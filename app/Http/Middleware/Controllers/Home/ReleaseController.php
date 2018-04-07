<?php

namespace App\Http\Controllers\home;

use App\Model\release;
use App\Model\user_home;
use App\Model\userinfo_home;
use App\Model\cate;
use Dotenv\Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReleaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $uid = Session('user')['uid'];
        $user = user_home::findOrFail($uid);
        $userinfo = $user->userinfo_home;

        $keywords = $request->input('keywords');

        $release = release::where('uid',$uid)
                            ->whereIn('status',[0,1])
                            ->where('gname','like','%'.$keywords.'%')
                            ->orderby('created_at','desc')
                            ->paginate(7);

        return view('home.release.user_release',compact('user','userinfo','release'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $uid = Session('user')['uid'];
        $user = user_home::find($uid);
        $userinfo = $user->userinfo_home;
        $cate = cate::get();
        $cates = $this->getCateTree();

        return view('home.release.release',compact('cate','user','cates','userinfo'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 删除无用数据
        $input = $request->except(['_token','dphone','file_upload']);

        // 表单验证
        $this->validate($request, [
            'gname' => 'required',
            'title' => 'required',
            'raddra' => 'required',
            'nowprice' => 'regex:/^\w{1,10}$/',
            'newprice'=>'regex:/^\w{1,10}$/',
            'rphone' => 'regex:/^\w{11}$/'
        ],[
            'gname.required'=>'请填写商品名',
            'title.required'=>'请填写标题',
            'raddra.required'=>'请选择发布地区',
            'nowprice.regex' => '请填写卖价',
            'newprice.regex' => '请填写新品参考价',
            'rphone.regex' => '请正确填写联系方式'
        ]);


        // 处理数据库写入数据
        $input['raddr'] = $input['raddrp'].','.$input['raddrc'].','.$input['raddra'];
        unset($input['raddrp']);
        unset($input['raddrc']);
        unset($input['raddra']);
        unset($input['pid']);


        // 在数据库存储数据
        $res = release::create($input);
        if ($res){
            return back()->withErrors('发布成功');
        } else {
            return back()->withErrors('发布失败，请重试一下');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($uid)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($rid)
    {
        $uid = Session('user')['uid'];
        $user = user_home::findOrFail($uid);
        $userinfo = $user->userinfo_home;

        return view('home/release/edit',compact('user','userinfo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }

    public function getCateTree( $cates=[], $pid=0 )
    {
        if( empty($cates) ){
            $cates = cate::get();
        }
        $sub = [];
        foreach( $cates as $k=>$v ){
            if( $v->pid == $pid ){
                $v->sub = $this->getCateTree( $cates, $v->cid );
                $sub[] = $v;
            }
        }
        return $sub;
    }

    public function update_release(Request $request)
    {
        $this->validate($request, [
            'nowprice' => 'regex:/^\d{1,}$/',
        ],[
            'nowprice.regex' => '请正确填写价格',
        ]);

        $rid = $request->only('rid');
        $input = $request->only('nowprice');

        $res = release::where('rid',$rid)->update($input);
        if ($res){
            return back();
        } else {
            return back()->withErrors('发布失败，请重试一下');
        }
    }

    public function destroy_release($rid)
    {
        $res = release::destroy($rid);

        if ($res) {
            return back();
        } else {
            return back()->withErrors('删除失败');
        }
    }
}

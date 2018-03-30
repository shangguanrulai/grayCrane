<?php

namespace App\Http\Controllers\home;

use App\Model\release;
use App\Model\user_home;
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
    public function index()
    {

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
        $cate = cate::get();
        $cates = $this->getCateTree();

        return view('home.release.release',compact('cate','user','cates'));
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
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
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
}

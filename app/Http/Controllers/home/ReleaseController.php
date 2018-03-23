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
        $user = user_home::find(1);
        $cate = cate::get();

        return view('home.release.release',compact('cate','user'));
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
        $input = $request->except(['_token','dphone']);

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

        // 判断是否有文件上传
        if (!$request->hasFile('gpic')){
            return back()->withErrors('请上传商品图片');
        }

        // 处理数据库写入数据
        $input['raddr'] = $input['raddrp'].','.$input['raddrc'].','.$input['raddra'];
        unset($input['raddrp']);
        unset($input['raddrc']);
        unset($input['raddra']);
        unset($input['pid']);

        // 存储上传文件
        $path = $request->file('gpic')->store('/home');
        $input['gpic'] = $path;


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
}

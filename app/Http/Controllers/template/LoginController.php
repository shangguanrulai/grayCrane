<?php

namespace App\Http\Controllers\Template;


use App\Model\Admin_User;

use App\Model\release;
use App\Org\code\Code;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;


class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

//    退出后台
    public function exit(Request $request)
    {
        $request->Session()->forget('user','count');
        return redirect('/login');
    }
    //后台登录页面
   public  function logins()
  {
     return view( 'template.logins.login');
  }
    public  function index()
    {
        return view( 'template.logins.index');
    }

   //生成验证码
    public function code()
    {

        $code = new Code;
        return $code->make();
//        return Code::make();
    }

    //登录处理逻辑
    public function doLogin(Request $request)
    {

//        echo 333;
//        die;
        //获取用户提交登录数据(用户名 密码 验证码)
        $input = $request->except('_token');


        //判断验证码是否正确

        if( strtolower($input['code']) !=strtolower(session()->get('code')) ){
            return back()->with('errors','验证码错误');
        }

        //判断是否有此用户

        $user = Admin_User::where('username',$input['username'])->first();

        if(!$user){
            return back()->with('errors','用户名不存在');
        }else if($user->status !=0){
            return back()->with('errors','你的用户名已被禁用,请与管理员联系');
        }
        $goods = release::get();
        $count = 0;
        foreach($goods as $v){
            if($v->status==0){
                $count++;
            }
        }
        Session::put('count',$count);

//     判断密码是否正确（加密方式）

        if(Hash::check($input['userpass'], $user->userpass)  ) {
            Session::put('user_admin',$user);
            return redirect('/template');

        }else{
            return back()->with('errors','密码错误');
        }

    }
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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

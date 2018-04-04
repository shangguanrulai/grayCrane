<?php

namespace App\Http\Controllers\Template;


use App\Model\User;
use App\Org\code\Code;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    //后台登录页面
   public  function logins()
  {
     return view( 'template.logins.login');
  }
    public  function index()
    {
        return view( 'template.logins.index');
    }


    //登录处理逻辑
    public function doLogin(Request $request)
    {

//        echo 333;
//        die;
        //获取用户提交登录数据(用户名 密码 验证码)
        $input = $request->except('_token');
//      dd($input);
        //对提交的数据进行验证
        $rule = [
            'username'=>'required|between:4,10',
            'userpass'=>'required|between:4,10'
        ];

        $msg = [
            'username.required'=>'用户名不能为空',
            'username.between'=>'用户名必须在4-10位之间',
            'userpass.required'=>'密码不能为空',
            'userpass.between'=>'密码必须在4-10位之间',
        ];

        $validator = Validator::make($input,$rule,$msg);
        //如果验证失败
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        //判断验证码是否正确

        if( strtolower($input['code']) !=strtolower(session()->get('code')) ){
            return back()->with('errors','验证码错误');
        }

        //判断是否有此用户

        $user = User::where('username',$input['username'])->first();

        if(!$user){
            return back()->with('errors','用户名不存在');
        }

//     判断密码是否正确（加密方式）
        if($input['userpass'] != Crypt::decrypt($user->userpass)) {
            return back()->with('errors','密码错误');
        }

        Session::put('user',$user);

        return redirect('tempalate/index');



    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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

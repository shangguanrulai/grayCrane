<?php

namespace App\Http\Controllers\home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

require_once app_path().'/Org/Code.class.php';
use App\Org\Code\Code;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use App\Model\user_home;
use App\Model\userinfo_home;


class RegisterController extends Controller
{
    //注册
    public function register()
    {
    	return view('home.register');
    	// return 1111;

	}

	public function yanzhengma()
    {
    	$code = new Code();
        return $code->make();
    }

	 public function doregister(Request $request)
    {
        // echo '11';
        // die;

        //验证
        $rule = [
            'uname'=> 'required|min:5|max:18',
            'uname'=> 'regex:/^\w{5,18}$/',
            'upass'=>'required|min:5|max:18 ',
            'upass'=>'regex:/^\w{5,18}$/ ',
            're-upass'=>'required|same:upass',
             // 'email'=>'required|email',
        ];


        $mess = [
            'uname.required'=>'用户名不能为空',
            'uname.regex'=>'用户名的长度必须在5-18位',
            'upass.required'=>'密码不能为空',
            'upass.regex'=>'密码的长度必须在5-18位',
            're-upass.required'=>'密码不能为空',
            're-upass.same:upass'=>'两次输入的密码不一致',
        ];

        // $input['password'] = encrypt($input['password']);
        // $input = $request->except('re-password');


        //Validator::make   验证
        $validator = Validator::make($request->all(),$rule,$mess);

        if ($validator->fails()) {
                                        return redirect('home/register')
                                            ->withErrors($validator)
                                            ->withInput();
                                    }



        // dd($validator);

        //except   除了
        $input = $request->except('code','re-upass','_token','submit');
       // dd($input['yzm']);

        // var_dump($input);
        // die;
         if(strtolower($input['yzm']) != strtolower(session('code'))){
            return back()->with('errors','验证码错误');
        }

        //  if($input['re-upass'] != $input['upass']){
        //     return back()->with('errors','两次密码不一致');
        // }
        unset($input['yzm']);
        // unset($input['re-upass']);

        $input['upass'] = hash::make($input['upass']);



        //创建时间  更新时间
         // $time = date('Y-m-d H:i:s',time());
         // $input['created_at']=$time;
         // $input['updated_at'] = $time;


        //状态
         $input['status'] = 0;
         unset($input['status']);

        $user = User_home::where('uname',$input['uname'])->first();

        //从表里面调取邮箱
       // $emails = User_home::where('email',$input['email'])->first();



        if ($user) {
            return back()->with('errors','用户已被注册');
        }

        //     if ($emails) {
        //     return back()->with('errors','邮箱已被激活');
        // }

        /* $res = \DB::table('user_home')->insert(); */

		$user_home = new user_home;
		$register = $user_home -> create($input);
		$uid = $register['uid'];

		$userinfo_home = new userinfo_home;
		$userinfo_home -> uid = $uid;
		$res = $userinfo_home -> save();

       if($res){
            // 发送邮件
             /*\Mail::send('mails.mails',['input' => $input],function($message)use($input){
                $message->to($input['email'])->subject('请激活您的账号');

             });*/
             //如果添加成功，跳转到列表页
            return redirect('/');
        }else{
            //如果添加失败，返回到添加页
            return back()->with('msg','添加失败');
       }

    }

}
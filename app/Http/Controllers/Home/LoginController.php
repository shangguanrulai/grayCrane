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
use Session;

class LoginController extends Controller
{
    //
    public function login()
    {
    	return view('home.login');
    }

 
    public function yzm()
    {

        ob_clean();
    	$code = new Code();
        return $code->make();
		
    }

    public function dologin(Request $request)
    {

       // 获取用户提交过来的登录数据
        $input = $request->except('_token');
		/* dd($input); */

		//验证数据的有效性
        $rule = [
            'uname'=>'required|between:5,18',
            'upass'=>'required|between:5,18|alpha_dash',
        ];

        //提示信息
        $mess = [
            'uname.required'=>'用户名不能为空',
            'uname.between'=>'用户名的长度必须在5-18位',
            'upass.required'=>'密码不能为空',
            'upass.between'=>'密码的长度必须在5-18位',
            'upass.alpha_dash'=>'密码必须是数字字母下划线',
        ];

        $validator = Validator::make($input, $rule,$mess);
        // dd($validator);
        // 如果验证失败
        if ($validator->fails()) {
            return redirect('home/login')
                ->withErrors($validator)
                ->withInput();
        }

        //验证码
       /* dd($input['yzm']); */
        if(strtolower($input['yzm']) != strtolower(session('code'))){
            return back()->with('errors','验证码错误');
        }

        $user = user_home::where('uname',$input['uname'])->first();
		
        
        //用户验证
        // dd($user->upass);
		// die;
        if (!$user) {
            return back()->with('errors','无此用户');
        } 
        // dd($user->password);

        //密码验证
        /* if(Crypt::decrypt($user->upass) != $input['upass']){
            return back()->with('errors','密码错误');
        } */
		
		if($user->upass != $input['upass']){
            return back()->with('errors','密码错误');
        } 
		

        $status = $user->userinfo_home->status;

        if ($status == 0) {
            return back()->with('errors','账号没激活');
        }




      //将用户的登录状态保存到session
        Session::put('inuser',$user);


        // return '111';
        return redirect('');

    }

    public function loginout(Request $request)
    {
       
       $res = $request->session()->flush();

       // dd($res);


       if(!$res){
           return redirect('home/login'); 
       }
        
    }

}

<?php

namespace App\Http\Controllers\home;

use App\Model\user_home;
use App\Model\userinfo_home;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $uid = Session('user')['uid'];
        $user = user_home::where('uid',$uid)->first();
        $userinfo = userinfo_home::where('uid',$uid)->first();


        $safeScore = 0;
        if ($userinfo['isTrue'] != 0){
            $safeScore += 2.5;
        }
        if ($user['phone']){
            $safeScore += 2.5;
        }
        if ($user['email']){
            $safeScore += 2.5;
        }
        if ($userinfo['payPass']){
            $safeScore += 2.5;
        }

        return view('Home.user.user',['user'=>$user,'userinfo'=>$userinfo,'safeScore'=>$safeScore]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $uid = Session('user')['uid'];
        $user = user_home::where('uid',$uid)->first();
        $userinfo = userinfo_home::where('uid',$uid)->first();

        return view('home.user.prcid',['user'=>$user,'userinfo'=>$userinfo]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'prcid' => 'regex:/^\d{17}[0-9xX]$/',
            'trueName' => 'required'
        ],[
            'prcid.regex' => '请正确填写身份证号码',
            'trueName.required' => '请填写真实姓名'
        ]);

        $input = $request->except('_token');
        $input['isTrue'] = 1;
        $uid = Session('user')['uid'];

        $res = userinfo_home::where('uid',$uid)->update($input);

        if ($res){
            return redirect('/home/user');
        } else {

            return back()->withErrors('修改失败，请重试一下');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($uid)
    {
        $uid = Session('user')['uid'];
        $user = user_home::where('uid',$uid)->first();
        $userinfo = userinfo_home::where('uid',$uid)->first();

       return view('home.user.edit',['user'=>$user,'userinfo'=>$userinfo]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $uid)
    {
        $this->validate($request, [
            'phone' => 'regex:/^1[3-9]\w{9}$/',
            'email'=>'email',
            'nickname' => 'required',
            'portrait' => 'required'
        ],[
            'phone.regex' => '请正确填写手机号码',
            'email.email' => '请填写邮箱',
            'nickname.required' => '请填写昵称',
            'portrait.required' => '请选择个人头像'
        ]);


        $user_input = $request->only(['phone','email']);
        $userinfo_input = $request->only(['nickname','portrait']);


        $res1 = user_home::where('uid',$uid)->update($user_input);
        $res2 = userinfo_home::where('uid',$uid)->update($userinfo_input);

        if($res1 && $res2){
            return redirect('/home/user');
        };
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

    public function pass(Request $request)
    {
        $uid = Session('user')['uid'];
        $user = user_home::where('uid',$uid)->first();
        $userinfo = userinfo_home::where('uid',$uid)->first();

        return view('home.user.pass',compact('user','userinfo'));
    }

    public function update_pass(Request $request)
    {
        $this->validate($request, [
            'upass' => 'regex:/^[\S]{6,18}$/',
            'reupass' => 'same:upass',
        ],[
            'upass.regex' => '密码必须6到18位，且不能出现空格',
            'reupass.same' => '两次输入的密码不一致',
        ]);

        $input = $request->input();
        $uid = Session('user')['uid'];
        $oldpass = user_home::findOrFail($uid);

        if (Hash::check($input['upass'],$oldpass['upass'])) {

            return back()->withErrors('新旧密码一致');
        } else if(Hash::check($input['oldupass'],$oldpass['upass'])){

            $upass = $request->only('upass');
            $upass['upass'] = Hash::make($request->upass);

            $res = user_home::where('uid',$uid)->update($upass);
            if ($res){
                return redirect('/home/user');
            } else {
                return back()->withErrors('修改失败请重试');
            }
        } else {
            return back()->withErrors('原密码错误');
        }
    }

    public function paypass()
    {
        $uid = Session('user')['uid'];
        $user = user_home::where('uid',$uid)->first();
        $userinfo = userinfo_home::where('uid',$uid)->first();

        return view('home.user.paypass',compact('user','userinfo'));
    }

    public function update_paypass(Request $request)
    {
        $uid = Session('user')['uid'];
        $oldpass = userinfo_home::where('uid',$uid)->first()['payPass'];

        $this->validate($request, [
            'payPass' => 'regex:/^\d{6}$/',
            'rePayPass' => 'same:payPass'
        ],[
            'payPass.regex' => '密码必须6位纯数字',
            'rePayPass.same' => '两次输入的密码不一致'
        ]);

        if($oldpass){
            $this->validate($request, [
                'oldPayPass' => 'required',
            ],[
                'oldPayPass.required' => '请输入原密码'
            ]);

            if (!Hash::check($request->oldPayPass,$oldpass)) {

                return back()->withErrors('原密码错误');
            } else if(Hash::check($request->payPass,$oldpass)) {

                return back()->withErrors('新旧密码一致');
            } else {

                $payPass = $request->only('payPass');
                $payPass['payPass'] = Hash::make($payPass['payPass']);

                $res = userinfo_home::where('uid',$uid)->update($payPass);

                if ($res){
                    return redirect('/home/user');
                } else {
                    return back()->withErrors('添加失败请重试');
                }
            }
        } else {

            $payPass = $request->only('payPass');
            $payPass['payPass'] = Hash::make($payPass['payPass']);

            $res = userinfo_home::where('uid',$uid)->update($payPass);

            if ($res){
                return redirect('/home/user');
            } else {
                return back()->withErrors('添加失败请重试');
            }
        }

    }

}

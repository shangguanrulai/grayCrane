<?php

namespace App\Http\Controllers\Home;

use App\Model\address;
use App\Model\user_home;
use App\Model\userinfo_home;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AddrController extends Controller
{
    public function index()
    {
        $uid = Session('user')['uid'];

        $user = user_home::find($uid);
        $userinfo = $user->userinfo_home;
        $addr = address::where('uid',$uid)->paginate(5);

        return view('home.address.addr',compact('user','userinfo','addr'));

    }

    public function create()
    {
        $uid = Session('user')['uid'];

        $user = user_home::find($uid);
        $userinfo = $user->userinfo_home;


        return view('home.address.create',compact('user','userinfo'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'rec' => 'required',
            'phone' => 'regex:/^1[3-9]\d{9}$/',
            'addr' => 'required'
        ],[
            'rec.required' => '请填写收货人姓名',
            'phone.regex' => '请正确填写手机号',
            'addr.required' => '请填写收货地址',
        ]);

        $input = $request->except('_token');
        $input['uid'] = Session('user')['uid'];

        $res = address::create($input);

        if ($res) {
            return redirect('/home/user/addr');
        } else {
            return back()->withErrors('添加失败请重试');
        }

    }

    public function edit($aid)
    {
        $uid = Session('user')['uid'];

        $user = user_home::find($uid);
        $userinfo = $user->userinfo_home;
        $addr = address::find($aid);


        return view('home.address.edit',compact('user','userinfo','addr'));
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'rec' => 'required',
            'phone' => 'regex:/^1[3-9]\d{9}$/',
            'addr' => 'required'
        ],[
            'rec.required' => '请填写收货人姓名',
            'phone.regex' => '请正确填写手机号',
            'addr.required' => '请填写收货地址',
        ]);

        $aid = $request->only('aid')['aid'];
        $input = $request->except('_token','aid');

        $res = address::where('aid',$aid)->update($input);

        if ($res) {
            return redirect('/home/user/addr');
        } else {
            return back()->withErrors('修改失败请重试');
        }
    }

    public function destroy($aid)
    {
        $res = address::destroy($aid);

        if ($res) {
            return back();
        } else {
            return back()->withErrors('删除失败');
        }
    }

}

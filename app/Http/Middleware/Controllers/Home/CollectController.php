<?php

namespace App\Http\Controllers\Home;

use App\Model\collect;
use App\Model\release;
use App\Model\user_home;
use App\Model\userinfo_home;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CollectController extends Controller
{
    public function index()
    {
        $uid = Session('user')['uid'];

        $user = user_home::find($uid);
        $userinfo = $user->userinfo_home;
        $collects = $user->collect;

        // 获取发布rid数据
        $rids = [];
        foreach ($collects as $k=>$v){
            $rids[] = $v['rid'];
        }

        $releases = release::whereIn('rid',$rids)->paginate(5);

        // 将收藏ID整合进发布数据中
        foreach ($releases as $k=>$v){
            $releases[$k]['id'] = $collects[$k]['id'];
        }

        return view('home.collect.collect',compact('user','userinfo','releases'));
    }

    public function destroy($id)
    {
        $res = collect::destroy($id);

        if ($res) {
            return back();
        } else {
            return back()->withErrors('取消失败');
        }
    }
}

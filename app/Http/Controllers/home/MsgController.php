<?php

namespace App\Http\Controllers\Home;

use App\Model\user_home;
use App\Model\Words;
use App\Model\release;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MsgController extends Controller
{
    public function index()
    {
        $uid = session('user')['uid'];
        $user = user_home::find($uid);
        $userinfo = $user->userinfo_home;

        // 获取用户发布的商品信息
        $release = $user->release;
        $rid = [];
        $gname = [];
        foreach($release as $v){
           $rid[] = $v['rid'];
           $gname[] = $v['gname'];
        }

        // 获取商品中有留言的
        $msg = [];
        foreach($rid as $k=>$v){
            $data = Words::where('rid',$v)->where('pid',0)->get();
            // 将商品名存入留言信息中
            foreach($data as $kk=>$vv){
                $data[$kk]['gname'] = $gname[$k];
            }
            // 将有留言的商品整合进数组中
            if($data->count() != ''){
                $msg[$k] = $data;
            }
        }

        // 获取用户发布的留言
        $user_msg = Words::where('uid',$uid)->get();
        $user_gname = [];
        // 将商品名存入留言信息中
        foreach($user_msg as $k=>$v){
            $user_gname[$k] = release::find($v['rid'])['gname'];
            $user_msg[$k]['gname'] = $user_gname[$k];
        }

        return view('home.msg.msg',compact('user','userinfo','msg','user_msg','data'));
    }



}

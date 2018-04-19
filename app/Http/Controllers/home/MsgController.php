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


        // 获取发布表中用户收到的留言
        $arr = Words::where('uid',$uid)->get();
        $msg = [];
        foreach ($arr as $v) {
           $res = Words::where('pid',$v['wid'])->get();
           if($res->count() != 0){
            $msg[] = $res;
           }
        }


        $rid = [];
        foreach ($msg as $k=>$v) {
            $rid[] = $v[0]['rid'];

        }
    
        
        foreach($rid as $k=>$v){
            $data = release::where('rid',$v)->get();
            // dd($data);
            // 将商品名存入留言信息中
            foreach($data as $kk=>$vv){
                $msg[$k][$kk]['gname'] = $data[0]['gname'];
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

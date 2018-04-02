<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Order;
use App\Model\user_home;
use App\Model\userinfo_home;
use App\Model\release;
use App\Model\address;

class OrdersController extends Controller
{
    public function sell()
    {
        $uid = Session('user')['uid'];
        $user = user_home::find($uid);
        $userinfo = $user->userinfo_home;

        $orders = Order::where('soleid',$uid)->orderBy('created_at','desc')->paginate(5);

        foreach($orders as $k=>$v){
            $gname = release::find($v['rrid'])['gname'];
            $gpic = release::find($v['rrid'])['gpic'];
            $addr = address::find($v['tid']);
            $addr = $addr['rec'].' '.$addr['phone'].' '.$addr['addr'].' '.$addr['code'];

            $orders[$k]['gname'] = $gname;
            $orders[$k]['gpic'] = $gpic;
            $orders[$k]['addr'] = $addr;
        }

        return view('home.orders.orders_sole',compact('user','userinfo','orders'));
    }

    public function send($oid)
    {
        $ostatus = ['ostatus'=>1];
        $res = Order::where('oid',$oid)->update($ostatus);
        return back();
    }

    public function buy()
    {
        $uid = Session('user')['uid'];
        $user = user_home::find($uid);
        $userinfo = $user->userinfo_home;

        $orders = Order::where('buyid',$uid)->orderBy('created_at','desc')->paginate(5);

        foreach($orders as $k=>$v){
            $gname = release::find($v['rrid'])['gname'];
            $gpic = release::find($v['rrid'])['gpic'];
            $addr = address::find($v['tid']);
            $addr = $addr['rec'].' '.$addr['phone'].' '.$addr['addr'].' '.$addr['code'];

            $orders[$k]['gname'] = $gname;
            $orders[$k]['gpic'] = $gpic;
            $orders[$k]['addr'] = $addr;
        }

        return view('home.orders.orders_buy',compact('user','userinfo','orders'));
    }

    public function take($oid)
    {
        $ostatus = ['ostatus'=>2];
        $res = Order::where('oid',$oid)->update($ostatus);
        return back();
    }

}



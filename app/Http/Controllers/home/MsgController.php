<?php

namespace App\Http\Controllers\home;

use App\Model\user_home;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MsgController extends Controller
{
    public function index($uid)
    {

        $stmt = new user_home();
        $user = $stmt->find($uid);
        $userinfo = $stmt->find($uid)->userinfo_home;

        return view('home.msg.msg',['user'=>$user,'userinfo'=>$userinfo]);
    }



}

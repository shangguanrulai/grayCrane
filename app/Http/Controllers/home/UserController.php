<?php

namespace App\Http\Controllers\home;

use App\Model\user_home;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $uid = $request->input('uid');
        $stmt = new user_home();
        $user = $stmt->find($uid);
        $userinfo = $stmt->find($uid)->userinfo_home;

        $safeScore = 0;
        if ($userinfo->isTrue != 0){
            $safeScore += 2.5;
        }
        if ($user->phone){
            $safeScore += 2.5;
        }
        if ($user->email){
            $safeScore += 2.5;
        }
        if ($userinfo->prcid){
            $safeScore += 2.5;
        }

        return view('home.user.user',['user'=>$user,'userinfo'=>$userinfo,'safeScore'=>$safeScore]);
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

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($uid)
    {
        $stmt = new user_home();
        $user = $stmt->find($uid);
        $userinfo = $stmt->find($uid)->userinfo_home;

       return view('home.user.edit',['user'=>$user,'userinfo'=>$userinfo]);
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

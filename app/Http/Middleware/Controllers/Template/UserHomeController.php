<?php

namespace App\Http\Controllers\template;

use App\Model\user_home;
use App\Model\userinfo_home;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserHomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users =user_home::with('userinfo_home')
            ->where(function($query) use($request){
//                检测关键字
            $gjz = $request -> input('keywords1');
            $qx = $request -> input('keywords2');
//                关键字不为空
            if(!empty($gjz)){
                $query -> where('uname','like','%'.$gjz.'%');


            }
            if(!empty($qx)){
                $query -> where('status',$qx);
            }
        })->paginate(5);
        return view('template.user.homelist',compact('users','request'));
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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

    public function change(Request $request)
    {

        $uid = $request -> input('id');

        if($request -> input('status')==1){
            $status=0;
        }else{
            $status=1;
        }
        $user =userinfo_home::where('uid',$uid)->first();
        $res = $user -> update(["status" => $status]);

        if($res){
            $arr=[
                'status'=>$status,
                'msg'=>'修改成功'

            ];
        }else{
            $arr=[
                'status'=>$status,
                'msg'=>'修改失败'

            ];
        }
        return $arr;

    }
}

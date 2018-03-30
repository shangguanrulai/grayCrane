<?php

namespace App\Http\Controllers\template;

use App\Model\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Perm_cate;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::get();
        return view('template.role.list',compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('template.role.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'role_name' => 'required'
        ],[
            'role_name.required' => '请输入角色名称!'
        ]);
//        接收表单传过来的数据
        $input = $request -> except('_token');
        $res = Role::create($input);
        if($res){
            return redirect('/role')->with('msg','添加成功');
        }else{
            return back()->with('msg','添加失败');
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
        $role = Role::find($id);

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
        $res = Role::destroy($id);
        if($res){
            return back()->with('msg','删除成功');
        }else{
            return back()->with('msg','删除失败');
        }
    }

    public function delall(Request $request)
    {
        $ids = $request -> input('ids');


        $res = Role::destroy($ids);


        if($res) {

            $arr = [

                'msg' => '删除成功'

            ];
        } else{
            $arr = [
                'msg' => '删除失败'
            ];
        }
        return $arr;

    }

    public function change(Request $request)
    {

        $uid = $request -> input('id');
//        $status = ($request -> input('status')==1)?0:1;
        if($request -> input('status')==1){
            $status=0;
        }else{
            $status=1;
        }
        $user = Role::find($uid);

        $res = $user -> update(['role_status' => $status]);

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
    public function auth($id)
    {
        //获取当前角色
        $role = Role::find($id);
        //获取所有权限
        $perms =Perm_cate::get()->prem;
        dd($perms);

//        return view('template.role.auth',compact('role'));
    }
}

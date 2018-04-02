<?php

namespace App\Http\Controllers\template;

use App\Model\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\perm_cate;
use App\Model\Perm;
use Illuminate\Support\Facades\DB;

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
        $perm_cate = perm_cate::get();
        //获取当前角色已经被授予的权限

        return view('template.role.auth',compact('role','perm_cate'));
    }

    public function showperm(Request $request)
    {
        $id = $request->input('id');
        $pid = $request->input('pid');
        $role = Role::find($id);
         $own_perms = $role->permission;
//        return $own_perms;
        $own_perids = [];
        foreach($own_perms as $v){
            $own_perids[] = $v->id;
        }

        $perms = Perm::where('pid',$pid)->get();
        $arr = [
            'own_perids' => $own_perids,
            'perms' => $perms,
        ];
        return $arr;
  }
//添加授权
  public function doauth(Request $request)
  {
        $input = $request->all();


//      将提交的数据提交到角色权限关联表
      DB::beginTransaction();
      try{
          //先删除当前角色所有被授予的权限
//          dd($input['cateid']);
          $permid = [];
          foreach($input['cateid'] as $v){
            $perm=Perm::where('pid',$v)->get();
                foreach($perm as $vv){
                    $permid[] = $vv->id;
                }
          }
          DB::table('role_permission')->whereIn('permission_id',$permid)->delete();
          if(!empty($input['checkbox'])){
              foreach($input['checkbox'] as $v) {
                  DB::table('role_permission')->insert([
                      'role_id' => $input['field_type'],
                      'permission_id' => $v
                  ]);
          }

          }
          DB::commit();
          return redirect('/role')->with('msg','授权成功');

      }catch(Exception $e){
          DB::rollBack()
              ->withErrors(['error'=>$e->getMessage()]);

      }
  }

}

<?php

namespace App\Http\Controllers\template;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Perm;
use App\Model\Perm_cate;

class PermController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $perm_cates = Perm_cate::get();
        $perms = Perm::
            where(function($query) use($request){
//                检测关键字
                $gjz = $request -> input('keywords1');
                $qx = $request -> input('keywords2');
//                关键字不为空
                if(!empty($gjz)){
                    $query -> where('title','like','%'.$gjz.'%');


                }
                if(!empty($qx)){
                    $query -> where('pid',$qx);
                }
            })
            ->get();
        return view('template.perm.list',['perms'=>$perms,'request'=>$request,'perm_cates'=>$perm_cates]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $perm_cates = Perm_cate::get();
        return view('template.perm.form',compact('perm_cates'));
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
            'title' => 'required',
            'urls' => 'required'
        ],[
            'title.required' => '请输入权限名称!',
            'urls.required' => '请输入路由'
        ]);
//        接收表单传过来的数据
        $input = $request -> except('_token');
        $res =Perm::create($input);
        if($res){
            return redirect('/perm')->with('msg','添加成功');
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
        $perm_cates = Perm_cate::get();
        $perm = Perm::find($id);
        return view('template.perm.edit',compact('perm','perm_cates'));
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
        $input = $request -> except('_token','_method');

        $res = Perm::where('id',$id)->update($input);
        if($res){
            return redirect('/perm')->with('msg','修改成功');
        }else{
            return back()->with('msg','修改失败');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $res = Perm::destroy($id);

        if($res){
            return back()->with('msg','删除成功');
        }else{
            return back()->with('msg','删除失败');
        }
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
        $perm = Perm::find($uid);

        $res = $perm -> update(['status' => $status]);

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

    public function delall(Request $request)
    {
        $ids = $request -> input('ids');


        $res = Perm::destroy($ids);


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
}

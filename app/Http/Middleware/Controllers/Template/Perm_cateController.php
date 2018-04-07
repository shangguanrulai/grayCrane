<?php

namespace App\Http\Controllers\template;

use App\Model\perm;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Perm_cate;

class Perm_cateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $perm_cates = Perm_cate::get();
        return view('template.perm_cate.list',compact('perm_cates'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('template.perm_cate.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request ->except('_token');
        $this->validate($request,[
            'pname' => 'required'
        ],[
            'pname.required' => '类名不能为空'
        ]);

        $res = Perm_cate::create($input);
        if($res){
            return redirect('/perm_cate')->with('msg','添加成功');
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
        $perms =perm::where('pid',$id)->get();
        if($perms->count()!=0){
            return back()->with('msg','请先清空分类,然后删除');
        }else{
            $res = Perm_cate::destroy($id);
            if($res){
                return back()->with('msg','删除成功');

            }else{
               return back()->with('msg','删除失败');
            }
        }

    }

    public function delall(Request $request)
    {
        $ids = $request -> input('ids');
        foreach($ids as $v){
            $perms = perm::where('pid',$v)->get();
            if($perms->count()!=0){
                $arr = [
                    'a'=>1,
                    'msg' => '请先清空权限'

                ];
                return $arr;
            }
        }

        $res = Perm_cate::destroy($ids);


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


    public function showperm($id)
    {


        $perms =perm::where('pid',$id)->get();
        return view('template.perm_cate.perms',compact('perms'));

    }
}

<?php

namespace App\Http\Controllers\template;

use App\Model\cate;
use App\Model\release;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $arr = Cate::tree();

        return view('template.cate.list',compact('arr'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {



        $cates = Cate::where('pid',0)->get();


        return view('template.cate.form',['cates'=>$cates]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        表单验证
        $this->validate($request,[
            'cname'=>'required',
        ],[
            'cname.required'=>'类别名称不能为空!!'
        ]);
        $cate = new Cate();
        //获取提交来的数据
        $input = $request -> except('_token');
        //验证该分类是否已经存在
        $arr = Cate::where('cname',$input['cname'])->first();
        if($arr){
            return back()->with('error','该类名已存在!');
        }
        //拼接path
        if($input['pid']==0){
            $cate->path = '0,';
        }else{
            $p_cate = Cate::find($input['pid']);

            $cate -> path = $p_cate->path.$input['pid'].',';
        }

        foreach($input as $k=>$v){
            $cate -> $k = $v;
        }

        $res = $cate -> save();
        if($res){
           return redirect('/cate');
       } else{
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
        $cate =Cate::find($id);
        return view('template.cate.add',compact('cate'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cate =Cate::find($id);
        $p_cate =Cate::where('cid',$cate->pid)->first();

        return view('template.cate.edit',compact('cate','p_cate'));
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
        //表单验证
        $this->validate($request,[
            'cname'=>'required',
        ],[
            'cname.required'=>'类别名称不能为空!!'
        ]);

        //获取提交来的数据
        $input = $request -> except('_token','_method');
        //验证该分类是否已经存在
        $arr = Cate::where('cname',$input['cname'])->first();
        if($arr){
            return back()->with('error','该类名已存在!');
        }

        $res = Cate::where('cid',$id)->update(['cname'=>$input['cname']]);

        if($res){
            return redirect('/cate');
        } else{
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
        $res = Cate::where('pid',$id)->get();
        $goods = release::where('cid',$id)->get();

        if($res->count()!=0){
            return back()->with('msg','该类别含子分类,不能删除!!');
        }else if($goods->count()!=0) {
            return back()->with('msg', '该类别含商品,不能删除!!');
        }else{

            $red =Cate::destroy($id);
            if($red){
                return back()->with('msg','删除成功');
            }else{
                return back()->with('msg','删除失败');
            }
        }
    }

    //批量删除
    public function delall(Request $request)
    {
        $cids = $request -> input('ids');


        foreach($cids as $k => $v){
            $res = Cate::where('pid',$v)->get();
            $goods = release::where('cid',$v)->get();

            if($res->count()!=0){
                $arr = [
                    'a'=>0,
                    'msg'=>'选中类别含子分类,无法删除'

                ];
                return $arr;
            }else if($goods->count()!=0){
                $arr = [
                    'a'=>0,
                    'msg'=>'选中类别含商品,无法删除'

                ];
                return $arr;
            }

        }

            $red =Cate::destroy($cids);
            if($red) {
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

<?php

namespace App\Http\Controllers\template;

use App\MOdel\Cate;
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

        if(empty($id)){
            $id = 1;
        }


        $p_cates = Cate::where('pid','0')->get();
        $c_cates = Cate::where('pid',$id)->get();
        return view('template.cate.list',compact('p_cates','c_cates'));
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
            return back()->with('error','该类户已存在!');
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
           return redirect('');
       } else{
            return back()->with('msg','添加成功');
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
        $p_cates = Cate::where('pid','0')->get();
        $c_cates = Cate::where('pid',$id)->get();
        return view('template.cate.list',compact('p_cates','c_cates'));
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
}

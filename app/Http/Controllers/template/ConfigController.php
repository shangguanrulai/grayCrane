<?php

namespace App\Http\Controllers\template;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Config;
use Illuminate\Support\Facades\DB;

class ConfigController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $configs = Config::where(function($query) use($request){
//                检测关键字
            $gjz = $request -> input('keywords1');
            $qx = $request -> input('keywords2');
//                关键字不为空
            if(!empty($gjz)){
                $query -> where('username','like','%'.$gjz.'%');


            }
            if(!empty($qx)){
                $query -> where('auth',$qx);
            }
        })
            ->paginate(10);

        foreach($configs as $v){
            switch ($v->field_type){
                //如果当前记录的类型是文本框
//      aaaa   =====>    <input type="text" name="title"  class="layui-input" value="aaaa">
                case 'input':
                    $v->config_desc = '<input type="text" name="config_desc[]" value="'.$v->config_desc.'">';
                    break;
                //如果当前记录的类型是文本域
//       bbbb   =====>     <textarea name=""  class="layui-textarea">bbbbb</textarea>
                case 'textarea':
                    $v->config_desc ='<textarea name="config_desc[]"  class="layui-textarea">'.$v->config_desc.'</textarea>';
                    break;
                //如果当前记录的类型是单选按钮
                case 'radio':
//      1|开启,0|关闭====>
//      <input type="radio" name="aaa" value="1" title="开启" checked="">
//      <input type="radio" name="aaa" value="0" title="关闭">
                    $str = '';
                    $arr = explode(',',$v->field_value);
//                  $arr = [
//                      0=>'1|开启',
//                      1=>'0|关闭',
//                  ];
                    foreach ($arr as $n){
                        $a = explode('|',$n);//[0=>1,1=>开启]
                        $checked =    ($a[0] == $v->config_desc)?'checked':'';

                        $str.= '<input type="radio" name="config_desc[]" value="'.$a[0].'" title="'.$a[1].'" '.$checked.'>'.$a[1];
                    }
                    $v->config_desc = $str;
                    break;
                case 'img':
                    $v->config_desc = "<input id=\"file_upload\" type=\"file\" name=\"fileupload\" value=\"\" style=\"position:relative;top:30px;opacity:0.0;z-index:99999999\"   ><input id=\"content\" type='hidden' name='config_desc[]' value=''><img  id=\"art_thumb\" style=position:relative;top:-20px;width:70px;height:70px src='/uploads/". $v->config_desc."' />";

            }
        }
        return view('template.config.list',['configs'=>$configs,'request'=>$request]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('template.config.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'config_title' => 'required',
            'config_name' => 'required',
            'config_desc' => 'required',
            'field_type' => 'required',

        ],[
            'config_title.required'=>'标题不能为空',
            'config_name.required'=>'名称不能为空',
            'config_desc.required'=>'内容不能为空',
            'field.type.required'=>'请选择类型',
            'config_order.required'=>'排序不能为空',
        ]);

        // 接受提交过来的数据
        $input = $request -> except('_token','fileupload');
        //验证名称是否已经存在
        $arr = Config::where('config_name',$input['config_name'])->first();

        if($arr){
            return back()->with('error','该用户已存在!');
        }
//      添加到配置表
        $res = Config::create($input);
        if($res){
            return redirect('/config');
        }else{
            return back()->with('msg','添加失败');
        };

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
        $configs =Config::find($id);
        return view('template.config.edit',compact('configs'));
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
        $this->validate($request, [
            'config_title' => 'required',
            'config_name' => 'required',
            'config_desc' => 'required',
            'field_type' => 'required',
            'config_order'=>'required',

        ],[
            'config_title.required'=>'标题不能为空',
            'config_name.required'=>'名称不能为空',
            'config_desc.required'=>'内容不能为空',
            'field.type.required'=>'请选择类型',
            'config_order.required'=>'排序不能为空',
        ]);

        // 接受提交过来的数据
        $input = $request -> except('_token','fileupload','_method');
        //验证名称是否已经存在
        $arr = Config::where('config_name',$input['config_name'])->first();

        if($arr){
            return back()->with('error','该用户已存在!');
        }
//      添加到配置表
        $res = Config::create($input);
        /*foreach($input as $k => $v){
            $user -> $k = $v;
        }
        $res = $user -> save();*/

        if($res){
            return redirect('/config');
        }else{
            return back()->with('msg','添加失败');
        };
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $res = Config::destroy($id);
        if($res){
            $arr=[
                'msg'=>'删除成功'
            ];
        }else{
            $arr=[
                'msg'=>'删除失败'

            ];
        }
        return $arr;
    }
    //图片上传
    public function uploads(Request $request)
    {
        $files = $request -> file('fileupload');
//        dd($files);
        $path = $files->store('uploads');
        return $path;
    }
    //批量修改
    public function change(Request $request)
    {

        $input = $request->except('_token','fileupload');



//        开启事务
       DB::beginTransaction();

        try{
            foreach($input['conf_id'] as $k=>$v){
                //$v就是要更新的网站配置项的id
                Config::find($v)->update(['config_desc'=>$input['config_desc'][$k]]);
            }
            DB::commit();
            return redirect('/config')->with('msg','修改成功');

        }catch(Exception $e){
            DB::rollBack();
            return redirect()->back()
                ->withErrors(['error' => $e->getMessage()]);
        }
        return redirect('/config');
    }

    //批量删除
    public function delall(Request $request)
    {
        $ids = $request -> input('ids');


        $res = Config::destroy($ids);


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

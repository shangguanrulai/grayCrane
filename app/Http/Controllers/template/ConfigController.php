<?php

namespace App\Http\Controllers\template;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Config;
use Illuminate\Support\Facades\DB;

class ConfigController extends Controller
{
//    取出网站配置项,写入config/webconfig.php文件
    public function putFile()
    {
//        从config中取出config_name config_desc两列的值
        $configs =Config::pluck('config_desc','config_name')->all();
//        写入webconfig.php中
        $str = '<?php return '.var_export($configs, true).';';
        file_put_contents(config_path().'/webconfig.php',$str);

        return back();

    }
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
                    $v->config_desc = '<input type="text" name="profile[]" value="'.$v->config_desc.'">';
                    break;
                //如果当前记录的类型是文本域
//       bbbb   =====>     <textarea name=""  class="layui-textarea">bbbbb</textarea>
                case 'textarea':
                    $v->config_desc ='<textarea name="profile[]"  class="layui-textarea">'.$v->config_desc.'</textarea>';
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

                        $str.= '<input type="radio" name="profile[]" value="'.$a[0].'" title="'.$a[1].'" '.$checked.'>'.$a[1];
                    }
                    $v->config_desc = $str;
                    break;
                case 'img':
                    $v->config_desc = "<input id=\"file_upload\" type=\"file\" name=\"fileupload\" value=\"\" style=\"position:relative;top:30px;opacity:0.0;z-index:99999999\"   ><input id=\"content\" type='hidden' name='profile[]' value='".$v->config_desc."'><img  id=\"art_thumb\" style=position:relative;top:-20px;width:70px;height:70px src='/uploads/". $v->config_desc."' />";

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
            'profile' => 'required',

            'field_type' => 'required',

        ],[
            'config_title.required'=>'标题不能为空',
            'config_name.required'=>'名称不能为空',
            'profile.required'=>'内容不能为空',

            'field.type.required'=>'请选择类型',
            'config_order.required'=>'排序不能为空',
        ]);

        // 接受提交过来的数据
        $input = $request -> except('_token','fileupload');

        //验证名称是否已经存在
        $arr = Config::where('config_name',$input['config_name'])->first();

        if($arr){
            return back()->with('error','该配置已存在!');
        }

            $input['config_desc']=$input['profile'];


        unset($input['profile']);

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

    //批量修改
    public function change(Request $request)
    {

        $input = $request->except('_token','fileupload');

//        开启事务
       DB::beginTransaction();

        try{
            foreach($input['conf_id'] as $k=>$v){
                //$v就是要更新的网站配置项的id

                Config::find($v)->update(['config_desc'=>$input['profile'][$k]]);
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

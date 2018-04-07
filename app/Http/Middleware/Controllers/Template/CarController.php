<?php

namespace App\Http\Controllers\template;

use App\Model\Carousel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CarController extends Controller
{
    public function index()
    {
        $cars = Carousel::get();


        return view('template.car.list',compact('cars'));

    }

    public function create()
    {
        return view('template.car.form');
    }

    public function store(Request $request)
    {
        //表单验证
        $this->validate($request, [
            'profile' => 'required',
            'purl' => 'required',
            'pstatus'=>'required',

        ],[
            'profile.required'=>'请先上传图片',
            'purl.required'=>'链接不能为空',
            'pstatus.required'=>'请选择状态',
        ]);

        // 接受提交过来的数据
        $input = $request -> except('_token','fileupload');

//      添加到轮播图表
        $res =Carousel::create($input);


        if($res){
            return redirect('/car');
        }else{
            return back()->with('msg','添加失败');
        };

    }

    public function show($id)
    {

    }

    public function edit($id)
    {
        $cars =Carousel::find($id);
        return view('template.car.edit',compact('cars'));
    }

    public function update(Request $request, $id)
    {
        //表单验证
        $this->validate($request, [
            'profile' => 'required',
            'purl' => 'required',
            'pstatus'=>'required',

        ],[
            'profile.required'=>'请先上传图片',
            'purl.required'=>'链接不能为空',
            'pstatus.required'=>'请选择状态',
        ]);

        // 接受提交过来的数据
        $input = $request -> except('_token','fileupload','_method');
        $car =Carousel::find($id);

//      添加到轮播图表
        foreach($input as $k => $v){
            $car -> $k = $v;
        }

        $res = $car -> save();


        if($res){
            return redirect('/car');
        }else{
            return back()->with('msg','添加失败');
        };

    }

    public function destroy($id)
    {
        $res =Carousel::destroy($id);
        if($res){
            return back()->with('msg','删除成功');
        }else{
            return back()->with('msg','删除失败');
        }
    }

    public function delall(Request $request)
    {
        $ids = $request -> input('ids');


        $res =Carousel::destroy($ids);


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

        $id = $request -> input('id');
//        $status = ($request -> input('status')==1)?0:1;
        if($request -> input('pstatus')==1){
            $pstatus=0;
        }else{
            $pstatus=1;
        }
        $cars = Carousel::find($id);

        $res = $cars -> update(['pstatus' => $pstatus]);

        if($res){
            $arr=[
                'pstatus'=>$pstatus,
                'msg'=>'修改成功'

            ];
        }else{
            $arr=[
                'pstatus'=>$pstatus,
                'msg'=>'修改失败'

            ];
        }
        return $arr;

    }
}

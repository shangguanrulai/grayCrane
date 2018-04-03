<?php

namespace App\Http\Controllers\template;

use App\Model\Goods;
use App\Model\Words;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GoodsController extends Controller
{
    //上架
    public function index(Request $request)
    {
        $goods = Goods::where(function($query) use($request){
//                检测关键字
                $gjz = $request -> input('keywords1');
                $qx = $request -> input('keywords2');
//                关键字不为空
                if(!empty($gjz)){
                    $query -> where('gname','like','%'.$gjz.'%');


                }
                if(!empty($qx)){
                    $query -> where('status',$qx);
                }
            })
            ->paginate(10);;
        // Goods::where('rid',$id)->update(['status'=>$status]);
        return view('template.goods.index',compact('goods','request'));

    }
    // //下架
    // public function down($id)
    // {
    //    Goods::where('rid',$id)->update(['status'=>0]);
    //     return redirect('/user');

    // }
    public function change(Request $request)
    {


        $rid = $request -> input('rid');


//        $status = ($request -> input('status')==1)?0:1;
        if($request -> input('status')==1){
            $status=2;
        }else if($request -> input('status')==0){
            $status=1;
        }else if($request -> input('status')==2){
            $status=1;
        }



       $res = Goods::where('rid',$rid)->update(['status'=>$status]);




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

   public function details($rid)
   {
        $details= Words::where('rid',$rid)->get();
        // dd($data);
        return view('template.goods.details',compact('details'));
   }

   public function delete($wid){



       $res = Words::where('wid',$wid)->delete();


       if($res) {



               return back()->with('msg','删除成功');


       } else{

                return back()->with('msg','删除失败');

       }


   }


}
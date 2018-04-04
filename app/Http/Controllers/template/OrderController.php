<?php

namespace App\Http\Controllers\template;

use App\Model\Carousel;
use App\Model\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $orders = DB::table('orders')
            ->join('user_home', 'soleid', '=', 'user_home.uid')
            ->join('user_home as tmp','buyid', '=','tmp.uid')
            ->join('address', 'tid', '=', 'address.aid')
            ->join('release','rrid','=','release.rid')
            ->select('orders.*', 'user_home.uname as solename','tmp.uname as buyname','address.addr','release.gname')
            ->where(function($query) use($request){
//                检测关键字
                $gjz = $request -> input('keywords1');
                $qx = $request -> input('keywords2');
//                关键字不为空
                if(!empty($gjz)){
                    $query -> where('gname','like','%'.$gjz.'%');

                }
                if(!empty($qx)){
                    $query -> where('ostatus',$qx);
                }
            })
            ->paginate(10);

        return view('template.order.list',compact('orders','request'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $orders = Order::find($id);
        if($orders->ostatus==3){
            $res =Order::destroy($id);
        }else{
            return back()->with('msg','订单未完成,不可删除');
        }


        if($res){
            return back()->with('msg','删除成功');
        }else{
            return back()->with('msg','删除失败');
        }
    }

    public function delall(Request $request)
    {
        $ids = $request -> input('ids');
        $res = Order::destroy($ids);
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

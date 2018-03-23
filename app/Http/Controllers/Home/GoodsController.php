<?php

namespace App\Http\Controllers\home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\cate;
use App\Model\release;

class GoodsController extends Controller
{
    //商品列表页综合排序
    public function index(){

        //获取一级分类
        $zong = cate::where('pid','0')->get();

        //获取所有商品
        $goods = release::get();

        //分页
        $limits = release::paginate(1);


        return view('home.fenlei',['cname'=>$zong,'goods'=>$goods,'limits'=>$limits]);
    }

    public function ajax($c)
    {
       $b = cate::where('pid','1')->get();

         return $b;

    }

    //发布时间排序
    public function fbsj(){
        return view('home.fbsj');
    }


}



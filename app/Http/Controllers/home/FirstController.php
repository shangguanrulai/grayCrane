<?php

namespace App\Http\Controllers\home;

use App\Model\cate;
use App\Model\release;
use App\Model\Carousel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FirstController extends Controller
{
    /**
     * 首页显示
     * 2018-03-20
     * return 页面
     */
    public function index()
    {
        $cates = $this->getCateTree();
        $hot = release::where('status',1)->orderby('PV','desc')->get();
        $goods = release::where('status',1)->get();
        $Carousel = Carousel::get();
        // dd($Carousel);
        return view('home/first/index',compact('cates','hot','goods','Carousel'));

    }


    public function getCateTree( $cates=[], $pid=0 )
    {
        if( empty($cates) ){
            $cates = cate::get();
        }

        $sub = [];
        foreach( $cates as $k=>$v ){
            if( $v->pid == $pid ){
                $v->sub = $this->getCateTree( $cates, $v->cid );
                $sub[] = $v;
            }
        }

        return $sub;
    }




}

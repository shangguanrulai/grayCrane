<?php

namespace App\Http\Controllers\Home;

use App\Model\cate;
use App\Model\release;
use App\Model\Carousel;
use App\Model\user_home;
use App\Model\userinfo_home;
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
        $uid = Session('user')['uid'];
        $user = user_home::where('uid',$uid)->first();
        $userinfo = userinfo_home::where('uid',$uid)->first();

        $cates = $this->getCateTree();
        $hot = release::where('status',1)->orderby('PV','desc')->get();
        $goods = release::where('status',1)->orderby('created_at','desc')->get();
        $Carousel = Carousel::where('pstatus',1)->get();
        $i = 0;
        $j = 0;

        return view('home/first/index',compact('cates','hot','goods','Carousel','user','userinfo','i','j'));
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

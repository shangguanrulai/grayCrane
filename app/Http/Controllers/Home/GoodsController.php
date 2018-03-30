<?php

namespace App\Http\Controllers\home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Model\cate;
use App\Model\release;
use App\Model\Admin_User;
use App\Model\collect;
use App\Model\user_home;
use App\Model\userinfo_home;



use App\Model\Words;

use Illuminate\Support\Facades\Session;

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
    // ajax
    public function ajax(Request $request)
    {
       return 123;

//        echo $b;

    }

    //发布时间排序
    public function fbsj(){
        return view('home.fbsj');
    }

    //商品详情
    public function details(Request $request){
        //选择的商品
        $goods = Release::find(2);
        //获取发布人信息
        $a = $goods['uid'];
        //发布人详情
        $users = userinfo_home::where('uid',$a)->first();
        
        //获取加入的天数
        $b = $users['created_at'];
        $c = strtotime($b);

        $d = time();
        $e = $d - $c;
        $f = ceil($e/86400);




        
       
       


        if(empty(Session('user')) ){
            $flag = 0;
            
        }else{
            $flag = 1;
             
        }



        //获取所有留言及回复
        $ping = Words::where('rid',2)->get();

       
      

        
        






        return view('home.details',['goods'=>$goods,'users'=>$users,'f'=>$f,'flag'=>$flag,'ping'=>$ping]);
    }

    //商品收藏ajax
   public function ajaxs(Request $request){

        //获取商品id
        $rid =  $request->input('rid');
        //获取用户id
        $uid = Session('user')['uid'];


        /*$uid = $_GET['uid'];
        $rid = $_GET['cid'];*/


//        $uid = $all[uid];
//        $rid = $all[cid];


        //将数据加入收藏表

        $fan = Collect::where('uid',$uid)->where('rid',$rid)->first();

        

        if( !empty($fan)){
            return '有值';
        } else {
            $collect = new Collect;
            $collect->uid = $uid;
            $collect->rid = $rid;
            $collect->save();

            return '插入成功';
        }

       
        
    



    }

    //留言ajax
    public function ajaxss(Request $request){

        $rid = $request->input('rid');
        $umessage = $request->input('umessage');

         //登录用户的信息
        $useruid = Session('user')['uid'];

        $a = userinfo_home::where('uid',$useruid)->get();

        return var_dump($a);



        
       
        /*添加留言*/
        $words = new Words;

        $words->uid = $user;

        $words->rid = $rid;

        $words->umessage = $umessage;

        $words->save();


        return 123;

    }   
}


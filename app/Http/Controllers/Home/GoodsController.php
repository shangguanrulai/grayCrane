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
use App\Model\address;
use App\Model\Order;



use App\Model\Words;

use Illuminate\Support\Facades\Session;

class GoodsController extends Controller
{
    //商品列表页综合排序
    public function index(Request $request){

        $req = $request->input('cid');
        //获取一级分类
        $zong = cate::where('pid','0')->get();
        //获取二级分类
        $er = cate::where('pid','1')->get();





        //获取
        $goods = release::where('cid',$req)->paginate(1);


        if($goods->count() == 0){

            $release = new Release;
            $goods = $release->paginate(1);
        }


        

        
        

        //分页
       



        return view('home.fenlei',['er'=>$er,'cname'=>$zong,'goods'=>$goods]);
    }
    // ajax
    public function ajax(Request $request)
    {
       $cid = $request->input('cid');

       $er = cate::where('pid',$cid)->get();

       echo $er;


    }

    //发布时间排序
    public function fbsj(){
        return view('home.fbsj');
    }

    //商品详情
    public function details(Request $request){
        //选择的商品
        $goods = Release::find(11);
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

        //浏览量
        Release::where('rid','11')->increment('PV');


       

      



    //获取收藏情况
    $collect = Collect::where('rid','33')->get();

        
       
       


        if(empty(Session('user')) ){
            $flag = 0;
            
        }else{
            $flag = 1;
             
        }


        //获取留言个数
        $count = count(Words::where('pid','0')->get());

        //获取所有留言及回复
        $liu = Words::get();

       
        //获取登录uid
      $useruid = Session('user')['uid']; 



      //获取买家信息
      $musers = userinfo_home::where('uid',$useruid)->first();




     

      

        
        






       return view('home.details',['goods'=>$goods,'users'=>$users,'f'=>$f,'flag'=>$flag,'liu'=>$liu,'collect'=>$collect,'count'=>$count,'musers'=>$musers]);
    }

    //商品收藏ajax
   public function ajaxs(Request $request){

        //获取商品id
        $rid =  $request->input('rid');
        //获取用户id
        $uid = Session('user')['uid'];




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
        $useruid = $request->input('uid');



        $info = userinfo_home::where('uid',$useruid)->first();

        

        $nickname = $info -> nickname;

        $portrait = $info->portrait;

        

        
       
        /*添加留言*/
        $words = new Words;

        $words->uid = $useruid;

        $words->rid = $rid;

        /*$words->pid = $pid;*/

        $words->umessage = $umessage;

        $words->nickname = $nickname;

        $words->portrait = $portrait;

        $words->save();

        return 123;



    }   
    //回复留言
    Public function ajaxsss(Request $request){
        $text = $request->input('text');
        $pid = $request->input('pid');
        $rid = $request->input('rid');

         $useruid = Session('user')['uid'];

        $info = userinfo_home::where('uid',$useruid)->first();




        $nickname = $info -> nickname;

        $portrait = $info->portrait;

        /*添加留言*/
        $words = new Words;

        $words->uid = $useruid;

        $words->rid = $rid;

        $words->pid = $pid;


        $words->umessage = $text;

        $words->nickname = $nickname;

        $words->portrait = $portrait;

        $save = $words->save();


    }
    //删除留言
    Public function ajaxssss(Request $request){

        $wid = $request->input('wid');



        $words =Words::where('wid', $wid)->delete();;
        

        
    }


    //商品购买
    Public function buy($rid){



        $useruid = Session('user')['uid']; 

        //商品信息
       $goods = Release::find($rid);
       //买家信息
       $users = userinfo_home::where('uid',$useruid)->first();
       //卖家收货信息
       $address = address::where('uid',$useruid)->first();








       return view('home.buy',['goods'=>$goods,'users'=>$users,'address'=>$address]);
    }
//提交表单到数据库ajax
    public function ajaxsssss(Request $request){


    }

//付款
    Public function pay(Request $request){

        $rid = $request->input('rid');

        $buyid = $request->input('buyid');

        $price = $request->input('price');

        $omsg = $request->input('omsg');

        $onumber = time();

        $userinfo = userinfo_home::where('uid',$buyid)->first();

        $payPass = $userinfo['payPass'];



        

        

        return view('home.pay',['rid'=>$rid,'buyid'=>$buyid,'price'=>$price,'omsg'=>$omsg,'onumber'=>$onumber,'payPass'=>$payPass]);

    }

    //购买成功
    public function success(Request $request){

        $rrid = $request->input('rid');

        $buyid = $request->input('buyid');

        $sole= Release::where('rid',$rrid)->first();

        $soleid = $sole-> uid;

        $t = address::where('uid',$buyid)->first();

        $tid = $t -> aid;

        
        $price = $request->input('price');

        $omsg = $request->input('omsg');

        $onumber = $request->input('onumber');



        $order = new Order;

        $order->soleid = $soleid;

        $order->buyid = $buyid;

        $order->onumber = $onumber;

        $order->price = $price;

        $order->omsg = $omsg;

        $order->tid = $tid;

        $order->rrid = $rrid;

        $order->save();



        
    }


    //获取所有的留言及评论
    public function getCateTree( $cates=[], $pid=0 )
        {
            if( empty($cates) ){
                $cates = $this->cates -> select();
            }
            
            $sub = [];
            foreach( $cates as $k=>$v ){
                if( $v->pid == $pid ){
                    $v->sub = $this -> getCateTree( $cates, $v->cid );
                    $sub[] = $v;
                }
            }
            
            return $sub;
    }

}


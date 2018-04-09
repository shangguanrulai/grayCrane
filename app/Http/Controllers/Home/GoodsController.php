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

use Hash;



use App\Model\Words;

use Illuminate\Support\Facades\Session;

class GoodsController extends Controller
{
    //商品列表页综合排序
    public function index(Request $request){


        $cid = $request->input('cid');


    //获取分类下的所有商品

    $cates = $this->getCateTree();

    $goods = release::where('cid',$cid)->paginate(3);

    //如果分类下没有商品 ,则显示所有商品
    if($goods->count() == 0){

            $release = new Release;
            $goods = $release->paginate(3);
        }

    //检测关键字
    $gname = $request->input('gname');
    //检测价格区间
   /* $tp = $request->input('tp');
    $bp = $request->input('bp');
*/
   

   /* if(!empty($gname) || !empty($tp) || !empty($bp)){*/

        
    //多条件并分页
       /* $goods = Release::orderBy('rid','asc')
            ->where(function($query) use($request){
                
                //如果用户名不为空
                if(!empty($gname)) {
                    $query->where('gname','like','%'.$gname.'%');
                }
                //如果价格不为空
                if(!empty($tp)){
                    $query->where('newprice','<=',$tp);
                }
                if(!empty($bp)){
                     $query->where('newprice','<=',$tp);
                }
            })
            ->paginate($request->input('num', 5));
    }*/
   if(!empty($gname)){
     $goods = Release::where('gname','like','%'.$gname.'%')->paginate(3);

           
        }



        $uid = Session('user')['uid'];
        $user = user_home::where('uid',$uid)->first();
        $userinfo = userinfo_home::where('uid',$uid)->first();
    //获取推荐商品
    $recommend = Release::where('recommend','1')->get();



        return view('home.fenlei',['goods'=>$goods,'recommend'=>$recommend,'cates'=>$cates,'user'=>$user,'userinfo'=>$userinfo]);
    }
    // ajax
    public function ajax(Request $request)
    {
       $cid = $request->input('cid');

       $er = cate::where('pid',$cid)->get();

       echo $er;


    }

    //商品筛选
    Public function choose(Request $request){

        $goods = $request->input('goods');

        return $goods;

    }

    //商品详情
    public function details(Request $request){

        $rid = $request->input('rid');


        //选择的商品
        $goods = Release::find($rid);
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
        Release::where('rid','$rid')->increment('PV');


       

      



    //获取收藏情况
    $collect = Collect::where('uid',$a)->get();

        
       
       


        if(empty(Session('user')) ){
            $flag = 0;
            
        }else{
            $flag = 1;
             
        }


        //获取留言个数
        $count = count(Words::where('pid','0')->get());

        //获取所有留言及回复
        /*$liu = Words::get();*/
        $liu=array();
        $liu=$this->getCommlist();//获取评论列表

        /*dd($liu);*/

        /*return $liu;*/
        
        

        

       
        //获取登录uid
      $useruid = Session('user')['uid']; 



      //获取买家信息
      $musers = userinfo_home::where('uid',$useruid)->first();




     
      $cates = $this->getCateTree();

      $uid = Session('user')['uid'];
        $user = user_home::where('uid',$uid)->first();
        $userinfo = userinfo_home::where('uid',$uid)->first();
      

        
        






       return view('home.details',['goods'=>$goods,'users'=>$users,'f'=>$f,'flag'=>$flag,'liu'=>$liu,'collect'=>$collect,'count'=>$count,'musers'=>$musers,'useruid'=>$useruid,'cates'=>$cates,'user'=>$user,'userinfo'=>$userinfo]);
    }

     //获取所有留言及回复
    protected function getCommlist($parent_id = 0,&$result = array()){

        $arr = words::where('pid',$parent_id)->get();

        
        if(empty($arr)){
            return array();
        }
        foreach ($arr as $cm) {
            $thisArr=&$result[];

            $cm["children"] = $this->getCommlist($cm["wid"],$thisArr);

            $thisArr = $cm;
        }
        return $result;
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
        /*$useruid = $request->input('uid');*/
        $useruid = Session('user')['uid']; 



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

        return 123;


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
       $address = address::where('uid',$useruid)->get();









       return view('home.buy',['goods'=>$goods,'users'=>$users,'address'=>$address]);
    }
//添加收货地址
    Public function address(Request $request){
        //前台用户id
         $uid = Session('user')['uid'];

         $rec =$request->input('rec');

         $addr =$request->input('addr');


         $phone =$request->input('phone');

         $code =$request->input('code');

         $address = new address;

        $address->uid = $uid;

        $address->rec = $rec;

        $address->addr = $addr;

        $address->phone = $phone;

        $address->code = $code;



        $address->save();

        return back();

         



    }
//提交表单到数据库ajax
    public function ajaxsssss(Request $request){


    }

//付款
    Public function pay(Request $request){

        $rid = $request->input('rid');

        $aid = $request->input('aid');




        $buyid = $request->input('buyid');

        $price = $request->input('price');

        $omsg = $request->input('omsg');

        $onumber = date('Ymd').$rid.$buyid;

       


        

        

        return view('home.pay',['rid'=>$rid,'buyid'=>$buyid,'price'=>$price,'omsg'=>$omsg,'onumber'=>$onumber]);

    }

    //购买成功
    public function success(Request $request){

        $password = $request->input('password');



        $buyid = $request->input('buyid');

        //密码验证
         $userinfo = userinfo_home::where('uid',$buyid)->first();

        $payPass = $userinfo['payPass'];



         if(!Hash::check($password,$payPass)){
            return back()->with('errors','支付密码错误');
        }else{

        $rrid = $request->input('rid');

        

        $sole= Release::where('rid',$rrid)->first();

        $soleid = $sole-> uid;

        //通过uid查询收货地址
        $t = address::where('uid',$buyid)->first();



        $tid = $t['aid'];

        
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


        return view('home.success');






        
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


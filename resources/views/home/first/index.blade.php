@include('Home.common.index_header');


<div class="wrapper-box">
    <!-- banner-wrapper -->
    <div class="banner-wrapper">
        <div class="banner-slider-wrap" style="margin-top: -45px">
            <div class="layui-carousel" id="test1">
  <div carousel-item>
    <div><img src="/Images/3b97ccd974f522aeb7031b9453ff4a49.gif"  width="1420px" alt=""></div>
    <div><img src="/Images/2.jpg" width="1420px" alt=""></div>
    <div><img src="/Images/3.jpg" width="1420px" alt=""></div>
    <div><img src="/Images/4.jpg" width="1420px" alt=""></div>
    <!-- <div><img src="/Images/1.jpg" alt=""></div> -->
  </div>
</div>
<!-- 条目中可以是任意内容，如：<img src=""> -->

<script src="/layui/layui.js"></script>
<script>

layui.use('carousel', function(){
  var carousel = layui.carousel;
  //建造实例
  carousel.render({
    elem: '#test1'
    ,width: '100%' //设置容器宽度
    ,height: '450px'
    ,arrow: 'always' //始终显示箭头
    //,anim: 'updown' //切换动画方式
  });
});
</script>
        </div>
        <div class="wrapper clearfix" >
            <div class="sign-box-wrap" style="margin-top: -20px;margin-right: -20px">
               <!--  <i class="bg">
                </i> -->
                <div class="sign-box" style=>
                    <div class="user-box">
                        <a href="/user/index" target="_blank" class="avator">
                            <img src="Picture/head50.png" alt="" width="60" height="60">
                        </a>
                        <div class="logined-box">
                            <p class="welcome-tip">亲爱的，<a href="/user/index" target="_blank">忌惮</a> <br />欢迎回来！</p>
                            <a class="button" href="/user/index" target="_blank">个人中心</a>
                        </div>
                    </div>
                    <div class="banner-goods-slider">
                        <h3>开团抢购进行中</h3>
                        <div class="goods-bxslider-wrap">
                            <ul class="goods-bxslider">
                                <li >
                                    <a href="/secforum/3227351.html" class="good-pic">
                                        <img src="Picture/31e218e2ebe593659b9f83d844517cda.jpg" alt="">
                                        <span class="sold-out"></span>
                                    </a>
                                    <a href="/secforum/3227351.html" class="goods-title">TENBA天霸 通用单肩公文摄影包 单反相机包单肩包 索尼微单相机包</a>
                                    <div class="price-bar"><a href="/secforum/3227351.html" class="buy-button">抢购</a><span class="goods-price">&yen;199.00</span></div>
                                </li>
                                <!-- <li >
                                    <a href="/secforum/3227352.html" class="good-pic">
                                        <img src="Picture/0947eb11d29dc619c4fa9b5324842708.jpg" alt="">
                                        <span class="sold-out"></span>
                                    </a>
                                    <a href="/secforum/3227352.html" class="goods-title">天霸摄影包 CLASSIC P211 经典系列-迷你信使单肩摄影包 638-604</a>
                                    <div class="price-bar"><a href="/secforum/3227352.html" class="buy-button">抢购</a><span class="goods-price">&yen;180.00</span></div>
                                </li>
                                <li >
                                    <a href="/secforum/3227353.html" class="good-pic">
                                        <img src="Picture/4a07619a93bd8749376d04f2bca0ecf6.jpg" alt="">
                                        <span class="sold-out"></span>
                                    </a>
                                    <a href="/secforum/3227353.html" class="goods-title">天霸摄影包 CLASSIC TENBA 2 经典系列 单肩摄影包 638-605</a>
                                    <div class="price-bar"><a href="/secforum/3227353.html" class="buy-button">抢购</a><span class="goods-price">&yen;99.00</span></div>
                                </li> -->
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    <!-- //banner-wrapper -->


    <!-- pic-wrapper -->
    <div class="wrapper pic-wrapper">
        <div class="time-axis-bar clearfix">
            <a href="http://2.fengniao.com/recycle" target="_blank" class="axis-title"><img src="Picture/811c85a24dce709e9e2074f1141e7623.jpg" alt=""></a>
            <a href="http://2.fengniao.com/jd/84" target="_blank" class="axis-main">
                <img class="timer-line-b" src="Picture/7bb0e1c8e86dc3f5439bc251c20a3bff.gif" alt="">
                <img class="timer-line-s" style="display: none;" src="" alt="">
            </a>
        </div>


    </div>
    <!-- //pic-wrapper -->
    <div class="wrappwe-box">
        <div class="wrapper">
        </div>
        <div class="wrapper-goods">

            <div class="floor-fixed-wrap">
                <div class="floor-fixed-bar" style="visibility: hidden;">
                                <span class="floor-link recycle-fixed-link" rel="recycle-box">
                    灰鹤<br>回收
                </span>
                    <span class="floor-link repair-fixed-link" rel="rent-box">
                    租赁<br>维修
                </span>
                    <span class="floor-link auction-fixed-link" rel="auction-box">
                   灰鹤<br>拍卖
                </span>
                    <span class="floor-link appraisal-fixed-link" rel="appraisal-box">
                    灰鹤<br>鉴定
                </span>
                    <span class="floor-link goods-fixed-link" rel="goods-grid-box">
                淘<br>二手
                </span>
                </div>

            </div>


            <div class="wrapper">
                <!-- recycle-box -->
                <div class="recycle-box">
                    <span class="slogan"></span>
                    <div class="recycle-header">
                        <a href="http://2.fengniao.com/recycle" class="more-link">更多</a>
                        <h3><a href="http://2.fengniao.com/recycle">灰鹤热门</a></h3>
                        <a href="http://2.fengniao.com/recycle" class="slogan">低价、便捷、安全、快速</a>
                    </div>

                    <div class="recycle-container">
                        <div class="recycle-sidebar" style="height:300px;">
                            <a href="" ><img class="lazy" src="/Picture/timg.jpg" style="position: relative;top:-160px;height: 430px;"></a>
                        </div>
                        <div class="recycle-main">
                            <div class="recycle-switch J_switchBox">
                                <div id="recycleSwitch-85" class="J_tabPanel" style="display: block">
                                    <ul class="goods-top-list">
                                        @foreach($hot as $k=>$v)
                                            @if($k<=3)
                                            <li class="goods-item">
                                                <a href="http://kefu.qycn.com/vclient/chat/?websiteid=123435" class="goods-title">{{$v->gname}}</a>
                                                <div class="price-bar"><span class="price"> 二手价<em>&yen;{{$v->nowprice}}</em></span></div>
                                                <a href="" class="goods-pic"><img class="lazy" src="/uploads/{{$v->gpic}}" alt=""></a>
                                            </li>
                                            @else
                                                @break
                                            @endif
                                        @endforeach
                                    </ul>
                                    <ul class="goods-bottom-list">
                                        @foreach($hot as $k=>$v)
                                            @if($k==4 || $k==5)
                                                <li class="goods-item">
                                                    <a href="" class="goods-title">{{$v->gname}}</a>
                                                    <div class="price-bar"><span class="price"> 二手价<em>&yen;{{$v->nowprice}}</em></span></div>
                                                    <a href="" class="goods-pic"><img class="lazy" src="/uploads/{{$v->gpic}}" alt=""></a>
                                                </li>
                                            @endif
                                        @endforeach

                                        <li class="goods-item item3  ">
                                            <div class="more-link-wrap">
                                                <a href="" class="more-link">更多 GO</a>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="appraisal-box">
                    <div class="appraisal-header">
                        <a href="http://2.fengniao.com/quality" class="more-link">更多</a>
                        <h3><a href="http://2.fengniao.com/quality" >灰鹤二手</a></h3>
                        <a href="http://2.fengniao.com/quality" class="slogan">品质保障、真实描述</a>
                    </div>

                    <div class="appraisal-container">
                        <div class="appraisal-sidebar" style="height:300px;">
                            <a href="" ><img cls="lazy" src="/Picture/timg.jpg" style="position: relative;top:-245px;height: 530px;"></a>
                        </div>
                        <div class="appraisal-main">
                            <div class="appraisal-switch J_switchBox">
                                <div id="appraisalSwitch-1" class="J_tabPanel" style="display: block">
                                    <ul class="goods-top-list">
                                        @foreach($goods as $k=>$v)
                                            @if($k<=7)
                                            <li class="goods-item ">
                                                    <a href="" class="goods-title">{{$v->gname}}</a>
                                                    <div class="price-bar"><span class="price"> 灰鹤价<em>&yen;{{$v->nowprice}}</em></span></div>
                                                    <a href="" class="goods-pic"><img class="lazy" src="/uploads/{{$v->gpic}}" alt="">
                                                        <span class="sold-out"></span>
                                                    </a>
                                            </li>
                                            @else
                                                @break;
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- // appraisal-box -->            <!-- merchants-box -->

                <div class="merchants-box">
                    <div class="merchants-header clearfix">

                        <h3 class="merchants-title">大家都在看</h3>
                        {{--<a class="more-link" href="/help/detail?id=384" target="_blank">查看更多</a>--}}
                    </div>
                    <div class="merchants-content clearfix">
                        <ul class="merchants-promotions">
                            @foreach($hot as $k=>$v)
                                @if($k>=6 && $k<=9)
                            <li>
                                <a target="_blank" href="" class="pic"><img src="/uploads/{{$v->gpic}}" width="243" height="89"></a>
                            </li>
                                @endif
                            @endforeach
                        </ul>

                        <ul class="merchants-list">
                            @foreach($hot as $k=>$v)
                                @if($k>=10 && $k<=18)
                            <li>
                                <a target="_blank" href="" class="pic">
                                    <img src="/uploads/{{$v->gpic}}" width="177" height="88">
                                    {{--<img src="Picture/merchantshoverpic.png" alt="" class="hover-pic" width="177" height="87">--}}
                                </a>
                            </li>
                                @endif
                            @endforeach

                        </ul>
                    </div>
                </div>



</div>
@include('home.common.index_footer');

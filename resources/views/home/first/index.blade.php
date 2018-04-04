@include('Home.common.index_header');

<script src="/layui/layui.js"></script>
<div class="wrapper-box">
    <!-- banner-wrapper -->
    <div class="banner-wrapper">
        <div class="banner-slider-wrap" style="margin-top: -45px">
            <div class="layui-carousel" id="test1">
                  <div carousel-item>
                      @foreach($Carousel as $k=>$v)
                         <div><a href="{{$v['purl']}}"><img src="/uploads/{{$v['profile']}}"  width="1420px" alt=""></a></div>
                      @endforeach
                  </div>
</div>
<!-- 条目中可以是任意内容，如：<img src=""> -->

<script>

layui.use('carousel', function(){
  var carousel = layui.carousel;
  //建造实例
  carousel.render({
    elem: '#test1'
    ,width: '100%' //设置容器宽度
    ,height: '430px'
    ,arrow: 'always' //始终显示箭头
    //,anim: 'updown' //切换动画方式
  });
});
</script>
        </div>
        <div class="wrapper clearfix" >
            <div class="sign-box-wrap" style="margin-top: -20px;margin-right: -20px">
                <div class="sign-box" style=>
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
                        <div class="recycle-main" style="width: 1200px;">
                            <div class="recycle-switch J_switchBox">
                                <div id="recycleSwitch-85" class="J_tabPanel">
                                    <ul class="goods-top-list">
                                        @foreach($hot as $k=>$v)
                                            @if($k<=4)
                                            <li class="goods-item">
                                                <a href="" class="goods-title">{{$v->gname}}</a>
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
                                            @if($k>=5 && $k<=7)
                                                <li class="goods-item">
                                                    <a href="" class="goods-title">{{$v->gname}}</a>
                                                    <div class="price-bar"><span class="price"> 二手价<em>&yen;{{$v->nowprice}}</em></span></div>
                                                    <a href="" class="goods-pic"><img class="lazy" src="/uploads/{{$v->gpic}}" alt=""></a>
                                                </li>
                                            @endif
                                        @endforeach
                                        <li class="goods-item item3" style="width:160px;">
                                            <div class="more-link-wrap">
                                                <a href="" class="more-link" >更多 GO</a>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="appraisal-box" style="margin-top:50px;">
                    <div class="appraisal-header">
                        <a href="http://2.fengniao.com/quality" class="more-link">更多</a>
                        <h3><a href="http://2.fengniao.com/quality" >灰鹤二手</a></h3>
                        <a href="http://2.fengniao.com/quality" class="slogan">品质保障、真实描述</a>
                    </div>

                    <div class="appraisal-container">
                        <div class="appraisal-main" style="width: 1200px;">
                            <div class="appraisal-switch J_switchBox">
                                <div id="appraisalSwitch-1" class="J_tabPanel" style="display: block">
                                    <ul class="goods-top-list">
                                        @foreach($goods as $k=>$v)
                                            @if($k<=11)
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
                    <div class="merchants-header clearfix" style="margin-top:50px;">
                        <h3 class="merchants-title">大家都在看</h3>
                    </div>
                    <div class="merchants-content clearfix" style="margin-bottom:50px;">
                        <ul class="merchants-promotions">
                            @foreach($goods as $k=>$v)
                                @if($k<=3 && $v['recommend']==1)
                                <li>
                                    <a target="_blank" href="" class="pic">
                                        <div width="243" height="89">
                                        <img src="/uploads/{{$v->gpic}}">
                                        </div>
                                    </a>
                                </li>
                                @endif
                            @endforeach
                        </ul>

                        <ul class="merchants-list">
                            @foreach($goods as $k=>$v)
                                @if($k>=4 && $k<=11 && $v['recommend']==1)
                                <li>
                                    <a target="_blank" href="/home/goods/details" class="pic">
                                        <div width="177" height="88">
                                            <img src="/uploads/{{$v->gpic}}" style="height: 88px;margin: auto;">
                                        </div>
                                    </a>
                                </li>
                                @endif
                            @endforeach

                        </ul>
                    </div>
                </div>

</div>

@include('home.common.index_footer');

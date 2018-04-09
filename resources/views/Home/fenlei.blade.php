<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <title>{{ config('webconfig.web_title') }}</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <meta name="renderer" content="webkit">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <base target=_blank>
    <meta name="keywords" content="灰鹤二手">
    <meta name="description" content="灰鹤二手交易">
    <link id="narrowScreen" rel="stylesheet">
    <link href="http://m.2.fengniao.com" rel="alternate" media="only screen and (max-width: 640px)">
    <link href="/Content/jquery-ui.1.11.4.min.css" rel="stylesheet">
    <link href="/Content/jquery.bxslider.css" rel="stylesheet">
    <link href="/Content/header.css" rel="stylesheet">
    <link href="/Content/secondarytradingpublic.css" rel="stylesheet">
   <link href="/Content/homePage.css" rel="stylesheet">
    <link href="/Content/page.css" rel="stylesheet">
    <script src="/Scripts/jquery.min.js" charset="UTF-8"></script>
    <script src="/Scripts/jqueryui.1.11.4.js" charset="UTF-8"></script>
    <script src="/Scripts/jquery.tinyscrollbar.2.4.2.min.js" charset="UTF-8"></script>
    <script src="/Scripts/im.js" charset="UTF-8"></script>
    <script src="/Scripts/md5.js" charset="UTF-8"></script>
    <script src="/Scripts/global.js" charset="UTF-8"></script>
    <script src="/Scripts/swfobject.js" charset="UTF-8"></script>
    <link rel="stylesheet" id="WideGoodsSheet" rel="stylesheet">
    <link rel="stylesheet" href="/layui/css/layui.css">
    <link href="/Content/globalceiling.css" rel="stylesheet">
    
    <script>
        if (!$.support.leadingWhitespace || /msie 9/.test(navigator.userAgent.toLowerCase())) {
            document.documentElement.className += ' lowIE';
        }

        if(parseInt(window.screen.width,10) < 1025){
            document.documentElement.className += ' narrowScreen';
        }

    </script>

    <style>
        a{color:#fff;text-decoration:none;-webkit-transition-property:color;-moz-transition-property:color;-o-transition-property:color;transition-property:color;-webkit-transition-duration:.2s;-webkit-transition-timing-function:ease-in;-moz-transition-duration:.2s;-moz-transition-timing-function:ease-in;-o-transition-duration:.2s;-o-transition-timing-function:ease-in;transition-duration:.2s;transition-timing-function:ease-in}
        a:hover{color:#cd0606;text-decoration:underline;}
        .hc_lnav{z-index:9999;position:relative;width:190px;margin:40px 0 0 120px;}
        .hc_lnav .allbtn{z-index:99999;position:relative;left: -130px;top:-30px;}
        .hc_lnav .allbtn h2{font-size:14px;box-shadow:2px 0px 6px -3px #000;-webkit-box-shadow:2px 0px 6px -3px #000;-moz-box-shadow:2px 0px 6px -3px #000000;}
        .hc_lnav .allbtn h2 a{line-height:36px;background-color:#444;padding-left:10px;width:180px;display:block;height:36px;color:#ffffff;font-size:14px;font-weight:normal;}
        .hc_lnav .allbtn h2 a:hover{background-color:#444;text-decoration:none;}
        .hc_lnav .allbtn h2 b{margin-left: 60px;}
        .hc_lnav .allbtn ul{z-index:99999;position:absolute;background-color:#444;width:190px;display:none;height:486px;top:36px;left:0px}
        body.hc_home .hc_lnav .allbtn ul{display:block}
        body.hc_list .hc_lnav .allbtn ul{display:block}
        .hc_lnav .allbtn ul li{padding-bottom:7px;zoom:1;clear:both;cursor:default}
        .hc_lnav .allbtn ul li .tx{background-image:url(../images/header/header_bg1.png);line-height:35px;background-color:#444;padding-left:10px;background-repeat:no-repeat;background-position:right center;height:35px;}
        .hc_lnav .allbtn ul li .tx a{color:#fff;font-size:14px;-webkit-transition:color 0.1s ease-out 0s;-moz-transition:color 0.1s ease-out 0s;-ms-transition:color 0.1s ease-out 0s;-o-transition:color 0.1s ease-out 0s;transition:color 0.1s ease-out 0s}
        .hc_lnav .allbtn ul li .pop{border-bottom:#999999 2px solid;position:absolute;border-left:medium none;background-color:#fcfcfc;width:190px;display:none;min-height:495px;border-top:medium none;top:0px;border-right:#999999 2px solid;left:190px;box-shadow:4px 4px 5px -1px #999999;-webkit-box-shadow:4px 4px 5px -1px #999999;-moz-box-shadow:4px 4px 5px -1px #999999}
        .hc_lnav .allbtn:hover ul{display:block}
        .hc_lnav .allbtn ul li:hover{background-color:#fcfcfc}
        .hc_lnav .allbtn ul li:hover .tx{background-color:#f5f5f5}
        .hc_lnav .allbtn ul li:hover .tx a{color:#333333}
        .hc_lnav .allbtn ul li:hover .pop{display:block;top:0px;left:190px}
        .hc_lnav .allbtn ul li:hover dl{color:#6e6e6e}
        .ui-link{color:#666666;display: block;height: 50px;line-height: 50px;text-align: center;}
        .ui-link:hover{text-decoration: none;background: rgba(145, 153, 144, 0.09);}
    </style>

</head>
<script src="/Scripts/m.js" charset="UTF-8"></script>
<body>

<!-- header -->
<ul class="layui-nav" lay-filter="">
    <li class="layui-nav-item"><a href="/">灰鹤首页</a></li>
    <li class="layui-nav-item"><a href="">HI 欢迎来到灰鹤</a></li>
    @if(empty(Session('user')))
        <li class="layui-nav-item" style="float:right"><a href="/home/register">注册</a></li>
        <li class="layui-nav-item" style="float:right"><a href="/home/login">登录</a></li>
    @else
        <li class="layui-nav-item" style="float:right"><a href="/home/loginout">退出</a></li>
        <li class="layui-nav-item" style="float:right"><a href="/home/user">用户中心</a></li>
        <li class="layui-nav-item" style="float:right">
            <a href="/home/user">
                @if($userinfo['portrait'])
                    <img src="/uploads/{{$userinfo['portrait']}}" class="layui-nav-img">
                @else
                    <img src="/Picture/head80.png" class="layui-nav-img">
                @endif
                {{ $user['uname'] }}
            </a>
        </li>
    @endif
</ul>

<script>
    //注意：导航 依赖 element 模块，否则无法进行功能性操作
    layui.use('element', function(){
        var element = layui.element;
    });
</script>


<div class="header clearfix fn-sec-header">
    <div class="news-product-box">
        <a href="javascript:;" target="_blank"><img class="fn-recommend-b" src=""></a>
        <a href="javascript:;" target="_blank"><img class="fn-recommend-s" style="display: none;" src=""></a>
    </div>

    <div class="logo">
        <a href="/?click_source=logo">
            <img class="fn-shop-logo-b" src="/uploads/{{ config('webconfig.web_logo') }}" style="width: 200px;">
        </a>
    </div>


    <div class="search-box" id="searchContainer">
        <ul class="search-tab clearfix">
        </ul>
        <div class="search-bar">
            <input type="hidden" id="type" name="type" value="0">        <input class="search-button" id="searchBtn" type="button" value="搜&nbsp;索"/>
            <span class="search-txt">
            <input id="searchKwd" type="text" autocomplete="off" placeholder="请输入关键字"/>
            </span>
        </div>
        <div class="search-focus-layerbox clearfix" style="display: none;"></div>
        <div class="search-click-layerbox" style="display: none;"></div>
    </div>
</div>
<!-- homePage-nav-box -->
<div class="homePage-nav-box">
    <div class="wrapper clearfix">
        <a href="{{url('/home/release/create')}}" target="_blank" class="publish-button"><img src="/Picture/publishbutton-pic.png"></a>

        <div class="hc_lnav jslist" style="float: left;">
            <div class="allbtn">
                <h2>
                    <a href="#" style="position:absolute;z-index:2;"><b>商品分类</b></a>
                </h2>
                <ul style="width:190px" class="jspop box" >
                    @foreach($cates as $v)
                        <li class='a1'>
                            <div class='tx' name="{{$v->cid}}">
                                <a name="yiji" cid="{{ $v->cid }}"  target="_self">{{$v->cname}}</a>
                            </div>
                            <div class='pop'>
                                @foreach($v->sub as $vv)
                                    <a class="ui-link" name="erji" cid="{{ $vv->cid }}"  target="_self" >{{$vv->cname}}</a>
                                @endforeach
                                <div class='clr'></div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <script>
            //一级分类
            $('a[name=yiji]').each(function(){

                var cid = $(this).attr('cid');

                $(this).click(function(){
                   
                    $(this).attr('href','/home/goods/index?cid='+cid);
                })
            })
            //二级分类
            $('a[name=erji]').each(function(){

                var cid = $(this).attr('cid');

                $(this).click(function(){
                    $(this).attr('href','/home/goods/index?cid='+cid);
                })
            })
        </script>

        <div class="nav-link">
            <i class="bottom-line"></i>
            <a href="/" class="current-link">首页</a>
            <a href="/" class="current-link">灰鹤二手</a>
        </div>
    </div>
</div>

<!-- //homePage-nav-box -->


<!-- //homePage-nav-box -->




    <link href="/Content/list-v2.css" rel="stylesheet" 0="frontend\assets\BaseAsset">



<!-- //homePage-nav-box -->

<!-- //header -->
    <script>
    var goodsIdArr = ["3266418","3266413","3264483","3266561","3265072","3265735","3266034","3266092","3266088","3265547","3263792","3266723","3262649","3266595","3266580","3266396","3266294","3263253","3266024"];
    var usersIdArr = [10337863,10780799,86746,5904825,7363665,94076,245983,10811352,10386542,10773434,8448744,10286925,8527630,614768,10810151];
    var urlParam   = {"cateId":114,"subcateId":1050,"manuId":0,"productId":0,"type":"price","typeId":0,"quality":0,"maxQuality":0,"minPrice":0,"maxPrice":0,"keyword":"","notKwd":"","tagIds":[],"userid":false,"username":"","provinceId":0,"cityId":0,"style":1,"order":"def","page":1,"position":0};
</script>

<div class="wrapper-box">
    <!-- 手工推广位置 -->
    

    
    <!-- 面包屑 -->
    
<div class="wrapper location" id="listCrumbs">
    
    
                        
                    
    </div>

    <!-- 筛选 -->
    
<form type="price" id="listFilterForm" action="/home/goods/index" method="get">
<input type="hidden" name="pos" value="1"><ul class="wrapper filter-classification-box" id="listFilter">
                    
                        
    <li class="filter-item clearfix">
        <span class="item-title">更多：</span>
        <div class="filter-bar" style="margin:auto">
            <!-- <span class="filter-tag"><em>¥</em><input type="text" class="price" name="tp" placeholder="最低价" value="" maxlength="6"></span>
            <span class="filter-tag"><em>¥</em><input type="text" class="price" name="bp" placeholder="最高价" value="" maxlength="6"></span> -->
            <!-- <span class="filter-tag"><em>当前</em><input type="text" name="k" data-name="k" value="" placeholder="结果搜索"></span> -->
            <!-- <span class="filter-tag"><em>排除</em><input type="text" name="nk" data-name="nk" value="" placeholder="关键字"></span> -->
            <span class="filter-tag"><input type="text" class="seller-name" name="gname" data-name="u" value="" placeholder="卖家名称/店铺名称"></span>
            <input type="submit" class="search-button" value='筛选'></div>

    </li>
</ul>
    <script>

    </script>
<div class="wrapper search-result">
    <div class="result-count">
        小鹤已为您找到感兴趣器材
    </div>
</div>
<!-- filter-price-box -->

</form>

    <div class="wrapper clearfix">

        <div class="main" style="position:absolute;z-index:1;" >
                        
            <!-- 列表 -->
@foreach($goods as $v)
<ul class="goods-list">
    
    
            
    <li class="goods-item clearfix">
        <div class="cell-1">
            <a href="/home/goods/details?rid={{ $v->rid }}" target="_blank" class="goods-pic"><img src="/uploads/{{ $v->gpic }}" alt="" title=""></a>
        </div>
        <div class="cell-2" >
            <a class="goods-title"  name="choosegoods" rid="{{ $v->rid }}" target="_blank">{{ $v->gname }}

                                        </a>
            <div class="tags clearfix">
                &nbsp;{{ $v->describe }}
            </div>

                        
            <div class="user-box clearfix">
                <span class="city">{{ $v->raddr }}</span>
                <div class="user-bar" data-role="ser-info" data-id="10337863"></div>
            </div>
        </div>
        <div class="cell-3">
            <span class="quality-tag" style="width:150px;">{{ $v->title }}</span>
        </div>
        <div class="cell-4">
                    <div class="price-bar">
                <span class="price-tag">
                    <em class="unit">¥</em>
                                        <em class="price">{{ $v->nowprice }}</em>
                    <em class="decimal-point">.00</em>
                                    </span>
            </div>
                </div>
        <div class="cell-5">
            <div class="links">
                <a  target="_blank" class="link" rel="nofollow">浏览 {{ $v->PV }} 次</a>
                <a  target="_blank" class="link" rel="nofollow">优质良品</a>
                <p style='margin:10px auto;'>发布于 {{ $v->created_at }}</p>
            </div>
        </div>
    </li>
    
            

    
            <!--<li class="goods-item clearfix">
            <div class="extension-bit-list">
                                    <a href="http://2.fengniao.com/auction" target="_blank" class="item1"><img src="/Picture/cg-77vjc63oidtaiaabmctpmfqwaaflrwealkkaagyi471.jpg" alt="" title=""></a>
                                    <a href="http://2.fengniao.com/recycle" target="_blank" class="item2"><img src="/Picture/cg-40ljc62miyoakaabfb4zfsmeaafm1qi8trsaaf8f731.jpg" alt="" title=""></a>
                                    <a href="http://2.fengniao.com/quality" target="_blank" class="item3"><img src="/Picture/cg-4kljc61wiuboqaabqvdmnybmaaihiggdiaiaagru154.jpg" alt="" title=""></a>
                            </div>
        </li> -->
            

    </ul>
          @endforeach

          <center>{{ $goods->links() }}</center>

          <script>
              $('a[name=choosegoods]').each(function(){

                var rid = $(this).attr('rid');
                $(this).click(function(){

                    $(this).attr('href','/home/goods/details?rid='+rid);

                })
              })
          </script>
            


        </div>

        <div class="aside">
                                                            <a href="http://2.fengniao.com/auction" target="_blank" class="aside-ad-div"><img src="/Picture/cg-77vjc5y6ieaxdaac0rrlwzjwaadfcwnshjsaalre928.jpg" alt=""></a>
                                   
                            
            <div class="hot-auction-section">
                <div class="section-header clearfix">
                    <a href="/auction" target="_blank" class="more-link">去抢拍</a>
                    <h3 class="section-title">热门拍卖</h3>
                </div>

                <ul class="auction-list hot-auction-list clearfix"></ul>
            </div>
                    </div>
    </div>
    <div class="wrapper wechat-code">
        没找到合适的器材？关注 <i>小鹤</i> ，订阅您想要的器材，有合适的器材随时推送给您，省时、省心、更省力哦。
        <div id="wechatLayerBox" class="wechat-layer-box">
            <span class="trigger">点我扫一扫订阅</span>
            <div class="wechat-layer">
                <span class="pic"><img id="qrcode" src="" alt=""></span>
            </div>
        </div>
    </div>
    <div class="wrapper appraisal-section" style="position:relative;margin-top:370px;">
        <div class="section-header clearfix">
            <a href="/quality" target="_blank" class="more-link">更多好货</a>
            <h3 class="section-title">大家都在看 </h3>
            <span class="slogan">灰鹤鉴定好器材<a href="/quality" target="_blank"> (什么是灰鹤鉴定？去了解)</a></span>
        </div>
        <ul class="appraisal-list clearfix" >
        @foreach($recommend as $k=>$v)
        @if($k<=3)
        <li class="goods-item" style='float:left;margin:1px;'>
                                                <a href="" class="goods-title">{{$v->gname}}</a>
                                                <div class="price-bar"><span class="price"> 二手价<em>&yen;{{$v->nowprice}}</em></span></div>
                                                <a href="/home/goods/details?rid={{ $v->rid }}" class="goods-pic"><img class="lazy" src="/uploads/{{$v->gpic}}" alt="" width='300' height="300"></a>
                                           </li>
        @endif 
        @endforeach
        </ul>
    </div>
</div>

<div id="errorTipDialog" style="display: none;text-align: center;padding-top:15px;">
    <p>加载中...</p>
</div>
<!-- promote-footer -->
<!-- //promote-footer --><!-- foot -->

<!-- footer-box -->

 @include ('home.common.index_footer')
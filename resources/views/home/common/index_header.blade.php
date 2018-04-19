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
    {{--<link href="/Content/globalceiling.css" rel="stylesheet">--}}
    <link href="/Content/jquery-ui.1.11.4.min.css" rel="stylesheet">
    <link href="/Content/jquery.bxslider.css" rel="stylesheet">
    <link href="/Content/header.css" rel="stylesheet">
    <link href="/Content/secondarytradingpublic.css" rel="stylesheet">
    <link href="/Content/homepage.css" rel="stylesheet">
    <script src="/Scripts/jquery.min.js" charset="UTF-8"></script>
    {{--<script src="/Scripts/jquery-3.2.1.min.js" charset="UTF-8"></script>--}}
    <script src="/Scripts/jqueryui.1.11.4.js" charset="UTF-8"></script>
    <script src="/Scripts/jquery.tinyscrollbar.2.4.2.min.js" charset="UTF-8"></script>
    <script src="/Scripts/im.js" charset="UTF-8"></script>
    <script src="/Scripts/md5.js" charset="UTF-8"></script>
    <script src="/Scripts/global.js" charset="UTF-8"></script>
    <script src="/Scripts/swfobject.js" charset="UTF-8"></script>
    <script src="/layui/layui.js" charset="UTF-8"></script>
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
        <form action="/home/goods/index" method="get">
            <div class="search-bar">
                <input type="hidden" id="type" name="type" value="0">        <input class="search-button" id="searchBtn" type="submit" value="搜&nbsp;索"/>
                <span class="search-txt">
                <input id="searchKwd" type="text" autocomplete="off" name="gname" placeholder="请输入关键字"/>
                </span>
            </div>
        </form>
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
                    <a href="#"><b>商品分类</b></a>
                </h2>
                <ul style="width:190px" class="jspop box">
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
            <a href="/home/goods/index" class="current-link">灰鹤二手</a>
        </div>
    </div>
</div>

<!-- //homePage-nav-box -->

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
    <script src="/Scripts/jquery-3.2.1.min.js" charset="UTF-8"></script>
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
            <a href="/" class="current-link">灰鹤二手</a>
        </div>
    </div>
</div>

<!-- //homePage-nav-box -->


    <link href="/Content/jcarousel.connected-carousels.css" rel="stylesheet" 0="frontend\assets\BaseAsset">
<link href="/Content/secondarytradingdetail.css" rel="stylesheet" 0="frontend\assets\BaseAsset">


<!-- //header -->
    

<div class="wrapper detail-box" >
    <div class="detail-price clearfix" style="padding:0px 100px">
        <div class="product-summary">
            <div id="productGallery" class="connected-carousels product-gallery">
    <span id="productGalleryBack" class="goback">&lt; 返回</span>
    <div class="stage">
                <div class="carousel carousel-stage">
            <ul>
                            <li>
                    @if(empty($goods['gpic']))
                    <img src="/Picture/default.png">
                    @endif
                    <img src="/uploads/{{ $goods['gpic'] }}">
                    
                </li>
                        </ul>
        </div>
        <span class="count-bar" style="display: none"><i>1</i>/<em>0</em></span>
        <a href="javascript:;" class="prev prev-stage"><span>&lsaquo;</span></a>
        <a href="javascript:;" class="next next-stage"><span>&rsaquo;</span></a>
    </div>
    <div class="navigation">
        <a href="javascript:;" class="prev prev-navigation"><i class="icon">&lsaquo;</i></a>
        <a href="javascript:;" class="next next-navigation"><i class="icon">&rsaquo;</i></a>
        <div class="carousel carousel-navigation">
            <ul>
                            <li>
                    <img src="/uploads/{{ $goods['gpic'] }}">
                    <span class="mask"></span>
                </li>
                        </ul>
        </div>
    </div>
</div>
<div class="product-toolbar clearfix">
    <div id="collectionLink" class="collection-link">
        <span name="shou">
        @if($collect->count() == 0) 
            收藏宝贝
         @else
            已收藏宝贝
        
        @endif
        </span>
    </div>


    <script>


        $('span[name=shou]').click(function(){
            

                     
           if(!{{  $flag }}){
               
            
                window.location.href ='/home/login';
               
            } else {
                $(this).html('已收藏宝贝');
            };


            $.get('/home/goods/aaaaa',{rid:{{ $goods['rid'] }}},function(d){
                
        
            })

            });
        
  
    </script>
    <!-- share-box -->
    <div class="share-box  J_shareBox" id="shareBtn">
       {{-- <a class="share-header">分享<i></i></a>--}}
        <div class="share-links">
            <ul class="bdsharebuttonbox line-items bdshare-button-style0-16" data-bd-bind="1499677167628">
                <li class="msweixin">
                    <a href="#" class="bds_weixin" data-cmd="weixin" title="分享到微信">微信</a>
                </li>
                <li class="msSina">
                    <a href="#" class="bds_tsina" data-cmd="tsina" title="分享到新浪微博">新浪微博</a>
                </li>
                <li class="msQzone">
                    <a href="#" class="bds_qzone" data-cmd="qzone" title="分享到QQ空间">QQ空间</a>
                </li>
            </ul>
            <script>
                window._bd_share_config={
                    "common":{
                        "bdSnsKey":{},
                        "bdText":"我在@灰鹤二手交易平台 发现了一个非常不错的商品： （闲置商品测试 中一光学Mitakon 35mm F0.95 Mark II）　灰鹤价：94545.00 感觉特别好，分享一下~",
                        "bdMini":"1",
                        "bdMiniList":false,
                        "bdPic":"http://2.qn.img-space.com/g2/M00/06/56/Cg-4kllB_RiIFb_lAAwUeFikDwkAAJ1OQKROqoADBSQ119.jpg?imageView2/2/w/300/h/300/q/90/ignore-error/1/",
                        "bdStyle":"0",
                        "bdSize":"16"
                    },
                    "share":{}
                };
               /* with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];*/
            </script>
        </div>
    </div>
    <!-- //share-box -->
</div>

            <div id='d1' class="product-tabs J_productTab">
    <ul class="tab-nav clearfix">
        <li id='d2' class="J_item current-item" rel="describe">
            <span name='miaoshu'>描述</span>
        </li>
        <li class="J_item" rel="message" id='d3'>
            <span name='liuyan'> 给TA留言</span>
        </li>
    </ul>
    <div class="describe-wrap" id='d4'>
        <div class="section other-description-section">
    <div class="description-text"><pre style="word-break: break-all;word-wrap:break-word;white-space:normal ;">
        {{ $goods['describe'] }}
<br /><br /><br /><br /><br /></pre></div>
</div>    </div>
<!-- 给他留言 -->
    <div class='message-wrap'>
        <div class="section message-section" id="message-section"><div class="section-header">
    <h3 class="section-title">留言咨询</h3>
</div>
<!-- message-post -->
<div class="message-post clearfix">
    <div class="clearfix">
        <a href="javascript:;" class="avtor">
            @if(empty($musers['portrait']))  
            <img src="/Picture/head80.png" width="60" height="60" alt="">
            @else
            <img src="/uploads/{{ $musers['portrait'] }}" width="60" height="60" alt="">
            @endif

            <span class="name">{{ $musers['nickname'] }}</span>
        </a>

        <input type="hidden" id="csrf" name="_csrf" value="Zy1RUnl1bDUjYisjOkUjehBcA38eAxsGMhQABgE6JmVWaAcmE0EeWQ==">        <textarea  name="liuliuyan" placeholder="我来说两句" id="question_content" class="post-text"></textarea>
    </div>
    <div class="post-button">
        <span name="pinglun" class="comment-button">评论</span>
        
    </div>

<!-- 提交留言 -->
<script>
    $('textarea[name=liuliuyan]').focus(function(){
      

           if(!{{  $flag }}){
            
                window.location.href ='/home/login';
               
            } 
    })
    $('span[name=pinglun]').click(function(){
        var umessage = $('textarea').val();
        $.get('/home/goods/bbbbb',{umessage:umessage,rid:{{ $goods['rid'] }}},function(d){
               console.log(d);
            })

        setTimeout(location.reload(),1000);

        /*$('textarea').val('');*/
    })
</script>
</div>
<!-- //message-post -->

@foreach($liu as $k=>$v)
<ul class="comment-list">
    <li class='comment-item clearfix' id='qa_14311'>
    <a href="/10820479/credit.html" class='avator'>
        @if(empty($v['portrait']))
         <img src="/Picture/default.png" width="60" height="60" alt="">
        @else
        <img src="/uploads/{{ $v['portrait'] }}" width='60' height='40' alt="">
        @endif
    </a>
        <div class='item-content'> 
            <div class='comment-text clearfix'>
                @if(empty($v['nickname']))
                <a href="/10820479/credit.html" class='name'>暂无昵称</a><span class='text'> {{ $v['umessage'] }}</span>
                @else
                <a href="/10820479/credit.html" class='name'>{{ $v['nickname'] }}: </a><span class='text'> {{ $v['umessage'] }}</span>
                @endif
            </div>
                <div class='comment-toolbar clearfix'>
                    <span id='huifu' class='reply-link' num="{{ $k }}">回复</span>
                    
                    <span id='shanchu' wid="{{ $v['wid'] }}" class='delete-link'>删除</span>
                    
                    <span class='date'>{{ $v['created_at'] }}</span>
                    <div style='display:none' class="reply-box ccc{{ $k }}" id='reply_14674' >
                        <i class='arrow-icon'></i>
                        <textarea name='neirong' id="reply_content_14674" placeholder='请填写您的回复内容'></textarea>
                        <span class='comment-button' wid="{{ $v['wid'] }}" >评论</span>
                    </div>
                    
                </div>
        </div>

    </li>
     
    @if($v->children)
    @foreach($v->children as $v2)
    <ul class="comment-list">
    <li class='comment-item clearfix' id='qa_14311'>
        <a href="/10820479/credit.html" class='avator'>
            @if(empty($v2['portrait']))
             <img src="/Picture/default.png" width="60" height="60" alt="">
            @else
            <img src="/uploads/{{ $v['portrait'] }}" width='60' height='40' alt="">
            @endif
        </a>
        <div class='item-content'> 
            <div class='comment-text clearfix'>
                @if(empty($v2['nickname']))
                <a href="/10820479/credit.html" class='name'>暂无昵称</a><span class='text'> {{ $v['umessage'] }}</span>
                @else
                <a href="/10820479/credit.html" class='name'>回复:{{ $v2['nickname'] }}: </a><span class='text'> {{ $v2['umessage'] }}</span>
                @endif
            </div>
            <div class='comment-toolbar clearfix'>
               
                
                <span id='shanchu' class='delete-link' wid="{{ $v2['wid'] }}">删除</span>
                
                <span class='date'>{{ $v2['created_at'] }}</span>
                
            </div>
        </div>

    </li>
    </ul>
    @endforeach
    @endif

    
    
 </ul>  
@endforeach


    <script>
        // 回复留言
        var k = 0;
        $('.reply-link').each(function(){
             k=$(this).attr('num');
            $(this).click(function(){
               
            $(".ccc"+k).css('display','block');
        })
        })
        $('.comment-button').each(function(){

            var wid = $(this).attr('wid');
            $(this).click(function(){
            var text = $('textarea[name=neirong]').eq(k).val();

            
            $.get('/home/goods/ccccc',{text:text,pid:wid,rid:{{ $goods['rid'] }} },function(d){
                console.log(d);
           })

             setTimeout(location.reload(),1000);
        })
        })
        //删除留言
        $('.delete-link').each(function(){

            var wid = $(this).attr('wid');
            $(this).click(function(){

                console.log(wid);


             $.get('/home/goods/ddddd',{wid:wid},function(d){

                console.log(d);
                
            })



             setTimeout(location.reload(),1000);
        })

    })
    </script>






 <!-- <script type="text/javascript">
             var userId = 0 ;
             $('.message-post .comment-button').click(function () {
                 if (!userId) {
                     return quickLogin();
                 }
                 var question_content = $('#question_content').val(),
                     csrf = $('#csrf').val();
                 if (mb_strlen(question_content) >= 140 * 3) {
                     return jsError('不能超过140个字');
                 }
                 if (!question_content) {
                     return jsError('请输入评论内容');
                 }
                 $.ajax({
                     url: '/ajax/qa-add',
                     type: "post",
                     data: {'_csrf': csrf, 'goods_id': goods_id, 'message': question_content},
                     success: function (json) {
                         if (json.code == 1) {
                             _initPage('qa');
                         } else {
                             return jsError(json.msg);
                         }
                     }
                 });
             })
             function show_reply(id) {
                 $('#reply_' + id).toggle();
                 $('#reply_content_' + id).focus();
             }
             function qa_reply(id) {
                 var reply_content = $('#reply_content_' + id).val();
                 if (mb_strlen(reply_content) >= 140 * 3) {
                     return jsError('不能超过140个字');
                 }
                 var csrf = $('#csrf').val();
                 if (!reply_content) {
                     return jsError('请输入回复内容');
                 }
                 $.ajax({
                     url: '/ajax/qa-reply',
                     dataType: 'json',
                     type: "post",
                     data: {'_csrf': csrf, 'goods_id': goods_id, 'id': id, 'message': reply_content},
                     success: function (json) {
                         if(json.code==1){
                             _initPage('qa');
                         }else {
                             return jsError(json.msg);
                         }
                     }
                 });
             }
         
             function qa_dlt(id) {
                 var csrf = $('#csrf').val();
                 $.ajax({
                     url: '/ajax/qa-drop',
                     dataType: 'json',
                     type: "post",
                     data: {'_csrf': csrf, 'rnd':Math.random(),'goods_id': goods_id, 'id': id},
                     success: function () {
                         _initPage('qa');
                     }
                 });
             }
             // 二维码消息打通-PC-V2.5
             ;(function () {
                 $("#wechatQa").dialog({
                     autoOpen: false,
                     modal: true,
                     width: 600,
                     buttons: {}
                 });
         
                 $("#showWechatLayer").click(function () {
                     var scene_id = 11;
                     $.ajax({
                         dataType: 'json',
                         url: '/ajax/we-chat-qrcode',
                         data: {"scene_id":scene_id},
                         success: function (data) {
                             if (data.code == 1) {
                                 $("#qrcodeqa").attr("src",data.item);
                             }
                         }
                     });
                     $("#wechatQa").dialog("open");
         
                 });
             })();
         </script>  --> 
</div>
        
    </div>
<!--  留言 -->
<script>
    $('span[name=liuyan]').click(function(){

        $('#d1').attr('class','product-tabs J_productTab describeHidden');
        $('#d2').attr('class','J_item');
        $('#d3').attr('class','J_item current-item');
        $('#d4').css('display','none');
    })

    $('span[name=miaoshu]').click(function(){

        $('#d1').attr('class','product-tabs J_productTab');
        $('#d2').attr('class','J_item current-item');
        $('#d3').attr('class','J_item ');
        $('#d4').css('display','block');
    })


</script>
    <div class="message-wrap">
        <!-- message -->
        <div class="section message-section" id="message-section">
    
</div>        <!-- //message -->
    </div>
</div>
                    </div>
        <!-- product-disucuss -->
       <div class="product-disucuss-wrap">
            <div class="product-disucuss">
                <div class="summary-box clearfix">
    <div class="user-box clearfix">
        <a href="javascript:;" target="_blank" class="avtor"><img
                src="/uploads/{{ $users['portrait'] }}" width="40" height="40" alt=""></a>
        <ul class="user-infor">
            <li class="clearfix">
                {{ $users['nickname'] }}<img src="/Picture/redheart.png" alt="卖家信用" title="卖家信用">            </li>
            <li>
                已加入灰鹤 <em>{{ $f }}</em> 天，卖出商品 <em>0 </em> 件
            </li>
        </ul>
        
        <ul class="certification-list clearfix">
            <li class="identity-parameters ">未实名认证</li>
            <li class="mobile-parameters certified">手机认证</li>
            <li class="sesame-credit-parameters ">未芝麻授权</li>
        </ul>
    </div>
</div>
<div id="sesameCreditDialog"  style="display: none;">
    <div class="sesame-credit-certified">
        您需要完成芝麻信用授权，才能查看ta的芝麻评分，相互信任交易，才能更放心。
    </div>
</div>

<div id="sesameCreditShowDialog" style="display: none;">
    <div id="container" class="sesame-credit-container">
        <div id="sesameBoard" class="sesame-board" >
            <canvas id="clock" class="sesame-clock" width="340" height="340"></canvas>
            <canvas id="pointer" class="sesame-pointer" width="340" height="340"></canvas>
        </div>
        <div id="lowSesameBoard" class="low-sesame-board">
            <span class="credit-tag">信用度</span>
            <span class="fraction-tag"></span>
            <div class="grade-tag"></div>
        </div>
        <p>芝麻评分综合考虑了用户的信用历史、行为偏好、履行能力、身份特质、人脉关系五个维度信息，范围从350到950，分值越高则代表信用越好，越可靠。</p>
    </div>
</div>
                <!-- follow-box -->
                <div class="follow-box">
                    <div class="product-title-box">
       <h1 class="product-title">
                            {{ $goods['gname'] }}      </h1>
             <div class="report-box" id="reportBox">
            <div class="report-links">
                                    <span data-id="1" class="link">电话虚假</span>
                                    <span data-id="2" class="link">卖家是骗子</span>
                                    <span data-id="3" class="link">涉黄违法</span>
                                    <span data-id="4" class="link">商品信息不一致</span>
                            </div>
            <span class="report-layer"><i class="warning-icon">提示</i>举报成功</span>
        </div>
            {{--<div class="clearfix">
                          <h4 class="short-title"><a href="/price/115-1057-3542-404802-0-0-def-1_1.html" target="_blank">Hasselblad 500 C/M</a></h4>
                                       <a href="/price/115-1057-3542-404802-0-0-def-1_1.html" target="_blank" class="more-link" rel="nofollow">更多此机型 <em>&gt;&gt;</em></a>
                     </div>--}}
</div>                    <!-- product-parameter -->
                    <div class="product-parameter">
                        
<div class="top-parameter-item top-parameter-activity">
            <div class="parameter-item clearfix">
        <span class="parameter-title">商品价</span>
        <span class="parameter-price">&yen; <strong>{{ $goods['nowprice'] }}.00</strong></span>                                    <div class="view-num">已被浏览 <br><strong>{{ $goods['PV'] }}</strong> 次</div>
        <div class="comment-num">累计留言 <br> <strong>{{ $count }}</strong> 条</div>
    </div>
            </div>                        <div id='dvs' class="parameter-item  quality-parameter-item   clearfix">
    <span class="parameter-title">成色</span>
    <div class="parameter-text  parameter-quality quality-tag">
      {{ $goods['title'] }}       



        <div class="tiplayer">
            <p><strong>成色说明</strong> 是指外观有磨损划痕或掉漆，明显的使用痕迹，但功能正常完好的货品。</p>
            <i  class="arrow-icon"></i>
        </div>
    </div>

</div>
                        
                        <div class="parameter-item parameter-city clearfix">
    <span class="parameter-title">城市</span>
<span class="parameter-text">
    {{ $goods['raddr'] }}</span>
</div>
                        <div class="parameter-item parameter-contact clearfix starting" >
    <span class="parameter-title">联系方式</span>
    <!-- <span  goods_id="3266810"  data-url="/secforum/3266810.html" data-title="Hasselblad 500 C/M    +    CF80" userId="10821229" class="tag message-tag sendPrivateLetterBtn">
        <i class="message-icon "></i>与TA对话
    </span> -->
   
                            {{ $goods['rphone'] }}
</div>
                            <div title=""   class="parameter-item parameter-buy clearfix"><a style='text-decoration:none;' goods_id="3266810"  subid="3266810_0"   id="buy-button"  class="buy-button ">立即购买</a></div>
                                                </div>
                                                <script>
                                                    $('#buy-button').click(function(){

                                                        if(!{{  $flag }}){
                                                        
            
                                                                window.location.href ='/home/login';
               
                                                            }else{
                                                                $(this).attr('href','/home/goods/buy/{{ $goods['rid'] }}');
                                                            } 
                                                        })
                                                </script>
                    <!-- //product-parameter -->
                    <div class="saleout-tip" style="display: none">
    <strong>对不起，此商品已下架。</strong>
    <p>下架存在以下的可能：<br>1.商品已售出  2.商品被卖家下架  3.商品审核中</p>
</div>
                    <div class="warning-tip"><i class="warning-icon">警告</i>灰鹤提示您：请不要接收可疑文件或点击不明链接，交易中推荐使用灰鹤私信。若产生投诉举报，您提交的聊天记录将成为有力证据。</div>
                                    </div>
            </div>
        <!-- //follow-box -->
<!--         <script>
    $('.buy-button').click(function(){
       


    })
</script> -->
        
<div class="recommend-pic">
    <div>
        <img src="/Picture/aside-safetyguide.png"/>
    </div>
</div>
<div class="ad-stores clearfix">
    <span class="tag">推广</span>
    <a target="_blank" href="javascript:;">灰鹤租赁-低价、便捷、高效</a>
    <a target="_blank" href="javascript:;">高价回收-旧器材快速变现</a>
</div>        <!-- //product-disucuss -->
       </div>
    </div>
</div>
<div id="mobileDialog" class="mobile-dialog" title="安全信息设置" style="display: none;">
    <div id="followUserDialog" class="follow-layerbox" style="display: none;">
    <h3>收藏成功！</h3>
    <p>您可以在 <a href="/user/index">个人中心</a><i>></i><a
            href="/user/collect?type=9">我的收藏</a>中查看该卖家。</p>
</div>

<div id="followGoodsDialog" class="follow-layerbox" style="display: none;">
    <h3>收藏成功！</h3>
    <p>您可以在 <a href="/user/index">个人中心</a><i>></i><a
            href="/user/collect?type=0">我的收藏</a>中查看该商品。</p>
</div>
<div id="errorTipDialog" class="errorTip-layerbox" style="display: none;">
    <p>加载中...</p>
</div>

    <div id="showMobileDialog" class="show-wechat-layerbox" style="display: none;">
    <div class="wechat-dialog-inner">
        <h3 class="dialog-title">微信<i></i> 扫描二维码，立刻联系卖家</h3>
        <br>
        <div class="pic-box clearfix">
            <span class="pic"><img id="qrcode" src="" alt=""></span>
            <ul class="text-list">
                <li>1、扫描二维码</li>
                <li>2、关注“灰鹤二手”公众号</li>
                <li>3、快速拨打联系人电话</li>
            </ul>
        </div>
    </div>
</div>
    <!-- bidPriceDialog -->
    <div id="bidPriceDialog" class="bid-layerbox" title="选择您要出价的器材" style="display: none;"></div>
    <!-- //bidPriceDialog -->

    <!-- confirmGoodsDialog -->
    <div id="confirmGoodsDialog" class="confirm-goods-layerbox" style="display: none;"></div>
    <!-- //confirmGoodsDialog -->
    <div id="bidSuccessDialog" class="bid-status-layerbox" style="display: none;">
        <h3><i class="status-icon success-icon">成功</i>出价成功！</h3>
        <p>您可以在 <a href="/user/index">个人中心</a><i>></i><a href="/user/buyerOffer">我的出价</a>中查看卖家反馈</p>
    </div>


    <div id="bidFailureDialog" class="bid-status-layerbox" style="display: none;">
        <h3><i class="status-icon failure-icon">失败</i>出价失败！</h3>
        <p>当前价格已高于您的出价，请返回重试。</p>
    </div>
    <div class="setting-box" id="step1">
        <form id="step1Form" method="get" action="">
            <ul class="settingSteps clearfix">
                <li class="current">1.手机绑定</li>
                <li>2.设置交易密码</li>
                <li>3.完成</li>
            </ul>
            <div class="setting-form">
                <div class="form-group clearfix  required">
                    <label for="tel" class="control-label">请输入您的手机号：</label>
                    <div class="input-wrap">
                        <input type="text" maxlength="11" value="" name="phone_mob"
                               class="form-control" id="phone_mob" placeholder="请输入您的手机号">
                    </div>
                    <p class="help-block help-block-error" id="ajax_error"></p>
                </div>
                <div class="buttons">
                    <button id="yzm" class="send-button" type="button">获取手机验证码</button>
                    <input type="text" id="auth_code" placeholder="输入手机验证码">
                </div>
            </div>
            <input type="button" class="next-button" id="auth_code_btn"
                   value="下一步">
        </form>
    </div>


    <div class="setting-box" id="step2" style="display: none;">
        <form id="step2Form" method="get" action="">
            <ul class="settingSteps clearfix">
                <li class="current">1.手机绑定</li>
                <li class="current">2.设置交易密码</li>
                <li>3.完成</li>
            </ul>
            <div class="setting-form">

                <div class="form-group clearfix  required">
                    <label for="tel" class="control-label">请设置交易密码：</label>
                    <div class="input-wrap">
                        <input type="password" value="" name="passwd1"
                               class="form-control" id="passwd1" placeholder="">
                    </div>
                    <p class="help-block" id="step2error">由字母加数字或符号至少两种以上字符组成的6-20位半角字符，区分大小写</p>
                </div>
                <div class="form-group clearfix  required">
                    <label for="tel" class="control-label">再次确认交易密码：</label>
                    <div class="input-wrap">
                        <input type="password" value="" name="passwd2"
                               class="form-control" id="passwd2" placeholder="">
                    </div>
                </div>

            </div>
            <input type="button" class="next-button" value="提交完成">
        </form>
    </div>

    <div class="setting-box" id="step3" style="display: none;">
        <ul class="settingSteps clearfix">
            <li class="current">1.手机绑定</li>
            <li class="current">2.设置交易密码</li>
            <li class="current">3.完成</li>
        </ul>
        <div class="success-box">
            <span class="success-icon"><i></i></span>设置完成
        </div>
    </div>
</div>

<div id="common_ajax_error" class="delete-pic-layer" title="错误提示"
     style="display: none;">
    <div class="layer-/Content">
        <p></p>
    </div>
</div><!-- //detail-box -->
{{--<script type="text/javascript">
    //初始化数据
    var goods_id  = 3266810,
        seller_id  = 10821229,
        user_index_url="/user/index",
        user_buyer_offer_url="/user/buyerOffer?type=9",
        quality_arr = '{"100":{"quality_id":"1","title":"\u5168\u65b0","num":"100","desc":"\u662f\u6307\u672a\u5f00\u5c01\u4f7f\u7528\u8fc7\u7684\u65b0\u54c1\u3002","add_time":"0"},"99":{"quality_id":"2","title":"99\u65b0","num":"99","desc":"\u662f\u6307\u4ec5\u5f00\u5c01\uff0c\u4f46\u672a\u4f7f\u7528\u6216\u4ec5\u4ec5\u7ecf\u8fc7\u8bd5\u7528\uff0c\u5916\u89c2\u65e0\u4efb\u4f55\u4f7f\u7528\u75d5\u8ff9\u7684\u8d27\u54c1\u3002","add_time":"0"},"98":{"quality_id":"3","title":"98\u65b0","num":"98","desc":"\u662f\u6307\u4f7f\u7528\u6b21\u6570\u5f88\u5c11\uff0c\u5916\u89c2\u9664\u5361\u53e3\u3001\u89e6\u70b9\u7b49\u7279\u6b8a\u4f4d\u7f6e\u5916\uff0c\u5176\u4ed6\u4e3b\u4f53\u90e8\u5206\u65e0\u4efb\u4f55\u4f7f\u7528\u75d5\u8ff9\u7684\u8d27\u54c1\u3002","add_time":"0"},"95":{"quality_id":"4","title":"95\u65b0","num":"95","desc":"\u6307\u4f7f\u7528\u8fc7\uff0c\u4f46\u6210\u8272\u5f88\u65b0\uff0c\u5916\u89c2\u65e0\u6389\u6f06\u5212\u75d5\uff0c\u4ec5\u4ec5\u5141\u8bb8\u6709\u8f7b\u5fae\u4f7f\u7528\u75d5\u8ff9\uff08\u5982\u8f7b\u5fae\u6cb9\u5149\uff09\u7684\u8d27\u54c1\u3002","add_time":"0"},"90":{"quality_id":"5","title":"90\u65b0","num":"90","desc":"\u662f\u6307\u5916\u8868\u6709\u5c11\u8bb8\u4f7f\u7528\u75d5\u8ff9\uff08\u5212\u75d5\u6216\u6cb9\u5149\uff09\uff0c\u4f46\u65e0\u78d5\u78b0\u6389\u6f06\u4e14\u529f\u80fd\u6b63\u5e38\u5b8c\u597d\u7684\u8d27\u54c1\u3002","add_time":"0"},"80":{"quality_id":"6","title":"80\u65b0\u53ca\u4ee5\u4e0b","num":"80","desc":"\u662f\u6307\u5916\u89c2\u6709\u78e8\u635f\u5212\u75d5\u6216\u6389\u6f06\uff0c\u660e\u663e\u7684\u4f7f\u7528\u75d5\u8ff9\uff0c\u4f46\u529f\u80fd\u6b63\u5e38\u5b8c\u597d\u7684\u8d27\u54c1\u3002","add_time":"0"},"2":{"quality_id":"7","title":"\u7f3a\u9677\u54c1","num":"2","desc":"\u662f\u6307\u5916\u89c2\u6709\u635f\u574f\u6216\u5b58\u5728\u90e8\u5206\u529f\u80fd\u7f3a\u9677\uff0c\u4f46\u4e3b\u8981\u529f\u80fd\u8fd8\u80fd\u4f7f\u7528\u7684\u8d27\u54c1\u3002","add_time":"0"},"1":{"quality_id":"8","title":"\u62a5\u5e9f\u54c1","num":"1","desc":"\u662f\u6307\u4e3b\u8981\u529f\u80fd\u95ee\u9898\uff0c\u5df2\u65e0\u6cd5\u6b63\u5e38\u4f7f\u7528\u7684\u8d27\u54c1\u3002","add_time":"0"}}',
        quality_arr =eval("("+quality_arr+")"),
        ajax_goods_url = "/goods/ajax",
        ajax_goods_qa_url = "/goods/qa" ,
        order_url ="/order/add",
        url = "/user/privateLetter",
        csrf ='NU5URXU2UWRUGx4dJxseDXoXMQ0jZR1WDTkCFyFMISMHfB4xH0Q9Ng==',
        user_id = 10820479,
        subid = 0,
        isActive = 0,
        actPri = isActive ? "" : "",
        phone_mob = "16619922490",
        isStore=0,
        isaudit = 0;
    $(function(){
        _initPage();
        _initErrorDialog();
        goodsAttention(goods_id);
        sellerAttention(seller_id);
        isActive? Active.start() :'';
    });--}}
</script>
<div class="layerbox-overlay" id="galleryOverlay" style="display: none;">
    <iframe style="width: 100%; height: 100%;"></iframe>
</div>


<!-- foot -->

<!-- footer-box -->
<div class="footer-box">
    <!-- guarantee-box -->
    <div class="guarantee-box">
        <div class="wrapper">
            <ul class="guarantee-list clearfix">
                <li class="guarantee-item guarantee-item1">
                    <img src="/Picture/guarantee-icon1.png" alt="">
                    <strong>精选商品</strong>
                    <ul class="guarantee-links">
                        <li><span class="link">最全摄影品类</span></li>
                        <li><span class="link">垃圾商品过滤</span></li>
                        <li><span class="link">全程客服辅助</span></li>
                    </ul>
                </li>
                <li class="guarantee-item guarantee-item2">
                    <img src="/Picture/guarantee-icon2.png" alt="">
                    <strong>安全支付</strong>
                    <ul class="guarantee-links">
                        <li><span class="link">支付宝担保交易</span></li>
                        <li><span class="link">信用卡0手续费</span></li>
                        <li><span class="link">全程客服辅助</span></li>
                    </ul>
                </li>
                <li class="guarantee-item guarantee-item3">
                    <img src="/Picture/guarantee-icon3.png" alt="">
                    <strong>货款放心</strong>
                    <ul class="guarantee-links">
                        <li><span class="link">检测技术支持</span></li>
                        <li><span class="link">满意确认付款</span></li>
                    </ul>
                </li>
                <li class="guarantee-item guarantee-item4">
                    <img src="/Picture/guarantee-icon4.png" alt="">
                    <strong>纠纷维权</strong>
                    <ul class="guarantee-links">
                        <li><span class="link">灰鹤客服介入</span></li>
                        <li><span class="link">质量纠纷仲裁</span></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
    <!-- guarantee-box -->

    <div class="wrapper foot-classification clearfix">
        <ul class="foot-classification-links">
            <li class="foot-classification-item">
                <strong>新手上路</strong>
                <ul class="links">
                    <li><a rel="nofollow" target="_blank" href="/help/detail?id=196">购物流程</a></li>
                    <li><a rel="nofollow" target="_blank" href="/help/detail?id=166">免费注册</a></li>
                    <li><a rel="nofollow" target="_blank" href="/help/detail?id=237">发布商品</a></li>
                    <li><a rel="nofollow" target="_blank" href="/help/detail?id=390">交易安全</a></li>
                    <li><a rel="nofollow" target="_blank" href="/help/detail?id=389">联系客服</a></li>
                </ul>
            </li>
            <li class="foot-classification-item">
                <strong>支付方式</strong>
                <ul class="links">
                    <li><a rel="nofollow" target="_blank" href="/help/detail?id=391">支付宝</a></li>
                    <li><a rel="nofollow" target="_blank" href="/help/detail?id=392">网银支付</a></li>
                    <li><a rel="nofollow" target="_blank" href="/help/detail?id=393">信用卡</a></li>
                    <li><a rel="nofollow" target="_blank" href="/help/detail?id=395">公司转账</a></li>
                </ul>
            </li>
            <li class="foot-classification-item">
                <strong>售后保障</strong>
                <ul class="links">
                    <li><a rel="nofollow" target="_blank" href="/help/detail?id=207">保障范围</a></li>
                    <li><a rel="nofollow" target="_blank" href="/help/detail?id=220">退换货流程</a></li>
                    <li><a rel="nofollow" target="_blank" href="/help/detail?id=388">信息举报</a></li>
                    <li><a rel="nofollow" target="_blank" href="/help/detail?id=203">退款说明</a></li>
                </ul>
            </li>
            <li class="foot-classification-item">
                <strong>特色服务</strong>
                <ul class="links">
                    <li><a rel="nofollow" target="_blank" href="/help/detail?id=386">灰鹤鉴定</a></li>
                    <li><a rel="nofollow" target="_blank" href="/help/detail?id=319">灰鹤回收</a></li>
                    <li><a rel="nofollow" target="_blank" href="/help/detail?id=336">灰鹤拍卖</a></li>
                    <li><a rel="nofollow" target="_blank" href="/help/detail?id=387">卖家帮助</a></li>
                </ul>
            </li>
        </ul>
        <div class="foot-QR-code">
            <span class="pic"><img src="/Picture/wechat.jpg" alt="" width="80" height="80"></span>
            <strong>灰鹤二手官方微信</strong>
            <p>扫描二维码<br />即刻与灰鹤二手亲密互动</p>
        </div>
    </div>
    
    
<div class="footer-copyright">
    <div class="wrapper">
        <div class="site-map">
            <a rel="nofollow" href="http://www.fengniao.com/about.html" target="_blank">灰鹤简介</a>
            <a rel="nofollow" href="http://www.fengniao.com/contact.html" target="_blank">联系我们</a>
            <a rel="nofollow" href="http://www.fengniao.com/sitelinks.php" target="_blank">友情链接</a>
            <a rel="nofollow" href="http://www.fengniao.com/zhaopin.html" target="_blank">招聘信息</a>
            <a rel="nofollow" href="http://www.fengniao.com/law.html" target="_blank">用户服务协议</a>
            <a rel="nofollow" href="http://www.fengniao.com/copyright.html" target="_blank">隐私权声明</a>
            <a rel="nofollow" href="http://www.fengniao.com/shengming.html" target="_blank">法律投诉声明</a>
        </div>

        <div class="copyright">&copy;
            <script type="text/javascript">var myDate = new Date();document.write(myDate.getFullYear());</script>greycrane.com. All rights reserved . 北京灰鹤映像电子商务有限公司（灰鹤网）<br />版权所有 京ICP证150110号
        </div>
    </div>
</div>
<!--<script type="text/javascript" src="/Scripts/msg.js"></script>-->
    
</div>
<!-- //footer-box --><div id="commonLoginDialog" style="display: none;" class="commonLogin-dialog clearfix">
    <ul class="clearfix">
        <li id="scanLoginDialog" class="commonLoginDialog-form scanLogin-dialog" style="display: block">
            <div class="commonLogin-header">
                <h3 class="commonLogin-title">
                    微信扫码，安全登录</h3>
                <p class="commonLogin-sub-title">打开微信，扫一扫</p>
            </div>
            <div class="pic-box">
                <span class="pic-wrap"><img id="wxLoginQR" src="" alt=""></span>
                <span class="default-pic"><img src="/Picture/scan-default.png" alt="" width="247" height="270"></span>
            </div>
        </li>
        <li id="commonUserNameDialog" class="commonLoginDialog-form userName-dialog" style="display: none;">
            <div class="commonLogin-header">
                <h3 class="commonLogin-title">账号密码登录</h3>
                <span class="tip" style="display: none;"></span>
                <span class="exchange-link message-link">短信快捷登录</span>
            </div>
            <ul class="form-items clearfix">
                <li class="form-item clearfix">
                    <i class="user-name-icon"></i><input id="commonLoginUserName" class="user-name error" type="text" placeholder="请输入手机号/用户名/邮箱">
                </li>
                <li class="form-item clearfix">
                    <i class="password-icon"></i><input id="commonLoginPasswd" class="password" type="password" placeholder="请输入密码">
                    <div class="links clearfix">
                        <a rel="nofollow" target="_blank" href="http://my.fengniao.com/resetPassword.php" class="forgot-link">忘记密码？</a>
                    </div>
                </li>
                <li class="form-item clearfix">
                    <input class="commonLogin-button nomal" type="button" value="立即登录">
                </li>
            </ul>

            <div class="register-bar" style="display: none">还没有账号？<a target="_blank" href="http://my.fengniao.com/register.php">立即注册</a></div>

            <dl class="other-commonLogin clearfix" style="display: none">
                <dt>其他登录方式：</dt>
                <dd>
                    <a target="_blank" href="http://my.fengniao.com/user/login-third-party?id=1&url=http%3A%2F%2F2.fengniao.com%2Fsecforum%2F3266810.html" class="sina-link">新浪</a>
                    <a target="_blank" href="http://my.fengniao.com/user/login-third-party?id=2&url=http%3A%2F%2F2.fengniao.com%2Fsecforum%2F3266810.html" class="wechat-link">微信</a>
                    <a target="_blank" href="http://my.fengniao.com/user/login-third-party?id=3&url=http%3A%2F%2F2.fengniao.com%2Fsecforum%2F3266810.html" class="QQ-link">QQ</a>
                </dd>
            </dl>
        </li>
        <li id="otherLoginDialog" class="commonLoginDialog-form otherLogin-dialog" style="display: none;">
            <div class="commonLogin-header">
                <h3 class="commonLogin-title">其他登录方式</h3>
                <p class="commonLogin-sub-title">推荐使用<span class="scan-wechat-link">微信扫码</span>登录，安全快捷</p>
            </div>
            <div class="other-login clearfix">
                <a target="_blank" href="http://my.fengniao.com/user/login-third-party?id=1&url=http%3A%2F%2F2.fengniao.com%2Fsecforum%2F3266810.html" class="login-link link-sina">新浪微博</a>
                <a href="javascript:;" class="login-link link-scan-wechat">腾讯微信</a>
                <a target="_blank" href="http://my.fengniao.com/user/login-third-party?id=3&url=http%3A%2F%2F2.fengniao.com%2Fsecforum%2F3266810.html" class="login-link link-QQ">腾讯QQ</a>
                <a href="javascript:;" class="login-link link-message-login">短信验证</a>
            </div>
        </li>
        <li id="commonMessageDialog" class="commonLoginDialog-form message-dialog no-border"  style="display: none;">
            <div class="commonLogin-header">
                <h3 class="commonLogin-title">短信快捷登录</h3>
                <span class="tip" style="display: none;"></span>
                <span class="exchange-link">账号密码登录</span>
            </div>
            <ul class="form-items">
                <li class="form-item clearfix">
                    <i class="mobile-icon"></i><input id="commonLoginUserMobile" class="mobile" type="text" placeholder="请输入大陆手机号">
                </li>
                <li class="form-item clearfix">
                    <button type="button" class="disabled getCodeBtn" time="0" >获取动态密码</button>
                    <input id="commonLoginCode" class="code-input" type="text">
                    <br class="clear">
                    <span class="commonLogin-tip high-tip">注意：如果您已注册过灰鹤账号，请确认该手机号和账号是否做了绑定，否则系统将自动创建新账号。</span>
                </li>
                <li class="form-item clearfix">
                    <input class="commonLogin-button" type="button" value="立即登录">
                </li>
            </ul>
        </li>
    </ul>
    <div class="dialog-link clearfix">
        <span id="otherLink" class="link other-link">其他登录</span>
        <span id="userNameLink" class="link user-name-link">账号密码登录</span>
        <span id="scanLink" class="link scan-link" style="display: none">微信扫码登录</span>
        <a class="link register-link" href="http://my.fengniao.com/register.php">注册新账号</a>
    </div>
</div>
<div id="commonLoginPopupCaptcha"></div><!-- <script language="JavaScript" type="text/javascript" src="/Scripts/pv.js"></script> -->
<script>
    /*var _hmt = _hmt || [];
    (function () {
        var hm = document.createElement("script");
        hm.src = "//hm.baidu.com/hm.js?916ddc034db3aa7261c5d56a3001e7c5";
        var s = document.getElementsByTagName("script")[0];
        s.parentNode.insertBefore(hm, s);
    })();*/
</script><!-- <script src="/Scripts/gt.js"></script>
<script src="/Scripts/jquery.jcarousel.min.js" 0="frontend\assets\BaseAsset" language="javascript" charset="UTF-8"></script>
<script src="/Scripts/jcarousel.connected-carousels.js" 0="frontend\assets\BaseAsset" language="javascript" charset="UTF-8"></script>
<script src="/Scripts/jquery.cookie.1.4.0.js" 0="frontend\assets\BaseAsset" language="javascript" charset="UTF-8"></script>
<script src="/Scripts/showsesamecredit.js" 0="frontend\assets\BaseAsset" language="javascript" charset="UTF-8"></script>
<script src="/Scripts/view.js" 0="frontend\assets\BaseAsset" language="javascript" charset="UTF-8"></script>
<script src="/Scripts/priceguide.js" 0="frontend\assets\BaseAsset" language="javascript" charset="UTF-8"></script> -->
<script>
    $('i[name=name]').mouseover(function(){
        $('#dvs').attr('class','parameter-item  quality-parameter-item   clearfix show-layer');
    });
    $('i[name=name]').mouseout(function(){
        $('#dvs').attr('class','parameter-item  quality-parameter-item   clearfix');
    });
</script> -->

</body>


</html>



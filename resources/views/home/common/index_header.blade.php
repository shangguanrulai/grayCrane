<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <title>灰鹤二手交易平台</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <meta name="renderer" content="webkit">
    <meta name="csrf-param" content="_csrf">
    <meta name="csrf-token" content="Sk02VWFhd2t.e2wkDDgEPxggbxQ.OxsZcjVxYzM1BR8ZF24KFRMUKg==">
    <meta http-equiv="mobile-agent" content="format=html5; url=http://m.2.fengniao.com/"/>
    <base target=_blank>
    <meta name="keywords" content="灰鹤二手,二手摄影器材交易,二手单反，二手数码相机,二手镜头">
    <meta name="description" content="灰鹤二手交易平台提供单反相机、镜头、微单、便携数码相机、中画幅相机、闪光灯、三脚架、佳能、尼康、等数千种器材品牌,交易回收选购二手摄影器材，就上灰鹤网二手交易平台">
    <link id="narrowScreen" rel="stylesheet">
    <link href="http://m.2.fengniao.com" rel="alternate" media="only screen and (max-width: 640px)">
    {{--<link href="/Content/globalceiling.css" rel="stylesheet">--}}
    <link href="/Content/jquery-ui.1.11.4.min.css" rel="stylesheet">
    <link href="/Content/jquery.bxslider.css" rel="stylesheet">
    <link href="/Content/header.css" rel="stylesheet">
    <link href="/Content/secondarytradingpublic.css" rel="stylesheet">
    <link href="/Content/homepage.css" rel="stylesheet" 0="frontend\assets\BaseAsset">
    <script src="/Scripts/jquery.min.js" charset="UTF-8"></script>
    <script src="/Scripts/jqueryui.1.11.4.js" charset="UTF-8"></script>
    {{--<script src="/Scripts/jquery.bxslider.min.js" charset="UTF-8"></script>--}}
    <script src="/Scripts/jquery.tinyscrollbar.2.4.2.min.js" charset="UTF-8"></script>
    <script src="/Scripts/im.js" charset="UTF-8"></script>
    {{--<script src="/Scripts/globalceiling.js" charset="UTF-8"></script>--}}
    <script src="/Scripts/md5.js" charset="UTF-8"></script>
    {{--<script src="/Scripts/common.js" charset="UTF-8"></script>--}}
    <script src="/Scripts/global.js" charset="UTF-8"></script>
    <script src="/Scripts/swfobject.js" charset="UTF-8"></script>
    <link rel="stylesheet" id="WideGoodsSheet" rel="stylesheet">
    <link rel="stylesheet" href="/layui/css/layui.css">
    <script src="/layui/layui.js"></script>
    <script>
        if (!$.support.leadingWhitespace || /msie 9/.test(navigator.userAgent.toLowerCase())) {
            document.documentElement.className += ' lowIE';
        }

        if(parseInt(window.screen.width,10) < 1025){
            document.documentElement.className += ' narrowScreen';
        }

    </script>

</head>
<script src="/Scripts/m.js" charset="UTF-8"></script>
<body>

<!-- header -->
<ul class="layui-nav" lay-filter="">
    <li class="layui-nav-item"><a href="/">灰鹤首页</a></li>
    <li class="layui-nav-item"><a href="">HI 欢迎来到灰鹤</a></li>
    @for ($i=0; $i < 19; $i++)
        <li class="layui-nav-item"><a href=""></a></li>
    @endfor
    <li class="layui-nav-item"><a href="/home/login">请登录</a></li>
    <li class="layui-nav-item"><a href="/home/user?uid=1">用户中心</a></li>
    <li class="layui-nav-item"><a href="">退出</a></li>
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
            <img class="fn-shop-logo-b" src="/Picture/7df5beae4fc9e31d548c6dbafbec869b.png">
            <img class="fn-shop-logo-s" style="display: none;" src="">
        </a>
    </div>


    <div class="search-box" id="searchContainer">
        <ul class="search-tab clearfix">
            <!--        <li index="0" class="current">一口价</li>-->
            <!--        <li index="2" class="">拍卖</li>-->
        </ul>
        <div class="search-bar">
            <input type="hidden" id="type" name="type" value="0">        <input class="search-button" id="searchBtn" type="button" value="搜&nbsp;索"/>
            <span class="search-txt">
            <input id="searchKwd" type="text" autocomplete="off" placeholder="请输入感兴趣的器材型号"/>
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
        <div class="goods-classification J_goodsClassification" id="fn-2-navigation-layer">
            <span class="classification-trigger J_classificationTrigger">商品分类</span>
            <div class="classification-sub-layer J_switchTab" >
                <ul class="sub-link-box">
                    <li class="sub-link-item item1 J_item" rel="classificationPanel1">
                        <strong>
                            <a target="_blank" href="/price/114-0-0-0-0-0-def-1_1.html">数码相机</a>
                        </strong>
                        <div class="links clearfix">
                            <a target="_blank" href="/price/114-1049-0-0-0-0-def-1_1.html">单反相机</a>
                            <a target="_blank" href="/price/114-1050-0-0-0-0-def-1_1.html">微单/单电相机</a>
                            <a target="_blank" href="/price/114-1051-0-0-0-0-def-1_1.html">便携数码相机</a>
                        </div>
                        <i class="line"></i>            </li>
                    <li class="sub-link-item item2 J_item" rel="classificationPanel2">
                        <strong>
                            <a target="_blank" href="/price/118-0-0-0-0-0-def-1_1.html">镜头</a>
                        </strong>
                        <div class="links clearfix">
                            <a target="_blank" href="/price/118-1068-0-0-0-0-def-1_1.html">手动镜头</a>
                            <a target="_blank" href="/price/118-1069-0-0-0-0-def-1_1.html">自动镜头</a>
                        </div>
                        <i class="line"></i>            </li>
                    <li class="sub-link-item item3 J_item" rel="classificationPanel3">
                        <strong>
                            <a target="_blank" href="/price/115-0-0-0-0-0-def-1_1.html">胶片机</a>
                        </strong>
                        <div class="links clearfix">
                            <a target="_blank" href="/price/115-1057-0-0-0-0-def-1_1.html">中画幅相机</a>
                            <a target="_blank" href="/price/115-1056-0-0-0-0-def-1_1.html">35mm 相机</a>
                        </div>
                        <i class="line"></i>            </li>
                    <li class="sub-link-item item4 J_item" rel="classificationPanel4">
                        <strong>
                            <a target="_blank" href="/price/116-0-0-0-0-0-def-1_1.html">摄影必备</a>
                        </strong>
                        <div class="links clearfix">
                            <a target="_blank" href="/price/116-290-0-0-0-0-def-1_1.html">闪光灯</a>
                            <a target="_blank" href="/price/116-307-0-0-0-0-def-1_1.html">三脚架</a>
                            <a target="_blank" href="/price/116-265-0-0-0-0-def-1_1.html">相机包</a>
                        </div>
                        <i class="line"></i>            </li>
                    <li class="sub-link-item item5 J_item" rel="classificationPanel5">
                        <strong>
                            <a target="_blank" href="/price/112-0-0-0-0-0-def-1_1.html">摄像机</a>/<a href="/price/117-0-0-0-0-0-def-1_1.html">其他设备</a>
                        </strong>
                        <div class="links clearfix">
                            <a target="_blank" href="/price/1024-112-0-0-0-0-def-1_1.html">运动型摄像机</a>

                            <a target="_blank" href="/price/742-117-0-0-0-0-def-1_1.html">色彩管理</a>

                        </div>
                    </li>
                </ul>

                <div id="classificationPanel1" class="tab-panel J_tabPanel wide-panel" style="display: none;">
                    <dl class="sub-links-list">
                        <dt>找分类</dt>
                        <dd>
                            <div class="sub-links clearfix">
                                <span class="link hot-link"><a target="_blank" href="/price/114-1049-0-0-0-0-def-1_1.html">单反相机<i class="hot-tag">hot</i></a></span>
                                <span class="link hot-link"><a target="_blank" href="/price/114-1050-0-0-0-0-def-1_1.html">微单/单电相机<i class="hot-tag">hot</i></a></span>
                                <span class="link"><a target="_blank" href="/price/114-1051-0-0-0-0-def-1_1.html">便携数码相机</a></span>
                                <span class="link"><a target="_blank" href="/price/114-1052-0-0-0-0-def-1_1.html">中画幅相机</a></span>
                                <span class="link"><a target="_blank" href="/price/114-1053-0-0-0-0-def-1_1.html">数码后背</a></span>
                                <span class="link"><a target="_blank" href="/price/114-1055-0-0-0-0-def-1_1.html">数码旁轴</a></span>
                                <span class="link"><a target="_blank" href="/price/114-1071-0-0-0-0-def-1_1.html">其他</a></span>
                            </div>
                        </dd>

                        <dt>推荐品牌</dt>
                        <dd>
                            <div class="sub-links sub-brand-links clearfix">
                                <span class="link hot-link"><a target="_blank" href="/price/114-0-232-0-0-0-def-1_1.html">Canon（佳能）<i class="hot-tag">hot</i></a></span>
                                <span class="link hot-link"><a target="_blank" href="/price/114-0-657-0-0-0-def-1_1.html">Nikon（尼康）<i class="hot-tag">hot</i></a></span>
                                <span class="link hot-link"><a target="_blank" href="/price/114-0-167-0-0-0-def-1_1.html">Sony（索尼）<i class="hot-tag">hot</i></a></span>
                                <span class="link"><a target="_blank" href="/price/114-0-752-0-0-0-def-1_1.html">Fujifilm（富士）</a></span>
                                <span class="link"><a target="_blank" href="/price/114-0-184-0-0-0-def-1_1.html">Olympus（奥林巴斯）</a></span>
                                <span class="link"><a target="_blank" href="/price/114-0-1061-0-0-0-def-1_1.html">Pentax（宾得）</a></span>
                                <span class="link"><a target="_blank" href="/price/114-0-84-0-0-0-def-1_1.html">Panasonic（松下）</a></span>
                                <span class="link"><a target="_blank" href="/price/114-0-98-0-0-0-def-1_1.html">Samsung（三星）</a></span>
                            </div>
                        </dd>


                        <dt>热搜机型</dt>
                        <dd>
                            <div class="sub-links clearfix">
                                <span class="link"><a target="_blank" href="/price/114-1049-232-157973-0-0-def-1_1.html">5D2</a></span>
                                <span class="link"><a target="_blank" href="/price/114-1049-657-396424-0-0-def-1_1.html">D810A</a></span>
                                <span class="link"><a target="_blank" href="/price/114-1049-232-239857-0-0-def-1_1.html">5D3</a></span>
                                <span class="link"><a target="_blank" href="/price/114-1049-232-119530-0-0-def-1_1.html">40D</a></span>
                                <span class="link"><a target="_blank" href="/price/114-1049-657-226396-0-0-def-1_1.html">D800</a></span>
                                <span class="link"><a target="_blank" href="/price/114-1049-232-79273-0-0-def-1_1.html">20D</a></span>
                            </div>
                        </dd>

                    </dl>
                </div>
                <div id="classificationPanel2" class="tab-panel J_tabPanel wide-panel" style="display: none;">
                    <dl class="sub-links-list">
                        <dt>找分类</dt>
                        <dd>
                            <div class="sub-links clearfix">
                                <span class="link hot-link"><a target="_blank" href="/price/118-1068-0-0-0-0-def-1_1.html">手动镜头<i class="hot-tag">hot</i></a></span>
                                <span class="link hot-link"><a target="_blank" href="/price/118-1069-0-0-0-0-def-1_1.html">自动镜头<i class="hot-tag">hot</i></a></span>
                                <span class="link"><a target="_blank" href="/price/118-1072-0-0-0-0-def-1_1.html">其他</a></span>
                            </div>
                        </dd>

                        <dt>推荐品牌</dt>
                        <dd>
                            <div class="sub-links sub-brand-links clearfix">
                                <span class="link hot-link"><a target="_blank" href="/price/118-0-232-0-0-0-def-1_1.html">Canon（佳能）<i class="hot-tag">hot</i></a></span>
                                <span class="link hot-link"><a target="_blank" href="/price/118-0-657-0-0-0-def-1_1.html">Nikon（尼康）<i class="hot-tag">hot</i></a></span>
                                <span class="link hot-link"><a target="_blank" href="/price/118-0-1061-0-0-0-def-1_1.html">Pentax（宾得）<i class="hot-tag">hot</i></a></span>
                                <span class="link hot-link"><a target="_blank" href="/price/118-0-1799-0-0-0-def-1_1.html">Sigma（适马）<i class="hot-tag">hot</i></a></span>
                                <span class="link"><a target="_blank" href="/price/118-0-3534-0-0-0-def-1_1.html">TAMRON（腾龙）</a></span>
                                <span class="link"><a target="_blank" href="/price/118-0-167-0-0-0-def-1_1.html">Sony（索尼）</a></span>
                                <span class="link"><a target="_blank" href="/price/118-0-3538-0-0-0-def-1_1.html">Leica（徕卡）</a></span>
                                <span class="link"><a target="_blank" href="/price/118-0-184-0-0-0-def-1_1.html">Olympus（奥林巴斯）</a></span>
                                <span class="link"><a target="_blank" href="/price/118-0-32969-0-0-0-def-1_1.html">Carl Zeiss（卡尔·蔡司）</a></span>
                            </div>
                        </dd>


                        <dt>热搜机型</dt>
                        <dd>
                            <div class="sub-links clearfix">
                                <span class="link"><a target="_blank" href="/price/118-1069-232-98876-0-0-def-1_1.html">24-105L</a></span>
                                <span class="link"><a target="_blank" href="/price/118-1069-232-327296-0-0-def-1_1.html">18-135 STM</a></span>
                                <span class="link"><a target="_blank" href="/price/118-1069-232-88684-0-0-def-1_1.html">85 F1.8</a></span>
                                <span class="link"><a target="_blank" href="/price/118-1069-232-88683-0-0-def-1_1.html">50 F1.8 II</a></span>
                                <span class="link"><a target="_blank" href="/price/118-1069-232-89952-0-0-def-1_1.html">70-200 F2.8L 小白</a></span>
                            </div>
                        </dd>

                    </dl>
                </div>
                <div id="classificationPanel3" class="tab-panel J_tabPanel wide-panel" style="display: none;">
                    <dl class="sub-links-list">
                        <dt>找分类</dt>
                        <dd>
                            <div class="sub-links clearfix">
                                <span class="link hot-link"><a target="_blank" href="/price/115-1057-0-0-0-0-def-1_1.html">中画幅相机<i class="hot-tag">hot</i></a></span>
                                <span class="link hot-link"><a target="_blank" href="/price/115-1056-0-0-0-0-def-1_1.html">35mm 相机<i class="hot-tag">hot</i></a></span>
                                <span class="link"><a target="_blank" href="/price/115-1041-0-0-0-0-def-1_1.html">便携及其他相机</a></span>
                                <span class="link"><a target="_blank" href="/price/115-1058-0-0-0-0-def-1_1.html">大画幅相机</a></span>
                                <span class="link"><a target="_blank" href="/price/115-1059-0-0-0-0-def-1_1.html">底片扫描设备</a></span>
                                <span class="link"><a target="_blank" href="/price/115-1060-0-0-0-0-def-1_1.html">暗房器材</a></span>
                                <span class="link"><a target="_blank" href="/price/115-1070-0-0-0-0-def-1_1.html">测光表</a></span>
                                <span class="link"><a target="_blank" href="/price/115-1074-0-0-0-0-def-1_1.html">其他</a></span>
                            </div>
                        </dd>

                        <dt>推荐品牌</dt>
                        <dd>
                            <div class="sub-links sub-brand-links clearfix">
                                <span class="link hot-link"><a target="_blank" href="/price/115-0-3538-0-0-0-def-1_1.html">Leica（徕卡）<i class="hot-tag">hot</i></a></span>
                                <span class="link hot-link"><a target="_blank" href="/price/115-0-657-0-0-0-def-1_1.html">Nikon（尼康）<i class="hot-tag">hot</i></a></span>
                                <span class="link hot-link"><a target="_blank" href="/price/115-0-3542-0-0-0-def-1_1.html">Hasselblad（哈苏）<i class="hot-tag">hot</i></a></span>
                                <span class="link"><a target="_blank" href="/price/115-0-232-0-0-0-def-1_1.html">Canon（佳能）</a></span>
                                <span class="link"><a target="_blank" href="/price/115-0-33352-0-0-0-def-1_1.html">Rollei（禄莱）</a></span>
                                <span class="link"><a target="_blank" href="/price/115-0-37470-0-0-0-def-1_1.html">Contax（康泰时）</a></span>
                                <span class="link"><a target="_blank" href="/price/115-0-752-0-0-0-def-1_1.html">Fujifilm（富士）</a></span>
                                <span class="link"><a target="_blank" href="/price/115-0-37471-0-0-0-def-1_1.html">Minolta（美能达）</a></span>
                                <span class="link"><a target="_blank" href="/price/115-0-33780-0-0-0-def-1_1.html">Linhof（林哈夫）</a></span>
                            </div>
                        </dd>


                        <dt>热搜机型</dt>
                        <dd>
                            <div class="sub-links clearfix">
                                <span class="link"><a target="_blank" href="/price/115-1056-3538-404798-0-0-def-1_1.html">M6</a></span>
                                <span class="link"><a target="_blank" href="/price/115-1056-657-404745-0-0-def-1_1.html">FM2</a></span>
                                <span class="link"><a target="_blank" href="/price/115-1057-3542-256616-0-0-def-1_1.html">503CW</a></span>
                                <span class="link"><a target="_blank" href="/price/115-1056-3538-404797-0-0-def-1_1.html">M3</a></span>
                                <span class="link"><a target="_blank" href="/price/115-1056-657-404748-0-0-def-1_1.html">F3</a></span>
                            </div>
                        </dd>

                    </dl>
                </div>
                <div id="classificationPanel4" class="tab-panel J_tabPanel wide-panel" style="display: none;">
                    <dl class="sub-links-list">
                        <dt>找分类</dt>
                        <dd>
                            <div class="sub-links clearfix">
                                <span class="link hot-link"><a target="_blank" href="/price/116-290-0-0-0-0-def-1_1.html">闪光灯<i class="hot-tag">hot</i></a></span>
                                <span class="link hot-link"><a target="_blank" href="/price/116-307-0-0-0-0-def-1_1.html">三脚架<i class="hot-tag">hot</i></a></span>
                                <span class="link hot-link"><a target="_blank" href="/price/116-265-0-0-0-0-def-1_1.html">相机包<i class="hot-tag">hot</i></a></span>
                                <span class="link"><a target="_blank" href="/price/116-648-0-0-0-0-def-1_1.html">单反手柄</a></span>
                                <span class="link"><a target="_blank" href="/price/116-54-0-0-0-0-def-1_1.html">闪存卡</a></span>
                                <span class="link"><a target="_blank" href="/price/116-216-0-0-0-0-def-1_1.html">读卡器</a></span>
                                <span class="link"><a target="_blank" href="/price/116-722-0-0-0-0-def-1_1.html">相机贴膜</a></span>
                                <span class="link"><a target="_blank" href="/price/116-395-0-0-0-0-def-1_1.html">滤镜</a></span>
                                <span class="link"><a target="_blank" href="/price/116-677-0-0-0-0-def-1_1.html">遮光罩</a></span>
                                <span class="link"><a target="_blank" href="/price/116-741-0-0-0-0-def-1_1.html">闪光灯配件</a></span>
                                <span class="link"><a target="_blank" href="/price/116-266-0-0-0-0-def-1_1.html">相机电池</a></span>
                                <span class="link"><a target="_blank" href="/price/116-221-0-0-0-0-def-1_1.html">充电器</a></span>
                                <span class="link"><a target="_blank" href="/price/116-753-0-0-0-0-def-1_1.html">转接环/转接筒</a></span>
                                <span class="link"><a target="_blank" href="/price/116-675-0-0-0-0-def-1_1.html">镜头盖</a></span>
                                <span class="link"><a target="_blank" href="/price/116-740-0-0-0-0-def-1_1.html">取景器</a></span>
                                <span class="link"><a target="_blank" href="/price/116-738-0-0-0-0-def-1_1.html">快门线</a></span>
                                <span class="link"><a target="_blank" href="/price/116-739-0-0-0-0-def-1_1.html">相机遥控器</a></span>
                                <span class="link"><a target="_blank" href="/price/116-755-0-0-0-0-def-1_1.html">对焦屏</a></span>
                                <span class="link"><a target="_blank" href="/price/116-687-0-0-0-0-def-1_1.html">清洁养护</a></span>
                                <span class="link"><a target="_blank" href="/price/116-845-0-0-0-0-def-1_1.html">背带/腕带</a></span>
                                <span class="link"><a target="_blank" href="/price/116-846-0-0-0-0-def-1_1.html">摄影手套</a></span>
                                <span class="link"><a target="_blank" href="/price/116-619-0-0-0-0-def-1_1.html">相机配件</a></span>
                                <span class="link"><a target="_blank" href="/price/116-1046-0-0-0-0-def-1_1.html">近摄镜</a></span>
                                <span class="link"><a target="_blank" href="/price/116-1061-0-0-0-0-def-1_1.html">云台/快装板</a></span>
                                <span class="link"><a target="_blank" href="/price/116-1062-0-0-0-0-def-1_1.html">摄影灯</a></span>
                                <span class="link"><a target="_blank" href="/price/116-1063-0-0-0-0-def-1_1.html">防水壳</a></span>
                                <span class="link"><a target="_blank" href="/price/116-1064-0-0-0-0-def-1_1.html">自拍杆</a></span>
                                <span class="link"><a target="_blank" href="/price/116-1075-0-0-0-0-def-1_1.html">其他</a></span>
                            </div>
                        </dd>




                    </dl>
                </div>
                <div id="classificationPanel5" class="tab-panel J_tabPanel wide-panel" style="display: none;">
                    <dl class="sub-links-list">

                        <dt>摄像机 - 视频设备</dt>
                        <dd>
                            <div class="sub-links clearfix">
                                <span class="link hot-link"><a target="_blank" href="/price/112-1024-0-0-0-0-def-1_1.html">运动型摄像机<i class="hot-tag">hot</i></a></span>
                                <span class="link hot-link"><a target="_blank" href="/price/112-1034-0-0-0-0-def-1_1.html">航拍设备<i class="hot-tag">hot</i></a></span>
                                <span class="link"><a target="_blank" href="/price/112-1021-0-0-0-0-def-1_1.html">家用数码摄像机</a></span>
                                <span class="link"><a target="_blank" href="/price/112-1022-0-0-0-0-def-1_1.html">专业数码摄像机</a></span>
                                <span class="link"><a target="_blank" href="/price/112-1040-0-0-0-0-def-1_1.html">拍摄套件</a></span>
                                <span class="link"><a target="_blank" href="/price/112-1035-0-0-0-0-def-1_1.html">照明设备</a></span>
                                <span class="link"><a target="_blank" href="/price/112-1036-0-0-0-0-def-1_1.html">稳定器</a></span>
                                <span class="link"><a target="_blank" href="/price/112-1037-0-0-0-0-def-1_1.html">监视设备</a></span>
                                <span class="link"><a target="_blank" href="/price/112-1038-0-0-0-0-def-1_1.html">轨道</a></span>
                                <span class="link"><a target="_blank" href="/price/112-1039-0-0-0-0-def-1_1.html">录音设备</a></span>
                                <span class="link"><a target="_blank" href="/price/112-1073-0-0-0-0-def-1_1.html">其他</a></span>
                            </div>
                        </dd>
                        <dt>其他设备</dt>
                        <dd>
                            <div class="sub-links clearfix">
                                <span class="link hot-link"><a target="_blank" href="/price/117-742-0-0-0-0-def-1_1.html">色彩管理<i class="hot-tag">hot</i></a></span>
                                <span class="link"><a target="_blank" href="/price/117-1065-0-0-0-0-def-1_1.html">显示器</a></span>
                                <span class="link"><a target="_blank" href="/price/117-1066-0-0-0-0-def-1_1.html">打印机</a></span>
                                <span class="link"><a target="_blank" href="/price/117-1067-0-0-0-0-def-1_1.html">数码相框</a></span>
                                <span class="link"><a target="_blank" href="/price/117-1076-0-0-0-0-def-1_1.html">其他</a></span>
                            </div>
                        </dd>

                    </dl>
                </div>
            </div>
        </div>

        <div class="nav-link">
            <i class="bottom-line"></i>
            <a href="/" class="current-link">首页</a>
            <a href="/price/def-1_1.html" target="_blank">全部闲置</a>
            <a href="http://www.fengniao.com/topic/5348902.html" target="_blank">租赁<i class="new-icon">新</i></a>
            <a href="/auction" target="_blank">拍卖</a>
            <a href="/recycle" target="_blank">回收<i class="hot-icon">热</i></a>
            <a href="/quality" target="_blank">鉴定<i class="new-icon">热</i></a>
            <a href="/service" target="_blank">维修</a>
            <a href="/shop" target="_blank">商铺列表</a>
        </div>
    </div>
</div>

<!-- //homePage-nav-box -->

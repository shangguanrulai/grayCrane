<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-param" content="_csrf">
    <meta name="csrf-token" content="dGFzT24wakFBMx8/AVRYOys1JxYvXkcoATUQYgFdAAkCVEI6XV0vCA==">
    <title>选择支付</title>
    <link href="/Content/jquery-ui.1.11.4.min.css" rel="stylesheet">
<link href="/Content/secondarytradingpublic.css" rel="stylesheet">
<link href="/Content/secondarytradingorder.css" rel="stylesheet" 0="pay\assets\MallAsset">
<script src="/Scripts/jquery.min.js" charset="UTF-8"></script>
<script src="/Scripts/jqueryui.1.11.4.js" charset="UTF-8"></script>

    <link rel="stylesheet" href="/bs/css/bootstrap.min.css">
    <link rel="stylesheet" href="/bs/css/bootstrap-theme.min.css">
    <script type="text/javascript" src="/bs/js/jquery.js"></script>
    <script type="text/javascript" src="/bs/js/bootstrap.min.js"></script>
<!-- <script src="/Scripts/common-pay.js" charset="UTF-8"></script> -->    <script>
        if (!$.support.leadingWhitespace || /msie 9/.test(navigator.userAgent.toLowerCase())) {
            document.documentElement.className += ' lowIE';
        }
    </script>
</head>
<body>
<div class="top-bar"><span class="text">蜂鸟购为您提供全程的专业技术支持及安全保障!</span></div>
<!-- header -->
<div class="header">
    <div class="wrapper clearfix">
        <a href="http://2.fengniao.com" class="logo">蜂鸟网-二手交易</a>
        
    </div>
</div>
<div class="pay-box clearfix">
    <div class="wrapper">
        <div class="order-status pay-status">
            <i class="pay-icon"></i>
            <h3 style='line-height:5px'>订单提交成功，请您确定付款购买！</h3>
            <ul class="order-summary clearfix">
                <li>订单号:{{ $onumber }}&nbsp;&nbsp;|&nbsp;&nbsp;</li>
                <li>应付金额(元) ：<span class="price"><strong>{{ $price }}</strong>&nbsp;元 </span></li>
            </ul>
            
            <div class="pay-num">
                立即支付<strong class="price">{{ $price }}元</strong>
            </div>
        </div>
        <!-- pay-tabs -->
        <div class="pay-tabs J_switchTab">
            
            <div class="tab-panels J_switchTab">
                <div id="payItem1" class="tab-panel J_tabPanel"
                     style="display:block">
                    <div class="plat-pay-box J_switchTab">
                        <form method="get" action="/home/goods/success">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                                <input type="hidden" name='rid' value = "{{ $rid }}" >
                                <input type="hidden" name='buyid' value = "{{ $buyid }}" >
                                <input type="hidden" name='price' value = "{{ $price }}" >
                                <input type="hidden" name='omsg' value = "{{ $omsg }}" >
                                <input type="hidden" name='onumber' value = "{{ $onumber }}" >

                                <label for="exampleInputPassword1" style='margin:0px 25px;'>支付密码</label>
                                <input style='margin:25px;width:500px;' type="password" class="form-control" id="exampleInputPassword1" placeholder="请输入交易密码" name='password'> 
                                <em class='em'></em> 
                                @if (count($errors) > 0)
        <div class="alert alert-danger" style="width:300px;margin:50px 150px;">
            <ul>
                
                    <li>{{ $errors }}</li>
                
            </ul>
        </div>
        <div style="clear: both"></div>
    @endif
                            
                            <div class="button-box J_tabPanels">

                 
                                <div  id="wechatItem" class="J_tabPanel" style="display:block;">
                                    <input id="wechatSubButton" type="submit" value="确认付款" class="button">
                                </div>
                            </div>
                        </form>
                        
                    </div>
                </div>
<!--                <div id="payItem4" class="tab-panel J_tabPanel" style="display: none;">-->
<!--                    <div class="wechat-pay-box">-->
<!--                        <h3 class="pay-title"><img src="/Picture/wechat-logo.png" width="30" alt="">微信支付</h3>-->
<!--                        <div class="code-box">-->
<!--                            <img src="/Picture/photo.png" alt="" width="185" height="185">-->
<!--                            <img src="/Picture/code-text.png" width="185" alt="">-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->

<!--                <div id="payItem3" class="tab-panel J_tabPanel" style="display: none;">-->
<!--                    <div class="quick-pay-box">-->
<!--                        <div class="quick-payment-bar clearfix">-->
<!--                            <h3>快捷-支付</h3><strong>方便·快捷·安全</strong>-->
<!--                            <p>一步验证，无需网银！</p>-->
<!--                        </div>-->
<!--                        <span class="upgrade-tag">-->
<!--                            <i class="upgrade-icon"></i>-->
<!--                            即将升级-->
<!--                        </span>-->
<!--                    </div>-->
<!--                </div>-->
            </div>

        </div>
        <!-- //pay-tabs -->


    </div>
</div>
<i id="wechatLaryerMarsk" class="wechatLaryerMarsk"></i>
<script type="text/javascript">
    var orderUrl = "http://2.fengniao.com/order/id/1015226548117190",
        helpUrl = "http://2.fengniao.com/help/detail?id=124",
        orderId= 25858,
        isRecharge = 0;
</script>
<!-- foot -->
<div class="foot">
    <div class="wrapper">
        <p class="link">
            <a href="http://www.fengniao.com/about.html">蜂鸟简介</a>|
            <a href="http://www.fengniao.com/contact.html">联系我们</a>|
            <a href="http://www.fengniao.com/sitelinks.php">友情链接</a>|
            <a href="http://www.fengniao.com/zhaopin.html">招聘信息</a>|
            <a href="http://www.fengniao.com/law.html">用户服务协议</a>|
            <a href="http://www.fengniao.com/copyright.html">隐私权声明</a>|
            <a href="http://www.fengniao.com/shengming.html">法律投诉声明</a>
        </p>
        <p class="copyright">
            <script type="text/javascript">var myDate = new Date();
                document.write(myDate.getFullYear());</script>
            fengniao.com. All rights reserved . 北京蜂鸟映像电子商务有限公司（蜂鸟网）
        </p>
        <p>版权所有 京ICP证150110号</p>
    </div>
</div>
<!-- <script src="/Scripts/pay.js" 0="pay\assets\MallAsset" language="javascript" charset="UTF-8"></script> --></body>
</html>

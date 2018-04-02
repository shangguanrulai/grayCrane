<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <title>个人中心</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <meta name="renderer" content="webkit">
    <meta http-equiv="mobile-agent" content="format=html5; url=http://m.2.fengniao.com/"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="/Content/jquery-ui.1.11.4.min.css" rel="stylesheet">
    <link href="/Content/jquery.bxslider.css" rel="stylesheet">
    <link href="/Content/header.css" rel="stylesheet">
    <link href="/Content/style.css" rel="stylesheet">
    <link href="/Content/page.css" rel="stylesheet">
    <script src="/Scripts/jquery.min.js" charset="UTF-8"></script>
    <script src="/Scripts/jqueryui.1.11.4.js" charset="UTF-8"></script>
    <script src="/Scripts/jquery.bxslider.min.js" charset="UTF-8"></script>
    <script src="/Scripts/jquery.tinyscrollbar.2.4.2.min.js" charset="UTF-8"></script>
    <script src="/Scripts/im.js" charset="UTF-8"></script>
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
     </script>
</head>
<body>
<ul class="layui-nav" lay-filter="">
    <li class="layui-nav-item"><a href="/">灰鹤首页</a></li>
    <li class="layui-nav-item"><a href="">HI 欢迎来到灰鹤</a></li>
    @for ($i=0; $i < 17; $i++)
        <li class="layui-nav-item"><a href=""></a></li>
    @endfor
    @if(empty(Session('user')))
        <li class="layui-nav-item"><a href="/home/login">登录</a></li>
        <li class="layui-nav-item"><a href="/home/register">注册</a></li>
    @else
        <li class="layui-nav-item"><a href=""></a></li>
        <li class="layui-nav-item"><a href="/home/user">{{ Session('user')['uname'] }}</a></li>
    @endif
    <li class="layui-nav-item"><a href="/home/user">用户中心</a></li>
    <li class="layui-nav-item"><a href="/home/loginout">退出</a></li>
</ul>

<script>
    //注意：导航 依赖 element 模块，否则无法进行功能性操作
    layui.use('element', function(){
        var element = layui.element;
    });
</script>
<div class="y-center-header fn-sec-header">
    <div class="y-center-warp clearfix">
                <div class="y-center-logo"><a href="http://2.fengniao.com/" target="_blank">二手交易</a></div>

<!--        <a href="http://2.fengniao.com/" class="home-link" target="_blank"><i class="arrow-icon"></i>返回灰鹤二手首页</a>-->

        <div class="y-center-nav-box ">
            <a class="trigger" href="/"
               style="background-position-y: -19px;">首页</a><font>&nbsp;</font>
        </div>

        <div class="y-center-nav-box ">
            <a class="trigger" href="/home/user" style="background-position-y: -19px;">我的二手</a>
            <font>&nbsp;</font>
        </div>
    </div>
</div>

<div class="y-center-main clearfix">
    <div class="y-center-warp">
        <div class="y-center-bread ptop20">
                        <a href="/">首页</a> &gt; <a href="/home/user">个人中心</a>
                    </div>
            <div class="y-center-search" style="position: relative;right:-105px;">
                <div class="y-center-searchBox">
                    <div class="menu">
                        <span>我的发布</span>
                    </div>
                    <div class="inputBox">
                        <form id="listSearch" action="/home/release" method="get" role="form">
                            <input type="text" name="keywords" class="text1" placeholder="请输入"/>
                            <button type="submit" class="btn1">搜索</button>
                        </form>
                    </div>
                </div>
                <div class="add">
                    <a href="/home/release/create">免费发布</a>
                </div>
            </div>
        

        <div class="y-center-main-left mtop20">
            <dl>
                <dt>我是买家</dt>
                <dd>
                    <ul>
                        <li>
                            <a href="/home/user/orders/buy" >已买到的商品</a>
                        </li>
                        <li>
                            <a href="/home/user/collect">我的收藏</a>
                        </li>
                    </ul>
                </dd>
            </dl>

            <dl>
                <dt>我是卖家</dt>
                <dd>
                    <ul>
                        <li>
                            <a href="/home/release" >我发布的商品</a>
                        </li>
                        <li>
                            <a href="/home/user/orders/sell" >已卖出的商品</a>
                        </li>
                    </ul>
                </dd>
            </dl>
            <dl>
                <dt>个人设置</dt>
                <dd>
                    <ul>
                        <li>
                            <a href="/home/user/addr" >收货地址管理</a>
                        </li>
                        <li>
                            <a href="/home/user/{{$user['uid']}}/edit" >个人信息设置</a>
                        </li>
                    </ul>
                </dd>
            </dl>
            <span>我的二手</span>
            <dl>
                <dd>
                    <ul>
                        <li>
                            <a href="/home/msg" >消息中心</a>
                        </li>
                    </ul>
                </dd>
            </dl>
        </div>

@section('content')

@show

<!-- foot -->
<div class="foot">
    <div class="wrapper">
        <p class="link">
    <a rel="nofollow" href="http://www.fengniao.com/about.html" target="_blank">灰鹤简介</a>|
    <a rel="nofollow" href="http://www.fengniao.com/contact.html" target="_blank">联系我们</a>|
    <a rel="nofollow" href="http://www.fengniao.com/sitelinks.php" target="_blank">友情链接</a>|
    <a rel="nofollow" href="http://www.fengniao.com/zhaopin.html" target="_blank">招聘信息</a>|
    <a rel="nofollow" href="http://www.fengniao.com/law.html" target="_blank">用户服务协议</a>|
    <a rel="nofollow" href="http://www.fengniao.com/copyright.html" target="_blank">隐私权声明</a>|
    <a rel="nofollow" href="http://www.fengniao.com/shengming.html" target="_blank">法律投诉声明</a>
</p>
<p class="copyright">©
    <script type="text/javascript">var myDate = new Date();
        document.write(myDate.getFullYear());</script>
    fengniao.com. All rights reserved . 北京灰鹤映像电子商务有限公司（灰鹤网）
</p>
<p>版权所有 京ICP证150110号</p>
<!--<script type="text/javascript" src="/Scripts/msg.js"></script>-->
    </div>
</div><div id="commonLoginDialog" style="display: none;" class="commonLogin-dialog clearfix">
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
                    <a target="_blank" href="http://my.fengniao.com/user/login-third-party?id=1&url=http%3A%2F%2F2.fengniao.com%2Fuser%2Findex" class="sina-link">新浪</a>
                    <a target="_blank" href="http://my.fengniao.com/user/login-third-party?id=2&url=http%3A%2F%2F2.fengniao.com%2Fuser%2Findex" class="wechat-link">微信</a>
                    <a target="_blank" href="http://my.fengniao.com/user/login-third-party?id=3&url=http%3A%2F%2F2.fengniao.com%2Fuser%2Findex" class="QQ-link">QQ</a>
                </dd>
            </dl>
        </li>
        <li id="otherLoginDialog" class="commonLoginDialog-form otherLogin-dialog" style="display: none;">
            <div class="commonLogin-header">
                <h3 class="commonLogin-title">其他登录方式</h3>
                <p class="commonLogin-sub-title">推荐使用<span class="scan-wechat-link">微信扫码</span>登录，安全快捷</p>
            </div>
            <div class="other-login clearfix">
                <a target="_blank" href="http://my.fengniao.com/user/login-third-party?id=1&url=http%3A%2F%2F2.fengniao.com%2Fuser%2Findex" class="login-link link-sina">新浪微博</a>
                <a href="javascript:;" class="login-link link-scan-wechat">腾讯微信</a>
                <a target="_blank" href="http://my.fengniao.com/user/login-third-party?id=3&url=http%3A%2F%2F2.fengniao.com%2Fuser%2Findex" class="login-link link-QQ">腾讯QQ</a>
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
<div id="commonLoginPopupCaptcha"></div>{{--<script language="JavaScript" type="text/javascript" src="/Scripts/pv.js"></script>--}}
<script src="/Scripts/gt.js"></script>
{{--<script src="/Scripts/index.js" 0="frontend\assets\BaseAsset" language="javascript" charset="UTF-8"></script>--}}
<script src="/Scripts/jquery.cookie.1.4.0.js" 0="frontend\assets\BaseAsset" language="javascript" charset="UTF-8"></script>

</body>
</html>

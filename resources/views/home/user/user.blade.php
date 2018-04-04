@extends('home.common.user_home')
@section('content')
    <style>
        .pass:hover{color: red;}
        .layui-nav{top:-20px;}
        .fn-sec-header{top:-20px;}
    </style>
        <div class="y-center-main-right home mtop20">
            <div class="y-center-home-box">
                <div class="y-center-info">
                    <div class="head">
                       @if($userinfo['portrait'])
                            <img src="/uploads/{{$userinfo['portrait']}}" style="width: 75px;height: 75px;">
                        @else
                            <img src="/Picture/head80.png">
                       @endif
                    </div>
                    <div class="info">
                        @if($userinfo['nickname'])
                            <span class="left">{{$userinfo['nickname']}}</span>
                        @else
                            <span class="left"><a target='_blank' href="/home/user/{{$user['uid']}}/edit" >暂无昵称</a></span>
                        @endif
                        <span class="right">
                            <font></font>
                            <a target='_blank' href=""></a></span>
                        <span class="left"><font>灰鹤信用：<i>{{$userinfo['score']}}</i></font></span>
                        <span class="left"><font>手机认证：<i>@if ($user['phone']) 已认证 @else 未认证 @endif</i></font></span>
                        <span class="left"><font>实名认证：<i>@if ($userinfo['isTrue'] == 0) 未认证 @else 已认证 @endif</i></font></span>
                        <span class="left"><font><a href="/home/user/pass" class="pass">修改密码</a></font></span>
                        <span class="left"><font><a href="/home/user/addr" class="pass">收货地址</a><i></i></font></span>
                    </div>
                    <div class="clear">&nbsp;</div>
                    <div class="btn clearfix">
                        <a href="/home/user/{{$user['uid']}}/edit" id='showMoney' class="balance" style="position: relative;left:-10px;">修改信息</a>
                    </div>
                </div>
                <div class="y-center-notice-box">
                    <div class="y-center-notice-btn">
                        <ul class="clearfix">
                            <li>帮助</li>
                        </ul>
                    </div>
                    <div class="y-center-notice is_show" style="display: block;">
                        <ul>
                            <li><a target="_blank" href="http://2.fengniao.com/recycle">【灰鹤发布】快捷发布，简单便利</a><font>05-06</font></li>
                            <li><a target="_blank" href="http://2.fengniao.com/active/routine">【灰鹤质保】购买全程交易保护</a><font>05-24</font></li>
                            <li><a target="_blank" href="http://2.fengniao.com/service">【灰鹤二手】最全种类，及时跟新</a><font>05-24</font></li>
                            <li><a target="_blank" href="http://2.fengniao.com/auction">【灰鹤提醒】天天抢拍，时时捡漏</a><font>05-24</font></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="y-center-home-box mtop20">
                <div class="y-center-block-box y-center-security-service">
                    <span class="title"><font>您的安全服务</font></span>
                        <p>账户安全等级 {{$safeScore}}分
                            @switch ($safeScore)
                                @case(2.5)
                                    <font><i style="width:51.2px;">&nbsp</i></font>
                                    <b>请验证您的信息，提高账户安全！</b>
                                @break
                                @case(5)
                                    <font><i style="width:102.5px;">&nbsp</i></font>
                                    <b>请验证您的信息，提高账户安全！</b>
                                @break
                                @case(7.5)
                                    <font><i style="width:153.8px;">&nbsp</i></font>
                                    <b>请验证您的信息，提高账户安全！</b>
                                @break
                                @case(10)
                                    <font><i style="width:205px;">&nbsp</i></font>
                                    <b>您的账户很安全！</b>
                                @break
                            @endswitch
                        </p>
                    <ul>
                        @if ($userinfo['isTrue'] == 0)
                            <li class="no">
                                <font>未设置</font>
                                <font>身份验证</font>
                                <b>用于提升账号的安全性和信任级别。</b>
                                <a target="_blank" href="/home/user/create">设置</a>
                            </li>
                        @else
                            <li>
                                <font>已完成</font>
                                <font>身份验证</font>
                                <b>用于提升账号的安全性和信任级别。</b>
                                <a target="_blank" href="/home/user/create">查看</a>
                            </li>
                        @endif

                        @if ($user['phone'])
                            <li>
                                <font>已完成</font>
                                <font>手机绑定</font>
                                <b>绑定手机后，您可以享受灰鹤服务如手机登录等。</b>
                                <a target="_blank" href="/home/user/{{$user['uid']}}/edit">查看</a>
                            </li>
                        @else
                            <li class="no">
                                <font>未设置</font>
                                <font>手机绑定</font>
                                <b>绑定手机后，您可以享受灰鹤服务如手机登录等。</b>
                                <a target="_blank" href="/home/user/{{$user['uid']}}/edit">设置</a>
                            </li>
                        @endif

                        @if ($user['email'])
                            <li>
                                <font>已完成</font>
                                <font>邮箱验证</font>
                                <b>绑定邮箱可以提高账户安全等级。</b>
                                <a target="_blank" href="/home/user/{{$user['uid']}}/edit">查看</a>
                            </li>
                        @else
                            <li class="no">
                                <font>未设置</font>
                                <font>邮箱验证</font>
                                <b>绑定邮箱可以提高账户安全等级。</b>
                                <a target="_blank" href="/home/user/{{$user['uid']}}/edit">设置</a>
                            </li>
                        @endif

                        @if ($userinfo['payPass'])
                            <li>
                                <font>已完成</font>
                                <font>交易密码</font>
                                <b>设置交易密码，可购买商品等。</b>
                                <a target="_blank" href="/home/user/paypass">修改</a>
                            </li>
                        @else
                            <li class="no">
                                <font>未设置</font>
                                <font>交易密码</font>
                                <b>设置交易密码，可购买商品等。</b>
                                <a target="_blank" href="/home/user/paypass">设置</a>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>

<script type="text/javascript">
//初始化数据
var ajax_url = "/goods/ajax" ;  //通用ajax url
var money_url = '/user/getUserMoney';
var guideType = 'home';
var order_url = "/order/orderajax";
</script>
    </div>
</div>
@endsection
@extends('home.common.user_home')

@section('content')
        <div class="y-center-main-right home mtop20">
            <div class="y-center-home-box">
                <div class="y-center-info">
                    <div class="head"><a target='_blank' href="/10820479/credit.html" ><img src="/Picture/head80.png"></a></div>
                    <div class="info">
                        <span class="left"><a target='_blank' href="/10820479/credit.html" >{{$userinfo->nickname}}</a></span>
                        <span class="right">
                            <font></font>
                            <a target='_blank' href=""></a></span>
                        <span class="left"><font>信誉度：<i>{{$userinfo->score}}</i></font></span>
                        <span class="left"><font>手机认证：<i>@if ($user->phone) 已认证 @else 未认证 @endif</i></font></span>
                        <span class="left"><font>实名认证：<i>@if ($userinfo->isTrue == 0) 未认证 @else 已认证 @endif</i></font></span>
                        <span class="left"><font>收货地址：<i></i></font></span>
                    </div>
                    <div class="clear">&nbsp;</div>
                    <div class="btn clearfix">

                        {{--<font id='money' money="0.00" class="balanceNum" style="display: none;">0.00元</font>--}}
                        <a href='{{url("/home/user/{$user->uid}/edit")}}' id='showMoney' class="balance">修改信息</a>
                        {{--<a href="/user/withdraw">提现</a>--}}
                    </div>
                </div>
                <div class="y-center-notice-box">
                    <div class="y-center-notice-btn">
                        <ul class="clearfix">
                            <li>帮助</li>
                        </ul>
                        {{--<a target="_blank" href="/help/index">更多</a>--}}
                    </div>
                    <div class="y-center-notice is_show" style="display: block;">
                        <ul>
                            <li><a target="_blank" href="http://2.fengniao.com/recycle">【发布商品】</a><font>05-06</font></li>
                            <li><a target="_blank" href="http://2.fengniao.com/active/routine">【灰鹤鉴定】购买经过鉴定的二手器材</a><font>05-24</font></li>
                            <li><a target="_blank" href="http://2.fengniao.com/service">【灰鹤维修】专业摄影器材维修，资深工程师一对一服务</a><font>05-24</font></li>
                            <li><a target="_blank" href="http://2.fengniao.com/auction">【灰鹤拍卖】天天抢拍，时时捡漏</a><font>05-24</font></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="y-center-home-box mtop20 switch-tab J_switchTab">
                <ul class="switch-nav clearfix">
                    <li class="J_item current-item" rel="indexTab1-1"><span class="item-text">我的订单</span></li>

                </ul>
                <div id="indexTab1-1" class="J_tabPanel" style="display: block;">
                     <ul class="y-center-links index-tab-links">
                        <li class="obligation"><a href="/user/buy?status=1">待付款<i>(0)</i></a></li>
                        <li class="deliver"><a href="/user/buy?status=2">待发货<i>(0)</i></a></li>
                        <li class="consignment"><a href="/user/buy?status=3">发货中<i>(0)</i></a></li>
                        <li class="evaluate"><a href="/user/buy?status=4">已成交<i>(0)</i></a></li>
                        <li class="refund"><a href="/user/buy?status=5">退款中<i>(0)</i></a></li>
                    </ul>
                </div>
                <div id="indexTab1-2" class="J_tabPanel" style="display: none;">
                     <ul class="y-center-links index-tab-links">
                        <li class="obligation"><a href="/user/soldgoods?status=1">待付款<i>(0)</i></a></li>
                        <li class="deliver"><a href="/user/soldgoods?status=2">待发货<i>(0)</i></a></li>
                        <li class="consignment"><a href="/user/soldgoods?status=3">发货中<i>(0)</i></a></li>
                        <li class="evaluate"><a href="/user/soldgoods?status=4">已成交<i>(0)</i></a></li>
                        <li class="refund"><a href="/user/soldgoods?status=5">退款中<i>(0)</i></a></li>
                    </ul>
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
                        @if ($userinfo->isTrue == 0)
                            <li class="no">
                                <font>未设置</font>
                                <font>身份验证</font>
                                <b>用于提升账号的安全性和信任级别。</b>
                                <a target="_blank" href="">设置</a>
                            </li>
                        @else
                            <li>
                                <font>已完成</font>
                                <font>身份验证</font>
                                <b>用于提升账号的安全性和信任级别。</b>
                                <a target="_blank" href="">查看</a>
                            </li>
                        @endif

                        @if ($user->phone)
                            <li>
                                <font>已完成</font>
                                <font>手机绑定</font>
                                <b>绑定手机后，您可以享受灰鹤服务如手机登录等。</b>
                                <a target="_blank" href="">查看</a>
                            </li>
                        @else
                            <li class="no">
                                <font>未设置</font>
                                <font>手机绑定</font>
                                <b>绑定手机后，您可以享受灰鹤服务如手机登录等。</b>
                                <a target="_blank" href="">设置</a>
                            </li>
                        @endif

                        @if ($user->email)
                            <li>
                                <font>已完成</font>
                                <font>邮箱验证</font>
                                <b>绑定邮箱可以提高账户安全等级。</b>
                                <a target="_blank" href="">查看</a>
                            </li>
                        @else
                            <li class="no">
                                <font>未设置</font>
                                <font>邮箱验证</font>
                                <b>绑定邮箱可以提高账户安全等级。</b>
                                <a target="_blank" href="">设置</a>
                            </li>
                        @endif

                        @if ($userinfo->prcid)
                            <li>
                                <font>已完成</font>
                                <font>交易密码</font>
                                <b>设置交易密码，可购买商品等。</b>
                                <a target="_blank" href="">查看</a>
                            </li>
                        @else
                            <li class="no">
                                <font>未设置</font>
                                <font>交易密码</font>
                                <b>设置交易密码，可购买商品等。</b>
                                <a target="_blank" href="">设置</a>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>

            {{--<div class="y-center-home-box mtop20">
                <div class="y-center-block-box y-center-fast">
                <span class="title">
                    <font>
                        快速入口
                    </font>
                </span>
                    <ul>
                        <li>
                            <dl>
                                <dt>
                                    我的二手
                                </dt>
                                <dd>
                                    <a target="_blank" href="/user/news?type=0">
                                        消息中心
                                    </a>
                                </dd>
                                <dd>
                                    <a target="_blank" href="/user/myWallet">
                                        我的钱包
                                    </a>
                                </dd>
                                <dd>
                                    <a target="_blank" href="/user/comment">
                                        我的评价
                                    </a>
                                </dd>
                                <dd>
                                    <a target="_blank" href="/user/withdraw">
                                        我要提现
                                    </a>
                                </dd>
                                <dd>
                                    <a target="_blank" href="/user/coupon">
                                        我的优惠券
                                    </a>
                                </dd>
                            </dl>
                        </li>
                        <li>
                        </li>
                        <li>
                            <dl>
                                <dt>
                                    我是买家
                                </dt>
                                <dd>
                                    <a target="_blank" href="/user/buy">
                                        已买到的商品
                                    </a>
                                </dd>
                                <dd>
                                    <a target="_blank" href="/user/auction?type=0">
                                        我参与的拍卖
                                    </a>
                                </dd>
                                <dd>
                                    <a target="_blank" href="/user/buyerOffer?type=9">
                                        我的出价
                                    </a>
                                </dd>
                                <dd>
                                    <a target="_blank" href="/user/collect?type=0">
                                        我的收藏
                                    </a>
                                </dd>
                                <dd>
                                    <a target="_blank" href="/user/history">
                                        浏览历史
                                    </a>
                                </dd>
                            </dl>
                        </li>
                        <li>
                            <dl>
                                <dt>
                                    我是卖家
                                </dt>
                                <dd>
                                    <a target="_blank" href="/user/myGoods?status=0">
                                        我发布的商品
                                    </a>
                                </dd>
                                <dd>
                                    <a target="_blank" href="/user/soldgoods">
                                        已卖出的商品
                                    </a>
                                </dd>
                                <dd>
                                    <a target="_blank" href="/user/sellerOffer">
                                        议价请求
                                    </a>
                                </dd>
                            </dl>
                        </li>
                        <li>
                            <dl>
                                <dt>
                                    个人设置
                                </dt>
                                <dd>
                                    <a target="_blank" href="/user/address">
                                        收货地址管理
                                    </a>
                                </dd>
                                <dd>
                                    <a target="_blank" href="/user/setting?act=index">
                                        个人信息设置
                                    </a>
                                </dd>
                                <dd>
                                    <a target="_blank" href="/user/store">
                                        店铺信息设置
                                    </a>
                                </dd>
                            </dl>
                        </li>
                    </ul>
                </div>
            </div>--}}
        </div>
{{--<div id="userMoneylog" class="y-center-alert" style="display: none;">--}}
	{{--<div class="content">--}}
        {{--<p class="word2">请输入交易密码：<input id='pwd' type="password" class="text6" /></p>--}}
        {{--<p class="forgetPassword"><a href="/user/setting?act=password" class="forgetPassword">找回密码？</a></p>--}}
    {{--</div>--}}
{{--</div>--}}

<!-- //deleteGoodsDialog -->
{{--
<div id="errorTipDialog" style="display: none;text-align: center;padding-top:15px;">
	<p>加载中...</p>
</div>
--}}

{{--<div id="setPassWordBox" style="display: none;" title="确认收货">
	<div style='margin-top: 15px; text-align: center;'>
		您尚未设置交易密码，确认收货需要设置交易密码
	</div>
</div>--}}

{{--<div class="y-center-guide">
    <div class="y-center-guide-bg">&nbsp;</div>
    <div class="y-center-guide1">
        <img src="/Picture/y_center_guide_index1.png" />
        <a href="javascript:;" class="close">关闭</a>
        <a href="javascript:;" class="next">下一步</a>
    </div>
    <div class="y-center-guide2">
        <img src="/Picture/y_center_guide_index2.png" />
        <a href="javascript:;" class="close">关闭</a>
        <a href="javascript:;" class="next">下一步</a>
    </div>
    <div class="y-center-guide3">
        <img src="/Picture/y_center_guide_index3.png" />
        <a href="javascript:;" class="close">关闭</a>
        <a href="javascript:;" class="next">下一步</a>
    </div>
    <div class="y-center-guide4">
        <img src="/Picture/y_center_guide_index4.png" />
        <a href="javascript:;" class="close">关闭</a>
        <a href="javascript:;" class="next">下一步</a>
    </div>
    <div class="y-center-guide5">
        <img src="/Picture/y_center_guide_index5.png" />
        <a href="javascript:;" class="close">关闭</a>
        <a href="javascript:;" class="next">下一步</a>
    </div>
    <div class="y-center-guide6">
        <img src="/Picture/y_center_guide_index6.png" />
        <a href="javascript:;" class="close">关闭</a>
        <a href="javascript:;" class="next">下一步</a>
    </div>
    <div class="y-center-guide7">
        <img src="/Picture/y_center_guide_index7.png" />
        <a href="javascript:;" class="close">关闭</a>
        <a href="javascript:;" class="next">下一步</a>
    </div>
    <div class="y-center-guide8">
        <img src="/Picture/y_center_guide_index8.png" />
        <a href="javascript:;" class="close">关闭</a>
        <a href="javascript:;" class="next">下一步</a>
    </div>
</div>--}}
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
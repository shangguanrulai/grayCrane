<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <title>提交订单</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <meta name="renderer" content="webkit">
    <meta name="csrf-param" content="_csrf">
    <meta name="csrf-token" content="eFdSNkY4VloRBxd8KUovDE4YBXN.fxs1Aj47DwdROz86GCNldmsbAA==">
    <meta http-equiv="mobile-agent" content="format=html5; url=http://m.2.fengniao.com/"/>
        <link href="/Content/globalceiling.css" rel="stylesheet">
<link href="/Content/jquery-ui.1.11.4.min.css" rel="stylesheet">
<link href="/Content/jquery.bxslider.css" rel="stylesheet">
<link href="/Content/header.css" rel="stylesheet">
<link href="/Content/secondarytradingpublic.css" rel="stylesheet">
<link rel="stylesheet" href="/layui/css/layui.css">
<link href="/Content/secondarytradingorder.css" rel="stylesheet" 0="frontend\assets\BaseAsset">
<script src="/Scripts/jquery-3.2.1.js" charset="UTF-8"></script>
<script src="/Scripts/jqueryui.1.11.4.js" charset="UTF-8"></script>
<script src="/Scripts/jquery.bxslider.min.js" charset="UTF-8"></script>
<script src="/Scripts/jquery.tinyscrollbar.2.4.2.min.js" charset="UTF-8"></script>
<script src="/Scripts/im.js" charset="UTF-8"></script>
<script src="/Scripts/globalceiling.js" charset="UTF-8"></script>
<script src="/Scripts/md5.js" charset="UTF-8"></script>
<!-- <script src="/Scripts/common.js" charset="UTF-8"></script> -->
<script src="/Scripts/global.js" charset="UTF-8"></script>
<script src="/Scripts/swfobject.js" charset="UTF-8"></script> 
    <link rel="stylesheet" id="WideGoodsSheet" rel="stylesheet">
    <script>
        if (!$.support.leadingWhitespace || /msie 9/.test(navigator.userAgent.toLowerCase())) {
            document.documentElement.className += ' lowIE';
        }

          
     </script>
</head>
<body>

    <!-- header -->
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
<br />
        <div class="wrapper clearfix">
            <div class="logo">
    <a title="蜂鸟网--二手交易" href="/?click_source=logo"><img src="/Picture/logov2.png" alt="蜂鸟网--二手交易"></a>
</div>
            

        </div>
    
    <div class="wrapper-box">
            <ul class="order-steps clearfix">
                <li class="current">
                    <i class="line"></i>
                    <span class="num">1</span>
                    <span class="text">1.买家下单</span>
                </li>
                <li>
                    <i class="line"></i>
                    <span class="num">2</span>
                    <span class="text">2.买家付款</span>
                </li>
                <li>
                    <i class="line"></i>
                    <span class="num">3</span>
                    <span class="text">3.卖家发货</span>
                </li>
                <li>
                    <i class="line"></i>
                    <span class="num">4</span>
                    <span class="text">4.买家确认</span>
                </li>
                <li>
                    <i class="line"></i>
                    <span class="num">5</span>
                    <span class="text">5.双方评价</span>
                </li>
            </ul>
            <div class="wrapper">
           		<!-- order-confirm-box -->
                <div class="order-confirm-box">
                    <ul class="order-parameter">
                        <li class="parameter-item">
                            <div class="parameter-header">
                <!--                 <span id="addAddressButton" class="add-address">新增收货地址</span> -->
                                <h3 class="parameter-title">核对收货人信息</h3>
                            </div>
                            <div class="parameter-content">
                                <div id="addressBox" class="address-box">
                                <ul id="addressList" class="address-list">
                                	                                	                                		<li addressId='13802' class="address-item clearfix ">
	                                        <div class="address-tag" style='width:50px'>
		                                        <span class="name-tag">{{ $users['nickname'] }}</span>
		  
		                                        <i class="icon"></i>
	                                        </div>
	                                        <div class="address-summary">
	                                        	<div class="option-box">
			                                    	<span addressId='13802' class="delete-link">删除</span>
			                                    	<span addressId='13802' class="edit-link">编辑</span>
			                                    	<span addressId='13802' class="set-default">设为默认</span>
		                                    	</div>   
		                                        <span class="name-tag" >{{ $address['rec'] }}</span>  
		                                        <span class="province-tag">{{ $address['addr'] }}</span> 
		                            
		                                        <span class="mobile-tag">{{ $address['phone'] }}</span>  
		                                        <span class="email-tag"></span>
	                                        </div>
	                                    </li>
                                	                                </ul>
                            </div>
                        </li>
                        <li class="parameter-item">
                        	<div class="parameter-header"> 
                                <h3 class="parameter-title">确认订单信息</h3>
                            </div>
                            <div class="parameter-content">
                                <div class="order-detail">
                                    <!-- <div class="contact-bar clearfix">
                                        <span class="seller-tag">卖家：蜂鸟鉴定</span><span data-title="98新 富士 X-E2s #1047" data-url="/secforum/3264483.html" class="contact-tag sendPrivateLetterBtn" userId='10337863' >与TA联系</span>
                                    </div> -->
                                    <div class="order-header clearfix">
                                        <span class="cell-1">商品信息</span>
                                        <span class="cell-2">单价</span>
                                        <span class="cell-3">数量</span>
                                        <span class="cell-4">小计</span>
                                    </div>
                                    <ul id="goodList" class="good-list">
                                                                                                                                    <li class="goods-item clearfix" goodsid="0" >
                                                    <span class="goods-avator"><img src="/uploads/{{ $goods['gpic'] }}" alt=""></span>
                                                    <div class="goods-title-box">
                                                        <a href="JavaScript:;" target="_blank" class="goods-title">
															 {{ $goods['gname'] }}																																																<img src="/Picture/cg-4kljds_-izehzaaai0bdorqgaafcoqp-qxuaaajo174.jpg" >
																																	<!-- <img src="/Picture/cg-40ljfvraiozgiaaah1ddf758aadppqdgfwyaaaft874.jpg" >
                                                                                                                                    <img src="/Picture/f2201797f20c5a6f2a54944affff765b.jpg" > -->
																																													</a>
                                                        <span class="goods-subTitle">{{ $goods['title'] }}</span>
                                                    </div>
                                                    <div class="goods-price-box">
                                                                                                                    
                                                            <span class="price promotion-price">&yen;{{ $goods['newprice'] }}</span>
                                                                                                            </div>
                                                    <div class="goods-counter-box">
                                                        X 1
                                                    </div>
                                                    <div class="goods-total-box">&yen;{{ $goods['newprice'] }}</div>
                                                </li>
                                                                                                                        </ul>
                                    <div class="sellout-layerbox" style="display:none;">
                                        <p>哎呀下手慢了！商品被抢光了~再看看其他商品吧</p>
                                        <a href="/secforum/3264483.html" class="countdown-bar"><span>5</span>秒后跳转回详情页</a>
                                    </div>
                                </div>
                                <div class="total-price">
                                    <span>已优惠：<strong id='privilege' price='0'>&yen;0.00</strong></span>
                                    <span>应付总计：<strong id='totalprice' totalprice='2599.00'>&yen;{{ $goods['newprice'] }}</strong></span>
                                </div>
                            </div>
                        </li>
                    </ul>
                    <div class="extra-box clearfix">
                    	<div class="address-summary">
                    		<div class="address-inner">
	                    		<span class="price"><span class="goods-count">1件商品</span>实付总计：<strong id='realityprice'>&yen;{{ $goods['newprice'] }}</strong></span>
	                    		<ul class="address">
	                    			<li class="address-item">寄送至:{{ $address['addr'] }}</li>
	                    			<li class="address-item"><span>手机号:{{ $address['phone'] }}</span><span>收货人:{{ $address['rec'] }}</span></li>
	                    		</ul>
                    		</div> 
                            <form action="/home/goods/pay" method='get'>
                                <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                                <input type="hidden" name='rid' value = "{{ $goods['rid'] }}" >
                                <input type="hidden" name='buyid' value = "{{ $users['uid'] }}" >
                                <input type="hidden" name='price' value = "{{ $goods['newprice'] }}" >
                    		<input id='ordersubmit' type="submit" class="submit-button" value="提交订单">
                            
                    	</div>

                    	<ul class="pay-items">
                    		<li class="pay-item clearfix">
                    			<span class="item-title">给卖家留言</span>
                    			<textarea id='message' name='omsg'></textarea>
                			</li>	
                    		<li class="pay-item clearfix">
                    			<span class="item-title">优惠券</span>
                    			<select name="" id="coupon">
                    				<option money="0.00" value="0">请选择您要使用的优惠券</option>
                    			</select>
                			</li>	
                    		<li class="pay-item deduction-item clearfix">
                    			<span class="item-title">积分抵扣</span>
<!--                     			<span class="item-text">目前积分剩余2334,可抵扣23.34元 </span> -->
                    			<span class="tip">（积分中心即将上线，敬请期待）</span>
                			</li>	
                    	</ul>
                        </form>

                    </div>
                </div>
				<!-- //order-confirm-box -->

				<!-- addressAddDialog -->
				<div id="addressAddDialog" class="address-layerbox" style="display: none;">
					<ul class="address-items">
						<li class="address-item clearfix">
							<span class="item-title"><i class='star'>*</i>收货人</span>
							<input id='consignee' type="text" class="receiver-text">
							<span class="tip" style='display: none;' >请您填写收货人的姓名 2-25个字</span>
						</li>
						<li class="address-item clearfix">
							<span class="item-title"><i class='star'>*</i>所在地区</span>
							<select name="" id="province">
								<option value="0">省/直辖市</option>
							</select> 
							<select name="" id="city">
								<option value="0">市/县/区</option>
							</select>
							<span class="tip" style='display: none;' >请您填写完整的地区信息</span>
						</li>
						<li class="address-item clearfix">
							<span class="item-title"><i class='star'>*</i>详细地区</span>
							<input id='address' type="text" class="street-text">
							<span class="tip" style='display: none;' >请您填写收货人的地址 5-120个字</span>
						</li>
						<li class="address-item clearfix">
							<span class="item-title"><i class='star'>*</i>手机号码</span>
							<input id='phone_mob'  type="text" class="mobile-text">
							<span class="tip" style='display: none;' >请您填写收货人手机号码  11个数字</span>
						</li>
						<li class="address-item clearfix">
							<span class="item-title">固定电话</span>
							<input id='phone_tel' type="text" class="email-text">
							<span class="tip" style='display: none;' >固定电话 6-20个数字和-</span> 
						</li>
						<li class="address-item clearfix">
							<span class="item-title">邮编</span>
							<input id='zipcode' type="text" class="email-text">
							<span class="tip" style='display: none;' >邮编 1-10个数字</span> 
						</li>
						 
					</ul>
				</div>
		    	<!-- //addressAddDialog -->

		    	<!-- addressModifyDialog -->
				<div id="addressModifyDialog" class="address-layerbox" style="display: none;">
					<ul class="address-items">
						<li class="address-item clearfix">
							<span class="item-title"><i class='star'>*</i>收货人</span>
							<input id='mconsignee' type="text" class="receiver-text" value="闪电侠123">
							<span class="tip" style='display: none;' >请您填写收货人的姓名 2-25个字</span>
						</li>
						<li class="address-item clearfix">
							<span class="item-title"><i class='star'>*</i>所在地区</span>
							<select name="" id="mprovince">
								<option value="0">省/直辖市</option>
							</select> 
							<select name="" id="mcity">
								<option value="0">市/县/区</option>
							</select>
							<span class="tip" style='display: none;' >请您填写完整的地区信息</span>
						</li>
						<li class="address-item clearfix">
							<span class="item-title"><i class='star'>*</i>详细地区</span>
							<input id='maddress' type="text" class="street-text" value="安定门街道交道口北头条88号乙">
							<span class="tip" style='display: none;' >请您填写收货人的地址 5-120个字</span>
						</li>
						<li class="address-item clearfix">
							<span class="item-title"><i class='star'>*</i>手机号码</span>
							<input id='mphone_mob' type="text" class="mobile-text" value="010-68368431">
							<span class="tip" style='display: none;' >请您填写收货人手机号码  11个数字</span>
						</li>
						<li class="address-item clearfix">
							<span class="item-title">固定电话</span>
							<input id='mphone_tel' type="text" class="email-text" value="010-68368431">
							<span class="tip" style='display: none;' >固定电话 6-20个数字和-</span>
						</li>
						<li class="address-item clearfix">
							<span class="item-title">邮编</span>
							<input id='mzipcode' type="text" class="email-text" value="100089"> 
							<span class="tip" style='display: none;' >邮编 1-10个数字</span>
						</li> 
					</ul>
				</div>
				<!-- //addressModifyDialog -->
				
				<!-- deleteAddressDialog -->
				<div id="deleteAddressDialog" class="delete-layerbox" style="display: none;">
					<p>您确定要删除此地址信息么？</p>
				</div>
				<!-- //deleteAddressDialog -->

				<!-- deleteGoodsDialog -->
				<div id="deleteGoodsDialog" class="delete-layerbox" style="display: none;">
					<p>您确定要从订单中删除此商品么？</p>
				</div>
				<!-- //deleteGoodsDialog -->
				<div id="errorTipDialog" style="display: none;text-align: center;padding-top:15px;">
					<p>加载中...</p>
				</div>
            </div>
        </div>
<script>
	var city_url = '/goods/ajax';
	var ajax_url = '/order/ajax';
	var main_goodsid = '3264483';
    var main_goods_url = '/secforum/3264483.html';
	var coupontype = 0;
    var isNew = 0;


	</script>    <!-- foot -->
    
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
                        <li><span class="link">蜂鸟客服介入</span></li>
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
                    <li><a rel="nofollow" target="_blank" href="/help/detail?id=386">蜂鸟鉴定</a></li>
                    <li><a rel="nofollow" target="_blank" href="/help/detail?id=319">蜂鸟回收</a></li>
                    <li><a rel="nofollow" target="_blank" href="/help/detail?id=336">蜂鸟拍卖</a></li>
                    <li><a rel="nofollow" target="_blank" href="/help/detail?id=387">卖家帮助</a></li>
                </ul>
            </li>
        </ul>
        <div class="foot-QR-code">
            <span class="pic"><img src="/Picture/wechat.jpg" alt="" width="80" height="80"></span>
            <strong>蜂鸟二手官方微信</strong>
            <p>扫描二维码<br />即刻与蜂鸟二手亲密互动</p>
        </div>
    </div>
    
    
<div class="footer-copyright">
    <div class="wrapper">
        <div class="site-map">
            <a rel="nofollow" href="http://www.fengniao.com/about.html" target="_blank">蜂鸟简介</a>
            <a rel="nofollow" href="http://www.fengniao.com/contact.html" target="_blank">联系我们</a>
            <a rel="nofollow" href="http://www.fengniao.com/sitelinks.php" target="_blank">友情链接</a>
            <a rel="nofollow" href="http://www.fengniao.com/zhaopin.html" target="_blank">招聘信息</a>
            <a rel="nofollow" href="http://www.fengniao.com/law.html" target="_blank">用户服务协议</a>
            <a rel="nofollow" href="http://www.fengniao.com/copyright.html" target="_blank">隐私权声明</a>
            <a rel="nofollow" href="http://www.fengniao.com/shengming.html" target="_blank">法律投诉声明</a>
        </div>

        <div class="copyright">&copy;
            <script type="text/javascript">var myDate = new Date();document.write(myDate.getFullYear());</script>fengniao.com. All rights reserved . 北京蜂鸟映像电子商务有限公司（蜂鸟网）<br />版权所有 京ICP证150110号
        </div>
    </div>
</div>
<!--<script type="text/javascript" src="/Scripts/msg.js"></script>-->
    
</div>
<!-- //footer-box -->        <div id="commonLoginDialog" style="display: none;" class="commonLogin-dialog clearfix">
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
                    <a target="_blank" href="http://my.fengniao.com/user/login-third-party?id=1&url=http%3A%2F%2F2.fengniao.com%2Forder%2Fadd%2F3264483" class="sina-link">新浪</a>
                    <a target="_blank" href="http://my.fengniao.com/user/login-third-party?id=2&url=http%3A%2F%2F2.fengniao.com%2Forder%2Fadd%2F3264483" class="wechat-link">微信</a>
                    <a target="_blank" href="http://my.fengniao.com/user/login-third-party?id=3&url=http%3A%2F%2F2.fengniao.com%2Forder%2Fadd%2F3264483" class="QQ-link">QQ</a>
                </dd>
            </dl>
        </li>
        <li id="otherLoginDialog" class="commonLoginDialog-form otherLogin-dialog" style="display: none;">
            <div class="commonLogin-header">
                <h3 class="commonLogin-title">其他登录方式</h3>
                <p class="commonLogin-sub-title">推荐使用<span class="scan-wechat-link">微信扫码</span>登录，安全快捷</p>
            </div>
            <div class="other-login clearfix">
                <a target="_blank" href="http://my.fengniao.com/user/login-third-party?id=1&url=http%3A%2F%2F2.fengniao.com%2Forder%2Fadd%2F3264483" class="login-link link-sina">新浪微博</a>
                <a href="javascript:;" class="login-link link-scan-wechat">腾讯微信</a>
                <a target="_blank" href="http://my.fengniao.com/user/login-third-party?id=3&url=http%3A%2F%2F2.fengniao.com%2Forder%2Fadd%2F3264483" class="login-link link-QQ">腾讯QQ</a>
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
                    <span class="commonLogin-tip high-tip">注意：如果您已注册过蜂鸟账号，请确认该手机号和账号是否做了绑定，否则系统将自动创建新账号。</span>
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
<div id="commonLoginPopupCaptcha"></div>        <script language="JavaScript" type="text/javascript" src="/Scripts/pv.js"></script>
<script>
    var _hmt = _hmt || [];
    (function () {
        var hm = document.createElement("script");
        hm.src = "//hm.baidu.com/hm.js?916ddc034db3aa7261c5d56a3001e7c5";
        var s = document.getElementsByTagName("script")[0];
        s.parentNode.insertBefore(hm, s);
    })();
</script><script src="/Scripts/gt.js"></script>
<!-- <script src="/Scripts/order.js" 0="frontend\assets\BaseAsset" language="javascript" charset="UTF-8"></script> -->
<!-- <script src="/Scripts/add.js" 0="frontend\assets\BaseAsset" language="javascript" charset="UTF-8"></script> -->
<!-- <script src="/Scripts/coupon.js" 0="frontend\assets\BaseAsset" language="javascript" charset="UTF-8"></script></body> -->
</html>

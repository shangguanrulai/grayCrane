<!DOCTYPE html>
<html>
<head lang="zh-CN">
    <meta charset="UTF-8">
    <meta name="renderer" content="webkit"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <title>蜂鸟登录</title>
    <link rel="shortcut icon" href="https://my.fengniao.com/icon/images/favicon.ico"/>
    <link rel="bookmark" href="https://my.fengniao.com/icon/images/favicon.ico"/>
    <meta name="description" content=""/>
    <meta name="keywords" content=""/>
    <link rel="stylesheet" href="/Content/header-footer.css"/>
    <link rel="stylesheet" href="/Content/register-login.css"/>
    <script>
        var project_domain = 'https://my.fengniao.com/';
    </script>
    <script src="/Scripts/jquery-1.7.1.min.js"></script>
    <script type="text/javascript" src="/Scripts/function.js"></script>
    <script src="/Scripts/main.js"></script>
    <script src="/Scripts/md5.js"></script>
    <script src="/Scripts/jquery.cookie.js"></script>
    <script src="/Scripts/gt.js"></script>
	<script src="/layer/layer.js"></script>
</head>
<body>

<div id="box" class="wrapper wrapper-box">

    <div class="login" id="login">
        <!--logo-->
        <!--logo这里的行内样式是在输入错3次之后出现验证码时使用，如果没有验证码去掉行内样式-->
        <a href="#" class="logo" style="margin: 20px 0;">蜂鸟网</a>
        <!--logo-->
        <!--content-->
         <!--<div class="hint"><a href="javascript:;" class="messagelogin" id="changeMessageLogin">短信快捷登录</a></div>-->
		 <form action="{{ url('Home/dologin') }}" method="post" >
		@if (count($errors) > 0)
						<div class="alert alert-danger">
							<ul>
								@if(is_object($errors))
									@foreach ($errors->all() as $error)
										<li style="color:red;font-family:Microsoft YaHei">{{ $error }}</li>
										@endforeach
									@else
											<li style="color:red;font-family:Microsoft YaHei">{{ $errors }}</li>
									@endif
								</ul>
							</div>
						@endif
        <div class="username">
		
		{{--激活成功的提示--}}
						@if (!empty(session('msg')))
							<div class="alert alert-danger">
								<ul>
									<li style="color:red">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ session('msg') }}</li>
								</ul>
							</div>
						@endif
	
            <span>
                <input type="text" class="text-username" name='uname' placeholder="手机号/用户名/邮箱" id="name" autocomplete="off"/>
            </span>
            <div class="hint-word">请您填写登录名</div>
        </div>
        <div class="password">
            <span>
                <input type="password" name='upass' class="text-password" placeholder="请输入密码" id="password" autocomplete="off"/>
            </span>
            <div class="hint-word">请您填写密码</div>
        </div>
		
		 <div class="code" style="margin-top:20px;margin-bottom:20px">
            <span>
		<input class="yanzhengma" name="yzm" lay-verify="required" placeholder="请输入验证码"  type="text"  style="width:200px;height:40px;float:left;">
           <img src="{{ url('Home/yzm') }}" onclick="this.src='{{ url('Home/yzm') }}?'+Math.random()" alt="" style="width:150px;height:50px;float:right">


            <!-- <img src="{{ url('Home/yzm') }}" id="127ddf0de5a04167a9e427d883690ff6" onClick="this.src=this.src+'?'">  --> 
			
			
			
        </div>
		{{ csrf_field() }}
        <div class="verification-box" style="display: none;" id="verification">
            <div class="verification">
                <span class="short"><input type="text" class="text-short" id="code" autocomplete="off"></span>
            </div>
        </div>
        <input type="submit" class="login-sunmit" value="立即登录" id="toLogin">
        <div class="noID">还没有账号？<a href="https://my.fengniao.com/register.php">立即注册</a></div>
        <div class="other-login">
            <span>其他登录方式：</span>
            <a href="https://my.fengniao.com/loginThirdParty.php?id=1&url=http://2.fengniao.com/user/buy?click_source=topbar" class="weibo">微博</a>
            <a href="https://my.fengniao.com/loginThirdParty.php?id=2&url=http://2.fengniao.com/user/buy?click_source=topbar" class="weixin">微信</a>
            <a href="https://my.fengniao.com/loginThirdParty.php?id=3&url=http://2.fengniao.com/user/buy?click_source=topbar" class="qq">QQ</a>
        </div>
        <!--content-->
    </div>

    <div class="login loginMessage" id="loginMessage" style="display:none;">
        <!--logo-->
        <!--logo这里的行内样式是在输入错3次之后出现验证码时使用，如果没有验证码去掉行内样式-->
        <a href="http://www.fengniao.com" class="logo" style="margin: 20px 0;">蜂鸟网</a>
        <!--logo-->
        <!--content-->
        <div class="hint-message">注意：如果您已注册过蜂鸟账号，请确认该手机号和账号做了绑定，否则系统将自动创建新账号</div>
        <div class="message">
            <span>
                <input type="text" class="text-message" placeholder="请输入大陆手机号" name="phone" id="phone" autocomplete="off"/>
            </span>
            <div class="hint-word"></div>
        </div>
        <div class="verification-box">
            <div class="verification">
                <span class="short"><input type="text" class="text-short-message" placeholder="动态密码" name="phonecode" id="phonecode" autocomplete="off"></span>
                <div class="hint-word"></div>
            </div>
            <a href="javascript:;" class="message-code" id="getCode">获取动态密码</a>
            <font class="message-code2" style=" display: none;" id="showtime">60s</font>
        </div>
        <input type="button" class="login-sunmit" id="toMessageLogin" value="立即登录">
        <div class="messagebottom">
            <a href="javascript:;" class="change" id="changeLogin">账号密码登录</a>
            我已阅读并同意<a href="http://www.fengniao.com/law.html">《蜂鸟用户注册协议》</a>
        </div>
        <!--content-->
    </div>

</div>

<div id="popup-captcha"></div>
<input name="onlycode" id="onlycode" type="hidden" value="" class="text">
</form>
<!--foot-->
<div id="foot" class="foot foot-box">
    <div class="wrapper">
        <p class="link">
            <a href="http://www.fengniao.com/about.html">蜂鸟简介</a>|<a href="http://www.fengniao.com/contact.html">联系我们</a>|<a href="http://www.fengniao.com/sitelinks.php">友情链接</a>|<a href="http://www.fengniao.com/zhaopin.html">招聘信息</a>|<a href="http://www.fengniao.com/law.html">用户服务协议</a>|<a href="http://www.fengniao.com/copyright.html">隐私权声明</a>|<a href="http://www.fengniao.com/shengming.html">法律投诉声明</a>
        </p>
        <p class="copyright"><script type="text/javascript">var myDate = new Date();document.write(myDate.getFullYear());</script> fengniao.com. All rights reserved . 北京蜂鸟映像电子商务有限公司（蜂鸟网）</p>
        <p>版权所有 京ICP证150110号</p>
    </div>
</div>

<!--foot-->
</body>
</html>

<script>
	/* 
	  $(function(){
 
                var ok1=false;
                var ok2=false;
                var ok3=false;
                var ok4=false;
                // 验证用户名
                $('input[name="uname"]').focus(function(){
                    $(this).next().text('账号5-18位').removeClass('state1').addClass('state2');
                }).blur(function(){
                    if($(this).val().length >= 5 && $(this).val().length <=18 && $(this).val()!=''){
                        $(this).next("li").text('输入成功').removeClass('state1').addClass('state4');
                        ok1=true;
                    }else{
                        $(this).next("li").html('<font color="#FF0000"> 账号5-18位</font>').removeClass('state1').addClass('state3');
                    }
                     
                });
 
                //验证密码
                $('input[name="upass"]').focus(function(){
                    $(this).next().text('密码5-18位').removeClass('state1').addClass('state2');
                }).blur(function(){
                    if($(this).val().length >= 5 && $(this).val().length <=18 && $(this).val()!=''){
                        $(this).next().text('输入成功').removeClass('state1').addClass('state4');
                        ok2=true;
                    }else{
                        $(this).next().html('<font color="#FF0000"> 账号5-18位</font>').removeClass('state1').addClass('state3');
                    }
                     
                });
                //提交按钮,所有验证通过方可提交
                $('.submit').click(function(){
                    if(ok1 && ok2){

                        $('form').submit();
                       
                    }else{
                        return false;
                    }
                });
                 
            });
				 

				 
    var backUrl = 'http://2.fengniao.com/user/buy?click_source=topbar';
    backUrl = decodeURIComponent(backUrl);
    var url = backUrl ? backUrl : 'http://www.fengniao.com';
    $.cookie('loginRefer', url);
    function locationHref(type)
    {
        if (type == 1) {
            window.location.href = url;
        } else {
            url = backUrl ? backUrl : 'https://my.fengniao.com/';
            $.cookie('loginRefer', url);
            window.location.href = 'https://my.fengniao.com/phoneRegisterSuccess.php';
        }
    } */

    // 账号密码
$("#name").focus(function(){
        $("#name").parent().parent().removeClass('warning').addClass('active');
    }).blur(function(){
        $("#name").parent().parent().removeClass('warning active').children('.hint-word').text('');
        checkUserIsMustCode();
    });
    $("#password").focus(function(){
        $("#password").parent().parent().removeClass('warning').addClass('active');
    }).blur(function(){
        $("#password").parent().parent().removeClass('warning active').children('.hint-word').text('');
    });
    $("#code").focus(function(){
        $("#code").parent().parent().removeClass('warning').addClass('active');
    }).blur(function(){
        $("#code").parent().parent().removeClass('warning active').children('.hint-word').text('');
    });
    //手机短信
    $("#phone").focus(function(){
        $("#phone").parent().parent().removeClass('warning').addClass('active');
    }).blur(function(){
        $("#phone").parent().parent().removeClass('warning active').children('.hint-word').text('');
        phoneCheck();
    });
    $("#phonecode").focus(function(){
        $("#phonecode").parent().parent().removeClass('warning').addClass('active');
    }).blur(function(){
        $("#phonecode").parent().parent().removeClass('warning active').children('.hint-word').text('');
    });

    //展示短信验证码的输入框
    $('#changeMessageLogin').bind('click', changeMessageLogin);
    //展示账号密码登录输入框
    $('#changeLogin').bind('click', changeLogin);

    function changeMessageLogin(){
        $('#login').hide();
        $('#loginMessage').show();
    }
    function changeLogin(){
        $('#loginMessage').hide();
        $('#login').show();
    }

    // 判定用户是否需要验证码
    function checkUserIsMustCode(){
        var name = $("#name").val();
        if (name) {
            $.ajax({
                'url':'../ajax/ajaxLogin.php',
                'data':'from='+'checkUserIsMustNeedCode'+'&name='+name,
                'type':'POST',
                'dataType':'json',
                'success':function(data) {
                    if (data.code != 1)
                    {
                        showCode();
                    } else {
                        $("#verification").hide();
                        // 去掉行内样式
                        $("#logo").css('margin', "50px 0 30px 0");
                    }
                },
                'cache':false
            });
        }
    }

    //手机验证
    function phoneCheck(){
        // 手机号空判定
        // 手机号格式判定
        // 判定手机号是否
        var phone = $("#phone").val();
        if (phone) {

            if (/1\d{10}/m.test(phone)) {

            } else {
                $("#phone").parent().parent().removeClass('active').addClass('warning').children('.hint-word').text('请输入正确的手机号');
            }
        } else {
            $("#phone").parent().parent().removeClass('warning active').children('.hint-word').text('');
        }
    }

    //短信验证码登录
    $('#toMessageLogin').bind('click', toMessageLogin);
    function toMessageLogin(){
        var phone = $("#phone").val();
        var code = $("#phonecode").val();

        if (phone) {
            if (code) {

                if (/^1\d{10}$/m.test(phone)) {
                    if (/^\d{6}$/m.test(code)) {

                        $("#phone").parent().parent().removeClass('warning');
                        $("#phonecode").parent().parent().removeClass('warning');
                        $.ajax({
                            'url':'./ajax/ajaxRegister.php',
                            'data':'from='+'phoneLogin'+'&phone='+phone+'&code='+code,
                            'type':'POST',
                            'dataType':'json',
                            'success':function(data) {
                                if (data.code == 1 || data.code == 2)
                                {
                                    $.ajax({
                                        type:"get",
                                        url:'https://www.tripfn.com/login.php?type=set&bbuserid=' + $.cookie('bbuserid') + '&bbusername=' + encodeURIComponent($.cookie('bbusername')) + '&bbpassword=' + $.cookie('bbpassword'),
                                        async:false,
                                        dataType:"jsonp",
                                        success:function(data){

                                        }
                                    });
                                    if (data.code == 1) {
                                        setTimeout('locationHref(1)', 600);//延时3秒
                                    } else {
                                        setTimeout('locationHref(2)', 600);//延时3秒
                                    }
                                }else{
                                    if (data.code == -1 || data.code ==  -4) {
                                        $("#phone").parent().parent().addClass('warning').children('.hint-word').text(data.msg);
                                    } else if (data.code == -2) {
                                        $("#phonecode").parent().parent().addClass('warning').children('.hint-word').text('动态密码不可为空');
                                    } else if (data.code == -13 || data.code == -14) {
                                        $("#phonecode").parent().parent().addClass('warning');
                                        $("#phonecode").val('');
                                        $("#phonecode").parent().parent().addClass('warning').children('.hint-word').text('动态密码错误');
                                    } else if (data.code == -7 || data.code == -3 || data.code == -10) {
                                        $("#phone").parent().parent().addClass('warning').children('.hint-word').text(data.msg);
                                    }
                                }
                            },
                            'cache':false
                        });
                    }else {
                        $("#phonecode").parent().parent().removeClass('active').addClass('warning').children('.hint-word').text('动态密码错误');
                    }
                }
                else {
                    $("#phone").parent().parent().removeClass('active').addClass('warning').children('.hint-word').text('请输入正确的手机号');
                }
            } else {
                $("#phonecode").parent().parent().removeClass('active').addClass('warning').children('.hint-word').text('请输入动态密码');
            }
        } else {
            $("#phone").parent().parent().removeClass('active').addClass('warning').children('.hint-word').text('请输入手机号');
        }
    }

    $("#refreshCode").bind('click', refreshCode);
    $("#toLogin").bind('click', toLogin);

    // 刷新验证码
    function refreshCode(){
        var date = Math.round(new Date().getTime());
        var url = '../ajax/code.php';
        url = url + '?' + date;
        $("#refreshCode").attr('src', url);
    }

    // 显示验证码
    function showCode(){
        $("#verification").show();
        $("#logo").css('margin', "20px 0");
    }


	
	
	
    //账号密码登录
    function toLogin(){
        checkUserIsMustCode();

        var name = $("#name").val();
        var password = $("#password").val();
        var isshow = $("#verification").css('display') == 'block' ? 1 : 0;
        var code = $("#code").val();

        if (name) {
            if (password) {
                if ((isshow == 1 && code) || isshow == 0) {
                    // 消除所有warning
                    $("#name").parent().parent().removeClass('warning');
                    $("#password").parent().parent().removeClass('warning');
                    $("#code").parent().parent().removeClass('warning');
                    $.ajax({
                        'url':'../ajax/ajaxLogin.php',
                        'data':'from='+'login'+'&name='+name+'&password='+hex_md5(password)+'&code='+code,
                        'type':'POST',
                        'dataType':'json',
                        'success':function(data) {
                            if (data.code == 1)
                            {
                                $.ajax({
                                    type:"get",
                                    url:'https://www.tripfn.com/login.php?type=set&bbuserid=' + $.cookie('bbuserid') + '&bbusername=' + encodeURIComponent($.cookie('bbusername')) + '&bbpassword=' + $.cookie('bbpassword'),
                                    async:false,
                                    dataType:"jsonp",
                                    success:function(data){

                                    }
                                });

                                setTimeout('locationHref(1)', 600);//延时3秒
                            }else{
                                if (data.code == -1) {
                                    // 请您填写手机/用户名/邮箱
                                    $("#name").parent().parent().addClass('warning').children('.hint-word').text(data.msg);
                                } else if (data.code == -2) {
                                    // 请您填写密码
                                    $("#password").parent().parent().addClass('warning').children('.hint-word').text(data.msg);
                                } else if (data.code == -3) {
                                    // 您登录过于频繁，请15分钟后重试
                                    $("#name").parent().parent().addClass('warning').children('.hint-word').text(data.msg);
                                } else if (data.code == -4) {
                                    // 请您填写验证码
                                    showCode();
                                    $("#code").parent().parent().addClass('warning').children('.hint-word').text(data.msg);
                                } else if (data.code == -5) {
                                    // 您填写的验证码错误
                                    $("#code").parent().parent().addClass('warning');
                                    $("#code").val('');
                                    $("#code").parent().parent().addClass('warning').children('.hint-word').text(data.msg);
                                    refreshCode();
                                } else if (data.code == -6) {
                                    // 用户不存在
                                    $("#name").parent().parent().addClass('warning').children('.hint-word').text(data.msg);
                                }else if (data.code == -7) {
                                    // 您填写的帐号或密码有误
                                    $("#name").parent().parent().addClass('warning').children('.hint-word').text(data.msg);
                                    $("#password").parent().parent().addClass('warning');
                                    // 密码执行清空
                                    $("#password").val('');
                                    $("#code").val('');
                                    refreshCode();
                                }
                            }
                        },
                        'cache':false
                    });
                } else {
                    $("#code").parent().parent().addClass('warning').children('.hint-word').text('请您输入验证码');
                }
            } else {
                $("#password").parent().parent().addClass('warning').children('.hint-word').text('请您输入密码');
            }
        } else {
            $("#name").parent().parent().addClass('warning').children('.hint-word').text('请您输入手机/用户名/邮箱');
        }
    }

    //本地cookie 记录验证码时间
    // showtimelimit 时间戳 存储下次能点击能发送验证码的时间
    var timeLimit = 60;
    var date = Math.round(new Date().getTime()/1000);
    var timerObj;       // 定一个定时器参数
    var timerObjLimit;  // 定时器剩余时间

    function startTime(time) {
        timerObjLimit = time;
        $("#showtime").text(timerObjLimit + 's');
        $("#showtime").show();
        $("#getCode").hide();
        timerObj = window.setInterval(closeTime, 1000);
        var date = new Date();
        date.setTime(date.getTime() + (time * 1000));
        var commonTime = Math.round(new Date().getTime()/1000) + timerObjLimit;
    }

    function closeTime() {
        if (timerObjLimit == 1) {
            window.clearInterval(timerObj);//停止计时器
            $("#getCode").text('获取动态密码');
            $("#showtime").hide();
            $("#getCode").show();
        } else {
            timerObjLimit--;
            $("#showtime").text(timerObjLimit + 's');
        }
    }

    //极验-------------------------------------------------------------------------
    var handlerPopup = function (captchaObj) {
        // 将验证码加到id为captcha的元素里
        captchaObj.appendTo("#popup-captcha");
        // 更多接口参考：http://www.geetest.com/install/sections/idx-client-sdk.html
        // 成功的回调
        captchaObj.onSuccess(function () {
            var validate = captchaObj.getValidate();
            $.ajax({
                url: "../ajax/SecondVerify.php", // 进行二次验证
                type: "get",
                dataType: "json",
                data: {
                    type:'login',
                    geetest_challenge: validate.geetest_challenge,
                    geetest_validate: validate.geetest_validate,
                    geetest_seccode: validate.geetest_seccode
                },
                success: function (data) {
                    if (data.status === 'success') {
                        $("#onlycode").val(data.onlycode);
                        getSendCode();
                    } else {
                        alert("验证失败");
                        return false;
                    }
                }
            });
        });
        $("#getCode").click(function () {
            var phone = $("#phone").val();
            if(phone){

                if (/^1{1}[0-9]{10}$/.test(phone)) {

                    captchaObj.show();
                } else {
                    $("#phone").parent().parent().removeClass('active').addClass('warning').children('.hint-word').text('请输入正确的手机号');
                }
            }else{
                $("#phone").parent().parent().removeClass('active').addClass('warning').children('.hint-word').text('请输入手机号');
            }
        });

        function getSendCode(){
            var phone = $("#phone").val();
            var onlycode = $("#onlycode").val();
            $.ajax({
                url: "../ajax/getCode.php",
                type: "get",
                dataType: "json",
                data: {
                    onlycode: onlycode,
                    phone: phone,
                    usetype: 3,
                    sendtype: 1
                },
                success: function (data) {
                    $("#phone").parent().parent().removeClass('active');
                    if (data.code == 1){
                        $("#getCode").hide();
                        $("#showtime").show();
                        startTime(60);
                    }else{
                        $("#phone").parent().parent().removeClass('active').addClass('warning').children('.hint-word').text(data.msg);
                    }
                }
            });
        }
    };
    // 验证开始需要向网站主后台获取id，challenge，success（是否启用failback）
    $.ajax({
        url: "../ajax/StartCaptchaServlet.php?type=login&t=" + (new Date()).getTime(), // 加随机数防止缓存
        type: "get",
        dataType: "json",
        success: function (data) {
            // 使用initGeetest接口
            // 参数1：配置参数
            // 参数2：回调，回调的第一个参数验证码对象，之后可以使用它做appendTo之类的事件
            initGeetest({
                gt: data.gt,
                challenge: data.challenge,
                product: "popup", // 产品形式，包括：float，embed，popup。注意只对PC版验证码有效
                offline: !data.success // 表示用户后台检测极验服务器是否宕机，一般不需要关注
                // 更多配置参数请参见：http://www.geetest.com/install/sections/idx-client-sdk.html#config
            }, handlerPopup);
        }
    }); 

</script>


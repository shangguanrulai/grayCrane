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
		 <form action="{{ url('home/dologin') }}" method="post" >
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
                <input type="text" class="text-username" name='uname' placeholder="手机号/用户名/邮箱" id="username" autocomplete="off"/>
            </span><em></em>

        </div>
        <div class="password">
            <span>
                <input type="password" name='upass' class="text-password" placeholder="请输入密码" id="password" autocomplete="off"/>
            </span><em></em>

        </div>

		 <div class="code" style="margin-top:20px;margin-bottom:20px">
            <span>
		<input class="yanzhengma" name="yzm" lay-verify="required" placeholder="请输入验证码"  type="text"  style="width:200px;height:40px;float:left;">
           <img src="{{ url('home/yzm') }}" onclick="this.src='{{ url('home/yzm') }}?'+Math.random()" alt="" style="width:150px;height:50px;float:right">






        </div>
		{{ csrf_field() }}
        <div class="verification-box" style="display: none;" id="verification">
            <div class="verification">
                <span class="short"><input type="text" class="text-short" id="code" autocomplete="off"></span>
            </div>
        </div>
        <input type="submit" class="login-sunmit" value="立即登录" id="toLogin">
        <div class="noID">还没有账号？<a href="{{url('/home/register')}}">立即注册</a></div>
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
            <p class="">
            <span>
                <input type="text" class="text-message" placeholder="请输入大陆手机号" name="phone" id="phone" autocomplete="off"/>
            </span>
        </p>
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

    $(function(){
        $("#username").focus(function(){
            $("#username").parent().parent().removeClass('warning').addClass('active').children("em").text('5个字符以上，支持中文、英文、数字').css('color','#888888');
        }).blur(function(){
            $("#username").parent().parent().removeClass('warning active');
            checkUsername();
        });
        $("#password").focus(function(){
            $("#password").parent().parent().removeClass('warning').addClass('active').children("em").text('6-16位数字、字母或常用英文字符，字母区分大小写').css('color','#888888');
        }).blur(function(){
            $("#password").parent().parent().removeClass('warning active').children("em").text();
            checkPassword();
        });




        function checkUsername(){
            var username = $("#username").val();
            username = $.trim(username);
            if(username){
                $.ajax({
                    url:'../ajax/ajaxRegister.php',
                    data:'from='+'checkUsername'+'&username='+username,
                    type:'POST',
                    dataType:'json',
                    success:function(data) {
                        if (data.code == 1)
                        {
                            $("#username").parent().parent().removeClass('active warning').children("em").text('');
                        }
                        else
                        {
                            $("#username").parent().parent().removeClass('active').addClass('warning').children("em").text(data.msg);
                        }
                    },
                    cache:false
                });
            }else{
                $("#username").parent().parent().removeClass('active').addClass('warning').children("em").text('请输入用户名');
            }


            if (username) {
                if (username.length >= 6 && username.length <= 16) {
                    if (/^[0-9a-zA-Z!@#$%^&*()_+|?\/-=]{6,16}$/m.test(username)) {
                        if (!/^[0-9]{6,16}$/m.test(username)) {
                            $("#username").parent().parent().removeClass('active warning');
                        } else {
                            $("#username").parent().parent().removeClass('active').addClass('warning').children('em').text('用户名不能为纯数字').css('color','red');
                        }
                    } else {
                        $("#username").parent().parent().removeClass('active').addClass('warning').children('em').text('用户名不能包含特殊字符').css('color','red');
                    }
                } else {
                    $("#username").parent().parent().removeClass('active').addClass('warning').children('em').text('用户名长度为6-16位字符').css('color','red');
                }
            } else {
                $("#username").parent().parent().removeClass('active').addClass('warning').children('em').text('请您输入用户名').css('color','red');
            }
        }

        function checkPassword(){
            var password = $("#password").val();
            if (password) {
                if (password.length >= 6 && password.length <= 16) {
                    if (/^[0-9a-zA-Z!@#$%^&*()_+|?\/-=]{6,16}$/m.test(password)) {
                        if (!/^[0-9]{6,16}$/m.test(password)) {
                            $("#password").parent().parent().removeClass('active warning');
                        } else {
                            $("#password").parent().parent().removeClass('active').addClass('warning').children('em').text('密码不能为纯数字').css('color','red');
                        }
                    } else {
                        $("#password").parent().parent().removeClass('active').addClass('warning').children('em').text('密码不能包含特殊字符').css('color','red');
                    }
                } else {
                    $("#password").parent().parent().removeClass('active').addClass('warning').children('em').text('密码长度为6-16位字符').css('color','red');
                }
            } else {
                $("#password").parent().parent().removeClass('active').addClass('warning').children('em').text('请您输入密码').css('color','red');
            }
        }


        function checkCode() {
            var code = $("#code").val();
            if (code) {
                if (/^[0-9]{6}$/m.test(code)) {
                    $("#code").parent().parent().removeClass('active warning');
                } else {
                    $("#code").parent().parent().removeClass('active').addClass('warning').children('em').text('验证码错误').css('color','red');
                }
            } else {
                $("#code").parent().parent().removeClass('active').addClass('warning').children('em').text('请输入验证码');
            }
        }

        function phoneCheck(){
            // 手机号空判定
            // 手机号格式判定
            // 判定手机号是否
            var phone = $("#phone").val();
            phone = $.trim(phone);
            if (phone) {
                if (/1\d{10}/m.test(phone)&&phone.length==11) {
                    if(phone.indexOf('170') == 0){
                        $("#phone").parent().parent().children('em').text('请输入真实的手机号');
                        $("#phone").parent().parent().removeClass('active').addClass('warning');
                    }
                } else {
                    $("#phone").parent().parent().children('em').text('请输入正确的手机号');
                    $("#phone").parent().parent().removeClass('active').addClass('warning');
                }
            } else {
                $("#phone").parent().parent().children('em').text('请输入手机号');
                $("#phone").parent().parent().removeClass('active').addClass('warning');
            }
        }

        $("#agree").bind('click', agree);
        $("#toRegister").bind('click', toRegister);

        function agree() {
            if($("#agree:checked").val() == 1) {
                $("#toRegister").bind('click', toRegister);
                $("#toRegister").removeClass("submit2").addClass("submit1");
            } else {
                $("#toRegister").unbind('click', toRegister);
                $("#toRegister").removeClass("submit1").addClass("submit2");
            }
        }

        function toRegister() {
            var username = $("#username").val();
            username = $.trim(username);
            var password = $("#password").val();
            var phone = $("#phone").val();
            var code = $("#code").val();
            if (username) {
                if (password) {
                    if (password.length >= 6 && password.length <= 16) {
                        if (/^[0-9a-zA-Z!@#$%^&*()_+|?\/-=]{6,16}$/m.test(password)) {
                            if (!/^[0-9]{6,16}$/m.test(password)) {
                                if (phone) {
                                    if (code) {
                                        $.ajax({
                                            url:'../ajax/ajaxRegister.php',
                                            data:'from='+'registerPhone'+'&username='+username+'&password='+hex_md5(password)+'&phone='+phone+'&code='+code,
                                            type:'POST',
                                            dataType:'json',
                                            'success':function(data) {
                                                if (data.code == 1)
                                                {
                                                    window.location.href=skipUrl;
                                                    //$(".y-register-messagebox").show();
                                                }else{
                                                    if (data.code == -1)
                                                    {
                                                        $("#username").parent().parent().removeClass('active').addClass('warning').children("em").text(data.msg);
                                                    }
                                                    else if (data.code == -2)
                                                    {
                                                        $("#password").parent().parent().removeClass('active').addClass('warning').children("em").text(data.msg);
                                                    }
                                                    else if (data.code == -3)
                                                    {
                                                        $("#phone").parent().parent().removeClass('active').addClass('warning').children("em").text(data.msg);
                                                    }
                                                    else if (data.code == -4)
                                                    {
                                                        $("#code").parent().parent().removeClass('active').addClass('warning').children("em").text(data.msg);
                                                    }
                                                    else if (data.code == -5)
                                                    {
                                                        $("#username").parent().parent().removeClass('active').addClass('warning').children("em").text(data.msg);
                                                    }
                                                    else if (data.code == -6)
                                                    {
                                                        $("#username").parent().parent().removeClass('active').addClass('warning').children("em").text(data.msg);
                                                    }
                                                    else if (data.code == -7)
                                                    {
                                                        $("#username").parent().parent().removeClass('active').addClass('warning').children("em").text(data.msg);
                                                    }
                                                    else if (data.code == -8)
                                                    {
                                                        $("#username").parent().parent().removeClass('active').addClass('warning').children("em").text(data.msg);
                                                    }
                                                    else if (data.code == -9)
                                                    {
                                                        $("#username").parent().parent().removeClass('active').addClass('warning').children("em").text(data.msg);
                                                    }
                                                    else if (data.code == -10)
                                                    {
                                                        $("#username").parent().parent().removeClass('active').addClass('warning').children("em").text(data.msg);
                                                    }
                                                    else if (data.code == -11)
                                                    {
                                                        $("#phone").parent().parent().removeClass('active').addClass('warning').children("em").text(data.msg);
                                                    }
                                                    else if (data.code == -12)
                                                    {
                                                        $("#phone").parent().parent().removeClass('active').addClass('warning').children("em").text(data.msg);
                                                    }
                                                    else if (data.code == -13)
                                                    {
                                                        $("#code").parent().parent().removeClass('active').addClass('warning').children("em").text(data.msg);
                                                    }
                                                    else if (data.code == -14)
                                                    {
                                                        $("#code").parent().parent().removeClass('active').addClass('warning').children("em").text(data.msg);
                                                    }else if(data.code == -16){
                                                        $("#phone").parent().parent().removeClass('active').addClass('warning').children("em").text(data.msg);
                                                    }
                                                }
                                            },
                                            cache:false
                                        });
                                    } else {
                                        $("#code").parent().parent().removeClass('active').addClass('warning').children("em").text('请输入验证码');
                                    }
                                } else {
                                    $("#phone").parent().parent().removeClass('active').addClass('warning').children("em").text('请输入手机号');
                                }
                            } else {
                                $("#password").parent().parent().removeClass('active').addClass('warning').children("em").text('密码不能为纯数字');
                            }
                        } else {
                            $("#password").parent().parent().removeClass('active').addClass('warning').children("em").text('密码不能包含特殊字符');
                        }
                    } else {
                        $("#password").parent().parent().removeClass('active').addClass('warning').children("em").text('密码长度为6-16位字符');
                    }
                } else {
                    $("#password").parent().parent().removeClass('active').addClass('warning').children("em").text('请输入密码');
                }
            } else {
                $("#username").parent().parent().removeClass('active').addClass('warning').children("em").text('请输入用户名');
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
            $("#showtime").css('display','inline-block');
            $("#getCode").hide();
            timerObj = window.setInterval(closeTime, 1000);
            var date = new Date();
            date.setTime(date.getTime() + (time * 1000));
            var commonTime = Math.round(new Date().getTime()/1000) + timerObjLimit;
        }

        function closeTime() {
            if (timerObjLimit == 1) {
                window.clearInterval(timerObj);//停止计时器
                // 变更提示词
                $("#getCode").text('重新获取验证码');
                $("#showtime").hide();
                $("#getCode").show();
            } else {
                timerObjLimit--;
                $("#showtime").text(timerObjLimit + 's');
            }
        }

        //极验
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
                        type:'register',
                        geetest_challenge: validate.geetest_challenge,
                        geetest_validate: validate.geetest_validate,
                        geetest_seccode: validate.geetest_seccode,
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
                        if(phone.indexOf('170') == 0){
                            $("#phone").parent().parent().children('em').text('请输入真实的手机号');
                            $("#phone").parent().parent().removeClass('active').addClass('warning');
                        }else{
                            captchaObj.show();
                        }
                    } else {
                        $("#phone").parent().parent().children('em').text('请输入正确的手机号');
                        $("#phone").parent().parent().removeClass('active').addClass('warning');
                    }
                }else{
                    $("#phone").parent().parent().removeClass('active').addClass('warning').children("em").text('请输入手机号');
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
                        usetype: 1,
                        sendtype: 1
                    },
                    success: function (data) {
                        $("#phone").parent().parent().removeClass('active');
                        if (data && data.code == 1){
                            $("#getCode").hide();
                            $("#showtime").css('display','inline-block');
                            startTime(120);
                        }else{
                            $("#phone").parent().parent().children('em').text(data.msg);
                            $("#phone").parent().parent().removeClass('active').addClass('warning');
                        }
                        $("#code").parent().parent().removeClass('warning active').children("em").text();
                    }
                });
            }
        };
        // 验证开始需要向网站主后台获取id，challenge，success（是否启用failback）
        $.ajax({
            url: "../ajax/StartCaptchaServlet.php?type=register&t=" + (new Date()).getTime(), // 加随机数防止缓存
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

    });

</script>


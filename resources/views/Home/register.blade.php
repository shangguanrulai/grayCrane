﻿<!DOCTYPE html>
<html>
<head lang="zh-CN">
    <meta charset="UTF-8">
    <meta name="renderer" content="webkit"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <title>手机注册</title>
    <meta name="description" content=""/>
    <meta name="keywords" content=""/>
    <link rel="shortcut icon" href="https://my.fengniao.com/icon/images/favicon.ico"/>
    <link rel="bookmark" href="https://my.fengniao.com/icon/images/favicon.ico"/>
    <link rel="stylesheet" href="/Content/header-footer.css"/>
    <link rel="stylesheet" href="/Content/register-login.css"/>
    <script>
        var project_domain = 'https://my.fengniao.com/';
    </script>
    <script src="/Script/jquery-1.7.1.min.js"></script>
    <script type="text/javascript" src="/Scripts/function.js"></script>
    <script src="/Script/main.js"></script>
    <script src="/Script/md5.js"></script>
    <script src="/Script/gt.js"></script>
    <link rel="stylesheet" href="/Content/register.css"/>
</head>
<body>
<div id="box" class="wrapper wrapper-box">
    <!--logo-->
    <div class="logo-box">
        <a href="#" class="logo">蜂鸟网</a>
        <span>开启你的视觉之旅</span>
    </div>
    <!--logo-->
    <!--content-->
    <div class="content">
        <div class="title">
            注册蜂鸟账号
            <span>我已注册，现在就<a href="https://my.fengniao.com/login.php">登录</a></span>
        </div>
        <div class="register">
            <!--p标签在input输入时class使用active，验证失败时使用warning-->
            <p class="">
                <font><i>*</i>用户名：</font>
                <span><input type="text" class="text-long" name="username" id="username" autocomplete="off"/></span>
                <em></em>
            </p>
            <p class="">
                <font><i>*</i>密码：</font>
                <span><input type="password" class="text-long" name="password" id="password" autocomplete="off"/></span>
                <em></em>
            </p>
            <p>
                <font><i>*</i>手机号：</font>
                <span><input type="text" class="text-long"  name="phone" id="phone" autocomplete="off"/></span>
                <em></em>
            </p>
            <p>
                <font><i>*</i>验证码：</font>
                <span class="short"><input type="text" class="text-short"  name="code" id="code" autocomplete="off"/></span>
                <a href="javascript:;" class="getVerification" id="getCode">获取短信验证码</a>
                <!-- 秒数倒计时时class用time-->
                <s class="time" id="showtime" style="display:none">60s</s>
            </p>
            <p>
                <font>&nbsp;</font>
                <input type="checkbox" id="agree" value="1" checked/>
                <s>我已阅读并同意</s>
                <a href="http://www.fengniao.com/law.html" target="_blank">《蜂鸟用户注册协议》</a>
            </p>
            <p>
                <font>&nbsp;</font>
                <input type="submit" value="立即注册" class="submit1" id="toRegister"/>
            </p>
        </div>
    </div>
    <!--content-->
</div>


    
    
        
        
        
        
        
            
            
        
        
            
            
        
        
            
            
                
                
                
                
                
                
                
                
                
                
                
                
            
            
        
        
            
            
        
        
            
                
                    
                    
                    
                
            
        
        
        
            
            
        
    


    
    
        
        
        
    


<div id="popup-captcha"></div>
<input name="onlycode" id="onlycode" type="hidden" value="" class="text">


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
    var skipUrl = 'https://my.fengniao.com/registerSuccess.php?url=http://www.fengniao.com';
    
    
        
        
    
    
        
        
    
    
        
        
    
    
        
            
            
            
        
            
            
            
        
    
    
</script>


<script>
    
    $(function(){
        $("#username").focus(function(){
            $("#username").parent().parent().removeClass('warning').addClass('active').children("em").text('2-14位字符，支持中文、英文、数字');
        }).blur(function(){
            $("#username").parent().parent().removeClass('warning active');
            checkUsername();
        });
        $("#password").focus(function(){
            $("#password").parent().parent().removeClass('warning').addClass('active').children("em").text('6-16位数字、字母或常用英文字符，字母区分大小写');
        }).blur(function(){
            $("#password").parent().parent().removeClass('warning active').children("em").text();
            checkPassword();
        });
        $("#phone").focus(function(){
            $("#phone").parent().parent().removeClass('warning').addClass('active').children("em").text('请输入中国大陆手机号，可用于登录和找回密码，注册成功后，所有产品通用');
        }).blur(function(){
            $("#phone").parent().parent().removeClass('warning active').children("em").text();
            phoneCheck();
        });
        $("#code").focus(function(){
            $("#code").parent().parent().removeClass('warning').addClass('active').children("em").text('请输入验证码');
        }).blur(function(){
            $("#code").parent().parent().removeClass('warning active').children("em").text();
            checkCode();
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
        }

        function checkPassword(){
            var password = $("#password").val();
            if (password) {
                if (password.length >= 6 && password.length <= 16) {
                    if (/^[0-9a-zA-Z!@#$%^&*()_+|?\/-=]{6,16}$/m.test(password)) {
                        if (!/^[0-9]{6,16}$/m.test(password)) {
                            $("#password").parent().parent().removeClass('active warning');
                        } else {
                            $("#password").parent().parent().removeClass('active').addClass('warning').children('em').text('密码不能为纯数字');
                        }
                    } else {
                        $("#password").parent().parent().removeClass('active').addClass('warning').children('em').text('密码不能包含特殊字符');
                    }
                } else {
                    $("#password").parent().parent().removeClass('active').addClass('warning').children('em').text('密码长度为6-16位字符');
                }
            } else {
                $("#password").parent().parent().removeClass('active').addClass('warning').children('em').text('请您输入密码');
            }
        }

        function checkCode() {
            var code = $("#code").val();
            if (code) {
                if (/^[0-9]{6}$/m.test(code)) {
                    $("#code").parent().parent().removeClass('active warning');
                } else {
                    $("#code").parent().parent().removeClass('active').addClass('warning').children('em').text('验证码错误');
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
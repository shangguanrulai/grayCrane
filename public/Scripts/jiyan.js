//本地cookie 记录验证码时间
// showtimelimit 时间戳 存储下次能点击能发送验证码的时间
var timeLimit = 60;
var date = Math.round(new Date().getTime() / 1000);
var timerObj;       // 定一个定时器参数
var timerObjLimit;  // 定时器剩余时间
function startTime(time) {
    timerObjLimit = time;
    $("#getCode").addClass('disabled');
    $("#getCode").text(timerObjLimit + 's后重新获取');
    timerObj = window.setInterval(closeTime, 1000);
    var date = new Date();
    date.setTime(date.getTime() + (time * 1000));
    var commonTime = Math.round(new Date().getTime() / 1000) + timerObjLimit;
}
function closeTime() {
    if (timerObjLimit == 1) {
        window.clearInterval(timerObj);//停止计时器
        $("#getCode").removeClass('disabled');
        $("#getCode").text('获取验证码');
    } else {
        timerObjLimit--;
        $("#getCode").text(timerObjLimit + 's后重新获取');
    }
}

$.ajax({
    dataType: 'json',
    url: '/recycle/ajax/',
    data: {"act": 'captcha', 't': (new Date()).getTime()},
    type: 'post',
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
var handlerPopup = function (captchaObj) {
    // 将验证码加到id为captcha的元素里
    captchaObj.appendTo("#popup-captcha");
    // 更多接口参考：http://www.geetest.com/install/sections/idx-client-sdk.html
    // 成功的回调
    captchaObj.onSuccess(function () {
        var validate = captchaObj.getValidate();
        $.ajax({
            url: "/recycle/ajax/", // 进行二次验证
            type: "post",
            dataType: "json",
            data: {
                act: 'captcha_second',
                project: $("#project").val(),
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

    function getSendCode() {
        var phone = $("#phone").val();
        var onlycode = $("#onlycode").val();
        var usetype = $("#usetype").val();
        $.ajax({
            url: "/recycle/ajax/",
            type: "post",
            dataType: "json",
            data: {act: 'getCode', onlycode: onlycode, phone: phone, usetype: usetype, sendtype: 1},
            success: function (data) {
                if (data.code == 1) {
                    startTime(60);
                } else {
                    phoneError(data.msg);
                }
            }
        });
    }

    $("#getCode").click(function () {
        if (!$("#getCode").hasClass('disabled')) {
            var phone = $("#phone").val();
            if (phone) {
                if (/^1{1}[0-9]{10}$/.test(phone)) {
                    captchaObj.show();
                } else {
                    phoneError('请输入正确的手机号');
                }
            } else {
                phoneError('请输入手机号');
            }
        }
    });
};

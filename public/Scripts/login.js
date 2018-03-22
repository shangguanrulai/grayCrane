function quickrecoveryLogin() {
    $('#recoveryLoginDialog').dialog({
        autoOpen: false, //开发后期需要把这个重置为false
        width: 940,
        dialogClass: "recoveryLogin-dialog-wrap",
        modal: true,
        buttons: []
    });
}
quickrecoveryLogin();

$('.recoveryLogin-dialog-wrap').on('click', '.exchange-link', function () {
    if ($(this).hasClass('message-link')) {
        $(this).parents('#userNameDialog').hide().siblings('#messageDialog').show();
    } else {
        $(this).parents('#messageDialog').hide().siblings('#userNameDialog').show();
    }
});

var flg = $('#flg').val();
var recycleId = $('#recycleId').val();
var url = $('#url').val();

//点击我的回收单
$("#myRecycle").click(function () {
    _hmt.push(['_trackEvent', '2_fengniao', 'recycle-mine-btn']);
    var bbuserid = globalCeilingTools.getCookie('bbuserid');
    if (bbuserid) {
        window.location.href = url;
    } else {
        //登录层弹起
        $('#recoveryLoginDialog').dialog("open");
    }
});

//确认回收单
$("#confirmRecycle").click(function () {
    _hmt.push(['_trackEvent', '2_fengniao', 'recycle-confirm-btn']);
    var bbuserid = globalCeilingTools.getCookie('bbuserid');
    if (bbuserid) {
        $.ajax({
            url: "/recycle/ajax/",
            type: "post",
            dataType: "json",
            data: {act: 'confirm_recycle', recycleId: recycleId},
            success: function (data) {
                if (data.code == 1) {
                    window.location.href = url;
                } else {
                    alert(data.msg);
                }
            }
        });
    } else {
        $('#recoveryLoginDialog').dialog("open");
        $('.other-recoveryLogin').on('click','a.sina-link,a.wechat-link,a.QQ-link',function () {
            _hmt.push(['_trackEvent', '2_fengniao', 'recycle-confirm-third-'+$(this).attr('class')]);
        });
    }
});

$("#phone").keyup(function () {
    phoneCheck();
});
$("#phone").blur(function () {
    phoneCheck();
});
function phoneCheck() {
    var phone = $('#phone').val();
    phone = $.trim(phone);
    if (/1\d{10}/m.test(phone) && phone.length == 11) {
        $('#getCode').removeClass('disabled');
    } else {
        $('#getCode').addClass('disabled');
    }
}
phoneCheck();

function clearError() {
    $(".form-item input").removeClass('error');
    $('#tip-first').hide();
    $('#tip-phone').hide();
}
//极验使用
function phoneError(msg) {
    $("#phone").addClass('error');
    $('#tip-phone').show().text(msg);
}

//访客身份继续
$('#fangke').click(function () {
    _hmt.push(['_trackEvent', '2_fengniao', 'recycle-confirm-visitor']);
    window.location.href = url;
});

//账号密码登录
$('#tologin').click(function () {
    clearError();
    var username = $.trim($("#username").val());
    var password = $("#password").val();
    if (username) {
        if (password) {
            _hmt.push(['_trackEvent', '2_fengniao', 'recycle-confirm-login']);
            password = hex_md5(password);
            $.ajax({
                url: "/recycle/ajax/",
                type: "post",
                dataType: "json",
                data: {act: 'login', username: username, password: password, flg: flg, recycleId: recycleId},
                success: function (data) {
                    if (data.code == 1) {
                        if (flg == 2) {
                            if (data.count > 0) {
                                window.location.href = url;
                            } else {
                                $('#recoveryLoginDialog li').hide();
                                $('#emptyDialog').show();
                            }
                        } else {
                            window.location.href = url;
                        }
                    } else {
                        $('#tip-first').show().text('账号或密码错误，请重新输入');
                    }
                }
            });
        } else {
            $("#password").addClass('error');
            $('#tip-first').show().text('请输入密码');
        }
    } else {
        $("#username").addClass('error');
        $('#tip-first').show().text('请输入账号');
    }
});

//短信快速登录
$("#tologinphone").click(function () {
    clearError();
    var phone = $("#phone").val();
    var code = $("#code").val();
    if (phone) {
        if (code) {
            if (/^1\d{10}$/m.test(phone)) {
                if (/^\d{6}$/m.test(code)) {
                    if (flg == 2) {
                        var act = 'login_phone_no';
                    } else {
                        var act = 'login_phone';
                    }
                    $.ajax({
                        url: "/recycle/ajax/",
                        type: "post",
                        data: {act: act, phone: phone, code: code, flg: flg, recycleId: recycleId},
                        dataType: "json",
                        success: function (data) {
                            if (data.code == 1) {
                                if (flg == 2) {
                                    if (data.count > 0) {
                                        window.location.href = url;
                                    } else {
                                        $('#recoveryLoginDialog li').hide();
                                        $('#emptyDialog').show();
                                    }
                                } else {
                                    window.location.href = url;
                                }
                            } else {
                                if (data.code == -1 || data.code == -4) {
                                    $("#phone").addClass('error');
                                    $('#tip-phone').show().text(data.msg);
                                } else if (data.code == -2 || data.code == -13 || data.code == -14) {
                                    $("#code").addClass('error');
                                    $('#tip-phone').show().text(data.msg);
                                } else {
                                    alert(data.msg);
                                    return false;
                                }
                            }
                        }
                    });
                } else {
                    $("#code").addClass('error');
                    $('#tip-phone').show().text('请输入正确的验证码');
                }
            } else {
                $("#phone").addClass('error');
                $('#tip-phone').show().text('请输入正确的手机号');
            }
        } else {
            $("#code").addClass('error');
            $('#tip-phone').show().text('请输入验证码');
        }
    } else {
        $("#phone").addClass('error');
        $('#tip-phone').show().text('请输入手机号');
    }
});

$(function () {
    //埋点
    (function () {
        // $('a.fixed-price').on('click',function () {
        //     _hmt.push(['_trackEvent', '2_fengniao', 'recycle-right-ask-btn']);
        // });
        // $('a.button').on('click',function () {
        //     _hmt.push(['_trackEvent', '2_fengniao', 'recycle-ask-btn'+$(this).attr('opt_value')]);
        // });

        // $('#swichTab1-1,#swichTab1-2,#swichTab1-3').on('click','li.equipment-item:not(:last)',function () {
        //     _hmt.push(['_trackEvent', '2_fengniao', 'recycle-product-item']);
        // }).on('click','li.equipment-item:last',function () {
        //     _hmt.push(['_trackEvent', '2_fengniao', 'recycle-product-item-more']);
        // });

    })();
});
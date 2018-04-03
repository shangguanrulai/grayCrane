var $sendBtn = $('.form-box-idcard .send-button,#setPassword #step1 .send-button,#setPhone #step1 .send-button,#setNewPhone #step1 .send-button'),
    $newSendBtn = $('#setNewPhone #step2 .send-button'),
    $setPhone = $('#setPhone #step1 .submit-button'),
    $setNewPhoneStep1 = $('#setNewPhone #step1 .submit-button'),
    $setNewPhoneStep2 = $('#setNewPhone #step2 .submit-button'),
    $setNewPhoneStep3 = $('#setNewPhone #step3 .submit-button'),
    $setPassword =$('#setPassword #step1 .submit-button'),
    $setBank = $('.form-box-bank .submit-button'),
    $selectWay = $('#setNewPhone #way'),
    disErr = function () {
        $('.error-tip').hide();
    },
    showErr = function (obj) {
        $.each(obj, function (k, v) {
            $('#' + k).parent().find('.error-tip').text(v).show();
        })
    },
    ph_zz = /^1[3|4|5|8|7][0-9]{9}$/,
    mobileReg = /^1[3|4|5|8|7][0-9]{9}|010-82666200-[0-9]{4}$/,
    pwdReg = /(?=.*[a-zA-Z])(?=.*[0-9\.@#\$%\^&\*\(\)\[\]\\?\\\/\|\-~`\+\=\,\r\n\:\'\"]).{6,20}/;

$sendBtn.click(function () {
    $('.error-tip').hide();
    var yzm = $(this);
    var agx = typeof (again) == 'undefined' ? 0 : again;
    var numTime = 120;
    var Timer = null;
    yzm.removeAttr('disabled');
    var phone_mob = $('#phone_mob').val();

    var ph_zz = /^1[3|4|5|8|7][0-9]{9}$/;
    if (!ph_zz.test(phone_mob)) {
        $('#phone_mob').parent().find('.error-tip').text("手机号码不正确").show();
        return false;
    }
    $.ajax({
        dataType: 'json',
        url: '/ajax/captcha-send',
        data: {"phone_mob": phone_mob, "type": type, 'again': agx},
        success: function (data) {
            if (data.code == 1) {
                Timer = setInterval(function () {
                    numTime--;
                    if (numTime <= 0) {
                        yzm.html('重新发送'); //重新发送
                        yzm.removeAttr('disabled').removeClass('sending-button');
                        clearInterval(Timer);
                        numTime = 120;
                    }
                    else {
                        yzm.html(numTime + '秒后重发');
                        yzm.attr('disabled', "disabled").addClass('sending-button');
                    }
                }, 1000);
                return true;
            } else {
                if (data.code == -2) {
                    var _obj = $('#auth_code');
                    if (type == 3 || type == 2) {
                        _obj = $('#verify_code');
                    }
                    if (_obj) {
                        _obj.parent().find('.error-tip').text(data.msg).show();
                    }
                } else if (data.code == 0) {
                    var _obj = type == 1 ? $('#phone_mob') : $('#auth_code');
                    _obj.parent().find('.error-tip').text(data.msg).show();
                }
                return false;
            }
        }
    });
    return false;
});
$newSendBtn.click(function () {
    var yzm = $(this);
    var numTime = 120;
    var Timer = null;
    yzm.removeAttr('disabled');
    var phone_mob = $('#new_phone_mob').val();

    if (!ph_zz.test(phone_mob)) {
        $('#new_phone_mob').parent().find('.error-tip').text("手机号码不正确").show();
        return false;
    }
    $.ajax({
        dataType: 'json',
        url: '/ajax/captcha-send',
        data: {"phone_mob": phone_mob, 'type': type, 'again': 1},
        success: function (data) {
            if (data.code == 1) {
                Timer = setInterval(function () {
                    numTime--;
                    if (numTime <= 0) {
                        yzm.html('重新发送'); //重新发送
                        yzm.removeAttr('disabled').removeClass('sending-button');
                        clearInterval(Timer);
                        numTime = 120;
                    }
                    else {
                        yzm.html(numTime + '秒后重发');
                        yzm.attr('disabled', "disabled").addClass('sending-button');
                    }
                }, 1000);
                return true;
            } else {
                $('#new_verify_code').parent().find('.error-tip').text(data.msg).show();
                return false;
            }
        }
    });
    return false;
});


var idcardValidate = {
    'obj': {
        'idcard': $('#idcard'),
        'uname': $('#user_name'),
        'verify': $('#verify_code'),
        'passwd': $('#passwd'),
        'idcard': $('#idcard'),
        'mob': $('#phone_mob'),
        'bank': $('#bank_no'),
        'err': $('.error-tip')
    },
    'errNum': 0,
    valiIdcard: function () {
        this.ok('idcard');
        var idcard = this.obj.idcard.val();
        if (idcard == "") {
            this.error("身份证号不能为空", 'idcard');
            // return false;
        }
        var r = checkCardNotAlert();
        if (r) {
            this.error(r, 'idcard');
            // return false;
        }
    },
    valiUserName: function () {
        this.ok('user_name');
        var uname = this.obj.uname.val();
        if (uname == "") {
            this.error("真实姓名不能为空", 'user_name');
            // return false;
        }
    },
    valiBank: function () {
        this.ok('bank_no');
        var bank = this.obj.bank.val();
        if (bank == "") {
            this.error("银行卡号不能为空", 'bank_no');
        } else {
            bank.length < 12 && this.error("卡号位数不足", 'bank_no');
        }
    },
    valiPasswd: function () {
        this.ok('passwd');
        var passwd = this.obj.passwd.val();
        if (passwd == "") {
            this.error("交易密码不能为空", 'passwd');
        } else {
            !pwdReg.test(passwd) && this.error("由字母加数字或符号至少两种以上字符组成的6-20位半角字符，区分大小写", 'passwd');
        }
    },
    valiMob: function () {
        this.ok('phone_mob');
        var mob = this.obj.mob.val();
        if (mob == "") {
            this.error("手机号码不能为空", 'phone_mob');
        } else {
            !mobileReg.test(mob) && this.error("手机号码格式不正确", 'phone_mob');
        }
    },
    valiVerify: function () {
        this.ok('verify_code');
        var verify = this.obj.verify.val();
        if (verify == "") {
            this.error("验证码不能为空", 'verify_code');
        }
    },
    error: function ($err, $id, $server) {
        $('#' + $id).parent().find('.block-tip').hide();
        $('#' + $id).parent().find('.error-tip').html($err).show();
        !$server && ++this.errNum;
        return false;
    },
    ok: function ($id) {
        $('#' + $id).parent().find('.error-tip').hide();
    },
    init: function () {
        this.obj.err.hide();
        this.errNum = 0;
        this.obj.uname.length > 0 && this.valiUserName();
        this.obj.idcard.length > 0 && this.valiIdcard();
        this.obj.bank.length > 0 && this.valiBank();
        this.obj.mob.length > 0 && this.valiMob();
        this.obj.passwd.length > 0 && this.valiPasswd();
        this.valiVerify();
    },
    start: function () {
        var self = this,
            start = function () {
                $.post('/ajax/user-idcard', $('#form').serialize(), function (json) {
                    if (json.code == 1) {
                        FnApp.errorJs('绑定成功');
                        window.location.reload();
                    } else {
                        self.error(json.msg, json.id, 1);
                    }
                })
            };
        $('.form-box-idcard').on('click', '.submit-button', function () {
            self.init();
            console.log(self.errNum);
            self.errNum == 0 && start();
        }).on('blur', '[id="idcard"]', function () {
            self.obj.idcard.length > 0 && self.valiIdcard();
        }).on('blur', '[id="user_name"]', function () {
            self.obj.uname.length > 0 && self.valiUserName();
        }).on('blur', '[id="bank_no"]', function () {
            self.obj.bank.length > 0 && self.valiBank();
        }).on('blur', '[id="phone_mob"]', function () {
            self.obj.mob.length > 0 && self.valiMob();
        }).on('blur', '[id="verify_code"]', function () {
            self.valiVerify();
        }).on('blur', '[id="passwd"]', function () {
            self.obj.passwd.length > 0 && self.valiPasswd();
        })
    }
}
idcardValidate.start();

//交易密码修改
$setPassword.click(function () {
    disErr();
    var passwd1 = $('#passwd1').val(),
        passwd2 = $('#passwd2').val(),
        // passwd = $('#passwd').val(),
        // md5pwd =  hex_md5(passwd),
        auth_code = $('#verify_code').val(),
        error = {},
        phone_mob = $('#phone_mob').val(),
        goodsId = typeof (gid) == 'undefined' ? 0 : gid,
        regErr = function (key, err) {
            if (!error[key]) {
                error[key] = err;
            }
        },
        setTradePwd = function () {
            $.ajax({
                dataType: 'json',
                url: '/ajax/set-trade-pwd',
                type: 'post',
                data: {'passwd': hex_md5(passwd1), '_csrf': csrf},
                success: function (json) {
                    if (json.code == 1) {
                        window.location.href = '/user/setting?act=password&ok=1/';
                        goodsId && setTimeout(function () {
                            window.location.href = '/secforum/' + goodsId + '.html'
                        }, 3000);
                    } else {
                        showErr({'passwd2':json.msg});
                    }
                }
            });
        }
    passwd1 == "" && regErr('passwd1', "交易密码不能为空");
    !pwdReg.test(passwd1) && regErr('passwd1',"交易密码必须是大于6位,由字母和数字组成");

    passwd2 == "" && regErr('passwd2', "确认密码不能为空");
    passwd2 != passwd1 && regErr('passwd2', "密码不一致");

    // passwd == "" && regErr('passwd', "登录密码不能为空");
    auth_code == "" && regErr('verify_code', "验证码不能为空");
    if (Object.keys(error).length) {
        showErr(error);
        return false;
    }
    $.ajax({
        dataType: 'json',
        url: '/ajax/captcha-user-auth-validate',
        data: {"phone_mob": phone_mob, 'code': auth_code, 'type': 3},
        success: function (json) {
            if (json.code == 1) {
                setTradePwd();
            } else {
                showErr({'verify_code':"验证码不正确"});
            }
        }
    });

    // $.ajax({
    //     dataType: 'jsonp',
    //     url: 'http://2.fengniao.com/ajax/sec-login/',
    //     async: false,
    //     data: {'action': 'secondHandlogin', 'username': userName, 'pw': md5pwd},
    //     success: function (json) {
    //         if (json.id == 1) {
    //
    //         } else {
    //             showErr({'passwd':"登录密码不正确"});
    //         }
    //     }
    // });
    return false;
})


//手机绑定修改
$setPhone.click(function () {
    disErr();
    var passwd = $('#passwd').val(),
        md5psw = hex_md5(passwd),
        auth_code = $('#auth_code').val(),
        phone_mob = $('#phone_mob').val(),
        error = {},
        regErr = function (key, err) {
            if (!error[key]) {
                error[key] = err;
            }
        },
        chkCode = function () {
            $.ajax({
                dataType: 'json',
                url: '/ajax/captcha-user-auth-validate',
                data: {"phone_mob": phone_mob, 'code': auth_code, 'op': 1, 'type': 1},
                success: function (json) {
                    if (json.code == 1) {
                        backurl ? window.location.href = backurl : window.location.reload();
                    } else {
                        showErr({'auth_code': '验证码不正确'});
                    }
                }
            });
        }
    passwd == "" && regErr('passwd', '登录密码不能为空');
    auth_code == "" && regErr('auth_code', '验证码不能为空');
    phone_mob == "" && regErr('phone_mob', '手机号不能为空');
    !mobileReg.test(phone_mob) && regErr('phone_mob', "手机号码格式不正确");

    if (Object.keys(error).length) {
        showErr(error);
        return false;
    }

    $.ajax({
        dataType: 'jsonp',
        url: 'http://2.fengniao.com/ajax/sec-login/',
        async: false,
        data: {'action': 'secondHandlogin', 'username': userName, 'pw': md5psw},
        success: function (json) {
            if (json.id == 1) {
                chkCode();
            } else {
                showErr({'passwd': '登录密码不正确'});
            }
        }
    });
    return false;
})

$selectWay.on('change',function () {
    var way = $(this).val(),
        setEle =$('.form-box .setEle');
    setEle.show();
    if(way==1){
        setEle.eq(1).hide();
    }else if(way==2){
        setEle.eq(0).hide();
        setEle.eq(3).hide();
    }else{
        setEle.eq(2).hide();
    }
})
$setNewPhoneStep1.on('click',function () {
    disErr();
    var auth_code = $('#auth_code').val(),
        way =$selectWay.val(),
        error ={},
        phone_mob = $('#phone_mob').val(),
        passwd= $('#passwd').val(),
        tradepasswd= $('#tradepasswd').val(),
        regErr = function (key, err) {
            if (!error[key]) {
                error[key] = err;
            }
        },
        chkCode =function () {
            if (auth_code){
                var res =
                    $.ajax({
                        url: '/ajax/captcha-user-auth-validate',
                        async: false,
                        dataType: 'json',
                        data: {"phone_mob": phone_mob, 'code': auth_code, "type": type},
                    }).responseText;
                res = eval("(" + res + ")");
                if (res.code != 1) {
                    regErr('auth_code', '验证码不正确');
                }
            }else {
                regErr('auth_code', '验证码不能为空');
            }
        },
        chkPhone =function () {
            if(phone_mob){
                !mobileReg.test(phone_mob) && regErr('phone_mob', "手机号码格式不正确");
            } else {
                regErr('phone_mob', '手机号不能为空');
            }
        },
        chkPasswd =function () {
             passwd == '' &&  regErr('passwd', '登录密码不能为空');
        },
        chkTradePasswd =function () {
            if(tradepasswd){
                var res =
                    $.ajax({
                        url: '/ajax/verify-trade-pwd',
                        async: false,
                        dataType: 'json',
                        data: {"passwd": hex_md5(tradepasswd)},
                    }).responseText;
                res = eval("(" + res + ")");
                if (res.code != 1) {
                    regErr('tradepasswd', res.msg);
                }
            }else{
                regErr('tradepasswd', '交易密码不能为空');
            }
        },
        way0 =function(){
            chkCode();
            chkPhone();
            chkPasswd();
        },
        way1 =function(){
            chkCode();
            chkPhone();
            chkTradePasswd();
        },
        way2 =function(){
            chkPasswd();
            chkTradePasswd();
        }
    if(way ==1) {
        way1();
    }else if(way==2){
        way2();
    }else{
        way0();
    }
    if (Object.keys(error).length) {
        showErr(error);
        return false;
    }else {
        if(way != 1 ){
            $.ajax({
                dataType: 'jsonp',
                url: 'http://2.fengniao.com/ajax/sec-login/',
                async: false,
                data: {'action': 'secondHandlogin', 'username': userName, 'pw': hex_md5(passwd)},
                success: function (json) {
                    if (json.id == 1) {
                        $('#step2').show();
                        //$('#step3 .successful-tip p em').text(json.item.phone_mob);
                        $('#step1,#step3').hide();
                    } else {
                        showErr({'passwd':"登录密码不正确"});
                    }
                }
            });
        }else {
            $('#step2').show();
            //$('#step3 .successful-tip p em').text(json.item.phone_mob);
            $('#step1,#step3').hide();
        }
    }
    return false;
})
$setNewPhoneStep2.click(function () {
    disErr();
    var auth_code = $('#new_verify_code').val(),
        error ={},
        phone_mob = $('#new_phone_mob').val(),
        passwd= $('#passwd').val(),
        tradepasswd= $('#tradepasswd').val(),
        regErr = function (key, err) {
            if (!error[key]) {
                error[key] = err;
            }
        },
        chkCode =function () {
            if (auth_code){
                var res =
                    $.ajax({
                        url: '/ajax/captcha-user-auth-validate',
                        data: {"phone_mob": phone_mob, 'code': auth_code, 'type': type, 'op': 1},
                        async: false,
                        dataType: 'json',
                    }).responseText;
                res = eval("(" + res + ")");
                if (res.code == 1) {
                    window.location.href = jumpUrl;
                }else{
                    regErr('new_verify_code', '验证码不正确');
                }
            }else {
                regErr('new_verify_code', '验证码不能为空');
            }
        },
        chkPhone =function () {
            if(phone_mob){
                !mobileReg.test(phone_mob) && regErr('new_phone_mob', "手机号码格式不正确");
            } else {
                regErr('new_phone_mob', '手机号不能为空');
            }
        }
    chkPhone();
    chkCode();
    if (Object.keys(error).length) {
        showErr(error);
        return false;
    }
    return false;
})
$('#setNewPhone #step3 .submit-button').click(function () {
    $('.error-tip').hide();
    var auth_code = $('#auth_code').val();
    if (auth_code == "") {
        $('#auth_code').parent().find('.error-tip').text("验证码不能为空").show();
        return false;
    }
    var phone_mob = $('#phone_mob').val();
    if (phone_mob == "") {
        $('#phone_mob').parent().find('.error-tip').text("手机号不能为空").show();
        return false;
    }
    $.ajax({
        dataType: 'json',
        url: '/ajax/captcha-user-auth-validate',
        data: {"phone_mob": phone_mob, 'code': auth_code, "type": type},
        success: function (json) {
            if (json.code == 1) {
                $('#step3').show();
                $('#step1,#step2').hide();
            } else {
                $('#auth_code').parent().find('.error-tip').text("验证码不正确").show();
                return false;
            }
        }
    });
    return false;
})
$('.modifyPhone').click(function () {
    window.location.href = setNewPhoneUrl;
})

$setBank.click(function () {
    var _this = $(this);
    $('.error-tip').hide();
    var bankno = $('#bankno').val();
    if (bankno == "") {
        $('#bankno').parent().find('.error-tip').text("银行卡号不能为空").show();
        return false;
    }
    var passwd = $('#passwd').val();
    if (passwd == "") {
        $('#passwd').parent().find('.error-tip').text("交易密码不能为空").show();
        return false;
    }
    passwd = hex_md5(passwd);
    $.ajax({
        dataType: 'json',
        url: authUrl,
        type: 'POST',
        data: {'act': 'bank', "bankno": bankno, 'passwd': passwd, '_csrf': csrf},
        success: function (json) {
            if (json.code == 1) {
                $('#end').show();
                $('#start').hide();
            } else {
                $('#' + json.id).parent().find('.error-tip').text(json.msg).show();
                _this.val('保 存').attr('disabled', false);
                return false;
            }
        }
    });
    $(this).val('提交中...').attr('disabled', true);
    // $('#form').submit();
    return true;
})

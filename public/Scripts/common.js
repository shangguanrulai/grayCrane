$.ajaxSetup({cache: false});
var charset = 'utf-8',
    NOTICETITLE = [],
    NOTICECURTITLE = document.title;
$(function () {
    //navigation
    (function () {
        var $target = $('#fn-2-navigation-layer'),
            $nav    = $target.find('span.J_classificationTrigger'),
            $drop   = $target.find('div.J_switchTab'),
            timer   = counter = null,
            isIdx   = location.pathname === '/' ? true : false; //是否首页

        if (isIdx === false) {
            $nav.hover(function () {
                $drop.show();
            }, function () {
                timer = setTimeout(function () {$drop.hide();},200);
            });

            $drop.hover(function(){clearTimeout(timer);},function(){$drop.hide();});
        }
        $drop.find('.J_item').hover(function(){
            var self = $(this);
            counter = setTimeout(function () {
                _hmt.push(['_trackEvent', '2_fengniao', 'hover-navigation',self.attr('rel')]);
            },500);
        },function(){
            clearTimeout(counter);
        });

        //公共选择分类tab切换
        $drop.on('mouseenter mouseout', '.J_item', function() {
            $(this).addClass('current-item').siblings('.J_item').removeClass('current-item');
            $(this).parents('.J_switchTab').find('.J_tabPanel[id=' + $(this).attr('rel') + ']').show().siblings('.J_tabPanel').hide();
        });
    })();
    
    //right fixed
    (function () {
        $('#fixedNav .nav-link').hover(function () {
            $(this).addClass('hover-item');
        },function () {
            $(this).removeClass('hover-item');
        })
    })();
    
    
    //search
    (function () {
        var search = $('#searchContainer'),
            tab = search.find('ul'),
            type = search.find('#type'),
            tcfg = ['price', 'buy', 'auction'],
            btn = search.find('#searchBtn'),
            ilayer = search.find('.search-focus-layerbox'),
            dlayer = search.find('.search-click-layerbox'),
            hotword= search.find('.hot-search-bar'),
            timer = {},
            kwd = search.find('#searchKwd');

        //The TAB to switch
        tab.on('click', 'li', function () {
            var idx = $(this).attr('index');
            _hmt.push(['_trackEvent', '2_fengniao', 'top-search-tab','tab-idex',idx]);
            $(this).addClass('current').siblings().removeClass('current');
            idx && type.val(parseInt(idx,10));
            hotword && hotword.hide() && hotword.filter('[index="'+ idx +'"]').show();
        });

        //default tab current
        var cfg = {
                "price": tab.find('[index="0"]'),
                "auction": tab.find('[index="2"]'),
                "buy": tab.find('[index="1"]')
            },
            ua = window.location.pathname.split('/');
        ua && ua[1] && cfg[ua[1]] && cfg[ua[1]].click();


        //kwd
        kwd.on({
            'focus': function () {
                $.get('/common/search-init', {"type": type.val(), "t": (new Date()).getTime()}, function (html) {
                    ilayer.html(html).off().on('click', '.record', function () {
                        clearTimeout(timer.ilayer);
                        var u = $(this).attr('url').toString();
                        kwd.val($(this).text()) && btn.attr('url', u) && btn.click();
                    }).on('click', '.clear-link', function () {
                        clearTimeout(timer.ilayer);
                        //clear
                        $.get('/common/search-clear', {"t": (new Date()).getTime()}, function (json) {
                            ilayer.find('.record-list').empty();
                        }, 'json');
                    }).show();
                })
            }
            , 'blur': function () {
                timer.ilayer = setTimeout(function () {
                    ilayer.hide();
                    dlayer.hide();
                }, 300);
            }
            , 'keyup': function (event) {
                if (kwd.val() == '') {
                    dlayer.hide();
                    ilayer.show();
                    return;
                }
                clearTimeout(timer.kinput);
                if (event.keyCode === 13) {
                    var ck = dlayer.find('.search-tag.hover');
                    return ck.length > 0 ? ck.click() : btn.click();
                }

                //上下箭头
                if (event.keyCode === 40 || event.keyCode === 38) {
                    var idx = dlayer.find('.search-tag').index(dlayer.find('.hover')),
                        len = dlayer.find('.search-tag').size(),
                        next = 0;

                    if (event.keyCode == 38) {
                        next = (idx == 0) ? len - 1 : idx - 1;
                    } else if (event.keyCode == 40) {
                        next = (idx == len - 1) ? 0 : idx + 1;
                    }

                    dlayer.find('.search-tag').removeClass('hover');
                    dlayer.find('.search-tag:eq(' + next + ')').addClass('hover');
                    return;
                }
                timer.kinput = setTimeout(function () {

                    var data = {"kwd": kwd.val(), "type": type.val(), "t": (new Date()).getTime()};
                    $.get('/common/search-data', data, function (html) {
                        ilayer.hide();
                        dlayer.html(html).off().on('click', '.search-tag', function (event) {
                            event.preventDefault();
                            var u = $(this).attr('url').toString();
                            btn.attr('url', u) && btn.click();
                        }).on('mouseenter', '.search-tag', function () {
                            dlayer.find('.search-tag').removeClass('hover');
                            $(this).addClass('hover');
                        }).show();
                    });
                }, 100);
            }
        });

        //ilayer
        ilayer.on('click', function () {
            //clearTimeout(timer.ilayer);
        })

        //go search
        btn.on('click', function (event) {
            var keyword = kwd.val(),
                url = $(this).attr('url'),
                t = tcfg[type.val()];

            clearTimeout(timer.kinput);
            if (!keyword || !t) return;
            //add search record
            $.get('/common/search-record', {
                'kwd': keyword,
                'type': type.val(),
                "url": url,
                "t": (new Date()).getTime()
            }, function (json) {
                var u = url ? url : ((json && json.info == 'ok') ? json.options.url : '');
                if (u)window.location.href = u;
            }, 'json');
        })

    })();

});

//初始化公用错误提示框
function _initErrorDialog(id) {
    id = id ? id : 'errorTipDialog';
    $("#" + id).dialog({
        autoOpen: false,
        width: 436,
        height: "auto",
        modal: true,
        title: "错误提示",
        buttons: {
            '返回': function () { //返回
                $(this).dialog("close");
                // window.location.reload();
            }
        }
    });
}

function chkNum(str) {
    var pzz = /^[0-9]*$/;
    return pzz.test(str);
}
function chkPriceNum(price) {
    return (!isNaN(price) && price > 0 && price <= 999999 && chkNum(price));
}
function jsError(error) {
    $('#errorTipDialog p').html(error);
    $("#errorTipDialog").dialog("open");
    return false;
}
function mb_strlen(str) {
    var len = 0;
    for (var i = 0; i < str.length; i++) {
        len += str.charCodeAt(i) < 0 || str.charCodeAt(i) > 255 ? (charset == 'utf-8' ? 2 : 2) : 1;
    }
    return len;
}


/* 格式化金额 */
function price_format(price) {
    if (typeof(PRICE_FORMAT) == 'undefined') {
        PRICE_FORMAT = '%s';
    }
    price = number_format(price, 2);

    return PRICE_FORMAT.replace('%s', price);
}

function number_format(num, ext) {
    if (ext < 0) {
        return num;
    }
    num = Number(num);
    if (isNaN(num)) {
        num = 0;
    }
    var _str = num.toString();
    var _arr = _str.split('.');
    var _int = _arr[0];
    var _flt = _arr[1];
    if (_str.indexOf('.') == -1) {
        /* 找不到小数点，则添加 */
        if (ext == 0) {
            return _str;
        }
        var _tmp = '';
        for (var i = 0; i < ext; i++) {
            _tmp += '0';
        }
        _str = _str + '.' + _tmp;
    } else {
        if (_flt.length == ext) {
            return _str;
        }
        /* 找得到小数点，则截取 */
        if (_flt.length > ext) {
            _str = _str.substr(0, _str.length - (_flt.length - ext));
            if (ext == 0) {
                _str = _int;
            }
        } else {
            for (var i = 0; i < ext - _flt.length; i++) {
                _str += '0';
            }
        }
    }

    return _str;
}

var GOODS = {
    /*配置*/
    config: {},
    browser: { //手机服务版本
        versions: function () {
            var u = navigator.userAgent, app = navigator.appVersion;
            return {//移动终端浏览器版本信息
                trident: u.indexOf('Trident') > -1, //IE内核
                presto: u.indexOf('Presto') > -1, //opera内核
                webKit: u.indexOf('AppleWebKit') > -1, //苹果、谷歌内核
                gecko: u.indexOf('Gecko') > -1 && u.indexOf('KHTML') == -1, //火狐内核
                mobile: !!u.match(/AppleWebKit.*Mobile.*/) || !!u.match(/AppleWebKit/), //是否为移动终端
                ios: !!u.match(/\(i[^;]+;( U;)? CPU.+Mac OS X/), //ios终端
                android: u.indexOf('Android') > -1 || u.indexOf('Linux') > -1, //android终端或者uc浏览器
                iPhone: u.indexOf('iPhone') > -1 || u.indexOf('Mac') > -1, //是否为iPhone或者QQHD浏览器
                iPad: u.indexOf('iPad') > -1, //是否iPad
                webApp: u.indexOf('Safari') == -1 //是否web应该程序，没有头部与底部
            };
        }(),
        language: (navigator.browserLanguage || navigator.language).toLowerCase()
    },
    log: function (str) {
        //console.log(str);
    },
    /**
     * @初始化商品收藏
     * @method _initGoodsAttention
     */
    _initGoodsAttention: function (goods_ids) {
        var _this = this;
        var spanclass = spantext = '';
        $.ajax({
            url: '/ajax/goods-collect-view',
            type: "get",
            dataType: "json",
            data: {'goods_ids': goods_ids},
            success: function (json) {
                if (json.code == 1) {
                    $.each(json.item, function (k, v) {
                        spanclass = v == 1 ? 'followed-button' : 'follow-button';
                        spantext = v == 1 ? '已收藏' : '+收藏';
                        $('.goods-list .cls_' + k + ' span').text(spantext).removeClass().addClass(spanclass);
                        if (v == 0) {
                            $('.goods-list .cls_' + k + ' span').attr('onclick', 'GOODS.attentionGoods(' + k + ',this)')
                        }
                    })
                }
            },
            error: function () {
                //do some thing
            }
        });
    },
    /**
     * @收藏商品
     * @method attentionGoods
     */
    attentionGoods: function (goods_id, showele) {
        $.ajax({
            dataType: 'json',
            url: '/ajax/goods-collect',
            data: {'goods_id': goods_id},
            success: function (json) {
                if (json.code == 1) {
                    $(showele).removeAttr('onclick').removeClass().addClass('followed-button').html('已收藏');
                }
            }
        });
    }
}

function isNumberOrLetter(s) {
    //判断是否是数字或字母 
    var regu = "^[0-9a-zA-Z]+$";
    var re = new RegExp(regu);
    if (re.test(s)) {
        return true;
    }
    else {
        return false;
    }
};

function quickLogin() {
    // $('#loginDialog').dialog({
    //     autoOpen: false,
    //     width: 310,
    //     dialogClass: "login-dialog",
    //     modal: true,
    //     buttons: []
    // });
    //
    // $('#loginDialog').dialog("open");
    // return true;

    publicLoginObj.init();
}

var publicLoginObj = {
    'init':function(){
        this.wxLoginInit();

        $('#commonLoginDialog').dialog({
            autoOpen: false,
            width: 470,
            dialogClass: "commonLogin-dialog-wrap",
            modal: true,
            buttons: [],
            close:function()
            {
                publicLoginObj.wxLoginPollingClear();
            }
        });

        $('#commonLoginDialog').dialog("open");

        if( this.time == false )
        {
            this.time = setInterval( function(){
                var box = $( '#commonMessageDialog .getCodeBtn' );
                var time = box.attr( 'time' ) - 1;

                if( time <= 60 && time > 0  )
                {
                    if( !box.hasClass( 'disabled' ) )
                    {
                        box.addClass( 'disabled' );
                    }

                    box.html( time );
                    box.attr( 'time', time );

                }
                else if( time == 0 )
                {
                    box.html( '获取动态密码' );
                    box.attr( 'time', time );
                }
                publicLoginObj.checkPhone();
            }, 1000 );
        }

        return true;
    },
    'time':false,
    'bindEvent':function(){
        this.bindTab();
        this.nomal();
        this.bindPhoneChange();
        this.check();
        this.phone();
        this.userNameChange();
        this.ohterChange();
        this.scanWechatChange();
        this.messageChange();
        this.scanWechatOver();
    },
    /*'bindTab':function(){
        $( document ).on('click','#commonLoginDialog .exchange-link',function(){
            if($(this).hasClass('message-link') || $(this).hasClass('link-message-login')){
                $(this).parents('#commonUserNameDialog').hide().siblings('#commonMessageDialog').show();
                $('#userNameLink').hide();
                $('#scanLink').show();
            }else{
                $(this).parents('#commonMessageDialog').hide().siblings('#commonUserNameDialog').show();
                $('#userNameLink').hide();
                $('#scanLink').show();
            }
        });
    },*/
    'messageChange':function(){
        $( document ).on('click','#commonLoginDialog .link-message-login',function(){
            $('#commonLoginDialog').find('.commonLoginDialog-form').hide();
            $('#commonMessageDialog').show();
            $('#userNameLink').hide();
            $('#scanLink').show();
            $('#otherLink').show();
        });
    },
    'userNameChange':function(){
        $( document ).on('click','#commonLoginDialog .user-name-link',function(){
            $('#commonLoginDialog').find('.commonLoginDialog-form').hide();
            $('#commonUserNameDialog').show();
            $('#userNameLink').hide();
            $('#scanLink').show();
            $('#otherLink').show();
        });
    },
    'ohterChange':function(){
        $( document ).on('click','#commonLoginDialog .other-link',function(){
            $('#commonLoginDialog').find('.commonLoginDialog-form').hide();
            $('#otherLoginDialog').show();
            $('#otherLink').hide();
            $('#scanLink').show();
            $('#userNameLink').show();

        });
    },
    'scanWechatChange':function(){
        $( document ).on('click','#commonLoginDialog .scan-wechat-link,#commonLoginDialog .scan-link,#commonLoginDialog .link-scan-wechat',function(){
            publicLoginObj.wxLoginInit();

            $('#commonLoginDialog').find('.commonLoginDialog-form').hide();
            $('#scanLoginDialog').show();
            $('#otherLink').show();
            $('#scanLink').hide();
            $('#userNameLink').show();

        });
    },
    'bindPhoneChange':function(){
        $( document ).on('change keyup paste copy cut blur focus','#commonLoginDialog #commonLoginUserMobile',function(){
            publicLoginObj.checkPhone();
        });
    },
    'scanWechatOver':function(){

        $(document).on('mouseenter','#commonLoginDialog .pic-box',function(){
            $(this).stop().animate({
                'margin-left' : '-90px'
            });

            $(this).find('.default-pic').stop().animate({
                'right' : '-120px'
            });
        });
        $(document).on('mouseleave','#commonLoginDialog .pic-box',function(){
            $(this).stop().animate({
                'margin-left' : '0'
            });

            $(this).find('.default-pic').stop().animate({
                'right' : '-270px'
            });
        });
    },
    'checkPhone':function(){
        var box = $( '#commonMessageDialog .getCodeBtn' );

        if( box.attr( 'time' ) != '0' )
        {
            return;
        }

        var phone = $( '#commonLoginUserMobile' ).val(),
            preg = /^\d{11}$/,
            pre = preg.test( phone );

        if( pre )
        {
            box.removeClass( 'disabled' );
        }
        else
        {
            box.addClass( 'disabled' );
        }
    },
    'nomal':function(){
        $( document ).on('click','#commonLoginDialog .nomal',function(){
            var userName = $( '#commonLoginDialog #commonLoginUserName' ).val();
            var passWord = $( '#commonLoginDialog #commonLoginPasswd' ).val();
            passWord = hex_md5( passWord );

            $.ajax({
                'type':'get',
                'url':'/login/nomal',
                'data':{
                    'userName':userName,
                    'passWord':passWord
                },
                'dataType':'json',
                'success':function( data ){
                    if( data.flag == 1 )
                    {
                        window.location.reload();
                    }
                    else
                    {
                        $( '#commonUserNameDialog .tip' ).show().html( data.msg );
                    }
                }
            })
        });
    },
    'check':function(){
        $( document ).on( 'click', '#commonMessageDialog .getCodeBtn', function(){
            if( !$( this ).hasClass( 'disabled' ) )
            {

                $.ajax({
                    dataType: 'json',
                    url: '/common/geetest-register',
                    data: {'t': (new Date()).getTime()},
                    type: 'get',
                    success: function ( data ) {
                        // 使用initGeetest接口
                        // 参数1：配置参数
                        // 参数2：回调，回调的第一个参数验证码对象，之后可以使用它做appendTo之类的事件
                        initGeetest({
                            gt: data.msg.gt,
                            challenge: data.msg.challenge,
                            product: "popup", // 产品形式，包括：float，embed，popup。注意只对PC版验证码有效
                            offline: !data.msg.success, // 表示用户后台检测极验服务器是否宕机，一般不需要关注
                            // 更多配置参数请参见：http://www.geetest.com/install/sections/idx-client-sdk.html#config
                        }, function( commonCaptchaObj ){
                            commonCaptchaObj.appendTo("#commonLoginPopupCaptcha");

                            commonCaptchaObj.onReady(function () {
                                commonCaptchaObj.show();
                            });

                            //验证码成功之后回调
                            commonCaptchaObj.onSuccess(function () {
                                var validate = commonCaptchaObj.getValidate();
                                var phone = $( '#commonLoginUserMobile' ).val();

                                $.ajax({
                                    'type':'post',
                                    'dataType':'json',
                                    'url':'/login/get-code',
                                    'data':{
                                        'challenge' : validate.geetest_challenge,
                                        'validate' : validate.geetest_validate,
                                        'seccode' : validate.geetest_seccode,
                                        'phone' : phone
                                    },
                                    'success':function( data ){
                                        if( data.flag == 1 )
                                        {
                                            $( '#commonMessageDialog .tip' ).hide().html( '' );

                                            $( '#commonMessageDialog .getCodeBtn' ).attr( 'time', '60' );
                                        }
                                        else
                                        {
                                            $( '#commonMessageDialog .tip' ).show().html( data.msg );
                                        }
                                    }
                                });
                            });
                        });
                    }
                });
            }
        } );
    },
    'phone':function(){
        $( document ).on( 'click', '#commonMessageDialog .commonLogin-button', function(){

            var phone = $( '#commonLoginUserMobile' ).val();
            var code = $( '#commonLoginCode' ).val();

            $.ajax({
                'type':'get',
                'dataType':'json',
                'url':'/login/phone',
                'data':{
                    'phone' : phone,
                    'code' : code
                },
                'success':function( data ){
                    if( data.flag == 1 )
                    {
                        $( '#commonMessageDialog .tip' ).hide().html( '' );
                        window.location.reload();
                    }
                    else
                    {
                        $( '#commonMessageDialog .tip' ).show().html( data.msg );
                    }
                }
            });
        } );
    },
    'wxLoginInit':function()
    {
        this.wxLoginPollingClear();

        $.ajax({
            'type':'get',
            'dataType':'json',
            'url':'/ajax/wechat-login-qrcode',
            'success':function( data ){
                if( data.flag == 1 )
                {
                    $( '#commonLoginDialog #wxLoginQR' ).attr( 'src', data.data.qrcode_url );
                    publicLoginObj.wxLoginTicket = data.data.ticket;
                    publicLoginObj.wxLoginPolling();
                }
            }
        });
    },
    'wxLoginPolling':function()
    {
        this.wxLoginPollingClear();

        this.wxLoginIntval = setInterval( function(){

            $.ajax({
                'type':'get',
                'dataType':'json',
                'url':'/ajax/wechat-login-qrcode',
                'data':{
                    type:1,
                    ticket:publicLoginObj.wxLoginTicket
                },
                'success':function( data )
                {
                    if( data.flag == 1 )
                    {
                        window.location.reload();
                    }
                }
            });
        }, 2000 );
    },
    'wxLoginIntval':false,
    'wxLoginTicket':false,
    'wxLoginPollingClear':function()
    {
        if( this.wxLoginIntval !== false )
        {
            clearInterval( this.wxLoginIntval );
        }
    }
};

publicLoginObj.bindEvent();

function regValidatePic() {
    $('#imageCode').attr('src', 'http://my.fengniao.com/validate.php?t=' + (new Date).valueOf());
}

function doLogin() {
    $('#loginDialog').find('.tip').hide();
    var username = $('#loginUserName').val();
    if (!username) {
        $('#loginUserName').parent().find('.tip').show();
        return false;
    }
    var pw = $('#loginPasswd').val();
    if (!pw) {
        $('#loginPasswd').parent().find('.tip').show();
        return false;
    }

    var checkcode = $('#loginCode').val();
    pw = hex_md5(pw);
    $.ajax({
        dataType: 'jsonp',
        url: 'http://2.fengniao.com/ajax/sec-login/',
        data: {action: "login", username: username, pw: pw, checkcode: checkcode},
        async: false,
        success: function (json) {
            if (json.id == 1) {
                window.location.reload()
            } else {
                $('#loginPasswd').parent().find('.tip').text('密码或验证码错误').show();
            }
        }
    });
}


var FnApp = {
    mdjs: 'http://icon.fengniao.com/fn_mall/js/public/md5.js'
    //loader
    , loadScript: function (url, callback) {
        var callback = callback || function () {
            };
        var _script = document.createElement("script");
        if (_script.readyState) { //IE
            _script.onreadystatechange = function () {
                if (_script.readyState == "loaded" || _script.readyState == "complete") {
                    _script.onreadystatechange = null;
                    callback();
                }
            };
        } else { //Others: Firefox, Safari, Chrome, and Opera
            _script.onload = function () {
                callback();
            };
        }
        ;
        _script.src = url;
        document.body.appendChild(_script);
    }

    , nowTime: Math.round(new Date().getTime() / 1000)

    //countdown
    , countdown: function (target, callback) {
        if (!target) return false;
        var self = this, timer = null, callback = callback || function(){};
        $(target).each(function () {
            var remain = $(this).attr('remain');
            if (remain && remain > 0) {
                var real = parseInt(remain, 10) + self.nowTime,
                    time = Math.round(new Date().getTime() / 1000),
                    youtime = real - time,//还有多久
                    seconds = youtime,
                    minutes = Math.floor(seconds / 60),
                    hours = Math.floor(minutes / 60),
                    days = Math.floor(hours / 24),
                    CDay = days,
                    CHour = hours % 24,
                    CMinute = minutes % 60,
                    CSecond = Math.floor(seconds % 60),//取余
                    html = '';
                html += CDay ? CDay + '天' : '';
                html += CHour ? CHour + '时' : '';
                html += CMinute ? CMinute + '分' : '';
                html += CSecond ? CSecond + '秒' : '';
                $(this).html(html);
                callback();
            }
        });
        timer = setTimeout(function () {
            self.countdown(target);
        }, 1000)
        return $(target);
    }

    //countdownList 列表倒计时
    , countdownList: function (target, callback) {
        if (!target) return false;
        var self = this, timer = null, callback = callback || function(){};
        $(target).each(function () {
            var remain = $(this).attr('remain');
            if (remain && remain > 0) {
                var real = parseInt(remain, 10) + self.nowTime,
                    time = Math.round(new Date().getTime() / 1000),
                    t = real - time,//还有多久
                    d = Math.floor(t / 60 / 60 / 24),
                    h = Math.floor(t / 60 / 60 % 24),
                    m = Math.floor(t / 60 % 60),
                    s = Math.floor(t % 60);
                
                callback($(this),d,h,m,s);
            }
        });
        timer = setTimeout(function () {
            self.countdownList(target,callback);
        }, 1000)
        return $(target);
    }

    /**
     * 获取字符串长度
     */
    , mbStrLen: function (str) {
        var len = 0;
        for (var i = 0; i < str.length; i++) {
            len += str.charCodeAt(i) < 0 || str.charCodeAt(i) > 255 ? 3 : 1;
        }
        ;
        return len;
    }

    /**
     * 字符串截取
     */
    , mbSubstr: function (str, maxlen, dot) {
        var len = 0;
        var ret = '';
        var dot = dot || '';
        maxlen = maxlen - dot.length;
        for (var i = 0; i < str.length; i++) {
            len += str.charCodeAt(i) < 0 || str.charCodeAt(i) > 255 ? 3 : 1;
            if (len > maxlen) {
                ret += dot;
                break;
            }
            ;
            ret += str.substr(i, 1);
        }
        ;
        return ret;
    }
    , setcookie: function (cookieName, cookieValue, seconds, path, domain, secure) {
        if (cookieValue == '' || seconds < 0) {
            cookieValue = '';
            seconds = -2592000;
        }
        if (seconds) {
            var expires = new Date();
            expires.setTime(expires.getTime() + seconds * 1000);
        }
        domain = !domain ? cookiedomain : domain;
        path = !path ? cookiepath : path;
        document.cookie = escape(cookiepre + cookieName) + '=' + escape(cookieValue)
            + (expires ? '; expires=' + expires.toGMTString() : '')
            + (path ? '; path=' + path : '/')
            + (domain ? '; domain=' + domain : '')
            + (secure ? '; secure' : '');
    }
    , getcookie: function (name, nounescape) {
        name = cookiepre + name;
        var cookie_start = document.cookie.indexOf(name);
        var cookie_end = document.cookie.indexOf(";", cookie_start);
        if (cookie_start == -1) {
            return '';
        } else {
            var v = document.cookie.substring(cookie_start + name.length + 1, (cookie_end > cookie_start ? cookie_end : document.cookie.length));
            return !nounescape ? unescape(v) : v;
        }
    }
    , checkall: function (form, prefix, checkall) {
        var checkall = checkall ? checkall : 'chkall';
        count = 0;
        for (var i = 0; i < form.elements.length; i++) {
            var e = form.elements[i];
            if (e.name && e.name != checkall && !e.disabled && (!prefix || (prefix && e.name.match(prefix)))) {
                e.checked = form.elements[checkall].checked;
                if (e.checked) {
                    count++;
                }
            }
        }
        return count;
    }
    , noticeTitle: function () {
        NOTICETITLE = {'State': 0, 'oldTitle': NOTICECURTITLE, flashNumber: 0, sleep: 15};
        if (!getcookie('noticeTitle')) {
            window.setInterval('noticeTitleFlash();', 500);
        } else {
            window.setTimeout('noticeTitleFlash();', 500);
        }
        setcookie('noticeTitle', 1, 600);
    }
    , noticeTitleFlash: function () {
        if (NOTICETITLE.flashNumber < 5 || NOTICETITLE.flashNumber > 4 && !NOTICETITLE['State']) {
            document.title = (NOTICETITLE['State'] ? '【　　　】' : '【新提醒】') + NOTICETITLE['oldTitle'];
            NOTICETITLE['State'] = !NOTICETITLE['State'];
        }
        NOTICETITLE.flashNumber = NOTICETITLE.flashNumber < NOTICETITLE.sleep ? ++NOTICETITLE.flashNumber : 0;
    }
    ,errorJs : function(err){
        var errorDio  = $('#errorTipDialog'),
            init = function () {
                var errdiv = document.createElement('div');
                errdiv.id  = 'errorTipDialog';
                errdiv.style.textAlign='center';
                errdiv.style.paddingTop='15px';
                errdiv.innerHTML = '<p>加载中...</p>';
                document.body.appendChild(errdiv);
                errorDio = $('#errorTipDialog');
            }
        !errorDio.length && init.call();
        errorDio.dialog({
            autoOpen: false,
            closeText:'关闭',
            width: 436,
            height: "auto",
            modal: true,
            title: "提示",
            buttons: {
                '返回': function () { //返回
                    $(this).dialog("close");
                }
            }
        });
        errorDio.find("p").html(err);
        errorDio.dialog("open");
        return false;
    }
}

function _initPrivateLetter(uid ,title) {
    if (jsChkUserLogin()) return false;
    var talkusername  = PrivateLetter.getCookie('talkusername'),
        talkuserid= PrivateLetter.getCookie('talkuserid');
    if ($('.privateLetter-box').hasClass('showPrivateLetter') && !uid) {
        $('.privateLetter-box').removeClass('showPrivateLetter');
        $('#shrinkPrivateLetterBox,#private_letter_right_bottom').show();
        PrivateLetter.stopleft();
        PrivateLetter.stopright();
        PrivateLetter.initrightbottom(PrivateLetter.user.userid?'':'close');
        if(talkuserid) {
            PrivateLetter.setCookie('talkid',PrivateLetter.getCookie('bbuserid'),'d1');
        }else {
            PrivateLetter.delCookie('talkuserid');
            PrivateLetter.delCookie('talkusername');
        }
    } else {
        if (uid) { //create relation
            var res =
                $.ajax({
                    url: "/user/ajax",  //url
                    async: false,
                    dataType: 'json',
                    data: {'act': 'personalMessage', 'toUserId': uid, 'op': 'create'}
                }).responseText;
            res = eval("(" + res + ")");
            if (res.code == 0) {
                return false;
            }
        }
        var url = "/user/privateLetter";  //url

        $.ajax({
            url: url,
            type: "get",
            data: {'uid': uid},
            success: function (html) {
                if(html.code==0){
                    return FnApp.errorJs(html.msg);
                }else {
                    $('.privateLetter-box').html(html).addClass('showPrivateLetter');
                    PrivateLetter.tsb();
                    title && PrivateLetter.inittitle(title)  ;
                    $('#shrinkPrivateLetterBox,#private_letter_right_bottom').hide();
                }
            }
        });
    }
    return false;
}
function jsChkUserLogin() {
    var url = '/user/ajax?act=chkUserLogin';
    var res =
        $.ajax({
            url: url,
            async: false,
            dataType: 'json'
        }).responseText;
    res = eval("(" + res + ")");
    if (res.code == -1) {
        quickLogin();
        return true;
    }
    return false;
}
//私信弹出
function privateLetterBoxFN() {
    $('.product-parameter').on('click', '.tag.message-tag', function () {
        if ($('.privateLetter-box').hasClass('showPrivateLetter')) {
            $('.privateLetter-box').animate({
                bottom: "-398px",
                right: "-600px"
            }, 0).removeClass('showPrivateLetter');
        } else {
            $('.privateLetter-box').animate({
                bottom: "50px",
                right: "30px"
            }, 0).addClass('showPrivateLetter');
        }
    });

    $('#shrinkPrivateLetterBox').on('click', function () {
        if ($('.privateLetter-box').hasClass('showPrivateLetter')) {
            $('.privateLetter-box').animate({
                bottom: "-398px",
                right: "-600px"
            }, 0).removeClass('showPrivateLetter');
        } else {
            $('.privateLetter-box').animate({
                bottom: "50px",
                right: "30px"
            }, 0).addClass('showPrivateLetter');
        }
    });
}
function strlen(obj) {
    var len, i;
    for (i = 0; i < obj.length; i++) {
        if (obj.charCodeAt(i) > 127 || obj.charCodeAt(i) == 94) {
            len += 2;
        } else {
            len++;
        }
    }
    return len;
}

//底部吸底
;(function () {
    if ($('body').height() < ($(window).height() - $('.top-bar').height())) {
        $('div.foot').addClass('fixed-footer');
    } else {
        $('div.foot').removeClass('fixed-footer');
    }
})();
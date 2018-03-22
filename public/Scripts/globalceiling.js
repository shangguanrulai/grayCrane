var globalCeilingTools = {
    getCookie: function (name) {
        var cookieValue = "";
        var search_s = name + "=";
        if (document.cookie.length > 0) {
            offset = document.cookie.indexOf(search_s);
            if (offset != -1) {
                offset += search_s.length;
                end = document.cookie.indexOf(";", offset);
                if (end == -1) end = document.cookie.length;
                var value = document.cookie.substring(offset, end);
                cookieValue = decodeURIComponent(value.replace(/\+/g, ' '));
            }
        }
        return cookieValue;
    },
    setCookie: function (name, value, expires) {
        document.cookie = name + "=" + escape(value) +
            ("; expires=" + expires.toGMTString()) +
            ("; path=/") +
            ("; domain=.fengniao.com");
    },
    ajax: function (json) {
        var xhr = null;
        if (window.XMLHttpRequest) {
            xhr = new XMLHttpRequest();
        } else {
            xhr = new ActiveXObject('Microsoft.XMLHTTP')
        }
        var j = {
            method: json.method || 'get',
            url: json.url || '',
            data: json.data || '',
            async: json.async || true,
            success: json.success || function () {
            },
            error: json.error || function () {
            }
        }

        var type = j.method.toUpperCase();
        // 用于清除缓存
        var random = Math.random();

        if (typeof j.data == 'object') {
            var str = '';
            for (var key in j.data) {
                str += key + '=' + j.data[key] + '&';
            }
            data = str.replace(/&$/, '');
        }

        if (type == 'GET') {
            if (j.data) {
                xhr.open('GET', j.url + '?' + j.data, j.async);
            } else {
                xhr.open('GET', j.url, j.async);
            }
            xhr.send();

        } else if (type == 'POST') {
            xhr.open('POST', j.url, j.async);
            // 如果需要像 html 表单那样 POST 数据，请使用 setRequestHeader() 来添加 http 头。
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.send(j.data);
        }

        // 处理返回数据
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4) {
                if (xhr.status == 200) {
                    j.success(xhr.responseText);
                } else {
                    if (j.error) {
                        j.error(xhr.status);
                    }
                }
            }
        }
    },
    injectCss: function (url) {
        var style = document.createElement("link");
        style.type = 'text/css';
        style.rel = 'stylesheet';
        style.href = url;

        var head = document.getElementsByTagName("head")[0];
        head.insertBefore(style, head.lastChild);
    },
    injectJs: function (url) {
        var script = document.createElement("script");
        script.type = "text/javascript";
        script.src = url;

        var head = document.getElementsByTagName("head")[0];
        head.insertBefore(script, head.lastChild);
    },
    addClass: function (obj, sClass) {
        var aClass = obj.className.split(' ');
        if (!obj.className) {
            obj.className = sClass;
            return;
        }
        for (var i = 0; i < aClass.length; i++) {

            if (aClass[i] == sClass)return;
        }
        obj.className += ' ' + sClass;
    },
    removerClass: function (obj, sClass) {
        var aClass = obj.className.split(' ');
        if (!obj.className)return;
        for (var i = 0; i < aClass.length; i++) {
            if (aClass[i] == sClass) {
                aClass.splice(i, 1);
                //删除数组中指定位置的值
                obj.className = aClass.join(' ');
            }
        }
    },
    getClassName: function (tag, className) {
        if (document.getElementsByClassName) {
            return document.getElementsByClassName(className);
        } else {
            var rel = [];
            var nodes = document.getElementsByTagName(tag);
            for (var i = 0; i < nodes.length; i++) {
                var liClassName = nodes[i].className.split(/\s+/);
                for (var j = 0; j < liClassName.length; j++) {
                    if (liClassName[j] == className) {
                        rel.push(nodes[i]);
                        break;
                    }
                }
            }
            return rel;
        }
    }
};

var secDomainName = '/';

var globalCeilingParams = {
    getMessageCountUrl: secDomainName + 'user/ajax?act=message',
    //cssSourceUrl:secDomainName + 'globalCeiling.css',
    pollInterval: 90,

    myOrderUrl: secDomainName + 'user/index?click_source=topbar',
    indexUrl: secDomainName,
    myBuyGoodsUrl: secDomainName + 'user/buy?click_source=topbar',
    myAuctionGoodsUrl: secDomainName + 'user/auction?type=0',
    myOfferGoodsUrl: secDomainName + 'user/buyerOffer?type=9',
    myCollectGoodsUrl: secDomainName + 'user/collect?type=0',
    myCollectSellerUrl: secDomainName + 'user/collect?type=9',
    myHistoryGoodsUrl: secDomainName + 'user/history',
    mySoldgoodsGoodsUrl: secDomainName + 'user/soldgoods',
    mySellerOfferGoodsUrl: secDomainName + 'user/sellerOffer',
    myRecycleUrl : secDomainName + 'myRecycle?click_source=topbar',
    mySaleGoodsUrl: secDomainName + 'user/myGoods?status=0&click_source=topbar',
    messageGlobalUrl: secDomainName + 'user/news?type=0&click_source=topbar',
    messageSystemUrl: secDomainName + 'user/news?type=1&click_source=topbar',
    messagePersonalUrl: secDomainName + 'user/news?type=3&click_source=topbar',
    messageLeaveUrl: secDomainName + 'user/news?type=2&click_source=topbar',
    helpCenterUrl: secDomainName + 'help/index?click_source=topbar',
    zmxyUrl: secDomainName + 'user/setting?act=index&click_source=topbar'
};

var globalCeilingRun = {
    loginUrl: 'http://my.fengniao.com/login.php?url=',
    logoutUrl: 'http://my.fengniao.com/login.php?action=logout&url=',
    registerUrl: 'http://my.fengniao.com/register.php?url=http://2.fengniao.com',
    userId: '',
    isStore : '',
    userName: '',
    pollStatus: '',

    run: function (callback) {
        // 注入css
        //globalCeilingTools.injectCss(globalCeilingParams.cssSourceUrl);
        // 注入dom
        globalCeilingRun.injectDom();
        var callback = callback || function () {};
        return callback();
    },
    checkUserIsLogin: function () {
        var bbuserid = globalCeilingTools.getCookie('bbuserid');
        var bbusername = globalCeilingTools.getCookie('bbusername');
        if (bbuserid > 0 && bbuserid < 12000000) {
            this.userId = bbuserid;
            this.userName = decodeURIComponent(bbusername);
        } else {
            this.userId = 0;
            this.userName = '';
        }
    },
    getLoginUrl: function () {
        return this.loginUrl + encodeURIComponent(document.URL);
    },
    getLogoutUrl: function () {
        return this.logoutUrl + encodeURIComponent(document.URL);
    },
    htmlTemplate: function () {

        var mySecHand = '<ul class="global-sub-links">';
        mySecHand += '<li class="global-sub-link"><a rel="nofollow" href="' + globalCeilingParams.myBuyGoodsUrl + '" target="_blank">我买到的</a></li>';
        mySecHand += '<li class="global-sub-link"><a rel="nofollow" href="' + globalCeilingParams.mySaleGoodsUrl + '" target="_blank">我的发布</a></li>';
        mySecHand += '<li class="global-sub-link"><a rel="nofollow" href="' + globalCeilingParams.myRecycleUrl + '" target="_blank">我的回收</a></li>';
        mySecHand += '<li class="global-sub-link"><a rel="nofollow" href="' + globalCeilingParams.mySoldgoodsGoodsUrl + '" target="_blank">已卖出的</a></li>';
        // mySecHand += '<li class="global-sub-link"><a rel="nofollow" href="' + globalCeilingParams.mySellerOfferGoodsUrl + '" target="_blank">议价请求</a></li>';
        mySecHand += '<li class="global-sub-link"><a rel="nofollow" href="' + globalCeilingParams.myOfferGoodsUrl + '" target="_blank">我的出价</a></li>';
        mySecHand += '<li class="global-sub-link"><a rel="nofollow" href="' + globalCeilingParams.zmxyUrl + '" target="_blank" class="current">认证管理</a></li>';
        mySecHand += '</ul>';

        var sellerCenter = '<ul class="global-sub-links">';
        sellerCenter += '<li class="global-sub-link"><a opt_value="1" rel="nofollow" href="/my-store/index" target="_blank">我的店铺</a></li>';
        sellerCenter += '<li class="global-sub-link"><a opt_value="2" rel="nofollow" href="' + globalCeilingParams.mySaleGoodsUrl + '" target="_blank">出售中的商品</a></li>';
        sellerCenter += '<li class="global-sub-link"><a opt_value="3" rel="nofollow" href="' + globalCeilingParams.mySoldgoodsGoodsUrl + '" target="_blank">已卖出的商品</a></li>';
        sellerCenter += '<li class="global-sub-link"><a opt_value="4" rel="nofollow" href="' + globalCeilingParams.mySellerOfferGoodsUrl + '" target="_blank">议价请求</a></li>';
        sellerCenter += '</ul>';

        var navigation = '<li class="global-personal-item">\
            <ul class="global-personal-nav clearfix">\
            <li class="global-personal-item global-special-ie7-li"><span class="trigger"><i></i><i class="arrow-icon"></i>网站导航</span>\
                 <dl  class="global-sub-links website-links">\
                    <dt><a target="_blank" href="http://www.fengniao.com/">资讯</a></dt>\
                <dd class="clearfix">\
                    <a target="_blank" href="http://academy.fengniao.com/">技法学院</a><a target="_blank" href="http://image.fengniao.com/">大师作品</a><a target="_blank" href="http://qicai.fengniao.com/">器材评测</a><a target="_blank" href="http://travel.fengniao.com/">旅游摄影</a><a target="_blank" href="http://qsy.fengniao.com/">手机拍照</a><a target="_blank" href="http://auto.fengniao.com/">行摄自驾</a>\
                    </dd>\
                <dt><a target="_blank" href="http://bbs.fengniao.com/">论坛</a></dt>\
                <dd class="clearfix">\
                    <a target="_blank" href="http://bbs.fengniao.com/forum/forum_11.html">主题摄影</a><a target="_blank" href="http://bbs.fengniao.com/forum/forum_250.html">器材讨论</a><a target="_blank" href="http://bbs.fengniao.com/forum/forum_23.html">品牌交流</a><a target="_blank" href="http://bbs.fengniao.com/forum/forum_75.html">自建论坛</a><a target="_blank" href="http://bbs.fengniao.com/forum/forum_38.html">地方论坛</a><a target="_blank" href="http://huodong.fengniao.com/">活动中心</a>\
                    </dd>\
                <dt><a target="_blank" href="http://product.fengniao.com/">器材</a></dt>\
                <dd class="clearfix">\
                    <a target="_blank" href="http://product.fengniao.com/camera.html">数码相机</a><a target="_blank" href="http://product.fengniao.com/lens.html">热门镜头</a><a target="_blank" href="http://product.fengniao.com/filmcamera.html">胶片相机</a><a target="_blank" href="http://product.fengniao.com/camcorder.html">视频设备</a><a target="_blank" href="http://product.fengniao.com/accessories.html">摄影附件</a><a target="_blank" href="http://product.fengniao.com/others.html">其他设备</a>\
                    </dd>\
                <dt><a href="http://2.fengniao.com/">二手</a></dt>\
                <dd class="clearfix">\
                    <a target="_blank" href="http://2.fengniao.com/quality">蜂鸟鉴定</a><a target="_blank" href="http://2.fengniao.com/recycle">蜂鸟回收</a><a target="_blank" href="http://2.fengniao.com/price/def-1_1.html">闲置商品</a><a target="_blank" href="http://2.fengniao.com/auction">蜂鸟拍卖</a>\
                    </dd>\
                <dt><a target="_blank" href="http://tu.fengniao.com/">图片</a></dt>\
                <dd class="clearfix">\
                    <a target="_blank" href="http://tu.fengniao.com/">精选图赏</a><a target="_blank" href="http://photo.fengniao.com/">图库大全</a><a target="_blank" href="http://pp.fengniao.com/">唯美相册</a><a target="_blank" href="http://bbs.fengniao.com/jinghua-101.html">论坛精华</a>\
                    </dd>\
                <dt><a target="_blank" href="http://sai.fengniao.com/">活动</a></dt>\
                <dd class="clearfix">\
                    <a target="_blank" href="http://sai.fengniao.com/">热门影赛</a><a target="_blank" href="http://www.fengniao.com/topic/">热门专题</a>\
                </dd>\
                </dl>\
            </li>\
            </ul>\
            </li>';

        var commonTemplateTop = '<div class="global-secondaryTopbar">' +
            '<div class="wrapper clearfix">' +
            '<div class="global-personal-center">' +
            '<ul class="global-personal-nav">' +
            '<li class="global-personal-item"><!--<a href="' + globalCeilingParams.indexUrl + '" target="_blank">蜂鸟二手首页</a><i class="line-icon">|</i>--></li>' +
            '<li class="global-personal-item my-secondary-item" id="mySecondaryItem">' +
            '<a rel="nofollow" href="/user/index" target="_blank" class="trigger"><i class="arrow-icon"></i>用户中心</a>' + '<i class="line-icon">|</i>' + mySecHand +
            '</li>' + 
            '<li class="global-personal-item my-follow-item"><a rel="nofollow" href="/user/index" target="_blank" class="trigger"><i class="arrow-icon"></i><img src="http://icon.fengniao.com/fn_mall/images/topBarfollowIcon.png" class="topBarfollowIcon" width="14" height="12">我的收藏</a><i class="line-icon">|</i>\
            <ul class="global-sub-links">\
            <li class="global-sub-link"><a rel="nofollow" href="'+ globalCeilingParams.myCollectGoodsUrl +'" target="_blank">我收藏的商品</a></li>\
            <li class="global-sub-link"><a rel="nofollow" href="'+ globalCeilingParams.myCollectSellerUrl+'" target="_blank">我收藏的卖家</a></li>\
            </ul>\
            </li>' + 
            '<li class="global-personal-item" id="global-store-item" style="display: none;">' +
            '<a rel="nofollow" href="/my-store/index" target="_blank" opt_value="0" class="trigger"><i class="arrow-icon"></i>卖家中心</a>' +
            '<i class="line-icon">|</i>' +
            sellerCenter + '</li>' +
            '<li class="global-personal-item global-special-ie7-li"><span class="trigger"><i class="arrow-icon"></i>联系客服</span> <i class="line-icon global-special-ie7-i">|</i>\
        <div class="global-sub-links onlineService-links clearfix">\
            <dl class="onlineService-mobile">\
            <dt>在线客服</dt>\
            <dd>\
            <a rel="nofollow" target="_blank" href="http://kefu.qycn.com/vclient/chat/?websiteid=123435&click_source=index_right"><img src="http://icon.fengniao.com/fn_mall/images/onlineServiceICon.png" width="120" height="36" alt=""></a>\
            </dd>\
            <dd><strong class="telephone-tag">010-82666200-8152</strong><strong class="telephone-tag">010-82666200-8129</strong></dd>\
            </dl>\
            <dl class="onlineService-vcode">\
            <dt>关注公众号</dt>\
            <dd><span class="onlineService-pic"><img src="http://icon.fengniao.com/fn_mall/images/wechat.jpg"></span></dd>\
            </dl>\
            </div>\
            </li>' + navigation +
            '</ul>' +
            '</div>' +
            '<div class="global-login-bar">' +
            '<a href="http://www.fengniao.com" class="home-link" target="_blank">蜂鸟首页</a>';

        var commonTemplateBottom =
            '</div>' +
            '</div>' +
            '</div>';


        if (this.userId > 0) {
            var template = commonTemplateTop + '<div class="global-login-inner clearfix">' +
                '                               <div class="global-welcome">Hi，' +
                '<a target="_blank" href="/user/index" class="name">' + this.userName + '</a>' +
                '<a href="' + globalCeilingRun.getLogoutUrl() + '" class="login-out">退出</a>' +
                '</div> ' +
                '<ul class="global-personal-nav clearfix">' +
                '<li class="global-personal-item global-special-ie7-li">' +
                '<span class="trigger"><i id="globalCeilingMessageAllCount"></i><i class="arrow-icon"></i>消息</span> ' +
                '<i class="line-icon global-special-ie7-i">|</i>' +
                '<div class="global-sub-links">' +
                '<div class="global-sub-link"><a rel="nofollow" href="' + globalCeilingParams.messageSystemUrl + '" target="_blank"><i id="globalCeilingMessageSystemCount"></i>个人消息</a></div>' +
                '<div class="global-sub-link"><a rel="nofollow" href="' + globalCeilingParams.messageLeaveUrl + '" target="_blank"><i id="globalCeilingMessageQaCount"></i>我的留言</a></div>' +
                '<div class="global-sub-link"><a rel="nofollow" href="' + globalCeilingParams.messageGlobalUrl + '" target="_blank"><i id="globalCeilingMessageGlobalCount"></i>全站消息</a></div>' +
                '<div class="global-sub-link" id="globalIMstarter" style="display: none;"><a rel="nofollow" href="javascript:;">我的私信</a></div>' +
                '</div>' +
                '</li>' +
                '</ul>' +
                '<a class="coupon-link" rel="nofollow" href="/user/coupon"><i id="globalCeilingCouponCount"></i>优惠券</a>' +
                '</div> ' + commonTemplateBottom;

        } else {
            var template = commonTemplateTop + '<div class="global-login-inner clearfix">' +
                '<span class="welcome-tip">HI,欢迎来到蜂鸟二手交易&nbsp;&nbsp;&nbsp;</span><a rel="nofollow" href="javascript:;" class="registered-link nologin">请登录</a>' +
                '<i class="line-icon">|</i>' +
                '<a rel="nofollow" href="' + this.registerUrl + '" class="registered-link" target="_blank">免费注册</a>' +
                '</div> ' + commonTemplateBottom;
        }

        var divObject = document.getElementById('globalCeiling-topBar');

        if (divObject) {
            divObject.innerHTML = template;
        } else {
            var divObject = document.createElement('div');
            divObject.id = "globalCeiling-topBar";
            divObject.innerHTML = template;
            var bodyObject = document.getElementsByTagName("body")[0];
            var headerObj = globalCeilingTools.getClassName('div','fn-sec-header')[0];
            bodyObject.insertBefore(divObject, headerObj);
        }

        globalCeilingRun.executeJs();

        if (this.userId > 0) {
            globalCeilingRun.getMessageCount();
            globalCeilingRun.getCouponCount();
            globalCeilingRun.getStoreCenter();
        }
    },
    injectDom: function () {
        globalCeilingRun.checkUserIsLogin();
        globalCeilingRun.htmlTemplate();
    },
    executeJs: function () {
        var classObj = globalCeilingTools.getClassName('li', 'global-personal-item');
        for (var i in classObj) {
            classObj[i].onmouseover = function () {
                globalCeilingTools.addClass(this, 'current-item');
            };
            classObj[i].onmouseout = function () {
                globalCeilingTools.removerClass(this, 'current-item');
            };
        }
    },
    insertMessageNum: function (id, num) {
        num = parseInt(num);
        num = num > 99 ? '99+' : (num == 0 ? '' : num);

        globalCeilingTools.removerClass(document.getElementById(id), 'num-icon');
        if (num) globalCeilingTools.addClass(document.getElementById(id), 'num-icon');
        document.getElementById(id).innerHTML = num;
    },
    getMessageCount: function () {
        var json = {
            method: 'get',
            url: globalCeilingParams.getMessageCountUrl,
            data: '',
            async: true,
            success: function (data) {
                data = eval('(' + data + ')');
                if (data.code == 1) {
                    globalCeilingRun.insertMessageNum('globalCeilingMessageAllCount', data.content.all);
                    globalCeilingRun.insertMessageNum('globalCeilingMessageSystemCount', data.content.system);
                    globalCeilingRun.insertMessageNum('globalCeilingMessageGlobalCount', data.content.global);
                    globalCeilingRun.insertMessageNum('globalCeilingMessageQaCount', data.content.qa);
                    // globalCeilingRun.insertMessageNum('globalCeilingMessagePersonalCount', data.content.personal);
                    //globalCeilingRun.insertMessageNum('globalCeilingMessageAllCount2', data.content.all);
                }
            },
            error: function (data) {}
        };

        globalCeilingTools.ajax(json);
    },
    getStoreCenter : function () {
        var ajax = {
            url: '/common/get-is-store',
            success: function (data) {
                var data = eval('(' + data + ')');
                if (data.is == 1) {
                    var obj = document.getElementById('global-store-item');
                    if (data.sku == 1) {
                        var ul  = obj.childNodes[2],
                            uul = document.getElementById('mySecondaryItem').childNodes[2],
                            url = "/my-store/selling-goods?click_source=topbar";
                        ul.removeChild(ul.childNodes[3]);
                        ul.childNodes[1].childNodes[0].href = url;
                        uul.childNodes[1].childNodes[0].href = url;
                    }
                    obj.style.display = 'block';
                }
            }
        }
        globalCeilingTools.ajax(ajax);
    },
    pollUpdateMessageCount: function () {
        return false;
        // this.pollStatus = setInterval(globalCeilingRun.getMessageCount, globalCeilingParams.pollInterval * 1000);
    },
    getCouponCount: function () {
        var ajax = {
            method: 'get',
            url: '/coupon/getcount',
            data: '',
            async: true,
            success: function (data) {
                data = eval('(' + data + ')');
                if (data.flag == 1) {
                    var count = data.data;

                    if (count > 99) {
                        count = '99+';
                    }

                    if (count > 0) {
                        var couponDom = document.getElementById('globalCeilingCouponCount');
                        globalCeilingTools.addClass(couponDom, 'num-icon');
                        couponDom.innerHTML = data.data;
                    }
                }
            }
        }

        globalCeilingTools.ajax(ajax);
    }
};

$(function () {
// window.onload = function () {
    globalCeilingRun.run(function () {
        $('#globalCeiling-topBar').find('a.nologin').on('click', function () {
            if (jsChkUserLogin()) return false;
        })
    });
})
// }
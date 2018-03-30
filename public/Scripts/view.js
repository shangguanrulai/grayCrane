/**
 * @Description: the script 二手交易详情页
 * @authors: hanjw (han.jingwei@fengniao.com)
 * @date：    2015-11-05 11:46:33
 * @version： 1.0
 */
$.ajaxSetup({cache: false});
//分享
$("#shareBtn").mouseover(function () {
    $(this).addClass("share-hover");
}).mouseout(function () {
    $(this).removeClass("share-hover");
});

//手机购买推荐 mobile-promotion-box
$(".mobile-promotion-box .code-icon").mouseover(function () {
    $(this).parents('.mobile-promotion-box').addClass("promotion-hover");
}).mouseout(function () {
    $(this).parents('.mobile-promotion-box').removeClass("promotion-hover");
});



//收藏用户弹层
var followUserLock = true;
(function followUserDialogFn() {
    $("#followUserDialog").dialog({
        autoOpen: false,
        dialogClass: "no-header",
        width: 436,
        height: 176,
        modal: true,
        buttons: {
            '返回': function () { //返回
                $(this).dialog("close");
            }
        }
    });

    $("#followUserButton ,.collect-button").click(function () {
        if (jsChkUserLogin()) return false;
        var _this = $(this);
        if (followUserLock) {
            //var text = _this.text().replace('收藏(', '');
            //text = text.replace(')', '');
            var num = Number(_this.text().match(/\d+(\.\d+)?/g));
            //alert(num);return ;
            $.ajax({
                dataType: 'json',
                url: ajax_goods_url,
                data: {"act": 'seller_collect', 'seller_id': seller_id},
                success: function (json) {
                    if (json.code == 1) {
                        $("#followUserDialog").dialog("open");
                        //这里需要 ajax 请求成功后才能显示
                        followUserLock = false;
                        _this.text('已收藏');
                    } else {
                        FnApp.errorJs(json.msg);
                        //quickLogin();
                    }
                }
            });

        }
    });
})();
function jsChkGoods() {
    var res = $.ajax({
        url: ajax_goods_url,
        async: false,
        data: {'act': 'chk_goods', 'goods_id': goods_id},
        dataType: 'json'
    }).responseText;
    res = eval("(" + res + ")");
    if (res.code == 0) {
        return FnApp.errorJs(res.msg);
        return false;
    }
    return true;
}

//收藏商品弹层
var followGoodsLock = true;
(function followGoodsDialogFn() {
    $("#followGoodsDialog").dialog({
        autoOpen: false,
        dialogClass: "no-header",
        width: 436,
        height: 176,
        modal: true,
        buttons: {
            '返回': function () { //返回
                $(this).dialog("close");
            }
        }
    });

/*    $(".collection-link").on('click', function () {
        var _this = $(this);
        if (followGoodsLock) {
            var num = Number(_this.find('strong').text());
            $.ajax({
                dataType: 'json',
                url: '/ajax/goods-collect',
                data: {'goods_id': goods_id},
                success: function (json) {
                    if (json.code == 1) {
                        $("#followGoodsDialog").dialog("open");
                        //这里需要 ajax 请求成功后才能显示
                        //_this.find('strong').html(num + 1);
                        followGoodsLock = false;
                        //_this.addClass('followed-tag');
                        _this.find('span').text('已收藏');
                    } else if (json.code == -1) {
                        quickLogin();
                    } else {
                        return FnApp.errorJs(json.msg);
                    }
                }
            });
        }
    });
})();*/

// 二维码消息打通-PC-V2.5
(function showMobileDialogFn() {
    $("#showMobileDialog").dialog({
        autoOpen: false,
        modal: true,
        width: 600,
        buttons: {}
    });

    $("#showMobileButton").click(function () {
        var scene_id = '20'+goods_id;
        $.ajax({
            dataType: 'json',
            url: '/ajax/we-chat-qrcode',
            data: {"scene_id":scene_id},
            success: function (data) {
                if (data.code == 1) {
                    $("#qrcode").attr("src",data.item);
                }
            }
        });
        $("#showMobileDialog").dialog("open");
    });
})();

(function showAuction() {
    $("#wechatAuction").dialog({
        autoOpen: false,
        modal: true,
        width: 600,
        buttons: {}
    });

    $("#showAuction").click(function () {
        var scene_id = '14'+goods_id;
        $.ajax({
            dataType: 'json',
            url: '/ajax/we-chat-qrcode',
            data: {"scene_id":scene_id},
            success: function (data) {
                if (data.code == 1) {
                    $("#auctioncode").attr("src",data.item);
                }
            }
        });
        $("#wechatAuction").dialog("open");
    });
})();

var bidPrice = {
    num: 0,
    lang: {
        'empty': '请填写手机号',
        'format': '手机号码格式不正确',
        'resend': '重新发送',
        'noCode': '验证码不能为空',
        'errCode': '验证码错误',
        'sucCode': '验证成功'
    },
    error: function (str) {
        $("#bidFailureDialog p").html(str);
        $("#bidFailureDialog").dialog("open");
        return false;
    },
    displayError: function (obj, className, error) {
        obj.html(error).removeClass().addClass(className).show();
        return false;
    },

    validatePhone: function (phone_mob) {
        var reg = /^1[3|4|5|8|7][0-9]{9}$/;
        if (!phone_mob) {
            return this.error(this.lang.empty);
        }
        if (!reg.test(phone_mob)) {
            return this.error(this.lang.format);
        }
        return true;
    },
    captcha: function () {
        var _this = this;
        $(document).on('click', '.code-button', function () {
            var phone = $('#telephone'),
                phone_mob = phone_mob ? phone_mob : phone.val(),
                numTime = 120,
                Timer = null,
                _obj = $(this),
                validate = _this.validatePhone(phone_mob),
                start = function () {
                    _obj.removeAttr('disabled');
                    $.get('/ajax/captcha-offer', {"phone_mob": phone_mob, 'type': 9}, function (json) {
                        if (json.code == 1) {
                            Timer = setInterval(function () {
                                numTime--;
                                if (numTime <= 0) {
                                    _obj.html(_this.lang.resend).removeAttr('disabled');
                                    clearInterval(Timer);
                                    numTime = 120;
                                } else {
                                    _obj.html(numTime + 's').attr('disabled', "disabled");
                                }
                            }, 1000);
                            return true;
                        } else {
                            return _this.error(json.msg);
                        }
                    });
                };
            validate && start.call();
        }).on('blur', '#telephoneCode', function () {
            var code = $(this).val(),
                phone = $('#telephone'),
                phone_mob = phone_mob ? phone_mob : phone.val(),
                _obj = $('.telephoneCode-wrap').find('span').eq(1),
                validate = _this.validatePhone(phone_mob),
                start = function () {
                    if (!code) {
                        return _this.displayError(_obj, 'error-tip', _this.lang.noCode);
                    }
                    $.ajax({
                        dataType: 'json',
                        url: '/ajax/captcha-offer-validate',
                        data: {"phone_mob": phone_mob, "code": code, 'type': 9},
                        success: function (data) {
                            if (data.code == 1) {
                                _this.displayError(_obj, 'tip', _this.lang.sucCode);
                                phone.attr('readonly', true);
                            } else {
                                _this.displayError(_obj, 'error-tip', _this.lang.errCode);
                            }
                        }
                    });
                };
            validate && start.call();
        })
    },
    bid: function () {
        var _this = this;
        //出价试试弹层
        (function bidPriceDialogFn() {
            //出价成功
            $("#bidSuccessDialog,#bidFailureDialog").dialog({
                autoOpen: false,
                dialogClass: "no-header",
                width: 436,
                height: 180,
                modal: true,
                buttons: {
                    '返回': function () { //返回
                        $(this).dialog("close");
                    }
                }
            });

            $("#bidPriceDialog").dialog({
                autoOpen: false,
                dialogClass: "bid-dialog",
                width: 456,
                //height: 450,
                modal: true,
                buttons: [{
                    text: '取消 ', //取消
                    click: function () {
                        $(this).dialog("close");
                    }
                }, {
                    text: '出价', //出价
                    click: function () {
                        var start = function () {
                            var csrf = $('#csrf').val(),
                                price = $('.price-item .price').val(),
                                message = $('#message').val(),
                                trading_way = $('#trading_way').val(),
                                goods_extm_ids = $('#goods_extm_ids').val(),
                                phone_mob = $('#telephone').val(),
                                code = $('#telephoneCode');
                            if (_this.num == 0) {
                                if (!_this.validatePhone(phone_mob)) {
                                    return false;
                                }
                                if (!code.val()) {
                                    return _this.error(_this.lang.noCode);
                                }
                            }
                            if (price <= 0 || price >= 999999) {
                                return _this.error('价格非法');
                            }
                            $.ajax({
                                url: '/ajax/buyer-offer',
                                type: "post",
                                dataType: "json",
                                data: {
                                    '_csrf': csrf,
                                    'message': message,
                                    'goods_id': goods_id,
                                    'price': price,
                                    'goods_extm_ids': goods_extm_ids,
                                    'trading_way': trading_way,
                                    'phone_mob': phone_mob,
                                    'code': code.val(),
                                    'num': _this.num
                                },
                                success: function (json) {
                                    if (json.code == 1) {
                                        $("#bidSuccessDialog").dialog("open");
                                        $("#bidPriceDialog").dialog("close");
                                    } else {
                                        $("#bidFailureDialog p").html(json.msg);
                                        $("#bidFailureDialog").dialog("open");
                                    }
                                }
                            });
                        }
                        start.call();
                    }
                }]
            });

            $('#bidPriceDialog .equipment-list,#confirmGoodsDialog .equipment-list').on('click', 'li', function () {
                if (!$(this).hasClass('delete-item')) {
                    var checkeTag = $(this).find('.checkbox-icon');
                    if (checkeTag.hasClass('checked')) {
                        checkeTag.removeClass('checked')
                    } else {
                        checkeTag.addClass('checked')
                    }
                } else {
                    return false;
                }
            });
            $("#bidPriceButton").click(function () {
                if (jsChkUserLogin()) return false;
                $('#confirmGoodsDialog').empty(); //清空购买弹层
                $.ajax({
                    url: '/ajax/goods-view',
                    type: "get",
                    dataType: "json",
                    data: {'goods_id': goods_id},
                    success: function (json) {
                        if (json.code == 1) {
                            var html = '<div class="equipment-wrap"><ul class="equipment-list">',
                                price = 0,
                                delete_item = '',
                                checked = '',
                                subids = '',
                                goods = json.item.goods,
                                is_multi = json.item.is_multi;
                            _this.num = json.item.num;
                            $.each(goods, function (k, v) {
                                delete_item = v.status > 0 ? 'delete-item' : '';
                                checked = v.status > 0 ? '' : 'checked';
                                var id = k == 0 ? 0 : k;
                                if (v.status > 0) {
                                    html += '<li class="' + delete_item + '">';
                                } else {
                                    price = Number(v.price) + Number(price);
                                    subids += k + ',';
                                    html += is_multi ? '<li price="' + v.price + '" id="item_' + id + '" onclick="slt_goods(' + goods_id + ',' + id + ')" class="' + delete_item + '">' : '<li price="' + v.price + '"  class="' + delete_item + '">';
                                }
                                html += is_multi ? '<i class="checkbox-icon ' + checked + '"></i>' : '';
                                html += '<span class="price-tag">' + v.price + '元</span>';
                                html += '<span class="quality-tag">' + v.quality + '</span>';
                                html += '<span class="title">' + v.model_name + '</span>';
                                html += '</li>';
                            })
                            html += '</ul>';
                            html += '<span class="total-price">商品总价<strong>' + price_format(price) + '</strong>&nbsp;元</span>';
                            html += '</div>';
                            html += '<div class="bid-tip">';
                            html += '  <p>发送后您可以随时在 <a target="_blank" href="' + user_index_url + '">个人中心</a> - <a target="_blank" href="' + user_buyer_offer_url + '">我的出价</a> 中查看反馈信息及状态。</p>';
                            html += ' <p>如卖家同意您的出价，系统会自动生成订单，并以短信通知您。</p>';
                            html += '</div>';
                            html += '<div class="price-item">诚心以<input type="text" class="price">元';
                            html += '<select name="" id="trading_way">';
                            html += '<option value="1">包含邮费</option>';
                            html += '<option value="2">不含邮费</option>';
                            html += '</select>';
                            html += '的价格购买此商品。</div>';
                            html += '<div class="textarea-wrap clearfix">';
                            html += '  <span class="textarea-title">留言</span>';
                            html += '  <input type="hidden"  id="goods_extm_ids" value="' + subids + '">';
                            html += '  <textarea id="message"  placeholder="给卖家说点什么吧"></textarea>';
                            html += ' </div>';
                            if (_this.num == 0) {
                                html += '<div class="telephone-wrap clearfix">';
                                html += '  <span class="telephone-title">绑定手机号:</span>';
                                html += phone_mob ? '<span class="telephone-tag">' + phone_mob.replace(phone_mob.substring(3, 7), '****') + '</span><input id="telephone" type="hidden"  value="' + phone_mob + '">' : '<input id="telephone">';
                                html += ' <button class="code-button">获取验证码</button>';
                                html += ' </div>';
                                html += '<div class="telephoneCode-wrap clearfix">';
                                html += '  <span class="telephoneCode-title">验证码:</span>';
                                html += '  <input id="telephoneCode" >';
                                html += ' <span class="tip" style="display: none"></span>';
                                html += ' </div>';
                            }
                            $("#bidPriceDialog").html(html);
                        }
                    }
                });
                $("#bidPriceDialog").dialog("open");
            });
        })();
    },
    start: function () {
        this.bid();
        this.captcha();
    }
}

bidPrice.start();


function slt_goods(goods_id, goods_extm_id) {
    var _this = $('#item_' + goods_extm_id),
        checkeTag = _this.find('.checkbox-icon'),
        price = Number($('.total-price strong').text()),
        goods_extm_ids = $('#goods_extm_ids').val();
    if (checkeTag.hasClass('checked')) {
        checkeTag.removeClass('checked');
        price = price - Number(_this.attr('price'));
        goods_extm_ids = goods_extm_ids.replace(goods_extm_id + ',', '');
    } else {
        checkeTag.addClass('checked');
        price = price + Number(_this.attr('price'));
        goods_extm_ids += goods_extm_id + ',';
    }
    $('.total-price strong').text(price_format(price));
    $('#goods_extm_ids').val(goods_extm_ids);
}
function buy_slt_goods(goods_id, goods_extm_id) {
    var _this = $('#item_' + goods_extm_id);
    var checkeTag = _this.find('.checkbox-icon');
    var price = Number($('.total-price strong').eq(1).text());
    var num = Number($('.total-price strong').eq(0).text());
    var goods_extm_ids = $('#goods_extm_ids').val();
    if (checkeTag.hasClass('checked')) {
        checkeTag.removeClass('checked');
        price = price - Number(_this.attr('price'));
        num--;
        goods_extm_ids = goods_extm_ids.replace(goods_extm_id + ',', '');
    } else {
        checkeTag.addClass('checked');
        price = price + Number(_this.attr('price'));
        num++;
        goods_extm_ids += goods_extm_id + ',';
    }
    $('.total-price strong').eq(0).text(num);
    $('.total-price strong').eq(1).text(price_format(price));
    $('#goods_extm_ids').val(goods_extm_ids);
}
//详情拍卖--器材清单选择
$('.product-parameter .equipment-list').on('click', ' > li', function () {
    if (!$(this).hasClass('delete-item')) {
        $(this).addClass('selected').siblings().removeClass('selected');
    }
});

//选择分类
$(".J_selectClassification").mouseover(function () {
    $(this).addClass("classification-hover");
}).mouseout(function () {
    $(this).removeClass("classification-hover");
});

$('.J_switchTab').on('click', '.J_item', function () {
    $(this).addClass('current-item').siblings('.J_item').removeClass('current-item');
    $(this).parents('.J_switchTab').find('.J_tabPanel[id=' + $(this).attr('rel') + ']').show().siblings('.J_tabPanel').hide();
});

//商品描述和商品评论切换
$('.J_productTab').on('click', '.J_item', function () {
    $(this).addClass('current-item').siblings('.J_item').removeClass('current-item');

    if ($(this).attr('rel') == "message") {
        $(this).parents('.J_productTab').addClass('describeHidden');
        $(this).parents('.J_productTab').find('.describe-wrap').hide();
    } else if ($(this).attr('rel') == "describe") {
        $(this).parents('.J_productTab').find('.describe-wrap').show();
        $(this).parents('.J_productTab').removeClass('describeHidden');
    }
});

//产品图片点击显示大图
(function productGalleryFn() {
    var productGalleryLock = true;
    if ($('#productGallery').length > 0) {

        var liWidth = parseInt($('#productGallery .carousel-stage li').width());

        $('#productGallery').on('click', '.carousel-stage li', function () { 
            
            var indexNum = Number($(this).index()),
                carouselData = $(this).parent('ul'),
                galleryTop = $('#productGallery').offset().top,
                galleryMarTop,
                galleryMarLeft,
                laryerLiWidth,
                windowScrollTop = $(window).scrollTop(),
                screenWidth;

            if(parseInt(window.screen.width,10) > 1375){
                screenWidth = 1200;
            }else{
                screenWidth = 980;
            }

            if(isStore){
                galleryMarTop = galleryTop - ($(window).height() - 700) / 2;
                galleryMarLeft = (screenWidth - 1000) / 2 ;
                laryerLiWidth = 1000;
            }else{
                galleryMarTop = galleryTop - ($(window).height() - 660) / 2 ;
                galleryMarLeft = (screenWidth - 740) / 2 ;
                laryerLiWidth = 740;
            }

            $('#productGallery').on('click', '.carousel-navigation li', function () {
                indexNum = Number($(this).index());
                return indexNum;
            });

            if (productGalleryLock == true) {
                carouselData.css('left', -(indexNum) * laryerLiWidth);
                $('#galleryOverlay').show();

                $('body').addClass('hasLaryer');
                productGalleryLock = false;
                $(window).scrollTop(0);
                
                if($(window).height() < 700){
                    $('.hasLaryer #productGallery').addClass('smallProductGallery');
                    $('#productGallery').css({
                        'margin-top' : '-' + Number(galleryMarTop - 80) + 'px',
                        'margin-left' : galleryMarLeft + 'px'
                    });
                }else{
                    $('#productGallery').css({
                        'margin-top' : '-' + galleryMarTop + 'px',
                        'margin-left' : galleryMarLeft + 'px'
                    });
                }
            }

            $('#productGalleryBack').on('click', function () {
                $('#productGallery').removeClass('smallProductGallery');
                carouselData.css('left', -(indexNum) * liWidth);
                $('#galleryOverlay').hide();
                $('body').removeClass('hasLaryer');
                productGalleryLock = true;
                $(window).scrollTop(windowScrollTop);
                $('#productGallery').css({
                    'margin-top': 0,
                    'margin-left': 0
                });
            });
        });


        //新增
        var countBar = $('#productGallery').find('.count-bar'),
            liNum = $('#productGallery .navigation ul').find('li').length;

        countBar.find('em').text(liNum);

        if(countBar.find('em').text() !='0' ){
            countBar.css('display','block')
        }

        $('#productGallery .navigation').on('click','li',function(){
            countBar.find('i').text($(this).index()+1)
        });
    }


})();

//查看出价历史
(function shootPriceRecordDialogFn() {
    $("#shootPriceRecordDialog").dialog({
        autoOpen: false,
        width: 436,
        height: 395,
        modal: true
    });

    $("#shootPriceRecord").click(function () {
        _initPage('auction_offer');
        initBidPrice();
        $("#shootPriceRecordDialog").dialog("open");
    });
})();

//免保证金
(function depositsDialogFn() {
    $("#depositsDialog").dialog({
        autoOpen: false,
        width: 436,
        height: 246,
        modal: true,
        buttons: [{
            text: '去设置',
            'class' : 'confirm-button',
            click: function () {
                window.location.href = '/user/setting?act=password&ok=1&backurl=goods&goods_id=' + goods_id;
            }
        }, {
            text: '再看看 ',
            'class' : 'cancel-button',
            click: function () {
                $(this).dialog("close");
            }
        }]
    });
})();

//确认要购买的商品
(function confirmGoodsDialogFn() {
    $("#confirmGoodsDialog").dialog({
        autoOpen: false,
        width: 456,
        height: 325,
        title: '确认您要购买的商品',
        dialogClass: "confirmGoods-dialog",
        buttons: [{
            text: '确认购买 ', //确认购买
            'class' : 'confirm-button',
            click: function () {
                var goods_extm_ids = $('#goods_extm_ids').val();
                if (!goods_extm_ids) {
                    return FnApp.errorJs('至少选择一个商品');//价格应该是一个数字
                }
                window.location.href = '/order/add/'+goods_id + '_' + goods_extm_ids;
                $(this).dialog("close");
            }
        }, {
            text: '取消', //取消
            'class' : 'cancel-button',
            click: function () {
                $(this).dialog("close");
            }
        }]
    });
})();

//出价确认
(function confirmPriceDialogFn() {
    $("#confirmPriceDialog").dialog({
        autoOpen: false,
        width: 436,
        height: 246,
        title: '出价确认',
        dialogClass: "confirmGoods-dialog",
        buttons: [{
            text: '确认',
            'class' : 'confirm-button',
            click: function () {
                var csrf = $('#csrf').val(),
                    price = $('#bid_price').val(),
                    item = {},
                    dialog=$("#shootSuccessDialog");
                $.ajax({
                    url: '/ajax/auction-offer',
                    type: "post",
                    dataType: 'json',
                    data: {'_csrf': csrf, 'goods_id': goods_id, 'price': price},
                    success: function (json) {
                        $("#confirmPriceDialog").dialog("close");
                        if (json.code == 1) {
                            item = json.item;
                            var str = ' <h3>出价成功！</h3>';
                            str +=item.auto_user.price?'<p class="tip">出价成功，但是低于其他用户设置的自动加价金额。</p>' : ' <p>您可以在 <a href="/user/index">个人中心</a><i>></i><a href="/user/auction">我参与的拍卖</a>中查看</p>';
                            item.delay_num && $(".delay-tag").find('strong').text(item.delay_num).show() &&dialog.dialog("open").html(str);
                        } else {
                            $("#bidFailureDialog").dialog("open").find('p').html(json.msg);
                        }
                    }
                });
            }
        }, {
            text: '取消', //取消
            'class' : 'cancel-button',
            click: function () {
                $(this).dialog("close");
            }
        }]
    });
})();

//确认拍卖出价
(function confirmShootDialogFn() {
    $("#confirmShootDialog").dialog({
        autoOpen: false,
        width: 436,
        height: 206,
        dialogClass: "no-header",
        //modal: true,
        buttons: [{
            text: '确认', //确认
            click: function () {
                window.location.href = order_url + '?goodsid=' + goods_id + '&goodsids=0';
                $(this).dialog("close");
            }
        }, {
            text: '取消 ', //取消
            click: function () {
                $(this).dialog("close");
            }
        }]
    });
})();

//设置自动出价
(function automaticBidDialogFn() {
    var cfmDio = $('#confirmShootDialog'),
        shootDio = $('#shootSuccessDialogAuto'),
        bidDio = $('#automaticBidDialog');
    bidDio.dialog({
        autoOpen: false,
        width: 436,
        height: 295,
        modal: true,
        buttons: [{
            text: '确认', //确认
            click: function () {
                var auto_price = Number($('#auto_price').val()),
                    html = '';
                $.ajax({
                    url: '/ajax/set-user-price',
                    type: "get",
                    dataType: "json",
                    data: {'goods_id': goods_id, 'auto_price': auto_price},
                    success: function (json) {
                        if (json.code == 1) {
                            bidDio.dialog("close");
                            if (json.item.price) {
                                html ='<span>'+json.item.username+'</span> <span><strong>'+price_format(json.item.price)+'</strong>元</span>';
                                //shootDio.find('.price-show').html(html).show();
                                shootDio.find('.tip').show();
                            } else {
                                shootDio.find('.price-show').hide().empty();
                                shootDio.find('.tip').hide();
                            }
                            shootDio.dialog("open");
                        } else if (json.code == -99) {
                            bidDio.dialog("close");
                            cfmDio.dialog("open");
                            return false;
                        } else {
                            return FnApp.errorJs(json.msg);
                        }
                    }
                });

            }
        }, {
            text: '取消 ', //取消
            click: function () {
                $(this).dialog("close");
            }
        }]
    });

    $("#automaticBidButton").click(function () {
        if (jsChkUserLogin()) return false;
        if ($(this).hasClass('disabled-link')) return false;
        if (jsChkGoods()) {
            $.ajax({
                url: '/ajax/user-price',
                type: "get",
                dataType: "json",
                data: {'goods_id': goods_id},
                success: function (json) {
                    if (json.code == 1) {
                        $('#automaticBidDialog h4 strong').text(json.item.auto_price);
                        $('#automaticBidDialog h4').show();
                    }
                }
            });
            bidDio.dialog("open");
        }
    });
})();

function initBidPrice() {
    var curprice = Number($('.parameter-price strong').text());
    $('#bid_price').val(price_format(curprice + add_price));
}
//
(function shootSuccessDialogFn() {
    $(".shootSuccess-layerbox").dialog({
        autoOpen: false,
        width: 436,
        height: 206,
        dialogClass: "no-header",
        buttons: [{
            text: '返回 ',
            click: function () {
                $(this).dialog("close");
                initBidPrice();
            }
        }]
    });
})();
(function shootSuccessDialogAutoFn() {
    $(".shootSuccess-auto-layerbox").dialog({
        autoOpen: false,
        width: 436,
        height: 186,
        dialogClass: "no-header",
        buttons: [{
            text: '返回 ',
            click: function () {
                $(this).dialog("close");
                initBidPrice();
            }
        }]
    });
})();

/*function goodsAttention(goods_ids) {
    $.ajax({
        url: '/ajax/goods-collect-view',
        type: "get",
        dataType: "json",
        data: {'goods_ids': goods_ids},
        success: function (json) {
            if (json.code == 1) {
                $.each(json.item, function (k, v) {
                    if (v == 1) followGoodsLock = false;
                    spanclass = v == 1 ? 'followed-tag' : '';
                    spantext = v == 1 ? '已收藏' : '收藏';
                    //$('#followGoodsButton').addClass(spanclass);
                    $('#collectionLink,#collectionLink.collection-link').find('span').text(spantext);
                })
            }
        }
    });
}*/


$(document).on('click', '#equipment-list li', function () {
    if ($(this).hasClass('delete-item')) {
        return false;
    }
    var id = $(this).attr('data-id'),
        goUrl = '/secforum/'+goods_id+(id>0?'_'+id:'')+'.html';
    window.location.href=goUrl;
}).on('click','.specifications-box > li',function(){
    if ($(this).hasClass('disabled-tag')) {
        return false;
    }
    var url = $(this).attr('data-url');
    if (url){
        window.location.href=url;
    }
})

//卖家收藏
function sellerAttention(seller_id) {
    $.ajax({
        url: '/goods/ajax',
        type: "get",
        dataType: "json",
        data: {'seller_id': seller_id, 'act': 'seller_attention'},
        success: function (json) {
            if (json.code == 1) {
                var item = json.item;
                $('.user-layerbox span.follow-num').text((item.is_collect==1?'已':'')+'收藏(' + item.num + ')');
                $('.shop-summary .collect-button,.shop-info .collect-button').addClass('collected').text(item.is_collect==1?'已收藏':'收藏本店');
            }
        }
    });
}
$('#buy-button ,#goodsSwitch .switch-nav-wrap .fn-buy-button ').on('click', function () {
    if ($(this).hasClass('disabled-button')) return false;
    if (jsChkUserLogin()) return false;
    $('#bidPriceDialog').empty();
    if ($(this).attr('goods_id')) {
        window.location.href = '/order/add/'+$(this).attr('goods_id');
        return;
    }
    if ($(this).attr('subid')) {
        window.location.href = '/order/add/'+$(this).attr('subid');
        return;
    }
    $.ajax({
        url: '/ajax/goods-view',
        type: "get",
        dataType: "json",
        data: {'goods_id': goods_id},
        success: function (json) {
            if (json.code == 1) {
                var html = '<div class="equipment-wrap">',
                    price = 0,
                    num = 0,
                    delete_item = '',
                    checked = '',
                    goods_extm_ids = '';
                html += '<ul class="equipment-list">';
                $.each(json.item.goods, function (k, v) {
                    delete_item = v.status > 0 ? (v.status == 1 ? 'delete-item' : 'unbuy-item') : '';
                    checked = v.status > 0 ? '' : 'checked';
                    var id = k == 0 ? 0 : k;
                    if (v.status > 0) {
                        html += '<li class="' + delete_item + '">';
                    } else {
                        price = Number(v.price) + Number(price);
                        num++;
                        goods_extm_ids += k + ',';
                        html += '<li price="' + v.price + '" id="item_' + id + '" onclick="buy_slt_goods(' + goods_id + ',' + id + ')" class="' + delete_item + '">';
                    }
                    html += '<i class="checkbox-icon ' + checked + '"></i>';
                    html += '<span class="price-tag">' + v.price + '元</span>';
                    html += '<span class="quality-tag">' + v.quality + '</span>';
                    html += '<span class="title">' + v.model_name + '</span>';
                    html += '</li>';
                })
                html += '</ul>';
                html += '<div class="tip">注：橘红色不可选为已被拍下购买的商品，但还未付款，您还有机会哦！</div>';
                html += '<div class="total-price"><strong>' + num + '</strong> 件商品，共<strong>' + price + '</strong>&nbsp;元</div>';
                html += '  <input type="hidden"  id="goods_extm_ids" value="' + goods_extm_ids + '">';
                html += ' </div>';
                $("#confirmGoodsDialog").html(html);
            }
        }
    });
    $("#confirmGoodsDialog").dialog("open");
})
var Auction = {
    phone_mob: phone_mob ? phone_mob : '',
    offer: function () {
        var _this = this;
        $('#shootButton,.switch-nav-wrap  .fn-shoot-button').on('click', function () {
            if ($(this).hasClass('disabled-button')) return false;
            if (jsChkUserLogin()) return false;
            if (!deposit) {
                _this.deposit();
                return false;
            }
            var price = $('#bid_price').val();
            if (!price) {
                return FnApp.errorJs('竞拍价格不能为空');
            }
            var shoot_price = Number($('.gobuy .shoot-price strong').text());
            if (shoot_price > 0 && price >= shoot_price) {
                if ($('.disabledShootPrice-item').is(":hidden")) {
                    $('#confirmShootDialog').dialog("open");
                    return false;
                }
            }
            var now_price = Number($('.parameter-price strong').text());
            if (price <= now_price) {
                return FnApp.errorJs('竞拍价不能低于当前价格');
            }
            if (jsChkGoods()) {
                $("#confirmPriceDialog p strong").text($('#bid_price').val());
                $("#confirmPriceDialog").dialog("open");
            }
        })
    },
    deposit: function () {
        //$.getJSON('/ajax/auction-deposit',{'goodsId':goods_id,'passwd':hex_md5('123456')},function (json) {
        if(seller_id==user_id) {
            return FnApp.errorJs('不可以对自己的商品操作');
        }
        $.getJSON('/ajax/auction-deposit',function (json) {
            if(json.code==1){
                if (json.item.passwd ){
                    if(json.item.money>=100){
                        $('#bondgeDialog').dialog('open');
                        _hmt.push(['_trackEvent', '2_fengniao', 'secforum', 'deposit_enough','1']);
                    }else {
                        var userMoney=price_format(json.item.money),
                            payMoney =price_format(Math.round((100-userMoney)*100)/100);
                        $('#rechargeDialog h4').html('当前账户余额：'+userMoney+'元，至少需充值'+payMoney+'元').attr('data-price',payMoney);
                        $('#rechargeDialog').dialog('open');
                        _hmt.push(['_trackEvent', '2_fengniao', 'secforum', 'deposit_less','1']);
                    }
                }else{
                    $("#depositsDialog p ").html('您尚未设置交易密码，请设置后参与拍卖');
                    $("#depositsDialog").dialog("open");
                }
            }
        })
        
    },
    start: function () {
        this.offer();
        this.dialog();
    }
    ,dialog:function () {
        var tit = "交纳拍卖保证金";
        (function bondgeDialogFn() { //交纳保证金
            $("#bondgeDialog").dialog({
                autoOpen: false,
                width: 526,
                title:tit,
                buttons: [{
                    text: '交纳保证金', //确认
                    'class':'confirm-button',
                    click: function () {
                        var pw=$('#bondgeDialog #passwd'),
                            passwd =pw.val(),
                            pwErr = $('#bondgeDialog .error-tip') ;
                        if (passwd == "") {
                            pwErr.text("交易密码不能为空").show();
                            return false;
                        }
                        passwd = hex_md5(passwd);
                        $.getJSON('/ajax/auction-deposit',{'goodsId':goods_id,'passwd':passwd},function (json) {
                            if(json.code==1){
                                $('#bondgeDialog').dialog("close");
                                $('#successRechargeDialog').dialog("open");
                            }else {
                                pwErr.text(json.msg).show();
                            }
                        })
                    }
                }, {
                    text: '取消 ', //取消
                    click: function () {
                        $(this).dialog("close");
                        _hmt.push(['_trackEvent', '2_fengniao', 'secforum', 'deposit_enough_close','1']);
                    }
                }]
                ,close:function () {
                    _hmt.push(['_trackEvent', '2_fengniao', 'secforum', 'deposit_enough_close','1']);
                }
            });
        })()
        ;(function rechargeDialogFn() { //充值
            $("#rechargeDialog").dialog({
                autoOpen: false,
                width:490,
                title: tit,
                //modal: true,
                buttons: [{
                    text: '立即充值',
                    'class':'confirm-button',
                    click: function () {
                        window.location.href = '/user/recharge?order_type=0&goodsId=' + goods_id;
                        $(this).dialog("close");
                    }
                }, {
                    text: '再看看',
                    click: function () {
                        $(this).dialog("close");
                        _hmt.push(['_trackEvent', '2_fengniao', 'secforum', 'deposit_less_close','1']);
                    }
                }]
                ,close:function () {
                    _hmt.push(['_trackEvent', '2_fengniao', 'secforum', 'deposit_less_close','1']);
                }
            });
        })()
        ;(function successRechargeDialogFn() { //成功
            $("#successRechargeDialog").dialog({
                autoOpen: false,
                width: 496,
                title: tit,
                buttons: [{
                    text: '确定',
                    click: function () {
                        window.location.reload();
                        // $(this).dialog("close");
                    }
                }]
            });
        })()
    }
}


var Active = {
    obj: $("#shootCountdown"),
    _refresh: function () {
        var _this = this;
        $.ajax({
            url: '/ajax/active-refresh',
            type: "get",
            dataType: "json",
            data: {'goods_id': goods_id},
            success: function (json) {
                var item = json.item,
                    btnCls = false;
                if (json.code == 1) {
                    btnCls = (item.is_buy && user_id != seller_id && !item.status ) ? true : false;
                    _this.attr('current_time', parseInt(item.diff_time));
                    $('.buy-button').text(item.title).removeClass(btnCls ? 'disabled-button' : '').addClass(btnCls ? '' : 'disabled-button');
                    $('.active-time').text('距离' + (item.is_buy ? '结束' : '开始') + '时间: ');
                    item.is_buy && $('.parameter-activity .collection-link').hide();
                } else {
                    window.location.reload();
                }
            }
        });
    },
    refresh: function () {
        var sdt = parseInt(this.obj.attr('sdt')),
            edt = parseInt(this.obj.attr('edt')),
            status = parseInt(this.obj.attr('status')),
            // title = status==2?'商品被拍下':(sdt > 0 ? (sdt > 3600 ? '活动未开始' : '活动即将开始') : '立即购买'),
            title = status==2?'商品被拍下':'立即购买',
            objPri = $('.actPri strong');
        if (sdt <= 0 && edt <= 0) {
            window.location.reload(true);
            return false;
        }
        sdt = sdt - 1 > 0 ? sdt - 1 : 0;
        edt = edt - 1 > 0 ? edt - 1 : 0;
        var btnSta = sdt <= 0  ? true : false;

        //var btnCls = (btnSta && user_id != seller_id && status==0) ? true : false;
        var btnCls = (user_id != seller_id && status==0) ? true : false;
        $('.buy-button,.fn-buy-button').removeClass(btnCls ? 'disabled-button' : '').addClass(btnCls ? '' : 'disabled-button').text(title).attr('title', user_id == seller_id ? '您不能购买自己的商品' : '');
        $('.active-time').text('距离' + (btnSta ? '结束' : '开始') + '时间: ');
        btnSta && $('.parameter-activity .collection-link').hide();
        (actPri && sdt==0 ) && objPri.text(actPri);
        this.obj.attr('sdt', sdt);
        this.obj.attr('edt', edt);
    },
    start: function () {
        var _this = this,
            a = new Date().getTime(),
            d = 24 * 3600 * 1000,
            c = 3600 * 1000,
            e = 60 * 1000,
            f = 1000;
        setTimeout(function () {
                _this.obj.each(function (o) {
                    var sdt = parseInt($(this).attr("sdt")),
                        edt = parseInt($(this).attr("edt")),
                        dt = sdt > 0 ? sdt : edt,
                        n = dt * 1000;
                    if (!n > 0) {
                        return;
                    }
                    var m = new Date().getTime();
                    var i = n;
                    if (i > 0) {
                        var p = Math.floor(i / d),
                            j = Math.floor((i - p * d) / c),
                            k = Math.floor((i - p * d - j * c) / e),
                            q = Math.floor((i - p * d - j * c - k * e) / f),
                            w = new Date().getTime(),
                            h = Math.floor(w).toString().substr(11, 2),
                            l = '';
                        if (p == 0) {
                            l = '<span class="item-0">' + j + '时</span>';
                            l += '<span class="item-1">' + k + '分</span>';
                            l += '<span class="item-2">' + q + '秒</span>';
                            l += '<span class="item-3">' + h + '</span>';
                        } else {
                            l = '<span class="item-0">' + p + '天</span>';
                            l += '<span class="item-1">' + j + '时</span>';
                            l += '<span class="item-2">' + k + '分</span>';
                            l += '<span class="item-3">' + q + '秒</span>';
                        }
                        $(this).html(l);
                    }
                });
                setTimeout(arguments.callee, 280);
            },
            280);
        var Timer = null;
        Timer = setInterval(function () {
                if ($("#shootCountdown").attr('end_time') <= 0) {
                    clearInterval(Timer);
                } else {
                    _this.refresh();
                }
            },
            1000);
    },
}
//刷新交易价格等
function refreshAuction() {
    var btn = $('.product-parameter .shoot-buttons .button'),
        fdBtn = $('.switch-nav-wrap .fn-shoot-button');
    $.ajax({
        url: '/ajax/auction-refresh',
        type: "get",
        dataType: "json",
        data: {'goods_id': goods_id},
        success: function (json) {
            var item = json.item.goods_info,
                str1 = '',
                str2 = '';
            if (json.code == 1) {
                $("#shootCountdown").attr('current_time', parseInt(item.diff_time - 1));
                $('.shoot-person').text(item.num + '人');
                $('.shoot-times em').text(item.auction_num + '次');
                str1 = item.is_hour == 1 ? '延时' + parseInt(item.delay_num) + '次' : '结束30秒内继续出价，将延迟30秒';
                str2 = item.status ? (item.status == 1 ? '距离结束' : '距离开始') : '距离开始';
                $("#end_str").html(str1).show();
                $('#start_str').html(str2);
                $("#shootCountdown").attr('status', parseInt(item.status));
                var record_list = json.item.offer_arr,
                    showRecord =function () {
                        $('.ending ,.starting,.shoot-price-record').show();
                        $('#automaticBidButton').hide();
                        $('.parameter-price strong').text(price_format(item.current_price));
                        $('.shoot-times em').text(item.auction_num + '次');
                    };
                if (record_list) {
                    var html = tag = even = '';
                    $.each(record_list, function (k, v) {
                        tag = k == 0 ? '<span class="tag">最高</span>' : ''; //最高
                        even = k == 1 ? 'even' : '';
                        html += '<li  class="' + even + '">';
                        html += '<div class="cell-1">';
                        html += '<span class="name">' + v.user_name + '</span>' + tag;
                        html += '</div>';
                        html += '<div class="cell-2">';
                        html += '<span class="price"><strong>&yen;' + price_format(v.price) + '</strong></span>';
                        html += v.is_auto >0 ? '<span class="auto-tag">自动出价</span>' : '';//自动出价
                        html += '</div>';
                        html += '<div class="cell-3">';
                        html += '<span class="date">' + v.dateline + '</span>';
                        html += '</div>';
                        html += '</li>';
                    })
                } else {
                    html = '<li class="empty">暂无出价</li>'; //暂无出价
                }
                $('.latest-price .price-record-box .record-list').html(html);

                if (item.is_gobuy == 1) {
                    $('.disabledShootPrice-item').hide();
                    $('.gobuy').show();
                } else {
                    $('.disabledShootPrice-item').show();
                    $('#instantlyBuyLink').removeAttr('title');
                    $('.gobuy').hide();
                }
                if ( (isaudit!=1) ) {
                    var auditCfg = {"0":"待审核","2":"审核中","3":"已下架","-1":"已下架"};
                    btn.text(auditCfg[isaudit]).addClass('disabled-button');
                    (isaudit==0 || isaudit==2) && $('.audit').show();
                    $('.parameter-countdown').hide();
                    return false;
                }
                if (!deposit  && item.status!=2 ) {
                    btn.text(item.status?'我要出价':'预先交纳保证金').removeClass('disabled-button');
                    fdBtn.length>0 && fdBtn.text(item.status?'我要出价':'预先交纳保证金').removeClass('disabled-button');
                    item.status ==1 && showRecord();
                    return false;
                }
                if (item.status == 2) {//2结束
                    var endStr = (isaudit==0||isaudit==2 )? '审核中' : '拍卖结束';
                    btn.addClass('disabled-button').text(endStr).removeAttr('onclick');
                    fdBtn.length>0 && fdBtn.addClass('disabled-button').text(endStr).removeAttr('onclick');
                    $('.ending ,.starting').hide();
                    $('.shoot-times em').text(item.auction_num + '次');
                    $('.current_price').html('成交价格');
                    $('.gobuy').hide();
                    $('.shoot-price-record').show();
                } else if (item.status == 1) {//1开始
                    if (item.seller_id == user_id) {
                        btn.text('我要出价').attr('title', '您不能竞拍自己的商品').addClass('disabled-button');
                        fdBtn.length>0 && fdBtn.text('我要出价').attr('title', '您不能竞拍自己的商品').addClass('disabled-button');
                    } else {
                        btn.removeClass('disabled-button').text('我要出价');
                        fdBtn.length>0 && fdBtn.removeClass('disabled-button').text('我要出价');
                    }
                    $('.ending ,.starting,#automaticBidButton,.shoot-price-record').show();
                    $('.parameter-price strong').text(price_format(item.current_price));
                    $('.shoot-times em').text(item.auction_num + '次');
                } else if (item.status == 0) {//0 未开始
                    var str = item.is_active>0 ? (item.diff_time > 3600 ? '活动未开始' : '活动即将开始') :  (item.diff_time > 3600 ? '拍卖未开始' : '拍卖即将开始');
                    btn.text(str).addClass('disabled-button').removeAttr('onclick');
                    fdBtn.length>0 && fdBtn.text(str).addClass('disabled-button').removeAttr('onclick');
                    $('.ending').show();
                    $('#automaticBidButton').hide();
                }
            } else {
                btn.addClass('disabled-button').text('拍卖结束');
                fdBtn.length>0 && fdBtn.addClass('disabled-button').text('拍卖结束');
                $('.ending ,.starting').hide();
            }
        }
    });
}
$('#plus').click(function () {
    var price = $('#bid_price').val();
    price = Number(price) + Number(add_price);
    $('#bid_price').val(price_format(price));
})
$('#minus').click(function () {
    var price = $('#bid_price').val();
    var now_price = Number($('.parameter-price strong').text());
    price = Number(price) - Number(add_price);
    if (price <= now_price) {
        return FnApp.errorJs('竞拍价格不能低于当前价格');//竞拍价格不能低于当前价格
    }
    if (price <= 0) {
        price = 0;
    }
    $('#bid_price').val(price_format(price));
})
$('#bid_price').blur(function () {
    var price = $('#bid_price').val();
    var now_price = Number($('.parameter-price strong').text());
    if (isNaN(price)) {
        $('#bid_price').val(price_format(now_price + Number(add_price)));
        return FnApp.errorJs('价格应该是一个数字');//价格应该是一个数字
    }
    $('#bid_price').val(price_format(price));
})
$('#gobuy').click(function () {
    if (jsChkUserLogin()) return false;
    if (jsChkGoods()) {
        $('#confirmShootDialog').dialog("open");
    }
})
function _initPage(act, page) {
    page = page ? page : 1;
    var id = url = '';
    if (act == 'auction_offer') {
        url = ajax_goods_offer_url;
        id = 'shootPriceRecordDialog';
    } else {
        act = 'qa';
        id = 'message-section';
        url = ajax_goods_qa_url;
    }
    $.ajax({
        url: url,
        type: "get",
        data: {'goods_id': goods_id, 'page': page},
        success: function (html) {
            $('#' + id).html(html);
            //自定义显示左侧区域
            // act == 'qa' && moreGoods();
        }
    });

}

var moreGoods =function(){
        var num = parseInt(($('#goodsSwitchPanel1').height()+$('#goodsSwitchPanel2').height()+$('#goodsSwitchPanel3').height()) / 282)-1,
            oHeight = num * 282 + 20;
        if(num <= 10){
            $('.promotion-goods-section .promotion-goods-list').css('height',oHeight + 'px');
        }else{
            $('.promotion-goods-section .promotion-goods-list').css('padding-bottom','20px');
        }
    }

;(function () {
    $('.product-parameter').on("mouseenter mouseleave", '.quality-parameter-item .parameter-quality', function () {
        $(this).parent().toggleClass('show-layer');
    });
}());


//埋点
$(function () {
    $('.sendPrivateLetterBtn').click(function () {
        _hmt.push(['_trackEvent', '2_fengniao', 'secforum', 'sendPrivateLetter', '']);
    });

    $('#showMobileButton').click(function () {
        _hmt.push(['_trackEvent', '2_fengniao', 'secforum', 'showMobile', '']);
    });
});

//举报成功提示
;(function () {
    //举报
    $("#reportBox").mouseover(function () {
        $(this).addClass("report-hover");
    }).mouseout(function () {
        $(this).removeClass("report-hover");
    });
    var reportLayer = $('.report-box').find('.report-layer');
    $('.summary-box,.shop-summary-box,.report-box').on('click', '.report-links .link', function () {
        $.get('/ajax/goods-report', {'goods_id': goods_id, 'type': $(this).attr('data-id')}, function (json) {
            json.code == 1 && reportLayer.show().animate({top: '-100px', opacity: '0'}, 2000, 'linear');
            json.code == -1 && quickLogin();
            json.code == 0 && FnApp.errorJs(json.msg);
        });
    });
}())

//收藏成功提示
;
(function () {
    $('.summary-box .user-box').on({
        'mouseenter': function () {
            $(this).find('.user-layerbox').show();
        },
        'mouseleave': function () {
            $(this).find('.user-layerbox').hide();
        }
    });
}())


//隐藏出价提示
;(function(){
    $('.product-parameter .disabledShootPrice-item').on({
        'mouseenter' : function(){
            $(this).siblings('.shootPrice-layerbox').show();
        },
        'mouseleave' : function(){
            $(this).siblings('.shootPrice-layerbox').hide();
        }
    },'#instantlyBuyLink');
}())

//站长推送
;(function(){
    var bp = document.createElement('script');
    var curProtocol = window.location.protocol.split(':')[0];
    if (curProtocol === 'https') {
        bp.src = 'https://zz.bdstatic.com/linksubmit/push.js';
    }
    else {
        bp.src = 'http://push.zhanzhang.baidu.com/push.js';
    }
    var s = document.getElementsByTagName("script")[0];
    s.parentNode.insertBefore(bp, s);
})();

;(function(){
    if($('#goodsSwitch').length>0) {
        var goodsSwitchTop = $('#goodsSwitch').offset().top + 44;

        function goodsSwitchFn() {
            if ($(window).scrollTop() >= goodsSwitchTop) {
                $('#goodsSwitch .switch-nav-box').addClass('fixed-switch-nav');
                $('#gotop').css('display', 'block')
            } else {
                $('#goodsSwitch .switch-nav-box').removeClass('fixed-switch-nav');
                $('#gotop').css('display', 'none')
            }
        }

        goodsSwitchFn();

        $(window).on('scroll', function () {
            goodsSwitchFn();
        });
    }
}());

$('#goodsSwitch').on('click', '.J_item', function () {
    $(this).addClass('current-item').siblings('.J_item').removeClass('current-item');
    var tabPanelTop = Number($(this).parents('.goods-switch').find('.J_tabPanel[id=' + $(this).attr('rel') + ']').offset().top) - Number($('#goodsSwitch .switch-nav').height());

    $(document).scrollTop(tabPanelTop)
});

// 查看芝麻信用
;(function(){
    $("#sesameCreditDialog").dialog({
        autoOpen: false,
        title : '系统提示',
        width : 460,
        modal : true,
        dialogClass : 'sesame-credit-dialog',
        buttons : [{
            text : '去授权',
            'class' : 'confirm-button',
            click: function () {
                window.location = '/user/setting?act=zmxy&click_source=detail';
            }
        }, {
            text : '取消',
            'class' : 'cancel-button',
            click: function () {
                $(this).dialog("close");
            }
        }]
    });

    $("#sesameCreditShowDialog").dialog({
        autoOpen: false,
        width: 460,
        modal: true,
        dialogClass: 'sesame-credit-show-dialog',
        buttons: []
    });

    // 若已经验证，则需要添加样式名"certified"
    $('#sesameCreditShow').on('click',function(){
        $(this).hasClass('certified') ? $("#sesameCreditShowDialog").dialog("open") : $("#sesameCreditDialog").dialog("open");
    });

    //查看芝麻信用分数  num 必定为整数
    if($('#sesameBoard').length > 0 && $('#lowSesameBoard').length > 0){
        var num = Number($('#sesameCreditShow').attr('data-score'));
        !$('html').hasClass('lowIE') ? SesameCreditCicrle(num) : lowSesameCreditCicrle(num);
    }
}());


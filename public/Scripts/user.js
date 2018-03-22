;(function () {
    //翻页
    var target = $('#pageBar'),
        tot = parseInt(target.attr('data-total'), 10),
        btn = target.find('.button'),
        input = target.find('.jump-page input');
    btn.on('click', function () {
        var val = parseInt($(input).val().toString(), 10);
        if (!$.isNumeric(val) || val <= 0 || val > tot) {
            alert('没有这么多页');
            return false;
        }

        if (window.location.search.indexOf('page') == -1) {
            var letter = window.location.search.indexOf('?') == -1 ? '?' : '&';
            var url = window.location.pathname + window.location.search + letter + 'page=' + val;
        }
        else {
            var url = window.location.pathname + window.location.search.toString().replace(/page=\d+/, 'page=' + val);
        }


        window.location.href = url;
    });

    input.on('keyup', function (event) {
        if (event.keyCode === 13) {
            btn.click();
        }
    });
}());

$(function () {
    // 导航下拉菜单
    $('.y-center-nav-box').each(function () {
        $(this).hover(function () {
            $(this).find('.y-center-nav-open').css('display', 'block');
            $(this).children('a').css('background-position-y', '-33px');
        }, function () {
            $(this).find('.y-center-nav-open').css('display', 'none');
            $(this).children('a').css('background-position-y', '-19px');
        });
    });

    $('input.text3').on('keyup', function (event) {
        if (event.keyCode === 13) {
            $('input.btn3').click();
        }
    });

    (function () {
        var target = $('.y-center-searchBox .menu'),
        	urlCfg = {'price' : '/price/def-1_1.html','auction' : '/auction/def-1_1.html','buy':'/buy/def-1_1.html'},
        	form   = $('#listSearch');
        // 搜索
        target.hover(function () {
            $(this).find('span').css({'border-left': '1px #e9e9e9 solid', 'border-top': '1px #e9e9e9 solid'});
            $(this).find('ul').css('display', 'block');
        }, function () {
            $(this).find('span').css({'border-left': '1px #fff solid', 'border-top': '1px #fff solid'});
            $(this).find('ul').css('display', 'none');
        });
        target.find('li').each(function () {
            $(this).click(function () {
                $(this).parent().hide();
                $(this).parent().siblings('span').html($(this).html());
                form.attr('action', urlCfg[$(this).attr('data')]);
            });
        });
        $('.inputBox a').click(function () {
            $('.inputBox .text1').val('');
        });

    }());
}());

;(function(){ // 二维码消息打通
    $("#wechatLayerBox").mouseover(function () {
        var scene_id = 15;
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
        $(this).addClass("wechat-hover");
    }).mouseout(function () {
        $(this).removeClass("wechat-hover");
    });
}())

$(document).ready(function () {
    ;(function () {
        if ($('.y-center-guide').css('display') == 'block') {
            $('.y-center-main').css('z-index', '100001');
            $('.y-center-guide .close').on('click', function () {
                $('.y-center-main').css('z-index', '1');
            });
        } else {
            $('.y-center-main').css('z-index', '1');
        }
    }());
});


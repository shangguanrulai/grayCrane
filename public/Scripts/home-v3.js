/**
 * @description : the script of 蜂鸟二手项目首页
 * @authors 	: hanjw (han.jingwei@fengniao.com)
 * @date    	: 2016-08-25 11:24:35
 * @link 		: http://example.org
 * @version 	: 1.0
 */
$(document).ready(function(){
    $('.banner-slider').bxSlider({
        controls : false,
        auto : true,
        autoHover : true
    });

    $('.speak-slider,.evaluate-slider').bxSlider({
        controls : false,
        mode: 'vertical',
        pager: false,
        auto: true,
        autoHover : true
    });

    $('.goods-bxslider').bxSlider({
        controls : true,
        pager: false,
    });

    //鼠标移出分类选择交互
    $('.J_switchTab').on('mouseleave',function(){
        $(this).find('.J_item').removeClass('current-item');
        $(this).find('.J_tabPanel').hide();

        $(this).show();
    });

    //蜂鸟回收分类tab切换
    $('.J_switchBox').on('mouseenter mouseout', '.J_item', function() {
        $(this).addClass('current-item').siblings('.J_item').removeClass('current-item');
        $(this).parents('.J_switchBox').find('.J_tabPanel[id=' + $(this).attr('rel') + ']').show().siblings('.J_tabPanel').hide();
    });


    $('.merchants-list li').hover(function () {
        $(this).addClass('hover-item');
    },function () {
        $(this).removeClass('hover-item');
    })

    $('#couponFixed').on('click','.closed-button',function(){
        $(this).parents('#couponFixed').hide();
        _hmt.push(['_trackEvent', '2_fengniao', 'close-left-coupon']);
    });

    //蜂鸟拍卖
    (function () {
        var $target = $('#FN-auction-layer'),
            $ul     = $target.find('ul'),
            nowTime = FnApp.nowTime,
            timer   = count = null;

        var countdown = function(target){
            var arr = [];
            if (target.find('.count-down-bar').length <= 0) {
                clearTimeout(count);
                return false;
            }
            $.each(target.find('.count-down-bar'),function(k,v){
                var remain = $(v).attr('diff_time');
                if (remain && remain > 0) {
                    arr.push(remain);
                    var real = parseInt(remain, 10) + nowTime,
                        time = Math.round(new Date().getTime() / 1000),
                        seconds = real - time,
                        minutes = Math.floor(seconds / 60),
                        hours = Math.floor(minutes / 60),
                        days = Math.floor(hours / 24),
                        CDay = days,
                        CHour = hours % 24,
                        CMinute = minutes % 60,
                        CSecond = Math.floor(seconds % 60),//取余
                        html = '<span>剩余</span>';

                    html += CDay ? '<em>'+CDay+'</em><span>天</span>' : '';
                    html += CHour ? '<em>'+CHour+'</em><span>时</span>' : '';
                    html += CMinute ? '<em>'+CMinute+'</em><span>分</span>' : '';
                    html += CSecond ? '<em>'+CSecond+'</em><span>秒</span>' : '';
                    $(v).html(html);
                }
            }); 
            
            count = setTimeout(function () {
                countdown(target);
            },1000);
            
            if (arr && timer === null) {
                timer = setTimeout(function () {
                    nowTime = Math.round(new Date().getTime() / 1000);
                    getData();
                },(Math.min.apply(null,arr) * 1000));
            }
        }
        
        var getData = function () {
            $.get('/ajax/index-auction',{"t" : (new Date()).getTime()},function(html){
                $ul.empty().append(html);
                countdown($ul);
                $ul.show();

                $ul.find('li').on({
                    'mouseenter' : function(){
                        if(!$(this).hasClass('sold-out-item')){
                            $(this).addClass('goods-hover-item')
                        };
                    },
                    'mouseleave' : function(){
                        $(this).removeClass('goods-hover-item')
                    }
                });
            });
        }
        var getGoods = function (page) {
            if(page<2){
                $.get('site/goodgrid', {
                    "t": (new Date()).getTime(),
                    "page": page
                }, function (html) {
                    var $items = $(html);
                    $('#goodsGrid').append($items);
                    page++;
                })
            }
        }
        getGoods(0);
        getGoods(1);
        getData();
    })();

    // 淘二手区块瀑布流
    (function(){
        var footerBoxHeight = $('.footer-box').height(),
            num = 2,
            lock = true;

        $('.grid-bottom').hide();

        function loadData(){
            if (num < 10) {
                if(lock){
                    lock = false;
                    $.get('site/goodgrid', {
                        "t": (new Date()).getTime(),
                        "page": num
                    }, function (html) {
                        // 动态加载淘二手的数据
                        scrollStart = $(document).scrollTop();
                        var $items = $(html);

                        $('#goodsGrid').append($items);
                        num++;
                        lock = true;
                    })
                }
            } else {
                $('.grid-bottom').show();
            }
        }

        $(window).scroll(function(){
            var scrollTop = $(this).scrollTop(),
                scrollHeight = $(document).height(),
                windowHeight = $(this).height();

            if((scrollTop + windowHeight) > (scrollHeight - footerBoxHeight)) {
                loadData();
            }
        });
    }());

    // 右侧导航
    (function() {
        var eleParent = $('#sidebarFixedNav'),
            ele = eleParent.find('.nav-item'),
            picBox = eleParent.find('.pic-box'),
            uid = 1;


        if($.cookie('sidebarPicBox') != 'closed'){
            picBox.css({
                'left': '-250px',
                'visibility' : 'visible'
            })
        } else {
            picBox.css({
                'left': '38px',
                'visibility' : 'hidden'
            })
        }

        picBox.on('click','.closed',function(){
            picBox.css({
                'left': '38px'
            }).delay(1000);

            $.cookie('sidebarPicBox', 'closed', {
                expires: 30 ,
            });
        });

        ele.on('mouseenter', function() {
            var       oText = $(this).find('.text'),
                oIcon = $(this).find('.icon'),
                index = $(this).index() ;

            eleParent.find('.pic-box').css({
                'left': '38px'
            })
            if (index != 1) {
                oText.css({
                    'background-color': '#ff511b',
                    'left': '-80px'
                })
                oIcon.css({
                    'background-color': '#ff511b'
                })
            } else {
                oIcon.css({
                    'background-color': '#ff511b'
                })

                picBox.css({
                    'left': '-250px',
                    'visibility' : 'visible'
                })
            }
        });

        ele.on('mouseleave', function() {
            var oText = $(this).find('.text'),
                oIcon = $(this).find('.icon'),
                index = $(this).index() ;

            if (index != 1) {
                oText.css({
                    'left': '38px',
                    'background-color': '#444'
                }).delay(1000);

                oIcon.css({
                    'background-color': '#444'
                }).delay(1000);
            } else {
                oIcon.css({
                    'background-color': '#444'
                }).delay(1000);

                picBox.css({
                    'left': '38px'
                }).delay(1000);
            }
        });

    // $('.sidebar-nav-item').on('click','.item1,.item2,.item3,.item4',function(){
        //     if (!uid) {
        //         quickLogin();
        //         return false;
        //     }
        // }) 
    }());

    // 左侧楼层定位
    (function(){
        var $fixWrap = $('.floor-fixed-wrap'),
            $fix = $('.floor-fixed-bar')
            cfg = $fix.find('span').map(function(){
                return $(this).attr('rel');
            }).get(),
            floor = {},
            goodsGridBoxTop = $('#goodsGridBox').offset().top - 200;

            for (x in cfg) {
                floor[$('.' +cfg[x]).offset().top + $('.' +cfg[x]).height()/2] = cfg[x]
            }

        if (!Object.keys) {
            Object.keys = function(obj) {
                var keys = [];

                for (var i in obj) {
                    if (obj.hasOwnProperty(i)) {
                        keys.push(i);
                    }
                }

                return keys;
            };
        } //兼容IE8

        function sortNumber(a,b){
            return a - b
        }

        var offset = Object.keys(floor).sort(sortNumber);

        $(window).scroll(function() {
            var bodyTop = $(document).scrollTop();

            if(400 > bodyTop > 0){
                $fix.css('visibility','hidden');
            }else if(bodyTop > 400) {
                $fix.css('visibility', 'visible');

                var $current = null;
                for (x in offset) {
                    if (bodyTop <= offset[x]) {
                        $current = $fix.find('[rel="'+floor[offset[x]]+'"]');
                        break;
                    }
                }

                if(bodyTop < goodsGridBoxTop) {
                    $current.addClass('current').siblings().removeClass('current');
                }else{
                    $('.goods-fixed-link').addClass('current').siblings().removeClass('current');
                }


            }
        });


        $fixWrap.on('click','.floor-link',function(){
            var bodyTopValue = $('.' + $(this).attr('rel')).offset().top;
            $(document).scrollTop(bodyTopValue);
            $fixWrap.find('.floor-link').removeClass('current');
            $(this).addClass('current');
        });
    }());

    // 芝麻信用提示弹层
    (function(){
        $.cookie('bbuserid') && $.cookie('bbusername') && $.cookie('sesameCreditDialog') !== 'closed' ? $('#sesameCreditDialog').show() : ''

        $('#sesameCreditDialog').on('click','.closed-btn',function(){
            $('#sesameCreditDialog').hide();
            $.cookie('sesameCreditDialog', 'closed', {
                expires: 1 ,
                path: '/'
            }); // 用户关闭了，一天之内不显示
        });
    }());
});
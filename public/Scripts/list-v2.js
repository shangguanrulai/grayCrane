$(function(){
    _initErrorDialog();
	//搜索右侧广告推广
    (function () {
        $.get('/es-list-v2/get-recommend',{},function (html) {$('#searchContainer').prev().before(html);});
    })();
	
    //筛选交互
    (function () {
        //crumbs
        $('#listCrumbs .select-tag:has(div.down-list)').hover(function () {$(this).addClass('select-hover');},function () {$(this).removeClass('select-hover');});

        var $filter = $('#listFilter'),
            $category = $filter.find('.category'),
            $manu     = $filter.find('.manu'),
            upTriCls  = 'pack-up',
            subCls    = 'show-sub-layer',
            manuCss   = {'height' : '135px','overflow' : 'auto','margin' : '10px 0 15px 110px','padding' : '0 0 25px','background' :  '#fff'};

        //category-filter
        $category.on('click','.more-link',function () {
            if (!$(this).hasClass(upTriCls)) {
                $(this).addClass(upTriCls);
                $(this).prev().css('height','auto');
                $(this).text('收起');
            }else {
                $(this).removeClass(upTriCls);
                $(this).prev().css('height','');
                $(this).text('更多');
            }
        });

        //分类品牌更多是否显示
        for (var x in [$category,$manu]){
            $ele = [$category,$manu][x];
            if ($ele.find('div.filter-sub-links > a.tag').length > 0) {
                var totWidth = 0;
                $.map($ele.find('div.filter-sub-links > a.tag'),function(ele,idx){return totWidth += $(ele).outerWidth();});
                if ($ele.find('div.filter-sub-links').width() > totWidth) {
                    $ele.find('.more-link').hide();
                }
            }
        };

        //manu-filter
        $manu.on('click','.more-link',function () {
            if (!$(this).hasClass(upTriCls)) {
                $(this).addClass(upTriCls);
                $(this).prev().css(manuCss).addClass(subCls);
                $(this).prev().find('.tag').css('width',220);
                $(this).prev().prev().show();
                $(this).prev().prev().find('input').trigger('keyup');
                $(this).text('收起');
            }else {
                $(this).removeClass(upTriCls);
                $(this).prev().removeAttr('style').removeClass(subCls).scrollTop(0);
                $(this).prev().find('.tag').removeAttr('style');
                $(this).prev().prev().hide();
                $(this).text('更多');
            } 
        });

        //manu-search
        $manu.on('keyup','input',function () {
            var query = $(this).val().toLowerCase(),
                $target = $(this).parent().next().find('.tag');
            
            if (query !== '') {
                
                $target.each(function (idx,ele) {
                    var name = $(ele).text().replace(/\(\d+\)/g,'').toLowerCase();
                    if (name.indexOf(query) !== -1) {
                        $(ele).show();
                    }else{
                        $(ele).hide();
                    }
                });

                //no result
                if ($target.length === $target.filter(':hidden').length) {
                    if ($target.parent().find('p').length > 0) {
                        return false;
                    }
                    
                    $target.hide().parent().css({
                        'height' : '30px',
                        'overflow' : 'hidden',
                        'margin' : '10px 0 15px 110px',
                        'padding' : '0',
                        'background' :  '#fff'
                    }).append('<p>对不起,没有找到相关品牌</p>');
                }else{
                    $target.parent().removeAttr('style').css(manuCss).addClass(subCls).find('p').remove();
                }

            }else {
                $target.parent().removeAttr('style').css(manuCss).addClass(subCls).find('p').remove();
                $target.show();
            }
        });

        var $tagLayer = $('#listTagSearch'),
            $input    = $filter.find('.filter-tag input[data-name]'),
            $flrLayer = $('#listFilterLayer'),
            $floatIpt = $flrLayer.find('.sub-filter-tag input[data-name]'),
            flrTop    = $flrLayer.offset().top,
            $tagItem  = $tagLayer.find('label'),
            $form 	  = $('#listFilterForm'),
            $tVal	  = $tagLayer.find('#tagIdsValue'),
            fixCls    = 'fixed-filter-price-box';

        //标签筛选
        $tagItem.find('input[group="5"]').on('click',function () {
            location.href = '/auction';
            return false;
        });
        $tagItem.find('input').on('change',function(){
            if (parseInt($(this).attr('group'),10) === 5) {
                return false;
            }
            
            var keys = [];
            $tagItem.find('input:checked').each(function(){
                keys.push($(this).val());
            });

            return $tVal.val(keys.join('-')) && $form.submit();
        });

        $(window).on('scroll',function(){
            if ($(window).scrollTop() > flrTop) {
                $floatIpt.each(function (idx,ele) {
                    $(ele).attr('name',$(ele).attr('data-name'));
                });
                $input.removeAttr('name');
                
                $flrLayer.addClass(fixCls);
            }else{
                $input.each(function (idx,ele) {
                    $(ele).attr('name',$(ele).attr('data-name'));
                });
                $floatIpt.removeAttr('name');

                $flrLayer.removeClass(fixCls);
            }
        });

        //输入框使用统计
        $floatIpt.on('keyup',function () {
            var act = {"k" : "list-hover-input-kwd","u" : "list-input-seller","nk" : "list-hover-input-notkwd"};
            _hmt.push(['_trackEvent', '2_fengniao', act[$(this).attr('data-name')]]);
        });
        $input.on('keyup',function () {
            var act = {"k" : "list-input-kwd","nk" : "list-input-notkwd","u" : "list-seller"};
            _hmt.push(['_trackEvent', '2_fengniao', act[$(this).attr('data-name')]]);
        });

        (function ($) {
            $.support.placeholder = ('placeholder' in document.createElement('input'));

            //fix for IE7 and IE8
            if (!$.support.placeholder) {
                $("input[data-name]").focus(function () {
                    if ($(this).val() == $(this).attr("placeholder")) $(this).val("");
                }).blur(function () {
                    if ($(this).val() == "") $(this).val($(this).attr("placeholder"));
                }).blur();

                $form.submit(function () {
                    $(this).find('input[data-name]').each(function() {
                        if ($(this).val() == $(this).attr("placeholder")) {
                            $(this).val("");
                        }
                    });
                });
            }
        })(jQuery);

    })();

    //翻页
	(function(){
		var target = $('#pageBar'),
			tot	   = parseInt(target.attr('data-total'),10),
			btn	   = target.find('.button'),
			input  = target.find('.jump-page input');
		
		btn.on('click',function(){
			var val = parseInt($(input).val().toString(),10);
			if (!$.isNumeric(val) || val <= 0 || val > tot) return false;
			
			var url = window.location.pathname.replace(/\_\d+\.html/,'_'+val+'.html') + window.location.search.toString();
			window.location.href = url;
		});
		
		input.on('keyup',function(event){
			if (event.keyCode === 13) {
				btn.click();
			}
		});
	})();
	
	(function(){
        var $container = $('div.wrapper-box'),
            lock = false;
            
        if (typeof goodsIdArr !== undefined && typeof urlParam !== undefined && typeof usersIdArr !== undefined) {
            var $item   = parseInt(urlParam.style) === 1 ? $('ul.goods-list li.goods-item') : $('ul#goodsPictureList li.goods-item'),
                timer   = {},
                cls  = urlParam.style === 1 ? 'collected' : 'collected-tag';

            //是否收藏
            $.get('/list/ajax-focus',{"ids" : goodsIdArr.toString()},function(json){
                if (json.info == 'ok') {
                    var target = $.map(json['options']['data'],function (ele,idx) {
                        if (ele == 1) return '[data-id="'+idx+'"]';
                    });
                    $(target.join()).addClass(cls);
                }
            },'json');

            //user-info
            $.get('/es-list-v2/get-user-info',{"users" : usersIdArr.toString(),"style" : urlParam.style},function (json) {
                if (json) {
                    var $target = $container.find('[data-role="user-info"]');
                    $.each(json.msg,function (idx,ele) {
                        if (parseInt(urlParam.style) === 1) {
                            $target.filter('[data-id="'+idx+'"]').html(ele);
                        }else {
                            $target.filter('[data-id="'+idx+'"]').prepend(ele);
                        }
                    });

                    //hover-user-layer
                    var cls = parseInt(urlParam.style) === 1 ? 'user-hover' : 'author-hover',
                        nam = parseInt(urlParam.style) === 1 ? '.user-bar a.user-name' : '.goods-price-box span.autor-wrap',
                        lay = parseInt(urlParam.style) === 1 ? '.user-bar div.user-layer' : '.goods-price-box div.author-layer';
                    $item.find(nam).hover(function () {
                        var $self = $(this);
                        timer.b = setTimeout(function () {
                            $self.parent().addClass(cls);
                        },200);
                    },function () {
                        clearTimeout(timer.b);
                        var $self = $(this);
                        timer.a = setTimeout(function () {
                            $self.parent().removeClass(cls);
                        },200);
                    });
                    $item.find(lay).hover(function () {
                        clearTimeout(timer.a);
                    },function () {
                        $(this).parent().removeClass(cls);
                    });
                }
            },'json')


            //大图模式
            if (parseInt(urlParam.style) === 2) {
                var $picList = $item.parent();
                $picList.imagesLoaded(function(){
                    $picList.masonry({
                        itemSelector:'.goods-item', //class选择器,默认'.item'
                        columnWidth: 230, //一列的宽度
                        gutterWidth: 20, //列的间隙 Integer
                        //isFluid:false, //
                        //isFitWidth:true, //适应宽度Boolean
                        isResizable:true //是否可调整大小 Boolean
                    });

                });
                
                $item.hover(function () {
                    $(this).addClass('goods-hover-item');
                },function () {
                    $(this).removeClass('goods-hover-item');
                })
            }
        }

        //收藏
        $container.on('click','[data-role="collect"]',function () {
            if(jsChkUserLogin() || lock) return false;

            var $self = $(this),
                cls   = $self.attr('data-cls'),
                url   = $(this).hasClass(cls) ? '/ajax/goods-collect-cancel' : '/ajax/goods-collect';

            lock = true;
            $.get(url,{"goods_id" : $self.attr('data-id')},function (json) {
                if (json.code == 1) {
                    var num = $self.text() ? parseInt($self.text(),10) : false;
                    if ($self.hasClass(cls)) {
                        $self.removeClass(cls);
                        num !== false && num > 0 && $self.html('<i></i>' + (num-1));
                    }else {
                        $self.addClass(cls);
                        num !== false && $self.html('<i></i>' + (num + 1));
                    }
                }else {
                    json.msg && jsError(json.msg);
                }
                lock = false;
            },'json');
        });
        
        var nodata = false;
        //auction
        var auction = {
            getData : function (pos) {
                if (nodata === true) return false;
                var style = typeof urlParam !== undefined ? urlParam.style : 1;
                var url = pos == 'banner' ? '/es-list-v2/get-banner-auction' : '/es-list-v2/get-side-auction?s='+style,
                    self= this;
                $.get(url,{},function (html) {
                    if (html) {
                        self[pos](html);
                    }else {
                        nodata = true;
                    }
                });
            }
            ,banner : function (html) {
                $container.find('div.main').find('div.auction-activities-section').remove();
                $container.find('div.main').prepend(html);
                this.countdown('[data-role="countdown"]','banner');
            }
            ,side : function (html) {
                $container.find('div.aside ul.auction-list').empty().html(html);
                this.countdown('[data-role="countdown-side"]','side');
            }
            //countdown
            ,countdown : function (selector,pos) {
                var self = this;
                if ($container.find(selector).length > 0) {
                    FnApp.countdownList($container.find(selector),function ($tar,day,hour,min,sec) {
                        if (day === 0 && hour === 0 && min === 0 && sec === 0) {
                            self.getData(pos);
                        }else {
                            if (day === 0) {
                                html = '<span>'+hour+'<em>时</em></span>';
                                html += '<span>'+min+'<em>分</em></span>';
                                html += '<span>'+sec+'<em>秒</em></span>';
                            }else {
                                html  = '<span>'+day+'<em>天</em></span>';
                                html += '<span>'+hour+'<em>时</em></span>';
                                html += '<span>'+min+'<em>分</em></span>';
                            }
                            $tar.find('span').remove();$tar.append(html);
                        }
                    })
                }
                return ;
            }
        };
        auction.getData('banner');
        auction.getData('side');
	})();
    
    //大家都在看
    (function () {
        var $ul = $('ul.appraisal-list');
        $.get('/es-list-v2/get-appraisal',{},function (html) {
            html && $ul.html(html) && $ul.find('li').hover(function () {
                $(this).addClass('appraisal-hover-item');
            },function () {
                $(this).removeClass('appraisal-hover-item');
            });
        });
    })();

	(function(){
		
		var cityBox  = $('.J_cityBox'),
			province = $('.J_proviceItems'),
			timer	 = null;

		cityBox.hover(function(){
			$(this).addClass('select-city');
			
		},function(){
			$(this).removeClass('select-city');
			province.find('li').removeClass('li-hover');
			
		});
		
		province.find('li').hover(function(){
			$(this).addClass('li-hover').siblings('li').removeClass('li-hover');
		},function(){
			var self = $(this);
			timer = setTimeout(function(){
				self.removeClass('li-hover');
			},100);
		});
		province.find('li .city-tags').hover(function(){
			clearTimeout(timer);
		},function(){});

	})();

    // 蜂鸟二手交易V2.7.1 匹配型号 
    ;(function(){ // 二维码消息打通-PC-V2.5
        $("#wechatLayerBox").mouseover(function () {
            var scene_id = 18;
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
    }());

    ;(function(){
        var recommendedGoodsSection = $('#recommendedGoodsSection')
        recommendedGoodsSection.on('click','.open-link',function(){
            if(recommendedGoodsSection.hasClass('closure')){
                recommendedGoodsSection.removeClass('closure');
                $(this).text('收起');
            }else{
                recommendedGoodsSection.addClass('closure');
                $(this).text('展开全部');
            }
        });
    }());
});


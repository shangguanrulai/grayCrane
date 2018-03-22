var goodsIndex = {
    itemLength: $('#selectItems > .item').outerWidth(true),
    start: function () {
        var obj = this;
        $('#selectItems').on('click', 'li:eq(0) .link', function () {
            var _this = $(this),
                _cateId = _this.attr('data-id');
            $.get('/ajax/goods-category', {'cate_id': _cateId}, function (json) {
                if (json.code) {
                    var html = '';
                    subcateJson = json.item.subitem;
                    $.each(subcateJson, function (k, v) {
                        html += '<span data-id="' + v.id + '" class="link">' + v.name + '</span>';
                    });
                    _this.addClass('current').siblings('.link').removeClass('current');
                    $('.sub-location').html(loc + '<span>' + _this.text() + '</span><i>&gt;</i>');
                    $('#cate_id').val(_cateId);
                    obj.disabledButton();
                    obj.displayLoc();
                    $('#subcate_id ,#brand_id ,#model_id').val('');
                    var _obj = _this.parents('.item').next('.item');
                    _obj.find('.empty-tip').hide();
                    _obj.find('.filter-bar').show();
                    _obj.next('.item').find('.empty-tip').show();
                    _obj.find('.filter-bar').find('.links').html(html);
                }
            });
        }).on('click', 'li:eq(1) .link', function () {
            var _this = $(this),
                _subcateId = _this.attr('data-id');
            $.get('/ajax/goods-category', {'subcate_id': _subcateId}, function (json) {
                if (json.code) {
                    var html = '';
                    brandJson = json.item.subitem;
                    $.each(brandJson, function (k, v) {
                        html += '<span data-id="' + v.id + '" class="link">' + v.name + '</span>';
                    });
                    _this.addClass('current').siblings('.link').removeClass('current');
                    $('.sub-location').html(loc + '<span>' + _this.parents('.item').prev('.item').find('.current').text() + '</span><i>&gt;</i><span>' + _this.text() + '</span><i>&gt;</i>');
                    _this.parents('.item').find('input').val(_this.text());
                    $('#subcate_id').val(_subcateId);
                    goodsIndex.activeButton();
                    $('#brand_id ,#model_id').val('');
                    var _obj = _this.parents('.item').next('.item');
                    _obj.find('.empty-tip').hide();
                    _obj.find('.filter-bar').show();
                    _obj.next('.item').find('.empty-tip').show();
                    _obj.find('.filter-bar').find('.links').html(html);
                    _obj.find('.filter-bar').find('input').val('');
                }
            });
        }).on('click', 'li:eq(2) .link', function () {
            var _this = $(this),
                _brandId = _this.attr('data-id'),
                _subcateId = $('#subcate_id').val();
            $.get('/ajax/goods-category', {'brand_id': _brandId, 'subcate_id': _subcateId}, function (json) {
                if (json.code) {
                    var html = '';
                    modelJson = json.item.subitem;
                    $.each(modelJson, function (k, v) {
                        html += '<span data-id="' + v.id + '" class="link">' + v.name + '</span>';
                    });
                    _this.addClass('current').siblings('.link').removeClass('current');
                    var pre = _this.parents('.item').prev('.item');
                    $('.sub-location').html(loc + '<span>' + pre.prev('.item').find('.current').text() + '</span><i>&gt;</i><span>' + pre.find('.current').text() + '</span><i>&gt;</i><span>' + _this.text() + '</span><i>&gt;</i>');
                    _this.parents('.item').find('input').val(_this.text());

                    $('#brand_id').val(_brandId);
                    $('#model_id').val('');

                    var _obj = _this.parents('.item').next('.item');
                    _obj.find('.empty-tip').hide();
                    _obj.find('.filter-bar').show();
                    $('.box-brand').find('.empty-tip').hide();
                    _obj.find('.filter-bar').find('.links').html(html);
                    _obj.find('.filter-bar').find('input').val('');
                    $('#selectItems').css('left', -obj.itemLength);
                    $('.select-classification-box').find('.prev').css('visibility', 'visible');
                    $('.select-classification-box').find('.next').css('visibility', 'visible');
                }
            });
        }).on('click', 'li:eq(3) .link', function () {
            var _this = $(this);
            _this.addClass('current').siblings('.link').removeClass('current');
            _this.parents('.item').find('input').val(_this.text());
            var pre = _this.parents('.item').prev('.item');
            $('.sub-location').html(loc + '<span>' + pre.prev('.item').prev('.item').find('.current').text() + '</span><i>&gt;</i><span>' + pre.prev('.item').find('.current').text() + '</span><i>&gt;</i><span>' + pre.find('.current').text() + '</span><i>&gt;</i><span>' + _this.text() + '</span><i>&gt;</i>');
            $('#model_id').val(_this.attr('data-id'));
        })
    },
    activeButton: function () {
        $('.rule-button').attr('disabled', false).removeClass('disabled-button');
    },
    disabledButton: function () {
        $('.rule-button').attr('disabled', true).addClass('disabled-button');
        $('#subcate_id,#brand_id,#model_id').val('');
    },
    displayLoc: function () {
        $('.sub-location').show();
    },
    enAdd: function () {
        var res =
            $.ajax({
                url: "/ajax/user-money",  //url
                async: false,
                dataType: 'json'
            }).responseText;
        res = eval("(" + res + ")");
        if (res.code == 0) {
            var brDio = $("#balanceRecoveryDialog");
            brDio.find('p').html('当前账户余额:' + res.money + '元,您至少需要充值' + res.needMoney + '元');
            brDio.dialog({
                modal: true,
                title: "系统提示",
                width: 460,
                close: function () {
                    $(this).dialog("close");
                },
                buttons: [
                    {
                        text: "立即充值",
                        'class': "confirm-button",
                        click: function () {
                            window.location.href = "/user/recharge?order_type=1";
                        }
                    }, {
                        text: "取消",
                        'class': "cancel-button",
                        click: function () {
                            $(this).dialog("close");
                        },
                    }
                ]
            });
        }
    },
    init: function () {
        var obj = this;
        $('#navbox').on('click', 'li', function () {
            $(this).addClass('current-item').siblings('li').removeClass('current-item');
            $('#goods-type').val($(this).attr('index'));
            $('#form-goods-type').val($(this).attr('index'));
            (!goodsId && $(this).attr('index') == 2 ) && obj.enAdd();
            $('.location-path span').text('发布' + typeCfg[$(this).attr('index')]);
        });
        $('.prev').on('click', function () {
            $('#selectItems').css('left', 0);
        });
        $('.next').on('click', function () {
            $('#selectItems').css('left', -obj.itemLength);
        });
    }
}
$(function () {
    goodsIndex.init();
    goodsIndex.start();
    $('#ruleBar').tinyscrollbar();


    (function () {
        var form = $('#searchForm');

        //后退重置表单

        form.get(0).reset();

        //filter empty
        form.on('submit', function () {
            return form.find('input.filter-text').val() != '';
        });
    })();

    //选择分类
    ;
    (function () {
        var chbox = $('#chooseItem'),
            selItem = $('#selectItems'),
            list = [selItem.find('li:eq(1) div.overview'), selItem.find('li:eq(2) div.overview'), selItem.find('li:eq(3) div.overview')],
            choose = chbox.find('.release-items'),
            close = chbox.find('span.closed-button'),
            select = $('#selectItemBox'),
            cate = $('#cate_id'),
            subcate = $('#subcate_id'),
            manu = $('#brand_id'),
            product = $('#model_id'),
            data = [cate, subcate, manu, product],
            subLoc = $('.sub-location'),
            scroll = [subcate, manu, product];

        choose.on('click', 'li', function () {
            var ids = $(this).attr('data-id').split('-');
            if (ids) {
                for (x in ids) {
                    data[x].val(ids[x]);
                }
                choose.find('li').removeClass('select');
                $(this).addClass('select');
                subLoc.html(loc + $(this).html()).show();
                return goodsIndex.activeButton();
            }
            return;
        });

        //close
        close.on('click', function () {
            if (cateId) {
                window.location.href = window.location.href;
            } else {
                return chbox.hide() && select.show();
            }
        });

        //auto scroll
        for (x in scroll) {
            var id = scroll[x].val(),
                tar = list[x].find('span[data-id="' + id + '"]');
            if (tar.length > 0) {
                var h = tar.position().top - tar.height();
                list[x].scrollTop(h);
            }
        }
    })();

    //title len
    (function () {
        var target = $('input[name="keyword"]');
        target.on('keyup', function () {
            var len = FnApp.mbStrLen($(this).val().toString());
            if (len >= 50) {
                $(this).val(FnApp.mbSubstr($(this).val(), 50));
            }
            return;
        });
    })();

    (function () {
        $('.box-subcate').on('keyup', 'input', function () {
            var q = $(this).val(),
                html = '',
                current = '';
            $.each(subcateJson, function (k, v) {
                if (v.name.toLowerCase().indexOf(q.toLowerCase()) >= 0 || !q) {
                    current = $('#subcate_id').val() == v.id ? 'current' : '';
                    html += '<span data-id="' + v.id + '" class="link ' + current + '">' + v.name + '</span>';
                }
            })
            $('.box-subcate').find('.filter-bar').find('.links').html(html);
        }).find('input').val('');

        $('.box-brand').on('keyup', 'input', function () {
            var q = $(this).val(),
                html = '',
                current = '';
            $.each(brandJson, function (k, v) {
                if (v.name.toLowerCase().indexOf(q.toLowerCase()) >= 0 || !q) {
                    current = $('#brand_id').val() == v.id ? 'current' : '';
                    html += '<span data-id="' + v.id + '" class="link ' + current + '">' + v.name + '</span>';
                }
            })
            $('.box-brand').find('.filter-bar').find('.links').html(html);
        }).find('input').val('');

        $('.box-model').on('keyup', 'input', function () {
            var q = $(this).val(),
                html = '',
                current = '';
            $.each(modelJson, function (k, v) {
                if (v.name.toLowerCase().indexOf(q.toLowerCase()) >= 0 || !q) {
                    current = $('#model_id').val() == v.id ? 'current' : '';
                    html += '<span data-id="' + v.id + '" class="link ' + current + '">' + v.name + '</span>';
                }
            })
            $('.box-model').find('.filter-bar').find('.links').html(html);
        }).find('input').val('');

    })();

})
$('.cancle_collect').click(function () {
    var goods_id = $(this).attr('goods_id');
        type_id = $(this).attr('type_id');
    $("#cancleCollectDialog").dialog({
        autoOpen: false,
        width: 456,
        title: '取消收藏',
        dialogClass: "y-center-alert",
        buttons: [{
            text: '确定 ', //确认购买
            'class' : 'confirm-button',
            click: function () {
                $.ajax({
                    url: '/ajax/goods-collect-cancel',
                    type: "get",
                    dataType: "json",
                    data: {'goods_id': goods_id,'type_id':type_id},
                    success: function (json) {
                        if (json.code == 1) {
                            $('#goods_' + goods_id).remove();
                            $('#cancleCollectDialog').dialog("close");
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
    $("#cancleCollectDialog").dialog("open");
})

$('.cancle_seller_collect').click(function () {
    var seller_id = $(this).attr('seller_id');
    $("#cancleCollectDialog").dialog({
        autoOpen: false,
        width: 456,
        title: '取消收藏',
        dialogClass: "y-center-alert",
        buttons: [{
            text: '确定 ', //确认购买
            click: function () {
                $.ajax({
                    url: ajax_url,
                    type: "get",
                    dataType: "json",
                    data: {'seller_id': seller_id, 'act': 'cancel_seller_collect'},
                    success: function (json) {
                        if (json.code == 1) {
                            $('#seller_' + seller_id).remove();
                            $('#cancleCollectDialog').dialog("close");
                        }
                    }
                });
            }
        }, {
            text: '取消', //取消
            click: function () {
                $(this).dialog("close");
            }
        }]
    });
    $("#cancleCollectDialog").dialog("open");
})

$('.collectSeller span').click(function () {
    $('#' + $(this).parent().attr('seller')).find('.collectSeller').find('span').removeClass('active');
    $(this).addClass('active');
    $('#' + $(this).parent().attr('seller')).find('.right .content').hide();
    $('#' + $(this).attr('tag')).show();
    var url =$(this).attr('data-url'),
        sfa =$('#' + $(this).parent().attr('seller')).find('.collectSeller').find('a');
    if(url){
        sfa.attr('href',url).show();
    }else{
        sfa.hide();
    }
});

//商品搜索
$('#searchbtn').click(function () {
    var str = $.trim($('#q').val());
    str = encodeURIComponent(str);

    if (window.location.search.indexOf('&q=') == -1) {
        window.location.href = window.location.pathname + window.location.search + '&q=' + str;
    } else {
        window.location.href = window.location.pathname + window.location.search.toString().replace(/&q=.*/, '&q=' + str);
    }
});

//add by hanjw 20160412 -- 推送商品弹层
;(function () {
    var obj = $("#pushgoodsDialog");
    obj.dialog({
        autoOpen: false,
        width: 490,
        title: '推送商品',
        dialogClass: "y-center-alert",
        buttons: [{
            text: '确定 ', //确认购买
            click: function () {
                var ids = $('#push-form').serialize();
                if (ids.substr(0, 3) == 'pid') {
                    return false;
                }
                ids && $.get('/ajax/goods-push-tobuyer', ids, function (json) {
                    $('#pushSuccess').dialog("open") && obj.dialog("close");
                })
            }
        }, {
            text: '取消', //取消
            click: function () {
                obj.dialog("close");
            }
        }]
    });
    $("#pushSuccess").dialog({
        autoOpen: false,
        width: 436,
        height: "auto",
        modal: true,
        title: "推送成功",
        dialogClass: "y-center-alert-releaseofgoods",
        buttons: {
            '返回': function () { //返回
                $(this).dialog("close");
            }
        }
    });

    $('.rowRequest3').on('click', '.push_button', function () {
        $.get('/ajax/goods-push-buyer', {'goods_id': $(this).attr('goods_id')}, function (json) {
            if (json.code == 1) {
                var goods = json.item.goods,
                    list = json.item.list,
                    defaulthtml = '',
                    cancel = $('.pushgoods-filter').find('.arrow-wrap'),
                    pushgoods = $('.pushgoods-key');

                obj.find('.good-title-box').find('.good-title').html(goods.model_name + ' ' + goods.quality_desc + ' ' + goods.price + '元以下');
                obj.find('.pushgoods-tip').find('.user-name').text(goods.user_name).attr('href', '/credit/list?userId=' + goods.user_id);
                obj.find('#pid').val(goods.user_id);
                var html = '';
                $.each(list, function (k, v) {
                    if (v.model_id == goods.model_id) {
                        html += '<li class="pushgoods-item clearfix">';
                        html += '<label for="item1"> ';
                        html += '<input type="checkbox" name="ids[' + v.goods_id + '][]" value="' + v.id + '"><span class="good-title" title="' + v.goods_name + '">' + v.model_name + '</span>';
                        html += '</label>';
                        html += v.model_id == goods.model_id ? '<span class="tag">匹配</span>' : '';
                        html += '<span class="quality-tag">' + v.quality_desc + '</span>';
                        html += '<span class="price-tag">¥' + v.price + '</span>';
                        html += '<a target="_blank" href="' + v.url + '" class="detail-link">查看详情</a>';
                        html += '</li>';
                    }
                })

                obj.find('.pushgoods-list').html(html);
                pushgoods.val('');
                cancel.hide();
                defaulthtml = html;
                cancel.on('click', function () {
                    cancel.hide() && pushgoods.val('') && pushgoods.keyup();
                })
                pushgoods.on('keyup', function () {
                    var q = $(this).val();
                    q && cancel.show();
                    !q && cancel.hide();
                    var html = '';
                    $.each(list, function (k, v) {
                        if (v.model_name.toLowerCase().indexOf(q.toLowerCase()) >= 0 || !q) {
                            html += '<li class="pushgoods-item clearfix">';
                            html += '<label for="item1"> ';
                            html += '<input type="checkbox" name="ids[' + v.goods_id + '][]" value="' + v.id + '"><span class="good-title" title="' + v.goods_name + '">' + v.model_name + '</span>';
                            html += '</label>';
                            html += v.model_id == goods.model_id ? '<span class="tag">匹配</span>' : '';
                            html += '<span class="quality-tag">' + v.quality_desc + '</span>';
                            html += '<span class="price-tag">¥' + v.price + '</span>';
                            html += '<a target="_blank" href="' + v.url + '" class="detail-link">查看详情</a>';
                            html += '</li>';
                        }
                    })
                    html = q ? html : defaulthtml;
                    obj.find('.pushgoods-list').html(html);
                });
                obj.dialog("open");
            }else{
                return FnApp.errorJs(json.msg);
            }

        })
    });
}())

;
(function () {
    $('.reputation-item').on('mouseenter', function () {
        $(this).addClass('current-item');
    });

    $('.reputation-layerbox').on('mouseleave', function () {
        $(this).parent('.reputation-item').removeClass('current-item');
    });

    $('.y-center-focus-listbox .content').on('mouseleave', function () {
        $(this).find('.reputation-item').removeClass('current-item');
    });
}())


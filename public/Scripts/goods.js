$.ajaxSetup({cache: false});
$('.y-center-main-right .close').click(function () {
    var dltDio = $("#dltGoods"),
        goods_id = $(this).attr('goods_id'),
        isdeposit = $(this).attr('isdeposit'),
        tit = isdeposit?'<h3 style="padding: 10px 0 0;">删除商品，系统将自动退还您所缴纳的保证金，商品不可恢复。</h3><p style="padding: 5px 0 20px; color: #999;">注：删除商品后可在个人中心  <a class="no-style" href="/user/myWallet" target="_blank">我的钱包</a> 或 卖家中心  <a href="/user/myWallet" class="no-style" target="_blank">我的钱包</a>查看</p>':'<p class="word">您确定要删除此商品吗？</p> ';
    dltDio.find('.content').html(tit);

    dltDio.dialog({
        autoOpen: false,
        width: 456,
        title: '删除',
        dialogClass: "y-center-alert",
        buttons: [{
            text: '确认',
            'class': 'confirm-button',
            click: function () {
                _hmt.push(['_trackEvent', '2_fengniao', 'goods', 'deleteGoodsConfirm', '0']);
                $.ajax({
                    url: ajax_url,
                    type: "get",
                    dataType: "json",
                    data: {'goods_id': goods_id, 'act': 'goods', 'op': 'drop'},
                    success: function (json) {
                        if (json.code == 1) {
                            $('#goods_' + goods_id).remove();
                            dltDio.dialog("close");
                        } else {
                            dltDio.dialog("close");
                            $("#pushError ._error").html(json.msg);
                            $("#pushError").dialog("open");
                        }
                    }
                });
            }
        }, {
            text: '返回', //取消
            'class': 'cancel-button',
            click: function () {
                $(this).dialog("close");
            }
        }]
    });
    if (validateGoodsStatus(goods_id)) {
        _hmt.push(['_trackEvent', '2_fengniao', 'goods', 'deleteOpen', '0']);
        dltDio.dialog("open");
    }
})
$('.rent-goods').on('click',function(){
    var id = $(this).attr('data-id');
    $.post('/user/rent-share',{'goods_id':id,'_csrf':csrf},function(html){
        if (html) {
            window.location.reload();
        }
    })
})
$('.close-goods').on('click', function () {
    var goods_id = $(this).attr('goods_id'),
        is_closed = $(this).attr('is_closed'),
        label = is_closed == 0 ? '下架' : '上架',
        v = is_closed == 0 ? 1 : 0;
    $("#closeGoods").dialog({
        autoOpen: false,
        width: 456,
        title: label + '商品',
        dialogClass: "y-center-alert",
        buttons: [{
            text: '确认',
            'class' : 'confirm-button',
            click: function () {
                $.ajax({
                    url: ajax_url,
                    type: "get",
                    dataType: "json",
                    data: {'goods_id': goods_id, 'act': 'goods', 'op': 'uc', 'is_closed': v},
                    success: function (json) {
                        var mb_yf = $('#goods_' + goods_id + ' .good-avator-wrap input[type="checkbox"]').length>0 ? '<input type="checkbox" value="'+goods_id+'" name="ids[]">':'';
                        if (json.code == 1) {
                            var successLabel = json.item.is_closed == 1 ? '上架' : '下架',
                                obj = $('#goods_' + goods_id + ' .cell4 .close-goods'),
                                _obj = $('#goods_' + goods_id + ' .cell1 img'),
                                html = mb_yf;
                            obj.attr('is_closed', json.item.is_closed);
                            obj.html(successLabel + '商品');
                            if (json.item.is_deleted == 1 || json.item.is_closed == 1) {
                                if (json.item.is_deleted == 1) {
                                    $('#goods_' + goods_id).remove();
                                } else {
                                    html += '<span class="good-avator">';
                                    html += '<img src="' + _obj.attr('src') + '" alt="' + _obj.attr('alt') + '">';
                                    html += '<i class="end-marsk">已下架</i>';
                                    html += '</span>';
                                }
                            } else {
                                html += '<a class="good-avator" target="_blank" title="' + _obj.attr('alt') + '" href="' + _obj.attr('url') + '" alt="' + _obj.attr('alt') + '">';
                                html += '<img src="' + _obj.attr('src') + '" alt="' + _obj.attr('alt') + '">';
                                html += '</a>';
                            }
                            $('#goods_' + goods_id + ' .good-avator-wrap').html(html);
                            $('#closeGoods').dialog("close");
                        }

                        location.reload(); // 页面刷新
                    }
                });
            }
        }, {
            text: '返回', //取消
            'class' : 'cancel-button',
            click: function () {
                $(this).dialog("close");
            }
        }]
    });
    $("#closeGoods .word").html('您确定要' + label + '此商品吗？');
    $("#closeGoods").dialog("open");
})

;
(function () {
    $('.refresh-goods').on('click', function () {
        var goods_id = $(this).attr('goods_id'),
            is_refreshed = $(this).attr('is_refreshed'),
            label = is_refreshed == 0 ? '已刷新' : '免费刷新',
            _this = $(this);
        if (is_refreshed == 1) return false;
        $.get('/ajax/goods-refresh', {'goods_id': goods_id}, function (json) {
            if (json.code == 1) {
                _this.text(label).attr('is_refreshed', 1).addClass('refreshed-goods');
                _this.parents('.table-item').find('.edit-date .time').text(json.item.dateline);
                $("#refresh").dialog({
                    autoOpen: false,
                    width: 456,
                    modal: true,
                    resizable: false,
                    dialogClass: "y-center-alert",
                    buttons: [{
                        text: '返回', //取消
                        click: function () {
                            $(this).dialog("close");
                        }
                    }]
                });
               // $("#refresh").dialog("open");
            } else {
                return jsError(json.msg);
            }
        })
    })
})();
$('.editGoodsPrice').on('click', function () {
    var goods_id = $(this).attr('goods_id');
    $("#editGoodsPrice").dialog({
        autoOpen: false,
        width: 456,
        title: '修改价格',
        dialogClass: "y-center-alert",
        buttons: [{
            text: '确认',
            click: function () {
                $.ajax({
                    url: ajax_url,
                    type: "get",
                    dataType: "json",
                    data: {'goods_id': goods_id, 'act': 'goods', 'op': 'drop'},
                    success: function (json) {
                        if (json.code == 1) {
                            var obj = $('#goods_' + goods_id + ' .row1 img');
                            var html = '<font>';
                            html += '<img src="' + obj.attr('src') + '" alt="' + obj.attr('alt') + '">';
                            html += '<i>已删除</i>';
                            html += '</font>';
                            $('#goods_' + goods_id + ' .row1').html(html);
                            $('#goods_' + goods_id + ' .close').remove();
                            $('#editGoodsPrice').dialog("close");
                        }
                    }
                });
            }
        }, {
            text: '取消 ',
            click: function () {
                $(this).dialog("close");
            }
        }]
    });
    $("#editGoodsPrice").dialog("open");
})

$(function () {
    $("#pushError").dialog({
        autoOpen: false,
        width: 436,
        height: "auto",
        modal: true,
        title: "错误提示",
        dialogClass: "y-center-alert-releaseofgoods",
        buttons: {
            '返回': function () { //返回
                $(this).dialog("close");
            }
        }
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
})


$('.push-goods').click(function () {
    var goods_id = $(this).attr('goods_id');
    $("#pushGoods").dialog({
        autoOpen: false,
        width: 456,
        title: '推送商品',
        dialogClass: "y-center-alert-releaseofgoods2",
        buttons: [{
            text: '确认',
            click: function () {
                var user_name = $('#user_name').val();
                if (!user_name) {
                    $("#pushError ._error").html('请输入用户名');
                    $("#pushGoods").dialog("close");
                    $("#pushError").dialog("open");
                    return false;
                }
                $.ajax({
                    url: '/ajax/goods-push',
                    type: "get",
                    dataType: "json",
                    data: {'goods_id': goods_id, 'user_name': user_name},
                    success: function (json) {
                        if (json.code == 1) {
                            $("#pushGoods").dialog("close");
                            $("#pushSuccess").dialog("open");
                        } else {
                            $("#pushError ._error").html(json.msg);
                            $("#pushGoods").dialog("close");
                            $("#pushError").dialog("open");
                        }
                    }
                });
                return false;
            }
        }, {
            text: '取消 ',
            click: function () {
                $(this).dialog("close");
            }
        }]
    });
    //获取商品
    $.ajax({
        url: '/ajax/goods-push-pre',
        type: "get",
        dataType: "json",
        data: {'goods_id': goods_id},
        success: function (json) {
            if (json.code == 1) {
                var goodsInfo = json.item;
                if (goodsInfo.is_closed == 1) {
                    $("#pushError ._error").html('请先将商品上架，才可推送商品。');
                    $("#pushError").dialog("open");
                } else if (goodsInfo.is_saled == 2) {
                    $("#pushError ._error").html('该商品已售出。');
                    $("#pushError").dialog("open");
                } else if (goodsInfo.is_deleted == 1) {
                    $("#pushError ._error").html('该商品已删除。');
                    $("#pushError").dialog("open");
                } else {
                    var html = '';
                    html += '<a href="' + goodsInfo.goods_url + '"><img src="' + goodsInfo.default_image + '" /></a>';
                    html += '<span>';
                    html += '<a href="' + goodsInfo.goods_url + '">' + goodsInfo.goods_name + '</a>';
                    html += '</span>';
                    html += '<font><i>' + goodsInfo.price + '</i>元</font>';
                    $("#pushGoods .box").html(html);
                    $("#pushGoods").dialog("open");
                }
            } else {
                $("#pushError ._error").html(json.msg?json.msg:'商品不存在');
                $("#pushError").dialog("open");
            }
        }
    });
})


$('.y-center-main-right #only_open,.y-center-main-right #only_close,.y-center-main-right #only_all').on('click',function () {
    var status = $(this).attr('data-id');
    url = window.location.pathname + window.location.search.toString().replace(/status=\d+/, 'status=' + status);
    window.location.href = url;
})
$('.y-center-main-right .table-header .filter_close :checkbox').click(function () {
    var status = 0;
    if ($(this).prop("checked") == true) {
        status = 1;
    }
    url = window.location.pathname + window.location.search.toString().replace(/status=\d+/, 'status=' + status);
    window.location.href = url;
})

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

$('.y-center-main-right').on('click','.all_checked :checkbox',function () {
    var self=$(this),
        i = 0 ,
        $infos =$('.y-center-main-right .table-item :checkbox,.y-center-main-right .all_checked :checkbox');
    $.each($infos, function (a, b) {
        b.checked =self[0].checked;
        if(b.checked ) i++;
    })
    btnClass(i);
});

$('.myGoods-table-box').on('click',':checkbox[name="ids[]"]',function () {
    var i=0,
        j = 0,
        $infos = $('.myGoods-table-box :checkbox[name="ids[]"]'),
        $self = $('.all_checked :checkbox');
    $.each($infos, function (a, b) {
        if(b.checked ) {
            i++;
        }else{
            j++;
        }
    })
    if(j>0) {
        $.each($self, function (a, b) {
            b.checked = false;
        })
    }
    btnClass(i);
});
var  btnClass = function(i) {
    if ( i > 0 ){
        $('.batch_open,.batch_close').removeClass('disabled-button');
    }else{
        $('.batch_open,.batch_close').addClass('disabled-button');
    }
}

$('.batch_close,.batch_open').click(function () {
    var ids = '',
        op= $(this).attr('data-id')==1?1:0;
    $('.myGoods-table-box .table-item :checkbox').each(function () {
        if ($(this).prop("checked") == true) {
            ids += $(this).val() + ',';
        }
    })
    if (ids) {
        ids = ids.substr(0, ids.lastIndexOf(','));
        $.post('/ajax/goods-batch-co',{'ids':ids,'op':op,'_csrf':csrf},function (json) {
            if(json.code ==1) {
                Store_Layer.alert({'content':'操作成功','callback':function(){window.location.reload()}});
           }else{
                Store_Layer.alert({'content':'操作失败'});
            }
        })
    }
})

function validateGoodsStatus(goods_id) {
    var res = $.ajax({
        url: '/ajax/goods-status',
        data: {'goods_id': goods_id},
        async: false
    }).responseText;
    res = eval("(" + res + ")");
    if (res.code == 0) {
        jsError(res.msg);
        return false;
    } else {
        return true;
    }
}

;(function () {
    $('.copy-goods').zclip({
        path: '/js/public/zclip/ZeroClipboard.swf',   //swf文件不能掉
        copy: function () {//复制内容
            return $(this).attr('data-url');
        },
        afterCopy: function () {//复制成功
            $(this).text('复制成功').addClass('disabled');
            $(this).siblings('.zclip').hide();
        }
    });
})()
// ;(function () {
//     var $infos = $('.myGoods-table-box :checkbox').not('[name="regular"]');
//     $.each($infos, function (a, b) {
//         b.checked  =false;
//     })
// })()

;(function(){ //  二维码消息打通-PC-V2.5
    $("#wechatDialog").dialog({
        autoOpen: false,
        modal: true,
        width: 600,
        dialogClass: "wechat-dialog",
        buttons: []
    });
    $('#showWechatLayer').on('click',function(){
        var scene_id = '15';
        $.ajax({
            dataType: 'json',
            url: '/ajax/we-chat-qrcode',
            data: {"scene_id":scene_id},
            success: function (data) {
                if (data.code == 1) {
                    $("#price_code").attr("src",data.item);
                }
            }
        });
        $("#wechatDialog").dialog("open");
    });
}())

;(function ($) {
    $('.ajax-audit').on('click',function () {
        var id = $(this).attr('data-id'),
            self = $(this),
            staObj = self.parents('.item-data').find('.auction-status');
        $.get('/ajax/audit',{'id':id},function(json){
            if  (json.code==1) {
                staObj.text(json.item.is_audit==0?'待审核':'撤销审核');
                self.text(json.item.is_audit==0?'撤销审核':'提交审核');
            }
        })
    })
})(jQuery)

var specificationObj = {
    config : {
        goodSummary : '.good-summary',
        priceWrap : '.price-wrap',
        specificationsBar : '.specifications-bar',
        goodSummary : $('.good-summary'),
        editButton : '.edit-button',
        deleteButton : '.delete-button',
        titleTextarea : $('.good-summary .title-textarea'),
        specificationsDialog : $("#specificationsDialog"),
        specificationsItems : $('#specificationsItems')
    },
    init : function () {
        var self = this;
        self.showSpecificationLayer();
        self.editTitle();
        self.fillTitle();
        self.showSpecificationsDialog();
        self.deleteSpecificationsItem();
    },
    'showSpecificationLayer' : function(){
        var self = this;
        $(self.config.priceWrap).on("mouseover mouseout",self.config.specificationsBar,function(event){
            if(event.type == "mouseover"){
                $(this).parents(self.config.priceWrap).addClass('hover');
            }else if(event.type == "mouseout"){
                $(this).parents(self.config.priceWrap).removeClass('hover');
            }
        })
    },
    'editTitle' : function(){
        var self = this;
        self.config.goodSummary.on('click',self.config.editButton,function(){
            var goodTitle = $(this).siblings('a'),
                images = $(this).siblings('img'),
                titleText = $.trim(goodTitle.text()),
                titleTextarea = $(this).siblings('.title-textarea');

            $(this).hide();
            $(this).siblings('.save-button').show();

            goodTitle.hide() && images.hide() && titleTextarea.show() && titleTextarea.val(titleText);
        });
    },
    'fillTitle' : function(){
        var self = this;
        $(self.config.goodSummary).on('click','.save-button',function(){
            var goodTitle = $(this).siblings('a'),
                images = $(this).siblings('img'),
                editButton = $(this).siblings('.edit-button'),
                titleText = $.trim($(this).siblings('textarea').val()),
                gid = $(this).parents('tr').attr('data-id'),
                editGoods =function(){
                    if(mb_strlen(titleText) < 8 || mb_strlen(titleText) > 60){
                        return FnApp.errorJs('标题只能包含4 - 30个字');
                    }else{
                        $.post('/ajax/goods-edit',{'gid':gid,'act':'edit','title':titleText,'_csrf':csrf},function(){})
                    }
                }

            titleText && goodTitle.text(titleText) && goodTitle.show() && images.show() && $(this).hide() && $(this).siblings('textarea').hide() && editButton.show() &&editGoods();
        });
    },
    'showSpecificationsDialog' : function(){
        var self = this;
        self.config.specificationsDialog.dialog({
            autoOpen: false,
            width: 450,
            dialogClass: 'no-header specifications-dialog',
            modal: true,
            resizable: false,
            buttons: [{
                text: '保存', //取消
                'class' : 'confirm-button',
                click: function () {
                    var sub = $('#subform').serialize(),
                        gid = $('#subform').attr('data-id'),
                        editGoods =function(){
                            var ids = self.config.specificationsDialog.find('input'),
                                idsinput = self.config.specificationsDialog.find('input.extm-price'),
                                err = 0;
                            $.each(ids, function () {
                                if ($(this).val() == '') {
                                    err = 1;
                                    return FnApp.errorJs('请完善规格信息');
                                }
                            })
                            if (err==0){
                                $.each(idsinput, function () {
                                    var value = $(this).val();
                                    if (isNaN(value) || value.indexOf('.') >= 0 || value < 1 || value > 999999){
                                        err = 1;
                                        return FnApp.errorJs('规格价格为1-999999间纯数字');
                                    }
                                })
                                err==0 && $.post('/ajax/goods-edit?act=sub',{'gid':gid,'sub':sub,'_csrf':csrf},function(){
                                    window.location.reload(true);
                                })
                            }
                        }
                    editGoods();
                }
            },{
                text: '返回', //取消
                'class' : 'cancel-button',
                click: function () {
                    $(this).dialog("close");
                }
            }]
        });

        $(self.config.priceWrap).on('click',self.config.editButton,function(){
            var html = '',
                gid = $(this).parents('tr').attr('data-id');
            $.post('/ajax/goods-edit?act=view',{'gid':gid,'_csrf':csrf},function (json) {
                $('#subform').attr('data-id',gid);
                if(json.code==1){
                    $.each(json.item.sub,function(k,sub){
                        html+='<li class="specifications-item clearfix"> <div class="cell-1"> <input type="text" name="sub[title]['+sub.id+']" value="'+sub.title+'"> </div> <div class="cell-2"> <input type="text"   name="sub[price]['+sub.id+']" value="'+parseInt(sub.price)+'" class="extm-price"> </div> <div class="cell-3"> <span class="delete-button">删除</span> </div> </li>';
                    })
                }
                $('#specificationsItems').html(html);
                html&&self.config.specificationsDialog.dialog('open');
            })
        });
        self.config.specificationsDialog.on('click','.closed',function(){
            self.config.specificationsDialog.dialog('close');
        });
    },
    'deleteSpecificationsItem' : function(){
        var self = this;
        self.config.specificationsItems.on('click',self.config.deleteButton,function(){
            $(this).parents('li').remove();
        });
    }
};

;(function(){
    specificationObj.init();
}())

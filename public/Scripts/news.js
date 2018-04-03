$('.message-content p').each(function () {
    $(this).click(function () {
        $(this).parent().find('.message-list .message-open').toggle();
        $(this).parent().siblings('.message-open').toggle();

        var _obj = $(this).parent().parent();
        var status = _obj.attr('is_read');
        if (status == 0) {
            ids = (_obj.find('input').val());
            if (ids) {
                if (_obj.attr('classType') == 'system') {
                    readNews(ids, false);
                } else {
                    readGlobalNews(ids, false);
                }
            }
        }
    });
});
$('#message-chb').click(function () {
    var $infos = $(".message-list :checkbox");
    $.each($infos, function (a, b) {
        b.checked = $("#message-chb")[0].checked;
    })
});
$('#qa-chb').click(function () {
    var $infos = $(".y-center-messageCenter-list :checkbox");
    $.each($infos, function (a, b) {
        b.checked = $("#qa-chb")[0].checked;
    })
})
$('#qa-del').click(function () {
    var ids = '';
    $('.y-center-messageCenter-list :checkbox').each(function () {
        if ($(this).prop("checked") == true) {
            ids += $(this).val() + ',';
        }
    })
    if (ids) {
        ids = ids.substr(0, ids.lastIndexOf(','));
        dltQa(ids);
    }
})
$('#qa-read').click(function () {
    var ids = '';
    $('.y-center-messageCenter-list :checkbox').each(function () {
        if ($(this).prop("checked") == true) {
            ids += $(this).val() + ',';
        }
    })
    if (ids) {
        ids = ids.substr(0, ids.lastIndexOf(','));
        readQa(ids);
    }
})
$('#message-del').click(function () {
    var ids = '';
    var nodel = false;
    $('.message-list :checkbox').each(function () {
        if ($(this).prop("checked") == true) {
            if ($('#news_' + $(this).val()).attr('is_read') == 0) {
                nodel = true;
            }
            ids += $(this).val() + ',';
        }
    })
    if (nodel) {
        //return jsError("未读消息不能删除");
        //return false;
    }
    if (ids) {
        ids = ids.substr(0, ids.lastIndexOf(','));
        dltNews(ids);
    }
})

$('#message-global-del').click(function () {
    var ids = '';
    var nodel = false;
    $('.message-list :checkbox').each(function () {
        if ($(this).prop("checked") == true) {
            if ($('#news_' + $(this).val()).attr('is_read') == 0) {
                nodel = true;
            }
            ids += $(this).val() + ',';
        }
    })
    if (nodel) {
        //return jsError("未读消息不能删除");
        //return false;
    }
    if (ids) {
        ids = ids.substr(0, ids.lastIndexOf(','));
        dltGlobalNews(ids);
    }
})


$('.del').click(function () {
    var ids = '';
    var status = $(this).parent().parent().attr('isdel');
    if (status == 0) {
        ids = $(this).parent().parent().attr('news_id');
        dltNews(ids);
    }
})

$('.del-global').click(function () {
    var ids = '';
    var status = $(this).parent().parent().attr('isdel');
    if (status == 0) {
        ids = $(this).parent().parent().attr('news_id');
        dltGlobalNews(ids);
    }
})
$('.dlt').click(function () {
    var ids = $(this).attr('news_id');
    dltQa(ids);
})
function dltQa(ids) {
    if (ids) {
        $("#dltNews").dialog({
            autoOpen: false,
            width: 456,
            title: '删除',
            dialogClass: "y-center-alert",
            buttons: [{
                text: '确认',
                click: function () {
                    $.ajax({
                        url: '/ajax/qa-batch-drop',
                        type: "post",
                        dataType: "json",
                        data: {'ids': ids, '_csrf': csrf},
                        success: function (json) {
                            if (json.code == 1) {
                                window.location.reload();
                                /*
                                 $(json.item.ids).each(function(k,v){
                                 $('#news_'+v).remove();
                                 })
                                 $('#dltNews').dialog("close");
                                 */
                            }
                        }
                    });
                }
            }, {
                text: '返回', //取消
                click: function () {
                    $(this).dialog("close");
                }
            }]
        });
        $("#dltNews").dialog("open");
    }
}
function readQa(ids) {
    if (ids) {
        $("#readNews").dialog({
            autoOpen: false,
            width: 456,
            title: '标为已读',
            dialogClass: "y-center-alert",
            buttons: [{
                text: '确认',
                click: function () {
                    $.ajax({
                        url: '/ajax/qa-batch-read',
                        type: "post",
                        dataType: "json",
                        data: {'ids': ids, '_csrf': csrf},
                        success: function (json) {
                            if (json.code == 1) {
                                window.location.reload();
                            }
                        }
                    });
                }
            }, {
                text: '返回', //取消
                click: function () {
                    $(this).dialog("close");
                }
            }]
        });
        $("#readNews").dialog("open");
    }
}
function dltGlobalNews(ids) {
    if (ids) {
        $("#dltNews").dialog({
            autoOpen: false,
            width: 456,
            title: '删除',
            dialogClass: "y-center-alert",
            buttons: [{
                text: '确认',
                click: function () {
                    $.ajax({
                        url: ajaxGoodUrl,
                        type: "post",
                        dataType: "json",
                        data: {'ids': ids, 'act': 'globalNews', 'op': 'drop', '_csrf': csrf},
                        success: function (json) {
                            if (json.code == 1) {
                                window.location.reload();
                                /*
                                 $(json.item.ids).each(function(k,v){

                                 $('#news_'+v).remove();
                                 })
                                 $('#dltNews').dialog("close");
                                 */
                            }
                        }
                    });
                }
            }, {
                text: '返回', //取消
                click: function () {
                    $(this).dialog("close");
                }
            }]
        });
        $("#dltNews").dialog("open");
    }
}
function dltNews(ids) {
    if (ids) {
        $("#dltNews").dialog({
            autoOpen: false,
            width: 456,
            title: '删除',
            dialogClass: "y-center-alert",
            buttons: [{
                text: '确认',
                click: function () {
                    $.ajax({
                        url: '/ajax/news-system-drop',
                        type: "post",
                        dataType: "json",
                        data: {'ids': ids, '_csrf': csrf},
                        success: function (json) {
                            if (json.code == 1) {
                                window.location.reload();
                                /*
                                 $(json.item.ids).each(function(k,v){

                                 $('#news_'+v).remove();
                                 })
                                 $('#dltNews').dialog("close");
                                 */
                            }
                        }
                    });
                }
            }, {
                text: '返回', //取消
                click: function () {
                    $(this).dialog("close");
                }
            }]
        });
        $("#dltNews").dialog("open");
    }
}
$('#message-read').click(function () {
    var ids = '';
    var hasid = false;
    $('.message-list :checkbox').each(function () {
        if ($(this).prop("checked") == true) {
            if ($('#news_' + $(this).val()).attr('is_read') == 0) {
                ids += $(this).val() + ',';
            } else {
                $(this).attr('checked', false);
                hasid = true;
            }
        }
    })
    if (hasid) {
        return jsError('存在已经读过的消息');
    }
    if (ids) {
        ids = ids.substr(0, ids.lastIndexOf(','));
        readNews(ids, true);
    }
})
$('#message-global-read').click(function () {
    var ids = '';
    var hasid = false;
    $('.message-list :checkbox').each(function () {
        if ($(this).prop("checked") == true) {
            if ($('#news_' + $(this).val()).attr('is_read') == 0) {
                ids += $(this).val() + ',';
            } else {
                $(this).attr('checked', false);
                hasid = true;
            }
        }
    })
    if (hasid) {
        return jsError('存在已经读过的消息');
    }
    if (ids) {
        ids = ids.substr(0, ids.lastIndexOf(','));
        readGlobalNews(ids, true);
    }
})
function readNews(ids, tip) {
    if (ids) {
        if (tip) {
            $("#readNews").dialog({
                autoOpen: false,
                width: 456,
                title: '标为已读',
                dialogClass: "y-center-alert",
                buttons: [{
                    text: '确认',
                    click: function () {
                        $.ajax({
                            url: '/ajax/news-system-read',
                            type: "post",
                            dataType: "json",
                            data: {'ids': ids, '_csrf': csrf},
                            success: function (json) {
                                if (json.code == 1) {
                                    $(json.item.ids).each(function (k, v) {
                                        $('#news_' + v).addClass('readed').attr('is_read', 1);
                                    })
                                    $('#readNews').dialog("close");
                                }
                            }
                        });
                    }
                }, {
                    text: '返回', //取消
                    click: function () {
                        $(this).dialog("close");
                    }
                }]
            });
            $("#readNews").dialog("open");
        } else {
            $.ajax({
                url: '/ajax/news-system-read',
                type: "post",
                dataType: "json",
                data: {'ids': ids, '_csrf': csrf},
                success: function (json) {
                    if (json.code == 1) {
                        $(json.item.ids).each(function (k, v) {
                            $('#news_' + v).addClass('readed').attr('is_read', 1);
                        })
                        //$('#readNews').dialog("close");
                    }
                }
            });
        }
    }
}

function readGlobalNews(ids, tip) {
    if (ids) {
        if (tip) {
            $("#readNews").dialog({
                autoOpen: false,
                width: 456,
                title: '标为已读',
                dialogClass: "y-center-alert",
                buttons: [{
                    text: '确认',
                    click: function () {
                        $.ajax({
                            url: ajaxGoodUrl,
                            type: "post",
                            dataType: "json",
                            data: {'ids': ids, 'act': 'globalNews', 'op': 'read', '_csrf': csrf},
                            success: function (json) {
                                if (json.code == 1) {
                                    $(json.item.ids).each(function (k, v) {
                                        $('#news_' + v).addClass('readed').attr('is_read', 1);
                                    })
                                    $('#readNews').dialog("close");
                                }
                            }
                        });
                    }
                }, {
                    text: '返回', //取消
                    click: function () {
                        $(this).dialog("close");
                    }
                }]
            });
            $("#readNews").dialog("open");
        } else {
            $.ajax({
                url: ajaxGoodUrl,
                type: "post",
                dataType: "json",
                data: {'ids': ids, 'act': 'globalNews', 'op': 'read', '_csrf': csrf},
                success: function (json) {
                    if (json.code == 1) {
                        $(json.item.ids).each(function (k, v) {
                            $('#news_' + v).addClass('readed').attr('is_read', 1);
                        })
                        //$('#readNews').dialog("close");
                    }
                }
            });
        }
    }
}


$('.quickReply').click(function () {
    var goods_id = $(this).attr('goods_id');
    var id = $(this).attr('qa_id');
    $("#replayNews").dialog({
        autoOpen: false,
        width: 480,
        title: '回复',
        //dialogClass: "y-center-fastback",
        buttons: [{
            text: '确认',
            click: function () {
                var reply_content = $('#replycontent').val();
                if (mb_strlen(reply_content) >= 140 * 3) {
                    return jsError('不能超过140个字');
                }
                if (!reply_content) {
                    return jsError('请输入回复内容');
                }
                $.ajax({
                    url: '/ajax/qa-reply',
                    type: "post",
                    dataType: "json",
                    data: {'_csrf': csrf, 'goods_id': goods_id, 'id': id, 'message': reply_content},
                    success: function (json) {
                        if (json.code == 1) {
                            window.location.reload();
                        }
                    }
                });
            }
        }, {
            text: '返回', //取消
            click: function () {
                $(this).dialog("close");
            }
        }]
    });
    $("#replayNews span").html($(this).parent().parent().parent().find('.content').find('.openBox').text());
    $("#replayNews").dialog("open");
})

;
(function () {
    var ycml = $('.y-center-messageCenter-list'),
        numObj = $('.y-center-buy-top').find('.active span');
    ycml.on('click', '.see-detail', function () {
        var pr = $(this).parents('.y-center-messageCenter-list'),
            num = parseInt(numObj.text()) - 1 > 0 ? parseInt(numObj.text()) - 1 : 0;
        if (pr.hasClass('readed')) {
            pr.removeClass('readed').addClass('read');
            numObj.text(num);
        }
    });
})()
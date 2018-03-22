$('.close').click(function () {
    var view_id = $(this).attr('view_id');
    $("#dltGoods").dialog({
        autoOpen: false,
        width: 456,
        title: '删除',
        dialogClass: "y-center-alert",
        buttons: [{
            text: '确认',
            click: function () {
                $.get('/ajax/goods-history-drop',{'view_id': view_id},function(json){
                    json.code==1 &&  $('#view_' + view_id).remove() && $('#dltGoods').dialog("close");
                })
            }
        }, {
            text: '返回',
            click: function () {
                $(this).dialog("close");
            }
        }]
    });
    $("#dltGoods").dialog("open");
})
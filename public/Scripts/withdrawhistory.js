$('.operation-link').click(function () {
    var _this = $(this);
    var id = $(this).attr('dw_id');
    if (!id)  return false;
    $.ajax({
        url: '/ajax/withdraw-cancel',
        type: "post",
        dataType: "json",
        data: {'id': id},
        success: function (json) {
            if (json.code == 1) {
                _this.parent().parent().parent().find('.table-cell7').html('<span  style="color:#999;"> 已取消</span>');
                _this.parent().remove();
            }
        }
    });
})
$('.search a').click(function () {
    var minMoney = $('#minMoney').val();
    var maxMoney = $('#minMoney').val();
    if (minMoney > 0 && maxMoney > 0 && minMoney > maxMoney) {
        return false;
    }
    document.getElementById('form').submit();
})
$('.download').click(function () {
    var minMoney = $('#minMoney').val();
    var maxMoney = $('#minMoney').val();
    if (minMoney > 0 && maxMoney > 0 && minMoney > maxMoney) {
        return false;
    }
    var startTime = $('#startTime').val();
    var endTime = $('#endTime').val();
    var url = '/user/withdrawHistory?startTime=' + startTime + '&endTime=' + endTime + '&minMoney=' + minMoney + '&maxMoney=' + maxMoney + '&r=&dwn=1';
    window.open(url);
})




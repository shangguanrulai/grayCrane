/**
 * @Description: the script 二手交易一口价
 * @authors: hanjw (han.jingwei@fengniao.com)
 * @date：    2015-10-26 18:32:24
 * @version： 1.0
 */
$.ajaxSetup({cache: false});
var DPT = {
    initAct:function (d) {
        console.log(d.actId);
        var customtCycle = $('#customtCycle'),
            selectCc =$("#customtCycle option:last"),
            startingPrice =$('#startingPrice'),
            shootPrice=$('#shootPrice'),
            goodsauctionPrice=$('#goodsauction-price'),
            defaultRule = $('.default-rule'),
            activeId = $('#active_id'),
            doAct =function () {
                startingPrice.val(1).attr("disabled", true);
                customtCycle.attr("disabled", true);
                selectCc.prop("selected", 'selected');
                shootPrice.attr("disabled", true);
                goodsauctionPrice.attr("disabled", true);
                defaultRule.attr("disabled", true);
                activeId.val(d.actId);

            },
            resetAct =function () {
                startingPrice.attr("disabled", false);
                customtCycle.attr("disabled", false);
                shootPrice.attr("disabled", false);
                goodsauctionPrice.attr("disabled", false);
                defaultRule.attr("disabled", false);
                activeId.val(d.actId);


            };

        // console.log(d);
        // console.log( $('#dpTime')) ;
        d.actId>0 ? doAct() :resetAct();


    }
}
$(document).ready(function () {
    $('#active_id').on('change',function () {
        alert(3);
    })
});


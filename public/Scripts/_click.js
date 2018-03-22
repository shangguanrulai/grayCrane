$('.shop-summary').on('click','.collect-button',function () {
    _hmt.push(['_trackEvent', '2_fengniao', 'secforum', 'store_header_collect', '']);
}).on('click','.connect-button',function () {
    _hmt.push(['_trackEvent', '2_fengniao', 'secforum', 'store_header_connect', '']);
}).on('click','.shop-name',function () {
    _hmt.push(['_trackEvent', '2_fengniao', 'secforum', 'store_header_shopname', '']);
}).on('click','.go_store',function () {
    _hmt.push(['_trackEvent', '2_fengniao', 'secforum', 'store_header_gostore','']);
}).on('click','.edit_store',function () {
    _hmt.push(['_trackEvent', '2_fengniao', 'secforum', 'store_header_editstore','']);
})

$('.shop-info-section').on('click','.sendPrivateLetterBtn',function () {
    _hmt.push(['_trackEvent', '2_fengniao', 'secforum', 'store_left_connect', '']);
}).on('click','.collect-button',function () {
    _hmt.push(['_trackEvent', '2_fengniao', 'secforum', 'store_left_collect','']);
}).on('click','.come-button',function () {
    _hmt.push(['_trackEvent', '2_fengniao', 'secforum', 'store_left_gostore','']);
}).on('click','.shop_name',function () {
    _hmt.push(['_trackEvent', '2_fengniao', 'secforum', 'store_left_shopname','']);
})
$('.promotion-goods-section').on('click','a',function () {
    _hmt.push(['_trackEvent', '2_fengniao', 'secforum', 'store_left_rec','']);
})

$('.detail-box').on('click','.sendPrivateLetterBtn',function () {
    _hmt.push(['_trackEvent', '2_fengniao', 'secforum', 'store_detail_connect', '']);
}).on('click','.telephone-tag',function () {
    _hmt.push(['_trackEvent', '2_fengniao', 'secforum', 'store_detail_phone', '']);
}).on('click','.buy-button',function () {
    _hmt.push(['_trackEvent', '2_fengniao', 'secforum', 'store_header_buy', '']);
})

$('.J_switchTab').on('click','li[rel="goodsSwitchPanel1"]',function () {
    _hmt.push(['_trackEvent', '2_fengniao', 'secforum', 'store_detail_desc', '']);
}).on('click','li[rel="goodsSwitchPanel2"]',function () {
    _hmt.push(['_trackEvent', '2_fengniao', 'secforum', 'store_detail_service', '']);
}).on('click','li[rel="goodsSwitchPanel3"]',function () {
    _hmt.push(['_trackEvent', '2_fengniao', 'secforum', 'store_detail_qa', '']);
})

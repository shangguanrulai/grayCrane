@include('home.common.index_header');

<script type="text/javascript" src="/Scripts/address.js"></script>
<link href="/Content/secondarytradingrelease.css" rel="stylesheet" 0="frontend\assets\BaseAsset">

<div class="wrapper">
    <div class="goodsRelease-switch">
        <ul class="switch-nav clearfix">
            <li index='0' class="current-item">
                <a href="">发布商品</a>
            </li>
        </ul>
<div class="switch-panel clearfix">
<!-- goods-form -->
<div class="goods-form">

<form id="goods-form" class="form-horizontal" action="/goods/add?_confirm=1&amp;type=0&amp;goods_id=0&amp;cate_id=114&amp;subcate_id=1049&amp;brand_id=0&amp;model_id=0" method="post">
   <div class="type-item clearfix">
        <span  style="display: none;" class="error"> </span>
        <div class="form-group field-goods-brand_name">
            <label class="control-label" for="goods-brand_name"><i class="star">*</i>分类</label>
            <div class="input-wrap">
                <input type="text" id="goods-brand_name" class="form-control" name="Goods[brand_name]" placeholder="请选择分类">
                <span class="arrow-wrap"><i class="arrow-icon"></i></span>
            </div>
        </div>
       <div class="form-group field-goods-model_name">
            <div class="input-wrap">
                <input type="text" id="goods-model_name" class="form-control" name="Goods[model_name]" placeholder="请选择详细分类">
                <span class="arrow-wrap"><i class="arrow-icon"></i></span>
            </div>
       </div>
   </div>

    <div class="goods-title clearfix">
        <div class="form-group field-goods-goods_name required">
            <span style="display: none" class="error"></span><label class="control-label" for="goods-goods_name"><i class="star">*</i>商品名</label>
            <div class="input-wrap"><input type="text" id="goods-goods_name" class="form-control" name="Goods[goods_name]" placeholder="请填写商品名"></div>
        </div>
    </div>
    <div class="price-item clearfix">
        <div class="form-group field-goods-price">
        <span style="display: none;" class="error"></span><label class="control-label" for="goods-price">价格</label><div class="input-wrap"><input type="text" id="goods-price" class="form-control" name="Goods[price]"><em class="unit">元</em><span class="price-tip"  style="display: ;"></span></div>
        </div>
        <div class="form-group field-goods-price">
            <span style="display: none;" class="error"></span><label class="control-label" for="goods-price">新品参考</label><div class="input-wrap"><input type="text" id="goods-price" class="form-control" name="Goods[price]"><em class="unit">元</em><span class="price-tip"  style="display: ;"></span></div>
        </div>
    </div>

        <div class="address-box clearfix">
             <div class="form-group field-goods-province_id required">
                <label class="control-label" for="goods-province_id">所在城市</label>
                <div class="input-wrap">
                    <select id="cmbProvince" name="1"></select>
                </div>
            </div>
            <div class="form-group field-goods-province_id required">
                <div class="input-wrap">
                    <select id="cmbCity" name="2"></select>
                </div>
            </div>
            <div class="form-group field-goods-province_id required">
                <div class="input-wrap">
                    <select id="cmbArea" name="3"></select>
                </div>
            </div>
        </div>

    <div class="mobile-box clearfix" id="use_phone_mob"   >
	<div class="certified-box">
		<div class="form-group field-goods-phone_mob required">
            <span style="display: none;" class="error"></span>
            <label class="control-label" for="goods-phone_mob">手机号</label>
            <div class="input-wrap">
                <input type="text" id="goods-phone_mob" class="form-control" name="Goods[phone_mob]" value="" readonly="true" maxlength="11">
                <div class="check-box">
                    <label class="checklabel">
                        <input id="use_default_phone" name="user_default_phone" value="1" type="checkbox" checked>使用绑定手机
                    </label>
                </div>
            </div>
        </div>
	</div>
    </div>

    <div id="upload-pictures" class="upload-pictures clearfix">
	<label class="control-label"><i class="star"></i>上传图片</label>
        <input type="file" style="padding-top: 15px;height: 45px;">
    </div>


    <div class="description-box clearfix">
        <div class="form-group field-goods-goods_desc required">
            <label class="control-label" for="goods-goods_desc"><i class="star"></i>详情描述</label>
            <div class="description-textarea">
                <textarea id="goods-goods_desc" class="form-control" name="Goods[goods_desc]">
1.型号要求：暂无信息
2.到手时间/使用时长：暂无信息
3.成色描述：暂无信息
4.器材情况：暂无信息
5.包含配件：暂无信息
6.其他说明：暂无信息
                </textarea>
            </div>
        </div>
    </div>
    <input type="button" class="btn btn-primary submit-button" value="发布">

</form>
</div>
    <!-- //goods-form -->
    <!-- mobileDialog -->
                <div id="mobileDialog" class="mobile-dialog" title="安全信息设置" style="display: none;">
    <div class="setting-box" id="step1">
        <form id="step1Form" method="get" action="">
            <ul class="settingSteps clearfix">
                <li class="current">1.手机绑定</li>
                <li>2.设置交易密码</li>
                <li>3.完成</li>
            </ul>
            <div class="setting-form">
                <div class="form-group clearfix  required">
                    <label for="tel" class="control-label">请输入您的手机号：</label>
                    <div class="input-wrap">
                        <input type="text" maxlength="11" value="" name="phone_mob"
                               class="form-control" id="phone_mob" placeholder="请输入您的手机号">
                    </div>
                    <p class="help-block help-block-error" id="ajax_error"></p>
                </div>
                <div class="buttons">
                    <button id="yzm" class="send-button" type="button">获取手机验证码</button>
                    <input type="text" id="auth_code" placeholder="输入手机验证码">
                </div>
            </div>
            <input type="button" class="next-button" id="auth_code_btn"
                   value="下一步">
        </form>
    </div>


    <div class="setting-box" id="step2" style="display: none;">
        <form id="step2Form" method="get" action="">
            <ul class="settingSteps clearfix">
                <li class="current">1.手机绑定</li>
                <li class="current">2.设置交易密码</li>
                <li>3.完成</li>
            </ul>
            <div class="setting-form">

                <div class="form-group clearfix  required">
                    <label for="tel" class="control-label">请设置交易密码：</label>
                    <div class="input-wrap">
                        <input type="password" value="" name="passwd1"
                               class="form-control" id="passwd1" placeholder="">
                    </div>
                    <p class="help-block" id="step2error">由字母加数字或符号至少两种以上字符组成的6-20位半角字符，区分大小写</p>
                </div>
                <div class="form-group clearfix  required">
                    <label for="tel" class="control-label">再次确认交易密码：</label>
                    <div class="input-wrap">
                        <input type="password" value="" name="passwd2"
                               class="form-control" id="passwd2" placeholder="">
                    </div>
                </div>

            </div>
            <input type="button" class="next-button" value="提交完成">
        </form>
    </div>
</div>

                <!-- //mobileDialog -->
</div>
    <div class="aside" style="position: absolute;top:285px;right: 23px;">
	<ul id="accordion" class="step-items">
		<li class="step-item">
			<h3 class="step-title">
				<em>1</em>完善基本信息
			</h3>
		</li>
		<li class="step-item">
			<h3 class="step-title">
				<em>2</em>上图上真相
			</h3>
		</li>
		<li class="step-item">
			<h3 class="step-title">
				<em>3</em>详情描述
			</h3>
		</li>
	</ul>
    </div>
</div>




{{--<script type="text/javascript">
    //初始化数据
    var jsonstr = '{"114":"\u6570\u7801\u76f8\u673a","118":"\u955c\u5934","112":"\u6444\u50cf\u673a - \u89c6\u9891\u8bbe\u5907","115":"\u80f6\u7247\u76f8\u673a\u53ca\u5468\u8fb9","116":"\u9644\u4ef6","117":"\u5176\u4ed6\u8bbe\u5907"}',
        qualityArr = '{"1":{"quality_id":"1","title":"\u5168\u65b0","num":"100","desc":"\u662f\u6307\u672a\u5f00\u5c01\u4f7f\u7528\u8fc7\u7684\u65b0\u54c1\u3002","add_time":"0"},"2":{"quality_id":"2","title":"99\u65b0","num":"99","desc":"\u662f\u6307\u4ec5\u5f00\u5c01\uff0c\u4f46\u672a\u4f7f\u7528\u6216\u4ec5\u4ec5\u7ecf\u8fc7\u8bd5\u7528\uff0c\u5916\u89c2\u65e0\u4efb\u4f55\u4f7f\u7528\u75d5\u8ff9\u7684\u8d27\u54c1\u3002","add_time":"0"},"3":{"quality_id":"3","title":"98\u65b0","num":"98","desc":"\u662f\u6307\u4f7f\u7528\u6b21\u6570\u5f88\u5c11\uff0c\u5916\u89c2\u9664\u5361\u53e3\u3001\u89e6\u70b9\u7b49\u7279\u6b8a\u4f4d\u7f6e\u5916\uff0c\u5176\u4ed6\u4e3b\u4f53\u90e8\u5206\u65e0\u4efb\u4f55\u4f7f\u7528\u75d5\u8ff9\u7684\u8d27\u54c1\u3002","add_time":"0"},"4":{"quality_id":"4","title":"95\u65b0","num":"95","desc":"\u6307\u4f7f\u7528\u8fc7\uff0c\u4f46\u6210\u8272\u5f88\u65b0\uff0c\u5916\u89c2\u65e0\u6389\u6f06\u5212\u75d5\uff0c\u4ec5\u4ec5\u5141\u8bb8\u6709\u8f7b\u5fae\u4f7f\u7528\u75d5\u8ff9\uff08\u5982\u8f7b\u5fae\u6cb9\u5149\uff09\u7684\u8d27\u54c1\u3002","add_time":"0"},"5":{"quality_id":"5","title":"90\u65b0","num":"90","desc":"\u662f\u6307\u5916\u8868\u6709\u5c11\u8bb8\u4f7f\u7528\u75d5\u8ff9\uff08\u5212\u75d5\u6216\u6cb9\u5149\uff09\uff0c\u4f46\u65e0\u78d5\u78b0\u6389\u6f06\u4e14\u529f\u80fd\u6b63\u5e38\u5b8c\u597d\u7684\u8d27\u54c1\u3002","add_time":"0"},"6":{"quality_id":"6","title":"80\u65b0\u53ca\u4ee5\u4e0b","num":"80","desc":"\u662f\u6307\u5916\u89c2\u6709\u78e8\u635f\u5212\u75d5\u6216\u6389\u6f06\uff0c\u660e\u663e\u7684\u4f7f\u7528\u75d5\u8ff9\uff0c\u4f46\u529f\u80fd\u6b63\u5e38\u5b8c\u597d\u7684\u8d27\u54c1\u3002","add_time":"0"},"7":{"quality_id":"7","title":"\u7f3a\u9677\u54c1","num":"2","desc":"\u662f\u6307\u5916\u89c2\u6709\u635f\u574f\u6216\u5b58\u5728\u90e8\u5206\u529f\u80fd\u7f3a\u9677\uff0c\u4f46\u4e3b\u8981\u529f\u80fd\u8fd8\u80fd\u4f7f\u7528\u7684\u8d27\u54c1\u3002","add_time":"0"},"8":{"quality_id":"8","title":"\u62a5\u5e9f\u54c1","num":"1","desc":"\u662f\u6307\u4e3b\u8981\u529f\u80fd\u95ee\u9898\uff0c\u5df2\u65e0\u6cd5\u6b63\u5e38\u4f7f\u7528\u7684\u8d27\u54c1\u3002","add_time":"0"}}',
        actArr = 'null',
        ajax_url = "/goods/ajax",  //通用ajax url
        upload_url = "/upload/goods",  //上传 url
        limit =20,
        goods = {"goods_id":0,"cate_id":114,"subcate_id":1049,"brand_id":0,"model_id":"0","type":0,"user_id":null,"province_id":0,"city_id":0,"quality":100,"status":0,"edit":false},
        user_id = '10820479',
        masterGoodsStatus =  0 ,
        brandSource =  '[{"label":"\u5965\u6797\u5df4\u65af(Olympus)","value":184},{"label":"\u5bbe\u5f97(Pentax)","value":1061},{"label":"\u5bcc\u58eb(Fujifilm)","value":752},{"label":"\u4f73\u80fd(Canon)","value":232},{"label":"\u67ef\u8fbe(Kodak)","value":139},{"label":"\u67ef\u5c3c\u5361\u7f8e\u80fd\u8fbe(Konicaminolta)","value":634},{"label":"\u5c3c\u5eb7(Nikon)","value":657},{"label":"\u9002\u9a6c(Sigma)","value":1799},{"label":"\u677e\u4e0b(Panasonic)","value":84},{"label":"\u7d22\u5c3c(Sony)","value":167},{"label":"\u5eb7\u6cf0\u65f6(Contax)","value":37470},{"label":"\u7f8e\u80fd\u8fbe(Minolta)","value":37471},{"label":"\u5176\u4ed6","value":37469},{"label":"\u4e09\u661f(Samsung)","value":98}]',
        secUe =null,
        modelSource =  'null',
//        userMoney = //,
        enAdd =function(){
            var res =
                $.ajax({
                    url: "/ajax/user-money",  //url
                    async: false,
                    dataType: 'json'
                }).responseText;
            res = eval("(" + res + ")");
            if(res.code==0){
                var brDio =$( "#balanceRecoveryDialog" );
                brDio.find('p').html('当前账户余额:'+res.money+'元,您至少需要充值'+res.needMoney+'元');
                brDio.dialog({
                    modal: true,
                    title: "系统提示",
                    width:460,
                    close:function () {
                        window.location.href="/goods/index?type=2" ;
                    },
                    buttons: [
                        {
                            text: "立即充值",
                            'class': "confirm-button",
                            click: function() {
                                window.location.href="/user/recharge?order_type=1" ;
                            }
                        },{
                            text: "取消",
                            'class': "cancel-button",
                            click: function() {
                                window.location.href="/goods/index?type=2" ;
                            },
                        }
                    ]
                });
            }
        };
    qualityArr = eval("(" + qualityArr + ")");
    brandSource = eval("(" + brandSource + ")"),
    modelSource = eval("(" + modelSource + ")");
    jsonstr = eval("(" + jsonstr + ")");

    $(function() {
        $( "#goods_image" ).sortable();
        $( "#goods_image" ).disableSelection();
        goods.type ==2 && enAdd();
    });
</script>--}}
<script type="text/javascript">
    addressInit('cmbProvince', 'cmbCity', 'cmbArea');
</script>

<!-- foot -->
@include('home.common.index_footer');
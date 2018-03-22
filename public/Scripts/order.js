/** 
 * @Description: the script 二手交易 订单页 
 * @authors: hanjw (han.jingwei@fengniao.com)
 * @date：    2015-11-16 10:18:56
 * @version： 1.0
 */
 //底部吸底
function fixedFooterFn(){
	if($('body').height() < ($(window).height() - $('.top-bar').height())){
	 	$('div.foot').addClass('fixed-footer');
	}else{
	 	$('div.foot').removeClass('fixed-footer');
	}
 } 
fixedFooterFn();
$(window).on('resize', fixedFooterFn);
 
//联系人区域js
(function addressAreaFn(){ 
	//展开更多联系人地址
	function tidyUnfoldAddressButton()
	{
		addressItemHeight = $('#addressList .address-item').outerHeight(true),
		addressItemLength = $('#addressList .address-item').length;

		if(addressItemLength > 2){
			$('#addressBox').find('.expansion-button').show();
			$('#addressBox').unbind( 'click' );
			$('#addressBox').on('click','.expansion-button',function(){
				var addressItemLength = $('#addressList .address-item').length;

				if($(this).hasClass('unexpansion-button')){
					$(this).removeClass('unexpansion-button');
					$(this).find('em').text('\u66f4\u591a\u5730\u5740'); //更多地址
					$(this).siblings('#addressList').css('height',80);
				}else{
					$(this).addClass('unexpansion-button');
					$(this).find('em').text('\u6536\u8d77\u5730\u5740'); //收起地址
					$(this).siblings('#addressList').css('height',addressItemLength * addressItemHeight);
				}
			});
		}else if(addressItemLength == 0){
			addressItemHeight = 40;
			$('#addressBox').find('.expansion-button').hide();
		}else{
			$('#addressBox').find('.expansion-button').hide();
			$(this).siblings('#addressList').css('height',addressItemLength * addressItemHeight);
		}
	}

	tidyUnfoldAddressButton();

	//鼠标滑过显示操作按钮 
	$('#addressList').on({
		'mouseenter' : function(){
			$(this).find('.option-box').show(); 
		},
		'mouseleave' : function(){
			$(this).find('.option-box').hide();
		}
	},'.address-item');
	
	//添加收货人地址弹层
	$("#addressAddDialog").dialog({
		autoOpen: false, 
		width: 670,
		//height: 400, 
		modal: true,
		title: '\u65b0\u589e\u6536\u8d27\u4eba\u4fe1\u606f', //新增收货人信息
		buttons: [{
			text: '\u4fdd\u5b58\u6536\u8d27\u4eba\u4fe1\u606f', //保存收货人信息
			'class': 'save-button confirm-button',
			click: function() {				
				var addCheckRe = checkAddressJs( 'add' );
				
				if( !addCheckRe )
				{
					return;
				}
				
				var add_box = this;
				//保存按钮设置为不可用
				$(add_box).parent().find(':button').eq(1).attr( 'disabled', true );
				
				var provinceId = $('#province').val();
				var provinceName = $('#province option[value='+provinceId+']').html();
				var cityId = $('#city').val();
				var cityName = $('#city option[value='+cityId+']').html();
				
				var consignee = $('#consignee').val();//收货人
				var address = $('#address').val();//收货地址
				var phone_tel = $('#phone_tel').val();//固定电话
				var phone_mob = $('#phone_mob').val();//固定电话
				var zipcode = $('#zipcode').val();//固定电话
				
				$.ajax({
					dataType:'json',
			        url: ajax_url,
			        cache:false,
			        data:{	"act":'addAddress',
				        	'provinceId':provinceId,
				        	'provinceName':provinceName,
				        	'cityId':cityId,
				        	'cityName':cityName,
				        	'consignee':consignee,
				        	'address':address,
				        	'phone_tel':phone_tel,
				        	'phone_mob':phone_mob,
				        	'zipcode':zipcode
			        	},
			        success: function(data){
			        	if(data.flag == 1)
			        	{	
			        		//保存按钮设置为可用
							$(add_box).parent().find(':button').eq(1).attr( 'disabled', false );
							
			        		$(add_box).dialog("close");
			        		$('#emptybox').remove();
			        		
			        		var appendStr = '<li addressid="'+data.data.address_id+'" class="address-item clearfix "><div class="address-tag"><span class="name-tag" title="'+data.data.consignee+'">'+data.data.consignee+'</span><span class="city-tag">'+data.data.province_name+'</span><i class="icon"></i></div>'
			        		+'<div class="address-summary"><div class="option-box"><span addressId="'+data.data.address_id+'" class="delete-link">删除</span><span addressId="'+data.data.address_id+'" class="edit-link">编辑</span><span addressId="'+data.data.address_id+'" class="set-default">设为默认</span></div>'
			        		+'<span class="name-tag" title="">'+data.data.consignee+'</span>  <span class="province-tag">'+data.data.province_name+'</span> <span class="city-tag">'+data.data.city_name+'</span>  <span class="street-tag" title="">'+data.data.address+'</span>  <span class="mobile-tag">'+data.data.phone_mob+'</span>  <span class="email-tag">'+data.data.phone_tel+'</span></div></li>';
			        		$('#addressList').append(appendStr);
			        		
			        		var addressItemNewLength = $('#addressList .address-item').length;
			        		$('#addressList').css('height',addressItemNewLength * addressItemHeight);
			        		
			        		$('#addressBox .address-tag:last').click();

							//调整展开按钮
							tidyUnfoldAddressButton();
			        	}
			        	else
			        	{
			        		var flag = data.flag;
			        		
			        		checkAddress( flag ,'add' );
			        	}
			        }
				});					
			}
		}]
	});
	
	//关闭添加地址栏
	$( "#addressAddDialog,#addressModifyDialog" ).on( "dialogclose", function( event, ui ){
		$('.address-items .tip').hide();
		resetAdd();
	});
	
	//清空编辑栏
	function resetAdd()
	{
		$('#consignee,#address,#phone_mob,#phone_tel,#zipcode').val('');
		$('#province option[value=0]').attr('selected','selected');
		$('#city option[value=0]').attr('selected','selected');
	}
	
	//添加编辑js验证
	function checkAddressJs( type )
	{	
		
		if( type == 'add' )
		{
			var fix = '';
			$('#addressAddDialog .tip').hide();
		}
		else
		{	
			var fix = 'm';
			$('#addressModifyDialog .tip').hide();
		}
		
		var falg = true;
		var consignee = $.trim( $('#'+fix+'consignee').val() );
		var address	  = $.trim( $('#'+fix+'address').val() );
		var phone_mob = $.trim($('#'+fix+'phone_mob').val() );
		var province  = $('#'+fix+'province').val();
		var city	  = $('#'+fix+'city').val();
		var phone_tel = $.trim( $('#'+fix+'phone_tel').val() );
		var zipcode	  = $.trim( $('#'+fix+'zipcode').val() );
		
		var preg  = /^\d{11}$/;
		var preg2 = /^[0-9-]{6,20}$/;
		var preg3 = /^\d{1,10}$/;

		if( consignee.length < 2 || consignee.length > 25  )
		{	
			falg = false;
			$('#'+fix+'consignee').next().show();
		}
		
		if( address.length < 5 || address.length > 120  )
		{	
			falg = false;
			$('#'+fix+'address').next().show();
		}

		if( !preg.test(phone_mob)  )
		{	
			falg = false;
			$('#'+fix+'phone_mob').next().show();
		}
		
		if( province == 0 || city == 0 )
		{	
			falg = false;
			$('#'+fix+'city').next().show();
		}
		
		if( phone_tel != '' )
		{
			if( !preg2.test(phone_tel) )
			{
				falg = false;
				$('#'+fix+'phone_tel').next().show();
			}
		}
		
		if( zipcode != '' )
		{
			if( !preg3.test(zipcode) )
			{
				falg = false;
				$('#'+fix+'zipcode').next().show();
			}
		}
		
		return falg;
	}
	
	function checkAddress( flag, type )
	{	
		if( type == 'add' )
		{
			var prefix = '';
			$('#addressAddDialog .address-items .tip').hide();
		}
		else
		{
			var prefix = 'm';
			$('#addressModifyDialog .address-items .tip').hide();
		}
		
		if( flag == '-2' )
		{
			$('#'+prefix+'consignee').next().show();
		}
		else if( flag == '-3' || flag == '-4' )
		{
			$('#'+prefix+'city').next().show();
		}
		else if( flag == -5 )
		{
			$('#'+prefix+'address').next().show();
		}
		else if( flag == -6 )
		{
			$('#'+prefix+'phone_mob').next().show();
		}
		else if( flag == -7 )
		{
			$('#'+prefix+'phone_tel').next().show();
		}
		else if( flag == -8 )
		{
			$('#'+prefix+'zipcode').next().show();
		}
	}
	
	$('.order-parameter .parameter-header').on('click','#addAddressButton',function(){
		$('#addressAddDialog').dialog("open"); 
	});

   //编辑收货人地址弹层
   $("#addressModifyDialog").dialog({
		autoOpen: false, 
		width: 670,
		//height: 400, 
		modal: true,
		title: '\u7f16\u8f91\u6536\u8d27\u4eba\u4fe1\u606f', //编辑收货人信息
		buttons: [{
			text: '\u4fdd\u5b58\u6536\u8d27\u4eba\u4fe1\u606f', //保存收货人信息
			'class': 'save-button confirm-button',
			click: function() {
				var addCheckRe = checkAddressJs( 'update' );
				
				if( !addCheckRe )
				{
					return;
				}
				
				var update_box = this;
				
				var provinceId = $('#mprovince').val();
				var provinceName = $('#mprovince option[value='+provinceId+']').html();
				var cityId = $('#mcity').val();
				var cityName = $('#mcity option[value='+cityId+']').html();
				
				var consignee = $('#mconsignee').val();//收货人
				var address = $('#maddress').val();//收货地址
				var phone_tel = $('#mphone_tel').val();//固定电话
				var phone_mob = $('#mphone_mob').val();//固定电话
				var zipcode = $('#mzipcode').val();//固定电话
				
				var addressid = $('#addressBox .address-item').eq(currentIndex).attr('addressid');
				
				$.ajax({
					dataType:'json',
			        url: ajax_url,
			        cache:false,
			        data:{	"act":'updateAddress',
				        	'provinceId':provinceId,
				        	'provinceName':provinceName,
				        	'cityId':cityId,
				        	'cityName':cityName,
				        	'consignee':consignee,
				        	'address':address,
				        	'phone_tel':phone_tel,
				        	'phone_mob':phone_mob,
				        	'zipcode':zipcode,
				        	'addressId':addressid
			        	},
			        success: function(data){
			        	if(data.flag == 1)
			        	{	
			        		var box = $('#addressBox .address-item').eq(currentIndex);
			        		
			        		box.find('.address-tag .name-tag').html(data.data.consignee);
			        		box.find('.address-tag .name-tag').attr('title',data.data.consignee);
			        		box.find('.address-tag .city-tag').html(data.data.province_name);
			        		
			        		box.find('.address-summary .name-tag').html(data.data.consignee);
			        		box.find('.address-summary .name-tag').attr('title',data.data.consignee);
			        		box.find('.address-summary .province-tag').html(data.data.province_name);
			        		box.find('.address-summary .city-tag').html(data.data.city_name);
			        		box.find('.address-summary .street-tag').html(data.data.address);
			        		box.find('.address-summary .street-tag').attr('title',data.data.address);
			        		box.find('.address-summary .mobile-tag').html(data.data.phone_mob);
			        		box.find('.address-summary .email-tag').html(data.data.phone_tel);
			        		
			        		if( $('#addressList .address-item').eq(currentIndex).hasClass('default-item') )
			        		{
			        			setAddressTable(data.data.province_name,data.data.city_name,data.data.address,data.data.phone_mob,data.data.consignee);
			        		}
			        		
			        		$(update_box).dialog("close");
			        	}
			        	else
			        	{	
			        		var flag = data.flag;
			        		
			        		checkAddress(flag, 'update');
			        	}
			        }
				});	
				
				//$(this).dialog("close");
			}
		}]
	}); 
   	
   	
   
   	//点击编辑按钮
	$('#addressList').on('click','.address-item .edit-link',function(){
		currentIndex = $(this).parents('.address-item').index();
		var addressid = $(this).attr('addressid');
		$.ajax({
			dataType:'json',
	        url: ajax_url,
	        cache:false,
	        data:{	"act":'getAddress',
		        	'addressId':addressid
	        	},
	        success: function(data){
	        	if( data.flag == 1 )
	        	{	
	        		$('#mconsignee').val(data.data.consignee);//收货人
					$('#maddress').val(data.data.address);//收货地址
					$('#mphone_tel').val(data.data.phone_tel);//固定电话
					$('#mphone_mob').val(data.data.phone_mob);//移动电话
					$('#mzipcode').val(data.data.zipcode);//邮编
					$('#mprovince option[value='+data.data.province_id+']').prop('selected',true);
					$('#mprovince').change();
					$('#mcity option[value='+data.data.city_id+']').prop('selected',true);
					$('#addressModifyDialog').dialog("open"); 
	        	}
	        }
		});
		
		
	});  

	//设为默认地址
	$('#addressList').on('click','.set-default',function(){
		var addressid = $(this).attr('addressid');
		var default_box = this;
		
		$.ajax({
			dataType:'json',
	        url: ajax_url,
	        cache:false,
	        data:{	"act":'setDefault',
		        	'addressId':addressid,
	        	},
	        success: function(data){
	        	if( data.flag == 1 )
	        	{	
	        		//$(default_box).parents('.address-item').addClass('default-item').siblings('.address-item').removeClass('default-item');
	        		
	        		$(default_box).parents('.address-item').addClass('default-item').siblings('.address-item').removeClass('default-item'); 
	        		$(default_box).parents('.address-item').find('.set-default').text('默认地址');
	        		$(default_box).parents('.address-item').siblings('.address-item').find('.set-default').text('设为默认');
	        	}
	        }
		});
	}); 

	//选择地址操作
	$('#addressList').on('click','.address-tag',function(){
		var parent = $(this).parent();
		
		var province = parent.find('.province-tag').html();
		var city = parent.find('.address-summary .city-tag').html();
		var address = parent.find('.street-tag').html();
		var phone_mob = parent.find('.mobile-tag').html();
		var consignee = parent.find('.name-tag').html();
		
		setAddressTable(province,city,address,phone_mob,consignee);
		
		$(this).parents('.address-item').addClass('selected-item').siblings('.address-item').removeClass('selected-item');  
	}); 
	
	function setAddressTable(province,city,address,phone_mob,consignee)
	{	
		var addressStr = '<li class="address-item">寄送至： '+province+' '+city+' '+address+'</li>'
						+'<li class="address-item"><span>手机号：'+phone_mob+'</span><span>收货人：'+consignee+'</span></li>';
		$('.address').html(addressStr);
	}
	
//	//选择收货
//	$('#addressList').on('click', '.address-tag', function(){
//		$(this).parents('.address-item').addClass('default-item').siblings('.address-item').removeClass('default-item');
//	})
	
	//删除联系人
	$('#deleteAddressDialog').dialog({
		autoOpen: false, 
		width: 296,
		height: 196, 
		modal: true,
		title: '\u5220\u9664\u63d0\u793a', //删除提示 
		buttons: [{
			text: '\u786e\u5b9a\u5220\u9664', //确定删除 
			click: function() {
				var addressid = $('#addressList .address-item').eq(currentIndex).find('.delete-link').attr('addressid');
				var del_box = this;
				
				$.ajax({
					dataType:'json',
			        url: ajax_url,
			        cache:false,
			        data:{	"act":'delAddress',
				        	'addressId':addressid,
			        	},
			        success: function(data){
			        	if( data.flag == 1 )
			        	{
			        		$(del_box).dialog("close"); 
							$('#addressList .address-item').eq(currentIndex).remove();
							
							var addressItemNewLength = $('#addressList .address-item').length;
			        		$('#addressList').css('height',addressItemNewLength * addressItemHeight);
							tidyUnfoldAddressButton();
			        	}
			        }
				});
				
				
			}
		},{
			text: '\u8fd4\u56de', //返回
			click: function() {
				$(this).dialog("close");
			}
		}]
	}); 

	$('#addressList').on('click','.address-item .delete-link',function(){
		$('#deleteAddressDialog').dialog("open"); 
		currentIndex = $(this).parents('.address-item').index();
	}); 

	//删除商品
	$('#deleteGoodsDialog').dialog({
		autoOpen: false, 
		width: 296,
		height: 196, 
		modal: true,
		title: '\u5220\u9664\u63d0\u793a', //删除提示 
		buttons: [{
			text: '\u786e\u5b9a\u5220\u9664', //确定删除 
			click: function() {
				//应付
				var price = $('#goodList .good-item').eq(currentIndex).find('.delete-link').attr('price');
				var nowprice = $('#totalprice').attr('totalprice');
				var totalprice = price_format(nowprice - price);
				$('#totalprice').html('&yen;'+totalprice);
				$('#totalprice').attr('totalprice',totalprice);
				//实付
				var privilege = $('#privilege').attr('price');
				var realityprice = price_format(totalprice - privilege);
				if( realityprice < 0 )realityprice = '0.00';
				$('#realityprice').html('&yen;'+realityprice);
				
				$(this).dialog("close"); 
				$('#goodList .good-item').eq(currentIndex).remove();
				getCoupon();
				$('#coupon').change();
				checkDeletGoodsBtn();
			}
		},{
			text: '\u8fd4\u56de', //返回
			click: function() {
				$(this).dialog("close");
			}
		}]
	}); 

	$('#goodList .good-item').on('click','.delete-link',function(){
		$('#deleteGoodsDialog').dialog("open"); 
		currentIndex = $(this).parents('.good-item').index();
	});  
})();

//拍卖类型区域js
$('.radio-buttons').on('click','.radio-text',function(){  
	var p = $(this).parent(); 
	if(p.hasClass('disabled-item')){
		p.removeClass('disabled-item').siblings().addClass('disabled-item');  
	}else{ 
		//p.addClass('disabled-item').siblings().removeClass('disabled-item'); 
	} 
});  
 
//评价弹层
(function evaluationDialogFn(){
	$('#evaluationDialog').dialog({
		autoOpen: false, 
		width: 596,
		height: 330,
		modal: true,
		title: '\u8bc4\u4ef7', //评价 
		dialogClass: 'evaluation-dialog',
		buttons: [{
			text: '\u53d6\u6d88', // 取消 
			click: function() {
				$(this).dialog("close");  
			}
		},{
			text: '\u8bc4\u4ef7', // 评价
			click: function() {
				var score = $('#score li:not(.disabled-item)').attr('score');
				var content = $('#evaluationContent').val();
				
				$.ajax({
					dataType:'json',
			        url: evaluation_url,
			        type:'post',
			        cache:false,
			        data:{
			        	'score':score,
			        	'content':content,
			        },
			        success: function(data){			        	
			        	if( data.flag == 1 )
			        	{
			        		window.location.reload(true);
			        	}
			        	else
			        	{	
			        		jsError(data.msg);
			        	}
			        }
				});
				
				$(this).dialog("close");
			}
		}]
	});

	//点击评价按钮操作
	$('.order-status').on('click','#evaluationButton',function(){
		var showNew = $(this).attr( 'showNew' );

		if( showNew == '1' )
		{
			var maxImg = 6;

			$( '#evaluationNewerDialog .pic-wrap li' ).remove();
			$( '#evaluationNewerDialog #newerEvaluationContent' ).val( '' );

			$( '#evaImgBtn' ).uploadify({
				'swf'           : '/js/public/uploadify.swf',    //指定上传控件的主体文件
				'uploader'     : '/order/orderajax?act=upImg',    //指定服务器端上传处理文件
				'buttonClass'  : 'imagefile-wrap',
				'buttonText'	: '',
				'debug'			: false,
				'uploadLimit' : maxImg,//上传文件个数
				'removeTimeout': 1,
				'removeCompleted': true,
				'fileObjName' : 'imgFile',
				'fileTypeExts': ' *.jpg; *.png;*.jpeg',
				'onUploadStart':function(){
					$( '#evaImgBtn' ).uploadify( 'disable', true );
					// $( '#evaImgBtn' ).uploadify( 'stop' );
				},
				'onUploadSuccess':function( file, data, response ){
					data = $.parseJSON( data );

					if( data.flag == 1 )
					{
						var id = file.id;

						var str = '<li imgid="'+ data.data.newId +'" class="pic-item"><img src="' + data.data.src + '" alt=""><i fid="'+ id +'" class="closed-icon">&times;</i></li>';
						$( '#pic-preview' ).append( str );
					}
				},
				'onQueueComplete':function(){//队列全部结束
					$( '#evaImgBtn' ).uploadify( 'disable', false );
				},
				'onSelectError': function (file, errorCode, errorMsg) {
					switch (errorCode) {
						case -100:
							this.queueData.errorMsg = '文件个数不能大于' + maxImg + '个';
							break;
						case -110:
							break;
						case -120:
							alert("文件 [" + file.name + "] 大小异常！");
							break;
						case -130:
							alert("文件 [" + file.name + "] 类型不正确！");
							break;
					}
				},
				'onInit':function( a ){

				},
			});

			$('#evaluationNewerDialog').dialog("open");
		}
		else
		{
			$('#evaluationDialog').dialog("open");
		}
	});  
})();

//新品评价弹层 add by hanjw 20170424
(function evaluationDialogFn(){
    $('#evaluationNewerDialog').dialog({
        autoOpen: false, //此处值开发的时候修改成 false
        width: 700,
        modal: true,
        title: '\u8bc4\u4ef7', //评价
        dialogClass: 'evaluation-dialog evaluation-newer-dialog',
        buttons: [{
            text: '\u53d6\u6d88', // 取消
            click: function() {
                $(this).dialog("close");
            }
        },{
            text: '\u8bc4\u4ef7', // 评价
			id:'newEvaSubmit',
            click: function() {
                var score = $('#newerScore li:not(.disabled-item)').attr('score');
                var content = $('#newerEvaluationContent').val();
				
				var imgIds = [];

				$( '#evaluationNewerDialog .pic-wrap li' ).each( function(){
					imgIds.push( $( this ).attr( 'imgid' ) );
				} );

				$( '#newEvaSubmit' ).attr("disabled", true);

				$.ajax({
					dataType:'json',
					url: evaluation_url,
					type:'post',
					cache:false,
					data:{
						'score':score,
						'content':content,
						'imgIds':imgIds
					},
					success: function(data){
						if( data.flag == 1 )
						{
							window.location.reload(true);
						}
						else
						{
							jsError(data.msg);
						}

						$( '#newEvaSubmit' ).attr("disabled", false);
					}
				});

				$(this).dialog("close");
            }
        }]
    });

	//新评论移入溢出
	$( document ).on( 'mouseover mouseout', '#evaluationNewerDialog .pic-item', function( event ){
		if( event.type == 'mouseover' )//移入
		{
			$( this ).addClass( 'item-hover' );
		}
		else if( event.type == 'mouseout' )//移出
		{
			$( this ).removeClass( 'item-hover' );
		}
	} );

	//删除新评论图片
	$( document ).on( 'click', '#evaluationNewerDialog .closed-icon', function(){
		$( this ).parent().remove();

		var alreadyNum = $( '#evaluationNewerDialog .pic-wrap li' ).length;
		var swfu = $('#evaImgBtn').data('uploadify');
		var stats = swfu.getStats();
		stats["successful_uploads"] = alreadyNum;
		swfu.setStats(stats);
	} );
})();

//买家取消订单
(function closedOrderDialogFn(){
	$('#closedOrderDialog').dialog({
		autoOpen: false, 
		width: 296,
		modal: true,
		title: '\u63d0\u793a', //提示
        resizable: false,
		buttons: [{
			text: '\u8fd4\u56de', //返回 
			click: function() {
				_hmt.push(['_trackEvent', '2_fengniao', 'orderDetail', 'closeOrder', '0']);
				$(this).dialog("close");  
			}
		},{
			text: '\u786e\u5b9a', //确定
			click: function() {
				var msgid 	  = $('#closedOrderDialog select').val();
				_hmt.push(['_trackEvent', '2_fengniao', 'orderDetail', 'closeOrder', '1']);
				
				$.ajax({
					dataType:'json',
			        url: ajax_url,
			        cache:false,
			        data:{	"act":'closeOrder',
				        	'msgid':msgid,
				        	'orderid':order_id
			        	},
			        success: function(data){			        	
			        	if( data.flag == 1 )
			        	{
			        		window.location.reload(true);
			        	}
			        	else
			        	{	
			        		jsError(data.msg);
			        	}
			        }
				});
				
				//$(this).dialog("close");
			}
		}]
	}); 
	 
	$('.order-status').on('click','#closedOrderButton',function(){
		if( orderInfo.orderType == 0 )
		{
			$('#closedOrderDialog').dialog({height:216});
		}
		else
		{
			$('#closedOrderDialog').dialog({height:254});
		}
		
		$('#closedOrderDialog').dialog("open");  
	});  
})();

//卖家取消订单
(function closedOrderDialogFn1(){
	$('#closedOrderDialog1').dialog({
		autoOpen: false, 
		width: 296,
		height: 254, 
		modal: true,
		title: '\u63d0\u793a', //提示
        resizable: false,
		buttons: [{
			text: '\u8fd4\u56de', //返回 
			click: function() {
				$(this).dialog("close");  
			}
		},{
			text: '\u786e\u5b9a', //确定
			click: function() {
				var msgid 	  = $('#closedOrderDialog1 select').val();
				
				$.ajax({
					dataType:'json',
			        url: ajax_url,
			        cache:false,
			        data:{	"act":'closeOrder',
				        	'msgid':msgid,
				        	'orderid':order_id
			        	},
			        success: function(data){			        	
			        	if( data.flag == 1 )
			        	{
			        		window.location.reload(true);
			        	}
			        	else
			        	{	
			        		jsError(data.msg);
			        	}
			        }
				});
				
				//$(this).dialog("close");
			}
		}]
	});
 
	$('.order-status').on('click','#closedOrderButton1',function(){
		if( orderInfo.orderType == 0 )
		{
			$('#closedOrderDialog1').dialog({height:226});
		}
		else
		{
			$('#closedOrderDialog1').dialog({height:284});
		}
		
		$('#closedOrderDialog1').dialog("open");
	});  
})();

//卖家修改价格 
(function modifyPriceDialogFn(){
	$('#modifyPriceDialog').dialog({
		autoOpen: false, 
		width: 350,
		height: 195, 
		modal: true,
		title: '\u4ef7\u683c\u4fee\u6539', //价格修改 
		buttons: [{
			text: '\u8fd4\u56de', //返回 
			click: function() {
				$(this).dialog("close");  
			}
		},{
			text: '\u786e\u5b9a', //确定
			click: function() {
				var modifyPrice = $('#modifyPrice').val();
				
				$.ajax({
					dataType:'json',
			        url: ajax_url,
			        cache:false,
			        data:{	"act":'updateOrderPrice',
				        	'price':modifyPrice,
				        	'orderid':order_id
			        	},
			        success: function(data){			        	
			        	if( data.flag == 1 )
			        	{
			        		window.location.reload(true);
			        	}
			        	else
			        	{	
			        		jsError(data.msg);
			        	}
			        }
				});
				
				
				//$(this).dialog("close");
				//$('#modifyPriceStateDialog').dialog("open"); 
			}
		}]
	});

	$('#modifyPriceStateDialog').dialog({
		autoOpen: false, 
		width: 296,
		height: 150, 
		modal: true, 
		dialogClass: 'no-header',
		buttons: [{
			text: '\u8fd4\u56de', //返回 
			click: function() {
				$(this).dialog("close");  
			}
		}]
	}); 
 
	$('.order-status').on('click','#modifyPriceButton',function(){
		$('#modifyPrice').val('');//清空修改金额
		$('#modifyPriceDialog').dialog("open");  
	});  
})();

//买家提醒发货
(function remindDeliveryDialogFn(){
	var remindState = true; //ture为提醒成功 false 为提醒失败

	$('#remindSuccessDialog,#remindFailureDialog').dialog({
		autoOpen: false, 
		width: 296, 
		modal: true,
		dialogClass: 'no-header',
		buttons: [{
			text: '\u8fd4\u56de', //返回 
			click: function() {
				$(this).dialog("close");  
			}
		}]
	});
 
	$('.order-status').on('click','#remindDeliveryButton',function(){
		$.ajax({
			dataType:'json',
	        url: ajax_url,
	        cache:false,
	        data:{	"act":'remindReceipt',
		        	'orderid':order_id
	        	},
	        success: function(data){			        	
	        	if( data.flag == 1 )
	        	{
	        		$('#remindSuccessDialog').dialog("open");
	        	}
	        	else
	        	{	
	        		jsError(data.msg);
	        	}
	        }
		});

//		if(remindState == true){ 
//			$('#remindSuccessDialog').dialog("open");	
//		}else if(remindState == false){
//			$('#remindFailureDialog').dialog("open");	
//		}else{
//			return false;
//		}  
	});  
})();

//卖家发货
(function deliveryDialogFn(){
	var deliveryState = window.deliveryState || false; //ture为提醒成功 false 为提醒失败

	$('#deliveryDialog').dialog({
		autoOpen: false, 
		width: 296, 
		modal: true,
		title: '\u53d1\u8d27', //发货 
		buttons: [{
			text: '\u8fd4\u56de', //返回 
			click: function() {
				$(this).dialog("close");  
			}
		},{
			text: '\u786e\u5b9a', //确定
			click: function() {
				var invoice_id 	 = $('#invoice_id').val();
				var invoice_no	 = $('#invoice_no').val();
				var invoice_name = $('#invoice_name').val();

				$.ajax({
					dataType:'json',
			        url: ajax_url,
			        cache:false,
			        data:{	"act":'invoice',
				        	'invoice_id':invoice_id,
				        	'invoice_no':invoice_no,
				        	'invoice_name':invoice_name,
				        	'orderid':order_id,
			        	},
			        success: function(data){			        	
			        	if( data.flag == 1 )
			        	{
			        		window.location.reload(true);
			        	}
			        	else
			        	{	
			        		jsError(data.msg);
			        	}
			        }
				});
//				$(this).dialog("close");
//				$('#modifyPriceStateDialog').dialog("open"); 
			}
		}]
	});

	$('#deliveryPauseDialog').dialog({
		autoOpen: false, 
		width: 296, 
		modal: true,
		title: '\u53d1\u8d27', //发货 
		buttons: [{
			text: '\u597d\uff0c\u6211\u5148\u6c9f\u901a', // 好，我先沟通 
			click: function() {
				$(this).dialog("close");  
			}
		},{
			text: '\u575a\u6301\u53d1\u8d27', //坚持发货
			click: function() {
				$(this).dialog("close"); 
				$('#deliveryDialog').dialog("open");
			}
		}]
	});
 
	$('.order-status').on('click','#deliveryButton',function(){
		if(deliveryState == true){ 
			$('#deliveryDialog').dialog("open");	
		}else if(deliveryState == false){
			$('#deliveryPauseDialog').dialog("open");	
		}else{
			return false;
		}  
	});
	
	$('#invoice_id').change(function(){
		var val = $(this).val();
		var box = $('#invoice_name_box');
		
		val == 0 ? box.show():box.hide();
	});
})();

//买家/卖家延迟收货时间
//(function delayDeliveryDialogFn(){
//	var delayState = false; //ture为提醒成功 false 为提醒失败
//
//	$('#delayDeliverySuccessDialog,#delayDeliveryFailureDialog').dialog({
//		autoOpen: false, 
//		width: 296,
//		modal: true,
//		title: '\u5ef6\u957f\u6536\u8d27\u65f6\u95f4', //延长收货时间 
//		buttons: [{
//			text: '\u8fd4\u56de', //返回 
//			click: function() {
//				$(this).dialog("close");  
//			}
//		}]
//	});
// 
//	$('.order-status').on('click','.delayDelivery-button',function(){ //建议用ID  delayDeliveryButton
//		if(delayState == true){ 
//			$('#delayDeliverySuccessDialog').dialog("open");	
//		}else if(delayState == false){
//			$('#delayDeliveryFailureDialog').dialog("open");	
//		}else{
//			return false;
//		}  
//	});  
//})();

//延长收货买家
(function delayDeliveryDialogFn(){
	$('#lengthenGoodsBuyerlog').dialog({
		autoOpen: false, 
		width: 296,
		modal: true,
		title: '\u5ef6\u957f\u6536\u8d27\u65f6\u95f4', //延长收货时间 
		buttons: [{
			text: '\u786e\u5b9a', //确定
			click: function() {
				$.ajax({
					dataType:'json',
			        url: ajax_url,
			        cache:false,
			        data:{  "act":'lengthen',
			        		'orderid':order_id,
			        	},
			        success: function(data){			        	
			        	if( data.flag == 1 )
			        	{
			        		window.location.reload(true);
			        	}
			        	else
			        	{	
			        		jsError(data.msg);
			        	}
			        }
				});
				
				$(this).dialog("close");  
			}
		},{
			text: '\u8fd4\u56de', //返回 
			click: function() {
				$(this).dialog("close");  
			}
		}]
	});
	
	$('#lengthenGoodsBuyer').click(function(){
		$('#lengthenGoodsBuyerlog').dialog('open');
	});
})();

//延长收货卖家
(function delayDeliveryDialogFn(){
	$('#lengthenGoodsSellerlog').dialog({
		autoOpen: false,  //此处值开发的时候修改成 false
		width: 500,
		modal: true,
		title: '\u5ef6\u957f\u6536\u8d27\u65f6\u95f4', //延长收货时间 
		buttons: [{
			text: '\u786e\u5b9a', //确定
			click: function() {
				var day = $('#lengthenDay').val();
				
				$.ajax({
					dataType:'json',
			        url: ajax_url,
			        cache:false,
			        data:{  "act":'lengthen',
			        		'orderid':order_id,
			        		'day':day,
			        	},
			        success: function(data){			        	
			        	if( data.flag == 1 )
			        	{
			        		window.location.reload(true);
			        	}
			        	else
			        	{	
			        		jsError(data.msg);
			        	}
			        }
				}); 
			}
		},{
			text: '\u8fd4\u56de', //返回 
			click: function() {
				$(this).dialog("close");  
			}
		}]
	});
	
	$('#lengthenGoodsSeller').click(function(){
		$( '#lengthenGoodsSellerlog .count-down' ).html( $( '#autoTime' ).html() );
		$( '#lengthenGoodsSellerlog' ).dialog('open');
	});
})();

//买家确认收货
FnApp.loadScript(FnApp.mdjs,function(){
	(function delayDeliveryDialogFn(){
		$("#confirmReceiptDialog1").dialog({
		    autoOpen: false, 
		    width: 736, 
		    modal: true,
		    dialogClass: 'orderNew-dialog', 
		    buttons: [{
		        text: '确认', 
		        click: function() {
		        	var pwd = $('#fengniaoPassword2').val();
		        	pwd = hex_md5( pwd );
		        	
		        	$.ajax({
						dataType:'json',
				        url: ajax_url,
				        cache:false,
				        data:{  "act":'affirmReceipt',
				        		'orderid':order_id,
				        		'pwd':pwd,
				        	},
				        success: function(data){			        	
				        	if( data.flag == 1 )
				        	{
				        		window.location.reload(true);
				        	}
				        	else
				        	{	
				        		jsError(data.msg);
				        	}
				        }
					});
		        }
		    },{
		        text: '取消', 
		        click: function() {
		            $(this).dialog('close');
		        }
		    }]
		}); 
		
		$('#affirmReceiptbtn').click(function(){
			$.ajax({
				dataType:'json',
		        url: ajax_url,
		        cache:false,
		        data:{  "act":'checkSetPassWord' },
		        success: function(data){			        	
		        	if( data.flag == 1 )
		        	{
		        		$('#confirmReceiptDialog1').dialog('open');
		        	}
		        	else
		        	{	
		        		$('#setPassWordBox').dialog('open');
		        	}
		        }
			});
		});
	})();
	
	$('#setPassWordBox').dialog({
		autoOpen: false, 
		width: 500,
		modal: true,
		title: '确认收货', //延长收货时间 
		buttons: [{
			text: '去设置', //确定
			click: function() {
				window.open("/user/setting?act=password");
			}
		},{
			text: '\u8fd4\u56de', //返回 
			click: function() {
				$(this).dialog("close");  
			}
		}]
	});
});

function checkDeletGoodsBtn()
{
	var len = $('#goodList .delete-link').length;
	
	if( len == 1 )
	{
		$('#goodList .delete-link').remove();
	}
};

checkDeletGoodsBtn();

$('.orderSwtich-tab').on('mouseenter mouseout', '.nav-item', function() {
	$(this).addClass('current-item').siblings('.nav-item').removeClass('current-item');
	$(this).parents('.orderSwtich-tab').find('.tab-panel[id=' + $(this).attr('rel') + ']').show().siblings('.tab-panel').hide();
});



/*$('.sellerOffer-table .table-row .more').click(function(){
	    var _this = $(this);
        if($(this).attr('onoff') == 1){
            $(this).attr('onoff','0');
            $(this).addClass('closed').find('.icon').text('收起');
            $(this).siblings('.reply').show();
			$(this).parents('.table-row').addClass('show-reply-row');
            var goods_id = $(this).attr('goods_id');
    		var offer_id = $(this).attr('offer_id');
    		if($(this).attr('status')==0){
	            $.ajax({
	    			url:ajax_url,
	    			type:"post",
	    			dataType:'json',
	    			data:{'goods_id':goods_id,'_csrf':csrf,'offer_id':offer_id,'act':'seller_offer','op':'viewed'},
	    			success:function(json){
	    				_this.attr('status',json.item.status);
	    			}
	    		});
    		}
        }else{
            $(this).attr('onoff','1');
            $(this).removeClass('closed').find('.icon').text('查看详情');
			$(this).siblings('.reply').hide();
			$(this).parents('.table-row').removeClass('show-reply-row');
        }
    });*/


$(function(){
	//初始化弹层
	_initErrorDialog();
	
	$(document).on('click', '.agree-button,.refuse-button',function(){
		var goods_id = $(this).attr('goods_id');
		var offer_id = $(this).attr('offer_id');
		var op =  $(this).attr('op') =='agree' ?'agree' : 'refuse';
		$('#agree').dialog({
			autoOpen: false,
			width: 510,
			dialogClass: "y-center-alert-price no-header",
			buttons: [{
				text: '确认',  
				click: function() {
					var reply  = $('#reply').val();
					$.ajax({
						url:'/ajax/seller-offer-'+op,
						type:"post",
						dataType:"json",
						cache:false,
						data:{'goods_id':goods_id,'_csrf':csrf,'reply':reply,'offer_id':offer_id},
						success:function(json){
							if(json.code==1){
								if(op=='agree')
								{
									$.ajax({
										url:order_url,
										dataType:"json",
										data:{'goodsid':goods_id,'act':'addOrderOffer','offerid':offer_id},
										success:function(json){
											if(json.flag==1){
												var page = $('#box'+goods_id).attr('page');
												getOffer( goods_id, page );
											}
										}
									});
								}
								else
								{
									var page = $('#box'+goods_id).attr('page');
									getOffer( goods_id, page );
								}
								
								$('#agree').dialog("close");
							}else{
								$('#'+op).dialog("close");
								var page = $('#box'+goods_id).attr('page');
								getOffer( goods_id, page );
								return jsError(json.msg);

							}
						}
					});
				}
			}, {
				text: '取消', //取消
				click: function() {
					$(this).dialog("close"); 
				}
			}] 
		});
		$.ajax({
			url:'/ajax/seller-offer',
			type:"post",
			cache:false,
			data:{'goods_id':goods_id,'_csrf':csrf,'offer_id':offer_id,'_op':op},
			success:function(html){
				$('#agree').html(html);
			}
		});
		$('#agree').dialog("open");
	})
	/*
	$('.y-center-bid2 dd').hover(function(){
		if($(this).find('.row6').find('p').length>0){
			$(this).find('.row6').show();
		}
	},
	function(){
		if($(this).find('.row6').find('p').length>0){
			$(this).find('.row6').hide();
		}
	}
	)*/
	
	$('.more').click(function(){
		    var _this = $(this);
	        if($(this).attr('onoff') == 1){
	        	var goodsId = $(this).attr('goods_id');
	        	
	        	getOffer( goodsId, 1 );
	        	
	            $(this).attr('onoff','0');
	            $(this).addClass('closed').find('.icon').text('收起');
	            $(this).siblings('.reply').show();
				$(this).parents('.table-row').addClass('show-reply-row');
	        }else{
	            $(this).attr('onoff','1');
	            $(this).removeClass('closed').find('.icon').text('查看详情');
				$(this).siblings('.reply').hide();
				$(this).parents('.table-row').removeClass('show-reply-row');
	        }
	    });
	
	function getOffer( goodsId, page )
	{
		$.ajax({
			url:'/user/getGoodsOffer',
			type:"get",
			cache:false,
			data:{'goodsId':goodsId,'page':page},
			dataType:'json',
			success:function( data ){
				if( data.flag == 1 )
				{
					$('#box'+goodsId).parent().find('.reply').html(data.data);
					$('#box'+goodsId).attr('page', page);
					
					flushGoods(goodsId);
					
					$('#box'+goodsId).find('.money-icon').each(function() {
						 $(this).parents('.price-wrap').click(function(){  
							 var lock = $(this).hasClass('price-hover');
							 
							 $(this).parents('.sellerOffer-table').find('.price-wrap').removeClass('price-hover');  
							 
							 if( lock ){ 
								 $(this).removeClass('price-hover');
							 }else{ 
								 $(this).addClass('price-hover');
							 }  
						 })
					 });
	
					 $('#box'+goodsId).find('.user-wrap').each(function() {
						 $(this).hover(function(){
							 $(this).toggleClass('reputation-hover');
						 })
					 });
				}
				else
				{
					jsError(data.msg);
				}
			}
		});
	}
	
	//跳转
	$(document).on('click', '.jump', function(){
		var page = $(this).parent().find('.pageNum').val();
		var goods_id = $(this).attr('goods_id');
		getOffer(goods_id,page);
	});
	
	//信封
	$(document).on('click', '.money-icon', function(){
		var box = this;
		var mark = $(box).hasClass('readOffer-icon');
		var goods_id = $(box).attr('goods_id');
		var offer_id = $(box).attr('offer_id');
		
		if( mark )
		{
			return;
		}
		
		$.ajax({
			url:'/ajax/seller-offer-view',
			type:"post",
			cache:false,
			data:{'goods_id':goods_id,'offer_id':offer_id},
			dataType:'json',
			success:function( data ){
				if( data.code == 1 )
				{
					$(box).addClass('readOffer-icon');
					$(box).parents('.price-wrap').addClass('readOffer-wrap');
					flushGoods(goods_id);
				}
				else
				{
					var page = $( '#box'+goods_id ).attr('page');
					getOffer( goods_id, page );
				}
			}
		});
	});
	
	//删除操作
	$('.delOffer').click(function(){
		var goods_id = $(this).attr( 'goods_id' );
		$('#alertBox').dialog({
			autoOpen: false, 
			width: 296,
			modal: true,
			title: '',
			buttons: [{
				text: '\u786e\u5b9a', //确定
				click: function() {
					$.ajax({
						url:'/ajax/seller-offer-del',
						type:"get",
						cache:false,
						data:{'goodsId':goods_id},
						dataType:'json',
						success:function( data ){
							if( data.flag == 1 )
							{
								window.location.reload(true);
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
		
		$('#alertMsg').html('确认删除该商品下全部议价？');
		
		$('#alertBox').dialog('open');
	});
	
	//拒绝所有
	$(document).on('click', '.refuseAll', function(){
		var offerIds = '';
		var goods_id = $(this).attr( 'goods_id' );
		$(this).parents('.reply').find('.money-icon').each(function(){
			var _offerId = $(this).attr('offer_id');
			offerIds += _offerId+',';
		});
		
		if( offerIds == '' )
		{
			return;
		}
		
		var page = $(this).parents('.reply').attr('page');
		
		$('#alertBox').dialog({
			autoOpen: false, 
			width: 296,
			modal: true,
			title: '',
			buttons: [{
				text: '\u786e\u5b9a', //确定
				click: function() {	
					$.ajax({
						url:'/ajax/seller-offer-refuseall',
						type:"get",
						cache:false,
						data:{ 'goodsId':goods_id, 'offerIds':offerIds },
						dataType:'json',
						success:function( data ){
							if( data.flag == 1 )
							{
								getOffer( goods_id, page );
								
								$('#alertBox').dialog("close");
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
		
		$('#alertMsg').html('确认拒绝该商品下全部议价？');
		
		$('#alertBox').dialog('open');
	});
	
	//刷新主商品信息
	function flushGoods( goods_id )
	{
		$.ajax({
			url:'/user/getOfferInfo',
			type:"get",
			cache:false,
			data:{ 'goodsId':goods_id },
			dataType:'json',
			success:function( data ){
				if( data.flag == 1 )
				{	
					var str = '';
					
					if( data.data.is_saled == 2 )
					{	
						if( data.data.is_more )
						{
							str += '<span class="link agreed">全部售出</span>';
						}
						else
						{
							str += '<span class="link agreed">已售出</span>';
						}
						
						str += '<span class="link tip">请到已售出商品查看</span>';
					}
					else
					{
						if( data.data.notread > 0 )
						{
							str += '<span class="link-tip">'+data.data.notread+'条新议价</span>';
						}
						else
						{
							str += '<span class="link-tip total-tip">收到'+data.data.all+'条议价</span>';
						}
					}
					
					$('#offer'+goods_id).find('.cell4 .links').html(str);
				}
			}
		});
	}
})



//;(function(){
//	 $('.sub-table .price-wrap .money-icon').each(function() {
//		 $(this).parents('.price-wrap').click(function(){
//			 $(this).toggleClass('price-hover');
//		 })
//	 });
//
//	 $('.sub-table .user-wrap').each(function() {
//		 $(this).hover(function(){
//			 $(this).toggleClass('reputation-hover');
//		 })
//	 });
// }())
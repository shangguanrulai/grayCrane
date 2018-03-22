var cityData;

$(function(){
	newGoodsObj.init();

	function fillcity(id, keycity, arr )
	{			
		var city = arr[id];
		
		var cityStr = '<option value="0">市/县/区</option>';
		
		$.each(city.city,function(k,v){
			cityStr += '<option value="'+v.region_id+'">'+v.region_name+'</option>';
		})
		
		$(keycity).html(cityStr);
	}
	
	$.ajax({
		dataType:'json',
        url: city_url,
        data:{"act":'region'},
        cache:false,
        success: function(data){
        	if( data.code == 1 )
        	{
        		var cityData = data.item;
        		
        		var provinceStr = '<option value="0">省/直辖市</option>';
        		
        		$.each(cityData,function(k,v){
        			provinceStr += '<option value="'+v.region_id+'">'+v.region_name+'</option>';
        		});
        		
        		$('#province').html(provinceStr);
        		$('#province').change(function(){
        			var id = $(this).val();
        			
        			fillcity(id,'#city', cityData);
        		});
        		
        		$('#mprovince').html(provinceStr);
        		$('#mprovince').change(function(){
        			var id = $(this).val();
        			
        			fillcity(id,'#mcity', cityData);
        		});
        	}
        }
	});
	
	
	
	//初始化弹层
	_initErrorDialog();
	
	//jsError('test');
	
	//提交订单按钮
	$('#ordersubmit').click(function(){
		//收货人信息
		var addressid = $('#addressList .selected-item').attr('addressid');
		
		if( !addressid )
		{
			jsError('请选择收货人地址');
			return;
		}

		var ajaxparam = {'goodsids':''};
		var num = 0;

		if( newGoodsObj.isNew() )
		{
			num = $( '#goodList .newGoodsNum' ).val();
			ajaxparam.num = num;
		}
		else
		{
			//商品信息
			$('#goodList li').each(function(k,v){
				var goodsid = $(this).attr('goodsid');
				//ajaxparam.goodsids.push(goodsid);
				ajaxparam.goodsids += goodsid+',';
				++num;
			});
		}

		if( num == 0 )
		{
			jsError('订单无商品');
			return;
		}
		
		ajaxparam.addressId = addressid;
		ajaxparam.act = 'addOrder';
		
		//优惠券
		ajaxparam.couponid = $('#coupon').val();
		
		//给卖家留言
		ajaxparam.message = $('#message').val();
		
		//主商品ID
		ajaxparam.goodsid = main_goodsid;

		//判断是否为租赁
		if( typeof( rentConfig ) != 'undefined' )
		{
			ajaxparam.stime = rentConfig.stime;
			ajaxparam.etime = rentConfig.etime;
		}
		
		//return;
		
		$.ajax({
			type:'get',
			dataType:'json',
	        url: ajax_url,
	        data:ajaxparam,
	        cache:false,
	        success: function(data){
				if( newGoodsObj.isNew() )
				{
					if( data.flag == 1 )
					{
						var url = data.data.url;

						window.location = url;
					}
					else if( data.flag == -10 )
					{
						newGoodsObj.emptyGoodsJump();
					}
					else if( data.flag == -4 )
					{
						$( '#goodList .counter-bar-box' ).attr( 'quantity', data.data.quantity );
						newGoodsObj.checkMax();
						newGoodsObj.checkQuantity();
						newGoodsObj.tidyPrice();
						newGoodsObj.coupon();
					}
					else
					{
						jsError(data.msg);
					}
				}
				else
				{
					if( data.flag == 1 )
					{
						var url = data.data.url;

						window.location = url;
					}
					else
					{
						jsError(data.msg);
					}
				}
	        }
		});
	});
	
	$('#perfectsubmit').click(function(){
		//收货人信息
		var addressid = $('#addressList .selected-item').attr('addressid');
		
		if( !addressid )
		{
			jsError('请选择收货人地址');
			return;
		}
		
		var ajaxparam = {};
		
		ajaxparam.addressId = addressid;
		ajaxparam.act = 'perfectOrder';
		
		//优惠券
		ajaxparam.couponid = $('#coupon').val();
		
		//给卖家留言
		ajaxparam.message = $('#message').val();
		
		//主商品ID
		ajaxparam.orderid = orderid;
		
		//return;
		
		$.ajax({
			type:'get',
			dataType:'json',
	        url: ajax_url,
	        data:ajaxparam,
	        cache:false,
	        success: function(data){
	        	if( data.flag == 1 )
	        	{
	        		var url = data.data.url;
	        		
	        		window.location = url;
	        	}
	        	else
	        	{
	        		jsError(data.msg);
	        	}
	        }
		});
	});
	
	var selectAddLen = $('#addressList .selected-item').length;
	
	if( selectAddLen == 0 )
	{
		$('#addressList .address-item').eq(0).addClass('selected-item').find('.address-tag').click();
	}
	
	var addLen = $('#addressList .address-item').length;
	
	if( addLen == 0 )
	{
		$('#addAddressButton').click();
	}
});

var newGoodsObj = {
	'init':function(){
		if( !this.isNew() )
		{
			return;
		}

		var quantityBox = $( '#goodList .counter-bar-box' );

		var quantity = quantityBox.attr( 'quantity' );

		if( quantity <= 0 )
		{
			this.emptyGoodsJump();
			return;
		}

		this.checkQuantity();
		this.bindQuantity();
		this.valChange();
	},
	'isNew':function(){
		if( typeof( isNew ) == 'undefined' )
		{
			return false;
		}

		if( isNew == 1 )
		{
			return true;
		}
		else
		{
			return false;
		}
	},
	'checkQuantity':function(){
		var quantityBox = $( '#goodList .counter-bar-box' );

		var quantity = quantityBox.attr( 'quantity' );
		var val = quantityBox.find( 'input' ).val();
		var disabledClass = 'disabled';

		quantity = parseInt( quantity );
		val = parseInt( val );

		if( val >= quantity )
		{
			quantityBox.find( '.increase-icon' ).addClass( disabledClass );
		}
		else
		{
			quantityBox.find( '.increase-icon' ).removeClass( disabledClass );
		}

		if( val <= 1 )
		{
			quantityBox.find( '.reduce-icon' ).addClass( disabledClass );
		}
		else
		{
			quantityBox.find( '.reduce-icon' ).removeClass( disabledClass );
		}
	},
	'bindQuantity':function(){
		$( '#goodList .increase-icon,.reduce-icon' ).click( function(){
			if( $(this).hasClass('disabled') )
			{
				return;
			}

			var val = $( this ).parent().find( 'input' ).val();

			if( $(this).hasClass('increase-icon') )
			{
				++val;
			}
			else
			{
				--val;
			}

			$( this ).parent().find( 'input' ).val( val );

			newGoodsObj.checkQuantity();

			newGoodsObj.tidyPrice();

			newGoodsObj.coupon();
		} );
	},
	'emptyGoodsJump':function(){
		var box = $( '.sellout-layerbox' );

		box.show();

		var time = box.find( '.countdown-bar span' ).html();

		setInterval( function(){
			if( time > 0 )
			{
				--time;
			}

			var jumpTime = time;

			box.find( '.countdown-bar span' ).html( time );

		}, 1000 );

		setTimeout( function(){
			window.location.href = main_goods_url;
		}, time * 1000 );
	},
	'valChange':function(){
		$( document ).on( 'keyup blur change', '#goodList .newGoodsNum', function( event ){
			var box = $( this );
			var val = box.val();

			if( val.length == 1 )
			{
				val = val.replace( /[^1-9]/g, '' );
			}
			else
			{
				val = val.replace( /[^0-9]/g, '' );
				val = val.replace( /^0+/g, '' );
			}

			if( event.type == 'change' || event.type == 'focusout' )
			{
				if( val == '' )
				{
					val = 1;
				}

				if( val <= 0 )
				{
					val = 1;
				}
			}

			box.val( val );

			if( val != '' )
			{
				newGoodsObj.checkQuantity();
			}

			if( event.type == 'change' || event.type == 'focusout' )
			{
				newGoodsObj.checkMax();
				newGoodsObj.checkQuantity();
				newGoodsObj.tidyPrice();
				newGoodsObj.coupon();
			}
		} );
	},
	'tidyPrice':function(){
		var price = 0;

		var box = $( '#goodList .price' );

		var price = box.attr( 'price' );

		var num = box.parents( 'li' ).find( 'input' ).val();

		var totalMoney = price * num;

		box.parents( 'li' ).find( '.goods-total-box' ).html( '&yen; '+number_format( totalMoney, 2 ) );
		$( '#totalprice' ).html(  '&yen;'+number_format( totalMoney, 2 ) );
		$( '#totalprice' ).attr( 'totalprice', number_format( totalMoney, 2 ) );

		var couponMoney = $( '#coupon option:selected' ).attr( 'money' );

		$( '#realityprice' ).html( '&yen;'+number_format( totalMoney - couponMoney, 2 ) );
		$( '.goods-count' ).html( num + '件商品' );
	},
	'checkMax':function(){
		var box = $( '#goodList .newGoodsNum' );

		var val = parseInt( box.val() );
		var max = parseInt( box.parent().attr( 'quantity' ) );

		if( val > max )
		{
			box.val( max );
			$( '.counter-bar-layer' ).show();
			setTimeout( function(){
				$( '.counter-bar-layer' ).hide();
			}, 2000 );
		}
	},
	'coupon':function( data ){
		var box = $('#coupon');

		if( typeof( data ) != 'undefined' )
		{
			this.couponArr = data;
		}
		else
		{
			data = this.couponArr;
		}

		var str = '<option money="0.00" value="0">请选择您要使用的优惠券</option>';
		var totalMoney = parseFloat( $( '#totalprice' ).attr( 'totalprice' ) );

		$.each(data,function(k,v){
			if( parseFloat( v.min_money ) <= totalMoney )
			{
				str += '<option money="'+v.money+'" min_money="'+v.min_money+'" value="'+v.couponId+'">'+v.name+'</option>';
			}
		});

		$('#coupon').html(str);

		selectMax();
	}
};
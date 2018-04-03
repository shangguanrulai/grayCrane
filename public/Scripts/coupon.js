//获取优惠券
$(function(){
	getCoupon();
})

//选择优惠券
$('#coupon').change(function(){
	var money = $(this).find('option:selected').attr('money');
	$('#privilege').html('&yen;'+money);
	$('#privilege').attr('price',money);
	
	var nowprice = $('#totalprice').attr('totalprice') - money;
	nowprice 	 = price_format(nowprice);
	
	$('#realityprice').html(nowprice);
});

function getCoupon()
{	
	if( coupontype == 0)
	{
		var num = 0;

		if( newGoodsObj.isNew() )
		{
			var goodsids = '0';
			num = 100000;
		}
		else
		{
			var goodsids = '';

			$('#goodList li').each(function(){
				goodsids += $(this).attr('goodsid')+',';
			});

			goodsids = goodsids.substr(0,goodsids.length-1);
		}

		$.ajax({
			dataType:'json',
	        url: ajax_url,
	        cache:false,
	        async:false,
	        data:{	"act":'getCoupon',
	        		'goodsids':goodsids,
	        		'goodsid':main_goodsid,
	        		'type':coupontype,
					'num':num,
	        	},
	        success: function(data){
	        	if(data.flag == 1)
	        	{
					if( newGoodsObj.isNew() )
					{
						newGoodsObj.coupon( data.data );

						return;
					}

	        		var str = '<option money="0.00" value="0">请选择您要使用的优惠券</option>';
	        		
	        		$.each(data.data,function(k,v){
	        			str += '<option money="'+v.money+'" min_money="'+v.min_money+'" value="'+v.couponId+'">'+v.name+'</option>'
	        		});
	        		
	        		$('#coupon').html(str);

					selectMax();
	        	}
	        }
		});
	}
	else if( coupontype == 1 )
	{
		var goodsids = '';
		
		$.ajax({
			dataType:'json',
	        url: ajax_url,
	        cache:false,
	        data:{	"act":'getCoupon',
	        		'goodsids':goodsids,
	        		'goodsid':orderid,
	        		'type':coupontype,
	        	},
	        success: function(data){
	        	if(data.flag == 1)
	        	{	
	        		var str = '<option money="0.00" value="0">请选择您要使用的优惠券</option>';
	        		
	        		$.each(data.data,function(k,v){
	        			str += '<option money="'+v.money+'" min_money="'+v.min_money+'" value="'+v.couponId+'">'+v.name+'</option>'
	        		});
	        		
	        		$('#coupon').html(str);

					selectMax();
	        	}
	        }
		});
	}
	
	
}

function selectMax()
{
	$('#coupon option').each(function(){
		var money = $(this).attr('money');

		if( money > 0 )
		{
			$(this).attr( 'selected',true );
			$('#coupon').change();
			return false;
		}
	});
}
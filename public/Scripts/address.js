var cityData;

$(function(){
	
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
	
	$('.setDefault').click(function(){
		var addressid   = $(this).attr('addressid');
		var default_box = $(this);
		
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
	        		$('.defaulttext').hide();
	        		$('.setDefault').show();
	        		default_box.parent().find('.defaulttext').show();
	        		default_box.parent().find('.setDefault').hide();
	        	}
	        }
		});
	});
	
	//初始化弹层
	_initErrorDialog();
	
	//添加收货人地址弹层
	$("#addressAddDialog").dialog({
		autoOpen: false, 
		width: 650,
		modal: true,
		title: '\u65b0\u589e\u6536\u8d27\u4eba\u4fe1\u606f', //新增收货人信息
		buttons: [{
			text: '\u4fdd\u5b58\u6536\u8d27\u4eba\u4fe1\u606f', //保存收货人信息
			'class': 'save-button',
			click: function() {
				var add_box = this;
				
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
			        		window.location.reload(true);
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
	
	//点击增加地址按钮
	$('.address-add').click(function(){
		resetAdd();
		$('#addressAddDialog').dialog("open"); 
	});
	
	function resetAdd()
	{
		$('#consignee,#address,#phone_mob,#phone_tel,#zipcode').val('');
		$('#province option[value=0]').attr('selected','selected');
		$('#city option[value=0]').attr('selected','selected');
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
	
	//删除收货地址
	$('.delAddress').click(function(){
		var addressid = $(this).attr('addressid');
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
	        		$(del_box).parents('.address-box').remove();
	        	}
	        }
		});
	});
	
	//编辑收货人地址弹层
	$("#addressModifyDialog").dialog({
		autoOpen: false, 
		width: 650,
		height: 400, 
		modal: true,
		title: '\u7f16\u8f91\u6536\u8d27\u4eba\u4fe1\u606f', //编辑收货人信息
		buttons: [{
			text: '\u4fdd\u5b58\u6536\u8d27\u4eba\u4fe1\u606f', //保存收货人信息
			'class': 'save-button',
			click: function() {
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
				
				console.log(  $('.y-center-address').children().eq(currentIndex).find('.updateAddress') );
				
				var addressid = $('.y-center-address').children().eq(currentIndex).find('.updateAddress').attr('addressid');
				
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
			        		var box = $('.y-center-address').children().eq(currentIndex);
			        		
			        		box.find('.consignee').html(data.data.consignee);
			        		box.find('.province_text').html(data.data.province_name+' - '+data.data.city_name);
			        		box.find('.address_text').html(data.data.address);
			        		box.find('.phone_mob').html(data.data.phone_mob);
			        		box.find('.phone_tel').html(data.data.phone_tel);
			        		box.find('.zipcode').html(data.data.zipcode);
			        		box.find('.name_text').html(data.data.consignee);
			        		box.find('.province_big').html(data.data.province_name);
			        		
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
	
	//编辑收货地址
	$('.updateAddress').click(function(){
		currentIndex = $(this).parents('.address-box').index();
		var addressid = $(this).attr('addressid');
		
		$.ajax({
			dataType:'json',
	        url: ajax_url,
	        cache:false,
	        data:{	"act":'getAddress',
		        	'addressId':addressid,
	        	},
	        success: function(data){
	        	if( data.flag == 1 )
	        	{	
	        		$('#mconsignee').val(data.data.consignee);//收货人
					$('#maddress').val(data.data.address);//收货地址
					$('#mphone_tel').val(data.data.phone_tel);//固定电话
					$('#mphone_mob').val(data.data.phone_mob);//移动电话
					$('#mzipcode').val(data.data.zipcode);//邮编
					$('#mprovince option[value='+data.data.province_id+']').attr('selected','selected');
					$('#mprovince').change();
					$('#mcity option[value='+data.data.city_id+']').attr('selected','selected');
					$('#addressModifyDialog').dialog("open"); 
	        	}
	        }
		});
	});
	
	//关闭添加地址栏
	$( "#addressAddDialog,#addressModifyDialog" ).on( "dialogclose", function( event, ui ){
		$('.address-items .tip').hide();
		resetAdd();
	});
});
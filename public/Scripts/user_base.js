//年月日的联动
function getyear(id, day){
	var  y=$("#year").val();
	if(0==y%4 && (y%100 !=0 || y%400 == 0)){
		if(2==id){
			$("#day").empty();
			var html='<option>日期</option>';
			//var html = '';
			for(var i=1;i<=29;i++){
				if(i == day){
					html +='<option value='+i+' selected="selected">'+i+'</option>';
				}else{
					html +='<option value='+i+'>'+i+'</option>';
				}
			}
			$(html).appendTo("#day");

		}else if(1==id || 3==id || 5==id ||7==id || 8==id ||10==id || 12==id){
				$("#day").empty();
				var html='<option>日期</option>';
				//var html = '';
				for(var i=1;i<=31;i++){
					if(i == day){
						html +='<option value='+i+' selected="selected">'+i+'</option>';
					}else{
						html +='<option value='+i+'>'+i+'</option>';
					}
				}
				$(html).appendTo("#day");

			} else if(4==id || 6==id || 9==id || 11==id){
			$("#day").empty();
			var html='<option>日期</option>';
				//var html = '';
				for(var i=1;i<=30;i++){
					if(i == day){
						html +='<option value='+i+' selected="selected">'+i+'</option>';
					}else{
						html +='<option value='+i+'>'+i+'</option>';
					}
				}
				$(html).appendTo("#day");

			}
		}else{
			if(2==id){
				$("#day").empty();
				var html='<option>日期</option>';
				//var html = '';
				for(var i=1;i<=28;i++){
					if(i == day){
						html +='<option value='+i+' selected="selected">'+i+'</option>';
					}else{
						html +='<option value='+i+'>'+i+'</option>';
					}
				}
				$(html).appendTo("#day");

			}else if(1==id || 3==id || 5==id ||7==id || 8==id ||10==id || 12==id){
				$("#day").empty();
				var html='<option>日期</option>';
				//var html = '';
				for(var i=1;i<=31;i++){
					if(i == day){
						html +='<option value='+i+' selected="selected">'+i+'</option>';
					}else{
						html +='<option value='+i+'>'+i+'</option>';
					}
				}
				$(html).appendTo("#day");

			}else if(4==id || 6==id || 9==id || 11==id){
			$("#day").empty();
				var html='<option>日期</option>';
				//var html='';
				for(var i=1;i<=30;i++){
					if(i == day){
						html +='<option value='+i+' selected="selected">'+i+'</option>';
					}else{
						html +='<option value='+i+'>'+i+'</option>';
					}
				}
				$(html).appendTo("#day");

			}
			}
}

//省市的二级联动
function get_city(id, host, cityId){
	$.ajax({
		type:'get',
		url: host + 'ajax/ajaxRestUserInfo.php',
		data:'from='+'city'+'&id='+id+'&n='+Math.random(),
		dataType:'json',
		success:function(data){
			$("#city").empty();
			var html='<option value="0">选择城市</option>';
			$.each(data,function(key,val){
				if(val['id'] == cityId){
					html +='<option value='+val['id']+' selected="selected">'+val['name']+'</option>';
				}else{
					html +='<option value='+val['id']+'>'+val['name']+'</option>';
				}
			})
			$(html).appendTo("#city");
		}
	});
}



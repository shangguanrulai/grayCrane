$(function(){
	//初始化弹层
	_initErrorDialog();
	
	(function(){
		//翻页
		(function(){
			var target = $('#pageBar'),
				tot	   = parseInt(target.attr('data-total'),10),
				btn	   = target.find('.button'),
				input  = target.find('.jump-page input');

			btn.off().on('click',function(){
				var val = parseInt($(input).val().toString(),10);
				if (!$.isNumeric(val) || val <= 0 || val > tot) return false;

                if (/\d+/.test(window.location.pathname)){
                    var url = window.location.pathname.replace(/\d+/,val);// + window.location.search.toString();
                }else {
                    var url = window.location.pathname + '/' +val;
                }
				window.location.href = url;
			});

		})();
	})()
	
	//回复评论弹层
	$("#postlog").dialog({
		autoOpen: false, 
		width: 470,
		modal: true,
		title: '回复评价', //新增收货人信息
//		buttons: [{
//			text: '\u4fdd\u5b58\u6536\u8d27\u4eba\u4fe1\u606f', //保存收货人信息
//			'class': 'save-button',
//			click: function() {
//				
//			}
//		}],
		buttons:[{
			text:'回复',
			click: function(){
				var content = $('#postEvaluationContent').val();
				
				$.ajax({
					dataType:'json',
			        url: post_evaluation_url,
			        type:'post',
			        cache:false,
			        data:{
			        	'eId':eId,
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
			}
		},
		{
			text:'取消',
			click: function(){
				$('#postlog').dialog("close");
			}
		}]
	});
	
	$('.hf').click(function(){
		var _eId = $(this).attr('eid');
		eId = _eId;
		
		$('#postlog').dialog("open");
	});
	 
});
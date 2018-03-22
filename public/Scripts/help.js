$(function(){
	//tan切换
	$('.J_switchTab').on('mouseenter mouseout', '.J_item', function() {
		$(this).addClass('current-item').siblings('.J_item').removeClass('current-item');
		$(this).parents('.J_switchTab').find('.J_tabPanel[id=' + $(this).attr('rel') + ']').show().siblings('.J_tabPanel').hide();
	});

	//右侧步骤效果
	if($('#accordion')){
		$('#accordion').accordion({
			heightStyle: "content",
		});
	}
	
	$('#accordion').accordion('option', 'active', showBox);
});
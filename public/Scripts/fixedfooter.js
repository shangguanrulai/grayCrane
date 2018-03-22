 /**
 * @Description: the script of 底部吸顶
 * @authors: hanjw (han.jingwei@fengniao.com)
 * @date   : 2015-12-28 11:12:28
 * @version: 1.0
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

var resizeTimer = null; 
$(window).resize(function() { 
	if (resizeTimer) clearTimeout(resizeTimer); 
	resizeTimer = setTimeout(fixedFooterFn(), 50); 
});
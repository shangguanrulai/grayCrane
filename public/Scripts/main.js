/**
 * @fileoverview Description of file, its uses and information about its dependencies.
 * @author wang.yan@fengniao.com on 2016/2/22.
 * @version 1.0
 */
function aaa() {
    var $h = $('#box')[0].offsetHeight + $('#foot')[0].offsetHeight;
    var $bodyH = $('body')[0].offsetHeight;
    if( $h > $bodyH - 30 ){
        $('#box').removeClass('wrapper-box');
        $('#foot').removeClass('foot-box');
    }else{
        $('#box').addClass('wrapper-box');
        $('#foot').addClass('foot-box');
    }
}
window.onresize = function () {
    aaa()
};




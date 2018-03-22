/**
 * @user jin.xiao@fengniao.com
 * @desc: 说明
 * @date: 2017/3/23 16:01
 */


if (!$.support.leadingWhitespace || /msie 9/.test(navigator.userAgent.toLowerCase())) {
    document.documentElement.className += ' lowIE';
    var selLow = document.getElementsByTagName('select');
    if(selLow.length>0){
        for(var i=0; i<selLow.length; i++){
            selLow[i].className += ' lowIESel';
        }
    }
}

var projectDomin = "https://my.fengniao.com/";

//分页使用方法
if(document.getElementById('goto')){
    document.getElementById('goto').onclick = function() {
        var gotopage = document.getElementById('gotoval').value;
        window.location.href = changeURLArg(window.location.href,'page',gotopage);
    };
}


function changeURLArg(url,arg,arg_val){
    var pattern=arg+'=([^&]*)';
    var replaceText=arg+'='+arg_val;
    if(url.match(pattern)){
        var tmp='/('+ arg+'=)([^&]*)/gi';
        tmp=url.replace(eval(tmp),replaceText);
        return tmp;
    }else{
        if(url.match('[\?]')){
            return url+'&'+replaceText;
        }else{
            return url+'?'+replaceText;
        }
    }
    return url+'\n'+arg+'\n'+arg_val;
}


//关注
$('.follow').click(function () {
    //$(this).unbind();


    var userId = $(this).attr('uid');

    ajaxUser(userId, 1, $(this));

});

//取消关注
$('.reFollow').click(function () {
    //$(this).unbind();

    var userId = $(this).attr('uid');

    ajaxUser(userId, 2, $(this));


});

var followClick = true;

//关注ajax
function ajaxUser(userId, type, __this) {
    if(!followClick) return false;
    followClick = false;
    setTimeout(function () {
        $.ajax({
            type: 'POST',
            url: projectDomin+"ajax/ajaxFollowAction.php",
            dataType: "json",
            data: 'userId=' + userId   + '&type='+type,
            success: function(data) {

                if(data.code == 1){
                    __this.unbind();
                    if(type == 1){

                        //在他的首页点关注现实关注， 先用 父级class判断
                        if(__this.parent().attr('class') == "others"){
                            __this.html("已关注");
                            __this.attr("class", "btn2");
                        }else{
                            if(__this.attr('class') == 'recentlyA follow'){
                                __this.html("已关注");
                                __this.attr("class", "recentlyA");
                            }else{
                                __this.html("取消关注");
                                __this.attr("class", "btn reFollow");
                                __this.click(function () {
                                    ajaxUser(userId, 2, __this);
                                });
                            }
                        }

                    }else{
                        __this.html("+ 关注");
                        __this.attr("class", "btn2 follow");
                        __this.click(function () {
                            ajaxUser(userId, 1, __this);
                        });
                    }
                }else{
                    alert(data.msg);
                }
                followClick = true;

            }
        });
    }, 200);
}


//发私信
$('#sendLetter').click(function () {

    var messageContent = $('#messageContent').val();
    var userId = $('#uid').val();
    var userName = $('#uname').val();
    if(!$.trim(userName)){
        userName = $('#tousername').val();
    }
    if(!messageContent){
        alertMessage("消息不能为空", 2);
    }
    if(!$.trim(userName)){
        alertMessage("收件人不可为空", 2);
    }

    $.ajax({
        type: 'POST',
        url: projectDomin+"ajax/ajaxMessage.php",
        dataType: "json",
        data: 'f_userid=' + userId   + '&nickname='+userName + '&invite_content=' + messageContent +'&action=sendMessage',
        success: function(data) {

            if(data.code == 1){
                alertMessage("发送成功", 1);

                $('#letter').hide();
            }else{

                alertMessage(data.msg, 2);
            }
        }
    });

});

//删除私信
$('.delete-tag').click(function (event) {

    var messageId = $(this).attr("messageId");
    var type = $(this).attr("type");

    var __this = $(this);
    event.stopPropagation();
    $.ajax({
        type: 'POST',
        url: projectDomin+"ajax/ajaxMessage.php",
        dataType: "json",
        data: 'id=' + messageId + '&id=' + messageId   + '&action=delete',
        success: function(data) {

            if(data.code == 1){
                //alert("删除成功");
                alertMessage('删除成功', 1);
                __this.parent().parent().parent().remove();
            }else{
                //alert(data.msg);
                alertMessage(data.msg, 2);
            }
        }
    });

});


/*//私信对话框
$('.letterBtn').click(function () {
    console.log($(this).attr("uName"));
    $('#toUserName').html($(this).attr("uName"));

    $('#uid').val($(this).attr("uid"));
    $('#uname').val($(this).attr("uName"));

    $('#letter').show();
});*/

function closeAlert() {
    $('#letter').hide();
    $('#toUserName').html('');
    $('#uid').val('');
    $('#uname').val('');
    $('#messageContent').val('');
}


//私信对话框
$('.letterBtn').click(function () {
    $('.firstP').html("<font>发给：</font><em id='showUserName'></em>");
    var userName = $(this).attr('userName');
    var userUserId = $(this).attr('userId');

    $('#showUserName').html(userName);
    $('#uid').val($(this).attr("userId"));
    $('#uname').val($(this).attr("userName"));
    $('#messageContent').val("");
    $('#letter').show();

});

//私信对话框  点击发私信
$('.send-message').click(function () {
    $('.firstP').html("<font>发给：</font><input type='text' name='tousername' id='tousername'></input>");
    $('#uid').val('');
    $('#uname').val('');
    $('#messageContent').val('');
    $('#letter').show();
});

//私信输入框字数控制
function textUp() {
    var s = $('#messageContent').val();
    if (s.length > 300) {
        document.getElementById('messageContent').value = s.substring(0, 300);
    }
    $('#wordNum').html(s.length+'/');
}


/**
 * 统一提示框
 * @param message
 * @param type
 */
function alertMessage(message, type) {

    if(document.getElementById('showStatus')) return false;

    var className = '';
    if(type == 1) className = 'tips-success';
    if(type == 2) className = 'tips-error';

    var html = '<div id="showStatus" class="'+className+'" style="z-index: 999">'+message+'</div>';
    $('body').append(html);
    $('#showStatus').css('width', message.length*16 + 10*2);

    setTimeout(function () {
        $('#showStatus').remove();
    }, 1000)

}
/**
 * 
 * Created by jiabowen on 2017/7/18.
 */


;$(function () {

    $.extend({
        IMReminder : {
            status  : false
            ,timerArr: false
            ,show : function() { //有新消息时在title处闪烁提示
                if(this.status == true) {
                    return;
                }

                var step=0, _title = document.title;
                var timer = setInterval(function() {
                    step++;
                    if (step==3) {step=1};
                    if (step==1) {document.title='【 　　　　　　　　】'+_title};
                    if (step==2) {document.title='【 您有新的未读消息】'+_title};
                }, 500);

                this.status = true;
                this.timerArr = [timer, _title];

                return [timer, _title];
            }
            ,clear : function() {    //去除闪烁提示，恢复初始title文本
                if(this.timerArr) {
                    clearInterval(this.timerArr[0]);
                    document.title = this.timerArr[1];
                    this.status = false;
                }
            }
            //play sound
            ,play : function () {
                var borswer = window.navigator.userAgent.toLowerCase();
                if ( borswer.indexOf( "ie" ) >= 0 ) {
                    //IE内核浏览器
                    var strEmbed = '<embed name="embedPlay" src="http://www.gongqinglin.com/accessory/ding.wav" autostart="true" hidden="true" loop="false"></embed>';
                    if ($( "body" ).find( "embed" ).length <= 0) $( "body" ).append( strEmbed );
                    var embed = document.embedPlay;

                    //浏览器不支持 audion，则使用 embed 播放
                    embed.volume = 100;
                } else {
                    //非IE内核浏览器
                    var strAudio = "<audio id='audioPlay' src='http://www.gongqinglin.com/accessory/ding.wav' hidden='true'>";
                    if ($( "body" ).find( "audio" ).length <= 0) $( "body" ).append( strAudio );
                    var audio = document.getElementById( "audioPlay" );
                    //浏览器支持 audion
                    audio.play();
                }
            }
        }
    });

    
    $.get('/im/init',{},function (html) {
        if (!html) return ;
        $('body').append(html);

        var $init = $('#IM-init-layer'),
            $number = $init.find('#IM-init-number');

        
        //waiting for web_socket.js
        setTimeout(function () {
            // Write your code in the same way as for native WebSocket:
            var ws = new WebSocket(socketCfg.domain),
                userId = socketCfg.userId,
                csrf = socketCfg.csrf,
                client = '',
                reTimer = null;

            //提醒初始化
            if (socketCfg.unread > 0) {
                reTimer = $.IMReminder.show();
            }

            //im交互的操作方法集合
            var actions = {
                //bind client_id with userid
                "bind" : function (json) {
                    client = json.client_id;
                    $.get('/im/bind',{'client_id' : json.client_id},function () {
                        if (parseInt($number.attr('data-read'),10) > 0) {
                            $number.html('<i class="icon animationing"></i>您有新的未读消息');
                        }else {
                            $number.html('<i class="icon"></i>我的联系人')
                        }
                        $number.removeClass('disabled');
                        $('#globalIMstarter').show();
                    });
                }

                //message
                ,"chat" : function (json) {
                    var remaind = false;
                    //msg (li) ,friends
                    var $layer = $('#IM-chat-layer'),
                        $list  = $('#IM-chat-list'),
                        $main  = $('#IM-chat-dialog');

                    //最小化
                    var minimize = !$init.is(":hidden") && $layer.length > 0 ? true : false;

                    if ($layer.length <= 0) {
                        //私信框隐藏状态
                        remaind = true;
                    }else {
                        $main.find('span.history-link').hide();

                        if (!json.sender && $list.find('[data-userid="' + json.friends.userid + '"]').length <= 0) {
                            $list.prepend(json.calling);
                            // number['total'] += 1; number['online'] += 1;
                        }
                        var $row = $list.find('[data-userid="' + json.friends.userid + '"]');

                        //当前会话直接插入dom
                        if ($row.hasClass('current')) {
                            $main.find('ul.chat-text').append(json.msg);
                            $main.tinyscrollbar();
                            $main.data("plugin_tinyscrollbar").update('bottom');
                            
                            //非最小化时 将回显的这条信息标记为已读
                            if (!minimize && !json.sender) {
                                var id = json.msg.toString().match(/data-id="(\d+)"/);
                                id && $.post('/im/mark-read', {'id': id[1], 't': (new Date()).getTime(),"_csrf" : csrf});
                            }
                            
                            remaind = (minimize && !json.sender) ? true : false;
                        }else {
                            remaind = true;
                            //提醒未读数量等
                            if (json.unread) {
                                $row.find('.num-tag').text(json.unread).show();
                                $row.find('.newer').show();
                            }
                        }


                        //接收者将新对话移动到第一个
                        if (!json.sender && $row.length > 0) {
                            $row.detach().prependTo($list);
                        }

                        //处理来源
                        if (!json.sender && json.source) {
                            var source = JSON.parse(json.source);
                            if (source.id > 0 && source.name !== '') {
                                $layer.find('div.source-link').html('来源：<a href="'+source.url+'">' + source.name+ '</a>');
                            }else {
                                $layer.find('div.source-link').text('来源：对话');
                            }
                        }
                    }
                    
                    if (!json.sender && remaind === true) {
                        $number.html('<i class="icon animationing"></i>您有新的未读消息');
                        reTimer = $.IMReminder.show();
                        $.IMReminder.play();
                    }
                }

                //标记已读
                ,"mark_read" : function (json) {
                    var $list = $('#IM-chat-list'),
                        $cur  = $list.find('[data-userid="'+json.friends+'"]');

                    $cur.find('.num-tag').hide();
                    $cur.find('.newer').hide();
                    reTimer !== null && $.IMReminder.clear(reTimer);
                    $number.html('<i class="icon"></i>我的联系人');
                }

                /*
                //更新联系人和在线人数
                ,"update_number" : function (json) {
                    number['online'] = json.number[0];
                    number['total']  = json.number[1];
                    $number.html('<i class="icon"></i> 联系人(' + json.number[0] + '/' + json.number[1] + ')');
                }*/

                //logout notify all
                ,"logout"   : function (json) {
                    client = json.client_id;
                    $init.is(':hidden') && $.get('/im/logout',{'client_id' : json.client_id},function () {});
                }

                //get notify,modify dom
                ,"offline" : function (json) {
                    return this.state_handler(json,'off');
                }

                ,"online" : function (json) {
                    return this.state_handler(json,'on');
                }

                //handler for offline & online
                ,"state_handler" : function (json,type) {
                    //json.user
                    var $layer = $('#IM-chat-layer'),
                        $friends = $('#IM-chat-list');

                    var tit = type === 'off' ? '离线' : '在线';
                    if ($layer.length > 0 && $friends.length > 0) {
                        var $row = $friends.find('li[data-userid="'+json.user+'"]');
                        if ($row.length > 0) {
                           $row.find('i.status').attr('title',tit);
                           if (type === 'off') {
                               $row.find('i.status').addClass('offline');
                           }else {
                               $row.find('i.status').removeClass('offline');
                           }
                           // $number.html('<i class="icon"></i> 联系人(' + number['online'] + '/' + number['total'] + ')');
                        }
                    }

                }
            };

            
            
            ws.onopen = function() {};
            ws.onmessage = function(message) {
                //message.data 是返回信息
                var json = JSON.parse(message.data);
                if (json) {
                    var type = json.type || '';
                    type === 'ping' && ws.send('ping'); //heartbeat
                    typeof actions[type] === "function" && actions[type](json);
                    // type !== 'ping' && console.info(message.data);
                }
                
            };
            ws.onclose = function() {};
            
            //get-friends-list
            var getFriends = function (relation,$target) {
                var params = {"_csrf" : csrf,"t" : (new Date()).getTime()},
                    $layer = $('#IM-chat-layer');
                if (relation !== null) {
                    params.url = $target.attr('data-url');
                    params.friends = relation;
                    $layer.fadeOut().remove();
                }else {
                    //最小化点开,回显,标记已读
                    if ($layer.length > 0){
                        $layer.show();
                        var $main = $layer.find('#IM-chat-dialog'),
                            $friends = $layer.find('#IM-chat-list');
                        $main.tinyscrollbar();
                        $main.data("plugin_tinyscrollbar").update('bottom');

                        //当前会话都标记已读
                        params.friends = $friends.find('li.current').attr('data-userid');
                        $.post('/im/mark-read',params);
                        return ;
                    }
                    
                }
                
                return getFriendsList(params);
            }
            
            var getFriendsList = function (params) {
                var page = 2, empty = false, loading = false;
                $number.mLoading();
                $.post('/im/get-list',params,function (html) {
                    $init.fadeOut();
                    $('body').append(html);
                    $number.mLoading('hide');

                    var $layer  = $('#IM-chat-layer'),
                        $header = $('#IM-chat-header'),
                        $search = $('#IM-chat-search'),
                        $side = $('#IM-chat-sidebar'),
                        $friends = $('#IM-chat-list'),
                        $main = $('#IM-chat-dialog'),
                        $container = $('#IM-chat-main'),
                        $title     = $header.find('.privateLetter-title'),
                        $conversation = $main.find('ul.chat-text'),
                        $content = $layer.find('#IM-chat-content'),
                        $uploader= $('#IM-chat-uploader'),
                        $submit = $layer.find('.submit-button');

                    $side.tinyscrollbar();
                    $main.tinyscrollbar() && $main.data("plugin_tinyscrollbar").update('bottom');

                    var scroller = $side.data("plugin_tinyscrollbar");
                    $side.on('move',function () {

                        if (scroller.contentPosition >= (scroller.contentSize - scroller.viewportSize) - 5){
                            if (!empty && !loading) {
                                $side.mLoading();
                                loading = true;
                                params.page = page;
                                $.post('/im/get-more-list', params, function (json) {
                                    if (json.info == 'ok') {
                                        $friends.append(json.msg);
                                        scroller.update('relative');
                                        page++;
                                    } else {
                                        empty = true;
                                    }
                                    $side.mLoading('hide');
                                    loading = false;
                                },'json');
                            }
                        }
                    })
                    //search
                    $search.on('keyup','input',function (event) {
                        var query = $(this).val();
                        if (query !== '') $(this).next().show();
                        
                        $friends.find('li').each(function (idx,ele) {
                            if ($(ele).attr('data-name') && $(ele).attr('data-name').toLowerCase().indexOf(query.toLowerCase()) >= 0) {
                                $(ele).show();
                            }else {
                                $(ele).hide();
                            }
                        });

                        if (event.keyCode === 13) {
                            $.post('/im/search-user',{"_csrf" : csrf,"t" : (new Date()).getTime(),"query" : query},function (json) {
                                if (json.info == 'err') {
                                    ($friends.find('li.empty-item').length > 0) 
                                        ? $friends.find('li').hide().filter('li.empty-item').show()
                                        : $friends.append('<li class="empty-item clearfix"><i class="empty-icon"></i><span>无搜索结果</span></li>');
                                    $side.data("plugin_tinyscrollbar").update('top');
                                }else {
                                    $friends.find('li[data-name="'+query+'"]').length <= 0 && $friends.append(json.msg);
                                }
                            },'json');
                        }

                        $side.data("plugin_tinyscrollbar").update();
                    }).on('click','span.closed-icon',function () {
                        $(this).hide().prev().val('');
                        $friends.find('li.empty-item').hide();
                        $friends.find('li[data-userid]').show();
                        $friends.find('li.current').detach().prependTo($friends);
                        $side.data("plugin_tinyscrollbar").update();
                    });

                    //get dialog
                    $friends.on('click','li[data-userid]',function () {
                        if ($(this).hasClass('current')) {return false;}

                        //dom
                        $(this).addClass('current').siblings().removeClass('current');

                        var source = $(this).attr('data-source') ? JSON.parse($(this).attr('data-source')) : null;
                        $title.text('正在与'+$(this).attr('data-name')+'对话');
                        if (source !== null && source.id > 0 && source.name !== '') {
                            $container.find('div.source-link').html('来源：<a href="'+source.url+'">' + source.name+ '</a>');
                        }else {
                            $container.find('div.source-link').text('来源：对话');
                        }
                        $container.find('i.inner-masrk').hide();
                        
                        //loading
                        $container.mLoading({'text' : '加载中...'});

                        //关闭提醒
                        $.IMReminder.clear(reTimer);
                        $conversation.empty();
                        params.friends = $(this).attr('data-userid');
                        
                        $.post('/im/get-dialog',params,function (json) {
                            var $link = $main.find('span.history-link'), //以上是历史消息
                                $more = $main.find('span.more-link'); //更多消息
                            
                            if (json.info === 'ok') {
                                if (json.msg) {
                                    json.options['has_more'] ? $more.show() : $more.hide();
                                    $conversation.html(json.msg);
                                    $main.tinyscrollbar();
                                    $main.data("plugin_tinyscrollbar").update('bottom');
                                }else {
                                    $more.hide();
                                }

                                json.options['is_today'] || !json.msg ? $link.hide() : $link.show();
                            }
                            $container.mLoading('hide');
                        },'json')
                        
                    //del friends
                    }).on('click','li .delete-btn',function (event) {
                        event.stopPropagation();
                        var $row = $(this).parent();
                        params.friends = $row.attr('data-userid');
                        
                        if ($row.hasClass('current')) {
                            $title.text('');
                            $container.find('i.inner-masrk').show();
                        }

                        $.post('/im/del-friends',params,function (json) {
                            if (json.info === 'ok') $row.remove();
                        },'json');
                    });

                    //del btn
                    $friends.on('mouseenter','li',function () {
                        $(this).find('.delete-btn').show();
                    }).on('mouseleave','li',function () {
                        $(this).find('.delete-btn').hide();
                    });
                    
                    //more message
                    $main.on('click','span.more-link',function () {
                        var $self = $(this);
                            // $conversation = $main.find('ul.chat-text');
                        
                        params.id = $conversation.children(":eq(0)").attr('data-id');
                        params.friends = $friends.find('li.current').attr('data-userid');
                        $.post('/im/get-more-dialog',params,function (json) {
                            if (json.info === 'ok') {
                                if (json.msg) {
                                    json.options['has_more'] ? $self.show() : $self.hide();
                                    $conversation.prepend(json.msg);
                                    $main.tinyscrollbar();
                                    $main.data("plugin_tinyscrollbar").update('relative');
                                }else {
                                    $self.hide();
                                }
                                
                            }
                        },'json')
                        
                    });
                    
                    //enter send
                    $content.on('keyup',function (event) {
                        if (event.keyCode === 13) {
                            $.trim($content.val()) && $submit.trigger('click');
                        }
                    });

                    //send
                    $submit.on('click',function () {
                        var $self = $(this),$to = $side.find('li.current');
                        if ($self.hasClass('sending')) return false;

                        if ($to.length <= 0 || !$.trim($content.val())) {return FnApp.errorJs('私信内容不能为空');}

                        $self.addClass('sending');
                        params.friends = $to.attr('data-userid');
                        params['content'] = $content.val();
                        params['client']  = client;
                        $content.val('');
                        $.post('/im/chat', params,function (json) {
                            $self.removeClass('sending');
                        },'json');
                    });

                    //关闭
                    $header.on('click','.closed-button',function () {
                        $layer.remove();
                        !$number.find('i').hasClass('animationing') && $number.html('<i class="icon"></i> 我的联系人');
                        $init.fadeIn();
                    //最小化
                    }).on('click','.newChat-button',function () {
                        if ($friends.find('li.current').length > 0) {
                            var tip = '与' + $friends.find('li.current').attr('data-name') + '对话中';
                            $number.html('<i class="icon"></i>' + tip);
                        }
                        $layer.hide();
                        $init.fadeIn();
                    });
                    
                    //paste upload (only support chrome)
                    window.addEventListener && $content[0].addEventListener("paste",function (event) {
                        // event.clipboardData;
                        if (event.clipboardData && event.clipboardData.items && event.clipboardData.items[0].type.indexOf('image') > -1) {
                            var image = event.clipboardData.items[0].getAsFile();
                            var form  = new FormData;
                            form.append('_csrf',csrf);
                            form.append('friends',$friends.find('li.current').attr('data-userid'));
                            form.append('imageFile',image);
                            
                            $submit.text('上传中...').addClass('sending');
                            $.ajax({
                                url  : $uploader.attr('action'),
                                type : 'POST',
                                cache: false,
                                data : form,
                                processData: false,
                                contentType: false
                            }).done(function(json) {
                                $submit.text('发送').removeClass('sending');
                                if (json && json.info === 'err') {
                                    alert(json.msg);
                                }
                            });
                            
                        }
                    })

                    $uploader.on('change','input[type="file"]',function () {
                        var $to  = $friends.find('li.current');

                        if ($to.length <= 0) return false;
                        $uploader.find('input[name="friends"]').val($to.attr('data-userid'));

                        $uploader.ajaxForm({
                            dataType : 'json',
                            complete : function (data) {
                                if (data.responseText) {
                                    var json = JSON.parse(data.responseText);

                                    if (json && json.info === 'err') {
                                        alert(json.msg);
                                    }
                                }
                            }
                        }).submit();
                    });
                });
            }
            
            $init.on('click',$number,function(){
                if($number.hasClass('disabled')) return false;
                //列表显示
                return getFriends(null,null);
            });

            //类名包括sendPrivateLetterBtn,直接触发
            $(document).on('click','.sendPrivateLetterBtn',function () {
                var userid = parseInt($(this).attr('userid'),10);
                if (!userid) return false;
                if (userid == userId) {
                    typeof jsError === 'function' && jsError('不能和自己对话~');
                    return false;
                }
                return getFriends(userid,$(this));
            //公共头
            }).on('click','#globalIMstarter',function (event) {
                event.preventDefault();
                return getFriends(null,null);
            });

        },2000);
    });
});
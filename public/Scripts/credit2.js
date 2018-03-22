var credit = {
    'init':function() {
        this.showFlipLightBox();
        this.getDate();

        $(window).scroll( function() {
            credit.loadMore();
        });
    },
    // 'showsesameCredit':function() {
    //     $("#sesameCreditDialog").dialog({
    //         autoOpen: false,
    //         title: '系统提示',
    //         width: 460,
    //         modal: true,
    //         dialogClass: 'sesame-credit-dialog',
    //         buttons: [{
    //             text: '去授权',
    //             class: 'confirm-button',
    //             click: function() {
    //                 window.location = '/user/zmxy?click_source=detail';
    //             }
    //         }, {
    //             text: '取消',
    //             class: 'cancel-button',
    //             click: function() {
    //                 $(this).dialog("close");
    //             }
    //         }]
    //     });
    //
    //     $("#sesameCreditShowDialog").dialog({
    //         autoOpen: false,
    //         width: 460,
    //         height: '360',
    //         modal: true,
    //         dialogClass: 'sesame-credit-show-dialog',
    //         buttons: []
    //     });
    //
    //     // 若已经验证，则需要添加样式名"certified"
    //     $('#sesameCreditShow').on('click', function() {
    //         $(this).hasClass('certified') ? $("#sesameCreditShowDialog").dialog("open") : $("#sesameCreditDialog").dialog("open");
    //     });
    // },
    'showFlipLightBox':function() {
        $( document ).on('click', '.comment-slider .pic-item', function() {
            var thisSrc = $(this).find('img').attr('src');
            $('body').css('overflow', 'hidden');
            $('#gallery').show();
            $('#gallery').find('#galleryImg').attr('src', thisSrc);
            return false;
        });

        $( document ).on('click', '#gallery .closed-button', function() {
            $('#gallery').find('#galleryImg').attr('src', '');
            $('body').css('overflow', 'visible');
            $('#gallery').hide();
        });
    },
    'loadMore':function(){
        var totalheight = parseFloat($(window).height()) + parseFloat($(window).scrollTop());     //浏览器的高度加上滚动条的高度
        if ($(document).height() <= totalheight + 200 )     //当文档的高度小于或者等于总的高度的时候，开始动态加载数据
        {
            credit.getDate();
        }
    },
    'getDate':function()
    {
        if( this.isLoad || this.canLoad == false )
        {
            return;
        }

        this.isLoad = true;

        $.ajax({
            url:'/credit/get-data',
            data:{
                type:creditConfig.type,
                userId:creditConfig.userId,
                page:credit.page
            },
            dataType:'json',
            cache:false,
            success:function( data )
            {
                $( '#boxList' ).append( data.data.html );

                credit.canLoad = data.data.canLoad;
                credit.isLoad = false;
                credit.page += 1;

                if( credit.canLoad == false && $( '#boxList li' ).length == 0 )
                {
                    $( '.credit-switch' ).append( '<div class="empty-box">暂无任何' + creditConfig.typeStr[ creditConfig.type ] + '记录</div>' );
                }
            }
        });
    },
    'canLoad':true,
    'isLoad':false,
    'page':1
};

var followObj = {
    'init':function()
    {
        this.bindEvent();
        this.getStatus();
    },
    'bindEvent':function()
    {
        this.follow();
    },
    'follow':function()
    {
        $('#creditFollowBtn').click(function(){
            var className = 'collected';

            if( $( this ).hasClass( 'collected' ) )//取消收藏
            {
                $.ajax({
                    dataType:'json',
                    url: '/goods/ajax',
                    cache:false,
                    data:{
                        "act":'cancel_seller_collect',
                        'seller_id':creditConfig.userId
                    },
                    success: function(data)
                    {
                        if( data.code == 1 )
                        {
                            $( '#creditFollowBtn' ).removeClass( className );
                        }
                        else if( data.code == -1 )
                        {
                            quickLogin();
                        }
                        else
                        {
                            FnApp.errorJs( data.msg );
                        }
                    }
                });
            }
            else//加入收藏
            {
                $.ajax({
                    dataType:'json',
                    url: '/goods/ajax',
                    cache:false,
                    data:{
                        "act":'seller_collect',
                        'seller_id':creditConfig.userId
                    },
                    success: function(data)
                    {
                        if( data.code == 1 )
                        {
                            $( '#creditFollowBtn' ).addClass( className );
                        }
                        else if( data.code == -1 )
                        {
                            quickLogin();
                        }
                        else
                        {
                            FnApp.errorJs( data.msg );
                        }
                    }
                });
            }
        });
    },
    'getStatus':function()
    {
        $.ajax({
            dataType:'json',
            url: '/goods/ajax',
            cache:false,
            data:{
                "act":'seller_attention',
                'seller_id':creditConfig.userId
            },
            success: function(data)
            {
                if( data.code == 1 )
                {
                    if( data.item.is_collect == 1 )
                    {
                        $( '#creditFollowBtn' ).addClass( 'collected' );
                    }
                }
            }
        });
    }
};

var sesameObj = {
    'init':function()
    {
        this.bindEvent();
    },
    'bindEvent':function()
    {
        this.showSesame();
    },
    'showSesame':function()
    {
        $("#sesameCreditShowDialog").dialog({
            autoOpen: false,
            width: 460,
            modal: true,
            dialogClass: 'sesame-credit-show-dialog',
            buttons: []
        });

        var sesame = parseInt( $( '#sesameCreditShow' ).attr( 'sesame' ) , 10);

        //查看芝麻信用分数 add by hanjw 20170721 num 必定为整数
        if($('#sesameBoard').length > 0 && $('#lowSesameBoard').length > 0){
            !$('html').hasClass('lowIE') ? SesameCreditCicrle(sesame) : lowSesameCreditCicrle(sesame);
        }

        $( '#sesameCreditShow' ).click( function(){
            if( creditConfig.visitorSesame )
            {
                $("#sesameCreditShowDialog").dialog("open");
            }
            else
            {
                $("#sesameCreditDialog").dialog({
                    autoOpen: false,
                    title: '系统提示',
                    width: 460,
                    modal: true,
                    dialogClass: 'sesame-credit-dialog',
                    buttons: [{
                        text: '去授权',
                        'class': 'confirm-button',
                        click: function() {
                            window.location = creditConfig.sesameUrl;
                        }
                    }, {
                        text: '取消',
                        'class': 'cancel-button',
                        click: function() {
                            $(this).dialog("close");
                        }
                    }]
                }).dialog("open");
            }
        } );
    }
};

//调用
$(function(){
    credit.init();

    followObj.init();

    sesameObj.init();
});
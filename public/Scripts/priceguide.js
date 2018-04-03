/** 
 * @Description: the script 二手交易详情页
 * @authors: hanjw (han.jingwei@fengniao.com)
 * @date：    2015-11-05 11:46:33
 * @version： 1.0
 */
function priceGuideFn(){ 
	function detailPriceGuideDialog1Fn() {
                $.cookie('detailPriceDialog', 'true',{ expires: 3000 });
                if($.cookie().detailPriceDialog != 'true'){  
                    $("#detailPriceGuideDialog1").dialog({
                        autoOpen: false,
                        width: 755,
                        height: 310,
                        modal: true,
                        dialogClass: "no-header guide-dialog detailPriceGuide-Dialog1",
                        buttons:[{
                            text: '\u5173\u95ed', //关闭 
                            'class': 'closed-button',
                            click: function() {
                                $(this).dialog("close");
                            }
                        },{
                            text: '\u4e0b\u4e00\u6b65', //下一步 
                            'class': 'next-button',
                            click: function() {
                                $(this).dialog("close");
                                $('#detailPriceGuideDialog2').dialog("open");

                                var oLeft2 = ($(window).width() - 1030)/2 + 52 +'px',
                                    oTop2 = $('.product-disucuss').offset().top -13 +'px';
                                $('.detailPriceGuide-Dialog2').css({
                                    'left' : oLeft2,
                                    'top' : oTop2
                                });
                            }
                        }] 
                    }); 

                    var oLeft = ($(window).width() - 1030)/2 + 260 +'px',
                        oTop = $('#shareBtn').offset().top - 10 +'px';
                    $('.detailPriceGuide-Dialog1').css({
                        'left' : oLeft,
                        'top' : oTop
                    }); 

                    $.cookie('detailPriceDialog', 'true',{ expires: 30 });
                }
            }

            //一口价详情页引导层弹层2 
            (function detailPriceGuideDialog2Fn() {   
                $("#detailPriceGuideDialog2").dialog({
                    autoOpen: false,
                    width: 879,
                    height: 402,
                    modal: true,
                    dialogClass: "no-header guide-dialog detailPriceGuide-Dialog2",
                    buttons:[{
                        text: '\u5173\u95ed', //关闭 
                        'class': 'closed-button',
                        click: function() {
                            $(this).dialog("close");
                        }
                    },{
                        text: '\u4e0b\u4e00\u6b65', //下一步 
                        'class': 'next-button',
                        click: function() {
                            $(this).dialog("close");
                            $('#detailPriceGuideDialog3').dialog("open");

                            var oLeft3 = ($(window).width() - 1030)/2 + 234 +'px',
                                oTop3 = $('.product-disucuss').offset().top - 6 +'px';
                            $('.detailPriceGuide-Dialog3').css({
                                'left' : oLeft3,
                                'top' : oTop3
                            });
                        }
                    }] 
                });  
            })();

            //一口价详情页引导层弹层3 
            (function detailPriceGuideDialog3Fn() {   
                $("#detailPriceGuideDialog3").dialog({
                    autoOpen: false,
                    width: 558,
                    height: 343,
                    modal: true,
                    dialogClass: "no-header guide-dialog detailPriceGuide-Dialog3",
                    buttons:[{
                        text: '\u5173\u95ed', //关闭 
                        'class': 'closed-button',
                        click: function() {
                            $(this).dialog("close");
                        }
                    },{
                        text: '\u4e0b\u4e00\u6b65', //下一步 
                        'class': 'next-button',
                        click: function() {
                            $(this).dialog("close");
                            $('#detailPriceGuideDialog4').dialog("open");

                            var oLeft4 = ($(window).width() - 1030)/2 + 115 + 'px',
                                oTop4 = $('.message-section').offset().top - 144 + 'px';
                            $('.detailPriceGuide-Dialog4').css({
                                'left' : oLeft4,
                                'top' : oTop4
                            });
                        }
                    }] 
                });  
            })();

            //一口价详情页引导层弹层4 
            (function detailPriceGuideDialog4Fn() {   
                $("#detailPriceGuideDialog4").dialog({
                    autoOpen: false,
                    width: 899,
                    height: 499,
                    modal: true,
                    dialogClass: "no-header guide-dialog detailPriceGuide-Dialog4",
                    buttons:[{
                        text: '\u5173\u95ed', //关闭 
                        'class': 'closed-button',
                        click: function() {
                            $(this).dialog("close");
                        }
                    },{
                        text: '\u4e0b\u4e00\u6b65', //下一步 
                        'class': 'next-button',
                        click: function() {
                            $(this).dialog("close");
                            $('#detailPriceGuideDialog5').dialog("open");

                            var oLeft5 = ($(window).width() - 1030)/2 +'px',
                                oTop5 = $('#productGallery').offset().top - 20 +'px';
                            $('.detailPriceGuide-Dialog5').css({
                                'left' : oLeft5,
                                'top' : oTop5
                            });
                        }
                    }] 
                });  
            })();

            //一口价详情页引导层弹层5
            (function detailPriceGuideDialog5Fn() {   
                $("#detailPriceGuideDialog5").dialog({
                    autoOpen: false,
                    width: 1004,
                    height: 674,
                    modal: true,
                    dialogClass: "no-header guide-dialog detailPriceGuide-Dialog5",
                    buttons:[{
                        text: '\u5173\u95ed', //关闭 
                        'class': 'closed-button',
                        click: function() {
                            $(this).dialog("close");
                        }
                    },{
                        text: '\u4e0b\u4e00\u6b65', //下一步 
                        'class': 'next-button',
                        click: function() {
                            $(this).dialog("close");
                            $('#detailPriceGuideDialog6').dialog("open");
                            
                            if($('#buyAuctionButton').length > 0){
                            	oHeight = $('#buyAuctionButton').offset().top;
                            }else{
                            	oHeight = $('#buy-button').offset().top;
                            }
                            
                            var oLeft6 = ($(window).width() - 1030)/2 + 140 +'px',
                                oTop6 = oHeight - 90 +'px';
                            $('.detailPriceGuide-Dialog6').css({
                                'left' : oLeft6,
                                'top' : oTop6
                            });
                        }
                    }] 
                });  
            })();

            //一口价详情页引导层弹层6
            (function detailPriceGuideDialog6Fn() {   
                $("#detailPriceGuideDialog6").dialog({
                    autoOpen: false,
                    width: 778,
                    height: 342,
                    modal: true,
                    dialogClass: "no-header guide-dialog detailPriceGuide-Dialog6",
                    buttons:[{
                        text: '\u5173\u95ed', //关闭 
                        'class': 'closed-button',
                        click: function() {
                            $(this).dialog("close");
                        }
                    },{
                        text: '\u4e0b\u4e00\u6b65', //下一步 
                        'class': 'next-button',
                        click: function() {
                            $(this).dialog("close");
                            $('#detailPriceGuideDialog7').dialog("open");

                            var oLeft7 = ($(window).width() - 1030)/2 + 204 +'px',
                                oTop7 = $('#bidPriceButton').offset().top - 170  +'px';
                            $('.detailPriceGuide-Dialog7').css({
                                'left' : oLeft7,
                                'top' : oTop7
                            });
                        }
                    }] 
                });  
            })();

            //一口价详情页引导层弹层7
            (function detailPriceGuideDialog7Fn() {   
                $("#detailPriceGuideDialog7").dialog({
                    autoOpen: false,
                    width: 670,
                    height: 415,
                    modal: true,
                    dialogClass: "no-header guide-dialog detailPriceGuide-Dialog7",
                    buttons:[{
                        text: '\u5173\u95ed', //关闭 
                        'class': 'closed-button',
                        click: function() {
                            $(this).dialog("close");
                        }
                    },{
                        text: '\u4e0b\u4e00\u6b65', //下一步 
                        'class': 'next-button',
                        click: function() {
                            $(this).dialog("close"); 
                        }
                    }] 
                });  
            })();
}

setTimeout(function(){
	priceGuideFn()
},1500); 
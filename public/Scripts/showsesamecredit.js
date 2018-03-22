/**
 * @description : the script of 查看芝麻信用等级
 * @authors : hanjw (hanjw@fengniao.com)
 * @date :  2017-07-21 17:07:18
 * @version : 1.0
 */
// 函数调用 其中 num 必需为数字类型
// !$('html').hasClass('lowIE') ? SesameCreditCicrle(num) : lowSesameCreditCicrle(num);

// 低版本浏览器显示情况
function lowSesameCreditCicrle(num){
    if(typeof(num) !== 'number'){
        return false;
    }

    var lowSesameBoard = $('#lowSesameBoard'),
        fractionTag = lowSesameBoard.find('.fraction-tag'),
        gradeTag = lowSesameBoard.find('.grade-tag');

    fractionTag.text(num)

    if (num < 550) {
        gradeTag.text('信用较差');
        lowSesameBoard.css('color' , '#ff0000');
    } else if (num < 600) {
        gradeTag.text('信用中等');
        lowSesameBoard.css('color' , '#ff612b');
    } else if (num < 650) {
        gradeTag.text('信用良好');
        lowSesameBoard.css('color' , '#ffc513');
    } else if (num < 700) {
        gradeTag.text('信用优秀');
        lowSesameBoard.css('color' , '#71de4d');
    } else {
        gradeTag.text('信用极好');
        lowSesameBoard.css('color' , '#1de078');
    }

    $('#sesameBoard').hide();
    $('#lowSesameBoard').show();

}

// 标准浏览器显示情况
function SesameCreditCicrle(num) {
    $('#sesameBoard').show();
    $('#lowSesameBoard').hide();

    var canvas = document.getElementById('clock');
    var ctx = canvas.getContext('2d'),
        img = new Image();

    img.src = "../images/sesame-credit/circle.png";
    img.onload = function() {
        ctx.drawImage(img, -148, -150);
    }
    // 绘制外环
    ctx.beginPath();
    ctx.arc(170, 170, 160, 20 / 180 * Math.PI, 160 / 180 * Math.PI, true);
    ctx.strokeStyle = '#31d890';
    ctx.lineWidth = '3'
    ctx.stroke();
    ctx.closePath();
    // 绘制内环
    ctx.beginPath();
    ctx.arc(170, 170, 110, 20 / 180 * Math.PI, 160 / 180 * Math.PI, true);
    ctx.strokeStyle = '#fff';
    ctx.lineWidth = '12';
    ctx.stroke();
    ctx.closePath();
    ctx.translate(170, 170);
    // 绘制刻度
    var total = [350, '较差', 550, '中等', 600, '良好', 650, '优秀', 700, '极好', 950];

    // 绘制文本
    ctx.font = '';
    ctx.fillStyle = '#8dc9f8';
    ctx.textAlign = 'center';
    ctx.textBaseline = 'bottom';
    ctx.rotate((-7.5 * 15) / 180 * Math.PI);
    for (var i = 0; i < 11; i++) {
        ctx.fillStyle = i % 2 ? '#333' : '#333';
        ctx.fillText(total[i], -0, -118);
        ctx.rotate((7.5 * 3) / 180 * Math.PI);
    }
    ctx.rotate(-7.5 * 18 / 180 * Math.PI);
    ctx.fillStyle = '#333';
    ctx.font = '14px normal';
    ctx.fillText('信用度', 0, -60);

    // 绘制动画需要重置幕布，所以重建一个canvas对象
    var pointer = document.getElementById('pointer');
    var ctxPoint = pointer.getContext('2d');

    function run(inputValue) {
        var timer;
        var i = 0;
        ctxPoint.translate(170, 170);

        // 设置最终的值
        var finalValue = inputValue;
        var value = 0;
        // 根据值的大小确定应该到达的位置
        if (finalValue < 550) {
            value = (finalValue - 316.7) * 0.225;
        } else if (finalValue < 700) {
            value = (finalValue - 550) * 0.9 + 52.5;
        } else {
            value = finalValue > 1000 ? 1000 : finalValue;
            value = (value - 700) * 0.18 + 187.5;
        }
        var evluate = '';
        if (inputValue < 550) {
            evluate = '较差'
        } else if (inputValue < 600) {
            evluate = '中等';
        } else if (inputValue < 650) {
            evluate = '良好';
        } else if (inputValue < 700) {
            evluate = '优秀';
        } else {
            evluate = '极好';
        }
        ctxPoint.font = '60px bold';
        ctxPoint.textAlign = 'center';

        if (inputValue < 550) {
            ctxPoint.fillStyle = '#ff0000';
            ctxPoint.strokeStyle = '#ff0000';
            ctxPoint.shadowColor = '#ff0000';
        } else if (inputValue < 600) {
            ctxPoint.fillStyle = '#ff612b';
            ctxPoint.strokeStyle = '#ff612b';
            ctxPoint.shadowColor = '#ff612b';
        } else if (inputValue < 650) {
            ctxPoint.fillStyle = '#ffc513';
            ctxPoint.strokeStyle = '#ffc513';
            ctxPoint.shadowColor = '#ffc513';
        } else if (inputValue < 700) {
            ctxPoint.fillStyle = '#71de4d';
            ctxPoint.strokeStyle = '#71de4d';
            ctxPoint.shadowColor = '#71de4d';
        } else {
            ctxPoint.fillStyle = '#1de078';
            ctxPoint.strokeStyle = '#1de078';
            ctxPoint.shadowColor = '#1de078';
        }

        // 所有的动画事件

        function slideValue() {
            ctxPoint.translate(-170, -170);
            ctxPoint.clearRect(0, 0, pointer.width, pointer.height);
            ctxPoint.translate(170, 170);
            i++;
            // 绘制滚动元素
            ctxPoint.beginPath();
            ctxPoint.shadowBlur = 10;
            ctxPoint.arc(-160 * Math.sin((i + 60) / 180 * Math.PI), 160 * Math.cos((i + 60) / 180 * Math.PI), 5, 0, 2 * Math.PI, true);
            ctxPoint.fillStyle = '#333';
            ctxPoint.fill();
            ctxPoint.arc(-160 * Math.sin((i + 60) / 180 * Math.PI), 160 * Math.cos((i + 60) / 180 * Math.PI), 3, 0, 2 * Math.PI, true);

            if (inputValue < 550) {
                ctxPoint.fillStyle = '#ff0000';
            } else if (inputValue < 600) {
                ctxPoint.fillStyle = '#ff612b';
            } else if (inputValue < 650) {
                ctxPoint.fillStyle = '#ffc513';
            } else if (inputValue < 700) {
                ctxPoint.fillStyle = '#71de4d';
            } else {
                ctxPoint.fillStyle = '#1de078';
            }
            ctxPoint.fill();

            // 填充分数和评分
            ctxPoint.font = '60px bold';
            var text = 0;
            if (i < 52.5) {
                text = i / 0.225 + 316.7;
            } else if (i < 187.5) {
                text = (i - 52.5) / 0.9 + 550;
            } else {
                text = (i - 187.5) / 0.18 + 700;
                text = text > 1000 ? 1000 : text;
            }
            text = text > inputValue ? inputValue : text;
            ctxPoint.shadowBlur = 0;
            ctxPoint.fillText(parseInt(text, 10), 0, 10);
            ctxPoint.stroke();
            ctxPoint.font = '30px bold';

            if (inputValue < 550) {
                ctxPoint.fillStyle = '#ff0000';
            } else if (inputValue < 600) {
                ctxPoint.fillStyle = '#ff612b';
            } else if (inputValue < 650) {
                ctxPoint.fillStyle = '#ffc513';
            } else if (inputValue < 700) {
                ctxPoint.fillStyle = '#71de4d';
            } else {
                ctxPoint.fillStyle = '#1de078';
            }

            ctxPoint.stroke();
            ctxPoint.closePath();
            // 如果到达所需要的弧度，则停止，否则继续跳动
            if (i > value) {
                setTimeout(function() {
                    ctxPoint.font = '20px bold';
                    ctxPoint.fillText('信用' + evluate, 0, 40);
                }, 200);
                clearTimeout(timer);
            } else {
                timer = setTimeout(slideValue, text / finalValue * 15);
            }
        }
        slideValue();
    }
    // 打开页面时默认的跳动数字

    typeof(num) === 'number' ? run(num) : run(0);
}
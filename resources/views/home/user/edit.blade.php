@extends('home.common.user_home');
@section('content')
    <style>
        .form-box .form-group .form-control {
            float: left;
            height: 41px;
            width: 178px;
            margin: 20px 10px 0 0;
            padding: 12px 10px;
            border: 1px solid #dfdfdf;
            font: normal 14px/14px 'Microsoft YaHei','\5FAE\8F6F\96C5\9ED1';
        }
        .dvs{
            float: left;
            height: 41px;
            width: 178px;
            margin: 20px 10px 0 0;
            padding: 9px 10px;

        }
    </style>

    <form action="">
    <div class="y-center-main-right mtop20">
    <div class="panel password-panel" id="setPassword">
        <div class="panel-header clearfix">
            <h3 class="panel-title">请完善个人信息</h3>
            {{--<span class="sub-title"></span>--}}
        </div>
        <div class="step-box" id="step1">
            <ul class="form-box">
                <li class="form-group clearfix">
                    <label for="passWord3" class="control-label">登录账号：</label>
                    <span class="control-text mobile-number">{{$user->uname}}</span>
                    {{--<span class="modify-link"><a href="/user/setting?act=newphone">
                             [修改认证]</a></span>--}}
                </li>
                <li class="form-group clearfix">
                    <label for="passWord3" class="control-label">真实姓名：</label>
                    <span class="control-text mobile-number">@if($userinfo->trueName) {{$userinfo->trueName}} @else <a href="" style="color: #999;">请尽快实名认证</a> @endif</span>

                </li>
                <li class="form-group clearfix">
                    <label for="passwd1" class="control-label">手机号：</label>
                    <input id="passwd1" type="text" class="form-control" value="{{$user->phone}}" name="phone">
                    <span class="block-tip error-tip"></span>
                </li>
                <li class="form-group clearfix">
                    <label for="passwd2" class="control-label">邮箱：</label>
                    <input id="passwd2" type="text" class="form-control" value="{{$user->email}}" name="email">
                    <span class="block-tip error-tip"></span>
                </li>
                <li class="form-group clearfix">
                    <label for="passwd2" class="control-label">昵称：</label>
                    <input id="passwd2" type="text" class="form-control" value="{{$userinfo->nickname}}" name="nickname">
                    <span class="block-tip error-tip"></span>
                </li>
                <li class="form-group clearfix">
                    <label for="passwd2" class="control-label">头像：</label>
                    <div class="dvs"><input id="passwd2" type="file" name="portrait"></div>
                    <img src="{{$userinfo->portrait}}" alt="">
                    {{--<img src="/Picture/0abff2111ef32fe97acf3df53fc36f4b.jpg" style="width: 75px;height: 75px;">--}}
                    <span class="block-tip error-tip"></span>
                </li>

                {{--<li class="form-group clearfix">
                    <label for="passWord4" class="control-label">短信验证码：</label>
                    <input id="verify_code" type="text" class="form-control">
                    <button class="send-button"> 获取短信验证码</button>
                    <span class="block-tip error-tip"></span>
                </li>--}}

                <li class="form-group button-group clearfix">
                    <input type="hidden" id="phone_mob" value="16619922490">
                    <input id="submit" type="button" class="button submit-button" value="提交">
                </li>
            </ul>
        </div>
    </div>
    </form>
    <script>
        var phone = $(':input[name=phone]').val();
        var email = $(':input[name=email]').val();
        var nickname = $(':input[name=nickname]').val();
        var portrait = $(':input[name=portrait]').val();

        $(':input[name=phone]').blur(function(){

            $.get('/home/ajax/user',{phone:phone},function(data){
                console.log(data);
            });
        });



        $('#submit').click(function(){
           /* $.post();*/
        });

    </script>
    
@endsection
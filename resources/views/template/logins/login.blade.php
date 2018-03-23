<!DOCTYPE html>
<html lang="en">
{{--<script src="//cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>--}}

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Amaze UI Admin index Examples</title>
    <meta name="description" content="这是一个 index 页面">
    <meta name="keywords" content="index">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <link rel="icon" type="image/png" href="/assets/i/favicon.png">
    <link rel="apple-touch-icon-precomposed" href="/assets/i/app-icon72x72@2x.png">
    <meta name="apple-mobile-web-app-title" content="Amaze UI" />
    <link rel="stylesheet" href="/assets/css/amazeui.min.css" />
    <link rel="stylesheet" href="/assets/css/amazeui.datatables.min.css" />
    {{--<link rel="stylesheet" href="../public/bootstrap.min.css">--}}
    <link rel="stylesheet" href="/assets/css/app.css">


    <script src="/assets/js/jquery.min.js"></script>

</head>

<body data-type="login">

    <script src="/assets/js/theme.js"></script>
    <div class="am-g tpl-g">

        <div class="tpl-skiner">
            <div class="tpl-skiner-toggle am-icon-cog">

            </div>
            <div class="tpl-skiner-content">
                <div class="tpl-skiner-content-title">
                    选择主题
                </div>
                <div class="tpl-skiner-content-bar">

                    <span class="skiner-color skiner-white" data-color="theme-white"></span>
                    <span class="skiner-color skiner-black" data-color="theme-black"></span>
                </div>
            </div>
        </div>
            <div class="tpl-login-content">

                    @if (count($errors) > 0)
                        <div class="alert alert-danger"style="background:pink"  >
                            <ul>
                                @if(is_object($errors))
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                @else
                                    <li>{{ $errors }}</li>
                                @endif
                            </ul>
                        </div>
                    @endif
                <div class="tpl-login-logo">

                </div>

                <form class="am-form tpl-form-line-form" action="{{ url('templates') }}" method="post">
                    {{ csrf_field()  }}
                    <div class="am-form-group"  >

                        <input type="text" name="username" class="tpl-form-input" id="user-name" value="{{old('username')}}"placeholder="请输入账号">

                    </div>

                    <div class="am-form-group" >
                        <input type="password" name="userpass" class="tpl-form-input" id="user-name"  value="{{old('userpass')}}" placeholder="请输入密码">

                    </div>
                    <div class="am-form-group">
                        <input type="text" name="code" class="tpl-form-input" id="user-name" placeholder="验证码" style="width:125px;float:left">
                        <img src="{{ url('template') }}" onclick="this.src='{{ url('template') }}?'+Math.random()" alt="" style="width:125px;float:right;">

                    </div>
                    <div class="am-form-group tpl-login-remember-me">
                        <input id="remember-me" type="checkbox">
                        <label for="remember-me">

                            记住密码
                        </label>

                    </div>


                    <div class="am-form-group">

                        <button type="submit" class="am-btn am-btn-primary  am-btn-block tpl-btn-bg-color-success  tpl-login-btn">登录</button>

                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="/assets/js/amazeui.min.js"></script>
    <script src="/assets/js/app.js"></script>

</body>

</html>
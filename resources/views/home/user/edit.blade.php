@extends('home.common.user_home')
@section('content')
    <style>
        .form-box .form-group .form-control {
            float: left;
            height: 41px;width: 178px;
            margin: 20px 10px 0 0;padding: 12px 10px;
            border: 1px solid #dfdfdf;
            font: normal 14px/14px 'Microsoft YaHei','\5FAE\8F6F\96C5\9ED1';
        }
        .dvs{
            float: left;
            height: 41px;width: 178px;
            margin: 20px 10px 0 0;padding: 9px 10px;
        }
        .loading{
            position:relative;
            left:50px;top: -10px;
            display: block;
        }
        .unloading{
            display: none;
        }
        .layui-nav{top:-20px;}
        .fn-sec-header{top:-20px;}
    </style>


    <form action="/home/user/{{$user->uid}}" method="post" enctype="multipart/form-data" class="layui-form">
        {{ method_field('PUT') }}
        {{ csrf_field() }}
        <input type="hidden" name="_method" value="PUT">
        <input type="hidden" name="portrait" value="{{$userinfo->portrait}}">
    <div class="y-center-main-right mtop20">
    <div class="panel password-panel" id="setPassword">
        <div class="panel-header clearfix">
            <h3 class="panel-title">请完善个人信息</h3>
            {{--<span class="sub-title"></span>--}}
        </div>
        <div class="step-box" id="step1">
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li style="margin: 10px;color:#f00;background: #f2f6f9;font-size: 14px;border-radius: 2px;padding-left: 280px;">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <ul class="form-box">
                <li class="form-group clearfix">
                    <label for="passWord3" class="control-label">登录账号：</label>
                    <span class="control-text mobile-number">{{$user->uname}}</span>
                </li>
                <li class="form-group clearfix">
                    <label for="passWord3" class="control-label">真实姓名：</label>
                    <span class="control-text mobile-number">@if($userinfo->trueName) {{$userinfo->trueName}} @else <a href="/home/user/create" style="color: #999;">请尽快实名认证</a> @endif</span>

                </li>
                <li class="form-group clearfix">
                    <label for="passwd1" class="control-label">手机号：</label>
                    <input id="passwd1" type="text" class="form-control" value="{{$user->phone}}" name="phone" lay-verify="phone">
                    <span class="block-tip error-tip"></span>
                </li>
                <li class="form-group clearfix">
                    <label for="passwd2" class="control-label">邮箱：</label>
                    <input id="passwd2" type="text" class="form-control" value="{{$user->email}}" name="email" lay-verify="email">
                    <span class="block-tip error-tip"></span>
                </li>
                <li class="form-group clearfix">
                    <label for="passwd2" class="control-label">昵称：</label>
                    <input id="passwd2" type="text" class="form-control" value="{{$userinfo->nickname}}" name="nickname" lay-verify="required">
                    <span class="block-tip error-tip"></span>
                </li>
                <li class="form-group clearfix">
                    <label for="passwd2" class="control-label">头像：</label>
                    <div class="dvs">
                        <input id="file_upload" type="file" name="file_upload" style="position:relative;height: 40px;width:110px;top: -5px;opacity:0;z-index: 9999999;cursor: pointer;">
                    </div>
                    <button type="button" class="layui-btn layui-btn-danger" id="test7" style="position: relative;left: -216px;top: 20px;z-index: 1;"><i class="layui-icon"></i>上传图片</button>
                    @if($userinfo->portrait)
                        <img src="/uploads/{{$userinfo->portrait}}" id="art_thumb" style="width: 50px;height: 50px;position: relative;left:-50px;top:20px;">
                    @endif
                    <img id="art_thumb">
                    <img src="/Images/5-121204193R5-50.gif" id="loading" class="unloading">
                    <span class="block-tip error-tip"></span>
                </li>

                <script type="text/javascript">
                    $(function () {
                        $("#file_upload").change(function () {
                            uploadImage();
                        })
                    })

                    function uploadImage() {
                        //  判断是否有选择上传文件
                        var imgPath = $("#file_upload").val();

                        if (imgPath == "") {
                            alert("请选择上传图片！");
                            return;
                        }

                        $('#loading').attr('class','loading');
                        //判断上传文件的后缀名
                        var strExtension = imgPath.substr(imgPath.lastIndexOf('.') + 1);

                        if (strExtension != 'jpg' && strExtension != 'gif'
                            && strExtension != 'png' && strExtension != 'bmp') {
                            alert("请选择图片文件");
                            return;
                        }
                        // var formData = new FormData($('#art_form')[0]);
                        var formData = new FormData();
                        formData.append('fileupload',$('#file_upload')[0].files[0]);

                        $.ajax({
                            type: "POST",
                            cache: false,
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            url: "/home/ajax/userinfo",
                            data: formData,
                            contentType: false,
                            processData: false,
                            success: function(data) {
                                $('#art_thumb').attr('src', '/uploads/'+data);
                                $('#art_thumb').attr('style', 'width: 50px;height: 50px;position: relative;left:-50px;top:20px;');
                                $('#loading').attr('class','unloading');

                                $("input[name='portrait']").attr('value',data);
                            },

                            error: function(XMLHttpRequest, textStatus, errorThrown) {
                                alert("上传失败，请检查网络后重试");
                                $('#loading').attr('class','unloading');
                            }
                        });
                    }
                </script>

                {{--<li class="form-group clearfix">
                    <label for="passWord4" class="control-label">短信验证码：</label>
                    <input id="verify_code" type="text" class="form-control">
                    <button class="send-button"> 获取短信验证码</button>
                    <span class="block-tip error-tip"></span>
                </li>--}}

                <li class="form-group button-group clearfix">
                    <input id="submit" type="submit" class="layui-btn layui-btn-danger layui-btn-lg" lay-submit value="提交">
                </li>
            </ul>
        </div>
    </div>
    </form>
    </div>
    </div>


    </div>
    </div>
    <script>
        layui.use(['layer', 'form'], function(){
            var layer = layui.layer
                ,form = layui.form;
        });
    </script>
    
@endsection
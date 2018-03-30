@extends('home.common.user_home')
@section('content')
    <form action="/home/user/update_pass" method="post" class="layui-form">
        {{ csrf_field() }}
        <div class="y-center-main-right mtop20">
            <div class="panel password-panel" id="setPassword">
                <div class="panel-header clearfix">
                    <h3 class="panel-title">密码修改</h3>
                </div>
                <div class="step-box" id="step1">
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li style="margin: 10px;color:#f00;font-size: 14px;border-radius: 2px;padding-left: 280px;">{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                <div class="step-box" id="step1">
                    <ul class="form-box">
                        <li class="form-group clearfix">
                            <label for="passwd1" class="control-label">原密码：</label>
                            <input id="passwd1" type="password" class="form-control"  name="oldupass" lay-verify="required">
                            <span class="block-tip error-tip"></span>
                        </li>
                        <li class="form-group clearfix">
                            <label for="passwd2" class="control-label">新密码：</label>
                            <input id="passwd2" type="password" class="form-control"  name="upass" lay-verify="pass">
                            <span class="block-tip error-tip"></span>
                        </li>
                        <li class="form-group clearfix">
                            <label for="passwd2" class="control-label">重复输入密码：</label>
                            <input id="passwd2" type="password" class="form-control"  name="reupass" lay-verify="pass">
                            <span class="block-tip error-tip"></span>
                        </li>

                        <li class="form-group button-group clearfix">
                            <input id="submit" type="submit" lay-submit lay-filter="*" class="layui-btn layui-btn-danger layui-btn-lg" value="提交" >
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

            form.verify({
                pass: [
                    /^[\S]{6,18}$/,
                    '密码必须6到18位，且不能出现空格'
                ]
            });

            form.on('submit(*)', function(data){
                var val = data.field;
                if(val.upass !== val.reupass){
                    layer.msg('两次输入的密码不一致', {icon: 5});
                    return false;
                }

            });

        });
    </script>

@endsection
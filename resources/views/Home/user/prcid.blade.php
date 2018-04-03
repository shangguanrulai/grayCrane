@extends('home.common.user_home');
@section('content')
    <style>
        .form-box .form-group .form-control {
            float: left;
            height: 41px;width: 178px;
            margin: 20px 10px 0 0;padding: 12px 10px;
            border: 1px solid #dfdfdf;
            font: normal 14px/14px 'Microsoft YaHei','\5FAE\8F6F\96C5\9ED1';
        .layui-nav{top:-20px;}
        .fn-sec-header{top:-20px;}
    </style>

    <form action="/home/user" method="post" class="layui-form">
        {{ csrf_field() }}
        <div class="y-center-main-right mtop20">
            <div class="panel password-panel" id="setPassword">
                <div class="panel-header clearfix">
                    <h3 class="panel-title">请实名认证</h3>
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
                            <label for="passwd1" class="control-label">身份证号：</label>
                            <input id="passwd1" type="text" class="form-control" value="{{$userinfo->prcid}}" name="prcid" lay-verify="identity">
                            <span class="block-tip error-tip"></span>
                        </li>
                        <li class="form-group clearfix">
                            <label for="passwd2" class="control-label">身份证姓名：</label>
                            <input id="passwd2" type="text" class="form-control" value="{{$userinfo->trueName}}" name="trueName" lay-verify="required">
                            <span class="block-tip error-tip"></span>
                        </li>

                        <li class="form-group button-group clearfix">
                            <input id="submit" type="submit" lay-submit class="layui-btn layui-btn-danger layui-btn-lg" value="提交" >
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
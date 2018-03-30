@extends('home.common.user_home')
@section('content')
    <script type="text/javascript" src="/Scripts/address.js"></script>
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
        .layui-nav{top:-20px;}
        .fn-sec-header{top:-20px;}
    </style>


    <form action="/home/user/addr_store" method="post" class="layui-form">
        {{ csrf_field() }}
        <div class="y-center-main-right mtop20">
            <div class="panel password-panel" id="setPassword">
                <div class="panel-header clearfix">
                    <h3 class="panel-title">添加收货地址</h3>
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
                    <ul class="form-box">
                        <li class="form-group clearfix">
                            <label for="passwd1" class="control-label">收货人姓名：</label>
                            <input type="text" class="form-control" name="rec" lay-verify="required">
                        </li>
                        <li class="form-group clearfix">
                            <label for="passwd1" class="control-label">手机号：</label>
                            <input type="text" class="form-control" name="phone" lay-verify="phone">
                        </li>
                        <li class="form-group clearfix">
                            <label for="passwd1" class="control-label">邮编：</label>
                            <input type="text" class="form-control" name="code">
                            <span class="block-tip error-tip" style="color: #777">邮编可为空</span>
                        </li>
                        <li class="form-group clearfix">
                            <label for="passwd1" class="control-label">收货地址：</label>
                            <textarea class="form-control" name="addr" style="resize: none;width: 450px;" lay-verify="required"></textarea>
                        </li>

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
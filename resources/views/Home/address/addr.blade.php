@extends('home.common.user_home')
@section('content')
    <style>
        .layui-nav{top:-20px;}
        .fn-sec-header{top:-20px;}
        .layui-icon{font-size: 30px; color: #ff7733;}
    </style>

    <div class="y-center-main-right mtop20">
        <div class="panel password-panel" id="setPassword">
            <div class="panel-header clearfix">
                <h3 class="panel-title">收货地址</h3>
                <a href="/home/user/addr_create"><button class="layui-btn layui-btn-danger" style="float: right;">添加地址</button></a>
            </div>


            <table class="layui-table" lay-even="" lay-skin="nob">
                <colgroup>
                    <col width="100">
                    <col width="100">
                    <col width="100">
                    <col>
                    <col width="100">
                </colgroup>
                <thead>
                    <tr>
                        <th>收货人姓名</th>
                        <th>收货电话</th>
                        <th>邮编</th>
                        <th>收货地址</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($addr as $k=>$v)
                    <tr>
                        <td>{{$v['rec']}}</td>
                        <td>{{$v['phone']}}</td>
                        <td>{{$v['code']}}</td>
                        <td>{{$v['addr']}}</td>
                        <td>
                            <a href="/home/user/addr_edit/{{$v['aid']}}"><i class="layui-icon">&#xe642;</i></a>
                            <a class="del" aid="{{$v['aid']}}"><i class="layui-icon">&#xe640;</i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <center>{{ $addr->links() }}</center>
        </div>
    </div>

    </div>
    </div>


    <script>
        layui.use('layer', function(){
            var layer = layui.layer;

            $('.del').each(function(){
                $(this).click(function(){
                    var aid = $(this).attr('aid');

                    layer.confirm('确定删除？', {
                        btn: ['确定','取消']
                    }, function(){
                        location.href = '/home/user/addr_destroy/'+aid;
                    }, function(){

                    });
                });
            });

        });
    </script>

@endsection
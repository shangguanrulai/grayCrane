@extends('home.common.user_home')
@section('content')
    <style>
        .layui-nav{top:-20px;}
        .fn-sec-header{top:-20px;}
        .layui-icon{font-size: 20px; color: #ff7733;}
    </style>

    <div class="y-center-main-right mtop20">
        <div class="panel password-panel" id="setPassword">
            <div class="panel-header clearfix">
                <h3 class="panel-title">我购买的</h3>
            </div>
            <table class="layui-table" lay-even="" lay-skin="nob" lay-size="sm">
                <colgroup>
                    <col width="80">
                    <col width="80">
                    <col width="100">
                    <col width="100">
                    <col width="80">
                    <col width="150">
                    <col>
                    <col width="80">
                </colgroup>
                <thead>
                    <tr>
                        <th>订单号</th>
                        <th>订单时间</th>
                        <th>商品名称</th>
                        <th>商品图</th>
                        <th>价格</th>
                        <th>留言</th>
                        <th>收货地址</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($orders as $k=>$v)
                    <tr>
                        <td>{{$v['onumber']}}</td>
                        <td>{{$v['created_at']}}</td>
                        <td>{{$v['gname']}}</td>
                        <td><img src="/uploads/{{$v['gpic']}}" style="width: 100px;"></td>
                        <td>{{$v['price']}}元</td>
                        <td>{{$v['omsg']}}</td>
                        <td>{{$v['addr']}}</td>
                        <td>
                            @if($v['ostatus'] == 0)
                                <font color="#FF5722">等待发货</font>
                            @elseif($v['ostatus'] == 1)
                                <a class="status" oid="{{$v['oid']}}"> <button class="layui-btn layui-btn-danger layui-btn-sm">确认收货</button></a>
                            @elseif($v['ostatus'] == 2)
                                订单已完成
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <center>{{ $orders->links() }}</center>
        </div>
    </div>
    </div>
    </div>


    <script>
        layui.use(['layer','form'], function(){
            var layer = layui.layer;

            $('.status').each(function(){
                $(this).click(function(){
                    var oid = $(this).attr('oid');

                    layer.confirm('确定收货？', {
                        btn: ['确定','取消']
                    }, function(){
                        location.href = '/home/user/orders/take/'+oid;
                    }, function(){

                    });
                });
            });

        });
    </script>

@endsection
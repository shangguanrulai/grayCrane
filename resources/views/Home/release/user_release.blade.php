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
                <h3 class="panel-title">我的发布</h3>
            </div>
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li style="margin: 10px;color:#f00;font-size: 14px;border-radius: 2px;padding-left: 280px;">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <table class="layui-table" lay-even="" lay-skin="nob" lay-size="sm">
                <colgroup>
                    <col width="80">
                    <col width="130">
                    <col width="130">
                    <col width="80">
                    <col width="100">
                    <col width="100">
                    <col width="70">
                    <col>
                    <col width="50">
                </colgroup>
                <thead>
                    <tr>
                        <th>发布时间</th>
                        <th>商品名称</th>
                        <th>标题</th>
                        <th>联系手机</th>
                        <th>商品图</th>
                        <th>发布价格</th>
                        <th>状态</th>
                        <th>描述</th>
                        <th>删除</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($release as $k=>$v)
                    <tr>
                        <td>{{$v['created_at']}}</td>
                        <td>{{$v['gname']}}</td>
                        <td>{{$v['title']}}</td>
                        <td>{{$v['rphone']}}</td>
                        <td><img src="/uploads/{{$v['gpic']}}" style="width: 100px;"></td>
                        <td>
                            {{$v['nowprice']}}元
                           <i class="layui-icon upd" rid="{{$v['rid']}}">&#xe642;</i>
                        </td>
                        <td>
                            @if($v['status']==0)
                                <font color="#ff7733">待审核···</font>
                            @else
                                <font color="#009688">出售中···</font>
                            @endif
                        </td>
                        <td>{{$v['describe']}}</td>
                        <td>
                            <a class="del" rid="{{$v['rid']}}"><i class="layui-icon">&#xe640;</i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <center>{{ $release->links() }}</center>
        </div>
    </div>
    </div>
    </div>


    <script>
        layui.use(['layer','form'], function(){
            var layer = layui.layer;

            $('.del').each(function(){
                $(this).click(function(){
                    var rid = $(this).attr('rid');

                    layer.confirm('确定删除？', {
                        btn: ['确定','取消']
                    }, function(){
                        location.href = '/home/release/destroy_release/'+rid;
                    }, function(){

                    });
                });
            });

            $('.upd').each(function(){
                $(this).click(function(){
                    var rid = $(this).attr('rid');
                    var content = '';
                    layer.open({
                        type: 1,
                        title: false,
                        closeBtn: 0,
                        shadeClose: true,
                        skin: 'yourclass',
                        content: '<form class="layui-form layui-form-pane" action="/home/release/update_release" method="get">\n' +
                        '  <input type="hidden" name="rid" value="'+rid+'">\n' +
                        '  <div class="layui-form-item" style="height:25px;">\n' +
                        '      <button class="layui-btn layui-btn-primary" lay-submit="*">修改</button>\n' +
                        '    <div class="layui-input-inline">\n' +
                        '       <input name="nowprice" lay-verify="number" autocomplete="off" class="layui-input" type="text">\n' +
                        '    </div>\n' +
                        '  </div>\n' +
                        '</form>\n'
                    });

                });
            });




        });
    </script>

@endsection
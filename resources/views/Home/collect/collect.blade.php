@extends('home.common.user_home')
@section('content')
    <style>
        .layui-nav{top:-20px;}
        .fn-sec-header{top:-20px;}
    </style>

    <div class="y-center-main-right buy mtop20 collect-goods-box">
        <div class="collect-filter-box clearfix">
            <div class="collect-swtich-tab">
                <h3 class="panel-title">我的收藏</h3>
            </div>
        </div>
        <div class="y-center-focus mtop20">
            <dl>
                <dt>
                    <div class="row1">商品</div>
                    <div class="row2">价格</div>
                    <div class="row3">操作</div>
                </dt>

                @foreach($releases as $v)
                <dd>
                    <div class="row1 ">
                        <font><img src="/uploads/{{$v['gpic']}}"/></font>
                    </div>
                    <div class="row2  ">
                        <div class="goods-name">
                            <a status="{{$v['status']}}" class="gname" target="_blank" href="">{{$v['gname']}}</a>
                        </div>
                        <div class="goods-list-wrap clearfix">
                            <div class="y-center-goods-list">
                                <font>{{$v['title']}}</font>
                            </div>
                        </div>
                    </div>
                    <div class="row3 ">
                        <p>{{$v['nowprice']}}<font>元</font></p>
                    </div>
                    <div class="row4">
                        <p><a class="cancle_collect" id="{{$v['id']}}" >取消收藏</a></p>
                        @if($v['status'] != 1)
                            <p style="color: #f00;">该商品已售出或下架</p>
                        @endif
                    </div>
                </dd>
                @endforeach
            </dl>
            {{ $releases->links() }}
        </div>
    </div>
    </div>
    </div>
    <script>
        layui.use('layer', function(){
            var layer = layui.layer;

            $('.cancle_collect').each(function(){
                $(this).click(function(){
                    var id = $(this).attr('id');

                    layer.confirm('确定取消收藏？', {
                        btn: ['确定','取消']
                    }, function(){
                        location.href = '/home/user/collect_destroy/'+id;
                    }, function(){

                    });
                });
            });

            $('.gname').each(function(){
                $(this).click(function(){
                    var sta = $(this).attr('status');
                    if(sta != 1){
                        layer.msg('该商品已售出或下架', {icon: 5});
                        return false;
                    }
                });
            });

        });
    </script>

@endsection
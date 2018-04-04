@extends('home.common.user_home')
@section('content')
<style>
    .layui-nav{top:-20px;}
    .fn-sec-header{top:-20px;}
</style>
<div class="y-center-main-right buy mtop20">
    <div class="layui-tab layui-tab-card">
        <ul class="layui-tab-title">
            <li class="layui-this">收到的留言</li>
            <li>发布的留言</li>
        </ul>
        <div class="layui-tab-content">
            <div class="layui-tab-item layui-show">
                <ul class="layui-timeline">
                    @foreach($msg as $v)
                    <li class="layui-timeline-item">
                        <i class="layui-icon layui-timeline-axis"></i>
                        <div class="layui-timeline-content layui-text">
                            @foreach($v as $kk=>$vv)
                                @if($kk == 0)
                                    <h3 class="layui-timeline-title"><a href="">{{$vv['gname']}}</a></h3>
                                @endif
                                <p>
                                    @if($vv['nickname'])
                                        <font color="red">{{$vv['nickname']}}</font>
                                    @else
                                        <font color="red">暂无昵称</font>
                                    @endif
                                    在&nbsp;{{$vv['created_at']}}&nbsp;留言:&nbsp;&nbsp;<font color="#ff7733">{{$vv['umessage']}}</font></p>

                            @endforeach
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
            <div class="layui-tab-item">
                <ul class="layui-timeline">
                    @foreach($user_msg as $v)
                        <li class="layui-timeline-item">
                            <i class="layui-icon layui-timeline-axis"></i>
                            <div class="layui-timeline-content layui-text">
                                <h3 class="layui-timeline-title"><a href="">{{$v['gname']}}</a></h3>
                                <p><font color="red">我</font>&nbsp;在&nbsp;{{$v['created_at']}}&nbsp;留言:&nbsp;&nbsp;<font color="#ff7733">{{$v['umessage']}}</font></p>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>


    </div>
    </div>


@endsection


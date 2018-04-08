@extends('template.layout')


@section('title','后台商品列表')

@section('content')
    <!-- 内容区域 -->
    <div class="tpl-content-wrapper">
        <div class="container-fluid am-cf">
            <div class="row">
                <div class="am-u-sm-12 am-u-md-12 am-u-lg-9">
                    <div class="page-header-heading"><span class="am-icon-home page-header-heading-icon"></span> 管理员模块<small></small></div>
                    <p class="page-header-description"></p>
                </div>

            </div>
        </div>
        <div class="row-content am-cf">
            <div class="row">
                <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
                    <div class="widget am-cf">
                        <div class="widget-head am-cf">
                            <div class="widget-title  am-cf">管理员列表</div>


                        </div>
                        <script>
                        @if(session('msg'))
                            alert("{{session('msg')}}");
                        @endif
                        </script>
                        <div class="am-u-sm-12">
                                <table width="100%" class="am-table am-table-compact am-table-striped tpl-table-black " id="example-r">
                                    <thead>
                                    <tr>
                                        <th>买家</th>
                                        <!-- <th>商品名称</th> -->
                                        <th>留言内容</th>
                                        <!-- <th>创建时间</th>
                                        <th>商品图片</th> -->
                                        <th>操作</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($details as $k => $v)
                                        <tr class="gradeX">
                                            <td>{{$v->nickname}}</td>
                                            <!-- <td>{{$v->gname}}</td> -->

                                            <td>{{ $v->umessage }}</td>
                                            <td> <a href="{{url('goods/delete/'.$v->wid)}}"><button  class="am-btn am-btn-default am-btn-success"><span class="am-icon-plus"></span> 删除</button></a></td>

                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    <script src="/assets/js/amazeui.min.js"></script>
    <script src="/assets/js/amazeui.datatables.min.js"></script>
    <script src="/assets/js/dataTables.responsive.min.js"></script>
    <script src="/assets/js/app.js"></script>
    <script>

@endsection
@extends('template.layout')


@section('title','后台用户列表')

@section('content')
    <!-- 内容区域 -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="tpl-content-wrapper">
        <div class="container-fluid am-cf">
            <div class="row">
                <div class="am-u-sm-12 am-u-md-12 am-u-lg-9">
                    <div class="page-header-heading"><span class="am-icon-home page-header-heading-icon"></span> 配置信息模块<small></small></div>
                    <p class="page-header-description"></p>
                </div>

            </div>
        </div>
        <div class="row-content am-cf">
            <div class="row">
                <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
                    <div class="widget am-cf">
                        <div class="widget-head am-cf">
                            <div class="widget-title  am-cf">配置信息列表</div>


                        </div>
                        <script>
                            @if(session('msg'))
                            alert("{{session('msg')}}");
                            @endif
                        </script>
                        <div class="widget-body  am-fr">

                            <div class="am-u-sm-12 am-u-md-6 am-u-lg-6">
                                <div class="am-form-group">
                                    <div class="am-btn-toolbar">
                                        <div class="am-btn-group am-btn-group-xs">
                                            <a href="{{ url('config/create') }}"><button type="button" class="am-btn am-btn-default am-btn-success"><span class="am-icon-plus"></span> 新增</button></a>
                                            <a href="javascript:;"><button onclick="delall()"  class="am-btn am-btn-default am-btn-danger"><span class="am-icon-plus"></span> 删除</button></a>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <form action="{{url('template/config/change')}}" class="am-form tpl-form-line-form" method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="am-u-sm-12">
                                    <table width="100%" class="am-table am-table-compact am-table-striped tpl-table-black " >
                                        <thead>
                                        <tr>
                                            <td>删除</td>
                                            <th>配置项标题</th>
                                            <th>配置项名称</th>
                                            <th>配置项内容</th>
                                            <th>操作</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        {{--图片上传--}}
                                        <script src="/assets/js/upload.js"></script>
                                        @foreach($configs as $k => $v)
                                            <tr class="gradeX" >
                                                <td style="vertical-align:middle"><input type="checkbox" del-id="{{ $v->config_id }}"/></td>

                                                <td style="vertical-align:middle">{{ $v->config_title }}</td>
                                                <td style="vertical-align:middle">{{ $v->config_name }}</td>

                                                <td style="vertical-align:middle">
                                                    <input type="hidden" name="conf_id[]" value="{{ $v->config_id }}">
                                                    {!! $v->config_desc !!}
                                                </td>

                                                <td style="vertical-align:middle">


                                                    <div class="tpl-table-black-operation">
                                                        {{--<div style="display: inline-block">
                                                            <form action="{{ url('config/'.$v->config_id.'/edit') }}" method="get">
                                                                <button class="btn-info" >
                                                                    <i class="am-icon-pencil"></i>修改
                                                                </button>
                                                            </form>
                                                        </div>--}}
                                                        <div style="display: inline-block">
                                                                <button type="button" onclick="del(this,{{$v->config_id}})" class="btn-danger" >
                                                                    <i class="am-icon-trash"></i>删除
                                                                </buttontype>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>

                                        @endforeach

                                        <!-- more data -->

                                        </tbody>
                                    </table>
                                    <div class="am-form-group">

                                        <div class="am-u-sm-9 am-u-sm-push-3">
                                            <button  class="am-btn am-btn-primary tpl-btn-bg-color-success ">修改</button>
                                        </div>
                                    </div>
                                </div>
                            </form>

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
        //批量删除
        function delall() {
            var ids = [];
            $(':checkbox').each(function () {
                if (this.checked == true) {
                    ids.push($(this).attr('del-id'));
                }
            })


            if (confirm('确定删除' + ids + '吗')) {
                $.ajax({
                    type: "GET",
                    url: "/template/config/delall",

                    data: {'ids': ids},
                    dataType: "json",
                    anyac: false,
                    success: function (data) {
                        var arr = data;
                        alert(arr['msg']);
                        $(':checkbox').each(function () {
                            if (this.checked == true) {
                                $(this).parents('tr').remove();
                            }
                        })

                    },
                    error: function (data) {
                        var arr = data;
                        alert(arr['msg']);
                    }
                });
            }

        }
        //单个删除
        function del(obj,id){
            $.ajax({
                type: "DELETE",
                url: "/config/"+id,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {'id': id},
                dataType: "json",
                anyac: false,
                success: function (data) {
                    var arr = data;
                    alert(arr['msg']);
                    $(obj).parents('tr').remove();


                },
                error: function (data) {
                    console.log(data);
                    var arr = data;
                    alert(arr['msg']);
                }
            });
        }



    </script>
@endsection
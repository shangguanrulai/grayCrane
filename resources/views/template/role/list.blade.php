@extends('template.layout')


@section('title','后台角色列表')

@section('content')
    <!-- 内容区域 -->
    <div class="tpl-content-wrapper">
        <div class="container-fluid am-cf">
            <div class="row">
                <div class="am-u-sm-12 am-u-md-12 am-u-lg-9">
                    <div class="page-header-heading"><span class="am-icon-home page-header-heading-icon"></span> 角色模块<small></small></div>
                    <p class="page-header-description"></p>
                </div>

            </div>
        </div>
        <div class="row-content am-cf">
            <div class="row">
                <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
                    <div class="widget am-cf">
                        <div class="widget-head am-cf">
                            <div class="widget-title  am-cf">角色列表</div>


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
                                            <a href="{{ url('role/create') }}"><button type="button" class="am-btn am-btn-default am-btn-success"><span class="am-icon-plus"></span> 新增</button></a>

                                            <a href="javascript:;"><button onclick="delall()"  class="am-btn am-btn-default am-btn-danger"><span class="am-icon-plus"></span> 批量删除</button></a>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="am-u-sm-12">
                                <table width="100%" class="am-table am-table-compact am-table-striped tpl-table-black " >
                                    <thead>
                                    <tr>
                                        <th>删除</th>
                                        <th>角色名</th>
                                        <th>更新时间</th>
                                        <th>状态</th>
                                        <th>操作</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($roles as $k => $v)
                                        <tr class="gradeX">
                                            <td><input type="checkbox" del-id="{{ $v->id }}"/></td>

                                            <td>{{ $v->role_name }}</td>
                                            <td>{{ $v->updated_at }}</td>
                                            <td>
                                                @if( $v->role_status ==0)
                                                    <button class="btn-success" onclick="star(this,{{$v->id}})" status="{{$v->role_status}}">已启用</button>
                                                @else
                                                    <button class="btn-danger" onclick="star(this,{{$v->id}})" status="{{$v->role_status}}">已禁用</button>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="tpl-table-black-operation">
                                                    <div style="display: inline-block">
                                                        <form action="{{ url('template/role/auth/'.$v->id) }}" method="get">
                                                            <button class="btn-info" >
                                                                <i class="am-icon-pencil"></i>授权
                                                            </button>
                                                        </form>
                                                    </div>
                                                    <div style="display: inline-block">
                                                        <form action="{{ url('role/'.$v->id) }}" method="post">
                                                            {{ csrf_field() }}
                                                            {{ method_field('DELETE') }}
                                                            <button class="btn-danger" >
                                                                <i class="am-icon-trash"></i>删除
                                                            </button>

                                                        </form>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    <!-- more data -->
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
    </div>
    <script src="/assets/js/amazeui.min.js"></script>
    <script src="/assets/js/amazeui.datatables.min.js"></script>
    <script src="/assets/js/dataTables.responsive.min.js"></script>
    <script src="/assets/js/app.js"></script>
    <script>
        //禁用 启用
        function star(obj,id){
            if($(obj).attr('status')==0){
                var str = '你确定禁用吗?';
            }else{
                var str = '你确定启用吗?';
            }
            if(confirm(str)){
                var status = $(obj).attr('status');
                $.ajax({
                    type: "GET",
                    url: "/template/role/change",
                    data: {'id':id,'status':status},
                    dataType: "json",
                    anyac:true,
                    success: function (data)
                    {
                        var arr = data;
                        if(arr['status']==0){
                            $(obj).html('已启用');
                            $(obj).attr('status',arr['status']);
                            $(obj).attr('class','btn-success');
                        }else if(arr['status']==1){
                            $(obj).html('已禁用');
                            $(obj).attr('status',arr['status']);
                            $(obj).attr('class','btn-danger');
                        }
                    },
                    error: function (data){
                        alert('连接失败');
                    },
                });
            }

        }

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
                    url: "/template/role/delall",
                    data: {'ids': ids},
                    dataType: "json",
                    anyac: false,
                    success: function (data) {
                        var arr = data;
                        if(arr['a']==1){
                            alert(arr['msg']);
                        }else{
                            alert(arr['msg']);
                            $(':checkbox').each(function () {
                                if (this.checked == true) {
                                    $(this).parents('tr').remove();
                                }
                            })
                        }

                    },
                    error: function (data) {
                        var arr = data;
                        alert(arr['msg']);
                    }
                });
            }

        }
    </script>
@endsection
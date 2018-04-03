@extends('template.layout')


@section('title','后台用户列表')

@section('content')
    <!-- 内容区域 -->
    <div class="tpl-content-wrapper">
        <div class="container-fluid am-cf">
            <div class="row">
                <div class="am-u-sm-12 am-u-md-12 am-u-lg-9">
                    <div class="page-header-heading"><span class="am-icon-home page-header-heading-icon"></span> 权限模块<small></small></div>
                    <p class="page-header-description"></p>
                </div>

            </div>
        </div>
        <div class="row-content am-cf">
            <div class="row">
                <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
                    <div class="widget am-cf">
                        <div class="widget-head am-cf">
                            <div class="widget-title  am-cf">权限列表</div>


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
                                            <a href="{{ url('perm/create') }}"><button type="button" class="am-btn am-btn-default am-btn-success"><span class="am-icon-plus"></span> 新增</button></a>

                                            <a href="javascript:;"><button onclick="delall()"  class="am-btn am-btn-default am-btn-danger"><span class="am-icon-plus"></span> 批量删除</button></a>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <form action="{{ url('/perm') }}" method="get">
                                <div class="am-u-sm-12 am-u-md-6 am-u-lg-3">
                                    <div class="am-form-group tpl-table-list-select">
                                        <select data-am-selected="{btnSize: 'sm'}"  name="keywords2">
                                            <option value="0" >所有类别</option>
                                            @foreach($perm_cates as $v)
                                                <option value="{{$v->id}}"
                                                        @if($request->keywords2==$v->id)
                                                        selected
                                                        @endif

                                                >{{$v->pname}}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                </div>
                                <div class="am-u-sm-12 am-u-md-12 am-u-lg-3">
                                    <div class="am-input-group am-input-group-sm tpl-form-border-form cl-p">
                                        <input type="text" class="am-form-field " name="keywords1" value="{{ $request->keywords1 }}" >
                                        <span class="am-input-group-btn">
                                                <button class="am-btn  am-btn-default am-btn-success tpl-table-list-field am-icon-search" ></button>
                                            </span>
                                    </div>
                                </div>
                            </form>

                            <div class="am-u-sm-12">
                                <table width="100%" class="am-table am-table-compact am-table-striped tpl-table-black " >
                                    <thead>
                                    <tr>
                                        <th>删除</th>
                                        <th>权限名称</th>
                                        <th>权限路由</th>

                                        <th>状态</th>
                                        <th>操作</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($perms as $k => $v)
                                        <tr class="gradeX">
                                            <td><input type="checkbox" del-id="{{ $v->id }}"/></td>

                                            <td>{{ $v->title }}</td>
                                            <td>{{ $v->urls }}</td>

                                            <td>
                                                @if( $v->status ==0)
                                                    <button class="btn-success" onclick="star(this,{{$v->id}})" status="{{$v->status}}">已启用</button>
                                                @else
                                                    <button class="btn-danger" onclick="star(this,{{$v->id}})" status="{{$v->status}}">已禁用</button>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="tpl-table-black-operation">
                                                    <div style="display: inline-block">
                                                        <form action="{{ url('perm/'.$v->id.'/edit') }}" method="get">
                                                            <button class="btn-info" >
                                                                <i class="am-icon-pencil"></i>修改权限
                                                            </button>
                                                        </form>
                                                    </div>
                                                    <div style="display: inline-block">
                                                        <form action="{{ url('perm/'.$v->id) }}" method="post">
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
                    url: "/template/perm/change",
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
                    url: "/template/perm/delall",
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
    </script>
@endsection
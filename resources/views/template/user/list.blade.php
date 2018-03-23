@extends('template.layout')


@section('title','后台用户列表')

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
                        <div class="widget-body  am-fr">

                            <div class="am-u-sm-12 am-u-md-6 am-u-lg-6">
                                <div class="am-form-group">
                                    <div class="am-btn-toolbar">
                                        <div class="am-btn-group am-btn-group-xs">
                                            <a href="{{ url('user/create') }}"><button type="button" class="am-btn am-btn-default am-btn-success"><span class="am-icon-plus"></span> 新增</button></a>
                                            <a href="javascript:;"><button onclick="checkall()"  class="am-btn am-btn-default am-btn-success"><span class="am-icon-plus"></span> 全选</button></a>
                                            <a href="javascript:;"><button onclick="removeall()"  class="am-btn am-btn-default am-btn-success"><span class="am-icon-plus"></span> 反选</button></a>
                                            <a href="javascript:;"><button onclick="delall()"  class="am-btn am-btn-default am-btn-success"><span class="am-icon-plus"></span> 删除</button></a>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <form action="{{ url('/user') }}" method="get">
                                <div class="am-u-sm-12 am-u-md-6 am-u-lg-3">
                                    <div class="am-form-group tpl-table-list-select">
                                        <select data-am-selected="{btnSize: 'sm'}"  name="keywords2">
                                            <option value="0" >所有类别</option>
                                            <option value="1"
                                            @if($request->keywords2==1)
                                                selected
                                            @endif

                                                >超级管理员</option>
                                            <option value="2"
                                            @if($request->keywords2==2)
                                                selected
                                            @endif
                                            >普通管理员</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="am-u-sm-12 am-u-md-12 am-u-lg-3">
                                    <div class="am-input-group am-input-group-sm tpl-form-border-form cl-p">
                                        <input type="text" class="am-form-field " value="{{ $request->keywords1 }}" name="keywords1">
                                        <span class="am-input-group-btn">
                                                <button class="am-btn  am-btn-default am-btn-success tpl-table-list-field am-icon-search" ></button>
                                            </span>
                                    </div>
                                </div>
                            </form>
                            <div class="am-u-sm-12">
                                <table width="100%" class="am-table am-table-compact am-table-striped tpl-table-black " id="example-r">
                                    <thead>
                                    <tr>
                                        <td>删除</td>
                                        <th>编号</th>
                                        <th>用户名</th>
                                        <th>权限</th>
                                        <th>创建时间</th>
                                        <th>状态</th>
                                        <th>操作</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($users as $k => $v)
                                        <tr class="gradeX">
                                            <td><input type="checkbox" /></td>
                                            <td>{{ $v->id }}</td>
                                            <td>{{ $v->username }}</td>
                                            <td>
                                                @if( $v->auth ==1)
                                                    超级管理员
                                                @else
                                                    普通管理员
                                                @endif
                                            </td>
                                            <td>{{ $v->created_at }}</td>
                                            <td>
                                                @if( $v->status ==0)
                                                    <button class="btn-success" onclick="star(this,{{$v->id}})" status="{{$v->status}}">已启用</button>
                                                @else
                                                    <button class="btn-danger" onclick="star(this,{{$v->id}})" status="{{$v->status}}">已禁用</button>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="tpl-table-black-operation">



                                                       {{--<a href="{{ url('user/'.$v->id.'/edit') }}" >
                                                           <button class="btn-info">
                                                                <i class="am-icon-pencil"></i> 修改
                                                           </button>
                                                       </a>--}}
                                                    <div style="display: inline-block">
                                                        <form action="{{ url('user/'.$v->id.'/edit') }}" method="get">
                                                            <button class="btn-info" >
                                                                <i class="am-icon-pencil"></i>修改
                                                            </button>
                                                        </form>
                                                    </div>
                                                    <div style="display: inline-block">
                                                        <form action="{{ url('user/'.$v->id) }}" method="post">
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
                            <div class="am-u-lg-12 am-cf">

                                <div class="am-fr">
                                    {{ $users ->appends(['keywords2'=>$request->keywords2])->appends(['keywords1'=>$request->keywords1])-> links() }}
                                </div>
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
                    url: "/template/user/change",
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

        //全选
        function checkall(){
            // console.log($(':checkbox'));
            $(':checkbox').each(function(){
               this.checked = true;
            })
        }

        //反选
        function removeall(){
            $(':checkbox').each(function(){

                if(this.checked == true){
                    this.checked = false;
                }else{
                    this.checked = true;
                }
            })
        }

        //批量删除
        function delall(){
            var a = 0;
            $(':checkbox').each(function(){

                if(this.checked == true){
                    var id = $(this).parents('td').next().html();
                    $(this).parents('tr').remove();
                    $.ajax({
                        type: "GET",
                        url: "/template/user/delall",
                        data: {'id':id,'a':a},
                        dataType: "json",
                        anyac:false,
                        success: function (data)
                        {
                        },
                        error: function (data){
                            alert('删除失败');
                        },
                    });
                    a++;
                }
            })
            alert('共计删除'+a+'条信息!!');


        }




    </script>
@endsection
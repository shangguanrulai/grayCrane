@extends('template.layout')


@section('title','后台用户列表')

@section('content')
    <!-- 内容区域 -->
    <div class="tpl-content-wrapper">
        <div class="container-fluid am-cf">
            <div class="row">
                <div class="am-u-sm-12 am-u-md-12 am-u-lg-9">
                    <div class="page-header-heading"><span class="am-icon-home page-header-heading-icon"></span> 前台用户模块<small></small></div>
                    <p class="page-header-description"></p>
                </div>

            </div>
        </div>
        <div class="row-content am-cf">
            <div class="row">
                <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
                    <div class="widget am-cf">
                        <div class="widget-head am-cf">
                            <div class="widget-title  am-cf">前台用户列表</div>


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

                                    </div>
                                </div>
                            </div>
                            <form action="{{ url('/userhome') }}" method="get">

                                <div class="am-u-sm-12 am-u-md-6 am-u-lg-3">
                                    <div class="am-form-group tpl-table-list-select">

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
                                <table width="100%" class="am-table am-table-compact am-table-striped tpl-table-black " >
                                    <thead>
                                    <tr>
                                        <th>删除</th>
                                        <th>用户名</th>
                                        <th>昵称</th>
                                        <th>手机号</th>
                                        <th>邮箱</th>
                                        <th>头像</th>
                                        <th>信誉度</th>
                                        <th>真实姓名</th>
                                        <th>身份证号</th>
                                        <th>是否实名认证</th>
                                        <th>状态</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($users as $k => $v)
                                        <tr class="gradeX">
                                            <td><input type="checkbox" del-id="{{ $v->uid }}"/></td>
                                            <td>{{ $v->uname }}</td>
                                            <td>{{ $v->userinfo_home['nickname']}}</td>
                                            <td>{{ $v->phone }}</td>
                                            <td>{{ $v->email }}</td>
                                            <td><img src="/uploads/{{ $v->userinfo_home['portrait'] }}" alt=""></td>
                                            <td>{{$v->userinfo_home['score']}}</td>
                                            <td>{{$v->userinfo_home['trueNamee']}}</td>
                                            <td>{{$v->userinfo_home['prcid']}}</td>
                                            <td>@if($v->userinfo_home['isTrue']==0)
                                                    未实名认证
                                                @else
                                                    已实名认证
                                                @endif
                                            </td>
                                            <td>
                                                @if( $v->userinfo_home['status'] ==1)
                                                    <button class="btn-success" onclick="star(this,{{$v->uid}})" status="{{$v->userinfo_home['status']}}">已启用</button>
                                                @else
                                                    <button class="btn-danger" onclick="star(this,{{$v->uid}})" status="{{$v->userinfo_home['status']}}">已禁用</button>
                                                @endif
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
                var str = '你确定启用吗?';
            }else{
                var str = '你确定禁用吗?';
            }
            if(confirm(str)){
                var status = $(obj).attr('status');
                
                $.ajax({
                    type: "GET",
                    url: "/template/userhome/change",
                    data: {'id':id,'status':status},
                    dataType: "json",
                    anyac:true,
                    success: function (data)
                    {
                        var arr = data;
                        if(arr['status']==0){
                            $(obj).html('已禁用');
                            $(obj).attr('status',arr['status']);
                            $(obj).attr('class','btn-danger');
                        }else if(arr['status']==1){
                            $(obj).html('已启用');
                            $(obj).attr('status',arr['status']);
                            $(obj).attr('class','btn-success');
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
                    url: "/template/user/delall",
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
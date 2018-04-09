@extends('template.layout')


@section('title','商品分类列表')

@section('content')

    <<div class="tpl-content-wrapper">
        <div class="container-fluid am-cf">
            <div class="row">
                <div class="am-u-sm-12 am-u-md-12 am-u-lg-9">
                    <div class="page-header-heading"><span class="am-icon-home page-header-heading-icon"></span> 分类模块<small></small></div>
                    <p class="page-header-description"></p>
                </div>

            </div>
        </div>
        <div class="row-content am-cf">
            <div class="row">
                <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
                    <div class="widget am-cf">
                        <div class="widget-head am-cf">
                            <div class="widget-title  am-cf">分类列表</div>


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
                                            <a href="{{ url('cate/create') }}"><button type="button" class="am-btn am-btn-default am-btn-success"><span class="am-icon-plus"></span> 新增</button></a>

                                            <a href="javascript:;"><button onclick="delall()"  class="am-btn am-btn-default am-btn-success"><span class="am-icon-plus"></span> 删除</button></a

                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{--<form action="{{ url('cate') }}" method="get">

                                <div class="am-u-sm-12 am-u-md-12 am-u-lg-3">
                                    <div class="am-input-group am-input-group-sm tpl-form-border-form cl-p">
                                        <input type="text" class="am-form-field " value="{{ $request->keywords1 }}" name="keywords1">
                                        <span class="am-input-group-btn">
                                                <button class="am-btn  am-btn-default am-btn-success tpl-table-list-field am-icon-search" ></button>
                                            </span>
                                    </div>
                                </div>
                            </form>--}}
                            <div class="am-u-sm-12">
                                <table width="100%" class="am-table am-table-compact am-table-striped tpl-table-black " >
                                    <thead>
                                    <tr pid="0">
                                        <td>删除</td>

                                        <th>类别名称</th>
                                        <th>操作</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($arr as $v)
                                        <tr class="gradeX" pid="{{$v->pid}}" style="background:'';">
                                            <td><input type="checkbox" del-id="{{ $v->cid }}"/></td>

                                            <td>{{ $v->cname }}</td>

                                            <td>
                                                <div class="tpl-table-black-operation">
                                                    <div style="display: inline-block">
                                                        <form action="{{ url('cate/'.$v->cid.'/edit') }}" method="get">
                                                            <button class="btn-info" >
                                                                <i class="am-icon-pencil"></i>修改
                                                            </button>
                                                        </form>
                                                    </div>
                                                    <div style="display: inline-block">
                                                        <form action="{{ url('cate/'.$v->cid) }}" method="post">
                                                            {{ csrf_field() }}
                                                            {{ method_field('DELETE') }}
                                                            <button class="btn-danger" >
                                                                <i class="am-icon-trash"></i>删除
                                                            </button>

                                                        </form>
                                                    </div>
                                                    <div style="display: inline-block">
                                                        @if($v->pid==0)

                                                               <a href="{{url('cate/'.$v->cid)}}"> <i class="am-icon-pencil"></i>添加子分类</a>

                                                            <button class="btn-default" hidden="hidden" onclick="star(this,{{$v->cid}})">
                                                                <i class="am-icon-pencil"></i>显示子分类
                                                            </button>
                                                            <button class="btn-info" hidden="hidden" onclick="stop(this,{{$v->cid}})">
                                                                <i class="am-icon-pencil"></i>隐藏子分类
                                                            </button>


                                                        @endif

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
            // 子分类隐藏显示
            $('tr').each(function(){
                var pid = $(this).attr('pid');
                if(pid==0){
                    $('.btn-default').attr('hidden',false);
                }else{
                    $(this).attr('hidden','hidden');
                }
            })
            function star(obj,cid){
                $('tr').each(function(){
                    if($(this).attr('pid')==cid){
                        $(this).attr('hidden',false);
                        $(this).attr('style','position:relative;left:30px;');

                        $(obj).attr('hidden','hidden');
                        $(obj).next().attr('hidden',false);

                    }
                })
            }
            function stop(obj,cid){
                $('tr').each(function(){
                    if($(this).attr('pid')==cid){
                        $(this).attr('hidden','hidden');
                        $
                        (obj).attr('hidden','hidden');
                        $(obj).prev().attr('hidden',false);
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
                            url: "/template/cate/delall",
                            data: {'ids': ids},
                            dataType: "json",
                                anyac: false,
                                success: function (data) {
                            var arr = data;
                            if(arr['a']==0){
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
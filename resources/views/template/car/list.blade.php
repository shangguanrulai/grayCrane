@extends('template.layout')


@section('title','后台轮播图列表')

@section('content')
    <!-- 内容区域 -->
    <div class="tpl-content-wrapper">
        <div class="container-fluid am-cf">
            <div class="row">
                <div class="am-u-sm-12 am-u-md-12 am-u-lg-9">
                    <div class="page-header-heading"><span class="am-icon-home page-header-heading-icon"></span> 轮播图模块<small></small></div>
                    <p class="page-header-description"></p>
                </div>

            </div>
        </div>
        <div class="row-content am-cf">
            <div class="row">
                <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
                    <div class="widget am-cf">
                        <div class="widget-head am-cf">
                            <div class="widget-title  am-cf">轮播图列表</div>


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
                                            <a href="{{ url('car/create') }}"><button type="button" class="am-btn am-btn-default am-btn-success"><span class="am-icon-plus"></span> 新增</button></a>

                                            <a href="javascript:;"><button onclick="delall()"  class="am-btn am-btn-default am-btn-danger"><span class="am-icon-plus"></span> 删除</button></a>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="am-u-sm-12">
                                <table width="100%" class="am-table am-table-compact am-table-striped tpl-table-black " >
                                    <thead>
                                    <tr>
                                        <td>删除</td>
                                        <th>图片</th>
                                        <th>说明</th>
                                        <th>链接</th>
                                        <th>状态</th>
                                        <th>操作</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($cars as $v)
                                        <tr class="gradeX">
                                            <td><input type="checkbox" del-id="{{ $v->id }}"/></td>
                                            <td><img class="smimg" style="width:40px;height:30px" src="/uploads/{{$v->profile}}" alt=""></td>
                                            <td>{{ $v->pmsg }}</td>
                                            <td>{{ $v->purl }}</td>
                                            <td>
                                                @if( $v->pstatus ==0)
                                                    <button class="btn-danger" onclick="star(this,{{$v->id}})" pstatus="{{$v->pstatus}}">已收藏</button>
                                                @else
                                                    <button class="btn-success" onclick="star(this,{{$v->id}})" pstatus="{{$v->pstatus}}">已展示</button>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="tpl-table-black-operation">
                                                    <div style="display: inline-block">
                                                        <form action="{{ url('car/'.$v->id.'/edit') }}" method="get">
                                                            <button class="btn-info" >
                                                                <i class="am-icon-pencil"></i>修改
                                                            </button>
                                                        </form>
                                                    </div>
                                                    <div style="display: inline-block">
                                                        <form action="{{ url('car/'.$v->id) }}" method="post">
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
                                    <div class="photo-mask"></div>
                                    <div class="photo-panel">
                                        <div class="photo-div">
                                            <div class="photo-left">
                                                <div class="arrow-prv"></div>
                                            </div>
                                            <div class="photo-img">
                                                <div class="photo-bar">
                                                    <div class="photo-close"></div>
                                                </div>

                                                <div class="photo-view-h">
                                                    <img src="http://b.zol-img.com.cn/sjbizhi/images/9/800x1280/1471524533521.jpg" />
                                                </div>

                                            </div>
                                            <div class="photo-right">
                                                <div class="arrow-next"></div>
                                            </div>
                                        </div>
                                    </div>
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
        //禁用 启用
        function star(obj,id){
            if($(obj).attr('pstatus')==0){
                var str = '你确定展示吗?';
            }else{
                var str = '你确定收藏吗?';
            }
            if(confirm(str)){
                var pstatus = $(obj).attr('pstatus');
                $.ajax({
                    type: "GET",
                    url: "/template/car/change",
                    data: {'id':id,'pstatus':pstatus},
                    dataType: "json",
                    anyac:true,
                    success: function (data)
                    {
                        var arr = data;
                        if(arr['pstatus']==0){
                            $(obj).html('已收藏');
                            $(obj).attr('pstatus',arr['pstatus']);
                            $(obj).attr('class','btn-danger');
                        }else if(arr['pstatus']==1){
                            $(obj).html('已展示');
                            $(obj).attr('pstatus',arr['pstatus']);
                            $(obj).attr('class','btn-success');
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
                    url: "/template/car/delall",
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

        var img_index = 0;
        var img_src = "";
        $(function() {
            //计算居中位置
            var mg_top = ((parseInt($(window).height()) - parseInt($(".photo-div").height())) / 2);

            $(".photo-div").css({
                "margin-top": "" + mg_top + "px"
            });
        });
        //关闭
        $(".photo-close").click(function () {
            $(".photo-mask").hide();
            $(".photo-panel").hide();
        });

        //如何调用？

        $('.smimg').each(function(){
            $(this).click(function(){
                $(".photo-mask").show();
                $(".photo-panel").show();
                img_src = $(this).attr("src");
                img_index = $(this).index();
                photoView($(this));
            })
        });


        //自适应预览
        function photoView(obj) {
            if($(obj).width() >= $(obj).height()) {
                $(".photo-panel .photo-div .photo-img .photo-view-h").attr("class", "photo-view-w");
                $(".photo-panel .photo-div .photo-img .photo-view-w img").attr("src", img_src);
            } else {
                $(".photo-panel .photo-div .photo-img .photo-view-w").attr("class", "photo-view-h");
                $(".photo-panel .photo-div .photo-img .photo-view-h img").attr("src", img_src);
            }
            //此处写调试日志
            console.log(img_index);
        }
    </script>
@endsection
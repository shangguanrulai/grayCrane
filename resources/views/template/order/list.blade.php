@extends('template.layout')


@section('title','后台订单列表')

@section('content')
    <!-- 内容区域 -->
    <div class="tpl-content-wrapper">
        <div class="container-fluid am-cf">
            <div class="row">
                <div class="am-u-sm-12 am-u-md-12 am-u-lg-9">
                    <div class="page-header-heading"><span class="am-icon-home page-header-heading-icon"></span> 订单模块<small></small></div>
                    <p class="page-header-description"></p>
                </div>

            </div>
        </div>
        <div class="row-content am-cf">
            <div class="row">
                <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
                    <div class="widget am-cf">
                        <div class="widget-head am-cf">
                            <div class="widget-title  am-cf">订单列表</div>


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
                                            <a href="javascript:;"><button onclick="delall()"  class="am-btn am-btn-default am-btn-danger"><span class="am-icon-plus"></span> 删除</button></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <form action="{{ url('/order') }}" method="get">
                                <div class="am-u-sm-12 am-u-md-6 am-u-lg-3">
                                    <div class="am-form-group tpl-table-list-select">
                                        <select data-am-selected="{btnSize: 'sm'}"  name="keywords2">
                                            <option value="0" >所有订单</option>
                                            <option value="1"
                                                    @if($request->keywords2==1)
                                                    selected
                                                    @endif

                                            >已下单,未发货</option>
                                            <option value="2"
                                                    @if($request->keywords2==2)
                                                    selected
                                                    @endif
                                            >已发货,未收货</option>
                                            <option value="3"
                                                    @if($request->keywords2==3)
                                                    selected
                                                    @endif
                                            >确认收货</option>
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
                                <table width="100%" class="am-table am-table-compact am-table-striped tpl-table-black " >
                                    <thead>
                                    <tr>
                                        <th>删除</th>
                                        <th>订单号</th>
                                        <th>商品名</th>
                                        <th>卖家名称</th>
                                        <th>买家名称</th>
                                        <th>成交价格</th>
                                        <th>备注信息</th>
                                        <th>收货地址</th>
                                        <th>订单状态</th>
                                        <th>操作</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($orders as $k => $v)
                                        <tr class="gradeX">
                                            <td><input type="checkbox" del-id="{{ $v->oid }}"/></td>
                                            <td>{{ $v->onumber }}</td>
                                            <td>{{$v->gname}}</td>
                                            <td>{{ $v->solename }}</td>
                                            <td>{{ $v->buyname }}</td>
                                            <td>{{$v->price}}</td>
                                            <td>{{$v->omsg}}</td>
                                            <td>{{$v->addr}}</td>
                                            <td>
                                                @if( $v->ostatus ==1)
                                                    <div style="background:red;border-radius: 10px">已下单,尚未发货</div>
                                                @elseif($v->ostatus==2)
                                                    <div style="background:yellow;border-radius: 10px">已发货</div>
                                                @elseif($v->ostatus==3)
                                                    <div style="background:lightseagreen;border-radius: 10px">买家确认收货,交易完成</div>
                                                @endif
                                            </td>

                                            <td>
                                                <div style="display: inline-block">
                                                    <form action="{{ url('order/'.$v->oid) }}" method="post">
                                                        {{ csrf_field() }}
                                                        {{ method_field('DELETE') }}
                                                        <button class="btn-danger" >
                                                            <i class="am-icon-trash"></i>删除
                                                        </button>

                                                    </form>
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
                                    {{ $orders ->links() }}
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
                    url: "/template/order/delall",
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
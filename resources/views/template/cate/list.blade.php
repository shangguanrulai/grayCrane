@extends('template.layout')


@section('title','添加后台用户')

@section('content')

    <div class="tpl-content-wrapper">

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


                        @if (count($errors) > 0 || session('error'))
                            <div class="alert alert-danger" >
                                <ul>
                                    <li>{{session('error')}}</li>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="row">

                            <div class="am-u-sm-12 am-u-md-12 am-u-lg-6">
                                <div class="widget am-cf">
                                    <div class="widget-head am-cf">
                                        <div class="widget-title am-fl">一级分类</div>
                                        <div class="widget-function am-fr">
                                            <a href="javascript:;" class="am-icon-cog"></a>
                                        </div>
                                    </div>
                                    <div class="widget-body  widget-body-lg am-fr">

                                        <table width="100%" class="am-table am-table-compact am-table-bordered tpl-table-black " id="example-r">
                                            <thead>
                                            <tr>
                                                <th>CID</th>
                                                <th>类名</th>
                                                <th>父ID</th>
                                                <th>操作</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($p_cates as $k=>$v)
                                            <tr class="gradeX">
                                                <td>{{$v->cid}}</td>
                                                <td>{{$v->cname}}</td>
                                                <td>{{$v->pid}}</td>
                                                <td>
                                                    <div class="tpl-table-black-operation">
                                                        <a href="javascript:;">
                                                            <i class="am-icon-pencil"></i> 编辑
                                                        </a>
                                                        <a href="javascript:;" class="tpl-table-black-operation-del">
                                                            <i class="am-icon-trash"></i> 删除
                                                        </a>

                                                        <a href="/cate/{{$v->cid}}" class="tpl-table-black-operation-del">
                                                            <i class="am-icon-trash"></i> 详情
                                                        </a>

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



                            <div class="am-u-sm-12 am-u-md-12 am-u-lg-6">
                                <div class="widget am-cf">
                                    <div class="widget-head am-cf">
                                        <div class="widget-title am-fl">二级分类</div>
                                        <div class="widget-function am-fr">
                                            <a href="javascript:;" class="am-icon-cog"></a>
                                        </div>
                                    </div>
                                    <div class="widget-body  widget-body-lg am-fr">

                                        <table width="100%" class="am-table am-table-compact am-table-bordered am-table-radius am-table-striped tpl-table-black " id="example-r">
                                            <thead>
                                            <tr>
                                                <th>CID</th>
                                                <th>类名</th>
                                                <th>父ID</th>
                                                <th>操作</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($c_cates as $k=>$v)
                                            <tr class="gradeX">
                                                <td>{{$v->cid}}</td>
                                                <td>{{$v->cname}}</td>
                                                <td>{{$v->pid}}</td>
                                                <td>
                                                    <div class="tpl-table-black-operation">
                                                        <a href="javascript:;">
                                                            <i class="am-icon-pencil"></i> 编辑
                                                        </a>
                                                        <a href="javascript:;" class="tpl-table-black-operation-del">
                                                            <i class="am-icon-trash"></i> 删除
                                                        </a>
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
@endsection
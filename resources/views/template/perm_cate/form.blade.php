@extends('template.layout')


@section('title','添加权限分类')

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
                    <div class="widget am-cf">
                        <div class="widget-head am-cf">
                            <div class="widget-title am-fl">添加分类</div>
                            <div class="widget-function am-fr">
                                <a href="javascript:;" class="am-icon-cog"></a>
                            </div>
                        </div>
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

                        <form action="/perm_cate" class="am-form tpl-form-line-form" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <table class="insert-tab" width="100%">
                                <tbody>
                                    <th><i class="require-red">*</i> 类别名称：</th>
                                    <td>
                                        <input class="common-text required" id="title" name="pname" size="50" value="" type="text">
                                    </td>
                                </tr>
                                    <tr style="height:50px"></tr>
                                <tr>
                                    <th></th>
                                    <td>
                                        <button class="btn btn-primary btn6 mr10" >提交</button>

                                    </td>
                                </tr>
                                </tbody></table>
                        </form>
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
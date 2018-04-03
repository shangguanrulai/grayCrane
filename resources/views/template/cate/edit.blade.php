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
                    <div class="widget am-cf">
                        <div class="widget-head am-cf">
                            <div class="widget-title am-fl">修改分类</div>
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
                        <script>
                            alert(Session('msg'));
                        </script>

                        <form action="/cate/{{$cate->cid}}" class="am-form tpl-form-line-form" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}
                            <table class="insert-tab" width="100%">
                                <tbody>
                                <tr>
                                    <th width="120"><i class="require-red">*</i> 分类：</th>
                                    @if(empty($p_cate))
                                        <td>顶级</td>
                                    @endif
                                    <td>{{$p_cate['cname']}}</td>
                                </tr>
                                    <tr></tr>
                                <tr>
                                    <th><i class="require-red">*</i>类别名称：</th>
                                    <td>
                                        <input class="common-text required" id="title" name="cname" size="50" value="{{$cate->cname}}" type="text">
                                    </td>
                                </tr>

                                <tr>
                                    <th></th>
                                    <td>
                                        <button class="btn btn-primary btn6 mr10" >修改</button>

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
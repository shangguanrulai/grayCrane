@extends('template.layout')


@section('title','添加后台权限')

@section('content')

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
                            <div class="widget-title am-fl">添加权限</div>
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

                        <form action="/perm/{{$perm->id}}" class="am-form tpl-form-line-form" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            {{method_field('PUT')}}
                            <table class="insert-tab" width="100%">
                                <tbody>
                                <tr>
                                    <th width="120"><i class="require-red">*</i>  权限分类：</th>
                                    <td>
                                        <select name="pid" id="catid" class="required">
                                            @foreach ($perm_cates as $k=>$v)

                                                echo "<option value={{$v->id}}
                                                @if($perm->pid==$v->id)
                                                    selected
                                                @endif
                                                >{{$v->pname}}</option>";

                                            @endforeach


                                        </select>
                                    </td>
                                </tr>
                                <tr style="height:20px"></tr>
                                <tr>
                                    <th width="120"><i class="require-red">*</i>  权限标题：</th>
                                    <td>
                                        <input class="common-text required" id="title" name="title" size="50" value="{{$perm->title}}" type="text">
                                    </td>
                                </tr>
                                <tr style="height:20px"></tr>
                                <tr>
                                    <th width="120"><i class="require-red">*</i>  对应路由：</th>
                                    <td>
                                        <input class="common-text required" id="title" name="urls" size="50" value="{{$perm->urls}}" type="text">
                                    </td>
                                </tr>
                                <tr style="height:20px"></tr>
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
@extends('template.layout')


@section('title','添加后台用户')

@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="tpl-content-wrapper">
        <div class="container-fluid am-cf">
            <div class="row">
                <div class="am-u-sm-12 am-u-md-12 am-u-lg-9">
                    <div class="page-header-heading"><span class="am-icon-home page-header-heading-icon"></span> 配置信息模块<small></small></div>
                    <p class="page-header-description"></p>
                </div>

            </div>
        </div>


        <div class="row-content am-cf">


            <div class="row">

                <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
                    <div class="widget am-cf">
                        <div class="widget-head am-cf">
                            <div class="widget-title am-fl">添加配置信息</div>
                            <div class="widget-function am-fr">
                                <a href="javascript:;" class="am-icon-cog"></a>
                            </div>
                        </div>
                        @if(session('error'))
                            <div class="alert alert-danger" >
                                <ul>
                                    <li>{{session('error')}}</li>
                                </ul>
                            </div>
                        @endif
                        @if (count($errors) > 0)
                            <div class="alert alert-danger" >
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="widget-body am-fr">
                            <div>
                                <script>
                                    @if(session('msg'))
                                    alert("{{session('msg')}}");
                                    @endif
                                </script>

                            </div>
                            <form action="/config" id="biaodan" class="am-form tpl-form-line-form" method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="am-form-group">
                                    <label for="user-name" class="am-u-sm-3 am-form-label">角色名称: <span class="tpl-form-line-small-title">config_title</span></label>
                                    <div class="am-u-sm-9">
                                        <input type="text" class="tpl-form-input" id="user-name" placeholder="" name="config_title" value="{{$role->role_name}}" disabled>
                                    </div>
                                </div>

                                <div class="am-form-group">
                                    <label for="user-email" class="am-u-sm-3 am-form-label" >配置项名称: <span class="tpl-form-line-small-title">config_name</span></label>
                                    <div class="am-u-sm-9">
                                        <input type="text" class="am-form-field tpl-form-no-bg" placeholder="" name="config_name">

                                    </div>
                                </div>
                                {{--图片上传--}}
                                <script src="/assets/js/upload.js"></script>
                                <div id="flag" class="am-form-group">
                                    <label for="user-email" class="am-u-sm-3 am-form-label ">配置项类型: <span class="tpl-form-line-small-title">file_type</span></label>
                                    <div class="am-u-sm-9">
                                        <li><input type="radio" name="field_type" data-labelauty="文本框" value="input"></li>
                                        <li><input type="radio" name="field_type" data-labelauty="单选框" value="radio"></li>
                                        <li><input type="radio" name="field_type" data-labelauty="文本域" value="textarea"></li>
                                        <li id="img"><input type="radio" name="field_type" data-labelauty="图片" value="img"></li>
                                        <li><input type="radio" name="radio" disabled data-labelauty="不可用"></li>
                                    </div>
                                </div>

                                <div class="am-form-group">
                                    <label for="user-email" class="am-u-sm-3 am-form-label" >配置项排序: <span class="tpl-form-line-small-title">config_order</span></label>
                                    <div class="am-u-sm-9">
                                        <input type="text" class="am-form-field tpl-form-no-bg" placeholder="" name="config_order">

                                    </div>
                                </div>


                                <div class="am-form-group">

                                    <div class="am-u-sm-9 am-u-sm-push-3">
                                        <button  class="am-btn am-btn-primary tpl-btn-bg-color-success ">提交</button>
                                    </div>
                                </div>
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
        <script src="/assets/js/jquery.min.js"></script>
        <script src="/assets/js/jquery-labelauty.js"></script>



@endsection
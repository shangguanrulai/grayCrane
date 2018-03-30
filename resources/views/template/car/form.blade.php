@extends('template.layout')


@section('title','添加后台用户')

@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
                            <div class="widget-title am-fl">添加图片</div>
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
                            <form action="/car" id="biaodan" class="am-form tpl-form-line-form" method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}

                                <div class="am-form-group">
                                    <label for="user-weibo" class="am-u-sm-3 am-form-label">图片: <span class="tpl-form-line-small-title">Images</span></label>
                                    <div class="am-u-sm-9" style="position: relative;">
                                        <input id="file_upload" type="file" name="fileupload" value="" style="opacity:0.0;position: relative;z-index:99999999"   >
                                        <button type="button" class="am-btn am-btn-danger am-btn-sm" style="position:absolute;top:0px">
                                            <i class="am-icon-cloud-upload"></i> 上传图片</button>
                                        <p id="demoText"></p>
                                    </div>
                                </div>
                                {{--引入上传图片--}}
                                <script src="/assets/js/upload.js"></script>

                                <div class="layui-form-item layui-form-text">
                                    <label class="layui-form-label"></label>
                                    <div class="layui-input-block" style="position:relative;left:270px;top:-30px;width:60px;height:60px">
                                        <input type="hidden" name="profile" value="">
                                        <img id="art_thumb" src="" style="width:60px;">
                                    </div>
                                </div>
                                <div class="am-form-group">
                                    <label for="user-name" class="am-u-sm-3 am-form-label">图片描述: <span class="tpl-form-line-small-title">pmsg</span></label>
                                    <div class="am-u-sm-9">

                                        <textarea name="pmsg" class="tpl-form-input" id="" cols="30" rows="5"></textarea>
                                        <small></small>
                                    </div>
                                </div>

                                <div class="am-form-group">
                                    <label for="user-email" class="am-u-sm-3 am-form-label" >图片链接: <span class="tpl-form-line-small-title">purl</span></label>
                                    <div class="am-u-sm-9">
                                        <input type="text" class="am-form-field tpl-form-no-bg" placeholder="" name="purl">
                                        <small></small>
                                    </div>
                                </div>

                                <div class="am-form-group">
                                    <label for="user-phone" class="am-u-sm-3 am-form-label">状态: <span class="tpl-form-line-small-title">pstatus</span></label>
                                    <div class="am-u-sm-9">
                                        <select data-am-selected="" style="display: none;"name="pstatus">
                                            <option value="1">展示</option>
                                            <option value="0">收藏</option>
                                        </select>

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


@endsection
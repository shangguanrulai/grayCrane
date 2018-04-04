@extends('template.layout')


@section('title','分类下详细权限')

@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="tpl-content-wrapper">
        <div class="container-fluid am-cf">
            <div class="row">
                <div class="am-u-sm-12 am-u-md-12 am-u-lg-9">
                    <div class="page-header-heading"><span class="am-icon-home page-header-heading-icon"></span> 权限分类模块<small></small></div>
                    <p class="page-header-description"></p>
                </div>

            </div>
        </div>


        <div class="row-content am-cf">


            <div class="row">

                <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
                    <div class="widget am-cf">
                        <div class="widget-head am-cf">
                            <div class="widget-title am-fl">查看权限分类</div>
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



                                <div  class="am-form-group">
                                    <label for="user-name" class="am-u-sm-3 am-form-label">权限分类: <span class="tpl-form-line-small-title">config_title</span></label>
                                    <div class="am-u-sm-9">
                                        @foreach($perms as $v)
                                            <li><input type="checkbox"  name="field_type"   data-labelauty="{{$v->title}} " checked></li>
                                        @endforeach
                                    </div>
                                </div>
                                <div style="height:50px"></div>
                                <div  class="am-form-group">
                                    <label for="user-name" class="am-u-sm-3 am-form-label"> <span class="tpl-form-line-small-title"></span></label>
                                    <div class="am-u-sm-9">

                                        <a href="{{url('/perm_cate')}}"><button class="btn btn-primary btn6 mr10" >返回</button></a>
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
        <script src="/assets/js/jquery.min.js"></script>
        <script src="/assets/js/jquery-labelauty.js"></script>
        <script src="/assets/js/jquery.min.js"></script>
        <script src="/assets/js/jquery-labelauty.js"></script>
        <script>
            $(function() {



                $(':input').labelauty();
            })

        </script>



@endsection
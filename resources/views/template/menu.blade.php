

    <script src="/assets/js/theme.js"></script>
    <div class="am-g tpl-g">
        <!-- 头部 -->
        <header>
            <!-- logo -->
            <div class="am-fl tpl-header-logo">
                <a href="javascript:;"><img src="/assets/img/logo.png" alt=""></a>
            </div>
            <!-- 右侧内容 -->
            <div class="tpl-header-fluid">
                <!-- 侧边切换 -->
                <div class="am-fl tpl-header-switch-button am-icon-list">
                    <span>

                </span>
                </div>

                <!-- 其它功能-->
                <div class="am-fr tpl-header-navbar">
                    <ul>
                        <!-- 欢迎语 -->
                        <li class="am-text-sm tpl-header-navbar-welcome">
                            <a href="javascript:;">欢迎你, <span>{{Session('user')->username}}</span> </a>
                        </li>


                        <!-- 新提示 -->
                        <li class="am-dropdown" data-am-dropdown>
                            <a href="javascript:;" class="am-dropdown-toggle" data-am-dropdown-toggle>
                                <i class="am-icon-bell"></i>
                                <span class="am-badge am-badge-warning am-round item-feed-badge">
                                    @if(Session('count')!=0)
                                        1
                                    @endif
                                </span>
                            </a>

                            <!-- 弹出列表 -->
                            <ul class="am-dropdown-content tpl-dropdown-content">
                                <li class="tpl-dropdown-menu-notifications">
                                    <a href="javascript:;" class="tpl-dropdown-menu-notifications-item am-cf">
                                        <div class="tpl-dropdown-menu-notifications-title">

                                            <i class="am-icon-line-chart"></i>
                                            @if(Session('count')!=0)
                                            <span>

                                                    有{{Session('count')}}笔发布信息未处理

                                            </span>
                                            @endif
                                        </div>
                                    </a>
                                </li>
                                <li class="tpl-dropdown-menu-notifications">
                                    <a href="{{url('goods/index')}}" class="tpl-dropdown-menu-notifications-item am-cf">
                                        <i class="am-icon-bell"></i> 立即处理…
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <!-- 退出 -->
                        <li class="am-text-sm">
                            <a href="/login/exit">
                                <span class="am-icon-sign-out"></span> 退出
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

        </header>
        <!-- 风格切换 -->
        <div class="tpl-skiner">
            <div class="tpl-skiner-toggle am-icon-cog">
            </div>
            <div class="tpl-skiner-content">
                <div class="tpl-skiner-content-title">
                    选择主题
                </div>
                <div class="tpl-skiner-content-bar">
                    <span class="skiner-color skiner-white" data-color="theme-white"></span>
                    <span class="skiner-color skiner-black" data-color="theme-black"></span>
                </div>
            </div>
        </div>
        <div class="left-sidebar">
                    <!-- 用户信息 -->
                    <div class="tpl-sidebar-user-panel">
                        <div class="tpl-user-panel-slide-toggleable">
                            <div class="tpl-user-panel-profile-picture">
                                <img src="/uploads/{{Session('user')->profile}}" alt="" style="weight:50px;height:50px">
                            </div>
                            <span class="user-panel-logged-in-text">
                      <i class="am-icon-circle-o am-text-success tpl-user-panel-status-icon"></i>
                      {{Session('user')->username}}
                  </span>

                        </div>
                    </div>

                    <!-- 菜单 -->
                    <ul class="sidebar-nav">

                        <li class="sidebar-nav-link">
                            <a href="/template" class="active">
                                <i class="am-icon-home sidebar-nav-link-logo"></i> 首页
                            </a>
                        </li>
                        <!-- 用户管理 -->
                        <li class="sidebar-nav-link">
                            <a href="javascript:;" class="sidebar-nav-sub-title">
                                <i class="am-icon-table sidebar-nav-link-logo"></i> 用户管理
                                <span class="am-icon-chevron-down am-fr am-margin-right-sm sidebar-nav-sub-ico"></span>
                            </a>
                            <ul class="sidebar-nav sidebar-nav-sub">

                                 <li class="sidebar-nav-link">
                                    <a href="javascript:;" class="sidebar-nav-sub-title">
                                        <i class="am-icon-table sidebar-nav-link-logo"></i> 前台用户管理
                                        <span class="am-icon-chevron-down am-fr am-margin-right-sm sidebar-nav-sub-ico"></span>
                                    </a>
                                    <ul class="sidebar-nav sidebar-nav-sub">
                                        <li class="sidebar-nav-link">
                                            <a href="{{url('userhome')}}">
                                                <span class="am-icon-angle-right sidebar-nav-link-logo"></span> 查看用户
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                 <li class="sidebar-nav-link">
                                    <a href="javascript:;" class="sidebar-nav-sub-title">
                                        <i class="am-icon-table sidebar-nav-link-logo"></i> 后台用户管理
                                        <span class="am-icon-chevron-down am-fr am-margin-right-sm sidebar-nav-sub-ico"></span>
                                    </a>
                                    <ul class="sidebar-nav sidebar-nav-sub">
                                        <li class="sidebar-nav-link">
                                            <a href="/user/create">
                                                <span class="am-icon-angle-right sidebar-nav-link-logo"></span> 添加用户
                                            </a>
                                        </li>

                                        <li class="sidebar-nav-link">
                                            <a href="{{ url('user') }}">
                                                <span class="am-icon-angle-right sidebar-nav-link-logo"></span> 查看用户
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                </ul>
                            </ul>
                        </li>
                        {{--角色管理--}}
                        <li class="sidebar-nav-link">
                            <a href="javascript:;" class="sidebar-nav-sub-title">
                                <i class="am-icon-table sidebar-nav-link-logo"></i> 角色管理
                                <span class="am-icon-chevron-down am-fr am-margin-right-sm sidebar-nav-sub-ico"></span>
                            </a>
                            <ul class="sidebar-nav sidebar-nav-sub">
                                <li class="sidebar-nav-link">
                                    <a href="{{ url('role/create') }}">
                                        <span class="am-icon-angle-right sidebar-nav-link-logo"></span> 添加角色
                                    </a>
                                </li>

                                <li class="sidebar-nav-link">
                                    <a href="{{ url('role') }}">
                                        <span class="am-icon-angle-right sidebar-nav-link-logo"></span> 查看角色
                                    </a>
                                </li>
                            </ul>
                        </li>
                        {{--权限分类管理--}}
                        <li class="sidebar-nav-link">
                            <a href="javascript:;" class="sidebar-nav-sub-title">
                                <i class="am-icon-table sidebar-nav-link-logo"></i> 权限分类管理
                                <span class="am-icon-chevron-down am-fr am-margin-right-sm sidebar-nav-sub-ico"></span>
                            </a>
                            <ul class="sidebar-nav sidebar-nav-sub">
                                <li class="sidebar-nav-link">
                                    <a href="{{ url('perm_cate/create') }}">
                                        <span class="am-icon-angle-right sidebar-nav-link-logo"></span> 添加权限分类
                                    </a>
                                </li>

                                <li class="sidebar-nav-link">
                                    <a href="{{ url('perm_cate') }}">
                                        <span class="am-icon-angle-right sidebar-nav-link-logo"></span> 查看权限分类
                                    </a>
                                </li>
                            </ul>
                        </li>
                        {{--权限管理--}}
                        <li class="sidebar-nav-link">
                            <a href="javascript:;" class="sidebar-nav-sub-title">
                                <i class="am-icon-table sidebar-nav-link-logo"></i> 权限管理
                                <span class="am-icon-chevron-down am-fr am-margin-right-sm sidebar-nav-sub-ico"></span>
                            </a>
                            <ul class="sidebar-nav sidebar-nav-sub">
                                <li class="sidebar-nav-link">
                                    <a href="{{ url('perm/create') }}">
                                        <span class="am-icon-angle-right sidebar-nav-link-logo"></span> 添加权限
                                    </a>
                                </li>

                                <li class="sidebar-nav-link">
                                    <a href="{{ url('perm') }}">
                                        <span class="am-icon-angle-right sidebar-nav-link-logo"></span> 查看权限
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <!-- 分类管理 -->
                        <li class="sidebar-nav-link">
                            <a href="javascript:;" class="sidebar-nav-sub-title">
                                <i class="am-icon-table sidebar-nav-link-logo"></i> 商品分类管理
                                <span class="am-icon-chevron-down am-fr am-margin-right-sm sidebar-nav-sub-ico"></span>
                            </a>
                            <ul class="sidebar-nav sidebar-nav-sub">
                                <li class="sidebar-nav-link">
                                    <a href="{{ url('cate/create') }}">
                                        <span class="am-icon-angle-right sidebar-nav-link-logo"></span> 添加商品分类
                                    </a>
                                </li>

                                <li class="sidebar-nav-link">
                                    <a href="{{ url('cate') }}">
                                        <span class="am-icon-angle-right sidebar-nav-link-logo"></span> 查看商品分类
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <!-- 订单管理 -->
                        <li class="sidebar-nav-link">
                            <a href="javascript:;" class="sidebar-nav-sub-title">
                                <i class="am-icon-table sidebar-nav-link-logo"></i> 订单管理
                                <span class="am-icon-chevron-down am-fr am-margin-right-sm sidebar-nav-sub-ico"></span>
                            </a>
                            <ul class="sidebar-nav sidebar-nav-sub">
                                <li class="sidebar-nav-link">
                                    <a href="{{url('order')}}">
                                        <span class="am-icon-angle-right sidebar-nav-link-logo"></span> 查看订单
                                    </a>
                                </li>


                            </ul>
                        </li>

                        {{--网站配置管理--}}
                        <li class="sidebar-nav-link">
                            <a href="javascript:;" class="sidebar-nav-sub-title">
                                <i class="am-icon-table sidebar-nav-link-logo"></i> 网站配置管理
                                <span class="am-icon-chevron-down am-fr am-margin-right-sm sidebar-nav-sub-ico"></span>
                            </a>
                            <ul class="sidebar-nav sidebar-nav-sub">
                                <li class="sidebar-nav-link">
                                    <a href="{{url('config/create')}}">
                                        <span class="am-icon-angle-right sidebar-nav-link-logo"></span> 添加网站配置
                                    </a>
                                </li>

                                <li class="sidebar-nav-link">
                                    <a href="{{url('config')}}">
                                        <span class="am-icon-angle-right sidebar-nav-link-logo"></span> 查看网站配置
                                    </a>
                                </li>
                            </ul>
                        </li>
                        {{--轮播图管理--}}
                        <li class="sidebar-nav-link">
                            <a href="javascript:;" class="sidebar-nav-sub-title">
                                <i class="am-icon-table sidebar-nav-link-logo"></i> 轮播图管理
                                <span class="am-icon-chevron-down am-fr am-margin-right-sm sidebar-nav-sub-ico"></span>
                            </a>
                            <ul class="sidebar-nav sidebar-nav-sub">
                                <li class="sidebar-nav-link">
                                    <a href="{{url('car/create')}}">
                                        <span class="am-icon-angle-right sidebar-nav-link-logo"></span> 添加图片
                                    </a>
                                </li>

                                <li class="sidebar-nav-link">
                                    <a href="{{url('car')}}">
                                        <span class="am-icon-angle-right sidebar-nav-link-logo"></span> 查看图片
                                    </a>
                                </li>
                            </ul>
                        </li>



                    </ul>
                </div>

@extends('template.layout')


@section('title','灰鹤交易后台首页')

@section('content')

        <!-- 内容区域 -->
        <div class="tpl-content-wrapper">
            <div class="container-fluid am-cf">
                <div class="row">
                    <div class="am-u-sm-12 am-u-md-12 am-u-lg-9">
                        <div class="page-header-heading"><span class="am-icon-home page-header-heading-icon"></span> 首页<small></small></div>
                        <p class="page-header-description"></p>
                    </div>

                </div>
            </div>


            <div class="row-content am-cf">
                <div class="row  am-cf">
                    <div class="am-u-sm-12 am-u-md-12 am-u-lg-4">
                        <div class="widget am-cf">

                            <div class="widget-head am-cf">
                                <div class="widget-title am-fl">使命</div>
                                <div class="widget-fluctuation-description-text am-text-right">
                                    MISSION
                                </div>
                            </div>
                            <div class="widget-body am-fr">
                                <div class="am-fl">
                                    <div class="widget-fluctuation-period-text">
                                        让生活变得简单快乐

                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                    <div class="am-u-sm-12 am-u-md-6 am-u-lg-4">
                        <div class="widget widget-primary am-cf">
                            <div class="widget-head am-cf">
                                <div class="widget-title am-fl">愿景</div>
                                <div class="widget-fluctuation-description-text am-text-right">
                                    VISION
                                </div>
                            </div>
                            <div class="widget-body am-fr">
                                <div class="am-fl">
                                    <div class="widget-fluctuation-period-text">
                                        成为全球最值得信赖的企业

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="am-u-sm-12 am-u-md-6 am-u-lg-4">
                        <div class="widget widget-purple am-cf">
                            <div class="widget-head am-cf">
                                <div class="widget-title am-fl">价值观</div>
                                <div class="widget-fluctuation-description-text am-text-right">
                                    CORE VALUE
                                </div>
                            </div>
                            <div class="widget-body am-fr">
                                <div class="am-fl">
                                    <div class="widget-fluctuation-period-text">
                                        客户为先 诚信 团队 创新 激情

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="row am-cf">
                    <div class="am-u-sm-12 am-u-md-12 am-u-lg-4 widget-margin-bottom-lg ">
                        <div class="tpl-user-card am-text-center widget-body-lg">
                            <div class="tpl-user-card-title">
                                {{Session()->get('user_admin')->username}}
                            </div>
                            <div class="achievement-subheading">
                                月度最佳员工
                            </div>
                            <img class="achievement-image" src="/uploads/{{Session('user_admin')->profile}}" alt="" style="weight:100px;height:100px">
                            <div class="achievement-description" style="font-size:20px">
                               细节决定成败
                            </div>
                        </div>
                    </div>

                    <div class="am-u-sm-12 am-u-md-12 am-u-lg-8 widget-margin-bottom-lg">

                        <div class="widget am-cf widget-body-lg">

                            <div class="widget-body  am-fr">
                                <div class="am-scrollable-horizontal ">
                                    <table width="100%" class="am-table am-table-compact am-text-nowrap tpl-table-black " >
                                        <thead>
                                            <tr>
                                                <th>合伙人</th>
                                                <th>公司职位</th>
                                                <th>其他职位</th>
                                                <th>江湖人称</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="gradeX">
                                                <td>李璐</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <tr class="even gradeC">
                                                <td>郎涛</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <tr class="gradeX">
                                                <td>曾建辉</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <tr class="even gradeC">
                                                <td>卫宁宁</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <tr class="even gradeC">
                                                <td>董志强</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>


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
    <script src="assets/js/amazeui.min.js"></script>
    <script src="assets/js/amazeui.datatables.min.js"></script>
    <script src="assets/js/dataTables.responsive.min.js"></script>
    <script src="assets/js/app.js"></script>
@endsection

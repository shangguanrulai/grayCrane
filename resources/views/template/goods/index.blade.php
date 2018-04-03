@extends('template.layout')


@section('title','后台商品列表')

@section('content')
	<!-- 内容区域 -->
	<div class="tpl-content-wrapper">
		<div class="container-fluid am-cf">
			<div class="row">
				<div class="am-u-sm-12 am-u-md-12 am-u-lg-9">
					<div class="page-header-heading"><span class="am-icon-home page-header-heading-icon"></span> 管理员模块<small></small></div>
					<p class="page-header-description"></p>
				</div>

			</div>
		</div>
		<div class="row-content am-cf">
			<div class="row">
				<div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
					<div class="widget am-cf">
						<div class="widget-head am-cf">
							<div class="widget-title  am-cf">管理员列表</div>


						</div>
						<script>
						@if(session('msg'))
							alert("{{session('msg')}}");
						@endif
						</script>


							<div class="am-u-sm-12">
								<table width="100%" class="am-table am-table-compact am-table-striped tpl-table-black " id="example-r">
									<thead>
									<tr>
										<td>删除</td>
										<th>编号</th>
										<th>用户名</th>
										<th>创建时间</th>
										<th>商品图片</th>
										<th>状态</th>
										<th>操作</th>
									</tr>
									</thead>
									<tbody>
									@foreach($goods as $k => $v)
										<tr class="gradeX">
											<td><input type="checkbox" del-id="{{ $v->id }}"/></td>
											<td>{{ $v->rid }}</td>
											<td>{{ $v->gname }}</td>
											<td>{{ $v->created_at }}</td>
											<td><img style="width:40px;height:30px" src="/uploads/{{$v->gpic}}" alt=""></td>
											<td>
												@if( $v->status ==0)
													<button class="btn-success" onclick="star(this,{{$v->rid}})" status="{{$v->status}}">未审核</button>
												@elseif($v->status ==1)
													<button class="btn-danger" onclick="star(this,{{$v->rid}})" status="{{$v->status}}">已上架</button>
												@elseif($v->status ==2)
													<button class="btn-down" onclick="star(this,{{$v->rid}})" status="{{$v->status}}">已下架</button>
												@endif
											</td>
											<td>

													<div style="display: inline-block">
														<form action="{{ url('user/'.$v->id) }}" method="post">
															{{ csrf_field() }}
															{{ method_field('DELETE') }}
															<button class="btn-danger" >
																<i class="am-icon-trash"></i>删除
															</button>

														</form>
													</div>
												</div>
											</td>
											<td>

						<a href="/goods/details/{{ $v->rid }}"><b tton class="btn-success">查看留言</button></a>

											</td>
										</tr>
									@endforeach
									</tbody>
								</table>
							</div>
							<div class="am-u-lg-12 am-cf">

								<div class="am-fr">
									{{ $goods ->appends(['keywords2'=>$request->keywords2])->appends(['keywords1'=>$request->keywords1])-> links() }}
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
		//禁用 启用

		function star(obj,id){
			if($(obj).attr('status')==0){
				var str = '你确定该商品通过审核';
			}else{
				var str = '你确定下架该商品吗?';
			}
			if(confirm(str)){
				var status = $(obj).attr('status');
				$.ajax({
					type: "GET",
					url: "/goods/change",
					data: {'rid':id,'status':status},
					dataType: "json",
					anyac:true,
					success: function (data)
					{

						console.log(data);
						var arr = data;
						if(arr['status']==0){
							$(obj).html('待审核');
							$(obj).attr('status',arr['status']);
							$(obj).attr('class','btn-success');
						}else if(arr['status']==1){
							$(obj).html('已上架');
							$(obj).attr('status',arr['status']);
							$(obj).attr('class','btn-danger');
						}else if(arr['status']==2){
							$(obj).html('已下架');
							$(obj).attr('status',arr['status']);
							$(obj).attr('class','btn-down');
						}
					},
					error: function (data){
						alert('连接失败');
					},
				});
			}

		}

		//全选
		function checkall(){
			// console.log($(':checkbox'));
			$(':checkbox').each(function(){
			   this.checked = true;
			})
		}

		//反选
		function removeall(){
			$(':checkbox').each(function(){

				if(this.checked == true){
					this.checked = false;
				}else{
					this.checked = true;
				}
			})
		}

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
						url: "/template/user/delall",
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
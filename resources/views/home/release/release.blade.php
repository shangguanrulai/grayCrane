@include('home.common.index_header');

<script type="text/javascript" src="/Scripts/address.js" xmlns="http://www.w3.org/1999/html"></script>
<link href="/Content/secondarytradingrelease.css" rel="stylesheet">

<style>
    .loading{
        position:relative;
        left:110px;
        top: 10px;
        display: block;
    }
    .unloading{
        display: none;
    }
</style>

<div class="wrapper">
    <div class="goodsRelease-switch">
        <ul class="switch-nav clearfix" style="position:relative;top:-50px;">
            <li index='0' class="current-item">
                <a href="">发布商品</a>
            </li>
        </ul>
<div class="switch-panel clearfix" style="position:relative;top:-50px;">
    @if (count($errors) > 0)
        <div class="alert alert-danger" >
            <ul>
                @foreach ($errors->all() as $error)
                    <li style="float: left;color: red;margin: 10px;font-size: 14px;border-radius: 2px;">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        <div style="clear: both"></div>
    @endif
<!-- goods-form -->
<div class="goods-form" {{--style="position:relative;top:-50px;"--}}>

<form id="goods-form" class="form-horizontal" action="{{url('/home/release')}}" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    <input type="hidden" value="{{$user['uid']}}" name="uid">
    <input type="hidden" name="gpic">
   <div class="type-item clearfix">

        <div class="form-group field-goods-brand_name">
            <label class="control-label" for="goods-brand_name"><i class="star"></i>分类</label>
            <div class="input-wrap">
                <select name="pid">
                    @foreach($cate as $v)
                        @if($v->pid == 0)
                            <option value="{{$v->cid}}" class="pid">{{$v->cname}}</option>
                        @endif
                    @endforeach
                </select>
            </div>
        </div>
       <div class="form-group field-goods-model_name">
            <div class="input-wrap">
                <select name="cid">
                    @foreach($cate as $v)
                        @if($v->pid == 1)
                            <option value="{{$v->cid}}" class="pid">{{$v->cname}}</option>
                        @endif
                    @endforeach
                </select>
            </div>
       </div>
   </div>

    <div class="goods-title clearfix">
        <div class="form-group field-goods-goods_name required">
            <label class="control-label" for="goods-goods_name"><i class="star"></i>商品名</label>
            <div class="input-wrap"><input type="text" id="release_name" class="form-control" name="gname" placeholder="请填写商品名" value="{{old('gname')}}"></div>
        </div>
    </div>
    <div class="goods-title clearfix">
        <div class="form-group field-goods-goods_name required">
            <label class="control-label" for="goods-goods_name"><i class="star"></i>标题</label>
            <div class="input-wrap"><input type="text" id="release_title" class="form-control" name="title" placeholder="请填写标题" value="{{old('title')}}"></div>
        </div>
    </div>
    <div class="price-item clearfix">
        <div class="form-group field-goods-price">
       <label class="control-label" for="goods-price">价格</label>
            <div class="input-wrap">
                <input type="text" id="nowprice" class="form-control" name="nowprice" value="{{old('nowprice')}}"><em class="unit">元</em>
            </div>
        </div>
        <div class="form-group field-goods-price">
            <label class="control-label" for="goods-price">新品参考</label>
            <div class="input-wrap">
                <input type="text" id="newprice" class="form-control" name="newprice" value="{{old('newprice')}}"><em class="unit">元</em>
            </div>
        </div>
    </div>

        <div class="address-box clearfix">
             <div class="form-group field-goods-province_id required">
                <label class="control-label" for="goods-province_id">所在城市</label>
                <div class="input-wrap">
                    <select class="sel" id="cmbProvince" name="raddrp"></select>
                </div>
            </div>
            <div class="form-group field-goods-province_id required">
                <div class="input-wrap">
                    <select class="sel" id="cmbCity" name="raddrc"></select>
                </div>
            </div>
            <div class="form-group field-goods-province_id required">
                <div class="input-wrap">
                    <select class="sel" id="cmbArea" name="raddra"></select>
                </div>
            </div>
        </div>

    <div class="mobile-box clearfix" id="use_phone_mob"   >
	<div class="certified-box">
		<div class="form-group field-goods-phone_mob required">
            <span style="display: none;" class="error"></span>
            <label class="control-label" for="goods-phone_mob">手机号</label>
            <div class="input-wrap">
                <input type="text" id="goods-phone_mob" class="form-control" name="rphone"  maxlength="11" value="{{old('rphone')}}">
                <div class="check-box">
                    <label class="checklabel">
                        <input id="phone" name="dphone" type="checkbox">使用绑定手机
                    </label>
                </div>
            </div>
        </div>
	</div>
    </div>

    <div id="upload-pictures" class="upload-pictures clearfix">
	<label class="control-label"><i class="star"></i>上传图片</label>
        <input type="file" name="file_upload" id="file_upload" style="position:relative;height: 43px;padding-top: 14px;width:120px;top: -20px;opacity:0;z-index: 9999999;cursor: pointer;">
        <button type="button" class="layui-btn layui-btn-danger" id="test7" style="position: relative;left: -120px;top: -15px;z-index: 1;"><i class="layui-icon"></i>上传图片</button>
        <div class="layui-inline layui-word-aux"></div>
        <img src="/Images/5-121204193R5-50.gif" id="loading" class="unloading">
        <img id="art_thumb" style="height: 100px;position: relative;left: -100px;top: 5px;">
    </div>


    <div class="description-box clearfix">
        <div class="form-group field-goods-goods_desc required">
            <label class="control-label" for="goods-goods_desc"><i class="star"></i>详情描述</label>
            <div class="description-textarea">
                <textarea id="goods-goods_desc" class="form-control" name="describe">{{old('describe')}}</textarea>
            </div>
        </div>
    </div>
    <input type="submit" class="btn btn-primary submit-button" value="发布">

    <script type="text/javascript">
        $(function () {
            $("#file_upload").change(function () {
                uploadImage();
            })
        })

        function uploadImage() {
            //  判断是否有选择上传文件
            var imgPath = $("#file_upload").val();

            if (imgPath == "") {
                alert("请选择上传图片！");
                return;
            }

            $('#loading').attr('class','loading');
            //判断上传文件的后缀名
            var strExtension = imgPath.substr(imgPath.lastIndexOf('.') + 1);

            if (strExtension != 'jpg' && strExtension != 'gif'
                && strExtension != 'png' && strExtension != 'bmp') {
                alert("请选择图片文件");
                return;
            }
            // var formData = new FormData($('#art_form')[0]);
            var formData = new FormData();
            formData.append('fileupload',$('#file_upload')[0].files[0]);

            $.ajax({
                type: "POST",
                cache: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "/home/ajax/release",
                data: formData,
                contentType: false,
                processData: false,
                success: function(data) {
                    $('#art_thumb').attr('src', '/uploads/'+data);
                    $('#loading').attr('class','unloading');

                    $("input[name='gpic']").attr('value',data);
                },

                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    alert("上传失败，请检查网络后重试");
                }
            });
        }
    </script>

</form>
    <script>
        layui.use(['layer', 'form'], function(){
            var layer = layui.layer;

            $(':submit').click(function(){
                if($('#release_name').val() == ''){

                    layer.msg('请填写商品名', {icon: 5});
                    return false;
                } else if($('#release_title').val() == ''){

                    layer.msg('请填写标题', {icon: 5});
                    return false;
                } else if(!Number($('input[name=nowprice]').val())){

                    layer.msg('请正确填写商品价格', {icon: 5});
                    return false;
                } else if(!Number($('input[name=newprice]').val())){

                    layer.msg('请正确填写商品价格', {icon: 5});
                    return false;
                } else if($('#cmbArea').val() == ''){

                    layer.msg('请选择区域', {icon: 5});
                    return false;
                } else if(!Number($('input[name=rphone]').val())){

                    layer.msg('请正确填写手机号', {icon: 5});
                    return false;
                }
            });

        });
    </script>
</div>

</div>
    <div class="aside" style="position: absolute;top:285px;right: 23px;">
	<ul id="accordion" class="step-items">
		<li class="step-item">
			<h3 class="step-title">
				<em>1</em>完善基本信息
			</h3>
		</li>
		<li class="step-item">
			<h3 class="step-title">
				<em>2</em>上图上真相
			</h3>
		</li>
		<li class="step-item">
			<h3 class="step-title">
				<em>3</em>详情描述
			</h3>
		</li>
	</ul>
    </div>
</div>
    
<script type="text/javascript">
    addressInit('cmbProvince', 'cmbCity', 'cmbArea');
</script>
<script>
    // 分类联动
    var pid = 0;
    $("select[name='pid']").change( function() {
        pid = $("select[name='pid']").val();

        $.get('/home/ajax/cate',{'pid':pid},function(data){
            $("select[name='cid']").empty();

            for (var i = 0; i < data.length; i++) {
                $("select[name='cid']").append('<option value="'+data[i]['cid']+'">'+data[i]['cname']+'</option>');
            };
        });
    });

    // 使用默认手机号码
    $('input[name=dphone]').change(function(){
        if( $('input[name=dphone]').attr('checked') == true ){

            $('input[name=rphone]').val({{$user['phone']}});
        } else {

            $('input[name=rphone]').val('');
        }
    });

</script>

<!-- foot -->
@include('home.common.index_footer');
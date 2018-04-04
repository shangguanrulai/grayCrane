$(function () {

    $("body").on('change','#file_upload',function () {
        uploadImage();
    })
})
function uploadImage() {
    //判断是否有文件上传
    var imgPath = $("#file_upload").val();
    if (imgPath == "") {
        alert("请选择上传图片！");
        return;
    }
    //判断上传文件的后缀名
    var strExtension = imgPath.substr(imgPath.lastIndexOf('.') + 1);
    if (strExtension != 'jpg' && strExtension != 'gif'
        && strExtension != 'png' && strExtension != 'bmp') {
        alert("请选择图片文件");
        return;
    }
    // var formData = new FormData($('#biaodan')[0]);
    var formData = new FormData();
    formData.append('fileupload',$('#file_upload')[0].files[0]);
    $.ajax({
        type: "POST",
        cache: false,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: "/template/upload/uploads",
        data: formData,
        contentType: false,
        processData: false,
        success: function(data) {
            console.log(data);
            $('#art_thumb').attr('src','/uploads/'+data);
            $("input[name='profile']").val(data);
            $("#content").val(data);
        },
        error:function(data){
            alert('添加失败');
        },
    })

}
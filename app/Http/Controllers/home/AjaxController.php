<?php

namespace App\Http\Controllers\home;

use Illuminate\Http\Request;
use App\Model\cate;
use App\Http\Controllers\Controller;


class AjaxController extends Controller
{
    public function user($phone)
    {
        echo $phone;
    }

    public function cate(Request $request)
    {
        $pid =  $request->input('pid');

        return cate::where('pid',$pid)->get();
    }

    public function release(Request $request)
    {
        $file = $request->file('fileupload');

        //如果是有效的上传文件
        if($file->isValid()) {

           // 存储上传文件
            $path = $request->file('fileupload')->store('/home');

            //将上传文件的路径返回给客户端
            return $path;
        }
    }

    public function userinfo(Request $request)
    {
        $file = $request->file('fileupload');

        //如果是有效的上传文件
        if($file->isValid()) {

            // 存储上传文件
            $path = $request->file('fileupload')->store('/home');

            //将上传文件的路径返回给客户端
            return $path;
        }
    }

}

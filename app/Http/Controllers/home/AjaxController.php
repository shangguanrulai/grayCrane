<?php

namespace App\Http\Controllers\home;

use Illuminate\Http\Request;
use App\Model\cate;
use App\Model\code_phone;
use App\Http\Controllers\Controller;
use Session;


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

    public function code_phone(Request $request)
    {
        //初始化必填
//填写在开发者控制台首页上的Account Sid
        $options['accountsid']='7a7e15eff9fe00d980a3b3ada8dd0381';
//填写在开发者控制台首页上的Auth Token
        $options['token']='4906896f01ae877072d36469df893fae';

//初始化 $options必填
        $ucpass = new code_phone($options);

        $appid = "7f07d06306d5406395f962b2312e3416";	//应用的ID，可在开发者控制台内的短信产品下查看
        $templateid = "305654";    //可在后台短信产品→选择接入的应用→短信模板-模板ID，查看该模板ID
        $param = mt_rand(1000,9999); //多个参数使用英文逗号隔开（如：param=“a,b,c”），如为参数则留空
        $mobile = $request->input('phone');
        $uid = "";

        Session()->put('code_phone',$param);

        //70字内（含70字）计一条，超过70字，按67字/条计费，超过长度短信平台将会自动分割为多条发送。分割后的多条短信将按照具体占用条数计费。
        $ucpass->SendSms($appid,$templateid,$param,$mobile,$uid);


    }

}

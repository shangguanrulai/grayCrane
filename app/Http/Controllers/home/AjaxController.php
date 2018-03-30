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
}

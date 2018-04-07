<?php

namespace App\Http\Controllers\template;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReleaseController extends Controller
{
    //商品管理
    public function releases()
    {
        return view('template.releases.releases');
    }
    //商品上架管理
    public function up()
    {
        return view('template.releases.up');

    }
    //商品待审核管理
    public function await()
    {
        return view('template.releases.await');
    }
}

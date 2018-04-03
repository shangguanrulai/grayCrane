<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::group([],function(){
    //显示一个后台首页
    Route::get('/template', function () {
        return view('template.first');
    });

    //后台用户控制器
    Route::get('template/user/change','template\UserController@change');
    Route::get('template/user/delall','template\UserController@delall');

    Route::resource('user','template\UserController');

    //后台分类控制器
    Route::get('template/cate/delall','template\CateController@delall');
    Route::resource('cate','template\CateController');

    //后台商品
    Route::get('goods/index','template\GoodsController@index');
    Route::get('goods/change','template\GoodsController@change');
    Route::get('goods/details/{rid}','template\GoodsController@details');
    Route::get('goods/delete/{wid}','template\GoodsController@delete');

    //后台网站配置控制器
    Route::get('template/config/delall','template\ConfigController@delall');
    Route::post('template/config/change','template\ConfigController@change');

    Route::resource('config','template\ConfigController');

    //轮播图控制器
    Route::get('template/car/change','template\CarController@change');
    Route::get('template/car/delall','template\CarController@delall');
    Route::resource('car','template\CarController');

    //文件上传控制器

    Route::post('template/upload/uploads','template\UploadController@uploads');
    route::resource('upload','template\UploadController');

    //订单控制器
    Route::get('template/order/delall','template\OrderCOntroller@delall');
    Route::resource('order','template\OrderController');





});






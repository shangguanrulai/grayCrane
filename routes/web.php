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

// Route::get('/', function () {
//     return view('welcome');
// });


//前台登录
Route::get('home/login','home\LoginController@login');
Route::get('home/yzm','home\LoginController@yzm');
Route::post('home/dologin','home\loginController@dologin');
Route::get('home/loginout','home\loginController@loginout');

//前台注册
Route::get('home/register','home\RegisterController@register');
Route::get('home/yanzhengma','home\RegisterController@yanzhengma');
Route::post('home/doregister','home\RegisterController@doregister');


/**
 *前台ajax
 */
// 默认手机号
Route::get('/home/ajax/user/{phone}','home\AjaxController@user');
// 分类
Route::get('/home/ajax/cate','home\AjaxController@cate');
// 商品发布上传图
Route::post('/home/ajax/release','home\AjaxController@release');
// 用户头像上传图
Route::post('/home/ajax/userinfo','home\AjaxController@userinfo');
/**
*ajax结束
 */


// 前台消息
Route::get('/home/msg/{uid}','home\MsgController@index');

// 前台首页
Route::get('/', 'home\FirstController@index');

// 前台用户收货地址
Route::get('/home/user/addr', 'home\AddrController@index');
Route::get('/home/user/addr_create', 'home\AddrController@create');
Route::post('/home/user/addr_store', 'home\AddrController@store');
Route::get('/home/user/addr_edit/{aid}/', 'home\AddrController@edit');
Route::post('/home/user/addr_update', 'home\AddrController@update');
Route::get('/home/user/addr_destroy/{aid}/', 'home\AddrController@destroy');

// 前台用户收藏
Route::get('/home/user/collect', 'home\CollectController@index');
Route::get('/home/user/collect_destroy/{id}/', 'home\CollectController@destroy');


// 前台用户中心
Route::get('/home/user/pass', 'home\UserController@pass');
Route::post('/home/user/update_pass', 'home\UserController@update_pass');
Route::get('/home/user/paypass', 'home\UserController@paypass');
Route::post('/home/user/update_paypass', 'home\UserController@update_paypass');
Route::resource('/home/user', 'home\UserController');


// 前台发布
Route::resource('/home/release', 'Home\ReleaseController');



Route::group([],function(){
    //显示一个后台首页
    Route::get('/template', function () {
        return view('template.first');
    });

    Route::resource('user','template\UserController');
    Route::resource('cate','template\CateController');
    Route::get('template/user/change','template\UserController@change');
    Route::get('template/user/delall','template\UserController@delall');


});


Route::get('/home/goods/index','home\GoodsController@index');
Route::get('/home/goods/ajax/{c}','home\GoodsController@ajax');
//发布时间排序
Route::get('home/goods/fbsj','home\GoodsController@fbsj');
//商品详情
Route::get('/home/goods/details','home\GoodsController@details');
//商品收藏
Route::get('/home/goods/aaaaa','home\GoodsController@ajaxs');





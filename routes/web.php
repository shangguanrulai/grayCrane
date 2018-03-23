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

//前台注册
Route::get('home/register','home\RegisterController@register');
Route::get('home/yanzhengma','home\RegisterController@yanzhengma');
Route::post('home/doregister','home\RegisterController@doregister');


// 前台ajax
Route::get('/home/ajax/user/{phone}','home\AjaxController@user');
Route::get('/home/ajax/cate','home\AjaxController@cate');

// 前台消息
Route::get('/home/msg/{uid}','home\MsgController@index');

//前台首页
Route::resource('/', 'home\FirstController');

//前台用户中心
Route::resource('/home/user', 'home\UserController');

//前台发布
Route::resource('/home/release', 'home\ReleaseController');



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





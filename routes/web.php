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
Route::get('Home/login','Home\LoginController@login');

Route::get('Home/yzm','Home\LoginController@yzm');

Route::post('Home/dologin','Home\loginController@dologin');

//前台注册
Route::get('/Home/register','Home\RegisterController@register');
Route::get('/Home/yzm','Home\RegisterController@yzm');
Route::post('/Home/doregister','Home\RegisterController@doregister');

// 前台ajax
Route::get('/home/ajax/user/{phone}','home\AjaxController@user');

// 前台消息
Route::get('/home/msg/{uid}','home\MsgController@index');

//前台首页
Route::resource('/', 'home\FirstController');

//前台用户中心
Route::resource('/home/user', 'home\UserController');

//前台发布
Route::resource('/home/release', 'home\ReleaseController');



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
//Route::group(['prefix'=>'admin','namespace'=>'Admin'],function(){
//
//
//    Route::get('login','LoginController@login');



Route::get('/login', function () {
    return view('template.logins.login');
});
Route::group(['prefix'=>'template','namespace'=>'Template'],function(){
//Route::group([],function(){
    Route::get('/login', function () {
        return view('template.first');
    });
    Route::get('/user/create','UserController@create');
    Route::post('/user','UserController@store');

});
//生成验证码路由
Route::get('template','Template\LoginController@code');

//登录处理路由
Route::post('templates','Template\LoginController@doLogin');
//Route::resource('user','template\UserController');

//加密
Route::get('jiami','Admin\LoginController@jiami');

//Route::resource('template','Template\LoginController');

//Route::resource('/user/code','LoginController@code');
Route::post('admin/template','Template\LoginController@index');


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
    Route::get('/', function () {
        return view('template.first');
    });

    Route::resource('user','template\UserController');
    Route::resource('cate','template\CateController');
    Route::get('template/user/change','template\UserController@change');
    Route::get('template/user/delall','template\UserController@delall');




});






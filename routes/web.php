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

/*Route::get('/', function () {
    return view('welcome');
});*/


Route::get('/home/ajax/user/{phone}','home\AjaxController@user');
Route::get('/home/msg/{uid}','home\MsgController@index');

Route::resource('/', 'home\FirstController');
Route::resource('/home/user', 'home\UserController');
Route::resource('/home/release', 'home\ReleaseController');


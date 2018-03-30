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

    //后台用户控制器
    Route::get('template/user/change','template\UserController@change');
    Route::get('template/user/delall','template\UserController@delall');

    Route::resource('user','template\UserController');

    //前台用户控制器
    Route::get('template/userhome/change','template\UserHomeController@change');
    Route::resource('userhome','template\UserHomeController');

    //后台分类控制器
    Route::get('template/cate/delall','template\CateController@delall');
    Route::resource('cate','template\CateController');

    //后台网站配置控制器
    Route::get('template/config/putFile','template\ConfigController@putFile');
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

    //角色控制器
    //给角色添加权限
    Route::get('template/role/auth/{id}','template\RoleController@auth');
    Route::get('template/role/change','template\RoleController@change');
    Route::get('template/role/delall','template\RoleController@delall');
    Route::resource('role','template\RoleController');

    //权限控制器
    Route::get('template/perm/change','template\PermController@change');
    Route::get('template/perm/delall','template\PermController@delall');
    Route::resource('perm','template\PermController');

    //权限分类控制器
    Route::get('template/perm_cate/delall','template\Perm_cateController@delall');
    Route::resource('perm_cate','template\Perm_cateController');



});


//后台控制前台用户
Route::get('template/user_home','template\User_homeController@user_home');


//商品分类
Route::get('/home/goods/index','home\GoodsController@index');
Route::get('/home/goods/ajax','home\GoodsController@ajax');


//商品详情
Route::get('/home/goods/details','home\GoodsController@details');
//商品收藏
Route::get('/home/goods/aaaaa','home\GoodsController@ajaxs');

//留言
Route::get('/home/goods/bbbbb','home\GoodsController@ajaxss');







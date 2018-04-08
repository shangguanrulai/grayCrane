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
Route::get('/login', function () {
    return view('template.logins.login');
});

//生成验证码路由
Route::get('/login/code','Template\LoginController@code');

Route::post('/login/dologin','template\LoginController@doLogin');

//退出登录
Route::get('/login/exit','template\LoginController@exit');


//加密
Route::get('jiami','Admin\LoginController@jiami');

Route::get('noaccess',function(){
    return view('template.error.auth');
});

//文件上传控制器

Route::post('template/upload/uploads','template\UploadController@uploads');
route::resource('upload','template\UploadController');
//'middleware'=>['admin_login','hasrole']
Route::group(['middleware'=>['admin_login','hasrole']],function(){
    //显示一个后台首页
    Route::get('/template', function () {
        return view('template.first');
    });

    //后台用户控制器
    Route::get('template/user/auth/{id}','template\UserController@auth');
    Route::post('template/user/doauth','template\UserController@doauth');

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
    Route::get('template/config/putFile     ','template\ConfigController@putFile');
    Route::get('template/config/delall','template\ConfigController@delall');
    Route::post('template/config/change','template\ConfigController@change');

    Route::resource('config','template\ConfigController');

    //轮播图控制器
    Route::get('template/car/change','template\CarController@change');
    Route::get('template/car/delall','template\CarController@delall');
    Route::resource('car','template\CarController');



    //订单控制器
    Route::get('template/order/delall','template\OrderController@delall');
    Route::resource('order','template\OrderController');

    //角色控制器
    //给角色添加权限
    Route::get('template/role/auth/{id}','template\RoleController@auth');
    Route::post('template/role/doauth','template\RoleController@doauth');
    Route::get('template/role/showperm','template\RoleController@showperm');
    Route::get('template/role/change','template\RoleController@change');
    Route::get('template/role/delall','template\RoleController@delall');
    Route::resource('role','template\RoleController');

    //权限控制器
    Route::get('template/perm/change','template\PermController@change');
    Route::get('template/perm/delall','template\PermController@delall');
    Route::resource('perm','template\PermController');

    //权限分类控制器
    Route::get('template/perm_cate/showperm/{id}','template\Perm_cateController@showperm');
    Route::get('template/perm_cate/delall','template\Perm_cateController@delall');
    Route::resource('perm_cate','template\Perm_cateController');





});






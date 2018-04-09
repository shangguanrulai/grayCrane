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

Route::group(['middleware' => ['Gray']],function(){


// 前台首页
Route::get('/', 'Home\FirstController@index');

//前台登录
Route::get('Home/login','Home\LoginController@login');
Route::get('Home/yzm','Home\LoginController@yzm');
Route::post('Home/dologin','Home\loginController@dologin');
Route::get('Home/loginout','Home\loginController@loginout');

//前台注册
Route::get('Home/register','Home\RegisterController@register');
Route::get('Home/yanzhengma','Home\RegisterController@yanzhengma');
Route::post('Home/doregister','Home\RegisterController@doregister');

/**
 *前台ajax
 */
// 默认手机号
Route::get('/Home/ajax/user/{phone}','Home\AjaxController@user');
// 分类
Route::get('/Home/ajax/cate','Home\AjaxController@cate');
// 手机验证
Route::get('/Home/ajax/phone','Home\AjaxController@code_phone');
// 商品发布上传图
Route::post('/Home/ajax/release','Home\AjaxController@release');
// 用户头像上传图
Route::post('/Home/ajax/userinfo','Home\AjaxController@userinfo');
/**
*ajax结束
 */

// 前台中间件控制器
Route::group(['prefix'=>'Home','namespace'=>'Home','middleware'=>['Home_login']],function(){
// 前台消息
    Route::get('msg','MsgController@index');

// 前台用户收货地址
    Route::get('user/addr', 'AddrController@index');
    Route::get('user/addr_create', 'AddrController@create');
    Route::post('user/addr_store', 'AddrController@store');
    Route::get('user/addr_edit/{aid}/', 'AddrController@edit');
    Route::post('user/addr_update', 'AddrController@update');
    Route::get('user/addr_destroy/{aid}/', 'AddrController@destroy');

// 前台用户收藏
    Route::get('user/collect', 'CollectController@index');
    Route::get('user/collect_destroy/{id}/', 'CollectController@destroy');

// 前台订单
    Route::get('user/orders/sell', 'OrdersController@sell');
    Route::get('user/orders/send/{oid}', 'OrdersController@send');
    Route::get('user/orders/buy', 'OrdersController@buy');
    Route::get('user/orders/take/{oid}', 'OrdersController@take');

// 前台用户中心
    Route::get('user/pass', 'UserController@pass');
    Route::post('user/update_pass', 'UserController@update_pass');
    Route::get('user/paypass', 'UserController@paypass');
    Route::post('user/update_paypass', 'UserController@update_paypass');
    Route::resource('user', 'UserController');

// 前台发布
    Route::get('release/update_release', 'ReleaseController@update_release');
    Route::get('release/destroy_release/{rid}/', 'ReleaseController@destroy_release');
    Route::resource('release', 'ReleaseController');


//商品收藏
    Route::get('/Home/goods/aaaaa','Home\GoodsController@ajaxs');
});


//商品分类
    Route::get('/Home/goods/index','Home\GoodsController@index');
    Route::get('/Home/goods/ajax','Home\GoodsController@ajax');
//商品筛选
    Route::get('/Home/goods/choose','Home\GoodsController@choose');

//商品详情
    Route::get('/Home/goods/details','Home\GoodsController@details');

// 回复留言
    Route::get('/Home/goods/ccccc','Home\GoodsController@ajaxsss');
//删除留言
    Route::get('/Home/goods/ddddd','Home\GoodsController@ajaxssss');
//订单提交ajax
    Route::get('/Home/goods/eeeee','Home\GoodsController@ajaxsssss');

//留言
    Route::get('/Home/goods/bbbbb','Home\GoodsController@ajaxss');

//购买商品
    Route::get('/Home/goods/buy/{rid}','Home\GoodsController@buy');

//付款
    Route::get('/Home/goods/pay','Home\GoodsController@pay');
//购买成功
    Route::get('/Home/goods/success','Home\GoodsController@success');
//添加收货地址
    Route::get('/Home/goods/address','Home\GoodsController@address');

});







// 后台
Route::get('/login', function () {
    return view('template.logins.login');
});

//加密
Route::get('jiami','Admin\LoginController@jiami');

Route::get('noaccess',function(){
    return view('template.error.auth');
});

//退出登录
Route::get('/login/exit','template\LoginController@exit');

//生成验证码路由
Route::get('/login/code','Template\LoginController@code');
Route::post('/login/dologin','template\LoginController@doLogin');


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
    Route::get('template/userHome/change','template\UserHomeController@change');
    Route::resource('userHome','template\UserHomeController');

    //后台分类控制器
    Route::get('template/cate/delall','template\CateController@delall');
    Route::resource('cate','template\CateController');

	//后台商品
    Route::get('goods/index','template\GoodsController@index');
    Route::get('goods/change','template\GoodsController@change');
    Route::get('goods/del/{rid}','template\GoodsController@del');
    //留言管理
    Route::get('goods/details/{rid}','template\GoodsController@details');
    Route::get('goods/delete/{wid}','template\GoodsController@delete');


    //后台网站配置控制器
    Route::get('template/config/putFile','template\ConfigController@putFile');
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









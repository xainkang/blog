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

//Route::get('admin/jiami','Admin\LoginController@jiami');
//后台登录路由
Route::group(['prefix'=>'admin','namespace'=>'Admin'],function (){
    Route::get('login','LoginController@login');
//验证码路由
    Route::get('code','LoginController@code');
//表单验证
    Route::post('dologin','LoginController@doLogin');
//加密
    Route::get('jiami','LoginController@jiami');
});



Route::group(['prefix'=>'admin','namespace'=>'Admin','middleware'=>'isLogin'],function (){
    Route::get('index','LoginController@index');
    Route::get('welcome','LoginController@welcome');
    Route::get('logout','LoginController@logout');
    Route::get('user/list','LoginController@list');
    //用户后台模块
    Route::resource('user','UserController');
    Route::get('user/del','UserController@delAll');


    //角色模块
    Route::resource('role','RoleController');
    Route::get('role/auth/{id}','RoleController@auth');
    Route::post('role/doauth','RoleController@doauth');

    //角色授权模块
    Route::resource('permission','PermissionController');

});






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

Route::get('/', function () {
    return view('welcome');
});
//后台登录路由
Route::get('admin/login','Admin\LoginController@login');
//验证码路由

Route::get('admin/code','Admin\LoginController@code');
Route::get('/code/captcha/{tmp}','Admin\LoginController@capcha');
//表单验证
Route::post('admin/dologin','Admin\LoginController@doLogin');
//加密
Route::get('admin/jiami','Admin\LoginController@jiami');
Route::get('layouts/admin','Admin\LoginController@admin');

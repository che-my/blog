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

Route::group(['namespace' => 'Admin'], function () {
    Route::get('/dashboard', 'AdminController@index'); //后台首页
    Route::get('/admin/profile','AdminController@adminInfo');//管理员资料
    Route::get('/admin/users','UserController@index');//用户管理界面
    Route::get('/admin/article/index','ArticleController@index');//文章列表界面
    Route::get('/admin/article/create','ArticleController@create');//创建文章

    //用户操作
    Route::get('/admin/users/add','UserController@add');//用户添加界面
	Route::get('/admin/users/insert','UserController@insert');//用户添加操作
	Route::get('/admin/users/edit','UserController@edit');//用户编辑界面
	Route::get('/admin/users/update','UserController@update');//用户编辑操作
	Route::get('/admin/users/delete','UserController@delete');//用户删除操作
	Route::get('/admin/users/moredel','UserController@moredel');//用户批量删除操作
});







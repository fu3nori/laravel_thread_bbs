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

use App\Http\Middleware\AdminMiddleware;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/start', 'StartController@index');
Route::post('/start', 'StartController@post');
Route::get('/start/view', 'StartController@view');
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

// カテゴリID
//Route::get('category/','CategoryController@index');
Route::get('/category/view/{id}','CategoryController@view');
Route::get('/category/','CategoryController@index');
// 板ID
Route::get('/board/{id}','BoardController@index');
Route::post('/board/post','BoardController@post');
Route::post('/board/res','BoardController@res');

// スレ一覧・スレ単独表示
Route::get('/thread/list/{id}','ThreadController@list');
Route::get('/thread/view/{id}','ThreadController@view');
// スレ単独から投稿
Route::post('/thread/post','ThreadController@post');

// 管理者権限ミドルウェアで管理するページ


Route::group(['middleware' => 'admin'], function() {
    Route::get('/admin', 'AdminController@index');
    Route::post('/admin', 'AdminController@index');
    Route::post('/admin/edit', 'AdminController@edit');
    Route::get('/admin/edit', 'AdminController@edit');
    Route::get('/thread_admin' , 'ThreadAdminController@index');
    Route::get('/thread_admin/category' , 'ThreadAdminController@category');
    Route::post('/thread_admin/category' , 'ThreadAdminController@category');
    Route::get('/thread_admin/board' , 'ThreadAdminController@board');
    Route::post('/thread_admin/board' , 'ThreadAdminController@board');

    Route::get('/thread_admin/thread' , 'ThreadAdminController@thread');
    Route::post('/thread_admin/thread' , 'ThreadAdminController@thread');

    Route::get('/thread_admin/thread_res' , 'ThreadAdminController@thread_res');
    Route::post('/thread_admin/thread_res' , 'ThreadAdminController@thread_res');

});

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


// 管理者権限ミドルウェアで管理するページ


Route::group(['middleware' => 'admin'], function() {
    Route::get('/admin', 'AdminController@index');
    Route::post('/admin', 'AdminController@index');
    Route::post('/admin/edit', 'AdminController@edit');
});

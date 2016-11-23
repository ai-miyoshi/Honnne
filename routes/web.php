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
// ログイン/ログアウト？
Auth::routes();
// 上記についてきたやつ
Route::get('/home', 'HomeController@index');

// アイテム一覧表示
Route::get('/items', 'ItemsController@index');
// アイテム個別ページ
Route::get('/item/{id}', 'ItemsController@show');

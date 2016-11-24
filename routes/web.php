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

// アイテム一覧
Route::get('/items', 'ItemsController@index');

// アイテム一覧＋レビュー一覧
Route::get('/items/{id}', 'ItemsController@show');

// レビュー投稿
Route::post('/reviews', 'ReviewsController@create');

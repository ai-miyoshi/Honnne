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

// カテゴリのアイテム一覧
Route::get('/categories/{id}', 'ItemsController@index');

// アイテム詳細＋レビュー一覧
Route::get('/items/{id}', 'ItemsController@show');
// 参考になった->はい
Route::post('/items/{id}', 'ReviewsController@store');

// レビュー投稿
Route::post('/reviews', 'ReviewsController@create');



// カテゴリ一覧
Route::get('/categories', 'CategoriesController@index');
// 管理ページ
Route::get('/admin', 'ItemsController@create');
Route::post('/admin', 'ItemsController@store');
// コメントの投稿
Route::post('/comment', 'CommentsController@store');

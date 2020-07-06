<?php

use Illuminate\Support\Facades\Route;



Auth::routes(['verify' => true]);

Route::get('/', 'PostController@index')->name('posts.index'); /**-スレッド一覧- */
Route::get('/posts/search', 'PostController@search')->name('posts.search');/**-スレッド検索- */
Route::resource('/posts', 'PostController',  ['except' => ['index']]);/**-ポストのレストフル- */
Route::resource('/users', 'UserController');/**-スレッド一覧- */
Route::resource('/comments', 'CommentController')->middleware('auth');/**-コメントへの遷移　ログインしていないとログインページへ飛ぶ- */
Route::get('/home', 'HomeController@index')->name('home');/**-ホームへ遷移- */
Route::get('/user/pro', 'UserController@pro')->name('user.pro');/**-ユーザープロフィール更新へ遷移- */
Route::post('/user/profile', 'UserController@profile')->name('user.profile');/**-プロファイル更新コントローへ遷移- */

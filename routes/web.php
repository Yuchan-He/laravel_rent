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

Route::get('/', 'Front\ArticleController@index') -> name('home');

// ユーザーのrouteを入れる
// ('front/front.php');
include base_path('routes/front/front.php');


// 管理者のrouteを入れる
// ('admin/admin.php');
include base_path('routes/admin/admin.php');

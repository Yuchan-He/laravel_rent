<?php
// frontのroute

// prefix:routeの前置きの名前を設定
// namespace:関連するcontrollerの前置きの名前を設定
Route::group(['prefix' => 'front', 'namespace' => 'Front','as' => 'front.'],function(){

	// like機能、resourceの上に置く,post表示文章id，用正则限制只能为数字
	Route::get('posts/{post}/like','CollectionController@like') -> where('post',['0-9+']);
	Route::get('posts/{post}/unlike','CollectionController@unlike') -> where('post',['0-9+']);

	// home page画面表示
	// --文章管理
	Route::resource('article','ArticleController');

	// 新規登録（signup）
	// --signup 画面
	Route::get('signup','SignupController@index') -> name('signup');
	// --signup　検証&提出画面
	Route::post('signup','SignupController@signup') -> name('signup');	

	// login画面表示
	Route::get('login','LoginController@index') -> name('login');
	// loginデータの検証処理
	Route::post('login','LoginController@login') -> name('login');

	// logout画面
	Route::get('logout','LoginController@logout') -> name('logout');


});
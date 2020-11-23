<?php

// frontのroute

// prefix:routeの前置きの名前を設定
// namespace:関連するcontrollerの前置きの名前を設定
Route::group(['prefix' => 'front', 'namespace' => 'Front','as' => 'front.'],function(){

	// Route::get('category/{id}','CategoryController@show') -> name('category.show');
	// home page画面表示
	// --文章管理
	Route::resource('article','ArticleController');

	// --comment管理
	Route::resource('comment','CommentController');

	// 新規登録（signup）
	// --signup 画面
	Route::get('signup','SignupController@index') -> name('signup');
	// --signup　ユーザー名唯一性検証画面
	Route::post('signupUsername','SignupController@signupUsername') -> name('signupUsername');	
	// --signup　検証&提出画面
	Route::post('signup','SignupController@signup') -> name('signup');	

	// login画面表示
	Route::get('login','LoginController@index') -> name('login');
	// loginデータの検証処理
	Route::post('login','LoginController@login') -> name('login');

	// logout画面
	Route::get('logout','LoginController@logout') -> name('logout');



	
});
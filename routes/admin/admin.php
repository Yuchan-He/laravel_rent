<?php
// 管理者のroute

// prefix:routeの前置きの名前を設定
// namespace:関連するcontrollerの前置きの名前を設定
Route::group(['prefix' => 'admin', 'namespace' => 'Admin'],function(){
	// login画面表示
	Route::get('login','LoginController@index') -> name('admin.login');
	// loginデータの検証処理
	Route::post('login','LoginController@login') -> name('admin.login');

	Route::group(['middleware' => ['ckadmin']],function(){
		// login成功画面の画面表示
		Route::get('index','IndexController@index') -> name('admin.index'); 
		// login成功welcome画面
		Route::get('welcome','IndexController@welcome') -> name('admin.welcome');
		/*
		|---------------------------------
		| ユーザー管理
		|---------------------------------
		*/
		// ユーザーリスト画面
		Route::get('user/index','UserController@index') -> name('admin.user.index');
		// ユーザー追加画面
		Route::get('user/add','UserController@create') -> name('admin.user.create');
		// ユーザー追加機能
		Route::post('user/add','UserController@store') -> name('admin.user.store');
		// ユーザー削除機能
		Route::delete('user/del/{id}','UserController@del') -> name('admin.user.del');


	});

	// logout画面
	Route::get('logout','IndexController@logout') -> name('admin.logout');

});
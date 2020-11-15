<?php
// 管理者のroute

// prefix:routeの前置きの名前を設定
// namespace:関連するcontrollerの前置きの名前を設定
Route::group(['prefix' => 'admin', 'namespace' => 'Admin'],function(){
	// login画面表示
	Route::get('login','LoginController@index') -> name('admin.login');
	// loginデータの検証処理
	Route::post('login','LoginController@login') -> name('admin.login');

	Route::group([
		'middleware' => ['ckadmin'],
		'as' => 'admin.'
		],function(){
		// login成功画面の画面表示
		Route::get('index','IndexController@index') -> name('index'); 
		// login成功welcome画面
		Route::get('welcome','IndexController@welcome') -> name('welcome');
		/*
		|---------------------------------
		| ユーザー管理
		|---------------------------------
		*/
		// ユーザーリスト画面
		Route::get('user/index','UserController@index') -> name('user.index');
		// ユーザー追加画面
		Route::get('user/add','UserController@create') -> name('user.create');
		// ユーザー追加機能
		Route::post('user/add','UserController@store') -> name('user.store');
		// ユーザー削除機能
		Route::delete('user/del/{id}','UserController@del') -> name('user.del');

		// 削除したユーザー画面
		Route::get('user/deleted','UserController@indexdeleted') -> name('user.indexdeleted');
		// 削除したユーザー復元画面
		Route::get('user/restore/{id}','UserController@restore') -> name('user.restore');
		// 削除したユーザー永久削除画面
		Route::delete('user/deleted/{id}','UserController@deleted') -> name('user.deleted');

		// ユーザー情報編集機能
		Route::get('user/edit/{id}','UserController@edit') -> name('user.edit');
		Route::put('user/edit/{id}','UserController@update') -> name('user.update');

		// ユーザー情報角色分配，match为简易写法，支持多重提交方式
		Route::match(['get','post'],'user/role/{id}','UserController@updateRole') -> name('user.role');


		// 分配权限查看页面
		Route::get('role/node/{role}','RoleController@node') -> name('role.node');
		// 分配权限修改页面
		Route::post('role/node/{role}','RoleController@nodeSave') -> name('role.node');


		// RBAC權限管理--role
		Route::resource('role','RoleController');

		// RBAC權限管理--node
		Route::resource('node','NodeController');


	});

	// logout画面
	Route::get('logout','IndexController@logout') -> name('admin.logout');

});
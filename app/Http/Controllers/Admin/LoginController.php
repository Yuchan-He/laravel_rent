<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    /**
    * @param null 
    * @return view login画面
    */
    public function index(){
        //　ユーザーの登録状態を確認、すでにログインのユーザーは直接ログイン画面に行く
        if (auth() ->guard('admin')-> check()){
            return redirect(route('admin.index'));
        }else{
    	   return view('admin.login.login');
        }
        
    }

	/**
	* 検証ログインのデータ
    * @param Request $request 
    * @return login 成功画面
    */
    public function login(Request $request){
        //  提出のデータをチェックする
    	$post = $this ->validate($request,
    		['username' => 'required',
    		 'password' => 'required'
    		
    	]);
        //  提出のデータをDBでチェックする
        $bool = auth() -> guard('admin') -> attempt($post);
        if(!$bool){
            return redirect(route('admin.login')) -> withErrors(['error' => 'ユーザー名か、パスワードが間違っています']);
        }else{
            $data = auth() -> guard('admin') -> user() -> toArray();
            return redirect(route('admin.index'));
        }
                


    }


}

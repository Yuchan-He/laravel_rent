<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Hash;

class SignupController extends Controller
{	
	/** 
	* @param null 
	* 新規登録（signup)画面
	*/
	public function index(){
		return view('front.login.signup');
	}

	/** 
	* @param null 
	* 新規登録（signup)画面
	*/
	public function signup(Request $request){
    	// ユーザが提出したデータを検証する
        $this ->validate($request,
            ['username' => 'required | unique:users,username',
             'password' => 'required'       
            ]);

        // 更新するデータをフィルターする
        $post = $request -> except(['_token']);
        $post['password'] = bcrypt($request -> password);
        $userModel = User::create($post);
        if(!$userModel){
        	return redirect(route('front.login.signup') -> with('status',0)); 
        }
        // return view('front.login.login') -> with('success','登録成功しました、ログインしてくだい') ;
        return redirect(route('front.login')) -> with('success','登録成功しました、ログインしてくだい');
	}


}

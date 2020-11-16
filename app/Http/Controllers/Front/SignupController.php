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
	* 新規登録（signupUsername)画面
	*/
	public function signupUsername(Request $request){
        // ユーザが提出したデータを検証する
        
        $username = $this ->validate($request,
            ['username' => 'required | unique:users,username']); 

        if(!$username){
            $data = 0;
            return $data;
        }else{
            $data = 1;
            return $data;            
        }

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
            return redirect(route('front.login.signup')); 
        }
        // return view('front.login.login') -> with('success','登録成功しました、ログインしてくだい') ;
        // session(['success' => '登録成功しました、ログインしてくだい']);
        // return view('front.login.login');
        // 登录成功后，处于登录状态，所以要先退出登录状态，让用户重新登录
        auth() ->guard('admin')-> logout();
        return redirect(route('front.login')) -> with('success','登録成功しました、ログインしてくだい');
    }    


}

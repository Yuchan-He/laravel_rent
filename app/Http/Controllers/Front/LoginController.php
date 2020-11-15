<?php

namespace App\Http\Controllers\Front;

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

            return redirect(route('front.article.index'));
        }else{

    	   return view('front.login.login');
        }
        // return view('front.login.login');
        
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
        //  提出のデータをDBでチェックする,用户和管理员都在user table中，所以使用同样的guard
        $bool = auth() -> guard('admin') -> attempt($post);
        if(!$bool){
            return redirect(route('front.login')) -> withErrors(['error' => 'ユーザー名か、パスワードが間違っています']);
        }else{
            // $data = auth() -> guard('admin') -> user() -> toArray();
            //  ユーザーの権限を取得
            $data = auth() -> guard('admin') -> user();
            $roleModel_3 = $data -> role;
            // 从关联模型中，获得用户节点
            $node =  $roleModel_3 -> nodes() -> pluck('name','node_id') -> toArray();
            // dump($node);
            // 权限保存到session中
            session(['admin.node' => $node]);            

            return redirect(route('front.article.index')) -> with('status',1);
        }           
    }

    /**
    * @param null 
    * @return view login画面
    */
    public function logout(){
        auth() ->guard('admin')-> logout();
        return redirect(route('front.article.index'));
        
    }    

}

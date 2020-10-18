<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{

    // login成功画面の画面表示
    public function index(){
    	return view('admin.index.index');
    }

    // login成功welcome画面
    public function welcome(){
    	return view('admin.index.welcome');
    }

    // logout画面
    public function logout(){
    	auth() ->guard('admin')-> logout();
		return redirect(route('admin.login')) -> with('success','please login');
    }
}

<?php
// adminでユーザー管理
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
// use App\Http\Controllers\Controller;
// userデータのモデルを入れる

use App\Models\User;

class UserController extends BaseController
{
    /**
    * ユーザーリスト画面
    * @param null 
    * @return ユーザーリスト画面
    */
    public function index(){

    	$data = User::orderBy('id','desc') -> paginate($this -> pagesize);
    	return view('admin.user.index',compact('data'));
    }

	/**
    * ユーザー追加画面
    * @param null 
    * @return view
    */
    public function create(){
    	return view('admin.user.create');
    }


	/**
    * ユーザー追加機能
    * @param Reqquest $request
    * @return data
    */
    public function store(Request $request){
    	// ユーザーが提出したデータを検証する
        $this ->validate($request,
            ['username' => 'required | unique:users,username',
             'password' => 'required | confirmed',
             'mobile' => 'required | mobile',
             'email' => 'required',
             'sex' => 'required'           
            ]);

        // 选择要入库数据
        $post = $request -> except(['_token','password_confirmation']);
        // dump($post);
        // $userModel = User::create($post);
        $userModel = User::create($post);
        // 入库成功，跳转到列表页面
        // return view('admin.user.index');
        // return view(route('admin.user.index'));
        // return redirect(route('admin.user.index')); 
        return $userModel ? '添加用户成功' : '添加失败';
    
    }

    /**
    * ユーザー削除機能
    * @param Request $request
    * @return null
    */
    public function del(int $id){

        return $id;

        // 削除の対象が自分かどうか判定する
        // $id = $request -> get('id');
        // User::find($id);
        // if(User::find($id)){
        //     return '自己不能删除自己'
        // }else{
        //     User::update('deleted_at') = time()+data();

        //     return view('admin.user.create');
        // }
    }

    
}

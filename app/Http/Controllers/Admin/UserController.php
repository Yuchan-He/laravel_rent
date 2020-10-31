<?php
// adminでユーザ管理
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
// use App\Http\Controllers\Controller;
// userデータのモデルを入れる
use App\Models\User;
// 密码加密的明文是否对应
use Hash;

class UserController extends BaseController
{
    /**
    * ユーザリスト画面 + 用户查询功能
    * @param id
    * @return ユーザリスト画面
    */
    public function index(Request $request){
        // 获取搜索框数据
        $kw = $request -> get('kw');

        // 分页列表搜索
        // when 来判断$kw, $kw存在时候，为真，则执行匿名函数，继续下面的代码，否则不执行
        // 由于使用匿名函数，使用外部变量，所以用到use
        $data = User::when($kw, function($query) use($kw) {
            $query -> where('username','like',"%{$kw}%");
        }) -> orderBy('created_at','desc') -> paginate($this -> pagesize);

    	// $data = User::orderBy('id','desc') -> paginate($this -> pagesize);
    	return view('admin.user.index',compact('data','kw'));
    }

	/**
    * ユーザ追加画面
    * @param null 
    * @return view
    */
    public function create(){
    	return view('admin.user.create');
    }


	/**
    * ユーザ追加機能
    * @param Reqquest $request
    * @return data
    */
    public function store(Request $request){
    	// ユーザが提出したデータを検証する
        $this ->validate($request,
            ['username' => 'required | unique:users,username',
             'password' => 'required | confirmed',
             'mobile' => 'required | mobile',
             'email' => 'required',
             'sex' => 'required'           
            ]);

        // 选择要入库数据
        $post = $request -> except(['_token','password_confirmation']);
        $post['password'] = bcrypt($request -> password);
        // dump($post);
        // $userModel = User::create($post);
        $userModel = User::create($post);
        // 入库成功，跳转到列表页面
        // return view('admin.user.index');
        // return view(route('admin.user.index'));
        // return redirect(route('admin.user.index')); 
        return $userModel ? '添加用户成功' : '添加失败';
        // dump($post);
    
    }

    /**
    * ユーザ削除機能
    * @param Request $request
    * @return null
    */
    public function del(int $id){
        // 用户删除(真删除，数据不保存)
        User::find($id) -> delete();
        return ['status' => 0,'msg' => 'ユーザ―を削除しました'];

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

    /**
    * ユーザ編集表示画面
    * @param id
    * @return view
    */
    public function edit(int $id){
        $model = User::find($id);
        // 返回id对应的值，可在视图中设置显示
        return view('admin.user.edit',compact('model'));
    }


    /**
    * ユーザ編集提出画面
    * @param id
    * @return view　id
    */
    public function update(Request $request,int $id){
        // 更新操作，先查询，后更新
        $model = User::find($id);
        $password = $model -> password;
        // 修改信息时候，验证用户输入的密码
        $spass = $request -> get('spassword');

        // dump($model); //根据id查询到服务器中客户的密码
        // dump($spass); //获取用户在html中输入的原有密码

        // 验证用户输入的密码和服务器的密码是否一致，由于生成用户密码hash了，所以要用hash验证
        // 顺序不能颠倒，否则无法验证 $bool = Hash::check($password，$spass);
        // 如果密码没有hash化，用hash验证也会出错

        $bool = Hash::check($spass,$password);
        if($bool){
            $data = $request -> except(['_token','password_confirmation','spassword']);
            if(!empty($data['password'])){
                $data['password'] = bcrypt($request -> password);
            }else{
                // $data = $request -> except(['_token','password_confirmation','spassword','password']);
                // 否则移除password
                unset($data['password']);
            }
            $model -> update($data);
            return redirect(route('admin.user.index')) -> with('success','情報を更新しました'); 
        }else{
            return redirect(route('admin.user.edit',$model)) -> withErrors(['error' => '元パスワードが一致しておりません']);
            // dump($model); //根据id查询到服务器中客户的密码
            // dump($password);
            // dump($spass); //获取用户在html中输入的原有密码
        }
        
    }
    
}

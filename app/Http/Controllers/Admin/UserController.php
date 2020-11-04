<?php
// adminでユーザ管理
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Models\User;
use Hash;

class UserController extends BaseController
{
    /**
    * ユーザリスト画面 + 用户查询功能
    * @param id
    * @return ユーザリスト画面
    */
    public function index(Request $request){
        // 検索のデータを取得
        $kw = $request -> get('kw');
        // modelのデータ合計を取得
        $sum = User::count();

        // 検索の内容はUserにあるかどうか判断する
        $data = User::when($kw, function($query) use($kw) {
            $query -> where('username','like',"%{$kw}%");
        }) -> orderBy('created_at','desc') -> paginate($this -> pagesize);
        
    	return view('admin.user.index',compact('data','kw','sum'));
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

        // 更新するデータをフィルターする
        $post = $request -> except(['_token','password_confirmation']);
        $post['password'] = bcrypt($request -> password);
        $userModel = User::create($post);
        return $userModel ? '新しいユーザーを追加しました' :'ユーザーを追加失敗しました';
 
    
    }

    /**
    * ユーザ削除機能
    * @param Request $request
    * @return null
    */
    public function del(int $id){
        User::find($id) -> delete();
        return ['status' => 0,'msg' => 'ユーザ―を削除しました'];
    }

    /**
    * 削除したユーザ画面
    * @param 
    * @return null
    */
    public function indexdeleted(){

        // 削除したユーザーを抽出
        $deletedUsers = User::onlyTrashed() -> get();
        return view('admin.user.deleted',compact('deletedUsers'));
    }

    /**
    * ユーザーを復元機能
    * @param Request $request
    * @return null
    */
    public function restore(int $id){
        User::onlyTrashed() -> where('id',$id) ->restore();
        return redirect(route('admin.user.indexdeleted')) -> with('success','ユーザーを復元しました。ユーザーリストに確認ください');
    }

    /**
    // * ユーザーを永久削除機能
    // * @param Request $request
    // * @return null
    // */
    public function deleted(int $id){
        User::onlyTrashed() -> where('id',$id) ->forceDelete();
        return ['status' => 0,'msg' => 'ユーザーを永久に削除しました'];
    }


    /**
    * ユーザ編集表示画面
    * @param id
    * @return view
    */
    public function edit(int $id){
        $model = User::find($id);
        return view('admin.user.edit',compact('model'));
    }


    /**
    * ユーザ編集提出画面
    * @param id
    * @return view　id
    */
    public function update(Request $request,int $id){

        
        $model = User::find($id);
        $password = $model -> password;
        // パスワードを検証する
        $spass = $request -> get('spassword');
        $bool = Hash::check($spass,$password);
        if($bool){
            $data = $request -> except(['_token','password_confirmation','spassword']);
            if(!empty($data['password'])){
                $data['password'] = bcrypt($request -> password);
            }else{
                unset($data['password']);
            }
            $model -> update($data);
            return redirect(route('admin.user.index')) -> with('success','情報を更新しました'); 
        }else{
            return redirect(route('admin.user.edit',$model)) -> withErrors(['error' => '元パスワードが一致しておりません']);
        }
        
    }
    
}

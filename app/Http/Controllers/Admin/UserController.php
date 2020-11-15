<?php
// adminでユーザー管理
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Models\User; // = use app\Models\User 
use App\Models\Role;
use Hash;

class UserController extends BaseController
{
    /**
    * ユーザーリスト画面 + 用户查询功能
    * @param id
    * @return ユーザーリスト画面
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

        // 更新するデータをフィルターする
        $post = $request -> except(['_token','password_confirmation']);
        $post['password'] = bcrypt($request -> password);
        $userModel = User::create($post);
        return $userModel ? '新しいユーザーを追加しました' :'ユーザーを追加失敗しました';
 
    
    }

   
    /**
    * ユーザー削除機能
    * @param Request $request
    * @return null
    */
    public function del(int $id){
        User::find($id) -> delete();
        return ['status' => 0,'msg' => 'ユーザー―を削除しました'];
    }

    /**
    * 削除したユーザー画面
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
    * ユーザー編集表示画面
    * @param id
    * @return view
    */
    public function edit(int $id){
        $model = User::find($id);
        return view('admin.user.edit',compact('model'));
    }


    /**
    * ユーザー編集提出画面
    * @param id
    * @return view　id
    */
    public function update(Request $request,int $id){
        // username 検証
        $username = $this ->validate($request,
            ['username' => 'required | unique:users,username',          
            ]);
        
        $model = User::find($id);
        $password = $model -> password;
        // パスワードを検証する
        $spass = $request -> get('spassword');
        $bool = Hash::check($spass,$password);
        if($bool && $username){
            $data = $request -> except(['_token','password_confirmation','spassword']);
            if(!empty($data['password'])){
                $data['password'] = bcrypt($request -> password);
            }else{
                unset($data['password']);
            }
            $model -> update($data);
            return redirect(route('admin.user.index')) -> with('success','情報を更新しました'); 
        }else{
            return redirect(route('admin.user.edit',$model)) -> withErrors(['error_pw' => 'パスワードが一致しておりません']);
        }
        
    }

    /**
    * ユーザー角色变更跳转画面
    * @param id
    * @return view
    */
    public function updateRole(Request $request,int $id){
        // 路由设置match,所以要在此处判断提交方式，选择跳转路径

        // 判断是否是post
        if($request -> isMethod('post')){
            // 必须要输入选项
            $post = $this -> validate($request,[
                'role_id' => 'required'
            ],['role_id.required' => '役割をご選択ください']);
            User::find($id) -> update($post);
            return redirect(route('admin.user.index')) -> with('success','情報を更新しました');


        }
        // 不是post,就get显示，显示用户现有角色和所有角色
        $roleAll = Role::all();
        // dump($user ->toArray()) ;
        // dump($user -> toArray());
        // dump($id);
        // dump($roleAll);
        // dump($user);
        $role_id = User::where('id',$id) -> pluck('role_id') -> toArray();
        // dump($role_id);
        return view('admin.user.role',compact('id','role_id','roleAll'));
    }    

    
}

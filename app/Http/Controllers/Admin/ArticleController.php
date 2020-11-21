<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Article;
// use App\Models\User;

// 'Storage' => Illuminate\Support\Facades\Storage::class,
use Storage;

class ArticleController extends BaseController
{
    /**
    * リスト画面 + 查询功能
    * @param id
    * @return リスト画面
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // 用户权限判断，如果是一般用户，只显示自己的文章
        $role = auth() -> guard('admin') -> user() -> role_id;
        $user_id = auth() -> guard('admin') -> user() -> id;
        // $user_article = $user_id -> article() -> title;

       // $user_article = User::with('article') -> where('id',$user_id) -> get() -> toArray();
        $user_article = Article::where('user_id','=',$user_id) -> pluck('title');
        // dump($user_id);
        // dd($user_article);

        if($role == 4){
            // 検索のデータを取得
            $kw = $request -> get('kw');
            // modelのデータ合計を取得
            // $sum = Article::count();

            // 検索の内容はUserにあるかどうか判断する
            // $data =  Article::where('user_id','=',$user_id) -> orderBy('updated_at','desc') -> paginate($this -> pagesize);
            $user_article = Article::where('user_id','=',$user_id);
            $sum = $user_article ->count();
            $data = $user_article -> when($kw, function($query) use($kw) {
                $query -> where('title','like',"%{$kw}%");
            }) -> orderBy('updated_at','desc') -> paginate($this -> pagesize);

            return view('admin.article.index',compact('data','kw','sum'));

        }else{
            // 検索のデータを取得
            $kw = $request -> get('kw');
            // modelのデータ合計を取得
            $sum = Article::count();

            // 検索の内容はUserにあるかどうか判断する
            $data = Article::when($kw, function($query) use($kw) {
                $query -> where('title','like',"%{$kw}%");
            }) -> orderBy('updated_at','desc') -> paginate($this -> pagesize);

            return view('admin.article.index',compact('data','kw','sum'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        // $defaultPic = config('defaultPic.pic');
        // dump($defaultPic);
        return view('admin.article.create');        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function webuploader(Request $request)
    {
        // store article picture
        // $bool = $request -> hasFile('file');
        // $bool =$request -> file('file') -> isValid();
        // dump($bool);
        // dump($request);
        // sha1防止文件重名
        $file = $request -> file('file');
        if($request -> hasFile('file') && $file -> isValid()){
            // file 重命名
            $filename = sha1(time(). $file -> getClientOriginalName()) . '.' . $file -> getClientOriginalExtension();
            $movefile = $file -> path();
            Storage::disk('public') -> put($filename,file_get_contents($movefile));
            $result = [
                'success' => 'アップロード成功しました',
                'path' => '/storage/' . $filename
            ];           
        }else{
            $result = [

                'error' => 'アップロード失敗',
                'errorMsg' => $file -> getErrorMessage()
            ];
        }

        // 以json形式返回结果
        return response() -> json($result);

    }    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
// 
        $this ->validate($request,
            ['title' => 'required',
             'body' => 'required'         
            ]);
        $post = $request -> except(['_token']);
        $defaultPic = config('defaultPic.pic');

        // 没有上传文件时候，使用默认文件
        if(empty($request -> pic)){
            $post['pic'] = $defaultPic;
            // dump($post);
        }

        // $post = $request -> except(['_token']);
        $userModel = Article::create($post);
        return redirect(route('admin.article.create')) -> withErrors(['error' => '入力箇所を完了してください']);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
        //
        $model = Article::find($id);
        return view('admin.article.edit',compact('model'));        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // データ検証
        $bool = $this ->validate($request,
            ['title' => 'required',
             'body' => 'required'         
            ]);

        
        $model = Article::find($id);
        $post = $request -> except(['_token']);
        $defaultPic = config('defaultPic.pic');
        if(empty($request -> pic)){
            $post['pic'] = $defaultPic;
        }

        if($bool){
            $model -> update($post);
            return redirect(route('admin.article.index')) -> with('success','更新しました'); 
        }else{
            return redirect(route('admin.article.edit',$model)) -> withErrors(['error' => '更新失敗しました']);
        }       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        Article::find($id) -> delete();
        return ['status' => 0,'msg' => '削除しました'];        
    }
}

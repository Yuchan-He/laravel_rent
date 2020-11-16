<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Article;

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
        // 検索のデータを取得
        $kw = $request -> get('kw');
        // modelのデータ合計を取得
        $sum = Article::count();

        // 検索の内容はUserにあるかどうか判断する
        $data = Article::when($kw, function($query) use($kw) {
            $query -> where('title','like',"%{$kw}%");
        }) -> orderBy('created_at','desc') -> paginate($this -> pagesize);

        return view('admin.article.index',compact('data','kw','sum'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.article.create');        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // $this ->validate($request,
        //     ['title' => 'required',          
        //     ]);
        $pic = config('defaultPic');
        // if()
        // // 判断是否有上传文件,pic对应上传的name
        // dump($request -> hasFile('pic'));

        // // 更新するデータをフィルターする
        // $post = $request -> except(['_token']);
        // $userModel = Article::create($post);
        // return $userModel ? '追加しました' :'追加失敗しました';

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
        //
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
        return ['status' => 0,'msg' => '文章を削除しました'];        
    }
}

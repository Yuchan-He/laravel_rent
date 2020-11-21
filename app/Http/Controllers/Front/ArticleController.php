<?php

namespace App\Http\Controllers\Front;

use App\Models\Article;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\BaseController;

class ArticleController extends BaseController
{
    /**
     * Display a listing of the resource.
     * home page
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $data = Article::orderBy('updated_at','desc') -> paginate(6);
        return view('front.index.index',compact('data'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        // 对应的id用户取得数据
        $model = $article;
        // 获得文章所有评论
        $article_id = $article -> id;
        
        $comment = Comment::where('article_id','=',$article_id) -> get();
        // $comment = $article -> comment
        // $user_id = Comment::where('article_id','=',$article_id) -> pluck('user_id');
        // $username = User::where('id','=',$user_id) -> get();
        // dd($username);
        // dd($user_id);
        // dd($comment);
        // $username = $model -> where('id',$id) -> pluck('user_id') -> toArray(); 
        // dump($data);
        // dd($username);
        return view('front.index.single', compact('model','comment'));        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        //
    }
}

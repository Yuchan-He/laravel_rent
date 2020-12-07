<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Comment;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        // dd($request);
        $this ->validate($request,
            ['content' => 'required'         
            ]);
        $post = $request -> except(['_token']);
        // $id = $request -> article_id;
        // $defaultPic = config('defaultPic.pic');

        // 没有上传文件时候，使用默认文件
        // if(empty($request -> pic)){
        //     $post['pic'] = $defaultPic;
        //     // dump($post);
        // }

        // $post = $request -> except(['_token']);
        $userModel = Comment::create($post);
        // return $userModel ? '新しいユーザーを追加しました' :'ユーザーを追加失敗しました';
        return redirect(route('front.article.index')) -> withErrors(['error' => '入力箇所を完了してください']);
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
    public function edit($id)
    {
        //
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
    }
}

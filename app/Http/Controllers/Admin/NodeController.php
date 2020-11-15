<?php

namespace App\Http\Controllers\Admin;

use App\Models\Node;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 获取节点所有信息，用数据形式体现
        $data = Node::all();
        // dump($data);
        return view('admin.node.index',compact('data'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // 获取所有顶级id
        // $data = Node::where('pid','=','0') ->get();
        // return view('admin.node.create',compact('data'));
        return view('admin.node.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // ユーザーが提出したデータを検証する
        $this -> validate($request,[
            'name' => 'required | unique:nodes,name',
            'route_name' => 'required',
            'pid' => 'required',
            'is_menu' => 'required',
        ]);

        $post = $request -> except(['_token']);
        $Model = Node::create($post);
        return $Model ? '追加しました' :'追加失敗しました';
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Node  $node
     * @return \Illuminate\Http\Response
     */
    public function show(Node $node)
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Node  $node
     * @return \Illuminate\Http\Response
     */
    public function edit(Node $node)
    {
        $model = $node;
        // dump($node);
        return view('admin.node.edit',compact('model'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Node  $node
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Node $node)
    {
        //
        $data = $request -> except(['_token']);

        $node -> update($data);
        return redirect(route('admin.node.index')) -> with('success','情報を更新しました');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Node  $node
     * @return \Illuminate\Http\Response
     */
    public function destroy(Node $node)
    {
        //传递的是Node $node,所以要用 $node,如果传入的$id,下方也要用$id
        Node::destroy($node); 
        return ['status' => 0,'msg' => 'ユーザー―を削除しました'];
    }
}

<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
// 引入role model
use App\Models\Role;
use App\Models\Node;

class RoleController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 列表显示
        $data = Role::all();
        // 要和resource形成的名称一致
        return view('admin.role.index',compact('data'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.role.create');
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
            'roleName' => 'required | unique:roles,roleName'
        ]);

        $post = $request -> only(['roleName']);
        $roleModel = Role::create($post);
        return $roleModel ? '追加しました' :'追加失敗しました';

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
        $model = Role::find($id);
      
        return view('admin.role.edit',compact('model'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        $model = Role::find($id);
        $data = $request -> except(['_token']);

        $model -> update($data);
        return redirect(route('admin.role.index')) -> with('success','情報を更新しました');  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        Role::destroy($id); 
        return ['status' => 0,'msg' => 'ユーザーを削除しました'];

    }

    /**
     * 権限の按分
     *
     * @param  Role $role
     * @return \Illuminate\Http\Response
     */
    public function node(Role $role)
    {
        // 读取所有的权限
        $nodeAll = Node::get('name') -> toArray();
        // dump($nodeAll);
        // 读取当前用户所拥有的权限
        // dump($role -> nodes ->toArray());
        //nodes()  变为关联模型,关联模型中只取name列
        $nodes = ($role -> nodes() -> pluck('name') ->toArray());
        
        return view('admin.role.node',compact('nodeAll','nodes'));
    }

}

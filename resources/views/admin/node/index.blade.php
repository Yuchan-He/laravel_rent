
@extends('admin.common.main')

@section('css')
<link rel="stylesheet" type="text/css" href="/admin/static/h-ui.admin/css/style.css" />
@endsection

@section('content')

@include('admin.common.msg')
<nav class="breadcrumb">
	<i class="Hui-iconfont">&#xe67f;</i> Home 
	<span class="c-gray en">&gt;</span> 管理項目 
	<span class="c-gray en">&gt;</span> 権限管理
	<a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="更新" >
		<i class="Hui-iconfont">&#xe68f;</i>
	</a>
</nav>
<div class="page-container">
	<div class="cl pd-5 bg-1 bk-gray"> <span class="l"> 

		<a class="btn btn-primary radius" href="javascript:;" onclick="admin_node_add('権限追加','url','800')"><i class="Hui-iconfont">&#xe600;</i> 権限追加</a> </span> 
		
	</div>
	<table class="table table-border table-bordered table-hover table-bg">
		<thead>
			<tr>
				<th scope="col" colspan="6">角色管理</th>
			</tr>
			<tr class="text-c">
				<th width="25"><input type="checkbox" value="" name=""></th>
				<th width="40">ID</th>
				<th width="200">権限名称</th>
				<th>ルート名</th>
				<th width="300">メンユー判断</th>
				<th width="70">編集</th>
			</tr>
		</thead>
		<tbody>
			@foreach($data as $value)
			<tr class="text-c">
				<td><input type="checkbox" value="" name=""></td>
				<td>{{$value -> id}}</td>
				<td>{{$value -> name}}</td>
				<td>{{$value -> route_name}}</td>
				<td>{{$value -> is_menu}}</td>
				<td class="f-14">
					<a title="編集" href="{{route('admin.node.edit',['id' => $value ->id])}}" style="text-decoration:none" ><i class="Hui-iconfont">&#xe6df;</i>
					</a>  
					<a title="删除" href="{{route('admin.node.destroy',['id' => $value ->id])}}" class="ml-5 delbtn" style="text-decoration:none" ><i class="Hui-iconfont">&#xe6e2;</i>
					</a>
				</td>

			</tr>
			@endforeach

			
		</tbody>
	</table>
</div>
@endsection
@section('js')
<script type="text/javascript" src="/admin/lib/laypage/1.2/laypage.js"></script>
<script type="text/javascript">
// ユーザー追加のtoken csrfを追加
const _token = "{{csrf_token()}}";
// /*追加*/
function admin_node_add(title,url,w,h){
	layer_show(title,"{{route('admin.node.create')}}",w,h);
}

// ajaxを通して、deleteのリクエストを送る
$('.delbtn').click(function(evt) {
	// リクエストのurlを取得する
	let url = $(this).attr('href');

	$.ajax({
		url,
		data:{_token},
		type:'DELETE',
		dataType:'json'
	}).then(({status,msg}) => {
		if(status == 0) {
			// 削除成功メッセージ
			layer.msg(msg,{time:2000,icon:2},() => {
			// view中行を削除
			$(this).parents('tr').remove();			
			});
		}
	});

	// ディフォルト事件はhref画面に戻す、この事件をキャンセル
	return false;
});

</script>

@endsection
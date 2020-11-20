
@extends('admin.common.main')

@section('css')
<link rel="stylesheet" type="text/css" href="/admin/static/h-ui.admin/css/style.css" />
@endsection

@section('content')

@include('admin.common.msg')
<nav class="breadcrumb">
	<i class="Hui-iconfont">&#xe67f;</i> Home 
	<span class="c-gray en">&gt;</span> 管理項目 
	<span class="c-gray en">&gt;</span> 役割管理
	<a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="更新" >
		<i class="Hui-iconfont">&#xe68f;</i>
	</a>
</nav>
<div class="page-container">
	<div class="cl pd-5 bg-1 bk-gray"> <span class="l"> 

		<a class="btn btn-primary radius" href="javascript:;" onclick="admin_role_add('役割追加','url','800')"><i class="Hui-iconfont">&#xe600;</i> 役割追加</a> </span> 
		
	</div>
	<table class="table table-border table-bordered table-hover table-bg">
		<thead>
			<tr>
				<th scope="col" colspan="6">役割管理</th>
			</tr>
			<tr class="text-c">
				<th width="25"><input type="checkbox" value="" name=""></th>
				<!-- <th width="80">ID</th> -->
				<th width="300">役割</th>
				<th>権限</th>
			<!-- 	<th width="300">描述</th> -->
				<th >編集</th>
			</tr>
		</thead>
		<tbody>
			@foreach($data as $value)
			<tr class="text-c">
				<td><input type="checkbox" value="{{$value -> id}}" name="id[]"></td>
				<!-- <td>{{$value['id']}}</td> -->
				<td>{{$value['roleName']}}</td>
				<td><a href="{{route('admin.role.node',['id' => $value -> id])}}" class="label label-success radius">権限詳細</a></td>
		<!-- 		<td>拥有至高无上的权利</td> -->
				<td class="f-14">
					<a title="編集" href="{{route('admin.role.edit',['id' => $value -> id])}}" style="text-decoration:none" ><i class="Hui-iconfont">&#xe6df;</i>
					</a>  
					<a title="删除" href="{{route('admin.role.destroy',['id' => $value -> id])}}" class="ml-5 delbtn" style="text-decoration:none" ><i class="Hui-iconfont">&#xe6e2;</i>
					</a></td>
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
/*追加*/
function admin_role_add(title,url,w,h){
	layer_show(title,"{{route('admin.role.create')}}",w,h);
}
/*管理员-角色-编辑*/
// function admin_role_edit(title,url,w,h){
// 	layer_show(title,"{{route('admin.role.edit',['role' => $value -> id])}}",w,h);
// }
/*管理员-角色-删除*/
// function admin_role_del(obj,id){
// 	layer.confirm('本当に削除しますか？',function(index){
// 		$.ajax({
// 			type: 'POST',
// 			url: '',
// 			dataType: 'json',
// 			success: function(data){
// 				$(obj).parents("tr").remove();
// 				layer.msg('削除済み!',{icon:1,time:1000});
// 			},
// 			error:function(data) {
// 				console.log(data.msg);
// 			},
// 		});		
// 	});
// }

// function deleteAll(){
// 	layer.confirm('本当に削除しますか？',{btn:['OK','cancel']},() => {

// 			// 选中用户的ID
// 			let ids = $('input[name="id[]"]:checked');
// 			// 输出要删除的ID
// 			let id = [];
// 			// 循环
// 			$.each(ids,($key,val) => {
// 				// id.push($(val).val());
// 				// dom对象转为 jquery对象
// 				id.push(val.value);

// 			});
// 			console.log(id);

// 			$.ajax({
// 				,
// 				data:{_token},
// 				type:'DELETE',
// 				dataType:'json'
// 			}).then(({status,msg}) => {
// 				if(status == 0) {
// 					// 削除成功メッセージ
// 					layer.msg(msg,{time:2000,icon:2},() => {
// 					// view中行を削除
// 					$(this).parents('tr').remove();			
// 					});
// 				}
// 			});

// 			// ディフォルト事件はhref画面に戻す、この事件をキャンセル
// 			return false;

// 	});
// }

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
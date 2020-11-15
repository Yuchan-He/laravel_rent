
@extends('admin.common.main')

@section('css')
<link rel="stylesheet" type="text/css" href="/admin/static/h-ui.admin/css/style.css" />
@endsection

@section('content')

<nav class="breadcrumb">
	<i class="Hui-iconfont">&#xe67f;</i> Home 
	<span class="c-gray en">&gt;</span> 管理項目 
	<span class="c-gray en">&gt;</span> 削除したユーザー
	<a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="更新" >
		<i class="Hui-iconfont">&#xe68f;</i>
	</a>
</nav>
<!-- エラー情報の表示 -->
@include('admin.common.msg')
<div class="page-container">	
	<table class="table table-border table-bordered table-bg">
		<thead>
			<tr class="text-c">
				<th width="25"><input type="checkbox" name="" value=""></th>
				<th width="140">ユーザー名</th>
				<th width="150">携帯</th>
				<th width="150">メール</th>
				<th width="80">性別</th>
				<th width="130">削除時間</th>
				<th>編集</th>
				<!-- <th width="130">永久削除</th> -->
			</tr>
		</thead>
		<tbody>
			@foreach($deletedUsers as $value)
			<tr class="text-c">	
				<td>
				@if(auth() -> guard('admin')-> id() != $value -> id)
					<input type="checkbox" value="{{$value -> id}}" name="">
					
				</td>
				<td>{{$value -> username}}</td>
				<td>{{$value -> mobile}}</td>
				<td>{{$value -> email}}</td>
				@if($value -> sex==1)
					<td>女性</td>
				@elseif($value -> sex==2)
					<td>男性</td>
				@else
					<td>秘密</td>
				@endif
				<td>{{$value -> deleted_at}}</td>
				<td class="td-manage">
					<span><a title="復元" href="{{route('admin.user.restore',['id' => $value -> id])}}"  class="btn btn-success radius　restore" style="text-decoration:none">復元				
					</a></span>			
					<span><a title="永久削除" href="{{route('admin.user.deleted',['id' => $value -> id])}}" class="btn btn-warning radius delbtn" style="text-decoration:none">永久削除
					</a></span>
				@endif
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
/*ユーザー追加*/
function user_add(title,url,w,h){
	layer_show(title,url,w,h);
}

// ajaxを通して、復元のリクエストを送る
$('.restore').click(function(evt) {
	// リクエストのurlを取得する
	let url = $(this).attr('href');

	$.ajax({
		url,
		data:{_token},
		type:'',
		dataType:'json'
	}).then(({status,msg}) => {
		if(status == 1) {
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
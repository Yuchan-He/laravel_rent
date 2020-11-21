
@extends('admin.common.main')

@section('css')
<link rel="stylesheet" type="text/css" href="/admin/static/h-ui.admin/css/style.css" />
@endsection

@section('content')

<nav class="breadcrumb">
	<i class="Hui-iconfont">&#xe67f;</i> Home 
	<span class="c-gray en">&gt;</span> 管理項目 
	<span class="c-gray en">&gt;</span> 文章管理
	<a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="更新" >
		<i class="Hui-iconfont">&#xe68f;</i>
	</a>
</nav>
<!-- エラー情報の表示 -->
@include('admin.common.msg')
<div class="page-container">
	<form method="get" class="text-c">		
		<input type="text" class="input-text" style="width:250px" placeholder="タイトルの一部を入力" name="kw" value = "{{$kw}}" autocomplete="off">
		<button type="submit" class="btn btn-success"  name=""><i class="Hui-iconfont">&#xe665;</i> タイトル検索</button>
	</form>
	<div class="cl pd-5 bg-1 bk-gray mt-20"> 
		<span class="l">
			<!-- <a href="{{route('admin.article.create')}}"  class="btn btn-primary radius">
				<i class="Hui-iconfont">&#xe600;</i> 新規投稿
			</a> -->
		</span> <span class="r">合計：<strong> {{$sum}}</strong> 個　</span> </div>
	<table class="table table-border table-bordered table-bg">
		<thead>
			<tr class="text-c">
				<th width="25"><input type="checkbox" name="" value=""></th>
				<th width="220">タイトル</th>
				<th>摘要</th>				
				<th width="200">更新日</th>
				<th width="200">作成日</th>
				<th width="200">編集</th>
			</tr>
		</thead>
		<tbody>
			@foreach($data as $value)
			<tr class="text-c">	
				@if(auth() -> guard('admin')-> id() != $value -> id)
				<td>				
				<input type="checkbox" value="{{$value -> id}}" name="">	
				</td>

				<td>{{$value -> title}}</td>
				<td>{{$value -> desn}}</td>
				<td>{{$value -> updated_at}}</td>
				<td>{{$value -> created_at}}</td>
				<td class="td-manage">
					<a title="編集" href="{{route('admin.article.edit',['id' => $value -> id])}}"  class="ml-5" style="text-decoration:none">
						<i class="Hui-iconfont">&#xe6df;</i>
					</a>			
					<a title="削除" href="{{route('admin.article.destroy',['id' => $value -> id])}}" class="ml-5 delbtn" style="text-decoration:none">
						<i class="Hui-iconfont">&#xe6e2;</i>
					</a>
					@endif
				</td>
			</tr>
			@endforeach
			
		</tbody>
	</table>
	<!-- ページ数を設定する -->
	{{$data -> links()}}
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
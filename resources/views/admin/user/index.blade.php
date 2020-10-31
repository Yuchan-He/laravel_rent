
@extends('admin.common.main')

@section('css')
<link rel="stylesheet" type="text/css" href="/admin/static/h-ui.admin/css/style.css" />

<title>用户列表</title>
@endsection

@section('content')

<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 用户管理 <span class="c-gray en">&gt;</span> 用户列表 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a>
</nav>
<!-- エラー情報の表示 -->
@include('admin.common.msg')
<div class="page-container">
	<form method="get" class="text-c"> ユーザー検索：
		<!-- <input type="text" onfocus="WdatePicker({ maxDate:'#F{$dp.$D(\'datemax\')||\'%y-%M-%d\'}' })" id="datemin" class="input-text Wdate" style="width:120px;">
		-
		<input type="text" onfocus="WdatePicker({ minDate:'#F{$dp.$D(\'datemin\')}',maxDate:'%y-%M-%d' })" id="datemax" class="input-text Wdate" style="width:120px;"> -->
		<input type="text" class="input-text" style="width:250px" placeholder="输入用户名称" id="" name="kw" value = "{{$kw}}" autocomplete="off">
		<button type="submit" class="btn btn-success" id="" name=""><i class="Hui-iconfont">&#xe665;</i> 搜用户</button>
	</form>
	<div class="cl pd-5 bg-1 bk-gray mt-20"> 
		<span class="l">
			<a href="javascript:;" onclick="datadel()" class="btn btn-danger radius">
				<i class="Hui-iconfont">&#xe6e2;</i> 批量删除
			</a> 
			<a href="javascript:;" onclick="user_add('&nbsp;','/admin/user/add','800','500')" class="btn btn-primary radius">
				<i class="Hui-iconfont">&#xe600;</i> 添加用户
			</a>
		</span> <span class="r">共有数据：<strong>54</strong> 条</span> </div>
	<table class="table table-border table-bordered table-bg">
		<thead>
			<tr>
				<th scope="col" colspan="9">员工列表</th>
			</tr>
			<tr class="text-c">
				<th width="25"><input type="checkbox" name="" value=""></th>
				<th width="40">ID</th>
				<th width="150">登录名</th>
				<th width="90">手机</th>
				<th width="150">邮箱</th>
				<th>角色</th>
				<th width="130">删除时间</th>
				<th width="100">是否已启用</th>
				<th width="100">操作</th>
			</tr>
		</thead>
		<tbody>
			@foreach($data as $value)
			<tr class="text-c">	
				<td>
					@if(auth() -> guard('admin')-> id() != $value -> id)
					<input type="checkbox" value="{{$value -> id}}" name="">
					@endif
				</td>
				<td>{{$value -> id}}</td>
				<td>{{$value -> username}}</td>
				<td>{{$value -> mobile}}</td>
				<td>{{$value -> email}}</td>
				<td>{{$value -> sex}}</td>
				<td>{{$value -> deleted_at}}</td>
				<td class="td-status"><span class="label label-success radius">已启用</span></td>
				<td class="td-manage">
					<a style="text-decoration:none" onClick="admin_stop(this,'10001')" href="javascript:;" title="停用">
						<i class="Hui-iconfont">&#xe631;</i>
					</a> 
					
					<a title="编辑" href="{{route('admin.user.edit',['id' => $value -> id])}}"  class="ml-5" style="text-decoration:none">
						<i class="Hui-iconfont">&#xe6df;</i>
					</a>
					
					@if(auth() -> guard('admin') -> id() != $value -> id)
					<a title="删除" href="{{route('admin.user.del',['id' => $value -> id])}}" class="ml-5 delbtn" style="text-decoration:none">
						<i class="Hui-iconfont">&#xe6e2;</i>
					</a>
					@endif
				</td>
			</tr>
			@endforeach
			<!-- <tr class="text-c">
				<td><input type="checkbox" value="2" name=""></td>
				<td>2</td>
				<td>zhangsan</td>
				<td>13000000000</td>
				<td>admin@mail.com</td>
				<td>栏目编辑</td>
				<td>2014-6-11 11:11:42</td>
				<td class="td-status"><span class="label radius">已停用</span></td>
				<td class="td-manage"><a style="text-decoration:none" onClick="admin_start(this,'10001')" href="javascript:;" title="启用"><i class="Hui-iconfont">&#xe615;</i></a> <a title="编辑" href="javascript:;" onclick="admin_edit('用户编辑','admin-add.html','2','800','500')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i></a> <a title="删除" href="javascript:;" onclick="admin_del(this,'1')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a></td>
			</tr> -->
		</tbody>
	</table>
	<!-- ページ数を設定する -->
	{{$data -> links()}}
</div>
@endsection

@section('js')
<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="/admin/lib/My97DatePicker/4.8/WdatePicker.js"></script> 
<script type="text/javascript" src="/admin/lib/datatables/1.10.0/jquery.dataTables.min.js"></script> 
<script type="text/javascript" src="/admin/lib/laypage/1.2/laypage.js"></script>
<script type="text/javascript">
/*
	参数解释：
	title	标题
	url		请求的url
	id		需要操作的数据id
	w		弹出层宽度（缺省调默认值）
	h		弹出层高度（缺省调默认值）
*/

// 生成一个token csrf
const _token = "{{csrf_token()}}";
/*用户-增加*/
function user_add(title,url,w,h){
	layer_show(title,url,w,h);
}

// 用户删除按钮绑定事件,通过ajax发起一个delete请求
$('.delbtn').click(function(evt) {
	// 得到请求的url地址
	let url = $(this).attr('href');
	// alert(url);
	$.ajax({
		url,
		data:{_token},
		type:'DELETE',
		dataType:'json'
	}).then(({status,msg}) => {
		if(status == 0) {
			// 提示插件
			layer.msg(msg,{time:2000,icon:2},() => {
			// 删除当前行
			$(this).parents('tr').remove();			
			});
		}
	});

	// 目前默认事件为点击后，跳转到href的网址，用jquery取消默认事件
	return false;


});
/*用户-删除提示弹窗*/
function admin_del(obj,id){
	layer.confirm('确认要删除吗？',function(index){
		$.ajax({
			type: 'POST',
			url: '/admin/user/delete',
			dataType: 'json',
			success: function(data){
				$(obj).parents("tr").remove();
				layer.msg('已删除!',{icon:1,time:1000});
			},
			error:function(data) {
				console.log(data.msg);
			},
		});		
	});
}

/*用户-编辑*/
function admin_edit(title,url,id,w,h){
	layer_show(title,url,w,h);
}
/*用户-停用*/
function admin_stop(obj,id){
	layer.confirm('确认要停用吗？',function(index){
		//此处请求后台程序，下方是成功后的前台处理……
		
		$(obj).parents("tr").find(".td-manage").prepend('<a onClick="admin_start(this,id)" href="javascript:;" title="启用" style="text-decoration:none"><i class="Hui-iconfont">&#xe615;</i></a>');
		$(obj).parents("tr").find(".td-status").html('<span class="label label-default radius">已禁用</span>');
		$(obj).remove();
		layer.msg('已停用!',{icon: 5,time:1000});
	});
}

/*用户-启用*/
function admin_start(obj,id){
	layer.confirm('确认要启用吗？',function(index){
		//此处请求后台程序，下方是成功后的前台处理……
		
		
		$(obj).parents("tr").find(".td-manage").prepend('<a onClick="admin_stop(this,id)" href="javascript:;" title="停用" style="text-decoration:none"><i class="Hui-iconfont">&#xe631;</i></a>');
		$(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已启用</span>');
		$(obj).remove();
		layer.msg('已启用!', {icon: 6,time:1000});
	});
}
</script>

@endsection
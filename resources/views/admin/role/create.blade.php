@extends('admin.common.main')

@section('content')

<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 管理項目 <span class="c-gray en">&gt;</span> 役割管理 <span class="c-gray en">&gt;</span>　役割追加 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="更新" ><i class="Hui-iconfont">&#xe68f;</i></a>
</nav>
<article class="page-container">
	<form action="" method="post" class="form form-horizontal" id="form-admin-role-add">
		@csrf
		<!-- エラー情報の表示 -->
		@include('admin.common.validate')		

		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>役割名称：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" id="roleName" name="roleName" >
			</div>
		</div>
		<!-- <div class="row cl">
			<label class="form-label col-xs-4 col-sm-3">备注：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="" placeholder="" id="" name="">
			</div>
		</div> -->

		<div class="row cl">
			<!-- <label class="form-label col-xs-4 col-sm-3">网站角色：</label> -->
			<div class="formControls col-xs-8 col-sm-9">
				
				<dl class="permission-list">
					<!-- <dt>
						<label>
							<input type="checkbox" value="" name="user-Character-0" id="user-Character-1">
							用户中心</label>
					</dt> -->
					<dd>
						<dl class="cl permission-list2">
							<dt>
								<label class="">
									<input type="checkbox" value="" name="user-Character-1-0" id="user-Character-1-0">
									用户管理</label>
							</dt>
							<dd>
								<label class="">
									<input type="checkbox" value="" name="user-Character-1-0-0" id="user-Character-1-0-0">
									添加</label>
								<label class="">
									<input type="checkbox" value="" name="user-Character-1-0-0" id="user-Character-1-0-1">
									修改</label>
								<label class="">
									<input type="checkbox" value="" name="user-Character-1-0-0" id="user-Character-1-0-2">
									删除</label>
								<label class="">
									<input type="checkbox" value="" name="user-Character-1-0-0" id="user-Character-1-0-3">
									查看</label>
								<label class="">
									<input type="checkbox" value="" name="user-Character-1-0-0" id="user-Character-1-0-4">
									审核</label>
							</dd>
						</dl>
					</dd>
				</dl>
			</div>
		</div>
		<div class="row cl">
			<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
				<button type="submit" class="btn btn-success radius" id="admin-role-save" name="admin-role-save"><i class="icon-ok"></i>追加</button>
			</div>
		</div>
	</form>
</article>

@endsection

@section('js')
<script type="text/javascript" src="/admin/lib/My97DatePicker/4.8/WdatePicker.js"></script>
<script type="text/javascript" src="/admin/lib/jquery.validation/1.14.0/jquery.validate.js"></script> 
<script type="text/javascript" src="/admin/lib/jquery.validation/1.14.0/validate-methods.js"></script> 
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/localization/messages_ja.js"></script>

<script type="text/javascript">
$(function(){
	$('.skin-minimal input').iCheck({
		checkboxClass: 'icheckbox-blue',
		radioClass: 'iradio-blue',
		increaseArea: '20%'
	});
	
	$("#form-admin-role-add").validate({
		rules:{
			roleName:{
				required:true,
			},	
		},
		
		messages:{
			roleName:{
				required:'役割名称をご入力ください'
			},
		},
		// キーボード事件をキャンセル
		onkeyup:false,
		focusCleanup:true,
		success:"valid",
		submitHandler:function(form){
			$(form).ajaxSubmit({
				type: 'post',
				url: "{{route('admin.role.store')}}" ,
				// url:"",
				success: function(data){
					layer.msg('役割を追加しました!',{icon:1,time:2000},function(){
					var index = parent.layer.getFrameIndex(window.name);
					//自動更新
                    parent.window.location = parent.window.location;
					parent.layer.close(index);						
					});
				},
                error: function(XmlHttpRequest, textStatus, errorThrown){
					layer.msg('他の役割を指定してください、ユーザー名が既に使われいます。',{icon:2,time:3000},function(){
					
					});
				}
			});

		}
	// new code

	});
});


</script> 

@endsection
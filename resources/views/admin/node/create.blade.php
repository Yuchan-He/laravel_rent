@extends('admin.common.main')

@section('content')

<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 管理項目 <span class="c-gray en">&gt;</span> 権限管理 <span class="c-gray en">&gt;</span>　権限追加 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a>
</nav>
<article class="page-container">
	<form action="" method="post" class="form form-horizontal" id="form-node-add">
		@csrf
		<!-- エラー情報の表示 -->
		@include('admin.common.validate')		


	<!-- <div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>&nbsp;&nbsp;是否顶级：&nbsp;&nbsp;</label>
		<div class="formControls col-xs-8 col-sm-9"> <span class="select-box">
			<select name="pid" class="select">
				<option value="0">顶级权限</option>
				<option value="1">非顶级权限</option>
			</select>
			</span> 
		</div>
	</div> -->

	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>権限名称：</label>
		<div class="formControls col-xs-8 col-sm-9">
			<input type="text" class="input-text" value="" placeholder="" id="name" name="name">
		</div>
	</div>
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>ルート名称：</label>
		<div class="formControls col-xs-8 col-sm-9">
			<input type="text" class="input-text" value="" placeholder="" id="route_name" name="route_name">
		</div>
	</div>
	
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>トップメニュー：</label>
		<div class="formControls col-xs-8 col-sm-9 skin-minimal">
			<div class="radio-box">
				<input name="is_menu" type="radio" id="sex-1" value="1"checked>
				<label for="sex-1">Yes</label>
			</div>
			<div class="radio-box">
				<input type="radio" id="sex-2" name="is_menu" value="0">
				<label for="sex-2">No</label>
			</div>
		</div>
	</div>

	<div class="row cl">
		<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
			<input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;追加&nbsp;&nbsp;">
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
	
	$("#form-node-add").validate({
		rules:{
			pid:{
				required:true,
			},
			name:{
				required:true,
			},
			route_name:{
				required:true,
			},
			is_menu:{
				required:true,
			},				
		},
		
		// messages:{
		// 	username:{
		// 		required:'ユーザー名をご入力ください'
		// 	},
		// },
		// キーボード事件をキャンセル
		onkeyup:false,
		focusCleanup:true,
		success:"valid",

	// old code
		// submitHandler:function(form){
		// 	// 検証成功したら、フォームを提出
		// 	form.submit();			
		// }
	// old code

	// new code
		submitHandler:function(form){
			$(form).ajaxSubmit({
				type: 'post',
				url: "{{route('admin.node.store')}}" ,
				success: function(data){
					layer.msg('追加しました!',{icon:1,time:2000},function(){
					var index = parent.layer.getFrameIndex(window.name);
					//自動更新
                    parent.window.location = parent.window.location;
					parent.layer.close(index);						
					});
				},
                error: function(XmlHttpRequest, textStatus, errorThrown){
					layer.msg('他の名称を指定してください、権限名称が既に使われいます。',{icon:2,time:3000},function(){
					
					});
				}
			});

		}
	// new code

	});
});
// 自分が設定電話ルール
$.validator.addMethod("IsMobile",function(value,element){
	var tel = /^0[789]0-[0-9]{4}-[0-9]{4}$/;
	return this.optional(element) || (tel.test(value));
},"XXX-XXXX-XXXX形式で入力してください");

</script> 

@endsection
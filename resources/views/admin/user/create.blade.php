@extends('admin.common.main')

@section('content')

<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> Home <span class="c-gray en">&gt;</span> ユーザー管理 <span class="c-gray en">&gt;</span> ユーザー追加 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="更新" ><i class="Hui-iconfont">&#xe68f;</i></a>
</nav>
<article class="page-container">
	<form action="" method="post" class="form form-horizontal" id="form-member-add">
		@csrf
		<!-- エラー情報の表示 -->
		@include('admin.common.validate')
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>ユーザー名：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="{{old('username')}}" id="username" name="username">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>性別：</label>
			<div class="formControls col-xs-8 col-sm-9 skin-minimal">
				<div class="radio-box">
					<input name="sex" type="radio" id="sex-1" value="1" checked>
					<label for="sex-1">女性
					</label>
				</div>
				<div class="radio-box">
					<input type="radio" id="sex-2" name="sex" value="2" >
					<label for="sex-2">男性</label>
				</div>
				<div class="radio-box">
					<input type="radio" id="sex-3" name="sex" value="3" >
					<label for="sex-3">秘密</label>
				</div>
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>携帯：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="{{old('mobile')}}" placeholder="" id="mobile" name="mobile">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>メール：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" name="email" id="email" value="{{old('email')}}">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>パスワード：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="password" class="input-text" name="password" id="password" >
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>パスワード再入力：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="password" class="input-text" name="password_confirmation" id="password_confirmation">
			</div>
		</div>
		<div class="row cl">
			<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
				<input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;提出&nbsp;&nbsp;">
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
	
	$("#form-member-add").validate({
		rules:{
			username:{
				required:true,
				minlength:2,
				maxlength:16
			},
			sex:{
				required:true,
			},
			// 自分が設定電話ルール
			mobile:{
				required:true,
				IsMobile:true,
			},
			email:{
				required:true,
				email:true,
			},	
			password:"required",
			password_confirmation:{
					equalTo: "#password"
			}
				
		},
		
		messages:{
			username:{
				required:'ユーザー名をご入力ください'
			},
		},
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
				// 自己提交给自己，不需要指定
				url: "" ,
				success: function(data){
					layer.msg('ユーザーを追加しました!',{icon:1,time:2000},function(){
					var index = parent.layer.getFrameIndex(window.name);
					//自動更新
                    parent.window.location = parent.window.location;
					parent.layer.close(index);						
					});
				},
                error: function(XmlHttpRequest, textStatus, errorThrown){
					layer.msg('他のユーザー名を指定してください、ユーザー名が既に使われいます。',{icon:2,time:3000},function(){
					
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
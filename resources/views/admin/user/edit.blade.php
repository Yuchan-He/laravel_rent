@extends('admin.common.main')

@section('content')

<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> Home <span class="c-gray en">&gt;</span> 管理項目 <span class="c-gray en">&gt;</span> ユーザ情報編集 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a>
</nav>
<article class="page-container">
	<form action="{{route('admin.user.update',['id' => $model ->id])}}" method="post" class="form form-horizontal" id="form-member-add">
		<!-- 提出方法を設定する-->
		@method('PUT')
		@csrf
		<!-- エラー情報の表示 -->
		@include('admin.common.validate')
		
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>ユーザー名：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="{{$model -> username}}" id="username" name="username">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>性別：</label>
			<div class="formControls col-xs-8 col-sm-9 skin-minimal">
				<div class="radio-box">
					<input name="sex" type="radio" id="sex-1" value="1" checked>
					<label for="sex-1">女性</label>
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
				<input type="text" class="input-text" value="{{ $model -> mobile}}" placeholder="" id="mobile" name="mobile">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>メール：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" name="email" id="email" value="{{ $model -> email}}">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>パスワード：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="password" class="input-text" name="spassword" id="spassword" >
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red"></span>新しいパスワード：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="password" class="input-text" name="password" id="password" >
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red"></span>新しいパスワードを再入力：</label>
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
			
			mobile:{
				required:true,
				IsMobile:true,
			},
			email:{
				required:true,
				email:true,
			},	
			spassword:"required",
			password_confirmation:{
					equalTo: "#password"
			}
				
		},
		
		messages:{
			username:{
				required:'ユーザー名をご入力ください'
			},
		},
		// 取消键盘事件
		onkeyup:false,
		focusCleanup:true,

		success:"valid",

		submitHandler:function(form){

			form.submit();

		}
	});
});
// 自分が設定電話ルール
$.validator.addMethod("IsMobile",function(value,element){
	var tel = /^0[789]0-[0-9]{4}-[0-9]{4}$/;
	return this.optional(element) || (tel.test(value));
},"XXX-XXXX-XXXX形式で入力してください");

</script> 

@endsection
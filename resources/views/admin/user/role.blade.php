@extends('admin.common.main')

@section('content')

<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 管理項目 <span class="c-gray en">&gt;</span> ユーザー管理 <span class="c-gray en">&gt;</span>　役割 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="更新" ><i class="Hui-iconfont">&#xe68f;</i></a>
</nav>
<article class="page-container">
	<form action="{{route('admin.user.role',$id)}}" method="post" class="form form-horizontal" id="form-admin-role-add">
		@csrf
		<!-- 更新情報の表示 -->
		@include('admin.common.validate')		
		<div class="row cl">
			<div class="formControls col-xs-8 col-sm-9">				
				<dl class="permission-list">
					@foreach($roleAll as $value)
					<dd>
						<label class="">
							<input type="radio" value="{{ $value['id'] }}" name="role_id"
							@if($value['id'] == $role_id[0])
							checked 
							@endif
							>
							{{$value['roleName']}}
						</label>
					</dd>
					@endforeach
				</dl>
			</div>
		</div>
		<div class="row cl">
			<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
				<button type="submit" class="btn btn-success radius" id="admin-role-save" name="admin-role-save"><i class="icon-ok"></i>変更</button>
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


@endsection
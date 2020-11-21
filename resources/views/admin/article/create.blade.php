@extends('admin.common.main')

@section('css')
<!-- 引入webuploader上传样式CSS -->
<link rel="stylesheet" type="text/css" href="/admin/lib/webuploader/0.1.5/webuploader.css">
@endsection

@section('content')


<!-- <nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> Home <span class="c-gray en">&gt;</span> 文章管理 <span class="c-gray en">&gt;</span> 文章追加 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="更新" ><i class="Hui-iconfont">&#xe68f;</i></a>
</nav> -->
<article class="page-container">
	<form class="form form-horizontal" id="form-article-add">
		@csrf
		<!-- エラー情報の表示 -->
		@include('admin.common.validate')
		<!-- 投稿のユーザーID、非表示 -->
		<input type="hidden" name="user_id" value="{{auth() -> guard('admin')-> id()}}">
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>タイトル：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="" placeholder="" id="articletitle" name="title">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"></span>文章摘要：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<textarea name="desn" cols="" rows="" class="textarea"  placeholder="" datatype="*10-100" dragonfly="true" nullmsg="備考をご記入ください！" onKeyUp="$.Huitextarealength(this,200)"></textarea>
				<p class="textarea-numberbar"></p>
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">画像：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<!-- webuploader 上传btn -->
				<div id="uploader-demo">
				    <!--用来存放item-->
				    <div id="fileList" class="uploader-list"></div>
				    <!-- 　上传图片地址的隐藏域，保存到数据库的地址 -->
				    <input type="hidden" name="pic" id="pic" value=""/>

				    <div id="filePicker" name="file">画像選択</div>
				</div>
				<!-- webuploader 上传btn -->	
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>文章内容：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<textarea name="body" cols="" rows="" class="textarea"  placeholder="何か書きましょう..." datatype="*10-100" dragonfly="true" nullmsg="備考をご記入ください" onKeyUp="$.Huitextarealength(this,200)"></textarea>
				<p class="textarea-numberbar"></p>
			</div>
		</div>

		<div class="row cl">
			<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
				<button class="btn btn-primary radius" type="submit"><i class="Hui-iconfont">&#xe632;</i> 投稿</button>
<!-- 				<button onClick="article_save();" class="btn btn-secondary radius" type="button"><i class="Hui-iconfont">&#xe632;</i> 保存草稿</button> -->
				<button class="btn btn-default radius" type="button"><a href="{{route('front.article.index')}}">&nbsp;&nbsp;キャンセル&nbsp;&nbsp;</a></button>
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
<!--引入webuploaderJS-->
<script type="text/javascript" src="/admin/lib/webuploader/0.1.5/webuploader.js"></script>


<script type="text/javascript">


// // 初始化Web Uploader
// var uploader = WebUploader.create({

//     // 选完文件后，是否自动上传。
//     auto: true,

//     // swf文件路径
//     swf: '/admin/lib/webuploader/0.1.5/Uploader.swf',

//     // 文件接收服务端。
//     server: 'http://webuploader.duapp.com/server/fileupload.php',

//     // 选择文件的按钮。可选。
//     // 内部根据当前运行是创建，可能是input元素，也可能是flash.
//     pick: '#filePicker',

//     // 只允许选择图片文件。
//     accept: {
//         title: 'Images',
//         extensions: 'gif,jpg,jpeg,bmp,png',
//         mimeTypes: 'image/*'
//     }
// });


$(function(){
	$('.skin-minimal input').iCheck({
		checkboxClass: 'icheckbox-blue',
		radioClass: 'iradio-blue',
		increaseArea: '20%'
	});
	
	//表单验证
	$("#form-article-add").validate({
		rules:{
			title:{
				required:true,
			},
			body:{
				required:true,
			}		
		},
		onkeyup:false,
		focusCleanup:true,
		success:"valid",
		submitHandler:function(form){
			$(form).ajaxSubmit({
				type: 'post',
				// 自己提交给自己，不需要指定
				url: "{{route('admin.article.store')}}" ,
				success: function(data){
					layer.msg('文章を追加しました!',{icon:1,time:2000},function(){
					// var index = layer.getFrameIndex(window.name);
					// //自動更新
     				// window.location = window.location;
     				window.location = "{{route('admin.article.index')}}";
					// layer.close(index);						
					});
				},
                error: function(XmlHttpRequest, textStatus, errorThrown){
					layer.msg('入力箇所を完了してください',{icon:2,time:3000},function(){
					
					});
				}
			});
		}
	});
	
	$list = $("#fileList"),
	$btn = $("#btn-star"),
	state = "pending",
	uploader;

	// 初始化Web Uploader

	var uploader = WebUploader.create({
		auto: true,
		swf: '/admin/lib/webuploader/0.1.5/Uploader.swf',
	
		// 文件接收服务端/route。
		server: "{{route('admin.article.webuploader')}}",

		// 添加token
		formData:{

			_token:'{{csrf_token()}}'
		},				
	
		// 选择文件的按钮。可选。
		// 内部根据当前运行是创建，可能是input元素，也可能是flash.
		pick: '#filePicker',
	
		// 不压缩image, 默认如果是jpeg，文件上传前会压缩一把再上传！
		resize: false,
		// 只允许选择图片文件。
		accept: {
			title: 'Images',
			extensions: 'gif,jpg,jpeg,bmp,png',
			mimeTypes: 'image/*'
		}
	});
	uploader.on( 'fileQueued', function( file ) {
		var $li = $(
			'<div id="' + file.id + '" class="item thumbnail">' +
				'<div class="pic-box"><img></div>'+
				'<div class="info">' + file.name + '</div>' +
				'<p class="state">一生懸命アップロード中...</p>'+
			'</div>'
		),
		$img = $li.find('img');
		
		// 清除上一张缩略图
		$('.thumbnail').remove();
		$list.append( $li );
		// 创建缩略图
		// 如果为非图片文件，可以不用调用此方法。
		// thumbnailWidth x thumbnailHeight 为 100 x 100
		uploader.makeThumb( file, function( error, src ) {
			if ( error ) {
				$img.replaceWith('<span>閲覧できません</span>');
				return;
			}
	
			$img.attr( 'src', src );
		}, 100, 100 );
	});
	// // 文件上传过程中创建进度条实时显示。
	// uploader.on( 'uploadProgress', function( file, percentage ) {
	// 	var $li = $( '#'+file.id ),
	// 		$percent = $li.find('.progress-box .sr-only');
	
	// 	// 避免重复创建
	// 	if ( !$percent.length ) {
	// 		$percent = $('<div class="progress-box"><span class="progress-bar radius"><span class="sr-only" style="width:0%"></span></span></div>').appendTo( $li ).find('.sr-only');
	// 	}
	// 	$li.find(".state").text("上传中");
	// 	$percent.css( 'width', percentage * 100 + '%' );
	// });
	
	// 文件上传成功，给item添加成功class, 用样式标记上传成功。
	uploader.on('uploadSuccess', function(file,response) {
		$( '#'+file.id ).addClass('upload-state-success').find(".state").text("アップロード成功しました");
		console.log(response.path);
		$('#pic').val(response.path);
	});
	
	// // 文件上传失败，显示上传出错。
	// uploader.on( 'uploadError', function( file ) {
	// 	$( '#'+file.id ).addClass('upload-state-error').find(".state").text("上传出错");
	// });
	
	// // 完成上传完了，成功或者失败，先删除进度条。
	// uploader.on( 'uploadComplete', function( file ) {
	// 	$( '#'+file.id ).find('.progress-box').fadeOut();
	// });
	// uploader.on('all', function (type) {
 //        if (type === 'startUpload') {
 //            state = 'uploading';
 //        } else if (type === 'stopUpload') {
 //            state = 'paused';
 //        } else if (type === 'uploadFinished') {
 //            state = 'done';
 //        }

 //        if (state === 'uploading') {
 //            $btn.text('暂停上传');
 //        } else {
 //            $btn.text('开始上传');
 //        }
 //    });

 //    $btn.on('click', function () {
 //        if (state === 'uploading') {
 //            uploader.stop();
 //        } else {
 //            uploader.upload();
 //        }
 //    });
	
	// var ue = UE.getEditor('editor');
	
});
</script>

@endsection
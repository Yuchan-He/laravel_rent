<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<link href="/admin/static/h-ui/css/H-ui.min.css" rel="stylesheet" type="text/css" />
<link href="/admin/static/h-ui.admin/css/H-ui.login.css" rel="stylesheet" type="text/css" />
<link href="/admin/static/h-ui.admin/css/style.css" rel="stylesheet" type="text/css" />
<link href="/admin/lib/Hui-iconfont/1.0.8/iconfont.css" rel="stylesheet" type="text/css" />
<title>管理者ログイン</title>
</head>
<body>
<input type="hidden" id="TenantId" name="TenantId" value="" />

<div class="loginWraper">
  <div id="loginform" class="loginBox">
    <form class="form form-horizontal" action="{{route('admin.login')}}" method="post">
      @csrf
      <!-- エラー情報の表示を入れる -->
      @include('admin.common.validate')
      <!-- ログアウト成功のメッセージを表示 -->
      @include('admin.common.msg')
      <div class="row cl">
        <label class="form-label col-xs-3"><i class="Hui-iconfont">&#xe60d;</i></label>
        <div class="formControls col-xs-8">
          <input id="" name="username" type="text" placeholder="ユーザー名" class="input-text size-L" value="admin">
        </div>
      </div>
      <div class="row cl">
        <label class="form-label col-xs-3"><i class="Hui-iconfont">&#xe60e;</i></label>
        <div class="formControls col-xs-8">
          <input id="" name="password" type="password" placeholder="パスワード" class="input-text size-L" value="12345678">
        </div>
      </div>
      <div class="row cl">
        <div class="formControls col-xs-8 col-xs-offset-3">
          <input name="" type="submit" class="btn btn-success radius size-L" value="&nbsp;&nbsp;ログイン&nbsp;&nbsp;&nbsp;&nbsp;">
          <input name="" type="reset" class="btn btn-default radius size-L" value="&nbsp;&nbsp;キャンセル&nbsp;&nbsp;&nbsp;&nbsp;">
        </div>
      </div>
    </form>
  </div>
</div>

<script type="text/javascript" src="/admin/lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="/admin/static/h-ui/js/H-ui.min.js"></script>

</body>
</html>
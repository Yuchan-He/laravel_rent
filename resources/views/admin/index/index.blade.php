
@extends('admin.common.main')

<title>管理画面</title>
@section('content')
<body>
<header class="navbar-wrapper">
	<div class="navbar navbar-fixed-top">
		<div class="container-fluid cl"> <a class="logo navbar-logo f-l mr-10 hidden-xs" href="">管理画面</a> <a class="logo navbar-logo-m f-l mr-10 visible-xs" href=""></a> 

		<nav id="Hui-userbar" class="nav navbar-nav navbar-userbar hidden-xs">
			<ul class="cl">
				
				<li class="dropDown dropDown_hover">
					<a href="#" class="dropDown_A">{{auth() -> guard('admin') -> user() -> username}}
						<i class="Hui-iconfont">&#xe6d5;</i>
					</a>
					<ul class="dropDown-menu menu radius box-shadow">
						<li>
							<a href="{{route('admin.logout')}}">ログアウト
							</a>
						</li>
						<li>
							<a href="javascript:;" onClick="myselfinfo()">個人情報
							</a>
						</li>
						
				</ul>
				</li>
				
			</ul>
		</nav>
	</div>
</div>
</header>
<aside class="Hui-aside">
	<div class="menu_dropdown bk_2">
		<dl id="menu-admin">
			<dt>
				<i class="Hui-iconfont">&#xe62d;</i>管理項目
				<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i>
			</dt>
			<dd>
				<ul>
					@foreach($menuData as $value)

						<li>
							<a data-href="{{route($value['route_name'])}}" data-title="{{$value['name']}}" href="javascript:void(0)">{{$value['name']}}</a>
						</li>

					@endforeach
					<!-- <li>
						<a data-href="{{route('admin.user.index')}}" data-title="ユーザーリスト" href="javascript:void(0)">ユーザーリスト</a>
					</li>
					<li>
						<a data-href="{{route('admin.user.indexdeleted')}}" data-title="削除したユーザー" href="javascript:void(0)">削除したユーザー</a>
					</li>	
					<li>
						<a data-href="{{route('admin.role.index')}}" data-title="役割管理" href="javascript:void(0)">役割管理</a>
					</li>
					<li>
						<a data-href="{{route('admin.node.index')}}" data-title="権限管理" href="javascript:void(0)">権限管理</a>
					</li> -->										
				</ul>
			</dd>
		</dl>					
	</div>
</aside>
<div class="dislpayArrow hidden-xs"><a class="pngfix" href="javascript:void(0);" onClick="displaynavbar(this)"></a></div>
<section class="Hui-article-box">
	<div id="Hui-tabNav" class="Hui-tabNav hidden-xs">
		<div class="Hui-tabNav-wp">
			<ul id="min_title_list" class="acrossTab cl">
				<li class="active">
					<span title="ホーム" data-href="">ホーム</span>
					<em></em></li>
		</ul>
	</div>
		<div class="Hui-tabNav-more btn-group"><a id="js-tabNav-prev" class="btn radius btn-default size-S" href="javascript:;"><i class="Hui-iconfont">&#xe6d4;</i></a><a id="js-tabNav-next" class="btn radius btn-default size-S" href="javascript:;"><i class="Hui-iconfont">&#xe6d7;</i></a></div>
</div>
	<div id="iframe_box" class="Hui-article">
		<div class="show_iframe">
			<div style="display:none" class="loading"></div>
			<iframe scrolling="yes" frameborder="0" src="/admin/welcome"></iframe>
	</div>
</div>
</section>

@section('js')
<script type="text/javascript">
/*個人情報*/
function myselfinfo(){

	layer.open({
		type: 2,
		title: "管理者情報",
		area: ['750px','500px'],
		content: "{{route('admin.user.edit',['id' => auth() -> guard('admin') -> user() -> id])}}"
	});
	
}
</script>
@endsection

@endsection

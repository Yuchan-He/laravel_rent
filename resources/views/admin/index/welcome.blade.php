
@extends('admin.common.main')

@section('css')
<style>
	body{
		background-image: url(/admin/icon/slide01-sp.jpg);
		background-repeat: no-repeat;
		background-size: 100% auto;
	}
</style>
@endsection

@section('content')
<title>ホームページ</title>
<body>
<div class="page-container">
	<p class="f-20 text-success">{{auth() -> guard('admin') -> user() -> username}} <span class="f-14"></span>,Welcome！</p>
</div>


@endsection

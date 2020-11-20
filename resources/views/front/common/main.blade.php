<!DOCTYPE HTML>
<!-- header 共有部分として独立する --> 
<html lang="en">
  <head>
    <title>Mini Rent</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Muli:300,400,700|Playfair+Display:400,700,900" rel="stylesheet">

    <link rel="stylesheet" href="/front/fonts/icomoon/style.css">
    <link rel="stylesheet" href="/front/css/bootstrap.min.css">
    <link rel="stylesheet" href="/front/css/magnific-popup.css">
    <link rel="stylesheet" href="/front/css/jquery-ui.css">
    <link rel="stylesheet" href="/front/css/owl.carousel.min.css">
    <link rel="stylesheet" href="/front/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="/front/css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="/front/fonts/flaticon/font/flaticon.css">
    <link rel="stylesheet" href="/front/css/aos.css">

    <link rel="stylesheet" href="/front/css/style.css">
<!-- header 共有部分として独立する -->
  <!-- 自分が定義したCSS -->
  @yield('css')

  </head>
  <body>
  <div class="site-wrap">

    <div class="site-mobile-menu">
      <div class="site-mobile-menu-header">
        <div class="site-mobile-menu-close mt-3">
          <span class="icon-close2 js-menu-toggle"></span>
        </div>
      </div>
      <div class="site-mobile-menu-body"></div>
    </div>
    
    <header class="site-navbar" role="banner">
      <div class="container-fluid">
        <div class="row align-items-center">
          

          <div class="col-4 site-logo">
            <a href="{{route('front.article.index')}}" class="text-black h2 mb-0">Mini Rent</a>
          </div>

          <div class="col-8 text-right">
            <nav class="site-navigation" role="navigation">
              <ul class="site-menu js-clone-nav mr-auto d-none d-lg-block mb-0">
                <li><a href="">{{auth() -> guard('admin') -> user() -> username}} さん、ようこそ<i class="icon-heart text-danger" aria-hidden="true"></i></a></li>            
                @if(auth() ->guard('admin') ->check())
                <li><a href="{{route('admin.article.create')}}">投稿しましょう</a></li>
                <li><a href="{{route('admin.index')}}">設定</a></li>  
                <li><a href="{{route('front.logout')}}">ログアウト</a></li>                 
                @else
                <li><a href="{{route('front.signup')}}">新規登録</a></li>   
                <li><a href="{{route('front.login')}}">ログイン</a></li>
                @endif   
                <!-- <li><a href="category.html"> </a></li> -->

              </ul>
            </nav>
     <!--        <a href="#" class="site-menu-toggle js-menu-toggle text-black d-inline-block d-lg-none"><span class="icon-menu h3"></span></a> -->
          </div>
          </div>

      </div>
    </header>  
  <!-- 自分が定義したコンテンツ -->
  @yield('content')
   
  <!--_footer 共有部分として独立する-->
      <div class="site-footer">
      <div class="container">
        <div class="row">
          <div class="col-12 text-center">
            <p>
              Copyright &copy; <script>document.write(new Date().getFullYear());</script> All rights reserved | by He Yuchan</a>   
              </p>
          </div>
        </div>
      </div>
    </div>
    <!--_footer 共有部分として独立する--js-->  
  <script src="/front/js/jquery-3.3.1.min.js"></script>
  <script src="/front/js/jquery-migrate-3.0.1.min.js"></script>
  <script src="/front/js/jquery-ui.js"></script>
  <script src="/front/js/popper.min.js"></script>
  <script src="/front/js/bootstrap.min.js"></script>
  <script src="/front/js/owl.carousel.min.js"></script>
  <script src="/front/js/jquery.stellar.min.js"></script>
  <script src="/front/js/jquery.countdown.min.js"></script>
  <script src="/front/js/jquery.magnific-popup.min.js"></script>
  <script src="/front/js/bootstrap-datepicker.min.js"></script>
  <script src="/front/js/aos.js"></script>

  <script src="/front/js/main.js"></script>
  <!-- error message -->
  <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/localization/messages_ja.js"></script>
  <!-- footer 共有部分として独立する -->
  
  <!-- 自分が定義したJS -->
  @yield('js')
  
  </body>
  </html>
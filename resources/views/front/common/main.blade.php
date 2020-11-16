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
  
  <!-- 自分が定義したコンテンツ -->
  @yield('content')
   
  <!--_footer 共有部分として独立する-->
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
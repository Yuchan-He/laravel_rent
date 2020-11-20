@extends('front.common.main')
<meta name="csrf-token" content="{{ csrf_token() }}">
  @section('content')
  
  <!-- <div class="site-wrap">

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
          
          <div class="col-12 search-form-wrap js-search-form">
            <form method="get" action="#">
              <input type="text" id="s" class="form-control" placeholder="Search...">
              <button class="search-btn" type="submit"><span class="icon-search"></span></button>
            </form>
          </div>

          <div class="col-4 site-logo">
            <a href="index.html" class="text-black h2 mb-0">Mini Blog</a>
          </div>

          <div class="col-8 text-right">
            <nav class="site-navigation" role="navigation">
              <ul class="site-menu js-clone-nav mr-auto d-none d-lg-block mb-0">
                <li><a href="category.html">Home</a></li>
                <li><a href="category.html">Politics</a></li>
                <li><a href="category.html">Tech</a></li>
                <li><a href="category.html">Entertainment</a></li>
                <li><a href="category.html">Travel</a></li>
                <li><a href="category.html">Sports</a></li>
                <li class="d-none d-lg-inline-block"><a href="#" class="js-search-toggle"><span class="icon-search"></span></a></li>
              </ul>
            </nav>
            <a href="#" class="site-menu-toggle js-menu-toggle text-black d-inline-block d-lg-none"><span class="icon-menu h3"></span></a></div>
          </div>

      </div>
    </header> -->
    
    
    
    <div class="site-section bg-light">
      <div class="container">
        <div class="row">
          <div class="col-md-7 mb-5">
          
            <form action="{{route('front.signup')}}" method="post" class="p-5 bg-white">
            @csrf
            <!-- エラー情報の表示 -->
            @include('front.common.validate')            

<!--               <div class="row form-group">
                <div class="col-md-6 mb-3 mb-md-0">
                  <label class="text-black" for="fname">First Name</label>
                  <input type="text" id="fname" class="form-control">
                </div>
                <div class="col-md-6">
                  <label class="text-black" for="lname">Last Name</label>
                  <input type="text" id="lname" class="form-control">
                </div>
              </div>
 -->
              <div class="row form-group">
                
                <div class="col-md-12">
                  <label class="text-black" for="username">ユーザー名：</label> <span id="info"></span>
                  <input type="text" id="username" name="username" class="form-control" value="{{old('username')}}">
                </div>
              </div>

              <div class="row form-group">
                
                <div class="col-md-12">
                  <label class="text-black" for="password">パスワード：</label> 
                  <input type="password" id="password" name="password" class="form-control">
                </div>
              </div>

           <!--    <div class="row form-group">
                <div class="col-md-12">
                  <label class="text-black" for="message">Message</label> 
                  <textarea name="message" id="message" cols="30" rows="7" class="form-control" placeholder="Write your notes or questions here..."></textarea>
                </div>
              </div> -->

              <div class="row form-group">
                <div class="col-md-12">
                  <input type="submit" value="新規登録" class="btn btn-primary py-2 px-4 text-white">
                </div>
              </div>

  
            </form>
          </div>
          <!-- <div class="col-md-5">
            
            <div class="p-4 mb-3 bg-white">
              <p class="mb-0 font-weight-bold">Address</p>
              <p class="mb-4">203 Fake St. Mountain View, San Francisco, California, USA</p>

              <p class="mb-0 font-weight-bold">Phone</p>
              <p class="mb-4"><a href="#">+1 232 3235 324</a></p>

              <p class="mb-0 font-weight-bold">Email Address</p>
              <p class="mb-0"><a href="#">youremail@domain.com</a></p>

            </div>

          </div> -->
        </div>
      </div>
    </div>
        
  </div>
  @section('js')

  <script type="text/javascript">
    $(function () { 
      // 在要发起post请的ajax前加上这几行代码
      $.ajaxSetup({
          headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
      });

      var info = document.getElementById('info');
      $("#username").blur(function () {
        var username = $('#username').val();
      
        $.ajax({          
          type: "post",
          url: "{{route('front.signupUsername')}}", 
          data: { 
            "username" : username,

          },
          dataType:"json",         
          // headers: {
          //     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          // },
          success: function (data) {
            
            console.log(data);
            info.innerHTML = "ユーザー名が使えます。";
            info.className = "text-black bg-success";
            // var vCount = parseInt(data);
            // if (data == 1) {
            //   console.log(data);;
            // }
            // else {
            //   console.log(data);;
            // }
          },

          error: function (data) {
            console.log(data);
            info.innerHTML = "ユーザ名を再度入力ください、すでに登録されています。";
            info.className = "text-white bg-danger";

          },          

        });
      });
      // $("#checkpwd").blur(function () {
      //   return CheckPwd();
      // });
    });
    // function CheckPwd()
    // {
    //   var bCheck = true;
    //   if ($.trim($("#pwd").val()) != $.trim($("#checkpwd").val()))
    //   {
    //     alert("两次密码输入不一致");
    //     bCheck = false;
    //   }
    //   return bCheck;
    // }
  </script>

  @endsection

  @endsection
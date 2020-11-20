@extends('front.common.main')
  @section('content')
  
    <div class="site-cover site-cover-sm same-height overlay single-page" style="background-image: url('');">
      <div class="container">
        <div class="row same-height justify-content-center">
          <div class="col-md-12 col-lg-10">
            <div class="post-entry text-center">
              <span class="post-category text-white bg-success mb-3">Mini Rent</span>
              <h1 class="mb-4">Mini Rentとは</h1>
              <h2 class="mb-4">たまに登山いきたい！けど登山の装備はない。。。そういう悩みの方に小っちゃくでもいい、レンタルしましょう</h2>
              <div class="post-meta align-items-center text-center">
                <figure class="author-figure mb-0 mr-3 d-inline-block"><img src="" alt="Image" class="img-fluid"></figure>

<!--                 <span class="d-inline-block mt-1">By </span>
                <span>&nbsp;-&nbsp; February 10, 2019</span> -->
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="site-section">
      <div class="container">
        <div class="row mb-5">
          <div class="col-12">
            <h2>最新な投稿</h2>
          </div>
        </div>
        <div class="row">
          <!-- article -->
          @foreach($data as $value)
          <div class="col-lg-4 mb-4">
            <div class="entry2">
              <a href="{{route('front.article.show',['id' => $value -> id])}}" target="_blank"><img src="{{$value -> pic}}" alt="Image" class="rounded" width="370" height="250" ></a>
              <div class="excerpt">
              <span class="post-category text-white bg-secondary mb-3">Politics</span>
              
              <h2><a href="">{{$value -> title}}</a></h2>
              <div class="post-meta align-items-center text-left clearfix">
                <figure class="author-figure mb-0 mr-3 float-left"><img src="uploads/article/1.jpg" alt="Image" class="img-fluid"></figure>
       <!--          <span class="d-inline-block mt-1">作者<a href="#">Carrol Atkinson</a></span> -->
                <span>&nbsp;-&nbsp; {{$value -> created_at}}</span>
              </div>
              
                <p>{{$value -> desn}}</p>
                <p><a href="{{route('front.article.show',['id' => $value -> id])}}" target="_blank">Read More</a></p>
              </div>
            </div>
          </div>
          @endforeach
          {{ $data->links() }}
      </div>
    </div>

   <!--  <div class="site-section bg-light">
      <div class="container">

        <div class="row align-items-stretch retro-layout">
          
          <div class="col-md-5 order-md-2">
            <a href="single.html" class="hentry img-1 h-100 gradient" style="background-image: url('images/img_4.jpg');">
              <span class="post-category text-white bg-danger">Travel</span>
              <div class="text">
                <h2>The 20 Biggest Fintech Companies In America 2019</h2>
                <span>February 12, 2019</span>
              </div>
            </a>
          </div>

          <div class="col-md-7">
            
            <a href="single.html" class="hentry img-2 v-height mb30 gradient" style="background-image: url('images/img_1.jpg');">
              <span class="post-category text-white bg-success">Nature</span>
              <div class="text text-sm">
                <h2>The 20 Biggest Fintech Companies In America 2019</h2>
                <span>February 12, 2019</span>
              </div>
            </a>
            
            <div class="two-col d-block d-md-flex">
              <a href="single.html" class="hentry v-height img-2 gradient" style="background-image: url('images/img_2.jpg');">
                <span class="post-category text-white bg-primary">Sports</span>
                <div class="text text-sm">
                  <h2>The 20 Biggest Fintech Companies In America 2019</h2>
                  <span>February 12, 2019</span>
                </div>
              </a>
              <a href="single.html" class="hentry v-height img-2 ml-auto gradient" style="background-image: url('images/img_3.jpg');">
                <span class="post-category text-white bg-warning">Lifestyle</span>
                <div class="text text-sm">
                  <h2>The 20 Biggest Fintech Companies In America 2019</h2>
                  <span>February 12, 2019</span>
                </div>
              </a>
            </div>  
            
          </div>
        </div>

      </div>
    </div>


    <div class="site-section bg-lightx">
      <div class="container">
        <div class="row justify-content-center text-center">
          <div class="col-md-5">
            <div class="subscribe-1 ">
              <h2>Subscribe to our newsletter</h2>
              <p class="mb-5">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sit nesciunt error illum a explicabo, ipsam nostrum.</p>
              <form action="#" class="d-flex">
                <input type="text" class="form-control" placeholder="Enter your email address">
                <input type="submit" class="btn btn-primary" value="Subscribe">
              </form>
            </div>
          </div>
        </div>
      </div>
    </div> -->
    
    
<!--     <div class="site-footer">
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
     -->
 

  @endsection
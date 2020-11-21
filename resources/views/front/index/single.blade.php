@extends('front.common.main')
  @section('content')  
    <div class="site-cover site-cover-sm same-height overlay single-page" style="background-image: url('{{$model -> pic}}');">
      <div class="container">
        <div class="row same-height justify-content-center">
          <div class="col-md-12 col-lg-10">
            <div class="post-entry text-center">
              <span class="post-category text-white bg-success mb-3">Nature</span>
              <h1 class="mb-4">{{$model -> title}}</h1>
              <div class="post-meta align-items-center text-center">

                <span class="d-inline-block mt-1">By {{$model -> user -> username}} </span>
                <span>&nbsp;-&nbsp; {{$model -> updated_at}}</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <section class="site-section py-lg">
      <div class="container">
        
        <div class="row blog-entries element-animate">

          <div class="col-md-12 col-lg-8 main-content">
            <div class="post-content-body">              
              <p>{{$model -> body}}</p>
            </div>                  
            <div class="pt-5">
              <span class="post-category text-white bg-success">いいね！</span>
            </div>


            <div class="pt-5">
              <!-- <h3 class="mb-5">6 Comments</h3> -->
              <ul class="comment-list">
                @foreach($comment as $value)
                <li class="comment">
                  <div class="vcard">
                    <!-- <img src="images/person_1.jpg" alt="Image placeholder"> -->
                  </div>
                  <div class="comment-body">
                    <h3></h3>
                    <div class="meta">{{$value -> created_at}}</div>
                    <p>{{$value -> content}}</p>
                    <!-- <p><a href="#" class="reply rounded">Reply</a></p> -->
                  </div>
                </li>
                @endforeach

              </ul>
              <!-- END comment-list -->
              
              <div class="comment-form-wrap pt-5">
                <h3 class="mb-5">コメントしましょう</h3>
                <form action="" method="post" class="p-5 bg-light" id="form-comment-add">
                  @csrf
                  <!-- 投稿のユーザーID、非表示 -->
                  <input type="hidden" name="user_id" value="{{auth() -> guard('admin')-> id()}}">
                  <input type="hidden" name="article_id" value="{{$model -> id}}">                  
                  <div class="form-group">
                    <label for="message">Message</label>
                    <textarea name="content" id="message" cols="30" rows="10" class="form-control"></textarea>
                  </div>
                  <div class="form-group">
                    <input type="button" onclick="comment()" value="Post Comment" class="btn btn-primary">
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

  </div>
  @endsection

  @section('js')
  <script type="text/javascript" src="/admin/lib/jquery.validation/1.14.0/jquery.validate.js"></script> 
  <script type="text/javascript" src="/admin/lib/jquery.validation/1.14.0/validate-methods.js"></script> 
  <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/localization/messages_ja.js"></script>
  <script type="text/javascript">
    function comment(){
        $.ajax({
          type: "POST",
          url: "{{route('front.comment.store')}}",
          data: $('#form-comment-add').serialize(),
          success: function(result){
            // $('#message').val="";
            window.location = window.location;
            console.log("ok");
          },
          error: function(){
            window.location = "{{route('front.login')}}";

          }
        });
    }
         

  </script> 

  @endsection  
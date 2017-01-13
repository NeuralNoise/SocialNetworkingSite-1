@extends('sns_final/template_dashboard')

@section('sidebarleft_section')
<a href='{{ url("myprofile") }}'> my profile </a>
<a href='{{ url("myprofile/edit")}}'> edit account </a>
<a href='#'> friends </a>


<h1>my friends({{ $friendCount }})</h1>
      @foreach($myfriends as $friends)
          <a href='{{ url("user/$friends->id") }}'>{{ $friends -> name}}</a>
          {{$friends->updated_at}}<Br>

      @endforeach

@endsection



@section('content_section')
        
 

        <form action= '{{ url("dashboard/createpost") }}' method="POST" enctype="multipart/form-data">
          {{ csrf_field() }}

          {{ Auth::user()->name }}
          {{ Auth::user()->id }}
          First name:<br>

          <input type="file" name="image"></input>

          <textarea name='post_body'></textarea>
          <input type="submit" value="Submit">
        </form> 

       <h1>my post and friends</h1>
       
    @foreach($dashboardPost as $post)

      @if(($post->body != '') OR $post->img_src != ''))
      {{ $post->user_id }}: {{ $post->name }} : "{{$post->body }}" {{ $post->id}}
      <br>

      @if($post->img_src != null) 
         {{ $post-> img_src }}
         <div class="col-md-12">
            <div class="col-md-6">
               <img src=  "{{ asset('images/userpost/' .$post->img_src) }} " style="width: 100%;">
            </div> 
         </div>
      @endif

     
          <a href='{{ url("post/like/$post->id") }}'>like</a> |
          <a href='{{ url("post/like/$post->id") }}'>comment</a> |
          <a href="#">share</a> |
        
        @if($post->user_id == $id)
            <a href='{{ url("post/delete/$post->id") }}'>delete</a> 
        @endif
        <br>

      <br>
      <h3>Comments</h5>
      @foreach($loadComments as $comment)
        @if($comment->post_id == $post->post_id)
           {{ $comment->name }} : "{{ $comment-> comment_body }}" <br>
        @endif
      @endforeach

       <form action='{{ url("post/comment/$post->id") }}' method="POST">
          {{ csrf_field() }}
          comment:
          <textarea name='comment_body'></textarea>
          <input type="submit" value="post comment">
        </form> 
        <hr>

 @endif

    @endforeach

<h1>notification</h1>

<h3>friend request</h3>
  @foreach($friendRequest_get as $getRequest)
      {{ $getRequest ->user_id }}:  {{ $getRequest ->friend_id }} 
     {{ $getRequest ->name }} added you 
     <a href='{{url ("accept/$getRequest->user_id")}}'>accept</a>
      <a href="">not now</a>
     <Br>
  @endforeach


  @foreach($friendRequest_sent as $sentRequest)
      {{ $sentRequest ->user_id }}:  {{ $sentRequest ->friend_id }} 
      you added {{ $sentRequest ->name }} <Br>
  @endforeach
--
<br>


  --

  <br>
  @foreach($friendRequest_accept as $acceptedRequest)
      {{ $acceptedRequest ->user_id }}:  {{ $acceptedRequest ->friend_id }} 
      you accepted {{ $acceptedRequest ->name }} <Br>
  @endforeach

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

<div id="target">
  <h2>Click here</h2>
</div>

<script type="text/javascript">


$(document).ready(function(){


    $("#target").click(function(){
        $("h2").toggle();

  });

});
</script>



@endsection 

@section('sidebarright_content')
    
      <h1>People you might know</h1>
      <span>all users except current user</span>
      <div>
        @foreach($all_users as $user)
          <a href='{{ url("user/$user->id") }}'>{{ $user ->name }}</a><Br>
        @endforeach
      </div>

@endsection


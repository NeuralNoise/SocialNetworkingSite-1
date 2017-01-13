@extends('sns_final/template_profile')


@section('header')

@endsection

@section('sidebarleft_section')
<!-- <a href='{{ url("/dashboard2") }}'>back to dashboard</a> -->


@endsection


@section('content_section')

<Br>
	{{ $user_info -> name }}
	<Br>
   {{ $user_info -> email }}

   @if($user_info->userinfoExist())

   {{($user_info->userinfo->last()-> birthday) }}<bR>
   {{($user_info->userinfo->last()-> fname) }}<br>
   {{($user_info->userinfo->last()-> description) }}
   @endif



  
    @if($thisuserSentRequest != 0 )
   <a href='{{ url("/accept/$user_info->id")}}'><button type="submit" class="btn btn-primary commentbutton"><span class='glyphicon glyphicon-plus'></span>Accept Request</button></a>


    @elseif($meSentRequest != 0 )


       <a href='{{ url("/addfriend/$user_info->id")}}'></a>
   <a href='{{ url("/cancelRequest/$user_info->id")}}'><button type="submit" class="btn btn-primary commentbutton"><span class='glyphicon glyphicon-plus'></span>Cancel Request</button></a>


   
   @elseif($iFfriend == 0)


   <a href='{{ url("/addfriend/$user_info->id")}}'><button type="submit" class="btn btn-primary commentbutton"><span class='glyphicon glyphicon-plus'></span>Add</button></a>

   @else

   <!-- <a href='{{ url("/unfriend/$user_info->id")}}'>unfriend</a> -->
   <a href='{{ url("/unfriend/$user_info->id")}}'><button type="submit" class="btn btn-primary commentbutton" style='background-color:rgba(0, 0, 0, 0.6)'><span class='glyphicon glyphicon-remove' style:'color:red;'></span>Unfriend</button></a>
  @endif
   




   <h2>SAY SOMEthiNG</h2>
<!-- 
  <form action= '' method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            <br>say something<br>

            <input type="file" name="image"></input>

            <textarea name='post_body'></textarea>
            <input type="submit" value="Submit">
          </form>  -->




          <h1>posts</h1>



          @foreach($user_post as $post)
          <!-- ----- post start-->
          <div class='well' style="; background-color: #FFFFFF; bottom-margin:2%; border-radius: 0.5%; padding:0px;">
            <div style="background-color: #FFFFFF; padding: 2.5% 2.5% 2.5% 2.5%  ;">


 <?php $avatar = 'noavatar.png'; ?>


               @if ($post->userinfo->where('user_id',$post->user_id)->latest()->first()->avatar != '') 

    <?php $avatar = $post->userinfo->where('user_id',$post->user_id)->latest()->first()->avatar; ?>


    @endif



      <!--    <?php  $time = \Carbon\Carbon::createFromTimeStamp(strtotime($post->created_at))->diffForHumans() ?>
      {{ $time }} -->

      <div>
        <img src='{{ asset("images/userpic/$avatar")}}' class='image-avatar-m'>
        <a href='{{ url("user/".$post->user_id)}}'><strong>{{ $post->user->name}}</strong></a>

        @if($post->user->id == $currentuser->id)
            <!-- if post is made by the current user -->

                <span class="glyphicon glyphicon-remove-sign pull-right" id="delete_{{$post->id}}" onclick='deletePost({{$post->id}})' style='font-size: 150%; color: #E9EBEE; margin-left: 1%;'></span>

        <span class="glyphicon glyphicon-cog pull-right" style='font-size: 150%; color: #E9EBEE' onclick='editPost({{$post->id}})' id="edit_{{$post->id}}"></span>
         @endif
       </div>

       <div style="padding: 2%">{{ $post->body}}</div>


       @if($post->img_src != '')
       <div class='vertical-center'>
        <img src='{{ asset("images/userpost/$post->img_src")}}' class='img-responsive center-block' style='height:100%;'>
      </div>
      @endif
      <hr class='row' style="margin-bottom: 1%;">
      <!-- {{ $post->like()}} -->
<!-- 
      @if( $post->islike() == 0 )
   
      <span id='color{{$post->id}}' class="btn btn-default btn-sm" onclick="like({{$post->id}})">
        <span class="glyphicon glyphicon-thumbs-up"></span><span id='{{$post->id}}'> Like</span>
        <span class="label label-default">{{ $post->like()}}</span> </span>


        @else
    

        <span id='color{{$post->id}}' class="btn btn-default btn-sm" onclick="like({{$post->id}})" style='color:#365899'>
          <span class="glyphicon glyphicon-thumbs-up"></span> <u><strong><span id='{{$post->id}}'> Unlike</span></strong></u>
          <span class="badge" style='background-color:#365899'>{{ $post->like()}}</span></span>

          @endif -->



@if( $post->islike() == 0 )
<!-- <a href='{{ url("post/like/{$post->id}")}}'>like</a> -->
<span id='color{{$post->id}}' class="btn btn-default btn-sm" onclick="like({{$post->id}})">
  <span class="glyphicon glyphicon-thumbs-up"></span><span id='{{$post->id}}'> Like</span>
  <span class="label label-default">{{ $post->like()}}</span> </span>


  @else
  <!-- <a href='{{ url("post/unlike/{$post->id}")}}'>unlike</a>| -->

  <span id='color{{$post->id}}' class="btn btn-default btn-sm" onclick="like({{$post->id}})" style='color:#365899'>
    <span class="glyphicon glyphicon-thumbs-up"></span> <u><strong><span id='{{$post->id}}'> Unlike</span></strong></u>
    <!-- <span class="badge" style='background-color:#365899'>{{ $post->like()}}</span> -->
  </span>

  @endif




         <!--    @if($post->user->id == $currentuser->id)
            <span  id="delete_{{$post->id}}" onclick='deletePost({{$post->id}})'>| <a>delete</a></span>

              <a href='{{ url("post/delete/$post->id")}}'>| delete</a>
              <a href='{{ url("post/edit/$post->id")}}'>| edit</a>
              @endif -->


   <div id="dialog-confirm_{{$post->id}}" title="Delete Post" style='display:none;'>
                <p><span class="ui-icon ui-icon-alert" style="float:left; margin:12px 12px 20px 0;"></span>{{$post->user->name}}<br>"{{$post->body}}"</p>
              </div>


 <!-- modal for editing post -->

  <div id="dialog-edit_{{$post->id}}" title="Edit Post" style='display:none;'>
                <p><span class="ui-icon ui-icon-alert" style="float:left; margin:12px 12px 20px 0;"></span>{{$post->user->name}}<br>"{{$post->body}}"</p>

                @if($post->img_src != '')
                <img src='{{ asset("images/userpost/$post->img_src")}}' class='image-avatar-m img'>
                @endif

                <form action='{{ url("post/edit/$post->id/save") }}' method="POST" enctype="multipart/form-data">
                  {{ csrf_field() }}

                  <div class="form-group">
                    <label for="exampleInputFile">File input</label>
                    <input type="file" class="form-control-file" id="exampleInputFile" aria-describedby="fileHelp" name='post_image'>
                    <small id="fileHelp" class="form-text text-muted">This is some placeholder block-level help text for the above input. It's a bit lighter and easily wraps to a new line.</small>
                  </div>



                  <div class="form-group">
                    <label for="exampleTextarea"></label>
                    <textarea class="form-control" id="exampleTextarea" rows="3" name='post_body'>{{$post->body}}</textarea>
                  </div>

                  <button type="submit" class="btn btn-primary">Edit this post</button>
                </form>


              </div> 

<!-- end of edit modal -->





            </div>

            <div class='row commentsection'>
              <div class='col-md-offset-1'>
                <a href='#'><span class="glyphicon glyphicon-comment">Comments</a> {{ ($post->countComment() ) }}


                @if($post->like() != 0)
                |  <span id="countLike{{$post->id}}" class="glyphicon glyphicon-thumbs-up">
                <span id="COUNT{{$post->id}}">{{ $post->like() }}</span></span>
                @else
                <span id="countLike{{$post->id}}" class="glyphicon glyphicon-thumbs-up" style="display:none">
                  <span id="COUNT{{$post->id}}"></span></span>
                  @endif




                @foreach($post->comments()->orderBy('created_at','desc')->get() as $comment)
                <div class='col-md-12' style="margin-bottom: 1%;">


                  <div class='col-md-1'>
                   <?php $commentAvatar = $comment->userinfo()->orderBy('created_at','desc')->first() ; ?>

                   @if(!is_null($commentAvatar))
                   <img src='{{ url("images/userpic/$commentAvatar->avatar")}}' class='image-avatar-s'>      
                   @else
                   <img src='{{ url("images/userpic/noavatar.png")}}' class='image-avatar-s'>  
                   @endif
                 </div>

                 <div style='padding-left: 11%;'>
                   <a href='{{ url("/user/$comment->user_id")}}' style='color:#3B5998'><big>{{$comment->user->name}}</big></a> {{$comment->comment_body}}
                   <div >


                    <!-- <?php echo \Carbon\Carbon::createFromTimeStamp(strtotime($comment->created_at))->diffForHumans() ?> -->


                    @if($currentuser->id == $comment->user_id )
                      <a href='{{ url("/comment/delete/$comment->id")}}'><small>Delete</small></a>
                      <!-- <a href='{{ url("/comment/edit/$comment->id") }}'> -->
                      <span onclick="editComment({{$comment->id}})"><small>Edit</small></span>

                      @elseif($comment->user_id != $post->user_id || $comment->user_id == $post->user_id)

                      <a href='{{ url("/comment/delete/$comment->id")}}'><small>Delete</small></a>


                      @endif


                  </div>
                </div>

              </div>
              @endforeach

            </div>


           <div class='col-md-offset-1'>
          <form action= '{{ url("/post/comment/$post->id") }}'  method="POST" enctype="multipart/form-data">
           {{ csrf_field() }}


           <div class='col-md-8'>




            <div class='row'>
              <div class='col-md-2'>
                @if (count($currentuser->userinfo) == 0)
                <img src='{{ asset("images/userpic/noavatar.png")}}' class='image-avatar-s'>
                <?php $name = $currentuser->name; ?>
                @else
                <img src='{{ asset("images/userpic/$myinfo->avatar")}}' class='image-avatar-s'>
                <?php $fname = $currentuser->userinfo()->latest()->first()->fname ; ?>
                <?php $lname = $currentuser->userinfo()->latest()->first()->lname; ?>
                <?php $name = $fname." ".$lname; ?>
                @endif

              </div>

              <div class='col-md-8'>
                <div class="form-group">
                  <!-- <label for="exampleInputEmail1">Lastname</label> -->
                  <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="comment_body">
                  <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->

                </div>

              </div>
              <div class='col-md-2'>
               <button type="submit" class="btn btn-primary commentbutton"><span class="glyphicon glyphicon-ok-circle"></span> Comment</button>
             </div>
           </div>





         </form>

       </div>

     </div>

   </div>

 </div>
</form>
<!-- --- post end -->




<div id='csrf'>{{csrf_field()}} </div>


@endforeach







<script type="text/javascript">

  function deletePost(id){
    var dialog;

    dialog = $( "#dialog-confirm_"+id ).dialog({
      autoOpen: false,
      resizable: false,
      height: "auto",
      width: 400,
      modal: true,
      buttons: {
        "Delete this post": function() {
          $.get("{{ url("post/delete/")}}/"+id, function(data, status){
            location.reload();
          });
        },
        Cancel: function() {
          $( this ).dialog( "close" );
        }
      }
    });
    dialog.dialog( "open" );
  }


  function like(id){
    if($('#'+id).html() == " Like"){
      $.get("{{ url("post/like/")}}/"+id, function(data, status){
        $('#color'+id).css({"color":"#365899","font-weight":"bold",'text-decoration':'underline'});
        $('#'+id).html(" Unlike");
        var count = $('#COUNT'+id).html();
        if(count!="") count++
          else count = 1;
        $('#COUNT'+id).html(count);
        $('#countLike'+id).show();
      });
    } else {
      $.get("{{ url("post/unlike/")}}/"+id, function(data, status){
        $('#'+id).html(" Like");
        var count = $('#COUNT'+id).html();
        if(count == 1){
          $('#COUNT'+id).html("0");
          $('#countLike'+id).hide();
        } else $('#COUNT'+id).html(--count);

      });
    }
  }



  function accept(id){

    $.get("{{ url("accept/")}}/"+id, function(data, status){
     $('#accept_'+id).remove();
   });

    // alert(id);

  }





  function editPost(id){
    var dialog;

    dialog = $( "#dialog-edit_"+id ).dialog({
      autoOpen: false,
      resizable: false,
      height: "auto",
      width: 400,
      modal: true,
      buttons: {
        Cancel: function() {
          $( this ).dialog( "close" );
        }
      }
    });
    dialog.dialog( "open" );
  }

  function editComment(id){
    var value = $('#'+id).html();
    var csrf = ($('#csrf').html());
    var newValue = "<form action='{{ url('comment/edit') }}/"+id+"/save' enctype='multipart/form-data' method='post'>"+csrf+"<input type='text' name='comment_body' value='"+value+"'><input type='submit' name='edit' value='Edit'></form>";
    $('#'+id).html(newValue);

    // alert(value);
  }





</script>
@endsection
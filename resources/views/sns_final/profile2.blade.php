@extends('sns_final/template_profile')


@section('sidebarright_section')

@endsection



@section('sidebarleft_section')

<!-- FRIENDS -->
  @if($friendCount != 0)
  <div class='sidebar_right'>
   <div class='row'>
     <div class='col-md-12'>

       <div style="padding-left:5%">
        <a href=""><h2><span class='glyphicon glyphicon-user' style='color:#0066ff;'></span> Friends({{ $friendCount }})</h2></a>
      </div>

      @foreach($myfriends->take($take) as $friends)

      <div class='col-md-4' style=''>

        <div class='col-center-block text-center' style="background-color: white ;border: 1px solid black; ">
         @if( $friends->userinfo->isEmpty() || $friends->userinfo->last()->avatar=='')
         <!-- no avatar or blank -->
         <img src='{{ asset("images/userpic/noavatar.png")}}' class='image-avatar-m'>
         @else

         <img src='{{ asset("images/userpic/".$friends->userinfo->last()->avatar)}}' class='image-avatar-m'>

         @endif

       </div>
       <div class='friendlist'>
         <a href='{{ url("user/$friends->id") }}' class='friendlist-name'>  {{ $friends->name}}</a><br> 
         <?php $mightKnow[] = $friends->id; ?>
       </div>

     </div>

     @endforeach
     
   </div>
 </div>

</div>
@endif

<br>
<!-- END FRIENDS -->


<!-- <div class='well outerbox1' style='background-color: blue;'>
      <div class='row commentsection'>
         @for($i=0;$i< 9;$i++)

             <div class='col-md-4' style=''>
               <div style='margin:4%; background-color: black; padding:0px; height: 65px;width: 65px;'>
                  <img src='{{ asset("images/userpic/noavatar.png")}}' class='img-responsive'>
                </div>
            </div>

            @endfor
           
</div>

       <div class='row well outerbox1 commentsection' style='background-color: white;'>

        <!-- <img src='{{ asset("images/userpic/noavatar.png")}}'>
          <div class='col-md-12' >

            @for($i=0;$i< 9;$i++)

             <div class='col-md-4' style='background-color: gray; height:100px;  width:100px;'>
              <img src='{{ asset("images/userpic/noavatar.png")}}' class='img-responsive'>
            </div>

            @endfor
           

             
          </div>

        </div> -->
   <!--      </div>
 </div>  -->
   <div class='well row  text-center' style='padding:0px; margin-left:auto;margin-right:auto;'>

    <div class='col-md-12' >

      <div class='row ' style='height: 50px;'><span style='font-size: 20px;  '>
        <span class="glyphicon glyphicon-picture " style='font-size: 25px; text-align: left; color:#a5d950;'></span>
        Gallery</div>
      </div>
      @if(!($nineposts->isEmpty()))
      @foreach($nineposts as $gallery)


      @if(!is_null($gallery->img_src))
      <div class='col-md-4' style='margin:0px; padding: 0px; '> 
        <div class='row' style='margin-bottom: 1% ;'> 
         <img src='{{ asset("images/userpost/$gallery->img_src")}}' class="image-avatar-l img-responsive" style=" max-width: 100%; max-height: 100%;   margin-left: auto; margin-right: auto;">

       </div>
     </div>
     @endif

     @endforeach
     @endif
   </div>












   @endsection

   @section('content_section')


<!-- <div class='well outerbox1' style='background-color: blue;'>
      <div class='row commentsection'>
      asdasd</div>

       <div class='row commentsection' style='background-color: white;'>asdasdasd</div>
 </div>

-->



<div class='well outerbox2'>
  <div class='row commentsection' style='background-color: white;'>
    <div class='col-md-2'>
      <img src='{{ asset("images/userpic/$myavatar")}}' class='img-responsive' style="height:50px; width: 50px;">


      {{ $currentuser->name }}<br>
      {{ $currentuser->email }}<br>

      @if($currentuser->userinfoExist())
      
      {{($currentuser->userinfo->last()-> birthday) }}<bR>
      {{($currentuser->userinfo->last()-> fname) }}<br>
      {{($currentuser->userinfo->last()-> description) }}

      @endif

    </div>

    <div class='col-md-10'>



    </div>

    <h2>posts({{ count($myposts) }})
      friends({{ count($myfriends) }})</h2>

      

    </div>


    <!-- ----------------- -->
  </div>


  <div class='well outerbox2'>
    <div class='row commentsection' style='background-color: white;'>
      <div class='col-md-2'>
        <img src='{{ asset("images/userpic/$myavatar")}}' class='img-responsive center-block' style="height:50px; width: 50px; ">


 <!--  {{ $currentuser->name }}<br>
     {{ $currentuser->email }}<br>
   
    @if($currentuser->userinfoExist())
      
      {{($currentuser->userinfo->last()-> birthday) }}<bR>
      {{($currentuser->userinfo->last()-> fname) }}<br>
      {{($currentuser->userinfo->last()-> description) }}

      @endif -->

    </div>
<!-- 
  <form action= '{{ url("dashboard/createpost") }}' method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}

            {{ Auth::user()->name }}
            {{ Auth::user()->id }}
            <br>say something<br>

            <input type="file" name="image"></input>

            <textarea name='post_body'></textarea>
            <input type="submit" value="Submit">
          </form>  -->
          <div class='col-md-10'>

            <form action= '{{ url("dashboard/createpost") }}'  method="POST" enctype="multipart/form-data" >
             {{ csrf_field() }}

             <div class='col-md-12'>
              <div class="form-group">
                <label for="exampleTextarea"></label>
                <textarea class="form-control" id="exampleTextarea" rows="3" name= "post_body"  placeholder="What's on your mind?"></textarea>
              </div>  </div>
              <div class='col-md-12'>

                <div class="form-group pull-left">
                  <!-- <label for="exampleInputFile">File input</label> -->
                  <input type="file" class="form-control-file" id="exampleInputFile" aria-describedby="fileHelp" name= "image">
                  <!-- <small id="fileHelp" class="form-text text-muted">This is some placeholder block-level help text for the above input. It's a birthday lighter and easily wraps to a new line.</small> -->
                </div>

                <button type="submit" class="btn btn-primary pull-right button" >Post</button>
              </form>
            </div>
<!-- 
    <h2>posts({{ count($myposts) }})
    friends({{ count($myfriends) }})</h2>
  -->


</div>
</div>  


</div>

@foreach($myposts as $post)
<!-- ----- post start-->
<div class='well outerbox1' >
  <div class='outerbox2'>

    <?php $avatar = 'noavatar.png'; ?>
 @if(!(is_null($post->userinfo)))
  @if ($post->userinfo->where('user_id',$post->user_id)->latest()->first()->avatar != '') 

    <?php $avatar = $post->userinfo->where('user_id',$post->user_id)->latest()->first()->avatar; ?>

    @endif
  @endif
      <!--    <?php  $time = \Carbon\Carbon::createFromTimeStamp(strtotime($post->created_at))->diffForHumans() ?>
      {{ $time }} -->

      <div>
        <img src='{{ asset("images/userpic/$avatar")}}' class='image-avatar-m '>
        <a href='{{ url("user/".$post->user_id)}}'><strong>{{ $post->user->name}}</strong></a>

      @if($post->user->id == $currentuser->id)

        <span class="glyphicon glyphicon-remove-sign pull-right" id="delete_{{$post->id}}" onclick='deletePost({{$post->id}})' style='font-size: 150%; color: #E9EBEE; margin-left: 1%;'></span>

        <!--  glyphicon glyphicon-cog -->

        <span class="glyphicon glyphicon-cog pull-right" style='font-size: 150%; color: #E9EBEE' onclick='editPost({{$post->id}})' id="edit_{{$post->id}}"></span>

<!--            <a href='{{ url("post/edit/$post->id")}}'><span class="glyphicon glyphicon-cog pull-right" style='font-size: 150%; color: #E9EBEE' ></span></a>
-->

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






<!-- edit modal -->
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

<!-- edit modal -->





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
                   <?php $commentAvatar = $comment->userinfo()->orderBy('updated_at','desc')->first() ; ?>

                  @if(!is_null($commentAvatar))

                     <img src='{{ url("images/userpic/$commentAvatar->avatar")}}' class='image-avatar-s'>      
                     @else
                     <img src='{{ url("images/userpic/noavatar.png")}}' class='image-avatar-s'>  
                     @endif

                 </div>

                 <div style='padding-left: 11%;'>

                     <a href='{{ url("/user/$comment->user_id")}}' style='color:#3B5998'><big>{{ $comment->user -> name}}</big></a>
                     <span id="{{$comment->id}}">{{ $comment->comment_body }}</span>
                     <div >


                      <!-- <?php echo \Carbon\Carbon::createFromTimeStamp(strtotime($comment->created_at))->diffForHumans() ?> -->

                      @if($currentuser->id == $comment->user_id )
                      <a href='{{ url("/comment/delete/$comment->id")}}'><small>Delete</small></a>
                      <!-- <a href='{{ url("/comment/edit/$comment->id") }}'> -->
                      <span onclick="editComment({{$comment->id}})"><small>Edit</small></span>

                      @elseif($comment->user_id != $post->user_id)

                      <a href='{{ url("/comment/delete/$comment->id")}}'><small>Delete</small></a>
                  
                      @endif

                    </div>
                  </div>

              </div>
              @endforeach

            </div>

       <!-- start edit comment  modal -->

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
       <!-- end edit comment modal -->

     </div>

   </div>

 </div>
</form>


<div id='csrf'>{{csrf_field()}} </div>
<!-- --- post end -->


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
  }





</script>


@endsection
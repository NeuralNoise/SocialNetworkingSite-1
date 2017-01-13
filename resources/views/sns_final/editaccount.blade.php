@extends('sns_final/template_dashboard')

@section('content_section')


@if( $currentuser->userinfo->isEmpty() )


<div class='container-fluid '>
  <div class='col-md-offset-2 col-md-7 well'>
    <form action= '{{ url("myprofile/$currentuser->id/edit/save") }}'  method="POST" enctype="multipart/form-data">
     {{ csrf_field() }}


     <div class='col-md-3'>

       <img src='{{ asset("images/userpic/noavatar.png")}}' class='img-responsive' >


     </div>

     <div class="form-group">
      <label for="exampleInputFile">File input</label>
      <input type="file" class="form-control-file" id="exampleInputFile" aria-describedby="fileHelp" name= "avatar">
      <small id="fileHelp" class="form-text text-muted">This is some placeholder block-level help text for the above input. It's a bit lighter and easily wraps to a new line.</small>
    </div>

    <div class='row'>
      <div class='col-md-6'>
        <div class="form-group">
          <label for="exampleInputEmail1">Firstname</label>
          <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Firstname" name="firstname" required ="required">
          <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
      </div>
      <div class='col-md-6'>
        <div class="form-group">
          <label for="exampleInputEmail1">Lastname</label>
          <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Lastname" name="lastname" required ="required">
          <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
      </div> </div>
      <div class='row'>
        <div class='col-md-6'>
          <div class="form-group">
            <label for="exampleInputEmail1">Gender</label>
            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Gender" name="gender" required ="required">
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
          </div></div>
          <div class='col-md-6'>
            <div class="form-group">
              <label for="exampleInputPassword1">Birthday</label>
              <input type="date" class="form-control" id="exampleInputPassword1" placeholder="Password" name="birthday" required ="required">
            </div></div></div>
            <div class="form-group">
              <label for="exampleTextarea">Description</label>
              <textarea class="form-control" id="exampleTextarea" rows="3" name= "description"></textarea>
            </div>

            <button type="submit" class="btn btn-primary commentbutton" >Submit</button>


              <span onclick = 'deleteAccount({{$currentuser->id}})' class='pull-right' style='color: #2E6DA4; text-decoration: underline;'>Delete Account</span>


          </form>

        </div>

      </div>


      @else

      <div class='col-md-offset-2 col-md-7 well'>
        <form action= '{{ url("myprofile/$currentuser->id/edit/save") }}'  method="POST" enctype="multipart/form-data">
         {{ csrf_field() }}

         <?php $picture = $currentuser->userinfo()->orderBy('updated_at','desc')->first()->avatar ; ?>

         <div class='col-md-3'>
          @if($currentuser->userinfo()->orderBy('updated_at','desc')->first()->avatar == '')
          <img src='{{ asset("images/userpic/noavatar.png")}}' class='img-responsive' >

          @else
          <img src='{{ asset("images/userpic/$picture")}}' class='img-responsive'>
          @endif

        </div>

        <div class='col-md-9'>
          <div class="form-group">
            <label for="exampleInputFile">Profile Picture</label>
            <input type="file" class="form-control-file" id="exampleInputFile" aria-describedby="fileHelp" name= "avatar" require ="require">
            <small id="fileHelp" class="form-text text-muted">This is some placeholder block-level help text for the above input. It's a bit lighter and easily wraps to a new line.</small>
          </div> </div>

          <div class='row'>
            <div class='col-md-6'>
              <div class="form-group">
                <label for="exampleInputEmail1">Firstname</label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value= '{{$currentuser->userinfo()->orderBy('updated_at','desc')->first()->fname}}' name="firstname">
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
              </div>
            </div>
            <div class='col-md-6'>
              <div class="form-group">
                <label for="exampleInputEmail1">Lastname</label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"  value='{{$currentuser->userinfo()->orderBy('updated_at','desc')->first()->lname}}' name="lastname">
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
              </div>
            </div> </div>

            <div class="form-group">
              <label for="exampleInputEmail1">Gender</label>
              <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value='{{$currentuser->userinfo()->orderBy('updated_at','desc')->first()->gender}}' name="gender">
              <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>

            <div class="form-group">
              <label for="exampleInputPassword1">Birthday</label>
              <input type="date" class="form-control" id="exampleInputPassword1" value='{{ $currentuser->userinfo()->orderBy('updated_at','desc')->first()->birthday}}' name="birthday">
            </div>

            <div class="form-group">
              <label for="exampleTextarea">Description</label>
              <textarea class="form-control" id="exampleTextarea" rows="3" name= "description" >{{$currentuser->userinfo()->orderBy('updated_at','desc')->first()->description}}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>

              <span onclick = 'deleteAccount({{$currentuser->id}})' class='pull-right' style='color: #2E6DA4; text-decoration: underline;'>Delete Account</span>

            <!-- <a href='{{ url("myprofile/$currentuser->id/delete") }}' class='pull-right'>Delete Account</a> -->
          </form>

        </div>





        @endif



        <div id="dialog-confirm_{{$currentuser->id}}" title="Delete Account" style='display:none;'>
          <p><span class="ui-icon ui-icon-alert" style="float:left; margin:12px 12px 20px 0;"></span>
            Are you sure you want to delete account?
          </p> 
        </div>
        

        <script type="text/javascript">

         function deleteAccount(id){


          var dialog;

          dialog = $( "#dialog-confirm_"+id ).dialog({
            autoOpen: false,
            resizable: false,
            height: "auto",
            width: 400,
            modal: true,
            buttons: {
              "Delete this Account": function() {
                $.get("{{ url("myprofile/")}}/"+id+"/delete", function(data, status){
                 
                });

                 location.reload();

              },
              Cancel: function() {
                $( this ).dialog( "close" );
              }
            }
          });
          dialog.dialog( "open" );
        }

      </script>




      @endsection


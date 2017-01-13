<!DOCTYPE html>
<html>
<head>
	<title></title>

	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href='{{ asset("/css/mystyle_dashboard.css")}}'>


  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <!-- <link rel="stylesheet" href="/resources/demos/style.css"> -->
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

  
</head>
<body>	


<!-- ----------------------- start navbar-->


<style>

.navwhite{
  color:white;
}


</style>


	<div class='container-fluid' style='margin-bottom: 5%; color:white;'>
	<div class='row'>
		
			<nav class="navbar navbar-default navbar-fixed-top" style='background-color: #3B5998;'>
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand " href="#">Brand</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="active"><a href="#" class='navwhite'>Link <span class="sr-only">(current)</span></a></li>
        <li><a href="#" class='navwhite'>Link</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li ><a href='{{ url("myprofile/$currentuser->id/edit") }}'>Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">Separated link</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">One more separated link</a></li>
          </ul>
        </li>
      </ul>
      <form class="navbar-form navbar-left">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Search">
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
      </form>


<div class='col-md-5'>



      <ul class="nav navbar-nav navbar-right">
      	<li><a href='{{ url("/myprofile")}}'>

	 @if (count($currentuser->userinfo) == 0)
      <img src='{{ asset("images/userpic/noavatar.png")}}' style="height:20px; width: 20px;">
    @else
      <img src='{{ asset("images/userpic/$myinfo->avatar")}}' style="height:20px; width: 20px;">
    @endif
      	{{$currentuser->name}}</a></li>
        <li><a href='{{ url("/dashboard")}}'>Home</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">My Account <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href='{{ url("myprofile/$currentuser->id/edit") }}'>Edit Account</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li role="separator" class="divider"></li>
            <li><a href='{{ url("/logout")}}'>Logout</a></li>
          </ul>
        </li>
      </ul>


</div>



    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
		</div>
</div>


<!-- ----------------------- end navbar-->






		<div class='row ' >
			<div class=' col-md-3 col-sm-12 affix' style='padding-left: 5%;'>
				@yield('sidebarleft_section')
			</div>

			<style>
				.well{
					background-color: "white";
				}
			</style>


		<!-- 	<div class='col-md-7 col-sm-12 well' style=" border-style: none;border-right: solid  thin gray; border-left: solid  thin gray; background-color: white;"> -->
		<div class='col-md-offset-3 col-md-6 col-sm-12' ;>
				@yield('content_section')
			</div>



			<div class='col-md-3 col-sm-12'  style='padding-right: 5%;'>
				@yield('sidebarright_section')
			</div>
		</div>
		
		<div>
			footer
		</div>
	</div>

</body>
</html>
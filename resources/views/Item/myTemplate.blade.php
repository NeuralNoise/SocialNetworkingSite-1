<!DOCTYPE html>
<html>
<head>
	<title></title>

	<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="{{ asset ("https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css")}}">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<style>

* {
    box-sizing: border-box;
}

.content_area{
	/*background-color: #f2f2f2;*/
}

.itemdiv{
	margin:.05%;	
	background-color: #f2f2f2;
}



</style>

</head>
<body>
	
	<div>
		<!-- myTemplate.php<br>
		HEADER -->
		<!-- @yield('navigation_bar') -->
		<nav class="navbar navbar-default">
			<div class="container-fluid">
				<div class="navbar-header">
					<a class="navbar-brand" href="#">WebSiteName</a>
				</div>
				<ul class="nav navbar-nav">
					<li class="active"><a href="{{url("item_home")}}">Home</a></li>
					<li><a href="{{url("item_list")}}">Items</a></li>
					<li><a href="#">Page 2</a></li>
					<li><a href="#">Page 3</a></li>
				</ul>
			</div>
		</nav>

	</div>


<div class ='container-fluid'>
	<div class='row'>	
		<div class= 'col-md-2'> 
			SIDEBAR
		</div>

		<div class='col-md-8 content_area'>
			<!-- CONTENT -->
			
		@yield('content_section')



		</div>
	</div>
</div>

	<div>
		FOOTER

	</div>

</body>
</html>
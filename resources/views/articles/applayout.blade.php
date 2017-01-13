<!DOCTYPE html>
<html>
<head>
	<title></title>

	<link rel="stylesheet" href="{{ asset ("https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css")}}">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>



</head>
<body>
	
	<div>
		<nav class="navbar navbar-default">
			<div class="container-fluid">
				<div class="navbar-header">
					<a class="navbar-brand" href="#">WebSiteName</a>
				</div>
				<ul class="nav navbar-nav">
					<li class="active"><a href="{{url("articles")}}">Home</a></li>
					<li><a href="{{url("/articles/create")}}">Create</a></li>
					<li><a href="#">Page 2</a></li>
					<li><a href="#">Page 3</a></li>
				</ul>
			</div>
		</nav>
	</div>

	<div>
		<h1>SIDEBAR</h1>
		<!-- *YIELD -->
		@yield('sidebar_content')
	</div>

	<div>
		<h1>CONTENT</h1>
		<!-- *YIELD -->
		<!-- calls content_section from resources/views/article_list -->
		@yield('content_section')

	</div>

	<div>
		<h1>FOOTER</h1>
	</div>

</body>
</html>
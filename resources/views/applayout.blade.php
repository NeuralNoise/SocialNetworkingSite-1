<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	
	<div>
		HEADER
	</div>

	<div>
		SIDEBAR
		@yield('sidebar_content')
	</div>

	<div>
		CONTENT
		<!-- calls content_section from resources/views/article_list -->
		@yield('content_section')

	</div>

	<div>
		FOOTER
	</div>

</body>
</html>
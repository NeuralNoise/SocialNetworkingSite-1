@extends('articles/Applayout')

@section('content_section')
	<h1>Create New Article</h1>
	<a href='{{url("articles")}}'>Go back</a>

	@if (count($errors) > 0)
		<div class='alert alert-danger'>
			<ul>
				@foreach($errors->all() as $error)
					<li>{{ $error }}</li>
				@endforeach
			<ul>
		</div>
	@endif
		<!-- <form action='{{url("articles")}}'> -->
		<form action="" method="POST">
			{{ csrf_field() }}
			Title:<br>
			<input type="text" name="title">
			<br>
			Content<br>
			<textarea name="content"></textarea>
			<input type="submit" value="Submit">
		</form> 

@endsection
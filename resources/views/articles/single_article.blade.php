@extends('articles/applayout')

@section('content_section')
	<div>
	<p><h3>Title: {{ $article->title }}</h3></p>
	<p>Content: {{ $article->content }}</p>
	</div>
	<a href='{{url("articles/$article->id/delete")}}'>DELETE</a>
	<a href='{{url("articles")}}'>Back</a>
@endsection
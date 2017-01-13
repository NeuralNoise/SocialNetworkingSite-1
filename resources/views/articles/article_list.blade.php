@extends('articles/applayout')
<!-- 
@section('content_section')
	<pre>***This ('content_section') is from article_list.blade.php***</pre>
		<h2>
			{{ $article1->title}}
		</h2>
	<pre>***end ('content_section')***</pre>

		<br>--------------foreach all articles from DATABASE and print title & content
	<ul>
	@foreach($all_articles as $article)
		<h1>{{$article->title}}</h1>
		<p>{{$article->content}}</p>
	@endforeach
	</ul>
	<br>--------------end foreach
@endsection


@section('sidebar_content')
	<pre>***This ('sidebar_content') is from article_list.blade.php***</pre>
	<ul>
		<pre>from database- TITLE</pre>
		<li>{{ $article1 ->title }}</li>
		<li>{{ $article2 ->title }}</li>
	</ul>
	--------------foreach (article/article_list)<br>

	<ul>
		@foreach($categories as $tag)
			<li><a href="#">{{$tag}}</a></li>
		@endforeach
	</ul>
	<br>--------------end foreach

	<br>--------------if else statement (article/article_list)<br>
	@if (!empty($article2))
		'Article2 ' is not empty
	@endif 
	<br>--------------end if**
			
	<pre>***end ('sidebar_content')***</pre>

@endsection
 -->
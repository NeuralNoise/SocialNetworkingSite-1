@extends('articles/applayout')

@section('content_section')
	<a href='{{ url("articles/create") }}'>Create new Article</a>


	<div>

		Current Preference: {{ $preference }}
		<form action= '{{ url("setpreference") }}' method ="POST">
			{{ csrf_field() }}
			Preference:
			<select name='preference_select'>
				<option value="politics">Politics</option>
				<option value = "weather">Weather</option>
				<option value="sports">Sports</option>
			</select>
			<input type="submit" value="Set">
		</form>	
	</div>


	<h2>Articles</h2>

	<ul>
		@foreach ($all_articles as $article)
			<li><a href='{{ url("articles/$article->id") }}'>{{$article->title}}</a></li>
		@endforeach
	</ul>
@endsection	
@extends('sns_final/template_profile')

@section('content_section')
    {{ Auth::user()->name }}
    {{ Auth::user()->id }}
    {{ $login_user->id }}

{{ dd($myinfo) }}


  <h4>friends({{ $friendCount }})| posts ({{ $postCount }}) |  </h4>
  

<br>

  <form action= '{{ url("dashboard/createpost") }}' method="POST">
          {{ csrf_field() }}	
         Post:<br>
          <textarea name='post_body'></textarea>
          <input type="submit" value="Submit">
   </form> 


    <h1>my post</h1>
<br>
	@foreach($post_obj as $post_obj)
	  	{{ $post_obj ->body }}<Br>
	@endforeach

@endsection
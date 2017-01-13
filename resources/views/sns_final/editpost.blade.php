@extends('sns_final/template_dashboard')

@section('content_section')

<form action='{{ url("post/edit/$post->id/save") }}' method="POST" enctype="multipart/form-data">
{{ csrf_field() }}
	@if(is_null($post->img_src))

	@endif

  <div class="form-group">
    <label for="exampleInputFile">File input</label>
    <input type="file" class="form-control-file" id="exampleInputFile" aria-describedby="fileHelp" name='post_image'>
    <small id="fileHelp" class="form-text text-muted">This is some placeholder block-level help text for the above input. It's a bit lighter and easily wraps to a new line.</small>
  </div>


  
  <div class="form-group">
    <label for="exampleTextarea"></label>
    <textarea class="form-control" id="exampleTextarea" rows="3" name='post_body'>{{$post->body}}</textarea>
  </div>

  <button type="submit" class="btn btn-primary">Done</button>
</form>




@endsection
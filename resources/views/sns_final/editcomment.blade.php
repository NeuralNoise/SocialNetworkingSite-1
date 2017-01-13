@extends('sns_final/template_dashboard');

@section('content_section')
	
	<form action='{{ url("comment/edit/$comment->id/save") }}' enctype="multipart/form-data" method="post">
		{{ csrf_field() }}

		<div class='col-md-8'>
			<div class='row'>
				<div class='col-md-8'>
					<div class="form-group">
						<input aria-describedby="emailHelp" class="form-control" id="exampleInputEmail1" 
						name="comment_body" type="text" value="{{$comment->comment_body}}">
						
					</div>
				</div>

				<div class='col-md-2'>
					<button class="btn btn-primary" type="submit"><span class="glyphicon glyphicon-ok-circle"></span> Done</button>
				</div>
			</div>
		</div>
	</form>


@endsection
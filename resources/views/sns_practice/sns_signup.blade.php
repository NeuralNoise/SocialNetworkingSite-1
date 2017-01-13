@extends('sns_practice/sns_template')

@section('content_section')
	<div>
		<form action="" method="POST">
			{{ csrf_field() }}
			username:	<input type='text' name='username'> <br>
			password:	<input type='text' name='password1'> <br>
			password:	<input type='text' name='password2'> <br>
			<input type='submit' name='submit'>
		</form>
	</div>
@endsection
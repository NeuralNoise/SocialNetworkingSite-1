@extends('sns_practice/sns_template')

@section('content_section')
	<a href="{{url("sns/login")}}">Log in</a>
	<a href="{{url("sns/signup")}}">Sign up</a>
@endsection
@extends('Item/myTemplate')

@section('content_section')
		<div class='col-md-12'>

			<div class='col-md-4 itemdiv' >
				<p><h2>{{$item->name}}</h2></p>
				<p>{{$item->qty}}pcs</p>
				<p>{{$item->category}}</p>
			</div>
		</div>

@endsection

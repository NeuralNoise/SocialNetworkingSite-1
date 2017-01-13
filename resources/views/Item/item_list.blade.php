@extends('item/myTemplate')

<!-- navigation bar -->
@section('navigation_bar')

@endsection

<!-- content -->
@section('content_section')
		<div class='col-md-12'>
	@foreach($all_items as $items)
			<div class='col-md-4' >
				<div class='itemdiv'>
					<p>{{$items->name}}</p>
					<p>{{$items->qty}}pcs</p>
					<p>{{$items->category}}</p>
				</div>
			</div>
	@endforeach
@endsection
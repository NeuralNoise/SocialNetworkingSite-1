@extends('Item/myTemplate')

@section('navigation_bar')
	<nav class="navbar navbar-default">
	  <div class="container-fluid">
	    <div class="navbar-header">
	      <a class="navbar-brand" href="#">WebSiteName</a>
	    </div>
	    <ul class="nav navbar-nav">
	      <li class="active"><a href="../item_home">Home</a></li>
	      <li ><a href="../item_list">Items</a></li>
	      <li><a href="#">Page 2</a></li>
	      <li><a href="#">Page 3</a></li>
	    </ul>
	  </div>
	</nav>
@endsection

@section('content_section')
	@foreach($all_items as $items)
			<div class='col-md-4 col-sm-4 col-xs-12' >
				<div class='itemdiv' >
					<p><h2><a href ='{{url("items/$items->id")}}'>{{$items->name}}</a></h2></p>
				</div>
			</div>
	@endforeach
@endsection
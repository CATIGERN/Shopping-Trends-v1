@extends('layout')

@section('title')
Cart
@stop

@section('header')
<script src="/js/alert.js-0.0.0/dist/alert.min.js"></script>
<link rel="stylesheet" href="/js/alert.js-0.0.0/dist/alert.core.min.css" />
<link rel="stylesheet" href="/js/alert.js-0.0.0/dist/alert.default.min.css" />

<script>
function markItem(cartid, iditem, itemname){
	document.getElementById('markForm').action = '/carts/' + cartid + '/mark/' + iditem;
	document.getElementById('itemDiv').innerHTML = itemname.toString();
	alertjs.show({
	title: 'Purchase Details',
	text: '#myCustomDialog', //must be an id
	from: 'top',
});
}
</script>

<script>

</script>
@stop

@section('content')
		<h1 align="center">{{ $cartname }}</h1>
		@foreach ($items as $item)
			<li><a href="javascript:markItem({{ $cartid }}, {{ $item->iditem}}, '{{ $item->itemname }}')">
			@if ($item->itembought == '1')
		 		<del>{{ $item->itemname }}</del>
		 	@else
		 		{{ $item->itemname }}
		 	@endif
		 	</a></li>
		@endforeach
        </div>
        <form method="POST" action="/carts/{{ $cartid }}/add">
        <input type="text" name="itemname">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
     	<input type="submit" value="Add Item"></input>
     	<br>
        @if (session()->has('message'))
        	{{ session('message') }}
        @else
       		Add a new item
       	@endif
        </form>

        <div id="myCustomDialog" style="display: none">
			<div class="dialogWrapper">
				<form id="markForm" method="POST">
					<div id="itemDiv" align="center"></div><br><br>
					Store: <input type="text" name="storename" align="center"></input><br><br>
					Price: <input type="text" name="price" align="center"></input><br><br>
					Quantity: <input type="text" name="quantity" align="center"></input><br><br>
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<br>
					<input type="submit" value="Mark Item"></input>
				</form>
			</div>
		</div>

@stop
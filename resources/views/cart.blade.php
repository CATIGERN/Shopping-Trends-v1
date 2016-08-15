@extends('layout')

@section('title')
Cart
@stop

@section('header')
<script src="/js/alert.js-0.0.0/dist/alert.min.js"></script>
<link rel="stylesheet" href="/js/alert.js-0.0.0/dist/alert.core.min.css" />
<link rel="stylesheet" href="/js/alert.js-0.0.0/dist/alert.default.min.css" />

<script>
function markItem(cartid, iditem, itemname, marked){
	document.getElementById('markForm').action = '/carts/' + cartid + '/mark/' + iditem;
	document.getElementById('itemDiv').innerHTML = itemname.toString();
	if(marked == 1){
		document.getElementById('markForm').action = '/carts/' + cartid + '/edit/' + iditem;
		// var url = '/carts/' + cartid + '/get/' + iditem;
		// httpGetAsync(url, function(data){
		// 	data = JSON.parse(data);
		// 	document.getElementById("storename").value = data[0].storename;
		//  	document.getElementById('price').value = data[0].price;
		//  	document.getElementById('quantity').value = data[0].quantity;
		// });
	}
	alertjs.show({
	title: 'Purchase Details',
	text: '#myCustomDialog', //must be an id
	from: 'top',
});
}

function httpGetAsync(theUrl, callback)
{
    var xmlHttp = new XMLHttpRequest();
    xmlHttp.onreadystatechange = function() { 
        if (xmlHttp.readyState == 4 && xmlHttp.status == 200)
            callback(xmlHttp.responseText);
    }
    xmlHttp.open("GET", theUrl, true); // true for asynchronous 
    xmlHttp.send(null);
}
</script>

@stop

@section('content')
		<h1 align="center">{{ $cartname }}</h1>
		<h2 id="vishal"></h2>
		@foreach ($items as $item)
			<li>
			@if ($item->itembought == '1')
		 		<a href="javascript:markItem({{ $cartid }}, {{ $item->iditem}}, '{{ $item->itemname }}', 1)">
		 		<del>{{ $item->itemname }}</del>
		 		</a>
		 	@else
		 		<a href="javascript:markItem({{ $cartid }}, {{ $item->iditem}}, '{{ $item->itemname }}', 0)">
		 		{{ $item->itemname }}
		 		</a>
		 	@endif
		 	</li>
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
					Store: <input type="text" name="storename" align="center" value=""></input><br><br>
					Price: <input type="text" name="price" align="center" value=""></input><br><br>
					Quantity: <input type="text" name="quantity" align="center" value=""></input><br><br>
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<br>
					<input type="submit" value="Mark Item"></input>
				</form>
			</div>
		</div>

@stop
@extends('layout')

@section('title')
Cart
@stop

@section('header')

<script src="/js/alert.js-0.0.0/dist/alert.min.js"></script>
<link rel="stylesheet" href="/js/alert.js-0.0.0/dist/alert.core.min.css" />
<link rel="stylesheet" href="/js/alert.js-0.0.0/dist/alert.default.min.css" />
<link rel="stylesheet" href="/css/tablestyle.css">
<link rel="stylesheet" href="/css/style.css">

<script>
function markItem(cartid, iditem, itemname, marked){
	document.getElementById('markForm').action = '/carts/' + cartid + '/mark/' + iditem;
	document.getElementById('itemDiv').innerHTML = itemname.toString();
	if(marked == 1){
		document.getElementById('markForm').action = '/carts/' + cartid + '/edit/' + iditem;
	}
	alertjs.show({
	title: 'Purchase Details',
	text: '#myCustomDialog',
	from: 'top',
});
}

function deleteItem(url){
	document.getElementById('deleteitem').action = url;
	document.getElementById('deleteitem').submit();
}

</script>

@stop

@section('content')
		<h1 align="center" style="color:#595959; font-weight:bold">{{ $cartname }}</h1>
		<div align="center">
		<table>
		<tr>
			<th>Item name</th>
			<th>Store</th>
			<th>Price</th><th></th>
		</tr>
		@foreach ($items as $item)
			<tr><td>
			@if ($item->itembought == '1')
		 		<a href="javascript:markItem({{ $cartid }}, {{ $item->iditem}}, '{{ $item->itemname }}', 1)">
		 		<del>{{ $item->itemname }}</del>
		 		</a>
		 	@else
		 		<a href="javascript:markItem({{ $cartid }}, {{ $item->iditem}}, '{{ $item->itemname }}', 0)">
		 		{{ $item->itemname }}
		 		</a>
		 	@endif
		 	</td>
		 	<td>
		 		@if ($item->storename != null)
		 			{{ $item->storename }}
		 		@else
		 			Not bought
		 		@endif
		 	</td><td>
		 		@if ($item->price != null)
		 			{{ $item->price }}&#x20B9;
		 		@else
		 			Not purchased
		 		@endif
		 	</td><td><a href="javascript:deleteItem('/carts/{{ $cartid }}/delete/{{ $item->iditem }}')">
		 	<img src="/delete.png" height="20" width="20"></a></td>
		 	</tr>
		@endforeach
		</table><br>
		<form method="POST" action="/carts/{{ $cartid }}/add">
        <ul class="input-list style-1 clearfix">
		      <input type="text" name="itemname" placeholder="Add new item">
		  </ul>
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
     	<input type="submit" value="Add Item"></input>
     	<br>
        @if (session()->has('message'))
        	{{ session('message') }}
        @else
       		<p style="text-align:center; color:green">Add a new item</p>
       	@endif
        </form></div>
        

        <div id="myCustomDialog" style="display: none">
			<div class="dialogWrapper">
				<form id="markForm" method="POST">
					<div id="itemDiv" align="center"></div><br><br>
					Store: <input type="text" id="storename" name="storename" align="center" value=""></input><br><br>
					Price: <input type="text" id="price" name="price" align="center" value=""></input><br><br>
					Quantity: <input type="text" id="quantity" name="quantity" align="center" value=""></input><br><br>
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<br>
					<input type="submit" value="Mark Item"></input>
				</form>
			</div>
		</div>

		<form method="POST" id="deleteitem">
			{{ method_field('DELETE') }}
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
		</form>

@stop
@extends('layout')

@section('title')
Cart
@stop

@section('header')

<script src="/js/alert.js-0.0.0/dist/alert.min.js"></script>
<script src="/js/angular.min.js"></script>
<script src="/js/app/shoppingtrends.js"></script>
<script src="/js/controllers/CartController.js"></script>
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

function change(){
	var selects = document.getElementById('predictions').options;
	if(selects.length){
		var val = selects[0].value;
		var original = document.getElementById('maininput').value;
		if(!original){
			document.getElementById('autocomplete').value = '';
			return;
		}
		if(val.indexOf(original) == 0){
			document.getElementById('autocomplete').value = val;
		}
		else{
			document.getElementById('autocomplete').value = '';
		}
	}
	else{
		document.getElementById('autocomplete').value = '';
	}
}





</script>

@stop

@section('content')
		<div style="margin:0 35%; width:50%; display:inline-block; text-align:center">
		<a href="/" style="float:left; margin:0 1.5%; width:50%; position:relative ">
		<img src="/home.png" width="30" height="30"></a>
		<h1 style="color:#595959; font-weight:bold; float:left; margin:0 1.5%; width:50%;position:relative">
		{{ $cartname }}</h1>
		</div><br><br>
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
		<div ng-app="shoppingtrends">
        <ul class="input-list style-1 clearfix">
        <div ng-controller="CartController" id="CartController">
		      <input type="text" name="itemname" placeholder="" style="z-index:5;
		      background:transparent; position:absolute; margin:0 37%" id="maininput"
		      onkeyup="change()" ng-model="data">
		      <input type="text" style="color:#595959; background:transparent; z-index:1; position:absolute; margin:0 37%"
		       id="autocomplete" disabled="disabled">
		       <select id="predictions" style="visibility:hidden">
		       		<option ng-repeat = "item in items | filter:data" value="@{{ item.itemname }}"> 
		       		@{{ item.itemname }}</option>
		       </select>
		       </div>
		  </ul>
        <input type="hidden" name="_token" value="{{ csrf_token() }}"><br><br>
     	<input type="submit" value="Add Item" style="position:relative"></input>
     	<br>
        @if (session()->has('message'))
        	{{ session('message') }}
        @else
       		<p style="text-align:center; color:green">Add a new item</p>
       	@endif
       	</div>
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
		</div>
		<form method="POST" id="deleteitem">
			{{ method_field('DELETE') }}
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
		</form>

@stop
@extends('layout')

@section('header')
<script src="/js/alert.js-0.0.0/dist/alert.min.js"></script>
<link rel="stylesheet" href="/js/alert.js-0.0.0/dist/alert.core.min.css" />
<link rel="stylesheet" href="/js/alert.js-0.0.0/dist/alert.default.min.css" />
<link rel="stylesheet" href="/css/tablestyle.css">
<link rel="stylesheet" href="/css/style.css">

<script>
function addCart(){
	alertjs.show({
	title: 'Create Cart',
	text: '#myCustomDialog', //must be an id
	from: 'top',
});
}

function deleteCart(url){
    document.getElementById('deletecart').action = url;
    document.getElementById('deletecart').submit();
}
</script>
@stop

@section('title')
Shopping trends
@stop

@section('content')
        <h1 align="center" style="color:#595959; font-weight:bold">SHOPPING TRENDS</h1>
        <h2 align="center"> <a href="/view/trends">Generate trends</a></h2>
        <br>
        <div align="center">
            <div>
            <table align = "center">
            <tr>
            <th>Shopping Lists</th>
            <th>Items Bought</th><th></th>
            </tr>
                @foreach ($carts as $cart)
                <tr>
                <td>
                <a href="/carts/{{ $cart->idcart }}"> {{ $cart->cartname }} </a></td>
                <td style="text-align:center">
                    @if ($cart->total == 0)
                        None
                    @else
                        {{ $cart->bought }}/{{ $cart->total }}
                    @endif
                </td>
                <td><a href="javascript:deleteCart('/carts/{{ $cart->idcart }}/delete')">
                    <img src="/delete.png" height="20" width="20"></a></td>
                </tr>
                @endforeach
            </table>
            </div>
            <br>
            <div>
            <h2 style="color:#595959; font-weight:bold">Create new List
            </h2></div>
            <div>
            <button type="button" onclick="addCart()">+</button>
            </div><br>
            <div style="color:red">@if (session()->has('cartExists'))
            {{ session('cartExists') }}
            @endif</div>
        </div>
        <div id="myCustomDialog" style="display: none">
			<div class="dialogWrapper">
				<form method="POST" action="/carts/add">
					<input type="text" name="cartname" align="center"></input>
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<input type="submit" value="Create Cart"></input>
				</form>
			</div>
		</div>

        <form method="POST" id="deletecart">
            {{ method_field('DELETE') }}
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
        </form>

@stop

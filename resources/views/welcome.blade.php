@extends('layout')

@section('header')
<script src="/js/alert.js-0.0.0/dist/alert.min.js"></script>
<link rel="stylesheet" href="/js/alert.js-0.0.0/dist/alert.core.min.css" />
<link rel="stylesheet" href="/js/alert.js-0.0.0/dist/alert.default.min.css" />

<script>
function addCart(){
	alertjs.show({
	title: 'Create Cart',
	text: '#myCustomDialog', //must be an id
	from: 'top',
});
}
</script>
@stop

@section('title')
Shopping trends
@stop

@section('content')
        <h1 align="center">Shopping Trends</h1>
        <h2 align="center"> <a href="/view/trends">Generate trends</a></h2>
        <a href="javascript:addCart()">Create new List</a>
        <br>
        <div>
            <div>
                @foreach ($carts as $cart)
                <li><a href="/carts/{{ $cart->idcart }}"> {{ $cart->cartname }} </a></li>
                @endforeach
            </div>
        </div>
        @if (session()->has('cartExists'))
        {{ session('cartExists') }}
        @endif
        <div id="myCustomDialog" style="display: none">
			<div class="dialogWrapper">
				<form method="POST" action="/carts/add">
					<input type="text" name="cartname" align="center"></input>
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<input type="submit" value="Create Cart"></input>
				</form>
			</div>
		</div>

@stop

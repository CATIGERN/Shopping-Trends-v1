@extends('layout')

@section('title')
Cart
@stop

@section('content')
		@foreach ($items as $item)
		<li>{{ $item->itemname }} </li>
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
@stop
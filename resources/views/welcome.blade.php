@extends('layout')

@section('title')
Shopping trends
@stop

@section('content')
        <h1 align="center">Shopping Trends</h1>
        <a href="#">Create new List</a>
        <br>
        <div>
            <div>
                @foreach ($carts as $cart)
                <li><a href="/carts/{{ $cart->idcart }}"> {{ $cart->cartname }} </a></li>
                @endforeach
            </div>
        </div>

@stop

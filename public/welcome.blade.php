@extends('layout')

@section('title')
Shopping trends
@stop

@section('content')
        <h1 align="center">Shopping Trends</h1>
        <a href="#">Create new List</a>
        <br>
        <div>
            <div ng-controller = "CartController">
                <li ng-repeat = "cart in carts"> <a href="#"> @{{ cart.cartname }} </a></li>
            </div>
            
        </div>

@stop

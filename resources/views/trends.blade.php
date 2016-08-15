@extends('layout')

@section('header')
<link rel="stylesheet" href="/css/style.css">
@stop

@section('content')
	<div id="vishal">
		@columnchart('Trends', 'vishal')
	</div>
@stop
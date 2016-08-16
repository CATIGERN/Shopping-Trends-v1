@extends('layout')

@section('header')
<link rel="stylesheet" href="/css/style.css">
@stop

@section('content')
	<div style="margin:0 35%; width:50%; display:inline-block; text-align:center">
	<a href="/" style="float:left; margin:0 1.5%; width:50%; position:relative ">
	<img src="/home.png" width="30" height="30"></a>
	<h1 style="color:#595959; font-weight:bold; float:left; margin:0 1.5%; width:50%;position:relative">
	SHOPPING TRENDS</h1>
	</div><br><br>
	<h2 align="center" style="color:#3333ff">Analysis by Storewise Spending</h2>
	<div id="graph">
		@columnchart('Trends', 'graph')
	</div>
@stop
<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'CartController@welcome');


Route::get('/test', function(){
	return view('test');
});

Route::get('/carts', 'CartController@showCarts');

Route::get('/users', 'SimpleController@showUser');

Route::get('/carts/view/{cartid}', 'CartController@showCartItems');

Route::get('/carts/{cartid}', 'CartController@show');

Route::post('/carts/{cartid}/add', 'CartController@addItemToCart');

Route::get('/items/{cartid}/{itemid}', 'CartController@checkItemInCart');

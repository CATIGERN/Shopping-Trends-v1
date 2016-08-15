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

Route::get('/carts', 'CartController@showCarts');

Route::get('/users', 'SimpleController@showUser');

Route::get('/carts/view/{cartid}', 'CartController@showCartItems');

Route::get('/carts/{cartid}', 'CartController@show');

Route::post('/carts/{cartid}/add', 'CartController@addItemToCart');

Route::post('/carts/add', 'CartController@addCart');

Route::post('/carts/{cartid}/mark/{itemid}', 'CartController@markItem');

Route::post('/carts/{cartid}/edit/{itemid}', 'CartController@markItem');

Route::get('/carts/{cartid}/get/{itemid}', 'CartController@getItem');

Route::delete('/carts/{cartid}/delete/{itemid}', 'CartController@deleteItem');

Route::get('/view/trends', 'CartController@trends');

Route::delete('/carts/{cartid}/delete', 'CartController@deleteCart');


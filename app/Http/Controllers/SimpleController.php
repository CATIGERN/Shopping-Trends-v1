<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Controllers\CartController;
use App\Http\Requests;

class SimpleController extends Controller
{

    public function showUser(){
    	$users = User::all();
    	return $users;
    }

}

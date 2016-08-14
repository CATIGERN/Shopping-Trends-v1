<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use App\Cart;
use App\Item;
use App\CartItem;
use Log;
use Redirect;
use Exception;
use DB;
use App\Http\Requests;

class CartController extends Controller
{
    public function showCarts(){
    	$carts = Cart::all();
    	return $carts;
    }

    public function showCartItems($cartid){
    	$items = CartItem::select('cartname', 'itemname')
    				->join('carts', 'carts.idcart', '=', 'cartitems.idcart')
    				->join('items', 'items.iditem', '=', 'cartitems.iditem')
    				->where('cartitems.idcart', $cartid)
    				->orderBy('itemaddedat')
    				->get();
    	return $items;
    }

    public function show($cartid){
        try{
            if(!CartController::checkCartExists($cartid)){
                throw new Exception;
            }
        	$items = CartController::showCartItems($cartid);
        }
        catch(Exception $e){
            App::abort('404', 'Cart not found');
        }
        return view('cart', compact('items', 'cartid'));
    }

    public function welcome(){
        $carts = CartController::showCarts();
        return view('welcome', compact('carts'));
    }

    public function checkItem($itemname){
        $itemid = Item::select('iditem')->where('itemname', $itemname)
                        ->get();
        if($itemid->isEmpty()){
            return -1;
        }
        return $itemid->pluck('iditem')->first();
    }

    public function addItem($itemname){
        $item = new Item;
        $item->itemname = $itemname;
        $item->save();
        return $item->iditem;
    }

    public function checkItemInCart($cartid, $itemid){
        $count = CartItem::where('idcart', $cartid)
                            ->where('iditem', $itemid)
                            ->count();
        if($count != 0){
            return true;
        }
        return false;
    }

    public function checkCartExists($cartid){
        $count = Cart::where('idcart', $cartid)->count();
        if($count == 1){
            return true;
        }
        return false;
    }

    public function addItemToCart(Request $request, $cartid){
        $message = 'Item successfully added';
        DB::beginTransaction();
        try{
            $iditem = CartController::checkItem($request->itemname);
            if($iditem == -1){
                $iditem = CartController::addItem($request->itemname);
            }
            if(!CartController::checkCartExists($cartid)){
                throw new Exception;
            }
            if(CartController::checkItemInCart($cartid, $iditem)){
                $message = 'Item already in cart';
                throw new Exception;
            }
            $cartItem = new CartItem;
            $cartItem->idcart = $cartid;
            $cartItem->iditem = $iditem;
            $cartItem->save();
            DB::commit();
        }
        catch(Exception $e){
            DB::rollback();
        }
        return redirect()->back()->with('message', $message);
    }
}

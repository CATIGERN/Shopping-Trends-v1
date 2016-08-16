<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use App\Cart;
use App\Item;
use App\CartItem;
use App\Store;
use Khill\LavaCharts\LavaCharts;
use Redirect;
use Exception;
use DB;
use App\Http\Requests;

class CartController extends Controller
{
    public function welcome(){
        session(['userid' => 1]);
        $carts = CartController::itemsBought();
        return view('welcome', compact('carts'));
    }

    public function showCarts(){
    	$carts = Cart::where('userid', session()->get('userid'))
                        ->get();
    	return $carts;
    }

    public function itemsBought(){
        $items = DB::table('carts')
                    ->select('carts.idcart', 'carts.cartname',
                        DB::raw('sum(case when cartitems.itembought = 1 then 1 else 0 end) as bought'),
                        DB::raw('count(cartitems.itembought) as total'))
                    ->leftJoin('cartitems', 'carts.idcart', '=' ,'cartitems.idcart')
                    ->where('carts.userid', session()->get('userid'))
                    ->groupBy('carts.idcart')
                    ->get();
        return $items;
        /*
        select A.idcart, A.cartname, bought, total from
        (select shoppingtrends.cartitems.idcart, cartname, count(itembought) as total
        from shoppingtrends.cartitems
        inner join shoppingtrends.carts
        on shoppingtrends.cartitems.idcart = shoppingtrends.carts.idcart
        where shoppingtrends.carts.userid = 1
        group by shoppingtrends.cartitems.idcart) as A
        inner join
        (select shoppingtrends.cartitems.idcart, cartname, count(itembought) as bought from shoppingtrends.cartitems
        inner join shoppingtrends.carts
        on shoppingtrends.cartitems.idcart = shoppingtrends.carts.idcart
        where shoppingtrends.carts.userid = 1 and itembought = 1
        group by shoppingtrends.cartitems.idcart) as B
        on A.idcart = B.idcart
        */
    }

    public function showCartItems($cartid){
    	$items = CartItem::select('cartitems.iditem', 'itemname', 'itembought', 'storename', 'price')
    				->join('carts', 'carts.idcart', '=', 'cartitems.idcart')
    				->join('items', 'items.iditem', '=', 'cartitems.iditem')
                    ->leftJoin('stores', 'cartitems.idstore', '=', 'stores.idstore')
    				->where('cartitems.idcart', $cartid)
    				->orderBy('itembought')
                    ->orderBy('itemaddedat')
    				->get();
    	return $items;
    }

    public function cartName($cartid){
        $cartname = Cart::where('idcart', $cartid)
                        ->pluck('cartname')->first();
        return $cartname;
    }

    public function show($cartid){
        try{
            if(!CartController::checkCartExists($cartid)){
                throw new Exception;
            }
        	$items = CartController::showCartItems($cartid);
            $cartname = CartController::cartName($cartid);
        }
        catch(Exception $e){
            App::abort('404', 'Cart not found');
        }
        return view('cart', compact('items', 'cartid', 'cartname'));
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

    public function checkCartName($cartname){
        $count = Cart::where('cartname', $cartname)->count();
        return $count;
    }

    public function addCart(Request $request){
        $count = CartController::checkCartName($request->cartname);
        if($count == 1){
            return redirect()->back()->with('cartExists', 'Cart already exists');
        }
        $cart = new Cart;
        $cart->cartname = $request->cartname;
        $cart->userid = $request->session()->get('userid');
        $cart->save();
        return back();
    }

    public function checkStore($storename){
        $storeid = Store::select('idstore')->where('storename', $storename)
                        ->get();
        if($storeid->isEmpty()){
            return -1;
        }
        return $storeid->pluck('idstore')->first();
    }

    public function addStore($storename){
        $store = new Store;
        $store->storename = $storename;
        $store->iduser = session()->get('userid');
        $store->save();
        return $store->idstore;
    }


    public function markItem(Request $request, $cartid, $itemid){
        DB::beginTransaction();
        try{
            if(!CartController::checkItemInCart($cartid, $itemid)){
                throw new Exception;
            }
            $storeid = CartController::checkStore($request->storename);
            if($storeid == -1){
                $storeid = CartController::addStore($request->storename);
            }
            $cartitem = CartItem::where('idcart', $cartid)
                                    ->where('iditem', $itemid)
                                    ->update(['idstore' => $storeid,
                                        'price' => $request->price,
                                        'quantity' => $request->quantity,
                                        'itembought' => true]);
            DB::commit();
        }
        catch(Exception $e){
            echo $e;
            DB::rollback();
        }
        return back();
    }

    public function getItem($cartid, $itemid){
        if(!CartController::checkItemInCart($cartid, $itemid)){
            return null;
        }
        $cartitem = CartItem::select('storename', 'price', 'quantity')
                    ->join('stores', 'stores.idstore', '=', 'cartitems.idstore')
                    ->where('cartitems.idcart', $cartid)
                    ->where('cartitems.iditem', $itemid)
                    ->get();
        return $cartitem;
    }

    public function items(){
        $items = Item::all();
        return $items;
    }


    public function deleteItem($cartid, $itemid){
        DB::beginTransaction();
        try{
            $deletes = CartItem::where('idcart', $cartid)
                                ->where('iditem', $itemid)
                                ->delete();
            DB::commit();
        }
        catch(Exception $e){
            DB::rollback();
        }
        return back();
    }

    public function deleteCart($cartid){
        DB::beginTransaction();
        try{
            $deletes = Cart::where('idcart', $cartid)
                            ->delete();
            DB::commit();
        }
        catch(Exception $e){
            DB::rollback();
        }
        return back();
    }

    public function trends(){
        $trends = \Lava::DataTable();

        $trends->addStringColumn('Store')
                ->addNumberColumn('Money Spent');

        $result = CartItem::select('storename', DB::raw('sum(price) as total'))
                            ->join('stores', 'stores.idstore', '=', 'cartitems.idstore')
                            ->where('itembought', 1)
                            ->whereIn('idcart', function($query){
                                $query->select('idcart')
                                        ->from('carts')
                                        ->where('userid', session()->get('userid'))
                                        ->get();
                            })
                            ->groupBy('storename')
                            ->get();
        foreach($result as $data){
            $trends->addRow([$data->storename, $data->total]);
        }

        \Lava::ColumnChart('Trends', $trends, [
            'title' => 'Shopping Trends',
            'titleTextStyle' => [
                'color'    => '#eb6b2c',
                'fontSize' => 14
            ]
        ]);

        return view('trends');
    }

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PortalController extends Controller
{
    public function index()
    {
        $products = DB::table('products')
                            ->leftJoin('store_inventories', 'store_inventories.productID', '=', 'products.productID' )
                            ->select('products.productID', 'products.name as product_name' ,    'products.cost_price', 'products.price', 
                                         DB::raw('SUM(products.cost_price * store_inventories.quantity) as stock_value'))
                            ->groupBy('products.productID', 'products.name' , 'products.sku', 'products.cost_price', 'products.price',)
                            ->get();

        $totalStockValue = $products->sum('stock_value');

        $customers = DB::table('users')->where('customer', true)->count();

        $total_orders = DB::table('orders')
                      ->where('orders.paid', true)  
                      ->count();

        $user = Auth::user();
        if ( $user->store ) {
            $orders = DB::table('orders')
                    ->leftJoin('users', 'users.id', '=', 'orders.userID' )
                    ->leftJoin('shipping_addresses', 'shipping_addresses.orderID', '=', 'orders.orderID' )
                    ->select('orders.*', 'shipping_addresses.*', 'users.store as user_store', 'users.first_name', 'users.last_name')
                    ->where('orders.status', 'pending')    // Just for testing
                    ->where('orders.paid', true)  
                    ->where('orders.store', '=', $user->store)
                    ->get();
        } else {            
            $orders = DB::table('orders')
                    ->leftJoin('users', 'users.id', '=', 'orders.userID' )
                    ->leftJoin('shipping_addresses', 'shipping_addresses.orderID', '=', 'orders.orderID' )
                    ->select('orders.*', 'shipping_addresses.*', 'users.store as user_store', 'users.first_name', 'users.last_name')
                    ->where('orders.status', 'pending')    // Just for testing
                    ->where('orders.paid', true)  
                    ->get();
        }         
 
        $new_orders =  $orders->count();

        return view('dashboard')
             ->with("total_stock_value", $totalStockValue)
             ->with("customers", $customers)
             ->with("total_orders", $total_orders)
             ->with("orders", $orders)
             ->with("new_orders", $new_orders);

    }
 
 
}

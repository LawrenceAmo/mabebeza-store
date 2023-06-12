<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PortalController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = DB::table('products')
                            ->leftJoin('store_inventories', 'store_inventories.productID', '=', 'products.productID' )
                            ->select('products.productID', 'products.name as product_name' ,    'products.cost_price', 'products.price', 
                                         DB::raw('SUM(products.cost_price * store_inventories.quantity) as stock_value'))
                            ->groupBy('products.productID', 'products.name' , 'products.sku', 'products.cost_price', 'products.price',)
                            ->get();
        $totalStockValue = $products->sum('stock_value');

                            // return $totalStockValue;
        $customers = DB::table('customers')->count();
        $orders = DB::table('orders')->get();
        $new_orders =  $orders->where([['paid', true],['status', "proccessing"]])->count();
 
        return view('dashboard')
             ->with("total_stock_value", $totalStockValue)
             ->with("customers", $customers)
             ->with("total_orders", $orders->count())
             ->with("new_orders", $new_orders)
             ->with("num", 23234);

    }
 
 
}

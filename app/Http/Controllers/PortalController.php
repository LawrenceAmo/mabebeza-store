<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PortalController extends Controller
{
    public function get_products()
    {
        $products = DB::table('products')
                    // ->leftJoin('store_inventories', 'store_inventories.productID', '=', 'products.productID' )
                    ->leftJoin('product_photos', 'product_photos.productID', '=', 'products.productID' )
                    ->select('products.productID', 'products.name as product_name' , 'products.publish', 'products.availability', 'products.sku', 'products.cost_price', 'products.price', 'products.sale_price', 'product_photos.url', 'product_photos.title', )
                    ->where( 'products.availability', '=',  true)
                    ->where( 'products.publish', '=', true)
                    ->where( 'products.publish', '=', true)
                    ->where( 'product_photos.thumbnail', '=', true)
                    ->groupBy('products.productID', 'products.name' , 'products.publish','product_photos.url', 'product_photos.title', 'products.availability', 'products.sku', 'products.cost_price','products.sale_price', 'products.price',)
                    ->get();
        return $products;
        return response()->json($products);
    }
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

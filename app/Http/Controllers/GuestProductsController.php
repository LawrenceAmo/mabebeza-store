<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
// use header
use Illuminate\Support\Facades\Cache;


use Illuminate\Http\Request;

class GuestProductsController extends Controller
{
    public function get_products()
    {
        $cacheKey = 'api-guest_get_products';

        // Check if the cached response exists
        if (Cache::has($cacheKey)) {
            // If the cached response exists, return it
            return Cache::get($cacheKey);
        }

        // sub_categories.sub_category_name
        $products = DB::table('products')
                    ->leftJoin('sub_categories', 'sub_categories.sub_categoryID', '=', 'products.sub_categoryID' )
                    ->leftJoin('product_photos', 'product_photos.productID', '=', 'products.productID' )
                    ->select('products.productID', 'products.name as product_name' , 'products.publish', 'products.availability', 'products.sku', 'products.cost_price', 'products.price', 'sub_categories.sub_category_name', 'products.sale_price', 'product_photos.url', 'product_photos.title', )
                    ->where( 'products.availability', '=',  true)
                    ->where( 'products.publish', '=', true)
                    ->where( 'products.publish', '=', true)
                    ->where( 'product_photos.thumbnail', '=', true)
                    ->groupBy('products.productID', 'products.name' , 'products.publish','product_photos.url', 'product_photos.title', 'products.availability', 'products.sku', 'products.cost_price','products.sale_price', 'sub_categories.sub_category_name', 'products.price',)
                    ->get();
        // return $products;
        // Cache the response for 5 minutes
        Cache::put($cacheKey, $products, 300);

        // return $responseData;
        return response()->json($products);
    }

    public function welcome()
    {
        if (Cache::has('guest-welcome')) {
            // If the cached view exists, return it
            return Cache::get('guest-welcome');
        }

        $categories = DB::table('categories')->get();

        $view = view('welcome')->with("categories", $categories)->render();

        return $view;
        Cache::put('guest-welcome', $view, 3600);

        // ->header('Cache-Control', 'max-age=3600');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($category = null, $name )
    {
        // get the productID (last number of the string {array})
        $name = explode('-', $name);
        $productID = (int)end($name);

        $products = DB::table('products')
                    ->leftJoin('product_photos', 'product_photos.productID', '=', 'products.productID')
                    ->leftJoin('sub_categories', 'sub_categories.sub_categoryID', '=', 'products.sub_categoryID')
                    ->select('products.productID', 'products.name as product_name' , 'products.description', 'products.product_detail', 'products.sku', 'products.cost_price', 'products.price', 'sub_categories.sub_category_name', 'products.sale_price', 'product_photos.url', 'product_photos.title', )
                    ->where('products.productID', '=', $productID)
                    ->orWhere('products.name', 'LIKE', '%' . $name[0] . '%')
                    ->groupBy('products.productID', 'products.name', 'products.description', 'products.product_detail', 'products.sku', 'products.cost_price', 'products.sale_price', 'sub_categories.sub_category_name', 'products.price','product_photos.url', 'product_photos.title',)
                    ->limit(4) // Limit the number of records to 4
                    ->get();
                    // description

                    $firstProductID =  $products[0]->productID;
                    $manyProducts = false;

             for ($i=0; $i < count($products); $i++) { 
                if ($products[$i]->productID !== $firstProductID) {
                    $manyProducts = false; // Different productIDs found, return 0
                    break;
                }
                if($i > 3){
                    $manyProducts = true;
                    break;
                } 
            }  
  
        // redirect to search page for product
        if($manyProducts){
            return 1; 
        } 

        return  view('pages.products.view')->with('product', $products);  //return normal page
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function category($categoryID, $category)
    {
        // $category_name =  explode(' ',  $category);//str_replace('-', ' ', $category );

        $categories = DB::table('categories')
                        ->leftjoin('sub_categories', 'sub_categories.categoryID', '=', 'categories.categoryID')
                        ->where('categories.categoryID', '=', $categoryID)
                        ->pluck('sub_categories.sub_categoryID' )                        
                        ->toArray();
 
        $products =  DB::table('products')
                        ->leftJoin('sub_categories', 'sub_categories.sub_categoryID', '=', 'products.sub_categoryID')
                        ->leftJoin('product_photos', function ($join) {
                            $join->on('product_photos.productID', '=', 'products.productID')
                                ->whereRaw('product_photos.product_photoID = (SELECT MIN(product_photoID) FROM product_photos WHERE productID = products.productID)');
                        })
                        ->select('products.productID', 'products.name as product_name', 'products.description', 'products.product_detail', 'products.sku', 'products.cost_price', 'products.price', 'products.sale_price', 'product_photos.url', 'product_photos.title', 'sub_categories.sub_category_name')
                        ->whereIn('products.sub_categoryID', $categories)
                        ->groupBy('products.productID', 'products.name', 'products.description', 'products.product_detail', 'products.sku', 'products.cost_price', 'products.sale_price', 'products.price', 'product_photos.url', 'product_photos.title', 'sub_categories.sub_category_name')
                        ->get();

                    // return $products; 
        return view('pages.products.category')->with('products', $products);
     }

    

    /**
     * API
     */
    public function get_sub_categories()
    {
        $cacheKey = 'api-guest_get_sub_categories';

        // Check if the cached response exists
        if (Cache::has($cacheKey)) {
            // If the cached response exists, return it
            return Cache::get($cacheKey);
        }

        // If the cached response doesn't exist, retrieve the data from the API
        $sub_categories = DB::table('sub_categories')->get();// Fetch data from your API

        // Cache the response for 5 minutes
        Cache::put($cacheKey, $sub_categories, 300);

         return $sub_categories;
    }

    
    public function my_cart()
    {
        return view('pages.products.cart');
    }
  
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

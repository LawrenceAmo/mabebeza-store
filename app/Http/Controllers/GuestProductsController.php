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
            // return Cache::get($cacheKey);
        }

        $products = DB::table('products')
                    ->leftJoin('store_inventories', 'store_inventories.productID', '=', 'products.productID' )
                    ->leftJoin('stores', 'stores.storeID', '=', 'store_inventories.storeID' )
                    ->leftJoin('sub_categories', 'sub_categories.sub_categoryID', '=', 'products.sub_categoryID' )
                    ->leftJoin('product_photos', 'product_photos.productID', '=', 'products.productID' )
                    ->select('products.productID', 'products.name as product_name' , 'products.publish', 'products.availability', 'products.sku', 'products.cost_price', 'products.price', 'sub_categories.sub_category_name', 'products.sale_price', 'product_photos.url', 'product_photos.title', 'products.type', 'store_inventories.quantity' , 'stores.name as store_name' )
                    ->where( 'products.availability', '=',  true)
                    ->where( 'products.publish', '=', true)
                    // ->where( 'products.price', 'LIKE', '%ega%')
                    // ->orWhere( 'stores.name', 'LIKE', '%embisa%')
                    ->groupBy('products.productID', 'products.name' , 'products.publish','product_photos.url', 'product_photos.title', 'products.availability', 'products.sku', 'products.cost_price','products.sale_price', 'sub_categories.sub_category_name', 'products.price', 'products.type', 'store_inventories.quantity', 'stores.name')
                    ->get();
        // return $products;
        // Cache the response for 5 minutes
        // Cache::put($cacheKey, $products, 300);

        // return $products;
        return response()->json($products);
    }

    public function welcome()
    {
        if (Cache::has('guest-welcome')) {
            // If the cached view exists, return it
            return Cache::get('guest-welcome');
        }

        $categories = DB::table('categories')->where('category_descript', '!=', null)->get();

        $view = view('welcome')->with("categories", $categories)->render();

        // return $this->get_products();  //$view;/
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

        // return $productID;

        $products = DB::table('products')
                    ->leftJoin('store_inventories', 'store_inventories.productID', '=', 'products.productID' )
                    ->leftJoin('stores', 'stores.storeID', '=', 'store_inventories.storeID' )
                    ->leftJoin('product_photos', 'product_photos.productID', '=', 'products.productID')
                    ->leftJoin('sub_categories', 'sub_categories.sub_categoryID', '=', 'products.sub_categoryID')
                    ->select('products.productID', 'products.name as product_name' , 'products.description', 'products.product_detail', 'products.sku', 'products.cost_price', 'products.price', 'sub_categories.sub_category_name', 'products.sale_price', 'product_photos.url', 'product_photos.title',  'store_inventories.quantity' , 'stores.name as store_name'  )
                    ->where('products.productID', '=', (int)$productID)
                    // ->orWhere('products.name', 'LIKE', '%' . $name[0] . '%')                    
                    // ->where( 'stores.name', 'LIKE', '%ega%')
                    // ->orWhere( 'stores.name', 'LIKE', '%embisa%')
                    ->groupBy('products.productID', 'products.name', 'products.description', 'products.product_detail', 'products.sku', 'products.cost_price', 'products.sale_price', 'sub_categories.sub_category_name', 'products.price','product_photos.url', 'product_photos.title',  'store_inventories.quantity' , 'stores.name' )
                    ->limit(1) // Limit the number of records to 4
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

     public function view_sub_category($sub_category_name)
     {
         $sub_category_name = str_replace('-', ' ', $sub_category_name ); 
         $categories = DB::table('sub_categories')
                          ->where('sub_category_name', '=', $sub_category_name)
                         ->pluck('sub_categoryID' )                        
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
  
        return view('pages.products.sub_category')->with('products', $products);
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
        $sub_categories = DB::table('sub_categories')
                            ->whereNotIn('sub_category_name', ['other', 'Other'])
                            ->get();// Fetch data from your API
        // Cache the response for 5 minutes
        Cache::put($cacheKey, $sub_categories, 300);
         return $sub_categories;
    }

    public function guest_search_product(String $name)
    {
        $keywords = explode('-', strtolower($name)); 

        $products = DB::table('products')
            ->leftJoin('store_inventories', 'store_inventories.productID', '=', 'products.productID')
            ->leftJoin('sub_categories', 'sub_categories.sub_categoryID', '=', 'products.sub_categoryID')
            ->leftJoin('product_photos', function ($join) {
                $join->on('product_photos.productID', '=', 'products.productID')
                    ->whereRaw('product_photos.product_photoID = (SELECT MIN(product_photoID) FROM product_photos WHERE productID = products.productID)');
            })
            ->select('products.productID', 'products.name as product_name', 'products.publish', 'products.availability', 'products.sku', 'products.cost_price', 'products.price', 'products.sale_price', 'product_photos.url', 'product_photos.title', 'products.type', 'store_inventories.quantity', 'sub_categories.sub_category_name')
            ->where(function ($query) use ($keywords) {
                foreach ($keywords as $keyword) {
                    $query->whereRaw('LOWER(name) like ?', ['%' . strtolower($keyword) . '%']);
                }
            })
            ->where('products.availability', '=', true)
            ->where('products.publish', '=', true)
            ->groupBy('products.productID', 'products.name', 'products.publish', 'product_photos.url', 'product_photos.title', 'products.availability', 'products.sku', 'products.cost_price', 'products.sale_price', 'products.price', 'products.type', 'store_inventories.quantity', 'sub_categories.sub_category_name')
            ->get();
 
        // return $products;
        return view('pages.products.product_search')->with('products', $products);
    }
    
    public function my_cart()
    {
        return view('pages.products.cart');
    }

    public function my_wish_list()
    {
        return view('pages.products.wish_list');
    }
    public function where_we_deliver()
    {
        return view('pages.deliveries.where_we_deliver');
    }
    public function gift_registry()
    {
        return view('pages.gift.index');
    }
   

    // 
}

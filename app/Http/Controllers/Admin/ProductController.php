<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $userID = Auth::id();
        $store = DB::table('stores')->where('userID', $userID)->get('storeID');
        $suppliers = DB::table('suppliers')->get();
        $products = DB::table('products')->get();
        $sub_categories = DB::table('sub_categories')->get();
         // $test = 1;//DB::table('test')->where('id', '>', 11000)->limit(100)->get();
        // return $products;
        // $products = DB::table('products')->where('storeID',$store[0]->storeID)->get();
       
  
       return view('portal.products.index')
                ->with('num',111)
                ->with('products',$products)
                ->with('suppliers',$suppliers)
                ->with('sub_categories',$sub_categories); //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $request->validate([
            'product_name' => 'required|string',
            'sub_category' => 'required',
            'supplier' => 'required',                     
         ]); 
  
        $product = new Product();
        $product->name = $request->product_name;
        $product->price = 0;
        $product->sub_categoryID = (int)$request->sub_category;
        $product->supplierID = (int)$request->supplier;
        $product->id = Auth::id();
        $product->save();
 
        $lastInsertedProduct = Product::latest()->first();
  
         return redirect()->to(route('product_update_info', [$lastInsertedProduct->productID]));
     }

     
    public function save(Request $request)
    {
        return $request;
    }
 
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function product_update_info(int $id)
    {  
        $product = DB::table('products')
                    // ->leftJoin('suppliers', 'suppliers.supplierID', '=', 'products.supplierID' )
                    // ->leftJoin('sub_categories', 'sub_categories.sub_categoryID', '=', 'products.sub_categoryID' )
                    // ->leftJoin('store_inventories', 'store_inventories.productID', '=', 'products.supplierID' )
                    // ->leftJoin('product_colors', 'product_colors.productID', '=', 'products.supplierID' )
                    // ->leftJoin('product_photos', 'product_photos.productID', '=', 'products.supplierID' )
                    ->where('products.productID', '=', (int)$id)
                    ->select(['products.name as product_name','products.productID as product_productID', 'products.*',  ])
                    ->get();

        // return $product[0];
         return view('portal.products.update_info')
                ->with('product', $product[0]);
     }

    public function product_save_info(Request $request)
    {
        $request->validate([
            'code' => 'required',
            'name' => 'required|string',
            // 'meta_title' => 'required|string',
            // 'slug' => 'required',
            // 'description' => 'required',                     
            // 'product_detail' => 'required',                     
         ]);
        //  return $request;

         DB::table('products')
                ->where('productID', (int)$request->productID)  // find your user by their email
                ->limit(1)  // optional - to ensure only one record is updated.
                ->update([
                    'name' => $request->name,
                    'sku' => $request->code,
                    'meta_title' => (string)$request->meta_title,
                    'slug' => (string)$request->slug,                       
                    'description' => (string)$request->description,                       
                    'product_detail' => (string)$request->product_detail,                       
                 ]);

         return redirect()->to(route('product_update_price', [(int)$request->productID]));
    }

    public function product_update_price(Request $request, int $id)
    {
        $product = DB::table('products') 
                    ->where('products.productID', '=', (int)$id)
                    ->select(['products.name as product_name','products.productID as product_productID','products.*' ])
                    ->get();
 
        return view('portal.products.update_price')
                ->with('product', $product[0]);
    }

    
    public function product_save_price(Request $request )
    {
        // return $request;
        $request->validate([
            'cost_price' => 'required',
            'price' => 'required',                       
         ]);
         
         $vat = (bool)$request->vat;
     
         DB::table('products')
                ->where('productID', (int)$request->productID)  // find your user by their email
                ->limit(1)  // optional - to ensure only one record is updated.
                ->update([
                    'cost_price' => $request->cost_price,
                    'price' => $request->price,
                    'vat' => $vat,
                    'sale_price' => $request->sale_price,
                    'sale_name' => (string)$request->sale_name,                       
                    'description' => (string)$request->description,                       
                    'product_detail' => (string)$request->product_detail,                       
                 ]);
        return redirect()->to(route('product_update_vendor', [(int)$request->productID]));
    }

    public function product_update_vendor(Request $request, int $id)
    {
        $product = DB::table('products') 
                    ->leftJoin('suppliers', 'suppliers.supplierID', '=', 'products.supplierID' )
                    ->leftJoin('sub_categories', 'sub_categories.sub_categoryID', '=', 'products.sub_categoryID' )
                    ->leftJoin('store_inventories', 'store_inventories.productID', '=', 'products.supplierID' )
                    ->where('products.productID', '=', (int)$id)
                    ->select(['products.name as product_name','products.productID as product_productID','products.*' ])
                    ->get();

         $suppliers = DB::table('suppliers')->get();
        $sub_categories = DB::table('sub_categories')->get();

        // return $product;

        return view('portal.products.update_vendor')
                ->with('suppliers', $suppliers)
                ->with('sub_categories', $sub_categories)
                ->with('product', $product[0]);
    }

    public function product_save_vendor(Request $request)
    {
        // return $request;
        $request->validate([
            'quantity' => 'required',
            // 'price' => 'required',                       
         ]);
          
         DB::table('products')
                ->where('productID', (int)$request->productID)  // find your user by their email
                ->limit(1)  // optional - to ensure only one record is updated.
                ->update([
                    'supplierID' => (int)$request->supplier,
                    'sub_categoryID' => (int)$request->sub_category,
                    'quantity' => $request->quantity,                                
                 ]);

        return redirect()->to(route('product_update_shipping', [(int)$request->productID]));
    }

    public function product_update_shipping(Request $request, int $id)
    {
        $product = DB::table('products') 
                ->where('products.productID', '=', (int)$id)
                ->select(['products.name as product_name','products.productID as product_productID','products.*' ])
                ->get(); 

        // return $product;

        return view('portal.products.update_shipping') 
                ->with('product', $product[0]);
    }

    public function product_save_shipping(Request $request)
    {
        // return $request;
        $request->validate([
            // 'quantity' => 'required',
            // 'price' => 'required',                       
         ]);

         $physical_product = (bool)$request->physical_product;
          
          DB::table('products')
                ->where('productID', (int)$request->productID)  // find your user by their email
                ->limit(1)  // optional - to ensure only one record is updated.
                ->update([
                    'weight' => $request->weight,
                    'length' => $request->length,
                    'width' => $request->width,  
                    'height' => $request->height,                                
                    'shipping_time_period' => $request->shipping_time_period,                                
                    'physical_product' => $physical_product,                                
                 ]);
                //  return $request;
                 
        return redirect()->to(route('product_update_media', [(int)$request->productID]));
    }


    public function product_update_media(Request $request, int $id)
    {
        $product = DB::table('products') 
                    ->leftJoin('product_photos', 'product_photos.productID', '=', 'products.productID' )
                    // ->leftJoin('sub_categories', 'sub_categories.sub_categoryID', '=', 'products.sub_categoryID' )
                    // ->leftJoin('store_inventories', 'store_inventories.productID', '=', 'products.supplierID' )
                    ->where('products.productID', '=', (int)$id)
                    ->select(['products.name as product_name','products.productID as product_productID','products.*' ])
                    ->get();

        return view('portal.products.update_media') 
                ->with('product', $product[0]);
    }

    public function product_save_media(Request $request)
    {
        $request->validate([
            'thumnail_title' => 'required',
            'thumnail' => 'required',                       
            'main_title' => 'required',                       
            'main' => 'required',                       
          ]);

        return $request;
    }

    public function product_update_publish(Request $request, int $id)
    {
        $product = DB::table('products') 
                    ->leftJoin('product_photos', 'product_photos.productID', '=', 'products.productID' )
                    // ->leftJoin('sub_categories', 'sub_categories.sub_categoryID', '=', 'products.sub_categoryID' )
                    // ->leftJoin('store_inventories', 'store_inventories.productID', '=', 'products.supplierID' )
                    ->where('products.productID', '=', (int)$id)
                    ->select(['products.name as product_name','products.productID as product_productID','products.*' ])
                    ->get();

        return $product;
        return view('portal.products.update_media') 
                ->with('product', $product[0]);
    }


    //  product_photoID	url	title	main	thumbnail	productID	
}


<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\product_photos;
use App\Models\supplier;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Store_inventory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
// use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Collection;
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
        $sub_categories = DB::table('sub_categories')->get();
 
        $products = DB::table('products')
                            ->leftJoin('store_inventories', 'store_inventories.productID', '=', 'products.productID' )
                            ->leftJoin('stores', 'stores.storeID', '=', 'store_inventories.storeID' )
                            ->select('products.productID', 'products.name as product_name' , 'stores.name as store_name' , 'products.publish', 'products.availability', 'products.sku', 'products.cost_price', 'products.price',// 'products.publish', 'products.publish', 'products.publish',
                                         DB::raw('SUM(products.cost_price * store_inventories.quantity) as stock_value'))
                            ->groupBy('products.productID', 'products.name' , 'stores.name', 'products.publish', 'products.availability', 'products.sku', 'products.cost_price', 'products.price',)
                            ->get();
 
        // return $products;        
  
       return view('portal.products.index')
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
            'code' => 'required',
            'product_name' => 'required|string',              
         ]); 
 
         $products = DB::table('products')->where('sku', $request->code)->count();
         $suppliers = DB::table('suppliers')->count();
         $sub_categories = DB::table('sub_categories')->count();
         $stores = DB::table('stores')->get();

         if ( $products > 0) {
            return redirect()->back()->with('error', "Item already exists");            
         }
         if ( $suppliers < 1) {
            $supplier = new supplier();
            $supplier->supplier_name = "Other";
            $supplier->company_name = "Other";
            $supplier->save();
         }

         if ($sub_categories < 1) {

            $category = new Category();
            $category->category_name = "Other";
            $category->save();

            $lastInsertedCategory = Category::latest()->first();

            $category = new SubCategory();
            $category->sub_category_name = "Other";
            $category->categoryID = (int)$lastInsertedCategory->categoryID;
            $category->save();

         }

        $default_sub_category = SubCategory::first()->first();

        $default_supplier = supplier::first()->first();

        $product = new Product();
        $product->sku = $request->code;
        $product->name = $request->product_name;
        $product->price = 0;
        $product->cost_price = 0;
        $product->sub_categoryID = $default_sub_category->sub_categoryID;
        $product->supplierID = $default_supplier->supplierID;
        $product->id = Auth::id();
        $product->save();
 
        $lastInsertedProduct = Product::latest()->first();


        for ($i=0; $i < count( $stores); $i++) { 
            $Store_inventory = new Store_inventory();
            $Store_inventory->storeID = $stores[$i]->storeID;        
            $Store_inventory->productID = $lastInsertedProduct->productID;        
            $Store_inventory->save();
        }
        
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
                ->where('productID', (int)$request->productID)   
                ->limit(1)   
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
                ->where('productID', (int)$request->productID)   
                ->limit(1)   
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
            // 'quantity' => 'required',
            // 'price' => 'required',                       
         ]);
          
         DB::table('products')
                ->where('productID', (int)$request->productID)   
                ->limit(1)   
                ->update([
                    'supplierID' => (int)$request->supplier,
                    'sub_categoryID' => (int)$request->sub_category,
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
                ->where('productID', (int)$request->productID)   
                ->limit(1)   
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
                    ->select(['products.name as product_name','products.productID as product_productID','products.*','product_photos.*' ])
                    ->get();

                    // return $product;

        return view('portal.products.update_media') 
                ->with('product', $product);
    }

    public function product_save_media(Request $request)
    {
        $request->validate([
            // 'thumnail_title' => 'required',
            // 'thumnail' => 'required',                       
            // 'main_title' => 'required',                       
            // 'main' => 'required',                       
          ]);
 
          $images = product_photos::where('productID',(int)$request->productID)->get();
  
          try { 
          
            if (!$images->firstWhere('thumbnail', true)) {
                
                $thumnail = $this->upload_product_image( "thumnail", $request->thumnail);

                $product_thumnail = new product_photos();
                $product_thumnail->title = $request->thumnail_title;
                $product_thumnail->url = $thumnail;
                $product_thumnail->thumbnail = true;
                $product_thumnail->main = false;
                $product_thumnail->productID = (int)$request->productID;
                $product_thumnail->save();
            }            
        } catch (\Throwable $th) {
            // throw $th;
        }
 
        try { 
          
            if (!$images->firstWhere('main', true)) {
                
            $main = $this->upload_product_image( "main", $request->main);

            $product_main = new product_photos();
            $product_main->title = $request->main_title;
            $product_main->url = $main;
            $product_main->thumbnail = false;
            $product_main->main = true;
            $product_main->productID = (int)$request->productID;
            $product_main->save();
            }            
        } catch (\Throwable $th) {
            // throw $th;
        }

        try { 

            if (!$images->firstWhere([
                    'thumbnail'=> false,
                    'main'=> false,
                ])) {

                $image = $this->upload_product_image( "image", $request->image);

                $product_image = new product_photos();
                $product_image->title = $request->image_title;
                $product_image->url = $image;
                $product_image->thumbnail = false;
                $product_image->main = false;
                $product_image->productID = (int)$request->productID;
                $product_image->save();
            }            
        } catch (\Throwable $th) {
            // throw $th;
        }
        return redirect()->to(route('product_update_publish', [(int)$request->productID]));
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

        // return $product;
        return view('portal.products.update_publish') 
                ->with('product', $product[0]);
    }


    public function product_save_publish(Request $request)
    {
        // return $request;
        // $request->validate([
        //     // 'quantity' => 'required',
        //     // 'price' => 'required',                       
        //  ]);

        // return $request;

        $sale = (bool)$request->sale;
        $availability = (bool)$request->availability;
        $publish = (bool)$request->publish;
          
          DB::table('products')
                ->where('productID', (int)$request->productID)   
                ->limit(1)   
                ->update([ 
                    'type' => $request->product_type,
                    'sale' => $sale,
                    'availability' => $availability,
                    'publish' => $publish,                                                   
                 ]);
                //  
        
        return redirect()->to(route('product_update_publish', [(int)$request->productID]))->with('success', '');
    }

    public function update_stock(Request $request) {
        
        ini_set('max_execution_time', 300);

        $products = DB::table('products')
                    ->leftJoin('store_inventories', 'store_inventories.productID', '=', 'products.productID' )
                    ->leftJoin('stores', 'stores.storeID', '=', 'store_inventories.storeID' )
                    ->select( 'stores.name as store_name' , 'products.*', 'store_inventories.quantity', 'store_inventories.storeID',	'store_inventories.productID as pID')
                    ->get();
                    
        $stores = DB::table('stores')->get();

        $tembisa = collect($request->tembisa);
        $bambanani = collect($request->bambanani);
        
        // // Get the common products by matching 'sku' from $array1 with 'barcode' from $array2
        $products->each(function ($item) use ($tembisa) {
            $matchingProduct = $tembisa->firstWhere('barcode', (string)$item->sku);
            if ($matchingProduct) {
                if ( strpos(strtolower($item->store_name), 'tembisa') || strpos(strtolower($item->store_name), 'mega') ) {
                    $item->quantity = (int)$matchingProduct['onhand'];
                    $item->cost_price = $matchingProduct['avrgcost'];
                    $item->price = $matchingProduct['sellpinc1'];
                  }
            }
        });

        // return response()->json($products);

    
        // for Bambanani     
        $products->each(function ($item) use ($bambanani) {
            $matchingProduct = $bambanani->firstWhere('barcode', $item->sku);
            if ($matchingProduct) {
                if ( strpos(strtolower($item->store_name), 'bambanani') || strpos( strtolower($item->store_name), 'doc') ) {
                    $item->quantity = (int)$matchingProduct['onhand'];
                    $item->cost_price = $matchingProduct['avrgcost'];
                    $item->price = $matchingProduct['sellpinc1'];
                  }
            }
        });

        for ($i=0; $i < count($products) ; $i++) { 
            
            // DB::table('store_inventories')
            //     ->where('productID', (int)$products[$i]->productID)   
            //     ->where('storeID', (int)$products[$i]->storeID)   
            //     ->limit(1)   
            //     ->update([
            //         'quantity' => $products[$i]->quantity,                                                              
            //     ]);
                

            if ( strpos(strtolower($products[$i]->store_name), 'tembisa') || strpos(strtolower($products[$i]->store_name), 'mega') ) {
                DB::table('products')
                    ->where('productID', (int)$products[$i]->productID)   
                    ->limit(1)   
                    ->update([
                        'cost_price' => $products[$i]->cost_price,                                                            
                        'price' => $products[$i]->price,                                                             
                    ]);

            }  // quantity

            if (!$products[$i]->storeID) {
                for ($x=0; $x <count($stores) ; $x++){
                    $storeName = strtolower($stores[$x]->name);                    
                        if (strpos(strtolower($storeName), 'tembisa')  !== false || strpos(strtolower($storeName), 'mega') !== false) {
                            $products[$i]->storeID = $stores[$x]->storeID;
                        }
                        if (strpos(strtolower($storeName), 'doc') !== false || strpos(strtolower($storeName), 'bambanani') !== false) {
                            $products[$i]->storeID = $stores[$x]->storeID;
                        } 
                }
            } 
            // "SQLSTATE[23000]: Integrity constraint violation: 1048 Column 'storeID' cannot be null (SQL: insert into `store_inventories` (`storeID`, `productID`, `quantity`, `created_at`, `updated_at`)
            //  values (?, 1, 0, 2023-07-22 09:44:41, 2023-07-22 09:44:41))"
                $qty = 0;
                if ($products[$i]->quantity) {
                    $qty = $products[$i]->quantity;
                }

                $data = [
                    'quantity' => $qty,
                    'storeID' => $products[$i]->storeID,
                    'productID' => $products[$i]->productID,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            
                DB::table('store_inventories')->updateOrInsert(['storeID' => (int)$products[$i]->storeID, 'productID' => (int)$products[$i]->productID], $data);
   
        }
 
        //  return  $stores;
        // return response()->json($tembisa);
        return response()->json($products);
    }
    // /////////////////////////////////////////////////////
 
    public function upload_product_image( $prefix, $image = null)
    {
            if(!$image) return false;      ///// check if file is available if nto do nothing

            $filename = $image->getClientOriginalName();
            $ext = substr($filename,-5);
            
            $uniqName = md5($filename)."".uniqid($filename, true);
            $uniqName = "ba".md5($uniqName)."by".$ext;

            $filename = $prefix."-".$uniqName;           
            $image->storeAs('products/',"$filename",'public');

        return $filename;
    }

    //  product_photoID	url	title	main	thumbnail	productID	
}


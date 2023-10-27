<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PromotionItems;
use App\Models\Promotions;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
class PromotionItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $promotion = Promotions::find($id);
        if (!$promotion) {
           return redirect()->back()->with('error','Something went wrong...');
        }
        $items = PromotionItems::leftJoin('products', 'products.productID', '=', 'promotion_items.productID' )
                                ->leftJoin('promotions', 'promotions.promotionID', '=', 'promotion_items.promotionID' )
                                ->where('promotions.promotionID', (int)$id)
                                ->get();
        // return $items;
        return view('portal.promotionItems.index')->with('products', $items)->with('promotionID', $id);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add_items($id)
    {
        $items = DB::table('products')
                            ->leftJoin('promotion_items', 'promotion_items.productID', '=', 'products.productID' )
                            ->whereNull('promotion_items.productID')
                            ->select('products.*')
                            ->get();

        return view('portal.promotionItems.add_items')->with('products', $items)->with('promotionID', $id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function promotions_add_items(Request $request, $id)
    {
        $productIDs =  json_encode($request->data, true);
        $productIDs =  json_decode($productIDs, true);

        $products = Product::whereIn('productID', $productIDs)->get();

        foreach ($products as $item) {
           
            DB::table('promotion_items')
            ->updateOrInsert(
                [
                    'promotionID' => (int)$id,
                    'productID' => $item->productID,
                ],
                [
                    'promotionID' => (int)$id,
                    'productID' => $item->productID,
                    'sale_price' => 0,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
        return response()->json(['message' => 'Success'], 200);
    }

    
    public function promotions_item_delete(Request $request)
    {
        DB::table('promotion_items')
            ->where('productID', (int)$request->productID)
            ->delete();
        return $request;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function promotion_items_sele_prices($id)
    {
        $items = PromotionItems::leftJoin('products', 'products.productID', '=', 'promotion_items.productID' )
                                ->leftJoin('promotions', 'promotions.promotionID', '=', 'promotion_items.promotionID' )
                                ->where('promotions.promotionID', (int)$id)
                                ->get();

        return view('portal.promotionItems.update_sale_prices')->with('promotionID', $id)->with('products', $items);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function promotions_items_sale_price_update(Request $request)
    {
        $products = $request->items;
       for ($i=0; $i < count($products); $i++) { 
       
         DB::table('products')
            ->where('productID', $products[$i]['productID'])
            ->update(['sale_price' => $products[$i]['sale_price']]);

       }
        return $products;
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

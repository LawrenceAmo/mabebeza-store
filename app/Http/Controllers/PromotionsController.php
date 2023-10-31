<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Promotions;
use Illuminate\Support\Facades\DB;
use App\Models\PromotionItems;
use App\Models\Product;
 
class PromotionsController extends Controller
{
 
    public function index()
    {
        $promotions = Promotions::get();
        return view('portal.promotions.index')->with('promotions', $promotions);
    }

 
    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required|string',  
        ]);
        $promotion = new Promotions();
        $promotion->promotion_name = $request->name;
        $promotion->start_date = now()->toDateString();
        $promotion->start_time = now()->toTimeString();
        $promotion->end_date = now()->toDateString();
        $promotion->end_time = now()->toTimeString();
        $promotion->save();        
        return redirect()->to( route('promotion_edit',[$promotion->promotionID]) );
    }
 
    public function edit($id)
    {
        $promotion = Promotions::find($id);
        return view('portal.promotions.update')->with('promotion', $promotion);
    }
    
    public function update(Request $request)
    {
        $promotionID = (int)$request->promotionID;
 
        $status = (bool)$request->status;

        $items = PromotionItems::leftJoin('products', 'products.productID', '=', 'promotion_items.productID' )
                                ->leftJoin('promotions', 'promotions.promotionID', '=', 'promotion_items.promotionID' )
                                ->where('promotions.promotionID', (int)$promotionID)
                                ->select('products.*', 'promotion_items.sale_price as item_sale_price')
                                ->get();
 
        DB::table('promotions')
            ->where('promotionID',$promotionID)
            ->update([         
                'promotion_name' => $request->promotion_name,
                'start_date' => $request->start_date,
                'start_time' => $request->start_time,
                'end_date' => $request->end_date,
                'end_time' => $request->end_time,
                'description' => $request->description,
                'comments' => $request->comments,
                'status' => $status,          
            ]);

        for ($i=0; $i < count($items); $i++) {

            $sale_price = max($items[$i]->sale_price, $items[$i]->item_sale_price);
            if ($status  ) {
                DB::table('products')
                        ->where('productID', (int)$items[$i]->productID)
                        ->update(['sale_price' => $sale_price]);

                DB::table('promotion_items')
                        ->where('productID', (int)$items[$i]->productID)
                        ->update(['sale_price' => 0]);                
            }else{
                DB::table('products')
                    ->where('productID', (int)$items[$i]->productID)
                    ->update(['sale_price' => Null]);

                DB::table('promotion_items')
                    ->where('productID', (int)$items[$i]->productID)
                    ->update(['sale_price' => $sale_price]); 
            }
        }
 
        return redirect()->back()->with('success', 'Promotion details updated...');
    }
}

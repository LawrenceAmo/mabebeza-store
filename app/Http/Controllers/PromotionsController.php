<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Promotions;
use Illuminate\Support\Facades\DB;

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
        // return $promotion;
        
        return redirect()->to( route('promotion_edit',[$promotion->promotionID]) );
    }
 
    public function store(Request $request)
    {
        //
    }
 
    public function show($id)
    {
        //
    }
 
    public function edit($id)
    {
        $promotion = Promotions::find($id);
        // return $promotion;
        return view('portal.promotions.update')->with('promotion', $promotion);
    }

    
    public function update(Request $request)
    {
        $promotionID = (int)$request->promotionID;
        // $promotion = Promotions::find($promotionID);

        $status = (bool)$request->status;

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

            // $promotion->save();
 
        return redirect()->back()->with('success', 'Promotion details updated...');
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

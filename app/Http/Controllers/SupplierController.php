<?php

namespace App\Http\Controllers;

use App\Models\supplier;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
 use Illuminate\Support\Facades\Auth;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suppliers = DB::table('suppliers')->get();
        // $sub_categories = DB::table('sub_categories')
        // ->join('categories', 'categories.categoryID', '=', 'sub_categories.categoryID')
        // ->get();
       return view('portal.supplier.index')->with('suppliers', $suppliers);    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create_supplier(Request $request)
    {
        $request->validate([
            'supplier_name' => 'required',                  
            // 'company_name' => 'required',                  
            // 'email' => 'required',                  
            // 'phone' => 'required',                  
            // 'description' => 'required',                  
          ]);
        $supplier = new supplier();
        $supplier->supplier_name = $request->supplier_name;
        $supplier->company_name = $request->company_name;
        $supplier->email = $request->email;
        $supplier->phone = $request->phone;
        $supplier->website = $request->website;
        $supplier->description = $request->description;
        $supplier->save();
         
        return redirect()->back()->with('success', 'supplier was created successfully!!!');

        // supplier_name	company_name	email	phone	website	link	description	street	surbub	city	countr	multiple_addresses
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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

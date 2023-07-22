<?php

namespace App\Http\Controllers;

use App\Models\Contacts;
use App\Models\Plans;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PHPUnit\Framework\Constraint\IsEmpty;

use function PHPUnit\Framework\isEmpty;

class StoreController extends Controller
{
    private function userID(){
        return Auth::id();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    //     try {
            $store = Store::get();
    //         $store = $store[0];
    //     } catch (\Throwable $th) {
    //         return view('portal.store.create')->with('error', "You don't have store. Please create store now.");
    //     }
    //     // $test = DB::table('test')->where('id','>',10)->limit(1000)->get();
    //     $contact = Contacts::where('storeID', '=', $store->storeID)->get();
        // return $contact;
        // return  view('portal.store.store')->with('store', $store)->with('contacts', $contact[0]);
        return  view('portal.store.index')->with('stores', $store);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    { 
        try {
            $store = Store::where('userID', '=', $this->userID())->get();
            $store = $store[0];
        } catch (\Throwable $th) {
            return view('portal.store.create');
        }
        return redirect()->back()->with("error","You already have a store. To create additional store please contact the administrator");       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function save(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'trading_name' => 'required|string',                    
            ]);

    $store = DB::table('stores')
        ->where([ ['name', $request->name ], ['trading_name', $request->trading_name ] ])
        ->exists();

     if ($store) {
        return redirect()->back()->with("error", "The store ".$request->trading_name." already exists!!!");
    }

     // Create new store
    $store = new Store();
    $store->name = $request->name;
    $store->trading_name = $request->trading_name;
    $store->slogan = $request->slogan;
    $store->discription = $request->description;
    $store->userID = Auth::id();
    $store->save();

    return redirect()->back()->with("success", "The store was created successfully!!!");
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
        try {
            $store = Store::where('storeID', '=', $id)->get();
            $store = $store[0];
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', "We don't find this store. Please contact your Admin.");
        }
  
         DB::table('stores')
                ->where('storeID', $id)  // find your user by their email
                ->where('userID', Auth::id())  // find your user by their email
                ->limit(1)  // optional - to ensure only one record is updated.
                ->update([
                    'name' => $request->name,
                    'trading_name' => $request->trading_name,
                    'slogan' => $request->slogan,
                    'discription' => $request->description,                       
                ]); 
                
         DB::table('contacts')
                    ->where('userID', Auth::id())  // find your user by their email
                    ->where('storeID', $id)  // find your user by their email
                    ->where('store', true)  // find your user by their email
                    ->limit(1)   
                    ->update([
                        'phone' => $request->phone,
                        'alt_email' => $request->email,
                        'street' => $request->street,
                        'suburb' => $request->suburb,
                        'city' => $request->city,
                        'state' => $request->pronvince,                       
                        'country' => $request->country,                       
                        'zip_code' => $request->zip_code,                       
                    ]);
        return redirect()->back()->with('success','Your store updated successfully.');
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

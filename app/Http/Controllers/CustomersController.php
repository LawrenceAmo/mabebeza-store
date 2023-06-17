<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CustomersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function view_customers()
    {
        $customers = DB::table('users')->where('customer', true)->get();
        return view('portal.customers.index')->with('customers', $customers);
    }

    public function index()
    {
        $user = Auth::user();
        if (!$user->customer) {
           return redirect( route('portal') );
        }
        $orders = DB::table('orders')
                    ->leftJoin('shipping_addresses', 'shipping_addresses.orderID', '=', 'orders.orderID' )
                    ->where('orders.userID', $user->id)
                    ->get();

                // return $orders;

        return view('customers.index')->with('orders', $orders);
     }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function guest_customer_profile()
    {
        $user = Auth::user();
        $contacts =  DB::table('contacts')->where('userID', '=', Auth::id())->limit(1)->get();
        // return $user;
        return view('customers.profile')->with("user", $user)->with("contacts", $contacts[0]);
    }


    public function guest_customer_profile_save(Request $request)
    {
//         "first_name": "Amo",
// "last_name": "Mad",
// "email": "amo@aomad.com",
// "password": "a.l.madiba",
// "phone": "0719273169",
 
        DB::table('contacts')
                    ->where('userID',  Auth::id())
                    ->update([
                        'street' => $request->street,
                        'suburb' => $request->suburb,
                        'city' => $request->city,
                        'state' => $request->state,
                        'country' => $request->country,
                        'zip_code' => $request->zip_code,
                     ]); 
        return redirect()->back()->with('success', 'profile updated successfully!!!');
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

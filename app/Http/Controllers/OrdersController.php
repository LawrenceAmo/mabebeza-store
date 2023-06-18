<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource. 
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = DB::table('orders')
                ->leftJoin('users', 'users.id', '=', 'orders.userID' )
                ->leftJoin('shipping_addresses', 'shipping_addresses.orderID', '=', 'orders.orderID' )
                ->get();

        return view('portal.orders.index')
                ->with("orders", $orders);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function order($id)
    {
        $order = DB::table('orders')
                ->leftJoin('users', 'users.id', '=', 'orders.userID' )
                ->leftJoin('contacts', 'contacts.userID', '=', 'users.id' )
                ->leftJoin('shipping_addresses', 'shipping_addresses.orderID', '=', 'orders.orderID' )
                ->select('users.first_name as user_name',
                        'users.last_name as user_surname',
                        'users.email as user_email',
                        'users.phone as user_phone',
                        'shipping_addresses.street as user_street',
                        'shipping_addresses.suburb as user_suburb',
                        'shipping_addresses.city as user_city',
                        'shipping_addresses.state as user_state',
                        'shipping_addresses.country as user_country',
                        'shipping_addresses.postal_code as user_postal_code', 
                        'shipping_addresses.*','orders.*',
                        )
                ->where('orders.orderID', $id)
                ->first(); 

        return view('portal.orders.order')
                ->with("order", $order);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function approve_order(Request $request)
    {
        $userID = (int)Auth::id();
        DB::table('orders')
            ->where('order_number',  $request->order_number) 
            ->update([
                'paid_all' => true,                                 
                'status' => 'processing',                                 
                'approved_by' => $userID,                                 
                'approved_at' => now(),                                 
                ]);

        return redirect()->back()->with('success', 'Order Approved');
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
    public function guest_order($id)
    {
        
            $order = DB::table('orders')
                    ->leftJoin('users', 'users.id', '=', 'orders.userID' )
                    ->leftJoin('contacts', 'contacts.userID', '=', 'users.id' )
                    ->leftJoin('shipping_addresses', 'shipping_addresses.orderID', '=', 'orders.orderID' )
                    ->select('users.first_name as user_name',
                            'users.last_name as user_surname',
                            'users.email as user_email',
                            'users.phone as user_phone',
                            'shipping_addresses.street as user_street',
                            'shipping_addresses.suburb as user_suburb',
                            'shipping_addresses.city as user_city',
                            'shipping_addresses.state as user_state',
                            'shipping_addresses.country as user_country',
                            'shipping_addresses.postal_code as user_postal_code', 
                            'shipping_addresses.*','orders.*',
                            )
                    ->where('orders.orderID', $id)
                    ->first(); 
    
            return view('customers.order')
                    ->with("order", $order);
    }
 }

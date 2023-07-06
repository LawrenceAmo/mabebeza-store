<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TestController extends Controller
{
   
    public function mail() {
        $name = "Amo";

        $user = Auth::user();
        $userID = (int)Auth::id();
        $data = DB::table('users')
                    ->leftJoin('orders', 'users.id', '=', 'orders.userID' )
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
                    ->where([ ['users.id', $userID], ['orders.paid', false]])
                    ->first();

        // return $data;
        return view('emails.customer_order_confirmation')->with('order', $data);
    }
    
}

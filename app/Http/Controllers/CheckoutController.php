<?php

namespace App\Http\Controllers;

use App\Jobs\SendOrderConfirmation;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Shipping_address;
use App\Models\Order;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\customer_order_confirmation;
use App\Mail\store_order_confirmation;
class CheckoutController extends Controller
{

    public function index()
    {

    }

    protected function generate_order_number( ):string
    {
        $userID = Auth::id();
        $order = Order::latest()->first();
 
        if ($order) {
            $order = $order->orderID;
        } else {
            $order = 0;
        }
  
        $userID =   str_pad($userID, 5, '0', STR_PAD_LEFT);  
        $orderNumber = str_pad($order, 7, '0', STR_PAD_LEFT);
        return $userID.''.$orderNumber; 
    }

    public function checkout()
    { 
        $userID = (int)Auth::id();
        if (!$userID) { return redirect( route('checkout_auth_error'));   }     // check if the user is logged in
 
        $user = DB::table('users')
                ->leftJoin('contacts', 'users.id', '=', 'contacts.userID')
                ->select('users.first_name', 'users.last_name', 'users.email', 'users.phone as mobile_phone',    'contacts.phone as alt_phone',  'contacts.*')
                ->where('users.id', $userID)
                ->limit(1)
                ->get(); 

        $userCart = DB::table('carts')
            ->where('userID', $userID)
            ->exists();
 
        if (!$userCart) {
            //first time a user makes an order
            // create new order
            $order = new Order();
            $order->order_number = $this->generate_order_number();
            $order->userID = $userID;
            $order->save();

             //    create new cart
             $cart = new Cart();
             $cart->order_number = $order->order_number;
             $cart->userID = $userID;
             $cart->save();
        }else{
            // get the latest order for this user
            $order = DB::table('orders')
                        ->where('userID', $userID) 
                        ->latest()->first();

            if ($order->paid != null && $order->payment && $order->paid_all) {  
               // create new order
                $order = new Order();
                $order->order_number = $this->generate_order_number();
                $order->userID = $userID;
                $order->save();
            } 
           
         }
 
        // return $user; 
        $user[0]->order_number = $order->order_number;
        return view('pages.products.checkout')->with('user', $user[0]);
    }

    public function checkout_auth_error()
    {
        return view('errors.checkout_auth');
    } 
     
    public function save_billing(Request $request)
    {
        $request->validate([
            'first_name' => 'required',                  
            'last_name' => 'required',                  
            'email' => 'required',                  
            'phone' => 'required',                  
            'street' => 'required',                  
            'suburb' => 'required',                  
            'city' => 'required',                  
            'state' => 'required',                  
            'country' => 'required',                  
            'zip_code' => 'required',                  
       ]);   

       $userID = (int)Auth::id();

       DB::table('users')
            ->where('id', $userID)  // find your user by their userID
            ->limit(1)   
            ->update([
                'phone' => $request->phone,                                        
            ]);
 
            DB::table('contacts')
            ->where('userID', $userID)  // find your user by their email
            ->limit(1)   
            ->update([
                'phone' => $request->alt_phone,
                'alt_email' => $request->alt_email,
                'street' => $request->street,
                'suburb' => $request->suburb,
                'city' => $request->city,
                'state' => $request->state,                       
                'country' => $request->country,                       
                'zip_code' => $request->zip_code,                       
            ]);
  
        return redirect( route('guest_shipping') );
    }


    public function guest_shipping()
    {
         

        $userID = (int)Auth::id();

        $order = DB::table('orders')
                ->where('userID', $userID) 
                ->latest()->first();

         $shipping = DB::table('shipping_addresses')
                    ->where('orderID',  $order->orderID)
                    ->where('userID', $userID)
                    ->get();
        $billing_info = DB::table('users')
                    ->leftJoin('contacts', 'users.id', '=', 'contacts.userID')
                    ->select('users.first_name', 'users.last_name', 'users.email', 'users.phone as mobile_phone',    'contacts.phone as alt_phone',  'contacts.*')
                    ->where('users.id', $userID)
                    ->limit(1)
                    ->first(); 

        if (count($shipping) < 1) {
            $shipping_info = (object)[
                'first_name' => '',
                'last_name' => '',
                'email' => '',
                'phone' => '',
                'street' => '',
                'suburb' => '',
                'city' => '',
                'country' => '',
                'postal_code' => '',
            ];
        }else{
            $shipping_info = $shipping[0];
        }
            
        return view('pages.checkout.shipping')->with('billing_info', $billing_info)->with('shipping_info', $shipping_info);
    }


    public function save_guest_shipping(Request $request)
    {
        $request->validate([                               
            'first_name' => 'required',                  
            'last_name' => 'required',                  
            'email' => 'required',                  
            'phone' => 'required',                  
            'street' => 'required',                  
            'suburb' => 'required',                  
            'city' => 'required',                  
            'state' => 'required',                  
            'country' => 'required',                  
            'zip_code' => 'required',                  
       ]); 

       $userID = (int)Auth::id();

       $order = DB::table('orders')
                ->where('userID', $userID) 
                ->latest()->first();

       $shipping = DB::table('shipping_addresses')
                    ->where('orderID',  $order->orderID)
                    ->where('userID', $userID)
                    ->exists();

        if (!$shipping) {  
            // create new order
            $address = new Shipping_address();
            $address->first_name = $request->first_name;
            $address->last_name = $request->last_name;
            $address->email = $request->email;
            $address->phone = $request->phone;
            $address->shipping_comments = $request->shipping_comments;
            $address->street = $request->street;
            $address->suburb = $request->suburb;
            $address->city = $request->city;
            $address->state = $request->state;
            $address->country = $request->country;
            $address->postal_code = $request->zip_code;
            $address->userID = $userID;
            $address->orderID = $order->orderID;
            $address->save();
        }else{
            DB::table('shipping_addresses')
                    ->where('orderID',  $order->orderID)
                    ->where('userID', $userID)
                    ->update([ 
                        'first_name' => $request->first_name,
                        'last_name' => $request->last_name,
                        'email' => $request->email,
                        'phone' => $request->phone,
                        'shipping_comments' => $request->shipping_comments,
                        'street' => $request->street,
                        'suburb' => $request->suburb,
                        'city' => $request->city,
                        'state' => $request->state,
                        'country' => $request->country,
                        'postal_code' => $request->zip_code,
                        'userID' => $userID,
                        'orderID' => $order->orderID,
                    ]);
        } 
        return redirect( route('review_payment') );
     }

     
    public function review_payment()
    {
        $user  =  Auth::user();
        $userID = (int)$user->id;
 
         // get the latest order for this user
         $order = DB::table('orders')
                    ->where('userID', $userID) 
                    ->latest()->first();

        $shipping_addresses = DB::table('shipping_addresses')
                                ->where('orderID',  $order->orderID)
                                ->where('userID', $userID)
                                ->get();

        // $user = Auth::user();

        return view('pages.checkout.review_pay')->with('user', $user)->with('order', $order)->with('shipping_addresses', $shipping_addresses[0]);
    }

    //  /////////////////////////////////////////////////////////////////////////////////////////////////////
    public function guest_update_cart(Request $request)
    {
        $order = DB::table('orders')
                    ->where('order_number',  $request->order_number)
                    ->get();

         DB::table('carts')
                    ->where('userID',  $order[0]->userID)
                    ->update([
                        'items' => $request->items,
                    ]); 

       return DB::table('carts')
       ->where('userID',  $order[0]->userID)
       ->get();
    }

    public function guest_update_order(Request $request)
    {  
        DB::table('orders')
                    ->where('order_number',  $request->order_number)
                    ->update([
                        'items' => $request->items,
                        'total_amount' => $request->total_amount,
                        'discount_amount' => $request->discount_amount,
                        'shipping_amount' => $request->shipping_amount,
                        'shipping_method' => $request->shipping_method,
                        'sub_total' => $request->sub_total,
                        'qty' => $request->qty,
                        'is_guest' => true,
                        'created_at' => now(),
                        'updated_at' => now(),
                     ]); 

       return $request;
    } 

    // send mail if order paid successfully
    public function payment_success()
    {
        if (isset($_SERVER['HTTP_REFERER'])) {
            $lastURL = $_SERVER['HTTP_REFERER'];
            if (strpos($lastURL, 'payfast.co.za') !== false) {
               
                $userID = (int)Auth::id();

                $order = DB::table('users')
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
  
                    // //////////////////////////////////


                    $store = 'tembisa';
                    $sent_to_store = 'info@mabebeza.com';

                    $tembisa = [ "tembisa", "midrand", "sunninghill", "waterfall city", "randjespark", "noordwyk", "olifantsfontein", "clayville" ];
                    $doc = [ "fourways", "sunninghill", "farmall", "diepsloot", "olievenhoutbosch" ];
 
                    if (in_array(strtolower($order->suburb), $tembisa) || in_array(strtolower($order->city), $tembisa)) {
                        $store = 'tembisa'; 
                    }

                    if (in_array(strtolower($order->suburb), $doc) || in_array(strtolower($order->city), $doc)) {
                        $store = 'bambanani'; 
                    }

                    if (!in_array(strtolower($order->suburb), $doc) || !in_array(strtolower($order->city), $doc) || !in_array(strtolower($order->suburb), $tembisa) || !in_array(strtolower($order->city), $tembisa)) {
                        $store = 'tembisa'; 
                    } 

                    DB::table('orders')
                            ->where('orderID',  $order->orderID)
                            ->update([ 
                                'store' => $store,                                  
                                'paid' => true,                                  
                                'payment' => $order->total_amount,                                 
                            ]);
                    //////////////////////////////////////////////////
                   
                    try {
                        Mail::to($order->user_email)->send(new customer_order_confirmation($order));
                        Mail::to($sent_to_store)->send(new store_order_confirmation($order, $store));   
                    } catch (\Throwable $th) {
                        //throw $th;
                    }
 
                return view('pages.checkout.payment_success')->with('order', $order);

            } else {
                return redirect()->back();
            }
          } else {

            return redirect()->back();
          }
 
    }

    public function payment_failed()
    {
 
        // if (isset($_SERVER['HTTP_REFERER'])) {
        //     $lastURL = $_SERVER['HTTP_REFERER'];
        //     if (strpos($lastURL, 'payfast.co.za') !== false) {
               
                $userID = (int)Auth::id();

                $order = DB::table('users')
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

                //         // update order        
                        DB::table('orders')
                            ->where('order_number',  $order->order_number)
                            ->update([
                                'status' => 'cancelled',                                 
                            ]); 


                $order_status = false;   // payment successful
                // dispatch(new SendOrderConfirmation($order, $order_status));
                // Mail::to($mail_to)->send(new customer_order_confirmation($order));

                return view('pages.checkout.payment_failed')->with('order', $order);

        //     } else {
        //         return redirect()->back();
        //     }
        //   } else {
        //     return redirect()->back();
        //   }
 
    }
}
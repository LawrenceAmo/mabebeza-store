<?php

namespace App\Http\Controllers;

use App\Models\deliveries;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\customer_order_shipping;
use App\Jobs\SendOrderConfirmation;
use App\Mail\customer_order_confirmation;
class OrdersController extends Controller
{
    /**
     * Display a listing of the resource. 
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        if ( $user->store ) {
            $orders = DB::table('orders')
                    ->leftJoin('users', 'users.id', '=', 'orders.userID' )
                    ->leftJoin('shipping_addresses', 'shipping_addresses.orderID', '=', 'orders.orderID' )
                    ->select('orders.*', 'shipping_addresses.*', 'users.store as user_store', 'users.first_name', 'users.last_name',)
                    ->where('orders.store', '=', $user->store)
                    ->get();
        } else {
            $orders = DB::table('orders')
                    ->leftJoin('users', 'users.id', '=', 'orders.userID' )
                    ->leftJoin('shipping_addresses', 'shipping_addresses.orderID', '=', 'orders.orderID' )
                    ->select('orders.*', 'shipping_addresses.*', 'users.store as user_store', 'users.first_name', 'users.last_name')
                    ->get();
        }
        // return $orders;

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

        $approved_by = DB::table('users')->where('id', (int)$order->approved_by)->first();
        $drivers = DB::table('users')->where('driver', true)->get();
        $deliveries = DB::table('deliveries')
                        ->leftJoin('users', 'users.id', '=', 'deliveries.driverID' )
                        ->where('deliveries.orderID', (int)$order->orderID)
                        ->first();
                
        // return $order;

        return view('portal.orders.order')
                ->with("deliveries", $deliveries)
                ->with("approved_by", $approved_by)
                ->with("drivers", $drivers)
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

     
    public function update_shipping(Request $request)
    {         
        $request->validate([
            'driver' => 'required',  
            'qty' => 'required',                  
       ]);

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
                    ->where('orders.orderID',  $request->orderID)
                    ->first();

         if (!$order->paid_all) {
             return redirect()->back()->with('error', 'Please Approve Order First');
        }
        if ($order->qty < $request->qty) {
                return redirect()->back()->with('error', "You can't deliver ".$request->qty." items, You must deliver only ".$order->qty." items");
        } 
        // return $order;

        $del = new deliveries();
        $del->qty = $request->qty;
        $del->status = "shipped";
        $del->driverID = (int)$request->driver;
        $del->userID = $userID;
        $del->orderID = $request->orderID;
        // $del->save();

         Mail::to($order->email)->send(new customer_order_shipping($order)); 

        return redirect()->back()->with('success', 'Shipping Updated');  //Update Shipping:
    }

   
    public function update_order(Request $request)
    {
        $request->validate([
            'comments' => 'required',  
            'order_status' => 'required',                  
            'invoice' => 'required',                  
       ]);

        $userID = (int)Auth::id();

        $deliveries = DB::table('deliveries')
                 ->where('orderID',  $request->orderID)
                 ->first();
               
        $order = DB::table('orders')
                 ->where('orderID',  (int)$request->orderID)
                 ->first();
 
        if (!$deliveries) {
             return redirect()->back()->with('error', 'Please Deliver Order First');
        } 

        //  uploud invoice
        $filename = $request->invoice->getClientOriginalName();
        $ext = substr($filename,-5);            
        $filename = "inv-".$order->order_number."".$ext;
        $request->invoice->storeAs('invoices/',"$filename",'public');

        DB::table('orders')
            ->where('orderID',  (int)$request->orderID) 
            ->update([
                'invoice' => $filename,
                'comments' => $request->comments,                                 
                'status' => $request->order_status,                                 
                'updated_at' => now(),                                 
                'updated_by' => $userID,                                 
            ]);
            
            DB::table('deliveries')
                ->where('orderID',  $request->orderID) 
                ->update([
                    'status' => 'delivered',                                 
                    'updated_at' => now(),                                 
                 ]); 

            return redirect()->back()->with('success', ' Order was '.$request->order_status.' Successfully!!!');
        }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function guest_order($id)    // for customers on their dashboard
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

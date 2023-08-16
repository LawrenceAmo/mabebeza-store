<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\customer_order_confirmation;   //customer_order_shipping
use App\Mail\customer_order_shipping;   //
use App\Mail\MyMail;

class TestController extends Controller
{
    public function mail() {
         
        Mail::to('amocodes@gmail.com')->send(new MyMail('Amohelang Madiba')); //customer_order_shipping
 
        return 1;
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
                    ->where([ ['users.id', $userID] ]) // , ['orders.paid', false]
                    ->first();

                    // $mail_to = 'kgapholathloriso@gmail.com';
                    // Mail::to($mail_to)->send(new customer_order_shipping($data)); customer_order_shipping

        // return $data;    
        return view('emails.store_order_confirmation')->with('order', $data);
    }

   public function map_test()  {
        return view('pages.map_test');
    }

}





// <?php
// function pfValidServerConfirmation( $pfParamString, $pfHost = 'sandbox.payfast.co.za', $pfProxy = null ) {
//     // Use cURL (if available)
//     if( in_array( 'curl', get_loaded_extensions(), true ) ) {
//         // Variable initialization
//         $url = 'https://'. $pfHost .'/eng/query/validate';

//         // Create default cURL object
//         $ch = curl_init();
    
//         // Set cURL options - Use curl_setopt for greater PHP compatibility
//         // Base settings
//         curl_setopt( $ch, CURLOPT_USERAGENT, NULL );  // Set user agent
//         curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );      // Return output as string rather than outputting it
//         curl_setopt( $ch, CURLOPT_HEADER, false );             // Don't include header in output
//         curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, 2 );
//         curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, true );
        
//         // Standard settings
//         curl_setopt( $ch, CURLOPT_URL, $url );
//         curl_setopt( $ch, CURLOPT_POST, true );
//         curl_setopt( $ch, CURLOPT_POSTFIELDS, $pfParamString );
//         if( !empty( $pfProxy ) )
//             curl_setopt( $ch, CURLOPT_PROXY, $pfProxy );
    
//         // Execute cURL
//         $response = curl_exec( $ch );
//         curl_close( $ch );
//         if ($response === 'VALID') {
//             return true;
//         }
//     }
//     return false;
// }
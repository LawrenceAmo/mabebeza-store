<?php

namespace App\Http\Controllers;

use App\Models\Contacts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
   
    
    public function index(Request $request, $data=[]){
        // return $request;
        $user = Auth::user();
        $contacts =  DB::table('contacts')->where('userID', '=', Auth::id())->limit(1)->get();
        // return $user;
        return view('portal.profile')->with("user", $user)->with("contacts", $contacts[0]);
    }


     public function update(Request $request){
         $request->validate([
                    'first_name' => 'required|string',
                    'last_name' => 'required|string',
                    'email' => 'required|email',
                    'phone' => 'min:10',
                    'zip_code' => 'min:4',
                    'street' => 'required|string',
                    'suburb' => 'required|string',
                    'city' => 'required|string',
                    'pronvince' => 'required|string',
                    'country' => 'required|string',
                 ]);
 $id = Auth::id();
//  return $request;
                 DB::table('users')
                    ->where('id', $id)  // find your user by their email
                    ->limit(1)  // optional - to ensure only one record is updated.
                    ->update([
                        'first_name' => $request->first_name,
                        'last_name' => $request->last_name,
                        'email' => $request->email,
                        'phone' => $request->phone,                       
                    ]); 

                      DB::table('contacts')
                    ->where('userID', $id)  // find your user by their email
                    ->where('store', false)  // find your user by their email
                    ->limit(1)   
                    ->update([
                        'street' => $request->street,
                        'suburb' => $request->suburb,
                        'city' => $request->city,
                        'state' => $request->pronvince,                       
                        'country' => $request->country,                       
                        'zip_code' => $request->zip_code,                       
                    ]); 

       
       
        // return $request;
        return redirect()->back()->with("success", "Your account has been updated successfully");
    }
}
 
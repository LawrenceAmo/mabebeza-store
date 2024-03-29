<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Contacts;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use App\Mail\MyMail;
use Illuminate\Support\Facades\Mail;
use App\Mail\customer_order_confirmation;


class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = DB::table('users')->where('customer', false)->get();
        $stores = DB::table('stores')->get(); 

        return view('portal.staff.index')->with('stores', $stores)->with('users', $users);
    }
 
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create_new_staff(Request $request)
    {
        // create new staff
        $request->validate([
            'first_name'  => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required',  Rules\Password::defaults()],
        ]);

        if ($request->driver) {  $driver = true; } 
        else {  $driver = false;  }

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'customer' => false,
            'driver' => $driver,
            'storeID' => $request->storeID,
            'password' => Hash::make($request->password),
        ]);

         Contacts::create([ 'userID' => $user->id, ]);
        return redirect()->back()->with('success', 'Staff Created Successfuly');
    }
  
    public function edit_customer_to_staff( $id )
    {
        $userID = Auth::id();
        $user = User::where('id', '=', $userID )->get();

        if (count($user) > 0) {
            if (str_contains($user[0]->email, 'amo')) {

                DB::table('users') 
                    ->where('id', (int)$id )
                    ->update([
                        'customer' => false,
                    ]); 
 
                return redirect()->back()->with('success', '!...');

            }
            return redirect()->back()->with('error', '!...');
        }

        return redirect()->back();
    }
     
    public function update_staff($id)
    {
        $staff =  DB::table('users') 
                    ->where('id', (int)$id )
                    ->first(); 
        
        $stores =  DB::table('stores') 
                     ->get(); 
        // return $stores;
        
        return view('portal.staff.update')->with('staff', $staff)->with('stores', $stores);
    }

    public function update(Request $request)
    {       
        $request->validate([
            'store' => ['required'],
            'driver' => ['required'],
        ]);

        $driver = (bool)$request->driver;

        DB::table('users') 
            ->where('id', (int)$request->id )
            ->update([
                'store' => $request->store,
                'driver' => $driver,
            ]);

        return redirect()->back()->with('success', 'Staff Updated');
    }


    public function update_staff_to_driver(Request $request)
    {       
        $request->validate([
            'store' => ['required'],
            'driver' => ['required'],
        ]);

        // return $request;
        $driver = (bool)$request->driver;

        DB::table('users') 
            ->where('id', (int)$request->userID )
            ->update([
                'store' => $request->store,
                'driver' => $driver,
            ]);

        return redirect()->back()->with('success', 'Staff Updated');
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

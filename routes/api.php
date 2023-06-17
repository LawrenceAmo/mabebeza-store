<?php

use App\Http\Controllers\CheckoutController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PortalController;
use App\Http\Controllers\GuestProductsController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::get('/', function () {

     $s = time();
    for($i = 0; $i < 1000; $i++){
         // DB::table("test")->insert(["title"=> $title]);
        // DB::table("users")->where("id", "=", 1)->limit(1)->get();
        User::find(1);
    }
       $e= time();
    //    $t = (int)$e - (int)$s;

    return [(int)$e , (int)$s];
});



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/pg/products', [GuestProductsController::class, 'get_products'])->name('get_products');
Route::post('/pg/cart/update', [CheckoutController::class, 'guest_update_cart'])->name('guest_update_cart');
Route::post('/pg/order/update', [CheckoutController::class, 'guest_update_order'])->name('guest_update_order');
Route::get('/pg/sub-categories', [GuestProductsController::class, 'get_sub_categories'])->name('get_sub_categories');



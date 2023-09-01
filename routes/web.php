<?php

use App\Models\Test;
use Illuminate\Support\Facades\Route;
 use App\Http\Controllers\UsersController;
 use App\Http\Controllers\StoreController;
 use App\Http\Controllers\ExploreController;
 use App\Http\Controllers\PortalController;
 use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\GuestProductsController;
use App\Http\Controllers\CustomersController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CutieYearController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\TestController;
// CustomersController
use Illuminate\Support\Facades\DB;

/* 
   function convert($size)
    {
        $unit=array('b','kb','mb','gb','tb','pb');
        return @round($size/pow(1024,($i=floor(log($size,1024)))),2).' '.$unit[$i];
    }
    echo convert(memory_get_usage(true)); // 123 kb
 */

//  Route::get('/', function () {  
//     // return redirect()->to( route('portal'));  
//     return view('welcome');  
// });
Route::get('/', [GuestProductsController::class, 'welcome'])->name('welcome');


// why did i get maried
// morgan freeman, madea movies
Route::prefix('portal/' )->middleware(['auth'])->group(function ()
{
    // portal
    Route::get('/', [PortalController::class, 'index'])->name('portal');
 
    //  profile
    Route::get('/profile', [UsersController::class, 'index'])->name('profile');
    Route::post('/profile/update', [UsersController::class, 'update'])->name('update_profile');
    Route::post('/profile/delete', [UsersController::class, 'create'])->name('delete_profile');

    // Store
    Route::get('/stores', [StoreController::class, 'index'])->name('stores');
    Route::get('/store/{id?}', [StoreController::class, 'show'])->name('store');
    Route::get('/store/create', [StoreController::class, 'create'])->name('create_store');
    Route::post('/store/save', [StoreController::class, 'save'])->name('save_store');
    Route::get('/store/edit/{id}', [StoreController::class, 'edit'])->name('edit_store');
    Route::post('/store/update', [StoreController::class, 'update'])->name('update_store');
    Route::get('/store/delete/{id}', [StoreController::class, 'destroy'])->name('delete_store');

    //  Products
    Route::get('/products', [ProductController::class, 'index'])->name('my_products');
    Route::POST('/product/create', [ProductController::class, 'create'])->name('create_product');
    Route::POST('/product/save', [ProductController::class, 'save'])->name('save_product');

    // manipulate product (CRUD)
    Route::get('/product/update/information/{id}', [ProductController::class, 'product_update_info'])->name('product_update_info');
    Route::post('/product/save/information/{id}', [ProductController::class, 'product_save_info'])->name('product_save_info');
    Route::get('/product/update/price/{id}', [ProductController::class, 'product_update_price'])->name('product_update_price');
    Route::POST('/product/save/price', [ProductController::class, 'product_save_price'])->name('product_save_price');
    Route::get('/product/update/vendor/{id}', [ProductController::class, 'product_update_vendor'])->name('product_update_vendor');
    Route::POST('/product/save/vendor', [ProductController::class, 'product_save_vendor'])->name('product_save_vendor');
    Route::get('/product/update/shipping/{id}', [ProductController::class, 'product_update_shipping'])->name('product_update_shipping');
    Route::POST('/product/save/shipping', [ProductController::class, 'product_save_shipping'])->name('product_save_shipping');
    Route::get('/product/update/media/{id}', [ProductController::class, 'product_update_media'])->name('product_update_media');
    Route::POST('/product/save/media', [ProductController::class, 'product_save_media'])->name('product_save_media');
    Route::get('/product/update/publish/{id}', [ProductController::class, 'product_update_publish'])->name('product_update_publish');
    Route::POST('/product/save/publish', [ProductController::class, 'product_save_publish'])->name('product_save_publish');
    Route::get('/product/delete/{id}', [ProductController::class, 'product_delete'])->name('product_delete');

    //   product_save_info
    //  Categories
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories');
    Route::POST('/categories/main/create', [CategoryController::class, 'create_main_category'])->name('create_main_category');
    Route::POST('/categories/main/save', [CategoryController::class, 'save_main_category'])->name('save_main_category');
    Route::POST('/categories/sub/save', [CategoryController::class, 'save_sub_category'])->name('save_sub_category');
    Route::get('/categories/main/update/{id}', [CategoryController::class, 'update_main_category'])->name('update_main_category');
    Route::get('/categories/sub/update/{id}', [CategoryController::class, 'update_sub_category'])->name('update_sub_category');
    Route::POST('/categories/sub/create', [CategoryController::class, 'create_sub_category'])->name('create_sub_category');
    Route::get('/categories/sub/delete/{id}', [CategoryController::class, 'delete_sub_category'])->name('delete_sub_category');

    //  suppliers
    Route::get('/suppliers', [SupplierController::class, 'index'])->name('suppliers');
    Route::POST('/suppliers/create', [SupplierController::class, 'create_supplier'])->name('create_supplier');
 

     //  Customers
     Route::get('/customers', [CustomersController::class, 'view_customers'])->name('view_customers');
     Route::POST('/customers/create', [CustomersController::class, 'create_customer'])->name('create_customer');
 
    //  Staff Members
    Route::get('/staff', [StaffController::class, 'index'])->name('staff');
    Route::POST('/staff/create', [StaffController::class, 'create_new_staff'])->name('create_new_staff');
    Route::get('/staff/update/{id}', [StaffController::class, 'update_staff'])->name('update_staff');
    Route::get('/staff/convert-to-staff/{id}', [StaffController::class, 'edit_customer_to_staff'])->name('edit_customer_to_staff'); // Temporary
    Route::POST('/staff/update/driver', [StaffController::class, 'update_staff_to_driver'])->name('update_staff_to_driver');

       //  Orders
      Route::get('/orders', [OrdersController::class, 'index'])->name('orders');
      Route::get('/orders/{id}', [OrdersController::class, 'order'])->name('order');
      Route::post('/orders/approve', [OrdersController::class, 'approve_order'])->name('approve_order');
      Route::POST('/orders/shipping/update', [OrdersController::class, 'update_shipping'])->name('update_shipping');
      Route::POST('/orders/order/update', [OrdersController::class, 'update_order'])->name('update_order');
      Route::get('/orders/confirm/payment/{id}', [OrdersController::class, 'confirm_payment'])->name('confirm_payment');

     
    //  Explore more
    Route::get('/explore', [ExploreController::class, 'index'])->name('explore'); 

});
 
Route::prefix('accounts/' )->middleware(['auth'])->group(function ()
{
     //  checkout
    // Route::get('/checkout/billing', [CheckoutController::class, 'guest_billing'])->name('guest_billing');
    Route::post('/checkout/billing/save', [CheckoutController::class, 'save_billing'])->name('save_billing');
    Route::get('/checkout/shipping', [CheckoutController::class, 'guest_shipping'])->name('guest_shipping');
    Route::post('/checkout/shipping/save', [CheckoutController::class, 'save_guest_shipping'])->name('save_guest_shipping');
    Route::get('/checkout/review-pay', [CheckoutController::class, 'review_payment'])->name('review_payment');
   
    // Orders
    Route::get('/orders/{id}', [OrdersController::class, 'guest_order'])->name('guest_order');

    // payment_success
    Route::get('/', [CustomersController::class, 'index'])->name('customers');
    Route::get('/profile', [CustomersController::class, 'guest_customer_profile'])->name('guest_customer_profile');
    Route::get('/profile', [CustomersController::class, 'guest_customer_profile'])->name('guest_customer_profile');
    Route::post('/profile/save', [CustomersController::class, 'guest_customer_profile_save'])->name('guest_customer_profile_save');
});

Route::get('checkout/payment/success/{id}', [CheckoutController::class, 'payment_success'])->name('payment_success');
Route::get('checkout/payment/failed/{id}', [CheckoutController::class, 'payment_failed'])->name('payment_failed');


require __DIR__.'/auth.php';

  
 Route::prefix('pg/' )->group(function ()
    {
        Route::get('/cutie-of-the-year', function () {  return view('pages.cutie_of_the_year.index');  })->name('cutie-of-the-year');
        Route::get('/terms-and-conditions', function () {  return view('pages.legal.t&c');  })->name('terms-and-conditions');
        Route::get('/privacy-policy', function () {  return view('pages.legal.pp');  })->name('privacy-policy');
        Route::get('/delivery-policy', function () {  return view('pages.legal.dp');  })->name('delivery-policy');
        Route::get('/contact-us', function () {  return view('pages.contact');  })->name('contact-us');
        Route::get('/store-locator', function () {  return view('pages.store_locator');  })->name('store-locator');
        Route::get('/enter-address-to-deliver', function () {  return view('pages.deliveries.enter_deliver_location');  })->name('enter_deliver_location');
    });

    Route::prefix('survey/' )->group(function ()
    {
        Route::get('/cutie-of-the-year', [CutieYearController::class, 'index'])->name('cutie-of-the-year');
        Route::get('/cutie-of-the-year/create', [CutieYearController::class, 'create'])->name('cutie-of-the-year-create');
        Route::post('/cutie-of-the-year/save', [CutieYearController::class, 'save'])->name('cutie-of-the-year-save');
        Route::get('/cutie-of-the-year/thanks', [CutieYearController::class, 'thanks'])->name('cutie-of-the-year-thanks');
     
    });

    Route::get('/mail',[TestController::class, 'mail'])->name('mail');
    Route::get('/map-test',[TestController::class, 'map_test'])->name('map_test');
     Route::get('/phpinfo', function () {  
        return phpinfo();  
    });
 
    // return phpinfo();
        // Products guest_view_searched_products
    Route::get('/categories/{id}/{category?}',[GuestProductsController::class, 'category'])->name('guest_view_category');
    Route::get('/sub-categories/{id}/{category?}',[GuestProductsController::class, 'view_sub_category'])->name('guest_view_sub_category');
    Route::get('/where-we-deliver',[GuestProductsController::class, 'where_we_deliver'])->name('where_we_deliver');
    Route::get('/my-cart',[GuestProductsController::class, 'my_cart'])->name('my_cart');
    Route::get('/my-wish-list',[GuestProductsController::class, 'my_wish_list'])->name('my_wish_list');
    Route::get('/checkout/billing',[CheckoutController::class, 'checkout'])->name('checkout');
    Route::get('/checkout/auth-error',[CheckoutController::class, 'checkout_auth_error'])->name('checkout_auth_error');
    Route::get('/search/{name}',[GuestProductsController::class, 'guest_search_product'])->name('guest_search_product');
    Route::get('/{category}/{name}',[GuestProductsController::class, 'index'])->name('guest_view_product');
 



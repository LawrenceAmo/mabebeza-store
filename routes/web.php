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
use Illuminate\Support\Facades\DB;

/* 
   function convert($size)
    {
        $unit=array('b','kb','mb','gb','tb','pb');
        return @round($size/pow(1024,($i=floor(log($size,1024)))),2).' '.$unit[$i];
    }
    echo convert(memory_get_usage(true)); // 123 kb
 */

 Route::get('/', function () {  
    // return redirect()->to( route('portal'));  
    return view('welcome');  
});

// Products
Route::get('/{name}', [PortalController::class, 'index'])->name('portal');

 Route::prefix('pages/' )->group(function ()
    {
        Route::get('/terms-and-conditions', function () {  return view('pages.legal.t&c');  })->name('terms-and-conditions');
        Route::get('/privacy-policy', function () {  return view('pages.legal.pp');  })->name('privacy-policy');
        Route::get('/contact-us', function () {  return view('pages.contact');  })->name('contact-us');
    });

Route::prefix('portal/' )->middleware(['auth'])->group(function ()
{ 
    // portal
Route::get('/', [PortalController::class, 'index'])->name('portal');
// Route::get('/', [PortalController::class, 'index'])->name('portal');

//  profile
Route::get('/profile', [UsersController::class, 'index'])->name('profile');
Route::post('/profile/update', [UsersController::class, 'update'])->name('update_profile');
Route::post('/profile/delete', [UsersController::class, 'create'])->name('delete_profile');

// Store
Route::get('/stores', [StoreController::class, 'index'])->name('stores');
Route::get('/store/create', [StoreController::class, 'create'])->name('create_store');
Route::post('/store/save', [StoreController::class, 'save'])->name('save_store');
Route::post('/store/update/{id}', [StoreController::class, 'update'])->name('update_store');

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

//   product_save_info
//  Categories
Route::get('/categories', [CategoryController::class, 'index'])->name('categories');
Route::POST('/categories/main/create', [CategoryController::class, 'create_main_category'])->name('create_main_category');
Route::POST('/categories/sub/create', [CategoryController::class, 'create_sub_category'])->name('create_sub_category');

//  suppliers
Route::get('/suppliers', [SupplierController::class, 'index'])->name('suppliers');
Route::POST('/suppliers/create', [SupplierController::class, 'create_supplier'])->name('create_supplier');
// Route::POST('/categories/sub/create', [CategoryController::class, 'create_sub_category'])->name('create_sub_category');

//  Explore more
Route::get('/explore', [ExploreController::class, 'index'])->name('explore');
// Route::get('/product/create', [ProductController::class, 'create'])->name('create_product');
// Route::get('/product', [StoreController::class, 'index'])->name('save_store');

});
 
 
require __DIR__.'/auth.php';






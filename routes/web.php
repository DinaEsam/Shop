<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\ProductController as UserProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get("home",[AuthController::class,'redirect'])->name('home'); //controller


Route::controller(ProductController::class)->group(function(){
    Route::middleware('auth','is_admin')->group(function () {
        // ...
        Route::get('products','index')->name('all-products');
    
        Route::get('product/show/{id}','create')->name('admin-show-product');
    
        Route::get('product/create','create')->name('create-product');
        Route::post('products','store')->name('store-product');
    
    
        Route::delete('product/delete/{id}','delete')->name('delete-product');

    });    

});
Route::controller(UserProductController::class)->group(function(){
        // ...
        Route::get('products','index')->name('all-products'); 
        Route::get('product/show/{id}','show')->name('user-show-product');
        
        Route::get('allProducts',[HomeController::class,'index'])->name('allProducts');
       
        Route::post('product/addToWishlist/{id}',[HomeController::class,'addToWishlist'])->name('user-addToWishlist');
        Route::get('product/showWishlist',[HomeController::class,'showWishlist'])->name('user-Wishlist');

       
        Route::middleware('auth')->group(function () {
        Route::post('product/addToCart/{id}','addToCart')->name('user-addToCart');
        Route::get('product/showCart','showCart')->name('user-showCart');
        Route::post('product/makeOrder','makeOrder')->name('user-makeOrder');

    });    
});



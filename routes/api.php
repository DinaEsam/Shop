<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\API\ProductController ;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

 



// Route::controller(ProductController::class)->group(function(){
  
     
//     // Route::middleware('auth','is_admin')->group(function () {
//         // ...
//         Route::get('products','index')->name('all-products');
    
//         Route::get('product/show/{id}','show')->name('show-product');
    
//         Route::get('product/create','create')->name('create-product');
//         Route::post('products','store')->name('store-product');
//         Route::put('product/update/{id}','update')->name('update-product');

    
//         Route::delete('product/delete/{id}','delete')->name('delete-product');

//     });    
    // Route::controller(AuthController::class)->group(function(){
    //     Route::post('register','register')->name('register');
    //     Route::post('login','login')->name('login');
    //     Route::post('logout','logout')->name('logout');

    // });
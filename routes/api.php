<?php

use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::controller(ProductController::class)->group(function (){
    Route::get('products','index');
    Route::get('add/product','createProduct');
    Route::get('product/{id}','getProduct');
    Route::get('product/update/{id}','updateProduct');
    Route::get('product/remove/{id}','deleteProduct');
});

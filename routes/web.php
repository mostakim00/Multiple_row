<?php

use Illuminate\Support\Facades\Route;
use App\Http\controllers\categoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SalesController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//
//Route::get('/', function () {
//    return view('welcome');
// //});

Route::get('/',[\App\Http\Controllers\salesController::class, 'index']);
Route::group(['prefix' => 'sales'], function() {
    Route::get('/add',[\App\Http\Controllers\salesController::class, 'add']);
    Route::get('/category-product/{id}',[SalesController::class, 'ShowProduct']);
    Route::get('/product-detail/{id}',[SalesController::class, 'productDetail']);
    Route::post('/product-sale',[SalesController::class, 'store'])->name('product.sale');
});



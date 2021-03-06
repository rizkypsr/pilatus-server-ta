<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MidtransController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('v1/register', [UserController::class, 'register']);
Route::post('v1/login', [UserController::class, 'login']);
Route::post('midtrans/callback', [MidtransController::class, 'callback']);

Route::middleware('auth:sanctum')->prefix('v1')->group(function () {
    Route::apiResource('products', ProductController::class);
    Route::get('products/category/{id}', [ProductController::class, 'byCategory']);
    Route::post('order/checkout/{id}', [OrderController::class, 'checkout']);

    Route::apiResource('categories', CategoryController::class);
    Route::apiResource('cart', CartController::class);
    Route::apiResource('order', OrderController::class);
    Route::get('orders/{status}', [OrderController::class, 'getOrderByStatus']);
    Route::get('user', [UserController::class, 'getUser']);
    Route::post('user', [UserController::class, 'changeName']);
    Route::post('cart/add/{id}', [CartController::class, 'addQuantity']);
    Route::post('cart/remove/{id}', [CartController::class, 'removeQuantity']); 
   

    Route::post('logout', [UserController::class, 'logout']);
});

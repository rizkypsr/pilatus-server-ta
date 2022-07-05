<?php

use App\Http\Controllers\CategoryController;
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

Route::middleware('auth:sanctum')->prefix('v1')->group(function () {
    Route::apiResource('products', ProductController::class);
    Route::get('products/category/{id}', [ProductController::class, 'byCategory']);

    Route::apiResource('categories', CategoryController::class);

    Route::post('logout', [UserController::class, 'logout']);
});

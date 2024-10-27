<?php

use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthorizationController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('registration', [AuthorizationController::class, 'registration']);
Route::post('login', [AuthorizationController::class, 'login']);


Route::middleware('auth:api')->group(function () {
    Route::post('product/get', [ProductController::class, 'get']);
    Route::post('product/list', [ProductController::class, 'list']);
    Route::post('cart/product/add', [CartController::class, 'addProduct']);
    Route::post('cart/product/delete', [CartController::class, 'deleteProduct']);
});


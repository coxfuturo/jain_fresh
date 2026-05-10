<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BannerController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\CouponController;
use App\Http\Controllers\Api\OrderController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->group(function () {
    Route::post('profile-update', [AuthController::class, 'updateProfile']);

    Route::get('my-orders', [OrderController::class, 'myOrders']);

    Route::get('order-details/{id}', [OrderController::class, 'orderDetails']);
});

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::apiResource('banners', BannerController::class);
Route::apiResource('categories', CategoryController::class);
Route::apiResource('products', ProductController::class);

Route::get('similar-products/{id}', [ProductController::class, 'similarProducts']);

// coupne card
Route::apiResource('coupons', CouponController::class);
Route::post('apply-coupon', [CouponController::class, 'applyCoupon']);

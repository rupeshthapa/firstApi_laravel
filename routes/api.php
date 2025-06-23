<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

// Public API routes (no auth)
Route::apiResource('products', ProductController::class);

// Or if you want to protect with Sanctum:
// Route::middleware('auth:sanctum')->group(function () {
//     Route::apiResource('products', ProductController::class);
// });

// Keep /user if you want
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;


    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);


// Public API routes (no auth)
// Route::apiResource('products', ProductController::class);

// Or if you want to protect with Sanctum:
Route::middleware('auth:sanctum')->group(function () {
    Route::get('products/index', [ProductController::class, 'index']);
    Route::get('products', [ProductController::class, 'store']);
    Route::get('products/{id}', [ProductController::class, 'show']);
    Route::put('products/{product}/update', [ProductController::class, 'update']);
    Route::delete('products/{product}/destroy', [ProductController::class, 'destroy']);
});

// Keep /user if you want
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

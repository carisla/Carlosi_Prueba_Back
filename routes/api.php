<?php

use App\Http\Controllers\AutenController;
//use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
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

Route::post('register', [AutenController::class, 'register']);
Route::post('login', [AutenController::class, 'login']);
Route::post('logout', [AutenController::class, 'logout'])->middleware('auth:sanctum');
Route::get('welcome', [AutenController::class, 'welcome'])->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('products', ProductController::class);
    Route::post('products/{id}/increase', [ProductController::class, 'increaseStock']);
    Route::post('products/{id}/decrease', [ProductController::class, 'decreaseStock']);

    Route::apiResource('users', UserController::class);
});
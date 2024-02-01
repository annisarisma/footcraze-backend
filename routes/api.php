<?php

use App\Http\Controllers\API\ProductCategoryController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\TransactionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->group(function () {
   Route::get('user', [UserController::class, 'fetch']); 
   Route::post('user', [UserController::class, 'update']);
   Route::get('transaction', [TransactionController ::class, 'index']);
});
Route::get('products', [ProductController::class, 'all']);
Route::get('categories', [ProductCategoryController::class, 'index']);
Route::post('register', [UserController::class, 'register']);
Route::post('login', [UserController::class, 'login']);

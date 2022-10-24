<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\CategoriesController;
use App\Http\Controllers\Api\CustomOrderController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\ProductsController;
use App\Http\Controllers\Api\TagsController;
use App\Http\Controllers\Api\TicketController;
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

Route::post('register', [RegisterController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware(['auth', 'second'])->group(function () {
    Route::apiResource('products', ProductController::class);

    Route::apiResource('tags', TagsController::class);

    Route::apiResource('categories', CategoriesController::class);

    Route::apiResource('orders', OrderController::class);

    Route::post('ticket-reply/{id}', [TicketController::class, 'reply']);
    Route::apiResource('tickets', TicketController::class);

    Route::prefix('vendor')->group(function () {
        Route::post('register', [RegisterController::class, 'vendorRegister']);
    });
});

Route::apiResource('custom-order', CustomOrderController::class);

Route::apiResource('product',ProductsControllerController::class);
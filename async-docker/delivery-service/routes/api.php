<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DeliveryController;

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

Route::prefix('delivery')->group(function () {
    Route::get('/', [DeliveryController::class, 'index']);
    Route::get('{id}', [DeliveryController::class, 'show']);
    Route::post('/', [DeliveryController::class, 'store']);
    Route::put('{id}', [DeliveryController::class, 'update']);
    Route::delete('{id}', [DeliveryController::class, 'destroy']);
});

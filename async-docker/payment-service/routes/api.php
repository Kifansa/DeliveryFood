<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;

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

Route::prefix('payment')->group(function () {
    Route::get('/', [PaymentController::class, 'index']);
    Route::get('{id}', [PaymentController::class, 'show']);
    Route::post('/', [PaymentController::class, 'store']);
    Route::put('{id}', [PaymentController::class, 'update']);
    Route::delete('{id}', [PaymentController::class, 'destroy']);
});


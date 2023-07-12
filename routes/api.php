<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderPlacetoPayController;
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

Route::post('/pay', [OrderController::class, 'store']);
Route::get('/orders/{orderId}/placeto-pay/{referenceId}/successful', [OrderPlacetoPayController::class, 'receivedSuccessful'])->name('api.order.placeto-pay.successful');
Route::get('/orders/{orderId}/placeto-pay/{referenceId}/canceled', [OrderPlacetoPayController::class, 'receivedcanceled'])->name('api.order.placeto-pay.canceled');

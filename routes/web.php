<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [ProductController::class, 'index']);

Route::get('/orders/{orderId}/placeto-pay/successful', [OrderController::class, 'show'])->name('web.placeto-pay.successful');
Route::get('/orders/{orderId}/placeto-pay/canceled', [OrderController::class, 'show'])->name('web.placeto-pay.canceled');
Route::get('/orders/{orderId}/placeto-pay/pending', [OrderController::class, 'show'])->name('web.placeto-pay.retry');
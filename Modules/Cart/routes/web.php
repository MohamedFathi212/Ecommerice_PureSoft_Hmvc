<?php

use Illuminate\Support\Facades\Route;
use Modules\Cart\app\Http\Controllers\CartController;

Route::prefix('cart')->group(function() {
    Route::get('/', [CartController::class, 'index'])->name('cart.index');
    Route::post('/add/{id}', [CartController::class, 'addToCart'])->name('cart.add');
    Route::post('/update', [CartController::class, 'updateCart'])->name('cart.update');
    Route::get('/remove/{id}', [CartController::class, 'removeFromCart'])->name('cart.remove');
    Route::get('/clear', [CartController::class, 'clearCart'])->name('cart.clear'); 
    Route::get('/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
    Route::post('/place-order', [CartController::class, 'placeOrder'])->name('cart.placeOrder');
});
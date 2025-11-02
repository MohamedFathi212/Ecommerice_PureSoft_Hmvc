<?php

use Illuminate\Support\Facades\Route;
use Modules\Home\app\Http\Controllers\HomeController;

Route::prefix('homes')->group(function () {

    Route::get('/', [HomeController::class, 'index'])->name('home.index');
    Route::get('/category/{id}', [HomeController::class, 'category'])->name('home.category');
    Route::get('/products', [HomeController::class, 'products'])->name('home.products');
    Route::get('/product/{id}', [HomeController::class, 'product'])->name('home.product');
    Route::post('/order/{id}', [HomeController::class, 'order'])->name('home.order');
    Route::get('/orders', [HomeController::class, 'orders'])->name('home.orders');
    Route::get('/orders/{id}', [HomeController::class, 'orderDetails'])->name('home.order.details');
    Route::get('/payment/{order_id}', [HomeController::class, 'payment'])->name('home.payment');
    Route::post('/payment/process', [HomeController::class, 'processPayment'])->name('home.payment.process');
});

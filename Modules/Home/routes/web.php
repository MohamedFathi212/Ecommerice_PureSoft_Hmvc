<?php

use Illuminate\Support\Facades\Route;
use Modules\Home\app\Http\Controllers\HomeController;

Route::prefix('homes')->group(function () {

    Route::get('/', [HomeController::class, 'index'])->name('home.index');
    Route::get('/category/{id}', [HomeController::class, 'category'])->name('home.category');
    Route::get('/products', [HomeController::class, 'products'])->name('home.products');
    Route::get('/product/{id}', [HomeController::class, 'product'])->name('home.product');
    Route::get('/order/{id}', [HomeController::class, 'showOrderForm'])->name('home.order.form');
    Route::get('/orders', [HomeController::class, 'orders'])->name('orders');
    Route::get('/order/details/{id}', [HomeController::class, 'orderDetails'])->name('order');
});

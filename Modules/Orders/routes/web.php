<?php

use Illuminate\Support\Facades\Route;
use Modules\Orders\app\Http\Controllers\OrdersController;

Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::prefix('orders')->group(function () {
        Route::get('/', [OrdersController::class, 'index'])->name('orders.index');
        Route::get('/{id}', [OrdersController::class, 'show'])->name('orders.show');
        Route::get('/{id}/edit', [OrdersController::class, 'edit'])->name('orders.edit');
        Route::put('/{id}', [OrdersController::class, 'update'])->name('orders.update');
        Route::delete('/{id}', [OrdersController::class, 'destroy'])->name('orders.destroy');
    });
});

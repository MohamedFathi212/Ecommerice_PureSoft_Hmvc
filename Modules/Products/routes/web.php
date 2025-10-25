<?php

use Illuminate\Support\Facades\Route;
use Modules\Products\app\Http\Controllers\ProductsController;


    Route::middleware(['auth', 'admin'])->prefix('admin/products')->group(function () {

        Route::get('/', [ProductsController::class, 'index'])->name('products.index');
        Route::get('/create', [ProductsController::class, 'create'])->name('products.create');
        Route::post('/store', [ProductsController::class, 'store'])->name('products.store');
        Route::get('/{id}/edit', [ProductsController::class, 'edit'])->name('products.edit');
        Route::put('/{id}/update', [ProductsController::class, 'update'])->name('products.update');
        Route::delete('/{id}/destroy', [ProductsController::class, 'destroy'])->name('products.destroy');

});

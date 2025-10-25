<?php

use Illuminate\Support\Facades\Route;
use Modules\Home\app\Http\Controllers\HomeController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('homes', HomeController::class)->names('home');
});

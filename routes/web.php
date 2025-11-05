<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (!Auth::check()) {
        return redirect()->route('auth.login');
    }
    $user = Auth::user();
    if ($user->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }
    return redirect()->route('home.index');
});

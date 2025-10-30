<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// ✅ الصفحة الرئيسية تتصرف حسب الحالة
Route::get('/', function () {
    if (!Auth::check()) {
        // المستخدم مش مسجل دخول → روح على login
        return redirect()->route('auth.login');
    }

    // لو داخل، شوف نوعه
    $user = Auth::user();

    if ($user->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }

    return redirect()->route('home.index');
});

<?php

namespace Modules\Dashboard\app\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $totalUsers = User::count();
        $totalCategories = Category::count();
        $totalProducts = Product::count();
        // $totalOrders = Order::count();

        return view('dashboard::index', compact( 'totalCategories','$totalProducts'));
    }
}

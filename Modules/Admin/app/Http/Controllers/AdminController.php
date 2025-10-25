<?php

namespace Modules\Admin\app\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use Illuminate\Routing\Controller;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin::index');
    }

    public function users()
    {
        $users = User::latest()->paginate(10);
        return view('admin::users', compact('users'));
    }

    public function products()
    {
        $products = Product::latest()->paginate(10);
        return view('admin::products', compact('products'));
    }  

    public function orders()
    {
        $orders = Order::latest()->paginate(10);
        return view('admin::orders', compact('orders'));
    }

    public function categories()
    {
        $categories = Category::latest()->paginate(10);
        return view('admin::categories', compact('categories'));
    }



}

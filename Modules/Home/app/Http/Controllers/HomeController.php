<?php

namespace Modules\Home\app\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $products   = Product::latest()->take(4)->get();

        return view('home::index', compact('categories', 'products'));
    }

    public function category($id)
    {
        $category = Category::find($id);

        if (!$category) {
            return redirect()->route('home.index')->with('error', 'Category not found.');
        }

        $products = Product::where('category_id', $id)->get();

        return view('home::category', compact('category', 'products'));
    }

    public function products(Request $request)
    {
        $query = Product::query();

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }
        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        if ($request->filled('sort')) {
            switch ($request->sort) {
                case 'price_asc':
                    $query->orderBy('price', 'asc');
                    break;
                case 'price_desc':
                    $query->orderBy('price', 'desc');
                    break;
                case 'latest':
                    $query->orderBy('created_at', 'desc');
                    break;
            }
        } else {
            $query->latest();
        }

        $products = $query->paginate(12);
        $categories = Category::all();

        if ($request->ajax()) {
            return view('home::partials.product_grid', compact('products'))->render();
        }

        return view('home::products', compact('products', 'categories'));
    }

    public function product($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return redirect()->route('home.index')->with('error', 'Product not found.');
        }

        return view('home::product', compact('product'));
    }

    public function showOrderForm($id)
    {
        if (!Auth::check()) {
            return redirect()->route('auth.login')->with('error', 'Please login to continue.');
        }

        $product = Product::find($id);
        if (!$product) {
            return redirect()->route('home.index')->with('error', 'Product not found.');
        }

        return view('home::order', compact('product'));
    }

}

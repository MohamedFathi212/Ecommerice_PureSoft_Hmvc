<?php

namespace Modules\Cart\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;


class CartController extends Controller
{

    public function index()
    {
        $cart = session()->get('cart', []);
        $total = !empty($cart) ? collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']) : 0;
        return view('cart::index', compact('cart', 'total'));
    }

    public function addToCart($id)
    {
        $product = Product::findOrFail($id);
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                'name' => $product->name,
                'quantity' => 1,
                'price' => $product->price,
                'image' => $product->image,
            ];
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', ' Product added to cart successfully!');
    }
    public function updateCart(Request $request)
    {
        $cart = session()->get('cart', []);
        $quantities = $request->input('quantity', []);

        foreach ($quantities as $id => $qty) {
            if (isset($cart[$id])) {
                $qty = (int) $qty;
                if ($qty <= 0) {
                    unset($cart[$id]);
                } else {
                    $cart[$id]['quantity'] = $qty;
                }
            }
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', ' Cart updated successfully!');
    }

    public function removeFromCart($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }
        return redirect()->back()->with('success', ' Item removed from cart!');
    }

    public function checkout()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty!');
        }

        $total = collect($cart)->sum(function ($item) {
            return ($item['price'] ?? 0) * ($item['quantity'] ?? 0);
        });

        return view('cart::checkout', compact('cart', 'total'));
    }


    public function placeOrder(Request $request)
    {
        $cart = session()->get('cart', []);
    
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty!');
        }
    
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'address' => 'required|string|max:500',
            'payment_method' => 'required|string',
        ]);
    
        $total = collect($cart)->sum(fn($it) => ($it['price'] ?? 0) * ($it['quantity'] ?? 0));
    
        $order = Order::create([
            'user_id' => Auth::id(),            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'payment_method' => $request->payment_method,
            'total' => $total,
            'status' => 'pending',
        ]);
    
        foreach ($cart as $productId => $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $productId,
                'product_name' => $item['name'],
                'price' => $item['price'],
                'quantity' => $item['quantity'],
                'subtotal' => $item['price'] * $item['quantity'],
            ]);
        }
        session()->forget('cart');
        return redirect()->route('home.index')->with('success', ' Order placed successfully and saved to database!');
    }
    
    public function clearCart()
    {
        session()->forget('cart');
        return redirect()->back()->with('success', ' Cart cleared!');
    }
}

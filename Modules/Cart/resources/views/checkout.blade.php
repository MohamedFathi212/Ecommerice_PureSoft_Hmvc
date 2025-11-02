@extends('home::layouts.app')

@section('title', 'Checkout')

@section('content')
<div class="container py-5">

    {{-- Title --}}
    <div class="text-center mb-5">
        <h1 class="fw-bold text-gradient">
            <i class="fa-solid fa-credit-card me-2"></i> Checkout
        </h1>
        <p class="text-muted">Confirm your order and complete your purchase</p>
    </div>

    {{-- If Cart Empty --}}
    @if(empty($cart))
    <div class="text-center bg-light shadow-sm rounded-4 py-5">
        <i class="fa-solid fa-cart-arrow-down fa-3x text-muted mb-3"></i>
        <h4 class="fw-semibold text-muted">Your cart is empty.</h4>
        <a href="{{ route('home.index') }}" class="btn btn-primary rounded-pill mt-3 shadow-sm">
            <i class="fa-solid fa-store me-2"></i> Go Shopping
        </a>
    </div>
    @else
    {{-- Order Summary + Billing Form --}}
    <div class="row g-4">
        {{-- Order Summary --}}
        <div class="col-lg-7">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header bg-gradient text-white fw-bold text-center py-3"
                    style="background: linear-gradient(90deg, #007bff, #00bcd4);">
                    Order Summary
                </div>
                <div class="card-body">
                    <table class="table align-middle">
                        <thead class="table-light text-center">
                            <tr>
                                <th>Product</th>
                                <th>Qty</th>
                                <th>Price</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $grandTotal = 0; @endphp
                            @foreach($cart as $id => $item)
                            @php 
                                $subtotal = $item['price'] * $item['quantity']; 
                                $grandTotal += $subtotal; 
                            @endphp
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="{{ asset('uploads/products/'.$item['image']) }}"
                                            width="60" class="rounded-3 me-3 shadow-sm" alt="{{ $item['name'] }}">
                                        <span class="fw-semibold">{{ $item['name'] }}</span>
                                    </div>
                                </td>
                                <td class="text-center">{{ $item['quantity'] }}</td>
                                <td class="text-center">${{ number_format($item['price'], 2) }}</td>
                                <td class="text-center text-primary fw-bold">${{ number_format($subtotal, 2) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{-- Total --}}
                    <div class="d-flex justify-content-end border-top pt-3">
                        <h5 class="fw-bold">
                            Total: <span class="text-success">${{ number_format($grandTotal, 2) }}</span>
                        </h5>
                    </div>
                </div>
            </div>
        </div>

        {{-- Checkout Form --}}
        <div class="col-lg-5">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header bg-gradient text-white fw-bold text-center py-3"
                    style="background: linear-gradient(90deg, #007bff, #00bcd4);">
                    Billing Details
                </div>
                <div class="card-body">
                    <form action="{{ route('cart.placeOrder') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Full Name</label>
                            <input type="text" name="name" value="{{ old('name', Auth::user()->name ?? '') }}"
                                class="form-control rounded-pill shadow-sm" placeholder="Enter your name" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Email</label>
                            <input type="email" name="email" value="{{ old('email', Auth::user()->email ?? '') }}"
                                class="form-control rounded-pill shadow-sm" placeholder="Enter your email" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Address</label>
                            <input type="text" name="address" class="form-control rounded-pill shadow-sm"
                                placeholder="Enter your address" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Payment Method</label>
                            <select name="payment_method" class="form-select rounded-pill shadow-sm" required>
                                <option value="Cash on Delivery" selected>Cash on Delivery</option>
                                <option value="Credit / Debit Card">Credit / Debit Card</option>
                                <option value="PayPal">PayPal</option>
                            </select>
                        </div>

                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-success rounded-pill px-5 shadow-sm">
                                <i class="fa-solid fa-lock me-2"></i> Confirm & Pay
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>

{{-- Custom Styling --}}
<style>
    .text-gradient {
        background: linear-gradient(90deg, #007bff, #00bcd4);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }
</style>
@endsection

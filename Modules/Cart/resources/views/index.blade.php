@extends('home::layouts.app')

@section('title', 'My Cart')

@section('content')
<div class="container py-5">

    {{-- Title --}}
    <div class="text-center mb-5">
        <h1 class="fw-bold text-gradient">
            <i class="fa-solid fa-cart-shopping me-2"></i> Shopping Cart
        </h1>
        <p class="text-muted">Review your selected products before checkout</p>
    </div>

    {{-- Success & Error Alerts --}}
    @if(session('success'))
    <div class="alert alert-success text-center shadow-sm rounded-pill">{{ session('success') }}</div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger text-center shadow-sm rounded-pill">{{ session('error') }}</div>
    @endif

    {{-- If Cart is Not Empty --}}
    @if(!empty($cart))
    <form action="{{ route('cart.update') }}" method="POST">
        @csrf

        <div class="table-responsive shadow-lg rounded-4 overflow-hidden bg-white">
            <table class="table align-middle mb-0">
                <thead class="bg-gradient text-white text-center" style="background: linear-gradient(90deg, #007bff, #00bcd4);">
                    <tr>
                        <th>Product</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cart as $id => $item)
                    <tr class="align-middle">
                        <td class="text-center">
                            <img src="{{ asset('uploads/products/'.$item['image']) }}"
                                alt="{{ $item['name'] }}"
                                class="rounded-4 shadow-sm" width="80" height="80" style="object-fit: cover;">
                        </td>
                        <td class="fw-semibold text-center">{{ $item['name'] }}</td>
                        <td class="text-center text-success fw-bold">${{ number_format($item['price'], 2) }}</td>
                        <td class="text-center">
                            <input type="number" name="quantity[{{ $id }}]"
                                value="{{ $item['quantity'] }}" min="1"
                                class="form-control text-center mx-auto rounded-pill shadow-sm w-50">
                        </td>
                        <td class="text-center fw-semibold text-primary">
                            ${{ number_format($item['price'] * $item['quantity'], 2) }}
                        </td>
                        <td class="text-center">
                            <a href="{{ route('cart.remove', $id) }}"
                                class="btn btn-sm btn-danger rounded-pill shadow-sm px-3">
                                <i class="fa-solid fa-trash"></i>
                                Remove
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Footer Buttons --}}
        <div class="d-flex flex-wrap justify-content-between align-items-center mt-4">

            <a href="{{ route('home.index') }}" class="btn btn-outline-primary rounded-pill px-4 mb-2 mb-md-0 shadow-sm">
                <i class="fa-solid fa-store me-2"></i> Continue Shopping
            </a>

            <div class="text-end mt-3">
                <h4 class="text-end mb-3 fw-bold">Total: ${{ number_format($total ?? 0, 2) }}</h4>
                <a href="{{ route('cart.clear') }}"
                    class="btn btn-outline-danger rounded-pill px-4 me-2 shadow-sm"
                    onclick="return confirm('Are you sure you want to clear the entire cart?');">
                    <i class="fa-solid fa-trash-can me-1"></i> Clear Cart
                </a>
                <button type="submit" class="btn btn-outline-info rounded-pill px-4 me-2 shadow-sm">
                    <i class="fa-solid fa-rotate me-1"></i> Update Cart
                </button>
                <a href="{{ route('cart.checkout') }}" class="btn btn-success rounded-pill px-5 shadow-sm">
                    <i class="fa-solid fa-credit-card me-2"></i> Checkout
                </a>
            </div>

        </div>
    </form>
    @else
    {{-- Empty Cart --}}
    <div class="text-center mt-5 p-5 rounded-4 shadow-sm bg-light">
        <i class="fa-solid fa-cart-arrow-down fa-3x text-muted mb-3"></i>
        <h4 class="fw-semibold text-muted">Your cart is empty</h4>
        <p class="text-secondary">Start adding some products to your cart!</p>
        <a href="{{ route('home.index') }}" class="btn btn-primary rounded-pill px-4 mt-3 shadow-sm">
            <i class="fa-solid fa-store me-2"></i> Go Shopping
        </a>
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

    .bg-gradient {
        background: linear-gradient(90deg, #007bff, #00bcd4) !important;
    }

    .table thead th {
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
</style>
@endsection
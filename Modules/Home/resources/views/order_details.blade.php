@extends('home::layouts.app')

@section('title', 'Order Details')

@section('content')
<div class="container py-5">
    <h1 class="fw-bold text-center text-gradient mb-5">
        <i class="fa-solid fa-file-invoice me-2"></i> Order #{{ $order->id }} Details
    </h1>

    {{-- ✅ معلومات الطلب --}}
    <div class="card shadow-lg border-0 rounded-4 mb-4">
        <div class="card-header text-white fw-bold"
             style="background: linear-gradient(90deg, #007bff, #00bcd4);">
            <i class="fa-solid fa-circle-info me-2"></i> Order Information
        </div>
        <div class="card-body">
            <p><strong>Placed On:</strong> {{ $order->created_at->format('Y-m-d H:i') }}</p>
            <p><strong>Status:</strong>
                @if($order->status == 'pending')
                    <span class="badge bg-warning text-dark rounded-pill">Pending</span>
                @elseif($order->status == 'completed')
                    <span class="badge bg-success rounded-pill">Completed</span>
                @else
                    <span class="badge bg-danger rounded-pill">Cancelled</span>
                @endif
            </p>
            <p><strong>Payment Method:</strong> {{ $order->payment_method ?? 'Not specified' }}</p>
            <p><strong>Total Amount:</strong> <span class="text-success fw-bold">${{ number_format($order->total, 2) }}</span></p>
        </div>
    </div>

    {{-- ✅ تفاصيل المنتجات داخل الطلب --}}
    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-header text-white fw-bold"
             style="background: linear-gradient(90deg, #007bff, #00bcd4);">
            <i class="fa-solid fa-box me-2"></i> Ordered Items
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table align-middle text-center">
                    <thead class="table-light">
                        <tr>
                            <th>Product</th>
                            <th>Name</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->items as $item)
                            <tr>
                                <td>
                                    @if($item->product && $item->product->image)
                                        <img src="{{ asset('uploads/products/'.$item->product->image) }}"
                                             width="70" class="rounded-3 shadow-sm" alt="">
                                    @else
                                        <i class="fa-solid fa-box text-muted fa-2x"></i>
                                    @endif
                                </td>
                                <td>{{ $item->product->name ?? 'Deleted Product' }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>${{ number_format($item->price, 2) }}</td>
                                <td class="fw-bold text-primary">
                                    ${{ number_format($item->price * $item->quantity, 2) }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="text-center mt-4">
        <a href="{{ route('orders') }}" class="btn btn-outline-primary rounded-pill px-4 shadow-sm">
            <i class="fa-solid fa-arrow-left me-2"></i> Back to My Orders
        </a>
    </div>
</div>

<style>
.text-gradient {
    background: linear-gradient(90deg, #007bff, #00bcd4);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}
</style>
@endsection

@extends('dashboard::layouts.app')
@section('title', 'Order Details')

@section('content')
<div class="container-fluid py-4">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-primary">
            <i class="fa-solid fa-file-invoice-dollar me-2"></i>
            Order #{{ $order->id }} Details
        </h2>
        <a href="{{ route('orders.index') }}" class="btn btn-outline-secondary btn-sm">
            <i class="fa-solid fa-arrow-left me-1"></i> Back to Orders
        </a>
    </div>

    {{-- Order Summary Card --}}
    <div class="card shadow-sm border-0 rounded-4 mb-4">
        <div class="card-header bg-primary text-white">
            <i class="fa-solid fa-circle-info me-2"></i> Order Summary
        </div>
        <div class="card-body">
            <div class="row g-4">
                <div class="col-md-4">
                    <h6 class="text-muted mb-1"><i class="fa-solid fa-user me-2"></i>Customer</h6>
                    <p class="fw-semibold">{{ $order->user->name ?? 'Guest' }}</p>
                </div>
                <div class="col-md-4">
                    <h6 class="text-muted mb-1"><i class="fa-solid fa-envelope me-2"></i>Email</h6>
                    <p>{{ $order->user->email ?? 'N/A' }}</p>
                </div>
                <div class="col-md-4">
                    <h6 class="text-muted mb-1"><i class="fa-solid fa-calendar me-2"></i>Order Date</h6>
                    <p>{{ $order->created_at->format('d M, Y h:i A') }}</p>
                </div>

                <div class="col-md-4">
                    <h6 class="text-muted mb-1"><i class="fa-solid fa-money-bill-wave me-2"></i>Payment Method</h6>
                    <p>{{ ucfirst($order->payment_method ?? 'N/A') }}</p>
                </div>
                <div class="col-md-4">
                    <h6 class="text-muted mb-1"><i class="fa-solid fa-tags me-2"></i>Status</h6>
                    @php
                        $badgeClass = match($order->status) {
                            'completed' => 'success',
                            'cancelled' => 'danger',
                            'pending' => 'warning',
                            default => 'secondary'
                        };
                    @endphp
                    <span class="badge bg-{{ $badgeClass }} px-3 py-2">{{ ucfirst($order->status) }}</span>
                </div>
                <div class="col-md-4">
                    <h6 class="text-muted mb-1"><i class="fa-solid fa-dollar-sign me-2"></i>Total</h6>
                    <p class="fw-bold text-success fs-5">${{ number_format($order->total, 2) }}</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Order Items Table --}}
    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-header bg-secondary text-white">
            <i class="fa-solid fa-box me-2"></i> Order Items
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Unit Price</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($order->items as $item)
                            <tr>
                                <td>{{ $item->product->name ?? '-' }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>${{ number_format($item->price, 2) }}</td>
                                <td class="fw-bold text-success">
                                    ${{ number_format($item->price * $item->quantity, 2) }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-4 text-muted">
                                    <i class="fa-solid fa-box-open fa-2x mb-2"></i>
                                    <p>No items in this order</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection

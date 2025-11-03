@extends('home::layouts.app')

@section('title', 'My Orders')

@section('content')
<div class="container py-5">
    <h1 class="fw-bold text-center text-gradient mb-5">
        <i class="fa-solid fa-receipt me-2"></i> My Orders
    </h1>

    {{-- ✅ رسالة النجاح --}}
    @if(session('success'))
        <div class="alert alert-success text-center rounded-pill shadow-sm">
            {{ session('success') }}
        </div>
    @endif

    {{-- ✅ في حالة مفيش طلبات --}}
    @if($orders->isEmpty())
        <div class="text-center mt-5 p-5 rounded-4 shadow-sm bg-light">
            <i class="fa-solid fa-box-open fa-3x text-muted mb-3"></i>
            <h4 class="fw-semibold text-muted">You haven’t placed any orders yet.</h4>
            <a href="{{ route('home.index') }}" class="btn btn-primary rounded-pill mt-3 px-4 shadow-sm">
                <i class="fa-solid fa-store me-2"></i> Start Shopping
            </a>
        </div>
    @else
        {{-- ✅ في حالة وجود طلبات --}}
        <div class="table-responsive shadow-lg rounded-4 bg-white">
            <table class="table table-striped align-middle mb-0">
                <thead class="text-center text-white"
                       style="background: linear-gradient(90deg, #007bff, #00bcd4);">
                    <tr>
                        <th>#</th>
                        <th>Date</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Payment</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                        <tr class="text-center">
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->created_at->format('Y-m-d H:i') }}</td>
                            <td class="fw-bold text-success">${{ number_format($order->total, 2) }}</td>
                            <td>
                                @if($order->status == 'pending')
                                    <span class="badge bg-warning text-dark rounded-pill">Pending</span>
                                @elseif($order->status == 'completed')
                                    <span class="badge bg-success rounded-pill">Completed</span>
                                @else
                                    <span class="badge bg-danger rounded-pill">Cancelled</span>
                                @endif
                            </td>
                            <td>{{ ucfirst(str_replace('_', ' ', $order->payment_method)) }}</td>
                            <td>
                                <a href="{{ route('order', $order->id) }}"
                                   class="btn btn-sm btn-outline-primary rounded-pill shadow-sm">
                                    <i class="fa-solid fa-eye me-1"></i> View
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>

<style>
.text-gradient {
    background: linear-gradient(90deg, #007bff, #00bcd4);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}
</style>
@endsection

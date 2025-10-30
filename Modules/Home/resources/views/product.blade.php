@extends('home::layouts.app')

@section('title', $product->name ?? 'Product Details')

@section('content')
<div class="container py-5">
    @if(isset($product))
        <div class="row align-items-center g-5">
            {{-- 🖼️ صورة المنتج --}}
            <div class="col-md-6 text-center">
                <div class="position-relative">
                    <img src="{{ asset('uploads/products/'.$product->image) }}" 
                         class="img-fluid rounded-4 shadow-sm" 
                         alt="{{ $product->name }}" 
                         style="max-height: 420px; object-fit: cover;">
                    <span class="badge bg-success position-absolute top-0 end-0 m-3 fs-6 px-3 py-2">
                        ${{ number_format($product->price, 2) }}
                    </span>
                </div>
            </div>

            {{-- 📄 تفاصيل المنتج --}}
            <div class="col-md-6">
                <h1 class="fw-bold text-primary mb-3">{{ $product->name }}</h1>
                <p class="text-muted fs-5 mb-4">{{ $product->description }}</p>

                <div class="d-flex align-items-center mb-4">
                    <h3 class="text-success fw-bold me-3 mb-0">
                        ${{ number_format($product->price, 2) }}
                    </h3>
                    <span class="text-muted">Inclusive of all taxes</span>
                </div>

                {{-- ✅ زر الطلب --}}
                <form action="{{ route('home.order', $product->id) }}" method="POST" class="mb-3">
                    @csrf
                    <button class="btn btn-lg btn-success w-100 rounded-pill shadow-sm">
                        <i class="fa-solid fa-cart-shopping me-2"></i> Order Now
                    </button>
                </form>

                {{-- ❤️ روابط إضافية --}}
                <div class="d-flex justify-content-between mt-3">
                    <a href="{{ url()->previous() }}" class="btn btn-outline-secondary rounded-pill px-4">
                        <i class="fa-solid fa-arrow-left me-2"></i> Back
                    </a>
                    <a href="{{ route('home.index') }}" class="btn btn-outline-primary rounded-pill px-4">
                        <i class="fa-solid fa-store me-2"></i> Continue Shopping
                    </a>
                </div>
            </div>
        </div>

        {{-- ✨ قسم منتجات مشابهة --}}
        <div class="mt-5">
            <h4 class="fw-bold mb-4 text-center text-secondary">You may also like</h4>
            <div class="row g-4">
                @foreach(\App\Models\Product::where('category_id', $product->category_id)->where('id', '!=', $product->id)->take(4)->get() as $related)
                    <div class="col-md-3">
                        <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden">
                            <img src="{{ asset('uploads/products/'.$related->image) }}" 
                                 class="card-img-top" 
                                 alt="{{ $related->name }}" 
                                 style="height: 220px; object-fit: cover;">
                            <div class="card-body text-center">
                                <h6 class="fw-bold">{{ $related->name }}</h6>
                                <p class="text-success fw-semibold mb-2">${{ number_format($related->price, 2) }}</p>
                                <a href="{{ route('home.product', $related->id) }}" 
                                   class="btn btn-sm btn-outline-primary rounded-pill w-100">
                                    View Details
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

    @else
        <div class="alert alert-warning text-center py-4 rounded-3 shadow-sm">
            <i class="fa-solid fa-triangle-exclamation me-2"></i> Product not found.
        </div>
    @endif
</div>
@endsection

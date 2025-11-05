@if($products->count())
    <div class="row g-4">
        @foreach($products as $product)
            <div class="col-md-3">
                <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden hover-shadow">
                    <img src="{{ asset('uploads/products/'.$product->image) }}" 
                         class="card-img-top" 
                         alt="{{ $product->name }}" 
                         style="height: 220px; object-fit: cover;">
                    <div class="card-body text-center">
                        <h6 class="fw-bold text-dark mb-2">{{ $product->name }}</h6>
                        <p class="text-success fw-semibold mb-3">${{ number_format($product->price, 2) }}</p>
                        <a href="{{ route('home.product', $product->id) }}" 
                           class="btn btn-sm btn-outline-primary rounded-pill w-100">
                            <i class="fa-solid fa-eye me-1"></i> View Details
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="mt-5 d-flex justify-content-center">
        {{ $products->withQueryString()->links() }}
    </div>
@else
    <div class="alert alert-warning text-center py-4 rounded-3 shadow-sm">
        <i class="fa-solid fa-box-open me-2"></i> No products found.
    </div>
@endif

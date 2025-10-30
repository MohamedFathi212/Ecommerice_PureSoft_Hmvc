@extends('home::layouts.app')

@section('title', $category->name ?? 'Category')

@section('content')
<div class="container py-5">
    @if(isset($category))
        {{-- 🏷️ Header --}}
        <div class="text-center mb-5">
            <h2 class="fw-bold text-primary display-6">{{ $category->name }}</h2>
            <p class="text-muted fs-5">Find the perfect {{ strtolower($category->name) }} for your needs.</p>
            <hr class="w-25 mx-auto border-primary opacity-75">
        </div>

        <div class="row">
            {{-- 🛍️ Products --}}
            <div class="col-md-9">
                <div class="row g-4">
                    @forelse($products as $p)
                        <div class="col-6 col-md-4">
                            <div class="card h-100 shadow-sm border-0 rounded-4 overflow-hidden product-card">
                                <div class="position-relative">
                                    <img src="{{ asset('uploads/products/'.$p->image) }}" 
                                         class="card-img-top" alt="{{ $p->name }}" 
                                         style="height:230px;object-fit:cover;transition:transform .4s;">
                                    <span class="badge bg-success position-absolute top-0 end-0 m-2 px-2 py-1">
                                        ${{ number_format($p->price, 2) }}
                                    </span>
                                </div>
                                <div class="card-body text-center d-flex flex-column">
                                    <h6 class="fw-bold">{{ $p->name }}</h6>
                                    <a href="{{ route('home.product', $p->id) }}" 
                                       class="btn btn-outline-primary btn-sm mt-auto rounded-pill">
                                        <i class="fa-solid fa-eye me-1"></i> View Details
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center mt-4">
                            <div class="alert alert-info w-75 mx-auto rounded-3 shadow-sm">
                                <i class="fa-solid fa-box-open me-2"></i> No products match your filters.
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    @else
        <div class="alert alert-warning text-center mt-5">
            <i class="fa-solid fa-triangle-exclamation me-2"></i> Category not found.
        </div>
    @endif
</div>

{{-- ✨ Hover + Animation --}}
<style>
    .product-card:hover img { transform: scale(1.08); }
    .product-card:hover { box-shadow: 0 8px 20px rgba(0,0,0,0.1); transform: translateY(-4px); transition: all 0.3s ease; }
</style>
@endsection

@extends('home::layouts.app')

@section('title', 'All Products')

@section('content')
<div class="container py-5">
    <h1 class="fw-bold text-center text-primary mb-5">Our Products</h1>

    <form id="filterForm" class="mb-5 bg-light p-4 rounded-4 shadow-sm">
        <div class="row g-3 align-items-end">
            <div class="col-md-3">
                <label class="form-label fw-semibold">Search</label>
                <input type="text" name="search" value="{{ request('search') }}" class="form-control"
                    placeholder="Product name">
            </div>

            <div class="col-md-3">
                <label class="form-label fw-semibold">Category</label>
                <select name="category_id" class="form-select">
                    <option value="">All Categories</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-2">
                <label class="form-label fw-semibold">Min Price</label>
                <input type="number" name="min_price" value="{{ request('min_price') }}" class="form-control" min="0" step="0.01">
            </div>

            <div class="col-md-2">
                <label class="form-label fw-semibold">Max Price</label>
                <input type="number" name="max_price" value="{{ request('max_price') }}" class="form-control" min="0" step="0.01">
            </div>

            <div class="col-md-2">
                <label class="form-label fw-semibold">Sort By</label>
                <select name="sort" class="form-select">
                    <option value="">Default</option>
                    <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Price: Low to High</option>
                    <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Price: High to Low</option>
                    <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Newest</option>
                </select>
            </div>
        </div>
    </form>

    <!-- Product List -->
    <div id="productList">
        @include('home::partials.product_grid', ['products' => $products])
    </div>
</div>
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function () {

    function fetchProducts(url = "{{ route('home.products') }}") {
        let formData = $('#filterForm').serialize();

        $.ajax({
            url: url,
            type: 'GET',
            data: formData,
            beforeSend: function () {
                $('#productList').html('<div class="text-center py-5"><div class="spinner-border text-primary"></div></div>');
            },
            success: function (response) {
                $('#productList').html(response.html);
                window.history.pushState({}, '', url + '?' + formData);
            },
            error: function (xhr) {
                console.error(xhr.responseText);
                alert('Error fetching products.');
            }
        });
    }

    $('#filterForm input, #filterForm select').on('input change', function () {
        fetchProducts();
    });

    $(document).on('click', '.pagination a', function (e) {
        e.preventDefault();
        let url = $(this).attr('href');
        fetchProducts(url);
    });
});
</script>
@endsection

@extends('home::layouts.app')

@section('title', 'Welcome to MyStore')

@section('content')
    <!-- 🔹 Hero Section -->
    <section class="hero text-center text-white d-flex align-items-center justify-content-center" 
             style="background: linear-gradient(135deg, #6a11cb, #2575fc); height: 50vh;">
        <div>
            <h1 class="fw-bold">Welcome to MyStore</h1>
            <p class="lead mb-4">Discover premium products tailored just for you!</p>
            <a href="{{ route('home.products') }}" class="btn btn-light btn-lg rounded-pill shadow-sm">
                <i class="fa-solid fa-arrow-down"></i> Browse Products
            </a>
        </div>
    </section>

    <!-- 🔹 Categories Section -->
    <section class="container py-5">
        <h3 class="mb-4 text-center text-primary fw-bold">Shop by Category</h3>
        <div class="d-flex flex-wrap justify-content-center gap-3">
            @foreach($categories as $cat)
                <a href="{{ route('home.category', $cat->id) }}" 
                   class="btn btn-outline-primary px-4 py-2 rounded-pill shadow-sm">
                    {{ $cat->name }}
                </a>
            @endforeach
        </div>
    </section>

    <!-- 🔹 Products Section -->
    <section id="products" class="container py-5">
        <h3 class="mb-4 text-center text-success fw-bold">Latest Arrivals</h3>
        <div class="row g-4">
            @foreach($products as $p)
                <div class="col-md-3">
                    <div class="card h-100 shadow-sm border-0 rounded-4 overflow-hidden">
                        <div class="position-relative">
                            <img src="{{ asset('uploads/products/'.$p->image) }}" 
                                 class="card-img-top" 
                                 alt="{{ $p->name }}" 
                                 style="height:230px;object-fit:cover;">
                            <div class="position-absolute top-0 end-0 bg-primary text-white px-2 py-1 small rounded-start">
                                ${{ number_format($p->price, 2) }}
                            </div>
                        </div>
                        <div class="card-body text-center d-flex flex-column">
                            <h6 class="fw-bold">{{ $p->name }}</h6>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <!-- 🔹 Contact Us Section (Luxury Style) -->
    <section id="contact" class="py-5" 
             style="background: linear-gradient(135deg, #1f1c2c, #928DAB); color: #fff;">
        <div class="container">
            <div class="text-center mb-5">
                <h3 class="fw-bold display-6 mb-3" style="letter-spacing: 1px;">Get in Touch</h3>
                <p class="text-light opacity-75 fs-5">We’d love to hear from you — let’s build something great together!</p>
            </div>

            <div class="row justify-content-center align-items-center">
                <div class="col-lg-8">
                    <div class="card border-0 shadow-lg rounded-4" 
                         style="background: rgba(255, 255, 255, 0.1); backdrop-filter: blur(10px);">
                        <div class="card-body p-4 p-md-5">
                            <form action="#" method="POST">
                                @csrf
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold text-white">Full Name</label>
                                        <input type="text" name="name" class="form-control rounded-pill border-0 shadow-sm" 
                                               placeholder="Enter your name" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold text-white">Email Address</label>
                                        <input type="email" name="email" class="form-control rounded-pill border-0 shadow-sm" 
                                               placeholder="Enter your email" required>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label fw-semibold text-white">Message</label>
                                        <textarea name="message" rows="4" class="form-control rounded-4 border-0 shadow-sm" 
                                                  placeholder="Write your message here..." required></textarea>
                                    </div>
                                </div>

                                <div class="text-center mt-4">
                                    <button type="submit" class="btn btn-lg px-5 rounded-pill shadow-sm" 
                                            style="background: linear-gradient(90deg, #6a11cb, #2575fc); color: #fff;">
                                        <i class="fa-solid fa-paper-plane me-2"></i> Send Message
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="text-center mt-5">
                        <div class="d-flex flex-column flex-md-row justify-content-center gap-4">
                            <p class="mb-0">
                                <i class="fa-solid fa-envelope text-info me-2"></i> mohamedfathymo66@gmail.com
                            </p>
                            <p class="mb-0">
                                <i class="fa-solid fa-phone text-info me-2"></i> +20 1142423466
                            </p>
                            <p class="mb-0">
                                <i class="fa-solid fa-location-dot text-info me-2"></i> Cairo, Egypt
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

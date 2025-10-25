@extends('dashboard::layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="container-fluid">

    <!-- Title Section -->
    <div class="mb-4">
        <h2 class="fw-bold">Welcome back, {{ Auth::user()->name ?? 'Admin' }} </h2>
        <p class="text-muted">Here’s what’s happening in your store today.</p>
    </div>

    <!-- Stats Cards -->
    <div class="row g-4">

        <div class="col-md-3">
            <div class="card shadow-sm border-0 rounded-3 p-3 bg-primary text-white">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h5>Total Users</h5>
                        <h3>0</h3>
                    </div>
                    <i class="fa-solid fa-users fa-2x"></i>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm border-0 rounded-3 p-3 bg-success text-white">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h5>Products</h5>
                        <h3>0</h3>
                    </div>
                    <i class="fa-solid fa-box fa-2x"></i>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm border-0 rounded-3 p-3 bg-warning text-dark">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h5>Categories</h5>
                        <h3>{{ $totalCategories }}</h3>
                    </div>
                    <i class="fa-solid fa-layer-group fa-2x"></i>
                    </div>
            </div>
        </div>


        <div class="col-md-3">
            <div class="card shadow-sm border-0 rounded-3 p-3 bg-warning text-dark">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h5>Orders</h5>
                        <h3>0</h3>
                    </div>
                    <i class="fa-solid fa-cart-shopping fa-2x"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="row mt-5">
        <div class="col-lg-8">
            <div class="card shadow-sm border-0 rounded-3 p-4">
                <h5 class="fw-bold mb-3">Sales Overview</h5>
                <canvas id="salesChart" height="150"></canvas>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card shadow-sm border-0 rounded-3 p-4">
                <h5 class="fw-bold mb-3">Recent Activities</h5>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"> New order received from John</li>
                    <li class="list-group-item"> New user registered: {{auth()->user()->name}}</li>
                    <li class="list-group-item"> Product “Wireless Headphones” updated</li>
                    <li class="list-group-item"> Payment of $240 processed</li>
                </ul>
            </div>
        </div>
    </div>

</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('salesChart');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
            datasets: [{
                label: 'Sales ($)',
                data: [1200, 1500, 1800, 2200, 2600, 3000],
                borderWidth: 3,
                borderColor: '#0d6efd',
                backgroundColor: 'rgba(13,110,253,0.2)',
                fill: true,
                tension: 0.3
            }]
        },
        options: {
            scales: { y: { beginAtZero: true } },
            plugins: { legend: { display: false } }
        }
    });
</script>
@endsection

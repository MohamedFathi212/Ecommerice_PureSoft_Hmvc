@extends('layouts.app')
@section('title', 'Admin Panel')
@section('content')

<div class="container-fluid">
    <h2 class="fw-bold mb-4">Admin Control Panel</h2>

    <div class="row g-4">
        <div class="col-md-4">
            <a href="{{ route('admin.users') }}" class="text-decoration-none">
                <div class="card shadow-sm border-0 p-4 text-center">
                    <i class="fa-solid fa-users fa-2x text-primary mb-2"></i>
                    <h5>Manage Users</h5>
                </div>
            </a>
        </div>

        <div class="col-md-4">
            <a href="{{ route('admin.products') }}" class="text-decoration-none">
                <div class="card shadow-sm border-0 p-4 text-center">
                    <i class="fa-solid fa-box fa-2x text-success mb-2"></i>
                    <h5>Manage Products</h5>
                </div>
            </a>
        </div>
        <div class="col-md-4">
            <a href="{{ route('admin.categories') }}" class="text-decoration-none">
                <div class="card shadow-sm border-0 p-4 text-center">
                <i class="fa-solid fa-layer-group fa-2x"></i>
                <h5>Manage Categories</h5>
                </div>
            </a>
        </div>

    </div>
</div>

@endsection

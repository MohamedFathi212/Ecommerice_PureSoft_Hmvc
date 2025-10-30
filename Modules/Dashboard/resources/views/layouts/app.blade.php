<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Admin Dashboard')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f6f9;
        }

        .sidebar {
            width: 250px;
            height: 100vh;
            background-color: #212529;
            position: fixed;
            top: 0;
            left: 0;
            color: white;
            transition: all 0.3s;
        }

        .sidebar .brand {
            font-size: 1.4rem;
            font-weight: bold;
            padding: 20px;
            text-align: center;
            background-color: #0d6efd;
        }

        .sidebar ul {
            list-style: none;
            padding-left: 0;
            margin-top: 20px;
        }

        .sidebar ul li {
            padding: 15px 25px;
            border-left: 3px solid transparent;
        }

        .sidebar ul li a {
            color: #ddd;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .sidebar ul li:hover {
            background-color: #0d6efd;
            border-left: 3px solid white;
        }

        .sidebar ul li.active {
            background-color: #0d6efd;
            border-left: 3px solid white;
        }

        .content {
            margin-left: 250px;
            padding: 30px;
        }

        .navbar-custom {
            background-color: #fff;
            padding: 15px 30px;
            border-bottom: 1px solid #ddd;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar-custom .user-info {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .logout-btn {
            color: #dc3545;
            text-decoration: none;
            font-weight: 500;
            cursor: pointer;
        }

        .logout-btn:hover {
            text-decoration: underline;
        }

        footer {
            text-align: center;
            padding: 15px;
            color: #888;
            font-size: 0.9rem;
            border-top: 1px solid #ddd;
            margin-top: 40px;
        }
    </style>
</head>

<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="brand">
            <i class="fa-solid fa-store"></i> Admin Panel
        </div>
        <ul>
            <li class="{{ request()->is('dashboard') ? 'active' : '' }}">
                <a href="{{ route('admin.dashboard') }}"><i class="fa-solid fa-gauge"></i> Dashboard</a>
            </li>
            <li class="{{ request()->is('admin/users') ? 'active' : '' }}">
                <a href="{{ route('users.index') }}"><i class="fa-solid fa-users"></i> Users</a>
            </li>
            <li class="{{ request()->is('admin/categories') ? 'active' : '' }}">
                <a href="{{ route('categories.index') }}"><i class="fa-solid fa-layer-group"></i>Categories</a>
            </li>
            <li class="{{ request()->is('admin/products') ? 'active' : '' }}">
                <a href="{{ route('products.index') }}"><i class="fa-solid fa-box"></i> Products</a>
            </li>

            <li class="{{ request()->is('admin/orders') ? 'active' : '' }}">
                <a href="{{ route('orders.index') }}"><i class="fa-solid fa-cart-shopping"></i> Orders</a>
            </li>


        </ul>
    </div>

    <!-- Main Content -->
    <div class="content">
        <!-- Navbar -->
        <div class="navbar-custom">
            <h4>@yield('title', 'Dashboard')</h4>
            <div class="user-info">
                <i class="fa-solid fa-user-circle fa-lg"></i>
                <span>{{ Auth::user()->name ?? 'Guest' }}</span>

                <!-- Logout Form -->
                <form id="logout-form" action="{{ route('auth.logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn btn-link logout-btn p-0 m-0 align-baseline">Logout</button>
                </form>
            </div>
        </div>

        <!-- Page Body -->
        <div class="mt-4">
            @yield('content')
        </div>

        <footer>
            &copy; {{ date('Y') }} - Mohamed | All Rights Reserved.
        </footer>
    </div>

</body>

</html>
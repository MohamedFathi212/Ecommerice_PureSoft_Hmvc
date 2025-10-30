<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'MyStore | Online Shopping')</title>

    {{-- Bootstrap & Icons --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/4efb67bdf1.js" crossorigin="anonymous"></script>

    <style>
        body {
            background-color: #f8f9fa;
        }

        nav.navbar {
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        footer {
            background-color: #222;
            color: #ccc;
            padding: 30px 0;
            text-align: center;
        }

        .hero {
            background: url('{{ asset("images/banner.jpg") }}') center/cover no-repeat;
            color: #fff;
            padding: 100px 0;
            text-align: center;
            background-attachment: fixed;
        }

        .hero h1 {
            font-size: 3rem;
            font-weight: bold;
            text-shadow: 2px 2px 6px rgba(0, 0, 0, 0.4);
        }

        .hero p {
            font-size: 1.2rem;
        }
    </style>
</head>

<body>
    {{-- 🧭 Navbar --}}
    <nav class="navbar navbar-expand-lg bg-white fixed-top">
        <div class="container">
            <a class="navbar-brand text-primary fw-bold" href="{{ route('home.index') }}">
                <i class="fa-solid fa-store me-1"></i> MyStore
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="mainNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item"><a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ route('home.index') }}">Home</a></li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home.products') }}">Products</a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="#">Orders</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Contact</a></li>

                    @auth
                    <li class="nav-item">
                        <a class="nav-link fw-semibold text-success">
                            <i class="fa-solid fa-user me-1"></i> {{ Auth::user()->name }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <form method="POST" action="{{ route('auth.logout') }}">
                            @csrf
                            <button type="submit" class="btn btn-outline-danger btn-sm ms-2">
                                <i class="fa-solid fa-right-from-bracket"></i> Logout
                            </button>
                        </form>
                    </li>
                    @else
                    <li class="nav-item">
                        <a href="{{ route('auth.login') }}" class="btn btn-outline-primary btn-sm me-2">
                            <i class="fa-solid fa-right-to-bracket"></i> Login
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('auth.register') }}" class="btn btn-primary btn-sm">
                            <i class="fa-solid fa-user-plus"></i> Register
                        </a>
                    </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    {{-- ✅ Page Content --}}
    <main style="margin-top: 90px;">
        @yield('content')
    </main>

    {{-- ⚙️ Footer --}}
    <footer class="mt-5">
        <div class="container">
            <p>© {{ date('Y') }} MyStore. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
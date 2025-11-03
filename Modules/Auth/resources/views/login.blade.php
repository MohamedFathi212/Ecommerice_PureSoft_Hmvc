<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login | MyStore Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        /* خلفية متدرجة هادئة ومتحركة */
        .animated-bg {
            background: linear-gradient(-45deg, #0f172a, #1e293b, #334155, #1e40af);
            background-size: 400% 400%;
            animation: gradientShift 12s ease infinite;
        }

        @keyframes gradientShift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        /* ظل أنعم للفورم */
        .glow {
            box-shadow: 0 0 30px rgba(59, 130, 246, 0.15);
        }

        /* زر متدرج بحركة ناعمة */
        .btn-animate {
            background: linear-gradient(90deg, #2563eb, #0ea5e9);
            background-size: 200% 200%;
            animation: btnGlow 5s ease infinite;
        }

        @keyframes btnGlow {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        /* إدخال ناعم الزوايا */
        input {
            transition: all 0.3s ease;
        }

        input:focus {
            background-color: rgba(255,255,255,0.15);
            border-color: #60a5fa;
        }
    </style>
</head>

<body class="animated-bg min-h-screen flex items-center justify-center px-4 text-white">

    <!-- Login Card -->
    <div class="bg-white/10 backdrop-blur-2xl border border-white/20 rounded-3xl shadow-2xl glow p-10 w-full max-w-md transition-all transform hover:scale-[1.01] duration-300">

        <!-- Header -->
        <div class="text-center mb-8">
            <div class="mx-auto bg-gradient-to-r from-blue-500 to-cyan-400 w-16 h-16 flex items-center justify-center rounded-full mb-4 shadow-lg">
                <i class="fa-solid fa-lock text-2xl text-white"></i>
            </div>
            <h1 class="text-3xl font-bold tracking-tight text-white">Welcome Back 👋</h1>
            <p class="text-gray-300 mt-2 text-sm">Login to access your personal dashboard</p>
        </div>

        {{-- Error Messages --}}
        @if ($errors->any())
            <div class="bg-red-500/20 border border-red-500 text-red-300 px-4 py-3 rounded-lg mb-4">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        {{-- Success Message --}}
        @if (session('success'))
            <div class="bg-green-500/20 border border-green-400 text-green-300 px-4 py-3 rounded-lg mb-4">
                {{ session('success') }}
            </div>
        @endif

        <!-- Login Form -->
        <form method="POST" action="{{ route('auth.login.post') }}" class="space-y-6">
            @csrf

            <div>
                <label for="email" class="block text-gray-200 font-semibold mb-1">Email Address</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}"
                       class="w-full bg-white/10 border border-gray-600 rounded-xl px-4 py-3 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-400"
                       placeholder="Enter your email" required>
            </div>

            <div>
                <label for="password" class="block text-gray-200 font-semibold mb-1">Password</label>
                <input id="password" type="password" name="password"
                       class="w-full bg-white/10 border border-gray-600 rounded-xl px-4 py-3 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-400"
                       placeholder="Enter your password" required>
            </div>

            <div class="flex items-center justify-between text-sm">
                <label class="flex items-center text-gray-300">
                    <input type="checkbox" name="remember" class="mr-2 rounded border-gray-600 bg-transparent"> Remember me
                </label>
                <a href="#" class="text-cyan-400 hover:underline font-medium">Forgot password?</a>
            </div>

            <button type="submit"
                    class="btn-animate w-full text-white font-semibold py-3 rounded-xl shadow-lg transition-all duration-300 hover:shadow-cyan-500/30 transform hover:scale-[1.02]">
                <i class="fa-solid fa-right-to-bracket mr-2"></i> Login
            </button>
        </form>

        <p class="text-center text-gray-300 mt-6 text-sm">
            Don’t have an account?
            <a href="{{ route('auth.register') }}" class="text-cyan-400 font-semibold hover:underline">Register here</a>
        </p>
    </div>

    <!-- FontAwesome -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</body>
</html>

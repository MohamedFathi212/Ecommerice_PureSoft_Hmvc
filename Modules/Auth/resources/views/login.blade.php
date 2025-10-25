<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login | E-Commerce Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900 min-h-screen flex items-center justify-center">

    <div class="bg-gray-100 rounded-2xl shadow-2xl p-8 w-full max-w-md">
        <h2 class="text-3xl font-bold text-center text-gray-800 mb-6">Welcome Back </h2>
        <p class="text-center text-gray-500 mb-6">Sign in to your account to continue</p>

        {{-- Error Messages --}}
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        {{-- Success Message --}}
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        {{-- Login Form --}}
        <form method="POST" action="{{ route('auth.login.post') }}" class="space-y-4">
            @csrf

            <div>
                <label for="email" class="block text-gray-700 font-semibold mb-2">Email Address</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}"
                       class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                       placeholder="Enter your email" required>
            </div>

            <div>
                <label for="password" class="block text-gray-700 font-semibold mb-2">Password</label>
                <input id="password" type="password" name="password"
                       class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                       placeholder="Enter your password" required>
            </div>

            <div class="flex items-center justify-between text-sm">
                <label class="flex items-center text-gray-600">
                    <input type="checkbox" name="remember" class="mr-2"> Remember me
                </label>
                <a href="#" class="text-blue-600 hover:underline">Forgot password?</a>
            </div>

            <button type="submit"
                    class="w-full bg-blue-600 text-white font-semibold py-2 rounded-lg hover:bg-blue-700 transition-all duration-200">
                Login
            </button>
        </form>

        <p class="text-center text-gray-600 mt-6">
            Don’t have an account?
            <a href="{{ route('auth.register') }}" class="text-blue-600 font-semibold hover:underline">Register here</a>
        </p>
    </div>

</body>
</html>

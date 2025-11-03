<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Account | MyStore</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        /* 🌤 خلفية ناعمة بتدرجات فاتحة مريحة للعين */
        .soft-bg {
            background: linear-gradient(135deg, #f9fafb, #eef2ff, #e0f2fe);
        }

        /* حركة لطيفة عند المرور */
        .hover-scale {
            transition: all 0.3s ease;
        }

        .hover-scale:hover {
            transform: translateY(-4px);
        }

        /* ظل ناعم واقعي */
        .soft-shadow {
            box-shadow: 0 10px 35px rgba(0, 0, 0, 0.05);
        }

        /* إدخال مريح للنظر */
        input:focus {
            background-color: #f8fafc;
            transition: all 0.25s ease-in-out;
        }

        /* 🌈 زر متدرج بألوان مهدئة */
        .btn-gradient {
            background: linear-gradient(90deg, #60a5fa, #818cf8);
            transition: all 0.3s ease;
        }

        .btn-gradient:hover {
            background: linear-gradient(90deg, #4f83f1, #6d76f7);
            transform: scale(1.03);
        }
    </style>
</head>

<body class="soft-bg min-h-screen flex items-center justify-center px-4">

    <!-- Register Card -->
    <div class="bg-white/90 backdrop-blur-xl rounded-3xl soft-shadow p-10 w-full max-w-md hover-scale">

        <!-- Header -->
        <div class="text-center mb-8">
            <div class="mx-auto bg-gradient-to-r from-sky-400 to-indigo-400 text-white w-16 h-16 flex items-center justify-center rounded-full mb-5 shadow-md">
                <i class="fa-solid fa-user-plus text-2xl"></i>
            </div>
            <h1 class="text-3xl font-bold text-gray-800">Create Account</h1>
            <p class="text-gray-500 mt-2 text-sm">
                Join <span class="text-indigo-500 font-semibold">MyStore</span> and start your journey today
            </p>
        </div>

        {{-- Error Messages --}}
        @if ($errors->any())
            <div class="bg-red-50 border border-red-400 text-red-600 px-4 py-3 rounded-lg mb-4">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        {{-- Success Message --}}
        @if (session('success'))
            <div class="bg-green-50 border border-green-400 text-green-600 px-4 py-3 rounded-lg mb-4">
                {{ session('success') }}
            </div>
        @endif

        <!-- Register Form -->
        <form method="POST" action="{{ route('auth.register.post') }}" class="space-y-5">
            @csrf

            <div>
                <label for="name" class="block text-gray-700 font-medium mb-1">Full Name</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}"
                       class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-sky-300"
                       placeholder="John Doe" required>
            </div>

            <div>
                <label for="email" class="block text-gray-700 font-medium mb-1">Email Address</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}"
                       class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-sky-300"
                       placeholder="example@email.com" required>
            </div>

            <div>
                <label for="password" class="block text-gray-700 font-medium mb-1">Password</label>
                <input id="password" type="password" name="password"
                       class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-sky-300"
                       placeholder="Create a password" required>
            </div>

            <div>
                <label for="password_confirmation" class="block text-gray-700 font-medium mb-1">Confirm Password</label>
                <input id="password_confirmation" type="password" name="password_confirmation"
                       class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-sky-300"
                       placeholder="Re-enter password" required>
            </div>

            <button type="submit"
                    class="btn-gradient w-full text-white font-semibold py-3 rounded-xl shadow-md">
                <i class="fa-solid fa-user-plus mr-2"></i> Create Account
            </button>
        </form>

        <p class="text-center text-gray-600 mt-6 text-sm">
            Already have an account?
            <a href="{{ route('auth.login') }}" class="text-sky-500 font-semibold hover:underline">Login here</a>
        </p>
    </div>

    <!-- FontAwesome -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</body>
</html>

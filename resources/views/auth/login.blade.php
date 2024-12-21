<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <!-- Add TailwindCSS or your custom CSS here -->
    <script src="https://cdn.tailwindcss.com"></script>

</head>
<body class="bg-gray-100">
    <div class="flex justify-center items-center min-h-screen">
        <div class="w-full max-w-sm bg-white p-8 rounded-lg shadow-md">
            <h2 class="text-2xl font-semibold text-center mb-6">Login</h2>
            <form action="{{ route('login.submit') }}" method="POST">
                @csrf
                <!-- Email Field -->
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" name="email" id="email" class="w-full px-4 py-2 border border-gray-300 rounded-md" placeholder="Enter your email" required>
                </div>

                <!-- Password Field -->
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input type="password" name="password" id="password" class="w-full px-4 py-2 border border-gray-300 rounded-md" placeholder="Enter your password" required>
                </div>

                <!-- Forgot Password Link -->
                <div class="mb-4 text-right">
                    <a href="#" class="text-sm text-blue-600 hover:underline">Forgot Password?</a>
                </div>

                <!-- Login Button -->
                <div class="mb-6">
                    <button type="submit" class="w-full py-2 bg-teal-700 text-white rounded-md hover:bg-teal-800">Login</button>
                </div>

                <!-- Register Link -->
                <div class="text-center">
                    <p class="text-sm">Don't have an account? <a href="{{ route('register') }}" class="text-teal-600 hover:underline">Sign up</a></p>
                </div>
            </form>
        </div>
    </div>
</body>
</html>

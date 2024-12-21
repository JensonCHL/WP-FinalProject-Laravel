<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
    <!-- Tailwind CSS link -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 h-screen flex items-center justify-center">

    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-sm">
        <h2 class="text-2xl font-semibold text-center mb-6">Create an Account</h2>

        <!-- Register Form -->
        <form method="POST" action="{{ url('/register') }}">
            @csrf

            <!-- Name -->
            <div class="mb-4">
                <label for="name" class="block text-gray-700">Name</label>
                <input type="text" name="name" id="name"
                    class="w-full p-2 border border-gray-300 rounded mt-2" required>
            </div>

            <!-- Age -->
            <div class="mb-4">
                <label for="age" class="block text-gray-700">Age</label>
                <input type="number" name="age" id="age"
                    class="w-full p-2 border border-gray-300 rounded mt-2" required>
            </div>

            <!-- Email -->
            <div class="mb-4">
                <label for="email" class="block text-gray-700">Email</label>
                <input type="email" name="email" id="email"
                    class="w-full p-2 border border-gray-300 rounded mt-2" required>
            </div>

            <!-- Password -->
            <div class="mb-4">
                <label for="password" class="block text-gray-700">Password</label>
                <input type="password" name="password" id="password"
                    class="w-full p-2 border border-gray-300 rounded mt-2" required>
            </div>

            <!-- Register Button -->
            <div class="mb-4">
                <button type="submit" class="w-full p-2 bg-teal-700 text-white rounded hover:bg-teal-800 transition">
                    Register
                </button>
            </div>

            <!-- Login Link -->
            <p class="text-center text-gray-700">
                Already have an account? <a href="{{ route('login') }}" class="text-teal-700 hover:underline">Login</a>
            </p>
        </form>
    </div>

</body>

</html>

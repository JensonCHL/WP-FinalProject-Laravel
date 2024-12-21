<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body>
    <div class="flex items-center justify-center h-screen space-between gap-10">
        <a href="{{ route('forum.index') }}"
            class="px-4 py-2 rounded bg-teal-700 text-white hover:bg-teal-800 transition text-[60px]">
            Go to Forum
        </a>
        <a href="{{ route('login') }}"
            class="px-4 py-2 rounded bg-teal-700 text-white hover:bg-teal-800 transition text-[60px]">
            Login Page
        </a>
    </div>
</body>

</html>


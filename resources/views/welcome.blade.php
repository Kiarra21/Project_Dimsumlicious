<!-- resources/views/welcome.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <!-- Tailwind CSS via CDN (cepat untuk testing) -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 dark:bg-gray-900 flex items-center justify-center min-h-screen">

    <div class="bg-white dark:bg-gray-800 p-8 rounded-lg shadow-lg text-center">
        <h1 class="text-2xl font-bold mb-6 text-gray-800 dark:text-gray-100">Welcome to Our App</h1>

        <div class="space-x-4">
            <!-- Login Button -->
            <a href="{{ route('login') }}"
               class="inline-block px-6 py-2 text-sm font-medium rounded-sm text-gray-900 dark:text-gray-100 border border-transparent hover:border-gray-300 dark:hover:border-gray-500 transition">
               Log in
            </a>

            <!-- Register Button (if route exists) -->
            @if (Route::has('register'))
                <a href="{{ route('register') }}"
                   class="inline-block px-6 py-2 text-sm font-medium rounded-sm text-gray-900 dark:text-gray-100 border border-gray-300 dark:border-gray-500 hover:border-gray-400 dark:hover:border-gray-400 transition">
                   Register
                </a>
            @endif
        </div>
    </div>

</body>
</html>

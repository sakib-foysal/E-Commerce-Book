<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - E-Commerce Book</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex">
        <!-- Sidebar -->
        <nav class="bg-gray-800 w-64 min-h-screen p-4">
            <div class="text-white text-xl font-semibold mb-8">Admin Panel</div>
            <ul>
                <li class="mb-4">
                    <a href="{{ route('admin.dashboard') }}" class="text-gray-300 hover:text-white flex items-center">
                        <i class="fas fa-tachometer-alt mr-3"></i>
                        Dashboard
                    </a>
                </li>
                <li class="mb-4">
                    <a href="{{ route('admin.product.list') }}" class="text-gray-300 hover:text-white flex items-center">
                        <i class="fas fa-book mr-3"></i>
                        Products
                    </a>
                </li>
                <li class="mb-4">
                    <a href="{{ route('admin.category.list') }}" class="text-gray-300 hover:text-white flex items-center">
                        <i class="fas fa-tags mr-3"></i>
                        Categories
                    </a>
                </li>
                <li class="mb-4">
                    <a href="{{ route('admin.orders') }}" class="text-gray-300 hover:text-white flex items-center">
                        <i class="fas fa-shopping-cart mr-3"></i>
                        Orders
                    </a>
                </li>
                <li class="mb-4">
                    <a href="{{ route('admin.users') }}" class="text-gray-300 hover:text-white flex items-center">
                        <i class="fas fa-users mr-3"></i>
                        Users
                    </a>
                </li>
            </ul>
        </nav>

        <!-- Main Content -->
        <div class="flex-1">
            <!-- Top Navigation -->
            <header class="bg-white shadow-md p-4">
                <div class="flex justify-between items-center">
                    <h2 class="text-xl font-semibold">@yield('title')</h2>
                    <div class="flex items-center">
                        <span class="mr-4">Admin</span>
                        <form action="{{ route('admin.logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="text-red-600 hover:text-red-800">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </button>
                        </form>
                    </div>
                </div>
            </header>

            <!-- Main Content Area -->
            <main class="p-6">
                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                        {{ session('error') }}
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    @stack('scripts')
</body>
</html>

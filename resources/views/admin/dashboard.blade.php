@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
    <!-- Total Orders -->
    <div class="bg-white p-6 rounded-lg shadow-md">
        <div class="flex items-center">
            <div class="p-3 bg-blue-500 rounded-full">
                <i class="fas fa-shopping-cart text-white text-2xl"></i>
            </div>
            <div class="ml-4">
                <h3 class="text-gray-500 text-sm">Total Orders</h3>
                <p class="text-2xl font-semibold">{{ $totalOrders }}</p>
            </div>
        </div>
    </div>

    <!-- Total Products -->
    <div class="bg-white p-6 rounded-lg shadow-md">
        <div class="flex items-center">
            <div class="p-3 bg-green-500 rounded-full">
                <i class="fas fa-book text-white text-2xl"></i>
            </div>
            <div class="ml-4">
                <h3 class="text-gray-500 text-sm">Total Products</h3>
                <p class="text-2xl font-semibold">{{ $totalProducts }}</p>
            </div>
        </div>
    </div>

    <!-- Total Categories -->
    <div class="bg-white p-6 rounded-lg shadow-md">
        <div class="flex items-center">
            <div class="p-3 bg-yellow-500 rounded-full">
                <i class="fas fa-tags text-white text-2xl"></i>
            </div>
            <div class="ml-4">
                <h3 class="text-gray-500 text-sm">Total Categories</h3>
                <p class="text-2xl font-semibold">{{ $totalCategories }}</p>
            </div>
        </div>
    </div>

    <!-- Total Users -->
    <div class="bg-white p-6 rounded-lg shadow-md">
        <div class="flex items-center">
            <div class="p-3 bg-purple-500 rounded-full">
                <i class="fas fa-users text-white text-2xl"></i>
            </div>
            <div class="ml-4">
                <h3 class="text-gray-500 text-sm">Total Users</h3>
                <p class="text-2xl font-semibold">{{ $totalUsers }}</p>
            </div>
        </div>
    </div>
</div>

<!-- Recent Orders -->
<div class="bg-white rounded-lg shadow-md p-6 mb-8">
    <h2 class="text-xl font-semibold mb-4">Recent Orders</h2>
    <div class="overflow-x-auto">
        <table class="min-w-full table-auto">
            <thead>
                <tr class="bg-gray-100">
                    <th class="px-4 py-2 text-left">Order ID</th>
                    <th class="px-4 py-2 text-left">Customer</th>
                    <th class="px-4 py-2 text-left">Status</th>
                    <th class="px-4 py-2 text-left">Date</th>
                    <th class="px-4 py-2 text-left">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($recentOrders as $order)
                <tr class="border-b">
                    <td class="px-4 py-2">#{{ $order->id }}</td>
                    <td class="px-4 py-2">{{ $order->user->name }}</td>
                    <td class="px-4 py-2">
                        <span class="px-2 py-1 text-xs rounded-full
                            {{ $order->status === 'completed' ? 'bg-green-100 text-green-800' :
                               ($order->status === 'pending' ? 'bg-yellow-100 text-yellow-800' :
                               'bg-blue-100 text-blue-800') }}">
                            {{ ucfirst($order->status) }}
                        </span>
                    </td>
                    <td class="px-4 py-2">{{ $order->created_at->format('M d, Y') }}</td>
                    <td class="px-4 py-2">${{ number_format($order->total, 2) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Recent Products -->
<div class="bg-white rounded-lg shadow-md p-6">
    <h2 class="text-xl font-semibold mb-4">Recent Products</h2>
    <div class="overflow-x-auto">
        <table class="min-w-full table-auto">
            <thead>
                <tr class="bg-gray-100">
                    <th class="px-4 py-2 text-left">Product</th>
                    <th class="px-4 py-2 text-left">Price</th>
                    <th class="px-4 py-2 text-left">Stock</th>
                    <th class="px-4 py-2 text-left">Added Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($recentProducts as $product)
                <tr class="border-b">
                    <td class="px-4 py-2">{{ $product->name }}</td>
                    <td class="px-4 py-2">${{ number_format($product->price, 2) }}</td>
                    <td class="px-4 py-2">{{ $product->stock }}</td>
                    <td class="px-4 py-2">{{ $product->created_at->format('M d, Y') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

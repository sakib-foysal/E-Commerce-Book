@extends('layouts.homelayout')

@section('content')
<div class="container mx-auto mt-8 px-4">
    <div class="max-w-2xl mx-auto bg-white p-8 rounded-lg shadow">
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-green-100 rounded-full mb-4">
                <svg class="w-8 h-8 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>
            <h2 class="text-2xl font-bold text-gray-800">Order Placed Successfully!</h2>
            <p class="text-gray-600 mt-2">Thank you for your order. We'll start processing it right away.</p>
        </div>

        <div class="border-t border-b border-gray-200 py-4 mb-6">
            <div class="flex justify-between mb-2">
                <span class="text-gray-600">Order Number:</span>
                <span class="font-semibold">#{{ $order->id }}</span>
            </div>
            <div class="flex justify-between mb-2">
                <span class="text-gray-600">Order Date:</span>
                <span class="font-semibold">{{ $order->created_at->format('F j, Y') }}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-gray-600">Total Amount:</span>
                <span class="font-semibold">৳{{ $order->total_amount }}</span>
            </div>
        </div>

        <div class="mb-6">
            <h3 class="font-semibold text-gray-800 mb-3">Order Items</h3>
            <div class="space-y-3">
                @foreach($order->items as $item)
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="font-medium">{{ $item->product->name }}</p>
                            <p class="text-sm text-gray-600">Quantity: {{ $item->quantity }}</p>
                        </div>
                        <span class="font-medium">৳{{ $item->total }}</span>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="border-t border-gray-200 pt-4 mb-6">
            <h3 class="font-semibold text-gray-800 mb-3">Shipping Details</h3>
            <div class="grid grid-cols-2 gap-4 text-sm">
                <div>
                    <p class="text-gray-600">Name:</p>
                    <p class="font-medium">{{ $order->shipping_name }}</p>
                </div>
                <div>
                    <p class="text-gray-600">Email:</p>
                    <p class="font-medium">{{ $order->shipping_email }}</p>
                </div>
                <div>
                    <p class="text-gray-600">Phone:</p>
                    <p class="font-medium">{{ $order->shipping_phone }}</p>
                </div>
                <div>
                    <p class="text-gray-600">Address:</p>
                    <p class="font-medium">
                        {{ $order->shipping_address }}<br>
                        {{ $order->shipping_city }}, {{ $order->shipping_postal_code }}
                    </p>
                </div>
            </div>
        </div>

        <div class="text-center">
            <a href="{{ route('home') }}"
               class="inline-block bg-purple-700 text-white py-2 px-6 rounded hover:bg-purple-800 transition">
                Continue Shopping
            </a>
        </div>
    </div>
</div>
@endsection

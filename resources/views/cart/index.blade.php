@extends('layouts.homelayout')

@section('content')
<div class="container mx-auto mt-8 px-4">
    <h2 class="text-2xl font-bold mb-6">Shopping Cart</h2>

    @if(count($cartItems) > 0)
        <div class="bg-white rounded-lg shadow-md">
            <!-- Cart Items -->
            <div class="border-b">
                @php $total = 0 @endphp
                @foreach($cartItems as $id => $item)
                    <div class="flex items-center py-4 px-6 hover:bg-gray-50 border-b last:border-b-0">
                        <!-- Product Image -->
                        @if(isset($item['image']))
                            <img src="{{ asset('storage/' . $item['image']) }}"
                                 alt="{{ $item['name'] }}"
                                 class="w-20 h-20 object-cover rounded">
                        @else
                            <div class="w-20 h-20 bg-gray-200 rounded flex items-center justify-center">
                                <span class="text-gray-500">No Image</span>
                            </div>
                        @endif

                        <!-- Product Details -->
                        <div class="flex-1 ml-6">
                            <h3 class="text-lg font-semibold">{{ $item['name'] }}</h3>
                            <p class="text-gray-600">Price: ${{ $item['price'] }}</p>
                            <p class="text-gray-600">Quantity: {{ $item['quantity'] }}</p>
                        </div>

                        <!-- Item Total -->
                        <div class="text-right">
                            <p class="text-lg font-semibold">${{ $item['price'] * $item['quantity'] }}</p>
                        </div>
                    </div>
                    @php $total += $item['price'] * $item['quantity'] @endphp
                @endforeach
            </div>

            <!-- Cart Summary -->
            <div class="p-6 bg-gray-50">
                <div class="flex justify-between items-center">
                    <h3 class="text-lg font-semibold">Total</h3>
                    <p class="text-2xl font-bold">${{ $total }}</p>
                </div>
                <div class="mt-6 text-right">
                    <a href="{{ route('checkout') }}"
                       class="inline-block bg-blue-500 text-white px-6 py-3 rounded-lg hover:bg-blue-600 transition">
                        Proceed to Checkout
                    </a>
                </div>
            </div>
        </div>
    @else
        <div class="text-center py-12">
            <h3 class="text-xl text-gray-600 mb-4">Your cart is empty</h3>
            <a href="{{ route('categories') }}"
               class="inline-block bg-blue-500 text-white px-6 py-3 rounded-lg hover:bg-blue-600 transition">
                Continue Shopping
            </a>
        </div>
    @endif
</div>
@endsection

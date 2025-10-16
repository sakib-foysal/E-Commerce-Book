@extends('layouts.homelayout')

@section('content')
<div class="container mx-auto mt-8 px-4">
    <h2 class="text-2xl font-bold mb-6">Checkout</h2>

    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <!-- Shipping Information Form -->
        <div class="bg-white p-6 rounded-lg shadow">
            <h3 class="text-lg font-semibold mb-4">Shipping Information</h3>
            <form action="{{ route('checkout.store') }}" method="POST">
                @csrf
                <div class="space-y-4">
                    <div>
                        <label class="block text-gray-700 mb-1" for="shipping_name">Full Name</label>
                        <input type="text" name="shipping_name" id="shipping_name"
                               value="{{ old('shipping_name') }}"
                               class="w-full border-gray-300 rounded focus:ring-purple-500 focus:border-purple-500"
                               required>
                        @error('shipping_name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-gray-700 mb-1" for="shipping_email">Email</label>
                        <input type="email" name="shipping_email" id="shipping_email"
                               value="{{ old('shipping_email') }}"
                               class="w-full border-gray-300 rounded focus:ring-purple-500 focus:border-purple-500"
                               required>
                        @error('shipping_email')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-gray-700 mb-1" for="shipping_phone">Phone</label>
                        <input type="tel" name="shipping_phone" id="shipping_phone"
                               value="{{ old('shipping_phone') }}"
                               class="w-full border-gray-300 rounded focus:ring-purple-500 focus:border-purple-500"
                               required>
                        @error('shipping_phone')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-gray-700 mb-1" for="shipping_address">Address</label>
                        <textarea name="shipping_address" id="shipping_address" rows="3"
                                  class="w-full border-gray-300 rounded focus:ring-purple-500 focus:border-purple-500"
                                  required>{{ old('shipping_address') }}</textarea>
                        @error('shipping_address')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-gray-700 mb-1" for="shipping_city">City</label>
                            <input type="text" name="shipping_city" id="shipping_city"
                                   value="{{ old('shipping_city') }}"
                                   class="w-full border-gray-300 rounded focus:ring-purple-500 focus:border-purple-500"
                                   required>
                            @error('shipping_city')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-gray-700 mb-1" for="shipping_postal_code">Postal Code</label>
                            <input type="text" name="shipping_postal_code" id="shipping_postal_code"
                                   value="{{ old('shipping_postal_code') }}"
                                   class="w-full border-gray-300 rounded focus:ring-purple-500 focus:border-purple-500"
                                   required>
                            @error('shipping_postal_code')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-gray-700 mb-1">Payment Method</label>
                        <div class="space-y-2">
                            <label class="inline-flex items-center">
                                <input type="radio" name="payment_method" value="cash"
                                       class="text-purple-600 focus:ring-purple-500"
                                       {{ old('payment_method', 'cash') === 'cash' ? 'checked' : '' }}>
                                <span class="ml-2">Cash on Delivery</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input type="radio" name="payment_method" value="card"
                                       class="text-purple-600 focus:ring-purple-500"
                                       {{ old('payment_method') === 'card' ? 'checked' : '' }}>
                                <span class="ml-2">Credit Card</span>
                            </label>
                        </div>
                        @error('payment_method')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-gray-700 mb-1" for="notes">Order Notes (Optional)</label>
                        <textarea name="notes" id="notes" rows="2"
                                  class="w-full border-gray-300 rounded focus:ring-purple-500 focus:border-purple-500">{{ old('notes') }}</textarea>
                    </div>
                </div>

                <button type="submit"
                        class="mt-6 w-full bg-purple-700 text-white py-2 px-4 rounded hover:bg-purple-800 transition">
                    Place Order
                </button>
            </form>
        </div>

        <!-- Order Summary -->
        <div class="bg-white p-6 rounded-lg shadow h-fit">
            <h3 class="text-lg font-semibold mb-4">Order Summary</h3>
            <div class="space-y-4">
                @foreach($cartItems as $item)
                    <div class="flex justify-between border-b pb-4">
                        <div>
                            <h4 class="font-medium">{{ $item['name'] }}</h4>
                            <p class="text-gray-600">Quantity: {{ $item['quantity'] }}</p>
                        </div>
                        <p class="font-medium">৳{{ $item['price'] * $item['quantity'] }}</p>
                    </div>
                @endforeach

                <div class="flex justify-between pt-2">
                    <p class="font-semibold">Total:</p>
                    <p class="font-bold text-lg">৳{{ $total }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

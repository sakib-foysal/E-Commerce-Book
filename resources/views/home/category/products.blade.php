@extends('layouts.homelayout')
@section('content')
<div class="container mx-auto mt-8 px-4">
    <h2 class="text-2xl font-bold mb-6">{{ $category->name }} Products</h2>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach($category->products as $product)
            <div class="bg-white border rounded-lg shadow hover:shadow-lg transition duration-300">
                <!-- Product Image -->
                @if($product->images->first())
                    <img src="{{ asset('storage/'.$product->images->first()->image_path) }}"
                         class="w-full h-48 object-cover rounded-t-lg" alt="{{ $product->name }}">
                @else
                    <div class="w-full h-48 bg-gray-200 flex items-center justify-center rounded-t-lg">
                        <span class="text-gray-500">No Image</span>
                    </div>
                @endif

                <div class="p-4 flex flex-col justify-between h-52">
                    <!-- Product Info -->
                    <div>
                        <h3 class="text-lg font-semibold mb-2">{{ $product->name }}</h3>
                        <p class="text-gray-700 mb-3">${{ $product->price }}</p>
                    </div>

                    <!-- Buttons -->
                    <div class="flex flex-col gap-2">
                        <a href="{{ route('product.details', $product->id) }}"
                           class="bg-blue-500 hover:bg-blue-600 text-white text-center py-1 rounded transition">
                           Details
                        </a>

                        <form action="{{ route('cart.add', $product->id) }}" method="POST">
                            @csrf
                            <button type="submit"
                                    class="bg-green-500 hover:bg-green-600 text-white py-1 rounded w-full transition">
                                Add to Cart
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection

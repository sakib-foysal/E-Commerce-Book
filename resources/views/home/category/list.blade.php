@extends('layouts.homelayout')
@section('content')
<div class="container mx-auto mt-8 px-4">
    <h2 class="text-2xl font-bold mb-6">All Categories</h2>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach($categories as $category)
            <div class="bg-white border rounded-lg shadow hover:shadow-lg transition duration-300">
                <div class="p-4">
                    <h3 class="text-lg font-semibold mb-2">{{ $category->name }}</h3>
                    <p class="text-gray-600 mb-4">{{ $category->products->count() }} Products</p>
                    <a href="{{ route('category.products', $category->id) }}"
                       class="inline-block w-full bg-blue-500 hover:bg-blue-600 text-white text-center py-2 rounded transition">
                        View Products
                    </a>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection


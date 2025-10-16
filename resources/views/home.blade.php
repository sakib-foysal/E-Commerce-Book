@extends('layouts.homelayout')
@section('content')

    <!-- Hero Slider -->
    <section class="mt-4">
        <div class="container mx-auto px-4">
            <div class="slider-container rounded-lg overflow-hidden">
                <div class="slider-track" id="sliderTrack">
                    <div class="slider-item">
                        <a href="#books">
                            <img src="https://images.unsplash.com/photo-1512820790803-83ca734da794?w=1200&h=400&fit=crop" alt="Books Collection" class="w-full h-96 object-cover">
                        </a>
                    </div>
                    <div class="slider-item">
                        <a href="#stationery">
                            <img src="https://images.unsplash.com/photo-1544947950-fa07a98d237f?w=1200&h=400&fit=crop" alt="Stationery Items" class="w-full h-96 object-cover">
                        </a>
                    </div>
                    <div class="slider-item">
                        <a href="#new-arrivals">
                            <img src="https://images.unsplash.com/photo-1495446815901-a7297e633e8d?w=1200&h=400&fit=crop" alt="New Arrivals" class="w-full h-96 object-cover">
                        </a>
                    </div>
                </div>
                <div class="slider-dots" id="sliderDots"></div>
            </div>
        </div>
    </section>

    <!-- Categories -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <h3 class="text-3xl font-bold text-center mb-12 text-gray-800">Browse by Category</h3>
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-6">
                <div class="category-card text-center p-6 bg-purple-50 rounded-full cursor-pointer">
                    <div class="text-5xl mb-4 text-purple-700"><i class="fas fa-book"></i></div>
                    <h4 class="font-semibold">Fiction</h4>
                </div>
                <div class="category-card text-center p-6 bg-blue-50 rounded-full cursor-pointer">
                    <div class="text-5xl mb-4 text-blue-700"><i class="fas fa-graduation-cap"></i></div>
                    <h4 class="font-semibold">Academic</h4>
                </div>
                <div class="category-card text-center p-6 bg-green-50 rounded-full cursor-pointer">
                    <div class="text-5xl mb-4 text-green-700"><i class="fas fa-child"></i></div>
                    <h4 class="font-semibold">Children</h4>
                </div>
                <div class="category-card text-center p-6 bg-yellow-50 rounded-full cursor-pointer">
                    <div class="text-5xl mb-4 text-yellow-700"><i class="fas fa-mosque"></i></div>
                    <h4 class="font-semibold">Islamic</h4>
                </div>
                <div class="category-card text-center p-6 bg-red-50 rounded-full cursor-pointer">
                    <div class="text-5xl mb-4 text-red-700"><i class="fas fa-pen"></i></div>
                    <h4 class="font-semibold">Stationery</h4>
                </div>
                <div class="category-card text-center p-6 bg-indigo-50 rounded-full cursor-pointer">
                    <div class="text-5xl mb-4 text-indigo-700"><i class="fas fa-heart"></i></div>
                    <h4 class="font-semibold">Romance</h4>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Books -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center mb-12">
                <h3 class="text-3xl font-bold text-gray-800">Featured Books</h3>
                <a href="#" class="text-purple-700 font-semibold hover:text-purple-900">View All <i class="fas fa-arrow-right ml-2"></i></a>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6" id="featured-books"></div>
        </div>
    </section>

    <!-- New Arrivals -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center mb-12">
                <h3 class="text-3xl font-bold text-gray-800">New Arrivals</h3>
                <a href="#" class="text-purple-700 font-semibold hover:text-purple-900">View All <i class="fas fa-arrow-right ml-2"></i></a>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6" id="new-arrivals"></div>
        </div>
    </section>

    <!-- Testimonials -->
    <section class="py-16 bg-purple-700 text-white">
        <div class="container mx-auto px-4">
            <h3 class="text-3xl font-bold text-center mb-12">Hear from our valued customers</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white text-gray-800 p-6 rounded-lg">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-purple-200 rounded-full flex items-center justify-center mr-4">
                            <i class="fas fa-user text-purple-700"></i>
                        </div>
                        <div>
                            <h4 class="font-semibold">Karim Ahmed</h4>
                            <div class="text-yellow-500">★★★★★</div>
                        </div>
                    </div>
                    <p class="text-gray-600">"Great collection of books! Fast delivery and excellent customer service. Highly recommended!"</p>
                </div>
                <div class="bg-white text-gray-800 p-6 rounded-lg">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-purple-200 rounded-full flex items-center justify-center mr-4">
                            <i class="fas fa-user text-purple-700"></i>
                        </div>
                        <div>
                            <h4 class="font-semibold">Fatima Rahman</h4>
                            <div class="text-yellow-500">★★★★★</div>
                        </div>
                    </div>
                    <p class="text-gray-600">"Best online bookstore in Bangladesh. I always find what I'm looking for at great prices."</p>
                </div>
                <div class="bg-white text-gray-800 p-6 rounded-lg">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-purple-200 rounded-full flex items-center justify-center mr-4">
                            <i class="fas fa-user text-purple-700"></i>
                        </div>
                        <div>
                            <h4 class="font-semibold">Rahim Hossain</h4>
                            <div class="text-yellow-500">★★★★★</div>
                        </div>
                    </div>
                    <p class="text-gray-600">"Amazing experience! The website is easy to navigate and the book quality is excellent."</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Publishers Section -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <h3 class="text-3xl font-bold text-center mb-12 text-gray-800">Navigate the World of Publications</h3>
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-6">
                <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition text-center">
                    <div class="text-4xl mb-3 text-purple-700">📚</div>
                    <h4 class="font-semibold">Ananda Publishers</h4>
                </div>
                <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition text-center">
                    <div class="text-4xl mb-3 text-blue-700">📚</div>
                    <h4 class="font-semibold">Protik</h4>
                </div>
                <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition text-center">
                    <div class="text-4xl mb-3 text-green-700">📚</div>
                    <h4 class="font-semibold">Somoy Prokashon</h4>
                </div>
                <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition text-center">
                    <div class="text-4xl mb-3 text-yellow-700">📚</div>
                    <h4 class="font-semibold">Prothoma</h4>
                </div>
                <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition text-center">
                    <div class="text-4xl mb-3 text-red-700">📚</div>
                    <h4 class="font-semibold">Mowla Brothers</h4>
                </div>
                <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition text-center">
                    <div class="text-4xl mb-3 text-indigo-700">📚</div>
                    <h4 class="font-semibold">Sheba Prokashani</h4>
                </div>
            </div>
        </div>
    </section>


@endsection

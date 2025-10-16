<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BD Books - Online Bookstore in Bangladesh</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
        }

        .book-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .book-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
        }

        .category-card {
            transition: all 0.3s ease;
        }

        .category-card:hover {
            transform: scale(1.05);
        }

        .nav-link {
            position: relative;
            transition: color 0.3s ease;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 2px;
            background: #f59e0b;
            transition: width 0.3s ease;
        }

        .nav-link:hover::after {
            width: 100%;
        }

        .badge {
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.7; }
        }

        .mega-menu {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.4s ease;
        }

        .mega-menu.active {
            max-height: 500px;
        }

        .slider-container {
            position: relative;
            overflow: hidden;
        }

        .slider-track {
            display: flex;
            transition: transform 0.5s ease;
        }

        .slider-item {
            min-width: 100%;
            flex-shrink: 0;
        }

        .slider-dots {
            position: absolute;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 10px;
            z-index: 10;
        }

        .slider-dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: rgba(255,255,255,0.5);
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .slider-dot.active {
            background: white;
            width: 30px;
            border-radius: 6px;
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Top Bar -->
    <div class="bg-purple-700 text-white py-2">
        <div class="container mx-auto px-4 flex justify-between items-center text-sm">
            <div class="flex items-center space-x-4">
                <span><i class="fas fa-phone-alt mr-2"></i>+880 1234-567890</span>
                <span><i class="fas fa-envelope mr-2"></i>info@bdbooks.net</span>
            </div>
            <div class="flex items-center space-x-4">
                <a href="#" class="hover:text-yellow-300">Track Order</a>
                <a href="#" class="hover:text-yellow-300">Help</a>
            </div>
        </div>
    </div>

    <!-- Header -->
    <header class="bg-white shadow-md sticky top-0 z-50">
        <div class="container mx-auto px-4 py-4">
            <div class="flex items-center justify-between">
                <!-- Logo -->
                <div class="flex items-center space-x-4">
                    <h1 class="text-3xl font-bold text-purple-700">BD<span class="text-yellow-500">Books</span></h1>
                </div>

                <!-- Cart & User -->
                <div class="flex items-center space-x-6">
                    <a href="#" class="relative hover:text-purple-700">
                        <i class="fas fa-heart text-2xl"></i>
                        <span class="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">0</span>
                    </a>
                    <a href="{{ route('cart.index') }}" class="relative hover:text-purple-700">
                        <i class="fas fa-shopping-cart text-2xl"></i>
                        <span class="absolute -top-2 -right-2 bg-yellow-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">{{ $cartCount }}</span>
                    </a>
                    <a href="#" class="hover:text-purple-700">
                        <i class="fas fa-user text-2xl"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- TOP CATEGORY NAV -->
        <nav class="bg-white border-b shadow-sm">
            <div class="container mx-auto px-4 flex items-center justify-between">

                <!-- Left Menu Button -->
                <button onclick="toggleSidebar()" class="text-purple-700 text-2xl font-bold p-2">
                    ☰
                </button>

                <!-- Category Links (Centered) -->
                <div class="flex-1 flex justify-center">
                    <div class="flex gap-6 text-gray-700 text-[18px] font-bold py-4">
                        <a href="/" class="hover:text-purple-700 border-b-2 border-purple-700 pb-2">হোম</a>
                        <a href="/categories" class="hover:text-purple-700">ক্যাটাগরিস</a>
                        <a href="#" class="hover:text-purple-700">লেখক</a>
                        <a href="#" class="hover:text-purple-700">প্রকাশনী</a>
                        <a href="#" class="hover:text-purple-700">স্টেশনারিস</a>
                        <a href="#" class="hover:text-purple-700">ক্যাম্পেইন</a>
                    </div>
                </div>
            </div>
        </nav>

        <!-- SIDEBAR (Hidden Default) -->
        <aside id="sidebar" class="fixed top-0 left-0 w-64 h-full bg-white shadow transform -translate-x-full transition-transform duration-300 z-50">
            <div class="p-4 border-b flex justify-between items-center">
                <h3 class="font-bold text-purple-700">Menu</h3>
                <button onclick="toggleSidebar()">✖</button>
            </div>
            <ul class="p-4 space-y-3 text-gray-700">
                <li><a href="#" class="hover:text-purple-700">হোম</a></li>
                <li><a href="#" class="hover:text-purple-700">ক্যাটাগরিস</a></li>
                <li><a href="#" class="hover:text-purple-700">লেখক</a></li>
                <li><a href="#" class="hover:text-purple-700">প্রকাশনী</a></li>
                <li><a href="#" class="hover:text-purple-700">স্টেশনারিস</a></li>
                <li><a href="#" class="hover:text-purple-700">ক্যাম্পেইন</a></li>
                <li><a href="#" class="hover:text-purple-700">যোগাযোগ</a></li>
            </ul>
        </aside>

@yield('content')


    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-300 py-12">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-2xl font-bold text-white mb-4">BD<span class="text-yellow-500">Books</span></h3>
                    <p class="mb-4">Your trusted online bookstore in Bangladesh. Discover thousands of books at your fingertips.</p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-2xl hover:text-yellow-500"><i class="fab fa-facebook"></i></a>
                        <a href="#" class="text-2xl hover:text-yellow-500"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-2xl hover:text-yellow-500"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-2xl hover:text-yellow-500"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
                <div>
                    <h4 class="text-white font-semibold mb-4">Quick Links</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="hover:text-yellow-500">About Us</a></li>
                        <li><a href="#" class="hover:text-yellow-500">Contact Us</a></li>
                        <li><a href="#" class="hover:text-yellow-500">Privacy Policy</a></li>
                        <li><a href="#" class="hover:text-yellow-500">Terms & Conditions</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-white font-semibold mb-4">Categories</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="hover:text-yellow-500">Fiction</a></li>
                        <li><a href="#" class="hover:text-yellow-500">Academic Books</a></li>
                        <li><a href="#" class="hover:text-yellow-500">Children's Books</a></li>
                        <li><a href="#" class="hover:text-yellow-500">Islamic Books</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-white font-semibold mb-4">Contact Info</h4>
                    <ul class="space-y-2">
                        <li><i class="fas fa-map-marker-alt mr-2"></i>Dhaka, Bangladesh</li>
                        <li><i class="fas fa-phone mr-2"></i>+880 1234-567890</li>
                        <li><i class="fas fa-envelope mr-2"></i>info@bdbooks.net</li>
                        <li><i class="fas fa-clock mr-2"></i>10 AM - 8 PM (Everyday)</li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-8 pt-8 text-center">
                <p>&copy; 2025 BDBooks.net. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Chat Button -->
    <div class="fixed bottom-6 right-6 z-50">
        <button class="bg-purple-700 text-white rounded-full w-16 h-16 shadow-lg hover:bg-purple-800 flex items-center justify-center">
            <i class="fas fa-comments text-2xl"></i>
        </button>
    </div>

    <script>
        // Sidebar Toggle
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('-translate-x-full');
        }

        // Menu Toggle for Mega Menu
        const megaMenu = document.getElementById('megaMenu');

        // Close sidebar when clicking outside
        document.addEventListener('click', (e) => {
            const sidebar = document.getElementById('sidebar');
            if (!sidebar.contains(e.target) && !e.target.closest('button[onclick="toggleSidebar()"]')) {
                sidebar.classList.add('-translate-x-full');
            }
        });

        // Slider functionality
        const sliderTrack = document.getElementById('sliderTrack');
        const sliderDots = document.getElementById('sliderDots');
        const slides = document.querySelectorAll('.slider-item');
        let currentSlide = 0;

        // Create dots
        slides.forEach((_, index) => {
            const dot = document.createElement('div');
            dot.className = `slider-dot ${index === 0 ? 'active' : ''}`;
            dot.addEventListener('click', () => goToSlide(index));
            sliderDots.appendChild(dot);
        });

        function goToSlide(n) {
            currentSlide = n;
            sliderTrack.style.transform = `translateX(-${currentSlide * 100}%)`;

            // Update dots
            document.querySelectorAll('.slider-dot').forEach((dot, index) => {
                dot.classList.toggle('active', index === currentSlide);
            });
        }

        function nextSlide() {
            currentSlide = (currentSlide + 1) % slides.length;
            goToSlide(currentSlide);
        }

        // Auto slide
        setInterval(nextSlide, 5000);

        // Sample book data
        const books = [
            { title: "পথের পাঁচালী", author: "Bibhutibhushan Bandyopadhyay", price: 350, oldPrice: 450, image: "https://images.unsplash.com/photo-1544947950-fa07a98d237f?w=300" },
            { title: "শেষের কবিতা", author: "Rabindranath Tagore", price: 280, oldPrice: 350, image: "https://images.unsplash.com/photo-1512820790803-83ca734da794?w=300" },
            { title: "লালসালু", author: "Syed Waliullah", price: 320, oldPrice: 400, image: "https://images.unsplash.com/photo-1543002588-bfa74002ed7e?w=300" },
            { title: "চোখের বালি", author: "Rabindranath Tagore", price: 300, oldPrice: 380, image: "https://images.unsplash.com/photo-1495446815901-a7297e633e8d?w=300" },
            { title: "শ্রীকান্ত", author: "Sarat Chandra Chattopadhyay", price: 420, oldPrice: 500, image: "https://images.unsplash.com/photo-1481627834876-b7833e8f5570?w=300" }
        ];

        function createBookCard(book) {
            return `
                <div class="book-card bg-white rounded-lg shadow overflow-hidden cursor-pointer">
                    <div class="relative">
                        <img src="${book.image}" alt="${book.title}" class="w-full h-64 object-cover">
                        <span class="badge absolute top-2 right-2 bg-red-500 text-white px-3 py-1 rounded-full text-xs font-semibold">
                            ${Math.round(((book.oldPrice - book.price) / book.oldPrice) * 100)}% OFF
                        </span>
                    </div>
                    <div class="p-4">
                        <h4 class="font-semibold text-gray-800 mb-1 truncate">${book.title}</h4>
                        <p class="text-sm text-gray-600 mb-2 truncate">${book.author}</p>
                        <div class="flex items-center justify-between mb-3">
                            <div>
                                <span class="text-purple-700 font-bold text-lg">৳${book.price}</span>
                                <span class="text-gray-400 line-through text-sm ml-2">৳${book.oldPrice}</span>
                            </div>
                        </div>
                        <button class="w-full bg-purple-700 text-white py-2 rounded hover:bg-purple-800 transition">
                            <i class="fas fa-shopping-cart mr-2"></i>Add to Cart
                        </button>
                    </div>
                </div>
            `;
        }

        // Populate books
        const featuredBooksContainer = document.getElementById('featured-books');
        const newArrivalsContainer = document.getElementById('new-arrivals');

        books.forEach(book => {
            featuredBooksContainer.innerHTML += createBookCard(book);
            newArrivalsContainer.innerHTML += createBookCard(book);
        });
    </script>
</body>
</html>

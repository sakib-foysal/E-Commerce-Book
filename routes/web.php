<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Teacher\AuthenticatedSessionController as TeacherAuth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;

// ---------- TEACHER ----------
Route::prefix('teacher')->name('teacher.')->group(function () {
    Route::get('login', [TeacherAuth::class, 'create'])->name('login');
    Route::post('login', [TeacherAuth::class, 'store']);
    Route::get('dashboard', function () {
        return view('teacher.dashboard');
    })->middleware('auth:teacher')->name('dashboard');
    Route::post('logout', [TeacherAuth::class, 'destroy'])->name('logout');
});

// ---------- HOME / FRONT ----------
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::get('/categories', [HomeController::class, 'categories'])->name('categories');

// ---------- PRODUCT ----------
Route::get('/category/{id}', [ProductController::class, 'categoryProducts'])->name('category.products');
Route::get('/product/{id}', [ProductController::class, 'productDetails'])->name('product.details');
Route::get('/cart', [ProductController::class, 'viewCart'])->name('cart.index');
Route::get('/cart/add/{id}', [ProductController::class, 'addToCart'])->name('cart.add');
Route::get('/checkout', [ProductController::class, 'checkout'])->name('checkout');
Route::post('/checkout/place', [ProductController::class, 'placeOrder'])->name('checkout.place');
Route::get('/thankyou', [ProductController::class, 'thankyou'])->name('thankyou');

// ---------- ADMIN ----------
Route::prefix('admin')->name('admin.')->group(function () {
    // Products
    Route::get('/product/add', [AdminController::class, 'addProduct'])->name('product.add');
    Route::post('/product/store', [AdminController::class, 'storeProduct'])->name('product.store');
    Route::get('/product/list', [AdminController::class, 'productList'])->name('product.list');
    Route::get('/product/edit/{id}', [AdminController::class, 'editProduct'])->name('product.edit');
    Route::post('/product/update/{id}', [AdminController::class, 'updateProduct'])->name('product.update');
    Route::get('/product/delete/{id}', [AdminController::class, 'deleteProduct'])->name('product.delete');

    // Categories
    Route::get('/category/add', [AdminController::class, 'addCategory'])->name('category.add');
    Route::post('/category/store', [AdminController::class, 'storeCategory'])->name('category.store');
    Route::get('/category/list', [AdminController::class, 'categoryList'])->name('category.list');
});






// Route::post('/cart/add/{id}', [ProductController::class, 'addToCart'])->name('cart.add');


use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;

// Cart Routes
Route::post('/cart/add/{id}', [CartController::class, 'addToCart'])->name('cart.add');
Route::get('/cart', [CartController::class, 'viewCart'])->name('cart.index');
Route::patch('/cart/update/{id}', [CartController::class, 'updateCart'])->name('cart.update');
Route::delete('/cart/remove/{id}', [CartController::class, 'removeFromCart'])->name('cart.remove');

// Checkout Routes
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
Route::get('/checkout/success/{order}', [CheckoutController::class, 'success'])->name('checkout.success');

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Category;
use App\Models\Product;

class HomeController extends Controller
{
    // Display the home page
    public function index()
    {
        return view('home'); // resources/views/home.blade.php
    }

    // Example: About page
    public function about()
    {
        return view('about');
    }

    // Example: Contact page
    public function contact()
    {
        return view('contact');
    }

    public function categories()
    {
        $categories = Category::all();

        return view('home.category.list', compact('categories'));
    }

   public function categoryProducts($id)
{
    // Load category + products + images
    $category = Category::with('products.images')->findOrFail($id);

    return view('home.category.products', compact('category'));
}

    public function productDetails($id)
    {
        $product = Product::findOrFail($id);
        return view('home.product_details', compact('product'));
    }

    public function addToCart($id)
    {
        // Logic for adding to cart
    }

    public function cart()
    {
        // Logic for showing cart
    }

    public function removeFromCart($id)
    {
        // Logic for removing from cart
    }

    public function checkout()
    {
        // Logic for showing checkout page
    }

    public function processCheckout(Request $request)
    {
        // Logic for placing order
    }

    public function thankYou()
    {
        return view('home.thankyou');
    }
}

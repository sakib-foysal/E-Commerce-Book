<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    // ---------- CATEGORY LIST ----------
    public function categoryList()
    {
        $categories = Category::all();
        return view('home.category.list', compact('categories'));
    }

    // ---------- PRODUCTS BY CATEGORY ----------
    public function categoryProducts($id)
    {
        $category = Category::with('products.images')->findOrFail($id);
        return view('home.category.products', compact('category'));
    }

    // ---------- PRODUCT DETAILS ----------
    public function productDetails($id)
    {
        $product = Product::with('images', 'categories')->findOrFail($id);
        return view('home.product.details', compact('product'));
    }

    // ---------- ADD TO CART ----------
    public function addToCart(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $cart = session()->get('cart', []);

        if(isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => 1
            ];
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Product added to cart!');
    }

    // ---------- VIEW CART ----------
    public function viewCart()
    {
        $cartItems = session()->get('cart', []);
        return view('home.cart.index', compact('cartItems'));
    }

    // ---------- REMOVE FROM CART ----------
    public function removeFromCart($id)
    {
        $cart = session()->get('cart', []);
        if(isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }
        return redirect()->back()->with('success', 'Product removed from cart!');
    }

    // ---------- CHECKOUT ----------
    public function checkout()
    {
        $cartItems = session()->get('cart', []);
        $total = collect($cartItems)->sum(fn($item) => $item['price'] * $item['quantity']);
        return view('home.checkout.index', compact('cartItems', 'total'));
    }

    public function placeOrder(Request $request)
    {
        $cartItems = session()->get('cart', []);
        if(empty($cartItems)) {
            return redirect()->back()->with('error', 'Cart is empty!');
        }

        // Save order logic here (DB or Mail)
        // For simplicity, we just clear the cart

        session()->forget('cart');

        return redirect()->route('thankyou')->with('success', 'Order placed successfully!');
    }

    // ---------- THANK YOU PAGE ----------
    public function thankyou()
    {
        return view('home.thankyou');
    }


}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    public function addToCart(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $cart = session()->get('cart', []);

        // যদি product আগেই cart এ থাকে
        if(isset($cart[$id])){
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => 1
            ];
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', $product->name.' added to cart!');
    }

    public function viewCart()
    {
        $cartItems = session()->get('cart', []);
        return view('home.cart.index', compact('cartItems'));
    }

    public function updateCart(Request $request, $id)
    {
        $cart = session()->get('cart', []);
        $product = Product::findOrFail($id);

        if (!isset($cart[$id])) {
            return response()->json([
                'error' => 'Item not found in cart!'
            ], 404);
        }

        if ($request->action === 'increase') {
            $cart[$id]['quantity']++;
        } elseif ($request->action === 'decrease') {
            if ($cart[$id]['quantity'] > 1) {
                $cart[$id]['quantity']--;
            } else {
                unset($cart[$id]);
            }
        } else {
            $quantity = max(1, min(10, $request->quantity));
            $cart[$id]['quantity'] = $quantity;
        }

        // Calculate totals before saving cart
        $itemTotal = isset($cart[$id]) ? $cart[$id]['price'] * $cart[$id]['quantity'] : 0;
        $cartTotal = array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cart));
        $cartCount = array_sum(array_column($cart, 'quantity'));

        session()->put('cart', $cart);

        return response()->json([
            'success' => true,
            'message' => 'Cart updated successfully!',
            'itemTotal' => $itemTotal,
            'cartTotal' => $cartTotal,
            'cartCount' => $cartCount
        ]);
    }

    public function removeFromCart($id)
    {
        $cart = session()->get('cart', []);

        if(isset($cart[$id])) {
            $productName = $cart[$id]['name'];
            unset($cart[$id]);
            session()->put('cart', $cart);
            return redirect()->back()->with('success', $productName . ' removed from cart!');
        }

        return redirect()->back()->with('error', 'Item not found in cart!');
    }
}

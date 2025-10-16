<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function index()
    {
        $cartItems = session()->get('cart', []);

        if (empty($cartItems)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty');
        }

        $total = array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cartItems));

        return view('checkout.index', compact('cartItems', 'total'));
    }

    public function store(Request $request)
    {
        $cartItems = session()->get('cart', []);

        if (empty($cartItems)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty');
        }

        $request->validate([
            'shipping_name' => 'required|string|max:255',
            'shipping_email' => 'required|email|max:255',
            'shipping_phone' => 'required|string|max:20',
            'shipping_address' => 'required|string',
            'shipping_city' => 'required|string|max:255',
            'shipping_postal_code' => 'required|string|max:20',
            'payment_method' => 'required|in:cash,card',
            'notes' => 'nullable|string'
        ]);

        try {
            DB::beginTransaction();

            // Create order
            $total = array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cartItems));

            $order = Order::create([
                'user_id' => auth()->id(), // null if guest checkout
                'total_amount' => $total,
                'status' => 'pending',
                'shipping_name' => $request->shipping_name,
                'shipping_email' => $request->shipping_email,
                'shipping_phone' => $request->shipping_phone,
                'shipping_address' => $request->shipping_address,
                'shipping_city' => $request->shipping_city,
                'shipping_postal_code' => $request->shipping_postal_code,
                'payment_method' => $request->payment_method,
                'payment_status' => 'pending',
                'notes' => $request->notes
            ]);

            // Create order items
            foreach ($cartItems as $id => $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $id,
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                    'total' => $item['price'] * $item['quantity']
                ]);

                // Update product stock if needed
                // $product = Product::find($id);
                // $product->decrement('stock', $item['quantity']);
            }

            // Clear the cart
            session()->forget('cart');

            DB::commit();

            return redirect()->route('checkout.success', $order->id)
                           ->with('success', 'Order placed successfully!');

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()
                           ->with('error', 'Something went wrong! Please try again.')
                           ->withInput();
        }
    }

    public function success($orderId)
    {
        $order = Order::with('items.product')->findOrFail($orderId);
        return view('checkout.success', compact('order'));
    }
}

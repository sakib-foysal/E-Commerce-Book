@extends('layouts.homelayout')

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    function updateCartDisplay(response) {
        if (response.cartCount) {
            $('.cart-count').text(response.cartCount);
        }
        if (response.cartTotal) {
            $('.cart-total').text('৳' + response.cartTotal);
        }
        if (response.itemTotal) {
            $('#item-' + response.itemId + ' .item-total').text('৳' + response.itemTotal);
        }
    }

    // Handle quantity changes
    $('.quantity-form').on('submit', function(e) {
        e.preventDefault();
        const form = $(this);
        $.ajax({
            url: form.attr('action'),
            type: 'POST',
            data: form.serialize(),
            success: function(response) {
                updateCartDisplay(response);
                if (response.message) {
                    showAlert(response.message, 'success');
                }
            },
            error: function(xhr) {
                showAlert('Error updating cart', 'error');
            }
        });
    });

    // Handle direct quantity input
    $('.quantity-input').on('change', function() {
        $(this).closest('form').submit();
    });

    // Handle item removal
    $('.remove-item-form').on('submit', function(e) {
        e.preventDefault();
        if (!confirm('Are you sure you want to remove this item?')) return;

        const form = $(this);
        $.ajax({
            url: form.attr('action'),
            type: 'POST',
            data: form.serialize(),
            success: function(response) {
                $('#item-' + response.itemId).fadeOut(function() {
                    $(this).remove();
                    updateCartDisplay(response);
                    if ($('.cart-item').length === 0) {
                        location.reload(); // Reload if cart is empty
                    }
                });
            }
        });
    });

    function showAlert(message, type) {
        const alertDiv = $('<div>')
            .addClass('alert fixed top-4 right-4 px-6 py-3 rounded shadow-lg')
            .addClass(type === 'success' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700')
            .text(message);

        $('body').append(alertDiv);
        setTimeout(() => alertDiv.fadeOut(() => alertDiv.remove()), 3000);
    }
});
</script>
@endsection

@section('content')
<div class="container mx-auto mt-8 px-4">
    <h2 class="text-2xl font-bold mb-6">Your Cart</h2>

    <div id="alert-container"></div>

    @if(count($cartItems) > 0)
        <div class="grid grid-cols-1 gap-4">
            @foreach($cartItems as $id => $item)
            <div id="item-{{ $id }}" class="cart-item flex items-center justify-between bg-white p-4 rounded shadow">
                <div class="flex items-center space-x-4">
                    <!-- Product Image -->
                    @if(isset($item['image']))
                        <img src="{{ asset('storage/' . $item['image']) }}"
                             alt="{{ $item['name'] }}"
                             class="w-20 h-20 object-cover rounded">
                    @else
                        <div class="w-20 h-20 bg-gray-200 rounded flex items-center justify-center">
                            <span class="text-gray-500">No Image</span>
                        </div>
                    @endif

                    <div>
                        <h3 class="text-lg font-semibold">{{ $item['name'] }}</h3>
                        <p class="text-gray-700">Price: ৳{{ $item['price'] }}</p>

                        <!-- Quantity Controls -->
                        <div class="flex items-center mt-2 space-x-2">
                            <form action="{{ route('cart.update', $id) }}" method="POST"
                                  class="quantity-form flex items-center">
                                @csrf
                                @method('PATCH')
                                <button type="submit" name="action" value="decrease"
                                        class="bg-gray-200 px-2 py-1 rounded-l hover:bg-gray-300 transition">
                                    -
                                </button>
                                <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1"
                                       class="quantity-input w-16 text-center border-gray-200 border-y focus:ring-purple-500 focus:border-purple-500">
                                <button type="submit" name="action" value="increase"
                                        class="bg-gray-200 px-2 py-1 rounded-r hover:bg-gray-300 transition">
                                    +
                                </button>
                            </form>

                            <!-- Remove Item Button -->
                            <form action="{{ route('cart.remove', $id) }}" method="POST"
                                  class="remove-item-form inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="text-red-600 hover:text-red-800 transition ml-2">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="text-right">
                    <p class="text-lg font-bold item-total">৳{{ $item['price'] * $item['quantity'] }}</p>
                </div>
            </div>
            @endforeach

            <div class="text-right mt-4">
                <p class="text-xl font-bold">
                    Grand Total: <span class="cart-total">৳{{ array_sum(array_map(fn($i)=> $i['price']*$i['quantity'], $cartItems)) }}</span>
                </p>
                <a href="{{ route('checkout') }}"
                   class="inline-block mt-2 bg-purple-700 text-white py-2 px-4 rounded hover:bg-purple-800 transition">
                   Proceed to Checkout
                </a>
            </div>
        </div>
    @else
        <div class="text-center py-12">
            <p class="text-gray-600 mb-4">Your cart is empty</p>
            <a href="{{ route('categories') }}"
               class="inline-block bg-purple-700 text-white py-2 px-4 rounded hover:bg-purple-800 transition">
                Continue Shopping
            </a>
        </div>
    @endif
</div>
@endsection

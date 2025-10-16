@extends('layouts.homelayout')
@section('content')
<div class="container mt-4">
  <h2>Checkout</h2>
  <form action="{{ route('checkout.place') }}" method="POST">
    @csrf
    <div class="mb-3">
      <label>Address</label>
      <textarea name="address" class="form-control" required></textarea>
    </div>
    <div class="mb-3">
      <label>Payment Method</label>
      <select name="payment_method" class="form-control">
        <option value="COD">Cash On Delivery</option>
      </select>
    </div>
    <button type="submit" class="btn btn-success">Place Order</button>
  </form>
</div>
@endsection

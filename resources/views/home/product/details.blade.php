@extends('layouts.app')
@section('content')
<div class="container mt-4">
  <h2>{{ $product->name }}</h2>
  <div class="row">
    <div class="col-md-6">
      @foreach($product->images as $img)
        <img src="{{ asset('storage/'.$img->image_path) }}" class="img-fluid mb-2">
      @endforeach
    </div>
    <div class="col-md-6">
      <p>{{ $product->description }}</p>
      <h4>${{ $product->price }}</h4>
      <a href="{{ route('cart.add', $product->id) }}" class="btn btn-success">Add to Cart</a>
    </div>
  </div>
</div>
@endsection

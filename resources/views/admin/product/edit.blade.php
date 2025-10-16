@extends('layouts.app')
@section('content')
<div class="container mt-4">
  <h2>Edit Product</h2>
  <form action="{{ route('admin.product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
      <label>Name</label>
      <input type="text" name="name" value="{{ $product->name }}" class="form-control">
    </div>
    <div class="mb-3">
      <label>Description</label>
      <textarea name="description" class="form-control">{{ $product->description }}</textarea>
    </div>
    <div class="mb-3">
      <label>Price</label>
      <input type="number" name="price" step="0.01" value="{{ $product->price }}" class="form-control">
    </div>
    <div class="mb-3">
      <label>Stock</label>
      <input type="number" name="stock" value="{{ $product->stock }}" class="form-control">
    </div>
    <div class="mb-3">
      <label>Categories</label><br>
      @foreach($categories as $cat)
        <label>
          <input type="checkbox" name="category_id[]" value="{{ $cat->id }}"
          {{ $product->categories->contains($cat->id) ? 'checked' : '' }}> {{ $cat->name }}
        </label><br>
      @endforeach
    </div>
    <div class="mb-3">
      <label>Upload New Images</label>
      <input type="file" name="images[]" multiple class="form-control">
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
  </form>
</div>
@endsection

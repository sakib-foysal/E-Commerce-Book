@extends('layouts.app')
@section('content')
<div class="container mt-4">
  <h2>Product List</h2>
  <a href="{{ route('admin.product.add') }}" class="btn btn-success mb-3">Add Product</a>
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>ID</th><th>Name</th><th>Price</th><th>Stock</th><th>Categories</th><th>Images</th><th>Action</th>
      </tr>
    </thead>
    <tbody>
      @foreach($products as $product)
      <tr>
        <td>{{ $product->id }}</td>
        <td>{{ $product->name }}</td>
        <td>{{ $product->price }}</td>
        <td>{{ $product->stock }}</td>
        <td>
          @foreach($product->categories as $cat)
            <span class="badge bg-secondary">{{ $cat->name }}</span>
          @endforeach
        </td>
        <td>
          @foreach($product->images as $img)
            <img src="{{ asset('storage/'.$img->image_path) }}" width="50">
          @endforeach
        </td>
        <td>
          <a href="{{ route('admin.product.edit', $product->id) }}" class="btn btn-warning btn-sm">Edit</a>
          <a href="{{ route('admin.product.delete', $product->id) }}" class="btn btn-danger btn-sm">Delete</a>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection

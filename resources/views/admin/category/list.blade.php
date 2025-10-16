@extends('layouts.app')
@section('content')
<div class="container mt-4">
  <h2>Category List</h2>
  <a href="{{ route('admin.category.add') }}" class="btn btn-success mb-3">Add Category</a>
  <table class="table table-bordered">
    <thead>
      <tr><th>ID</th><th>Name</th><th>Description</th></tr>
    </thead>
    <tbody>
      @foreach($categories as $cat)
      <tr>
        <td>{{ $cat->id }}</td>
        <td>{{ $cat->name }}</td>
        <td>{{ $cat->description }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection

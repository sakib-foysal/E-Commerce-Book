@extends('layouts.app')
@section('content')
<div class="container mt-4">
  <h2>Add Category</h2>
  <form action="{{ route('admin.category.store') }}" method="POST">
    @csrf
    <div class="mb-3">
      <label>Name</label>
      <input type="text" name="name" class="form-control" required>
    </div>
    <div class="mb-3">
      <label>Description</label>
      <textarea name="description" class="form-control"></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Add Category</button>
  </form>
</div>
@endsection

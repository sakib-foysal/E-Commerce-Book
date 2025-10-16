@extends('layouts.app')
@section('content')
<div class="container text-center mt-5">
  <h2>Thank You!</h2>
  <p>Your order has been placed successfully.</p>
  <a href="{{ route('home') }}" class="btn btn-primary">Go Home</a>
</div>
@endsection

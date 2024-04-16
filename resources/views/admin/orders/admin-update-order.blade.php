@extends('layouts.admin')


@section('content')
<div class="container">
    <h2>Edit Order</h2>
    <form action="{{ route('orders-update', $order->id) }}" method="POST">
        @csrf
        @method('PATCH')
        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" class="form-control" id="username" name="username" value="{{ $order->user->username }}" readonly>
        </div>
        <div class="form-group">
            <label for="address">Address:</label>
            <input type="text" class="form-control" id="address" name="address" value="{{ $order->address }}">
        </div>
        <div class="form-group">
            <label for="phone_number">Phone Number:</label>
            <input type="text" class="form-control" id="phone_number" name="phone_number" value="{{ $order->phone_number }}">
        </div>
        <div class="form-group">
            <label for="payment_method">Payment Method:</label>
            <input type="text" class="form-control" id="payment_method" name="payment_method" value="{{ $order->payment_method }}">
        </div>


        <div class="form-group mt-3">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>


        </form>
        </div>
@endsection

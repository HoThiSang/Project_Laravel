@extends('layouts.master')

@section('css')
<style>
  .checkout-heading {
    color: #EE4D2D;
    font-weight: bold;
  }

  .custom-select {
    background-color: #EE4D2D;
    color: white;
  }

  .custom-button {
    background-color: #EE4D2D;
    border-color: #EE4D2D;
  }

  .custom-button:hover,
  .custom-button:active {
    background-color: #FFA07A;
    border-color: #FFA07A;
  }
</style>
@endsection

@section('content')
<form action="{{ route('checkoutPost') }}" method="post">
  @csrf
  <div class="container">
    <h3 class="checkout-heading">CHECKOUT PAGE</h3>
    <hr style="border-width: 2px; border-color: #C4C4C4">
    <h4 class="checkout-heading text-center mt-4">Bill information</h4>

    <div class="row">
      <div class="form-container">
        <div class="form-group mb-3 col-md-6">
          <label for="username" class="form-label">User name:</label>
          <input type="text" class="form-control" id="username" name="username" value="{{ isset($user->username) ? $user->username : 'N/A' }}">
          @error('username')
          <span style="color: red;">{{$message}}</span>
          @enderror
        </div>
        <input type="hidden" name="user_id" value="{{  $user->id}}">
        <div class="form-group mb-3 col-md-6">
          <label for="email" class="form-label">Email:</label>
          <input type="email" class="form-control" id="email" name="email" value="{{ isset($user->email) ? $user->email : 'N/A' }}">
          @error('email')
          <span style="color: red;">{{$message}}</span>
          @enderror
        </div>
        <div class="form-group mb-3 col-md-6">
          <label for="phone" class="form-label">Phone number:</label>
          <input type="text" class="form-control" id="phone" name="phone" value="{{ isset($user->phone) ? $user->phone : 'XXXXX' }}">
          @error('phone')
          <span style="color: red;">{{$message}}</span>
          @enderror
        </div>
        <div class="form-group mb-3 col-md-6">
          <label for="address" class="form-label">Address:</label>
          <input type="text" class="form-control" id="address" name="address" value="{{ isset($user->address) ? $user->address : 'ABC' }}">
          @error('address')
          <span style="color: red;">{{$message}}</span>
          @enderror
        </div>
      </div>
    </div>
    @php
    $totalPrice = 0;
    @endphp

    <h4 class="checkout-heading text-center mt-4">Order information</h4>
    <div class="form-container">
      <div class="form-row mt-3">
        <div class="form-group col-md-3">
          <label for="product">Product name</label>
        </div>
        <div class="form-group col-md-3">
          <label for="quantity">Quantity</label>
        </div>
        <div class="form-group col-md-3">
          <label for="unit-price">Unit price</label>
        </div>
        <div class="form-group col-md-3">
          <label for="total-price">Total price</label>
        </div>
        <?php $total = 0;
        $total_quantity = 0 ?>
        @foreach($carts as $item)
        <div class="form-group col-md-3">
          <label for="product">{{ $item->product_name }}</label>
        </div>
        <div class="form-group col-md-3">
          <label for="quantity">X{{ $item->quantity }}</label>
        </div>
        <div class="form-group col-md-3">
          <label for="unit-price">X{{ $item->price }}</label>
        </div>
        <div class="form-group col-md-3">
          <label for="total-price">{{ $item->price }}</label>
        
          @php
          
          $finalPrice = $item->quantity * $item->price;
          $totalPrice += $finalPrice;

          @endphp
        </div>


        <input type="hidden" value="{{ $item->product_id }}">

        @endforeach
      </div>
    </div>
    <input type="hidden" name="totalPrice" value="<?php echo number_format($totalPrice, 2) ?>">
    <div class="form-container">
      <div class="form-group col-md-12 text-right">
        <hr style="border-width: 2px; border-color: #C4C4C4; margin-top: 10px;">
        <div class="form-inline" style="display: flex; justify-content: space-between; align-items: center;">
          <h4 style="margin: 0;">Total of payment</h4>
          <label for=""><?php echo number_format($totalPrice, 2) ?></label>
          <input type="hidden" name="total_price" value="{{ number_format($total,2) }}">
        </div>
        <hr style="border-width: 2px; border-color: #C4C4C4; margin-top: 10px;">
      </div>
      <div class="form-group col-md-12 text-right">
        <div class="form-inline" style="display: flex; justify-content: space-between; align-items: center;">
          <h4 style="margin: 0;">Payment method</h4>
          <select class="btn-sm form-select custom-select" name="payment_method">

            <option name="payment_method" value="VNP">VNP</option>
            <option name="payment_method" value="COD">COD</option>
          </select>
        </div>
        <hr style="border-width: 2px; border-color: #C4C4C4; margin-top: 10px;">
      </div>
      <button type="submit" name="redirect" class="btn-lg btn-block custom-button">Place Order</button>
    </div>
  </div>
</form>
@endsection
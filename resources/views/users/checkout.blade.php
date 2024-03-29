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
    @foreach($user as $item)
    <div class="row">
      <div class="form-container">
        <div class="form-group mb-3 col-md-6">
          <label for="username" class="form-label">User name:</label>
          <input type="text" class="form-control" id="username" name="username" value="{{ $item->username }}">
          @error('username')
          <span style="color: red;">{{$message}}</span>
          @enderror
        </div>
        <input type="hidden" name="user_id" value="{{  $item->id}}">
        <div class="form-group mb-3 col-md-6">
          <label for="email" class="form-label">Email:</label>
          <input type="email" class="form-control" id="email" name="email" value="{{ $item->email }}">
          @error('email')
          <span style="color: red;">{{$message}}</span>
          @enderror
        </div>
        <div class="form-group mb-3 col-md-6">
          <label for="phone" class="form-label">Phone number:</label>
          <input type="text" class="form-control" id="phone" name="phone" value="{{ $item->phone }}">
          @error('phone')
          <span style="color: red;">{{$message}}</span>
          @enderror
        </div>
        <div class="form-group mb-3 col-md-6">
          <label for="address" class="form-label">Address:</label>
          <input type="text" class="form-control" id="address" name="address" value="{{ $item->address }}">
          @error('address')
          <span style="color: red;">{{$message}}</span>
          @enderror
        </div>
      </div>
    </div>
    @endforeach

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
        <?php $total = 0 ; $total_quantity = 0 ?>
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
          <label for="total-price">{{ $item->cart_price }}</label>
          <?php $total += $item->cart_price  ;
            $total_quantity +=$item->quantity ;
           ?>
        </div>
        
        <input type="hidden" value="{{ $item->product_id }}">
      
        @endforeach
      </div>
    </div>

    <div class="form-container">
      <div class="form-group col-md-12 text-right">
        <hr style="border-width: 2px; border-color: #C4C4C4; margin-top: 10px;">
        <div class="form-inline" style="display: flex; justify-content: space-between; align-items: center;">
          <h4 style="margin: 0;">Total of payment</h4>
          <label for="">{{ number_format($total,2) }}</label>
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
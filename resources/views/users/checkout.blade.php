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
<form action="" method="post">
  <div class="container">
    <h3 class="checkout-heading">CHECKOUT PAGE</h3>
    <hr style="border-width: 2px; border-color: #C4C4C4">
    <h4 class="checkout-heading text-center mt-4">Bill information</h4>
    <div class="form-container border">
      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="username">User name:</label>
          <input type="text" class="form-control" id="username">
        </div>
        <div class="form-group col-md-6">
          <label for="email">Email:</label>
          <input type="email" class="form-control" id="email">
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="phone">Phone number:</label>
          <input type="text" class="form-control" id="phone">
        </div>
        <div class="form-group col-md-6">
          <label for="address">Address:</label>
          <input type="text" class="form-control" id="address">
        </div>
      </div>
    </div>
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
        <!--for loop to dispay data of  -->
        <?php for ($i = 0; $i < 2; $i++) { ?>
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
        <?php } ?>
        <?php for ($i = 0; $i < 3; $i++) { ?>
          <input type="hidden" name="">
        <?php } ?>
      </div>
    </div>
    <div class="form-container">
      <div class="form-group col-md-12 text-right">
        <div class="form-inline" style="display: flex; justify-content: space-between; align-items: center;">
          <h4 style="margin: 0;">Payment method</h4>
          <select class="btn-sm form-select custom-select">
            <option disabled selected hidden>SELECT</option>
            <option value="VNP">VNP</option>
            <option value="COD">COD</option>
          </select>
        </div>
        <hr style="border-width: 2px; border-color: #C4C4C4; margin-top: 10px;">
      </div>
      <button type="submit" class="btn-lg btn-block custom-button">Place Order</button>
    </div>
</form>
@endsection
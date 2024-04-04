@extends('layouts.master')

@section('content')
    <div class="body-content outer-top-xs">
	<div class="container">
		<div class="row ">
			<div class="shopping-cart">
				<div class="shopping-cart-table ">
	<div class="table-responsive">
		<table class="table">
			<thead>
				<tr>
					<th class="cart-romove item">Remove</th>
					<th class="cart-description item">Image</th>
					<th class="cart-product-name item">Product Name</th>
					<th class="cart-qty item">Quantity</th>
					<th class="cart-sub-total item">Subtotal</th>
					<th class="cart-sub-total item">Discounted_price</th>
					<th class="cart-total last-item">Grandtotal</th>
				</tr>
			</thead><!-- /thead -->
			<tfoot>
				<tr>
					<td colspan="7">
						<div class="shopping-cart-btn">
							<span class="">
								<a href="#" class="btn btn-upper btn-primary outer-left-xs">Continue Shopping</a>
							</span>
						</div><!-- /.shopping-cart-btn -->
					</td>
				</tr>
			</tfoot>
			<tbody>
				@php
					$totalPrice = 0;
				@endphp
				@foreach($carts as $cart)
				<tr>
					<td class="romove-item">
						<a href="{{ route('cart.remove', $cart->product->id) }}" title="Remove" class="icon"><i class="fa fa-trash-o"></i></a>
					</td>

					<td class="cart-image">
						<a class="entry-thumbnail" href="{{ route('detail', $cart->product->id) }}">
						   <img src="{{ $cart->product->images->first()->image_url }}" alt="Product Image" class="img-fluid" height="120" width="50" id="large-image">
						</a>
					</td>
					<td class="cart-product-name-info">
						<h4 class='cart-product-description'><a href="{{ route('detail', $cart->product->id) }}">{{ $cart->product->product_name }}</a></h4>
					</td>
					<td class="cart-qty">
											{{ $cart->quantity }}
										</td>
					<td class="cart-product-sub-total"><span class="cart-sub-total-price">${{ $cart->product->price }}</span></td>
					<td class="cart-product-sub-total"><span class="cart-sub-discounted-price">${{ $cart->product->discounted_price }}</span></td>

					<td class="cart-product-grand-total"><span class="cart-grand-total-price">@php
                                                    // Tính toán giá cuối cùng của sản phẩm
                                                    $finalPrice = $cart->quantity * $cart->product->price;

                                                    // Kiểm tra nếu sản phẩm có giảm giá
                                                    if ($cart->product->discount > 0) {
                                                        // Tính toán giảm giá
                                                        $discountAmount = ($cart->product->discount / 100) * $finalPrice;
                                                        // Áp dụng giảm giá vào giá cuối cùng
                                                        $finalPrice -= $discountAmount;
                                                    }

                                                    // Cộng thêm giá cuối cùng vào tổng số tiền
                                                    $totalPrice += $finalPrice;
                                                @endphp
                                                ${{ number_format($finalPrice, 2) }}</span></td>
				</tr>
				@endforeach
			</tbody><!-- /tbody -->
		</table><!-- /table -->
	</div>
</div><!-- /.shopping-cart-table -->
<div class="col-md-4 col-sm-12 cart-shopping-total">
	<table class="table">
		<thead>
			<tr>
				<th>
					<div class="cart-sub-total">
						Subtotal<span class="inner-left-md">${{ number_format($totalPrice, 2) }}</span>
					</div>
					<div class="cart-grand-total">
						Grand Total<span class="inner-left-md">${{ number_format($totalPrice, 2) }}</span>
					</div>
				</th>
			</tr>
		</thead><!-- /thead -->
		<tbody>
				<tr>
					<td>
						<div class="cart-checkout-btn pull-right">
							<button type="submit" class="btn btn-primary checkout-btn">PROCCED TO CHEKOUT</button>
							<span class="">Checkout with multiples address!</span>
						</div>
					</td>
				</tr>
		</tbody><!-- /tbody -->
	</table><!-- /table -->
</div><!-- /.cart-shopping-total -->			</div><!-- /.shopping-cart -->
		</div> <!-- /.row -->
		<!-- ============================================== BRANDS CAROUSEL ============================================== -->
<div id="brands-carousel" class="logo-slider wow fadeInUp">

		<div class="logo-slider-inner">	
			<div id="brand-slider" class="owl-carousel brand-slider custom-carousel owl-theme">
				<div class="item m-t-15">
					<a href="#" class="image">
						<img data-echo="assets/images/brands/brand1.png" src="assets\images\blank.gif" alt="">
					</a>	
				</div><!--/.item-->

				<div class="item m-t-10">
					<a href="#" class="image">
						<img data-echo="assets/images/brands/brand2.png" src="assets\images\blank.gif" alt="">
					</a>	
				</div><!--/.item-->

				<div class="item">
					<a href="#" class="image">
						<img data-echo="assets/images/brands/brand3.png" src="assets\images\blank.gif" alt="">
					</a>	
				</div><!--/.item-->

				<div class="item">
					<a href="#" class="image">
						<img data-echo="assets/images/brands/brand4.png" src="assets\images\blank.gif" alt="">
					</a>	
				</div><!--/.item-->

				<div class="item">
					<a href="#" class="image">
						<img data-echo="assets/images/brands/brand5.png" src="assets\images\blank.gif" alt="">
					</a>	
				</div><!--/.item-->

				<div class="item">
					<a href="#" class="image">
						<img data-echo="assets/images/brands/brand6.png" src="assets\images\blank.gif" alt="">
					</a>	
				</div><!--/.item-->

				<div class="item">
					<a href="#" class="image">
						<img data-echo="assets/images/brands/brand2.png" src="assets\images\blank.gif" alt="">
					</a>	
				</div><!--/.item-->

				<div class="item">
					<a href="#" class="image">
						<img data-echo="assets/images/brands/brand4.png" src="assets\images\blank.gif" alt="">
					</a>	
				</div><!--/.item-->

				<div class="item">
					<a href="#" class="image">
						<img data-echo="assets/images/brands/brand1.png" src="assets\images\blank.gif" alt="">
					</a>	
				</div><!--/.item-->

				<div class="item">
					<a href="#" class="image">
						<img data-echo="assets/images/brands/brand5.png" src="assets\images\blank.gif" alt="">
					</a>	
				</div><!--/.item-->
		    </div><!-- /.owl-carousel #logo-slider -->
		</div><!-- /.logo-slider-inner -->
	
</div><!-- /.logo-slider -->
<!-- ============================================== BRANDS CAROUSEL : END ============================================== -->	</div><!-- /.container -->
</div><!-- /.body-content -->

@endsection
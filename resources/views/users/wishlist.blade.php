@extends('layouts.master')
@section('content')
<div class="body-content">
    <div class="container">
        <div class="my-wishlist-page">
            <div class="row">
                <div class="col-md-12 my-wishlist">
                    @if ($wishlist->count()>0)
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th colspan="4" class="heading-title">My Wishlist</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($wishlist as $item)
                                <tr>
                                    <td class="col-md-2"><img src="{{ $item->image->image_url }}" alt="imga"></td>
                                    <td class="col-md-7">
                                        <div class="product-name"><a href="#">{{ $item->products->product_name }}</a></div>
                                        <div class="rating">
                                            <i class="fa fa-star rate"></i>
                                            <i class="fa fa-star rate"></i>
                                            <i class="fa fa-star rate"></i>
                                            <i class="fa fa-star rate"></i>
                                            <i class="fa fa-star non-rate"></i>
                                            <span class="review">( 06 Reviews )</span>
                                        </div>
                                        <div class="price">
                                        {{ $item->products->price }}
                                            <span>$900.00</span>
                                        </div>
                                    </td>
                                    <td class="col-md-2">
                                        <a href="#" class="btn-upper btn btn-primary">Add to cart</a>
                                    </td>
                                    <td class="col-md-1 close-btn">
                                        <a href="#" class=""><i class="fa fa-times"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <h4>There are no products in your Wishlist</h4>
                    @endif
                </div>
            </div><!-- /.row -->
        </div><!-- /.sigin-in-->
    </div><!-- /.container -->
</div>
@endsection
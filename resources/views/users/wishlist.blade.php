@extends('layouts.master')
@section('content')
<style>
    button:hover .fa-heart {
        color: red;
    }

    .fill-heart {
        color: red !important;
    }
    </style>
    @if (session()->has('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
<div class="category-product">
    
    @if ($wishlist->isEmpty())
        <h1>No item in Wishlist</h1>
    @else
    <div>
        <h1>Wishlist</h1>
    </div>
        <div class="row">
            @foreach ($wishlist as $productMakeUp)
                <div class="col-sm-6 col-md-4 wow fadeInUp">
                    <div class="products">
                        <div class="product">
                            <div class="product-image">
                                <div class="image">
                                    <a href="{{ route('detail', ['id' => $productMakeUp->id]) }}">
                                        <img src="{{ asset('images/' . $productMakeUp->image_url) }}" alt="">
                                    </a>
                                </div>
                                <div class="tag new"><span>new</span></div>
                            </div>

                            <div class="product-info text-left">
                                <h3 class="name"><a href="{{ route('detail', ['id' => $productMakeUp->id]) }}">{{ $productMakeUp->product_name }}</a></h3>
                                <div class="rating rateit-small"></div>
                                <div class="description"></div>
                                <div class="product-price">
                                    <span class="price">{{ $productMakeUp->price }}</span>
                                    <span class="price-before-discount">{{ $productMakeUp->discounted_price }}</span>
                                </div>
                            </div>
                            <div class="cart clearfix animate-effect">
                                <div class="action">
                                    <ul class="list-unstyled">
                                        <li class="add-cart-button">
                                            <form id="addToCartForm" action="{{ route('addtocart', ['id' => $productMakeUp->id]) }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $productMakeUp->id }}">
                                                <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                                                <input type="hidden" name="price" value="{{ $productMakeUp->price }}">
                                                @php
                                                    $cart_item = App\Models\Cart::where('product_id', $productMakeUp->id)
                                                        ->where('user_id', auth()->user()->id)
                                                        ->first();
                                                @endphp
                                                <button type="submit" class="btn btn-primary icon">
                                                    <i class="fa fa-shopping-cart"></i>
                                                </button>
                                            </form>
                                        </li>

                                        <li class="wishlist-button">
                                            <form action="{{ route('addToWishlist', ['id' => $productMakeUp->id]) }}" method="post">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $productMakeUp->id }}">
                                                <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                                                @php
                                                    $wishlist_item = App\Models\WishList::where('product_id', $productMakeUp->id)
                                                        ->where('user_id', auth()->user()->id)
                                                        ->first();
                                                @endphp
                                                <button class="btn btn-primary" data-toggle="tooltip" data-placement="right" title="Wishlist" href="#">
                                                    
                                                        <i class="fa-solid fa-heart fill-heart"></i>
                                                    
                                                </button>
                                            </form>
                                        </li>

                                        <li class="lnk">
                                            <a data-toggle="tooltip" class="add-to-cart" href="" title="Compare">
                                                <i class="fa fa-signal" aria-hidden="true"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>

@endsection
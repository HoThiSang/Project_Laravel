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
    <div class="container" style="display: flex; justify-content: center; align-items: center; ">
        <div class="col-xs-12 col-sm-12 col-md-9 homebanner-holder ">

        <div id="hero">
            <div id="owl-main" class="owl-carousel owl-inner-nav owl-ui-sm">

                @foreach($bannerAll as $banner)
                <div class="item" style="background-image: url(<?php echo  $banner->image_url ?>)">
                    <div class="container-fluid">
                        <div class="caption bg-color vertical-center text-left">
                            <div class="slider-header fadeInDown-1">{{ $banner->title }}</div>
                            <div class="big-text fadeInDown-1"> {{ $banner->title }}</div>
                            <div class="excerpt fadeInDown-2 hidden-xs"> <span>{{ $banner->content }}</span> </div>
                            <div class="button-holder fadeInDown-3"> <a href="{{ route('categories') }}" class="btn-lg btn btn-uppercase btn-primary shop-now-button">Shop Now</a> </div>
                        </div>
                    </div>
                </div>
                @endforeach

            </div>
        </div>
        <!--/buttom slider-->
        <div class="info-boxes wow fadeInUp">
            <div class="info-boxes-inner">
                <div class="row">
                    <div class="col-md-6 col-sm-4 col-lg-4">
                        <div class="info-box">
                            <div class="row">
                                <div class="col-xs-12">
                                    <h4 class="info-box-heading green">money back</h4>
                                </div>
                            </div>
                            <h6 class="text">30 Days Money Back Guarantee</h6>
                        </div>
                    </div>

                    <div class="hidden-md col-sm-4 col-lg-4">
                        <div class="info-box">
                            <div class="row">
                                <div class="col-xs-12">
                                    <h4 class="info-box-heading green">free shipping</h4>
                                </div>
                            </div>
                            <h6 class="text">Shipping on orders over $99</h6>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-4 col-lg-4">
                        <div class="info-box">
                            <div class="row">
                                <div class="col-xs-12">
                                    <h4 class="info-box-heading green">Special Sale</h4>
                                </div>
                            </div>
                            <h6 class="text">Extra $5 off on all items </h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="product-tabs-slider" class="scroll-tabs outer-top-vs wow fadeInUp">
            <div class="more-info-tab clearfix ">
                <h3 class="new-product-title pull-left">All Products</h3>

            </div>
            <div class="tab-content outer-top-xs">
                <div class="tab-pane in active" id="all">
                    <div class="product-slider">
                        <div class="owl-carousel home-owl-carousel custom-carousel owl-theme" data-item="4">
                            @foreach ($products as $product)
                            <div class="item item-carousel">
                                <div class="products">
                                    <div class="product">
                                        <div class="product-image">
                                            <div class="image">
                                                <a href="{{ route('detail', ['id' => $product->id]) }}">
                                                    <img src="{{ asset('images/' . $product->image_url) }}" alt="">
                                                </a>
                                            </div>

                                            @if($product->discount>0)
                                            <div class="tag new"><span>{{ intval($product->discount) }}%</span></div>
                                            @else
                                            <!-- <div class="tag new"><span></span></div> -->
                                            @endif
                                        </div>


                                        <div class="product-info text-left">
                                            <h3 class="name"><a href="detail.html">{{ $product->product_name }}</a></h3>
                                            <div class="rating rateit-small"></div>
                                            <div class="description"></div>
                                            <div class="product-price">
                                                <span class="price">
                                                    @if (isset($product->price))
                                                    {{ $product->price }}
                                                    @endif
                                                </span>
                                                <span class="price-before-discount">{{ $product->discounted_price }}</span>
                                            </div>
                                        </div>
                                        @auth
                                        <div class="cart clearfix animate-effect">
                                            <div class="action">
                                                <ul class="list-unstyled">
                                                    <li class="add-cart-button">
                                                        <form id="addToCartForm" action="{{ route('addtocart', ['id' => $product->id]) }}" method="POST">
                                                            @csrf
                                                            <input type="hidden" name="id" value="{{ $product->id }}">
                                                            <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                                                            <input type="hidden" name="price" value="{{ $product->price }}">
                                                            @php
                                                            $cart_item = App\Models\Cart::where('product_id', $product->id)
                                                            ->where('user_id', auth()->user()->id)
                                                            ->first();
                                                            @endphp
                                                            <button type="submit" class="btn btn-primary icon">
                                                                <i class="fa fa-shopping-cart"></i>
                                                            </button>
                                                        </form>
                                                    </li>

                                                    <li class="wishlist-button">
                                                        <form action="{{ route('addToWishlist', ['id' => $product->id]) }}" method="post">
                                                            @csrf
                                                            <input type="hidden" name="id" value="{{ $product->id }}">
                                                            <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                                                            @php
                                                            $wishlist_item = App\Models\WishList::where('product_id', $product->id)
                                                            ->where('user_id', auth()->user()->id)
                                                            ->first();
                                                            @endphp
                                                            <button class="btn btn-primary" data-toggle="tooltip" data-placement="right" title="Wishlist" href="#">
                                                                @if ($wishlist_item)
                                                                <i class="fa-solid fa-heart fill-heart"></i>
                                                                @else
                                                                <i class="fa-solid fa-heart"></i>
                                                                @endif
                                                            </button>
                                                        </form>
                                                    </li>

                                                    <li class="lnk">
                                                        <a data-toggle="tooltip" class="add-to-cart" href="detail.html" title="Compare">
                                                            <i class="fa fa-signal" aria-hidden="true"></i>
                                                        </a>
                                                    </li>

                                                </ul>
                                            </div>
                                        </div>
                                        @endauth
                                    </div>


                                </div>

                            </div>

                            @endforeach

                        </div>

                    </div>

                </div>



            </div>
        </div>
        <div class="wide-banners wow fadeInUp outer-bottom-xs">
            <div class="row">
                <div class="col-md-7 col-sm-7">
                    <div class="wide-banner cnt-strip">
                        <div class="image"> <img class="img-responsive" src="https://img3.thuthuatphanmem.vn/uploads/2019/09/16/anh-banner-quang-cao-my-pham-kem-chong-nam_083546551.jpg" alt=""> </div>
                    </div>
                </div>
                <div class="col-md-5 col-sm-5">
                    <div class="wide-banner cnt-strip">
                        <div class="image"> <img class="img-responsive" src="https://res.cloudinary.com/dt8km1sxl/image/upload/v1710517848/V-Splush/makeup_sp1.2_icedxx.webp" alt=""> </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Discount of product -->
        <section class="section featured-product wow fadeInUp">
            <h3 class="section-title">Promotional products</h3>

            <div class="owl-carousel home-owl-carousel custom-carousel owl-theme outer-top-xs">
                @foreach ($productsWithDiscount as $productdiscount)
                <div class="item item-carousel">
                    <div class="products">
                        <div class="product">
                            <div class="product-image">
                                <div class="image"> <a href="{{ route('detail', ['id' => $productdiscount->id]) }}"><img src="{{ asset('images/' . $productdiscount->image_url) }}" alt=""></a> </div>
                                @if($product->discount>0)
                                <div class="tag new"><span>{{ intval($product->discount) }}%</span></div>
                                @else
                                @endif
                            </div>
                            <div class="product-info text-left">
                                <h3 class="name"><a href="detail.html">{{ $productdiscount->product_name }}</a>
                                </h3>
                                <div class="rating rateit-small"></div>
                                <div class="description"></div>
                                <div class="product-price"> <span class="price">
                                        {{ $productdiscount->discounted_price }}</span> <span class="price-before-discount">{{ $productdiscount->price }}</span> </div>

                            </div>
                            @auth
                            <div class="cart clearfix animate-effect">
                                <div class="action">
                                    <ul class="list-unstyled">
                                        <li class="add-cart-button">
                                            <form id="addToCartForm" action="{{ route('addtocart', ['id' => $productdiscount->id]) }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $productdiscount->id }}">
                                                <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                                                <input type="hidden" name="price" value="{{ $productdiscount->price }}">
                                                @php
                                                $cart_item = App\Models\Cart::where('product_id', $productdiscount->id)
                                                ->where('user_id', auth()->user()->id)
                                                ->first();
                                                @endphp
                                                <button type="submit" class="btn btn-primary icon">
                                                    <i class="fa fa-shopping-cart"></i>
                                                </button>
                                            </form>
                                        </li>

                                        <li class="wishlist-button">
                                            <form action="{{ route('addToWishlist', ['id' => $productdiscount->id]) }}" method="post">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $productdiscount->id }}">
                                                <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                                                @php
                                                $wishlist_item = App\Models\WishList::where('product_id', $productdiscount->id)
                                                ->where('user_id', auth()->user()->id)
                                                ->first();
                                                @endphp
                                                <button class="btn btn-primary" data-toggle="tooltip" data-placement="right" title="Wishlist" href="#">
                                                    @if ($wishlist_item)
                                                    <i class="fa-solid fa-heart fill-heart"></i>
                                                    @else
                                                    <i class="fa-solid fa-heart"></i>
                                                    @endif
                                                </button>
                                            </form>
                                        </li>

                                        <li class="lnk">
                                            <a data-toggle="tooltip" class="add-to-cart" href="detail.html" title="Compare">
                                                <i class="fa fa-signal" aria-hidden="true"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            @endauth
                        </div>

                    </div>
                </div>
                @endforeach

            </div>
        </section>

        <div class="wide-banners wow fadeInUp outer-bottom-xs">
            <div class="row">
                <div class="col-md-12">
                    <div class="wide-banner cnt-strip">
                        <div class="image"> <img class="img-responsive" src="https://bloganchoi.com/wp-content/uploads/2018/01/thuong-hieu-duoc-my-pham-la-roche-posay.jpg" alt=""> </div>
                        <div class="strip strip-text">
                            <div class="strip-inner">
                                <h2 class="text-right">New Skins for you<br>
                                    <span class="shopping-needs">Save up to 40% off</span>
                                </h2>
                            </div>
                        </div>
                        <div class="new-label">
                            <div class="text">NEW</div>
                        </div>

                    </div>

                </div>


            </div>

        </div>

        <section class="section latest-blog outer-bottom-vs wow fadeInUp">
            <h3 class="section-title">BLOG FOR PRODUCT</h3>
            <div class="blog-slider-container outer-top-xs">
                <div class="owl-carousel blog-slider custom-carousel">
                    <div class="item">
                        <div class="blog-post">
                            <div class="blog-post-image">
                                <div class="image"> <a href="blog.html"><img src="assets\images\blog-post\post1.jpg" alt=""></a> </div>
                            </div>
                            <div class="blog-post-info text-left">
                                <h3 class="name"><a href="#">Voluptatem accusantium doloremque laudantium</a>
                                </h3>
                                <span class="info">By Jone Doe &nbsp;|&nbsp; 21 March 2016 </span>
                                <p class="text">Sed quia non numquam eius modi tempora incidunt ut labore et dolore
                                    magnam aliquam quaerat voluptatem.</p>
                                <a href="#" class="lnk btn btn-primary">Read more</a>
                            </div>

                        </div>
                    </div>

                    <div class="item">
                        <div class="blog-post">
                            <div class="blog-post-image">
                                <div class="image"> <a href="blog.html"><img src="assets\images\blog-post\post2.jpg" alt=""></a> </div>
                            </div>

                            <div class="blog-post-info text-left">
                                <h3 class="name"><a href="#">Dolorem eum fugiat quo voluptas nulla
                                        pariatur</a></h3>
                                <span class="info">By Saraha Smith &nbsp;|&nbsp; 21 March 2016 </span>
                                <p class="text">Sed quia non numquam eius modi tempora incidunt ut labore et dolore
                                    magnam aliquam quaerat voluptatem.</p>
                                <a href="#" class="lnk btn btn-primary">Read more</a>
                            </div>

                        </div>
                    </div>
                    <div class="item">
                        <div class="blog-post">
                            <div class="blog-post-image">
                                <div class="image"> <a href="blog.html"><img src="assets\images\blog-post\post1.jpg" alt=""></a> </div>
                            </div>
                            <div class="blog-post-info text-left">
                                <h3 class="name"><a href="#">Dolorem eum fugiat quo voluptas nulla
                                        pariatur</a></h3>
                                <span class="info">By Saraha Smith &nbsp;|&nbsp; 21 March 2016 </span>
                                <p class="text">Sed ut perspiciatis unde omnis iste natus error sit voluptatem
                                    accusantium</p>
                                <a href="#" class="lnk btn btn-primary">Read more</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Sản phẩm giảm giá  -->
        <section class="section wow fadeInUp new-arriavls">
            <h3 class="section-title">Recomendation </h3>
            <div class="owl-carousel home-owl-carousel custom-carousel owl-theme outer-top-xs">
                @foreach ($productsSuggesteds as $productsSuggested)
                <div class="item item-carousel">
                    <div class="products">
                        <div class="product">
                            <div class="product-image">
                                <div class="image"> <a href="{{ route('detail', ['id' => $productsSuggested->id]) }}"><img src="{{ asset('images/' . $productsSuggested->image_url) }}" alt=""></a> </div>

                                <div class="tag new"><span>new</span></div>
                                @if($product->discount>0)
                                <div class="tag hot"><span>hot</span></div>
                                @else
                                @endif
                            </div>
                            <div class="product-info text-left">
                                <h3 class="name"><a href="detail.html">{{ $productsSuggested->product_name }}</a></h3>
                                <div class="rating rateit-small"></div>
                                <div class="description"></div>
                                <div class="product-price"> <span class="price">{{ $productsSuggested->price }}
                                    </span> <span class="price-before-discount">$ 800</span> </div>

                            </div>
                            <!-- /.product-info -->
                            @auth
                            <div class="cart clearfix animate-effect">
                                <div class="action">
                                    <ul class="list-unstyled">
                                        <li class="add-cart-button">
                                            <form id="addToCartForm" action="{{ route('addtocart', ['id' => $productsSuggested->id]) }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $productsSuggested->id }}">
                                                <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                                                <input type="hidden" name="price" value="{{ $productsSuggested->price }}">
                                                @php
                                                $cart_item = App\Models\Cart::where('product_id', $productsSuggested->id)
                                                ->where('user_id', auth()->user()->id)
                                                ->first();
                                                @endphp
                                                <button type="submit" class="btn btn-primary icon">
                                                    <i class="fa fa-shopping-cart"></i>
                                                </button>
                                            </form>
                                        </li>

                                        <li class="wishlist-button">
                                            <form action="{{ route('addToWishlist', ['id' => $productsSuggested->id]) }}" method="post">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $productsSuggested->id }}">
                                                <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                                                @php
                                                $wishlist_item = App\Models\WishList::where('product_id', $productsSuggested->id)
                                                ->where('user_id', auth()->user()->id)
                                                ->first();
                                                @endphp
                                                <button class="btn btn-primary" data-toggle="tooltip" data-placement="right" title="Wishlist" href="#">
                                                    @if ($wishlist_item)
                                                    <i class="fa-solid fa-heart fill-heart"></i>
                                                    @else
                                                    <i class="fa-solid fa-heart"></i>
                                                    @endif
                                                </button>
                                            </form>
                                        </li>

                                        <li class="lnk">
                                            <a data-toggle="tooltip" class="add-to-cart" href="detail.html" title="Compare">
                                                <i class="fa fa-signal" aria-hidden="true"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            @endauth
                        </div>

                    </div>
                </div>
                @endforeach


            </div>

        </section>

    </div>
</div>
@endsection
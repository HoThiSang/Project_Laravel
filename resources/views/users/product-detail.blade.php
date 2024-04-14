@extends('layouts.master')

@section('css')
<style>
    .small-images {
        display: flex;
        justify-content: flex-start;
        align-items: center;
        margin-top: 20px;
        /* Tạo khoảng cách phía trên */
    }

    .single-product-gallery-item {
        margin-bottom: 20px;
        /* Tạo khoảng cách phía dưới */
    }

    .small-image {
        margin-right: 10px;
        cursor: pointer;
        border: 1px solid #ccc;
        /* Tạo khung bao quanh ảnh */
        padding: 5px;
        /* Tạo khoảng cách giữa khung và ảnh */
    }

    .small-image:hover {
        opacity: 0.7;
    }
</style>
@endsection
@section('content')
@if (session()->has('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif
<div class="body-content outer-top-xs">
    <div class='container'>
        <div class='row single-product'>
            <div class='col-md-12'>
                <div class="detail-block">
                    <form action="{{ route('addtocart', ['id' => $product->id]) }}" method="post">
                        @csrf
                        <div class="row  wow fadeInUp">
                            <div class="col-xs-12 col-sm-6 col-md-5 gallery-holder">
                                <div class="product-item-holder size-big">
                                    <div id="owl-single-product">
                                        <div class="single-product-gallery-item mt-3" id="slide1">
                                            <img src="{{ '/images/'.$product_images[0]->image_url }}" alt="Product Image" class="img-fluid" height="400" width="450" id="large-image">
                                        </div>
                                        <div class="small-images mt-3">
                                            @foreach ($product_images as $image)
                                            <div class="small-image">
                                                <img src="{{ '/images/'. $image->image_url }}" alt="Product Image" class="img-fluid" data-large-image="{{ '/images/ '.$image->image_url }}" height="100" width="128" onclick="changeLargeImage('{{ $image->image_url }}')">
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class='col-sm-6 col-md-7 product-info-block'>
                                <div class="product-info">
                                    @if (isset($product))
                                    <h1 class="name">{{ $product->product_name }}</h1>
                                    <div class="rating-reviews m-t-20">
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <div class="rating rateit-small"></div>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="reviews">
                                                    <a href="#" class="lnk">(13 Reviews)</a>
                                                </div>
                                            </div>
                                        </div><!-- /.row -->
                                    </div><!-- /.rating-reviews -->
                                    <div class="stock-container info-container m-t-10">
                                        <div class="row">
                                            <div class="col-sm-2">
                                                <div class="stock-box">
                                                    <span class="label">Availability :</span>
                                                </div>
                                            </div>
                                            <div class="col-sm-9">
                                                <div class="stock-box">
                                                    <span class="value">In Stock</span>
                                                </div>
                                            </div>
                                        </div><!-- /.row -->
                                    </div><!-- /.stock-container -->
                                    <div class="description-container m-t-20">
                                        {{ $product->description }}
                                    </div><!-- /.description-container -->
                                    <div class="price-container info-container m-t-20">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="price-box">
                                                    <span class="price">{{ $price }}</span>
                                                    @if ($discountedPrice)
                                                    <span class="price-strike">{{ $discountedPrice }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="favorite-button m-t-10">
                                                    <a class="btn btn-primary" data-toggle="tooltip" data-placement="right" title="Wishlist" href="#">
                                                        <i class="fa fa-heart"></i>
                                                    </a>
                                                    <a class="btn btn-primary" data-toggle="tooltip" data-placement="right" title="Add to Compare" href="#">
                                                        <i class="fa fa-signal"></i>
                                                    </a>
                                                    <a class="btn btn-primary" data-toggle="tooltip" data-placement="right" title="E-mail" href="#">
                                                        <i class="fa fa-envelope"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="quantity-container info-container">
                                        <div class="row">
                                            <div class="col-sm-2">
                                                <span class="label">Qty :</span>
                                            </div>
                                            <div class="col-sm-2">
                                                <label for="Quantity">Quantity</label>
                                                <div class="input-group text-center mb-3" style="width:130px;">
                                                    <button class="input-group-text decrement-btn">-</button>
                                                    <input type="text" name="quantity" class="form-control qty-input text-center" value="1">
                                                    <button class="input-group-text increment-btn">+</button>

                                                </div>
                                                {{-- <div class="cart-quantity">
                                                            <div class="quant-input">
                                                                <div class="arrows">
                                                                    <div class="arrow plus gradient"><span class="ir"><i
                                                                                class="icon fa fa-sort-asc"></i></span>
                                                                    </div>
                                                                    <div class="arrow minus gradient"><span
                                                                            class="ir"><i
                                                                                class="icon fa fa-sort-desc"></i></span>
                                                                    </div>
                                                                </div>
                                                                <input type="text" value="1">
                                                            </div>
                                                        </div> --}}
                                            </div>
                                            <input type="hidden" name="id" value="{{ $product->id }}">
                                            <input type="hidden" name="use_id" value="1">
                                            <input type="hidden" name="price" value="{{ $product->price }}">
                                            <div class="col-sm-7">
                                                <button type="submit" class="btn btn-primary"><i class="fa fa-shopping-cart inner-right-vs"></i> ADD TO
                                                    CART</button>
                                            </div>

                                            <button class="btn btn-primary addToWishlist" type="button" data-toggle="tooltip" data-placement="right" title="Wishlist" onclick="addToWishlist(event)">
                                                <i class="fa fa-heart addToWishlist"></i>
                                            </button>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </form>

                </div>

                <div class="product-tabs inner-bottom-xs  wow fadeInUp">
                    <div class="row">
                        <div class="col-sm-3">
                            <ul id="product-tabs" class="nav nav-tabs nav-tab-cell">
                                <li class="active"><a data-toggle="tab" href="#description">DESCRIPTION</a></li>
                            </ul>
                        </div>
                        <div class="col-sm-9">
                            <div class="tab-content">
                                <div id="description" class="tab-pane in active">
                                    <div class="product-tab">
                                        @if (isset($product))
                                        <p class="text">{{ $product->description }}</p>
                                        @endif
                                    </div>
                                </div>
                                <div id="review" class="tab-pane">
                                    <div class="product-tab">
                                        <div class="product-reviews">
                                            <h4 class="title">Customer Reviews</h4>
                                            <div class="reviews">
                                                <div class="review">
                                                    <div class="review-title"><span class="summary">We love this
                                                            product</span><span class="date"><i class="fa fa-calendar"></i><span>1 days
                                                                ago</span></span></div>
                                                </div>
                                            </div>
                                            <div class="product-add-review">
                                                <h4 class="title">Write your own review</h4>
                                                <div class="review-table">
                                                    <div class="table-responsive">
                                                        <table class="table">
                                                            <thead>
                                                                <tr>
                                                                    <th class="cell-label">&nbsp;</th>
                                                                    <th>1 star</th>
                                                                    <th>2 stars</th>
                                                                    <th>3 stars</th>
                                                                    <th>4 stars</th>
                                                                    <th>5 stars</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td class="cell-label">Quality</td>
                                                                    <td><input type="radio" name="quality" class="radio" value="1"></td>
                                                                    <td><input type="radio" name="quality" class="radio" value="2"></td>
                                                                    <td><input type="radio" name="quality" class="radio" value="3"></td>
                                                                    <td><input type="radio" name="quality" class="radio" value="4"></td>
                                                                    <td><input type="radio" name="quality" class="radio" value="5"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="cell-label">Price</td>
                                                                    <td><input type="radio" name="quality" class="radio" value="1"></td>
                                                                    <td><input type="radio" name="quality" class="radio" value="2"></td>
                                                                    <td><input type="radio" name="quality" class="radio" value="3"></td>
                                                                    <td><input type="radio" name="quality" class="radio" value="4"></td>
                                                                    <td><input type="radio" name="quality" class="radio" value="5"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="cell-label">Value</td>
                                                                    <td><input type="radio" name="quality" class="radio" value="1"></td>
                                                                    <td><input type="radio" name="quality" class="radio" value="2"></td>
                                                                    <td><input type="radio" name="quality" class="radio" value="3"></td>
                                                                    <td><input type="radio" name="quality" class="radio" value="4"></td>
                                                                    <td><input type="radio" name="quality" class="radio" value="5"></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="review-form">
                                                    <div class="form-container">
                                                        <form role="form" class="cnt-form">
                                                            <div class="row">
                                                                <div class="col-sm-6">
                                                                    <div class="form-group">
                                                                        <label for="exampleInputName">Your Name <span class="astk">*</span></label>
                                                                        <input type="text" class="form-control txt" id="exampleInputName" placeholder="">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="exampleInputSummary">Summary <span class="astk">*</span></label>
                                                                        <input type="text" class="form-control txt" id="exampleInputSummary" placeholder="">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="exampleInputReview">Review <span class="astk">*</span></label>
                                                                        <textarea class="form-control txt txt-review" id="exampleInputReview" rows="4" placeholder=""></textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="action text-right">
                                                                <button class="btn btn-primary btn-upper">SUBMIT
                                                                    REVIEW</button>
                                                            </div>
                                                            < </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="tags" class="tab-pane">
                                        <div class="product-tag">
                                            <h4 class="title">Product Tags</h4>
                                            <form role="form" class="form-inline form-cnt">
                                                <div class="form-container">
                                                    <div class="form-group">
                                                        <label for="exampleInputTag">Add Your Tags: </label>
                                                        <input type="email" id="exampleInputTag" class="form-control txt">
                                                    </div>
                                                    <button class="btn btn-upper btn-primary" type="submit">ADD
                                                        TAGS</button>
                                                </div>
                                            </form>
                                            <form role="form" class="form-inline form-cnt">
                                                <div class="form-group">
                                                    <label>&nbsp;</label>
                                                    <span class="text col-md-offset-3">Use spaces to separate tags. Use
                                                        single quotes (') for phrases.</span>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div><!-- /.row -->
        </div>
    </div>

    @endsection

    @section('js')
    <script src="https://unpkg.com/sweetalert@2.1.2/dist/sweetalert.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        //bd
        $(document).ready(function() {
            $('.increment-btn').click(function(e) {
                e.preventDefault();

                var inc_value = $('.qty-input').val();
                var value = parseInt(inc_value, 10);
                value = isNaN(value) ? 0 : value;
                if (value < 10) {
                    value++;
                    $('.qty-input').val(value);
                }
            })

            $('.decrement-btn').click(function(e) {
                e.preventDefault();

                var dec_value = $('.qty-input').val();
                var value = parseInt(dec_value, 10);
                value = isNaN(value) ? 0 : value;
                if (value > 1) {
                    value--;
                    $('.qty-input').val(value);
                }
            })
        });

        //kt
        // function addToWishlist(event) {
        //     var csrfToken = $('meta[name="csrf-token"]').attr('content');
        //     event.preventDefault();
        //     var product_id = $(event.target).closest('.product_data').find('.product_id').val();

        //     const token = "{{ csrf_token() }}";
        //     const id = "{{ $product->id }}";
        //     $.ajax({
        //         method: "POST",
        //         url: "/add-to-wishlist",
        //         data: {
        //             _token: token,
        //             product_id: id
        //         },
        //         success: function(response) {
        //             swal({
        //                 title: "Success",
        //                 text: response.status,
        //                 icon: "success",
        //             });
        //         },
        //         error: function(xhr, status, error) {
        //             swal({
        //                 title: "Error",
        //                 text: "An error occurred: " + error,
        //                 icon: "error",
        //             });
        //         }
        //     });

        //     // $.ajaxSetup({
        //     //     headers: {
        //     //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //     //     }
        //     // });
        // }

        // document.addEventListener('DOMContentLoaded', function() {
        //     var smallImages = document.querySelectorAll('.small-image');
        //     var largeImage = document.getElementById('large-image');

        //     smallImages.forEach(function(smallImage) {
        //         smallImage.addEventListener('click', function() {
        //             var largeImageUrl = smallImage.getAttribute('data-large-image');
        //             largeImage.src = largeImageUrl;
        //         });
        //     });
        // });
    </script>
    @endsection
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
    <div class="body-content outer-top-xs">
        <div class='container'>
            <div class='row'>
                    <div class="search-result-container ">
                        <div id="myTabContent" class="tab-content category-list">
                            <div class="tab-pane active " id="grid-container">
                                <div class="category-product">
                                    <div>
                                        <h1>Kết quả tìm kiếm</h1>
                                    </div>
                                                    <div class="row">
                                                        @foreach ($products as $productMakeUp)
                                                            <div class="col-sm-6 col-md-4 wow fadeInUp">
                                                                <div class="products">
                                                                    <div class="product">
                                                                        <div class="product-image">
                                                                            <div class="image">
                                                                                <a
                                                                                    href="{{ route('detail', ['id' => $productMakeUp->id]) }}">
                                                                                    <img src="{{ asset('images/' . $productMakeUp->image_url) }}"
                                                                                        alt="">
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
                                                                        
                
                                                                    </div>
                
                
                                                                </div>
                
                                                            </div>
                                                        @endforeach
                
                
                                                    </div>
                                                </div>
                
                
                                            </div>
                
                                        </div>
                                        <!--
                                            <div class="clearfix filters-container">
                                                <div class="text-right">
                                                    <div class="pagination-container">
                                                        <ul class="list-inline list-unstyled">
                                                            <li class="prev"><a href="#"><i class="fa fa-angle-left"></i></a></li>
                                                            <li><a href="#">1</a></li>
                                                            <li class="active"><a href="#">2</a></li>
                                                            <li><a href="#">3</a></li>
                                                            <li><a href="#">4</a></li>
                                                            <li class="next"><a href="#"><i class="fa fa-angle-right"></i></a></li>
                                                        </ul>
                                                     
                                                    </div>
                                                  
                                                </div>
                                             
                
                                            </div> -->
                                        <!-- /.filters-container -->
                
                                    </div>
                                </div>


                            </div>

                        </div>
                        <!--
                            <div class="clearfix filters-container">
                                <div class="text-right">
                                    <div class="pagination-container">
                                        <ul class="list-inline list-unstyled">
                                            <li class="prev"><a href="#"><i class="fa fa-angle-left"></i></a></li>
                                            <li><a href="#">1</a></li>
                                            <li class="active"><a href="#">2</a></li>
                                            <li><a href="#">3</a></li>
                                            <li><a href="#">4</a></li>
                                            <li class="next"><a href="#"><i class="fa fa-angle-right"></i></a></li>
                                        </ul>
                                     
                                    </div>
                                  
                                </div>
                             

                            </div> -->
                        <!-- /.filters-container -->

                    </div>


                </div>
            </div>
        </div>

        <div id="brands-carousel" class="logo-slider wow fadeInUp">
            <div class="logo-slider-inner">
                <div id="brand-slider" class="owl-carousel brand-slider custom-carousel owl-theme">
                    <div class="item m-t-15"> <a href="#" class="image"> <img
                                data-echo="assets/images/brands/brand1.png" src="assets\images\blank.gif" alt="">
                        </a> </div>


                    <div class="item m-t-10"> <a href="#" class="image"> <img
                                data-echo="assets/images/brands/brand2.png" src="assets\images\blank.gif" alt="">
                        </a> </div>


                    <div class="item"> <a href="#" class="image"> <img
                                data-echo="assets/images/brands/brand3.png" src="assets\images\blank.gif" alt="">
                        </a> </div>


                    <div class="item"> <a href="#" class="image"> <img
                                data-echo="assets/images/brands/brand4.png" src="assets\images\blank.gif" alt="">
                        </a> </div>


                    <div class="item"> <a href="#" class="image"> <img
                                data-echo="assets/images/brands/brand5.png" src="assets\images\blank.gif" alt="">
                        </a> </div>


                    <div class="item"> <a href="#" class="image"> <img
                                data-echo="assets/images/brands/brand6.png" src="assets\images\blank.gif" alt="">
                        </a> </div>


                    <div class="item"> <a href="#" class="image"> <img
                                data-echo="assets/images/brands/brand2.png" src="assets\images\blank.gif" alt="">
                        </a> </div>


                    <div class="item"> <a href="#" class="image"> <img
                                data-echo="assets/images/brands/brand4.png" src="assets\images\blank.gif" alt="">
                        </a> </div>


                    <div class="item"> <a href="#" class="image"> <img
                                data-echo="assets/images/brands/brand1.png" src="assets\images\blank.gif" alt="">
                        </a> </div>


                    <div class="item"> <a href="#" class="image"> <img
                                data-echo="assets/images/brands/brand5.png" src="assets\images\blank.gif" alt="">
                        </a> </div>

                </div>

            </div>


        </div>

    </div>

    </div>
@endsection

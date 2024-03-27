@extends('layouts.master')
@section('content')
<div class="body-content outer-top-xs">
    <div class='container'>
        <div class='row'>
            <div class='col-md-3 sidebar'>
                <!-- ================================== TOP NAVIGATION ================================== -->
                <div class="side-menu animate-dropdown outer-bottom-xs">
                    <div class="head"><i class="icon fa fa-align-justify fa-fw"></i> Categories</div>
                    <nav class="yamm megamenu-horizontal">
                        <ul class="nav">
                            <li class=" menu-item"> <a href="?sort-by=Make up" class="-toggle" data-toggle=""><i class="icon fa fa-shopping-bag" aria-hidden="true"></i>Make up</a>
                            </li>
                           
                            <li class="dropdown menu-item"> <a href="?sort-by=Body" class="dropdown-toggle" data-toggle=""><i class="icon fa fa-laptop" aria-hidden="true"></i>Body care</a>

                            </li>

                            <li class=" menu-item"> <a href="?sort-by=Skincare" class="-toggle" data-toggle=""><i class="icon fa fa-paw" aria-hidden="true"></i>Skincare</a>

                            </li>

                            <li class=" menu-item"> <a href="?sort-by=Fragrance" class="-toggle" data-toggle=""><i class="icon fa fa-clock-o"></i>Fragrance</a>

                            </li>

                            <li class=" menu-item"> <a href="?sort-by=Hair" class="-toggle" data-toggle=""><i class="icon fa fa-diamond"></i>Hair</a>

                            </li>

                            <li class=" menu-item"> <a href="#" class="-toggle" data-toggle=""><i class="icon fa fa-heartbeat"></i>Health and Beauty</a>

                            </li>

                            <li class=" menu-item"> <a href="#" class="-toggle" data-toggle=""><i class="icon fa fa-paper-plane"></i>Kids and Babies</a>
                            </li>


                            <li class=" menu-item"> <a href="#" class="-toggle" data-toggle=""><i class="icon fa fa-futbol-o"></i>Sports</a>

                            </li>

                            <li class=" menu-item"> <a href="#" class="-toggle" data-toggle=""><i class="icon fa fa-envira"></i>Home and Garden</a>
                            </li>
                        </ul>

                    </nav>

                </div>

                <div class="sidebar-module-container">
                    <div class="sidebar-filter">

                    </div>

                </div>

            </div>
            <div class='col-md-9'>
                <!-- ========================================== SECTION – HERO ========================================= -->

                <div id="category" class="category-carousel hidden-xs">
                    <div class="item">
                        <div class="image"> <img src="assets\images\banners\cat-banner-1.jpg" alt="" class="img-responsive"> </div>
                        <div class="container-fluid">
                            <div class="caption vertical-top text-left">
                                <div class="big-text"> Big Sale </div>
                                <div class="excerpt hidden-sm hidden-md"> Save up to 49% off </div>
                                <div class="excerpt-normal hidden-sm hidden-md"> Lorem ipsum dolor sit amet, consectetur adipiscing elit </div>
                            </div>
                            <!-- /.caption -->
                        </div>
                        <!-- /.container-fluid -->
                    </div>
                </div>


                <div class="search-result-container ">
                    <div id="myTabContent" class="tab-content category-list">
                        <div class="tab-pane active " id="grid-container">
                            <div class="category-product">
                                <div>
                                    <h1>{{$title }}</h1>
                                </div>
                                <div class="row">
                                    @foreach ($products as $productMakeUp)

                                    <div class="col-sm-6 col-md-4 wow fadeInUp">
                                        <div class="products">
                                            <div class="product">
                                                <div class="product-image">
                                                    <div class="image">
                                                        <a href="{{ route('detail', ['id' => $productMakeUp->id]) }}">
                                                            <img src="{{ $productMakeUp->image_url }}" alt="">
                                                        </a>
                                                    </div>
                                                    <!-- /.image -->

                                                    <div class="tag new"><span>new</span></div>
                                                </div>
                                                <!-- /.product-image -->

                                                <div class="product-info text-left">
                                                    <h3 class="name"><a href="detail.html">Floral Print Buttoned</a></h3>
                                                    <div class="rating rateit-small"></div>
                                                    <div class="description"></div>
                                                    <div class="product-price"> <span class="price"> $450.99 </span> <span class="price-before-discount">$ 800</span> </div>
                                                    <!-- /.product-price -->

                                                </div>
                                                <!-- /.product-info -->
                                                <div class="cart clearfix animate-effect">
                                                    <div class="action">
                                                        <ul class="list-unstyled">
                                                            <li class="add-cart-button btn-group">
                                                                <button class="btn btn-primary icon" data-toggle="dropdown" type="button"> <i class="fa fa-shopping-cart"></i> </button>
                                                                <button class="btn btn-primary cart-btn" type="button">Add to cart</button>
                                                            </li>
                                                            <li class="lnk wishlist"> <a class="add-to-cart" href="detail.html" title="Wishlist"> <i class="icon fa fa-heart"></i> </a> </li>
                                                            <li class="lnk"> <a class="add-to-cart" href="#" title="Compare"> <i class="fa fa-signal"></i> </a> </li>
                                                        </ul>
                                                    </div>
                                                    <!-- /.action -->
                                                </div>
                                                <!-- /.cart -->
                                            </div>
                                            <!-- /.product -->

                                        </div>
                                        <!-- /.products -->
                                    </div>
                                    <!-- /.item -->

                                    @endforeach


                                </div>
                                <!-- /.row -->
                            </div>
                            <!-- /.category-product -->

                        </div>
                        <!-- /.tab-pane -->

                        <!-- /.tab-pane #list-container -->
                    </div>
                    <!-- /.tab-content -->
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
                <!-- /.search-result-container -->


            </div>
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
    <!-- ============================================== BRANDS CAROUSEL ============================================== -->
    <div id="brands-carousel" class="logo-slider wow fadeInUp">
        <div class="logo-slider-inner">
            <div id="brand-slider" class="owl-carousel brand-slider custom-carousel owl-theme">
                <div class="item m-t-15"> <a href="#" class="image"> <img data-echo="assets/images/brands/brand1.png" src="assets\images\blank.gif" alt=""> </a> </div>
                <!--/.item-->

                <div class="item m-t-10"> <a href="#" class="image"> <img data-echo="assets/images/brands/brand2.png" src="assets\images\blank.gif" alt=""> </a> </div>
                <!--/.item-->

                <div class="item"> <a href="#" class="image"> <img data-echo="assets/images/brands/brand3.png" src="assets\images\blank.gif" alt=""> </a> </div>
                <!--/.item-->

                <div class="item"> <a href="#" class="image"> <img data-echo="assets/images/brands/brand4.png" src="assets\images\blank.gif" alt=""> </a> </div>
                <!--/.item-->

                <div class="item"> <a href="#" class="image"> <img data-echo="assets/images/brands/brand5.png" src="assets\images\blank.gif" alt=""> </a> </div>
                <!--/.item-->

                <div class="item"> <a href="#" class="image"> <img data-echo="assets/images/brands/brand6.png" src="assets\images\blank.gif" alt=""> </a> </div>
                <!--/.item-->

                <div class="item"> <a href="#" class="image"> <img data-echo="assets/images/brands/brand2.png" src="assets\images\blank.gif" alt=""> </a> </div>
                <!--/.item-->

                <div class="item"> <a href="#" class="image"> <img data-echo="assets/images/brands/brand4.png" src="assets\images\blank.gif" alt=""> </a> </div>
                <!--/.item-->

                <div class="item"> <a href="#" class="image"> <img data-echo="assets/images/brands/brand1.png" src="assets\images\blank.gif" alt=""> </a> </div>
                <!--/.item-->

                <div class="item"> <a href="#" class="image"> <img data-echo="assets/images/brands/brand5.png" src="assets\images\blank.gif" alt=""> </a> </div>
                <!--/.item-->
            </div>
            <!-- /.owl-carousel #logo-slider -->
        </div>
        <!-- /.logo-slider-inner -->

    </div>
    <!-- /.logo-slider -->
    <!-- ============================================== BRANDS CAROUSEL : END ============================================== -->
</div>
<!-- /.container -->

</div>

@endsection
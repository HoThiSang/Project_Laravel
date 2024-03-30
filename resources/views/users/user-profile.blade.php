@extends('layouts.master')
@section('css')
<style>
    .default-image-wrapper {
        width: 100px;
        height: 100px;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .default-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .button-wrapper {
        flex-grow: 1;
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        justify-content: flex-start;
    }
</style>
@endsection
@section('content')
<div class="body-content outer-top-xs">
    <div class='container'>
        <div class='row'>
            <div class='col-md-3 sidebar'>
                <!-- ================================== TOP NAVIGATION ================================== -->
                <div class="side-menu animate-dropdown outer-bottom-xs">
                    <div class="head">
                        <img src="https://down-vn.img.susercontent.com/file/cdf9af013aa652eb0596cb252b1101d4_tn" alt="">

                        <p class="text-center">Nhã Trần</p>

                    </div>
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
                        </ul>

                    </nav>

                </div>

                <div class="sidebar-module-container">
                    <div class="sidebar-filter">

                    </div>

                </div>

            </div>
            <div class='col-md-9'>
                <!-- ========================================== SECTION – PROFILE ========================================= -->
                <div class="search-result-container ">
                    <div id="myTabContent" class="tab-content category-list">
                        <div class="tab-pane active " id="grid-container">
                            <div class="category-product">
                                <div>
                                    <h1></h1>
                                </div>
                                <div class="row">
                                    <div class="card mb-4">
                                        <h5 class="card-header">Profile Details</h5>

                                        <div class="">
                                            <div class="d-flex align-items-start align-items-sm-center gap-4">
                                                <div>
                                                    <img src="https://down-vn.img.susercontent.com/file/cdf9af013aa652eb0596cb252b1101d4_tn" alt="user-avatar" class="d-block rounded" id="uploadedAvatar" height="150px" width="150px" />
                                                </div>

                                                <div class="button-wrapper">
                                                    <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                                                        <span class="d-none d-sm-block">Upload new photo</span>
                                                        <i class="bx bx-upload d-block d-sm-none"></i>
                                                        <input type="file" id="upload" class="account-file-input" hidden accept="image/png, image/jpeg" />
                                                    </label>
                                                    <button type="button" class="btn btn-outline-secondary account-image-reset mb-4">
                                                        <i class="bx bx-reset d-block d-sm-none"></i>
                                                        <span class="d-none d-sm-block">Reset</span>
                                                    </button>

                                                    <p class="text-muted mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p>
                                                </div>
                                            </div>
                                        </div>
                                        <hr class="my-0" />

                                        <div class="card-body">
                                            <form id="formAccountSettings" method="post" action="{{route('update-user-profile', ['id'=>$user->id]) }}">
                                                <div class="row">
                                                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                                                    <input type="hidden" name="role_id" value="{{ $user->role_id }}">
                                                    <input type="hidden" name="password" value="{{ $user->password }}">
                                                    <div class="mb-3 col-md-6 mt-2">
                                                        <label for="username" class="form-label">Full Name</label>
                                                        <input class="form-control" type="text" id="username" name="username" value="{{ $user->username }}" autofocus />
                                                        @error('username')
                                                        <span style="color: red;">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                     <div class="mb-3 col-md-6 mt-2">
                                                        <label for="email" class="form-label">Email</label>
                                                        <input class="form-control" type="text" id="email" name="email" value="{{ $user->email }}" autofocus />
                                                        @error('email')
                                                        <span style="color: red;">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="mb-3 col-md-6 mt-2">
                                                        <label for="date" class="form-label">Date of birth</label>
                                                        <input class="form-control" type="date" name="date" id="dateOfBirth" value="{{ $user->date_of_birth }}" placeholder="XX-XX-XXXX" />
                                                      
                                                    </div>
                                                    <div class="mb-3 col-md-6 mt-2">
                                                        <label for="address" class="form-label">Address</label>
                                                        <input type="text" class="form-control" id="address" name="address" value="{{ $user->address }}" />
                                                        @error('address')
                                                        <span style="color: red;">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="mb-3 col-md-6 ">
                                                        <label for="phone" class="form-label">Phone number</label>
                                                        <input type="text" class="form-control" id="phone" name="phone" value="{{ $user->phone }}" placeholder="" />
                                                        @error('phone')
                                                        <span style="color: red;">{{$message}}</span>
                                                        @enderror
                                                    </div>

                                                   
                                                </div>
                                                @csrf
                                                <div class="mt-4" style="margin-top: 10px;">
                                                    <button type="submit" class="btn btn-primary me-2">Save changes</button>
                                                    <button type="reset" class="btn btn-outline-secondary">Cancel</button>
                                                </div>
                                            </form>
                                        </div>
                                        <!-- /Account -->
                                    </div>


                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

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


</div>


@endsection
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

    .icon-with-text {
        display: inline-flex;
        align-items: center;
    }

    .icon-with-text i {
        margin-right: 15px;
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
                        <img src="{{ $user->image_url }}" style="height: 200px; width: 220px; border: 1px solid gray;" alt="">

                        <p class="text-center">{{ $user->username }}</p>

                    </div>
                    @include('components.nav')

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
                                    <h4>Profile Details</h4>
                                </div>
                                <div class="row">
                                    <div class="card mb-4">
                                      

                                        <div class="">
                                            <div class="d-flex align-items-start align-items-sm-center gap-4">
                                                <div>
                                                    <img src="{{  $user->image_url }}" alt="user-avatar" class="d-block rounded" id="uploadedAvatar" height="150px" width="150px" />
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
    @if(session('message'))
    <script>
        alert("{{ session('message') }}");
    </script>
    @endif

    @if(session('error'))
    <script>
        alert("{{ session('error') }}");
    </script>
    @endif

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
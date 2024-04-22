@extends('layouts.master')
@section('css')
<style>
    .card {
        max-width: 500px;
        height: 250px;
        margin: 0 280px;
        border: 1px solid #ccc;
        padding: 20px;
        border-radius: 5px;
        box-shadow: rgba(50, 50, 93, 0.25) 0px 13px 27px -5px, rgba(0, 0, 0, 0.3) 0px 8px 16px -8px;
    }
    </style>
@endsection
@section('content')
<div class="container" >
    
    <div class="row justify-content-center">
        <div class="col-md-12  mx-auto">
            <div class="card" style="margin:50px 0 100px 250px;">
                <div class="card-header" ><h4 style="color:  #EE4D2D;">{{ __('Reset Password') }}</h4></div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-3 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-9">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <button type="submit" class="btn  mb-5" style="margin-top: 40px; background-color:  #EE4D2D; color:white">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                            </div>
                            
                        </div>

                        <!-- <div class="row mb-0">
                            <div class="col-md-12 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                            </div>
                        </div> -->
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

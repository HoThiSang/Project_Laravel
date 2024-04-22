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
    .input{
        margin-bottom: 40px;
    }
    </style>
@endsection

@section('content')
<div class="container" style="margin-bottom:15%">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card"style="margin:5% 0 0 26%">
                <div class="card-header"><h4 style="color:#EE4D2D">{{ __('Reset Password') }}</h4></div>

                <div class="card-body">
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-8" style="margin-bottom: 10px">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3" style="margin-bottom: 10px">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-8" style="margin-bottom: 5px">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3" style="margin-bottom: 10px">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-8">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0" style="margin-bottom: 10px">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn" style="background-color:  #EE4D2D; color: white">
                                    {{ __('Reset Password') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('layouts.master')
@section('css')
<style>
    .login-form {
        max-width: 400px;
        margin: 0 auto;
        border: 1px solid #ccc;
        padding: 20px;
        border-radius: 5px;
        box-shadow: rgba(50, 50, 93, 0.25) 0px 13px 27px -5px, rgba(0, 0, 0, 0.3) 0px 8px 16px -8px;
    }

    .login-form .form-group {
        margin-bottom: 20px;
    }


    .form-group .form-control {
        width: 100%;
        padding: 10px;
        height: 40px;
    }

    .login-form .btn-login {
        width: 100%;
        padding: 10px;
        background-color: #EE4D2D;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }


    .login-form-title {
        color: #EE4D2D;
    }

    .login-form {
        margin-top: 60px;
        margin-bottom: 60px;
    }
</style>

@endsection
@section('content')
<div class="container">
    <div class="login-form">
        <h2 class="login-form-title">Sign in</h2>
        <form method="POST" action="{{ route('login') }}">
            @if(Session::has('success'))
            <div class="alert alert-success">{{Session::get('success')}}</div>
            @endif
            @if(Session::has('fail'))
            <div class="alert alert-danger">{{Session::get('fail')}}</div>
            @endif
            @csrf
            <div class="form-group">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{old('email')}}" placeholder="Enter email">
                <span class="text-danger">@error('email') {{$message}} @enderror</span>

            </div>
            <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Enter password">
                <span class="text-danger">@error('password') {{$message}} @enderror</span>
            </div>
            <button type="submit" class="btn btn-login">Sign up</button>
        </form>
        <div class="text-center">
            Don't have an account? <a href="registration">Create account</a>
        </div>
    </div>
</div>
@endsection
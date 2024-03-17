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

  
    .form-group
    .form-control{
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
        <h2 class="login-form-title">Sign up</h2>
        <form method="POST" action="/your-login-route">
            @csrf
            <div class="form-group">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" required>

            </div>
            <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" required>
            </div>
            <button type="submit" class="btn btn-login">Sign up</button>
        </form>
        <div class="text-center">
            Don't have an account? <a href="/create-account">Create account</a>
        </div>
    </div>
</div>
@endsection
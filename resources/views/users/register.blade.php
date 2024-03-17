@extends('layouts.master')
@section('css')
<style>
    .form-register {
        border: 1px solid #C4C4C4;
        padding: 30px;
        border-radius: 10px;
        box-shadow: rgba(50, 50, 93, 0.25) 0px 13px 27px -5px, rgba(0, 0, 0, 0.3) 0px 8px 16px -8px;
    }

    .form-register-title {
        color: #EE4D2D;
        size: 20px;
    }

    .form-control {
        height: 40px;
    }

    .btn-create-account {
        background-color: #EE4D2D;
        color: white;
    }
</style>
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center" style="display: flex; justify-content: center; align-items: center; ">
        <div class="col-md-6 form-register">
            <fieldset class="border border-primary rounded p-4">
                <legend class="text-center mb-4 form-register-title">Register</legend>
                <form class="mx-auto" action="" method="post">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Name">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="tel" class="form-control" id="phone" name="phone" placeholder="Phone">
                    </div>
                    <div class="form-group">
                        <label for="address">Address</label>
                        <textarea class="form-control" id="address" name="address" rows="3" placeholder="Address"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <label for="confirmPassword">Confirm Password</label>
                        <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" placeholder="Confirm Password">
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-create-account">Create account</button>
                    </div>
                    @csrf
                </form>
                <div class="text-center">
                    If you have an account <a href="/create-account">Sign in</a>
                </div>
            </fieldset>
        </div>
    </div>
</div>
@endsection
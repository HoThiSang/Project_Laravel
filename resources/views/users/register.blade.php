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
                <form class="mx-auto" action="{{route('register-user')}}" method="post">
                    @if(Session::has('success'))
                    <div class="alert alert-success">{{Session::get('success')}}</div>
                    @endif
                    @if(Session::has('fail'))
                    <div class="alert alert-danger">{{Session::get('fail')}}</div>
                    @endif
                    @csrf
                    <div class="form-group">
                        <label for="username">Name</label>
                        <input type="text" class="form-control" id="username" name="username" value="{{old('username')}}" placeholder="Name">
                        <span class="text-danger">@error('username') {{$message}} @enderror</span>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{old('email')}}" placeholder="Email">
                        <span class="text-danger">@error('email') {{$message}} @enderror</span>
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="tel" class="form-control" id="phone" name="phone" value="{{old('phone')}}" placeholder="Phone">
                        <span class="text-danger">@error('phone') {{$message}} @enderror</span>
                    </div>
                    <div class="form-group">
                        <label for="address">Address</label>
                        <textarea class="form-control" id="address" name="address" value="" rows="3" placeholder="Address">{{old('address')}}</textarea>
                        <span class="text-danger">@error('address') {{$message}} @enderror</span>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" value="{{old('password')}}" placeholder="Password">
                        <span class="text-danger">@error('password') {{$message}} @enderror</span>
                    </div>
                    <div class="form-group">
                        <label for="confirmPassword">Confirm Password</label>
                        <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" value="{{old('confirmPassword')}}" placeholder="Confirm Password">
                        <span class="text-danger">@error('confirmPassword') {{$message}} @enderror</span>
                    </div>
                    <input type="hidden" value="1" name="role_id">
                    <div class="text-center">
                        <button type="submit" class="btn btn-create-account">Create account</button>
                    </div>
                    @csrf
                </form>
                <div class="text-center">
                    If you have an account <a href="login">Sign in</a>
                </div>
            </fieldset>
        </div>
    </div>
</div>
@endsection
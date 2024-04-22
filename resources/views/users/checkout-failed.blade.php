@extends('layouts.master')
@section('content')
<div class="body-content">
    <div class="container" style="height: 40vh;">
        <div class="contact-page">
            @if (isset($error) && !empty($error))
            <div class="alert alert-danger">
                {{ $error }}
            </div>
            @endif
        </div>
        <div class="col-md-12 mt-4 justify-content-end align-content-center end">

            <button type="button" class="btn btn-primary"><a href="{{ route('homepage')}}" style="text-decoration: none; color: white;">Continue Shopping</a></button>

            <button type="button" class="btn btn-success"><a href="{{ route('view-orders')}}" style="text-decoration: none; color: white;">Check Order</a></button>
        </div>
    </div>
</div>
@endsection
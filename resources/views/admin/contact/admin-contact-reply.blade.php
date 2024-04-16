@extends('layouts.admin')
@section('css')

<style>
    .custom-textarea {
        height: 200px;
        width: 95%;
    }

    .custom-button {
        width: 95%;
    }

    h4 {
        color: coral;
    }
</style>
@endsection
@section('content')
<div class="content-wrapper">
    <div style="margin: 50px 0px 0px 50px">
        <div class="row">
            <h4 style="color: coral"><strong>User name </strong>: {{ isset($cart) ?  $cart->user_name : ''}}</h4>
            <p><b>Email </b>: {{ isset($cart) ?  $cart->email : ''}} </p>
            <p><strong>Title </strong> : {{ isset($cart) ?  $cart->title : ''}}</p>
            <p><strong>Content </strong>: {{ isset($cart) ?  $cart->message : ''}} </p>
        </div>
        <form action="{{ route('admin-reply-contact', ['id'=>$cart->id]) }}" method="post">
            @csrf
            <div class="row ">
                <label style="color: coral" for="user_name" class="form-label">Message reply</label>
                <span></span>
                <div class="col mb-3">
                    <textarea type="text" class="form-control custom-textarea" name="message" value="" placeholder="Write the content you want to send to customers!!"></textarea>
                    @error('message')
                    <span style="color: red;">{{$message}}</span>
                    @enderror
                </div>
              
            </div>
            <button type="submit" class="btn btn-primary custom-button">Send message</button>
            <div class="row">

            </div>
        </form>
    </div>

</div>

@endsection
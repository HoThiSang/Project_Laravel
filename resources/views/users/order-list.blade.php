@extends('layouts.master')
@section('content')
@if( isset($check) && $check=='success')
<div class="container-full-width">

    <table class="table table-hover" style="font-size: 15px;">
        <thead class="table-danger">
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Customer</th>
                <th scope="col">Phone</th>

                <th scope="col">Payment</th>
                <th scope="col">Order Status</th>
                <th scope="col">Order Date</th>
                <th scope="col">Total price</th>
                <th scope="col">Action</th>
            </tr>
        </thead>

        <tbody>
            @foreach($orderAll as $order)
            <tr>
                <th scope="row">{{ $order->id }}</th>
                <td>{{ $order->username }}</td>
                <td>{{ $order->phone }}</td>

                <td>{{ $order->payment_method }}</td>

                @if($order->order_status=='Ordered')
                <td><button class="btn btn-primary me-1">{{ $order->order_status }}</button></td>
                @elseif($order->order_status=='Delivering')
                <td><button class="btn btn-success me-1">{{ $order->order_status }}</button></td>
                @else
                <td><button class="btn btn-danger me-1">{{ $order->order_status }}</button></td>
                @endif


                <td>{{ $order->created_at }}</td>
                <td>{{ $order->order_total }}</td>
                <td>
                    <button type="button" class="btn btn-success" style="text-decoration: none; color:#000;"><i class="fa-solid fa-eye"></i></button>
                    <button type="button" class="btn btn-info" style="text-decoration: none; color:#000; margin-left: 5px;"><i class="fa-solid fa-pencil"></i></button>
                    <button type="button" class="btn btn-danger" style="margin-left: 5px;" onclick="return confirm('Do you want to delete?')"><a href="{{ route('delete-order', ['id'=>$order->id]) }}"><i class="fa-solid fa-trash"></i></a></button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@else
<div class="body-content" style="height: 30vh; margin-top: 10%; justify-content: center; align-items: center">
    <div class="container">
        <div class="contact-page">
            <h3>Your haven't have order yet! Or you not login. <a href="{{ route('login') }}" style="text-decoration: none; color:chocolate">Login Now</a></h3>

        </div>
    </div>
</div>
@endif
@if(session('success'))
    <script>
        alert("{{ session('success') }}");
    </script>
    @endif

    @if(session('error'))
    <script>
        alert("{{ session('error') }}");
    </script>
    @endif
@endsection
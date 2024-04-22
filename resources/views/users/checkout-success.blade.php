<!-- success.blade.php -->
@extends('layouts.master')
@section('content')
<div class="body-content">
    <div class="container">
        <div class="contact-page">
            @if (isset($success) && !empty($success))
            <div class="alert alert-success">
                {{ $success }}
            </div>
            <h2>Order Details</h2>

            <table class="table table-border">
                <thead class="table-primary">
                    <tr>
                        <th>Order Date</th>
                        <th>Address</th>
                        <th>Phone Number</th>
                        <th>Payment Method</th>
                        <th>Order Status</th>
                        <th>Delivery ID</th>
                        <th>Created At</th>
                        <th>Order Total</th>
                        <th>User ID</th>
                    </tr>
                </thead>
                
                <tbody>
                    <tr>
                        <td><?php echo $order->order_date; ?></td>
                        <td><?php echo $order->address; ?></td>
                        <td><?php echo $order->phone_number; ?></td>
                        <td><?php echo $order->payment_method; ?></td>
                        <td><?php echo $order->order_status; ?></td>
                        <td><?php echo $order->deliver_id; ?></td>
                        <td><?php echo $order->created_at; ?></td>
                        <td><?php echo $order->order_total; ?></td>
                        <td><?php echo $order->user_id; ?></td>
                    </tr>
                </tbody>
            </table>

            @else
            <div class="alert alert-success">
                <h1 style="color: #FF0000">{{ $error }}</h1>
            </div>
            @endif
            <div class="col-md-12 mt-4 justify-content-end align-content-center end">

                <button type="button" class="btn btn-primary"><a href="{{ route('homepage')}}" style="text-decoration: none; color: white;">Continue Shopping</a></button>

                <button type="button" class="btn btn-success"><a href="{{ route('view-orders')}}" style="text-decoration: none; color: white;">Check Order</a></button>
            </div>
        </div>

    </div>
</div>

@endsection
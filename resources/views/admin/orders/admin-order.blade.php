@extends('layouts.admin')
@section('content')
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Tables /</span> Orders Tables</h4>
            <div class="row mb-4">
                <div class="col-2">
                    <a href="?sort-by" class="btn btn-primary mx-1">Soft by date</a>
                </div>
                <div class="col-2">
                    <a href="?sort-by" class="btn btn-primary mx-1">Soft by name</a>
                </div>
               
                <div class="col-4">
                    <form action="{{ route('admin-order-search') }}" method="post">
                        @csrf
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="Search by product name">
                            <button type="submit" class="btn btn-primary">Search</button>
                        </div>
                    </form>
                </div>

            </div>
            <!-- Basic Bootstrap Table -->
            <!-- @if (session('success'))
                 <div class="alert alert-success">
                     {{ session('success') }}
                 </div>
             @endif

             @if (session('error'))
                 <div class="alert alert-danger">
                     {{ session('error') }}
                 </div>
             @endif -->

            <div class="card">
                <h5 class="card-header">Table Order</h5>
                <div class="table-responsive text-nowrap">
                    <!-- @if (session('success'))
                        <div class="alert alert-success mt-3" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif -->
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>User name</th>
                                <th>Address</th>
                                <th>Phone Number</th>
                                <th>Payment Method</th>
                                <th>Order Total</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach ($orders as $order)
                                <tr>
                                    <td>{{ $order->id }}</td>
                                    <td>{{ $order->user ? $order->user->username : 'Unknown User' }}</td>
                                    <td>{{ $order->address }}</td>
                                    <td>{{ $order->phone_number }}</td>
                                    <td>{{ $order->payment_method }}</td>
                                    <td>{{ $order->order_total }}</td>
                                    {{-- <td class="@if ($order->order_status === 'Processing') bg-danger text-white @elseif($order->order_status === 'Shipped') bg-primary text-white @elseif($order->order_status === 'Delivered') bg-success text-white @elseif($order->order_status === 'Cancelled') bg-secondary text-white @endif">
                                {{ $order->order_status }}
                            </td> --}}
                                    <td>
                                        <div class="dropdown">
                                            @if ($order->order_status == 'Ordered')
                                                <button type="button"
                                                    class="btn p-0 btn-primary dropdown-toggle hide-arrow"
                                                    data-bs-toggle="dropdown">
                                                    {{ $order->order_status }}
                                                </button>
                                            @elseif($order->order_status == 'Delivering')
                                                <button type="button" class="btn p-0 dropdown-toggle btn-info hide-arrow"
                                                    data-bs-toggle="dropdown">
                                                    {{ $order->order_status }}
                                                </button>
                                            @else
                                                <button type="button"
                                                    class="btn p-0 btn-success dropdown-toggle hide-arrow"
                                                    data-bs-toggle="dropdown">
                                                    {{ $order->order_status }}
                                                </button>
                                            @endif
                                            <div class="dropdown-menu">
                                                <form action="{{ route('order-change-status', ['id' => $order->id]) }}"
                                                    method="post">
                                                    @csrf
                                                    <select class="form-select" name="new_status">
                                                        <option value="Ordered"
                                                            {{ $order->order_status === 'Ordered' ? 'selected' : '' }}>
                                                            Ordered</option>
                                                        <option value="Delivering"
                                                            {{ $order->order_status === 'Delivering' ? 'selected' : '' }}>
                                                            Delivering</option>
                                                        <option value="Received"
                                                            {{ $order->order_status === 'Received' ? 'selected' : '' }}>
                                                            Received</option>
                                                    </select>
                                                    <button type="submit" class="btn btn-primary mt-2">Change
                                                        Status</button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                data-bs-toggle="dropdown">
                                                <i class="fa-solid fa-ellipsis-vertical"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item"
                                                    href="{{ route('orders-edit', ['id' => $order->id]) }}">
                                                    <i class="bx bx-edit-alt me-1"></i> Edit
                                                </a>

                                                <form action="{{ route('admin-orders-delete', ['id' => $order->id]) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="dropdown-item">
                                                        <i class="bx bx-trash me-1"></i> Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!--/ Basic Bootstrap Table -->
            <hr class="my-5" />
        </div>
        <!-- / Content -->
        <div class="content-backdrop fade"></div>
    </div>
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

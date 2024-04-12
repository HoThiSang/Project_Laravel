 <!-- Content wrapper -->

 @extends('layouts.admin')
 @section('content')
 <div class="content-wrapper">
     <!-- Content -->

     <div class="container-xxl flex-grow-1 container-p-y">
         <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Tables /</span> Basic Tables</h4>
         <div class="row mb-4">
             <div class="col-2">
                 <a href="?sort-by" class="btn btn-primary mx-1">Soft by date</a>
             </div>
             <div class="col-2">
                 <a href="?sort-by" class="btn btn-primary mx-1">Soft by name</a>
             </div>
             <div class="col-2">
                 <a href="?sort-by" class="btn btn-primary mx-1">Soft by DOB</a>
             </div>
             <div class="col-2">
                 <a href="?sort-by" class="btn btn-primary mx-1">Primary link</a>
             </div>
             <div class="col-2">
                 <form action="" class="position-relative" method="post">
                 @csrf
                     <input type="text" class="form-control pl-5" placeholder="Search..." style="width: 300px; padding-left: 35px;">
                     <i class="fas fa-search position-absolute" style="left: 10px; top: 50%; transform: translateY(-50%);"></i>
                 </form>
             </div>
         </div>
         <!-- Basic Bootstrap Table -->
         <div class="card">
             <h5 class="card-header">Table Order</h5>
             <div class="table-responsive text-nowrap">
                 <table class="table">
                     <thead>
                        <tr>
                            <th>ID</th>
                            <th>Address</th>
                            <th>Phone Number</th>
                            <th>Payment Method</th>
                            <th>Order Total</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                     <tbody class="table-border-bottom-0">
                         @foreach($orders as $order)
                            <tr>
                                <td>{{ $order->id }}</td>
                                <td>{{ $order->address }}</td>
                                <td>{{ $order->phone_number }}</td>
                                <td>{{ $order->payment_method }}</td>
                                <td>{{ $order->order_total }}</td>
                            
                             <td><span class="badge bg-label-primary me-1">Active</span></td>
                             <td>
                                 <div class="dropdown">
                                     <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                         <i class="fa-solid fa-ellipsis-vertical"></i>
                                     </button>
                                     <div class="dropdown-menu">
                                         <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                                        <form action="{{ route('admin-orders-delete', ['id' => $order->id]) }}" method="post">
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
 @endsection
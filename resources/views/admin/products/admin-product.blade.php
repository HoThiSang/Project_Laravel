 <!-- Content wrapper -->

 @extends('layouts.admin')
 @section('content')
 <div class="content-wrapper">
     <!-- Content -->
     <div class="container-xxl flex-grow-1 container-p-y">
         <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Tables /</span> Produts</h4>
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
         @if(session('success'))
         <div class="alert alert-success">
             {{ session('success') }}
         </div>
         @endif

         @if(session('error'))
         <div class="alert alert-danger">
             {{ session('error') }}
         </div>
         @endif

         <div class="card">
             <div style="margin:15px;"><a href="{{ route('admin.get-view-add-new')}}" class="btn btn-primary">Create new</a></div>
             <div class="table-responsive text-nowrap">
                 <table class="table">
                     <thead>
                         <tr>
                             <th>ID</th>
                             <th>Product name</th>
                             <th>Price</th>
                             <th>Promotion</th>
                             <th>Quantity</th>
                             <th>Image</th>
                             <th>Actions</th>
                         </tr>
                     </thead>
                     <tbody class="table-border-bottom-0">
                         @foreach($productAll as $product)
                         <tr>
                             <td><strong>{{ $product->id }}</strong></td>
                             <td>{{ Str::limit($product->product_name, 20) }}</td>
                             <td>{{ $product->price }}</td>
                             <td>{{ $product->discounted_price }}</td>
                             <td>{{ $product->quantity }}</td>
                             <td>
                                 <img src="{{ asset('images/' . $product->image_url) }}" alt="" class="img-fluid" height="150" width="100">
                             </td>


                             <td>
                                 <div class="dropdown">
                                     <button type="button" class="btn p-10 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                         <i class="fa-solid fa-ellipsis-vertical" style="padding-right: 10px;"></i>
                                     </button>
                                     <div class="dropdown-menu">
                                         <a class="dropdown-item" href="{{ route('admin.product-detail', ['id'=>$product->id ]) }}"><i class="fa-solid fa-eye" style="padding-right: 5px;"></i> Detail</a>
                                         <a class="dropdown-item" href="{{ route('admin.admin-get-update',  ['id'=>$product->id ]) }}"><i class="fa-solid fa-pen" style="padding-right: 5px;"></i> Edit</a>
                                         <a class="dropdown-item" href="javascript:void(0);"><i class="fa-solid fa-trash" style="padding-right: 10px;"></i> Delete</a>
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


     @endsection
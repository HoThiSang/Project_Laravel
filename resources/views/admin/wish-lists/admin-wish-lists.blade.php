 <!-- Content wrapper -->

 @extends('layouts.admin')
 @section('content')
 <div class="content-wrapper">
     <!-- Content -->

     <div class="container-xxl flex-grow-1 container-p-y">
         <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Tables /</span> Wishlist Table</h4>
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
             <h5 class="card-header">Table Wish Lists</h5>
             <div class="table-responsive text-nowrap">
                 <table class="table">
                     <thead>
                         <tr>
                             <th>ID</th>
                             <th>User Name</th>
                             <th>Product Name</th>
                             <th>Status</th>
                             <th>Action</th>
                         </tr>
                     </thead>
                     <tbody class="table-border-bottom-0">
                         @foreach($wishLists as $wishList)
                         <tr>
                             <td>{{ $wishList->id }}</td>
                             <td>{{ $wishList->user->username }}</td> <!-- Hiển thị tên người dùng -->
                             <td>{{ $wishList->product->product_name }}</td> <!-- Hiển thị tên sản phẩm -->
                             <td><span class="badge bg-label-primary me-1">Active</span></td>
                             <td>
                                 <div class="dropdown">
                                     <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                         <i class="fa-solid fa-ellipsis-vertical"></i>
                                     </button>
                                     <div class="dropdown-menu">
                                         <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                                         <a class="dropdown-item" href="{{ route('admin-whislist-destroy', ['id'=>$wishList->id]) }}"><i class="bx bx-trash me-1"></i> Delete</a>
                                     </div>
                                 </div>
                             </td>
                         </tr>
                         @endforeach

                     </tbody>
                 </table>
             </div>
         </div>
      
         <hr class="my-5" />
     </div>

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
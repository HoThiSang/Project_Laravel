 <!-- Content wrapper -->

 @extends('layouts.admin')
 @section('content')
 <div class="content-wrapper">
     <!-- Content -->
     <div class="container-xxl flex-grow-1 container-p-y">

         <form action="{{ route('admin-category-update', ['id'=> $categoryUpdate->id]) }}" method="post" enctype="multipart/form-data">
             @csrf

             <div class="row">
                 <div class="col-xl">
                     <div class="card mb-4">
                         <div class="card-header d-flex justify-content-between align-items-center">
                             <h5 class="mb-0">Update Category</h5>
                             <small class="text-muted float-end">l</small>
                         </div>
                         <div class="card-body">

                             <div class="mb-3">
                                 <label class="form-label" for="fullname">Product Name</label>
                                 <div class="input-group input-group-merge">
                                     <span id="category_name" class="input-group-text"><i class="bx bx-user"></i></span>
                                     <input type="text" class="form-control" id="category_name" name="category_name" value="{{ isset($categoryUpdate) ? $categoryUpdate->category_name: ''}}" placeholder="Product name" aria-label="John Doe" aria-describedby="basic-icon-default-fullname2" />

                                 </div>
                                 @error('category_name')
                                 <span style="color: red;">{{$message}}</span>
                                 @enderror
                             </div>
                             <button type="submit" class="btn btn-outline-primary">Update</button>
                         </div>

                     </div>
                 </div>
             </div>
         </form>



         <hr class="my-5" />

     </div>
     <!-- / Content -->



     <div class="content-backdrop fade"></div>

 </div>
 @endsection
 @section('js')
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
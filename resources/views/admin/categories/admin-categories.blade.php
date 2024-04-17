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
                 <a href="?sort-by" class="btn btn-primary mx-1">Soft name</a>
             </div>
             <div class="col-4">
                 <form action="{{ route('admin-category-research') }}" method="post">
                     @csrf
                     <div class="input-group">
                         <input type="text" name="key-search" class="form-control" placeholder="Search by product name">
                         <button type="submit" class="btn btn-primary">Search</button>
                     </div>
                 </form>
             </div>
         </div>


         <div class="card">
             <div style="margin:15px;"><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Create new</button></div>
             <div class="table-responsive text-nowrap">
                 <table class="table">
                     <thead>
                         <tr>
                             <th>ID</th>
                             <th>Category name</th>
                             <th>Actions</th>

                         </tr>
                     </thead>
                     <tbody class="table-border-bottom-0">
                         @foreach($categoriesAll as $category)

                         <tr>
                             <td><strong>{{ $category->id }}</strong></td>
                             <td>{{ $category->category_name }}</td>



                             <td>
                                 <div class="dropdown">
                                     <button type="button" class="btn p-10 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                         <i class="fa-solid fa-ellipsis-vertical" style="padding-right: 10px;"></i>
                                     </button>
                                     <div class="dropdown-menu">
                                         <a class="dropdown-item" href="{{ route('admin-get-update',  ['id'=>$category->id ]) }}"><i class="fa-solid fa-pen" style="padding-right: 5px;"></i> Edit</a>
                                         <a class="dropdown-item" onclick="return alert('Are you sure want to delete this category')" href="{{ route('admin-category-destroy',  ['id'=>$category->id ]) }}"><i class="fa-solid fa-trash" style="padding-right: 10px;"></i> Delete</a>
                                     </div>
                                 </div>
                             </td>

                         </tr>
                         @endforeach

                     </tbody>
                 </table>

                 <!-- Modal create-->
                 <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                     <form action="{{ route('admin-category-create') }}" method="post">
                         @csrf
                         <div class="modal-dialog">
                             <div class="modal-content">
                                 <div class="modal-header">
                                     <h5 class="modal-title" id="exampleModalLabel">Create new Category</h5>
                                     <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                 </div>
                                 <div class="modal-body">
                                     <div class="mb-3">
                                         <label for="category" class="form-label">Catregory name : </label>
                                         <input type="text" class="form-control" id="category_name" name="category_name" placeholder="Body..example">
                                     </div>
                                 </div>
                                 <div class="modal-footer">
                                     <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                     <button type="submit" class="btn btn-primary">Save changes</button>
                                 </div>
                             </div>
                         </div>
                     </form>
                 </div>

             </div>
         </div>

         <hr class="my-5" />

     </div>
     <!-- / Content -->



     <div class="content-backdrop fade"></div>


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
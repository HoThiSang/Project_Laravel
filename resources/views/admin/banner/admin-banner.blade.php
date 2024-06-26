
 @extends('layouts.admin')
 @section('content')
 <div class="content-wrapper">
     <!-- Content -->
     <div class="container-xxl flex-grow-1 container-p-y">
         <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Tables /</span> Banner</h4>
         <div class="row mb-4">
             <div class="col-2">
                 <a href="?sort-by" class="btn btn-primary mx-1">Soft by date</a>
             </div>
             <div class="col-2">
                 <a href="?sort-by" class="btn btn-primary mx-1">Soft by name</a>
             </div>
             <div class="col-4">
                     <form action="{{ route('admin-products-search') }}" method="post">
                         @csrf
                         <div class="input-group">
                             <input type="text" name="keyword" class="form-control" placeholder="Search by product name">
                             <button type="submit" class="btn btn-primary">Search</button>
                         </div>
                     </form>
                 </div>



         </div>
         <!-- Basic Bootstrap Table -->
   
         <div class="card">
            <h5 class="card-header">Banner</h5>
             <div style="margin:15px;"><a href="{{route('add-banner')}}" class="btn btn-primary">Create new</a></div>
             <div class="table-responsive text-nowrap">
                 <table class="table">
                     <thead>
                         <tr>
                             <th>ID</th>
                             <th>Title</th>
                             <th>Content</th>
                             <th>Image_url</th>
                             <!-- <th>Image_name</th> -->
                             <th>Action</th>
                         </tr>
                     </thead>
                     <tbody class="table-border-bottom-0">
                         @foreach($bannerAll as $banner)
                         <tr>
                             <td><strong>{{ $banner->id }}</strong></td>
                             <td>{{ Str::limit($banner->title, 20) }}</td>
                             <td>{{  Str::limit($banner->content , 50)}}</td>
                             <!-- <td>{{ $banner->image_name }}</td> -->
                             <td>
                                 <img src="{{ $banner->image_url }}" alt="" class="img-fluid" height="150" width="100">
                             </td>
                             


                             <td>
                                 <div class="dropdown">
                                     <button type="button" class="btn p-10 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                         <i class="fa-solid fa-ellipsis-vertical" style="padding-right: 10px;"></i>
                                     </button>
                                     <div class="dropdown-menu">
                                         {{-- <a class="dropdown-item" href=""><i class="fa-solid fa-eye" style="padding-right: 5px;"></i> Detail</a> --}}
                                         <a class="dropdown-item" href="{{ route('edit-banner', ['id'=> $banner->id]) }}"><i class="fa-solid fa-pen" style="padding-right: 5px;"></i> Edit</a>
                                         <a class="dropdown-item" href="{{ route('delete-banner', ['id'=> $banner->id]) }}"><i class="fa-solid fa-trash" style="padding-right: 10px;"></i> Delete</a>
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
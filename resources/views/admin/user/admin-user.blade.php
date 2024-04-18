 <!-- Content wrapper -->

 @extends('layouts.admin')
 @section('content')
     <div class="content-wrapper">
         <!-- Content -->

         <div class="container-xxl flex-grow-1 container-p-y">
             <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Tables /</span> Users Tables</h4>
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
                         <input type="text" class="form-control pl-5" placeholder="Search..."
                             style="width: 300px; padding-left: 35px;">
                         <i class="fas fa-search position-absolute"
                             style="left: 10px; top: 50%; transform: translateY(-50%);"></i>
                     </form>
                 </div>

             </div>

             <!-- Basic Bootstrap Table -->
             <div class="card">
                 <h5 class="card-header">Users</h5>
                 <div style="margin:15px;" class="d-flex justify-content">
                     <a class="btn btn-primary " href="{{ route('add-user') }}" id="">Create new</a>
                 </div>
                 <div class="table-responsive text-nowrap">
                     @if (Session::has('status'))
                         <div class="alert alert-success">
                             {{ Session::get('status') }}
                         </div>
                     @endif
                     <table class="table">
                         <thead>
                             <tr>
                                 <th>ID</th>
                                 <th>User name</th>
                                 <th>Phone</th>
                                 <th>Email</th>
                                 <th>Date of birth</th>
                                 <th>Address</th>
                                 <th>Avatar</th>
                                 <th>Role</th>
                                 <th>Actions</th>
                             </tr>
                         </thead>
                         <tbody class="table-border-bottom-0">
                             @foreach ($userAll as $user)
                             @if($user->role_id==1)
                                 <tr>
                                     <td><strong>{{ $user->id }}</strong></td>
                                     <td>{{ $user->username }}</td>
                                     <td>{{ $user->phone }}</td>
                                     <td>{{ $user->email }}</td>
                                     <td>
                                         @if ($user->date_of_birth)
                                             {{ $user->date_of_birth }}
                                         @else
                                             -
                                         @endif
                                     </td>
                                     <td>
                                         @if ($user->address)
                                    
                                             {{ Str::limit($user->address, 18) }}
                                         @else
                                             -
                                         @endif
                                     </td>
                                     <td>
                                         @if ($user->image_url)
                                             <ul
                                                 class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
                                                 <li data-bs-toggle="tooltip" data-popup="tooltip-custom"
                                                     data-bs-placement="top" class="avatar avatar-xs pull-up"
                                                     title="Lilian Fuller">
                                                     <img src="{{ $user->image_url}}" alt="Avatar"
                                                         class="rounded-circle" />
                                                 </li>
                                             </ul>
                                         @else
                                             <ul
                                                 class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
                                                 <li data-bs-toggle="tooltip" data-popup="tooltip-custom"
                                                     data-bs-placement="top" class="avatar avatar-xs pull-up"
                                                     title="Lilian Fuller">
                                                     <img src="https://down-vn.img.susercontent.com/file/cdf9af013aa652eb0596cb252b1101d4_tn"
                                                         alt="Avatar" class="rounded-circle" />
                                                 </li>
                                             </ul>
                                         @endif
                                     </td>
                                     <td>{{ $user->role_id }}</td>
                                     <td>
                                         <div class="dropdown">
                                             <button type="button" class="btn p-10 dropdown-toggle hide-arrow"
                                                 data-bs-toggle="dropdown">
                                                 <i class="fa-solid fa-ellipsis-vertical" style="padding-right: 10px;"></i>
                                             </button>
                                             <div class="dropdown-menu">
                                                 <a class="dropdown-item"
                                                     href="{{ route('edit-user', ['id' => $user->id]) }}"><i
                                                         class="fa-solid fa-pen" style="padding-right: 5px;"></i> Edit</a>
                                                 <a class="dropdown-item"
                                                     href="{{ route('delete-user', ['id' => $user->id]) }}"><i
                                                         class="fa-solid fa-trash" style="padding-right: 10px;"></i>
                                                     Delete</a>
                                             </div>
                                         </div>
                                     </td>
                                 </tr>
                                @endif
                             @endforeach
                         </tbody>
                     </table>
                 </div>
             </div>

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

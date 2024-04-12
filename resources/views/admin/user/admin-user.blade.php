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
                         <input type="text" class="form-control pl-5" placeholder="Search..."
                             style="width: 300px; padding-left: 35px;">
                         <i class="fas fa-search position-absolute"
                             style="left: 10px; top: 50%; transform: translateY(-50%);"></i>
                     </form>
                 </div>



             </div>
             <!-- Basic Bootstrap Table -->
             <div class="card">
                 <h5 class="card-header">Table Users</h5>
                 <div class="d-flex justify-content-end">
                     <a class="btn btn-primary mx-1 align-self-end" href="javascript:void(0)" id="createNewUser">Add</a>
                 </div>
                 <div class="table-responsive text-nowrap">
                     <table class="table">
                         <thead>
                             <tr>
                                 <th>ID</th>
                                 <th>User name</th>
                                 <th>Phone</th>
                                 <th>Email</th>
                                 <th>Avatar</th>
                                 <th>Status</th>
                                 <th>Actions</th>
                             </tr>
                         </thead>
                         <tbody class="table-border-bottom-0">
                             @foreach ($userAll as $user)
                                 <tr>
                                     <td><strong>{{ $user->id }}</strong></td>
                                     <td>{{ $user->username }}</td>
                                     <td>{{ $user->phone }}</td>
                                     <td>{{ $user->email }}</td>
                                     <td>
                                         <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
                                             <li data-bs-toggle="tooltip" data-popup="tooltip-custom"
                                                 data-bs-placement="top" class="avatar avatar-xs pull-up"
                                                 title="Lilian Fuller">
                                                 <img src="https://down-vn.img.susercontent.com/file/cdf9af013aa652eb0596cb252b1101d4_tn"
                                                     alt="Avatar" class="rounded-circle" />
                                             </li>

                                             <!-- Có thêm dòng cho phần này
                                                <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up" title="Sophia Wilkerson">
                                                     <img src="../assets/img/avatars/6.png" alt="Avatar" class="rounded-circle" />
                                                 </li>
                                                 <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up" title="Christina Parker">
                                                     <img src="../assets/img/avatars/7.png" alt="Avatar" class="rounded-circle" />
                                                 </li>   -->
                                         </ul>

                                     </td>
                                     <td><span class="badge bg-label-primary me-1">Active</span></td>
                                     <td>
                                         <div class="dropdown">
                                             <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                 data-bs-toggle="dropdown">
                                                 <i class="fa-solid fa-ellipsis-vertical"></i>
                                             </button>
                                             <div class="dropdown-menu">
                                                 <a class="dropdown-item" href="javascript:void(0);"><i
                                                         class="bx bx-edit-alt me-1"></i> Edit</a>
                                                 <a class="dropdown-item" href="javascript:void(0);"><i
                                                         class="bx bx-trash me-1"></i> Delete</a>
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

     <div class="modal fade" id="ajaxModel" aria-hidden="true">
         <div class="modal-dialog">
             <div class="modal-content">
                 <div class="modal-header">
                     <h4 class="modal-title" id="modalHeading"></h4>
                 </div>
                 <div class="modal-body">
                     <form id="userForm" name="userForm" class="form-horizontal">
                         <input type="hidden" name="user_id" id="user_id">

                         <div class="form-group">
                             <label for="username">Username:</label> <br>
                             <input type="text" class="form-control" id="username" name="username"
                                 placeholder="Enter username" value="" required>
                         </div>

                         <div class="form-group">
                             <label for="email">Email:</label> <br>
                             <input type="email" class="form-control" id="email" name="email"
                                 placeholder="Enter email" value="" required>
                         </div>

                         <div class="form-group">
                             <label for="password">Password:</label> <br>
                             <input type="password" class="form-control" id="password" name="password"
                                 placeholder="Enter password" value="" required>
                         </div>

                         <div class="form-group">
                             <label for="date_of_birth">Date of Birth:</label> <br>
                             <input type="date" class="form-control" id="date_of_birth" name="date_of_birth"
                                 required>
                         </div>

                         <div class="form-group">
                             <label for="address">Address:</label> <br>
                             <input type="text" class="form-control" id="address" name="address"
                                 placeholder="Enter address" value="" required>
                         </div>

                         <div class="form-group">
                             <label for="role_id">Role ID:</label> <br>
                             <input type="number" class="form-control" id="role_id" name="role_id" value="1"
                                 required>
                         </div>

                         <button type="submit" class="btn btn-primary" id="saveBtn" value="Create">Save</button>
                     </form>
                 </div>
             </div>
         </div>
     </div>

     <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
     <script type="text/javascript">
         $(function() {
             $.ajaxSetup({
                 headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 }
             });

             $("#createNewUser").click(function() {
                 $('#user_id').val('');
                 $('#userForm').trigger('reset');
                 $('#modalHeading').html("Add User");
                 $('#ajaxModel').modal('show');
             });

            //  $('#saveBtn').click(function(e) {
            //      e.preventDefault();
            //      $(this).html('Save');

            //      $.ajax({
            //          data: {
            //              '_token': '{{ csrf_token() }}',
            //              // Include other form data here
            //              // For example: 'name': $('#name').val(),
            //              //             'email': $('#email').val(),
            //              //             ...
            //              // Make sure to include all the form fields
            //          },
            //          url: "{{ route('admin-user.store') }}",
            //          type: "POST",
            //          dataType: 'json',
            //          success: function(data) {
            //              $('#userForm').trigger('reset');
            //              $('#ajaxModel').modal('hide');
            //              table.draw();
            //          },
            //          error: function(data) {
            //              console.log('Error:', data);
            //              $('#saveBtn').html('Save');
            //          }
            //      });
            //  });
         });
     </script>
 @endsection

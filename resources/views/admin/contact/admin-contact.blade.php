@extends('layouts.admin')
@section('content')
<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Tables /</span> Basic Tables</h4>
        <div class="row mb-4">

            <div class="col-2">
                <a href="?sort-by" class="btn btn-primary mx-1">Sort by DOB</a>
            </div>
            <div class="col-2">
                <a href="?sort-by" class="btn btn-primary mx-1">Primary link</a>
            </div>
            <div class="col-2">
                <form action="" class="position-relative" method="post">
                    <input type="text" class="form-control pl-5" placeholder="Search..." style="width: 300px; padding-left: 35px;">
                    <i class="fas fa-search position-absolute" style="left: 10px; top: 50%; transform: translateY(-50%);"></i>
                </form>
            </div>
        </div>
        <!-- Basic Bootstrap Table -->
        <div class="card">
            <h5 class="card-header">Table Wish Lists</h5>
            <div class="table-responsive text-nowrap">
                <table class="table" style="height: 100%;">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>User Name</th>
                            <th>Product Name</th>
                            <th>Status</th>
                            <th>Status</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach($contactAll as $contact)
                        <tr>
                            <td>{{ $contact->id }}</td>
                            <td>{{ $contact->user_name }}</td>
                            <td>{{ Str::limit($contact->email, 30) }}</td>
                            <td>{{ $contact->title }}</td>

                            <td> {{ Str::limit($contact->message, 30) }}</td>
                            @if($contact->status=='Contacted')
                            <td><span class="badge bg-label-primary me-1">{{ $contact->status }}</span></td>
                            @else
                            <td><span class="badge bg-label-danger me-1">{{ $contact->status }}</span></td>
                            @endif
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                        <i class="fa-solid fa-ellipsis-vertical"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{ route('admin-view-contact',  ['id'=>$contact->id ]) }}"><i class="bx bx-edit-alt me-1"></i>Reply</a>
                                        <a class="dropdown-item" href="{{ route('admin-contact-delete',  ['id'=>$contact->id ]) }}"><i class="bx bx-trash me-1"></i> Delete</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>


        </div>
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
</div>

    @endsection
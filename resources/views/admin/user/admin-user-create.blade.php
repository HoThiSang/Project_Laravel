@extends('layouts.admin')
@section('content')
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Forms/</span> Vertical Layouts</h4>
            <form action="{{ route('admin-user.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif

                <div class="row">
                    <div class="col-xl">
                        <div class="card mb-4">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">Add new user</h5>
                                <small class="text-muted float-end">l</small>
                            </div>
                            <div class="card-body">

                                <div class="mb-3">
                                    <label class="form-label" for="fullname">User Name</label>
                                    <div class="input-group input-group-merge">
                                        <span id="username" class="input-group-text"><i class="bx bx-user"></i></span>
                                        <input type="text" class="form-control" id="username" name="username"
                                            value="{{ old('username') }}" placeholder="User name" aria-label="John Doe"
                                            aria-describedby="basic-icon-default-fullname2" />

                                    </div>
                                    @error('username')
                                        <span style="color: red;">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="phone">phone</label>
                                    <div class="input-group input-group-merge">
                                        <span id="phone" class="input-group-text"><i class="bx bx-buildings"></i></span>
                                        <input type="text" id="phone" class="form-control" name="phone"
                                            value="{{ old('phone') }}" placeholder="phone" aria-label="ACME Inc."
                                            aria-describedby="basic-icon-default-company2" />

                                    </div>
                                    @error('phone')
                                        <span style="color: red;">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="email">email</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i class="bx bx-envelope"></i></span>
                                        <input type="text" id="email" name="email" class="form-control"
                                            value="{{ old('email') }}" placeholder="email" aria-label="john.doe"
                                            aria-describedby="basic-icon-default-email2" />
                                    </div>
                                    @error('email')
                                        <span style="color: red;">{{ $message }}</span>
                                    @enderror

                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="password">password</label>
                                    <div class="input-group input-group-merge">
                                        <span id="password" class="input-group-text"><i class="bx bx-phone"></i></span>
                                        <input type="text" id="password" name="password" value="{{ old('password') }}"
                                            class="form-control phone-mask" placeholder="password"
                                            aria-describedby="password" />
                                    </div>
                                    @error('password')
                                        <span style="color: red;">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="date_of_birth">date_of_birth</label>
                                    <div class="input-group input-group-merge">
                                        <span id="date_of_birth" class="input-group-text"><i
                                                class="bx bx-buildings"></i></span>
                                        <input type="text" id="date_of_birth" class="form-control" name="date_of_birth"
                                            value="{{ old('date_of_birth') }}" placeholder="date_of_birth"
                                            aria-label="ACME Inc." aria-describedby="basic-icon-default-company2" />

                                    </div>
                                    @error('date_of_birth')
                                        <span style="color: red;">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="address">address</label>
                                    <div class="input-group input-group-merge">
                                        <span id="address" class="input-group-text"><i class="bx bx-comment"></i></span>
                                        <textarea id="address" name="address" value="{{ old('address') }}" class="form-control" placeholder="address"
                                            aria-label="Hi, Do you have a moment to talk Joe?" aria-describedby="basic-icon-default-message2"></textarea>

                                    </div>
                                    @error('address')
                                        <span style="color: red;">{{ $message }}</span>
                                    @enderror
                                </div>
                                <input type="hiden" class="role_id" id="role_id" value="1">

                                <button type="submit" class=" btn btn-primary">Create new</button>

                            </div>
                        </div>
                    </div>

                </div>

            </form>
        </div>
        <!-- / Content -->



        <div class="content-backdrop fade"></div>
    </div>
@endsection

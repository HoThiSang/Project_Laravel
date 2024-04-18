<!-- admin-profile.blade.php -->
@extends('layouts.admin')
@section('content')
    <div class="card mb-4">
        <h5 class="card-header">Profile Details</h5>
        <!-- Account -->
        <div class="card-body">
            <!-- Hiển thị ảnh đại diện -->
            <div>
                <img src="https://down-vn.img.susercontent.com/file/cdf9af013aa652eb0596cb252b1101d4_tn" alt="user-avatar"
                    class="d-block rounded" id="uploadedAvatar" height="150px" width="150px" />
            </div>

            <!-- Hiển thị thông tin người dùng -->
            <div class="button-wrapper">
                <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                    <span class="d-none d-sm-block">Upload new photo</span>
                    <i class="bx bx-upload d-block d-sm-none"></i>
                    <input type="file" id="upload" class="account-file-input" hidden accept="image/png, image/jpeg" />
                </label>
                <button type="button" class="btn btn-outline-secondary account-image-reset mb-4">
                    <i class="bx bx-reset d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Reset</span>
                </button>
                <p class="text-muted mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p>
            </div>
        </div>
        <hr class="my-0" />
        <div class="card-body">
            <!-- Form cập nhật thông tin người dùng -->

            <form id="formAccountSettings" method="post" action="{{ route('update-admin-profile', ['id' => $user->id]) }}">
                <div class="row">
                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                    <input type="hidden" name="role_id" value="{{ $user->role_id }}">
                    <input type="hidden" name="password" value="{{ $user->password }}">
                    <div class="mb-3 col-md-6 mt-2">
                        <label for="username" class="form-label">Full Name</label>
                        <input class="form-control" type="text" id="username" name="username"
                            value="{{ $user->username }}" autofocus />
                        @error('username')
                            <span style="color: red;">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3 col-md-6 mt-2">
                        <label for="email" class="form-label">Email</label>
                        <input class="form-control" type="text" id="email" name="email" value="{{ $user->email }}"
                            autofocus />
                        @error('email')
                            <span style="color: red;">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3 col-md-6 mt-2">
                        <label for="date" class="form-label">Date of birth</label>
                        <input class="form-control" type="date" name="date" id="dateOfBirth"
                            value="{{ $user->date_of_birth }}" placeholder="XX-XX-XXXX" />

                    </div>
                    <div class="mb-3 col-md-6 mt-2">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" class="form-control" id="address" name="address"
                            value="{{ $user->address }}" />
                        @error('address')
                            <span style="color: red;">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3 col-md-6 ">
                        <label for="phone" class="form-label">Phone number</label>
                        <input type="text" class="form-control" id="phone" name="phone"
                            value="{{ $user->phone }}" placeholder="" />
                        @error('phone')
                            <span style="color: red;">{{ $message }}</span>
                        @enderror
                    </div>


                </div>
                @csrf
                <div class="mt-4" style="margin-top: 10px;">
                    <button type="submit" class="btn btn-primary me-2">Save changes</button>
                    <button type="reset" class="btn btn-outline-secondary">Cancel</button>
                </div>
            </form>
        </div>
        <!-- /Account -->
    </div>
   
        @if (session('message'))
        <script>
            alert("{{ session('message') }}");
            </script>
        @endif

        @if (session('error'))
        <script>
            alert("{{ session('error') }}");
        </script>
        @endif
   
@endsection

@extends('layouts.admin')
@section('content')
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Forms/</span> Create new banner</h4>
            <form action="{{ route('create-new-banner') }}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-xl">
                        <div class="card mb-4">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">Add new banner</h5>
                                <small class="text-muted float-end">l</small>
                            </div>
                            <div class="card-body">

                                <div class="mb-3">
                                    <label class="form-label" for="fullname">Title</label>
                                    <div class="input-group input-group-merge">
                                        <span id="title" class="input-group-text"><i class="bx bx-user"></i></span>
                                        <input type="text" class="form-control" id="title" name="title"
                                            value="{{ old('title') }}" placeholder="Title" aria-label="John Doe"
                                            aria-describedby="basic-icon-default-fullname2" />

                                    </div>
                                    @error('title')
                                        <span style="color: red;">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="price">Content</label>
                                    <div class="input-group input-group-merge">
                                        <span id="content" class="input-group-text"><i class="bx bx-buildings"></i></span>
                                        <input type="text" id="content" class="form-control" name="content"
                                            value="{{ old('content') }}" placeholder="Content" aria-label="ACME Inc."
                                            aria-describedby="basic-icon-default-company2" />

                                    </div>
                                    @error('content')
                                        <span style="color: red;">{{ $message }}</span>
                                    @enderror
                                </div>

                                <button type="submit" onclick="uploadImg()" class=" btn btn-primary">Create</button>

                            </div>
                        </div>
                    </div>
                    <div class="col-xl">
                        <div class="card mb-4">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="mb-0"></h5>
                                <small class="text-muted float-end">Merged input group</small>
                            </div>

                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label" for="ingredient">Image Name</label>
                                    <div class="input-group input-group-merge">
                                        <span id="image_name" class="input-group-text"><i class="bx bx-comment"></i></span>
                                        <textarea id="image_name" class="form-control" name="image_name" value="{{ old('image_name') }}" placeholder=""
                                            aria-label="" aria-describedby="basic-icon-default-message2"></textarea>

                                    </div>
                                    @error('image_name')
                                        <span style="color: red;">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <input type="hidden" id="imageUrl" name="url" value="">
                                    <input id="image" type="file" accept="image/*" name="image_url"
                                        onchange="loadFile(event)">

                                </div>
                                @error('image')
                                    <span style="color: red;">{{ $message }}</span>
                                @enderror
                                <div>
                                    <img style="width: 200px; height: 200px; list-style-type: none; border:none"
                                        id="output" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </form>
        </div>
        <!-- / Content -->



        <div class="content-backdrop fade"></div>
    @endsection

    @section('js')
<script>
    let file = null;
    var loadFile = function(event) {

        for (let i = 0; i <= event.target.files.length - 1; i++) {

            const fsize = event.target.files.item(i).size;
            const filee = Math.round((fsize / 1024));
            // The size of the file.
            if (filee > 4096) {
                alert("File too Big, please select a file less than 4mb");
            } else {
                var output = document.getElementById('output');
                file = event;
                output.src = URL.createObjectURL(event.target.files[0]);
                output.onload = function() {
                    URL.revokeObjectURL(output.src) // free memory
                }
            }
        }
    };

</script>

@endsection
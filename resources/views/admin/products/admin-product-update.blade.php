@extends('layouts.admin')
@section('content')
<div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Forms/</span> Vertical Layouts</h4>
        <form action="{{  route('admin-product-update', ['id'=> $productDetail->id]) }}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="row">
                <div class="col-xl">
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Add new products</h5>
                            <small class="text-muted float-end">l</small>
                        </div>
                        <div class="card-body">

                            <div class="mb-3">
                                <label class="form-label" for="fullname">Product Name</label>
                                <div class="input-group input-group-merge">
                                    <span id="product_name" class="input-group-text"><i class="bx bx-user"></i></span>
                                    <input type="text" class="form-control" id="product_name" name="product_name" value="{{ $productDetail->product_name }}" placeholder="Product name" aria-label="John Doe" aria-describedby="basic-icon-default-fullname2" />

                                </div>
                                @error('product_name')
                                <span style="color: red;">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="price">Price</label>
                                <div class="input-group input-group-merge">
                                    <span id="price" class="input-group-text"><i class="bx bx-buildings"></i></span>
                                    <input type="text" id="price" class="form-control" name="price" value="{{ $productDetail->price }}" placeholder="Price of product" aria-label="ACME Inc." aria-describedby="basic-icon-default-company2" />

                                </div>
                                @error('price')
                                <span style="color: red;">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="discount">Discount</label>
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text"><i class="bx bx-envelope"></i></span>
                                    <input type="text" id="discount" name="discount" class="form-control" value="{{ $productDetail->discount }}" placeholder="Discount of product" aria-label="john.doe" aria-describedby="basic-icon-default-email2" />
                                </div>
                                @error('discount')
                                <span style="color: red;">{{$message}}</span>
                                @enderror

                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="quantity">Quantity</label>
                                <div class="input-group input-group-merge">
                                    <span id="quantity" class="input-group-text"><i class="bx bx-phone"></i></span>
                                    <input type="text" id="quantity" name="quantity" value="{{ $productDetail->quantity }}" class="form-control phone-mask" placeholder="Quantity" aria-describedby="quantity" />
                                </div>
                                @error('quantity')
                                <span style="color: red;">{{$message}}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="price">Brand</label>
                                <div class="input-group input-group-merge">
                                    <span id="brand" class="input-group-text"><i class="bx bx-buildings"></i></span>
                                    <input type="text" id="brand" class="form-control" name="brand" value="{{ $productDetail->brand }}" placeholder="Brand of product" aria-label="ACME Inc." aria-describedby="basic-icon-default-company2" />

                                </div>
                                @error('brand')
                                <span style="color: red;">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="description">Description</label>
                                <div class="input-group input-group-merge">
                                    <span id="description" class="input-group-text"><i class="bx bx-comment"></i></span>
                                    <textarea id="description" name="description" value="{{ $productDetail->description }}" class="form-control" placeholder="Description for your product" aria-label="Hi, Do you have a moment to talk Joe?" aria-describedby="basic-icon-default-message2">{{ $productDetail->description }}</textarea>

                                </div>
                                @error('description')
                                <span style="color: red;">{{$message}}</span>
                                @enderror
                            </div>
                            <button type="submit" class=" btn btn-primary">Update</button>

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
                                <label class="form-label" for="ingredient">Ingredient</label>
                                <div class="input-group input-group-merge">
                                    <span id="ingredient" class="input-group-text"><i class="bx bx-comment"></i></span>
                                    <textarea id="ingredient" class="form-control" name="ingredient" value="{{ $productDetail->ingredient }}" placeholder="Ingredient for your product" aria-label="" aria-describedby="basic-icon-default-message2">{{ $productDetail->ingredient }}</textarea>

                                </div>
                                @error('ingredient')
                                <span style="color: red;">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-icon-default-company">Category name</label>
                                <div class="">
                                    <select name="category_id" id="category_name" class=" form-select">
                                        @foreach($categoryAll as $category)
                                        <option name="category_id" value="{{ $category->id }}">{{ $category->category_name }}</option>
                                        @endforeach
                                    </select>

                                </div>
                                @error('category_id')
                                <span style="color: red;">{{$message}}</span>
                                @enderror
                            </div>
                            <!-- <div class=""> -->
                            @foreach ($imageAll as $image)
                            <div>
                                <!-- <p>ID: {{ $image->id }}</p>
                                <p>Image Name: {{ $image->image_name }}</p> -->
                                <img src="{{ asset('/images/' . $image->image_url) }}" alt="{{ $image->image_name }}">
                            </div>
                            @endforeach

                            <!-- </div> -->
                            <input type="file" class="form-control" id="images" name="images[]" multiple onchange="loadFile(event)">
                            <small class="text-muted">Select one or more images to upload (max: 4MB per image)</small>
                            @error('images')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror

                            <div>
                                <img style="width: 200px; height: 200px; list-style-type: none; border:none" id="output" />
                            </div>
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



    // async function uploadImg() {
    //     const cloud_name = '{{ env("CLOUDINARY_NAME") }}';
    //     const upload_preset = '{{ env("CLOUDINARY_UPLOAD_PRESET") }}';
    //     const api_key = '{{ env("CLOUDINARY_API_KEY") }}';
    //     const api_secret = '{{ env("CLOUDINARY_API_SECRET") }}';

    //     let url = '';

    //     const formData = new FormData();
    //     formData.append("file", file.target.files[0]);
    //     formData.append("upload_preset", upload_preset);
    //     formData.append("api_key", api_key);
    //     formData.append("api_secret", api_secret);
    //     const options = {
    //         method: "POST",
    //         body: formData,
    //     };

    //     if (file) {
    //         await fetch(
    //                 `https://api.cloudinary.com/v1_1/${cloud_name}/upload/`,
    //                 options
    //             )
    //             .then((res) => res.json())
    //             .then((data) => {
    //                 console.log(data);
    //                 url = data.secure_url

    //             })
    //             .catch((err) => console.log(err));
    //         //    console.log(url);
    //         return url
    //     }

    //     return;

    // }
</script>


@endsection
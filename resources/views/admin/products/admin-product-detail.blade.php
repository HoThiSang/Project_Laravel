 <!-- Content wrapper -->

 @extends('layouts.admin')
 @section('content')
 <div class="content-wrapper">
     <div class="row mt-4">
         <!-- Information on the right -->
         <div class="col-md-12 align-content-center">
             <h1 class="text-center text-danger" id="title">INFORMATION OF PRODUCT HAS ID {{ $productDetail->id }} </h1>
         </div>
         <div class="col-md-3 mt-4" style="margin-left: 40px;">
             <!-- Image on the left -->
           
             <img src="{{ asset('images/' . $imageAll[0]->image_url) }}" alt="Car Image" class="img-fluid" style="height:300px;" >
         </div>
         

         <div class="col-md-8">
             <div class="col-md-8 mt-4">
                 <ul class="list-group">
                     <li class="list-group-item d-flex justify-content-between align-items-center active">
                         ID : {{ $productDetail->id }}
                     </li>
                     <li class="list-group-item d-flex justify-content-between align-items-center">
                         Product name : {{ $productDetail->product_name }}
                     </li>
                     <li class="list-group-item d-flex justify-content-between align-items-center">
                         Price : {{ $productDetail->price }}
                     </li>
                     <li class="list-group-item d-flex justify-content-between align-items-center">
                         Promotion : {{ $productDetail->discounted_price }}
                     </li>
                     <li class="list-group-item d-flex justify-content-between align-items-center">
                         Quantity : {{ $productDetail->quantity }}
                     </li>
                     <li class="list-group-item d-flex justify-content-between align-items-center">
                         Category name : {{ $category->category_name }}
                     </li>
                 </ul>
             </div>
             <div>
                 <a href="{{ route('admin.product-index')}}" class="btn btn-primary mt-4">Back</a>
             </div>
         </div>
     </div>

    
 </div>
 @endsection
 
@extends('layouts.master')
@section('content')
   
<div class="body-content outer-top-xs">
    <div class='container'>
        <div class='row single-product'>
            <div class='col-md-3 sidebar'>
                <div class="sidebar-module-container">
                    <div class="home-banner outer-top-n">
              
                    </div>	
                </div>
            </div>
            <div class='col-md-9'>
                <div class="detail-block">
                    <div class="row  wow fadeInUp">
                        <div class="col-xs-12 col-sm-6 col-md-5 gallery-holder">
                            <div class="product-item-holder size-big single-product-gallery small-gallery">
                                <div id="owl-single-product">
                                    <div class="single-product-gallery-item" id="slide1">
                                        @if(isset($product_images))
                                            @foreach($product_images as $image)
                                                <img src="{{ $image->image_url }}" alt="Product Image" class="img-fluild" height="400" width="350">
                                            @endforeach
                                        @endif
                                    </div><!-- /.single-product-gallery-item -->
                                </div>
                                <div class="single-product-gallery-thumbs gallery-thumbs">

            
            

        </div><!-- /.single-product-slider -->
                            </div><!-- /.single-product-gallery -->
                        </div><!-- /.gallery-holder -->        			
                        <div class='col-sm-6 col-md-7 product-info-block'>
                            <div class="product-info">
                                @if(isset($product))
                                    <h1 class="name">{{ $product->product_name }}</h1>
                                    <div class="rating-reviews m-t-20">
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <div class="rating rateit-small"></div>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="reviews">
                                                    <a href="#" class="lnk">(13 Reviews)</a>
                                                </div>
                                            </div>
                                        </div><!-- /.row -->		
                                    </div><!-- /.rating-reviews -->
                                    <div class="stock-container info-container m-t-10">
                                        <div class="row">
                                            <div class="col-sm-2">
                                                <div class="stock-box">
                                                    <span class="label">Availability :</span>
                                                </div>	
                                            </div>
                                            <div class="col-sm-9">
                                                <div class="stock-box">
                                                    <span class="value">In Stock</span>
                                                </div>	
                                            </div>
                                        </div><!-- /.row -->	
                                    </div><!-- /.stock-container -->
                                    <div class="description-container m-t-20">
                                        {{ $product->description }}
                                    </div><!-- /.description-container -->
                                    <div class="price-container info-container m-t-20">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="price-box">
                                                    <span class="price">{{ $product->price }}</span>
                                                    <span class="price-strike">{{ $product->discounted_price }}</span>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="favorite-button m-t-10">
                                                    <a class="btn btn-primary" data-toggle="tooltip" data-placement="right" title="Wishlist" href="#">
                                                        <i class="fa fa-heart"></i>
                                                    </a>
                                                    <a class="btn btn-primary" data-toggle="tooltip" data-placement="right" title="Add to Compare" href="#">
                                                        <i class="fa fa-signal"></i>
                                                    </a>
                                                    <a class="btn btn-primary" data-toggle="tooltip" data-placement="right" title="E-mail" href="#">
                                                        <i class="fa fa-envelope"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div><!-- /.row -->
                                    </div><!-- /.price-container -->
                                    <div class="quantity-container info-container">
                                        <div class="row">
                                            <div class="col-sm-2">
                                                <span class="label">Qty :</span>
                                            </div>
                                            <div class="col-sm-2">
                                                <div class="cart-quantity">
                                                    <div class="quant-input">
                                                        <div class="arrows">
                                                            <div class="arrow plus gradient"><span class="ir"><i class="icon fa fa-sort-asc"></i></span></div>
                                                            <div class="arrow minus gradient"><span class="ir"><i class="icon fa fa-sort-desc"></i></span></div>
                                                        </div>
                                                        <input type="text" value="1">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-7">
                                                <a href="#" class="btn btn-primary"><i class="fa fa-shopping-cart inner-right-vs"></i> ADD TO CART</a>
                                            </div>
                                        </div><!-- /.row -->
                                    </div><!-- /.quantity-container -->	
                                @endif
                            </div><!-- /.product-info -->
                        </div><!-- /.col-sm-7 -->
                    </div><!-- /.row -->
                </div>
                <div class="product-tabs inner-bottom-xs  wow fadeInUp">
                    <div class="row">
                        <div class="col-sm-3">
                            <ul id="product-tabs" class="nav nav-tabs nav-tab-cell">
                                <li class="active"><a data-toggle="tab" href="#description">DESCRIPTION</a></li>
                            </ul><!-- /.nav-tabs #product-tabs -->
                        </div>
                        <div class="col-sm-9">
                            <div class="tab-content">
                                <div id="description" class="tab-pane in active">
                                    <div class="product-tab">
                                        @if(isset($product))
                                            <p class="text">{{ $product->description }}</p>
                                        @endif
                                    </div>	
                                </div><!-- /.tab-pane -->
                                <div id="review" class="tab-pane">
                                    <div class="product-tab">										
                                        <div class="product-reviews">
                                            <h4 class="title">Customer Reviews</h4>
                                            <div class="reviews">
                                                <div class="review">
                                                    <div class="review-title"><span class="summary">We love this product</span><span class="date"><i class="fa fa-calendar"></i><span>1 days ago</span></span></div>
                                                </div><!-- /.reviews -->
                                            </div><!-- /.product-reviews -->
                                            <div class="product-add-review">
                                                <h4 class="title">Write your own review</h4>
                                                <div class="review-table">
                                                    <div class="table-responsive">
                                                        <table class="table">	
                                                            <thead>
                                                                <tr>
																	<th class="cell-label">&nbsp;</th>
																	<th>1 star</th>
																	<th>2 stars</th>
																	<th>3 stars</th>
																	<th>4 stars</th>
																	<th>5 stars</th>
																</tr>
															</thead>	
															<tbody>
																<tr>
																	<td class="cell-label">Quality</td>
																	<td><input type="radio" name="quality" class="radio" value="1"></td>
																	<td><input type="radio" name="quality" class="radio" value="2"></td>
																	<td><input type="radio" name="quality" class="radio" value="3"></td>
																	<td><input type="radio" name="quality" class="radio" value="4"></td>
																	<td><input type="radio" name="quality" class="radio" value="5"></td>
																</tr>
																<tr>
																	<td class="cell-label">Price</td>
																	<td><input type="radio" name="quality" class="radio" value="1"></td>
																	<td><input type="radio" name="quality" class="radio" value="2"></td>
																	<td><input type="radio" name="quality" class="radio" value="3"></td>
																	<td><input type="radio" name="quality" class="radio" value="4"></td>
																	<td><input type="radio" name="quality" class="radio" value="5"></td>
																</tr>
																<tr>
																	<td class="cell-label">Value</td>
																	<td><input type="radio" name="quality" class="radio" value="1"></td>
																	<td><input type="radio" name="quality" class="radio" value="2"></td>
																	<td><input type="radio" name="quality" class="radio" value="3"></td>
																	<td><input type="radio" name="quality" class="radio" value="4"></td>
																	<td><input type="radio" name="quality" class="radio" value="5"></td>
																</tr>
															</tbody>
														</table><!-- /.table .table-bordered -->
													</div><!-- /.table-responsive -->
												</div><!-- /.review-table -->
												<div class="review-form">
													<div class="form-container">
														<form role="form" class="cnt-form">
															<div class="row">
																<div class="col-sm-6">
																	<div class="form-group">
																		<label for="exampleInputName">Your Name <span class="astk">*</span></label>
																		<input type="text" class="form-control txt" id="exampleInputName" placeholder="">
																	</div><!-- /.form-group -->
																	<div class="form-group">
																		<label for="exampleInputSummary">Summary <span class="astk">*</span></label>
																		<input type="text" class="form-control txt" id="exampleInputSummary" placeholder="">
																	</div><!-- /.form-group -->
																</div>
																<div class="col-md-6">
																	<div class="form-group">
																		<label for="exampleInputReview">Review <span class="astk">*</span></label>
																		<textarea class="form-control txt txt-review" id="exampleInputReview" rows="4" placeholder=""></textarea>
																	</div><!-- /.form-group -->
																</div>
															</div><!-- /.row -->
															<div class="action text-right">
																<button class="btn btn-primary btn-upper">SUBMIT REVIEW</button>
															</div><!-- /.action -->
														</form><!-- /.cnt-form -->
													</div><!-- /.form-container -->
												</div><!-- /.review-form -->
											</div><!-- /.product-add-review -->										
										</div><!-- /.product-tab -->
									</div><!-- /.tab-pane -->
									<div id="tags" class="tab-pane">
										<div class="product-tag">
											<h4 class="title">Product Tags</h4>
											<form role="form" class="form-inline form-cnt">
												<div class="form-container">
													<div class="form-group">
														<label for="exampleInputTag">Add Your Tags: </label>
														<input type="email" id="exampleInputTag" class="form-control txt">
													</div>
													<button class="btn btn-upper btn-primary" type="submit">ADD TAGS</button>
												</div><!-- /.form-container -->
											</form><!-- /.form-cnt -->
											<form role="form" class="form-inline form-cnt">
												<div class="form-group">
													<label>&nbsp;</label>
													<span class="text col-md-offset-3">Use spaces to separate tags. Use single quotes (') for phrases.</span>
												</div>
											</form><!-- /.form-cnt -->
										</div><!-- /.product-tab -->
									</div><!-- /.tab-pane -->
								</div><!-- /.tab-content -->
							</div><!-- /.col -->
						</div><!-- /.row -->
					</div><!-- /.product-tabs -->
				</div><!-- /.col -->
				<div class="clearfix"></div>
			</div><!-- /.row -->
	</div>
    </div>
</div>

@endsection
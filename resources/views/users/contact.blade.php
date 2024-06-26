@extends('layouts.master')

@section('content')
<div class="body-content">
	<div class="container">
		<div class="contact-page">
			<div class="row">

				<div class="col-md-12 contact-map outer-bottom-vs">
					<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3834.1104354879126!2d108.24107171071451!3d16.059758034554186!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3142177f2ced6d8b%3A0xeac35f2960ca74a4!2zOTkgVMO0IEhp4bq_biBUaMOgbmgsIFBoxrDhu5tjIE3hu7ksIFPGoW4gVHLDoCwgxJDDoCBO4bq1bmcgNTUwMDAwLCBWaWV0bmFt!5e0!3m2!1sen!2s!4v1710951115010!5m2!1sen!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
				</div>

				<div class="col-md-9 contact-form">
					<div class="col-md-12 contact-title">
						<h4>Contact Form</h4>
					</div>
					<form action="{{ route('sendEmail') }}" method="post">
						@csrf
						<div class="col-md-4">
							<div class="form-group">
								<label class="info-title" for="user_name">Your name <span>*</span></label>
								<input type="text" class="form-control unicase-form-control text-input" id="user_name" name="user_name" placeholder="Your name">
								@error('user_name')
								<span style="color: red;">{{$message}}</span>
								@enderror
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label class="info-title" for="email">Email Address <span>*</span></label>
								<input type="email" class="form-control unicase-form-control text-input" id="email" name="email" placeholder="Your email">
								@error('email')
								<span style="color: red;">{{$message}}</span>
								@enderror
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label class="info-title" for="title">Title <span>*</span></label>
								<input type="text" class="form-control unicase-form-control text-input" id="title" name="title" placeholder="Title">
								@error('title')
								<span style="color: red;">{{$message}}</span>
								@enderror
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<label class="info-title" for="message">Your Message <span>*</span></label>
								<textarea class="form-control unicase-form-control" id="message" name="message"></textarea>
								@error('message')
								<span style="color: red;">{{$message}}</span>
								@enderror
							</div>
						</div>
						<div class="col-md-12 outer-bottom-small m-t-20">
							<button type="submit" class="btn btn-primary">Send Message</button>
						</div>
					</form>
				</div>


				<div class="col-md-3 contact-info">
					<div class="contact-title">
						<h4>Information</h4>
					</div>
					<div class="clearfix address">
						<span class="contact-i"><i class="fa fa-map-marker"></i></span>
						<span class="contact-span">99 Tô Hiến Thành, Phước Mỹ, Sơn Trà, Đà Nẵng</span>
					</div>
					<div class="clearfix phone-no">
						<span class="contact-i"><i class="fa fa-mobile"></i></span>
						<span class="contact-span">(+84) 094 - 6928 - 517</span>
					</div>
					<div class="clearfix email">
						<span class="contact-i"><i class="fa fa-envelope"></i></span>
						<span class="contact-span"><a href="#">codequeens@gmail.com</a></span>
					</div>
				</div>

			</div><!-- /.contact-page -->
		</div><!-- /.row -->
		<!-- ============================================== BRANDS CAROUSEL ============================================== -->
		<div id="brands-carousel" class="logo-slider wow fadeInUp">

			<div class="logo-slider-inner">
				<div id="brand-slider" class="owl-carousel brand-slider custom-carousel owl-theme">
					<div class="item m-t-15">
						<a href="#" class="image">
							<img data-echo="assets/images/brands/brand1.png" src="assets\images\blank.gif" alt="">
						</a>
					</div><!--/.item-->

					<div class="item m-t-10">
						<a href="#" class="image">
							<img data-echo="assets/images/brands/brand2.png" src="assets\images\blank.gif" alt="">
						</a>
					</div><!--/.item-->

					<div class="item">
						<a href="#" class="image">
							<img data-echo="assets/images/brands/brand3.png" src="assets\images\blank.gif" alt="">
						</a>
					</div><!--/.item-->

					<div class="item">
						<a href="#" class="image">
							<img data-echo="assets/images/brands/brand4.png" src="assets\images\blank.gif" alt="">
						</a>
					</div><!--/.item-->

					<div class="item">
						<a href="#" class="image">
							<img data-echo="assets/images/brands/brand5.png" src="assets\images\blank.gif" alt="">
						</a>
					</div><!--/.item-->

					<div class="item">
						<a href="#" class="image">
							<img data-echo="assets/images/brands/brand6.png" src="assets\images\blank.gif" alt="">
						</a>
					</div><!--/.item-->

					<div class="item">
						<a href="#" class="image">
							<img data-echo="assets/images/brands/brand2.png" src="assets\images\blank.gif" alt="">
						</a>
					</div><!--/.item-->

					<div class="item">
						<a href="#" class="image">
							<img data-echo="assets/images/brands/brand4.png" src="assets\images\blank.gif" alt="">
						</a>
					</div><!--/.item-->

					<div class="item">
						<a href="#" class="image">
							<img data-echo="assets/images/brands/brand1.png" src="assets\images\blank.gif" alt="">
						</a>
					</div><!--/.item-->

					<div class="item">
						<a href="#" class="image">
							<img data-echo="assets/images/brands/brand5.png" src="assets\images\blank.gif" alt="">
						</a>
					</div><!--/.item-->
				</div><!-- /.owl-carousel #logo-slider -->
			</div><!-- /.logo-slider-inner -->

		</div><!-- /.logo-slider -->
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
		<script src="switchstylesheet/switchstylesheet.js"></script>

		<script>
			$(document).ready(function() {
				$(".changecolor").switchstylesheet({
					seperator: "color"
				});
				$('.show-theme-options').click(function() {
					$(this).parent().toggleClass('open');
					return false;
				});
			});

			$(window).bind("load", function() {
				$('.show-theme-options').delay(2000).trigger('click');
			});
		</script>
	</div>
	@endsection
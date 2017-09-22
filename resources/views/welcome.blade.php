@extends('layouts.app')
@section('content')
	<div id="home_carousel" class="carousel slide" data-ride="carousel">
		<ol class="carousel-indicators">
			<li data-target="#home_carousel" data-slide-to="0" class="active"></li>
			<li data-target="#home_carousel" data-slide-to="1" class=""></li>
			<li data-target="#home_carousel" data-slide-to="2" class=""></li>
		</ol>
		<div class="carousel-inner">
			<div class="carousel-item active">
				<div class="carousel-image" style="background: linear-gradient(rgba(0, 0, 0, 0), rgba(0, 0, 40, 0.6)), url('/images/family-and-house1.jpg')"></div>
				<div class="container">
					<div class="carousel-caption d-none d-md-block text-left">
						<h1>Example headline.</h1>
						<p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
						<p><a class="btn btn-lg btn-primary" href="#" role="button">Sign up today</a></p>
					</div>
				</div>
			</div>
			<div class="carousel-item">
				<div class="carousel-image" style="background: linear-gradient(rgba(0, 0, 0, 0), rgba(0, 0, 40, 0.6)), url('/images/family-and-house12.jpg')"></div>
				<div class="container">
					<div class="carousel-caption d-none d-md-block">
						<h1>Another example headline.</h1>
						<p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
						<p><a class="btn btn-lg btn-primary" href="#" role="button">Learn more</a></p>
					</div>
				</div>
			</div>
			<div class="carousel-item">
				<div class="carousel-image" style="background: linear-gradient(rgba(0, 0, 0, 0), rgba(0, 0, 40, 0.6)), url('/images/family-and-house3.jpg')"></div>
				<div class="carousel-caption d-none d-md-block text-right">
					<h1>One more for good measure.</h1>
					<p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
					<p><a class="btn btn-lg btn-primary" href="#" role="button">Browse gallery</a></p>
				</div>
			</div>
		</div>

		<a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
			<span class="carousel-control-prev-icon" aria-hidden="true"></span>
			<span class="sr-only">Previous</span>
		</a>
		<a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
			<span class="carousel-control-next-icon" aria-hidden="true"></span>
			<span class="sr-only">Next</span>
		</a>
	</div>
	<div class="container">
		<!-- Three columns of text below the carousel -->
		<div class="row">
			<div class="col-lg-4">
				<img class="mx-auto d-block rounded-circle" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="Generic placeholder image" width="140" height="140">
				<h2 class="">Heading</h2>
				<p>Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod. Nullam id dolor id nibh ultricies vehicula ut id elit. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Praesent commodo cursus magna.</p>
				<p><a class="btn btn-secondary" href="#" role="button">View details »</a></p>
			</div><!-- /.col-lg-4 -->
			<div class="col-lg-4">
				<img class="mx-auto d-block rounded-circle" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="Generic placeholder image" width="140" height="140">
				<h2>Heading</h2>
				<p>Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Cras mattis consectetur purus sit amet fermentum. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh.</p>
				<p><a class="btn btn-secondary" href="#" role="button">View details »</a></p>
			</div><!-- /.col-lg-4 -->
			<div class="col-lg-4">
				<img class="mx-auto d-block rounded-circle" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="Generic placeholder image" width="140" height="140">
				<h2>Heading</h2>
				<p>Donec sed odio dui. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula porta felis euismod semper. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>
				<p><a class="btn btn-secondary" href="#" role="button">View details »</a></p>
			</div><!-- /.col-lg-4 -->
		</div><!-- /.row -->


		<!-- START THE FEATURETTES -->

		<hr class="">

		@if($setting->show_welcome == "Y")
			@if($showcase_properties->isNotEmpty())
				@foreach($showcase_properties as $showcase)
					@php $image = $showcase->medias()->first(); @endphp
					<div class="row align-items-center">
						<div class="col-md-7">
							<h2 class="text-left">{{ $showcase->title }}</h2>
							<p class="lead">{{ $showcase->description }}</p>
						</div>
						<div class="col-md-5">
							<img class="img-fluid mx-auto" alt="Property Image" style="width: 500px; height: 500px;" src="{{ $image->path }}">
						</div>
					</div>

					<hr class="">
				@endforeach
			@else
				<div class="row">
					<h2 class="col">No Showcase Properties</h2>
				</div>
			@endif
		@endif

		@if($setting->show_welcome == "Y")
			<div class="modal fade" id="welcome_modal">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						@if($setting->welcome_media != null)
							<div class="modal-header">
								<div class="embed-responsive embed-responsive-1by1">
								  <iframe class="embed-responsive-item" src="{{ asset('storage/' . str_ireplace('public/', '', $setting->welcome_media)) }}" allowfullscreen></iframe>
								</div>
							</div>
						@endif
						<div class="modal-body text-dark">
							<p class="">{{ $setting->welcome_content }}</p>
						</div>
						<div class="modal-footer">
							<button type="button" class="cancelBtn btn btn-warning text-center" data-dismiss="modal">Close</button>
						</div>
					</div>
				</div>
			</div>
			
			<script type="text/javascript">
				// Show welcome modal
				$('#welcome_modal').addClass('d-block');
				setTimeout(function() {
					$('#welcome_modal').addClass('show');
					$('body').addClass('modal-open').append("<div class='modal-backdrop fade show'></div>");
				}, 500);
			</script>
		@endif
	</div>
@endsection
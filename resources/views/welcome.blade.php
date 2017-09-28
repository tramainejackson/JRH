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
		<!-- START THE FEATURETTES -->
		<div class="row align-items-center">
			<h1 class="col col-4 text-hide" style="border:1px solid #787878 !important">Hidden Text</h1>
			<h1 class="col col-4 text-muted">Featured Properties</h1>
			<h1 class="col col-4 text-hide" style="border:1px solid #787878 !important">Hidden Text</h1>
		</div>
		@if($showcase_properties->isNotEmpty())
			@foreach($showcase_properties as $showcase)
				@if($showcase->medias()->first())
					@php $image = $showcase->medias()->first(); @endphp
					@php $image = asset('storage/' . str_ireplace('public/', '', $image->path)); @endphp
				@else
					@php $image = '/images/empty_prop.png'; @endphp
				@endif
				<div class="row mt-4 align-items-center">
					<div class="col-md-7{{ $loop->iteration == 2 ? ' order-2' : '' }} ">
						<h2 class="text-left">{{ $showcase->title }}</h2>
						<p class="lead">{{ $showcase->description }}</p>
					</div>
					<div class="col-md-5{{ $loop->iteration == 2 ? ' order-1' : '' }}">
						<img class="img-fluid mx-auto" alt="Property Image" style="width: 500px; height: 500px;" src="{{ $image }}">
					</div>
				</div>
				
				@if(!$loop->last)
					<hr/>
				@endif
			@endforeach
		@else
			<div class="row mt-4">
				<h2 class="col">No Featured Properties Added Yet</h2>
			</div>
		@endif
	</div>

	<!-- Additional Services Div -->
	<div class="container-fluid" style="margin-bottom:-3em;">
		<div class="row align-items-center mt-5 py-3" id="addt_service_transition">
			<h1 class="col text-white p-4 mx-5 rounded display-4" style="background: rgba(0, 0, 0, 0.5);">Having Trouble Managing Your Properties??</h1>
		</div>
		<div class="row">
			<div class="col py-5 bg-theme3 text-center" style="color: #ebf1fb;">
				<h2 class="p-2">Does this sound familiar?</h2>
				<ul class="mx-auto p-3 text-left" style="max-width: fit-content; list-style-image: url(/images/checkmark-green-small.png);">
					<li class="">Can't Find a good tenant</li>
					<li class="">Tenants not paying rent on time</li>
					<li class="">Unable to get someone to fix the leak in the kitchen</li>
					<li class="">Property vacant for months at a time</li>
				</ul>
				<h3 class="p-2">Give us a call and we can help you out with getting up and running or managing your property for you</h3>
				<a class="btn btn-primary mx-auto" href="{{ route('contact_us') }} " style="color: #ebf1fb;">Contact Us</a>
			</div>
		</div>
	</div>
		
	<div class="container-fluid">
		<!-- Modal which will show when page loads if settings are Yes -->
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
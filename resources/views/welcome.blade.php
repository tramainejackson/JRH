@extends('layouts.app')

@section('addt_style')
	<link href="{{ asset('/css/mat.css') }}" rel="stylesheet">
@endsection

@section('content')
	@php $carouselImages = explode(';', $setting->carousel_images); @endphp
	<div id="home_carousel" class="carousel carousel-slider" data-indicators="true">
		@foreach($carouselImages as $carouselImage)
			<div class="carousel-item{{ $loop->first ? ' active' : '' }}">
				<div class="carousel-image" style="background: linear-gradient(rgba(0, 0, 0, 0), rgba(0, 0, 40, 0.6)), url({{ asset('storage/images/' . trim($carouselImage)) }})"></div>
				<div class="container">
					<div class="carousel-caption d-md-block text-left">
						@if($loop->first)
							<h1>Experienced Professionals.</h1>
							<p>A leading real estate agent with over 15 years of experience, provides exciting choices for enhancing your quality of life. We are dedicated to quality and community commitment translate to your peace of mind</p>
							<!--- <p class="text-sm-center"><a class="btn btn-lg btn-primary d-block d-sm-inline" href="#" role="button">Sign up today</a></p> --->
						@elseif($loop->iteration == 2)
							<h1>We got what you need.</h1>
							<p>Jackson Rental Homes LLC is one of the only businesses in the Philadelphia responsible for rehabing houses and providing reasonable accommodations for people of all walks of life and financial stature.</p>
						@elseif($loop->iteration == 3)
							<h1>Cutting Edge Designs.</h1>
							<p>Jackson Rental Homes LLC offers a complete range of development and construction services, from the design phase through site work, to complex commercial and residential construction projects.</p>
						@elseif($loop->iteration == 4)
							<h1>A little something for everybody.</h1>
							<p>Jackson Rental Homes LLC offers a selection of homes for sale and rent for every lifestyle.</p>
						@endif
					</div>
				</div>
			</div>
		@endforeach
	</div>
	<div class="container">
		<!-- START THE FEATURETTES -->
		<div class="row align-items-center">
			<h1 class="col-2 col-md-4 text-hide" style="border:1px solid #787878 !important">Hidden Text</h1>
			<h1 class="col-8 col-md-4 text-muted">Featured Properties</h1>
			<h1 class="col-2 col-md-4 text-hide" style="border:1px solid #787878 !important">Hidden Text</h1>
		</div>
		@if($showcase_properties->isNotEmpty())
			@foreach($showcase_properties as $showcase)
				@if($showcase->medias()->first())
					@php $image = $showcase->medias()->first(); @endphp
					@php $image = asset('storage/' . str_ireplace('public/', '', $image->path)); @endphp
				@else
					@php $image = '/images/empty_prop.png'; @endphp
				@endif
				<div class="row mt-4 d-flex align-items-center showcaseProps">
					<div class="col-md-7 order-2{{ $loop->iteration == 2 ? ' order-sm-1' : '' }} ">
						<h2 class="text-center text-sm-left">{{ $showcase->title }}</h2>
						<h5 class="text-center text-sm-left">{{ $showcase->city }}&nbsp;{{ $showcase->state }},&nbsp;{{ $showcase->zip }}</h5>
						<p class="lead py-3">{{ $showcase->description }}</p>
						<a href="/properties/{{ $showcase->id }}/{{ Auth::check() ? 'edit' : '' }}" class="btn text-theme1 btn-theme3 btn-lg d-block d-sm-inline{{ $showcase->active == 'N' ? ' disabled' : '' }}" >View Details</a>
					</div>
					<div class="mb-2 text-center col-md-5 order-1{{ $loop->iteration == 2 ? ' order-sm-2' : '' }}">
						<img class="img-fluid mx-auto" alt="Property Image" style="" src="{{ $image }}">
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
	<div class="container-fluid" style="{{ (Auth::guest()) ? 'margin-bottom:-3em;' : 'margin-bottom:-5em;' }}">
		<div class="row align-items-center mt-5 mb-0 py-3" id="addt_service_transition">
			<h1 class="col text-white p-sm-4 p-0 mx-4 rounded display-5 display-sm-4" style="background: rgba(0, 0, 0, 0.5);">Having Trouble Managing Your Properties??</h1>
		</div>
		<div class="row">
			<div class="col py-5 bg-theme3 text-center" style="color: #ebf1fb;">
				<h2 class="p-2">Does this sound familiar?</h2>
				<ul id="addt_service_list" class="mx-auto pl-5 pr-1 p-sm-3 text-left" style="max-width: fit-content; list-style-image: url(/images/checkmark-green-small.png);">
					<li class="">Can't Find a good tenant</li>
					<li class="">Tenants not paying rent on time</li>
					<li class="">Unable to get someone to fix the leak in the kitchen</li>
					<li class="">Property vacant for months at a time</li>
				</ul>
				<h3 class="p-3">Give us a call and we can help you out with getting up and running or managing your property for you</h3>
				<a class="btn btn-primary d-block d-sm-inline mx-auto" href="{{ route('contact_us') }} " style="color: #ebf1fb;">Contact Us</a>
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
								<div class="text-center">
									<img class="img-fluid" src="{{ asset('storage/' . str_ireplace('public/', '', $setting->welcome_media)) }}" />
								</div>
							</div>
						@endif
						<div class="modal-body text-dark">
							<p class="">{{ $setting->welcome_content }}</p>
						</div>
						<div class="modal-footer">
							<button type="button" class="cancelBtn btn btn-warning text-center d-block d-sm-inline" data-dismiss="modal">Close</button>
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
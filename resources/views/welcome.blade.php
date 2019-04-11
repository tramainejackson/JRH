@extends('layouts.app')

@section('addt_style')
	<style type="text/css">
		/* Navigation*/
		.navbar {
		  background-color: transparent;
		}
		.scrolling-navbar {
		  transition: background .5s ease-in-out, padding .5s ease-in-out;
		}
		.top-nav-collapse {
		  background-color: #667490;
		}
		footer.page-footer {
		  background-color: #667490;
		}
		
		@media only screen and (max-width: 768px) {
		  .navbar {
			background-color: #667490;
		  }
		}

		/* Necessary for full page carousel*/
		html,
		body,
		.view {
		  height: 100%;
		}

		/* Carousel*/
		.carousel,
		.carousel-item,
		.carousel-item.active {
		  height: 100%;
		}
		.carousel-inner {
		  height: 100%;
		}
		.carousel-item:nth-child(1) {
		  background-image: url("/images/family-and-house1.jpg");
		  background-repeat: no-repeat;
		  background-size: cover;
		  background-position: center center;
		}
		
		@foreach($carouselImages as $carouselImage)
		.carousel-item:nth-child({{ $loop->iteration + 1 }}) {
			background-image: url("{{ asset('storage/images/' . trim($carouselImage)) }}");
			background-repeat: no-repeat;
			background-size: cover;
			background-position: center center;
		}
		@endforeach
  </style>
@endsection

@section('content')
	
	<div id="home_carousel" class="carousel slide carousel-fade" data-ride="carousel">
		<div class="carousel-inner" role="listbox">
			<div class="carousel-item active">
				<div class="view">
					<div class="full-bg-img flex-column flex-center mask rgba-indigo-light white-text">
						<div class="container">
							<h1>Experienced Professionals.</h1>
							<p>A leading real estate agent with over 15 years of experience, provides exciting choices for enhancing your quality of life. We are dedicated to quality and community commitment translate to your peace of mind</p>
							<!--- <p class="text-sm-center"><a class="btn btn-lg btn-primary d-block d-sm-inline" href="#" role="button">Sign up today</a></p> --->
						</div>
					</div>
				</div>
			</div>
			
			@foreach($carouselImages as $carouselImage)
			
				<div class="carousel-item">
					<div class="view">
						<div class="full-bg-img flex-column flex-center mask rgba-indigo-light white-text">
							<div class="container">
								@if($loop->first)
									<h1>We got what you need.</h1>
									<p>Jackson Rental Homes LLC is one of the only businesses in the Philadelphia responsible for rehabing houses and providing reasonable accommodations for people of all walks of life and financial stature.</p>
								@elseif($loop->iteration == 2)
									<h1>Cutting Edge Designs.</h1>
									<p>Jackson Rental Homes LLC offers a complete range of development and construction services, from the design phase through site work, to complex commercial and residential construction projects.</p>
								@elseif($loop->iteration == 3)
									<h1>A little something for everybody.</h1>
									<p>Jackson Rental Homes LLC offers a selection of homes for sale and rent for every lifestyle.</p>
								@elseif($loop->iteration == 4)
									<h1>A little something for everybody.</h1>
									<p>Jackson Rental Homes LLC offers a selection of homes for sale and rent for every lifestyle.</p>
								@endif
							</div>
						</div>
					</div>
				</div>
				
			@endforeach
			
		</div>
	</div>
	
	<div class="container">
		<!-- START THE FEATURETTES -->
		<div class="row align-items-center">
			<h1 class="col-2 col-md-4 text-hide" style="border:1px solid #787878 !important">Hidden Text</h1>
			<h1 class="col-8 col-md-4 text-muted text-center">Featured Properties</h1>
			<h1 class="col-2 col-md-4 text-hide" style="border:1px solid #787878 !important">Hidden Text</h1>
		</div>

		@if($showcase_properties->isNotEmpty())

			<div class="row">
				<p class="col-12 text-center">Here is a list of the new and featured properties. To see all the active properties, click go. <a href="{{ action('PropertyController@index') }}" class="btn btn-sm peach-gradient">Go</a></p>
			</div>

			@foreach($showcase_properties as $showcase)

				@php

					$defaultPic = $showcase->medias()->where('default_photo', 'Y')->first();

					if($showcase->medias()->first()) {

						if($defaultPic != null) {

							if(file_exists(str_ireplace('public', 'storage', $defaultPic->path))) {

								$image = str_ireplace('public', 'storage', $defaultPic->path);

							} else {

								$image = '/images/empty_prop_3.png';

							}

						} else {

							$image = $showcase->medias()->first();

							if(file_exists(str_ireplace('public', 'storage', $image->path))) {

								$image = str_ireplace('public/', 'storage/', asset($image->path));

							} else {

								$image = '/images/empty_prop_3.png';

							}
						}
					} else {

						$image = '/images/empty_prop_3.png';
					}

				@endphp

				<div class="row m-5 justify-content-center showcaseProps">
					<!-- Card Light -->
					<div class="card">

						<!-- Card image -->
						<div class="view overlay">
							<img class="card-img-top" src="{{ $image }}" alt="Property Image">
							<a>
								<div class="mask rgba-white-slight"></div>
							</a>
						</div>

						<!-- Card content -->
						<div class="card-body">

							<!-- Social shares button -->
							<a class="activator waves-effect waves-light mr-4"><i class="fas fa-share-alt"></i></a>

							<!-- Title -->
							<h2 class="text-center text-sm-left">{{ $showcase->title }}</h2>
							<h5 class="text-center text-sm-left">{{ $showcase->city }}&nbsp;{{ $showcase->state }},&nbsp;{{ $showcase->zip }}</h5>

							<hr>

							<!-- Text -->
							<p class="lead py-3 card-text">{{ $showcase->description }}</p>

							<!-- Link -->
							<a href="/properties/{{ $showcase->id }}/{{ Auth::check() ? 'edit' : '' }}" class="btn text-theme1 blue-gradient btn-lg float-right{{ $showcase->active == 'N' ? ' disabled' : '' }}" >View Details</a>

						</div>

					</div>
					<!-- Card Light -->
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
	<div class="container-fluid" style="{{ (Auth::guest()) ? 'margin-bottom:-3em;' : 'margin-bottom:-3em;' }}">
	
		<div class="row align-items-center mt-5 mb-0 py-3" id="addt_service_transition">
			<div class="d-sm-none addt_service_transition_mobile_bgrd"></div>
			
			<h1 class="col text-white p-sm-4 p-0 mx-4 rounded display-5 display-sm-4 text-center" style="background: rgba(0, 0, 0, 0.5);">Having Trouble Managing Your Properties??</h1>
			
		</div>
		
		<div class="row">
			<div class="col py-5 bg-dark text-center" style="color: #ebf1fb;">
				<h2 class="p-2">Does this sound familiar?</h2>
				<ul id="addt_service_list" class="mx-auto pl-5 pr-1 p-sm-3 text-left" style="">
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

@endsection
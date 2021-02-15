@extends('layouts.app')

@section('addt_style')
	<style type="text/css">

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
		  background-image: url("/images/philadelphia1.png");
		  background-repeat: no-repeat;
		  background-size: cover;
		  background-position: center center;
		}

		.carousel-item:nth-child(2) {
			background-image: url("/images/philadelphia2.png");
			background-repeat: no-repeat;
			background-size: cover;
			background-position: center center;
		}
  </style>
@endsection

@section('content')

	<div id="home_carousel" class="carousel slide carousel-fade" data-ride="carousel">
		<div class="carousel-inner" role="listbox">
			<div class="carousel-item active">
				<div class="view">
					<div class="full-bg-img flex-column flex-center mask rgba-indigo-light white-text">
						<div class="container">
							<div class="card p-4 rgba-light-blue-strong" id="">
								<h1>Experienced Professionals.</h1>
								<p>A leading real estate agent with over 15 years of experience, provides exciting choices for enhancing your quality of life. We are dedicated to quality and community commitment translate to your peace of mind</p>
							</div>
						</div>
					</div>
				</div>
			</div>
			
			<div class="carousel-item">
				<div class="view">
					<div class="full-bg-img flex-column flex-center mask rgba-deep-orange-slight white-text">
						<div class="container">
							<div class="card p-4 rgba-stylish-strong" id="">
								<h1>We got what you need.</h1>
								<p>Jackson Rental Homes LLC is one of the only businesses in the Philadelphia responsible for rehabing houses and providing reasonable accommodations for people of all walks of life and financial stature.</p>
							</div>
						</div>
					</div>
				</div>
			</div>

			{{--<div class="carousel-item">--}}
				{{--<div class="view">--}}
					{{--<div class="full-bg-img flex-column flex-center mask rgba-indigo-light white-text">--}}
						{{--<div class="container">--}}
							{{--<div class="d-none" id="">--}}
								{{--<h1>Cutting Edge Designs.</h1>--}}
								{{--<p>Jackson Rental Homes LLC offers a complete range of development and construction services, from the design phase through site work, to complex commercial and residential construction projects.</p>--}}
							{{--</div>--}}
						{{--</div>--}}
					{{--</div>--}}
				{{--</div>--}}
			{{--</div>--}}
			{{----}}
			{{--<div class="carousel-item">--}}
				{{--<div class="view">--}}
					{{--<div class="full-bg-img flex-column flex-center mask rgba-indigo-light white-text">--}}
						{{--<div class="container">--}}
							{{--<div class="d-none" id="">--}}
								{{--<h1>A little something for everybody.</h1>--}}
								{{--<p>Jackson Rental Homes LLC offers a selection of homes for sale and rent for every lifestyle.</p>--}}
							{{--</div>--}}
						{{--</div>--}}
					{{--</div>--}}
				{{--</div>--}}
			{{--</div>--}}
		</div>
	</div>
	
	<div class="container">
		<!-- START THE FEATURETTES -->
		<div class="row align-items-center">

			<img class="col" src="{{ asset('images/divider-image-left.png') }}" alt="left divider" style="max-width: 33.3%;">

			<h1 class="col text-muted text-center h1 h1-responsive">Featured <span class="d-none d-md-inline">Properties</span></h1>

			<img class="col" src="{{ asset('images/divider-image-right.png') }}" alt="right divider" style="max-width: 33.3%;">
		</div>

		@if($showcase_properties->isNotEmpty())

			<div class="row">
				<p class="col-12 text-center mt-4">
					<span class="d-block">Here is a list of the new and featured properties. To see all the active properties, click go.</span>
					<a href="{{ action('PropertyController@index') }}" class="btn btn-lg peach-gradient">Go</a></p>
			</div>

			<div class="row row-cols-1 m-5 justify-content-center showcaseProps">

				@foreach($showcase_properties as $showcase)

					@php

						$defaultPic = $showcase->medias()->where('default_photo', 'Y')->first();

						if($showcase->medias()->first()) {

							if($defaultPic != null) {

								if(file_exists(str_ireplace('public', 'storage', $defaultPic->path))) {

									$image = str_ireplace('public/images', 'storage/images/sm', $defaultPic->path);

								} else {

									$image = '/images/empty_prop.png';

								}

							} else {

								$image = $showcase->medias()->first();

								if(file_exists(str_ireplace('public', 'storage', $image->path))) {

									$image = str_ireplace('public/images', 'storage/images/sm', asset($image->path));

								} else {

									$image = '/images/empty_prop.png';

								}
							}
						} else {

							$image = '/images/empty_prop.png';
						}

					@endphp

					<div class="col-12 col-md-8 col-lg-8 my-4" id="">
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

								<!-- Rent/Sale button -->
								<a class="white-text btn-rounded btn-sm teal float-right">{{ $showcase->sale == "sale" ? 'S' : 'R' }}</a>

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
						<div class="text-center my-5" id="" style="max-height: 50px;">
							<img src="{{ asset('images/divider-image.png') }}" alt="full divider" style="width: 100%;height: 100%;">
						</div>
					@endif

				@endforeach
			</div>
			
		@else
			
			<div class="row mt-4">
				<h2 class="col">No Featured Properties Added Yet</h2>
			</div>
			
		@endif

	</div>

	<!-- Additional Services Div -->
	<div class="view jarallax" style="height: 100vh;">

		<img class="jarallax-img" src="{{ asset('images/tools1.png') }}" alt="">

		<div class="mask rgba-mdb-color-strong">

			<div class="container flex-center text-center">

				<div class="row mt-5">

					<div class="col-md-12 wow fadeIn mb-3">
						<h1 class="p-2 white-text">Looking to do some remodeling?</h1>

						<h3 class="p-3 white-text">As a licensed contractor, I do top to bottom renovations. If you're looking to upgrades parts of the home, select the more info button below.</h3>

						<a class="btn btn-primary btn-lg d-block d-sm-inline mx-auto" href="#">More Info&nbsp;&nbsp;<i class="fas fa-info-circle"></i></a>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
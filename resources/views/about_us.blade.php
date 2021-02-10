@extends('layouts.app')

@section('content')
	<div id="" class="jumbotron jumbotron-fluid py-5 d-flex align-items-center aboutUsJumbotron">
		<div class="container-fluid py-5">
			<h2 class="py-5 text-white display-4 wow animated slideInLeft text-center" data-wow-delay="0.6s">Growth and development of our communities are the core of our pursuit.</h2>
		</div>
	</div>

	<div class="container">

		<div class="row align-items-center">
			<img class="col" src="{{ asset('images/divider-image-left.png') }}" alt="left divider" style="max-width: 33.3%;">

			<h1 class="col h1 h1-responsive text-muted text-center">Our Mission</h1>

			<img class="col" src="{{ asset('images/divider-image-right.png') }}" alt="right divider"  style="max-width: 33.3%;">

		</div>

		<div class="row">
			<div class="col-11 col-md-12 mx-auto mt-4">
				<p class="aboutUsBlurb"><i>{{ $settings->mission }}</i></p>
			</div>
		</div>

		<div class="row align-items-center">
			<h1 class="col text-hide my-3" style="border:1px solid #787878 !important">Hidden Text</h1>
		</div>
	</div>
@endsection
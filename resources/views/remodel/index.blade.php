<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Favicon -->
	<link rel="shortcut icon" href="/favicon_jrh.ico" type="image/x-icon">
	<link rel="icon" href="/favicon_jrh.ico" type="image/x-icon">

	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<title>Jackson Rental Homes / Remodeling</title>

	<!-- Styles -->
	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
	<!-- Bootstrap core CSS -->
	<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
	<!-- Material Design Bootstrap -->
	<link href="{{ asset('css/mdb.min.css') }}" rel="stylesheet">
	<link href="{{ asset('css/mycss.css') }}" rel="stylesheet">

	@if(substr_count(request()->server('HTTP_USER_AGENT'), 'rv:') > 0)
		<link href="{{ asset('/css/myIEcss.css') }}" rel="stylesheet">
	@endif

	<style type="text/css">
		/* Required for full background image */

		html,
		body,
		header,
		#intro-section {
			height: 100%;
		}

		@media (max-width: 740px) {
			html,
			body,
			header,
			#intro-section {
				height: 100vh;
			}
		}

		.top-nav-collapse {
			background-color: #563e91 !important;
		}

		.navbar:not(.top-nav-collapse) {
			background: transparent !important;
		}

		@media (max-width: 991px) {
			.navbar:not(.top-nav-collapse) {
				background: #563e91 !important;
			}
		}

		.rgba-gradient {
			background: -moz-linear-gradient(45deg, rgba(213, 15, 61, 0.6), rgba(13, 17, 198, 0.69) 100%);
			background: -webkit-linear-gradient(45deg, rgba(213, 15, 61, 0.6), rgba(13, 17, 198, 0.69) 100%);
			background: linear-gradient(45deg, rgba(213, 15, 61, 0.6), rgba(13, 17, 198, 0.69) 100%);
		}
	</style>

</head>

<body class="" id="app">

	<!-- Loading spinner to be added when form being submitted -->
	@include('modals.loading_spinner')

	<!-- Main navigation -->
	<header>

		<!-- Full Page Intro -->
		<div id="intro-section" class="view">
			<video class="video-intro" poster="https://mdbootstrap.com/img/Photos/Others/background.jpg" playsinline autoplay muted loop>
				<source src="/videos/remodel3.mp4" type="video/mp4">
			</video>
			<!-- Mask & flexbox options-->
			<div class="mask rgba-gradient d-flex justify-content-center align-items-center">
				<!-- Content -->
				<div class="container px-md-3 px-sm-0">
					<!--Grid row-->
					<div class="row wow fadeIn">
						<!--Grid column-->
						<div class="col-md-12 mb-4 white-text text-center wow fadeIn">
							<h3 class="display-3 font-weight-bold white-text mb-0 pt-md-5 pt-5">Remodeling</h3>
							<hr class="hr-light my-4 w-75">
							<h4 class="subtext-header mt-2 mb-4">By Jackson Rental Homes</h4>
							<a href="#!" class="btn btn-rounded btn-outline-white">
								<i class="fa fa-home"></i> Visit us
							</a>
						</div>
						<!--Grid column-->
					</div>
					<!--Grid row-->
				</div>
				<!-- Content -->
			</div>
			<!-- Mask & flexbox options-->
		</div>
		<!-- Full Page Intro -->
	</header>
	<!-- Main navigation -->

	<!--Main Layout-->
	<main>
		<div class="container">
			<!--Grid row-->
			<div class="row py-5">
				<!--Grid column-->
				<div class="col-md-12 text-center">
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
				</div>
				<!--Grid column-->
			</div>
			<!--Grid row-->
		</div>
	</main>
	<!--Main Layout-->

	@if (Auth::guest() && route('login') != url()->current())
		<!-- Footer -->
		<footer class="pt-5">
			<div class="container pt-5">
				<div class="row d-flex justify-content-around align-items-stretch mb-0">
					<div class="col">
						<h2 class="text-text-lg-left" style=""><u>Add To Our Contacts</u></h2>
						<h4 class="text-justify text-lg-left mb-4" style="">If you would like to be conacted when we have new rentals that fits you, please fill out the following information and we will reach out to you</h4>

						{!! Form::open([ 'action' => 'ContactController@store', 'class' => 'add_contact_form']) !!}

						<div class="form-row">
							<div class="form-group col-6">
								{{ Form::label('form_first_name', 'First Name', ['class' => '']) }}
								{{ Form::text('first_name', '', ['id' => 'form_first_name', 'class' => 'form-control']) }}

								@if ($errors->has('first_name'))
									<span class="text-danger">First Name cannot be empty</span>
								@endif
							</div>

							<div class="form-group col-6">
								{{ Form::label('last_name', 'Last Name', ['class' => 'form-control-label']) }}
								{{ Form::text('last_name', '', ['class' => 'form-control']) }}

								@if ($errors->has('last_name'))
									<span class="text-danger">Last Name cannot be empty</span>
								@endif
							</div>
						</div>

						<div class="form-group">
							{{ Form::label('email', 'Email Address', ['class' => 'form-control-label']) }}
							<input type="email" name="email" class="form-control" value="{{ old('email') }}" />
							@if ($errors->has('email'))
								<span class="text-danger">Email Address Cannot Be Empty</span>
							@endif
						</div>

						<div class="form-group">
							{{ Form::label('phone', 'Phone', ['class' => 'form-control-label']) }}
							<input type="text" name="phone" class="form-control" value="{{ old('phone') }}" max="10" />
							@if ($errors->has('phone'))
								<span class="text-danger">Phone Number Cannot Be Empty. Please add without spaces</span>
							@endif
						</div>

						<div class="form-group">
							{{ Form::label('family_size', 'Family Size', ['class' => 'form-control-label']) }}
							<input type="number" name="family_size" class="form-control" value="{{ old('family_size') }}" min='1' />
						</div>

						<div class="form-group">
							{!! Form::submit('Add Me', ['name' => 'submit', 'class' => 'form-control blue darken-3 white-text']) !!}

							<input type="text" name="non_modal" class="form-control" value="Y" max="10" hidden />
						</div>
						{!! Form::close() !!}
					</div>
					<div class="col-12 d-block d-lg-none my-3">
						<h1 class="">AND</h1>
					</div>
					<div class="col p-lg-0 py-4" id="instagram_us">
						<div class="d-flex align-content-center flex-wrap h-100">
							<h4 class="text-center d-block w-100" style="">Instagram With Us</h4>

							<div class="py-4 w-100">
								<img src="/images/jr.jpg" class="img-fluid mx-auto d-block instagramPhoto" />
							</div>

							<div class="w-100">
								<h5 class="text-center"><a href="https://www.instagram.com/jacksonrentalhomes/">#JacksonRentalHomes</a></h5>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="container-fluid registerNCopyright bg-theme2">
				<div class="row mb-0">
					<div class="col">
						<h5 class="text-center text-theme1 m-0 p-4" style="">&copy;&nbsp; & &reg;&nbsp; by Tramaine</h5
					</div>
				</div>
			</div>
		</footer>
	@else
		@if(!route('login'))
			<footer class="pt-5">
				<div class="container-fluid registerNCopyright bg-theme2">
					<div class="row mb-0">
						<div class="col">
							<h5 class="text-center text-theme1 my-3 m-lg-0 p-4" style="">&copy;&nbsp; & &reg;&nbsp; by Tramaine</h5
						</div>
					</div>
				</div>
			</footer>
		@endif
	@endif

	<!-- SCRIPTS -->
	<!-- JQuery -->
	<script type="text/javascript" src={{ asset('/js/jquery-3.4.1.min.js') }}></script>
	<!-- Bootstrap tooltips -->
	<script type="text/javascript" src={{ asset('/js/popper.min.js') }}></script>
	<!-- Bootstrap core JavaScript -->
	<script type="text/javascript" src={{ asset('/js/bootstrap.min.js') }}></script>
	<!-- MDB core JavaScript -->
	<script type="text/javascript" src={{ asset('/js/mdb.min.js') }}></script>
	<script type="text/javascript" src={{ asset('/js/myjs.js') }}></script>

</body>
</html>
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
    <link href="{{ asset('/css/mycss.css') }}" rel="stylesheet">

	<style type="text/css">
		/* Required for full background image */

		html,
		body,
		header,
		.view {
			height: 100%;
		}

		@media (max-width: 740px) {
			html,
			body,
			header,
			.view {
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
			background: linear-gradient(to 45deg, rgba(213, 15, 61, 0.6), rgba(13, 17, 198, 0.69) 100%);
		}
	</style>

	@yield('addt_style')

</head>
<body class="" id="app">

	<!-- Loading spinner to be added when form being submitted -->
	@include('modals.loading_spinner')

	<header>
		<!-- Navbar -->
		<nav class="navbar navbar-expand-lg fixed-top scrolling-navbar">
			<div class="container">
				<a class="navbar-brand" href="#">Navbar</a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarTogglerDemo02">
					<ul class="navbar-nav mr-auto smooth-scroll">
						<li class="nav-item">
							<a class="nav-link white-text" href="{{ route('remodeling_services') }}" data-offset="90">Services</a>
						</li>
					</ul>
					<!-- Social Icon  -->
					<ul class="navbar-nav nav-flex-icons">
						<li class="nav-item">
							<a class="nav-link white-text">
								<i class="fab fa-facebook-f light-green-text-2"></i>
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link white-text">
								<i class="fab fa-twitter light-green-text-2"></i>
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link white-text">
								<i class="fab fa-instagram light-green-text-2"></i>
							</a>
						</li>
					</ul>
				</div>
			</div>
		</nav>
		<!-- Navbar -->
	</header>

	@yield('content')

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
	<script type="text/javascript" src="/js/jquery-3.4.1.min.js"></script>
	<!-- Bootstrap tooltips -->
	<script type="text/javascript" src="/js/popper.min.js"></script>
	<!-- Bootstrap core JavaScript -->
	<script type="text/javascript" src="/js/bootstrap.min.js"></script>
	<!-- MDB core JavaScript -->
	<script type="text/javascript" src="/js/mdb.min.js"></script>
	<script type="text/javascript" src="/js/myjs.js"></script>
	
	@yield('addt_script')
</body>
</html>

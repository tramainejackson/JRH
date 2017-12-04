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

    <title>Jackson Rental Homes</title>

    <!-- Styles -->
	<!--Import Google Icon Font-->
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link href="/css/open-iconic/font/css/open-iconic-bootstrap.css" rel="stylesheet">
	@yield('addt_style')
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
    <link href="/css/mycss.css" rel="stylesheet">
	
	<!-- Scripts -->
	<script type="text/javascript" src="{{ asset('/js/app.js') }}"></script>
	<script type="text/javascript" src="/js/myjs.js"></script>
	
	@yield('custom_style')
</head>
<body class="bg-theme1">
    <div class="container-fluid d-none d-sm-block">
		<div class="row mb-0">
			<div class="col p-0">
				<nav class="nav navbar-expand-sm">
					<!-- Branding Image -->
					<a class="navbar-brand text-hide justify-content-start" href="{{ url('/') }}">Homes</a>

					<div class="collapse navbar-collapse justify-content-end" id="navbarToggleExternalContent">
						<ul class="navbar-nav">
							<!-- Authentication Links -->

							@if (Auth::guest())
								<li class="nav-item text-dark"><a href="/properties" class="nav-link text-dark{{ substr_count(url()->current(),'propert') > 0 ? ' activeNav': '' }}">Properties</a></li>
								<!--- <li class="nav-item"><a href="/contacts" class="nav-link">Construction</a></li> --->
								<li class="nav-item"><a href="{{ route('about_us') }}" class="nav-link text-dark{{ substr_count(url()->current(),'about') > 0 ? ' activeNav': '' }}">About Us</a></li>
								<li class="nav-item"><a href="{{ route('contact_us') }}" class="nav-link text-dark{{ substr_count(url()->current(),'contact') > 0 ? ' activeNav': '' }}">Contact Us</a></li>
								<li class="nav-item"><a href="{{ route('login') }}" class="nav-link text-dark{{ substr_count(url()->current(),'login') > 0 ? ' activeNav': '' }}">Login</a></li>
							@else
								<li class="nav-item"><a href="/admin_files" class="nav-link text-dark{{ substr_count(url()->current(),'file') > 0 ? ' activeNav': '' }}">Files</a></li>
								<li class="nav-item"><a href="/properties" class="nav-link text-dark{{ substr_count(url()->current(),'propert') > 0 ? ' activeNav': '' }}">Properties</a></li>
								<li class="nav-item"><a href="/contacts" class="nav-link text-dark{{ substr_count(url()->current(),'contact') > 0 ? ' activeNav': '' }}">Contacts</a></li>
								<li class="nav-item"><a href="/settings/1/edit" class="nav-link text-dark{{ substr_count(url()->current(),'setting') > 0 ? ' activeNav': '' }}">Settings</a></li>
								<li class="nav-item dropdown">
									<a href="#" class="nav-link text-dark dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
										{{ Auth::user()->name }} <span class="caret"></span>
									</a>

									<ul class="dropdown-menu" role="menu">
										<li class="dropdown-item">
											<a class="text-dark" href="{{ route('logout') }}"
												onclick="event.preventDefault();
														 document.getElementById('logout-form').submit();">
												Logout
											</a>

											<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
												{{ csrf_field() }}
											</form>
										</li>
									</ul>
								</li>
							@endif
						</ul>
					</div>
				</nav>
			</div>
		</div>
    </div>
	<nav class="d-sm-none navbar navbar-light bg-light justify-content-start">
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample03" aria-controls="navbarsExample03" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<img class="navbar-brand" src="/images/jrh_logo_lg.png" />

		<div class="collapse navbar-collapse" id="navbarsExample03">
			<ul class="list-unstyled text-center">
				@if (Auth::guest())
					<li class="nav-item text-dark"><a href="/" class="nav-link{{ substr_count(url()->current(),'welcome') > 0 ? ' activeNav': '' }}">Home</a></li>
					<li class="nav-item text-dark"><a href="/properties" class="nav-link{{ substr_count(url()->current(),'propert') > 0 ? ' activeNav': '' }}">Properties</a></li>
					<!--- <li class="nav-item"><a href="/contacts" class="nav-link">Construction</a></li> --->
					<li class="nav-item"><a href="{{ route('about_us') }}" class="nav-link{{ substr_count(url()->current(),'about') > 0 ? ' activeNav': '' }}">About Us</a></li>
					<li class="nav-item"><a href="{{ route('contact_us') }}" class="nav-link{{ substr_count(url()->current(),'contact') > 0 ? ' activeNav': '' }}">Contact Us</a></li>
					<li class="nav-item"><a href="{{ route('login') }}" class="nav-link{{ substr_count(url()->current(),'login') > 0 ? ' activeNav': '' }}">Login</a></li>
				@else
					<li class="nav-item"><a href="/admin_files" class="nav-link{{ substr_count(url()->current(),'file') > 0 ? ' activeNav': '' }}">Files</a></li>
					<li class="nav-item"><a href="/properties" class="nav-link{{ substr_count(url()->current(),'propert') > 0 ? ' activeNav': '' }}">Properties</a></li>
					<li class="nav-item"><a href="/contacts" class="nav-link{{ substr_count(url()->current(),'contact') > 0 ? ' activeNav': '' }}">Contacts</a></li>
					<li class="nav-item"><a href="/settings/1/edit" class="nav-link{{ substr_count(url()->current(),'setting') > 0 ? ' activeNav': '' }}">Settings</a></li>
					<li class="nav-item dropdown">
						<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
							{{ Auth::user()->name }} <span class="caret"></span>
						</a>

						<ul class="dropdown-menu" role="menu">
							<li class="dropdown-item">
								<a class="text-dark" href="{{ route('logout') }}"
									onclick="event.preventDefault();
											 document.getElementById('logout-form').submit();">
									Logout
								</a>

								<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
									{{ csrf_field() }}
								</form>
							</li>
						</ul>
					</li>
				@endif
			</ul>
		</div>
	</nav>
	@yield('content')
</div>
	@if (Auth::guest() && route('login') != url()->current())
		<!-- Footer -->
		<footer class="pt-5 bg-theme1">
			<div class="container pt-5">
				<div class="row d-flex justify-content-around align-items-stretch mb-0">
					<div class="col p-sm-0 py-4" id="instagram_us">
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
			<div id="social_div" class="pt-5 mb-2">
				<h2>Follow Me Socially</h2>
				<div class="d-flex align-items-stretch justify-content-center">
					<a style="background-image:url(/images/twitter_icon.png); color:transparent;" onclick="newSmallWindow('https://twitter.com/');" class="">Text</a>
					<a style="background-image:url(/images/instagram_icon.png); color:transparent;" onclick="newSmallWindow('https://instagram.com/jacksonrentalhomes/');" class="">Text</a>
					<a style="background-image:url(/images/facebook_icon.png); color:transparent;" onclick="newSmallWindow('https://www.facebook.com/');" class="">Text</a>
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
		<footer class="{{ route('login') != url()->current() ? 'pt-5 ' : '' }}bg-theme1">
			<div class="container-fluid registerNCopyright bg-theme2">
				<div class="row mb-0">
					<div class="col">
						<h5 class="text-center text-theme1 my-3 m-sm-0 p-4" style="">&copy;&nbsp; & &reg;&nbsp; by Tramaine</h5
					</div>
				</div>
			</div>
		</footer>		
	@endif
</body>
</html>

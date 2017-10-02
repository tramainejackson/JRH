<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

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
	<script type="text/javascript" src="{{ asset('/js/materialize.js') }}"></script>
	<script type="text/javascript" src="/js/myjs.js"></script>
</head>
<body class="bg-theme1">
    <div class="container-fluid d-none d-sm-block">				
		<nav class="nav navbar-expand-sm">
			<!-- Branding Image -->
			<a class="navbar-brand text-hide justify-content-start" href="{{ url('/') }}">Homes</a>

			<div class="collapse navbar-collapse justify-content-end" id="navbarToggleExternalContent">
				<ul class="navbar-nav">
					<!-- Authentication Links -->

					@if (Auth::guest())
						<li class="nav-item text-dark"><a href="/properties" class="nav-link text-dark">Properties</a></li>
						<!--- <li class="nav-item"><a href="/contacts" class="nav-link">Construction</a></li> --->
						<li class="nav-item"><a href="{{ route('about_us') }}" class="nav-link text-dark">About Us</a></li>
						<li class="nav-item"><a href="{{ route('contact_us') }}" class="nav-link text-dark">Contact Us</a></li>
						<li class="nav-item"><a href="{{ route('login') }}" class="nav-link text-dark">Login</a></li>
					@else
						<li class="nav-item"><a href="/properties" class="nav-link text-dark">Properties</a></li>
						<li class="nav-item"><a href="/contacts" class="nav-link text-dark">Contacts</a></li>
						<li class="nav-item"><a href="/settings/1/edit" class="nav-link text-dark">Settings</a></li>
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
	<nav class="bg-theme2 d-sm-none">
		<div class="nav-wrapper">
			<a href="{{ url('/') }}" class="brand-logo">Logo</a>
			<a href="#" data-activates="mobile_nav" class="button-collapse"><i class="material-icons">menu</i></a>
			<ul class="side-nav" id="mobile_nav">
				@if (Auth::guest())
						<li class="nav-item text-dark"><a href="/properties" class="nav-link text-dark">Properties</a></li>
						<!--- <li class="nav-item"><a href="/contacts" class="nav-link">Construction</a></li> --->
						<li class="nav-item"><a href="{{ route('about_us') }}" class="nav-link text-dark">About Us</a></li>
						<li class="nav-item"><a href="{{ route('contact_us') }}" class="nav-link text-dark">Contact Us</a></li>
						<li class="nav-item"><a href="{{ route('login') }}" class="nav-link text-dark">Login</a></li>
					@else
						<li class="nav-item"><a href="/properties" class="nav-link text-dark">Properties</a></li>
						<li class="nav-item"><a href="/contacts" class="nav-link text-dark">Contacts</a></li>
						<li class="nav-item"><a href="/settings/1/edit" class="nav-link text-dark">Settings</a></li>
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
	@yield('content')
</div>
	@if (Auth::guest())
		<!-- Footer -->
		<footer class="pt-5 bg-theme1">
			<div class="container pt-5">
				<div class="row d-flex align-items-stretch mb-0">
					<div class="col">
						<h4 class="text-center" style="">Leave a Message</h4>

						{!! Form::open([ 'action' => 'ContactController@store', 'class' => '']) !!}
							<div class="form-group">
								<label for="name" class="">Full Name</label>
								<input id="first" class="form-control" type="text" name="name">
							</div>
							<div class="form-group">
								<label for="email" class="">Email Address</label>
								<input id="last" class="form-control" type="email" name="email">
							</div>
							<div class="form-group">
								<label for="message" class="">Message</label>
								<textarea id="message" class="form-control" name="message"></textarea>
							</div>
							<div class="form-group">
								{!! Form::submit('Send Message', ['name' => 'submit', 'class' => 'form-control']) !!}
							</div>
						{!! Form::close() !!}
					</div>
					<div class="col-12 d-block d-sm-none my-3">
						<h1 class="">AND</h1>
					</div>
					<div class="col p-sm-0 py-4" id="instagram_us">
						<h4 class="text-center" style="">Instagram With Us</h4>

						<div class="py-4">
							<img src="/images/jr.jpg" class="img-fluid mx-auto d-block instagramPhoto" />
						</div>

						<div class="">
							<h5 class="text-center"><a href="https://www.instagram.com/jacksonrentalhomes/">#JacksonRentalHomes</a></h5>
						</div>
					</div>
				</div>
			</div>
			<div id="social_div" class="py-5">
				<h2>Follow Me Socially</h2>
				<div class="section">
					<a style="background-image:url(/images/twitter_icon.png)" onclick="newSmallWindow('https://twitter.com/');" class="text-hide">Text</a>
					<a style="background-image:url(/images/instagram_icon.png)" onclick="newSmallWindow('https://instagram.com/jacksonrentalhomes/');" class="text-hide">Text</a>
					<a style="background-image:url(/images/facebook_icon.png)" onclick="newSmallWindow('https://www.facebook.com/');" class="text-hide">Text</a>
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
		<footer class="pt-5 bg-theme1">
			<div class="container-fluid registerNCopyright bg-theme2">
				<div class="row mb-0">
					<div class="col">
						<h5 class="text-center text-theme1 m-0 p-4" style="">&copy;&nbsp; & &reg;&nbsp; by Tramaine</h5
					</div>
				</div>
			</div>
		</footer>		
	@endif
</body>
</html>

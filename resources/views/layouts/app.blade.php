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
	<!--Import materialize.css-->
	<!-- <link type="text/css" rel="stylesheet" href="css/materialize.css"  media="screen,projection"/> -->
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
    <link href="/css/mycss.css" rel="stylesheet">
	
	<style></style>
</head>
<body class="bg-theme1">
    <div class="container-fluid">
		<nav class="nav navbar-expand-lg">
			<!-- Branding Image -->
			<a class="navbar-brand justify-content-start" href="{{ url('/') }}">Homes</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse justify-content-end" id="navbarToggleExternalContent">
				<ul class="navbar-nav">
					<!-- Authentication Links -->
					@if (Auth::guest())
						<li class="nav-item"><a href="{{ route('login') }}" class="nav-link">Login</a></li>
						<li class="nav-item"><a href="{{ route('about_us') }}" class="nav-link">About Us</a></li>
						<li class="nav-item"><a href="/properties" class="nav-link">Properties</a></li>
						<li class="nav-item"><a href="/contacts" class="nav-link">Construction</a></li>
						<li class="nav-item"><a href="{{ route('contact_us') }}" class="nav-link">Contact Us</a></li>
					@else
						<li class="nav-item"><a href="/properties" class="nav-link">Properties</a></li>
						<li class="nav-item"><a href="/contacts" class="nav-link">Contacts</a></li>
						<li class="nav-item"><a href="/settings" class="nav-link">Settings</a></li>
						<li class="nav-item dropdown">
							<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
								{{ Auth::user()->name }} <span class="caret"></span>
							</a>

							<ul class="dropdown-menu" role="menu">
								<li class="dropdown-item">
									<a href="{{ route('logout') }}"
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
	<div class="container-fluid">
        @yield('content')
	</div>

	@if (Auth::guest())
		<!-- Footer -->
		<footer class="py-3 bg-theme1">
			<div class="container-fluid">
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
					<div class="col" id="instagram_us">
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
			<div class="container-fluid registerNCopyright">
				<div class="row">
					<div class="col">
						<h5 class="text-center m-0 p-4" style="">&copy;&nbsp; & &reg;&nbsp; by Tramaine</h5
					</div>
				</div>
			</div>
		</footer>
	@endif

    <!-- Scripts -->
	<script src="{{ asset('/js/app.js') }}"></script>
	<!-- <script type="text/javascript" src="js/materialize.js"></script> -->
	<script type="text/javascript" src="/js/myjs.js"></script>
</body>
</html>

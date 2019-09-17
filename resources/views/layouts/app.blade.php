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
	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
	<!-- Bootstrap core CSS -->
	<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
	<!-- Material Design Bootstrap -->
	<link href="{{ asset('css/mdb.min.css') }}" rel="stylesheet">
	<link href="{{ asset('/css/mycss.css') }}" rel="stylesheet">
	@if(substr_count(request()->server('HTTP_USER_AGENT'), 'rv:') > 0)
		<link href="{{ asset('/css/myIEcss.css') }}" rel="stylesheet">
	@endif

	@yield('addt_style')

</head>
<body class="" id="app">

<!-- Loading spinner to be added when form being submitted -->
@include('modals.loading_spinner')

<!-- Modal which will show when page loads if settings are Yes -->
@include('modals.welcome_modal')

<div class="container-fluid d-none d-lg-block">
	<div class="row mb-0">
		<div class="col p-0">
			<nav class="nav navbar-expand-lg scrolling-navbar fixed-top">
				<!-- Branding Image -->
				<a class="navbar-brand text-hide justify-content-start" href="{{ url('/') }}">Homes</a>

				<div class="collapse navbar-collapse justify-content-end" id="navbarToggleExternalContent">
					<ul class="navbar-nav mr-auto">
						<!-- Authentication Links -->

						@if (Auth::guest())
							<li class="nav-item dropdown text-dark{{ substr_count(url()->current(),'propert') > 0 ? ' activeNav': '' }}{{ substr_count(url()->current(),'calendar') > 0 ? ' activeNav': '' }}">
								<a id="property_dropdown" class="nav-link text-dark dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Properties</a>
								<div class="dropdown-menu dropdown-primary" aria-labelledby="property_dropdown">
									<a class="dropdown-item{{ substr_count(url()->current(),'propert') > 0 ? ' activeNav': '' }}" href="/properties">View Properties</a>
									<a class="dropdown-item{{ substr_count(url()->current(),'calendar') > 0 ? ' activeNav': '' }}" href="/calendar">Showings Calendar</a>
								</div>
							</li>
							<li class="nav-item"><a href="{{ route('about_us') }}" class="nav-link text-dark{{ substr_count(url()->current(),'about') > 0 ? ' activeNav': '' }}">About Us</a></li>
							<li class="nav-item"><a href="{{ route('contact_us') }}" class="nav-link text-dark{{ substr_count(url()->current(),'contact') > 0 ? ' activeNav': '' }}">Contact Us</a></li>
							<li class="nav-item"><a href="{{ route('login') }}" class="nav-link text-dark{{ substr_count(url()->current(),'login') > 0 ? ' activeNav': '' }}">Login</a></li>
						@else
							<li class="nav-item"><a href="/admin_files" class="nav-link text-dark{{ substr_count(url()->current(),'file') > 0 ? ' activeNav': '' }}">Files</a></li>
							<li class="nav-item"><a href="/properties" class="nav-link text-dark{{ substr_count(url()->current(),'propert') > 0 ? ' activeNav': '' }}">Properties</a></li>
							<li class="nav-item"><a href="/calendar" class="nav-link text-dark{{ substr_count(url()->current(),'calendar') > 0 ? ' activeNav': '' }}">Calendar</a></li>
							<li class="nav-item dropdown">
								<a id="property_dropdown" class="nav-link text-dark dropdown-toggle{{ substr_count(url()->current(),'contacts') > 0 ? ' activeNav': '' }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Contacts</a>
								<div class="dropdown-menu dropdown-primary" aria-labelledby="property_dropdown">
									<a href="/contacts" class="nav-link dropdown-item text-dark{{ ends_with(url()->current(),'contacts') > 0 ? ' activeNav': '' }}">View Contacts</a>
									<a href="/contacts_duplicated" class="nav-link dropdown-item text-dark{{ ends_with(url()->current(),'contacts_duplicated') > 0 ? ' activeNav': '' }}">Duplicate Contacts</a>
								</div>
							</li>

							<li class="nav-item"><a href="/services" class="nav-link text-dark{{ substr_count(url()->current(),'services') > 0 ? ' activeNav': '' }}">Services</a></li>
							<li class="nav-item"><a href="/settings/1/edit" class="nav-link text-dark{{ substr_count(url()->current(),'setting') > 0 ? ' activeNav': '' }}">Settings</a></li>
							<li class="nav-item"><a href="#" class="nav-link text-dark">{{ Auth::user()->name }}</a></li>
							<li class="nav-item">
								<a class="nav-link text-dark" href="{{ route('logout') }}"
								   onclick="event.preventDefault();
												 document.getElementById('logout-form').submit();">
									Logout
								</a>

								<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
									{{ csrf_field() }}
								</form>
							</li>
						@endif
					</ul>
					<ul class="navbar-nav nav-flex-icons">
						<li class="nav-item" data-toggle="tooltip" data-placement="left" title="No Twitter Account Yet">
							<a href="https://twitter.com/" class="nav-link disabled"><img src="/images/twitter_icon.png" class="" height="30px" width="30px" /></a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="https://instagram.com/jacksonrentalhomes/" target="_blank"><img src="/images/instagram_icon.png" class="" height="30px" width="30px" /></a>
						</li>
						<li class="nav-item">
							<a href="https://www.facebook.com/JacksonRentalHomes/" class="nav-link" target="_blank"><img src="/images/facebook_icon.png" class="" height="30px" width="30px" /></a>
						</li>
					</ul>
				</div>
			</nav>
		</div>
	</div>
</div>

<nav class="d-lg-none navbar navbar-light bg-light justify-content-start">
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample03" aria-controls="navbarsExample03" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>
	<img class="navbar-brand" src="/images/jrh_logo_lg.png" />

	<div class="collapse navbar-collapse" id="navbarsExample03">
		<ul class="list-unstyled text-center">
			@if (Auth::guest())
				<li class="nav-item text-dark"><a href="/" class="nav-link{{ substr_count(url()->current(),'welcome') > 0 ? ' activeNav': '' }}">Home</a></li>
				<li class="nav-item text-dark"><a href="/properties" class="nav-link{{ substr_count(url()->current(),'propert') > 0 ? ' activeNav': '' }}">Properties</a></li>
				<li class="nav-item text-dark"><a href="/calendar" class="nav-link{{ substr_count(url()->current(),'calendar') > 0 ? ' activeNav': '' }}">Calendar</a></li>
				<li class="nav-item"><a href="{{ route('about_us') }}" class="nav-link{{ substr_count(url()->current(),'about') > 0 ? ' activeNav': '' }}">About Us</a></li>
				<li class="nav-item"><a href="{{ route('contact_us') }}" class="nav-link{{ substr_count(url()->current(),'contact') > 0 ? ' activeNav': '' }}">Contact Us</a></li>
				<li class="nav-item"><a href="{{ route('login') }}" class="nav-link{{ substr_count(url()->current(),'login') > 0 ? ' activeNav': '' }}">Login</a></li>
			@else
				<li class="nav-item text-dark"><a href="/" class="nav-link{{ substr_count(url()->current(),'welcome') > 0 ? ' activeNav': '' }}">Home</a></li>
				<li class="nav-item"><a href="/admin_files" class="nav-link{{ substr_count(url()->current(),'file') > 0 ? ' activeNav': '' }}">Files</a></li>
				<li class="nav-item"><a href="/properties" class="nav-link{{ substr_count(url()->current(),'propert') > 0 ? ' activeNav': '' }}">Properties</a></li>
				<li class="nav-item"><a href="/calendar" class="nav-link{{ substr_count(url()->current(),'calendar') > 0 ? ' activeNav': '' }}">Calendar</a></li>
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

@if($settings->show_welcome == "Y" && !request()->hasPreviousSession())
	<script type="text/javascript">
        var winHeight = window.innerHeight;
        var screenHeight = screen.availHeight;

        // If modal has video, make its max-height 60% of
        // the available screen height
        if($('#welcome_modal video')) {
            $('#welcome_modal video').css({'maxHeight':(screenHeight * .6) + 'px'})
        }

        // Show welcome modal
        $('#welcome_modal').modal('show');
	</script>
@endif

@yield('addt_script')

<!-- Start of HubSpot Embed Code -->
<script type="text/javascript" id="hs-script-loader" async defer src="//js.hs-scripts.com/6257377.js"></script>
<!-- End of HubSpot Embed Code -->
</body>
</html>

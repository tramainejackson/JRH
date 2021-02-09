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
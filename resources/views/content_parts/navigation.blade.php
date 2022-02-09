<!--Double navigation-->
<header>
	<!-- Sidebar navigation -->
	<div id="slide-out" class="side-nav sn-bg-4">
		<ul class="custom-scrollbar">
			<!-- Logo -->
			<li>
				<div class="logo-wrapper waves-light">
					<a href="{{ url('/') }}">
						<img src="{{ asset('images/jrh_logo_white.png') }}" class="img-fluid flex-center" style="padding: 15px 5px;">
					</a>
				</div>
			</li>
			<!--/. Logo -->

			<!-- Side navigation links -->
			<li>
				<ul class="collapsible collapsible-accordion">

					@if (Auth::guest())

						<li class="">
							<a href="{{ route('welcome') }}" class=""><i class="fas fa-home"></i>Home</a>
						</li>
{{--						<li class="">--}}
{{--							<a href="#" class="" onclick="event.preventDefault(); toastr.warning('Coming Soon!')"><i class="fas fa-shopping-cart"></i>Shop</a>--}}
{{--						</li>--}}
{{--						<li class="">--}}
{{--							<a href="#" class="" onclick="event.preventDefault(); toastr.warning('Coming Soon!')"><i class="fas fa-blog"></i>Blog</a>--}}
{{--						</li>--}}
						<li class="">
							<a href="https://app.tenantturner.com/listings/jacksonrentalhomes" class="{{ substr_count(url()->current(),'propert') > 0 ? ' activeNav': '' }}"><i class="fas fa-home"></i>Properties</a>
						</li>
{{--						<li>--}}
{{--							<a class="collapsible-header waves-effect arrow-r"><i class="fas fa-chevron-right"></i>Properties<i class="fas fa-angle-down rotate-icon"></i></a>--}}

{{--							<div class="collapsible-body">--}}
{{--								<ul>--}}
{{--									<li>--}}
{{--										<a class="{{ substr_count(url()->current(),'propert') > 0 ? ' activeNav': '' }}" href="/properties">View Properties</a>--}}
{{--									</li>--}}
{{--									<li>--}}
{{--										<a class="{{ substr_count(url()->current(),'calendar') > 0 ? ' activeNav': '' }}" href="/calendar">Showings Calendar</a>--}}
{{--									</li>--}}
{{--								</ul>--}}
{{--							</div>--}}
{{--						</li>--}}
						<li class="">
							<a href="{{ route('about_us') }}" class="{{ substr_count(url()->current(),'about') > 0 ? ' activeNav': '' }}"><i class="fab fa-buromobelexperte"></i>About Us</a>
						</li>
						<li class="">
							<a href="{{ route('contact_us') }}" class="{{ substr_count(url()->current(),'contact') > 0 ? ' activeNav': '' }}"><i class="fas fa-question"></i>Contact Us</a>
						</li>
						<li class="">
							<a href="{{ route('login') }}" class="{{ substr_count(url()->current(),'login') > 0 ? ' activeNav': '' }}"><i class="fas fa-sign-in-alt"></i>Login</a>
						</li>

					@else

						<li>
							<a class="collapsible-header waves-effect arrow-r"><i class="fas fa-chevron-right"></i>Contacts<i class="fas fa-angle-down rotate-icon"></i></a>

							<div class="collapsible-body">
								<ul>
									<li>
										<a href="/contacts" class="{{ ends_with(url()->current(),'contacts') > 0 ? ' activeNav': '' }}">View Contacts</a>
									</li>
									<li>
										<a href="/contacts_duplicated" class="{{ ends_with(url()->current(),'contacts_duplicated') > 0 ? ' activeNav': '' }}">Duplicate Contacts</a>
									</li>
								</ul>
							</div>
						</li>
{{--						<li class="">--}}
{{--							<a href="/blogs" class="{{ substr_count(url()->current(),'blog') > 0 ? ' activeNav': '' }}"><i class="far fa-file"></i>Blogs</a>--}}
{{--						</li>--}}
						<li class="">
							<a href="https://app.tenantturner.com/listings/jacksonrentalhomes" class="{{ substr_count(url()->current(),'propert') > 0 ? ' activeNav': '' }}"><i class="fas fa-home"></i>Properties</a>
						</li>
{{--						<li class="">--}}
{{--							<a href="/calendar" class="{{ substr_count(url()->current(),'calendar') > 0 ? ' activeNav': '' }}"><i class="far fa-calendar-alt"></i>Calendar</a>--}}
{{--						</li>--}}
						<li class="">
							<a href="/services" class="{{ substr_count(url()->current(),'services') > 0 ? ' activeNav': '' }}"><i class="fas fa-tools"></i>Services</a>
						</li>
						<li class="">
							<a href="/settings/1/edit" class="{{ substr_count(url()->current(),'setting') > 0 ? ' activeNav': '' }}"><i class="fas fa-cog"></i>Settings</a>
						</li>
						<li class="">
							<a href="#" class="disabled"><i class="fas fa-user"></i>{{ Auth::user()->name }}</a>
						</li>
						<li class="">
							<a class="" href="{{ route('logout') }}"
							   onclick="event.preventDefault(); document.getElementById('logout-form2').submit();"><i class="fas fa-sign-out-alt"></i>Logout
							</a>

							<form id="logout-form2" action="{{ route('logout') }}" method="POST" style="display: none;">
								{{ csrf_field() }}
							</form>
						</li>

					@endif
				</ul>
			</li>
			<!--/. Side navigation links -->
		</ul>

		<div class="sidenav-bg mask-strong"></div>
	</div>
	<!--/. Sidebar navigation -->

	<!-- Navbar -->
	<nav class="navbar fixed-top navbar-expand-lg scrolling-navbar double-nav">

		<!-- SideNav slide-out button -->
		<div class="float-left d-lg-none">
			<a href="#" data-activates="slide-out" class="button-collapse"><i class="fas fa-bars"></i></a>
		</div>

		<!-- Branding Image -->
		<a class="navbar-brand mr-auto d-none d-lg-flex" href="{{ url('/') }}">
			<img src="{{ asset('images/jrh_logo_white.png') }}" height="30" alt="jrh logo">
		</a>

		<ul class="nav navbar-nav nav-flex-icons ml-auto d-none d-lg-flex">

			<!-- Authentication Links -->
			@if (Auth::guest())
{{--				<li class="nav-item dropdown{{ substr_count(url()->current(),'propert') > 0 ? ' activeNav': '' }}{{ substr_count(url()->current(),'calendar') > 0 ? ' activeNav': '' }}">--}}
{{--					<a id="property_dropdown" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Properties</a>--}}
{{--					<div class="dropdown-menu dropdown-primary" aria-labelledby="property_dropdown">--}}
{{--						<a class="dropdown-item{{ substr_count(url()->current(),'propert') > 0 ? ' activeNav': '' }}" href="/properties">View Properties</a>--}}
{{--						<a class="dropdown-item{{ substr_count(url()->current(),'calendar') > 0 ? ' activeNav': '' }}" href="/calendar">Showings Calendar</a>--}}
{{--					</div>--}}
{{--				</li>--}}
				<li class="nav-item"><a href="https://app.tenantturner.com/listings/jacksonrentalhomes" class="nav-link{{ substr_count(url()->current(),'propert') > 0 ? ' activeNav': '' }}">Properties</a></li>
{{--				<li class="nav-item"><a href="#" class="nav-link" onclick="event.preventDefault(); toastr.warning('Coming Soon!')">Shop</a></li>--}}
{{--				<li class="nav-item"><a href="#" class="nav-link" onclick="event.preventDefault(); toastr.warning('Coming Soon!')">Blog</a></li>--}}
				<li class="nav-item"><a href="{{ route('about_us') }}" class="nav-link{{ substr_count(url()->current(),'about') > 0 ? ' activeNav': '' }}">About Us</a></li>
				<li class="nav-item"><a href="{{ route('contact_us') }}" class="nav-link{{ substr_count(url()->current(),'contact') > 0 ? ' activeNav': '' }}">Contact Us</a></li>
				<li class="nav-item"><a href="{{ route('login') }}" class="nav-link{{ substr_count(url()->current(),'login') > 0 ? ' activeNav': '' }}">Login</a></li>
			@else
				<li class="nav-item"><a href="/blogs" class="nav-link{{ substr_count(url()->current(),'blog') > 0 ? ' activeNav': '' }}">Blogs</a></li>
				<li class="nav-item"><a href="https://app.tenantturner.com/listings/jacksonrentalhomes" class="nav-link{{ substr_count(url()->current(),'propert') > 0 ? ' activeNav': '' }}">Properties</a></li>
{{--				<li class="nav-item"><a href="/calendar" class="nav-link{{ substr_count(url()->current(),'calendar') > 0 ? ' activeNav': '' }}">Calendar</a></li>--}}
				<li class="nav-item dropdown">
					<a id="property_dropdown" class="nav-link dropdown-toggle{{ substr_count(url()->current(),'contacts') > 0 ? ' activeNav': '' }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Contacts</a>
					<div class="dropdown-menu dropdown-primary" aria-labelledby="property_dropdown">
						<a href="/contacts" class="nav-link dropdown-item{{ ends_with(url()->current(),'contacts') > 0 ? ' activeNav': '' }}">View Contacts</a>
						<a href="/contacts_duplicated" class="nav-link dropdown-item{{ ends_with(url()->current(),'contacts_duplicated') > 0 ? ' activeNav': '' }}">Duplicate Contacts</a>
					</div>
				</li>

				<li class="nav-item"><a href="/services" class="nav-link{{ substr_count(url()->current(),'services') > 0 ? ' activeNav': '' }}">Services</a></li>
				<li class="nav-item"><a href="/settings/1/edit" class="nav-link{{ substr_count(url()->current(),'setting') > 0 ? ' activeNav': '' }}">Settings</a></li>
				<li class="nav-item"><a href="#" class="nav-link">{{ Auth::user()->name }}</a></li>
				<li class="nav-item">
					<a class="nav-link" href="{{ route('logout') }}"
					   onclick="event.preventDefault(); document.getElementById('logout-form1').submit();">Logout
					</a>

					<form id="logout-form1" action="{{ route('logout') }}" method="POST" style="display: none;">
						{{ csrf_field() }}
					</form>
				</li>
			@endif
		</ul>

		<ul class="navbar-nav nav-flex-icons list-unstyled">
			<li class="nav-item">
				<a class="nav-link" href="https://instagram.com/jacksonrentalhomes/" target="_blank">
					<img src="/images/instagram_icon.png" class="" height="30px" width="30px" />
				</a>
			</li>
			<li class="nav-item">
				<a href="https://www.facebook.com/JacksonRentalHomes/" class="nav-link" target="_blank">
					<img src="/images/facebook_icon.png" class="" height="30px" width="30px" />
				</a>
			</li>
		</ul>
	</nav>
	<!-- /.Navbar -->
</header>
<!--/.Double navigation-->
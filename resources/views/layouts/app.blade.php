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

		<!-- Navigation -->
		@include('content_parts.navigation')

		<!-- Page Content -->
		@yield('content')

		<!-- Footer -->
		@include('content_parts.footer')

		<!-- SCRIPTS -->
		<!-- JQuery -->
		<script type="text/javascript" src="/js/jquery.min.js"></script>
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

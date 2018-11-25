<!DOCTYPE html>
<html xmlns:v="urn:schemas-microsoft-com:vml"><head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;">
	<meta name="viewport" content="width=600,initial-scale = 2.3,user-scalable=no">
	<!--[if !mso]><!-- -->
	<link href="https://fonts.googleapis.com/css?family=Work+Sans:300,400,500,600,700" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Quicksand:300,400,700" rel="stylesheet">
	<!-- <![endif]-->

	<title>Jackson Rental Homes Contact</title>

	<style type="text/css">
		body {
			width: 100%;
			background-color: #ffffff;
			margin: 0;
			padding: 0;
			-webkit-font-smoothing: antialiased;
			mso-margin-top-alt: 0px;
			mso-margin-bottom-alt: 0px;
			mso-padding-alt: 0px 0px 0px 0px;
		}

		a {
			-webkit-box-shadow: 0 2px 5px 0 rgba(0,0,0,.16), 0 2px 10px 0 rgba(0,0,0,.12);
			box-shadow: 0 2px 5px 0 rgba(0,0,0,.16), 0 2px 10px 0 rgba(0,0,0,.12);
			padding: .84rem 2.14rem;
			font-size: .81rem;
			-webkit-transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,-webkit-box-shadow .15s ease-in-out;
			-o-transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;
			transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;
			transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out,-webkit-box-shadow .15s ease-in-out;
			margin: .375rem;
			border: 0;
			-webkit-border-radius: .125rem;
			border-radius: .125rem;
			cursor: pointer;
			text-transform: uppercase;
			white-space: normal;
			color: #fff;
			background-color: #0e3d67;
			text-decoration: none;
		}

		p,
		h1,
		h2,
		h3,
		h4 {
			margin-top: 0;
			margin-bottom: 0;
			padding-top: 0;
			padding-bottom: 0;
		}

		span.preheader {
			display: none;
			font-size: 1px;
		}

		html {
			width: 100%;
		}

		table {
			font-size: 14px;
			border: 0;
		}
		/* ----------- responsivity ----------- */

		@media only screen and (max-width: 640px) {
			/*------ top header ------ */
			.main-header {
				font-size: 20px !important;
			}
			.main-section-header {
				font-size: 28px !important;
			}
			.show {
				display: block !important;
			}
			.hide {
				display: none !important;
			}
			.align-center {
				text-align: center !important;
			}
			.no-bg {
				background: none !important;
			}
			/*----- main image -------*/
			.main-image img {
				width: 440px !important;
				height: auto !important;
			}
			/* ====== divider ====== */
			.divider img {
				width: 440px !important;
			}
			/*-------- container --------*/
			.container590 {
				width: 440px !important;
			}
			.container580 {
				width: 400px !important;
			}
			.main-button {
				width: 220px !important;
			}
			/*-------- secions ----------*/
			.section-img img {
				width: 320px !important;
				height: auto !important;
			}
			.team-img img {
				width: 100% !important;
				height: auto !important;
			}
		}

		@media only screen and (max-width: 479px) {
			/*------ top header ------ */
			.main-header {
				font-size: 18px !important;
			}
			.main-section-header {
				font-size: 26px !important;
			}
			/* ====== divider ====== */
			.divider img {
				width: 280px !important;
			}
			/*-------- container --------*/
			.container590 {
				width: 280px !important;
			}
			.container590 {
				width: 280px !important;
			}
			.container580 {
				width: 260px !important;
			}
			/*-------- sections ----------*/
			.section-img img {
				width: 280px !important;
				height: auto !important;
			}
		}
	</style>
	<!-- [if gte mso 9]><style type=”text/css”>
		body {
			font-family: arial, sans-serif!important;
		}
	</style>
	<![endif]-->
</head>
<body>
    <div id="app" style="">
		<div class="container590" style="height:100%; margin: 0% 20%;">
		
			<div class="main-image" style="box-sizing: border-box; width: 100% !important;">
				<img src="{{ url('/images/jrh_logo.png') }}" class="" height="250px" style="margin:0 auto; text-align: center; display: block;" />
			</div>
			
			<div class="main-header" style="font-family: 'Playfair Display', serif;">
			
				<h3 style="margin: 0px 35px 35px;"><b>Upcoming Showing</b></h3>
				<h3 style="margin: 0px 35px 35px;"><b>Date:</b> {{ $showingDate[0]->show_date->format('l F jS, Y') }}</h3>

				<div style="margin: 0% 5%; text-align: center;">
					@foreach($showingDate as $showing)

						<div style="padding-bottom: 50px; border: solid 1px darkgray; margin: 20px;">
							<div class="section-img" id="">
								<img src="{{ asset(str_ireplace('public', 'storage', $showing->property->medias()->default()->first()->path)) }}" />
							</div>

							<p style="margin: 30px 10px;">{{ $showing->show_time->format('h:i A') }}</p>

							<p style="margin: 30px 10px;">{{ $showing->show_instructions }}</p>

							<a href="{{ route('properties.show', ['id' => $showing->property->id]) }}">View Details</a>
						</div>

					@endforeach
				</div>
				
				<p style="padding: 0px 35px 15px;">See you soon, <br/><br/>Have a nice day</p>
			</div>

		</div>

		<footer style="box-sizing: border-box; width: 100% !important;">
			<h3 style="border-bottom:1px solid gray; text-align: center; background: #5b955a; color: whitesmoke; padding: 35px;">2017 {{ config('app.name') }}. All rights reserved.</h3>
		</footer>
	</div>
</body>

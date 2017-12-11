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
	<link href="https://fonts.googleapis.com/css?family=Aclonica|Bangers|Fredericka+the+Great|Kurale|Monoton|Spirax" rel="stylesheet">
	
	<!--[if IE]>
		<link href="/css/myIEcss.css" rel="stylesheet">
	<![endif]-->

	<!-- Scripts -->
	<script type="text/javascript" src="{{ asset('/js/app.js') }}"></script>
	<script type="text/javascript" src="/js/myjs.js"></script>
	
	@yield('custom_style')
</head>
<body>
	<style>
		body {
			background: linear-gradient(rgba(0, 0, 0, 0), rgb(0, 0, 0)), url(/images/nightClub.png);
			color: orange;
		}
		
		.font2 {
			font-family: 'Bangers', cursive;
			font-size: 400%;
			letter-spacing: 10px;
		}
		
		.font3 {
			font-size: 200%;
			letter-spacing: 10px;
			font-family: 'Kurale', serif;
		}
		
		.font4 {
			font-family: 'Monoton', cursive;
			color: red;
			font-size: 155%;
		}
		
		.font5 {
			font-size: 115%;
			font-family: 'Kurale', serif;
		}
		
		.party {
			transform: rotate(-3deg); 
			margin: -10px 0px 0px;
			color: red;
			font-size: 470%;
			text-shadow: 0 0 10px white;
		}
		
		.date {
			margin-bottom: 0px;
			background: linear-gradient(to right, #ff000040, red, #ff000040); 
			color: white;transform: rotate(-3deg);
			font-family: 'Fredericka the Great', cursive;
			font-size: 350%;
		}
		
		.money {
			font-family: 'Spirax', cursive;
			top:5px; 
			left:10px;
			position: absolute;
			font-size: 175%;
		}
		
		.address {
			background: -webkit-linear-gradient(bottom, rgba(0, 0, 0, 0), white 45%);
			background: linear-gradient(bottom, rgba(0, 0, 0, 0), white 45%);
			-webkit-background-clip: text;
			-webkit-text-fill-color: transparent;
		}
	</style>
	<div class="container">
		<div class="">
			<h2 class="text-center mt-1 mb-0">Men of Maplewood</h2>
			<h2 class="text-center mt-0">Presents</h2>
		</div>
		<span class="money">$25</span>
		<span class="money" style="left:initial; right:10px !important;">$25</span>
		<h2 class="py-3 date" style="">February 24, 2018</h2>
		<div class="d-flex flex-column">
			<h2 class="text-center text-white display-2" style="letter-spacing: 10px; text-shadow: 0 0 20px white;   text-transform: uppercase; font-weight: 700;transform: rotate(-3deg); margin: -10px 0px 0px;">Bowling</h2>
			<h3 class="text-right party" style="">Party</h3>
		</div>
		<div class="d-table" style="background-image: url('/images/bowlingBgrd.png');padding:250px;background-position: center center;background-repeat: no-repeat;background-size: contain; margin: -165px -10px 0px;"></div>
		<div class="d-flex flex-column" style="margin-top: -110px;">
			<div class="d-flex justify-content-between align-items-center">
				<div class="">
					<span class="font2">V&S</span>
				</div>
				<div class="">
					<span class="font3">Eat & Drink</span>
				</div>
			</div>
			<div class="d-flex justify-content-between align-items-center" style="margin-top: -40px;">
				<div class="">
					<span class="font2">Elmwood</span>
				</div>
				<div class="">
					<div class="" style="margin: -35px 0px 0px 0px;">
						<span class="font3" style="margin: 0px 85px 0px 0px; letter-spacing: 3px;">& Bowl</span>
					</div>
				</div>
			</div>
			<div class="d-flex justify-content-between align-items-center" style="margin-top: -40px;">
				<div class="">
					<span class="font2">Lanes</span>
				</div>
				<div class="d-flex flex-column" style="margin-top: 20px;">
					<h3 class="font4">Doors Open @ 8:30PM</h3>
					<h3 class="font4">Game Starts 9PM</h3>
				</div>
			</div>
		</div>
		<div class="">
			<h2 class="">50/50 Raffle Tickets</h2>
		</div>
		<div class="d-flex align-items-center align-items-stretch justify-content-between font5">
			<div class="d-flex align-items-center justify-content-center mx-auto">
				<span>For Tickets Contact</span>
			</div>
			<div class="mx-auto" style="border-right:double 3px; margin:10px 0px 5px;">&nbsp;</div>
			<div class="d-flex flex-column align-items-center justify-content-center mx-auto">
				<span>Skinner 267-353-0270</span>
				<span>Damion 267-240-1822</span>
				<span>Skinner 267-257-4337</span>
			</div>
		</div>
		<div class="address">
			<h3 class="text-white fixed-bottom address">7235 Elmwood Ave, Philly PA 19142</h3>
		</div>
	</div>
</body>
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Jackson Rental Homes Contact</title>
	
	<style>
		div#app {
			width: 80%;
			margin: 0 auto;
		}
		
		h3 {
			
		}
		
		p {
			
		}

		.btn {
			padding: 1rem;
			margin: .375rem auto;
			border-radius: .125rem;
			cursor: pointer;
			text-transform: uppercase;
			white-space: normal;
			word-wrap: break-word;
			display: inline-block;
			font-weight: 400;
			text-align: center;
			vertical-align: middle;
			-webkit-user-select: none;
			-moz-user-select: none;
			-ms-user-select: none;
			user-select: none;
			border: 1px solid transparent;
			font-size: 1rem;
			border-radius: .25rem;
			-webkit-transition: all .2s ease-in-out;
			transition: all .2s ease-in-out;
			transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;
			box-shadow: 0 2px 5px 0 rgba(0,0,0,.16), 0 2px 10px 0 rgba(0,0,0,.12);
			background-color: green;
			color: whitesmoke;
			text-decoration: none;
		}
		
		@media (min-width: 1400px) {
            p, h3 {
                font-size: 150%;
            }
        }
	</style>
</head>
<body>
    <div id="app" class="container">
		<div style="position:relative; height:100%;">
			<div style="box-sizing: border-box; width: 100% !important;">
				<img src="{{ url('/images/jrh_logo.png') }}" class="" height="250px" style="margin:0 auto; text-align: center; display: block;" />
			</div>
			<div>
				<h3 style=""><b><u>Property:</u> {{ $contact->property->address }}</b></h3>
				
				<h3 style=""><b><u>Tenant:</u>  {{ $contact->first_name . ' ' . $contact->last_name }}</b></h3>
				
				<p style="">This email to remind you that rent is due the first day of every month. If you use the Cash App, you can pay electronically by selecting the button below.</p>
				
				<a href="https://cash.me/$Jacksonrentalhomes/{{ $amount }}" class="btn">Pay With Cash App</a>
				
				<p class="">{{ $body }}</p>
				
				<p>Please feel free to reach out to me at any time if you have any questions. I can be reached by phone at <span style="color: blue;"><i>215.252.4146</i></span> or by email at <a href="mailto:lorenzo@jacksonrentalhomesllc.com" class=""><i>lorenzo@jacksonrentalhomesllc.com</i>.</a></p>
				
				<p style="">Thanks you, <br/><br/>Have a nice day</p>
			</div>
		</div>
	</div>
	<footer style="box-sizing: border-box; width: 100% !important;">
		<h3 style="border-bottom:1px solid gray; text-align: center; background: #5b955a; color: whitesmoke; padding: 35px;">2017 {{ config('app.name') }}. All rights reserved.</h3>
	</footer>
</body>
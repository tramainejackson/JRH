@php use Carbon\Carbon; @endphp
@extends('layouts.app')

@section('addt_style')
	<style>
	* {box-sizing: border-box;}
		ul {list-style-type: none;}
		body {font-family: Verdana, sans-serif;}

		.month {
			padding: 70px 25px;
			width: 100%;
			background: #1abc9c;
			text-align: center;
		}

		.month ul {
			margin: 0;
			padding: 0;
		}

		.month ul li {
			color: white;
			font-size: 20px;
			text-transform: uppercase;
			letter-spacing: 3px;
		}

		.month .prev {
			float: left;
			padding-top: 10px;
		}

		.month .next {
			float: right;
			padding-top: 10px;
		}

		.weekdays {
			margin: 0;
			padding: 10px 0;
			background-color: #ddd;
		}

		.weekdays li {
			display: inline-block;
			width: 13.6%;
			color: #666;
			text-align: center;
		}

		.days {
			padding: 10px 0;
			background: #eee;
			margin: 0;
		}

		.days li {
			list-style-type: none;
			display: inline-block;
			width: 13.6%;
			text-align: center;
			margin-bottom: 5px;
			font-size:12px;
			color: #777;
		}

		.days li span {
			padding: 5px;
		}
		
		.days li.monthDay:hover span {
			cursor: pointer;
		}
		
		.days li.active span {
			background: linear-gradient(40deg, transparent, #1ABC9B, transparent);
			color: white !important;
		}
		
		.days li.active.propShowings span {
			background: linear-gradient(40deg, #ffc107, #1ABC9B, #ffc107);
			color: white !important;
		}
		
		.days li.propShowings span {
			background: linear-gradient(40deg, #ffc107, transparent, #ffc107);
			color: #777 !important;
		}
		
		.days li.monthDay:hover:not(.active) span {
			background: linear-gradient(120deg, transparent, blue, transparent);
			color: white !important;
		}
		
		.days li.monthDay.propShowings:hover:not(.active) span {
			background: linear-gradient(120deg, #ffc107, blue, #ffc107);
			color: white !important;
		}

		/* Add media queries for smaller screens */
		@media screen and (max-width:720px) {
			.weekdays li, .days li {width: 13.1%;}
		}

		@media screen and (max-width: 420px) {
			.weekdays li, .days li {width: 12.5%;}
			.days li .active {padding: 2px;}
		}

		@media screen and (max-width: 290px) {
			.weekdays li, .days li {width: 12.2%;}
		}
	</style>
@endsection

@section('addt_script')
	<script src="{{ public_path('js/vue.js') }}"></script>
	<script>$('.showingsCalendar div.calendarMonth').not('.activeMonth').hide();</script>
	<script>
		var app = new Vue({
			el: '#test',
			data: {
			    message: 'Hello Vue!'
			}
		});
	</script>
@endsection

@section('content')
	@php $calendar = DB::table('calendar_month')->get(); @endphp
	@php $showings = DB::table('property_showings')->pluck('show_date'); @endphp
	@php //$showTime = new Carbon($showings->show_date . $showings->show_time); @endphp
	@php $showings = $showings->toArray(); @endphp

	<div  id="content_container" class="container-fluid">

		<div class="row">
			<div class="col-md-12">

				<div id="mdb-lightbox-ui"></div>

				<div class="mdb-lightbox">

					<figure class="col-md-4">
						<a href="https://mdbootstrap.com/img/Photos/Lightbox/Original/img%20(145).jpg" data-size="1600x1067">
							<img src="https://mdbootstrap.com/img/Photos/Lightbox/Thumbnail/img%20(145).jpg" class="img-fluid">
						</a>
					</figure>

					<figure class="col-md-4">
						<a href="https://mdbootstrap.com/img/Photos/Lightbox/Original/img%20(150).jpg" data-size="1600x1067">
							<img src="https://mdbootstrap.com/img/Photos/Lightbox/Thumbnail/img%20(150).jpg" class="img-fluid" />
						</a>
					</figure>

					<figure class="col-md-4">
						<a href="https://mdbootstrap.com/img/Photos/Lightbox/Original/img%20(152).jpg" data-size="1600x1067">
							<img src="https://mdbootstrap.com/img/Photos/Lightbox/Thumbnail/img%20(152).jpg" class="img-fluid" />
						</a>
					</figure>

					<figure class="col-md-4">
						<a href="https://mdbootstrap.com/img/Photos/Lightbox/Original/img%20(42).jpg" data-size="1600x1067">
							<img src="https://mdbootstrap.com/img/Photos/Lightbox/Thumbnail/img%20(42).jpg" class="img-fluid" />
						</a>
					</figure>

					<figure class="col-md-4">
						<a href="https://mdbootstrap.com/img/Photos/Lightbox/Original/img%20(151).jpg" data-size="1600x1067">
							<img src="https://mdbootstrap.com/img/Photos/Lightbox/Thumbnail/img%20(151).jpg" class="img-fluid" />
						</a>
					</figure>

					<figure class="col-md-4">
						<a href="https://mdbootstrap.com/img/Photos/Lightbox/Original/img%20(40).jpg" data-size="1600x1067">
							<img src="https://mdbootstrap.com/img/Photos/Lightbox/Thumbnail/img%20(40).jpg" class="img-fluid" />
						</a>
					</figure>

					<figure class="col-md-4">
						<a href="https://mdbootstrap.com/img/Photos/Lightbox/Original/img%20(148).jpg" data-size="1600x1067">
							<img src="https://mdbootstrap.com/img/Photos/Lightbox/Thumbnail/img%20(148).jpg" class="img-fluid" />
						</a>
					</figure>

					<figure class="col-md-4">
						<a href="https://mdbootstrap.com/img/Photos/Lightbox/Original/img%20(147).jpg" data-size="1600x1067">
							<img src="https://mdbootstrap.com/img/Photos/Lightbox/Thumbnail/img%20(147).jpg" class="img-fluid" />
						</a>
					</figure>

					<figure class="col-md-4">
						<a href="https://mdbootstrap.com/img/Photos/Lightbox/Original/img%20(149).jpg" data-size="1600x1067">
							<img src="https://mdbootstrap.com/img/Photos/Lightbox/Thumbnail/img%20(149).jpg" class="img-fluid" />
						</a>
					</figure>

				</div>

			</div>
		</div>
	</div>

@endsection
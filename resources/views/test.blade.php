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
	<script>$('.showingsCalendar div.calendarMonth').not('.activeMonth').hide();</script>
@endsection

@section('content')
	@php $calendar = DB::table('calendar_month')->get(); @endphp
	@php $showings = DB::table('property_showings')->pluck('show_date'); @endphp
	@php //$showTime = new Carbon($showings->show_date . $showings->show_time); @endphp
	@php $showings = $showings->toArray(); @endphp

	<div  id="content_container" class="container-fluid">
		<div class="showingsCalendar row">
			<div class="col">
				@foreach($calendar as $key => $month)
					@php
						$day = 1;
						$day_count = 1;
						$monthNum = $month->month_id < 10 ? '0' . $month->month_id : $month->month_id;
						$monthName = $month->month_name;
						$totalDays = $month->month_days;
						$year = Carbon::now()->year;
						$firstDay = Carbon::createFromDate($year, $month->month_id, $day);
						$getFirstDayofMonth = $firstDay->format('l');
						$getCurrentMonth = new Carbon();
						
						switch($getFirstDayofMonth) {
							case "Sunday": $blank = 0; break;
							case "Monday": $blank = 1; break;   
							case "Tuesday": $blank = 2; break;   
							case "Wednesday": $blank = 3; break;   
							case "Thursday": $blank = 4; break;   
							case "Friday": $blank = 5; break;   
							case "Saturday": $blank = 6; break;   
						}
					@endphp
					
					<div class="calendarMonth my-2{{ $monthName == $getCurrentMonth->format('F') ? ' activeMonth' : '' }}">
						<div class="month">
						  <ul>
							<li class="prev">&#10094;</li>
							<li class="next">&#10095;</li>
							<li class="">{{ $monthName }}<br>
							  <span style="font-size:18px">{{ $year }}</span>
							</li>
						  </ul>
						</div>

						<ul class="weekdays">
						  <li>Su</li>
						  <li>Mo</li>
						  <li>Tu</li>
						  <li>We</li>
						  <li>Th</li>
						  <li>Fr</li>
						  <li>Sa</li>
						</ul>
						
						<ul class="days">
						
							@while($blank > 0)
								<li></li>
								@php
									$blank = $blank-1;
									$day_count++;
								@endphp
							@endwhile
							
							@while($day <= $totalDays)
								@if($monthName == $getCurrentMonth->format('F'))
									@if($getCurrentMonth->day == $day)
										<li class="monthDay active{{ in_array($year.'-'.$monthNum.'-'.$day, $showings) ? ' propShowings' : '' }}"><span id="{{ $year.'-'.$monthNum.'-'.$day }}">{{ $day }}</span></li>
									@else
										<li class="monthDay{{ in_array($year.'-'.$monthNum.'-'.$day, $showings) ? ' propShowings' : '' }}"><span id="{{ $year.'-'.$monthNum.'-'.$day }}">{{ $day }}</span></li>
									@endif
								@else
									<li class="monthDay{{ in_array($year.'-'.$monthNum.'-'.$day, $showings) ? ' propShowings' : '' }}"><span id="{{ $year.'-'.$monthNum.'-'.$day }}">{{ $day }}</span></li>
								@endif
								
								@php
									$day++;   
									$day_count++;
								@endphp
							@endwhile
						</ul>
					</div>
				@endforeach
			</div>
		</div>
		
		<div class="row">
			<div class="col">
				<!-- Legend for calendar -->
				<div class="calendarLegend">
					<div class="my-1 mx-2 d-inline">
						<p class="d-inline-flex m-0"><span class="text-hide" style="height:20px; width:20px; background: #3ec4a9;">Bleu</span>&nbsp;<span>Today</span></p>
					</div>
					<div class="my-1 mx-2 d-inline">
						<p class="d-inline-flex m-0"><span class="text-hide" style="height:20px; width:20px; background: #ffc107;">Bleu</span>&nbsp;<span>Showings</span></p>
					</div>
				</div>
			</div>
		</div>
		
		<!-- Calendar showings information -->
		<div class="row showingsContent"></div>
		<!-- /Calendar showings information -->
	</div>
@endsection
@extends('layouts.app')

@section('addt_style')
	<style type="text/css">
		.navbar.fixed-top.navbar-expand-lg.scrolling-navbar.double-nav {
			background-color: #243a51 !important;
		}
	</style>
@endsection

@section('addt_script')
	<script>
        $('.showingsCalendar div.calendarMonth').not('.activeMonth').hide();

        // Remove disbled class from save button to allow post of new showing form
        $('body').on('change', '#new_showing_modal input, #new_showing_modal textarea, #new_showing_modal select', function() {
            if($('#new_showing_modal input#new_datetimepicker').val() != '' && $('#new_showing_modal input#new_timepicker').val() != '' && $('#new_showing_modal textarea#new_show_instructions').val() != '' && $('#new_showing_modal select#new_property_showing option:selected').val() != 'blank') {
                $('#new_showing_modal .saveNewShowing').removeClass('disabled');
            } else {
                $('#new_showing_modal .saveNewShowing').addClass('disabled');
            }

        });

	</script>
@endsection

@section('content')
	@php $formatDate = []; @endphp
	@php $calendar = DB::table('calendar_month')->get(); @endphp
	@php $showings = App\PropertyShowing::pluck('show_date'); @endphp

	@foreach($showings as $value)
		@php array_push($formatDate, $value->toDateString()); @endphp
	@endforeach

	@php $showings = $formatDate; @endphp

	<div id="" class="container-fluid mt-5 py-5">

		<div class="showingsCalendar row">

			<div class="col">

				@foreach($calendar as $key => $month)

					@php
						$day = 1;
						$day_count = 1;
						$monthNum = $month->month_id < 10 ? '0' . $month->month_id : $month->month_id;
						$monthName = $month->month_name;
						$totalDays = $month->month_days;
						$year = Carbon\Carbon::now()->year;
						$firstDay = Carbon\Carbon::createFromDate($year, $month->month_id, $day);
						$getFirstDayofMonth = $firstDay->format('l');
						$getCurrentMonth = new Carbon\Carbon();
						
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
							<ul class="list-unstyled">
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
								@php $monthDayNum = ''; @endphp

								@php
									if($day < 10) {
										$monthDayNum = '0' . $day;
									} else {
										$monthDayNum = $day;
									}
								@endphp

								@if($monthName == $getCurrentMonth->format('F'))
									@if($getCurrentMonth->day == $day)
										<li class="monthDay active{{ in_array($year.'-'.$monthNum.'-'.$monthDayNum, $showings) ? ' propShowings' : '' }}"><span id="{{ $year.'-'.$monthNum.'-'.$monthDayNum }}">{{ $day }}</span></li>
									@else
										<li class="monthDay{{ in_array($year.'-'.$monthNum.'-'.$monthDayNum, $showings) ? ' propShowings' : '' }}"><span id="{{ $year.'-'.$monthNum.'-'.$monthDayNum }}">{{ $day }}</span></li>
									@endif
								@else
									<li class="monthDay{{ in_array($year.'-'.$monthNum.'-'.$monthDayNum, $showings) ? ' propShowings' : '' }}"><span id="{{ $year.'-'.$monthNum.'-'.$monthDayNum }}">{{ $day }}</span></li>
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

		<!-- Legend for calendar -->
		<div class="row">
			<div class="col-auto">
				<div class="calendarLegend">
					<div class="my-1 mx-2 d-inline">
						<p class="d-inline-flex m-0"><span class="text-hide" style="height:20px; width:20px; background: #3ec4a9;">Blue</span>&nbsp;<span>Today</span></p>
					</div>
					<div class="my-1 mx-2 d-inline">
						<p class="d-inline-flex m-0"><span class="text-hide" style="height:20px; width:20px; background: #ffc107;">Yellow</span>&nbsp;<span>Showings</span></p>
					</div>
				</div>
			</div>

			@if(Auth::check())
				<div class="col" id="">
					<button class='btn blue-grey addNewShowing white-text' type='button' data-toggle="modal" data-target="#new_showing_modal">Add Showing</button>
				</div>
			@endif
		</div>

		<!-- Calendar showings information -->
		<div class="row showingsContent" id="showings_content">
			@if($todayShowings->isNotEmpty())
				<div class="col-12 mt-5 text-center">
					<h1 class="">Today {{ $showDate->format('F jS\\, Y') }}</h1>
				</div>

				@foreach($todayShowings as $showing)
					@php
						$defaultPhoto = $showing->property->medias()->where('default_photo', 'Y')->first() == null ? '/images/empty_prop.png' : str_ireplace('public/images', 'storage/images/lg', $showing->property->medias()->where('default_photo', 'Y')->first()->path);
						$time = "";
						$timeArray = explode(':', $showing->show_time->format('H:i:s'));

						if($timeArray[0] > 12) {
							$time = ($timeArray[0] - 12) . ':' . $timeArray[1] . ' PM';
						} elseif($timeArray[0] == '0') {
							$time = '12:' . $timeArray[1] . ' AM';
						} elseif($timeArray[0] == '12') {
							$time = '12:' . $timeArray[1] . ' PM';
						} else {
							$time = $timeArray[0] . ':' . $timeArray[1] . ' AM';
						}
					@endphp

					<div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 my-3 showingCard">

						<!--Card-->
						<div class="card card-cascade reverse wider">
							<!--Card Image-->
							<div class="view overlay">
								<img src="{{ asset($defaultPhoto) }}" class="img-fluid" />
								@if(Auth::check())
									<a href="/properties/{{ $showing->property->id }}/edit" class="">
										<div class="mask rgba-white-slight"></div>
									</a>
								@else
									<a href="/properties/{{ $showing->property->id }}" class="">
										<div class="mask rgba-white-slight"></div>
									</a>
								@endif
							</div>
							<!--/Card Image-->

							<!--/Card Content-->
							<div class="card-body">

								@if(Auth::check())

									<!--Card Title-->
									<h2 class="propShowingAddress">{{ $showing->property->address }}</h2>

									<!--Show Date-->
									<div class="md-form">
										<input type="text" name="show_date" id="show_date" data-value="{{ $showing->show_date }}" value="{{ $showing->show_date }}" class="form-control datetimepicker" />
										<label for="show_date" class="propShowingDate">Show Date: </label>
									</div>

									<!--Show Time-->
									<div class="md-form">
										<input type="text" name="show_time" id="show_time" value="{{ $time }}" class="form-control timepicker" />
										<label for="show_time" class="propShowingTime">Show Time: </label>
									</div>

									<!--Show Instructions-->
									@if($showing->property->requirements)
										<div class="">
											<h5 class=""><u>Property Requirements:</u></h5>
											<ol class="">
												@foreach($showing->property->requirements as $requirement)
													<li class="">{{ $requirement->instructions }}</li>
												@endforeach
											</ol>
										</div>
									@endif

									<!--Show Additional Info-->
									<div class="md-form">
										<textarea type="text" id="show_instruc" class="form-control md-textarea" rows="3">{{ $showing->show_instructions }}</textarea>
										<label for="textareaBasic" class="">Additional Information:</label>
									</div>

									<input type="text" id="update_showing" name="update_showing" class="btn btn-block m-0 my-2 primary-color-dark updateShowing" value="Update Showing" style="display:none;" />

									<button class="btn btn-block getRemoveShowing red darken-3 m-0 my-2 white-text" id="calendar_{{ $showing->id }}" type="button" data-toggle="modal" data-target="#delete_modal" onclick="event.preventDefault(); deleteModalUpdate(this);">Remove Showing</button>
								@else

									<!--Card Title-->
									<h2 class="">{{ $showing->property->address }}</h2>

									<!--Show Time-->
									<p class="">Showtime: {{ $time }}</p>

									<!--Show Instructions-->
									@if($showing->property->requirements)
										<div class="">
											<h5 class=""><u>Property Requirements:</u></h5>
											<ol class="">
												@foreach($showing->property->requirements as $requirement)
													<li class="">{{ $requirement->instructions }}</li>
												@endforeach
											</ol>
										</div>
									@endif

									<!--Show Additional Instructions -->
									<p class="">Additional Information: {!! nl2br($showing->show_instructions) !!}</p>
								@endif
							</div>
							<!--/Card Content-->
						</div>
						<!--/Card-->
					</div>
				@endforeach
			@else
				<div class="col-12 mt-5 text-center">
					<h2 class="">{{ $showDate->format('F jS\\, Y') }}</h2>
					<h3 class="">There are no showings today</h3>
				</div>
			@endif
		</div>
		<!-- /Calendar showings information -->
	</div>

	@include('modals.new_showing')

	@component('modals.delete', ['title' => 'Delete Showing'])
		Are you sure you want to delete this showing?
	@endcomponent
@endsection
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
	<script>
		$('.showingsCalendar div.calendarMonth').not('.activeMonth').hide();
		$('.datetimepicker').pickadate({
			onStart: function() {
				$(this).next().addClass('active');
			},
			format: 'mm/dd/yyyy',
			formatSubmit: 'yyyy/mm/dd',
		});

		$('body').on('click', '.selectAllContact, .selectIndContact', function() {
		    if($(this).hasClass('selectIndContact')) {

                $('.mdb-select').show();
                $('input[name="all_contacts"]').val('N');

		        if($('.selectAllContact').hasClass('active')) {
                    $('.selectAllContact').toggleClass('btn-mdb-color btn-light-blue active');
                } else if($(this).hasClass('active')) {
                    $('.mdb-select').hide();
                    $('.sendNotifiBtn').toggleClass('btn-mdb-color btn-success disabled');
                } else {
                    $('.sendNotifiBtn').toggleClass('btn-mdb-color btn-success disabled');
				}

                $(this).toggleClass('btn-mdb-color btn-light-blue active');

            } else {

                $('input[name="all_contacts"]').val('Y');

                if($('.selectIndContact').hasClass('active')) {
                    $('.selectIndContact').toggleClass('btn-mdb-color btn-light-blue active');
                } else if($(this).hasClass('active')) {
                    $('input[name="all_contacts"]').val('N');
                    $('.sendNotifiBtn').toggleClass('btn-mdb-color btn-success disabled');
                } else {
                    $('.sendNotifiBtn').toggleClass('btn-mdb-color btn-success disabled');
				}

                $('.mdb-select').hide();
                $(this).toggleClass('btn-mdb-color btn-light-blue active');
			}
        });

        $('body').on('click', '.showingNotiBtn', function() {

            $('.formatShowings').empty();
            $('.showingCard').each(function () {
                var address = $(this).find('.card-body .propShowingAddress').text();
                var time = $(this).find('#show_time').val();
                var newFormat = "<div class='row'><div class='col'><p>" + time + " - " + address + "</p></div></div>";

                $('.formatShowings').append(newFormat);
                console.log($('.propShowingDateInput').val());
            });
        });

        // Remove disbled class from save button to allow post of new showing form
        $('body').on('change', '#new_showing_modal input, #new_showing_modal textarea, #new_showing_modal select', function() {

            console.log($('#new_showing_modal input#new_datetimepicker').val());
            console.log($('#new_showing_modal input#new_timepicker').val());
            console.log($('#new_showing_modal textarea#new_show_instructions').val());
            console.log($('#new_showing_modal #new_property_showing option:selected').val());

            if($('#new_showing_modal input#new_datetimepicker').val() != '' && $('#new_showing_modal input#new_timepicker').val() != '' && $('#new_showing_modal textarea#new_show_instructions').val() != '' && $('#new_showing_modal select#new_property_showing option:selected').val() != 'blank') {
                $('#new_showing_modal .saveNewShowing').removeClass('disabled');
			} else {
                $('#new_showing_modal .saveNewShowing').addClass('disabled');
            }

        });

	</script>

	@if(session('status'))
		<script>
			toastr.success($('.flashMessage').text());
		</script>
	@endif

@endsection

@section('content')
	{{-- If a return message is sent, add an alert --}}
	@if(session('status'))
		<h2 class="flashMessage hide" hidden>{{ session('status') }}</h2>
	@endif

    @php $formatDate = []; @endphp
	@php $calendar = DB::table('calendar_month')->get(); @endphp
	@php $showings = App\PropertyShowing::pluck('show_date'); @endphp

    @foreach($showings as $value)
        @php array_push($formatDate, $value->toDateString()); @endphp
    @endforeach

    @php $showings = $formatDate; @endphp

	<div id="content_container" class="container-fluid">
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
					<button class='btn blue-grey addNewShowing' type='button' data-toggle="modal" data-target="#new_showing_modal">Add Showing</button>
				</div>
			@endif
		</div>
		
		<!-- Calendar showings information -->
		<div class="row showingsContent" id="showings_content">
			@if($todayShowings->isNotEmpty())
				<div class="col-12 mt-5 text-center">
					<h1 class="">Today {{ $showDate->format('F jS\\, Y') }}</h1>
				</div>

				@if(Auth::check())
					<!-- Send Showing Notification-->
					<div class="col-12">
						<button class="btn showingNotiBtn light-blue darken-1" data-toggle="modal" data-target="#notiModal">Send Showing Notification</button>
					</div>
				@endif

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

									<a href="#" class="btn btn-block red darken-3 removeShowing m-0 my-2">Remove Showing</a>
									
									<input type="number" name="showing_id" id="showing_id" class="hidden" value="{{ $showing->id }}" hidden />
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

	<!-- Modal -->
	<div class="modal fade" id="notiModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">

		<!-- Add .modal-dialog-centered to .modal-dialog to vertically center the modal -->
		<div class="modal-dialog modal-lg" role="document">

			{!! Form::open(['action' => 'PropertyController@calendar_notification', 'class' => 'send_calendar_notification_form', 'method' => 'POST']) !!}

				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLongTitle">Send Email Notification</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>

					<div class="modal-body">
						<div class="">
							<h2 class="text-center">Here is a list of the properties you have as being shown on this date <span class="text-center propShowingDate"></span></h2>
						</div>

						<div class="formatShowings p-4"></div>

						<div class="md-form hidden">
							<select class="mdb-select colorful-select dropdown-primary" name="send_to[]" searchable="Search here.." multiple>
								<option value="" disabled selected>Choose recipients</option>
								@foreach($allContacts as $eachContact)
									<option value="{{ $eachContact->id }}" data-icon="{{ $eachContact->image ? str_ireplace('public', 'storage', $eachContact->image->path) : asset('/images/empty_face.jpg') }}" class="rounded-circle" {{ $eachContact->email == null ? 'disabled' : '' }}>{{ $eachContact->full_name() }}{{ $eachContact->email == null ? ' - no email listed' : '' }}</option>
								@endforeach
							</select>
							<button type="button" class="btn-save btn btn-primary btn-sm">Save</button>
						</div>

						<div class="row selectRecipients">
							<div class="col-12 d-flex align-items-center justify-content-around">

								<button type="button" class="btn btn-mdb-color selectIndContact">Selection Inidividual Contacts</button>
								<button type="button" class="btn btn-mdb-color selectAllContact">Select All Contacts</button>

							</div>
						</div>
					</div>

					<div class="container-fluid" style="border-top: 1px solid #e9ecef;">

						<div class="row">
							<div class="col-12 py-4 d-flex align-items-center justify-content-between">

								<button type="submit" class="btn btn-mdb-color disabled sendNotifiBtn">Send Notification</button>
								<button type="button" class="btn btn-deep-orange" data-dismiss="modal">Close</button>

								<input type="text" name="all_contacts" class="" hidden />
								<input type="date" name="showing_date" class="propShowingDateInput" hidden />
							</div>
						</div>
					</div>
				</div>

			{!! Form::close() !!}

		</div>

	</div>

	<!-- Modal -->
	<div class="modal fade" id="new_showing_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">

		<!-- Add .modal-dialog-centered to .modal-dialog to vertically center the modal -->
		<div class="modal-dialog modal-lg" role="document">

			{!! Form::open(['action' => 'PropertyController@add_showing_2', 'method' => 'POST']) !!}

				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLongTitle">Create New Showing</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>

					<div class="modal-body">
						<!-- Material input -->
						<div class="md-form">
						    <input type="text" class='form-control datetimepicker' name="new_datetimepicker" id='new_datetimepicker' />
						    <label for="new_datetimepicker">Show Date</label>
						</div>

						<!-- Material input -->
						<div class="md-form">
						    <input type="text" class="form-control timepicker" name="new_timepicker" id="new_timepicker" />
						    <label for="new_timepicker">Show Time</label>
						</div>

						<!-- Material input -->
						<div class="md-form">
						    <textarea type="text" class="form-control md-textarea" name="new_show_instructions" id="new_show_instructions" placeholder="Enter Showing Instructions"></textarea>
						    <label for="new_show_instructions">Show Instructions</label>
						</div>

						<div class="md-form hidden">
							<select class="mdb-select colorful-select dropdown-primary" name="new_property_showing" id="new_property_showing" searchable="Search here.." required>
								<option value="blank" disabled selected>Select a Property</option>

								@foreach($allProperties as $eachProperty)
									<option value="{{ $eachProperty->id }}" data-icon="{{ $eachProperty->medias()->default()->first() != null ? str_ireplace('public', 'storage', $eachProperty->medias()->default()->first()->path) : asset('/images/empty_prop.png') }}" class="rounded-circle" {{ $eachProperty->active != 'Y' ? 'disabled' : '' }}>{{ $eachProperty->address }}</option>
								@endforeach
							</select>

							<button type="button" class="btn-save btn btn-primary btn-sm">Save</button>
						</div>

					</div>

					<div class="container-fluid" style="border-top: 1px solid #e9ecef;">

						<div class="row">
							<div class="col-12 py-4 d-flex align-items-center justify-content-between">

								<button type="submit" class="btn btn-mdb-color saveNewShowing disabled">Save Showing</button>
								<button type="button" class="btn btn-deep-orange" data-dismiss="modal">Close</button>

							</div>
						</div>
					</div>
				</div>

			{!! Form::close() !!}

		</div>

	</div>
@endsection

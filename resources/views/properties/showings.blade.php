<div class="col-12 mt-5 text-center">
	<h1 class="">{{ $showDate->format('l F jS\\, Y') }}</h1>
</div>

@foreach($showings as $showing)

	@php
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

		$defaultPic = $showing->property->medias()->where('default_photo', 'Y')->first();

		if($showing->property->medias()->first()) {

			if($defaultPic != null) {

				if(file_exists(str_ireplace('public', 'storage', $defaultPic->path))) {

					$image = str_ireplace('public/images', 'storage/images/sm', $defaultPic->path);

				} else {

					$image = '/images/empty_prop.png';

				}

			} else {

				$image = $showcase->medias()->first();

				if(file_exists(str_ireplace('public', 'storage', $image->path))) {

					$image = str_ireplace('public/images', 'storage/images/sm', asset($image->path));

				} else {

					$image = '/images/empty_prop.png';

				}
			}
		} else {

			$image = '/images/empty_prop.png';
		}
	@endphp

	<div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 my-3 showingCard">
		<!--Card-->
		<div class="card card-cascade reverse wider">
			<!--Card Image-->
			<div class="view overlay">
				<img src="{{ $image }}" class="img-fluid" />
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
					<div class="md-form input-with-post-icon datepicker">
						<input type="text" name="show_date" id="show_date" data-value="{{ $showing->show_date }}" class="form-control" />
						<label for="show_date" class="active">Show Date:</label>

						<i class="fas fa-calendar input-prefix" tabindex=0></i>
					</div>

					<!--Show Time-->
					<div class="md-form input-with-post-icon timepicker" twelvehour="true">
						<input type="text" name="show_time" id="show_time" value="{{ $time }}" class="form-control" />
						<label for="show_time" class="active propShowingTime">Show Time:</label>

						<i class="far fa-clock input-prefix"></i>
					</div>

					<!--Show Instructions-->
					<div class="md-form">
						<textarea type="text" id="show_instruc" class="form-control md-textarea" rows="3" placeholder="Enter Showing Instructions">{{ $showing->show_instructions }}</textarea>
						<label for="textareaBasic" class="active">Additional Information:</label>
					</div>

					<input type="text" id="update_showing" name="update_showing" class="btn btn-block m-0 my-2 primary-color-dark white-text updateShowing" value="Update Showing" style="display:none;" />

					<a href="#" class="btn btn-block red darken-3 white-text removeShowing m-0 my-2">Remove Showing</a>

					<input type="number" name="showing_id" id="showing_id" class="hidden" value="{{ $showing->id }}" hidden />
			@else
				<!--Card Title-->
					<h2 class="">{{ $showing->property->address }}</h2>

					<!--Show Time-->
					<p class="">Showtime: {{ $time }}</p>

					<!--Tenant Responsibilities-->
					<p><u>Tenant Responsibilities:</u>
					@if($showing->property->included_utl != null)
						@if(substr_count($showing->property->included_utl, 'electricity') >= 1)
							<div class="pl-2"><i class="fa fa-bolt amber-text" aria-hidden="true"></i>&nbsp;Electricity</div>
						@endif

						@if(substr_count($showing->property->included_utl, 'water') >= 1)
							<div class="pl-2"><i class="fa fa-tint blue-text" aria-hidden="true"></i>&nbsp;Water</div>
						@endif

						@if(substr_count($showing->property->included_utl, 'gas') >= 1)
							<div class="pl-2"><i class="fa fa-fire red-text" aria-hidden="true"></i>&nbsp;Gas</div>
						@endif
					@else
						<div class="pl-2">
							<p class="">Tenant Not Responsible For Any Utilities</p>
						</div>
						@endif
						</p>

						<!--Show Instructions-->
						@if($showing->property->requirements->isNotEmpty())
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
						<p class=""><u>Additional Information:</u><br/>{!! nl2br($showing->show_instructions) !!}</p>
					@endif
			</div>
			<!--/Card Content-->
		</div>
		<!--/Card-->
	</div>
@endforeach
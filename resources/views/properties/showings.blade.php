<div class="col-12 mt-5 text-center">
	<h1 class="">{{ $showDate->format('l F jS\\, Y') }}</h1>
</div>
@foreach($showings as $showing)
	@php
		$defaultPhoto = $showing->property->medias()->where('default_photo', 'Y')->first() == null ? '/images/empty_prop.png' : str_ireplace('public', 'storage', $showing->property->medias()->where('default_photo', 'Y')->first()->path);
		$time = "";
		$timeArray = explode(':', $showing->show_time);
		
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
					<h2 class="">{{ $showing->property->address }}</h2>
					
					<!--Show Date-->
					<div class="md-form">
						<input type="text" name="show_date" id="show_date" data-value="{{ $showing->show_date }}" value="{{ $showing->show_date }}" class="form-control datetimepicker" />
						<label for="show_date" class="active">Show Date: </label>
					</div>
					
					<!--Show Time-->
					<div class="md-form">
						<input type="text" name="show_time" id="show_time" value="{{ $time }}" class="form-control timepicker" />
						<label for="show_time" class="active">Show Time: </label>
					</div>

					<!--Show Instructions-->
					<div class="md-form">
						<textarea type="text" id="show_instruc" class="form-control md-textarea" rows="3">{{ $showing->show_instructions }}</textarea>
						<label for="textareaBasic" class="active">Additional Information:</label>
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
					<p class="">Additional Information: {!! nl2br($showing->show_instructions) !!}</p>
				@endif
			</div>
			<!--/Card Content-->
		</div>
		<!--/Card-->
	</div>
@endforeach
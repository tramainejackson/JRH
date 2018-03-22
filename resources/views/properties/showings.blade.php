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
				<a href="/properties/{{ $showing->property->id }}" class="">
					<div class="mask rgba-white-slight"></div>
				</a>
			</div>
			<!--/Card Image-->
			
			<!--/Card Content-->
			<div class="card-body">
				<!--Card Title-->
				<h2 class="">{{ $showing->property->address }}</h2>
				
				<!--Show Time-->
				<p class="">Showtime: {{ $time }}</p>

				<!--Show Instructions-->
				<p class="">Additional Information: {{ $showing->show_instructions }}</p>
				
				@if(Auth::check())
					<input type="number" name="" class="hidden" value="{{ $showing->id }}" hidden />
					<a href="#" class="btn btn-block red darken-3 removeShowing m-0 my-2">Remove Showing</a>
				@endif
			</div>
			<!--/Card Content-->
		</div>
		<!--/Card-->
	</div>
@endforeach
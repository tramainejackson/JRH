@extends('layouts.app')

@section('content')

	<div id="" class="jumbotron jumbotron-fluid py-5 d-flex align-items-center propertiesJumbotron"></div>

	<div class="container">

		<div class="row">

			<div class="col-12">

				@if($property->sale == 'rent')
					<h5 class="propertyItem green-text text-center mb-0">{{ $property->price != null ? '$' . $property->price : 'Call for Pricing' }}&nbsp;/per month</h5>
					<h5 class="text-center mt-0 mb-3"><span class="font-small font-italic">{{ $property->move_in_cost != null ? '$' . $property->move_in_cost . ' /total move in cost' : 'Call for total move in cost' }}</span>&nbsp;&nbsp;<i class="fa fa-info-circle deep-orange-text" aria-hidden="true" data-toggle="tooltip" data-placement="right" title="This is total price it will cost to move in. Normally includes, first and last rent and a security deposit."></i></h5>
				@endif

				<h1 class="propertyItem d-flex flex-column align-items-center my-2">
					<span>{{ $property->address }}&nbsp;</span>
					<span>{{ $property->city }}&nbsp;{{ $property->state }},&nbsp;</span>
					<span>{{ $property->zip }}</span>
				</h1>

				<h5 class="propertyItem d-flex align-items-center justify-content-around justify-content-md-center my-2">
					<span class="indigo-text mr-md-2"><i class="fa fa-bed" aria-hidden="true"></i>&nbsp;Beds:&nbsp;{{ $property->bed }}&nbsp;&nbsp;</span>
					<span class="deep-purple-text ml-md-2"><i class="fas fa-bath"></i>&nbsp;Baths:&nbsp;{{ $property->bath }}</span>
				</h5>

				<h5 class="propertyItem">

					@if($property->sale == 'rent')

						<h5 class="text-center pt-4">Tenant Responsible For:</h5>

						<div class="d-flex align-items-center justify-content-around">

							@if($property->included_utl != null)
								@if(substr_count($property->included_utl, 'electricity') >= 1)
									<div class="d-inline px-2"><i class="fa fa-bolt amber-text" aria-hidden="true"></i>&nbsp;Electricity</div>
								@endif

								@if(substr_count($property->included_utl, 'water') >= 1)
									<div class="d-inline px-2"><i class="fa fa-tint blue-text" aria-hidden="true"></i>&nbsp;Water</div>
								@endif

								@if(substr_count($property->included_utl, 'gas') >= 1)
									<div class="d-inline px-2"><i class="fa fa-fire red-text" aria-hidden="true"></i>&nbsp;Gas</div>
								@endif
							@else
								&nbsp;Tenant Not Responsible For Any Utilities
							@endif
						</div>

						@if($property->requirements->isNotEmpty())
							<div class="">
								<h5 class=""><u>Property Requirements:</u></h5>
								<ol class="">
									@foreach($property->requirements as $requirement)
										<li class="">{{ $requirement->instructions }}</li>
									@endforeach
								</ol>
							</div>
						@endif
					</h5>
				@endif
			</div>

			<div class="col-12">
				<div class="">
					{{--<h2 class="text-center pt-5">{{ $property->title }}</h2>--}}

					<h3 class="pt-4 mb-0 text-underline font-italic">Description:</h3>
					<p class="text-justify pb-4">{{ $property->description }}</p>

					@php $dt = new Carbon\Carbon($property->available_date); @endphp
					@php $dtFormat = $dt->toFormattedDateString(); @endphp

					@if($property->active == "N")
						<span class="text-center text-uppercase text-danger"><i>This Property Is Not Currently Available</i></span>
					@else
						@if($dt->isFuture())
							<span class="d-block text-center text-success"><i>Available Date is {{ $dtFormat }} </i></span>
						@else
							<span class="d-block text-center text-success"><i>Currently Available</i></span>
						@endif
					@endif

					<p class="text-center"><i>For more information, please contact us at {{ $settings->phone }} or {{ $settings->email }}</i></p>
				</div>
			</div>

			<div class="col-12 text-center">
				@if($property->active == "Y")
					<div class="mt-4">
						<a type="button" class="btn btn-lg mt-2 btn-outline-primary btn-rounded waves-effect" target="_blank" href="http://jacksonrentalhomes.zohosites.com/BOOKING"><i class="fas fa-calendar-day"></i>&nbsp;&nbsp;Click Here To Schedule An Appointment&nbsp;&nbsp;<i class="fas fa-calendar-day"></i></a>
					</div>
				@endif
			</div>

			<div class="col-12 propertyImgGallery my-4">

				@if($images->isNotEmpty())

					<div id="mdb-lightbox-ui"></div>

					<!--Full width lightbox-->
					<div class="mdb-lightbox">

						<div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 align-items-center justify-content-center">

							@foreach($images as $image)

								<figure class="col text-center my-1">
									<a href="{{ asset($image->path) }}" class="" data-size="1500x{{ isset($image->lg_height) && $image->lg_height != null ? $image->lg_height : '1500' }}">
										<img src="{{ asset($image->path) }}" class="img-fluid" style="max-height: {{ isset($image->sm_height) && $image->sm_height != null ? $image->sm_height . 'px' : '500px' }}" />
									</a>
								</figure>

							@endforeach
						</div>
					</div>
				@else
					<p class="">No Images Added For This Property</p>
				@endif
			</div>
		</div>
		<div class="row align-items-center">
			<h1 class="col text-hide my-3" style="border:1px solid #787878 !important">Hidden Text</h1>
		</div>
	</div>
@endsection
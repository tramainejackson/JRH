@extends('layouts.app')
@if(Auth::check())
@else
@section('addt_style')
@endsection

@section('content')

	<div id="" class="jumbotron jumbotron-fluid py-5 d-flex align-items-center propertiesJumbotron"></div>

	<div class="container">

		<div class="row">

			<div class="col-12">

				<h4 class="propertyItem">{{ $property->address }}&nbsp;{{ $property->city }}&nbsp;{{ $property->state }},&nbsp;{{ $property->zip }}</h4>
				<h5 class="propertyItem">
					<i class="fa fa-bed" aria-hidden="true"></i>&nbsp;<em>Beds:</em>&nbsp;{{ $property->bed }}&nbsp;&nbsp;
					<i class="fa fa-bathtub" aria-hidden="true"></i>&nbsp;<em>Baths:&nbsp;</em>{{ $property->bath }}
				</h5>

				<h5 class="propertyItem">

					@if($property->sale == 'rent')
						<h5 class="propertyItem">{{ $property->price != null ? '$' . $property->price : 'Call for Pricing' }}&nbsp;/per month</h5>
						<h5>{{ $property->move_in_cost != null ? '$' . $property->move_in_cost . ' /total move in cost' : 'Call for total move in cost' }}&nbsp;&nbsp;<i class="fa fa-info-circle deep-orange-text" aria-hidden="true" data-toggle="tooltip" data-placement="right" title="This is total price it will cost to move in. Normally includes, first and last rent and a security deposit."></i></h5>
						<h5>Tenant Responsible For:
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
						</h5>

						@if($property->requirements)
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
					<h2 class="text-center pt-5">{{ $property->title }}</h2>

					<h3><i><u>Description:</u></i></h3>
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

			<div class="col-12 propertyImgGallery my-4">
				@if($images->isNotEmpty())
					<div id="mdb-lightbox-ui"></div>

					<!--Full width lightbox-->
					<div class="mdb-lightbox">

						<div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 align-items-center justify-content-center">

							@foreach($images as $image)
								@php
									if(file_exists(str_ireplace('public', 'storage', $image->path))) {

										$image_path = str_ireplace('public/images', 'storage/images/sm', asset($image->path));

									} else {

										$image_path = '/images/no_image_lg.png';

									}
								@endphp

								<figure class="col text-center my-1">
									<a href="{{ $image_path }}" class="" data-size="1500x{{ isset($image->lg_height) && $image->lg_height != null ? $image->lg_height : '1500' }}">
										<img src="{{ $image_path }}" class="img-fluid" />
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
@endif

@section('footer')
@endsection
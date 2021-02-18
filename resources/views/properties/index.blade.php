@extends('layouts.app')

@section('content')

	@if(Auth::check())

		<div id="" class="jumbotron jumbotron-fluid d-flex align-items-center propertiesJumbotron"></div>

		<div class="container-fluid">

			@if($properties->isNotEmpty())

				<div class="row">
					<div class="col-12 text-center mx-auto">

						<div class="container-fluid">
							<a href="{{ route('properties.create') }}" class="btn btn-success d-block d-sm-inline">Add New Property</a>
							<p class="my-3"><i>Total Properties:</i>&nbsp;<span class="text-muted">{{ $totalProperties->count() }}</span></p>
						</div>

						<form id="search-form" method="POST" action="{{ action('PropertyController@search') }}">

							{{ csrf_field() }}
							{{ method_field('POST') }}

							<div class="form-row" id="">
								<div class="md-form input-group col-12 col-md-6 mx-auto mb-5">
									<input type="text" name="search" class="form-control valueSearch" value="{{ request()->query('search') ? request()->query('search') : '' }}" placeholder="Properties Search" />

									<div class="input-group-btn">
										<button class="btn btn-outline-success searchBtn" type="button" onclick="event.preventDefault(); document.getElementById('search-form').submit();">
											<i class="fa fa-search" aria-hidden="true"></i>
										</button>
									</div>
								</div>
							</div>
						</form>
					</div>

					<div class="col-12 mx-auto">

						<div class="container-fluid">

							<!--- Pagination Links -->
							{{ $properties->links() }}

							<div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3 my-4">

								@foreach($properties as $property)

									<div class="col py-2 propertyList">

										<div class="card card-image h-100" style="background-image: url({{ asset($property->medias()->default()) }});">

											<!-- Content -->
											<div class="text-white text-center d-flex align-items-center rgba-mdb-color-strong py-5 px-4 h-100">
												<div class="d-block w-100">
													<h5 class="text-success"><i class="fas fa-home"></i> {{ $property->price != null ? '$' . $property->price : 'No Price Added Yet' }}&nbsp;{{ $property->sale == 'rent' ? '/per month' : '' }}</h5>
													<span class="col col-6 text-center">{!! $property->active == "Y" ? "<i class='fas fa-check-circle text-success'></i> Active" : "<i class='fas fa-times-circle text-danger'></i> Inactive" !!}</span>
													<h3 class="card-title pt-2"><strong>{{ $property->address }}</strong></h3>
													<p>{{ nl2br($property->description) }}</p>

													<a href="{{ route('properties.edit', $property->id) }}" class="btn btn-action"><i class="fas fa-clone left"></i> Edit</a>
												</div>
											</div>

										</div>
									</div>
								@endforeach
							</div>

							<!--- Pagination Links -->
							{{ $properties->links() }}

						</div>
					</div>
				</div>
			@else
				<div class="row">
					<div class="col">
						<h2 class="text-center">You haven't added any properties yet</h2>
						<h4 class="text-center">Click <a href="{{ route('properties.create') }}" class="">here</a> to create your first property</h4>
					</div>
				</div>
			@endif
		</div>

		@if($settings->show_deletes == "Y")

			@if($deletedProps->isNotEmpty())

				<div class="container-fluid">
					<div class="row">
						<div class="col">
							<div class="deleteDivider"></div>
						</div>
					</div>
					<div class="row">

						<div class="col col-12">
							<h2 class="">Deleted Properties</h2>
						</div>

						@foreach($deletedProps as $deletedProp)

							<div class="col-12 col-sm-4">
								<div class="card">
									<div class="card-header">
										<h2 class="text-center">{{ $deletedProp->address }}
										</h2>
									</div>
									<div class="card-body">
										<ul class="propertyInfo">
											<li class="propertyItem">{{ $deletedProp->description }}</li>
										</ul>
									</div>
									<div class="card-footer text-center">
										<a class="btn btn-warning" style="line-height:1.5" href="/property_restore/{{$deletedProp->id}}" class="">Restore</a>
									</div>
								</div>
							</div>

						@endforeach
					</div>
				</div>
			@endif
		@endif

	@else

		<div id="content_container" class="jumbotron jumbotron-fluid py-5 d-flex align-items-center propertiesJumbotron"></div>

		<div class="container-fluid">
			<div class="row align-items-center justify-content-center mb-5">
				<div class="col-12">
					<p class="my-3 px-3"><i>Total Properties {{ request()->query('sale') !== null ? request()->query('sale') == 'sale' ? 'for Sale' : 'for Rent' : '' }}:</i>&nbsp;<span class="text-muted">{{ $properties->where('active', 'Y')->count() }}</span></p>
				</div>

				<div class="col-12">
					<div class="d-flex justify-content-center flex-column flex-md-row" id="">
						<a class="btn btn-lg darken-1 white-text py-3 my-1 {{ request()->query('sale') == null ? 'btn-success' : 'btn-mdb-color' }}" href="{{ route('properties.index') }}" type='button'>&nbsp;&nbsp;&nbsp;&nbsp;All Properties&nbsp;&nbsp;&nbsp;&nbsp;</a>

						<a class="btn btn-lg darken-1 white-text py-3 my-1 {{ request()->query('sale') !== null && request()->query('sale') == 'sale' ? 'btn-success' : 'btn-mdb-color' }}" href="{{ route('properties.index') . '?sale=sale' }}" type='button'>Properties For Sale</a>

						<a class="btn btn-lg darken-1 white-text py-3 my-1 {{ request()->query('sale') !== null && request()->query('sale') == 'rent' ? 'btn-success' : 'btn-mdb-color' }}" href="{{ route('properties.index') . '?sale=rent' }}" type='button'>Properties For Rent</a>
					</div>
				</div>
			</div>
		</div>

		<div class="container">

			@if($properties->isNotEmpty())

				@foreach($properties->where('active', 'Y') as $property)

					<!-- Card -->
					<div class="card card-cascade wider reverse">

						<!-- Card image -->
						<div class="view view-cascade overlay" style="max-height: 500px;">
							<img class="card-img-top" src="{{ $property->medias()->default() }}"  style="max-height: 500px; max-width: 100%;"
								 alt="Card image cap">
							<a href="{{ route('properties.show', $property->id) }}">
								<div class="mask rgba-white-slight"></div>
							</a>
						</div>

						<!-- Card content -->
						<div class="card-body card-body-cascade text-center">

							<!-- Title -->
							<h2 class="card-title">
								<strong>{{ $property->address }}</strong>
								<!-- Rent/Sale button -->
								<a class="white-text btn-rounded btn-sm teal float-right">{{ $property->sale == "sale" ? 'S' : 'R' }}</a>
							</h2>
							<!-- Subtitle -->
							<h4 class="font-weight-bold indigo-text py-2">{{ $property->price != null ? '$' . $property->price : 'Call for Pricing' }}&nbsp;{{ $property->sale == 'rent' ? '/per month' : '' }}
								<span class="text-danger d-block font-italic font-small"><i class="fas fa-asterisk"></i> Price Subject to Change <i class="fas fa-asterisk"></i></span>
							</h4>
							<!-- Subtitle -->
							<h6 class="font-weight-bold indigo-text py-2{{ $property->active == 'N' ? ' text-muted' : ' text-theme3' }}">{{ $property->active == 'N' ? ' Inactive - ' : '' }}</h6>
							<!-- Text -->
							<p class="card-text">{{ $property->description }}</p>

							<div class="">
								<a href="{{ route('properties.show', $property->id) }}" class="btn blue-grey white-text btn-lg{{ $property->active == 'N' ? ' disabled' : '' }}" >View Details</a>
							</div>
						</div>
					</div>
					<!-- Card -->

					@if(!$loop->last)
						<div class="row align-items-center">
							<h1 class="col text-hide my-5" style="border:1px solid #787878 !important">Hidden Text</h1>
						</div>
					@endif
				@endforeach

			@else

				<div class="row">
					<div class="col">
						<h2 class="text-center">There are no current properties available {{ request()->query('sale') !== null ? 'for ' . request()->query('sale') . '.' : '.' }}</h2>
					</div>
				</div>
			@endif
		</div>
	@endif
@endsection
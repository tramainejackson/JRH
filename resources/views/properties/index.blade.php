@extends('layouts.app')
@section('addt_style')
	<link href="{{ asset('/css/mat.css') }}" rel="stylesheet">
@endsection
@section('content')
@if(Auth::check())
	<div id="" class="jumbotron jumbotron-fluid py-5 d-flex align-items-center propertiesJumbotron">
		<div class="container-fluid py-5">
			<h2 class="py-5 text-white display-4">Growth and development of our communities are at the core of our pursuit.</h2>
		</div>
	</div>
	<div class="container-fluid">
		@if(session('status'))
			<h2 class="">{{ session('status') }}</h2>
		@endif
		@if($properties->isNotEmpty() || $deletedProps->isNotEmpty())
			<div class="row">
				<div class="col-12 col-sm-3 text-center">
					<a href="/properties/create" class="btn btn-success py-4" style="line-height:0;">Add New Property</a>
				</div>
				<div class="col-12 col-sm-9">
					<div class="container-fluid">
						<div class="row">
							@foreach($properties as $property)
								<div class="col-12 col-sm-6">
									<div class="card mb-3">
										<div class="card-header container-fluid d-sm-flex align-items-center text-theme5 bg-theme3">
											<a class="btn btn-warning d-block d-sm-inline float-sm-right pb-1 mb-2 mb-sm-2 pb-sm-3" href="/properties/{{ $property->id }}/edit" class="" style="line-height:0.8;">Edit</a>
											<h2 class="text-center col-sm-8 col-12 mr-auto">{{ $property->address }}</h2>
										</div>
										<div class="card-body container-fluid bg-theme5">
											<div class="row">
												<span class="oi oi-basket text-theme1 col-1 text-center" title="icon name" aria-hidden="true"></span>
												<span class="col-sm-11 col-10 text-theme1 text-truncate">{{ $property->title }}</span>
											</div>
											<div class="row">
												<span class="oi oi-clipboard text-theme1 col-1 text-center" title="icon name" aria-hidden="true"></span>
												<span class="col-sm-11 col-10 text-theme1 text-truncate">{{ $property->description }}</span>
											</div>
											<div class="row">
												<span class="oi oi-home text-theme1 col-1 text-center" title="icon name" aria-hidden="true"></span>
												<span class="col-sm-11 col-10 text-theme1 text-truncate">{{ ucfirst($property->type) }}</span>
											</div>
											<div class="row">
												<span class="oi oi-dollar text-theme1 col-1 text-center" title="icon name" aria-hidden="true"></span>
												<span class="col-sm-11 col-10 text-theme1 text-truncate">${{ $property->price }}&nbsp;/per month</span>
											</div>
										</div>
										<div class="card-footer text-theme5 bg-theme3">
											<div class="container-fluid">
												<div class="row">
													<span class="col col-6 text-center">{!! $property->active == "Y" ? "<span class='oi oi-check text-success' title='icon name' aria-hidden='true'></span> Active" : "<span class='oi oi-x text-danger' title='icon name' aria-hidden='true'></span> Inactive" !!}</span>
													<span class="col-6 text-center">{!! $property->showcase == "Y" ? "<span class='oi oi-check text-success' title='icon name' aria-hidden='true'></span>" : "<span class='oi oi-x text-danger' title='icon name' aria-hidden='true'></span>" !!} Showcase</span>
												</div>
											</div>
										</div>
									</div>
								</div>
							@endforeach
						</div>
					</div>
				</div>
			</div>
			@if($settings->show_deletes == "Y")
				@if($deletedProps->isNotEmpty())
					<div class="row"><div class="deleteDivider"></div></div>
					<div class="row">
						<div class="col col-12">
							<h2 class="">Deleted Properties</h2>
						</div>
						@foreach($deletedProps as $deletedProp)
							<div class="col col-4">
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
										<a class="btn btn-warning" href="/property_restore/{{$deletedProp->id}}" class="">Restore</a>
									</div>
								</div>
							</div>
						@endforeach
					</div>
				@endif
			@endif
		@else
			<div class="row">
				<div class="col">
					<h2 class="text-center">You haven't added any properties yet</h2>
					<h4 class="text-center">Click <a href="/properties/create" class="">here</a> to create your first property</h4>
				</div>
			</div>
		@endif
	</div>
@else
	<div id="" class="jumbotron jumbotron-fluid py-5 d-flex align-items-center propertiesJumbotron">
		<div class="container-fluid py-5">
			<h2 class="py-5 text-white display-4">Growth and development of our communities are the core of our pursuit.</h2>
		</div>
	</div>
	<div class="container">
		@if($properties->isNotEmpty())
			<div class="row align-items-center">
				<h1 class="col-2 col-md-4 text-hide" style="border:1px solid #787878 !important">Hidden Text</h1>
				<h1 class="col-8 col-md-4 text-muted">Changing Lives</h1>
				<h1 class="col-2 col-md-4 text-hide" style="border:1px solid #787878 !important">Hidden Text</h1>
			</div>
			@foreach($properties as $property)
				@if($property->medias()->first())
					@php $image = $property->medias()->first(); @endphp
					@php $image = asset('storage/' . str_ireplace('public/', '', $image->path)); @endphp
				@else
					@php $image = '/images/empty_prop.png'; @endphp
				@endif
				<div class="row mt-4 align-items-center">
					<div class="col-12 order-1 col-md-5">
						<img class="img-fluid mx-auto" alt="Property Image" style="width: 100%x; height: 400px;" src="{{ $image }}">
					</div>
					<div class="col-12 col-md-6 order-2 ml-auto">
						<div class="">
							<h2 class="text-center text-sm-left pt-3 pt-sm-0{{ $property->active == 'N' ? ' text-muted' : ' text-theme3' }}">{{ $property->active == 'N' ? ' Inactive - ' : '' }}{{ $property->title }}</h2>
						</div>
						<div class="">
							<p class="lead">{{ $property->price != null ? '$' . $property->price : 'Call for Pricing' }}&nbsp;/per month</p>
							<span class="text-danger"><i>*Price Subject to Change</i></span>
						</div>
						<hr/>
						<div class="">
							<h4 class="text-left text-muted pb-2">{{ ucwords($property->type) }}</h4>
						</div>
						<div class="">
							<p>{{ $property->description }}</p>
						</div>
						<div class="">
							<a href="/properties/{{ $property->id }}/" class="btn text-theme1 btn-theme3 btn-lg d-block d-sm-inline{{ $property->active == 'N' ? ' disabled' : '' }}" >View Details</a>
						</div>
					</div>
				</div>
				<div class="row align-items-center">
					<h1 class="col text-hide my-5" style="border:1px solid #787878 !important">Hidden Text</h1>
				</div>
			@endforeach
		@else
			<div class="row">
				<div class="col">
					<h2 class="text-center">No properties have been added yet</h2>
				</div>
			</div>
		@endif
	</div>
@endif
@endsection

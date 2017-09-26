@extends('layouts.app')

@section('content')
@if(Auth::check())
	<div id="" class="jumbotron jumbotron-fluid py-5 d-flex align-items-center propertiesJumbotron">
		<div class="container-fluid py-5">
			<h2 class="py-5 text-white display-4">Growth and development of our communities are the core of our pursuit.</h2>
		</div>
	</div>
	<div class="container-fluid">
		@if(session('status'))
			<h2 class="">{{ session('status') }}</h2>
		@endif
		@if($properties->isNotEmpty() || $deletedProps->isNotEmpty())
			<div class="row">
				<div class="col col-12">
					<a href="/properties/create" class="btn btn-success">Add New Property</a>
				</div>
				@foreach($properties as $property)
					<div class="col col-4">
						<div class="card">
							<div class="card-header">
								<h2 class="text-center">{{ $property->address }}
									<a class="btn btn-warning float-right" href="/properties/{{ $property->id }}/edit" class="">Edit</a>
								</h2>
							</div>
							<div class="card-body">
								<ul class="propertyInfo">
									<li class="propertyItem">{{ $property->address }}</li>
									<li class="propertyItem">{{ $property->description }}</li>
									<li class="propertyItem">{{ $property->price }}</li>
								</ul>
							</div>
							<div class="card-footer">
								<p class="text-center">{{ $property->active == "Y" ? "Active" : "" }}</p>
								<p class="text-center">{{ $property->showcase == "Y" ? "Showcase" : "" }}</p>
							</div>
						</div>
					</div>
				@endforeach
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
				<h1 class="col col-4 text-hide" style="border:1px solid #787878 !important">Hidden Text</h1>
				<h1 class="col col-4 text-muted">Changing Lives</h1>
				<h1 class="col col-4 text-hide" style="border:1px solid #787878 !important">Hidden Text</h1>
			</div>
			@foreach($properties as $property)
				@if($property->medias()->first())
					@php $image = $property->medias()->first(); @endphp
					@php $image = asset('storage/' . str_ireplace('public/', '', $image->path)); @endphp
				@else
					@php $image = '/images/empty_prop.png'; @endphp
				@endif
				<div class="row mt-4 align-items-center">
					<div class="col-5 col-md-5">
						<img class="img-fluid mx-auto" alt="Property Image" style="width: 100%x; height: 400px;" src="{{ $image }}">
					</div>
					<div class="col-6 col-md-6 ml-auto">
						<div class="">
							<h2 class="text-left{{ $property->active == 'N' ? ' text-muted' : '' }}">{{ $property->active == 'N' ? ' Inactive - ' : '' }}{{ $property->title }}</h2>
						</div>
						<div class="">
							<p class="lead">{{ $property->price != null ? '$' . $property->price : 'Call for Pricing' }}{{ $property->rental == 'Y' ? '/per month' : '' }}</p>
							<span class="text-danger"><i>*Price Subject to Change</i></span>
						</div>
						<hr/>
						<div class="">
							<h4 class="text-left text-muted pb-2">{{ $property->type }}</h4>
						</div>
						<div class="">
							<p>{{ $property->description }}</p>
						</div>
						<div class="">
							<a href="/properties/{{ $property->id }}/" class="btn text-theme1 btn-theme3 btn-lg {{ $property->active == 'N' ? ' disabled' : '' }}" >View Details</a>
						</div>
					</div>
				</div>
				<div class="row align-items-center">
					<h1 class="col text-hide my-5" style="border:1px solid #787878 !important">Hidden Text</h1>
				</div>
			@endforeach
		@else
			<div class="row">
				<h2 class="text-center">No properties have been added yet</h2>
			</div>
		@endif
	</div>
@endif
@endsection

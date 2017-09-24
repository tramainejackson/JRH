@extends('layouts.app')

@section('content')
@if(Auth::check())
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
@else
	@if($properties->isNotEmpty())
		<div class="row">
			<div class="col">
				<h2 class="text-left p-4">Here is all of the properties that currently have. If the property is unavailbe, is will indicate so by saying inactive</h2>
			</div>
		</div>
		<div class="row">
			@foreach($properties as $property)
				<div class="col col-4">
					<div class="card">
						<div class="card-header">
							@if($property->showcase == "Y")
								<span class="text-center d-block" style="color:green">*FEATURED*</span>
							@endif
							<h2 class="text-center">{{ $property->address }}</h2>
						</div>
						<div class="card-body">
							<ul class="propertyInfo">
								<li class="propertyItem">{{ $property->title }}</li>
								<li class="propertyItem">{{ $property->description }}</li>
								<li class="propertyItem">{{ $property->price }}</li>
							</ul>
						</div>
						<div class="card-footer">
						</div>
					</div>
				</div>
			@endforeach
		</div>
		<hr/>
	@else
		<div class="row">
			<h2 class="text-center">No properties have been added yet</h2>
		</div>
	@endif
@endif
@endsection

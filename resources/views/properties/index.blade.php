@extends('layouts.app')

@section('content')
@if(session('status'))
	<h2 class="">{{ session('status') }}</h2>
@endif
@if($properties->isNotEmpty())
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
		@php $deletedProps = \App\Property::onlyTrashed()->get(); @endphp
		<div class="row"><div class="deleteDivider"></div></div>
		<div class="row">
			<div class="col col-12">
				<h2 class="">Deleted Properties</h2>
			</div>
			@foreach($deletedProps as $deletedProp)
				<div class="col col-12">
					<h2 class="">{{ $deletedProp->address}}</h2>
				</div>
			@endforeach
		</div>
	@endif
@else
	<div class="row">
		<div class="col">
			<h2 class="text-center">You haven't added any properties yet</h2>
			<h4 class="text-center">Click <a href="/properties/create" class="">here</a> to create your first property</h4>
		</div>
	</div>
@endif
@endsection

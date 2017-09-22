@extends('layouts.app')

@section('content')
@if(session('status'))
	<h2 class="">{{ session('status') }}</h2>
@endif
<div class="row">
	<div class="">
		<a href="/properties/create" class="btn btn-success">Add New Property</a>
		<a href="/properties" class="btn btn-success">All Properties</a>
	</div>
	<div class="col col-4">
		<div class="card">
			<div class="card-header">
				<h2 class="text-center">{{ $property->address }}
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
</div>
@endsection

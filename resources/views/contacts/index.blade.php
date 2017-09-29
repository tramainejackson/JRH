@extends('layouts.app')

@section('content')
	<div id="" class="jumbotron jumbotron-fluid py-5 d-flex align-items-center contactsJumbotron">
		<div class="container-fluid py-5">
			<h2 class="py-5 text-white display-4">Growth and development of our communities are the core of our pursuit.</h2>
		</div>
	</div>
	<div class="container-fluid">
		@if(session('status'))
			<h2 class="">{{ session('status') }}</h2>
		@endif
		<div class="row">
			@if($contacts->isNotEmpty())
				<div class="col-md-3 col-2 text-center">
					<a href="/contacts/create" class="btn btn-success">Add New Contact</a>
				</div>
				<div class="col-md-9 col-10">
					<div class="container-fluid">
						<div class="row">
							@foreach($contacts as $contact)
								<div class="col-md-6 col-4">
									<div class="card mb-3">
										<div class="card-header container-fluid d-flex align-items-center text-theme1 bg-theme2">
											<a class="btn btn-warning float-right" href="/contacts/{{ $contact->id }}/edit" class="">Edit</a>
											<h2 class="text-center col-8 mr-auto">{{ $contact->first_name }}</h2>
										</div>
										<div class="card-body container-fluid bg-theme5">
											<div class="row">
												<span class="oi oi-person text-theme1 col-1 text-center" title="person" aria-hidden="true"></span>
												<span class="col-11 text-theme1 text-truncate">{{ $contact->first_name . " " . $contact->last_name }}</span>
											</div>
											<div class="row">
												<span class="oi oi-envelope-closed text-theme1 col-1 text-center" title="envelope-closed" aria-hidden="true"></span>
												<span class="col-11 text-theme1 text-truncate">{{ $contact->email }}</span>
											</div>
											<div class="row">
												<span class="oi oi-phone text-theme1 col-1 text-center" title="phone" aria-hidden="true"></span>
												<span class="col-11 text-theme1 text-truncate">{{ $contact->phone }}</span>
											</div>
											<div class="row">
												<span class="oi oi-people text-theme1 col-1 text-center" title="people" aria-hidden="true"></span>
												<span class="col-11 text-theme1 text-truncate">Family of {{ $contact->family_size }}</span>
											</div>
											<div class="row">
												@php $dobFormat = new Carbon\Carbon($contact->dob); @endphp
												<span class="oi oi-calendar text-theme1 col-1 text-center" title="calendar" aria-hidden="true"></span>
												<span class="col-11 text-theme1 text-truncate">DOB: {{ $dobFormat->toFormattedDateString() }}</span>
											</div>
										</div>
										<div class="card-footer text-theme1 bg-theme2">
											<p class="text-center">{!! $contact->tenant == "Y" ? "<span class='oi oi-check text-success' title='icon name' aria-hidden='true'></span>" : "<span class='oi oi-x text-danger' title='icon name' aria-hidden='true'></span>" !!}&nbsp;Current Tenant</p>
										</div>
									</div>
								</div>
							@endforeach
						</div>
					</div>
				</div>
			@else
				<div class="col">
					<h2 class="text-center">You haven't added any contacts yet</h2>
					<h4 class="text-center">Click <a href="/contacts/create" class="">here</a> to create your first contact</h4>
				</div>
			@endif
		</div>
	</div>
@endsection

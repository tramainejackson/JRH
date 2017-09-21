@extends('layouts.app')

@section('content')
@if(session('status'))
	<h2 class="">{{ session('status') }}</h2>
@endif
<div class="row">
    @if($contacts->isNotEmpty())
		<div class="">
			<a href="/contacts/create" class="btn btn-success">Add New Contact</a>
		</div>
		@foreach($contacts as $contact)
			<div class="col col-4">
				<div class="card">
					<div class="card-header">
						<h2 class="text-center">{{ $contact->first_name }}
							<a class="btn btn-warning float-right" href="/contacts/{{ $contact->id }}/edit" class="">Edit</a>
						</h2>
					</div>
					<div class="card-body">
						<ul class="contactInfo">
							<li class="contactItem">{{ $contact->first_name . " " . $contact->last_name }}</li>
							<li class="contactItem">{{ $contact->email }}</li>
							<li class="contactItem">{{ $contact->phone }}</li>
							<li class="contactItem">Family of {{ $contact->family_size }}</li>
							<li class="contactItem">DOB: {{ $contact->dob }}</li>
						</ul>
					</div>
					<div class="card-footer">
						<p class="text-center">{{ $contact->tenant == "Y" ? "Current Tenant" : "" }}</p>
					</div>
				</div>
			</div>
		@endforeach
	@else
		<div class="col">
			<h2 class="text-center">You haven't added any contacts yet</h2>
			<h4 class="text-center">Click <a href="/contacts/create" class="">here</a> to create your first contact</h4>
		</div>
	@endif
</div>
@endsection

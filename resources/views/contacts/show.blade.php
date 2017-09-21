@extends('layouts.app')

@section('content')
@if(session('status'))
	<h2 class="">{{ session('status') }}</h2>
@endif
<div class="row">
	<div class="">
		<a href="/contacts/create" class="btn btn-success">Add New Contact</a>
		<a href="/contacts" class="btn btn-success">All Contacts</a>
	</div>
	<div class="col col-4">
		<div class="card">
			<div class="card-header">
				<h2 class="text-center">{{ $contact->first_name }}
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
</div>
@endsection

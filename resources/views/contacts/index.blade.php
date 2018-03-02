@extends('layouts.app')

@section('addt_style')
@endsection

@section('content')
	<div id="" class="jumbotron jumbotron-fluid py-5 d-flex align-items-center contactsJumbotron">
		<div class="container-fluid py-5">
			<h2 class="py-5 text-white display-4">Growth and development of our communities are the core of our pursuit.</h2>
		</div>
	</div>
	<div class="container-fluid">
		@if(session('status'))
			<h2 class="flashMessage">{{ session('status') }}</h2>
		@endif
		<div class="row">
			@if($contacts->isNotEmpty())
				<div class="col-sm-3 col-12 text-center mb-4">
					<div class="container-fluid">
						<a href="/contacts/create" class="btn btn-success d-block d-sm-inline">Add New Contact</a>
						<p class="my-3"><i>Total Contacts:</i>&nbsp;<span class="text-muted">{{ $contacts->count() }}</span></p>
					</div>
				</div>
				<div class="col-sm-9 col-12">
					<div class="container-fluid">
					
						<!-- Display for mobile screen -->
						<div class="row d-sm-none d-flex">
							@foreach($contacts as $contact)
								<div class="col-md-6 col-12">
									<div class="card mb-3">
										<div class="card-header container-fluid d-sm-flex align-items-center">
											<a class="btn btn-warning d-block d-sm-inline float-sm-right mb-2 mb-sm-2" href="/contacts/{{ $contact->id }}/edit" class="">Edit</a>
											<h2 class="text-center col-sm-8 col-12 mr-auto">{{ $contact->first_name }}</h2>
										</div>
										<div class="card-body container-fluid">
											<div class="row">
												<span class="oi oi-person col-1 text-center" title="person" aria-hidden="true"></span>
												<span class="col-sm-11 col-10 text-truncate">{{ $contact->first_name . " " . $contact->last_name }}</span>
											</div>
											<div class="row">
												<span class="oi oi-envelope-closed col-1 text-center" title="envelope-closed" aria-hidden="true"></span>
												<span class="col-sm-11 col-10 text-truncate">{{ $contact->email != null ? $contact->email : 'N/A' }}</span>
											</div>
											<div class="row">
												<span class="oi oi-phone col-1 text-center" title="phone" aria-hidden="true"></span>
												<span class="col-sm-11 col-10 text-truncate">{{ $contact->phone != null ? $contact->phone : 'N/A' }}</span>
											</div>
											<div class="row">
												<span class="oi oi-people col-1 text-center" title="people" aria-hidden="true"></span>
												<span class="col-sm-11 col-10 text-truncate">Family of {{ $contact->family_size != null ? $contact->family_size : 1 }}</span>
											</div>
											<div class="row">
												@php $dobFormat = new Carbon\Carbon($contact->dob); @endphp
												<span class="oi oi-calendar col-1 text-center" title="calendar" aria-hidden="true"></span>
												<span class="col-sm-11 col-10 text-truncate">DOB: {{ $contact->dob != null ? $dobFormat->toFormattedDateString() : 'N/A' }}</span>
											</div>
										</div>
										<div class="card-footer">
											<p class="text-center">{!! $contact->tenant == "Y" ? "<span class='oi oi-check text-success' title='icon name' aria-hidden='true'></span>" : "<span class='oi oi-x text-danger' title='icon name' aria-hidden='true'></span>" !!}&nbsp;Current Tenant</p>
										</div>
									</div>
								</div>
							@endforeach
						</div>
						
						<!-- Display for non-mobile screen -->
						<div class="row d-none d-sm-flex">
							@foreach($contacts as $contact)
								<div class="col-12 contactList">
									<div class="container-fluid">
										<div class="row">
											<div class="col-4">
												<img src="{{ $contact->image != null ? asset(str_ireplace('public', 'storage', $contact->image->path)) : asset('images/empty_face.jpg') }}" class="img-fluid" />
											</div>
											<div class="col-8">
												<div class="d-flex justify-content-between">
													<h1 class="text-center coolText1 display-3"><strong>{{ $contact->first_name . " " . $contact->last_name  }}</strong></h1>

													<a class="btn btn-warning align-self-center" href="/contacts/{{ $contact->id }}/edit" class="">Edit</a>
												</div>
												<div class="">
													<h3 class="d-inline-block"><u>Email :</u>&nbsp;</h3>
													<span class=""><a href="mailto:{{ $contact->email != null ? $contact->email : 'N/A' }}" class="">{{ $contact->email != null ? $contact->email : 'N/A' }}</a></span>
												</div>
												<div class="">
													<h3 class="d-inline-block"><u>Phone :</u>&nbsp;</h3>
													<span class="">{{ $contact->phone != null ? $contact->phone : 'N/A' }}</span>
												</div>
												<div class="">
													<h3 class="d-inline-block"><u>Family Members :</u>&nbsp;</h3>
													<span class="">Family of {{ $contact->family_size != null ? $contact->family_size : 1 }}</span>
												</div>
												<div class="">
													@php $dobFormat = new Carbon\Carbon($contact->dob); @endphp
													<h3 class="d-inline-block"><u>Birthday :</u>&nbsp;</h3>
													<span class="">DOB: {{ $contact->dob != null ? $dobFormat->toFormattedDateString() : 'N/A' }}</span>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col">
												<p class="text-center">{!! $contact->tenant == "Y" ? "<span class='oi oi-check text-success' title='icon name' aria-hidden='true'></span>" : "<span class='oi oi-x text-danger' title='icon name' aria-hidden='true'></span>" !!}&nbsp;Current Tenant</p>
											</div>
										</div>
									</div>
									@if(!$loop->last)
										<div class="col my-3">
											<h1 class="text-hide" style="border:1px solid #787878 !important">Hidden Text</h1>
										</div>
									@endif
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
		@if($settings->show_deletes == "Y")
			@if($deletedContacts->isNotEmpty())
				<div class="container-fluid">
					<div class="row">
						<div class="col">
							<div class="deleteDivider"></div>
						</div>
					</div>
					
				</div>
				<div class="row">
					<div class="col col-12">
						<h2 class="">Deleted Contacts</h2>
					</div>
					@foreach($deletedContacts as $deletedContact)
						<div class="col-12 col-sm-4">
							<div class="card">
								<div class="card-header">
									<h2 class="text-center">{{ $deletedContact->first_name . ' ' . $deletedContact->last_name}}
									</h2>
								</div>
								<div class="card-body">
									<ul class="propertyInfo">
										<li class="propertyItem">Email: {{ $deletedContact->email }}</li>
										<li class="propertyItem">Phone: {{ $deletedContact->phone }}</li>
									</ul>
								</div>
								<div class="card-footer text-center">
									<a class="btn btn-warning" href="/contact_restore/{{$deletedContact->id}}" class="">Restore</a>
								</div>
							</div>
						</div>
					@endforeach
				</div>
			@endif
		@endif
	</div>
@endsection

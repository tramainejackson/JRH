@extends('layouts.app')

@section('addt_script')
@endsection

@section('content')
	<div id="content_container" class="jumbotron jumbotron-fluid py-5 d-flex align-items-center contactsJumbotron">
		<div class="container-fluid py-5">
			<h2 class="py-5 text-white display-4">Growth and development of our communities are the core of our pursuit.</h2>
		</div>
	</div>
	<div class="container-fluid">
		@if(session('status'))
			<h2 class="flashMessage">{{ session('status') }}</h2>
		@endif
		<div class="row mb-5">
			<div class="col-12 col-md-8 col-lg-6 text-center mb-4 mx-auto">
				<div class="container-fluid">
				</div>
				<div class="container-fluid">
					{!! Form::open(['action' => 'ContactController@search', 'method' => 'POST', 'id' => 'search-form']) !!}
					{!! Form::close() !!}
					</div>
				</div>
			</div>
			
			@if($contacts->isNotEmpty())
				<div class="col-12">
					<div class="container-fluid">
						<div class="row">
							<h2 class="">Duplicates are checked by any email address entered more than once. Check to see if the information is the same before linking accounts or ignore it</h2>
						</div>
						
						<!-- Display for mobile screen -->
						<div class="row d-sm-none d-flex">
							@foreach($contacts as $contact)
								@php $getDupes = App\Contact::where('email', $contact->email)->get(); @endphp

								<ul class="">
									@foreach($getDupes as $dupe)
										<li class="">{{ $dupe->email }}</li>
									@endforeach
								</ul>
								
								<div class="col-md-6 col-12 contactList">
									<div class="card mb-3">
										<div class="card-header container-fluid d-sm-flex align-items-center">
											<a class="btn btn-warning d-block d-sm-inline float-sm-right mb-2 mb-sm-2" href="/contacts/{{ $contact->id }}/edit" class="">Edit</a>
											<h1 class="text-center col-sm-8 col-12 mr-auto">{{ $contact->first_name . ' ' . $contact->last_name }}</h1>
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
								@php $getDupes = App\Contact::where('email', $contact->email)->get(); @endphp

								@foreach($getDupes as $dupe)
									<ul class="w-100">
										<li class="d-inline">{{ $dupe->full_name() }}</li>
										<li class="d-inline">{{ $dupe->phone }}</li>
										<li class="d-inline">{{ $dupe->email }}</li>
										<li class="d-inline"><button class="btn" type="button">Link</button></li>
										<li class="d-inline"><button class="btn" type="button">Ignore</button></li>
									</ul>
								@endforeach
								
								<div class="col-12 contactList">
									<div class="container-fluid">
										<div class="row">
											<div class="col-4">
												<img src="{{ $contact->image != null ? asset(str_ireplace('public', 'storage', $contact->image->path)) : asset('images/empty_face.jpg') }}" class="img-fluid" />
											</div>
											<div class="col-8">
												<div class="d-flex align-items-center flex-column">
													<h1 class="text-center coolText1 display-3"><strong>{{ $contact->first_name . " " . $contact->last_name  }}</strong></h1>

													<a class="btn btn-warning" href="/contacts/{{ $contact->id }}/edit" class="">Edit</a>
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
				<div class="col-12">
					<h2 class="text-center">0 results found for following search criteria</h2>
					<h4 class="text-center">"{{ $searchCriteria }}"</h4>
				</div>
			@endif
		</div>
	</div>
@endsection

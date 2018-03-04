@extends('layouts.app')

@section('addt_style')
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
		<div class="row">
			@if($files->isNotEmpty())
				<div class="col-sm-3 col-12 text-center mb-4">
					<div class="container-fluid">
						<a href="/admin_files/create" class="btn btn-success d-block d-sm-inline">Add New File(s)</a>
						<p class="my-3"><i>Total Uploads:</i>&nbsp;<span class="text-muted">{{ $files->count() }}</span></p>
					</div>
					<div class="container-fluid">
						<div class="md-form">
							<label for="valueSearch">Search</label>
						</div>
						<div class="input-group mb-3">
							<input type="text" name="search" class="form-control valueSearch" placeholder="Files Search" />
							<div class="input-group-append">
								<span class="oi oi-magnifying-glass input-group-text"></span>
							</div>
						</div>
					</div>
				</div>
				<div class="col-sm-9 col-12">
					<div class="container-fluid">
					
						<!-- Display for mobile screen -->
						<div class="row d-sm-none d-flex">
							@foreach($files as $file)
								<div class="col-md-6 col-12">
									<div class="card mb-3">
										<div class="card-header container-fluid d-sm-flex align-items-center text-theme1 bg-theme2">
											<a class="btn btn-warning d-block d-sm-inline float-sm-right mb-2 mb-sm-2" href="/admin_files/{{ $file->id }}/edit" class="">Edit</a>
											<h2 class="text-center col-sm-8 col-12 mr-auto">{{ $file->first_name }}</h2>
										</div>
										<div class="card-body container-fluid bg-theme5">
											<div class="row">
												<span class="oi oi-person text-theme1 col-1 text-center" title="person" aria-hidden="true"></span>
												<span class="col-sm-11 col-10 text-theme1 text-truncate">{{ $file->first_name . " " . $file->last_name }}</span>
											</div>
											<div class="row">
												<span class="oi oi-envelope-closed text-theme1 col-1 text-center" title="envelope-closed" aria-hidden="true"></span>
												<span class="col-sm-11 col-10 text-theme1 text-truncate">{{ $file->email != null ? $file->email : 'N/A' }}</span>
											</div>
											<div class="row">
												<span class="oi oi-phone text-theme1 col-1 text-center" title="phone" aria-hidden="true"></span>
												<span class="col-sm-11 col-10 text-theme1 text-truncate">{{ $file->phone != null ? $file->phone : 'N/A' }}</span>
											</div>
											<div class="row">
												<span class="oi oi-people text-theme1 col-1 text-center" title="people" aria-hidden="true"></span>
												<span class="col-sm-11 col-10 text-theme1 text-truncate">Family of {{ $file->family_size != null ? $file->family_size : 1 }}</span>
											</div>
											<div class="row">
												@php $dobFormat = new Carbon\Carbon($file->dob); @endphp
												<span class="oi oi-calendar text-theme1 col-1 text-center" title="calendar" aria-hidden="true"></span>
												<span class="col-sm-11 col-10 text-theme1 text-truncate">DOB: {{ $file->dob != null ? $dobFormat->toFormattedDateString() : 'N/A' }}</span>
											</div>
										</div>
										<div class="card-footer text-theme1 bg-theme2">
											<p class="text-center">{!! $file->tenant == "Y" ? "<span class='oi oi-check text-success' title='icon name' aria-hidden='true'></span>" : "<span class='oi oi-x text-danger' title='icon name' aria-hidden='true'></span>" !!}&nbsp;Current Tenant</p>
										</div>
									</div>
								</div>
							@endforeach
						</div>
						
						<!-- Display for non-mobile screen -->
						<div class="row d-none d-sm-flex">
							@php $files = $files->groupBy('parent_doc'); @endphp
							@foreach($files->toArray() as $document)
								@php $contact = \App\Contact::where('id', $document[0]['contact_id'])->first(); @endphp
								@php $property = \App\Property::where('id', $document[0]['property_id'])->first(); @endphp
								<div class="col-12 fileList">
									<div class="container-fluid">
										<div class="row">
											<div class="col">
												<div class="d-flex align-items-center justify-content-between">
													<h1 class="text-center"><strong><em>{{ $document[0]['title'] }}</em></strong></h1>

													<a class="btn btn-warning" href="/admin_files/{{ $document[0]['id'] }}/edit" class="">Edit</a>
												</div>
											</div>
										</div>
										
										@foreach($document as $file)
											<div class="row">
												<div class="col ml-4 mb-3">
													<a href="{{ asset('storage/' . str_ireplace('public/', '', $file['name'])) }}" class="btn cyan darken-4 ml-3" download="{{ str_ireplace(' ', '_', $file['title']) }}">View Document {{ $loop->count > 1 ? $loop->iteration : ""}}</a>
												</div>
											</div>
										@endforeach
										
										<div class="row ml-4">
											<div class="col-12">
												<h3 class="m-0">Contact Association</h3>
												<div class="mb-3">
													@if($contact)
														<a href="/contacts/{{ $contact->id }}/edit" class="">{{ $contact->full_name() }}</a>
													@else
														<span class="">Not Associated To Any Contact</span>
													@endif
												</div>
											</div>
											<div class="col-12">
												<h3 class="m-0">Property Association</h3>
												<div class="mb-3">
													@if($property)
														<a href="/properties/{{ $property->id }}/edit" class="">{{ $property->address }}</a>
													@else
														<span class="">Not Associated To Any Property</span>
													@endif
												</div>
											</div>
										</div>
									</div>
								</div>
								@if(!$loop->last)
									<div class="col my-3">
										<h1 class="text-hide" style="border:1px solid #787878 !important">Hidden Text</h1>
									</div>
								@endif
							@endforeach
						</div>
					</div>
				</div>
			@else
				<div class="col">
					<h2 class="text-center">You haven't added any files yet</h2>
					<h4 class="text-center">Click <a href="/admin_files/create" class="">here</a> to add your first file/document</h4>
				</div>
			@endif
		</div>
		@if($settings->show_deletes == "Y")
		@endif
	</div>
@endsection

@extends('layouts.app')

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
				@php $files = $files->groupBy('parent_doc'); @endphp
				<div class="col-md-8 col-lg-12 col-xl-4 col-12 text-center mb-4 mx-auto">
					<div class="container-fluid">
						<a href="/admin_files/create" class="btn btn-success d-block d-sm-inline">Add New File(s)</a>
						<p class="my-3"><i>Total Uploads:</i>&nbsp;<span class="text-muted">{{ count($files->toArray()) }}</span></p>
					</div>
					<div class="container-fluid">
						<div class="md-form">
							<label for="valueSearch">Search</label>
						</div>
						<div class="input-group mb-3">
							<input type="text" name="search" class="form-control valueSearch" placeholder="Files Search" />
							<div class="input-group-append">
								<span class="input-group-text"><i class="fas fa-search"></i></span>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-12 col-lg-12 col-xl-8 col-12">
					<div class="container-fluid">
					
						<!-- Display for mobile screen -->
						<div class="row d-sm-none d-flex">
							@foreach($files->toArray() as $file)
								<div class="col-md-6 col-12 fileList">
									<div class="card mb-3">
										<div class="card-header container-fluid d-sm-flex align-items-center text-theme1 bg-theme2">
											<a class="btn btn-warning d-block d-sm-inline float-sm-right mb-2 mb-sm-2" href="/admin_files/{{ $file[0]['id'] }}/edit" class="">Edit</a>
											<h1 class="text-center col-sm-8 col-12 mr-auto">{{ $file[0]['title'] }}</h1>
										</div>
									</div>
								</div>
							@endforeach
						</div>
						
						<!-- Display for non-mobile screen -->
						<div class="row d-none d-sm-flex">
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

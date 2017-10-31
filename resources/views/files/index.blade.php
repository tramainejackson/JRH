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
			@if($files->isNotEmpty())
				<div class="col-sm-3 col-12 text-center mb-4">
					<div class="container-fluid">
						<a href="/admin_files/create" class="btn btn-success d-block d-sm-inline">Add New File(s)</a>
						<p class="my-3"><i>Total Uploads:</i>&nbsp;<span class="text-muted">{{ $files->count() }}</span></p>
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
							@foreach($files as $file)
								@php $file->name = explode('; ', $file->name); @endphp
								<div class="col-12 fileList">
									<div class="py-2">
										<div class="container-fluid mb-2">
											<div class="row">
												<div class="col-1">
													<a class="btn btn-warning d-block d-sm-inline mb-2 mb-sm-2 align-self-start" href="/admin_files/{{ $file->id }}/edit" class="">Edit</a>
												</div>
												<div class="col-10">
													<h2 class="text-center">{{ $file->title . " " . $file->last_name  }}</h2>
												</div>
												<div class="col-1">&nbsp;</div>
											</div>
										</div>
										<div class="container-fluid">
											<div class="row">
												<div class="col-xl-10 mx-auto text-center">
													@foreach($file->name as $document)
														<a href="{{ asset('storage/' . str_ireplace('public/', '', $document)) }}" class="ml-3{{ $loop->count > 1 ? ' d-inline' : ' d-block' }}" download="{{ str_ireplace(' ', '_', $file->title) }}">Document {{ $loop->count > 1 ? $loop->iteration : ""}}</a>
													@endforeach
												</div>
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
		@endif
	</div>
@endsection

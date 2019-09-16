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
					<h2 class="text-center">You haven't added any files yet</h2>
					<h4 class="text-center">Click <a href="/admin_files/create" class="">here</a> to add your first file/document</h4>
				</div>
			@endif
		</div>
		@if($settings->show_deletes == "Y")
		@endif
	</div>
@endsection

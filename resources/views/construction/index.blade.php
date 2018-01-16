@extends('layouts.app')

@section('addt_style')
@endsection

@section('content')
@if(Auth::check())
	<div id="" class="jumbotron jumbotron-fluid py-5 d-flex align-items-center constructionJumbotron">
		<div class="container-fluid py-5">
			<h2 class="py-5 text-white display-4">Growth and development of our communities are at the core of our pursuit.</h2>
		</div>
	</div>
	<div class="container-fluid">
		@if($properties->isNotEmpty())
			<div class="row">
				<div class="col-12 col-sm-3 mb-4 mb-sm-0 text-center">
					<div class="container-fluid">
						<a href="/properties/create" class="btn btn-success d-block d-sm-inline">Add New Property</a>
						<p class="my-3"><i>Total Properties:</i>&nbsp;<span class="text-muted">{{ $properties->count() }}</span></p>
					</div>
				</div>
				
				<!-- Display for mobile screen -->
				<div class="col-12 col-sm-9">
					<div class="container-fluid">
						<div class="row d-flex d-sm-none">
							@foreach($properties as $property)
								<div class="col-12 col-sm-6">
									<div class="card mb-3">
										<div class="card-header container-fluid d-sm-flex align-items-center text-theme5 bg-theme3">
											<a class="btn btn-warning d-block d-sm-inline float-sm-right mb-2 mb-sm-2" href="/properties/{{ $property->id }}/edit" class="" style="line-height:0.8;">Edit</a>
											<h2 class="text-center col-sm-8 col-12 mr-auto">{{ $property->address }}</h2>
										</div>
										<div class="card-body container-fluid bg-theme5">
											<div class="row">
												<span class="oi oi-basket text-theme1 col-1 text-center" title="icon name" aria-hidden="true"></span>
												<span class="col-sm-11 col-10 text-theme1 text-truncate">{{ $property->title }}</span>
											</div>
											<div class="row">
												<span class="oi oi-clipboard text-theme1 col-1 text-center" title="icon name" aria-hidden="true"></span>
												<span class="col-sm-11 col-10 text-theme1 text-truncate">{{ $property->description }}</span>
											</div>
											<div class="row">
												<span class="oi oi-home text-theme1 col-1 text-center" title="icon name" aria-hidden="true"></span>
												<span class="col-sm-11 col-10 text-theme1 text-truncate">{{ ucfirst($property->type) }}</span>
											</div>
											<div class="row">
												<span class="oi oi-dollar text-theme1 col-1 text-center" title="icon name" aria-hidden="true"></span>
												<span class="col-sm-11 col-10 text-theme1 text-truncate">${{ $property->price }}&nbsp;/per month</span>
											</div>
										</div>
										<div class="card-footer text-theme5 bg-theme3">
											<div class="container-fluid">
												<div class="row">
													<span class="col col-6 text-center">{!! $property->active == "Y" ? "<span class='oi oi-check text-success' title='icon name' aria-hidden='true'></span> Active" : "<span class='oi oi-x text-danger' title='icon name' aria-hidden='true'></span> Inactive" !!}</span>
													<span class="col-6 text-center">{!! $property->showcase == "Y" ? "<span class='oi oi-check text-success' title='icon name' aria-hidden='true'></span>" : "<span class='oi oi-x text-danger' title='icon name' aria-hidden='true'></span>" !!} Showcase</span>
												</div>
											</div>
										</div>
									</div>
								</div>
							@endforeach
						</div>
						
						<!-- Display for non-mobile screen -->
						<div class="row d-none d-sm-flex">
							@foreach($properties as $property)
								<div class="col-12 propertyList">
									<div class="py-2">
										<div class="container-fluid d-sm-flex align-items-center">
											<a class="btn btn-warning d-block d-sm-inline float-sm-right float-left mb-2 mb-sm-2" href="/properties/{{ $property->id }}/edit" class="">Edit</a>
											<h2 class="text-center col mx-auto">{{ $property->address }}</h2>
										</div>
										<div class="container">
											<div class="row justify-content-center">
												<span class="oi oi-basket text-theme1 col-1 text-center" title="icon name" aria-hidden="true"></span>
												<span class="col-3 text-truncate">{{ $property->title }}</span>
											</div>
											<div class="row justify-content-center">
												<span class="oi oi-clipboard col-1 text-center" title="icon name" aria-hidden="true"></span>
												<span class="col-3 text-truncate">{{ $property->description }}</span>
											</div>
											<div class="row justify-content-center">
												<span class="oi oi-home col-1 text-center" title="icon name" aria-hidden="true"></span>
												<span class="col-3 text-truncate">{{ ucfirst($property->type) }}</span>
											</div>
											<div class="row justify-content-center">
												<span class="oi oi-dollar text-theme1 col-1 text-center" title="icon name" aria-hidden="true"></span>
												<span class="col-3 text-theme1 text-truncate">${{ $property->price }}&nbsp;/per month</span>
											</div>
										</div>
										<div class="">
											<div class="container-fluid">
												<div class="row">
													<span class="col col-6 text-center">{!! $property->active == "Y" ? "<span class='oi oi-check text-success' title='icon name' aria-hidden='true'></span> Active" : "<span class='oi oi-x text-danger' title='icon name' aria-hidden='true'></span> Inactive" !!}</span>
													<span class="col-6 text-center">{!! $property->showcase == "Y" ? "<span class='oi oi-check text-success' title='icon name' aria-hidden='true'></span>" : "<span class='oi oi-x text-danger' title='icon name' aria-hidden='true'></span>" !!} Showcase</span>
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
			</div>
		@else
			<div class="row">
				<div class="col">
					<h2 class="text-center">You haven't added any properties yet</h2>
					<h4 class="text-center">Click <a href="/properties/create" class="">here</a> to create your first property</h4>
				</div>
			</div>
		@endif
	</div>
	@if($settings->show_deletes == "Y")
		@if($deletedProps->isNotEmpty())
			<div class="container-fluid">
				<div class="row">
					<div class="col">
						<div class="deleteDivider"></div>
					</div>
				</div>
				<div class="row">
					<div class="col col-12">
						<h2 class="">Deleted Properties</h2>
					</div>
					@foreach($deletedProps as $deletedProp)
						<div class="col-12 col-sm-4">
							<div class="card">
								<div class="card-header">
									<h2 class="text-center">{{ $deletedProp->address }}
									</h2>
								</div>
								<div class="card-body">
									<ul class="propertyInfo">
										<li class="propertyItem">{{ $deletedProp->description }}</li>
									</ul>
								</div>
								<div class="card-footer text-center">
									<a class="btn btn-warning" style="line-height:1.5" href="/property_restore/{{$deletedProp->id}}" class="">Restore</a>
								</div>
							</div>
						</div>
					@endforeach
				</div>
			</div>
		@endif
	@endif
@else
	<div id="" class="jumbotron jumbotron-fluid py-5 d-flex align-items-center constructionJumbotron"></div>
	<div class="container">
		@if($properties->isNotEmpty())
			<div class="row align-items-center">
				<h1 class="col-2 col-md-4 text-hide" style="border:1px solid #787878 !important">Hidden Text</h1>
				<h1 class="col-8 col-md-4 text-muted">Coming Soon</h1>
				<h1 class="col-2 col-md-4 text-hide" style="border:1px solid #787878 !important">Hidden Text</h1>
			</div>
			@foreach($properties as $property)
				<div class="row mt-4">
					<div class="col-12 my-3">
						<h2 class="text-center pt-3 pt-sm-0">{{ $property->title }}</h2>
					</div>
					
					@if($property->medias->count() < 1 && $property->videos->count() < 1)
						<div class="col-12">
							<h3 class="">There are no videos or pictures uploaded yet. Check back later for updates</h3>
						</div>
					@else
						<div class="col-2">
							<p class="text-muted"><i>Videos: {{ $property->videos->count() }}</i></p>
							<p class="text-muted"><i>Photos: {{ $property->medias->count() }}</i></p>
						</div>
						<div class="col-10">
							<div class="container-fluid my-2 mb-5">
								<div class="">
									<h2 class="">Videos</h2>
								</div>
								<div class="row">
									@foreach($property->videos as $video)
										<div class="col-4">
											<video poster="/images/jrh_logo_lg.png" controls>
												<source src="{{ asset('storage/' . str_ireplace('public/', '', $video->path)) }}">
												Your browser does not support the video tag.
											</video>
										</div>
									@endforeach
								</div>
							</div>
							
							<div class="container-fluid my-2">
								<div class="">
									<h2 class="my-3">Images</h2>
								</div>
								<div class="row">
									@foreach($property->medias as $media)
										<div class="col-3">
											<img src="{{ asset('storage/' . str_ireplace('public/', '', $media->path)) }}" class="img-thumbnail constructionImage" />
										</div>
									@endforeach
								</div>
							</div>
						</div>
					@endif
				</div>
				<div class="row align-items-center">
					<h1 class="col text-hide my-5" style="border:1px solid #787878 !important">Hidden Text</h1>
				</div>
			@endforeach
		@else
			<div class="row">
				<div class="col">
					<h2 class="text-center">No properties have been added yet</h2>
				</div>
			</div>
		@endif
	</div>
@endif
@endsection

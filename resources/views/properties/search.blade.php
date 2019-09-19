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
					<a href="/properties/create" class="btn btn-success d-block d-sm-inline">Add New Property</a>
					<a href="/properties/" class="btn btn-success d-block d-sm-inline">All Properties</a>

					<p class="my-3"><i>Total Propertys:</i>&nbsp;<span class="text-muted">{{ $propertiesCount }}</span></p>
				</div>
				<div class="container-fluid">
					{!! Form::open(['action' => 'PropertyController@search', 'method' => 'POST', 'id' => 'search-form']) !!}
					<div class="md-form input-group">
						<div class="input-group-btn">
							<a href="{{ route('properties.index') }}" class="btn btn-outline-warning searchBtn">Clear</a>
						</div>

						<input type="text" name="search" class="form-control valueSearch" value="{{ $searchCriteria }}" placeholder="Propertys Search" />

						<div class="input-group-btn">
							<button class="btn btn-outline-success searchBtn" type="button" onclick="event.preventDefault(); document.getElementById('search-form').submit();">
								<i class="fa fa-search" aria-hidden="true"></i>
							</button>
						</div>
						{!! Form::close() !!}
					</div>
				</div>
			</div>

			@if($properties->isNotEmpty())
				<div class="col-12">
					<div class="container-fluid">
						<div class="row">
							<div class="col-12 mb-3">
								<h2 class="text-center">{{ $properties->count() }} results found for following search criteria</h2>
								<h4 class="text-center">"{{ $searchCriteria }}"</h4>
							</div>
						</div>

						<!-- Display for mobile screen -->
						<div class="row d-sm-none d-flex">
							@foreach($properties as $property)
								<div class="col-md-6 col-12 contactList">
									<div class="card mb-3">

										<div class="card-header container-fluid d-sm-flex align-items-center">
											<a class="btn btn-warning d-block d-sm-inline float-sm-right mb-2 mb-sm-2" href="/properties/{{ $property->id }}/edit" class="" style="line-height:0.8;">Edit</a>
											<h1 class="text-center col-sm-8 col-12 mr-auto">{{ $property->address }}</h1>
										</div>

										<div class="card-body container-fluid bg-theme5">

											<div class="row">
												<span class="oi oi-clipboard text-theme1 col-1 text-center" title="icon name" aria-hidden="true"></span>
												<span class="col-sm-11 col-10 text-theme1 text-truncate">{{ $property->description }}</span>
											</div>

											<div class="row">
												<i class="fas fa-clipboard-list"></i>
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

								@php $homeImage = $property->medias()->where('default_photo', 'Y')->first();

                                        if($property->medias()->first()) {

                                            if($homeImage != null) {

                                                if(file_exists(str_ireplace('public', 'storage', $homeImage->path))) {

                                                    $homeImage = str_ireplace('public', 'storage', $homeImage->path);

                                                } else {

                                                    $homeImage = '/images/empty_prop_3.png';

                                                }

                                            } else {

                                                $homeImage = $property->medias()->first();

                                                if(file_exists(str_ireplace('public', 'storage', $homeImage->path))) {

                                                    $homeImage = str_ireplace('public/', 'storage/', asset($homeImage->path));

                                                } else {

                                                    $homeImage = '/images/empty_prop_3.png';

                                                }
                                            }
                                        } else {

                                            $homeImage = '/images/empty_prop_3.png';
                                        }

								@endphp

								<div class="col-12 py-2 propertyList">
									<div class="container-fluid">
										<div class="row">
											<div class="col-md-8 col-lg-4 mx-auto text-center">
												<img src="{{ $homeImage }}" class="img-fluid" />
											</div>
											<div class="col-md-12 col-lg-8">
												<div class="d-flex align-items-center flex-column">
													<span class="red-text">${{ $property->price }}&nbsp;/per month</span>

													<h1 class="text-center mx-auto">{{ $property->address }}</h1>

													<a class="btn btn-warning" href="/properties/{{ $property->id }}/edit" class="">Edit</a>
												</div>

												<div class="py-2">
													<h3 class=""><u>Type :</u></h3>
													<span class="">{{ ucfirst($property->type) }}</span>
												</div>

												<div class="py-2">
													<h3 class=""><u>Description :</u></h3>
													<span class="">{{ nl2br($property->description) }}</span>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-lg-4 col-md-8 mx-lg-0 mx-md-auto">
												<div class="row">
													<span class="col col-6 text-center">{!! $property->active == "Y" ? "<i class='fas fa-check-circle text-success'></i> Active" : "<i class='fas fa-times-circle text-danger'></i> Inactive" !!}</span>
													<span class="col-6 text-center">{!! $property->showcase == "Y" ? "<i class='fas fa-check-circle text-success'></i>" : "<i class='fas fa-times-circle text-danger'></i>" !!} Showcase</span>
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
				<div class="col-12">
					<h2 class="text-center">0 results found for following search criteria</h2>
					<h4 class="text-center">"{{ $searchCriteria }}"</h4>
				</div>
			@endif
		</div>

		@if($settings->show_deletes == "Y")
			@if($deletedProperties->isNotEmpty())
				<div class="container-fluid">
					<div class="row">
						<div class="col">
							<div class="deleteDivider"></div>
						</div>
					</div>

				</div>
				<div class="row">
					<div class="col col-12">
						<h2 class="">Deleted Properties</h2>
					</div>
					@foreach($deletedProperties as $deletedProperty)
						<div class="col-12 col-sm-4">
							<div class="card">
								<div class="card-header">
									<h2 class="text-center">{{ $deletedProperty->address }}
									</h2>
								</div>
								<div class="card-body">
									<ul class="propertyInfo">
										<li class="propertyItem">{{ $deletedProperty->description }}</li>
									</ul>
								</div>
								<div class="card-footer text-center">
									<a class="btn btn-warning" style="line-height:1.5" href="/property_restore/{{$deletedProperty->id}}" class="">Restore</a>
								</div>
							</div>
						</div>
					@endforeach
				</div>
			@endif
		@endif
	</div>
@endsection
@extends('layouts.app')

@section('content')

	@if(Auth::check())

		<div id="content_container" class="jumbotron jumbotron-fluid d-flex align-items-center propertiesJumbotron"></div>

		<div class="container-fluid">

			@if(session('status'))
				<h2 class="flashMessage">{{ session('status') }}</h2>
			@endif

			@if($properties->isNotEmpty())
				<div class="row">
					<div class="col-12 col-md-8 col-xl-4 mb-4 mb-sm-0 text-center mx-auto">
						<div class="container-fluid">
							<a href="/properties/create" class="btn btn-success d-block d-sm-inline">Add New Property</a>
							<p class="my-3"><i>Total Properties:</i>&nbsp;<span class="text-muted">{{ $properties->count() }}</span></p>
						</div>
						<div class="container-fluid">
							{!! Form::open(['action' => 'PropertyController@search', 'method' => 'POST', 'id' => 'search-form']) !!}
								<div class="md-form input-group">
									<input type="text" name="search" class="form-control valueSearch" value="{{ request()->query('search') ? request()->query('search') : '' }}" placeholder="Properties Search" />

									<div class="input-group-btn">
										<button class="btn btn-outline-success searchBtn" type="button" onclick="event.preventDefault(); document.getElementById('search-form').submit();">
											<i class="fa fa-search" aria-hidden="true"></i>
										</button>
									</div>
								</div>
							{!! Form::close() !!}
						</div>
					</div>

					<div class="col-12 col-md-12 col-xl-8">
						<div class="container-fluid">

							<!-- Display for mobile screen -->
							<div class="row d-flex d-sm-none">
								@foreach($properties as $property)
									<div class="col-12 col-sm-6 propertyList">

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

		<div id="content_container" class="jumbotron jumbotron-fluid py-5 d-flex align-items-center propertiesJumbotron"></div>

		<div class="container-fluid">
			<div class="row align-items-center justify-content-center mb-5">
				<div class="">
					<p class="my-3 px-3"><i>Total Properties {{ request()->query('sale') !== null ? request()->query('sale') == 'sale' ? 'for Sale' : 'for Rent' : '' }}:</i>&nbsp;<span class="text-muted">{{ $properties->count() }}</span></p>
				</div>

				<div class="flex-grow-1 text-center mx-5">
					<div class="card-deck flex-column flex-md-row" id="">
						<div class="card mb-3 mb-md-0" id="">
							<button class='btn btn-lg darken-1 btn-block m-0 {{ request()->query('sale') == null ? 'btn-success' : 'btn-mdb-color' }}' type='button'><a class="white-text" href="{{ route('properties.index') }}">&nbsp;&nbsp;&nbsp;&nbsp;All Properties&nbsp;&nbsp;&nbsp;&nbsp;</a></button>
						</div>
						<div class="card mb-3 mb-md-0" id="">
							<button class='btn btn-lg darken-1 btn-block m-0 {{ request()->query('sale') !== null && request()->query('sale') == 'sale' ? 'btn-success' : 'btn-mdb-color' }}' type='button'><a class="white-text" href="{{ route('properties.index') . '?sale=sale' }}">Properties For Sale</a></button>
						</div>
						<div class="card mb-3 mb-md-0" id="">
							<button class='btn btn-lg lighten-1 btn-block m-0 {{ request()->query('sale') !== null && request()->query('sale') == 'rent' ? 'btn-success' : 'btn-mdb-color' }}' type='button'><a class="white-text" href="{{ route('properties.index') . '?sale=rent' }}">Properties For Rent</a></button>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="container">
			@if($properties->isNotEmpty())

				@foreach($properties as $property)

					@if($property->active == 'Y')

						@php
							$defaultPic = $property->medias()->where('default_photo', 'Y')->first();

							if($property->medias()->first()) {

								if($defaultPic != null) {

									if(file_exists(str_ireplace('public', 'storage', $defaultPic->path))) {

										$image = str_ireplace('public/images', 'storage/images/sm', $defaultPic->path);

									} else {

										$image = '/images/empty_prop_3.png';

									}

								} else {

									$image = $property->medias()->first();

									if(file_exists(str_ireplace('public', 'storage', $image->path))) {

										$image = str_ireplace('public/images', 'storage/images/sm', asset($image->path));

									} else {

										$image = '/images/empty_prop_3.png';

									}
								}
							} else {

								$image = '/images/empty_prop_3.png';
							}
						@endphp

						<div class="row mt-4 align-items-center">
							<div class="col-12 order-1 col-md-5 text-center">
								<img class="img-fluid mx-auto" alt="Property Image" style="width: 100%; height: 400px;" src="{{ $image }}">
							</div>
							<div class="col-12 col-md-6 order-2 ml-auto">
								<div class="">
									<h2 class="text-center text-sm-left pt-3 pt-sm-0{{ $property->active == 'N' ? ' text-muted' : ' text-theme3' }}">{{ $property->active == 'N' ? ' Inactive - ' : '' }}{{ $property->address }}</h2>
								</div>
								<div class="">
									<p class="lead">{{ $property->price != null ? '$' . $property->price : 'Call for Pricing' }}&nbsp;{{ $property->sale == 'rent' ? '/per month' : '' }}</p>
									<span class="text-danger"><i>*Price Subject to Change</i></span>
								</div>
								<hr/>
								<div class="">
									<h4 class="text-left text-muted pb-2">{{ ucwords($property->type) }}</h4>
								</div>
								<div class="">
									<p>{{ $property->description }}</p>
								</div>
								<div class="">
									<a href="/properties/{{ $property->id }}/" class="btn blue-grey white-text btn-lg ml-0 d-block d-sm-inline{{ $property->active == 'N' ? ' disabled' : '' }}" >View Details</a>
								</div>
							</div>
						</div>
						<div class="row align-items-center">
							<h1 class="col text-hide my-5" style="border:1px solid #787878 !important">Hidden Text</h1>
						</div>
					@endif
				@endforeach
			@else

				<div class="row">
					<div class="col">
						<h2 class="text-center">There are no current properties available {{ request()->query('sale') !== null ? 'for ' . request()->query('sale') . '.' : '.' }}</h2>
					</div>
				</div>
			@endif
		</div>
	@endif
@endsection
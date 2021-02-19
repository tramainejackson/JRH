@extends('layouts.app')

@section('addt_style')
		<style>
			@if($tenant)
				.card-body:not(.testimonial-body) {
					background: linear-gradient(grey -70%, transparent, transparent);
				}
			@endif

			.navbar.fixed-top.navbar-expand-lg.scrolling-navbar.double-nav {
				background-color: #243a51 !important;
			}
		</style>
@endsection

@section('content')

	<div class="container-fluid mt-5 py-5" id="">

		<div class="row">

			<div class="col-12 col-md-12 col-lg-12 col-xl-4 text-center">
				<div class="container-fluid">
					<a href="/properties/create" class="btn btn-success btn-block mt-2">Add New Property</a>

					<a href="/properties" class="btn btn-success btn-block mt-2">All Properties</a>

					<button class="btn btn-primary btn-block mt-2" type="button" data-toggle="modal" data-target="#showing_modal">Add Showing</button>

					<button class="btn btn-danger btn-block mt-2 deleteBtn" type="button" data-toggle="modal" data-target="#delete_modal">Delete Property</button>

					@if($tenant)
						<button class="btn orange darken-2 btn-block mt-2 tenantBtn" type="button" data-toggle="modal" data-target="#remove_tenant_modal">Remove Tenant</button>
					@endif

					@if($allShowings->isNotEmpty())
					<!-- Card -->
						<div class="card card-image mt-4" style="background-image: url('{{ asset('/images/showings_calendar.jpg') }}'); background-color: black;">
							<!-- Card Content -->
							<div class="text-white text-center d-flex align-items-center justify-content-center rgba-black-strong py-5 px-2">
								<div class="">
									<h3 class="card-title pt-2">Upcoming Showings</h3>

									@if($upcomingShowings->isNotEmpty())
										@foreach($upcomingShowings as $upcomingShowing)
											@php $showDate = new Carbon\Carbon($upcomingShowing->show_date); @endphp
											<p class="">{{ $showDate->format('l F jS\\, Y') }}</p>
										@endforeach
									@else
										<p class="">No upcoming showings within the next 2 weeks</p>
									@endif

									<a href="/calendar" class="btn btn-pink"><i class="fa fa-clone left"></i> All showings</a>
								</div>
							</div>
							<!-- /Card Content -->
						</div>
						<!-- /Card -->
					@endif
				</div>
			</div>
			<div class="col-12 col-md-12 col-lg-8 col-lg-12 col-xl-8 mx-auto">
				<div class="container-fluid">
					<div class="row">
						<div class="col">
							<div class="card mt-2">

								<div class="card-header">
									<h2 class="">Edit Property</h2>
								</div>

								<div class="card-body">

									{!! Form::model($property, ['action' => ['PropertyController@update', $property->id], 'method' => 'PATCH', 'files' => true, 'class' => 'property_edit_form']) !!}

										@if($tenant)
											<div class="media flex-wrap" style="">
												<img src="{{ asset($tenant->image ? str_ireplace('public', 'storage', $tenant->image->path) : 'images/empty_face.jpg') }}" class="d-flex align-self-start mr-3" alt="Generic placeholder image" />
												<div class="media-body">
													<h4 class="mt-0 font-weight-bold"><a href="/contacts/{{ $tenant->id }}/edit">{{ $tenant->first_name . " " . $tenant->last_name }}</a></h4>
													<p class="m-1"><u>Phone:</u>&nbsp;{{ $tenant->phone != null ? $tenant->phone : 'N/A' }}</p>
													<p class="m-1"><u>Email:</u>&nbsp;{{ $tenant->email != null ? $tenant->email : 'N/A' }}</p>
												</div>
												<div class="d-flex">
													<p class="">Current Tenant</p>
												</div>
											</div>
										@endif

										<div class="form-block">
											<h2 class="form-block-header">Info</h2>

											<div class="form-row">
												<div class="form-group col-6">
													{{ Form::label('bed', '#Beds', ['class' => 'form-control-label']) }}
													<input type="number" name="bed" class="form-control" value="{{ $property->bed }}" placeholder='Total Beds' min="1" />

													@if ($errors->has('bed'))
														<span class="text-danger">Number of beds cannot be empty</span>
													@endif
												</div>
												<div class="form-group col-6">
													{{ Form::label('bath', '#Baths', ['class' => 'form-control-label']) }}
													<input type="text" name="bath" class="form-control" value="{{ $property->bath }}" placeholder='Total Baths' min="1" />

													@if ($errors->has('bath'))
														<span class="text-danger">Number of baths cannot be empty</span>
													@endif
												</div>
											</div>
											<div class="form-group">
												{{ Form::label('address', 'Address', ['class' => 'form-control-label']) }}
												<input type="text" name="address" class="form-control" value="{{ $property->address }}" />

												@if ($errors->has('address'))
													<span class="text-danger">Address cannot be empty</span>
												@endif
											</div>
											<div class="form-row">
												<div class="form-group col-12 col-sm-5">
													{{ Form::label('city', 'City', ['class' => 'form-control-label']) }}
													<input type="text" name="city" class="form-control" value="{{ $property->city }}" placeholder='City' />

													@if ($errors->has('city'))
														<span class="text-danger">City cannot be empty</span>
													@endif
												</div>
												<div class="form-group col-6 col-sm-3">
													{{ Form::label('state', 'State', ['class' => 'form-control-label']) }}

													<select class="custom-select browser-default w-100" name="state" style="height:initial;">
														@foreach($states as $state)
															<option value="{{ $state->state }}" {{ $state->state == $property->state ? 'selected' : '' }}>{{ $state->state }}</option>
														@endforeach
													</select>
												</div>
												<div class="form-group col-6 col-sm-4">
													{{ Form::label('zip', 'Zip Code', ['class' => 'form-control-label']) }}
													<input type="text" name="zip" class="form-control" value="{{ $property->zip }}" placeholder='Zip Code' />

													@if ($errors->has('zip'))
														<span class="text-danger">Zip code cannot be empty</span>
													@endif
												</div>
											</div>

											<div class="form-group">
												{{ Form::label('description', 'Description', ['class' => 'form-control-label']) }}
												<textarea name="description" class="form-control" row="3" style="height:auto">{{ $property->description }}</textarea>

												@if ($errors->has('description'))
													<span class="text-danger">Description cannot be empty</span>
												@endif
											</div>

											<div class="form-group">
												{{ Form::label('price', 'Price', ['class' => 'form-control-label']) }}
												<div class="input-group">
													<div class="input-group-prepend">
														<span class="input-group-text">$</span>
													</div>
													<input type="number" name="price" class="form-control" value="{{ $property->price }}" step="0.01" />
													<div class="input-group-append">
														<span class="input-group-text">/per month</span>
													</div>
												</div>
											</div>

											<div class="form-group">
												{{ Form::label('move_in_price', 'Total Move In Price', ['class' => 'form-control-label']) }}
												<div class="input-group">
													<div class="input-group-prepend">
														<span class="input-group-text">$</span>
													</div>
													<input type="number" name="move_in_price" class="form-control" value="{{ $property->move_in_cost }}" step="0.01" placeholder="Move In Cost" />
												</div>
											</div>

											<div class="form-group">
												<div class="md-form md-outline input-with-post-icon datepicker">
													<input type="text" name="available_date" id="available_date" data-value="{{ $startDate->format('m/d/Y') }}" value="{{ $startDate->format('m/d/Y') }}" class="form-control" placeholder="Add Available Start Date" />
													<label for="available_date" class="propShowingDate">Available Date: </label>

													<i class="fas fa-calendar input-prefix" tabindex=0></i>
												</div>
											</div>

											<div class="form-row">
												<div class="form-group col-12 mb-0">
													{{ Form::label('type', 'Tenant Utilities', ['class' => 'd-block form-control-label']) }}
												</div>

												<div class="form-group col-4">
													<button type="button" class="btn propUtilSwitch w-100{{ substr_count($property->included_utl, 'water') >= 1 ? ' active btn-success' : ' btn-blue-grey' }}">
														<input type="checkbox" name="included_utl[]" value="water" {{ substr_count($property->included_utl, 'water') >= 1 ? 'checked' : '' }} hidden />Water
													</button>
												</div>
												<div class="form-group col-4">
													<button type="button" class="btn propUtilSwitch w-100{{ substr_count($property->included_utl, 'gas') >= 1 ? ' active btn-success' : ' btn-blue-grey' }}">
														<input type="checkbox" name="included_utl[]" value="gas" {{ substr_count($property->included_utl, 'gas') >= 1 ? 'checked' : '' }} hidden />Gas
													</button>
												</div>
												<div class="form-group col-4">
													<button type="button" class="btn propUtilSwitch w-100{{ substr_count($property->included_utl, 'electricity') >= 1 ? ' active btn-success' : ' btn-blue-grey' }}">
														<input type="checkbox" name="included_utl[]" value="electricity" {{ substr_count($property->included_utl, 'electricity') >= 1 ? 'checked' : '' }} hidden />Electricity
													</button>
												</div>
											</div>

											<div class="form-row">
												<div class="form-group col-12">
													{{ Form::label('type', 'Type', ['class' => 'd-block form-control-label']) }}

													<div class="d-block d-sm-inline">
														<button type="button" class="btn w-100 aptBtn{{ $property->type == 'apartment' ? ' active btn-success' : ' btn-blue-grey' }}">
															<input type="checkbox" name="type" value="apartment" {{ $property->type == 'apartment' ? 'checked' : '' }} hidden />Apartment
														</button>
													</div>
													<div class="d-block d-sm-inline">
														<button type="button" class="btn w-100 mt-2 mt-sm-0 px-3 houseBtn{{ $property->type == 'house' ? ' active btn-success' : ' btn-blue-grey' }}">
															<input type="checkbox" name="type" value="house" {{ $property->type == 'house' ? 'checked' : '' }} hidden />House
														</button>
													</div>
												</div>
											</div>

											<div class="form-row">
												<div class="form-group col-12">
													{{ Form::label('type', 'Rent/Sale', ['class' => 'd-block form-control-label']) }}

													<div class="d-block d-sm-inline">
														<button type="button" class="btn w-100 rentBtn{{ $property->sale == 'rent' ? ' active btn-success' : ' btn-blue-grey' }}">
															<input type="checkbox" name="sale" value="rent" {{ $property->sale == 'rent' ? 'checked' : '' }} hidden />Rent
														</button>
													</div>
													<div class="d-block d-sm-inline">
														<button type="button" class="btn w-100 mt-2 mt-sm-0 px-3 saleBtn{{ $property->sale == 'sale' ? ' active btn-success' : ' btn-blue-grey' }}">
															<input type="checkbox" name="sale" value="sale" {{ $property->sale == 'sale' ? 'checked' : '' }} hidden />Sale
														</button>
													</div>
												</div>
											</div>

											<div class="form-group">
												{{ Form::label('active', 'Active', ['class' => 'd-block form-control-label']) }}

												<div class="btn-group">
													<button type="button" class="btn activeYes activeProp{{ $property->active == 'Y' ? ' btn-success active' : ' btn-blue-grey' }}">
														<input type="checkbox" name="active" value="Y" hidden {{ $property->active == 'Y' ? 'checked' : '' }} />Yes
													</button>
													<button type="button" class="btn activeNo activeProp{{ $property->active == 'N' ? ' btn-danger active' : ' btn-blue-grey' }}">
														<input type="checkbox" name="active" value="N" {{ $property->active == 'N' ? 'checked' : '' }} hidden />No
													</button>
												</div>
											</div>
											<div class="form-group">
												{{ Form::label('construction', 'Under Construction', ['class' => 'd-block form-control-label']) }}

												<div class="btn-group">
													<button type="button" class="btn activeUnderConstr underConstr{{ $property->construction == 'Y' ? ' btn-success active' : ' btn-blue-grey' }}">
														<input type="checkbox" name="construction" value="Y" hidden {{ $property->construction == 'Y' ? 'checked' : '' }} />Yes
													</button>
													<button type="button" class="btn noUnderConstr  underConstr{{ $property->construction == 'N' ? ' btn-danger active' : ' btn-blue-grey' }}">
														<input type="checkbox" name="construction" value="N" {{ $property->construction == 'N' ? 'checked' : '' }} hidden />No
													</button>
												</div>
											</div>
											<div class="form-group">
												{{ Form::label('showcase', 'Showcase', ['class' => 'd-block form-control-label']) }}

												<div class="btn-group">
													<button type="button" class="btn{{ $property->showcase == 'Y' ? ' btn-success active' : ' btn-blue-grey' }}">
														<input type="checkbox" name="showcase" value="Y" {{ $property->showcase == 'Y' ? 'checked' : '' }} hidden />Yes
													</button>
													<button type="button" class="btn{{ $property->showcase == 'N' ? ' btn-danger active' : ' btn-blue-grey' }}">
														<input type="checkbox" name="showcase" value="N" {{ $property->showcase == 'N' ? 'checked' : '' }} hidden />No
													</button>
												</div>
											</div>
										</div>
										<div class="form-block">
											<h2 class="form-block-header">Requirements</h2>

											<button class="btn blue mx-0 addRequirementBtn white-text" type="button"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Add A Requirement</button>

											<div class="form-group">
												@if($property->requirements->isNotEmpty())
													@foreach($property->requirements as $requirement)
														<div class="input-group mb-1 animated">
															<input type="number" name="requirement_id[]" class="hidden" value="{{ $requirement->id }}" hidden />
															<textarea type="text" name="update_requirements[]" class="form-control">{{ $requirement->instructions }}</textarea>

															<div class="input-group-append">
																<span class="input-group-text">
																	<button class="btn btn-outline-danger deleteRequirement" type="button">Delete</button>
																</span>
															</div>
														</div>
													@endforeach
												@else
													<p class="">There are no requirements added for this property</p>
											@endif

											<!-- Default row for requirements -->
												<div class="input-group mb-1" style="display:none;">
													<textarea name="requirements[]" class="form-control" placeholder="Enter Requirement Instructions" ></textarea>

													<div class="input-group-append">
														<span class="input-group-text">
															<button class="btn btn-outline-danger removeRequirement" type="button">Delete</button>
														</span>
													</div>
												</div>
											</div>
										</div>

										<div class="form-block mediaBlock">
											<h2 class="form-block-header">Media</h2>

											<div class="form-group">
												{{ Form::label('media', 'Media - select choose file to add pictures/videos', ['class' => 'd-block mw-100 custom-file text-muted']) }}
												<div class="input-group mb-3">
													<div class="input-group-prepend">
														<span class="input-group-text">Upload</span>
													</div>
													<div class="custom-file">
														<input type="file" name="media[]" id="upload_photo_input" class="custom-file-input" value="" multiple />
														<label class="custom-file-label text-truncate" for="upload_photo_input">Add Property Photos/Videos</label>
													</div>
												</div>
											</div>

											@if($property->medias->isNotEmpty())

												<div class="container-fluid my-4">

													<div class="row">
														<div class="col">
															<h3 class="text-center">Pictures</h3>
														</div>
													</div>

													<div class="row">

														@foreach($property->medias as $media)

															<div class="col-12 col-md-6 col-lg-4 deletePropImages">
																<div class="form-check">
																	<input type="checkbox" name="remove_image[]" id="filledInCheckbox{{$loop->iteration}}" class="form-check-input filled-in" value="{{ $media->id }}" />
																	<label class="form-check-label" for="filledInCheckbox{{$loop->iteration}}"></label>
																</div>

																<div class="view">
																	<img src="{{ asset($media->path) }}" class="img-fluid img-thumbnail media-modal-item mw-100 mx-auto" />
																	<div class="mask flex-center rgba-black-strong invisible" style="">
																		<p class="white-text">Remove</p>
																	</div>
																</div>

																@if($media->default_photo == 'Y')
																	<button type="button" class="m-0 p-0 w-100 btn btn-success">Default</button>
																@else
																	<button type="button" class="m-0 p-0 w-100 btn btn-primary makeDefault">Make Default</button>
																@endif
															</div>
														@endforeach
													</div>
												</div>
											@endif

											@if($property->videos->isNotEmpty())
												<div class="container-fluid my-1">
													<div class="row">
														<div class="col">
															<h3 class="text-center">Videos</h3>
														</div>
													</div>
													<div class="row">
														@foreach($property->videos as $video)
															<div class="col-12 col-md-12 col-lg-6 deletePropVideos">
																<div class="form-check">
																	<input type="checkbox" name="remove_video[]" id="filledInVidCheckbox{{$loop->iteration}}" class="form-check-input filled-in" value="{{ $video->id }}" />
																	<label class="form-check-label" for="filledInVidCheckbox{{$loop->iteration}}"></label>
																</div>

																<div class="view">
																	<video poster="/images/jrh_logo_lg.png" controls>
																		<source src="{{ asset('storage/' . str_ireplace('public/', '', $video->path)) }}">
																		Your browser does not support the video tag.
																	</video>
																	<div class="mask flex-center rgba-black-strong invisible" style="">
																		<p class="white-text">Remove</p>
																	</div>
																</div>
															</div>
														@endforeach
													</div>
												</div>
											@endif
											<div class="uploadsView">
												<div class="container-fluid">
													<div class="row"></div>
												</div>
												<h2 class="text-light invisible">Preview Uploads</h2>
											</div>
										</div>
										<div class="form-group">

											<button class="btn-block btn btn-danger removeMediaBtn" type="button" data-toggle="modal" data-target="#property_media" style="display:none;">Remove Selected Media Items</button>

											<button class="btn-block btn btn-primary" type="submit">Save Changes</button>

										</div>
									{!! Form::close() !!}
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		@include('modals.delete_property')
		@include('modals.delete_property_media')
		@include('modals.new_property_showing')

		@if($tenant)
			@include('modals.delete_property_tenant')
		@endif
	</div>
@endsection
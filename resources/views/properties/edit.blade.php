@extends('layouts.app')

@section('addt_style')
	@if($tenant)
		<style>
			.card-body:not(.testimonial-body) {
				background: linear-gradient(grey -70%, transparent, transparent);
			}
		</style>
	@endif
@endsection

@section('content')
	<div class="container-fluid" id="content_container">

		@if(session('status'))
			<h2 class="flashMessage">{{ session('status') }}</h2>
		@endif

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
											{{ Form::label('available_date', 'Available Date', ['class' => 'form-control-label']) }}
											<input type="text" name="available_date" id="datetimepicker" class="form-control" value="{{ $startDate->format('m/d/Y') }}"  placeholder="Add Available Start Date" />
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
									<div class="form-block">
										<h2 class="form-block-header">Documents</h2>

										<div class="form-group">
											@if($documents->isNotEmpty())
												@php
													$documents = $documents->groupBy('parent_doc');
												@endphp
												@foreach($documents->toArray() as $document)
													@foreach($document as $file)
														@if($loop->first)
															<p class="ml-3 mt-3 mb-0">{{ $file['title'] }}</p>
														@endif
														<a href="{{ asset(str_ireplace('public', 'storage', $file['name'])) }}" class="btn cyan darken-4 ml-5" download="{{ str_ireplace(' ', '_', $file['title']) }}">View Document {{ $loop->count > 1 ? $loop->iteration : ""}}</a>
													@endforeach
												@endforeach
											@else
												<span class="text-muted">No documents added for this contact</span>
											@endif
										</div>
										<div class="input-group mb-3">
											<div class="input-group-prepend">
												<span class="input-group-text">Upload</span>
											</div>
											<div class="custom-file">
												<input type="file" name="document[]" id="contact_document" class="custom-file-input" value="" multiple />
												<label class="custom-file-label text-truncate" for="upload_photo_input">Add Document(s) For Property</label>
											</div>
										</div>
										<div class="form-group">
											<div class="input-group mb-3">
												<div class="input-group-prepend">
													<span class="input-group-text">Document Title</span>
												</div>
												<input type="text" name="document_title" class="form-control" value="{{ old('document_title') }}" placeholder="Add Document Title" required disabled />
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
																<img src="{{ asset('storage/' . str_ireplace('public/', '', $media->path)) }}" class="img-fluid img-thumbnail media-modal-item mw-100 mx-auto" />
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
		<div class="row">
			<div class="modal fade" id="delete_modal" role="dialog" aria-hidden="true" tabindex="1">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Confirm Delete</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>

						<div class="modal-body text-dark">
							<div class="" id="">
								<p class="note note-danger">This will remove all images, videos, documents, showings, requirements, and tenants associates with this property</p>
							</div>

							{!! Form::model($property, ['action' => ['PropertyController@destroy', $property->id], 'method' => 'DELETE']) !!}
							<div class="form-group">
								<label class="form-control-label">Address</label>
								<input type="email" class="form-control" value="{{ $property->address }}" disabled />
							</div>

							<div class="form-group">
								<label class="form-control-label">City</label>
								<input type="text" class="form-control" value="{{ $property->city }}" disabled />
							</div>

							<div class="form-row">
								<div class="form-group col-6">
									<label class="form-control-label">State</label>
									<input type="text" class="form-control" value="{{ $property->state }}" disabled />
								</div>
								<div class="form-group col-6">
									<label class="form-control-label">Zip</label>
									<input type="text" class="form-control" value="{{ $property->zip }}" disabled />
								</div>
							</div>

							<div class="form-group align-items-center d-flex justify-content-center">

								<button class="btn btn-danger" type="submit">Delete</button>

								<button class="btn btn-warning cancelBtn" type="button">Cancel</button>

							</div>
							{!! Form::close() !!}
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="modal fade" id="property_media" role="dialog" aria-hidden="true" tabindex="1">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h3 class="modal-title" id="exampleModalLabel">Delete Property Media</h3>
							<button type="button" class="close dismissProperyMedia" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body text-dark">
							<div class="">
								<h5 class="text-muted text-center">Are You Sure You Want To Remove These Items</h5>
							</div>
							{!! Form::open(['action' => 'PropertyImagesController@remove_images', 'method' => 'DELETE', 'class' => 'container-fluid']) !!}
							<div class="row"></div>

							<button class="btn-block btn btn-danger mt-4" type="submit">Remove Items</button>

							{!! Form::close() !!}
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="modal fade" id="showing_modal" role="dialog" aria-hidden="true" tabindex="1">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h3 class="modal-title" id="exampleModalLabel">Add A Showing</h3>
							<button type="button" class="close dismissProperyMedia" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body text-dark">
							<div class="">
								<h3 class="text-muted text-center">Showing Information</h3>
							</div>
							{!! Form::open(['action' => ['PropertyController@add_showing', $property->id], 'method' => 'POST', 'class' => 'container-fluid']) !!}
							<div class="row">
								<div class="md-form col-6">
									<input type="text" name="show_date" id="show_date" class="form-control datetimepicker" value="{{ old('show_date') }}" placeholeder="Select Date" required />
									<label for="show_date" class="">Showing Date</label>
								</div>

								<div class="md-form col-6">
									<input type="text" name="show_time" id="show_time" class="form-control timepicker" value="{{ old('show_time') }}" placeholeder="Select Time" required />
									<label for="show_time" class="">Showing Time</label>
								</div>
							</div>
							<div class="row">
								<div class="col md-form">
									<textarea type="text" id="show_instruc" name="showing_instruc" class="form-control md-textarea" placeholder="" required>{{ old('showing_instructions') }}</textarea>
									<label for="show_instruc" class="">Showing Instructions</label>
								</div>
							</div>

							<button class="btn-block btn btn-primary mt-4" type="submit">Create Showing</button>

							{!! Form::close() !!}
						</div>
					</div>
				</div>
			</div>
		</div>

		@if($tenant)
			<div class="row">
				<div class="modal fade" id="remove_tenant_modal" role="dialog" aria-hidden="true" tabindex="1">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h3 class="modal-title" id="exampleModalLabel">Remove Tenant</h3>
								<button type="button" class="close dismissProperyMedia" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body text-dark">
								<div class="mb-3">
									<h5 class="red-text text-center">This contact will no longer be listed as the tenant for this property if you continue</h5>
								</div>
								<div class="card testimonial-card">
									<div class="card-up blue-gradient"></div>
									<div class="avatar mx-auto white">
										<img src="{{ asset($tenant->image ? str_ireplace('public', 'storage', $tenant->image->path) : 'images/empty_face.jpg') }}" class="rounded-circle" />
									</div>
									<div class="card-body testimonial-body">
										<!-- Name -->
										<div class="card-title">
											<h2>{{ $tenant->full_name() }}</h2>
										</div>
										<hr/>
										{!! $tenant->email != null ? '<p class="">E: ' . $tenant->email .'</p>' : '' !!}
										{!! $tenant->phone != null ? '<p class="">P: ' . $tenant->phone .'</p>' : '' !!}
									</div>
								</div>
								{!! Form::model($property, ['action' => ['PropertyController@remove_tenant',  $property->id], 'method' => 'POST']) !!}
								<div class="form-group">

									<button class="btn btn-danger btn-block mt-4" type="button">Remove Tenant</button>

								</div>
								{!! Form::close() !!}
							</div>
						</div>
					</div>
				</div>
			</div>
		@endif
	</div>
@endsection
@extends('layouts.app')

@section('addt_style')
	@if($tenant)
		<style>
			.card-body {
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
				
				<button class="btn btn-danger btn-block mt-2 deleteBtn" type="button" data-toggle="modal" data-target="#delete_modal">Delete Property</button>
				
				@if($tenant)
					<button class="btn orange darken-2 btn-block mt-2 tenantBtn" type="button" data-toggle="modal" data-target="#remove_tenant_modal">Remove Tenant</button>
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
												
												<select class="custom-select w-100" name="state" style="height:initial;">
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
											{{ Form::label('title', 'Title', ['class' => 'form-control-label']) }}
											<input type="text" name="title" class="form-control" value="{{ $property->title }}" />
											
											@if ($errors->has('title'))
												<span class="text-danger">Title cannot be empty</span>
											@endif
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
											{{ Form::label('available_date', 'Available Date', ['class' => 'form-control-label']) }}
											<input type="text" name="available_date" id="datetimepicker" class="form-control" value="{{ $startDate->format('m/d/Y') }}"  placeholder="Add Available Start Date" />
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
															<input type="checkbox" name="remove_image[]" id="" class="" value="{{ $media->id }}" />
															
															<div class="view">
																<img src="{{ asset('storage/' . str_ireplace('public/', '', $media->path)) }}" class="img-fluid img-thumbnail media-modal-item mw-100" />
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
															<input type="checkbox" name="remove_video[]" class="" value="{{ $video->id }}" />

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
										<button class="form-control btn btn-danger removeMediaBtn" type="button" data-toggle="modal" data-target="#property_media" style="display:none;">Remove Selected Media Items</button>
										{{ Form::submit('Save Changes', ['class' => 'form-control btn btn-primary']) }}
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
							<div class="form-group">
								{{ Form::submit('Delete', ['class' => 'form-control btn btn-danger', 'style' => 'line-height:1.5']) }}
								<button class="btn btn-warning form-control cancelBtn" style="line-height:1.5" type="button">Cancel</button>
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
							{{ Form::submit('Remove Items', ['class' => 'form-control btn btn-danger mt-4']) }}
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
							<div class="">
								<h5 class="text-muted text-center">This contact will no longer be listed as the tenant for this property if you continue</h5>
							</div>
							<div class="form-group">
								<p class="">{{ $property->tenant->full_name() }}</p>
							</div>
							{!! Form::model($property, ['action' => ['PropertyController@remove_tenant',  $property->id], 'method' => 'POST', 'class' => 'container-fluid']) !!}
								<div class="form-group">
									{{ Form::submit('Remove Tenant', ['class' => 'form-control btn btn-danger mt-4']) }}
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

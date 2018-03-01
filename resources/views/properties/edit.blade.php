@extends('layouts.app')

@section('addt_style')
@endsection

@section('content')
<div class="container-fluid">
	@if(session('status'))
		<h2 class="flashMessage">{{ session('status') }}</h2>
	@endif
	<div class="row">
		<div class="col-sm-3 col-12 text-center">
			<div class="container-fluid">
				<a href="/properties/create" class="btn btn-success d-block mt-2">Add New Property</a>
				<a href="/properties" class="btn btn-success d-block mt-2">All Properties</a>
				<button class="btn btn-danger w-100 mt-2 deleteBtn" type="button" data-toggle="modal" data-target="#delete_modal">Delete Property</button>
			</div>
		</div>
		<div class="col-sm-8 col-12 mx-auto">
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
										<div class="" style=" margin: -20px -20px 0px; padding: 5px; background: darkkhaki; color: whitesmoke; border-bottom: 1px solid rgba(0, 0, 0, 0.125);">
											<h2 class="">Current Tenant</h2>
											<h4 class="">{{ $tenant->first_name . " " . $tenant->last_name }}</h4>
										</div>
									@endif
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
											
											<select class="custom-select w-100 py-2" name="state" style="height:initial;">
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
											<input type="number" name="price" class="form-control" value="{{ $property->price }}" min='1' />
											<div class="input-group-append">
												<span class="input-group-text">/per month</span>
											</div>
										</div>
									</div>
									<div class="form-group">
										{{ Form::label('available_date', 'Available Date', ['class' => 'form-control-label']) }}
										<input type="date" name="available_date" class="form-control" value="{{ $property->available_date }}" min='1' />
									</div>
									<div class="form-row">
										<div class="form-group col-12">
											{{ Form::label('type', 'Type', ['class' => 'd-block form-control-label']) }}
											
											<div class="d-block d-sm-inline">
												<button type="button" class="btn w-100 aptBtn{{ $property->type == 'apartment' ? ' active btn-success' : ' btn-secondary' }}" style="line-height:1.5">
													<input type="checkbox" name="type" value="apartment" {{ $property->type == 'apartment' ? 'checked' : '' }} hidden />Apartment
												</button>
											</div>
											<div class="d-block d-sm-inline">
												<button type="button" class="btn w-100 mt-2 mt-sm-0 px-3 houseBtn{{ $property->type == 'house' ? ' active btn-success' : ' btn-secondary' }}" style="line-height:1.5">
													<input type="checkbox" name="type" value="house" {{ $property->type == 'house' ? 'checked' : '' }} hidden />House
												</button>
											</div>
										</div>
									</div>
									<div class="form-group">
										{{ Form::label('active', 'Active', ['class' => 'd-block form-control-label']) }}
										
										<div class="btn-group">
											<button type="button" class="btn activeYes activeProp{{ $property->active == 'Y' ? ' btn-success active' : ' btn-secondary' }}" style="line-height:1.5">
												<input type="checkbox" name="active" value="Y" hidden {{ $property->active == 'Y' ? 'checked' : '' }} />Yes
											</button>
											<button type="button" class="btn px-3 activeNo activeProp{{ $property->active == 'N' ? ' btn-danger active' : ' btn-secondary' }}" style="line-height:1.5">
												<input type="checkbox" name="active" value="N" {{ $property->active == 'N' ? 'checked' : '' }} hidden />No
											</button>
										</div>
									</div>
									<div class="form-group">
										{{ Form::label('construction', 'Under Construction', ['class' => 'd-block form-control-label']) }}
										
										<div class="btn-group">
											<button type="button" class="btn activeUnderConstr underConstr{{ $property->construction == 'Y' ? ' btn-success active' : ' btn-secondary' }}" style="line-height:1.5">
												<input type="checkbox" name="construction" value="Y" hidden {{ $property->construction == 'Y' ? 'checked' : '' }} />Yes
											</button>
											<button type="button" class="btn px-3 noUnderConstr  underConstr{{ $property->construction == 'N' ? ' btn-danger active' : ' btn-secondary' }}" style="line-height:1.5">
												<input type="checkbox" name="construction" value="N" {{ $property->construction == 'N' ? 'checked' : '' }} hidden />No
											</button>
										</div>
									</div>
									<div class="form-group">
										{{ Form::label('showcase', 'Showcase', ['class' => 'd-block form-control-label']) }}
										
										<div class="btn-group">
											<button type="button" class="btn{{ $property->showcase == 'Y' ? ' btn-success active' : ' btn-secondary' }}" style="line-height:1.5">
												<input type="checkbox" name="showcase" value="Y" {{ $property->showcase == 'Y' ? 'checked' : '' }} hidden />Yes
											</button>
											<button type="button" class="btn px-3{{ $property->showcase == 'N' ? ' btn-danger active' : ' btn-secondary' }}" style="line-height:1.5">
												<input type="checkbox" name="showcase" value="N" {{ $property->showcase == 'N' ? 'checked' : '' }} hidden />No
											</button>
										</div>
									</div>
									<div class="form-group">
									<div class="form-group">
										{{ Form::label('document', 'Documents', ['class' => 'd-block form-control-label']) }}
										
										@if($documents->isNotEmpty())
											@foreach($documents as $document)
												@php $document->name = explode('; ', $document->name); @endphp
												
												<p class="ml-3 mb-1">{{ $document->title }}</p>
												@foreach($document->name as $file)
													<a href="{{ asset('storage/' . str_ireplace('public/', '', $file)) }}" class="ml-5{{ $loop->count > 1 ? ' d-inline' : ' d-block' }}" download="{{ str_ireplace(' ', '_', $document->title) }}">Download Document {{ $loop->count > 1 ? $loop->iteration : ""}}</a>
												@endforeach
											@endforeach
										@else
											<span class="text-muted">No documents added for this contact</span>
										@endif
									</div>
										{{ Form::label('media', 'Media - select choose file to add pictures/videos', ['class' => 'd-block mw-100 custom-file']) }}
										<div class="input-group mb-3">
											<div class="input-group-prepend">
												<span class="input-group-text">Upload</span>
											</div>
											<div class="custom-file">
												<input type="file" name="media[]" id="upload_photo_input" class="custom-file-input" value="" multiple />
												<label class="custom-file-label" for="upload_photo_input">Choose File</label>
											</div>
										</div>	
										<div class="uploadsView">
											<h2 class="text-light">Preview Uploads</h2>
										</div>
									</div>
									@if($property->medias->isNotEmpty() || $property->videos->isNotEmpty())
										<div class="form-group">
											@foreach($property->medias as $media)
												<div class="position-relative d-inline-block deletePropImages">
													<label class="custom-control position-absolute custom-checkbox">
														<input type="checkbox" name="remove_image[]" class="custom-control-input" value="{{ $media->id }}" />
														<span class="custom-control-indicator"></span>
													</label>
													<img src="{{ asset('storage/' . str_ireplace('public/', '', $media->path)) }}" class="img-fluid img-thumbnail media-modal-item m-3" />
												</div>
											@endforeach
										</div>
									@endif
									<div class="form-group">
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
	@if($property->medias->isNotEmpty() || $property->videos->isNotEmpty())
		@php $medias = $property->medias; @endphp
		@php $videos = $property->videos; @endphp
		<div class="row">
			<div class="modal fade" id="property_media" role="dialog" aria-hidden="true" tabindex="1">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h3 class="modal-title" id="exampleModalLabel">Property Media</h3>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body text-dark">
							<div class="">
								<h5 class="text-muted">Check Box To Remove Image or Video</h5>
							</div>
							@if($property->medias->isNotEmpty())
								{!! Form::open(['action' => 'PropertyImagesController@remove_images', 'method' => 'DELETE']) !!}
									<div class="">
										<h2 class="">Photos</h2>
									</div>
									@foreach($medias as $media)
										<div class="position-relative d-inline-block deletePropImages">
											<label class="custom-control position-absolute custom-checkbox">
												<input type="checkbox" name="remove_image[]" class="custom-control-input" value="{{ $media->id }}" />
												<span class="custom-control-indicator"></span>
											</label>
											<img src="{{ asset('storage/' . str_ireplace('public/', '', $media->path)) }}" class="img-fluid img-thumbnail media-modal-item m-3" />
										</div>
									@endforeach
									
									<input type="number" name="prop" class="" value="{{ $property->id }}" hidden />
									
									{{ Form::submit('Remove Checked Images', ['class' => 'form-control btn btn-danger', 'style' => 'line-height:1.5']) }}
								{!! Form::close() !!}
							@endif
							
							@if($property->medias->isNotEmpty() || $property->videos->isNotEmpty())
								<div class="divider"></div>
							@endif
							
							@if($property->videos->isNotEmpty())
								{!! Form::open(['action' => 'PropertyImagesController@remove_videos', 'method' => 'DELETE']) !!}
									<div class="container-fluid my-2">
										<div class="">
											<h2 class="">Videos</h2>
										</div>
										<div class="row">
											@foreach($property->videos as $video)
												<div class="col-4">
													<label class="custom-control position-absolute custom-checkbox" style="z-index: 5;">
														<input type="checkbox" name="remove_video[]" class="custom-control-input" value="{{ $video->id }}" />
														<span class="custom-control-indicator"></span>
													</label>
													<video poster="/images/jrh_logo_lg.png" controls>
														<source src="{{ asset('storage/' . str_ireplace('public/', '', $video->path)) }}">
														Your browser does not support the video tag.
													</video>
												</div>
											@endforeach
										</div>
									</div>
									<input type="number" name="prop" class="" value="{{ $property->id }}" hidden />
									
									{{ Form::submit('Remove Checked Videos', ['class' => 'form-control btn btn-danger', 'style' => 'line-height:1.5']) }}
								{!! Form::close() !!}
							@endif
						</div>
					</div>
				</div>
			</div>
		</div>
	@endif
</div>
@endsection

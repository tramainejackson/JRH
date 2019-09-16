@extends('layouts.app')

@section('addt_style')
<<<<<<< HEAD
=======
	@if($tenant)
		<style>
			.card-body {
				background: linear-gradient(grey -70%, transparent, transparent);
			}
		</style>
	@endif
>>>>>>> payment_plan
@endsection

@section('content')
<div class="container-fluid">
	@if(session('status'))
		<h2 class="flashMessage">{{ session('status') }}</h2>
	@endif
	<div class="row">
		<div class="col-12 col-md-12 col-lg-12 col-xl-4 text-center">
			<div class="container-fluid">
<<<<<<< HEAD
				<a href="/contacts/create" class="btn btn-success d-block mt-2">Add New Contact</a>
				<a href="/contacts" class="btn btn-success d-block mt-2 mb-2 mb-sm-0">All Contacts</a><button class="btn btn-danger w-100 mt-2 deleteBtn" type="button" data-toggle="modal" data-target="#delete_modal">Delete Contact</button>
=======
				<div class="row py-2">
					<div class="col-12 col-xl-12">
						<a href="/contacts/create" class="btn btn-success btn-block my-2">Add New Contact</a>

						<a href="/contacts" class="btn btn-success btn-block">All Contacts</a>

						<button class="btn btn-danger btn-block deleteBtn my-2" type="button" data-toggle="modal" data-target="#delete_modal">Delete Contact</button>
						
						@if($tenant)
							<button class="btn cyan accent-4 btn-block rentBtn" type="button" data-toggle="modal" data-target="#rent_modal">Rent Reminder</button>
						
							<button class="btn orange darken-2 btn-block propertyBtn my-2" type="button" data-toggle="modal" data-target="#remove_property_modal">Remove As Tenant</button>
						@endif
					</div>

					<div class="col-12 col-xl-12 mt-xl-4">
						{!! Form::open(['action' => ['ContactController@send_mail', $contact->id], 'method' => 'POST', 'files' => true]) !!}
							<div class="row contactEmail">
								<div class="col-12">
									<h2 class="light-blue darken-1">Email Contact</h2>
								</div>
								<div class="col-12">
									<div class="form-group" id="email_subject">
										<input type="text" name="email_subject" class="form-control" placeholder="Email Subject" value="{{ old('email_subject') }}" />
									</div>
									<div class="form-group" id="email_body">
										<textarea name="email_body" class="form-control" placeholder="Email Body">{{ old('email_body') }}</textarea>
									</div>
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text">Add</span>
										</div>
										<div class="custom-file">
											<input type="file" name="attachment" class="custom-file-input" value="attachment" />
											<label class="custom-file-label text-left">Add Attachment</label>
										</div>
									</div>
									<div class="form-group">
										<input type="submit" id="send_email" name="send_email" class="btn light-blue lighten-5 mt-4" value="Send Email" />
									</div>
								</div>
							</div>
						{!! Form::close() !!}
					</div>
				</div>
>>>>>>> payment_plan
			</div>
		</div>
		
		<div class="col-12 col-md-12 col-lg-12 col-xl-8 mx-auto">
			<div class="container-fluid">
				<div class="row">
					<div class="col">
						<div class="card mt-2">
							<div class="card-header">
								<h2 class="">Edit Contact</h2>
							</div>
							<div class="card-body">
<<<<<<< HEAD
								{!! Form::model($contact, ['action' => ['ContactController@update', $contact->id], 'method' => 'PATCH']) !!}
=======
								{!! Form::model($contact, ['action' => ['ContactController@update', $contact->id], 'method' => 'PATCH', 'files' => true, 'class' => 'contact_edit_form']) !!}
									@if($tenant)
										@php 
											$defaultPhoto = $tenant->medias()->where('default_photo', 'Y')->first();
										@endphp
										<div class="media flex-wrap" style="">
											<img src="{{ $defaultPhoto != null ? asset(str_ireplace('public', 'storage', $defaultPhoto->path)) : asset('images/empty_prop.png') }}" class="d-flex align-self-start mr-3" alt="Generic placeholder image" />
											<div class="media-body">
												<h4 class="mt-0 font-weight-bold"><a href="/properties/{{ $tenant->id }}/edit">{{ $tenant->address }}</a></h4>
												<p class="m-1"><u>Type:</u>&nbsp;{{ ucwords($tenant->type) }}</p>
											</div>
											<div class="d-flex">
												<p class="">Current Residence</p>
											</div>
										</div>
									@endif
									<div class="row contactImg mb-3">
										<div class="view mx-auto">
											<img src="{{ asset($contact->image != null ? str_ireplace('public', 'storage', $contact->image->path) : 'images/empty_face.jpg') }}" class="rounded-circle hoverable" />
											<div class="mask d-flex justify-content-center">
												<button type="button" class="btn align-self-end rounded-circle w-100 white-text m-0 p-1">Change</button>
												<input type="file" class="hidden" name="contact_image" hidden />
											</div>
										</div>
										
										@if ($errors->has('contact_image'))
											<span class="text-danger">{{ $errors->first('contact_image') }}</span>
										@endif
									</div>
>>>>>>> payment_plan
									<div class="form-row">
										<div class="form-group col-sm-6 col-12">
											{{ Form::label('first_name', 'First Name', ['class' => 'form-control-label']) }}
											<input type="text" name="first_name" class="form-control" value="{{ $contact->first_name }}" />
											
											@if ($errors->has('first_name'))
												<span class="text-danger">First Name cannot be empty</span>
											@endif
										</div>
										<div class="form-group col-sm-6 col-12">
											{{ Form::label('last_name', 'Last Name', ['class' => 'form-control-label']) }}
											<input type="text" name="last_name" class="form-control" value="{{ $contact->last_name }}" />
											
											@if ($errors->has('last_name'))
												<span class="text-danger">Last Name cannot be empty</span>
											@endif
										</div>
									</div>
									<div class="form-group">
										{{ Form::label('email', 'Email Address', ['class' => 'form-control-label']) }}
										<input type="email" name="email" class="form-control" value="{{ $contact->email }}" placeholder="Enter An Email Address" />
									</div>
									<div class="form-group">
										{{ Form::label('phone', 'Phone', ['class' => 'form-control-label']) }}
										<input type="text" name="phone" class="form-control" value="{{ $contact->phone }}" placeholder="Enter A Phone Number" />
									</div>
									<div class="form-group">
										{{ Form::label('family_size', 'Family Size', ['class' => 'form-control-label']) }}
										<input type="number" name="family_size" class="form-control" value="{{ $contact->family_size }}" min='1' />
									</div>
									<div class="form-group">
										@php $dob = new Carbon\Carbon($contact->dob); @endphp
										{{ Form::label('dob', 'Date of Birth', ['class' => 'form-control-label']) }}
<<<<<<< HEAD
										<input type="date" name="dob" class="form-control" value="{{ $contact->dob }}" min='1' />
=======
										<input type="text" name="dob" id="datetimepicker" class="form-control" value="{{ $dob->format('m/d/Y') }}" placeholder="Add Contact Date of Birth" />
>>>>>>> payment_plan
									</div>
									<div class="form-group">
										{{ Form::label('tenant', 'Current Tenant', ['class' => 'd-block form-control-label']) }}
										
										<div class="btn-group">
											<button type="button" class="btn{{ $contact->tenant == 'Y' ? ' btn-success active' : ' btn-secondary' }}" >
												<input type="checkbox" name="tenant" value="Y" hidden {{ $contact->tenant == 'Y' ? 'checked' : '' }} />Yes
											</button>
											<button type="button" class="btn px-3{{ $contact->tenant == 'N' ? ' btn-danger active' : ' btn-secondary' }}">
												<input type="checkbox" name="tenant" value="N" hidden {{ $contact->tenant == 'N' ? 'checked' : '' }} />No
											</button>
										</div>
										<div class="btn-group tenantProp" {!! $contact->tenant == 'Y' ? '' : "style='display:none;' " !!}>
<<<<<<< HEAD
											<select class="py-2" name="property_id">
=======
											<select class="custom-select browser-default form-control-lg" name="property_id">
>>>>>>> payment_plan
												@foreach($properties as $property)
													<option value="{{ $property->id }}" {!! $contact->property && $contact->property->id == $property->id ? "class='bg-success text-light' " : '' !!}{{ $property->tenant ? 'disabled' : '' }}{{ $contact->property && $contact->property->id == $property->id ? ' selected' : '' }}>{{ $property->address }}{{ $property->tenant ? $contact->property && $contact->property->id == $property->id ? '  - Current Occupant' : ' - Occupied' : '' }}</option>
												@endforeach
											</select>
										</div>
									</div>
									<div class="form-group">
										{{ Form::label('document', 'Documents', ['class' => 'd-block form-control-label']) }}
										
										@if($documents->isNotEmpty())
											@foreach($documents as $document)
												@php $document->name = explode('; ', $document->name); @endphp
												
												<p class="ml-3 mb-1">{{ $document->title }}</p>
												@foreach($document->name as $file)
													<a href="{{ asset('storage/' . str_ireplace('public/', '', $file)) }}" class="ml-5{{ $loop->count > 1 ? ' d-inline' : ' d-block' }}" download="{{ str_ireplace(' ', '_', $document->title) }}">Document {{ $loop->count > 1 ? $loop->iteration : ""}}</a>
												@endforeach
<<<<<<< HEAD
											@endforeach
										@else
											<span class="text-muted">No documents added for this contact</span>
										@endif
=======
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
												<label class="custom-file-label text-truncate" for="upload_photo_input">Add Document For Contact</label>
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
>>>>>>> payment_plan
									</div>
									<div class="form-group">
									
										<button class="form-control btn btn-primary" type="submit">Update</button>

									</div>
								{!! Form::close() !!}
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

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
						<div class="form-group">
							<label class="form-control-label">Name</label>
							<input type="text" class="form-control" value="{{ $contact->first_name . ' ' .$contact->last_name }}" disabled />
						</div>
						<div class="form-group">
							<label class="form-control-label">Email Address</label>
							<input type="email" class="form-control" value="{{ $contact->email }}" disabled />
						</div>
						<div class="form-group">
							<label class="form-control-label">Phone</label>
							<input type="text" class="form-control" value="{{ $contact->phone }}" disabled />
						</div>
						<div class="form-group">
							<label for="team_name" class="form-control-label">Family Size</label>
							<input type="text" class="form-control" value="{{ $contact->family_size }}" disabled />
						</div>
						<div class="form-group">
							<label class="d-block form-control-label">Current Tenant</label>
							
							<div class="btn-group">
								<button type="button" class="btn{{ $contact->tenant == 'Y' ? ' btn-success active' : '' }}" disabled >
									<input type="checkbox" name="tenant" value="Y" hidden {{ $contact->tenant == 'Y' ? 'checked' : '' }} />Yes
								</button>
								<button type="button" class="btn{{ $contact->tenant == 'N' ? ' btn-danger active' : '' }}" disabled>
									<input type="checkbox" name="tenant" value="N" hidden {{ $contact->tenant == 'N' ? 'checked' : '' }} />No
								</button>
							</div>
						</div>
						{!! Form::model($contact, ['action' => ['ContactController@destroy', $contact->id], 'method' => 'DELETE']) !!}
							<div class="form-group">
								{{ Form::submit('Delete', ['class' => 'form-control btn btn-danger']) }}
								<button class="btn btn-warning form-control cancelBtn" type="button">Cancel</button>
							</div>
						{!! Form::close() !!}
					</div>
				</div>
			</div>
		</div>
		
		@if($tenant)
			<div class="modal fade" id="rent_modal" role="dialog" aria-hidden="true" tabindex="1">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header border-0">
							<h5 class="modal-title" id="">Rent Reminder</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-header">
							<p class="m-0">*This will send the tenant an email with a link to your $CashTag with the amount that you enter</p>
						</div>
						{!! Form::model($contact, ['action' => ['ContactController@rent_reminder', $contact->id], 'method' => 'POST']) !!}
							<div class="modal-body text-dark">
								<div class="row">
									<div class="col-12">
										<div class="form-group" id="email_subject">
											<label for="email_subject" class="form-label">Subject</label>
											<input type="text" name="email_subject" class="form-control" placeholder="Email Subject" value="{{ old('email_subject') ? old('email_subject') : 'Rent Reminder' }}" required />
										</div>
										<div class="form-group" id="email_body">
											<label for="email_body" class="form-label">Reminder Description</label>
											<textarea name="email_body" class="form-control" placeholder="Email Body" required>{{ old('email_body') }}</textarea>
										</div>
										<div class="form-group mb-0">
											<label for="rent_amount" class="form-label">Amount Due</label>
										</div>
										<div class="input-group mb-4">
											<div class="input-group-prepend">
												<span class="input-group-text">https://cash.me/$Jacksonrentalhomes/</span>
											</div>
											<input type="number" name="rent_amount" class="form-control" value="" placeholder="Enter An Amount" required />
										</div>
										<div class="form-group">
											{{ Form::submit('Send Reminder', ['class' => 'form-control btn cyan accent-4 ml-0']) }}
											<button class="btn btn-warning form-control cancelBtn ml-0" type="button">Cancel</button>
										</div>
									</div>
								</div>
							</div>
						{!! Form::close() !!}
					</div>
				</div>
			</div>
			
			<div class="modal fade" id="remove_property_modal" role="dialog" aria-hidden="true" tabindex="1">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="">Remove Contact as Tenant</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						{!! Form::model($contact, ['action' => ['ContactController@remove_as_tenant', $contact->id], 'method' => 'POST']) !!}
							@php 
								$default_img = $tenant->medias()->where('default_photo', 'Y')->first();
							@endphp
							<div class="modal-body text-dark">
								<div class="row">
									<div class="col-12">
										<p class="form-group deep-orange-text" id="">This contact will no longer be listed as the tenant for the below property if you continue</p>
									</div>
									<div class="col-12 col-md-12 col-xl-8 mx-auto" id="">
										<div class="card">
											<img src="{{ $default_img != null ? asset(str_ireplace('public', 'storage', $default_img->path)) : asset('/images/empty_prop.png') }}" class="card-img-top" alt="Property Default Image"/>
											<div class="card-body">
												<span class=""><i><b>Address:</b></i></span>
												<p class="">{{ $tenant->address }}</p>
											</div>
										</div>
									</div>
									<div class="w-100"></div>
									<div class="col-8 col-xl-4 mx-auto mt-3">
										<div class="form-group">
											{{ Form::submit('Remove Tenant', ['class' => 'form-control btn orange darken-2 ml-0']) }}
										</div>
									</div>
								</div>
							</div>
						{!! Form::close() !!}
					</div>
				</div>
			</div>
		@endif
	</div>
</div>
@endsection

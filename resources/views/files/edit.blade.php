@extends('layouts.app')

@section('addt_style')
@endsection

@section('content')
<div id="content_container" class="container-fluid">
	@if(session('status'))
		<h2 class="flashMessage">{{ session('status') }}</h2>
	@endif
	@php $file->name = explode('; ', $file->name); @endphp
	<div class="row">
		<div class="col-sm-3 col-12 text-center">
			<div class="container-fluid">
				<a href="/admin_files/create" class="btn btn-success d-block mt-2">Add New Files</a>
				<a href="/admin_files" class="btn btn-success d-block mt-2 mb-2 mb-sm-0">All Files</a>
				<button class="btn btn-danger d-block mt-2 deleteBtn{{ count($file->name) > 1 ? ' disabled' : ' btn-danger deleteBtn' }}" type="button" data-toggle="modal" data-target="#delete_modal" {{ count($file->name) > 1 ? 'disabled' : '' }}>Delete File</button>
			</div>
		</div>
		<div class="col-sm-8 col-12 mx-auto">
			<div class="container-fluid">
				<div class="row">
					<div class="col">
						<div class="card mt-2">
							<div class="card-header">
								<h2 class="">Edit Files</h2>
							</div>
							<div class="card-body">
								{!! Form::model($file, ['action' => ['FilesController@update', $file->id], 'method' => 'PATCH']) !!}
									<div class="form-group">
										{{ Form::label('title', 'File Description', ['class' => 'form-control-label']) }}
										<input type="text" name="title" class="form-control" value="{{ $file->title }}" />
										
										@if ($errors->has('title'))
											<span class="text-danger">Title cannot be empty</span>
										@endif
									</div>
									
									<div class="mb-2">
										<h3 class="text-left text-muted"><u>Documents</u></h3>
										@if($file->group_files) 
											@foreach($file->group_files as $document)
												<div class="">
													<a href="{{ asset(str_ireplace('public', 'storage', $document->name)) }}" class="btn cyan darken-4 ml-3" download="{{ str_ireplace(' ', '_', $document->title) }}">View Document {{ $loop->count > 1 ? $loop->iteration : ""}}</a>
												</div>
											@endforeach
										@else
											<div class="">
												<a href="{{ asset(str_ireplace('public', 'storage', $document->name)) }}" class="btn cyan darken-4 ml-3" download="{{ str_ireplace(' ', '_', $document->title) }}">View Document {{ $loop->count > 1 ? $loop->iteration : ""}}</a>
											</div>
										@endif
									</div>
									
									<div class="mb-2">
										<h3 class="text-left text-muted"><u>Contact Association</u></h3>
										@if($file->contact)
											<a href="/contacts/{{ $file->contact_id }}/edit" class="ml-3 btn teal darken-1">{{ $file->contact->full_name() }}</a>
										@else
											<div class="form-group">
												{{ Form::label('contact_id', 'Associate with contact', ['class' => 'form-control-label d-block']) }}
												<select class="py-2 w-50 custom-select form-control-lg" name="contact_id">
													<option value="" selected>---- Select a Contact ----</option>
													@foreach($contacts as $contact)
														<option value="{{ $contact->id }}">{{ $contact->first_name . ' ' . $contact->last_name }}</option>
													@endforeach
												</select>
											</div>
										@endif
									</div>
									
									<div class="">
										<h3 class="text-left text-muted"><u>Property Association</u></h3>
										@if($file->property)
											<a href="/properties/{{ $file->property_id }}/edit" class="ml-3 btn teal accent-4">{{ $file->property->address }}</a>
										@else
											<div class="form-group">
												{{ Form::label('property_id', 'Associate with contact', ['class' => 'form-control-label d-block']) }}
												<select class="py-2 w-50 custom-select form-control-lg" name="property_id">
													<option value="" selected>---- Select a Propery ----</option>
													@foreach($properties as $property)
														<option value="{{ $property->id }}">{{ $property->address }}</option>
													@endforeach
												</select>
											</div>
										@endif
									</div>
									<div class="form-group">
										{{ Form::submit('Update', ['class' => 'form-control btn btn-primary mt-4']) }}
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
						<div class="">
							<p class="ml-2 text-muted"><u>File Name</u></p>
							<p class="ml-4">{{ $file->title }}</p>
						</div>
						{!! Form::model($file, ['action' => ['FilesController@destroy', $file->id], 'method' => 'DELETE']) !!}
							<div class="form-group">
								{{ Form::submit('Delete', ['class' => 'form-control btn btn-danger']) }}
								<button class="btn btn-warning form-control cancelBtn" type="button">Cancel</button>
							</div>
						{!! Form::close() !!}
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@extends('layouts.app')

@section('addt_style')
@endsection

@section('content')

	<div id="content_container" class="container-fluid">
		<div class="row">
			<div class="col-sm-3 col-12 text-center mb-3">
				<a href="/admin_files" class="btn btn-success d-block mt-2">All Files</a>
			</div>
			<div class="col">
				<div class="card mt-2">
					<div class="card-header">
						<h2 class="">Add Files</h2>
					</div>
					<div class="card-body">
						{!! Form::open(['action' => ['FilesController@store'], 'method' => 'POST', 'files' => true, ]) !!}
							<div class="form-group">
								<div class="input-group mb-3">
									<div class="input-group-prepend">
										<span class="input-group-text">Upload</span>
									</div>
									<div class="custom-file">
										{{ Form::file('name[]', ['class' => 'custom-file-input', 'multiple' => 'true']) }}
										{{ Form::label('name', 'Add Files', ['class' => 'custom-file-label']) }}
									</div>
								</div>
								
								@if ($errors->has('name'))
									<span class="text-danger">{{ $errors->first('name') }}</span>
								@endif
							</div>
							<div class="form-group">
								{{ Form::label('title', 'Description', ['class' => 'form-control-label']) }}
								{{ Form::text('title', '', ['class' => 'form-control', 'placeholder' => 'Enter Name Of Documents']) }}
								
								@if ($errors->has('title'))
									<span class="text-danger">Description cannot be empty</span>
								@endif
							</div>
							<div class="form-group">
								{{ Form::label('contact_id', 'Associate with contact', ['class' => 'form-control-label d-block']) }}
								<select class="py-2 w-50 custom-select form-control-lg" name="contact_id">
									<option value="" selected>---- Select a Contact ----</option>
									@foreach($contacts as $contact)
										<option value="{{ $contact->id }}">{{ $contact->first_name . ' ' . $contact->last_name }}</option>
									@endforeach
								</select>
							</div>
							<div class="form-group">
								{{ Form::label('property_id', 'Associate with contact', ['class' => 'form-control-label d-block']) }}
								<select class="py-2 w-50 custom-select form-control-lg" name="property_id">
									<option value="" selected>---- Select a Propery ----</option>
									@foreach($properties as $property)
										<option value="{{ $property->id }}">{{ $property->address }}</option>
									@endforeach
								</select>
							</div>
							<div class="form-group">
								{{ Form::submit('Add File', ['class' => 'btn btn-primary ml-0']) }}
							</div>
						{!! Form::close() !!}
					</div>
				</div>

			</div>
		</div>
	</div>
</div>
@endsection

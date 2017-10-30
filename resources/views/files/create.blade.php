@extends('layouts.app')

@section('addt_style')
@endsection

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-sm-3 col-12 text-center my-3">
			<a href="/admin_files" class="btn btn-success d-block mt-2">All Files</a>
		</div>
		<div class="col-sm-8 col-12 mx-auto">
			<div class="">
				<fieldset>
					<legend class="">File Upload</legend>
					{!! Form::open(['action' => ['FilesController@store'], 'method' => 'POST', 'files' => true, ]) !!}
						<div class="form-group">
							{{ Form::label('name', 'File - select choose file to add a new file', ['class' => 'd-block form-control-label mw-100']) }}
							{{ Form::file('name[]', ['class' => 'd-block form-control-label mw-100', 'multiple' => 'true']) }}
							
							@if ($errors->has('name'))
								<span class="text-danger">File cannot be empty</span>
							@endif
						</div>
						<div class="form-group">
							{{ Form::label('title', 'Description', ['class' => 'form-control-label']) }}
							{{ Form::text('title', '', ['class' => 'form-control']) }}
							
							@if ($errors->has('title'))
								<span class="text-danger">Description cannot be empty</span>
							@endif
						</div>
						<div class="form-group">
							{{ Form::label('contact_id', 'Associate with contact', ['class' => 'form-control-label d-block']) }}
							<select class="py-2 w-50" name="contact_id">
								<option value="none" selected>---- Select a Contact ----</option>
								@foreach($contacts as $contact)
									<option value="{{ $contact->id }}">{{ $contact->first_name . ' ' . $contact->last_name }}</option>
								@endforeach
							</select>
						</div>
						<div class="form-group">
							{{ Form::label('property_id', 'Associate with contact', ['class' => 'form-control-label d-block']) }}
							<select class="py-2 w-50" name="property_id">
								<option value="none" selected>---- Select a Propery ----</option>
								@foreach($properties as $property)
									<option value="{{ $property->id }}">{{ $property->address }}</option>
								@endforeach
							</select>
						</div>
						<div class="form-group">
							{{ Form::submit('Add File', ['class' => 'btn btn-primary form-control']) }}
						</div>
					{!! Form::close() !!}
				</fieldset>
			</div>
		</div>
	</div>
</div>
@endsection

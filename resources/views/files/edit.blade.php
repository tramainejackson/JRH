@extends('layouts.app')

@section('addt_style')
@endsection

@section('content')
<div class="container-fluid">
	@if(session('status'))
		<h2 class="flashMessage">{{ session('status') }}</h2>
	@endif
	@php $file->name = explode('; ', $file->name); @endphp
	<div class="row">
		<div class="col-sm-3 col-12 text-center">
			<div class="container-fluid">
				<a href="/admin_files/create" class="btn btn-success d-block mt-2">Add New Files</a>
				<a href="/admin_files" class="btn btn-success d-block mt-2 mb-2 mb-sm-0">All Files</a>
				<button class="btn w-100 mt-2{{ count($file->name) > 1 ? ' disabled' : ' btn-danger deleteBtn' }}" type="button" data-toggle="modal" data-target="#delete_modal" {{ count($file->name) > 1 ? 'disabled' : '' }}>Delete File</button>
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
									
									@if($file->name != null) 
										<div class="mb-2">
											<h3 class="text-left text-muted"><u>Documents</u></h3>
											@foreach($file->name as $document)
												<div class="">
													<a href="{{ asset('storage/' . str_ireplace('public/', '', $document)) }}" class="ml-3{{ $loop->count > 1 ? ' d-inline' : ' d-block' }}" download="{{ str_ireplace(' ', '_', $file->title) }}">Document {{ $loop->count > 1 ? $loop->iteration : ""}}</a>{!! $loop->count > 1 ? "<a href='' class='pl-3 d-inline text-danger'> - Delete</a>" : "" !!}
												</div>
											@endforeach
										</div>
									@endif
									
									@if($file->contact_id != null)
										<div class="mb-2">
											@php $contact = \App\Contact::find($file->contact_id); @endphp

											@if($contact != null)
												<h3 class="text-left text-muted"><u>Contact</u></h3>
												<a href="/contacts/{{ $file->contact_id }}/edit" class="ml-3 d-block">Associated with contact - {{ $contact->first_name . " " . $contact->last_name}}</a>
											@endif
										</div>
									@endif
									
									@if($file->property_id != null)
										<div class="">
											@php $property = \App\Property::find($file->property_id); @endphp
											
											@if($property != null)
												<h3 class="text-left text-muted"><u>Property</u></h3>
												<a href="/properties/{{ $file->property_id }}/edit" class="ml-3 d-block">Associated with property - {{ $property->address }}</a>
											@endif
										</div>
									@endif
									<div class="form-group">
										{{ Form::submit('Update', ['class' => 'form-control btn btn-primary']) }}
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

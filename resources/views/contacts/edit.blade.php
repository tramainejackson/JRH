@extends('layouts.app')

@section('content')
@if(session('status'))
	<h2 class="flashMessage">{{ session('status') }}</h2>
@endif
<div class="container-fluid">
	<div class="row">
		<div class="col-md-3 col-2 text-center">
			<a href="/contacts/create" class="btn btn-success d-block mt-2">Add New Contact</a>
			<a href="/contacts" class="btn btn-success d-block mt-2">All Contacts</a>
		</div>
		<div class="col-md-8 col-7 mx-auto">
			<div class="container-fluid">
				<div class="row">
					<div class="col">
						<div class="card mt-2">
							<div class="card-header">
								<h2 class="">Edit Contact</h2>
							</div>
							<div class="card-body">
								{!! Form::model($contact, ['action' => ['ContactController@update', $contact->id], 'method' => 'PATCH']) !!}
									<div class="form-row">
										<div class="form-group col-6">
											{{ Form::label('first_name', 'First Name', ['class' => 'form-control-label']) }}
											<input type="text" name="first_name" class="form-control" value="{{ $contact->first_name }}" />
											
											@if ($errors->has('first_name'))
												<span class="text-danger">First Name cannot be empty</span>
											@endif
										</div>
										<div class="form-group col-6">
											{{ Form::label('last_name', 'Last Name', ['class' => 'form-control-label']) }}
											<input type="text" name="last_name" class="form-control" value="{{ $contact->last_name }}" />
											
											@if ($errors->has('last_name'))
												<span class="text-danger">Last Name cannot be empty</span>
											@endif
										</div>
									</div>
									<div class="form-group">
										{{ Form::label('email', 'Email Address', ['class' => 'form-control-label']) }}
										<input type="email" name="email" class="form-control" value="{{ $contact->email }}" />
									</div>
									<div class="form-group">
										{{ Form::label('phone', 'Phone', ['class' => 'form-control-label']) }}
										<input type="text" name="phone" class="form-control" value="{{ $contact->phone }}" />
									</div>
									<div class="form-group">
										{{ Form::label('family_size', 'Family Size', ['class' => 'form-control-label']) }}
										<input type="number" name="family_size" class="form-control" value="{{ $contact->family_size }}" min='1' />
									</div>
									<div class="form-group">
										{{ Form::label('dob', 'Date of Birth', ['class' => 'form-control-label']) }}
										<input type="date" name="dob" class="form-control" value="{{ $contact->dob }}" min='1' />
									</div>
									<div class="form-group">
										{{ Form::label('tenant', 'Current Tenant', ['class' => 'd-block form-control-label']) }}
										
										<div class="btn-group">
											<button type="button" class="btn {{ $contact->tenant == 'Y' ? 'btn-success active' : '' }}">
												<input type="checkbox" name="tenant" value="Y" hidden {{ $contact->tenant == 'Y' ? 'checked' : '' }} />Yes
											</button>
											<button type="button" class="btn px-3 {{ $contact->tenant == 'N' ? 'btn-danger active' : '' }}">
												<input type="checkbox" name="tenant" value="N" hidden {{ $contact->tenant == 'N' ? 'checked' : '' }} />No
											</button>
										</div>
										<div class="btn-group tenantProp" {!! $contact->tenant == 'Y' ? '' : "style='display:none;' " !!}>
											<select class="py-2" name="property_id">
												@foreach($properties as $property)
													<option value="{{ $property->id }}" {!! $contact->property && $contact->property->id == $property->id ? "class='bg-success text-light' " : '' !!}{{ $property->tenant ? 'disabled' : '' }}{{ $contact->property && $contact->property->id == $property->id ? ' selected' : '' }}>{{ $property->address }}{{ $property->tenant ? $contact->property && $contact->property->id == $property->id ? '  - Current Occupant' : ' - Occupied' : '' }}</option>
												@endforeach
											</select>
										</div>
									</div>
									<div class="form-group">
										{{ Form::submit('Update', ['class' => 'form-control btn btn-primary']) }}
										<button class="btn btn-danger w-100 mt-2 deleteBtn" type="button" data-toggle="modal" data-target="#delete_modal">Delete</button>
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
							<label class="form-control-label">Email Address</label>
							<input type="email" class="" value="{{ $contact->email }}" disabled />
						</div>
						<div class="form-group">
							<label class="form-control-label">Team Name</label>
							<input type="text" class="" value="{{ $contact->team_name }}" disabled />
						</div>
						<div class="form-group">
							<label class="form-control-label">Player 1</label>
							<input type="text" class="" value="{{ $contact->player_1 }}" disabled />
						</div>
						<div class="form-group">
							<label for="team_name" class="form-control-label">Player 2</label>
							<input type="text" class="" value="{{ $contact->player_2 }}" disabled />
						</div>
						<div class="form-group">
							<label class="d-block form-control-label">Current Tenant</label>
							
							<div class="btn-group">
								<button type="button" class="btn {{ $contact->tenant == 'Y' ? 'btn-success active' : '' }}" disabled >
									<input type="checkbox" name="tenant" value="Y" hidden {{ $contact->tenant == 'Y' ? 'checked' : '' }} />Yes
								</button>
								<button type="button" class="btn {{ $contact->tenant == 'N' ? 'btn-danger active' : '' }}" disabled>
									<input type="checkbox" name="tenant" value="N" hidden {{ $contact->tenant == 'N' ? 'checked' : '' }} />No
								</button>
							</div>
						</div>
						{!! Form::model($contact, ['action' => ['ContactController@destroy', $contact->id], 'method' => 'DELETE']) !!}
							<div class="form-group">
								{{ Form::submit('Delete', ['class' => 'form-control btn btn-danger']) }}
								<button class="btn btn-warning form-control " type="button">Cancel</button>
							</div>
						{!! Form::close() !!}
					</div>
					<div class="modal-footer">
						
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

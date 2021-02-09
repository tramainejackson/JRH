@extends('layouts.app')

@section('addt_style')
@endsection

@section('content')
	<div class="container-fluid" id="content_container">
		<div class="row">
			<div class="col-12 col-md-12 col-lg-6 col-xl-6 text-center my-3 mx-auto">
				<a href="/contacts" class="btn btn-success d-block mt-2">All Contacts</a>
			</div>
			<div class="col-12 col-md-12 col-lg-8 col-xl-8 mx-auto mb-3">
				<div class="card mt-2">
					<img src="/images/empty_face.jpg" class="card-img-top" height="350"/>
					<div class="card-body">
						{!! Form::open(['action' => ['ContactController@store'], 'method' => 'POST']) !!}
						<div class="form-row">
							<div class="form-group col-sm-6 col-12">
								{{ Form::label('first_name', 'First Name', ['class' => 'form-control-label']) }}
								{{ Form::text('first_name', '', ['class' => 'form-control', 'placeholder' => 'Enter A Fistname']) }}

								@if ($errors->has('first_name'))
									<span class="text-danger">First Name cannot be empty</span>
								@endif
							</div>
							<div class="form-group col-sm-6 col-12">
								{{ Form::label('last_name', 'Last Name', ['class' => 'form-control-label']) }}
								{{ Form::text('last_name', '', ['class' => 'form-control', 'placeholder' => 'Enter A Lastname']) }}

								@if ($errors->has('last_name'))
									<span class="text-danger">Last Name cannot be empty</span>
								@endif
							</div>
						</div>
						<div class="form-group">
							{{ Form::label('email', 'Email Address', ['class' => 'form-control-label']) }}
							<input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="Enter Email Address" />
						</div>
						<div class="form-group">
							{{ Form::label('phone', 'Phone', ['class' => 'form-control-label']) }}
							<input type="text" name="phone" class="form-control" value="{{ old('phone') }}" placeholder="Enter Phone Number" />
						</div>
						<div class="form-group">
							{{ Form::label('family_size', 'Family Size', ['class' => 'form-control-label']) }}
							<input type="number" name="family_size" class="form-control" value="{{ old('family_size') }}" min='1'placeholder="Enter Family Size" />
						</div>
						<div class="form-group">
							{{ Form::label('dob', 'Date of Birth', ['class' => 'form-control-label']) }}
							<input type="text" id="datetimepicker" name="dob" class="form-control" value="{{ old('dob') }}" placeholder="Add A Date of Birth" />
						</div>
						<div class="form-group">
							{{ Form::label('tenant', 'Current Tenant', ['class' => 'd-block form-control-label']) }}

							<div class="btn-group">
								<button type="button" class="btn btn-blue-grey">
									<input type="checkbox" name="tenant" value="Y" hidden />Yes
								</button>
								<button type="button" class="btn btn-danger active">
									<input type="checkbox" name="tenant" value="N" checked hidden />No
								</button>
							</div>
							<div class="btn-group tenantProp" style="display:none;">
								<select class="custom-select form-control-lg" name="property_id">
									@foreach($properties as $property)
										<option value="{{ $property->id }}" {{ $property->tenant ? 'disabled' : '' }}>{{ $property->address }}{{ $property->tenant ? ' - Occupied' : '' }}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="form-group">
							{{ Form::submit('Add Contact', ['class' => 'btn btn-primary ml-0']) }}
						</div>
						{!! Form::close() !!}
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
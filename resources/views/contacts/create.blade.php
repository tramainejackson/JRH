@extends('layouts.app')
@section('addt_style')
	<link href="{{ asset('/css/mat.css') }}" rel="stylesheet">
@endsection
@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="d-table d-sm-none" style="height:120px">&nbsp;</div>
		<div class="col-sm-3 col-12 text-center">
			<a href="/contacts" class="btn btn-success d-block pb-5 mt-2" style="line-height:1.5">All Contacts</a>
		</div>
		<div class="col-sm-8 col-12 mx-auto">
			<div class="card mt-2">
				<img src="/images/empty_face.jpg" class="card-img-top" height="350"/>
				<div class="card-body">
					{!! Form::open(['action' => ['ContactController@store'], 'method' => 'POST']) !!}
						<div class="form-row">
							<div class="form-group col-sm-6 col-12">
								{{ Form::label('first_name', 'First Name', ['class' => 'form-control-label']) }}
								{{ Form::text('first_name', '', ['class' => 'form-control']) }}
								
								@if ($errors->has('first_name'))
									<span class="text-danger">First Name cannot be empty</span>
								@endif
							</div>
							<div class="form-group col-sm-6 col-12">
								{{ Form::label('last_name', 'Last Name', ['class' => 'form-control-label']) }}
								{{ Form::text('last_name', '', ['class' => 'form-control']) }}
								
								@if ($errors->has('last_name'))
									<span class="text-danger">Last Name cannot be empty</span>
								@endif
							</div>
						</div>
						<div class="form-group">
							{{ Form::label('email', 'Email Address', ['class' => 'form-control-label']) }}
							<input type="email" name="email" class="form-control" value="{{ old('email') }}" />
						</div>
						<div class="form-group">
							{{ Form::label('phone', 'Phone', ['class' => 'form-control-label']) }}
							<input type="text" name="phone" class="form-control" value="{{ old('phone') }}" />
						</div>
						<div class="form-group">
							{{ Form::label('family_size', 'Family Size', ['class' => 'form-control-label']) }}
							<input type="number" name="family_size" class="form-control" value="{{ old('family_size') }}" min='1' />
						</div>
						<div class="form-group">
							{{ Form::label('dob', 'Date of Birth', ['class' => 'form-control-label']) }}
							<input type="date" name="dob" class="form-control" value="{{ old('dob') }}" min='1' />
						</div>
						<div class="form-group">
							{{ Form::label('tenant', 'Current Tenant', ['class' => 'd-block form-control-label']) }}
							
							<div class="btn-group">
								<button type="button" class="btn btn-secondary pb-5" style="line-height:1.5">
									<input type="checkbox" name="tenant" value="Y" hidden />Yes
								</button>
								<button type="button" class="btn px-3 pb-5 btn-danger active" style="line-height:1.5">
									<input type="checkbox" name="tenant" value="N" checked hidden />No
								</button>
							</div>
							<div class="btn-group tenantProp" style="display:none;">
								<select class="py-2" name="property_id">
									@foreach($properties as $property)
										<option value="{{ $property->id }}" {{ $property->tenant ? 'disabled' : '' }}>{{ $property->address }}{{ $property->tenant ? ' - Occupied' : '' }}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="form-group">
							{{ Form::submit('Add Contact', ['class' => 'btn btn-primary form-control pb-5', 'style' => 'line-height:1.5;']) }}
						</div>
					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

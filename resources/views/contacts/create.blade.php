@extends('layouts.app')

@section('content')
<div class="row">
	<div class="">
		<a href="/contacts" class="btn btn-success">All Contacts</a>
	</div>
	<div class="col col-3 col-md-6 mx-auto my-3">
		<div class="card">
			<img src="/images/empty_face.jpg" class="card-img-top" />
			<div class="card-body">
				{!! Form::open(['action' => ['ContactController@store'], 'method' => 'POST']) !!}
					<div class="form-group">
						{{ Form::label('first_name', 'First Name', ['class' => 'form-control-label']) }}
						{{ Form::text('first_name', '', ['class' => 'form-control']) }}
						
						@if ($errors->has('first_name'))
							<span class="text-danger">First Name cannot be empty</span>
						@endif
					</div>
					<div class="form-group">
						{{ Form::label('last_name', 'Last Name', ['class' => 'form-control-label']) }}
						{{ Form::text('last_name', '', ['class' => 'form-control']) }}
						
						@if ($errors->has('last_name'))
							<span class="text-danger">Last Name cannot be empty</span>
						@endif
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
							<button type="button" class="btn">
								<input type="checkbox" name="tenant" value="Y" hidden />Yes
							</button>
							<button type="button" class="btn px-3  btn-danger active">
								<input type="checkbox" name="tenant" value="N" checked hidden />No
							</button>
						</div>
					</div>
					<div class="form-group">
						{{ Form::submit('Add Contact', ['class' => 'btn btn-primary form-control']) }}
					</div>
				{!! Form::close() !!}
				
			</div>
		</div>
	</div>
</div>
@endsection

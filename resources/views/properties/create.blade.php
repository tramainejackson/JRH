@extends('layouts.app')
@section('addt_style')
	<link href="{{ asset('/css/mat.css') }}" rel="stylesheet">
@endsection
@section('content')
<div class="container-fluid">
	<div class="row">
	<div class="d-table d-sm-none" style="height:120px">&nbsp;</div>
		<div class="col-sm-3 col-12 text-center">
			<a href="/properties" class="btn btn-success d-block mt-2">All Properties</a>
		</div>
		<div class="col-sm-8 col-12 mx-auto">
			<div class="card">
				<img src="/images/empty_prop.png" class="card-img-top" height="300" />
				<div class="card-body">
					{!! Form::open(['action' => ['PropertyController@store'], 'method' => 'POST']) !!}
						<div class="form-group">
							{{ Form::label('address', 'Address', ['class' => 'form-control-label']) }}
							{{ Form::text('address', '', ['class' => 'form-control', 'placeholder' => 'Property Address']) }}
							
							@if ($errors->has('address'))
								<span class="text-danger">Address cannot be empty</span>
							@endif
						</div>
						<div class="form-row">
							<div class="form-group col-12 col-sm-5">
								{{ Form::label('city', 'City', ['class' => 'form-control-label']) }}
								{{ Form::text('city', 'Philadelphia', ['class' => 'form-control', 'placeholder' => 'City']) }}
								
								@if ($errors->has('city'))
									<span class="text-danger">City cannot be empty</span>
								@endif
							</div>
							<div class="form-group col-6 col-sm-3">
								{{ Form::label('state', 'State', ['class' => 'form-control-label']) }}
								<select class="custom-select w-100 py-2" name="state" style="height:initial;">
									@foreach($states as $state)
										<option value="{{ $state->state }}" {{ $state->state == "PA" ? 'selected' : '' }}>{{ $state->state }}</option>
									@endforeach
								</select>
							</div>
							<div class="form-group col-6 col-sm-3">
								{{ Form::label('zip', 'Zip Code', ['class' => 'form-control-label']) }}
								{{ Form::text('zip', '', ['class' => 'form-control', 'placeholder' => 'Zip Code']) }}
								
								@if ($errors->has('zip'))
									<span class="text-danger">Zip code cannot be empty</span>
								@endif
							</div>
						</div>
						<div class="form-group">
							{{ Form::label('title', 'Title', ['class' => 'form-control-label']) }}
							{{ Form::text('title', '', ['class' => 'form-control', 'placeholder' => 'Title will show for showcase property']) }}
						</div>
						<div class="form-group">
							{{ Form::label('description', 'Description', ['class' => 'form-control-label']) }}
							{{ Form::textarea('description', '', ['class' => 'form-control', 'rows' => '3', 'placeholder' => 'Description of Property. Max 500 Characters']) }}
							
							@if ($errors->has('description'))
								<span class="text-danger">Description cannot be empty</span>
							@endif
						</div>
						<div class="form-group">
							{{ Form::label('price', 'Price', ['class' => 'form-control-label']) }}
							<div class="input-group">
								<span class="input-group-addon">$</span>
								<input type="number" name="price" class="form-control" value="{{ old('price') }}" min='1' placeholder="Monthly Rent Amount" />
								<span class="input-group-addon">/per month</span>
							</div>
						</div>
						<div class="form-group">
							{{ Form::label('available_date', 'Available Date', ['class' => 'form-control-label']) }}
							<input type="date" name="available_date" class="form-control" value="{{ old('available_date') }}" min='1' />
						</div>
						<div class="form-row">
							<div class="form-group col-12">
								{{ Form::label('type', 'Type', ['class' => 'd-block form-control-label']) }}
								
								<div class="d-inline">
									<button type="button" class="btn aptBtn active btn-success">
										<input type="checkbox" name="type" value="apartment" checked hidden />Apartment
									</button>
								</div>
								<div class="d-inline">
									<button type="button" class="btn px-3 houseBtn">
										<input type="checkbox" name="type" value="house" hidden />House
									</button>
								</div>
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-4">
								{{ Form::label('active', 'Active', ['class' => 'd-block form-control-label']) }}
								
								<div class="btn-group">
									<button type="button" class="btn">
										<input type="checkbox" name="active" value="Y" hidden />Yes
									</button>
									<button type="button" class="btn px-3  btn-danger active">
										<input type="checkbox" name="active" value="N" checked hidden />No
									</button>
								</div>
							</div>
							<div class="form-group col-4">
								{{ Form::label('showcase', 'Showcase', ['class' => 'd-block form-control-label']) }}
								
								<div class="btn-group">
									<button type="button" class="btn">
										<input type="checkbox" name="showcase" value="Y" hidden />Yes
									</button>
									<button type="button" class="btn px-3  btn-danger active">
										<input type="checkbox" name="showcase" value="N" checked hidden />No
									</button>
								</div>
							</div>
						</div>
						<div class="form-group">
							{{ Form::submit('Add Property', ['class' => 'btn btn-primary form-control mt-3 pb-5', 'style' => 'line-height:1.4']) }}
						</div>
					{!! Form::close() !!}
					
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@extends('layouts.app')

@section('addt_style')
@endsection

@section('content')
<div class="container-fluid" id="content_container">
	<div class="row">
		<div class="col-12 col-md-12 col-lg-6 col-xl-6 text-center my-3 mx-auto">
			<a href="/properties" class="btn btn-success d-block mt-2">All Properties</a>
		</div>
		<div class="col-12 col-md-12 col-lg-8 col-xl-8 mx-auto mb-3">
			<div class="card">
				<div class="card-header">
					<h2 class="">Create New Property</h2>
				</div>
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
								<select class="custom-select browser-default" name="state" style="height:initial;">
									@foreach($states as $state)
										<option value="{{ $state->state }}" {{ $state->state == "PA" ? 'selected' : '' }}>{{ $state->state }}</option>
									@endforeach
								</select>
							</div>
							<div class="form-group col">
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
							{{ Form::textarea('description', '', ['class' => 'form-control', 'rows' => '3', 'placeholder' => 'Description of Property. Max 500 Characters', 'style' => 'height:auto']) }}
							
							@if ($errors->has('description'))
								<span class="text-danger">Description cannot be empty</span>
							@endif
						</div>
						<div class="form-group">
							{{ Form::label('price', 'Price', ['class' => 'form-control-label']) }}
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text">$</span>
								</div>
								
								<input type="number" name="price" class="form-control" value="{{ old('price') }}" min='1' placeholder="Monthly Rent Amount" />
								
								<div class="input-group-append">
									<span class="input-group-text">/per month</span>
								</div>
							</div>
						</div>
						<div class="form-group">
							{{ Form::label('available_date', 'Available Date', ['class' => 'form-control-label']) }}
							<input type="text" name="available_date" id="datetimepicker" class="form-control" value="{{ old('available_date') }}" placeholder="Add Available Start Date" />
						</div>
						<div class="form-row">
							<div class="form-group col-12">
								{{ Form::label('type', 'Type', ['class' => 'd-block form-control-label']) }}
								
								<div class="d-block d-sm-inline">
									<button type="button" class="btn w-100 aptBtn active btn-success">
										<input type="checkbox" name="type" value="apartment" checked hidden />Apartment
									</button>
								</div>
								<div class="d-block d-sm-inline mt-2 mt-sm-0">
									<button type="button" class="btn w-100 btn-blue-grey houseBtn">
										<input type="checkbox" name="type" value="house" hidden />House
									</button>
								</div>
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-12 col-md-4 text-center">
								{{ Form::label('active', 'Active', ['class' => 'd-block form-control-label']) }}
								
								<div class="btn-group">
									<button type="button" class="btn btn-success active activeYes activeProp">
										<input type="checkbox" name="active" value="Y" checked hidden />Yes
									</button>
									<button type="button" class="btn btn-blue-grey activeNo activeProp">
										<input type="checkbox" name="active" value="N" hidden />No
									</button>
								</div>
							</div>
							<div class="form-group col-12 col-md-4 text-center">
								{{ Form::label('construction', 'Under Construction', ['class' => 'd-block form-control-label']) }}
								
								<div class="btn-group">
									<button type="button" class="btn btn-blue-grey activeUnderConstr underConstr">
										<input type="checkbox" name="construction" value="Y" hidden />Yes
									</button>
									<button type="button" class="btn active btn-danger noUnderConstr  underConstr">
										<input type="checkbox" name="construction" value="N" checked hidden />No
									</button>
								</div>
							</div>
							<div class="form-group col-12 col-md-4 text-center">
								{{ Form::label('showcase', 'Showcase', ['class' => 'd-block form-control-label']) }}
								
								<div class="btn-group">
									<button type="button" class="btn btn-blue-grey">
										<input type="checkbox" name="showcase" value="Y" hidden />Yes
									</button>
									<button type="button" class="btn btn-danger active">
										<input type="checkbox" name="showcase" value="N" checked hidden />No
									</button>
								</div>
							</div>
						</div>
						<div class="form-group">
							{{ Form::submit('Add Property', ['class' => 'btn btn-primary ml-0 mt-3', 'style' => 'line-height:1.4']) }}
						</div>
					{!! Form::close() !!}
					
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

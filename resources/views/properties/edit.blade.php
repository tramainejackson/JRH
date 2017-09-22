@extends('layouts.app')

@section('content')
<div class="row">
	<div class="col">
		{!! Form::model($property, ['action' => ['PropertyController@update', $property->id], 'method' => 'PATCH', 'files' => true]) !!}
			<div class="form-group">
				{{ Form::label('address', 'Address', ['class' => 'form-control-label']) }}
				<input type="text" name="address" class="form-control" value="{{ $property->address }}" />
				
				@if ($errors->has('address'))
					<span class="text-danger">Address cannot be empty</span>
				@endif
			</div>
			<div class="form-group">
				{{ Form::label('description', 'Description', ['class' => 'form-control-label']) }}
				<textarea name="description" class="form-control" row="3">{{ $property->description }}</textarea>
				
				@if ($errors->has('description'))
					<span class="text-danger">Description cannot be empty</span>
				@endif
			</div>
			<div class="form-group">
				{{ Form::label('price', 'Price', ['class' => 'form-control-label']) }}
				<div class="input-group">
					<span class="input-group-addon">$</span>
					<input type="number" name="price" class="form-control" value="{{ $property->price }}" min='1' />
					{!! $property->rental == 'Y' ? '<span class="input-group-addon">/per month</span>' : '' !!}
				</div>
			</div>
			<div class="form-group">
				{{ Form::label('active', 'Active', ['class' => 'd-block form-control-label']) }}
				
				<div class="btn-group">
					<button type="button" class="btn {{ $property->active == 'Y' ? 'btn-success active' : '' }}">
						<input type="checkbox" name="active" value="Y" hidden {{ $property->active == 'Y' ? 'checked' : '' }} />Yes
					</button>
					<button type="button" class="btn px-3 {{ $property->active == 'N' ? 'btn-danger active' : '' }}">
						<input type="checkbox" name="active" value="N" {{ $property->active == 'N' ? 'checked' : '' }} hidden />No
					</button>
				</div>
			</div>
			<div class="form-group">
				{{ Form::label('rental', 'Rental', ['class' => 'd-block form-control-label']) }}
				
				<div class="btn-group">
					<button type="button" class="btn {{ $property->rental == 'Y' ? 'btn-success active' : '' }}">
						<input type="checkbox" name="rental" value="Y" hidden {{ $property->rental == 'Y' ? 'checked' : '' }} />Yes
					</button>
					<button type="button" class="btn px-3 {{ $property->rental == 'N' ? 'btn-danger active' : '' }}">
						<input type="checkbox" name="rental" value="N" {{ $property->rental == 'N' ? 'checked' : '' }} hidden />No
					</button>
				</div>
			</div>
			<div class="form-group">
				{{ Form::label('showcase', 'Showcase', ['class' => 'd-block form-control-label']) }}
				
				<div class="btn-group">
					<button type="button" class="btn {{ $property->showcase == 'Y' ? 'btn-success active' : '' }}">
						<input type="checkbox" name="showcase" value="Y" {{ $property->active == 'Y' ? 'checked' : '' }} hidden />Yes
					</button>
					<button type="button" class="btn px-3 {{ $property->showcase == 'N' ? 'btn-danger active' : '' }}">
						<input type="checkbox" name="showcase" value="N" {{ $property->active == 'N' ? 'checked' : '' }} hidden />No
					</button>
				</div>
			</div>
			<div class="form-group">
				{{ Form::label('media', 'Media', ['class' => 'form-control-label']) }}
				{{ Form::file('media') }}
			</div>
			<div class="form-group">
				<a href="#" class="viewPropMedia">View Media</a>
			</div>
			<div class="form-group">
				{{ Form::submit('Update', ['class' => 'form-control btn btn-primary']) }}
				<button class="btn btn-danger w-100 mt-2 deleteBtn" type="button" data-toggle="modal" data-target="#delete_modal">Delete</button>
			</div>
		{!! Form::close() !!}
	</div>
</div>
<div class="row">
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
						<input type="email" class="" value="{{ $property->email }}" disabled />
					</div>
					<div class="form-group">
						<label class="form-control-label">Team Name</label>
						<input type="text" class="" value="{{ $property->team_name }}" disabled />
					</div>
					<div class="form-group">
						<label class="form-control-label">Player 1</label>
						<input type="text" class="" value="{{ $property->player_1 }}" disabled />
					</div>
					<div class="form-group">
						<label for="team_name" class="form-control-label">Player 2</label>
						<input type="text" class="" value="{{ $property->player_2 }}" disabled />
					</div>
					<div class="form-group">
						<label class="d-block form-control-label">Current Tenant</label>
						
						<div class="btn-group">
							<button type="button" class="btn {{ $property->tenant == 'Y' ? 'btn-success active' : '' }}" disabled >
								<input type="checkbox" name="tenant" value="Y" hidden {{ $property->tenant == 'Y' ? 'checked' : '' }} />Yes
							</button>
							<button type="button" class="btn {{ $property->tenant == 'N' ? 'btn-danger active' : '' }}" disabled>
								<input type="checkbox" name="tenant" value="N" hidden {{ $property->tenant == 'N' ? 'checked' : '' }} />No
							</button>
						</div>
					</div>
					{!! Form::model($property, ['action' => ['PropertyController@destroy', $property->id], 'method' => 'DELETE']) !!}
						<div class="form-group">
							{{ Form::submit('Delete', ['class' => 'form-control btn btn-danger']) }}
							<button class="btn btn-warning form-control cancelBtn" type="button">Cancel</button>
						</div>
					{!! Form::close() !!}
				</div>
				<div class="modal-footer">
					
				</div>
			</div>
		</div>
	</div>
</div>
@if($property->medias)
@php $medias = $property->medias; @endphp
<div class="row">
	<div class="modal fade" id="property_media" role="dialog" aria-hidden="true" tabindex="1">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Property Media</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body text-dark">
					@foreach($medias as $media)
						<img src="{{ asset('storage/' . str_ireplace('public/', '', $media->path)) }}" class="img-fluid img-thumbnail float-left media-modal-item" />
					@endforeach
				</div>
			</div>
		</div>
	</div>
</div>
@endif
@endsection

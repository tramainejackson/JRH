@extends('layouts.app')
@section('addt_style')
	<link href="{{ asset('/css/mat.css') }}" rel="stylesheet">
@endsection
@section('content')
@if(session('status'))
	<h2 class="flashMessage">{{ session('status') }}</h2>
@endif
<div class="d-table d-sm-none" style="height:120px">&nbsp;</div>
<div class="container py-3">
	{!! Form::model($setting, ['action' => ['SettingsController@update', $setting->id], 'method' => 'PATCH', 'files' => true]) !!}
		<div class="row">
			<div class="col-12">
				<h1 class="text-muted">Home Page Settings</h1>
			</div>
			<div class="col">
				<div class="form-group">
					{{ Form::label('show_welcome', 'Show Welcome', ['class' => 'd-block form-control-label']) }}
					
					<div class="btn-group">
						<button type="button" class="btn pb-5{{ $setting->show_welcome == 'Y' ? ' btn-success active' : ' btn-secondary' }}" style="line-height:1.5">
							<input type="checkbox" name="show_welcome" value="Y" hidden {{ $setting->show_welcome == 'Y' ? 'checked' : '' }} />Yes
						</button>
						<button type="button" class="btn pb-5 px-3{{ $setting->show_welcome == 'N' ? ' btn-danger active' : ' btn-secondary' }}" style="line-height:1.5">
							<input type="checkbox" name="show_welcome" value="N" hidden {{ $setting->show_welcome == 'N' ? 'checked' : '' }} />No
						</button>
					</div>
				</div>
				<div class="form-group">
					{{ Form::label('welcome_content', 'Welcome Dropdown Content', ['class' => 'd-block form-control-label']) }}
					<textarea name="welcome_content" class="form-control" placeholder="Content will display in dropdown on welcome page">{{ $setting->welcome_content }}</textarea>
				</div>
				<div class="form-group">
					<fieldset>
						<legend class="w-sm-25 w-75">Welcome Media</legend>
						@if($setting->welcome_media == null)
							<span class="text-danger" style="font-size:100% !important;">No image or video added for the dropdown on welcome page</span>
						@else
							<div class="text-center">
								<img class="img-fluid" src="{{ asset('storage/' . str_ireplace('public/', '', $setting->welcome_media)) }}" />
							</div>
						@endif
						{{ Form::file('welcome_media', ['class' => 'd-block form-control-label mw-100']) }}
					</fieldset>
				</div>
				<div class="form-group">
					<fieldset>
						<legend class="w-sm-25 w-75">Carousel Images</legend>
						@if($setting->carousel_images == null)
							<span class="text-danger" style="font-size:75% !important;">No image or video added for the dropdown on welcome page</span>
							{{ Form::file('carousel_images', ['class' => 'd-block form-control-label']) }}
						@else
							<div class="">
								@php $carouselImages = explode(';', $setting->carousel_images); @endphp
								@foreach($carouselImages as $carouselImage)	
									<div class="d-block mx-auto mb-2 d-sm-inline-block" style="height:250px; width:250px; position:relative">
										<img class="img-thumbnail h-100 w-100" src="{{ asset('storage/images/' . trim($carouselImage)) }}" />
										<a href="#" class="removeImage text-hide" style=""></a>
									</div>
								@endforeach
								
								@if(count($carouselImages) >= 4)
									<span class="d-block text-danger" style="font-size:75% !important;">Max number of media items have been added</span>
								@else
									{{ Form::file('carousel_images', ['class' => 'd-block form-control-label mw-100']) }}
								@endif
							</div>
						@endif
					</fieldset>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-12">
				<h1 class="text-muted">Mission Statement</h1>
			</div>
			<div class="col">
				<div class="form-group">
					{{ Form::label('mission', 'Mission Statement', ['class' => 'd-block form-control-label']) }}
					<textarea name="mission" class="form-control" placeholder="Content will display in dropdown on welcome page" rows="5">{{ $setting->mission }}</textarea>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-12">
				<h1 class="text-muted">Contact Settings</h1>
			</div>
			<div class="col-12">
				<div class="form-group">
					{{ Form::label('phone', 'Phone', ['class' => 'd-block form-control-label']) }}
					<input type="number" name="phone" class="form-control" value="{{ $setting->phone }}" placeholder="Phone" />
				</div>
			</div>
			<div class="col-12">
				<div class="form-group">
					{{ Form::label('email', 'Email', ['class' => 'd-block form-control-label']) }}
					<input type="email" name="email" class="form-control" value="{{ $setting->email }}" placeholder="Phone" />
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-12">
				<h1 class="text-muted">Properties Settings</h1>
			</div>
			<div class="col">
				<div class="form-group">
					{{ Form::label('show_deletes', 'Show Deleted Items', ['class' => 'd-block form-control-label']) }}
					
					<div class="btn-group">
						<button type="button" class="btn pb-5{{ $setting->show_deletes == 'Y' ? ' btn-success active' : ' btn-secondary' }}" style="line-height:1.5">
							<input type="checkbox" name="show_deletes" value="Y" hidden {{ $setting->show_deletes == 'Y' ? 'checked' : '' }} />Yes
						</button>
						<button type="button" class="btn pb-5 px-3{{ $setting->show_deletes == 'N' ? ' btn-danger active' : ' btn-secondary' }}" style="line-height:1.5">
							<input type="checkbox" name="show_deletes" value="N" hidden {{ $setting->show_deletes == 'N' ? 'checked' : '' }} />No
						</button>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col">
				<div class="form-group">
					{{ Form::submit('Save Changes', ['class' => 'form-control btn btn-primary pb-5', 'style' => 'line-height:1.5;']) }}
				</div>
			</div>
		</div>
	{!! Form::close() !!}

	<div class="modal fade" id="delete_modal" role="dialog" aria-hidden="true" tabindex="1">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Delete Carousel Image</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body text-dark">
					<div class="">
						<p class="">Are you sure that you want to delete this carousel image?</p>
					</div>
					<div class="">
						{!! Form::open(['action' => ['SettingsController@destroy', 1], 'method' => 'DELETE']) !!}
							<input type="text" name="carouselImageD" class="carouselImageD" value="" hidden />
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

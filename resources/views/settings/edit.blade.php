@extends('layouts.app')

@section('content')
<div class="row">
	<div class="col col-12">
		<h1 class="text-muted">Home Page Settings</h1>
	</div>
	<div class="col">
		{!! Form::model($setting, ['action' => ['SettingsController@update', $setting->id], 'method' => 'PATCH', 'files' => true]) !!}
			<div class="form-group">
				{{ Form::label('show_welcome', 'Show Welcome', ['class' => 'd-block form-control-label']) }}
				
				<div class="btn-group">
					<button type="button" class="btn {{ $setting->show_welcome == 'Y' ? 'btn-success active' : '' }}">
						<input type="checkbox" name="show_welcome" value="Y" hidden {{ $setting->show_welcome == 'Y' ? 'checked' : '' }} />Yes
					</button>
					<button type="button" class="btn px-3 {{ $setting->show_welcome == 'N' ? 'btn-danger active' : '' }}">
						<input type="checkbox" name="show_welcome" value="N" hidden {{ $setting->show_welcome == 'N' ? 'checked' : '' }} />No
					</button>
				</div>
			</div>
			<div class="form-group">
				{{ Form::label('welcome_content', 'Welcome Dropdown Content', ['class' => 'd-block form-control-label']) }}
				<textarea name="welcome_content" class="form-control" placeholder="Content will display in dropdown on welcome page">{{ $setting->welcome_content }}</textarea>
			</div>
			<div class="form-group">
				{{ Form::label('welcome_media', 'Welcome Media', ['class' => 'd-block form-control-label']) }}
				@if($setting->welcome_media == null)
					<span class="text-danger" style="font-size:75% !important;">No image or video added for the dropdown on welcome page</span>
				@else
					<div class="embed-responsive embed-responsive-1by1">
					  <iframe class="embed-responsive-item" src="{{ asset('storage/' . str_ireplace('public/', '', $setting->welcome_media)) }}" allowfullscreen></iframe>
					</div>
				@endif
				{{ Form::file('welcome_media', ['class' => 'd-block form-control-label']) }}
			</div>
			<div class="form-group">
				<h1 class="text-muted">Properties and Contacts Settings</h1>
			</div>
			<div class="form-group">
				{{ Form::label('show_deletes', 'Show Deleted Items', ['class' => 'd-block form-control-label']) }}
				
				<div class="btn-group">
					<button type="button" class="btn {{ $setting->show_deletes == 'Y' ? 'btn-success active' : '' }}">
						<input type="checkbox" name="show_deletes" value="Y" hidden {{ $setting->show_deletes == 'Y' ? 'checked' : '' }} />Yes
					</button>
					<button type="button" class="btn px-3 {{ $setting->show_deletes == 'N' ? 'btn-danger active' : '' }}">
						<input type="checkbox" name="show_deletes" value="N" hidden {{ $setting->show_deletes == 'N' ? 'checked' : '' }} />No
					</button>
				</div>
			</div>
			<div class="form-group">
				{{ Form::submit('Update', ['class' => 'form-control btn btn-primary']) }}
			</div>
		{!! Form::close() !!}
	</div>
</div>
@endsection

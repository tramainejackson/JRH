@extends('layouts.app')

@section('content')
<div class="row">
	<div class="col">
		{!! Form::model($settings, ['action' => ['SettingsController@update', $settings->id], 'method' => 'PATCH']) !!}
			<div class="form-group">
				{{ Form::label('show_welcome', 'Show Welcome', ['class' => 'd-block form-control-label']) }}
				
				<div class="btn-group">
					<button type="button" class="btn {{ $settings->show_welcome == 'Y' ? 'btn-success active' : '' }}">
						<input type="checkbox" name="show_welcome" value="Y" hidden {{ $settings->show_welcome == 'Y' ? 'checked' : '' }} />Yes
					</button>
					<button type="button" class="btn px-3 {{ $settings->show_welcome == 'N' ? 'btn-danger active' : '' }}">
						<input type="checkbox" name="show_welcome" value="N" hidden {{ $settings->show_welcome == 'N' ? 'checked' : '' }} />No
					</button>
				</div>
			</div>
			<div class="form-group">
				{{ Form::label('show_deletes', 'Show Deleted Items', ['class' => 'd-block form-control-label']) }}
				
				<div class="btn-group">
					<button type="button" class="btn {{ $settings->show_deletes == 'Y' ? 'btn-success active' : '' }}">
						<input type="checkbox" name="show_deletes" value="Y" hidden {{ $settings->show_deletes == 'Y' ? 'checked' : '' }} />Yes
					</button>
					<button type="button" class="btn px-3 {{ $settings->show_deletes == 'N' ? 'btn-danger active' : '' }}">
						<input type="checkbox" name="show_deletes" value="N" hidden {{ $settings->show_deletes == 'N' ? 'checked' : '' }} />No
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

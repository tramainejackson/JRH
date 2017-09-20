@extends('layouts.app')

@section('content')
<div class="row">
	<div class="col">
		{!! Form::model($teams, ['action' => ['TeamController@update', $teams->id], 'method' => 'PATCH']) !!}
			<div class="form-group">
				{{ Form::label('email', 'Email Address', ['class' => 'form-control-label text-white']) }}
				{{ Form::email('email') }}
			</div>
			<div class="form-group">
				{{ Form::label('team_name', 'Team Name', ['class' => 'form-control-label text-white']) }}
				{{ Form::text('team_name') }}
			</div>
			<div class="form-group">
				{{ Form::label('player1', 'Player 1 Name', ['class' => 'form-control-label text-white']) }}
				{{ Form::text('player_1') }}
			</div>
			<div class="form-group">
				{{ Form::label('player2', 'Player 2 Name', ['class' => 'form-control-label text-white']) }}
				{{ Form::text('player_2') }}
			</div>
			<div class="form-group">
				{{ Form::label('pif', 'Paid in Full', ['class' => 'd-block form-control-label text-white']) }}
				
				<div class="btn-group">
					<button type="button" class="btn {{ $teams->pif == 'Y' ? 'btn-success active' : '' }}">
						<input type="checkbox" name="pif" value="Y" hidden {{ $teams->pif == 'Y' ? 'checked' : '' }} />Yes
					</button>
					<button type="button" class="btn px-3 {{ $teams->pif == 'N' ? 'btn-danger active' : '' }}">
						<input type="checkbox" name="pif" value="N" hidden {{ $teams->pif == 'N' ? 'checked' : '' }} />No
					</button>
				</div>
			</div>
			<div class="form-group">
				{{ Form::submit('Update', ['class' => 'form-control btn btn-primary']) }}
				<button class="btn btn-danger w-100 mt-2" type="button" data-toggle="modal" data-target="#delete_modal">Delete</button>
			</div>
		{!! Form::close() !!}
	</div>
</div>
@endsection

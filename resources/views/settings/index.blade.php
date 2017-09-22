@extends('layouts.app')

@section('content')
@if(session('status'))
	<h2 class="">{{ session('status') }}</h2>
@endif
<div class="row">
	<div class="col col-4">
		<div class="card">
			<div class="card-header">
				<h2 class="text-center"><a href="settings/{{ $settings->id}}/edit" class="btn btn-warning">Edit Settings</a></h2>
			</div>
			<div class="card-body">
				<ul class="settingsInfo">
					<li class="settingsItem">{{ $settings->show_welcome }}</li>
					<li class="settingsItem">{{ $settings->show_deletes }}</li>
				</ul>
			</div>
			<div class="card-footer">
				<p class="text-center">{{ $settings->tenant == "Y" ? "Current Tenant" : "" }}</p>
			</div>
		</div>
	</div>
</div>
@endsection

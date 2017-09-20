@extends('layouts.app')

@section('content')
<div class="row">
    @if($contacts->isNotEmpty())
		@if(session('status'))
			<h2 class="">{{ session('status') }}</h2>
		@endif
		@foreach($contacts as $contact)
			<div class="col col-4">
				<div class="card">
					<div class="card-header">
						<h2 class="">{{ $contact->first_name }}</h2>
					</div>
					<div class="card-body">
						
					</div>
					<div class="card-footer">
						
					</div>
				</div>
			</div>
		@endforeach
	@else
		<div class="col">
			<h2 class="text-center">You haven't added any contacts yet</h2>
			<h4 class="text-center">Click <a href="/contacts/create" class="">here</a> to create your first contact</h4>
		</div>
	@endif
</div>
@endsection

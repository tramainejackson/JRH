@extends('layouts.app')

@section('addt_script')
	<script type="text/javascript">
		$(document).ready(function() {
			// Add a button to select all recipients when sending mass email
			$('<button type="button" class="selectAllContacts btn btn-primary btn-sm mx-0">Select All</button>').appendTo('.select-dropdown .search-wrap');
			
			$('body').on('click', '.selectAllContacts', function(e) {
				var listItems = $('.select-dropdown li');
				var selectOption = $('.select-wrapper select[name="send_to[]"] option');

				$(listItems).each(function() {
					var listItemInput = $(this).find('input[type="checkbox"]');

					// If the item is not disabled then select
					if(!$(this).hasClass('disabled')) {
						$(this).addClass('selected');
						$(listItemInput).attr('checked', 'checked');
					}
				});

				$(selectOption).each(function() {
					// If the item is not disabled then select
					if(!$(this).attr('disabled')) {
						$(this).attr('selected', true);
					}
				});

				$('div.select-wrapper input.select-dropdown').val('All Recipients Selected');
			});
		});
	</script>
	
	@if($duplicates->count() > 0)
		<script type="text/javascript">
			$('#duplicates_modal').modal('show');
		</script>
	@endif
@endsection

@section('content')
	<div id="content_container" class="jumbotron jumbotron-fluid py-5 d-flex align-items-center contactsJumbotron">
		<div class="container-fluid py-5">
			<h2 class="py-5 text-white display-4">Growth and development of our communities are the core of our pursuit.</h2>
		</div>
	</div>
	<div class="container-fluid">
		@if(session('status'))
			<h2 class="flashMessage">{{ session('status') }}</h2>
		@endif
		<div class="row">
			@if($contacts->isNotEmpty())
				<div class="col-12 col-md-8 col-lg-6 text-center mb-4 mx-auto">
					<div class="container-fluid">
						<a href="/contacts/create" class="btn btn-success d-block d-sm-inline">Add New Contact</a>
						
						@if($contacts->count() > 0)
							<a href="#" class="btn purple d-block d-sm-inline" type="button" data-toggle="modal" data-target="#email_modal"><i class="fa fa-envelope" aria-hidden="true"></i>&nbsp;Email Contacts</a>
						@endif
						
						<p class="my-3"><i>Total Contacts:</i>&nbsp;<span class="text-muted">{{ $contactsCount }}</span></p>
					</div>
					<div class="container-fluid">
						{!! Form::open(['action' => 'ContactController@search', 'method' => 'POST', 'id' => 'search-form']) !!}
							<div class="md-form input-group">
								<input type="text" name="search" class="form-control valueSearch" value="{{ request()->query('search') ? request()->query('search') : '' }}" placeholder="Contacts Search" />

								<div class="input-group-btn">
									<button class="btn btn-outline-success searchBtn" type="button" onclick="event.preventDefault(); document.getElementById('search-form').submit();">
										<i class="fa fa-search" aria-hidden="true"></i>
									</button>
								</div>
						{!! Form::close() !!}
						</div>
					</div>
					
					@if($duplicates->count() > 0)
						<div class="modal fade" id="duplicates_modal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true" data-backdrop="false">
							<div class="modal-dialog modal-side modal-top-right">
								<div class="modal-content">
									<div class="modal-body">
										<h2 class="">You May Have Some Duplicate Records. Would You Like To Check?</h2>

										<a href="{{ route('contacts.dupes') }}" class="btn btn-lg teal darken-2" type="button">Check Duplicates</a>
										
										<button class="btn btn-lg btn-outline-warning" type="button" data-dismiss="modal">Maybe Later</button>
									</div>
								</div>
							</div>
						</div>
					@endif
				</div>
				<div class="col-md-12 col-lg-12 col-12">
					<div class="container-fluid">
						
						{{ $contacts->links() }}
						
						<!-- Display for mobile screen -->
						<div class="row d-sm-none d-flex">
							@foreach($contacts as $contact)
								<div class="col-md-6 col-12 contactList">
									<div class="card mb-3">
										<div class="card-header container-fluid d-sm-flex align-items-center">
											<a class="btn btn-warning d-block d-sm-inline float-sm-right mb-2 mb-sm-2" href="/contacts/{{ $contact->id }}/edit" class="">Edit</a>
											<h1 class="text-center col-sm-8 col-12 mr-auto">{{ $contact->first_name . ' ' . $contact->last_name }}</h1>
										</div>
										<div class="card-body container-fluid">
											<div class="row">
												<span class="oi oi-person col-1 text-center" title="person" aria-hidden="true"></span>
												<span class="col-sm-11 col-10 text-truncate">{{ $contact->first_name . " " . $contact->last_name }}</span>
											</div>
											<div class="row">
												<span class="oi oi-envelope-closed col-1 text-center" title="envelope-closed" aria-hidden="true"></span>
												<span class="col-sm-11 col-10 text-truncate">{{ $contact->email != null ? $contact->email : 'N/A' }}</span>
											</div>
											<div class="row">
												<span class="oi oi-phone col-1 text-center" title="phone" aria-hidden="true"></span>
												<span class="col-sm-11 col-10 text-truncate">{{ $contact->phone != null ? $contact->phone : 'N/A' }}</span>
											</div>
											<div class="row">
												<span class="oi oi-people col-1 text-center" title="people" aria-hidden="true"></span>
												<span class="col-sm-11 col-10 text-truncate">Family of {{ $contact->family_size != null ? $contact->family_size : 1 }}</span>
											</div>
											<div class="row">
												@php $dobFormat = new Carbon\Carbon($contact->dob); @endphp
												<span class="oi oi-calendar col-1 text-center" title="calendar" aria-hidden="true"></span>
												<span class="col-sm-11 col-10 text-truncate">DOB: {{ $contact->dob != null ? $dobFormat->toFormattedDateString() : 'N/A' }}</span>
											</div>
										</div>
										<div class="card-footer">
											<p class="text-center">{!! $contact->tenant == "Y" ? "<span class='oi oi-check text-success' title='icon name' aria-hidden='true'></span>" : "<span class='oi oi-x text-danger' title='icon name' aria-hidden='true'></span>" !!}&nbsp;Current Tenant</p>
										</div>
									</div>
								</div>
							@endforeach
						</div>
						
						<!-- Display for non-mobile screen -->
						<div class="row d-none d-sm-flex">
							@foreach($contacts as $contact)
								<div class="col-12 contactList">
									<div class="container-fluid">
										<div class="row">
											<div class="col-4">
												<img src="{{ $contact->image != null ? asset(str_ireplace('public', 'storage', $contact->image->path)) : asset('images/empty_face.jpg') }}" class="img-fluid" />
											</div>
											<div class="col-8">
												<div class="d-flex align-items-center flex-column">
													<h1 class="text-center coolText1 display-3"><strong>{{ $contact->first_name . " " . $contact->last_name  }}</strong></h1>

													<a class="btn btn-warning" href="/contacts/{{ $contact->id }}/edit" class="">Edit</a>
												</div>
												<div class="">
													<h3 class="d-inline-block"><u>Email :</u>&nbsp;</h3>
													<span class=""><a href="mailto:{{ $contact->email != null ? $contact->email : 'N/A' }}" class="">{{ $contact->email != null ? $contact->email : 'N/A' }}</a></span>
												</div>
												<div class="">
													<h3 class="d-inline-block"><u>Phone :</u>&nbsp;</h3>
													<span class="">{{ $contact->phone != null ? $contact->phone : 'N/A' }}</span>
												</div>
												<div class="">
													<h3 class="d-inline-block"><u>Family Members :</u>&nbsp;</h3>
													<span class="">Family of {{ $contact->family_size != null ? $contact->family_size : 1 }}</span>
												</div>
												<div class="">
													@php $dobFormat = new Carbon\Carbon($contact->dob); @endphp
													<h3 class="d-inline-block"><u>Birthday :</u>&nbsp;</h3>
													<span class="">DOB: {{ $contact->dob != null ? $dobFormat->toFormattedDateString() : 'N/A' }}</span>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col">
												<p class="text-center">{!! $contact->tenant == "Y" ? "<span class='oi oi-check text-success' title='icon name' aria-hidden='true'></span>" : "<span class='oi oi-x text-danger' title='icon name' aria-hidden='true'></span>" !!}&nbsp;Current Tenant</p>
											</div>
										</div>
									</div>
									@if(!$loop->last)
										<div class="col my-3">
											<h1 class="text-hide" style="border:1px solid #787878 !important">Hidden Text</h1>
										</div>
									@endif
								</div>
							@endforeach
						</div>
					</div>
				</div>
			@else
				<div class="col">
					<h2 class="text-center">You haven't added any contacts yet</h2>
					<h4 class="text-center">Click <a href="/contacts/create" class="">here</a> to create your first contact</h4>
				</div>
			@endif
		</div>
		
		@if($contacts->count() > 0)
			<div class="modal fade" id="email_modal" role="dialog" aria-hidden="true" tabindex="1">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Send Email To Multiple Recipients</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						{!! Form::open(['action' => 'ContactController@mass_email', 'method' => 'POST']) !!}
							<div class="modal-body text-dark">
								<div class="md-form">
									<label for="send_subject" class="form-control-label">Email Subject</label>
									<input type="text" name="send_subject" class="form-control md-textarea" id="send_subject" value="{{ old('send_subject') }}" placeholder="" />
								</div>
								<div class="md-form">
									<select class="mdb-select colorful-select dropdown-primary" name="send_to[]" searchable="Search here.." multiple>
										<option value="" disabled selected>Choose recipients</option>
										@foreach($contacts as $eachContact)
											<option value="{{ $eachContact->id }}" data-icon="{{ $eachContact->image ? str_ireplace('public', 'storage', $eachContact->image->path) : asset('/images/empty_face.jpg') }}" class="rounded-circle" {{ $eachContact->email == null ? 'disabled' : '' }}>{{ $eachContact->full_name() }}{{ $eachContact->email == null ? ' - no email listed' : '' }}</option>
										@endforeach
									</select>
									<button type="button" class="btn-save btn btn-primary btn-sm">Save</button>
								</div>
								<div class="md-form">
									<label class="form-control-label">Email Text</label>
									<textarea type="text" name="send_body" class="form-control md-textarea" placeholder="">{{ old('send_body') }}</textarea>
								</div>
								<div class="d-flex align-items-center justify-content-between">
									<button class="btn btn-success" type="submit">Send Email</button>
									<button class="btn btn-warning cancelBtn" type="button">Cancel</button>
								</div>
							</div>
						{!! Form::close() !!}
					</div>
				</div>
			</div>
		@endif

		@if($settings->show_deletes == "Y")
			@if($deletedContacts->isNotEmpty())
				<div class="container-fluid">
					<div class="row">
						<div class="col">
							<div class="deleteDivider"></div>
						</div>
					</div>
					
				</div>
				<div class="row">
					<div class="col col-12">
						<h2 class="">Deleted Contacts</h2>
					</div>
					@foreach($deletedContacts as $deletedContact)
						<div class="col-12 col-sm-4">
							<div class="card">
								<div class="card-header">
									<h2 class="text-center">{{ $deletedContact->first_name . ' ' . $deletedContact->last_name}}
									</h2>
								</div>
								<div class="card-body">
									<ul class="propertyInfo">
										<li class="propertyItem">Email: {{ $deletedContact->email }}</li>
										<li class="propertyItem">Phone: {{ $deletedContact->phone }}</li>
									</ul>
								</div>
								<div class="card-footer text-center">
									<a class="btn btn-warning" href="/contact_restore/{{$deletedContact->id}}" class="">Restore</a>
								</div>
							</div>
						</div>
					@endforeach
				</div>
			@endif
		@endif
	</div>
@endsection

@extends('layouts.app')

@section('addt_script')
	<script type="text/javascript">
		$('body').on('click', '.linkAcct, .ignoreLink', function() {
			var el_UL = $(this).parent().parent();
			var el_Val = $(this).children().val();
			var el_ContactDiv = $(this).parents('.contactList');
			var linkAction = $(this).hasClass('ignoreLink') ? 'ignore' : 'link';
			var originalContact = $(this).parents('.container-fluid').find('.originalContact').val();

			el_UL.addClass('zoomOutLeft');
			
			$.ajax({
			  method: "PATCH",
			  url: "/duplicate_link/" + el_Val + "/",
			  data: {link:linkAction, original:originalContact}
			})
			
			.fail(function() {	
				el_UL.addClass('zoomInLeft');
			})
			
			.done(function(data) {
				var newData = $(data);
				
				el_UL.one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function() {
					el_UL.remove();
					
					// Remove whole contact div if no more duplicates to check
					if(el_ContactDiv.find('.potentialDupe').length < 1) {
						el_ContactDiv.addClass('fadeOut').ready(function() {
							setTimeout(function() {
								 el_ContactDiv.prev().find('.divider').remove();
								 el_ContactDiv.remove();
							}, 750);
						});
					}
				});
			});
		});
	</script>
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
			
		@if($contacts->isNotEmpty())
			<div class="col-12">
				<div class="container-fluid">
					<div class="row mb-4">
						<h2 class="col text-justify">Duplicates are checked by looking for any email address entered more than once. Check to see if the information is the same before linking accounts or ignore it</h2>
					</div>
					
					<!-- Display for mobile screen -->
					<div class="row d-sm-none d-flex">
						@foreach($contacts as $contact)
							@php $getDupes = App\Contact::where('email', $contact->email)->get(); @endphp

							<ul class="">
								@foreach($getDupes as $dupe)
									<li class="">{{ $dupe->email }}</li>
								@endforeach
							</ul>
							
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
							@php 
								$getDupes = App\Contact::where([
									['email', $contact->email],
									['duplicate', null],
								])
								->orderBy('tenant', 'desc')
								->get(); 
							@endphp
							
							<div class="col-12">
								<div class="container-fluid">
									<div class="row">
										<div class="col-4">
											<img src="{{ $contact->image != null ? asset(str_ireplace('public', 'storage', $contact->image->path)) : asset('images/empty_face.jpg') }}" class="img-fluid" />
										</div>
										<div class="col-8">
											<div class="d-flex align-items-center flex-column">
												<h1 class="text-center coolText1 display-3"><strong>{{ $contact->first_name . " " . $contact->last_name  }}</strong></h1>

												<a class="btn btn-warning" href="/contacts/{{ $contact->id }}/edit" class="">Edit</a>
												
												<div class="hidden" hidden>
													<input type="text" class="originalContact" value="{{ $contact->id }}" />
												</div>
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
									<div class="row">
										<div class="col">
											<h3 class="h3-responsive text-center my-5">See Potential Duplicate Accounts</h3>
										</div>
									</div>
									<div class="row">
										@foreach($getDupes as $dupe)
											@if(!$loop->first)
												<ul class="col-12 col-md-8 mx-auto animated potentialDupe border rounded z-depth-1 my-2 text-center">
													<li class="d-inline">{{ $dupe->full_name() }} | </li>
													<li class="d-inline">{{ $dupe->phone }} | </li>
													<li class="d-inline">{{ $dupe->email }} | </li>
													<li class="d-inline">
														<button class="btn green linkAcct" type="button">Link
															<input type="text" class="hidden" value="{{ $dupe->id }}" hidden />
														</button> | 
													</li>
													<li class="d-inline">
														<button class="btn orange ignoreLink" type="button">Ignore
															<input type="text" name="" class="hidden" value="{{ $dupe->id }}" hidden />
														</button>
													</li>
												</ul>
											@endif
										@endforeach
									</div>
								</div>
								@if(!$loop->last)
									<div class="col my-3">
										<h1 class="text-hide divider" style="border:1px solid #787878 !important">Hidden Text</h1>
									</div>
								@endif
							</div>
						@endforeach
					</div>
				</div>
			</div>
		@else
			<div class="col-12">
				<h2 class="text-center">0 results found for following search criteria</h2>
				<h4 class="text-center">"{{ $searchCriteria }}"</h4>
			</div>
		@endif
	</div>
@endsection

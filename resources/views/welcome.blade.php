@extends('layouts.app')

@section('addt_style')
@endsection

@section('content')
	@if(session('status'))
		<h2 class="flashMessage">{{ session('status') }}</h2>
	@endif
	
	<!-- Modal which will show when page loads if settings are Yes -->
	@if($setting->show_welcome == "Y" && !$prevSession)
		<div class="modal fade" id="welcome_modal">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header flex-column">
						<h2 class="d-block" style=""><u>Add To Our Contacts</u></h2>
						<h4 class="d-block" style="">If you would like to be conacted when we have new rentals that fits you, please fill out the following information and we will reach out to you</h4>
					</div>
					<div class="modal-body text-dark">
						{!! Form::open([ 'action' => 'ContactController@store', 'class' => '', 'id' => 'contact_add',]) !!}
							<div class="form-row">
								<div class="form-group col-6">
									{{ Form::label('first_name', 'First Name', ['class' => 'form-control-label']) }}
									{{ Form::text('first_name', '', ['class' => 'form-control']) }}
									
									@if ($errors->has('first_name'))
										<span class="text-danger">First Name cannot be empty</span>
									@endif
								</div>
								<div class="form-group col-6">
									{{ Form::label('last_name', 'Last Name', ['class' => 'form-control-label']) }}
									{{ Form::text('last_name', '', ['class' => 'form-control']) }}
									
									@if ($errors->has('last_name'))
										<span class="text-danger">Last Name cannot be empty</span>
									@endif
								</div>
							</div>
							<div class="form-group">
								{{ Form::label('email', 'Email Address', ['class' => 'form-control-label']) }}
								<input type="email" name="email" class="form-control" value="{{ old('email') }}" />
								@if ($errors->has('email'))
									<span class="text-danger">Email Address Cannot Be Empty</span>
								@endif
							</div>
							<div class="form-group">
								{{ Form::label('phone', 'Phone', ['class' => 'form-control-label']) }}
								<input type="text" name="phone" class="form-control" value="{{ old('phone') }}" max="10" />
								@if ($errors->has('phone'))
									<span class="text-danger">Phone Number Cannot Be Empty. Please add without spaces</span>
								@endif
							</div>
							<div class="form-group">
								{{ Form::label('family_size', 'Family Size', ['class' => 'form-control-label']) }}
								<input type="number" name="family_size" class="form-control" value="{{ old('family_size') }}" min='1' />
							</div>
							<div class="form-group">
								{!! Form::submit('Add Me', ['name' => 'submit', 'class' => 'form-control btn btn-primary']) !!}
							</div>
						{!! Form::close() !!}
					</div>
					<div class="modal-footer">
						<button type="button" class="cancelBtn btn btn-warning text-center d-block d-sm-inline" data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>
	@endif
	
	@php $carouselImages = explode(';', $setting->carousel_images); @endphp
	<div id="home_carousel" class="carousel carousel-slider" data-indicators="true">
		@if($carouselImages[0] == "")
			<div class="carousel-item active">
				<div class="carousel-image" style="background: linear-gradient(rgba(0, 0, 0, 0), rgba(0, 0, 40, 0.6)), url('/images/family-and-house1.jpg')"></div>
				<div class="container">
					<div class="carousel-caption d-md-block text-left">
						<h1>Experienced Professionals.</h1>
						<p>A leading real estate agent with over 15 years of experience, provides exciting choices for enhancing your quality of life. We are dedicated to quality and community commitment translate to your peace of mind</p>
					</div>
				</div>
			</div>
		@else
			@foreach($carouselImages as $carouselImage)
				<div class="carousel-item{{ $loop->first ? ' active' : '' }}">
					<div class="carousel-image" style="background: linear-gradient(rgba(0, 0, 0, 0), rgba(0, 0, 40, 0.6)), url({{ asset('storage/images/' . trim($carouselImage)) }})"></div>
					<div class="container">
						<div class="carousel-caption d-md-block text-left">
							@if($loop->first)
								<h1>Experienced Professionals.</h1>
								<p>A leading real estate agent with over 15 years of experience, provides exciting choices for enhancing your quality of life. We are dedicated to quality and community commitment translate to your peace of mind</p>
								<!--- <p class="text-sm-center"><a class="btn btn-lg btn-primary d-block d-sm-inline" href="#" role="button">Sign up today</a></p> --->
							@elseif($loop->iteration == 2)
								<h1>We got what you need.</h1>
								<p>Jackson Rental Homes LLC is one of the only businesses in the Philadelphia responsible for rehabing houses and providing reasonable accommodations for people of all walks of life and financial stature.</p>
							@elseif($loop->iteration == 3)
								<h1>Cutting Edge Designs.</h1>
								<p>Jackson Rental Homes LLC offers a complete range of development and construction services, from the design phase through site work, to complex commercial and residential construction projects.</p>
							@elseif($loop->iteration == 4)
								<h1>A little something for everybody.</h1>
								<p>Jackson Rental Homes LLC offers a selection of homes for sale and rent for every lifestyle.</p>
							@endif
						</div>
					</div>
				</div>
			@endforeach
		@endif
	</div>
	<div class="container">
		<!-- START THE FEATURETTES -->
		<div class="row align-items-center">
			<h1 class="col-2 col-md-4 text-hide" style="border:1px solid #787878 !important">Hidden Text</h1>
			<h1 class="col-8 col-md-4 text-muted">Featured Properties</h1>
			<h1 class="col-2 col-md-4 text-hide" style="border:1px solid #787878 !important">Hidden Text</h1>
		</div>
		@if($showcase_properties->isNotEmpty())
			@foreach($showcase_properties as $showcase)
				@if($showcase->medias()->first())
					@php $image = $showcase->medias()->first(); @endphp
					@php $image = asset('storage/' . str_ireplace('public/', '', $image->path)); @endphp
				@else
					@php $image = '/images/empty_prop.png'; @endphp
				@endif
				<div class="row mt-4 d-flex align-items-center showcaseProps">
					<div class="col-md-7 order-2{{ $loop->iteration == 2 ? ' order-sm-1' : '' }} ">
						<h2 class="text-center text-sm-left">{{ $showcase->title }}</h2>
						<h5 class="text-center text-sm-left">{{ $showcase->city }}&nbsp;{{ $showcase->state }},&nbsp;{{ $showcase->zip }}</h5>
						<p class="lead py-3">{{ $showcase->description }}</p>
						<a href="/properties/{{ $showcase->id }}/{{ Auth::check() ? 'edit' : '' }}" class="btn text-theme1 btn-secondary btn-lg d-block d-sm-inline{{ $showcase->active == 'N' ? ' disabled' : '' }}" >View Details</a>
					</div>
					<div class="mb-2 text-center col-md-5 order-1{{ $loop->iteration == 2 ? ' order-sm-2' : '' }}">
						<img class="img-fluid mx-auto" alt="Property Image" style="" src="{{ $image }}">
					</div>
				</div>
				
				@if(!$loop->last)
					<hr/>
				@endif
			@endforeach
		@else
			<div class="row mt-4">
				<h2 class="col">No Featured Properties Added Yet</h2>
			</div>
		@endif
	</div>

	<!-- Additional Services Div -->
	<div class="container-fluid" style="{{ (Auth::guest()) ? 'margin-bottom:-3em;' : 'margin-bottom:-3em;' }}">
		<div class="row align-items-center mt-5 mb-0 py-3" id="addt_service_transition">
			<div class="d-sm-none addt_service_transition_mobile_bgrd"></div>
			<h1 class="col text-white p-sm-4 p-0 mx-4 rounded display-5 display-sm-4" style="background: rgba(0, 0, 0, 0.5);">Having Trouble Managing Your Properties??</h1>
		</div>
		<div class="row">
			<div class="col py-5 bg-dark text-center" style="color: #ebf1fb;">
				<h2 class="p-2">Does this sound familiar?</h2>
				<ul id="addt_service_list" class="mx-auto pl-5 pr-1 p-sm-3 text-left" style="">
					<li class="">Can't Find a good tenant</li>
					<li class="">Tenants not paying rent on time</li>
					<li class="">Unable to get someone to fix the leak in the kitchen</li>
					<li class="">Property vacant for months at a time</li>
				</ul>
				<h3 class="p-3">Give us a call and we can help you out with getting up and running or managing your property for you</h3>
				<a class="btn btn-primary d-block d-sm-inline mx-auto" href="{{ route('contact_us') }} " style="color: #ebf1fb;">Contact Us</a>
			</div>
		</div>
	</div>0
	
	@if($setting->show_welcome == "Y" && !$prevSession)
		<script type="text/javascript">
			// Show welcome modal
			$('#welcome_modal').addClass('d-block');
			setTimeout(function() {
				$('#welcome_modal').addClass('show');
				$('body').addClass('modal-open').append("<div class='modal-backdrop fade show'></div>");
			}, 500);
		</script>
	@endif
@endsection
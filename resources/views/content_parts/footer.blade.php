<!-- Footer -->
<footer class="pt-5">

	<div class="container pt-5">

		<div class="row d-flex justify-content-around align-items-stretch mb-0">

			<div class="col-12 col-lg-6">

				<div class="d-flex align-items-center justify-content-between flex-column h-100" id="">
					<div class="d-flex align-items-center justify-content-between flex-column" id="">
						<h2 class="text-center" style=""><u>Add To Our Contacts</u></h2>
						<h4 class="text-center mt-xl-5" style="">If you would like to be conacted when we have new rentals that fits you, please fill out the following information and we will reach out to you</h4>
					</div>


					<form class="add_contact_form w-100" action="{{ action('ContactController@store') }}">

						<div class="form-row">
							<div class="form-group col-6">
								{{ Form::label('form_first_name', 'First Name', ['class' => '']) }}
								{{ Form::text('first_name', '', ['id' => 'form_first_name', 'class' => 'form-control']) }}

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

						<div class="form-group mb-2">
							{!! Form::submit('Add Me', ['name' => 'submit', 'class' => 'form-control blue darken-3 white-text']) !!}

							<input type="text" name="non_modal" class="form-control" value="Y" max="10" hidden />
						</div>
					</form>
				</div>
			</div>

			<div class="col-12 col-lg-6 py-4 mt-4 py-lg-0 mt-lg-0" id="instagram_us">
				<div class="container-fluid">
					<div class="row" id="">
						<h4 class="col-12 text-center blue darken-2 rounded-top white-text mb-0 py-2" style="">Follow Us on The Gram</h4>

						<div class="col-12 py-0 px-0">
							<img src="/images/jr.jpg" class="instagramPhoto" />
						</div>

						<h5 class="col-12 text-center blue darken-3 py-2 py-md-3 rounded-bottom">
							<a class="white-text d-flex align-items-center justify-content-around justify-content-sm-center" href="https://www.instagram.com/jacksonrentalhomes/">
								<i class="fab fa-instagram white-text"></i>&nbsp;<span class="white-text">#JacksonRentalHomes</span>
							</a>
						</h5>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="container-fluid mt-5" id="">
		<div class="row stylish-color-dark white-text">
			<div class="col-12">
				<h5 class="text-center text-theme1 m-0 p-4" style="">
					<span class="text-center d-flex align-items-center justify-content-around">2021 &copy; & &reg;</span>
					<span class="text-center">by Tramaine Jackson Tech</span>
				</h5>
			</div>
		</div>
	</div>
</footer>
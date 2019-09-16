@extends('layouts.app')

@section('content')

	<div class="view loginJumbotron">
		<!-- Mask & flexbox options-->
		<div class="mask d-flex justify-content-center align-items-center">
			<div class="container-fluid">
				<div class="row h-100">
					<div class="col-md-6 mx-auto mt-5">
						<div class="panel panel-default h-100 d-flex flex-column align-items-center justify-content-center">
							<div class="panel-heading pl-3 text-white wow fadeInDown" data-wow-delay="0.5s"><h1>Login</h1></div>

<<<<<<< HEAD
							<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
								<label for="email" class="col col-12 control-label text-white">E-Mail Address</label>

								<div class="col">
									<input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

									@if ($errors->has('email'))
										<span class="help-block">
											<strong>{{ $errors->first('email') }}</strong>
										</span>
									@endif
								</div>
							</div>

							<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
								<label for="password" class="col col-12 control-label text-white">Password</label>

								<div class="col">
									<input id="password" type="password" class="form-control" name="password" required>

									@if ($errors->has('password'))
										<span class="help-block">
											<strong>{{ $errors->first('password') }}</strong>
										</span>
									@endif
								</div>
							</div>

							<div class="form-group">
								<div class="col-12">
									<div class="checkbox">
										<label class="text-white">
											<input type="checkbox" class="text-black" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
										</label>
									</div>
								</div>
							</div>
=======
							<div class="panel-body">
								<form class="form-horizontal wow fadeInDown" data-wow-delay="0.5s" method="POST" action="{{ route('login') }}">
									{{ csrf_field() }}

									<div class="md-form{{ $errors->has('email') ? ' has-error' : '' }}">
										<input id="email" type="email" class="form-control text-white" name="email" value="{{ old('email') }}" required autofocus>

										@if ($errors->has('email'))
											<span class="help-block">
												<strong>{{ $errors->first('email') }}</strong>
											</span>
										@endif

										<label for="email" class="active white-text">E-Mail Address</label>
									</div>

									<div class="md-form{{ $errors->has('password') ? ' has-error' : '' }}">
										<input id="password" type="password" class="form-control text-white" name="password" required>

										@if ($errors->has('password'))
											<span class="help-block">
												<strong>{{ $errors->first('password') }}</strong>
											</span>
										@endif
										<label for="password" class="text-white active">Password</label>
									</div>
>>>>>>> payment_plan

									<!-- Remember me not working -->
									<!-- <div class="form-group">
										<div class="col-12">
											<div class="checkbox">
												<label class="text-white">
													<input type="checkbox" class="text-black" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
												</label>
											</div>
										</div>
									</div> -->

									<div class="md-form">
										<div class="">
											<button type="submit" class="btn btn-primary">
												Login
											</button>

											<a class="btn btn-primary" href="{{ route('password.request') }}">
												Forgot Your Password?
											</a>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

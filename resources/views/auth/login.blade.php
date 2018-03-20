@extends('layouts.app')

@section('addt_style')
@endsection

@section('addt_script')
@endsection

@section('content')
	<div class="container-fluid h-100 loginJumbotron">
		<div class="row h-100">
			<div class="col-md-6 mx-auto mt-5">
				<div class="panel panel-default h-100 d-flex flex-column align-items-center justify-content-center">
					<div class="panel-heading pl-3 text-white"><h1>Login</h1></div>

					<div class="panel-body">
						<form class="form-horizontal" method="POST" action="{{ route('login') }}">
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

							<div class="form-group">
								<div class="col-md-8 col-md-offset-4">
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
@endsection

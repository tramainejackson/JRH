@extends('layouts.app')

@section('addt_style')
@endsection

@section('addt_script')
@endsection

@section('content')
<div class="view loginJumbotron">
	<!-- Mask & flexbox options-->
	<div class="mask d-flex justify-content-center align-items-center">
		<div class="container-fluid">
			<div class="row h-100">
				<div class="col-md-6 mx-auto mt-5">
					<div class="panel panel-default rgba-stylish-strong rounded p-2 d-flex flex-column align-items-center justify-content-center">
						<div class="panel-heading pl-3 text-white wow fadeInDown" data-wow-delay="0.5s"><h1>Reset Password</h1></div>

						<div class="panel-body w-100">
							<form class="form-horizontal" method="POST" action="{{ route('password.request') }}">
								{{ csrf_field() }}

								<input type="hidden" name="token" value="{{ $token }}">

								<div class="md-form{{ $errors->has('email') ? ' has-error' : '' }}">
									<input id="email" type="email" class="form-control" name="email" value="{{ $email or old('email') }}" required autofocus>

									<label for="email" class="col col-12 control-label text-white">E-Mail Address</label>

									@if ($errors->has('email'))
										<span class="help-block">
											<strong>{{ $errors->first('email') }}</strong>
										</span>
									@endif
								</div>

								<div class="md-form{{ $errors->has('password') ? ' has-error' : '' }}">
									<input id="password" type="password" class="form-control" name="password" required>

									<label for="password" class="col col-12 control-label text-white">Password</label>

									@if ($errors->has('password'))
										<span class="help-block">
											<strong>{{ $errors->first('password') }}</strong>
										</span>
									@endif
								</div>

								<div class="md-form{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
									<input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>

									<label for="password-confirm" class="col col-12 control-label text-white">Confirm Password</label>									

									@if ($errors->has('password_confirmation'))
										<span class="help-block">
											<strong>{{ $errors->first('password_confirmation') }}</strong>
										</span>
									@endif
								</div>

								<div class="md-form">
									<div class="">
										<button type="submit" class="btn btn-primary">
											Reset Password
										</button>
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

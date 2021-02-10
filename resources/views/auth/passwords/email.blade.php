@extends('layouts.app')

@section('content')
<div class="view loginJumbotron">
	<!-- Mask & flexbox options-->
	<div class="mask d-flex justify-content-center align-items-center">
		<div class="container-fluid">
			<div class="row h-100">
				<div class="col-md-6 mx-auto mt-5">
					<div class="panel panel-default rgba-stylish-strong rounded p-2 d-flex flex-column align-items-center justify-content-center">
						<div class="panel-heading pl-3 text-white wow fadeInDown" data-wow-delay="0.5s"><h1 class="text-white">Reset Password</h1></div>

						<div class="panel-body">
							@if (session('status'))
								<div class="alert alert-success">
									{{ session('status') }}
								</div>
							@endif

							<form class="form-horizontal wow fadeInDown" data-wow-delay="0.5s" method="POST" action="{{ route('password.email') }}">
								{{ csrf_field() }}

								<div class="md-form{{ $errors->has('email') ? ' has-error' : '' }}">
									<input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

									<label for="email" class="col-12 control-label text-white">E-Mail Address</label>
									
									@if ($errors->has('email'))
										<span class="help-block">
											<strong>{{ $errors->first('email') }}</strong>
										</span>
									@endif
								</div>

								<div class="md-form">
									<div class="">
										<button type="submit" class="btn btn-primary">
											Send Password Reset Link
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

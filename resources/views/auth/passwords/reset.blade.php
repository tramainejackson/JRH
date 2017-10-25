@extends('layouts.app')
@section('custom_style')
	<style>
		nav {
			line-height: 56px;
		}
		
		nav .nav-wrapper {
			position: relative;
			height: 100%;
		}
		
		nav .button-collapse {
			float: left;
			position: relative;
			z-index: 1;
			height: 56px;
			margin: 0 18px;
		}
		
		nav .button-collapse i {
			line-height: 100px;
			height: 56px;
		}


		nav i.material-icons {
			display: block;
			font-size: 24px;
			height: 56px;
		}

		.material-icons {
			text-rendering: optimizeLegibility;
			-webkit-font-feature-settings: 'liga';
			font-feature-settings: 'liga';
		}
		
		nav .brand-logo {
			left: 50%;
			-webkit-transform: translateX(-50%);
			transform: translateX(-50%);
		}

		nav .brand-logo {
			position: absolute;
			color: #fff;
			display: inline-block;
			color: transparent;
		}
		
		.drag-target {
			height: 100%;
			width: 10px;
			position: fixed;
			top: 0;
			z-index: 998;
		}
		
		#sidenav-overlay {
			position: fixed;
			top: 0;
			left: 0;
			right: 0;
			height: 120vh;
			background-color: rgba(0, 0, 0, 0.5);
			will-change: opacity;
		}
		
		ul:not(.browser-default) {
			padding-left: 0;
			list-style-type: none;
		}

		.side-nav {
			position: fixed;
			width: 300px;
			left: 0;
			top: 0;
			margin: 0;
			-webkit-transform: translateX(-100%);
			transform: translateX(-100%);
			height: 100%;
			height: calc(100% + 60px);
			height: -moz-calc(100%);
			padding-bottom: 60px;
			background-color: #fff;
			z-index: 999;
			overflow-y: auto;
			will-change: transform;
			-webkit-backface-visibility: hidden;
			backface-visibility: hidden;
			-webkit-transform: translateX(-105%);
			transform: translateX(-105%);
		}
		
		.z-depth-1, nav, .card-panel, .card, .toast, .btn, .btn-large, .btn-floating, .dropdown-content, .collapsible, .side-nav {
			-webkit-box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.14), 0 1px 5px 0 rgba(0, 0, 0, 0.12), 0 3px 1px -2px rgba(0, 0, 0, 0.2);
			box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.14), 0 1px 5px 0 rgba(0, 0, 0, 0.12), 0 3px 1px -2px rgba(0, 0, 0, 0.2);
		}
	</style>
@endsection
@section('content')
<div class="container-fluid h-100 loginJumbotron">
    <div class="row h-100">
		<div class="col-md-6 mx-auto mt-5">
            <div class="panel panel-default">
                <div class="panel-heading">Reset Password</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('password.request') }}">
                        {{ csrf_field() }}

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ $email or old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>
                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>

                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
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
@endsection

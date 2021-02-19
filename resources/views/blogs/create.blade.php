@extends('layouts.app')

@section('addt_style')
	<style type="text/css">
		.navbar.fixed-top.navbar-expand-lg.scrolling-navbar.double-nav {
			background-color: #243a51 !important;
		}
	</style>
@endsection

@section('content')

	<div class="container-fluid mt-5 pt-5">

		<div class="row">

			<div class="col-sm-3 col-12 text-center mb-3">
				<a href="{{ route('blogs.index') }}" class="btn btn-success d-block mt-2">All Blogs</a>
			</div>

			<div class="col">
				<div class="card mt-2">

					<div class="card-header">
						<h2 class="white-text">Add Blog</h2>
					</div>

					<div class="card-body">
						{!! Form::open(['action' => ['BlogsController@store'], 'method' => 'POST', 'files' => true, ]) !!}
							<div class="form-group">
								<div class="input-group mb-3">
									<div class="input-group-prepend">
										<span class="input-group-text">Upload</span>
									</div>
									<div class="custom-file">
										{{ Form::file('name[]', ['class' => 'custom-file-input', 'multiple' => 'true']) }}
										{{ Form::label('name', 'Add Files', ['class' => 'custom-file-label']) }}
									</div>
								</div>
								
								@if ($errors->has('name'))
									<span class="text-danger">{{ $errors->first('name') }}</span>
								@endif
							</div>

							<div class="form-group">
								{{ Form::label('title', 'Description', ['class' => 'form-control-label']) }}
								{{ Form::text('title', '', ['class' => 'form-control', 'placeholder' => 'Enter Name Of Documents']) }}
								
								@if ($errors->has('title'))
									<span class="text-danger">Description cannot be empty</span>
								@endif
							</div>

							<div class="form-group">
								{{ Form::submit('Add File', ['class' => 'btn btn-primary ml-0']) }}
							</div>

						{!! Form::close() !!}
					</div>
				</div>
			</div>
		</div>
	</div>

@endsection

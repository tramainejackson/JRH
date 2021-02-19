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

			<div class="col-12 text-center mb-3">
				<a href="{{ route('blogs.index') }}" class="btn btn-success mt-2">All Blogs</a>
			</div>

			<div class="col-12 col-md-10 col-lg-8 mx-auto">
				<div class="card mt-2">

					<div class="card-header">
						<h2 class="white-text">Add New Blog</h2>
					</div>

					<div class="card-body">

						<form class="" method="POST" action="{{ action('BlogsController@store') }}" enctype="multipart/form-data">

							{{ csrf_field() }}
							{{ method_field('POST') }}

							<div class="md-form pb-3" id="">

								<!-- Title -->
								<input type="text" id="title" class="form-control" name='title' value='{{ old('title') }}' placeholder="Enter Title" {{ $errors->has('title') ? 'autofocus' : '' }}/>

								<label class="" for="title">Title</label>

								@if ($errors->has('title'))
									<span class="text-danger">Title cannot be empty</span>
								@endif

							</div>

							<!--Material textarea-->
							<div class="md-form">

								<textarea id="" name="blog" class="md-textarea form-control" rows="3" placeholder="Enter Blog Content"></textarea>
								<label for="blog">Blog Content</label>
							</div>

							<div class="form-row">

								<div class="md-form input-group mt-0 mb-3 col-12 col-lg-6">
									<label class="mb-0 ml-2" for="link">Link</label>

									<div class="input-group-prepend">
										<span class="input-group-text md-addon" id="">https://www.</span>
									</div>

									<!-- URL Link -->
									<input type="text" id="link" class="form-control" name='link' value='{{ old('link') }}' placeholder="Enter Website" {{ $errors->has('link') ? 'autofocus' : '' }}/>

									@if ($errors->has('link'))
										<span class="text-danger">{{ $errors->has('link') }}</span>
									@endif

								</div>

								<div class="md-form col-12 col-lg-6" id="">

									<!-- Document -->
									<div class="file-field">
										<a class="btn-floating btn-lg pink lighten-1 mt-0 float-left">
											<i class="fas fa-paperclip" aria-hidden="true"></i>
											<input type="file" id="document" class="" name='document' value='{{ old('document') }}' placeholder="Add Document" {{ $errors->has('document') ? 'autofocus' : '' }}/>
										</a>

										<div class="file-path-wrapper">
											<input class="file-path validate" type="text" placeholder="Upload a Document">
										</div>
									</div>

									@if ($errors->has('document'))
										<span class="text-danger">{{ $errors->has('document') }}</span>
									@endif

								</div>
							</div>

							<div class="form-row">
								<div class="md-form col-12 col-md-6" id="">

									<div class="form-inline" id="">
										<div class="btn-group">
											<button type="button" class="btn activeYes activeBlog{{ old('active') == true ? ' btn-success active' : ' btn-blue-grey' }}">
												<input type="checkbox" name="active" value="1" hidden {{ old('active') == true ? 'checked' : '' }} />Yes
											</button>
											<button type="button" class="btn activeNo activeBlog{{ old('active') == false ? ' btn-danger active' : ' btn-blue-grey' }}">
												<input type="checkbox" name="active" value="0" {{ old('active') == false ? 'checked' : '' }} hidden />No
											</button>
										</div>
									</div>

									<label for="active" style="position: absolute;top: -60%;font-size: 14px !important;">Active</label>
								</div>

								<div id="" class="md-form md-outline input-with-post-icon datepicker col-12 col-md-6">
									<input placeholder="Select date" type="text" id="upload_date" class="form-control grey-text" data-value="{{ $today->format('m/d/Y') }}" disabled />
									<label for="upload_date" class="active">Upload Date</label>

									<i class="fas fa-calendar input-prefix disabled grey-text" tabindex=0 style="top: 35%;"></i>
								</div>
							</div>

							<div class="md-form">
								<button type="submit" class="btn btn-info btn-rounded">Create New Blog</button>
							</div>

						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

@endsection

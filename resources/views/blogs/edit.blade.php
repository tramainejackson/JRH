@extends('layouts.app')

@section('addt_style')
	<style type="text/css">
		.navbar.fixed-top.navbar-expand-lg.scrolling-navbar.double-nav {
			background-color: #243a51 !important;
		}
	</style>
@endsection

@section('content')

	<div id="" class="container-fluid mt-5 pt-5">

		<div class="row">

			<div class="col-12">

				<div class="d-flex justify-content-center flex-column flex-md-row" id="">
					<a href="{{ route('blogs.create') }}" class="btn btn-success">Add New Files</a>
					<a href="{{ route('blogs.index') }}" class="btn btn-success">All Files</a>
				</div>
			</div>
		</div>

		<div class="row mt-4">

			<div class="col-12 col-md-12 col-lg-8 col-lg-12 col-xl-8 mx-auto">

				<div class="card">

					<div class="card-body rounded-top border-top p-5">

						<!-- Section heading -->
						<h3 class="font-weight-bold my-4">Edit Blog</h3>

						<!-- Document -->
						@if($blog->document != null)
							<a href="{{ $blog->document }}" class="btn btn-outline-dark-green mt-n3" download="{{ $blog->title }}">See Document</a>
						@endif

						<form class="" method="POST" action="{{ route('blogs.update', [$blog->id]) }}" enctype="multipart/form-data">

							{{ method_field('PUT') }}
							{{ csrf_field() }}

							<div class="md-form" id="">

								<!-- Phone -->
								<input type="text" id="title" class="form-control" name='title' value='{{ old('title') ? old('title') : $blog->title }}' placeholder="Enter Document Title">

								<label class="" for="title">Title</label>

								@if ($errors->has('title'))
									<span class="text-danger">Title Cannot Be Empty</span>
								@endif

							</div>

							<!--Material textarea-->
							<div class="md-form">

								<textarea id="" name="blog" class="md-textarea form-control" rows="3" placeholder="Enter Blog Content">{{ $blog->blog }}</textarea>
								<label for="blog">Blog Content</label>
							</div>


							<div class="md-form" id="">

								<!-- Link -->
								<input type="text" id="link" class="form-control" name='link' value='{{ old('link') ? old('email') : $blog->link }}' placeholder="Enter Link URL">

								<label class="" for="link">Link</label>

								@if ($errors->has('link'))
									<span class="text-danger">{{ $errors->has('link') }}</span>
								@endif

							</div>

							<div class="md-form" id="">

								<!-- Document -->
								<div class="file-field">
									<a class="btn-floating btn-lg pink lighten-1 mt-0 float-left">
										<i class="fas fa-paperclip" aria-hidden="true"></i>
										<input type="file" id="document" class="" name='document' value='{{ old('document') }}' placeholder="Add Document" {{ $errors->has('document') ? 'autofocus' : '' }}/>
									</a>

									<div class="file-path-wrapper">
										<input class="file-path validate" type="text" placeholder="Upload a New Document">
									</div>
								</div>

								@if ($errors->has('document'))
									<span class="text-danger">{{ $errors->first('document') }}</span>
								@endif

							</div>


							<div class="md-form" id="">

								<div class="form-inline pt-5 ml-0" id="">
									<div class="btn-group">
										<button type="button" class="btn activeYes activeBlog{{ $blog->active == true ? ' btn-success active' : ' btn-blue-grey' }}">
											<input type="checkbox" name="active" value="1" hidden {{ $blog->active == true ? 'checked' : '' }} />Yes
										</button>
										<button type="button" class="btn activeNo activeBlog{{ $blog->active == false ? ' btn-danger active' : ' btn-blue-grey' }}">
											<input type="checkbox" name="active" value="0" {{ $blog->active == false ? 'checked' : '' }} hidden />No
										</button>
									</div>
								</div>

								<label for="active">Show Article</label>
							</div>

							<div class="col-4 my-5">

								<div id="date-picker-example" class="md-form md-outline input-with-post-icon datepicker">
									<input placeholder="Select date" type="text" id="upload_date" class="form-control grey-text" value="{{ $blog->created_at->format('m/d/Y') }}" disabled>
									<label for="upload_date">Upload Date</label>
									<i class="fas fa-calendar input-prefix disabled grey-text" tabindex=0></i>
								</div>
							</div>


							<div class="col-md-12">

								<div class="text-center">
									<button type="submit" class="btn btn-info btn-rounded">Update Blog</button>
								</div>

							</div>
						</form>

						<form class="position-absolute top right" method="POST" action="{{ route('blogs.destroy', [$blog->id]) }}">

							{{ method_field('DELETE') }}
							{{ csrf_field() }}

							<button class="btn btn-danger deleteBtn mr-3 mt-3" type="button" data-toggle="modal" data-target="#delete_modal">Delete Blog</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
@extends('layouts.app')

@section('content')

	@if(Auth::check())
		<div id="content_container" class="jumbotron jumbotron-fluid py-5 d-flex align-items-center blogsJumbotron">
			<div class="container-fluid py-5">
				<h2 class="py-5 text-white text-center display-4">Jackson Rental Homes Blogs.</h2>
			</div>
		</div>

		<div class="container-fluid">

			<div class="row">

				@if($blogs->isNotEmpty())

					<div class="col-12 text-center mx-auto">

						<div class="container-fluid">
							<a href="{{ route('blogs.create') }}" class="btn btn-success d-block d-sm-inline">Add New Blog</a>
							<p class="my-3"><i>Total Uploads:</i>&nbsp;<span class="text-muted">{{ $blogsTotal->count() }}</span></p>
						</div>

						<form id="search-form" method="POST" action="{{ action('PropertyController@search') }}">

							{{ csrf_field() }}
							{{ method_field('POST') }}

							<div class="form-row" id="">
								<div class="md-form input-group col-12 col-md-6 mx-auto mb-5">
									<input type="text" name="search" class="form-control valueSearch" value="{{ request()->query('search') ? request()->query('search') : '' }}" placeholder="Blogs Search" disabled />

									<div class="input-group-btn">
										<button class="btn btn-outline-success searchBtn" type="button" onclick="event.preventDefault(); document.getElementById('search-form').submit();" disabled="disabled">
											<i class="fa fa-search" aria-hidden="true"></i>
										</button>
									</div>
								</div>
							</div>
						</form>
					</div>

					<div class="col-12 mx-auto">

						<div class="container-fluid">

							<!--- Pagination Links -->
							{{ $blogs->links() }}

							<div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3 my-4">

								@foreach($blogs as $blog)

									{{--<div class="col fileList">--}}

										{{--<div class="container-fluid">--}}

											{{--<div class="row">--}}

												{{--<div class="col">--}}
													{{--<div class="d-flex align-items-center justify-content-between">--}}
														{{--<h1 class="text-center"><strong><em>{{ $blog[0]['title'] }}</em></strong></h1>--}}

														{{--<a class="btn btn-warning" href="/admin_files/{{ $blog[0]['id'] }}/edit" class="">Edit</a>--}}
													{{--</div>--}}
												{{--</div>--}}
											{{--</div>--}}

											{{--@foreach($document as $file)--}}
												{{--<div class="row">--}}
													{{--<div class="col ml-4 mb-3">--}}
														{{--<a href="{{ asset('storage/' . str_ireplace('public/', '', $file['name'])) }}" class="btn cyan darken-4 ml-3" download="{{ str_ireplace(' ', '_', $file['title']) }}">View Document {{ $loop->count > 1 ? $loop->iteration : ""}}</a>--}}
													{{--</div>--}}
												{{--</div>--}}
											{{--@endforeach--}}

										{{--</div>--}}
									{{--</div>--}}

									<div class="col py-2 fileList">

										<div class="card card-image h-100" style="background-image: url({{ asset($blog) }});">

											<!-- Content -->
											<div class="text-white text-center d-flex align-items-center rgba-mdb-color-strong py-5 px-4 h-100">
												<div class="d-block w-100">
													<h5 class="text-success"><i class="fas fa-home"></i> {{ $blog->price != null ? '$' . $blog->price : 'No Price Added Yet' }}&nbsp;{{ $blog->sale == 'rent' ? '/per month' : '' }}</h5>
													<span class="col col-6 text-center">{!! $blog->active == "Y" ? "<i class='fas fa-check-circle text-success'></i> Active" : "<i class='fas fa-times-circle text-danger'></i> Inactive" !!}</span>
													<h3 class="card-title pt-2"><strong>{{ $blog->address }}</strong></h3>
													<p>{{ nl2br($blog->description) }}</p>

													<a href="{{ route('blogs.edit', $blog->id) }}" class="btn btn-action"><i class="fas fa-clone left"></i> Edit</a>
												</div>
											</div>
										</div>
									</div>

								@endforeach
							</div>

							<!--- Pagination Links -->
							{{ $blogs->links() }}
						</div>
					</div>

				@else

					<div class="col">
						<h2 class="text-center">You haven't added any files yet</h2>
						<h4 class="text-center">Click <a href="{{ route('blogs.create') }}" class="">here</a> to add your first blog</h4>
					</div>

				@endif
			</div>

			@if($settings->show_deletes == "Y")@endif

		</div>
	@else
	@endif
@endsection
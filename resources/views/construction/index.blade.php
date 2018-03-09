@extends('layouts.app')

@section('addt_style')
<style>
	.constrPropTitle {
		background: linear-gradient(to right, transparent, red, darkred, red, transparent);
		color: white;
	}
</style>
@endsection

@section('content')
	<div id="content_container" class="jumbotron jumbotron-fluid py-5 d-flex align-items-center constructionJumbotron"></div>
	<div class="container">
		@if($properties->isNotEmpty())
			<div class="row align-items-center">
				<h1 class="col-2 col-md-4 text-hide" style="border:1px solid #787878 !important">Hidden Text</h1>
				<h1 class="col-8 col-md-4 text-muted text-center">Coming Soon</h1>
				<h1 class="col-2 col-md-4 text-hide" style="border:1px solid #787878 !important">Hidden Text</h1>
			</div>
			@foreach($properties as $property)
				@php $availDate = new Carbon\Carbon($property->available_date); @endphp
				<div class="row mt-4">
					<div class="col-12 my-3">
						<div class="container-fluid">
							<div class="row align-items-center">
								<p class="text-center text-md-left m-0 col-12 col-md-4 animated shake"><span class="red-text">Available Date:</span> {{ $property->available_date != null ? $availDate->format('m/d/Y') : 'TBD' }}</p>

								<h2 class="text-center m-0 col-12 col-md-4 coolText1">{{ $property->title }}</h2>
							</div>
						</div>
					</div>
					
					@if($property->medias->count() < 1 && $property->videos->count() < 1)
						<div class="col-12">
							<h3 class="emptyMedia">There are no videos or pictures uploaded yet. Check back later for updates</h3>
						</div>
					@else
						<div class="col-12 col-sm-2">
							<p class="text-muted text-center d-inline-block d-sm-block"><i>Videos: {{ $property->videos->count() }}</i></p>
							<p class="text-muted text-center d-inline-block d-sm-block"><i>Photos: {{ $property->medias->count() }}</i></p>
						</div>
						<div class="col-12 col-sm-10">
							<div class="container-fluid my-2 mb-5 constructionVids">
								<div class="">
									<h2 class=""><u>Videos</u></h2>
								</div>
								<div class="row">
									@if($property->videos->count() > 0)
										@foreach($property->videos as $video)
											<div class="col-12 col-sm-4">
												<video poster="/images/jrh_logo_lg.png" controls>
													<source src="{{ asset('storage/' . str_ireplace('public/', '', $video->path)) }}">
													Your browser does not support the video tag.
												</video>
											</div>
										@endforeach
									@else
										<div class="col-12">
											<p class="">No Videos For This Project Yet</p>
										</div>
									@endif
								</div>
							</div>
							
							<div class="container-fluid my-2 constructionPics">
								<div class="">
									<h2 class="my-3"><u>Images</u></h2>
								</div>
								<div class="row">
									@if($property->medias->count() > 0)
										@foreach($property->medias as $media)
											<div class="col-12 col-sm-3">
												<img src="{{ asset('storage/' . str_ireplace('public/', '', $media->path)) }}" class="img-thumbnail constructionImage" />
											</div>
										@endforeach
									@else
										<div class="col-12">
											<p class="">No Pictures For This Project Yet</p>
										</div>
									@endif
								</div>
							</div>
						</div>
					@endif
				</div>
				<div class="row align-items-center">
					<h1 class="col text-hide my-5" style="border:1px solid #787878 !important">Hidden Text</h1>
				</div>
			@endforeach
		@else
			<div class="row">
				<div class="col">
					<h2 class="text-center">No properties under constructions have been added yet</h2>
				</div>
			</div>
		@endif
	</div>
@endsection

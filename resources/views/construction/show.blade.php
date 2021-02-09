@extends('layouts.app')
@if(Auth::check())
@else
@section('addt_style')
@endsection

@section('content')
	<script type="text/javascript">
        function initHeroImg(path) {
            var firstImg = $('.propertyImgGallery .imgGallery img.active').attr('src');
            $('.propertyImgGallery .heroImg img').attr('src', firstImg);
        }
	</script>
	<div id="" class="jumbotron jumbotron-fluid py-5 d-flex align-items-center propertiesJumbotron">
		<div class="container-fluid py-5">
			<h2 class="py-5 text-white display-4">Growth and development of our communities are the core of our pursuit.</h2>
		</div>
	</div>
	<div class="container">
		<div class="row">
			<div class="col-12">
				<h2 class="text-center pt-5">{{ $property->title }}</h2>
				<h4 class="propertyItem">{{ $property->address }}&nbsp;{{ $property->city }}&nbsp;{{ $property->state }},&nbsp;{{ $property->zip }}</h4>
				<h5 class="propertyItem">{{ $property->price != null ? '$' . $property->price : 'Call for Pricing' }}&nbsp;/per month</h5>
			</div>
			<div class="col-12">
				<div class="">
					<p class="text-justify py-4">{{ $property->description }}</p>

					@php $dt = new Carbon\Carbon($property->available_date); @endphp
					@php $dtFormat = $dt->toFormattedDateString(); @endphp
					@if($property->active == "N")
						<span class="text-center text-uppercase text-danger"><i>This Property Is Not Currently Available</i></span>
					@else
						@if($dt->isFuture())
							<span class="d-block text-center text-success"><i>Available Date is {{ $dtFormat }} </i></span>
						@else
							<span class="d-block text-center text-success"><i>Currently Available</i></span>
						@endif
					@endif

					<p class="text-center"><i>For more information, please contact us at {{ $settings->phone }} or {{ $settings->email }}</i></p>
				</div>
			</div>
			<div class="col-12 propertyImgGallery my-4">
				<div class="heroImg">
					@if($images->isNotEmpty())
						<img src="" class="img-fluid" />
					@else
						<img src="/images/empty_prop.png" class="img-fluid" />
					@endif
				</div>
				<div class="imgGallery py-4">
					@if($images->isNotEmpty())
						@foreach($images as $image)
							@php $imagePath = asset('storage/' . str_ireplace('public/', '', $image->path)); @endphp
							<img src="{{ asset('storage/' . str_ireplace('public/', '', $image->path)) }}" class="img-thumbnail img-fluid{{ $loop->first ? ' active' : '' }}" onclick="activateImage('{{$imagePath}}')" {{ $loop->first ? "onload=initHeroImg()" : '' }} />
						@endforeach
					@else
						<p class="">No Images Added For This Property</p>
					@endif
				</div>
			</div>
		</div>
		<div class="row align-items-center">
			<h1 class="col text-hide my-3" style="border:1px solid #787878 !important">Hidden Text</h1>
		</div>
	</div>
	<div class="container-fluid bg-theme3">
	</div>
	<script type="text/javascript">
        function activateImage(path) {
            var targetEl = event.target;

            $('img').removeClass('active');
            $(targetEl).addClass('active');
            $('.propertyImgGallery .heroImg img').animate({opacity:'0'}, function() {
                $(this).attr('src', path).animate({opacity:'1'});
            });
        }
	</script>
@endsection
@endif

@section('footer')
@endsection
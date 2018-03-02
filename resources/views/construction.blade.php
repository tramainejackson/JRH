@extends('layouts.app')
	@section('content')
		<div id="home_carousel" class="carousel slide" data-ride="carousel">
			<ol class="carousel-indicators">
				<li data-target="#home_carousel" data-slide-to="0" class="active"></li>
				<li data-target="#home_carousel" data-slide-to="1"></li>
				<li data-target="#home_carousel" data-slide-to="2"></li>
				<li data-target="#home_carousel" data-slide-to="3"></li>
			</ol>
			<div class="carousel-inner">
				<!-- <div class="carousel-item active">
					<a class="btn waves-effect white grey-text darken-text-2">button</a>
				</div> -->
				<div class="carousel-item active" href="#one!">
					<div class="carousel-image" style="background-image: url('/images/family-and-house1.jpg')"></div>
					<div class="carousel-caption">
						<h2>First Panel</h2>
						<p class="">This is your first panel</p>
					</div>
				</div>
				<div class="carousel-item" href="#two!">
					<div class="carousel-image" style="background-image: url('/images/family-and-house12.jpg')"></div>
					<div class="carousel-caption">
						<h2>Second Panel</h2>
						<p class="white-text">This is your second panel</p>
					</div>
				</div>
				<div class="carousel-item" href="#three!">
					<div class="carousel-image" style="background: linear-gradient(rgba(0, 0, 0, 0), rgba(0, 0, 100, 0.6)), url('/images/family-and-house3.jpg')"></div>
					<div class="carousel-caption">
						<h2>Third Panel</h2>
						<p class="white-text">This is your third panel</p>
					</div>
				</div>
				<div class="carousel-item" href="#four!">
					<div class="carousel-image" style="background-image: url('/images/key_to_house.jpg')"></div>
					<div class="carousel-caption">
						<h2>Fourth Panel</h2>
						<p class="white-text">This is your fourth panel</p>
					</div>
				</div>
			</div>
		</div>
	@endsection
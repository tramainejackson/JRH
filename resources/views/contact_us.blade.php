@extends('layouts.app')
@section('content')
	<div id="" class="jumbotron jumbotron-fluid py-5 d-flex align-items-center contactUsJumbotron">
		<div class="container-fluid py-5">
			<h2 class="py-5 text-white display-4">Providing quality living that strengthens communities.</h2>
		</div>
	</div>
	<div class="container">
		<div class="row align-items-center">
			<h1 class="col col-4 text-hide" style="border:1px solid #787878 !important">Hidden Text</h1>
			<h1 class="col col-4 text-muted">Contact Information</h1>
			<h1 class="col col-4 text-hide" style="border:1px solid #787878 !important">Hidden Text</h1>
		</div>
		<div class="row">
			<div class="col col-8 ml-auto mt-4">
				<p>E: {{ $setting->email }}</p>
			</div>
		</div>
		<div class="row">
			<div class="col col-8 ml-auto">
				<p class="">P: {{ $setting->phone }}</p>
			</div>
		</div>
		<div class="row">
			<div class="col col-8 ml-auto mb-4">
				<p>W: <a href="{{ route('contact_us') }}">jacksonrealestatehomes.com/contact_us</a></p>
			</div>
		</div>
		<div class="row align-items-center">
			<h1 class="col text-hide my-3" style="border:1px solid #787878 !important">Hidden Text</h1>
		</div>
	</div>
@endsection
@extends('layouts.app')
@section('addt_style')
	<link href="{{ asset('/css/mat.css') }}" rel="stylesheet">
@endsection
@section('content')
	<div id="" class="jumbotron jumbotron-fluid py-5 d-flex align-items-center aboutUsJumbotron">
		<div class="container-fluid py-5">
			<h2 class="py-5 text-white display-4">Growth and development of our communities are the core of our pursuit.</h2>
		</div>
	</div>
	<div class="container">
		<div class="row align-items-center">
			<h1 class="col col-4 text-hide" style="border:1px solid #787878 !important">Hidden Text</h1>
			<h1 class="col col-4 text-muted">Our Mission</h1>
			<h1 class="col col-4 text-hide" style="border:1px solid #787878 !important">Hidden Text</h1>
		</div>
		<div class="row">
			<div class="col col-8 mx-auto mt-4">
				<p><i>{{ $setting->mission }}</i></p>
			</div>
		</div>
		<div class="row align-items-center">
			<h1 class="col text-hide my-3" style="border:1px solid #787878 !important">Hidden Text</h1>
		</div>
	</div>
@endsection
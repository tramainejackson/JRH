@extends('layouts.remodeling')

@section('content')

	<!--Main Layout-->
	<main>

		<div class="container">

			<div class="row mt-5 pt-5" id="">

				<div class="col-6" id="">

					<h3 class="">Here is a list of services that I can help provide for renovation options</h3>

				</div>

				<div class="col-6" id="">

					<form class="form-inline md-form ml-auto mb-4">
						<input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
						<button class="btn aqua-gradient btn-rounded btn-sm my-0" type="submit">Search</button>
					</form>

				</div>

				@foreach($services as $service)

					<div class="col-auto" id="">
						@if($service->description != null)
							<button class='btn btn-rounded btn-outline-mdb-color serviceTypeBtn' type='button'>{{ $service->type }}&nbsp;&nbsp;<i class="fas fa-info-circle"></i></button>
							<span class="d-none text-hide">{{ $service->description }}</span>
						@else
							<button class='btn btn-rounded btn-mdb-color serviceTypeBtn' type='button'>{{ $service->type }}</button>
						@endif

					</div>

				@endforeach

			</div>

		</div>

	</main>
	<!--Main Layout-->

	@section('addt_script')
		<script type="text/javascript">
			//Add an alert/modal when the button that's clicked has additional information
			$('body').on('click', '.serviceTypeBtn', function() {
			    if($(this).next().length > 0) {
                    toastr.success($(this).next().text(), {timeOut: 5000});
				}
			});
		</script>
	@endsection
@endsection
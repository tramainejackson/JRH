@extends('layouts.app')

@section('addt_script')
	<script type="text/javascript">
		var winHeight = window.innerHeight;
		var screenHeight = screen.availHeight;
		
		// If modal has video, make its max-height 60% of
		// the available screen height
		if($('video')) {
			$('video').css({'maxHeight':(screenHeight * .4) + 'px'})
		}
	</script>
@endsection

@section('content')
	@if(session('status'))
		<h2 class="flashMessage">{{ session('status') }}</h2>
	@endif
	<div class="container py-3" id="content_container">
		{!! Form::model($setting, ['action' => ['SettingsController@update', $setting->id], 'method' => 'PATCH', 'files' => true, 'class' => 'setting_edit_form']) !!}
			<div class="row my-4">
				<div class="col-12">
					<h1 class="text-muted"><u>Home Page Settings</u></h1>
				</div>
				<div class="col">
					<div class="form-group">
						{{ Form::label('show_welcome', 'Show Welcome', ['class' => 'd-block form-control-label']) }}
						
						<div class="btn-group">
							<button type="button" class="btn{{ $setting->show_welcome == 'Y' ? ' btn-success active' : ' btn-blue-grey' }}">
								<input type="checkbox" name="show_welcome" value="Y" hidden {{ $setting->show_welcome == 'Y' ? 'checked' : '' }} />Yes
							</button>
							<button type="button" class="btn{{ $setting->show_welcome == 'N' ? ' btn-danger active' : ' btn-blue-grey' }}">
								<input type="checkbox" name="show_welcome" value="N" hidden {{ $setting->show_welcome == 'N' ? 'checked' : '' }} />No
							</button>
						</div>
					</div>
					<div class="form-group">
						{{ Form::label('welcome_content', 'Welcome Dropdown Content', ['class' => 'd-block form-control-label']) }}
						<textarea name="welcome_content" class="form-control" placeholder="Content will display in dropdown on welcome page" style="height:auto">{{ $setting->welcome_content }}</textarea>
					</div>
					<div class="form-group">
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text">Upload</span>
							</div>
							<div class="custom-file">
								<input type="file" name="welcome_media" id="welcome_media" class="custom-file-input" max="4" multiple>
								<label class="custom-file-label" for="welcome_media">Choose File</label>
							</div>
						</div>
						
						{{ Form::label('', 'Welcome Media', ['class' => 'd-block form-control-label']) }}
						@if($setting->welcome_media == null)
							<span class="text-danger" style="font-size:100% !important;">No image or video added for the dropdown on welcome page</span>
						@else
							@if(substr_count($setting->welcome_media, 'image') > 0)
								<div class="text-center mx-auto position-relative">
									<img class="img-fluid" src="{{ asset(str_ireplace('public', 'storage', $setting->welcome_media)) }}" />
									<a href="#" class="removeWelcomeMedia text-hide" style=""></a>
								</div>
							@else
								<div class="text-center position-relative">
									<video loop controls poster="" preload="auto" muted>
										<source src="{{ asset(str_ireplace('public', 'storage', $setting->welcome_media)) }}" />
									</video>
									<a href="#" class="removeWelcomeMedia text-hide" style=""></a>
								</div>								
							@endif
						@endif
						<div class="welcomeMediaPreview"></div>
					</div>
					<div class="form-group">
						{{ Form::label('carousel_images_upload', 'Carousel Images', ['class' => 'd-block form-control-label']) }}
						
						@if($setting->carousel_images == null)
							<div class="uploadsView"><div class="container-fluid"><div class="row"></div></div></div>
							<span class="text-danger" style="font-size:75% !important;">No image or video added for the carousel on home page</span>
							<label class="custom-file d-block">Add up to 4 images</label>
							<div class="input-group mb-3">
								<div class="input-group-prepend">
									<span class="input-group-text">Upload</span>
								</div>
								<div class="custom-file">
									<input type="file" name="carousel_images[]" id="carousel_images_upload" class="custom-file-input" max="4" multiple>
									<label class="custom-file-label" for="carousel_images_upload">Choose File</label>
								</div>
							</div>
						@else
							@php $carouselImages = explode(';', $setting->carousel_images); @endphp
							<div class="currentCarImageDiv container-fluid">
								<div class="row">
									@foreach($carouselImages as $carouselImage)	
										<div class="col-12 col-md-4 my-1">
											<img class="img-thumbnail h-100 w-100" src="{{ asset('storage/images/' . trim($carouselImage)) }}" />
											<a href="#" class="removeImage text-hide" style=""></a>
										</div>
									@endforeach
								</div>
							</div>
							
							@if($errors->has('carousel_images'))
								<span class="red-text">{{ $errors->first('carousel_images') }}</span>
							@endif
							
							<div class="">
								@if(count($carouselImages) >= 4)
									<span class="d-block text-danger" style="font-size:75% !important;">Max number of media items have been added</span>
								@else
									<label class="custom-file d-block">Add up to 4 images</label>
									<div class="input-group mb-3">
										<div class="input-group-prepend">
											<span class="input-group-text">Upload</span>
										</div>
										<div class="custom-file">
											<input type="file" name="carousel_images[]" id="carousel_images_upload" class="custom-file-input" multiple>
											<label class="custom-file-label" for="carousel_images_upload">Choose File</label>
										</div>
									</div>
								@endif
							</div>
						@endif
					</div>
				</div>
			</div>
			<div class="row my-4">
				<div class="col-12">
					<h1 class="text-muted"><u>Mission Statement</u></h1>
				</div>
				<div class="col">
					<div class="form-group">
						{{ Form::label('mission', 'Mission Statement', ['class' => 'd-block form-control-label']) }}
						<textarea name="mission" class="form-control" placeholder="Content will display in dropdown on welcome page" rows="5" style="height:auto">{{ $setting->mission }}</textarea>
					</div>
				</div>
			</div>
			<div class="row my-4">
				<div class="col-12">
					<h1 class="text-muted"><u>Contact Settings</u></h1>
				</div>
				<div class="col-12">
					<div class="form-group">
						{{ Form::label('phone', 'Phone', ['class' => 'd-block form-control-label']) }}
						<input type="number" name="phone" class="form-control" value="{{ $setting->phone }}" placeholder="Phone" />
					</div>
				</div>
				<div class="col-12">
					<div class="form-group">
						{{ Form::label('email', 'Email', ['class' => 'd-block form-control-label']) }}
						<input type="email" name="email" class="form-control" value="{{ $setting->email }}" placeholder="Phone" />
					</div>
				</div>
			</div>
			<div class="row my-4">
				<div class="col-12">
					<h1 class="text-muted"><u>Properties Settings</u></h1>
				</div>
				<div class="col">
					<div class="form-group">
						{{ Form::label('show_deletes', 'Show Deleted Items', ['class' => 'd-block form-control-label']) }}
						
						<div class="btn-group">
							<button type="button" class="btn{{ $setting->show_deletes == 'Y' ? ' btn-success active' : ' btn-blue-grey' }}">
								<input type="checkbox" name="show_deletes" value="Y" hidden {{ $setting->show_deletes == 'Y' ? 'checked' : '' }} />Yes
							</button>
							<button type="button" class="btn{{ $setting->show_deletes == 'N' ? ' btn-danger active' : ' btn-blue-grey' }}">
								<input type="checkbox" name="show_deletes" value="N" hidden {{ $setting->show_deletes == 'N' ? 'checked' : '' }} />No
							</button>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col">
					<div class="form-group">
						{{ Form::submit('Save Changes', ['class' => 'form-control btn btn-primary', 'id' => 'form_update']) }}
					</div>
				</div>
			</div>
		{!! Form::close() !!}

		<div class="modal fade" id="delete_modal" role="dialog" aria-hidden="true" tabindex="1">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Delete Carousel Image</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body text-dark">
						<div class="">
							<p class="">Are you sure that you want to delete this carousel image?</p>
						</div>
						<div class="">
							{!! Form::open(['action' => ['SettingsController@destroy', 1], 'method' => 'DELETE']) !!}
								<input type="text" name="carouselImageD" class="carouselImageD" value="" hidden />
								<div class="form-group">
									{{ Form::submit('Delete', ['class' => 'form-control btn btn-danger']) }}
									<button class="btn btn-warning form-control cancelBtn" type="button">Cancel</button>
								</div>
							{!! Form::close() !!}
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@extends('layouts.app')

@section('addt_style')
	<style type="text/css">
		/* Required for full background image */
		/* Necessary for full page carousel*/
		html,
		body,
		.view {
			height: 100%;
		}

		.rgba-gradient {
			background: -moz-linear-gradient(45deg, rgba(213, 15, 61, 0.6), rgba(13, 17, 198, 0.69) 100%);
			background: -webkit-linear-gradient(45deg, rgba(213, 15, 61, 0.6), rgba(13, 17, 198, 0.69) 100%);
			background: linear-gradient(45deg, rgba(213, 15, 61, 0.6), rgba(13, 17, 198, 0.69) 100%);
		}
	</style>
@endsection

@section('addt_script')
	<script type="text/javascript">
		var getSRC = $('.side-nav .logo-wrapper img').attr('src');
		var setSRC = getSRC.replace('jrh_logo_white', 'jrh_remodel_logo_white');
		var getVideo = $('#intro-section video.video-intro source').attr('src');
        var setVideo = getVideo.replace('remodel3', 'remodel4');
        var lisItems = $('ul.collapsible li, ul.navbar li, ul.navbar-nav li');
        var getWidth = window.innerWidth;
        var getHeight = window.innerHeight;

		$('.side-nav .logo-wrapper img').css({'padding':'3px 15px'}).attr({'src':setSRC});
		$('.navbar-brand img').attr({'src':setSRC, 'height':55}).addClass('my-n4');

        if(getHeight > (getWidth - 200)) {
            $('#intro-section video.video-intro source').attr({'src':setVideo});
            $('#intro-section video.video-intro')[0].load();
        }

		$(lisItems).each(function() {
		    if($(this).find('a').text() == 'About Us' || $(this).find('a').text() == 'Login' || $(this).find('a').hasClass('collapsible-header') || $(this).find('a').hasClass('dropdown-toggle')) {
                $(this).remove();
			} else {
                if($(this).find('a').text() == 'Contact Us') {
                    $(this).find('a').text('Services');
				} else if($(this).find('a').text() == 'Home') {
                    $(this).find('a').attr({'href':'https://www.jacksonrentalhomesllc.com'})
				} else {
                    $(this).find('a').attr({'href':'#'});
				}
            }
		});

	</script>
@endsection

@section('content')
		<!-- Full Page Intro -->
		<div id="intro-section" class="view">

			<video class="video-intro" poster="{{ asset('/images/jrh_remodel_logo.png') }}" playsinline autoplay muted loop>
				<source src="{{ asset('/videos/remodel3.mp4') }}" type="video/mp4">
			</video>

			<!-- Mask & flexbox options-->
			<div class="mask rgba-gradient d-flex justify-content-center align-items-center">
				<!-- Content -->
				<div class="container px-md-3 px-sm-0">
					<!--Grid row-->
					<div class="row wow fadeIn">
						<!--Grid column-->
						<div class="col-md-12 mb-4 white-text text-center wow fadeIn">
							<h3 class="display-3 font-weight-bold white-text mb-0 pt-md-5 pt-5">Remodeling</h3>
							<hr class="hr-light my-4 w-75">
							<h4 class="subtext-header mt-2 mb-4">By Jackson Rental Homes</h4>
							<a href="#!" class="btn btn-rounded btn-outline-white">
								<i class="fa fa-home"></i> Visit us
							</a>
						</div>
						<!--Grid column-->
					</div>
					<!--Grid row-->
				</div>
				<!-- Content -->
			</div>
			<!-- Mask & flexbox options-->
		</div>
		<!-- Full Page Intro -->
@endsection
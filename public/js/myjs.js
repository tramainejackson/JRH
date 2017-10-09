$(document).ready(function() {
	$(".button-collapse").sideNav();
	// Carousel init
	// Only run carousel if the images are greater than 1
	var carouselSet = '';
	$('.carousel').carousel({
		fullWidth:true
	});

	if($('.carousel-item').length > 1) {
		carouselSet = setInterval(function() {
			$('.carousel').carousel('next');
		}, 10000);
	}
	
	if($('.flashMessage').length == 1) {
		$('.flashMessage').animate({top:'5%'});
		setTimeout(function(){
			$('.flashMessage').animate({top:'-150px'}, function(){
				$('.flashMessage').remove();
			});
		}, 8000);
	}
	
	// Bring up delete modal for contacts
	$('body').on('click', '.deleteBtn, .removeImage', function(e) {
		e.preventDefault();
		
		// If removing carousel Image
		// Add Image to input value
		var image = e.target;
		if($(image).hasClass('removeImage')) {
			var removeImage = $(image).prev().attr('src');
			$('.carouselImageD').val(removeImage);
		}
		
		$('#delete_modal').addClass('d-block');
		setTimeout(function() {
			$('#delete_modal').addClass('show');
			$('body').addClass('modal-open').append("<div class='modal-backdrop fade show'></div>");
		}, 500);
	});
	
	// Bring up delete modal for contacts
	$('body').on('click', '.viewPropMedia', function(e) {
		$('#property_media').addClass('d-block');
		setTimeout(function() {
			$('#property_media').addClass('show');
			$('body').addClass('modal-open').append("<div class='modal-backdrop fade show'></div>");
		}, 500);
	});
	
	// Remove Modal
	$('body').on('click', '.close, .cancelBtn', function(e) {
		e.preventDefault();
		$('.modal').removeClass('show');
		setTimeout(function() {
			$('.modal').removeClass('d-block');
			$('body').removeClass('modal-open');
			$(".modal-backdrop.fade.show").remove();
		}, 500);
	});
	
	// Button toggle switch
	$('body').on("click", "button", function(e) {
		if(!$(this).hasClass('btn-primary') || !$(this).hasClass('btn-danger')) {
			if($(this).children().val() == "Y") {
				$(this).addClass('active btn-success').children().attr("checked", true);
				$(this).siblings().removeClass('active btn-danger').children().removeAttr("checked");
			} else if($(this).children().val() == 'N') {
				$(this).addClass('active btn-danger').children().attr("checked", true);
				$(this).siblings().removeClass('active btn-success').children().removeAttr("checked");
			}
		}	
	});
	
	// House type toggle switch
	$('body').on("click", ".aptBtn, .houseBtn", function(e) {
		e.preventDefault();
		if(!$('.aptBtn').hasClass('active btn-success')) {
			console.log('Here 1');
			$('.aptBtn').addClass('active btn-success').children().attr("checked", true);
			$('.houseBtn').removeClass('active btn-success').children().removeAttr("checked");
		} else if(!$('.houseBtn').hasClass('active btn-success')) {
			console.log('Here 2');
			$('.houseBtn').addClass('active btn-success').children().attr("checked", true);
			$('.aptBtn').removeClass('active btn-success').children().removeAttr("checked");
		} else {
			console.log('Here');
		}
	});
	
	// Bring up dropdown menu item to logout
	$('body').on("mouseenter", ".nav-item.dropdown", function() {
		$('.dropdown-menu .dropdown-item').css({'fontSize':'small'});
		$('.dropdown-menu').css({'min-width':'auto'});
		setTimeout(function() {
			$('.dropdown-menu').slideDown();
		}, 500);
	});
	
	// Remove dropdown menu item to logout
	$('body').on("mouseenter", ".nav-item:not(.dropdown)", function() {
		setTimeout(function() {
			$('.dropdown-menu').slideUp();
		}, 500);
	});
	
});

//Open new window in a smaller window instead of new tab
function newSmallWindow(site) {
	event.preventDefault();
	var siteURL = site;
	console.log(siteURL);
	window.open(siteURL, '_blank', 'toolbar=no, location=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=500px, height=500px');
}
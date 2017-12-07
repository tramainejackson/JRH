$(document).ready(function() {
	
	$.ajaxSetup({
		headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')	},
		cache: false
	});
	
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
	
	// Add progress spinner when submitting form
	$(".property_edit_form, .add_contact_form, #contact_add").submit(function(e){
		$('.loadingSpinner p').text('Sending Contact Information');
		$('#welcome_modal .modal-dialog').hide();
		
		if($(this).hasClass('property_edit_form')) {
			$('.loadingSpinner p').text('Updating Property Information');
		} else if($(this).hasClass('add_contact_form')) {
		} else {
		}
		$('.loadingSpinner').modal('show');
	});
	
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
				$(this).siblings().addClass('btn-secondary').removeClass('active btn-danger').children().removeAttr("checked");
				
				// If this is the contacts page, toggle the addresses select div visibility
				if($('.tenantProp').length > 0) {
					$('.tenantProp').slideDown();
				}
			} else if($(this).children().val() == 'N') {
				$(this).addClass('active btn-danger').children().attr("checked", true);
				$(this).siblings().addClass('btn-secondary').removeClass('active btn-success').children().removeAttr("checked");
				
				// If this is the contacts page, toggle the addresses select div visibility
				if($('.tenantProp').length > 0) {
					$('.tenantProp').slideUp();
				}
			}
		}	
	});
	
	// House type toggle switch
	$('body').on("click", ".aptBtn, .houseBtn", function(e) {
		e.preventDefault();
		if(!$('.aptBtn').hasClass('active btn-success')) {
			$('.aptBtn').addClass('active btn-success').children().attr("checked", true);
			$('.houseBtn').addClass('btn-secondary').removeClass('active btn-success').children().removeAttr("checked");
		} else if(!$('.houseBtn').hasClass('active btn-success')) {
			$('.houseBtn').addClass('active btn-success').children().attr("checked", true);
			$('.aptBtn').addClass('btn-secondary').removeClass('active btn-success').children().removeAttr("checked");
		} else {
			console.log('Here');
		}
	});	
	
	// Call function for file preview when uploading 
	// new images to properties page
	$("#upload_photo_input").change(function () {
		filePreview(this);
	});
	
	// Call function for file preview when uploading 
	// new images to settings page
	$("#carousel_images_upload").change(function () {
		filePreview(this);
	});
	
	// Call function for add contact to send via Ajax call
	// $("#contact_add").submit(function () {
		// addContact(this);
	// });
});

// Preview images before being uploaded on images page and new location page
function filePreview(input) {
    if (input.files && input.files[0]) {
		if(input.files.length > 1) {
			var imgCount = input.files.length
			$('.imgPreview').remove();
			
			for(x=0; x < imgCount; x++) {
				if($('.uploadsView').length < 1) {
					reader.onload = function (e) {
						$('<div class="d-block mx-auto mb-2 d-sm-inline-block" style="height:250px; width:250px; position:relative"><img class="imgPreview img-thumbnail h-100 w-100" src="' + e.target.result + '"/></div>').insertAfter('.currentCarImageDiv:last-of-type');
					}
					reader.readAsDataURL(input.files[0]);
				} else {
					var reader = new FileReader();
					reader.onload = function (e) {
						$('<img class="imgPreview img-thumbnail m-1" src="' + e.target.result + '" width="350" height="200"/>').appendTo('.uploadsView');
					}
					reader.readAsDataURL(input.files[x]);
				}
			}			
		} else {
			var reader = new FileReader();
			$('.imgPreview').remove();
			
			if($('.uploadsView').length < 1) {
				reader.onload = function (e) {
					$('<div class="d-block mx-auto mb-2 d-sm-inline-block" style="height:250px; width:250px; position:relative"><img class="imgPreview img-thumbnail h-100 w-100" src="' + e.target.result + '"/></div>').insertAfter('.currentCarImageDiv:last-of-type');
				}
				reader.readAsDataURL(input.files[0]);

			} else {
				reader.onload = function (e) {
					$('<img class="imgPreview img-thumbnail" src="' + e.target.result + '" width="450" height="300"/>').appendTo('.uploadsView');
				}
				reader.readAsDataURL(input.files[0]);
			}
		}
    }
}

// Remove individual image via ajax request
function addContact() {
	event.preventDefault();
	
	$.ajax({
	  method: "POST",
	  url: "/contacts",
	  data: $('#contact_add').serialize()
	})
	
	.fail(function() {	
		alert("Fail");
	})
	
	.done(function(data) {
		var newData = $(data);
		
		$("#welcome_modal .modal-content").fadeOut(function() {
			$("#welcome_modal .modal-content").html(newData);
			$("#welcome_modal").modal('hide');
			
			setTimeout(function() {
				$("#welcome_modal .modal-content").fadeIn(function() {
				$("#welcome_modal").modal('show');
					setTimeout(function() {
						$("#welcome_modal").modal('toggle');
						$(".modal-backdrop").remove();
					}, 5000);
				});
			}, 500);
		});
	});
}
//Open new window in a smaller window instead of new tab
function newSmallWindow(site) {
	event.preventDefault();
	var siteURL = site;
	console.log(siteURL);
	window.open(siteURL, '_blank', 'toolbar=no, location=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=500px, height=500px');
}
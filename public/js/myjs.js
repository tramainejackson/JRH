$(document).ready(function() {
	
	$.ajaxSetup({
		headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')	},
		cache: false
	});
	
	// Commonly user variables
	var winHeight = window.innerHeight;
	var winWidth = window.innerWidth;
	var screenHeight = screen.availHeight;
	var screenWidth = screen.availWidth;
	
	// Since fixed height for nav, add nav height to container
	$('#content_container').css({'margin-top':$('nav').height() + 'px'});

	// Animations initialization
	new WOW().init();
	
	// Initialize the datetimepicker
	$('#datetimepicker, .datetimepicker').pickadate({
		// Escape any “rule” characters with an exclamation mark (!).
		format: 'mm/dd/yyyy',
		formatSubmit: 'yyyy/mm/dd',
	});
	
	$('.timepicker').pickatime({
		// 12 or 24 hour 
		twelvehour: true,
		autoclose: true,
	});
	
	// Dropdown Init
	$('.dropdown-toggle').dropdown();
	
	// Carousel init
	// Only run carousel if the images are greater than 1
	// var carouselSet = '';
	// $('.carousel').carousel({
		// fullWidth:true
	// });

	// if($('.carousel-item').length > 1) {
		// carouselSet = setInterval(function() {
			// $('.carousel').carousel('next');
		// }, 10000);
	// }
	
	if($('.flashMessage').length == 1) {
		$('.flashMessage').animate({top:'+=' + ($('nav').height() + 150) + 'px'});
		setTimeout(function(){
			$('.flashMessage').animate({top:'-150px'}, function(){
				// $('.flashMessage').remove();
			});
		}, 8000);
	}
	
	// Remove disabled from the document title input
	// when a document is added
	$('[name="document[]"]').on('change', function() {
		$('[name="document_title"]').removeAttr('disabled').focus();
	});

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
	
	// Add/Remove mask on media items when checkbox is selected/deselected
	$('body').on('change', ':checkbox', function() {
		var counter=0;
		
		$('.mediaBlock :checkbox').each(function() {
			if($(this).prop('checked')) {
				$(this).parent().next().find('.mask').removeClass('invisible');
				counter++;
			} else {
				$(this).parent().next().find('.mask').addClass('invisible');
			}
		});
		
		if(counter > 0) { 
			$('button.removeMediaBtn').fadeIn();
		} else {
			$('button.removeMediaBtn').slideUp();
		}
	});
	
	// Add the selected media item to the modal for delete verification
	$('body').on('click', '.removeMediaBtn', function() {
		if($('.mediaBlock input:checked').length > 0) {
			$('.mediaBlock input:checked').each(function() {
				var mediaObject = $(this).parent().next().clone();
				
				$(mediaObject).find('.mask, input').hide();
				$(mediaObject).prependTo($('#property_media form .row'));
			});
		}
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
	
	//Search option box
	$(".valueSearch ").keyup(function(e){
		startSearch($(".valueSearch ").val());
	});
	
	// Remove Modal
	$('body').on('click', '.close, .cancelBtn', function(e) {
		e.preventDefault();
		$('.modal').removeClass('show');
		
		// If this modal is the remove media objects modal
		if($(this).hasClass('dismissProperyMedia')) {
			// Remove all media objects from the modal
			$(this).parent().next().find('form .row').empty();
		}
		
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
				$(this).addClass('active btn-success').removeClass('btn-blue-grey').children().attr("checked", true);
				$(this).siblings().addClass('btn-blue-grey').removeClass('active btn-danger').children().removeAttr("checked");
				
				// If this is the contacts page, toggle the addresses select div visibility
				if($('.tenantProp').length > 0) {
					$('.tenantProp').slideDown();
				}
			} else if($(this).children().val() == 'N') {
				$(this).addClass('active btn-danger').removeClass('btn-blue-grey').children().attr("checked", true);
				$(this).siblings().addClass('btn-blue-grey').removeClass('active btn-success').children().removeAttr("checked");
				
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
			$('.houseBtn').addClass('btn-blue-grey').removeClass('active btn-success').children().removeAttr("checked");
		} else if(!$('.houseBtn').hasClass('active btn-success')) {
			$('.houseBtn').addClass('active btn-success').children().attr("checked", true);
			$('.aptBtn').addClass('btn-blue-grey').removeClass('active btn-success').children().removeAttr("checked");
		} else {
			console.log('Here');
		}
	});
	
	// Under Construction / Active Toggle Switch
	$('body').on("click", ".activeProp, .underConstr", function(e) {
		e.preventDefault();
		if($(this).hasClass('activeProp')) {
			if($(this).hasClass('activeYes')) {
				$(this).addClass('active btn-success').removeClass('btn-blue-grey').children().attr("checked", true);
				$('.activeNo').removeClass('active btn-danger').addClass('btn-blue-grey').children().removeAttr("checked");
				$('.noUnderConstr').addClass('btn-danger active').removeClass('btn-blue-grey').children().attr("checked", true);
				$('.activeUnderConstr').addClass('btn-blue-grey').removeClass('active btn-success').children().removeAttr("checked");
			} else if($(this).hasClass('activeNo')) {
				$('.activeYes').addClass('btn-blue-grey').removeClass('active btn-success').children().removeAttr("checked");
				$('.activeNo').removeClass('btn-blue-grey').addClass('active btn-danger').children().attr("checked", true);
			} else {
				console.log('Here');
			}
		} else if($(this).hasClass('underConstr')) {
			if($(this).hasClass('activeUnderConstr')) {
				$(this).addClass('active btn-success').removeClass('btn-blue-grey').children().attr("checked", true);
				$('.noUnderConstr').removeClass('active btn-danger').addClass('btn-blue-grey').children().removeAttr("checked");
				$('.activeNo').addClass('btn-danger active').removeClass('btn-blue-grey').children().attr("checked", true);
				$('.activeYes').addClass('btn-blue-grey').removeClass('active btn-success').children().removeAttr("checked");
			} else if($(this).hasClass('noUnderConstr')) {
				$('.activeUnderConstr').addClass('btn-blue-grey').removeClass('active btn-success').children().removeAttr("checked");
				$('.noUnderConstr').removeClass('btn-blue-grey').addClass('active btn-danger').children().attr("checked", true);
			} else {
				console.log('Here');
			}
		}
	});	
	
	// Change the default property image
	$('body').on('click', '.makeDefault', function() {
		var image = $(this).prev().prev();
		
		defaultPropImage(image);
	});
	
	// Click on input button when user goes to change
	// contact picture
	$('body').on('click', '.contactImg button', function(e) {
		e.preventDefault();
		$('.contactImg input').click();
	});
	
	// Call function for file preview when uploading 
	// new contact image
	$('.contactImg input').change(function () {
		contactImgPreview(this);
	});
	
	// Call function for file preview when uploading 
	// new images to properties page
	$("#upload_photo_input").change(function () {
		filePreview(this);
		fileLoaded(this);
	});
	
	// Call function for file preview when uploading 
	// new images to settings page
	$("#carousel_images_upload").change(function () {
		filePreview(this);
		fileLoaded(this);
	});
	
	// Change the background color of submit button when sending 
	// contact an email
	$("body").on('change', '.contactEmail #email_body textarea, .contactEmail #email_subject input', function () {
		var subject = $('.contactEmail #email_body textarea');
		var body = $('.contactEmail #email_subject input');
		if($(subject).val() != '' && $(body).val() != '') {
			$('[name="send_email"]').removeClass('lighten-5').addClass('dakren-3 active');
		};
	});
});

//Check to see if the file has been loaded
//If so then remove modal
function fileLoaded(input) {
	setInterval(function() {
		if($('.imgPreview').length == input.files.length) {
			$('.loadingSpinner, .modal-backdrop')
				.css({'display' : 'none'})
				.removeClass('show')
				.addClass('hide');
			$('body')
				.removeClass('modal-open');
		}
	}, 1000);
}

// Preview images before being uploaded on images page and new location page
function filePreview(input) {
	var backdrop = '<div class="modal-backdrop show fade"></div>';
	$(backdrop).appendTo('body');
	$('.loadingSpinner')
		.css({'display' : 'block'})
		.addClass('show')
		.removeClass('hide')
		.find('p')
		.text('Adding Image/Video');
	$('body')
		.addClass('modal-open');
	
    if(input.files && input.files[0]) {
		if(input.files.length > 1) {
			var imgCount = input.files.length
			$('.imgPreview').parent().remove();
			
			for(x=0; x < imgCount; x++) {
				if($('.uploadsView').length < 1) {
					if(input.files[x].type.indexOf('video') != -1) {
						var reader = new FileReader();
						reader.onload = function (e) {
							$('<div class="d-block mx-auto mb-2 d-sm-inline-block" style="height:250px; width:250px; position:relative"><video controls class="imgPreview" style="max-height:250px;"><source src="' + e.target.result + '" /></video></div>').appendTo($('.currentCarImageDiv').find('.row'));
						}
						reader.readAsDataURL(input.files[x]);
					} else {
						var reader = new FileReader();
						reader.onload = function (e) {
							$('<div class="col-4 my-1"><img class="imgPreview img-thumbnail h-100 w-100" src="' + e.target.result + '"/></div>').appendTo($('.currentCarImageDiv').find('.row'));
						}
						reader.readAsDataURL(input.files[x]);
					}
				} else {
					if(input.files[x].type.indexOf('video') != -1) {
						var reader = new FileReader();
						reader.onload = function (e) {
							$('<video controls class="imgPreview" style="max-height:250px;"><source src="' + e.target.result + '" /></video>').appendTo('.uploadsView');
						}
						reader.readAsDataURL(input.files[x]);
					} else {
						var reader = new FileReader();
						reader.onload = function (e) {
							$('<div class="col-4 my-1"><img class="imgPreview img-thumbnail" src="' + e.target.result + '" width="450" height="300"/></div>').appendTo($('.uploadsView').find('.row'));
						}
						reader.readAsDataURL(input.files[x]);
					}
				}
			}			
		} else {
			var reader = new FileReader();
			$('.imgPreview').parent().remove();

			if($('.uploadsView').length < 1) {
				if(input.files[0].type.indexOf('video') != -1) {
					reader.onload = function (e) {
						$('<div class="d-block mx-auto mb-2 d-sm-inline-block" style="height:250px; width:250px; position:relative"><video controls class="imgPreview" style="max-height:250px;"><source src="' + e.target.result + '" /></video></div>').insertAfter('.currentCarImageDiv:last-of-type');
					}
					reader.readAsDataURL(input.files[0]);
				} else {
					reader.onload = function (e) {
						$('<div class="col-4 my-1"><img class="imgPreview img-thumbnail h-100 w-100" src="' + e.target.result + '"/></div>').appendTo($('.currentCarImageDiv').find('.row'));
					}
					reader.readAsDataURL(input.files[0]);
				}
			} else {
				if(input.files[0].type.indexOf('video') != -1) {
					reader.onload = function (e) {
						$('<video controls class="imgPreview" style="max-height:250px;"><source src="' + e.target.result + '" /></video>').appendTo('.uploadsView');
					}
					reader.readAsDataURL(input.files[0]);
				} else {
					reader.onload = function (e) {
						$('<div class="col-4 my-1"><img class="imgPreview img-thumbnail" src="' + e.target.result + '" width="450" height="300"/></div>').appendTo($('.uploadsView').find('.row'));
					}
					reader.readAsDataURL(input.files[0]);
				}
			}
		}
    }
}

// Preview contact image before uploading
function contactImgPreview(input) {
	var backdrop = '<div class="modal-backdrop show fade"></div>';
	$(backdrop).appendTo('body');
	$('.loadingSpinner')
		.css({'display' : 'block'})
		.addClass('show')
		.removeClass('hide')
		.find('p')
		.text('Adding Image/Video');
	$('body')
		.addClass('modal-open');
	
	var reader = new FileReader();

	reader.onload = function (e) {
		$('.contactImg img').attr('src', e.target.result);
	}
	reader.readAsDataURL(input.files[0]);
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

// Remove individual image via ajax request
function defaultPropImage(img) {
	event.preventDefault();

	$.ajax({
	  method: "POST",
	  url: "/default_image",
	  data: {PropertyImages:$(img).val()}
	})
	
	.fail(function() {
		alert("Fail");
	})
	
	.done(function(data) {
		var image = data;
		var allImages = $('.deletePropImages');
		
		$(allImages).each(function() {
			inputVal = $(this).find('input');
			button = $(this).find('button');
			
			if($(inputVal).val() == $(image)[0].id) {
				$(button).text('Default').addClass('btn-success').removeClass('btn-primary');
			} else {
				$(button).text('Make Default').addClass('btn-primary').removeClass('btn-success');
			}
		});
	});
}

// Filter members with search input
// Check text to see if it matches the search criteria being entered
function startSearch(searchVal) {
	var searchList = $('.fileList, .contactList, .propertyList');
	var searchCriteria = searchVal.toLowerCase();
	var foundResults = 0;
	$(searchList).removeClass("matches");
	$('.noSearchResults').remove();
	
	if(searchCriteria != "") {
		$(searchList).each(function(event){
			var dataString = $(this).find('h1').text().toLowerCase();
			
			if(dataString.includes(searchCriteria)) {
				$(this).addClass("matches");
				$(this).show();
				$(this).next().show();
				foundResults++;
			} else if(!dataString.includes(searchCriteria)) {
				$(this).next().hide();
				$(this).hide();
			}
		});
		
		// If all rows are hidden, then add a row saying no results found
		if(foundResults == 0) {
			$('<tr class="noSearchResults"><td>No Results Found</td></tr>').appendTo($('table.table tbody'));
		}
	} else {
		$(searchList).each(function(event){
			$(this).show();
			$(this).next().show();
		});
	}
}
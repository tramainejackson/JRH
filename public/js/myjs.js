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

    // Animations initialization
    new WOW().init();

    // Initialize MDB select
    $('.mdb-select').materialSelect();

    // Work around for select search not working
    $(".mdb-select").find(".search").on("click", function (e) {
        e.preventDefault();
        $(this).focus();
    });

    // SideNav Initialization
    $(".button-collapse").sideNav();

    //Toggle value for checked item
    $("body").on("click", ".propUtilSwitch", function(e) {
        $(this).toggleClass('btn-success active btn-blue-grey');

        if($(this).children().attr('checked') == 'checked') {
            $(this).children().removeAttr('checked');
        } else {
            $(this).children().attr('checked', 'checked');
        }
    });

    // Remove an added requirement that hasn't been saved yet
    $('body').on('click', '.removeRequirement', function() {
        var inputGroup = $(this).parents('.input-group');
        $(inputGroup).addClass('animated bounceOut');

        setTimeout(function() {
            $(inputGroup).remove();
        }, 1000);
    });

    // Remove an added requirement that hasn't been saved yet
    $('body').on('click', '.deleteRequirement', function(e) {
        // Get the requirement id
        var requirement = $(this).parents('.input-group').find('input.hidden');

        // Send input field to deleteRequirement function
        deleteRequirement(requirement);
    });

    // Add a requirement input group to the requirements
    // form block
    $('body').on('click', '.addRequirementBtn', function() {
        var inputGroup = $(this).parent().find('.input-group:not(.animated)').clone();
        var formGroup = $(this).next();

        // Animate input group when added to DOM
        $(inputGroup).show().addClass('animated bounceIn').appendTo($(formGroup));
    });

    // Initialize the datetimepicker
    $('.datepicker').datepicker({
        // Escape any “rule” characters with an exclamation mark (!).
        format: 'mm/dd/yyyy',
        formatSubmit: 'yyyy/mm/dd',
    });

    // Remove flash message if there is one after 8 seconds
    if($('.flashMessage').length == 1) {
        $('.flashMessage').animate({top:'+=' + ($('nav').height() + 150) + 'px'});
        setTimeout(function(){
            $('.flashMessage').animate({top:'-150px'}, function(){
                // $('.flashMessage').remove();
            });
        }, 8000);
    }

    // Disable submit button once selected
    $('body').on('click', '.add_contact_form input[type="submit"], #contact_add  input[type="submit"]',  function(e) {
        // e.preventDefault();

        $(this).attr('disbaled', true);
    });

    // Remove disabled from the document title input
    // when a document is added
    $('[name="document[]"]').on('change', function() {
        $('[name="document_title"]').removeAttr('disabled').focus();
    });

    // Add progress spinner when submitting form
    $(".property_edit_form, .setting_edit_form, .contact_edit_form, .add_contact_form, .send_calendar_notification_form, #contact_add").submit(function(e) {
        $('.loadingSpinner p').text('Sending Contact Information');
        $('#welcome_modal .modal-dialog').hide();

        if($(this).hasClass('property_edit_form')) {
            $('.loadingSpinner p').text('Updating Property Information');
        } else if($(this).hasClass('add_contact_form')) {
            $('.loadingSpinner p').text('Adding Contact Information');
        } else if($(this).hasClass('contact_edit_form')) {
        } else if($(this).hasClass('send_calendar_notification_form')) {
            $('.loadingSpinner p').text('Sending Property Showing to Contact(s)');
            $('#notiModal .modal-dialog').hide();
        } else {}

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

                $(this).appendTo($(mediaObject));
                $(mediaObject).find('.mask').hide();
                $(mediaObject).prependTo($('#property_media form .row'));
            });
        }
    });

    // Bring up save input button if any of the information is changed on the
    // showing card
    $('body').on('change', '.showingCard input, .showingCard textarea', function() {
        $(this).parent().parent().find('input[name="update_showing"]').slideDown();
    });

    // Bring up delete modal for deletions
    $('body').on('click', '.deleteBtn, .removeImage, .removeWelcomeMedia', function(e) {
        e.preventDefault();

        // If removing carousel Image
        // Add Image to input value
        var image = e.target;
        if($(image).hasClass('removeImage')) {
            var removeImage = $(image).prev().attr('src');
            var appendImage = $(image).prev().clone();
            $('.carouselImageD').val(removeImage);

            $(appendImage).addClass('mb-2');
            $('#delete_modal .modal-body > div:first-of-type').append($(appendImage));
        } else if($(image).hasClass('removeWelcomeMedia')) {
            var appendWelcomeMedia = $(image).prev().clone();
            $('.carouselImageD').val('welcomeMedia');

            $(appendWelcomeMedia).addClass('mb-2');
            $('#delete_modal .modal-body > div:first-of-type').append($(appendWelcomeMedia));
        }

        $('#delete_modal').addClass('d-block');
        setTimeout(function() {
            $('#delete_modal').addClass('show');
            $('body').addClass('modal-open').append("<div class='modal-backdrop fade show'></div>");
        }, 500);
    });

    //Search option box
    // $(".valueSearch ").keyup(function(e){
    // startSearch($(".valueSearch ").val());
    // });

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
            $('.aptBtn').addClass('active btn-success').removeClass('btn-blue-grey').children().attr("checked", true);
            $('.houseBtn').addClass('btn-blue-grey').removeClass('active btn-success').children().removeAttr("checked");
        } else if(!$('.houseBtn').hasClass('active btn-success')) {
            $('.houseBtn').addClass('active btn-success').removeClass('btn-blue-grey').children().attr("checked", true);
            $('.aptBtn').addClass('btn-blue-grey').removeClass('active btn-success').children().removeAttr("checked");
        } else {
            console.log('Here');
        }
    });

    // Rent/Sale type toggle switch
    $('body').on("click", ".rentBtn, .saleBtn", function(e) {
        e.preventDefault();
        if(!$('.rentBtn').hasClass('active btn-success')) {
            $('.rentBtn').addClass('active btn-success').removeClass('btn-blue-grey').children().attr("checked", true);
            $('.saleBtn').addClass('btn-blue-grey').removeClass('active btn-success').children().removeAttr("checked");
        } else if(!$('.saleBtn').hasClass('active btn-success')) {
            $('.saleBtn').addClass('active btn-success').removeClass('btn-blue-grey').children().attr("checked", true);
            $('.rentBtn').addClass('btn-blue-grey').removeClass('active btn-success').children().removeAttr("checked");
        } else {
            console.log('Here');
        }
    });

    // Under Construction / Active Toggle Switch
    $('body').on("click", ".activeProp, .activeBlog", function(e) {
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
        } else if($(this).hasClass('activeBlog')) {
            if($(this).hasClass('activeYes')) {
                $(this).addClass('active btn-success').removeClass('btn-blue-grey').children().attr("checked", true);
                $('.activeNo').removeClass('active btn-danger').addClass('btn-blue-grey').children().removeAttr("checked");
            } else if($(this).hasClass('activeNo')) {
                $('.activeYes').addClass('btn-blue-grey').removeClass('active btn-success').children().removeAttr("checked");
                $('.activeNo').removeClass('btn-blue-grey').addClass('active btn-danger').children().attr("checked", true);
            } else {
                console.log('Here');
            }
        }
    });

    // Scroll through calendars
    $('body').on('click', '.calendarMonth li.prev, .calendarMonth li.next', function() {
        var showingCalendarMonth = $(this).parent().parent().parent();

        if($(this).hasClass('next')) {
            if($(showingCalendarMonth).next().hasClass('calendarMonth')) {
                // Hide current calendar month
                $(showingCalendarMonth).hide();
                $(showingCalendarMonth).next().show();
            } else {
                toastr.error("No calendar months listed for next year", "Uh Ohh!!!", {showMethod: 'slideDown'});
            }
        } else {
            if($(showingCalendarMonth).prev().hasClass('calendarMonth')) {
                // Hide current calendar month
                $(showingCalendarMonth).hide();
                $(showingCalendarMonth).prev().show();
            } else {
                toastr.error("No calendar months listed for previous year", "Uh Ohh!!!", {showMethod: 'slideDown'});
            }
        }
    });

    // Change the default property image
    $('body').on('click', '.makeDefault', function() {
        var image = $(this).prev().prev().find('input');

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
        fileLoaded(this);
    });

    // Call function for file preview when uploading
    // new contact image
    $('input#welcome_media').change(function () {
        welcomeMediaPreview(this);
        fileLoaded(this);
    });

    // Call function for removing current showing
    $('body').on('click', '.getRemoveShowing', function() {
        $('#delete_modal').find('.btn.btn-danger').addClass('removeShowing').attr({'type':'button', 'onclick':'event.preventDefault(); removeShowing(this);'});
    });

    // Call function for updating current showing
    $('body').on('click', '.updateShowing', function(e) {
        updateShowing(
            $(this).parents('div.card').find('#showing_id'),
            $(this).parents('div.card').find('input[name="show_date_submit"]'),
            $(this).parents('div.card').find('#show_time'),
            $(this).parents('div.card').find('#show_instruc')
        );
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

    // Get all property showings for selected date
    $("body").on('click', '.propShowings', function(e) {
        getShowings($(this).children().attr('id'));
    });

    // Upload new image for the current reunion
    $('body').on('click', 'button.resetCounterBtn', function() {
        event.preventDefault();

        $.ajax({
            url: "/reset_count",
            method: "POST",
            contentType: false,
            processData: false,
            cache: false,

            success: function(data) {
                var d = new Date();
                // Display a success toast
                toastr.success(data);
                $('.settingsCounter').text('0');
                $('.settingsCounterDate').text(d.toDateString());
            },
        });

        return false;
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
    $('.loadingSpinner').find('p').text('Adding Image/Video').ready(function() {
        $('.loadingSpinner').modal('show');
    });

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
                            $('<div class="col-6 my-1"><video controls class="imgPreview" style="max-height:250px;"><source src="' + e.target.result + '" /></video></div>').appendTo('.uploadsView');
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
                        $('<div class="col-6 my-1"><video controls class="imgPreview" style="max-height:250px;"><source src="' + e.target.result + '" /></video></div>').appendTo('.uploadsView');
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
        $('.contactImg img').attr('src', e.target.result).addClass('imgPreview');
    }
    reader.readAsDataURL(input.files[0]);
}

// Preview contact image before uploading
function welcomeMediaPreview(input) {
    $('.loadingSpinner').find('p').text('Adding Image/Video').ready(function() {
        $('.loadingSpinner').modal('show');
    });

    var reader = new FileReader();
    $('.welcomeMediaPreview *').remove();

    if(input.files[0].type.indexOf('video') != -1) {
        reader.onload = function (e) {
            $('<div class="col-6 my-1"><video controls class="imgPreview" style="max-height:250px;"><source src="' + e.target.result + '" /></video></div>').appendTo('.welcomeMediaPreview');
        }
        reader.readAsDataURL(input.files[0]);
    } else {
        reader.onload = function (e) {
            $('<div class="col-4 my-1"><img class="imgPreview img-thumbnail" src="' + e.target.result + '" width="450" height="300"/></div>').appendTo($('.welcomeMediaPreview'));
        }
        reader.readAsDataURL(input.files[0]);
    }
}

// Get all showings for a particular date
function getShowings(date) {
    event.preventDefault();

    $.ajax({
        method: "GET",
        url: "/calendar/" + date + "/",
    })

    .fail(function() {
        alert("Fail");
    })

    .done(function(data) {
        var newData = $(data);
        var elmnt = document.getElementById("showings_content");
        if($('.showingsContent *').length < 1) {
            $(newData).appendTo($('.showingsContent'));
        } else {
            $('.showingsContent *').addClass('animated zoomOutLeft');
            $('.mdb-select').hide();

            setTimeout(function() {
                $('.showingsContent').empty().ready(function(e) {
                    $(newData).find('.datepicker').datepicker({
                        // Escape any “rule” characters with an exclamation mark (!).
                        format: 'mm/dd/yyyy',
                        formatSubmit: 'yyyy/mm/dd',
                    });
                    $(newData).find('.timepicker').timepicker();
                    $(newData).appendTo($('.showingsContent'));

                    //Bring the new content into view
                    elmnt.scrollIntoView();
                });
            }, 800);
        }
    });
}

// Fill delete modal
function deleteModalUpdate(button) {
    var new_info = $(button).parents('div.modal-row');
    var form_info = $(button).attr('id').split('_');
    var form_controller = form_info[0].replace('consult', 'consult_').toLocaleLowerCase();
    var form_edit_id = form_info[1];

    // Remove any previous information
    $('#delete_modal').find('.newModalContent').remove();

    // Update Delete Modal Form
    $('#delete_modal').find('.modal-body-form').attr('action', location.origin + '/' + form_controller + '/' + form_edit_id);

    // Update Delete Modal Info
    $('#delete_modal').find('.modal-body-text').append(new_info.find('.newModalContent').clone().addClass('table-responsive'));
}

// Remove the selected showing on the calendar
function removeShowing() {
    event.preventDefault();
    var url = $('#delete_modal').find('form').attr('action');
    var startIndex = url.indexOf('calendar/');
    var showing = url.substr(startIndex+9);
    var removeCard = $('.showingsContent .card .getRemoveShowing#calendar_' + showing).parent().parent().parent().addClass('animated zoomOutLeft');

    $.ajax({
        method: "Delete",
        url: url,
    })

    .fail(function() {
        alert("Fail");
    })

    .done(function(data) {
        var newData = $(data);
        console.log(data);

        $('#delete_modal').modal('hide');

        // Display a success toast, with a title
        toastr.success(data);

        // Remove the showing card that was removed from the calendar
        setTimeout(function() {
            // Animate and hide card
            if($('.showingsContent .showingCard:not(.animated)').length < 1) {
                // Reload the page
                location.reload(true);
            }

            $(removeCard).remove();
        }, 2000);
    });
}

// Update the selected showing on the calendar
function updateShowing(showing, date, time, instructions) {
    event.preventDefault();

    $.ajax({
        method: "PATCH",
        url: "/calendar/" + $(showing).val() + "/",
        data: {date:$(date).val(), time:$(time).val(), instructions:$(instructions).val()}
    })

        .fail(function() {
            alert("Fail");
        })

        .done(function(data) {
            var newData = $(data);
            var removeCard = $('.showingsContent .card input[value="' + $(showing).val() + '"]').parent().parent().parent();

            toastr.success("Calendar showing updated", "Success", {showMethod: 'slideDown'});

            // Reload the page
            // setTimeout(function() {
                // location.reload(true);
            // }, 800);
        });
}

// Add contact via ajax request
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

// Remove individual requirement for property
function deleteRequirement(input) {
    event.preventDefault();

    $.ajax({
        method: "DELETE",
        url: "/remove_requirement/" + $(input).val(),
        data: {propertyRequirement:$(input).val()}
    })

        .fail(function() {
            alert("Fail");
        })

        .done(function(data) {
            var successData = data;
            var inputGroup = $(input).parent();

            // Removed the whole input group with animation
            $(inputGroup).addClass('bounceOut');

            // Display an error toast
            toastr["success"]("Requirement deleted successfully")

            // Remove the input from the DOM after animation completed
            setTimeout(function() {
                $(inputGroup).remove();
            }, 1000);
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

// Initialize tooltip
$(function () {
    $('[data-toggle="tooltip"]').tooltip()
});

// MDB Lightbox Init
$(function () {
    $("#mdb-lightbox-ui").load("/addons/mdb-lightbox-ui.html");
});

/* init Jarallax */
jarallax(document.querySelectorAll('.jarallax'));

jarallax(document.querySelectorAll('.jarallax-keep-img'), {
    keepImg: true,
});
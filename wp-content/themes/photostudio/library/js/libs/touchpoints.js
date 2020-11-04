jQuery(document).ready(function($){

// on listing page, this code is use in responsivness
	$(".list-content li:first-child").append("<span class='list-button'></span>");

	$(".list-button").click(function(){
		$(this).parents('ul').children('li:not(:first-child)').slideToggle();
		$(this).parents('ul').children('li:first-child').toggleClass('show');
	});

	$(".remove").click(function(){
            $(this).parents(".schedule-details").slideUp();
	});

// on Touchpoint process page: to sort out scheduled lists
	$( ".datepicker" ).datepicker({dateFormat: 'dd-mm-yy'});

	$("#sortable").sortable({

		update : function(event, ui){
			$('.schedule-details').each(function(index){
					$(this).attr('data-index-number', index + 1)
			});
			}
	});
	$("#sortable").disableSelection();


// to count the numbers up, after page loading (animates the number counting from 0 to up), used on listed page
	$('.count').each(function () {
        $(this).prop('Counter',0).animate({
            Counter: $(this).text()
        }, {
            duration: 2000,
            easing: 'swing',
            step: function (now) {
                $(this).text(Math.ceil(now));
            }
        });
    });
        
    function GetURLParameter(sParam) {
        var sPageURL = window.location.search.substring(1);
        var sURLVariables = sPageURL.split('&');
        for (var i = 0; i < sURLVariables.length; i++) {
            var sParameterName = sURLVariables[i].split('=');
            if (sParameterName[0] == sParam) {
                return sParameterName[1];
            }
        }
    }
    
    function cancelBooking() {
        var id = GetURLParameter('id');
        console.log(id);
        if(confirm('Are you sure you want to cancel this booking?') == true) {
            jQuery.ajax({
                    type: 'POST',
                    dataType: 'json',
                    url: ajax_scripts_object.ajaxurl,
                    data: 'action=ajaxcancelbooking&id=' + id,
                    success: function (data) {
                        if (data.error) {

                        }
                        if (data.success) {
                            location.reload();
                        }
                    }
                });
        };
    }
    
    function pauseBooking() {
        var id = GetURLParameter('id');
        console.log(id);
        if(confirm('Are you sure you want to pause this booking?') == true) {
            jQuery.ajax({
                    type: 'POST',
                    dataType: 'json',
                    url: ajax_scripts_object.ajaxurl,
                    data: 'action=ajaxpausebooking&id=' + id,
//                    success: function (data) {
//                        if (data.error) {
//
//                        }
//                        if (data.success) {
//                            location.reload();
//                        }
//                    }
                });
        };
    }
    
    $('button.recalc').click(function () {
        var id = GetURLParameter('id');
        var data = jQuery('.list-of-touchpoints').serialize();
        $('#sortable').slideUp();
        $('#sortable').empty();
        jQuery.ajax({
            type: 'POST',
            dataType: 'json',
            url: ajax_scripts_object.ajaxurl,
            data: 'action=ajaxrecalcdates&id=' + id + '&data=' + data,
            success: function (data) {
                if (data.error) {

                }
                if (data.success) {
                    $('#sortable').html(data.data);
                    $('#sortable').slideDown();
                }
            }
        });
    });  
    
    $('body').on('focus', ".datepicker", function(){
        $(this).datepicker({dateFormat: 'dd-mm-yy'});
    });
    
    $('#cancelBooking').click(function () {
        cancelBooking();
    });
    
    $('#pauseBooking').click(function () {
        pauseBooking();
    });
    
    $('#addTouchpoint').autocomplete({
        source: ajax_scripts_object.autoOptions
    });

//    $('#addTouchpointButton').click(function() {
//        var type = $('#addTouchpoint').val();
//        if(type !== '') {
//            $('#sortable').append('<ul class="schedule-details ui-state-default" data-index-number="" data-touchpoint-id=""><li><label>Customer notification Name</label><div>' + type + '</div></li><li><label>Schedule</label><div><span><?php echo $status; ?></span><input type="text" class="datepicker" name="schedule-date_<?php echo $n->id; ?>" value=""></div></li><li><label>Actions</label><div><ul class="actions"><li class="remove"><input type="checkbox" id="deleted_<?php echo $n->id; ?>" name="deleted_<?php echo $n->id; ?>"><label for="deleted_<?php echo $n->id; ?>"><i class="fa fa-trash-o"></i>Delete</label></li><li><i class="fa fa-arrows"></i></li></ul></div></li></ul>');
//        };
//        
//        
//    });
    
    $('#addTouchpointButton').click(function () {
        var id = GetURLParameter('id');
        var type = $('#addTouchpoint').val();
        jQuery.ajax({
            type: 'POST',
            dataType: 'json',
            url: ajax_scripts_object.ajaxurl,
            data: 'action=ajaxaddTouchpoint&id=' + id + '&type=' + type,
            success: function (data) {
                if (data.error) {

                }
                if (data.success) {
                    $('#sortable').append('<ul class="schedule-details ui-state-default" data-index-number="<?php echo $i; ?>" data-touchpoint-id="'+data.data+'">'+
                            '<li><label>Customer notification Name</label><div>'+type+'</div></li>'+
                            '<li><label>Schedule</label><div><span>Pending</span><input type="text" class="datepicker"  name="schedule-date_'+data.data+'" value="" ></div></li>'+
                            '<li><label>Actions</label><div>'+
                                    '<ul class="actions">'+
                                        '<li class="remove" data-touchpoint-id="<?php echo $i; ?>"><input type="checkbox" id="deleted_'+data.data+'" name="deleted_<?php echo $n->id; ?>"><label for="deleted_'+data.data+'"><i class="fa fa-trash-o"></i>Delete</label></li>'+
                                        '<li><i class="fa fa-arrows"></i></li>'+
                                    '</ul></div>'+
                            '</li>'+
                        '</ul>');
                }
            }
        });
    }); 
        
    $('#addTouchpointGroupButton').click(function() {
        $('.touchpointsList').find('li').last().clone().appendTo('.touchpointsList');
        var newTouchpoint = $('.touchpointsList').find('li').last();
        var count = $('.touchpointsList li').size();
        //count++;
        console.log(count);
        //newTouchpoint.data("index-number", count);
        $(newTouchpoint).find('select').attr('name', 'touchpoint-' + count)
    });
    
    $('.new-group').on('click', '.remove', function(){
        $(this).parent().remove();
    });
    
    $('#viewing').change(function() {
        var url = $(this).val();
        if(url) {
            window.location = url;
        }
        return false;
    });

}); //end of document.ready

// Form Validation

function validateForm(){
	var fname = document.forms["newBooking"]["fname"];
	var lname = document.forms["newBooking"]["lname"];
	var date = document.forms["newBooking"]["date"];
	var time = document.forms["newBooking"]["time"];
	var stylist = document.forms["newBooking"]["stylist"];
	var mobile_num = document.forms["newBooking"]["mobile_num"];
	var email = document.forms["newBooking"]["email"];
	var cust_type = document.forms["newBooking"]["cust_type"];
	var message = document.forms["newBooking"]["message"];

	// Error variables
	var fname_error = "";
	var lname_error = "";
	var date_error = "";
	var time_error = "";
	var stylist_error = "";
	var mobile_num_error = "";
	var email_error = "";
	var email_valid_error = "";
	var cust_type_error = "";
	var message_error = "";
	var totalError = 0;

	if (fname.value == null || fname.value ==""){
		fname_error = "<li>Please enter your first name</li>";
		$(fname).addClass('error-input');
		totalError += 1;
	}
	$(fname).change(function(){
		if (fname.value == null || fname.value ==""){
				fname_error = "<li>Please enter your first name</li>";
				$(fname).addClass('error-input');
				totalError += 1;
		} else{
			$(fname).removeClass('error-input');
		}
	});
	if (lname.value == null || lname.value ==""){
		lname_error = "<li>Please enter your last name</li>";
		$(lname).addClass('error-input');
		totalError += 1;
	}
	$(lname).change(function(){
		if (lname.value == null || lname.value ==""){
				lname_error = "<li>Please enter your last name</li>";
				$(lname).addClass('error-input');
				totalError += 1;
		} else{
			$(lname).removeClass('error-input');
		}
	});
	if (date.value == null || date.value ==""){
		date_error = "<li>Please choose date</li>";
		$(date).addClass('error-input');
		totalError += 1;
	}
	$(date).change(function(){
		if (date.value == null || date.value ==""){
				date_error = "<li><li>Please choose date</li></li>";
				$(date).addClass('error-input');
				totalError += 1;
		} else{
			$(date).removeClass('error-input');
		}
	});
	if (time.value == null || time.value ==""){
		time_error = "<li>Please enter time</li>";
		$(time).addClass('error-input');
		totalError += 1;
	}
	$(time).change(function(){
		if (time.value == null || time.value ==""){
				time_error = "<li>Please enter time</li>";
				$(time).addClass('error-input');
				totalError += 1;
		} else{
			$(time).removeClass('error-input');
		}
	});
	if (stylist.value == null || stylist.value ==""){
		stylist_error = "<li>Please choose stylist</li>";
		$(stylist).addClass('error-input');
		totalError += 1;
	}
	$(stylist).change(function(){
		if (stylist.value == null || stylist.value ==""){
			stylist_error = "<li>Please choose stylist</li>";
			$(stylist).addClass('error-input');
			totalError += 1;
		} else{
			$(stylist).removeClass('error-input');
		}
	});
	if (mobile_num.value == null || mobile_num.value ==""){
		mobile_num_error = "<li>Please enter your mobile number</li>";
		$(mobile_num).addClass('error-input');
		totalError += 1;
	}
	$(mobile_num).change(function(){
		if (mobile_num.value == null || mobile_num.value ==""){
			mobile_num_error = "<li>Please enter your mobile number</li>";
			$(mobile_num).addClass('error-input');
			totalError += 1;
		} else{
			$(mobile_num).removeClass('error-input');
		}
	});

	var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
	if (email.value == null || email.value =="" || !email.value.match(mailformat)){
		email_error = "<li>Please check your email</li>";
		$(email).addClass('error-input');
		totalError += 1;
	}
	$(email).change(function(){
		if (email.value == null || email.value =="" || !email.value.match(mailformat)){
			email_error = "<li>Please check your email</li>";
			$(email).addClass('error-input');
			totalError += 1;
		} else{
			$(email).removeClass('error-input');
		}
	});

	
	if (cust_type.value == null || cust_type.value ==""){
		cust_type_error = "<li>Please enter type of customer</li>";
		$(cust_type).addClass('error-input');
		totalError += 1;
	}
	$(cust_type).change(function(){
		if (cust_type.value == null || cust_type.value ==""){
			cust_type_error = "<li>Please enter type of customer</li>";
			$(cust_type).addClass('error-input');
			totalError += 1;
		} else{
			$(cust_type).removeClass('error-input');
		}
	});
	if (message.value == null || message.value ==""){
		message_error = "<li>Please provide some information</li>";
		$(message).addClass('error-input');
		totalError += 1;
	}
	$(message).change(function(){
		if (message.value == null || message.value ==""){
			message_error = "<li>Please enter your message</li>";
			$(message).addClass('error-input');
			totalError += 1;
		} else{
			$(message).removeClass('error-input');
		}
	});

	var validation_report = document.getElementById('new-booking-validation');
	var error_heading = "<p><b>Please check following errors:</b></p>";
	validation_report.innerHTML = '';

	var success_message = "<p>Thank you for your booking <b>" + fname.value + "&nbsp;" + lname.value + "</b>. You will get email confirmation.</p>";
	if (totalError > 0){
		// alert(fname_error);
		$('.new-booking-validation').show();
		$('.new-booking-validation').addClass('error-input');
		$('.new-booking-validation').removeClass('form-succeed');
		$('html, body').animate({
			scrollTop: $('.new-booking-validation').offset().top - 20
		}, 1000);
		
		validation_report.innerHTML += error_heading + fname_error + lname_error + date_error + time_error + stylist_error + mobile_num_error + email_error + email_valid_error + cust_type_error + message_error;
		return false;
	}

		$('.new-booking-validation').show();
		$('html, body').animate({
			scrollTop: $('.new-booking-validation').offset().top - 20
		}, 1000);
		validation_report.innerHTML += success_message;
		$('.new-booking-validation').removeClass('error-input');
		$('.new-booking-validation').addClass('form-succeed');

		return false; //just for testing
		// return true;
}


function validateBooking(){
	var flname = document.forms["touchpoint-form"]["flname"];
	var email = document.forms["touchpoint-form"]["email"];
	var phone = document.forms["touchpoint-form"]["phone"];
	var style_date = document.forms["touchpoint-form"]["style_date"];
	var time = document.forms["touchpoint-form"]["time"];
	var shoot_date = document.forms["touchpoint-form"]["shoot_date"];
	var stylist = document.forms["touchpoint-form"]["stylist"];

	// Error variables
	var flname_error = "";
	var email_error = "";
	var phone_error = "";
	var style_date_error = "";
	var time_error = "";
	var shoot_date_error = "";
	var stylist_error = "";
	var totalError = 0;


	if (flname.value == null || flname.value ==""){
		flname_error = "<li>Please enter your name</li>";
		$(flname).addClass('error-input');
		totalError += 1;
	}
	$(flname).change(function(){
		if (flname.value == null || flname.value ==""){
				flname_error = "<li>Please enter your name</li>";
				$(flname).addClass('error-input');
				totalError += 1;
		} else{
			$(flname).removeClass('error-input');
		}
	});

	var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
	if (email.value == null || email.value =="" || !email.value.match(mailformat)){
		email_error = "<li>Please check your email</li>";
		$(email).addClass('error-input');
		totalError += 1;
	}
	$(email).change(function(){
		if (email.value == null || email.value =="" || !email.value.match(mailformat)){
			email_error = "<li>Please check your email</li>";
			$(email).addClass('error-input');
			totalError += 1;
		} else{
			$(email).removeClass('error-input');
		}
	});
	if (phone.value == null || phone.value ==""){
		phone_error = "<li>Please enter phone</li>";
		$(phone).addClass('error-input');
		totalError += 1;
	}
	$(phone).change(function(){
		if (phone.value == null || phone.value ==""){
			phone_error = "<li>Please enter phone</li>";
			$(phone).addClass('error-input');
			totalError += 1;
		} else{
			$(phone).removeClass('error-input');
		}
	});
	if (style_date.value == null || style_date.value ==""){
		style_date_error = "<li>Please choose style date</li>";
		$(style_date).addClass('error-input');
		totalError += 1;
	}
	$(style_date).change(function(){
		if (style_date.value == null || style_date.value ==""){
			style_date_error = "<li>Please choose style date</li>";
			$(style_date).addClass('error-input');
			totalError += 1;
		} else{
			$(style_date).removeClass('error-input');
		}
	});

	if (time.value == null || time.value ==""){
		time_error = "<li>Please enter time</li>";
		$(time).addClass('error-input');
		totalError += 1;
	}
	$(time).change(function(){
		if (time.value == null || time.value ==""){
			time_error = "<li>Please enter time</li>";
			$(time).addClass('error-input');
			totalError += 1;
		} else{
			$(time).removeClass('error-input');
		}
	});

	if (shoot_date.value == null || shoot_date.value ==""){
		shoot_date_error = "<li>Please choose shoot date</li>";
		$(shoot_date).addClass('error-input');
		totalError += 1;
	}
	$(shoot_date).change(function(){
		if (shoot_date.value == null || shoot_date.value ==""){
			shoot_date_error = "<li>Please choose shoot date</li>";
			$(shoot_date).addClass('error-input');
			totalError += 1;
		} else{
				$(shoot_date).removeClass('error-input');
			}
		});

	if (stylist.value == null || stylist.value ==""){
		stylist_error = "<li>Please enter stylist</li>";
		$(stylist).addClass('error-input');
		totalError += 1;
	}
	$(stylist).change(function(){
		if (stylist.value == null || stylist.value ==""){
			stylist_error = "<li>Please enter stylist</li>";
			$(stylist).addClass('error-input');
			totalError += 1;
		} else{
			$(stylist).removeClass('error-input');
		}
	});


	var touchpoint_validation_report = document.getElementById('touchpoint-validation');
	var error_heading = "<p><b>Please check following errors:</b></p>";
	touchpoint_validation_report.innerHTML = '';

	var success_message = "<p>Your booking has been edited successfully.</p>";
	if (totalError > 0){
		$('.touchpoint-validation').show();
		$('.touchpoint-validation').addClass('error-input');
		$('.touchpoint-validation').removeClass('form-succeed');
		$('html, body').animate({
			scrollTop: $('.touchpoint-validation').offset().top - 20
		}, 1000);
		
		touchpoint_validation_report.innerHTML += error_heading + flname_error + email_error + phone_error + style_date_error + time_error + shoot_date_error + stylist_error;
		return false;
	}

		$('.touchpoint-validation').show();
		$('html, body').animate({
			scrollTop: $('.touchpoint-validation').offset().top - 20
		}, 1000);
		touchpoint_validation_report.innerHTML += success_message;
		$('.touchpoint-validation').removeClass('error-input');
		$('.touchpoint-validation').addClass('form-succeed');

		return false; //just for testing
		// return true;
}
/*Custom multipage for gravity forms (only form id 21 & 11)*/
jQuery(function($){
	/*Script for form id 21*/
	/*Add proggress bar*/
	
	//var forms = $('form[id="gform_22"]')
	//forms.each(function(index){
		
		
			

	$('#gform_22').before('<div id="pb-container" class="pb-container"><svg viewBox="0 0 100 4" preserveAspectRatio="none" style="width:100%;height:100%;background:#d8d8d8;"><path d="M 0,2 L 100,2" stroke="#eee" stroke-width="1" fill-opacity="0"></path><path d="M 0,2 L 100,2" stroke="rgb(2,242,0)" stroke-width="4" fill-opacity="0" style="stroke-dasharray: 100, 100; stroke-dashoffset: 87.5; transition: all 0.5s cubic-bezier(0.4, 0, 1, 1);"></path></svg><div class="pb-text">12%</div></div>');
	
	/*Add next button*/
	$('#gform_22').after('<a class="pb-button-next1" id="pb-next1" page="2"><span>Next ></span></a>');
	/*Add back button*/
	$('#gform_22').after('<a class="pb-button-back1" id="pb-back1" page="0"><span>< Back</span></a>');
		
	//});
	/*Modify onepage form to multipage form*/
	var forms = $('form[id="gform_22"]')
	console.log("forms: " + forms.length);
	forms.each(function(index){
		
	$(this.querySelector("#gform_fields_22 li")).removeClass('col-fifth').addClass('pb-fields');

	$(this.querySelector("#gform_wrapper_22")).addClass('pb-wrapper');
	$(this.querySelector("#field_22_7")).css('display','none');
	$(this.querySelector("#field_22_4")).css('display','none');
	$(this.querySelector("#field_22_5")).css('display','none');
	$(this.querySelector("#field_22_8")).css('display','none');
	$(this.querySelector("#field_22_3")).css('display','none');
	$(this.querySelector("#field_22_6")).css('display','none');
	$(this.querySelector("#field_22_11")).css('display','none');
	$(this.querySelector("#gform_submit_button_21")).css('display','none');
	$(this.querySelector("#gform_wrapper_22 a.pb-button-back1")).css('display','none');//.attr('page','0');
	$(this.querySelector("#gform_wrapper_22 a.pb-button-next1"));//.attr('page','2');
	
	$(this.querySelector("#gform_fields_22 input")).each(function(){
		var $this = $(this);
		$this.on('input', function(){
			$this.removeClass('hasError');
			$("." + $this.attr('id') + "_error").remove();
		});
	});
	$(this.querySelector("#gform_fields_22 select")).each(function(){
		var $this = $(this);
		$this.on('change', function(){
			$this.removeClass('hasError');
			$("." + $this.attr('id') + "_error").remove();
		});
	});
	
	});
	/*Script for form id 11*/
	/*Add proggress bar*
	$("#gform_11").before('<div id="pb-container" class="pb-container"><svg viewBox="0 0 100 4" preserveAspectRatio="none" style="width:100%;height:100%;"><path d="M 0,2 L 100,2" stroke="#eee" stroke-width="1" fill-opacity="0"></path><path d="M 0,2 L 100,2" stroke="rgb(2,242,0)" stroke-width="4" fill-opacity="0" style="stroke-dasharray: 100, 100; stroke-dashoffset: 87.5; transition: all 0.5s cubic-bezier(0.4, 0, 1, 1);"></path></svg><div class="pb-text">12%</div></div>');
	
	/*Add next/back buttons*
	$("#gform_11").after('<a class="pb-button-next" id="pb-next"><span>Next ></span></a>');
	$("#gform_11").after('<a class="pb-button-back" id="pb-back"><span>< Back</span></a>');
	
	/*Modify onepage form to multipage form*
	$("#gform_fields_11 li").removeClass('col-fifth').addClass('pb-fields');
	$("#gform_wrapper_11").addClass('pb-wrapper');
	$("#field_11_7").css('display','none');
	$("#field_11_4").css('display','none');
	$("#field_11_5").css('display','none');
	$("#field_11_8").css('display','none');
	$("#field_11_3").css('display','none');
	$("#field_11_6").css('display','none');
	$("#field_11_11").css('display','none');
	$("#gform_submit_button_11").css('display','none');
	$("#gform_wrapper_11 a.pb-button-back").css('display','none').attr('page','0');
	$("#gform_wrapper_11 a.pb-button-next").attr('page','2');
	
	$("#gform_fields_11 input").each(function(){
		var $this = $(this);
		$this.on('input', function(){
			$this.removeClass('hasError');
			$("." + $this.attr('id') + "_error").remove();
		});
	});
	$("#gform_fields_11 select").each(function(){
		var $this = $(this);
		$this.on('change', function(){
			$this.removeClass('hasError');
			$("." + $this.attr('id') + "_error").remove();
		});
	});
	
	/*Universal methods for form id 21 & 11*/
	$("#pb-next1").on('click', function(){
		var formID2 = 22;
		switch($(this).attr('page')) { 
			case "2":
				if($("#input_" + formID2 + "_1").val() == "") {
					$("#input_" + formID2 + "_1").addClass('hasError');
					$(".input_" + formID2 + "_1_error").remove();
					$("#input_"+formID2+"_1").after('<span class="input_'+formID2+'_1_error">First Name is required!</span>');
				} else {
					$("#field_"+formID2+"_1").css('display','none');
					$("#field_"+formID2+"_7").css('display','block');
					$(".pb-button-back1").css('display','block').attr('page','1');
					$(".pb-button-next1").css('display','block').attr('page','3');
					$("#pb-container > svg > path:nth-of-type(2)").css('stroke-dashoffset','75');
					$("#pb-container > svg > path:nth-of-type(2)").css('stroke','rgb(2,222,0)');
					$(".pb-text").html('25%').css('left','70px');
				}
				break;
			case "3":
				if($("#input_"+formID2+"_7").val() == "") {
					$("#input_"+formID2+"_7").addClass('hasError');
					$(".input_"+formID2+"_7_error").remove();
					$("#input_"+formID2+"_7").after('<span class="input_'+formID+'_7_error">Last Name is required!</span>');
				} else {
					$("#field_"+formID2+"_7").css('display','none');
					$("#field_"+formID2+"_4").css('display','block');
					$(".pb-button-back1").css('display','block').attr('page','2');
					$(".pb-button-next1").css('display','block').attr('page','4');
					$("#pb-container > svg > path:nth-of-type(2)").css('stroke-dashoffset','62.5');
					$("#pb-container > svg > path:nth-of-type(2)").css('stroke','rgb(2,202,0)');
					$(".pb-text1").html('37%').css('left','92px');
				}
				break;
			case "4":
				var regexPhone = /^([0-9\-\(\)\s]+)$/;
				if($("#input_"+formID2+"_4").val() == "") {
					$("#input_"+formID2+"_4").addClass('hasError');
					$(".input_"+formID2+"_4_error").remove();
					$("#input_"+formID2+"_4").after('<span class="input_'+formID+'_4_error">Phone is required!</span>');
				} else {
					if(!regexPhone.test($("#input_"+formID2+"_4").val())) {
						$("#input_"+formID2+"_4").addClass('hasError');
						$(".input_"+formID2+"_4_error").remove();
						$("#input_"+formID2+"_4").after('<span class="input_'+formID+'_4_error">Please enter a valid phone number!</span>');
					} else {
						$("#field_"+formID2+"_4").css('display','none');
						$("#field_"+formID2+"_5").css('display','block');
						$(".pb-button-back1").css('display','block').attr('page','3');
						$(".pb-button-next1").css('display','block').attr('page','5');
						$("#pb-container > svg > path:nth-of-type(2)").css('stroke-dashoffset','50');
						$("#pb-container > svg > path:nth-of-type(2)").css('stroke','rgb(2,182,0)');
						$(".pb-text").html('50%').css('left','114px');
					}
				}
				break;
			case "5":
				var regexEmail = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
				if($("#input_"+formID2+"_5").val() == "") {
					$("#input_"+formID2+"_5").addClass('hasError');
					$(".input_"+formID2+"_5_error").remove();
					$("#input_"+formID2+"_5").after('<span class="input_'+formID2+'_5_error">Email is required!</span>');
				} else {
					if(!regexEmail.test($("#input_"+formID2+"_5").val())) {
						$("#input_"+formID2+"_5").addClass('hasError');
						$(".input_"+formID2+"_5_error").remove();
						$("#input_"+formID2+"_5").after('<span class="input_'+formID+'_5_error">Please enter a valid email address!</span>');
					} else {
						$("#field_"+formID2+"_5").css('display','none');
						$("#field_"+formID2+"_8").css('display','block');
						$(".pb-button-back1").css('display','block').attr('page','4');
						$(".pb-button-next1").css('display','block').attr('page','6');
						$("#pb-container > svg > path:nth-of-type(2)").css('stroke-dashoffset','37.5');
						$("#pb-container > svg > path:nth-of-type(2)").css('stroke','rgb(2,162,0)');
						$(".pb-text").html('62%').css('left','136px');
					}
				$(".pb-button-next1").trigger("click");
				}
				break;
			case "6":
				
				$("#field_"+formID2+"_8").css('display','none');
				$("#field_"+formID2+"_3").css('display','block');
				$(".pb-button-back1").css('display','block').attr('page','5');
				$(".pb-button-next1").css('display','block').attr('page','7');
				$("#pb-container > svg > path:nth-of-type(2)").css('stroke-dashoffset','25');
				$("#pb-container > svg > path:nth-of-type(2)").css('stroke','rgb(2,142,0)');
				$(".pb-text").html('75%').css('left','158px');
				
				break;
			case "7":
				if($("#input_"+formID2+"_3 :selected").val() == "Please choose") {
					$("#input_"+formID2+"_3").addClass('hasError');
					$(".input_"+formID2+"_3_error").remove();
					$("#input_"+formID2+"_3").after('<span class="input_'+formID2+'_3_error">Studio is required!</span>');
				} else {
					$("#field_"+formID2+"_3").css('display','none');
					$("#field_"+formID2+"_6").css('display','block');
					$(".pb-button-back1").css('display','block').attr('page','6');
					$(".pb-button-next1").css('display','block').attr('page','8');
					$("#pb-container > svg > path:nth-of-type(2)").css('stroke-dashoffset','12.5');
					$("#pb-container > svg > path:nth-of-type(2)").css('stroke','rgb(2,122,0)');
					$(".pb-text").html('87%').css('left','180px');
				}
				break;
			case "8":
				if($("#input_"+formID2+"_6 :selected").val() == "Please choose") {
					$("#input_"+formID2+"_6").addClass('hasError');
					$(".input_"+formID2+"_6_error").remove();
					$("#input_"+formID2+"_6").after('<span class="input_'+formID2+'_6_error">Type of Photo Shoot is required!</span>');
				} else {
					$("#field_"+formID2+"_6").css('display','none');
					$("#field_"+formID2+"_11").css('display','block');
					$("#gform_submit_button_"+formID2+"").css('display','block');
					$(".pb-button-back1").css('display','block').attr('page','7');
					$(".pb-button-next1").css('display','none');
					$(".pb-container > svg > path:nth-of-type(2)").css('stroke-dashoffset','0');
					$("#pb-container > svg > path:nth-of-type(2)").css('stroke','rgb(2,102,0)');
					$(".pb-text").html('100%').css('left','202px');
					$(".pb-button-back1").addClass('mTextareaBottom');
					$(".pb-wrapper .gform_footer input[type=submit]").addClass('mTextareaBottom');
				}
				break;
		}
	});
	$("#pb-back1").on('click', function(){
		var formID2 = 22;
		switch($(this).attr('page')) {
			case "1":
				$("#field_"+formID2+"_1").css('display','block');
				$("#field_"+formID2+"_7").css('display','none');
				$(".pb-button-back1").css('display','none');
				$(".pb-button-next1").css('display','block').attr('page','2');
				$("#pb-container > svg > path:nth-of-type(2)").css('stroke-dashoffset','87.5');
				$("#pb-container > svg > path:nth-of-type(2)").css('stroke','rgb(2,242,0)');
				$(".pb-text").html('12%').css('left','48px');
				break;
			case "2":
				$("#field_"+formID2+"_7").css('display','block');
				$("#field_"+formID2+"_4").css('display','none');
				$(".pb-button-back1").css('display','block').attr('page','1');
				$(".pb-button-next1").css('display','block').attr('page','3');
				$("#pb-container > svg > path:nth-of-type(2)").css('stroke-dashoffset','75');
				$("#pb-container > svg > path:nth-of-type(2)").css('stroke','rgb(2,222,0)');
				$(".pb-text").html('25%').css('left','70px');
				break;
			case "3":
				$("#field_"+formID2+"_4").css('display','block');
				$("#field_"+formID2+"_5").css('display','none');
				$(".pb-button-back1").css('display','block').attr('page','2');
				$(".pb-button-next1").css('display','block').attr('page','4');
				$("#pb-container > svg > path:nth-of-type(2)").css('stroke-dashoffset','62.5');
				$("#pb-container > svg > path:nth-of-type(2)").css('stroke','rgb(2,202,0)');
				$(".pb-text").html('37%').css('left','92px');
				break;
			case "4":
				$("#field_"+formID2+"_5").css('display','block');
				$("#field_"+formID2+"_8").css('display','none');
				$(".pb-button-back1").css('display','block').attr('page','3');
				$(".pb-button-next1").css('display','block').attr('page','5');
				$("#pb-container > svg > path:nth-of-type(2)").css('stroke-dashoffset','50');
				$("#pb-container > svg > path:nth-of-type(2)").css('stroke','rgb(2,182,0)');
				$(".pb-text").html('50%').css('left','114px');
				break;
			case "5":
				$("#field_"+formID2+"_8").css('display','block');
				$("#field_"+formID2+"_3").css('display','none');
				$(".pb-button-back1").css('display','block').attr('page','4');
				$(".pb-button-next1").css('display','block').attr('page','6');
				$("#pb-container > svg > path:nth-of-type(2)").css('stroke-dashoffset','37.5');
				$("#pb-container > svg > path:nth-of-type(2)").css('stroke','rgb(2,162,0)');
				$(".pb-text").html('62%').css('left','136px');
				break;
			case "6":
				$("#field_"+formID2+"_3").css('display','block');
				$("#field_"+formID2+"_6").css('display','none');
				$(".pb-button-back1").css('display','block').attr('page','5');
				$(".pb-button-next1").css('display','block').attr('page','7');
				$("#pb-container > svg > path:nth-of-type(2)").css('stroke-dashoffset','25');
				$("#pb-container > svg > path:nth-of-type(2)").css('stroke','rgb(2,142,0)');
				$(".pb-text").html('75%').css('left','158px');
				break;
			case "7":
				$("#field_"+formID2+"_6").css('display','block');
				$("#field_"+formID2+"_11").css('display','none');
				$("#gform_submit_button_"+formID+"").css('display','none');
				$(".pb-button-back1").css('display','block').attr('page','6');
				$(".pb-button-next1").css('display','block').attr('page','8');
				$("#pb-container > svg > path:nth-of-type(2)").css('stroke-dashoffset','12.5');
				$("#pb-container > svg > path:nth-of-type(2)").css('stroke','rgb(2,122,0)');
				$(".pb-text").html('87%').css('left','180px');
				$(".pb-button-back1").removeClass('mTextareaBottom');
				$(".pb-wrapper .gform_footer input[type=submit]").removeClass('mTextareaBottom');
				break;
		}
	});
});

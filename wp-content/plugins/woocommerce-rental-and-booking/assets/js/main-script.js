jQuery(document).ready(function($) {
	
	/**
	 * Configuratin weekend
	 *
	 * @since 2.0.0
	 * @return null
	 */	
	var offDays = new Array();  
	if(BOOKING_DATA.all_data.local_settings_data.rental_off_days != undefined){
		var offDaysLength = BOOKING_DATA.all_data.local_settings_data.rental_off_days.length;
		for(var i=0; i<offDaysLength; i++){
			offDays.push(parseInt(BOOKING_DATA.all_data.local_settings_data.rental_off_days[i]));	
		}	
	} 

	var domain = '';
		months = '';
		weekdays = '';

	if(BOOKING_DATA.localize_info.domain !== false && BOOKING_DATA.localize_info.months !== false && BOOKING_DATA.localize_info.weekdays !== false){
		domain   = BOOKING_DATA.localize_info.domain,
		months   = BOOKING_DATA.localize_info.months.split(','),
		weekdays = BOOKING_DATA.localize_info.weekdays.split(',');
	}

	//sjQuery.datetimepicker.setLocale(domain);
	$.datetimepicker.setLocale(domain);


	/**
	 * Configuratin of date picker for pickupdate
	 *
	 * @since 1.0.0
	 * @return null
	 */	
	$('#pickup-date').datetimepicker({
	  	timepicker:false,
	  	scrollMonth: false,
	  	format:BOOKING_DATA.all_data.choose_date_format,	  	
	  	minDate: 0,
	  	disabledDates: BOOKING_DATA.block_dates,
	  	formatDate: BOOKING_DATA.all_data.choose_date_format ,	  	
	  	onShow:function( ct ){
			this.setOptions({
		    	maxDate:jQuery('#dropoff-date').val()?jQuery('#dropoff-date').val():false,		    	
		   	})
		},	
		disabledWeekDays : offDays, 
		i18n:
		{
			domain:{
		   		months: months,
		   		dayOfWeek: weekdays
		  	}
		}, 
		scrollInput: false
	});


	/**
	 * Configuratin of time picker for pickuptime
	 *
	 * @since 1.0.0
	 * @return null
	 */	
	$('#pickup-time').datetimepicker({
	  	datepicker:false,
	  	format:'H:i',	  	 
	  	step:5,
	  	scrollInput: false
	 	// onGenerate:function(ct,$i){
		// 	$('.xdsoft_time_variant .xdsoft_time').each(function(index){		 	
		// 	 	var hour = $(this).data('hour'),
		// 	 		min  = $(this).data('minute');
		// 	 		if(parseInt(hour) === 15 && parseInt(min) === 45 ){
		// 	 			$(this).addClass('xdsoft_disabled');
		// 	 			$(this).prop('xdsoft_disabled',true);	
		// 	 		}
			 		
		// 	});
		// }
	});


	/**
	 * Configuratin of time picker for dropoffdate
	 *
	 * @since 1.0.0
	 * @return null
	 */	
	$('#dropoff-date').datetimepicker({
	  	timepicker:false,
	  	scrollMonth: false,
	  	format:BOOKING_DATA.all_data.choose_date_format,	  	
	  	minDate: 0,
	  	disabledDates: BOOKING_DATA.block_dates,
	  	formatDate: BOOKING_DATA.all_data.choose_date_format,
	  	formatTime : 'H:i',
	  	onShow:function( ct ){
			this.setOptions({
		    	minDate:jQuery('#pickup-date').val()?jQuery('#pickup-date').val():false,		    	
		   	})
		},	
		disabledWeekDays : offDays,  
		i18n:
		{
			domain:{
		   		months: months,
		   		dayOfWeek: weekdays
		  	}
		}, 
		scrollInput: false	 
	});


	/**
	 * Configuratin of time picker for dropofftime
	 *
	 * @since 1.0.0
	 * @return null
	 */	
	$('#dropoff-time').datetimepicker({
	  	datepicker:false,
	  	format:'H:i',
	  	onShow:function( ct ){
			this.setOptions({
		    	minTime:jQuery('#pickup-time').val()?jQuery('#pickup-time').val():false,		    	
		   	})
		},
	  	step:5,
	  	scrollInput: false
	});


	/**
	 * Configuratin others pluins
	 *
	 * @since 1.0.0
	 * @return null
	 */	
	$('.redq-select-boxes').chosen();
	$('.price-showing').flip();
	
  // $('.cart a.redq_request_for_a_quote').magnificPopup({
  //   type: 'ajax'
  // });
  // $('.cart button.redq_request_for_a_quote').on('click', function (event) {
  //   event.preventDefault();
    // $('#quote-content').show();
    // var porduct_id = $(this).data('id');
    // $('#quote-content .white-popup').html('Loading....');
    //   $.ajax({
    //       type: "POST",
    //       url: REDQ_RENTAL_API.ajax_url,
    //       data: {
    //           action: 'redq_get_quoute_data',
    //           product_id: porduct_id
    //       },
          
    //       success: function(html) {
              
    //           $('#quote-content .white-popup').html(html);
    //       }
    //   });

    //   $.magnificPopup.open({
    //       items: {
    //           src: '#quote-content',
    //           type: 'inline'
    //       }
    //   });
    
    // var rental_params={
    //       "action"  :   "redq_request_for_a_quote", 
    //       "form_data":  jQuery(".cart").serializeArray(), 
    //     };

    //     console.log(REDQ_RENTAL_API.ajax_url);
    //     jQuery.ajax({         
    //       url : REDQ_RENTAL_API.ajax_url,           
    //       dataType : "json",
    //       type : "POST",
    //       data : rental_params,
    //       success : function(response){
            
    //         console.log(response);
            
    //       }
    //     });
  // });

  
  // window.onload = function() {
  //   document.querySelector('#quote-content-confirm').addEventListener('click', sample1)
  // }

  // function sample1(e) {
  //   e.preventDefault();
  //   swal.withFormAsync({
  //   // swal.withForm({
  //       title: 'Request for a quote?',
  //       text: 'Any text that you consider useful for the form',
  //       confirmButtonColor: '#DD6B55',
  //       confirmButtonText: 'Get form data!',
  //       showCancelButton: true,
  //       closeOnConfirm: false,
  //       showLoaderOnConfirm: true,
  //       formFields: [{
  //         id: 'name',
  //         placeholder: 'Name',
  //         required: true
  //       }, {
  //         id: 'email',
  //         type: 'email',
  //         placeholder: 'Email',
  //         required: true
  //       }, {
  //         id: 'phone',
  //         placeholder: 'Phone',
  //       }, {
  //         id: 'message',
  //         placeholder: 'Message',
  //         type: 'textarea',
  //         required: true
  //       }]
  //   }).then(function (context) {
  //     var cartData = $(".cart").serializeArray();
  //     if (context._isConfirm) {
  //       cartData.push({ 'forms': context.swalForm});
        
  //       var rental_params={
  //         "action"  :   "redq_request_for_a_quote", 
  //         "form_data":  cartData, 
  //       };
  //       $.ajax({         
  //         url : REDQ_RENTAL_API.ajax_url,           
  //         dataType : "json",
  //         type : "POST",
  //         data : rental_params,
  //         success : function(response){
  //           swal("Congratulations!", "Your request has been placed.", "success");
  //           console.log(response);
            
  //         }
  //       });

  //     }
  //   })
  // }

  $('.quote-submit i').hide();
  // From an element with ID #popup
  $('#quote-content-confirm').magnificPopup({
    items: {
      src: '#quote-popup',
      type: 'inline',
    },
    preloader: false,
    focus: '#quote-username',

    // When elemened is focused, some mobile browsers in some cases zoom in
    // It looks not nice, so we disable it:
    callbacks: {
      beforeOpen: function() {
        if($(window).width() < 700) {
          this.st.focus = false;
        } else {
          this.st.focus = '#quote-username';
        }
      },
      open: function() {
        
      }
    }
  });

  $('.quote-submit').on('click', function(e) {
    e.preventDefault();
    $('.quote-submit i').show();
    var cartData = $('.cart').serializeArray();
    var modalForm = {
      'quote_username': $('#quote-username').val(),
      'quote_password': $('#quote-password').val(),
      'quote_first_name': $('#quote-first-name').val(),
      'quote_last_name': $('#quote-last-name').val(),
      'quote_email': $('#quote-email').val(),
      'quote_phone': $('#quote-phone').val(),
      'quote_message': $('#quote-message').val(),
    }

    var product_id = $('.product_id').val();


    var errorMsg = '';
    var proceed = true;
    $("#quote-popup input[required=true], #quote-popup textarea[required=true]").each(function(){
      
      if(!$.trim($(this).val())){ //if this field is empty 
        var atrName = $(this).attr('name');
      
        if( atrName == 'quote-first-name' ) {
          errorMsg += 'First name field required<br>';
        } else if ( atrName == 'quote-email' ) {
          errorMsg += 'Email field required<br>';
        } else if ( atrName == 'quote-message' ) {
          errorMsg += 'Message field required<br>';
        } else if ( atrName == 'quote-last-name' ) {
          errorMsg += 'Last name required<br>';
        } else if ( atrName == 'quote-phone' ) {
          errorMsg += 'Last name required<br>';
        } else if ( atrName == 'quote-username' ) {
          errorMsg += 'Last name required<br>';
        } else if ( atrName == 'quote-password' ) {
          errorMsg += 'Last name required<br>';
        }
        
        
        proceed = false; //set do not proceed flag
      }
      //check invalid email
      var email_reg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/; 
      if($(this).attr("type")=="email" && !email_reg.test($.trim($(this).val()))){
        $(this).parent().addClass('has-error');
        proceed = false; //set do not proceed flag
        errorMsg += 'Email Must be valid & required!<br>';
      }

      if( errorMsg !== undefined && errorMsg !== '' ) {
        $('.quote-modal-message').slideDown().html(errorMsg);
        $('.quote-submit i').hide();
      }
      
      
    });
    if(proceed) {
      
      cartData.push({ forms: modalForm});
      var quote_params={
        "action"  :   "redq_request_for_a_quote", 
        "form_data":  cartData,
        "product_id": product_id ,
      };
      
      $.ajax({         
        url : REDQ_RENTAL_API.ajax_url,
        dataType : "json",
        type : "POST",
        data : quote_params,
        success : function(response){
          
          console.log(response);
          $('.quote-modal-message').html(response.message);
          if( response.status_code === 200 ) {
            $('#quote-popup').magnificPopup('close');
            $('.quote-submit i').hide();
          }
        }
      });
    }
  });

});
		
var initialLoad = true;				
//var baby_count = 0;
//var markerBounds = new google.maps.LatLngBounds();
var geocoder = new google.maps.Geocoder();
var map;
var directionsDisplay;
var directionsService;
var googleWaypoints = 0;
var lang = document.documentElement.lang;
if (lang == "ar") {	lang = "en"; }
var sternOptions;
var autocomplete;
var drop_autocomplete;
//var geocoder;




jQuery(document).ready(function() {
	if(document.getElementById('source')!=null) {
		jQuery('.uitip').tooltip();
		
		var data = {
			'action': 'stern_options',
			'getOptions': true,	
		};
		
		jQuery.post(my_ajax_object.ajax_url, data,   function(response) {
			sternOptions = jQuery.parseJSON(response);
			console.log(sternOptions);

			initMap();
			initAutoComplete();
			

			if(initialLoad==true) {
				if(sternOptions.stern_taxi_fare_show_rules_in_dropdown_inputs=="true") {
					refreshDestinationWithRule();
				}				
				if(sternOptions.stern_taxi_fare_show_seat_input != "false") {
					if(sternOptions.stern_taxi_fare_seat_field_as_input != "true") {
					//	if(sternOptions.stern_taxi_fare_typeCar_calendar_as_input="true") {
							if(document.getElementById('cartypes') !=null){
								refreshSeats();
								console.log("refreshSeats");
							}
					//	}
					}
				}
			}	
			
			initialLoad = false;
		  

			jQuery('[data-toggle="tooltip"]').tooltip(); 
		 
			jQuery('#stern_taxi_fare_div')
				.bootstrapValidator({
					message: 'This value is not valid',
					feedbackIcons: {
						valid: 'glyphicon glyphicon-ok',
						invalid: 'glyphicon glyphicon-remove',
						validating: 'glyphicon glyphicon-refresh'
					},
					fields: {
						source: {
							validators: {
								notEmpty: {
									message: ' '
								}
							}
						},
						destination: {
							validators: {
								notEmpty: {
									message: ' '
								}
							}
						},
						dateTimePickUp: {
							validators: {
								notEmpty: {
									message: ' '
								}
							}
						},
						datePickUpSplit: {
							validators: {
								notEmpty: {
									message: ' '
								}
							}
						},
						timePickUpSplit: {
							validators: {
								notEmpty: {
									message: ' '
								}
							}
						},
					}
				});

				
				
			jQuery('#resetBtn').click(function() {
				softReset();
				document.getElementById('SpanCal1').className="glyphicon glyphicon-check";
				
				
				if(jQuery('#source').attr('type') == "text") {
					jQuery('#source').val("");
				}
				
				if(jQuery('#destination').attr('type') == "text") {
					jQuery('#destination').val("");
				}
				
			//	jQuery('#stern_taxi_fare_div').data('bootstrapValidator').resetForm(true);
				jQuery("#resultLeft").css("display","none");
				jQuery("#resultText").css("display","none");
				//document.getElementById('cal3').style.visibility = 'hidden';
				jQuery("#cal3").css("display","none");
				setNowDate();
			});	
			

		
			initDatesInput("");
			initDatesInput("RoundTrip");
			
			
			jQuery('#cal1').click(function() {
				jQuery('#stern_taxi_fare_div').bootstrapValidator('validate');
				document.getElementById('SpanCal3').className="glyphicon glyphicon-map-marker";
			});
			

			
			
			jQuery('#source').on('change', function(){
				if(sternOptions.stern_taxi_fare_show_rules_in_dropdown_inputs=="true") {
					refreshDestinationWithRule();
				}

			});
			
			jQuery('#destination').on('change', function(){
				if(sternOptions.stern_taxi_fare_show_rules_in_dropdown_inputs=="true") {
					refreshMap();
					console.log("refreshMap");
					softReset();					
				}

			});
			
			
			if(autocomplete != null) {
				autocomplete.addListener('place_changed', function() {
					if(jQuery('#destination').val() != "") {
						refreshMap();
						softReset();
					}
				});	
			}
			if(drop_autocomplete != null) {
				drop_autocomplete.addListener('place_changed', function() {
					if(jQuery('#source').val() != "") {
						refreshMap();
						softReset();
					}
				});
			}				
					
			jQuery('#baby_count').on('change', function(){
				softReset();			
			});
			
			jQuery('#BabySeat').on('change', function(){
				softReset();			
			});
						
			

			/*
			jQuery('#dateTimePickUp').on('change dp.change', function(){
				doCalculation();		
			});				
			jQuery('#dateTimePickUpRoundTrip').on('change dp.change', function(){
				doCalculation();		
			});				
			*/
			
			jQuery('#hourPickUpSplitRoundTrip').on('change', function(){
				doCalculation();		
			});		
			jQuery('#minPickUpSplitRoundTrip').on('change', function(){
				doCalculation();			
			});
			jQuery('#hourPickUpSplit').on('change', function(){
				doCalculation();			
			});		
			jQuery('#minPickUpSplit').on('change', function(){
				doCalculation();			
			});		
			jQuery('#datePickUpSplit').click(function(){
				doCalculation();
			});
			jQuery('#datePickUpSplitRoundTrip').click(function(){
				doCalculation();
			});		
			
			
			
			jQuery('#stern_taxi_fare_round_trip').on('change', function(){
			//	softReset();
			//	refreshPrice();
			//	console.log("refreshPrice");
				var Selectstern_taxi_fare_round_trip = document.getElementById('stern_taxi_fare_round_trip').value;
				if( Selectstern_taxi_fare_round_trip == "false") {
					jQuery("#divDateTimePickUpRoundTrip").css("display","none");
					if(document.getElementById('dateTimePickUpRoundTrip') !=null){
						document.getElementById("dateTimePickUpRoundTrip").value = "";
					}
				} else {
					jQuery("#divDateTimePickUpRoundTrip").css("display","");
				//	setNowDateRoundTrip();
				//	console.log("setNowDateRoundTrip");
				}	
				doCalculation();
			});
				
				
			jQuery('#cartypes').on('change', function(){
				if(sternOptions.stern_taxi_fare_typeCar_calendar_as_input=="true") {
					if(sternOptions.stern_taxi_fare_seat_field_as_input=="true") {
					//	refreshSuitcases();
					//	console.log("refreshSuitcases");
						refreshPrice();
						console.log("refreshPrice");
					} else {					
						refreshSeats();
						console.log("refreshSeats");					
					}
				} else {
					refreshSeats();
					console.log("refreshSeats");
					softReset();				
				}
				
				//laodfullCalendarDiv();
				refreshSuitcases();
				console.log("refreshSuitcases");

				refreshSuitcasesSmall();
				console.log("refreshSuitcasesSmall");				
				refreshSuitcasesSmall
				//laodfullCalendarDiv();
			});	

		});
	}	
});


function refreshDestinationWithRule() {
	var source = document.getElementById("source").value;	
	var data = {
		'action': 'my_ajax',
		'getDestinationListfromRules': true,		
		'source': source,
	};

	jQuery("#destination").empty();	
	jQuery("#destination").append("<option data-icon='glyphicon-user' > .. </option>");
	
	jQuery.post(my_ajax_object.ajax_url, data,   function(response) {
		
		
		var res = jQuery.parseJSON(response);	
		var dataHtml = "";					
		var i = 0;
		while (res[i]) {
			dataHtml += "<option data-icon='glyphicon-user' value='"+ res[i] +"'>  "+ res[i] +"</option>";
			i++;
		}
		//dataHtml += "</optgroup>";

		jQuery("#destination").empty();	
		jQuery("#destination").append(dataHtml);
		refreshMap();
		console.log("refreshMap");
		softReset();

		
	});	

}					
					
					
function parseArabic(str) {
	if (lang == "ar") {
		console.log("parseArabic");
		return Number( str.replace(/[٠١٢٣٤٥٦٧٨٩]/g, function(d) {
			return d.charCodeAt(0) - 1632;
		}).replace(/[۰۱۲۳۴۵۶۷۸۹]/g, function(d) {
			return d.charCodeAt(0) - 1776;
		}) );
	} else {
		return str;
	}
}

/*
function initialize() {
  var mapProp = {
    center:new google.maps.LatLng(51.508742,-0.120850),
    zoom:5,
    mapTypeId:google.maps.MapTypeId.ROADMAP
  };
  var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);
}
google.maps.event.addDomListener(window, 'load', initialize);

*/


function initDatesInput(RoundTrip) {
		
	startDate = getStartDateForDateTimepicker('#dateTimePickUp'+RoundTrip);		
	if(document.getElementById('datePickUpSplit'+RoundTrip) !=null){
		jQuery('#datePickUpSplit'+RoundTrip).datetimepicker({				
			format: sternOptions.stern_taxi_fare_formatDate,
			minDate: startDate,	
			locale: lang,				
		});			
	}		
	if(document.getElementById('hourPickUpSplit'+RoundTrip) !=null){
		document.getElementById("hourPickUpSplit"+RoundTrip).value = getHours(startDate);
	}
	if(document.getElementById('minPickUpSplit'+RoundTrip) !=null){
		document.getElementById("minPickUpSplit"+RoundTrip).value = getMinutes(startDate);
	}
	if(document.getElementById('ampmPickUpSplit'+RoundTrip) !=null){
		document.getElementById("ampmPickUpSplit"+RoundTrip).value = getAMPM(startDate);
	}
	
	if(document.getElementById('timePickUpSplit'+RoundTrip) !=null){
		jQuery('#timePickUpSplit'+RoundTrip).datetimepicker({				
			format: sternOptions.stern_taxi_fare_formatTime,			
			locale: lang,				
		});
		document.getElementById("timePickUpSplit"+RoundTrip).value = moment(startDate).format(sternOptions.stern_taxi_fare_formatTime);
	}
	


	
	if(sternOptions.stern_taxi_fare_calendar_sideBySide=="true") {
	
		jQuery('#dateTimePickUp'+RoundTrip).datetimepicker({
			showClose: true,
			format: sternOptions.stern_taxi_fare_formatDateTime,
			minDate: startDate,	
			locale: lang,
			sideBySide: true
		});		
	} else {				
		jQuery('#dateTimePickUp'+RoundTrip).datetimepicker({
			showClose: true,
			format: sternOptions.stern_taxi_fare_formatDateTime,				
			minDate: startDate,	
			locale: lang,				
		});
	}
		
	
}
function initMap() {
	if(document.getElementById('googleMap')!=null) {
		if(sternOptions.stern_taxi_fare_show_markers_in_map=="false") {
			directionsDisplay = new google.maps.DirectionsRenderer({
				suppressMarkers: true
			});
		} else {
			directionsDisplay = new google.maps.DirectionsRenderer;
		}
		directionsService = new google.maps.DirectionsService;
		map = new google.maps.Map(document.getElementById('googleMap'), {
		});
		directionsDisplay.setMap(map);
		if(sternOptions.stern_taxi_fare_map_style!="") {
			map.set('styles', 
				jQuery.parseJSON(sternOptions.getOptionMapStyle)
			);
		}

		
		
	}
}
function setAddressFromDropDown(typeAddress,address) {
	jQuery("#"+typeAddress).val(address);
	refreshMap();
	softReset(); 
}


function initAutoComplete() {
	var VarCountry = sternOptions.stern_taxi_fare_country;
	if(VarCountry!=""){

	
		var options = {		
			componentRestrictions: {country: VarCountry}
		};		  
	
	if(document.getElementById('source')!=null) {		
		if(sternOptions.stern_taxi_fare_show_rules_in_dropdown_inputs!="true") {
			if(sternOptions.stern_taxi_use_list_address_source!="true") {
				var input = document.getElementById('source');
				autocomplete = new google.maps.places.Autocomplete(input,options);			
			}
		}
	}
		
	
		if(document.getElementById('destination')!=null) {
			if(sternOptions.stern_taxi_fare_show_rules_in_dropdown_inputs!="true") {
				if(sternOptions.stern_taxi_use_list_address_destination!="true") {			
					var drop = document.getElementById('destination');
					drop_autocomplete = new google.maps.places.Autocomplete(drop,options);
				}
			}
		} 	
	}
}

function addAddressFunction() {
	googleWaypoints++;
	htmlContent = '<input id="extraAddress'+googleWaypoints+'" name="extraAddress'+googleWaypoints+'" type="text" class="form-control" placeholder="extraAddress">';
	
	
	jQuery("#divSource").append(htmlContent);
	var VarCountry = sternOptions.stern_taxi_fare_country;
	if(VarCountry!=""){		
		var options = {		
			componentRestrictions: {country: VarCountry}
		};
		var drop = document.getElementById('extraAddress'+googleWaypoints);
		drop_autocomplete = new google.maps.places.Autocomplete(drop,options);	
	}
				
}
		
		
		
function round5(x)
{
    return Math.ceil(x/5)*5;
}

function getHours(startDate){
//	console.log(startDate);
	
	time = moment(startDate).format(sternOptions.stern_taxi_fare_formatTime);
	hours = time.substring(0,2);
//	console.log(hours);	
	return hours;
}
function getMinutes(startDate) {
	
	time = moment(startDate).format(sternOptions.stern_taxi_fare_formatTime);
	min = time.substring(3,5);
	if(parseInt(min)>=55) {
		RoundMin = "55"
	} else {
		RoundMin = Math.ceil(min/5)*5;
	}
	
//	console.log(min);
//	console.log(RoundMin);	
	return twoDigits(RoundMin);	
}
function getAMPM(startDate){
	time = moment(startDate).format(sternOptions.stern_taxi_fare_formatTime);
	ampm = time.substring(6,8);
//	console.log(time);
//	console.log(ampm);
	return ampm;
}

function twoDigits(n) {
    return n > 9 ? "" + n: "0" + n;
}


function closeBox() {
	//document.getElementById('boxclose').style.visibility = 'hidden';
	setTimeout(function(){
		//document.getElementById('main2').style.visibility = 'hidden';
		jQuery("#main2").css("display","none");
		document.getElementById('SpanCal3').className="glyphicon glyphicon-map-marker";
	}, 0);	
}

function closeBoxCalendar() {
	document.getElementById('boxcloseCalendar').style.visibility = 'hidden';
	setTimeout(function(){
		document.getElementById('fullCalendarDivContainer').style.visibility = 'hidden';
	}, 0);	
}


function closeBoxSettingDemo() {
	document.getElementById('closeBoxSettingDemo').style.visibility = 'hidden';
	setTimeout(function(){
		document.getElementById('settingDemo').style.visibility = 'hidden';
		
	}, 0);
	
}

function setNowDate() {	
	if(document.getElementById("First_date_available_in_hours")!=null){
		var First_date_available_in_hours = document.getElementById("First_date_available_in_hours").value
		var startDate= new Date();
		startDate.setTime( startDate.getTime() + First_date_available_in_hours * (1000*60*60) );
		
		
		var options = {year: 'numeric', month: '2-digit', day: 'numeric' , hour: 'numeric', minute: 'numeric',  hour12: false };
		if(document.getElementById('dateTimePickUp') !=null){
			document.getElementById("dateTimePickUp").value = startDate.toLocaleString(document.documentElement.lang, options);
		}
	}
}

function setNowDateRoundTrip() {
	
	if(sternOptions.stern_taxi_fare_typeCar_calendar_as_input!="true") {
		var duration = document.getElementById("stern_taxi_fare_duration").value;
		refreshDates(duration,'#dateTimePickUpRoundTrip')
		console.log("refreshDates#dateTimePickUpRoundTrip");
	} else {
		if(document.getElementById('hourPickUpSplitRoundTrip') !=null){
			document.getElementById("hourPickUpSplitRoundTrip").value = getHours(startDateRoundTrip);
		}
		if(document.getElementById('minPickUpSplitRoundTrip') !=null){
			document.getElementById("minPickUpSplitRoundTrip").value = getMinutes(startDateRoundTrip);
		}
		if(document.getElementById('ampmPickUpSplitRoundTrip') !=null){
			document.getElementById("ampmPickUpSplitRoundTrip").value = getAMPM(startDateRoundTrip);
		}		
		
	}
	

}


function getStartDateForDateTimepicker(divId) {
	var divFirst_date_available_in_hours = "";
	if(divId=='#dateTimePickUp') {
		divFirst_date_available_in_hours = "First_date_available_in_hours";
	} else {
		divFirst_date_available_in_hours = "First_date_available_roundtrip_in_hours";
	}
	
	if(document.getElementById(divFirst_date_available_in_hours)!=null){
		var First_date_available_in_hours = document.getElementById(divFirst_date_available_in_hours).value
		var startDate= new Date();
		startDate.setTime( startDate.getTime() + First_date_available_in_hours * (1000*60*60) );
	//	console.log(startDate);
		return startDate;
		
	}
}


function refreshDates(duration,divId) {
	var selectedCarTypeId = document.getElementById('cartypes').value;
	
	var dataPicker = {
		'action': 'my_ajax_picker',
		'getCalendarsForDateTimePicker': true,
		'selectedCarTypeId': selectedCarTypeId,			
		'duration' : duration,
	};
//	console.log(dataPicker);
	jQuery.post(my_ajax_object_picker.ajax_url, dataPicker ,   function(DataResponse) {

		var res = jQuery.parseJSON(DataResponse);
		var stern_taxi_fare_Time_To_add_after_a_ride = document.getElementById('stern_taxi_fare_Time_To_add_after_a_ride').value;
		var disabledDatesTimeArray = []
		var arrayCalendarJS = res.arrayCalendar;
		console.log(arrayCalendarJS);
		if(arrayCalendarJS !='') {
			
			var arrayCalendarMoment = [];
			var arrayDisableDates = [];
			
			for(var key in arrayCalendarJS) {
				var val = arrayCalendarJS[key];

				dateTimeBegin = moment(val["dateTimeBegin"]);
				dateTimeEnd = moment(val["dateTimeEnd"]);
				
		//		console.log(dateTimeBegin);
		//		console.log(dateTimeEnd);
				
				arrayCalendarMoment.push([
					dateTimeBegin,
					dateTimeEnd,
				]);
				

				
				var nbDaysinPeriod = ((dateTimeBegin - dateTimeEnd)/(1000*60*60*24));
				dateParsing = new Date(val["dateTimeBegin"]);
	//			console.log(dateParsing);
				for( k=0 ; k < nbDaysinPeriod-1 ; k++) {
					
					dateParsing.setTime( dateParsing.getTime() + 1 * (24*60*60*1000) );
					arrayDisableDates.push(moment(dateParsing));
								
				}
					
			}

			startDate = getStartDateForDateTimepicker(divId);
	

			
			console.log(arrayDisableDates);
			console.log(arrayCalendarMoment);
			
			if(sternOptions.stern_taxi_fare_use_calendar=="true") {	

				if(jQuery(divId).data("DateTimePicker")!=null) {
					jQuery(divId).data("DateTimePicker").destroy();
				}

				if(sternOptions.stern_taxi_fare_calendar_sideBySide=="true") {
							
					jQuery(divId).datetimepicker({	
							showClose: true,
							locale: lang,
							format: sternOptions.stern_taxi_fare_formatDateTime,
							minDate: startDate,
							disabledDates:arrayDisableDates,
							sideBySide: true,
							disabledTimeIntervals:  arrayCalendarMoment 

					});	
			
				} else {					
					jQuery(divId).datetimepicker({	
							showClose: true,
							locale: lang,
							format: sternOptions.stern_taxi_fare_formatDateTime,
							minDate: startDate,
							disabledDates:arrayDisableDates,
							disabledTimeIntervals:  arrayCalendarMoment 

					});	
				}					
			}
		}
		if(document.getElementById('buttonDateTime')!=null) {
			document.getElementById('buttonDateTime').className="glyphicon glyphicon-time";
		}
	});
		
}






function softReset(){
	jQuery("#divAlert").css("display","none");
	jQuery("#divAlertError").css("display","none");
/*	jQuery("#calCheckout_url").css("display","none"); */
	document.getElementById("calCheckout_url").disabled = true;
	
	
/*
	jQuery("#resultText").css("display","none");	
	document.getElementById('cal3').style.visibility = 'hidden';
	document.getElementById('main2').style.visibility = 'hidden';

	
	jQuery("#resultLeft").css("display","none");
	if(document.getElementById('boxclose') !=null){
		document.getElementById('boxclose').style.visibility = 'hidden';
	}
	*/
}

function getLocation() {
	document.getElementById('getLocationSource').className="glyphicon glyphicon-refresh glyphicon-spin";
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(onGeoSuccess);
    }
	refreshMap();
	softReset();
}




function getLocationDestination() {
	
	var stern_taxi_fare_address_saved_point = document.getElementById("stern_taxi_fare_address_saved_point").value;
	var stern_taxi_fare_address_saved_point2 = document.getElementById("stern_taxi_fare_address_saved_point2").value;
	
	if(stern_taxi_fare_address_saved_point!='') {
		if(document.getElementById("destination").value != stern_taxi_fare_address_saved_point) {
			document.getElementById("destination").value = stern_taxi_fare_address_saved_point;
		} else if (stern_taxi_fare_address_saved_point2 != "") {
			document.getElementById("destination").value = stern_taxi_fare_address_saved_point2;
		}
			
		
	} else {
		document.getElementById('getLocationDestination').className="glyphicon glyphicon-refresh glyphicon-spin";
		if (navigator.geolocation) {
			navigator.geolocation.getCurrentPosition(onGeoSuccessDestination);
		}
	}
	refreshMap();
	softReset();  
}



 function onGeoSuccess(event)
 {
	geocoder = new google.maps.Geocoder();
	codeLatLng(event.coords.latitude,event.coords.longitude);
 }
 

 
 function codeLatLng(lat, lng) {
  var latlng = new google.maps.LatLng(lat, lng);
  geocoder.geocode({
    'latLng': latlng
  }, function (results, status) {
    if (status === google.maps.GeocoderStatus.OK) {
      if (results[0]) {
		document.getElementById("source").value = results[0].formatted_address;
      } else {
        alert('No results found');
      }
    } else {
      alert('Geocoder failed due to: ' + status);
    }
	document.getElementById('getLocationSource').className="glyphicon glyphicon-map-marker";
  });
}





 function onGeoSuccessDestination(event)
 {
	geocoder = new google.maps.Geocoder();
	codeLatLngDestination(event.coords.latitude,event.coords.longitude);
 }
 
 var geocoder;
 
 function codeLatLngDestination(lat, lng) {
  var latlng = new google.maps.LatLng(lat, lng);
  geocoder.geocode({
    'latLng': latlng
  }, function (results, status) {
    if (status === google.maps.GeocoderStatus.OK) {
      if (results[0]) {
		document.getElementById("destination").value = results[0].formatted_address;
      } else {
        alert('No results found');
      }
    } else {
      alert('Geocoder failed due to: ' + status);
    }
	document.getElementById('getLocationDestination').className="glyphicon glyphicon-map-marker";
  });
}

	
function encodeString(string) {	
	res = string.replace(" ", "+");
	res = encodeURIComponent(res);
	console.log(res);
	return res;
}


function refreshMap() {
	initMap();
		var source = document.getElementById("source").value;
		var destination = document.getElementById("destination").value;
		if(source=="") {
			return false;
		}
		if(destination=="") {
			return false;
		}
		var waypts = [];
		stringWaypoints="";
		for (i=1;i<=googleWaypoints;i++) {
			res = document.getElementById('extraAddress'+i).value;
			waypts.push({
				location: res,
				stopover: false
			});			
		}
	
		// https://developers.google.com/maps/documentation/javascript/examples/places-placeid-finder


			
	//	console.log(waypts);
		
		directionsService.route({
			origin: source,  
			destination: destination, 
			waypoints: waypts,
			travelMode: google.maps.TravelMode["DRIVING"]
		}, function(response, status) {
			if (status == google.maps.DirectionsStatus.OK) {
				console.log(response);
				directionsDisplay.setDirections(response);
				
			} else {
				//window.alert('Directions request failed due to ' + status);
				setDivAlert("divAlertError",sternOptions.textErrorMessage);
			}
		});
		google.maps.event.trigger(map, "resize");
		
		
		

		// https://developers.google.com/maps/documentation/javascript/examples/directions-simple
}
function showMap() {
	//if (document.getElementById('main2').style.visibility == 'hidden') {
	if(jQuery("#main2").css("display") =="none") {	
		document.getElementById('SpanCal3').className="glyphicon glyphicon-eye-close";
		
		//document.getElementById('main2').style.visibility = 'visible';
		jQuery("#main2").css("display","");
		refreshMap();
						
	} else {
	//	document.getElementById('main2').style.visibility = 'hidden';
		jQuery("#main2").css("display","none");
		document.getElementById('SpanCal3').className="glyphicon glyphicon-map-marker";
	}	
	
}




function setDivAlert(divAlert,textDiv) {
	document.getElementById(divAlert+"Text").innerHTML = textDiv;	
	//jQuery("#divAlertError").css("display","");	
	jQuery("#"+divAlert).fadeIn(1000);
	setTimeout(function(){
		jQuery("#"+divAlert).fadeOut(1000);
	}, 5000);
}

function doCalculation()
{
	
	//document.getElementById('cal3').style.visibility = 'hidden';
	jQuery("#cal3").css("display","none");
	var stern_taxi_fare_show_map = document.getElementById('stern_taxi_fare_show_map').value;
	softReset();
	destroyFullCalendar();
	
    var address = document.getElementById('source').value;
    var destination = document.getElementById('destination').value;
	
	if(document.getElementById('datePickUpSplit') !=null){
		var datePickUpSplit = document.getElementById('datePickUpSplit').value;
		if(datePickUpSplit.trim() == '') {
			
			return false;
		}
		startDate = moment(getStartDateForDateTimepicker('#dateTimePickUp')).format("MM/DD/YYYY HH:mm");
		//console.log((getDateTimePickup("")) +"- -"+ startDate);
		if(sternOptions.stern_taxi_fare_typeCar_calendar_as_input=="true") {
			if(sternOptions.stern_taxi_fare_seat_field_as_input=="true") {
				if(getDateTimePickup("") < startDate) {
					setDivAlert("divAlertError",document.getElementById('stern_taxi_fare_time_wrong').value + moment(startDate).format(sternOptions.stern_taxi_fare_formatDateTime))+"."; 
					return false;
				}
			}
		}
	}
	
	if(sternOptions.stern_taxi_fare_typeCar_calendar_as_input=="true") {
		if(sternOptions.stern_taxi_fare_seat_field_as_input=="true") {
			if(document.getElementById("dateTimePickUp")!= null) {
				if(document.getElementById("dateTimePickUp").value == "") {
					setDivAlert("divAlertError","date is null");
					return false;
				}
			}
		}
	}

	
	var is_round_trip = document.getElementById('stern_taxi_fare_round_trip').value;
	var dateTimePickUp=getDateTimePickup("");
	var dateTimePickUpRoundTrip=getDateTimePickup("RoundTrip");		
	if(is_round_trip =="true") {
		if(dateTimePickUp>dateTimePickUpRoundTrip) {
			setDivAlert("divAlertError",sternOptions.textErrorDateRoundTrip);
			return false;
		}		
		
	}

	if(document.getElementById('timePickUpSplit') !=null){
		var timePickUpSplit = document.getElementById('timePickUpSplit').value;
		if(timePickUpSplit.trim() == '') {
			
			return false;
		}		
	}	
	
	
	
	
	if(address.trim() == '') {
        source = '';
        return false;
    }
    else if(destination.trim() == '') {
        destination = '';
        return false;
    } else if (address == destination) {
		setDivAlert("divAlertError","Same address"); 
		return false;
	}


	
    else
    {
		document.getElementById('SpanCal1').className="glyphicon glyphicon-refresh glyphicon-spin";
		
		var source = document.getElementById("source").value;				
		var destination = document.getElementById("destination").value;	
		if (stern_taxi_fare_show_map != 'false') {
			//document.getElementById('cal3').style.visibility = 'visible';
			jQuery("#cal3").css("display","");
		}			
		if(sternOptions.stern_taxi_fare_typeCar_calendar_as_input=="true") {
			if(sternOptions.stern_taxi_fare_seat_field_as_input=="true") {
				getTripInfo(source,destination);
				console.log("getTripInfo");
			} else {
				getTripInfo(source,destination);
				console.log("getTripInfo");
			}
		} else {
			getTripInfo(source,destination);
			console.log("getTripInfo");			
			
		//	calc(source,destination);
		//	console.log("calc");			
		}
		if (sternOptions.stern_taxi_fare_auto_open_map == 'true'){
			//if (document.getElementById('main2').style.visibility == 'hidden') {
			if(	jQuery("#main2").css("display") =="none") {;
				showMap();
			}
		}		
    }

}

function getDateTimePickup(roundtrip) {
	
	if(document.getElementById("dateTimePickUp"+roundtrip)!=null) {
		//dateTimePickUpValue = document.getElementById("dateTimePickUp"+roundtrip).value;
		
		dateTimePickUpValue = parseArabic( document.getElementById("dateTimePickUp"+roundtrip).value );
		
	} else {
		if(document.getElementById("timePickUpSplit"+roundtrip)!=null) {
			dateTimePickUpValue = parseArabic(document.getElementById("datePickUpSplit"+roundtrip).value) + " " + parseArabic(document.getElementById("timePickUpSplit"+roundtrip).value);
		} else {
			dateTimePickUpValue = parseArabic(document.getElementById("datePickUpSplit"+roundtrip).value) + " " + parseArabic(document.getElementById("hourPickUpSplit"+roundtrip).value) + " " + parseArabic(document.getElementById("minPickUpSplit"+roundtrip).value) ;
			if(document.getElementById("ampmPickUpSplit"+roundtrip)!=null) {
				dateTimePickUpValue = parseArabic(document.getElementById("datePickUpSplit"+roundtrip).value) + " " + document.getElementById("hourPickUpSplit"+roundtrip).value + " " + document.getElementById("minPickUpSplit"+roundtrip).value + " " + document.getElementById("ampmPickUpSplit"+roundtrip).value ;
			}
		}
	}		
	
	dateTimePickUp = moment(dateTimePickUpValue,sternOptions.stern_taxi_fare_formatDateTime);
	console.log(dateTimePickUp);
	console.log(dateTimePickUp.format("MM/DD/YYYY HH:mm"));
	return dateTimePickUp.format("MM/DD/YYYY HH:mm");
}

function getTripInfo(source,destination) {
	
	console.log(source);
	console.log(destination);
	var source = document.getElementById("source").value;				
	var destination = document.getElementById("destination").value;
	var arrayWaypoints = [];
	for (i=1;i<=googleWaypoints;i++) {
		arrayWaypoints.push(document.getElementById('extraAddress'+i).value)
	}
	//console.log(arrayWaypoints);
	
	var data = {
		'action': 'my_ajax',
		'getTripInfo': true,		
		'source': source,		
		'destination': destination,	
		'arrayWaypoints': arrayWaypoints,
		'googleWaypoints': googleWaypoints,

	};					
	jQuery.post(my_ajax_object.ajax_url, data,   function(response) {
			jQuery("#resultLeft").css("display","");
			jQuery("#divCheckoutButton").css("display","");
			jQuery("#resultText").css("display","");
			document.getElementById('SpanCal1').className="glyphicon glyphicon-refresh";
			
			var res = jQuery.parseJSON(response);
			if(document.getElementById("distanceSpanValue")!=null) {
				document.getElementById("distanceSpanValue").innerHTML =  res.distanceHtml;
			}
			if(document.getElementById("tollSpanValue")!=null) {
				document.getElementById("tollSpanValue").innerHTML = res.nbToll ;
			}
			if(document.getElementById("durationSpanValue")!=null) {
				document.getElementById("durationSpanValue").innerHTML = res.durationHtml ;
			}
			if(document.getElementById("stern_taxi_fare_duration")!=null) {
				document.getElementById("stern_taxi_fare_duration").value =  res.duration ;
			}
			if(document.getElementById("stern_taxi_fare_distance")!=null) {
				document.getElementById("stern_taxi_fare_distance").value =  res.distance ;
			}

			
			/*
			if(sternOptions.stern_taxi_fare_seat_field_as_input=="true") {
				if (document.getElementById("baby_count")) {
					carSeat = parseFloat(document.getElementById("baby_count").value);
				}
							
				refreshCarTypeDropDown(dateTimePickUp, res.duration, carSeat);
				console.log("refreshCarTypeDropDown");
			} else {
				
				if(sternOptions.stern_taxi_fare_typeCar_calendar_as_input=="true") {
				
				} else {
					refreshPrice();
					console.log("refreshPrice");
				}					
			}
			*/
			if(sternOptions.stern_taxi_fare_typeCar_calendar_as_input=="true") {
				if(sternOptions.stern_taxi_fare_seat_field_as_input=="true") {
					dateTimePickUp=getDateTimePickup("");
				//	console.log(dateTimePickUp);					
					carSeat = parseFloat(document.getElementById("baby_count").value);
					refreshCarTypeDropDown(dateTimePickUp, res.duration, carSeat);
					console.log("refreshCarTypeDropDown");					
				} else {
					dateTimePickUp=getDateTimePickup("");
				//	console.log(dateTimePickUp);					
					carSeat = parseFloat(document.getElementById("baby_count").value);
					refreshCarTypeDropDown(dateTimePickUp, res.duration, carSeat);
					console.log("refreshCarTypeDropDown");					
				}
			} else {
				if(sternOptions.stern_taxi_fare_use_calendar=="true") {
					refreshDates(res.duration,'#dateTimePickUp');
					console.log("refreshDates#dateTimePickUp");
				}
			//	refreshSuitcases();
			//	console.log("refreshSuitcases");
				refreshPrice();
				console.log("refreshPrice");				
			}
			
			laodfullCalendarDiv(lang);
					
		
	});
	
}

function refreshCarTypeDropDown(dateTimePickUp, duration, carSeat) {
	
	jQuery("#cartypesOptGroup").empty();
	if(sternOptions.isBootstrapSelectEnabale=="true") {
		jQuery("#cartypesOptGroup").append("<option data-icon='glyphicon-refresh glyphicon-spin' value='' selected>  </option>");
		jQuery('.selectpicker').selectpicker('refresh'); 
	} else {
		jQuery("#cartypesOptGroup").append("<option value='' selected> ... </option>");
	}
	
	
	is_round_trip = document.getElementById('stern_taxi_fare_round_trip').value;
	dateTimePickUpRoundTrip=getDateTimePickup("RoundTrip");

	
	
		var data = {
			'action': 'my_ajax',
			'getTypeCarAvailable': true,		
			'dateTimePickUp': dateTimePickUp,
			'duration': duration,
			'carSeat': carSeat,
			'is_round_trip': is_round_trip,
			'dateTimePickUpRoundTrip': dateTimePickUpRoundTrip,
			
		};
		
		refreshCarTypeDropDownHtml(data);
		console.log("refreshCarTypeDropDownHtml");
		

		
		
}

function refreshCarTypeDropDownHtml(data) {	
//	console.log(data);
	jQuery.post(my_ajax_object.ajax_url, data,   function(DataResponse) {
		console.log(DataResponse);
		var dataHtml = "";
		var res = jQuery.parseJSON(DataResponse);
		for(var key in res) {
			var val = res[key];
			
			if(val[3]=="1") {
				if(dataHtml!=""){
					dataHtml += "</optgroup>";
				}
				dataHtml += "<optgroup id='cartypesOptGroup' label='"+ val[2] +"'>";
			}
			dataHtml += "<option data-icon='glyphicon-user' value='"+ val[0] +"'>  "+ val[1] +"</option>";			
		}
		dataHtml += "</optgroup>";
		
		jQuery("#cartypes").empty();	
		jQuery("#cartypes").append(dataHtml);
		jQuery('.selectpicker').selectpicker('refresh');
		
		if(sternOptions.stern_taxi_fare_typeCar_calendar_as_input=="true") {
			if(sternOptions.stern_taxi_fare_seat_field_as_input=="true") {
				if(res == "") {
					setDivAlert("divAlertError","No car available!");
				} else {
					refreshPrice();
					console.log("refreshPrice");
				}
			//	refreshSuitcases();
			//	console.log("refreshSuitcases");
			
			} else {
				refreshSeats();
				console.log("refreshSeats");				
			}
		}

 		/*
		refreshSuitcases();
		
		if(sternOptions.stern_taxi_fare_seat_field_as_input!="true") {
			refreshSeats();
			console.log("refreshSeats");
		} else {
			refreshPrice();
			console.log("refreshPrice");
		}
	
	
		
		if(sternOptions.stern_taxi_fare_typeCar_calendar_as_input=="true") {
		
		
		} else {
			var duration = document.getElementById("stern_taxi_fare_duration").value;
			refreshDates(duration,'#dateTimePickUp' );
			console.log("refreshDates#dateTimePickUp");
		}
			
		*/
	});	
}

function refreshSuitcases(suitcases) {	
	var selectedCarTypeId = document.getElementById('cartypes').value;
	document.getElementById("suitcasesSpanValue").innerHTML ="<span class='glyphicon glyphicon-refresh glyphicon-spin'>";
	if(suitcases==null) {
		var data = {
			'action': 'my_ajax',
			'getSuitcases': true,		
			'selectedCarTypeId': selectedCarTypeId,		
		};					
		jQuery.post(my_ajax_object.ajax_url, data,   function(DataResponse) {
			var res = jQuery.parseJSON(DataResponse);
			if(document.getElementById("suitcasesSpanValue")!=null) {
				document.getElementById("suitcasesSpanValue").innerHTML = res;
			}
		});
	} else {
		if(document.getElementById("suitcasesSpanValue")!=null) {
			document.getElementById("suitcasesSpanValue").innerHTML = suitcases;
		}		
	}	
}

function refreshSuitcasesSmall(suitcasesSmall) {	
	var selectedCarTypeId = document.getElementById('cartypes').value;
	document.getElementById("suitcasesSmallSpanValue").innerHTML ="<span class='glyphicon glyphicon-refresh glyphicon-spin'>";
	if(suitcasesSmall==null) {
		var data = {
			'action': 'my_ajax',
			'getSuitcasesSmall': true,		
			'selectedCarTypeId': selectedCarTypeId,		
		};					
		jQuery.post(my_ajax_object.ajax_url, data,   function(DataResponse) {
			var res = jQuery.parseJSON(DataResponse);
			if(document.getElementById("suitcasesSmallSpanValue")!=null) {
				document.getElementById("suitcasesSmallSpanValue").innerHTML = res;
			}
		});
	} else {
		if(document.getElementById("suitcasesSmallSpanValue")!=null) {
			document.getElementById("suitcasesSmallSpanValue").innerHTML = suitcasesSmall;
		}		
	}	
}


function refreshSeats() {
	
	var selectedCarTypeId = document.getElementById('cartypes').value;
	softReset();
	cleanDropDownBeforeAjaxLoad("#labelSeats");
	cleanDropDownBeforeAjaxLoad("#labelBabySeat");
	
	
	var dataPicker = {
		'action': 'my_ajax_picker',
		'selectedCarTypeId': selectedCarTypeId,
		'refreshSeats': 'refreshSeats'
	};	
	
	jQuery.post(my_ajax_object_picker.ajax_url, dataPicker,   function(DataResponse) {
		//console.log(DataResponse);
		var res = jQuery.parseJSON(DataResponse);		
		refreshDropDownNumberHtml("#labelSeats", 1, res.carseat);
		refreshDropDownNumberHtml("#labelBabySeat", 0, res.carSeatChild);
		
		
		if(sternOptions.stern_taxi_fare_typeCar_calendar_as_input=="true") {
			if(sternOptions.stern_taxi_fare_seat_field_as_input=="true") {
				//
			} else {			
				refreshPrice();
				console.log("refreshPrice");				
			}
		}
			

	});	
}

function cleanDropDownBeforeAjaxLoad(label) {
	jQuery(label).empty();	
	jQuery('.selectpicker').selectpicker('refresh'); 	
	if(sternOptions.isBootstrapSelectEnabale=="true") {
		jQuery(label).append("<option data-icon='glyphicon-refresh glyphicon-spin' value='' selected>  </option>");
		jQuery('.selectpicker').selectpicker('refresh'); 
	} else {
		jQuery(label).append("<option value='' selected> ... </option>");
	}		
}
function refreshDropDownNumberHtml(label, minNumber, maxNumber) {
	var cadena = '';
	var selected ='';
	
	for (i=minNumber ; i<= maxNumber ; i++) {
		if(i==minNumber) {
			selected='selected';
		} else {
			selected='';
		}
		cadena += "<option data-icon='glyphicon-user' value='"+ i +"' "+selected+">  "+ i +"</option>";
	}
	jQuery(label).empty();	
	jQuery(label).append(cadena);
	jQuery('.selectpicker').selectpicker('refresh'); 	
}
function refreshPrice(redirect) {
	
	document.getElementById("estimatedFareSpanValue").innerHTML ="<span class='glyphicon glyphicon-refresh glyphicon-spin'>";
	var selectedCarTypeId = document.getElementById('cartypes').value;
	var duration = document.getElementById("stern_taxi_fare_duration").value;
	var distance = document.getElementById("stern_taxi_fare_distance").value;
	var nbToll = document.getElementById("tollSpanValue").innerHTML;
	var is_round_trip = document.getElementById('stern_taxi_fare_round_trip').value;
	var source = document.getElementById("source").value;
	var destination = document.getElementById("destination").value;	
	var distanceHtml = document.getElementById("distanceSpanValue").innerHTML;
	var durationHtml = document.getElementById("durationSpanValue").innerHTML;
	var e=document.getElementById('cartypes');
	var cartypes = e.options[e.selectedIndex].text
	var dateTimePickUp=getDateTimePickup("");
	var dateTimePickUpRoundTrip=getDateTimePickup("RoundTrip");
	var babySeat = 0;
	
	if (document.getElementById("baby_count")) {
		car_seats = parseFloat(document.getElementById("baby_count").value);
	}
	if (document.getElementById("BabySeat")) {
		babySeat = parseFloat(document.getElementById("BabySeat").value);
	}	
	
	
	var data = {	
		'action': 					'my_ajax',
		'getPriceAjax' : 			true,
		'duration': 				duration,
		'distance': 				distance,
		'source': 					source,
		'destination': 				destination,
		'selectedCarTypeId': 		selectedCarTypeId,		
		'car_seats': 				car_seats,
		'is_round_trip': 			is_round_trip,
		'nbToll' : 					nbToll,
		'durationHtml': 			durationHtml,		
		'selectedCarTypeId': 		selectedCarTypeId,
		'cartypes': 				cartypes,
		'dateTimePickUp': 			dateTimePickUp,		
		'dateTimePickUpRoundTrip': 	dateTimePickUpRoundTrip,
		'distanceHtml': 			distanceHtml,
		'babySeat'	 :				babySeat,
				
	};	

	jQuery.post(my_ajax_object.ajax_url, data,   function(response) {
		var res = jQuery.parseJSON(response);
		console.log(res);
		
		document.getElementById("estimatedFareSpanValue").innerHTML = res.estimated_fare_HTML;
		document.getElementById("stern_taxi_fare_estimated_fare").value =  res.estimated_fare;

	
	//	showEstimatedFareHtml(res.estimated_fare);
		if(res.RuleApproved==true) {
			setDivAlert("divAlertSuccess",sternOptions.textSuccessFixedPrice);
		}
		
		document.getElementById("calCheckout_url").disabled = false;
		
		refreshSuitcases(res.suitcases);
		console.log("refreshSuitcases");

		refreshSuitcasesSmall(res.refreshSuitcasesSmall);
		console.log("refreshSuitcasesSmall");		
		
		if(res.estimated_fare==0) {
			
			softReset();
			setDivAlert("divAlertError","Price is null!");
		}
		
		
		
		if(redirect == true) {			
			var data = {	
				'action': 				'my_ajax',
				'addToCart' : 			true,					
			};

			jQuery.post(my_ajax_object.ajax_url, data,   function(response) {
				console.log(response);	
				window.location=sternOptions.checkout_url;	
			});
		}

		

		
	});		
}
	
function showEstimatedFareHtml(estimated_fare) {
	jQuery("#estimatedFareDivId").css("display","");
	var currency_symbol=sternOptions.currency_symbol;
	var currency_symbol_right;
	var currency_symbol_left;
	if(currency_symbol=='€') {
		currency_symbol_right = currency_symbol;
		currency_symbol_left = '';
	} else {
		currency_symbol_right = '';
		currency_symbol_left = currency_symbol;						
	}
	document.getElementById("estimatedFareSpanValue").innerHTML = currency_symbol_left + estimated_fare + currency_symbol_right;
	document.getElementById("stern_taxi_fare_estimated_fare").value =  estimated_fare;
	setSessionDataAjax();
	
}
	
function calc(source,destination) {

	
	jQuery("#estimatedFareDivId").css("display","");
	//jQuery("#suicasesDivId").css("display","");
	
	var e=document.getElementById('cartypes');
	var cartypes = e.options[e.selectedIndex].text

	
	var dateTimePickUp=getDateTimePickup("");
	var dateTimePickUpRoundTrip=getDateTimePickup("RoundTrip");
	
	var selectedCarTypeId = document.getElementById('cartypes').value;
	var stern_taxi_fare_round_trip = document.getElementById('stern_taxi_fare_round_trip').value;
	


	

	if (document.getElementById("baby_count")) {
		baby_count = parseFloat(document.getElementById("baby_count").value);
	}					
	//var getShow_use_img_gif_loader = document.getElementById("getShow_use_img_gif_loader").value;
//	var getKmOrMiles = document.getElementById("getKmOrMiles").value;



		
	var data = {
		'action': 'my_ajax',
		'getTripInfoGlobal' : true,
		'cartypes': cartypes,
		'source': source,
		'selectedCarTypeId': selectedCarTypeId,				
		'destination': destination,
		'car_seats': baby_count,
		'stern_taxi_fare_round_trip': stern_taxi_fare_round_trip,
		'dateTimePickUpRoundTrip': dateTimePickUpRoundTrip,
		'dateTimePickUp': dateTimePickUp
	};					
	jQuery.post(my_ajax_object.ajax_url, data,   function(response) {
		
		jQuery("#resultLeft").css("display","none");
		
		var stern_taxi_fare_show_map = document.getElementById('stern_taxi_fare_show_map').value;

		document.getElementById('SpanCal1').className="glyphicon glyphicon-refresh";
		
				
	//	console.log(response);
							
		var res = jQuery.parseJSON(response);
		console.log(res);
		if(res.statusGoogleGlobal == "errorGoogleEmpty") {
			jQuery("#divAlertError").css("display","");
			
			
		} else {
			if(res.RuleApproved==true) {
				jQuery("#divAlert").css("display","");
				var stern_taxi_fare_great_text = document.getElementById("stern_taxi_fare_great_text").value;
				var stern_taxi_fare_fixed_price_text = document.getElementById("stern_taxi_fare_fixed_price_text").value;
				document.getElementById("divAlertText").innerHTML = "<strong>" + stern_taxi_fare_great_text +" </strong>"+ stern_taxi_fare_fixed_price_text + " "+ res.nameRule;
			}

			jQuery("#resultLeft").css("display","");
			jQuery("#divCheckoutButton").css("display","");
			jQuery("#resultText").css("display","");
			var stern_taxi_fare_Time_To_add_after_a_ride = document.getElementById('stern_taxi_fare_Time_To_add_after_a_ride').value;
			var fullDuration = (res.duration*1) + (stern_taxi_fare_Time_To_add_after_a_ride*1)
			

				
		
			if(sternOptions.stern_taxi_fare_drag_event_FullCalendar=="true") {
				setDraggableSection(fullDuration);
			} 
		
			

			getTripInfo(source,destination);

//			refreshSuitcases();
//			console.log("refreshSuitcases");
			refreshDates(res.duration,'#dateTimePickUp' );
			console.log("refreshDates#dateTimePickUp");
			laodfullCalendarDiv();
			

		
		}
			
	});


}




function setSessionDataAjax(callback) {
	
	var selectedCarTypeId = document.getElementById('cartypes').value;
	var duration = document.getElementById("stern_taxi_fare_duration").value;
	var estimated_fare = document.getElementById("stern_taxi_fare_estimated_fare").value;	
	var is_round_trip = document.getElementById('stern_taxi_fare_round_trip').value;
	var durationHtml = document.getElementById("durationSpanValue").innerHTML;
	var e=document.getElementById('cartypes');
	var cartypes = e.options[e.selectedIndex].text
	var source = document.getElementById("source").value;
	var destination = document.getElementById("destination").value;	
	var car_seats = parseFloat(document.getElementById("baby_count").value);
	var dateTimePickUp=getDateTimePickup("");
	var dateTimePickUpRoundTrip=getDateTimePickup("RoundTrip");
	var nbToll=document.getElementById('tollSpanValue').innerHTML;
	var distanceHtml = document.getElementById("distanceSpanValue").innerHTML;
	var distance = document.getElementById("stern_taxi_fare_distance").value;
		
	var data = {
		'action': 'my_ajax',
		'setSessionDataAjax' : true,
		'duration': 				duration,
		'durationHtml': 			durationHtml,
		'estimated_fare': 			estimated_fare,
		'selectedCarTypeId': 		selectedCarTypeId,
		'cartypes': 				cartypes,
		'source':					source,
		'destination': 				destination,
		'car_seats': 				car_seats,
		'dateTimePickUp': 			dateTimePickUp,
		'nbToll': 					nbToll,
		'is_round_trip': 			is_round_trip,
		'dateTimePickUpRoundTrip': 	dateTimePickUpRoundTrip,
		'distanceHtml': 			distanceHtml,
		'distance': 				distance,
	};	

	jQuery.post(my_ajax_object.ajax_url, data,   function(response) {
		document.getElementById("calCheckout_url").disabled = false;
		if (callback && typeof(callback) === "function") {
			callback();
		}
	});	
}


function checkout_url_function() {
	/*
	document.getElementById('SpanBookButton').className="glyphicon glyphicon-refresh glyphicon-spin";
	setSessionDataAjax(function() { 
		window.location=sternOptions.checkout_url;	
	});
	*/
	//if(sternOptions.stern_taxi_fare_typeCar_calendar_as_input=="true") {
		//
	//} else {
		refreshPrice(true);
		console.log("refreshPrice");
//	}
	
		
	
}


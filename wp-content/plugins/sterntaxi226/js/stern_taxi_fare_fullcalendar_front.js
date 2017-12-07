function laodfullCalendarDiv(lang) {
	destroyFullCalendar();	

	if(document.getElementById("stern_taxi_fare_use_FullCalendar").value=='true') {
		jQuery("#fullCalendarDivContainer").css("display","");
		
	}
	
	if(document.getElementById('cartypes') !=null){
		//var selectedCarTypeId = jQuery(this).find("option:selected").val();
		var selectedCarTypeId = document.getElementById('cartypes').value;
		//var selectedCarTypeId = 404;
		var dataAjax = {
			'action': 'ajax_calendar',
			'getAllCalendars': 'getAllCalendars',
			'selectedCarTypeId': selectedCarTypeId
		};

		jQuery.post(ajax_obj_calendar.ajax_url, dataAjax,   function(DataResponse) {
			
			
			if( typeof getArrayCalendarFront(DataResponse) === "undefined") {
				var arrayCalendar = [];			
			} else {
				var arrayCalendar = getArrayCalendarFront(DataResponse);			
			}
			
			
			
			
			arraytemp = {			
				start: moment([1970]),
				end: moment(),			
				overlap: false,
				rendering: 'background',
				color: '#ff9f89',			
			};

			arrayCalendar.push(
				arraytemp
			)
			
			var minDate = moment();
			jQuery('#fullCalendarDiv').fullCalendar({
				lang: lang,
				header: {
					left: 'prev,next today',					
					right: '',
					
				},
				minDate : minDate,
				
				slotDuration: {  hours:0, minutes:60 },
				ignoreTimezone: true,
				allDaySlot: false,
				eventDurationEditable: false,
				defaultView: 'agendaWeek',
				//selectable: true,
				//selectHelper: true,
				droppable: true,
				drop: function(date, jsEvent, ui) {	
					
					jQuery(this).remove();
					var customDate= new Date(date.format());
					customDate= new Date(customDate.valueOf() + customDate.getTimezoneOffset() * 60000);
					var options = {year: 'numeric', month: '2-digit', day: 'numeric' , hour: 'numeric', minute: 'numeric',  hour12: false };					
					document.getElementById("dateTimePickUp").value = customDate.toLocaleString(document.documentElement.lang, options);
					console.log(jsEvent);
										
				},

				eventRender: function(event, element) {					
					element.append(event.description  );	
				},
			
				eventDrop : function(event, delta, revertFunc) {

					var customDate= new Date(event.start.format());
					customDate= new Date(customDate.valueOf() + customDate.getTimezoneOffset() * 60000);
					
					
					console.log(event.start.format());
					console.log(customDate);
					var options = {year: 'numeric', month: '2-digit', day: 'numeric' , hour: 'numeric', minute: 'numeric',  hour12: false };					
					document.getElementById("dateTimePickUp").value = customDate.toLocaleString(document.documentElement.lang, options);;
				},


				eventLimit: true, 
				events: arrayCalendar,
				height: 400,
				
				
			});
		});

	}
}

function destroyFullCalendar() {
	jQuery('#fullCalendarDiv').fullCalendar( 'destroy' );
}

function setDraggableSection(duration) {
	jQuery("#external-events").show();
	jQuery('#external-events').html("<div class='fc-event'>Dragging Booking</div>");
	jQuery('#external-events .fc-event').each(function() {

		// store data so the calendar knows to render an event upon drop
		jQuery(this).data('event', {
			title: jQuery.trim(jQuery(this).text()), // use the element's text as the event title
			stick: true, // maintain when user navigates (see docs on the renderEvent method)
			editable: true,
		});
		jQuery(this).data('duration', { days:0, hours:0, minutes:duration });		

		// make the event draggable using jQuery UI
		jQuery(this).draggable({
			zIndex: 999,
			revert: true,      // will cause the event to go back to its
			revertDuration: 0  //  original position after the drag
		});

	});
}




function getArrayCalendarFront(DataResponse){
	var res = jQuery.parseJSON(DataResponse);
//	console.log(res);
	
	var disabledDatesTimeArray = []
	var arrayCalendarJS = res;
	if(arrayCalendarJS !='') {
		
		var arrayCalendar = [];

		
		for(var key in arrayCalendarJS) {
			var val = arrayCalendarJS[key];
			
			var arraytemp;
			if( moment(val["dateTimeEnd"]) > moment()) {
				if(val["isRepeat"]=="true") {
					arraytemp = {
						//title: val["carType"],
						start: moment(val["dateTimeBegin"]),
						end: moment(val["dateTimeEnd"]),
						id: val["id"],
						overlap: false,
					//	rendering: 'background',
						color: '#ff9f89',
					//	description: 'Repeat',
						dow: [ moment(val["dateTimeBegin"]).day() ],							
					};
				} else {
					arraytemp = {
						//title: val["carType"],
						start: moment(val["dateTimeBegin"]),
						end: moment(val["dateTimeEnd"]),
						id: val["id"],
						overlap: false,
					//	rendering: 'background',
						color: '#ff9f89',
					//	description: 'Not repeat',
					};
				}

					
				arrayCalendar.push(
					arraytemp
				)
			}

				
		}
	}
	return arrayCalendar;
}

	
	
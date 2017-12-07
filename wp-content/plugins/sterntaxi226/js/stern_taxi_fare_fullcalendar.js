jQuery(document).ready(function() {
	
	
	if(document.getElementById('typeIdCar') !=null){
		//var selectedCarTypeId = jQuery(this).find("option:selected").val();
		var selectedCarTypeId = document.getElementById('typeIdCar').value;
		//var selectedCarTypeId = 404;
		var dataAjax = {
			'action': 'ajax_calendar',
			'getAllCalendars': 'getAllCalendars',
			'selectedCarTypeId': selectedCarTypeId
		};

		jQuery.post(ajax_obj_calendar.ajax_url, dataAjax,   function(DataResponse) {
			
		
			
		var slotDuration_min = document.getElementById('stern_taxi_fare_slotDuration_min').value;
		
			jQuery('#calendar').fullCalendar({
				header: {
					left: 'prev,next today',
					center: 'title',
					right: 'month,agendaWeek,agendaDay',
					
				},
				slotDuration: {  hours:0, minutes:slotDuration_min },
				defaultView: 'agendaWeek',
				selectable: true,
				selectHelper: true,
				allDaySlot: false,
				select: function(start, end,ressource) {
					console.log(start);
					var selectedCarTypeId = document.getElementById('typeIdCar').value;
					
					
					var dataAjax = {
						'action': 'ajax_calendar',
						'newCalendar': 'newCalendar',
						'typeCalendar': 'disabledTimeIntervals',
						'typeIdCar': selectedCarTypeId,
						'start': start.format(), 
						'end': end.format()						
					};
					
					jQuery.post(ajax_obj_calendar.ajax_url, dataAjax,   function(DataResponse) {
						var arrayCalendar = getArrayCalendar(DataResponse);
						console.log(arrayCalendar[0]);
			
						jQuery('#calendar').fullCalendar('renderEvent', arrayCalendar[0], true); // stick? = true					
						jQuery('#calendar').fullCalendar('unselect');								
						notificationSaved();
					});

		

				},
				eventClick: function(event, jsEvent, view) {

						
					var dataAjax = {
						'action': 'ajax_calendar',
						'getCalendar': 'getCalendar',
						'id': event.id,
					};
					
					jQuery.post(ajax_obj_calendar.ajax_url, dataAjax,   function(DataResponse) {
						var res = jQuery.parseJSON(DataResponse);
						var object = res[event.id];
						
						
							document.getElementById("detailsEvents").innerHTML = "";
							jQuery("#detailsEvents").append("<span class='closeon'>"+event.title+" ("+event.id + ")"); 
							jQuery("#detailsEvents").append("<br>");
							
							
							
								jQuery("#detailsEvents").append("WooCommerceId: ");	
								if(object.wooCommerceOrderId != null) {								
									jQuery("#detailsEvents").append("<a href ='"+ object.wooCommerceURLEdit  +"'>"+object.wooCommerceOrderId + "</a>" );
								} else {
									jQuery("#detailsEvents").append(".." );
								}
								jQuery("#detailsEvents").append("<br>");
							

							jQuery("#detailsEvents").append("Customer: ");
							jQuery("#detailsEvents").append("<a href ='"+ object.userNameURL  +"'>"+object.userName + "</a>" );
							jQuery("#detailsEvents").append("<br>");
							
							jQuery("#detailsEvents").append(moment(event.start).format('MMMM Do YYYY, h:mm:ss a')  + " - " + moment(event.end).format('MMMM Do YYYY, h:mm:ss a') + "</span>");							
							jQuery("#detailsEvents").append("<br>");
							
							jQuery("#detailsEvents").append("<button class='fc-state-default' type='button' onclick='removeEvent("+event.id+")'>Delete</button>");
							jQuery("#detailsEvents").append("<button class='fc-state-default' type='button' onclick='changeRepeat("+event.id+")'>Change Repeat</button>");
							
												
						
						
					});					
					
					
			
				},
				eventRender: function(event, element) {					
					element.append(event.description  );	
				},				
				eventResize: function(event, delta, revertFunc) {
					var dataAjax = {
						'action': 'ajax_calendar',
						'changeCalendar': 'changeCalendar',
						'id': event.id,
						'start': event.start.format(),
						'end': event.end.format(),
					};
			
					jQuery.post(ajax_obj_calendar.ajax_url, dataAjax,   function(DataResponse) {
						notificationSaved();
					});
				},				
				eventDrop : function(event, delta, revertFunc) {
					var dataAjax = {
						'action': 'ajax_calendar',
						'changeCalendar': 'changeCalendar',
						'id': event.id,
						'start': event.start.format(),
						'end': event.end.format(),
					};
					
					jQuery.post(ajax_obj_calendar.ajax_url, dataAjax,   function(DataResponse) {
						notificationSaved();
					});
				},
				editable: true,
				eventLimit: true, // allow "more" link when too many events
				events: getArrayCalendar(DataResponse),
				height: 550,
				
				
			});
		});

	}
	
	

	
});

function notificationSaved() {
	document.getElementById("notificationCalendar").innerHTML = "<strong>Saved!</strong>";
	setTimeout(function(){
		document.getElementById("notificationCalendar").innerHTML = "";
		}, 1000);		
}

function removeEvent(id) {
	var dataAjax = {
		'action': 'ajax_calendar',
		'deleteCalendar': 'deleteCalendar',
		'id': id,
	};
	jQuery.post(ajax_obj_calendar.ajax_url, dataAjax,   function(DataResponse) {
		jQuery('#calendar').fullCalendar('removeEvents',id);
		notificationSaved();
	});
}
function changeRepeat(id) {
	var dataAjax = {
		'action': 'ajax_calendar',
		'repeatCalendar': 'repeatCalendar',
		'id': id,
	};
	jQuery.post(ajax_obj_calendar.ajax_url, dataAjax,   function(DataResponse) {
			var res = jQuery.parseJSON(DataResponse);
			
					var dataAjax = {
						'action': 'ajax_calendar',
						'getCalendar': 'getCalendar',
						'id': id
					};
					console.log(dataAjax);
					jQuery.post(ajax_obj_calendar.ajax_url, dataAjax,   function(DataResponse) {
						var arrayCalendar = getArrayCalendar(DataResponse);
						console.log(arrayCalendar[0]);
						jQuery('#calendar').fullCalendar('removeEvents',id);								
						jQuery('#calendar').fullCalendar('renderEvent', arrayCalendar[0], true); // stick? = true					
						jQuery('#calendar').fullCalendar('unselect');
						notificationSaved();
						
					});
					
	});
}

function getArrayCalendar(DataResponse){
	var res = jQuery.parseJSON(DataResponse);
	console.log(res);
	
	var disabledDatesTimeArray = []
	var arrayCalendarJS = res;
	if(arrayCalendarJS !='') {
		
		var arrayCalendar = [];

		
		for(var key in arrayCalendarJS) {
			var val = arrayCalendarJS[key];
			
			var arraytemp;
			if(val["isRepeat"]=="true") {
				arraytemp = {
					title: val["carType"],
					start: moment(val["dateTimeBegin"]),
					end: moment(val["dateTimeEnd"]),
					id: val["id"],
					overlap: false,
					//rendering: 'background',
					color: '#ff9f89',
					description: 'Repeat',
					dow: [ moment(val["dateTimeBegin"]).day() ],							
				};
			} else {
				arraytemp = {
					title: val["carType"],
					start: moment(val["dateTimeBegin"]),
					end: moment(val["dateTimeEnd"]),
					id: val["id"],
					overlap: false,
					//rendering: 'background',
					color: '#ff9f89',
					description: 'Not repeat',
				};
			}
	
			
				
			arrayCalendar.push(
				arraytemp
			)

				
		}
	}
	return arrayCalendar;
}

	
	
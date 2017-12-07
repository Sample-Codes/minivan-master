jQuery(document).ready(function() {
	jQuery('.uitip').tooltip();
	
	
	if(document.getElementById('countryHidden') !=null){
	
		var VarCountry = document.getElementById('countryHidden').value;
		var options = {		
			componentRestrictions: {country: VarCountry}
		};
	  

		var drop = document.getElementById('typeSourceValue');
		var drop_autocomplete = new google.maps.places.Autocomplete(drop,options);
		
		var drop = document.getElementById('typeDestinationValue');
		var drop_autocomplete = new google.maps.places.Autocomplete(drop,options);		
	
		
	}
	if(document.getElementById('countryHiddenListAddress') !=null){	
		var VarCountry = document.getElementById('countryHiddenListAddress').value;
		var options = {		
			componentRestrictions: {country: VarCountry}
		};	  

		var drop = document.getElementById('address');
		var drop_autocomplete = new google.maps.places.Autocomplete(drop,options);
	}		
	
	
	
	jQuery('#typeIdCar').on('change', function(){
		//var selectedCarTypeId = jQuery(this).find("option:selected").val();
		jQuery('#selecttypeIDcarCalendar').submit();
	
	});
	jQuery('#future').on('change', function(){
		//var selectedCarTypeId = jQuery(this).find("option:selected").val();
		jQuery('#selecttypeIDcarCalendar').submit();
	
	});	

	
	jQuery('#checkboxALL').click(function(event) {		
		jQuery(".removeCheckBox").prop('checked', jQuery(this).prop("checked"));
	});	
	
	jQuery('#checkboxALLActive').click(function(event) {		
		jQuery(".isActiveCheckBox").prop('checked', jQuery(this).prop("checked"));
	});		
	
			
	
	
	if(document.getElementById('tblAppendGrid') !=null){
		var maxlengthVar = 20;
		var widthVar= '50px';
		var ctrlOptionsCategCar = "";
		

		var data = {
			'action': 'ajax_type_car_admin',
			'getOptionsAdmin': true,	
		};		
		jQuery.post(ajax_obj_type_car_admin.ajax_url, data,   function(response) {
			

			
			
			sternOptions = jQuery.parseJSON(response);
			var dataAjax = {
				'action': 'ajax_type_car_admin',
				'getAllcarCateg': true,	
			};					
			jQuery.post(ajax_obj_type_car_admin.ajax_url, dataAjax,   function(DataResponse) {
				ctrlOptionsCategCar = jQuery.parseJSON(DataResponse);

				

			
				jQuery('#tblAppendGrid').appendGrid({	
					
					caption: 'Type Cars',
					initRows: 1,
					columns: [
						{ name: 'id', display: 'id', type: 'text', ctrlAttr: { maxlength: maxlengthVar, 'readonly': 'readonly'  }, ctrlCss: { width: widthVar} },		
						{ 
							name: 'carType', display: sternOptions.carTypeTrad, type: 'text', ctrlAttr: { maxlength: 80 }, ctrlCss: { width: '80px'},
								onChange: function (evt, rowIndex) {
									var idRow = jQuery('#tblAppendGrid').appendGrid('getCtrlValue', 'id', rowIndex);
									var data = jQuery('#tblAppendGrid').appendGrid('getCtrlValue', 'carType', rowIndex);
									if(idRow != "") {	
										var dataAjax = {
											'action': 'ajax_type_car_admin',
											'carType': data,
											'id': idRow,
										}
										showText("loading");
										jQuery.post(ajax_obj_type_car_admin.ajax_url, dataAjax,   function(DataResponse) {
											showText("saved");											
										});	
									}
								}
						},
						{ 
							name: 'carCategory', display: sternOptions.carCategory, type: 'select', ctrlAttr: { maxlength: 80 }, ctrlCss: { width: '80px'},
							ctrlOptions: ctrlOptionsCategCar,
								onChange: function (evt, rowIndex) {
									var idRow = jQuery('#tblAppendGrid').appendGrid('getCtrlValue', 'id', rowIndex);
									var data = jQuery('#tblAppendGrid').appendGrid('getCtrlValue', 'carCategory', rowIndex);
									if(idRow != "") {	
										var dataAjax = {
											'action': 'ajax_type_car_admin',
											'carCategory': data,
											'id': idRow,
										}
										showText("loading");
										jQuery.post(ajax_obj_type_car_admin.ajax_url, dataAjax,   function(DataResponse) {
											showText("saved");												
										});	
									}
								}
						},				
						{ 
							name: 'carFare', display: sternOptions.carFare, type: 'text', ctrlAttr: { maxlength: maxlengthVar }, ctrlCss: { width: widthVar }, 
								onChange: function (evt, rowIndex) {
									var idRow = jQuery('#tblAppendGrid').appendGrid('getCtrlValue', 'id', rowIndex);
									var data = jQuery('#tblAppendGrid').appendGrid('getCtrlValue', 'carFare', rowIndex);
									if(jQuery.isNumeric(data)) {
										if(idRow != "") {	
											var dataAjax = {
												'action': 'ajax_type_car_admin',
												'carFare': data,
												'id': idRow,
											}
											showText("loading");
											jQuery.post(ajax_obj_type_car_admin.ajax_url, dataAjax,   function(DataResponse) {
												showText("saved");											
											});	
										}
									} else {
										showText("errorNotNumeric");
									}
								},
								change: function( event, ui ) {
									// alert("alan11");
								}
								
						},
						{ 
							name: 'minimumCourseFare', display: sternOptions.minimumCourseFare, type: 'text', ctrlAttr: { maxlength: maxlengthVar }, ctrlCss: { width: widthVar }, 
								onChange: function (evt, rowIndex) {
									var idRow = jQuery('#tblAppendGrid').appendGrid('getCtrlValue', 'id', rowIndex);
									var data = jQuery('#tblAppendGrid').appendGrid('getCtrlValue', 'minimumCourseFare', rowIndex);
									if(jQuery.isNumeric(data)) {
										if(idRow != "") {	
											var dataAjax = {
												'action': 'ajax_type_car_admin',
												'minimumCourseFare': data,
												'id': idRow,
											}
											showText("loading");
											jQuery.post(ajax_obj_type_car_admin.ajax_url, dataAjax,   function(DataResponse) {
												showText("saved");											
											});	
										}
									} else {
										showText("errorNotNumeric");
									}
								},
								change: function( event, ui ) {
									// alert("alan11");
								}
								
						},						
						{ 
							name: 'carSeat', display: sternOptions.carSeat, type: 'text', ctrlAttr: { maxlength: maxlengthVar }, ctrlCss: { width: widthVar},
								onChange: function (evt, rowIndex) {
									var idRow = jQuery('#tblAppendGrid').appendGrid('getCtrlValue', 'id', rowIndex);
									var data = jQuery('#tblAppendGrid').appendGrid('getCtrlValue', 'carSeat', rowIndex);
									if(jQuery.isNumeric(data)) {
										if(idRow != "") {	
											var dataAjax = {
												'action': 'ajax_type_car_admin',
												'carSeat': data,
												'id': idRow,
											}
											showText("loading");
											jQuery.post(ajax_obj_type_car_admin.ajax_url, dataAjax,   function(DataResponse) {
												showText("saved");													
											});	
										}
									} else {
										showText("errorNotNumeric");
									}
								} 									
							
						},
						{ 
							name: 'suitcases', display: sternOptions.suitcases, type: 'text', ctrlAttr: { maxlength: maxlengthVar }, ctrlCss: { width: widthVar},
								onChange: function (evt, rowIndex) {
									var idRow = jQuery('#tblAppendGrid').appendGrid('getCtrlValue', 'id', rowIndex);
									var data = jQuery('#tblAppendGrid').appendGrid('getCtrlValue', 'suitcases', rowIndex);
									if(jQuery.isNumeric(data)) {
										if(idRow != "") {						
											var dataAjax = {
												'action': 'ajax_type_car_admin',
												'suitcases': data,
												'id': idRow,
											}
											showText("loading");
											jQuery.post(ajax_obj_type_car_admin.ajax_url, dataAjax,   function(DataResponse) {
												showText("saved");							
											});	
										}
									} else {
										showText("errorNotNumeric");
									}
								} 									
						},
						{ 
							name: 'suitcasesSmall', display: sternOptions.suitcasesSmall, type: 'text', ctrlAttr: { maxlength: maxlengthVar }, ctrlCss: { width: widthVar},
								onChange: function (evt, rowIndex) {
									var idRow = jQuery('#tblAppendGrid').appendGrid('getCtrlValue', 'id', rowIndex);
									var data = jQuery('#tblAppendGrid').appendGrid('getCtrlValue', 'suitcasesSmall', rowIndex);
									if(jQuery.isNumeric(data)) {
										if(idRow != "") {						
											var dataAjax = {
												'action': 'ajax_type_car_admin',
												'suitcasesSmall': data,
												'id': idRow,
											}
											showText("loading");
											jQuery.post(ajax_obj_type_car_admin.ajax_url, dataAjax,   function(DataResponse) {
												showText("saved");							
											});	
										}
									} else {
										showText("errorNotNumeric");
									}
								} 									
						},						
						{ 
							name: 'farePerDistance', display: sternOptions.farePerDistance, type: 'text', ctrlAttr: { maxlength: maxlengthVar }, ctrlCss: { width: widthVar},
								onChange: function (evt, rowIndex) {
									var idRow = jQuery('#tblAppendGrid').appendGrid('getCtrlValue', 'id', rowIndex);
									var data = jQuery('#tblAppendGrid').appendGrid('getCtrlValue', 'farePerDistance', rowIndex);
									if(jQuery.isNumeric(data)) {
										if(idRow != "") {						
											var dataAjax = {
												'action': 'ajax_type_car_admin',
												'farePerDistance': data,
												'id': idRow,
											}
											showText("loading");
											jQuery.post(ajax_obj_type_car_admin.ajax_url, dataAjax,   function(DataResponse) {
												showText("saved");				
											});	
										}
									} else {
										showText("errorNotNumeric");
									}
								} 									
						},
						{ 
							name: 'farePerMinute', display: sternOptions.farePerMinute, type: 'text', ctrlAttr: { maxlength: maxlengthVar }, ctrlCss: { width: widthVar},
								onChange: function (evt, rowIndex) {
									var idRow = jQuery('#tblAppendGrid').appendGrid('getCtrlValue', 'id', rowIndex);
									var data = jQuery('#tblAppendGrid').appendGrid('getCtrlValue', 'farePerMinute', rowIndex);
									if(jQuery.isNumeric(data)) {
										if(idRow != "") {						
											var dataAjax = {
												'action': 'ajax_type_car_admin',
												'farePerMinute': data,
												'id': idRow,
											}
											showText("loading");
											jQuery.post(ajax_obj_type_car_admin.ajax_url, dataAjax,   function(DataResponse) {
												showText("saved");									
											});	
										}
									} else {
										showText("errorNotNumeric");
									}
								} 									
						},
						{ 
							name: 'farePerSeat', display: sternOptions.farePerSeat, type: 'text', ctrlAttr: { maxlength: maxlengthVar }, ctrlCss: { width: widthVar},
								onChange: function (evt, rowIndex) {
									var idRow = jQuery('#tblAppendGrid').appendGrid('getCtrlValue', 'id', rowIndex);
									var data = jQuery('#tblAppendGrid').appendGrid('getCtrlValue', 'farePerSeat', rowIndex);
									if(jQuery.isNumeric(data)) {
										if(idRow != "") {						
											var dataAjax = {
												'action': 'ajax_type_car_admin',
												'farePerSeat': data,
												'id': idRow,
											}
											showText("loading");
											jQuery.post(ajax_obj_type_car_admin.ajax_url, dataAjax,   function(DataResponse) {
												showText("saved");											
											});	
										}
									} else {
										showText("errorNotNumeric");
									}
								} 									
						},
						{ 
							name: 'farePerToll', display: sternOptions.farePerToll, type: 'text', ctrlAttr: { maxlength: maxlengthVar }, ctrlCss: { width: widthVar},
								onChange: function (evt, rowIndex) {
									var idRow = jQuery('#tblAppendGrid').appendGrid('getCtrlValue', 'id', rowIndex);
									var data = jQuery('#tblAppendGrid').appendGrid('getCtrlValue', 'farePerToll', rowIndex);
									if(jQuery.isNumeric(data)) {
										if(idRow != "") {						
											var dataAjax = {
												'action': 'ajax_type_car_admin',
												'farePerToll': data,
												'id': idRow,
											}
											showText("loading");
											jQuery.post(ajax_obj_type_car_admin.ajax_url, dataAjax,   function(DataResponse) {
												showText("saved");											
											});	
										}
									} else {
										showText("errorNotNumeric");
									}
								} 									
						},
						{ 
							name: 'carSeatChild', display: sternOptions.carSeatChild, type: 'text', ctrlAttr: { maxlength: maxlengthVar }, ctrlCss: { width: widthVar},
								onChange: function (evt, rowIndex) {
									var idRow = jQuery('#tblAppendGrid').appendGrid('getCtrlValue', 'id', rowIndex);
									var data = jQuery('#tblAppendGrid').appendGrid('getCtrlValue', 'carSeatChild', rowIndex);
									if(jQuery.isNumeric(data)) {
										if(idRow != "") {						
											var dataAjax = {
												'action': 'ajax_type_car_admin',
												'carSeatChild': data,
												'id': idRow,
											}
											showText("loading");
											jQuery.post(ajax_obj_type_car_admin.ajax_url, dataAjax,   function(DataResponse) {
												showText("saved");												
											});	
										}
									} else {
										showText("errorNotNumeric");
									}
									
								} 									
						},	
						{ 
							name: 'farePerSeatChild', display: sternOptions.farePerSeatChild, type: 'text', ctrlAttr: { maxlength: maxlengthVar }, ctrlCss: { width: widthVar},
								onChange: function (evt, rowIndex) {
									var idRow = jQuery('#tblAppendGrid').appendGrid('getCtrlValue', 'id', rowIndex);
									var data = jQuery('#tblAppendGrid').appendGrid('getCtrlValue', 'farePerSeatChild', rowIndex);
									if(jQuery.isNumeric(data)) {
										if(idRow != "") {		
											var dataAjax = {
												'action': 'ajax_type_car_admin',
												'farePerSeatChild': data,
												'id': idRow,
											}
											showText("loading");
											jQuery.post(ajax_obj_type_car_admin.ajax_url, dataAjax,   function(DataResponse) {
												showText("saved");										
											});	
										}
									} else {
										showText("errorNotNumeric");
									}
								} 									
						},							
						
					],
					initData: [],
					rowDragging: true,
					afterRowDragged: function (caller, rowIndex, uniqueIndex) {
						refreshOrder();							
					},
					afterRowAppended: function(caller, parentRowIndex, addedRowIndex) {
						if(jQuery('#tblAppendGrid').appendGrid('getCtrlValue', 'id', addedRowIndex) == ""){
							var dataAjax = {
								'action': 'ajax_type_car_admin',
								'isNewTypeCar': "yes",								
							}
							jQuery.post(ajax_obj_type_car_admin.ajax_url, dataAjax,   function(DataResponse) {
								var res = jQuery.parseJSON(DataResponse);
								jQuery('#tblAppendGrid').appendGrid('setCtrlValue', 'id', addedRowIndex, res);
								refreshOrder();
								
							});
						
						}
						
					},
					beforeRowRemove: function (caller, rowIndex) {
						
						
						var idRow = jQuery('#tblAppendGrid').appendGrid('getCtrlValue', 'id', rowIndex);
						var dataAjax = {
							'action': 'ajax_type_car_admin',
							'isDelete': "yes",
							'id': idRow,				
						}
						jQuery.post(ajax_obj_type_car_admin.ajax_url, dataAjax,   function(DataResponse) {
							jQuery('#tblAppendGrid').appendGrid('removeRow', rowIndex);
							document.getElementById("tblAppendGridStatus").innerHTML = "<strong>Saved!</strong>";
							setTimeout(function(){
								document.getElementById("tblAppendGridStatus").innerHTML = "";
								}, 1000);
							
						});
						
					},

					hideButtons: { moveUp: true, moveDown: true , insert: true }
				});
				


				
				var dataAjax = {
					'action': 'ajax_type_car_admin',
					'loadInit': "yes",	
				};			
				
				jQuery.post(ajax_obj_type_car_admin.ajax_url, dataAjax,   function(DataResponse) {
					var objJSON = jQuery.parseJSON(DataResponse);
						jQuery('#tblAppendGrid').appendGrid('appendRow',						
							objJSON						
						);
				});
			});
		});
	}
  
});




function showText(type) {
	if(type=="errorNotNumeric") {
		document.getElementById("tblAppendGridStatus").innerHTML = "<strong>ERROR! Not saved. It is not numeric. It must be like 1.21</strong>";	
		setTimeout(function(){
			document.getElementById("tblAppendGridStatus").innerHTML = "";
			}, 5000);		
		
	}	
	if(type=="loading") {
		document.getElementById("tblAppendGridStatus").innerHTML = "<strong>...</strong>";	
	}
	if(type=="saved") {
		document.getElementById("tblAppendGridStatus").innerHTML = "<strong>Saved!</strong>";
		setTimeout(function(){
			document.getElementById("tblAppendGridStatus").innerHTML = "";
			}, 1800);
	}
}

function refreshOrder() {
	var count = jQuery('#tblAppendGrid').appendGrid('getRowCount') ;
	arrayOrder = [];
//	console.log(count);
	for (var z = 0; z < count; z++) {
		id = jQuery('#tblAppendGrid').appendGrid('getCtrlValue', 'id', z);
		arrayOrder.push([z,id]);
	}
	var dataAjax = {
		'action': 'ajax_type_car_admin',
		'arrayOrder': arrayOrder,
	}
	jQuery.post(ajax_obj_type_car_admin.ajax_url, dataAjax,   function(DataResponse) {
			document.getElementById("tblAppendGridStatus").innerHTML = "<strong>Saved!</strong>";
			setTimeout(function(){
			document.getElementById("tblAppendGridStatus").innerHTML = "";
			}, 1000);	
	});

	
}



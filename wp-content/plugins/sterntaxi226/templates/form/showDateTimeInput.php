<?php
function showDateTimeInput($class_full_row,$roundtrip,$class) {
	
	if(get_option('stern_taxi_fare_calendar_split_date_time') == "true") {
		if( get_option('stern_taxi_fare_typeCar_calendar_as_input') == "false" && get_option('stern_taxi_fare_use_calendar') == "true") {
			$okSplit=false;
		} else {
			$okSplit=true;
		}		
	} else {
		$okSplit=false;
	}

	if($roundtrip=="roundTrip") {
		$mainDiv = "divDateTimePickUpRoundTrip";
		
		$function = "setNowDateRoundTrip()";
		$spanButtonId = "buttonDateTimeROundTrip";
		
		if($okSplit ) {
			$label = __('Date Picking for round trip', 'stern_taxi_fare');
			$label2 = __('Time Picking for round trip', 'stern_taxi_fare');
			$tooltip = (get_option('stern_taxi_fare_show_tooltips') != "false") ? "data-toggle='tooltip' data-placement='bottom' data-original-title='". __('Date Picking for round trip', 'stern_taxi_fare')."';" : "";
			$tooltip = (get_option('stern_taxi_fare_show_tooltips') != "false") ? "data-toggle='tooltip' data-placement='bottom' data-original-title='". __('Time Picking for round trip', 'stern_taxi_fare')."';" : "";
			$inputId = "datePickUpSplitRoundTrip";
			$inputId2 = "timePickUpSplitRoundTrip";
			$class_full_row = "class='col-lg-6 col-md-6 col-sm-12 col-xs-12'";
			if(get_option('stern_taxi_fare_split_hour_min')=="true") {
				if(get_option('stern_taxi_fare_formatTime') == "12h" ) {
					$class_full_row3 = "class='col-lg-2 col-md-2 col-sm-6 col-xs-6'";
					$labelAMPM = __('am/pm', 'stern_taxi_fare');					
					$idAMPM = "ampmPickUpSplitRoundTrip";	
					$maxHour = 12;					
				} else {
					$class_full_row3 = "class='col-lg-3 col-md-3 col-sm-6 col-xs-6'";
				}
				$labelHour = __('Hour', 'stern_taxi_fare');
				$labelMin = __('Min', 'stern_taxi_fare');
				$maxHour = 24;
				$idHour = "hourPickUpSplitRoundTrip";
				$idMin = "minPickUpSplitRoundTrip";			
		//		$class_full_row = "class='col-lg-6 col-md-6 col-sm-12 col-xs-12'";
			}			
		} else {
			$label = __('DateTime Picking for round trip', 'stern_taxi_fare');
			$tooltip = (get_option('stern_taxi_fare_show_tooltips') != "false") ? "data-toggle='tooltip' data-placement='bottom' data-original-title='". __('DateTime Picking for round trip', 'stern_taxi_fare')."';" : "";			
			$inputId = "dateTimePickUpRoundTrip";
			
		}
		$display = "display:none;";
	} else {
		$mainDiv = "divDateTimePickUp";
		$function = "setNowDate()";
		$spanButtonId = "buttonDateTime";
		if($okSplit  ) {
			$label = __('Date Picking', 'stern_taxi_fare');
			$label2 = __('Time Picking', 'stern_taxi_fare');
			$tooltip = (get_option('stern_taxi_fare_show_tooltips') != "false") ? "data-toggle='tooltip' data-placement='bottom' data-original-title='". __('Date Picking', 'stern_taxi_fare')."';" : "";			
			$tooltip2 = (get_option('stern_taxi_fare_show_tooltips') != "false") ? "data-toggle='tooltip' data-placement='bottom' data-original-title='". __('Time Picking', 'stern_taxi_fare')."';" : "";			
			$inputId = "datePickUpSplit";
			$inputId2 = "timePickUpSplit";
			$class_full_row = "class='col-lg-6 col-md-6 col-sm-12 col-xs-12'";
			if(get_option('stern_taxi_fare_split_hour_min')=="true") {
				if(get_option('stern_taxi_fare_formatTime') == "12h" ) {
					$class_full_row3 = "class='col-lg-2 col-md-2 col-sm-6 col-xs-6'";
					$labelAMPM = __('am/pm', 'stern_taxi_fare');					
					$idAMPM = "ampmPickUpSplit";
					$maxHour = 12;
								
				} else {
					$class_full_row3 = "class='col-lg-3 col-md-3 col-sm-6 col-xs-6'";
				}
				
				$labelHour = __('Hour', 'stern_taxi_fare');
				$labelMin = __('Min', 'stern_taxi_fare');
				$idHour = "hourPickUpSplit";
				$maxHour = 24;
				$idMin = "minPickUpSplit";
			
//				$class_full_row = "class='col-lg-6 col-md-6 col-sm-12 col-xs-12'";		
			}			
		} else {
			$label = __('DateTime Picking', 'stern_taxi_fare');
			$tooltip = (get_option('stern_taxi_fare_show_tooltips') != "false") ? "data-toggle='tooltip' data-placement='bottom' data-original-title='". __('DateTime Picking', 'stern_taxi_fare')."';" : "";
			$inputId = "dateTimePickUp";
			
			
		}		
		$display = "";		
	}

	 

	?>
	
		<div id="<?php echo $mainDiv; ?>" style="<?php echo $display ?>">								
			<div <?php echo $class_full_row; ?> style="padding-top: 15px;">
				<?php if (showlabel()) : ?>
					<label for="<?php echo $inputId; ?>"><?php echo $label; ?></label>
				<?php endif; ?>												
				<div class="form-group">
					<div class='input-group date'>							
						<div class="input-group-btn" <?php echo $tooltip; ?>>
							<button type="button" onClick="<?php echo $function; ?>" class="btn btn-primary " style="font-size: 14px; font-weight: bold" >
								<span id="<?php echo $spanButtonId; ?>" class="glyphicon glyphicon-calendar" aria-hidden="true"></span>
							</button>
						</div>
						<input type='text' class="form-control"id="<?php echo $inputId; ?>" name="<?php echo $inputId; ?>" />														
					</div>
				</div>	
			</div>
			<?php if ($okSplit) : ?>
				<?php if(get_option('stern_taxi_fare_split_hour_min')=="true") : ?>
	
					<div <?php echo $class_full_row3; ?> style="padding-top: 15px;">
						<?php if (showlabel()) : ?>
							<label for="<?php echo $idHour; ?>"><?php echo $labelHour; ?></label>
						<?php endif; ?>						
						<div class="form-group">
							<div class='input-group date'>								
								<select id="<?php echo $idHour; ?>" class="<?php echo $class; ?>" data-width="100%" style="padding-left: 15px; float: right;">								
									<?php for ($i=0;$i<$maxHour;$i++): ?>
										<option value="<?php echo sprintf("%02d", $i); ?>"><?php echo sprintf("%02d", $i); ?></option>
									<?php endfor; ?>
								</select>													
							</div>
						</div>	
					</div>
					<div <?php echo $class_full_row3; ?> style="padding-top: 15px;">
						<?php if (showlabel()) : ?>
							<label for="<?php echo $idMin; ?>"><?php echo $labelMin; ?></label>
						<?php endif; ?>												
						<div class="form-group">
							<div class='input-group date'>								
								<select id="<?php echo $idMin; ?>"  class="<?php echo $class; ?>" data-width="100%" style="padding-left: 15px; float: right;">	
									<?php for ($i=0;$i<60;$i=$i+5): ?>
										<option value="<?php echo sprintf("%02d", $i); ?>"><?php echo sprintf("%02d", $i); ?></option>
									<?php endfor; ?>
								</select>													
							</div>
						</div>	
					</div>	
					<?php if(get_option('stern_taxi_fare_formatTime')=="12h") : ?>
						<div <?php echo $class_full_row3; ?> style="padding-top: 15px;">
							<?php if (showlabel()) : ?>
								<label for="<?php echo $idAMPM; ?>"><?php echo $labelAMPM; ?></label>
							<?php endif; ?>												
							<div class="form-group">
								<div class='input-group date'>								
									<select id="<?php echo $idAMPM; ?>"  class="<?php echo $class; ?>" data-width="100%" style="padding-left: 15px; float: right;">							
										<option value="am">am</option>
										<option value="pm">pm</option>										
									</select>													
								</div>
							</div>	
						</div>	
					<?php endif; ?>	
				
				<?php else : ?>	
					<div <?php echo $class_full_row; ?> style="padding-top: 15px;">
						<?php if (showlabel()) : ?>
							<label for="<?php echo $inputId2; ?>"><?php echo $label2; ?></label>
						<?php endif; ?>												
						<div class="form-group">
							<div class='input-group date'>							
								<div class="input-group-btn" <?php echo $tooltip2; ?>>
									<button type="button"  onClick="<?php echo $function; ?>" class="btn btn-primary " style="font-size: 14px; font-weight: bold" >
										<span id="<?php echo $spanButtonId; ?>" class="glyphicon glyphicon-calendar" aria-hidden="true"></span>
									</button>
								</div>
								<input type='text' class="form-control"id="<?php echo $inputId2; ?>" name="<?php echo $inputId2; ?>" />														
							</div>
						</div>	
					</div>
				<?php endif; ?>	
			<?php endif; ?>	
		</div>
		
	
<?php
	
}										
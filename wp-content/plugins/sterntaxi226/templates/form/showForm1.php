<?php
function showForm1($atts) {

			$args = array(
				'post_type' => 'stern_taxi_car_type',
				'nopaging' => true,
				'order'     => 'ASC',
				'orderby' => 'meta_value',
				'meta_key' => '_stern_taxi_car_type_organizedBy'
			);
			$allTypeCars = get_posts( $args );	


			
			$args = array(
				'post_type' => 'stern_listAddress',
				'nopaging' => true,
				'meta_query' => array(
					array(
						'key'     => 'typeListAddress',
						'value'   => 'destination',
						'compare' => '=',
					),				
					array(
						'key'     => 'isActive',
						'value'   => 'true',
						'compare' => '=',
					),
				),				
			);
			$allListAddressesDestination = get_posts( $args );			


			 $backgroundColor=get_option('stern_taxi_fare_bcolor');
			 if($backgroundColor!="")
			 {
				$backgroundColor='background-color:'.stern_taxi_fare_hex2rgba($backgroundColor,get_option('stern_taxi_fare_bTransparency'));
			 }
			global $woocommerce;
			
			$currency_symbol = get_woocommerce_currency_symbol();

			if (isBootstrapSelectEnabale()=="true")
			{
				$class = "selectpicker show-tick";
			} else {
				$class = "form-control";
			}
		
			
			
			
			$class_full_row12 = (get_option('stern_taxi_fare_full_row') != "true") ? "class='col-lg-12 col-md-12 col-sm-12 col-xs-12'" : "class='col-lg-12 col-md-12 col-sm-12 col-xs-12'";
			$class_full_row6 = (get_option('stern_taxi_fare_full_row') != "true") ? "class='col-lg-6 col-md-6 col-sm-12 col-xs-12'" : "class='col-lg-12 col-md-12 col-sm-12 col-xs-12'";
			$class_full_row3 = (get_option('stern_taxi_fare_full_row') != "true") ? "class='col-lg-3 col-md-3 col-sm-12 col-xs-12'" : "class='col-lg-12 col-md-12 col-sm-12 col-xs-12'";
			
						
									
					
			$classMain = (get_option('stern_taxi_fare_form_full_row') != "true") ? "class='col-xs-12 col-sm-6 col-lg-6'" : "class='col-xs-12 col-sm-12 col-lg-12'";
			
			showDemoSettings($backgroundColor);
			?>

			
          
   
			<div class="container">
				<div class="stern-taxi-fare">
					<div class="row">
						<div  <?php echo $classMain; ?> id="main1" style="<?php echo $backgroundColor; ?>;padding-bottom: 5px" >

						
					
							<form id="stern_taxi_fare_div" method="post">
								<div class="row">
									<?php if(get_option('stern_taxi_fare_title') !="") : ?>
										<div id="titleDiv" <?php echo $class_full_row12; ?> style="padding-top: 15px;">
											<h1><?php echo stripslashes(get_option('stern_taxi_fare_title')); ?></h1>										
										</div>
									<?php endif;?>
									
									<?php if(get_option('stern_taxi_fare_subtitle') !="") : ?>
										<div id="subtitleDiv" <?php echo $class_full_row12; ?> style="padding-top: 15px;">
											<h2><?php echo stripslashes(get_option('stern_taxi_fare_subtitle')); ?></h2>										
										</div>
									<?php endif;?>
										
										
										<?php showInputAddress($class_full_row12,"source",$class); ?>
										<?php showInputAddress($class_full_row12,"destination",$class); ?>	

									
									
										<?php if(get_option('stern_taxi_fare_typeCar_calendar_as_input') =="true") : ?>
											<?php showDateTimeInput($class_full_row12,"oneTrip",$class); ?>										
										<?php else: ?>
											<?php showTypeCar($class_full_row6,$class); ?>
											<?php showRoundTrip($class_full_row3,$class); ?>
										<?php endif;?>
										
										
										<?php if(get_option('stern_taxi_fare_seat_field_as_input') =="true") : ?>										
										<?php endif; ?>		
										
										<?php showSeatInputs1($class_full_row3,$class); ?>
										
										<?php if(get_option('stern_taxi_fare_typeCar_calendar_as_input') !="true") : ?>
											<?php if(get_option('stern_taxi_fare_seat_field_as_input') !="true") : ?>
												<?php if(get_option('stern_taxi_fare_use_babySeat') =="true") : ?>
													<?php showBabySeatInputs($class_full_row3,$class); ?>
												<?php endif;?>
											<?php endif;?>
										<?php endif;?>													
																							
									 
									
	
								</div>	
								<?php showButtons(); ?>

								
								
								<input type="hidden"  name="stern_taxi_fare_use_FullCalendar" id="stern_taxi_fare_use_FullCalendar" value="<?php echo get_option('stern_taxi_fare_use_FullCalendar'); ?>"/>
								<input type="hidden"  name="actualVersionPlugin" id="actualVersionPlugin" readonly value="<?php echo getPluginVersion(); ?>"/>
								<input type="hidden"  name="stern_taxi_fare_url_gif_loader" id="stern_taxi_fare_url_gif_loader" value="<?php echo getUrlGifLoader(); ?>"/>									
								<input type="hidden"  name="stern_taxi_fare_show_map" id="stern_taxi_fare_show_map" value="<?php echo get_option('stern_taxi_fare_show_map'); ?>"/>
								<input type="hidden"  name="stern_taxi_fare_auto_open_map" id="stern_taxi_fare_auto_open_map" value="<?php echo get_option('stern_taxi_fare_auto_open_map'); ?>"/>									
								<input type="hidden"  name="getKmOrMiles" id="getKmOrMiles" value="<?php echo getKmOrMiles(); ?>"/>									
								<input type="hidden"  name="stern_taxi_fare_avoid_highways_in_calculation" id="stern_taxi_fare_avoid_highways_in_calculation" value="<?php echo get_option('stern_taxi_fare_avoid_highways_in_calculation'); ?>"/>									
								<input type="hidden"  name="getShow_use_img_gif_loader" id="getShow_use_img_gif_loader" value="<?php echo getShow_use_img_gif_loader(); ?>"/>									
								<input type="hidden"  name="stern_taxi_fare_address_saved_point" id="stern_taxi_fare_address_saved_point" value="<?php echo get_option('stern_taxi_fare_address_saved_point') ?>"/>
								<input type="hidden"  name="stern_taxi_fare_address_saved_point2" id="stern_taxi_fare_address_saved_point2" value="<?php echo get_option('stern_taxi_fare_address_saved_point2') ?>"/>									
								<input type="hidden"  name="First_date_available_in_hours" id="First_date_available_in_hours" value="<?php echo getFirst_date_available_in_hours(); ?>"/>
								<input type="hidden"  name="First_date_available_roundtrip_in_hours" id="First_date_available_roundtrip_in_hours" value="<?php echo getFirst_date_available_roundtrip_in_hours(); ?>"/>
								<input type="hidden"  name="stern_taxi_fare_Time_To_add_after_a_ride" id="stern_taxi_fare_Time_To_add_after_a_ride" value="<?php echo get_option('stern_taxi_fare_Time_To_add_after_a_ride') ?>"/>									
								<input type="hidden"  name="stern_taxi_fare_great_text" id="stern_taxi_fare_great_text" value="<?php _e('Great! ', 'stern_taxi_fare'); ?>"/>
								<input type="hidden"  name="stern_taxi_fare_fixed_price_text" id="stern_taxi_fare_fixed_price_text" value="<?php _e('This is a fixed price ! ', 'stern_taxi_fare'); ?>"/>
								<input type="hidden"  name="stern_taxi_fare_duration" id="stern_taxi_fare_duration" value=""/>
								<input type="hidden"  name="stern_taxi_fare_distance" id="stern_taxi_fare_distance" value=""/>
								<input type="hidden"  name="stern_taxi_fare_nb_toll" id="stern_taxi_fare_nb_toll" value=""/>
								<input type="hidden"  name="stern_taxi_fare_estimated_fare" id="stern_taxi_fare_estimated_fare" value=""/>
								<input type="hidden"  name="stern_taxi_fare_time_wrong" id="stern_taxi_fare_time_wrong" value="<?php _e('Please select a date greater than ', 'stern_taxi_fare'); ?>"/>
								
								
								<div id="divAlertError" class="alert alert-danger alert-dismissible" role="alert" style="display: none;">									
									<div id="divAlertErrorTextStrong">
										<strong><?php _e('Error!', 'stern_taxi_fare'); ?></strong>
										<span id="divAlertErrorText">
										</span>
									</div>
								</div>											
								
								<div id="divAlertSuccess" class="alert alert-success alert-dismissible" role="alert" style="display: none;">									
									<div id="divAlertSuccessTextStrong">
										<strong><?php _e('Great!', 'stern_taxi_fare'); ?></strong>
										<span id="divAlertSuccessText">
										</span>
									</div>
								</div>	
								
														
								
						
							

								<div class="row">
									<div id="resultLeft" style="display: none;">
										<?php if(get_option('stern_taxi_fare_typeCar_calendar_as_input') =="true") : ?>

											
											<?php showRoundTrip($class_full_row3,$class); ?>
											<?php showDateTimeInput($class_full_row12,"roundTrip",$class); ?>
											<?php showTypeCar($class_full_row6,$class); ?>
										
										<?php else : ?>	
											<?php showDateTimeInput($class_full_row12,"oneTrip",$class); ?>
											<?php showDateTimeInput($class_full_row12,"roundTrip",$class); ?>
										<?php endif; ?>
										
										
									</div>
								</div>
								<div class="row">									
									<?php showResults($classMain,$backgroundColor); ?>									
								</div>								
								<div class="row">
									<?php showButtonCheckOut(); ?>
								</div>										
							</form>
						</div>
						
						<div <?php echo $classMain; ?>  id="fullCalendarDivContainer" style="<?php echo $backgroundColor; ?>;display: none;padding-top: 10px;padding-bottom: 10px;">
							<a class='boxclose' id='boxcloseCalendar' onclick='closeBoxCalendar();'></a>
							<div id='external-events'></div>
							<div id='fullCalendarDiv'></div>
						</div>
					
						<div <?php echo $classMain; ?>  id="main2" style="<?php echo $backgroundColor; ?>; background-image:url(<?php echo getUrlGifLoader(); ?>);display: none;">
							<a class='boxclose' id='boxclose' onclick='closeBox();'></a>
							<div id="googleMap" style="width:100%;height:450px;"></div>
						</div>						
				
					</div>
				</div>
				


			</div>
		<?php
	/*
echo "<pre>";
    var_dump(WC()->session);
echo "</pre>";
	*/
	
}

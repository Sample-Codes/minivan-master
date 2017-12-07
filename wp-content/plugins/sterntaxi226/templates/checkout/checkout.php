<?php

Class checkout{
	function __construct(){
		
		
	global $woocommerce;
	
	$distanceHtml = WC()->session->get( 'distanceHtml' );
	$durationHtml = WC()->session->get( 'durationHtml' );
	$estimated_fare = WC()->session->get( 'estimated_fare' );
	$cartypes = WC()->session->get( 'cartypes' );
	$source = WC()->session->get( 'source' );
	$destination = WC()->session->get( 'destination' );
	$car_seats = WC()->session->get( 'car_seats' );
	$dateTimePickUp = date(getFormatDateTime("php"),strtotime(WC()->session->get( 'dateTimePickUp' )));
	$dateTimePickUpRoundTrip = date(getFormatDateTime("php"),strtotime(WC()->session->get( 'dateTimePickUpRoundTrip' )));
	$nbToll = WC()->session->get( 'nbToll' );
	$suitcases = WC()->session->get( 'suitcases' );
	
	$stern_taxi_fare_round_trip = (WC()->session->get( 'stern_taxi_fare_round_trip' )=="true") ? __('Round Trip', 'stern_taxi_fare') : __('One way', 'stern_taxi_fare') ;
	
	
	

	

	?>
	
    <br>
	<div id="my_custom_checkout_field">
		

	
		<h3><?php _e('Your trip', 'stern_taxi_fare' ); ?></h3>
		<br>
		<?php if(get_option('stern_taxi_use_pets')=='true') : ?>
			<p class="form-row form-row form-row-wide" >
				<label><?php _e('Number of Pets', 'stern_taxi_fare'); ?></label><input name="NumberOfPets" id="NumberOfPets" type="number" class="input-text" value="">
			</p>
		<?php endif; ?>
		
				
		
			
			
		<p class="form-row form-row form-row-wide" >
			<label><?php _e( 'Pickup Time', 'stern_taxi_fare' ); ?></label>
			<input name="dateEstimatedPickedUp" type="text" class="input-text" readonly value="<?php echo $dateTimePickUp; ?>">
			<input name="timeEstimatedPickedUp" type="hidden" class="input-text" readonly value="">			
		</p>
			
			
		
		<p class="form-row form-row form-row-first" >
			<label><?php _e('Distance', 'stern_taxi_fare'); ?></label><input type="text" class="input-text" readonly value="<?php echo $distanceHtml; ?>">
		</p>
		<p class="form-row form-row form-row-last" >
			<label><?php _e('Duration', 'stern_taxi_fare'); ?></label><input type="text" class="input-text" readonly value="<?php echo $durationHtml; ?>">
		</p>	


		<p class="form-row form-row form-row-wide" style="<?php echo (get_option('stern_taxi_fare_show_dropdown_typecar')!="false") ? "" : "display:none;"; ?>">
			<label><?php _e('Car type', 'stern_taxi_fare'); ?></label><input type="text" class="input-text" readonly value="<?php echo $cartypes; ?>">
		</p>
		


		<p class="form-row form-row form-row-wide" style="<?php echo (get_option('stern_taxi_fare_show_tolls_in_form')!="false") ? "" : "display:none;"; ?>">
			<label><?php _e('Number of Tolls', 'stern_taxi_fare'); ?></label><input type="text" class="input-text" readonly value="<?php echo $nbToll; ?>">
		</p>

		
		<p class="form-row form-row form-row-wide" style="<?php echo (get_option('stern_taxi_fare_show_seat_input')!="false") ? "" : "display:none;"; ?>">
			<label><?php _e('Seats', 'stern_taxi_fare'); ?></label><input type="text" class="input-text" readonly value="<?php echo $car_seats; ?>">
		</p>

		
	
		<p class="form-row form-row form-row-wide" style="<?php echo (get_option('stern_taxi_fare_show_suitcases_in_form')!="false") ? "" : "display:none;"; ?>">
			<label><?php _e('Suitcases', 'stern_taxi_fare'); ?></label><input type="text" class="input-text" readonly value="<?php echo $suitcases; ?>">
		</p>


		
		<p class="form-row form-row form-row-wide" >
			<label><?php _e('Source', 'stern_taxi_fare'); ?></label><input type="text" class="input-text" readonly value="<?php echo stripslashes($source); ?>">
		</p>

		
		<p class="form-row form-row form-row-wide" >
			<label><?php _e('Destination', 'stern_taxi_fare'); ?></label><input type="text" class="input-text" readonly value="<?php echo stripslashes($destination); ?>">
		</p>

		<p class="form-row form-row form-row-wide" >
			<label><?php _e('Round trip?', 'stern_taxi_fare'); ?></label><input type="text" class="input-text" readonly value="<?php echo $stern_taxi_fare_round_trip; ?>">
		</p>
		
		<?php if(WC()->session->get( 'stern_taxi_fare_round_trip' )=="true") : ?>
			<p class="form-row form-row form-row-wide" >
				<label><?php _e('Pickup Time for Round Trip', 'stern_taxi_fare'); ?></label><input type="text" class="input-text" readonly value="<?php echo $dateTimePickUpRoundTrip; ?>">
			</p>		
		<?php endif; ?>


	
	
		<?php

		
		if (get_option('stern_taxi_fare_show_map_checkout') =="true") {
			$apiGoogleKey = get_option('stern_taxi_fare_apiGoogleKey');
			$iframeGmap = "<iframe  width='100%'   height='350' ";
			$iframeGmap .= "frameborder='0' style='border:0'  ";
			$iframeGmap .= "src='https://www.google.com/maps/embed/v1/directions?key=" . $apiGoogleKey ;
			$iframeGmap .= "&origin=" . $source;
			$iframeGmap .= "&destination=" . $destination ;
			if(get_option('stern_taxi_fare_avoid_highways_in_calculation')=="true") {
				$iframeGmap .= "&avoid=highways";
			}			
			$iframeGmap .= "&avoid=tolls|highways' allowfullscreen></iframe>";
			echo $iframeGmap;
		}
		?>
    </div>
	<?php
	}
}
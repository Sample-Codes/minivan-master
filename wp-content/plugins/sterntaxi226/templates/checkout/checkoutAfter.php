<?php

Class checkoutAfter{
	function __construct($order_id, $isTextFormat=true, $isInAdmin=false){
		
		if(!isProductTaxiIsInCart($order_id)) {
			return;
		}
		
		
		if($isTextFormat) {
			
			$distanceHtml = get_post_meta( $order_id , '_distance', true );
			$durationHtml = get_post_meta( $order_id , '_durationHtml', true );
			$estimated_fare = get_post_meta($order_id , '_estimated_fare', true );
			$cartypes = get_post_meta( $order_id , '_cartypes', true );
			$source = get_post_meta( $order_id , '_source', true );
			$destination = get_post_meta( $order_id , '_destination', true );
			$car_seats = get_post_meta( $order_id , '_car_seats', true );
			$dateTimePickUp = date(getFormatDateTime("php"),strtotime(get_post_meta( $order_id , '_local_pickup_time_select', true )));
			$dateTimePickUpRoundTrip = date(getFormatDateTime("php"),strtotime(get_post_meta( $order_id , '_dateTimePickUpRoundTrip', true )));
			$nbToll = get_post_meta( $order_id , '_nbToll', true );
			$numberOfPets = get_post_meta( $order_id , '_NumberOfPets', true );
			//$dateTimePickUpRoundTrip = get_post_meta( $order_id , '_dateTimePickUpRoundTrip', true );
			$stern_taxi_fare_round_trip_text = (get_post_meta( $order_id , '_stern_taxi_fare_round_trip', true )=="true") ? __('Round Trip', 'stern_taxi_fare') : __('One way', 'stern_taxi_fare') ;
			$suitcases = get_post_meta( $order_id , '_suitcases', true );
			$idCalendar = get_post_meta( $order_id , '_idCalendar', true );
			$idCalendarRoundTrip = get_post_meta( $order_id , '_idCalendarRoundTrip', true );
			
			
			
			?>	
			<h4><?php _e('Trip', 'stern_taxi_fare' ); ?></h4>
		

			<?php if($distanceHtml !="") : ?>	
				<p>
					<strong><?php _e('Distance: ', 'stern_taxi_fare'); ?></strong><?php echo $distanceHtml; ?>
				</p>
			<?php endif; ?>	
			

			
			<?php if($durationHtml !="") : ?>	
				<p>
					<strong><?php _e('duration: ', 'stern_taxi_fare'); ?></strong><?php echo $durationHtml; ?>
				</p>
			<?php endif; ?>	
			
			<?php if(get_option('stern_taxi_fare_show_dropdown_typecar')!="false") : ?>	
				<?php if($cartypes !="") : ?>	
					<p>
						<strong><?php _e('cartypes: ', 'stern_taxi_fare'); ?></strong><?php echo $cartypes; ?>
					</p>
				<?php endif; ?>	
			<?php endif; ?>

			<?php if($source !="") : ?>	
				<p>
					<a href="https://maps.google.com?saddr=Current+Location&daddr=<?php echo $source; ?>" TARGET="_blank"><i class="dashicons-before dashicons-external"></i></a>
					<strong><?php _e('source: ', 'stern_taxi_fare'); ?></strong><?php echo $source; ?>
				</p>
			<?php endif; ?>

			
			<?php if($destination !="") : ?>	
				<p>
					<a href="https://maps.google.com?saddr=Current+Location&daddr=<?php echo $destination; ?>" TARGET="_blank"><i class="dashicons-before dashicons-external"></i></a>			
					<strong><?php _e('destination: ', 'stern_taxi_fare'); ?></strong><?php echo $destination; ?>
				</p>
			<?php endif; ?>

			<?php if(get_option('stern_taxi_fare_show_seat_input')!="false") : ?>		
				<?php if($car_seats !="") : ?>	
					<p>
						<strong><?php _e('Seats: ', 'stern_taxi_fare'); ?></strong><?php echo $car_seats; ?>
					</p>
				<?php endif; ?>
			<?php endif; ?>

			<?php if(get_option('stern_taxi_fare_show_suitcases_in_form')!="false") : ?>
				<?php if($suitcases !="") : ?>	
					<p>
						<strong><?php _e('Suitcases: ', 'stern_taxi_fare'); ?></strong><?php echo $suitcases; ?>
					</p>
				<?php endif; ?>
			<?php endif; ?>
			
			
			
			<?php if($dateTimePickUp !="") : ?>	
				<p>
					<strong><?php _e('dateTimePickUp: ', 'stern_taxi_fare'); ?> </strong><?php echo $dateTimePickUp; ?>
				</p>
			<?php endif; ?>
			<?php if($nbToll !="") : ?>	
				<p style="<?php echo (get_option('stern_taxi_fare_show_tolls_in_form')!="false") ? "" : "display:none;"; ?>">
					<strong><?php _e('nbToll: ', 'stern_taxi_fare'); ?></strong><?php echo $nbToll; ?>
				</p>
			<?php endif; ?>
			<?php if($numberOfPets !="") : ?>
				<p>
					<strong><?php _e('Number Of Pets: ', 'stern_taxi_fare'); ?> </strong><?php echo $numberOfPets; ?>
				</p>
			<?php endif; ?>
			<p>
				<strong><?php _e('Round trip: ', 'stern_taxi_fare'); ?> </strong><?php echo $stern_taxi_fare_round_trip_text; ?>
			</p>
			<?php if(get_post_meta( $order_id , '_stern_taxi_fare_round_trip_text', true )=="true") : ?>
				<p>
					<strong><?php _e('Date Round Trip: ', 'stern_taxi_fare'); ?> </strong><?php echo $dateTimePickUpRoundTrip; ?>
				</p>
			<?php endif; ?>
			<?php new qrCode($order_id); ?>		
			
			
	
			
			<?php if($isInAdmin) : ?>
				<p>
					<strong><?php _e('id Calendar: ', 'stern_taxi_fare'); ?> </strong><?php echo $idCalendar; ?>
				</p>
				<p>
					<strong><?php _e('id Calendar Round Trip: ', 'stern_taxi_fare'); ?> </strong><?php echo $idCalendarRoundTrip; ?>
				</p>
			<?php endif; ?>
				
		<?php
			
		} else {
			
			
			$distanceHtml = get_post_meta( $order_id , '_distanceHtml', true );
			$durationHtml = get_post_meta( $order_id , '_durationHtml', true );
			$estimated_fare = get_post_meta($order_id , '_estimated_fare', true );
			$cartypes = get_post_meta( $order_id , '_cartypes', true );
			$source = get_post_meta( $order_id , '_source', true );
			$destination = get_post_meta( $order_id , '_destination', true );
			$car_seats = get_post_meta( $order_id , '_car_seats', true );
			$dateTimePickUp = date(getFormatDateTime("php"),strtotime(get_post_meta( $order_id , '_local_pickup_time_select', true )));
			$dateTimePickUpRoundTrip = date(getFormatDateTime("php"),strtotime(get_post_meta( $order_id , '_dateTimePickUpRoundTrip', true )));
			$nbToll = get_post_meta( $order_id , '_nbToll', true );
			$numberOfPets = get_post_meta( $order_id , '_NumberOfPets', true );
			$suitcases = get_post_meta( $order_id , '_suitcases', true );
			$stern_taxi_fare_round_trip_text = (get_post_meta( $order_id , '_stern_taxi_fare_round_trip_text', true )=="true") ? __('Round Trip', 'stern_taxi_fare') : __('One way', 'stern_taxi_fare') ;
			
			

			

			?>
			
			
			<?php new qrCode($order_id); ?>
			<h2><?php _e('Your trip', 'stern_taxi_fare' ); ?></h2>
			
			<div class="row">

				
					
				<div class="col-xs-12 col-sm-6 col-lg-4">
					<label><?php _e( 'Pickup Time', 'stern_taxi_fare' ); ?></label>
					<input name="dateEstimatedPickedUp" type="text" class="input-text" readonly value="<?php echo $dateTimePickUp; ?>">
					<input name="timeEstimatedPickedUp" type="hidden" class="input-text" readonly value="">			
				</div>
					
					
				
				<div class="col-xs-12 col-sm-6 col-lg-4">
					<label><?php _e('Distance', 'stern_taxi_fare'); ?></label><input type="text" class="input-text" readonly value="<?php echo $distanceHtml; ?>">
				</div>
				
				<div class="col-xs-12 col-sm-6 col-lg-4">
					<label><?php _e('Duration', 'stern_taxi_fare'); ?></label><input type="text" class="input-text" readonly value="<?php echo $durationHtml; ?>">
				</div>	


				<div class="col-xs-12 col-sm-6 col-lg-4" style="<?php echo (get_option('stern_taxi_fare_show_dropdown_typecar')!="false") ? "" : "display:none;"; ?>">
					<label><?php _e('Car type', 'stern_taxi_fare'); ?></label><input type="text" class="input-text" readonly value="<?php echo $cartypes; ?>">
				</div>
				
				<?php if($nbToll !="") : ?>
					<div class="col-xs-12 col-sm-6 col-lg-4" style="<?php echo (get_option('stern_taxi_fare_show_tolls_in_form')!="false") ? "" : "display:none;"; ?>">
						<label><?php _e('Number of Tolls', 'stern_taxi_fare'); ?></label><input type="text" class="input-text" readonly value="<?php echo $nbToll; ?>">
					</div>
				<?php endif; ?>	

				<div class="col-xs-12 col-sm-6 col-lg-4" style="<?php echo (get_option('stern_taxi_fare_show_seat_input')!="false") ? "" : "display:none;"; ?>">
					<label><?php _e('Seats', 'stern_taxi_fare'); ?></label><input type="text" class="input-text" readonly value="<?php echo $car_seats; ?>">
				</div>
				
				<?php if(get_option('stern_taxi_fare_show_suitcases_in_form')!="false") : ?>
					<div class="col-xs-12 col-sm-6 col-lg-4">
						<label><?php _e('Suitcases', 'stern_taxi_fare'); ?></label><input type="text" class="input-text" readonly value="<?php echo $suitcases; ?>">
					</div>
				<?php endif; ?>	
				
				<?php if($numberOfPets !="") : ?>
					<div class="col-xs-12 col-sm-6 col-lg-4">
						<label><?php _e('Number Of Pets', 'stern_taxi_fare'); ?></label><input type="text" class="input-text" readonly value="<?php echo $numberOfPets; ?>">
					</div>		
				<?php endif; ?>
				

				<div class="col-xs-12 col-sm-6 col-lg-4">
					<label><?php _e('Source', 'stern_taxi_fare'); ?></label><input type="text" class="input-text" readonly value="<?php echo $source; ?>">
				</div>

				
				<div class="col-xs-12 col-sm-6 col-lg-4">
					<label><?php _e('Destination', 'stern_taxi_fare'); ?></label><input type="text" class="input-text" readonly value="<?php echo $destination; ?>">
				</div>

				<div class="col-xs-12 col-sm-6 col-lg-4">
					<label><?php _e('Round trip?', 'stern_taxi_fare'); ?></label><input type="text" class="input-text" readonly value="<?php echo $stern_taxi_fare_round_trip_text; ?>">
				</div>
				
				<?php if(get_post_meta( $order_id , '_stern_taxi_fare_round_trip_text', true )=="true") : ?>
					<div class="col-xs-12 col-sm-6 col-lg-4">
						<label><?php _e('Pickup Time for Round Trip', 'stern_taxi_fare'); ?></label><input type="text" class="input-text" readonly value="<?php echo $dateTimePickUpRoundTrip; ?>">
					</div>		
				<?php endif; ?>

				
				
			
				<?php

				
				if (get_option('stern_taxi_fare_show_map_checkout') ==true) {
					$apiGoogleKey = get_option('stern_taxi_fare_apiGoogleKey');
					$iframeGmap = "<iframe  width='100%'   height='350' ";
					$iframeGmap .= "frameborder='0' style='border:0'  ";
					$iframeGmap .= "src='https://www.google.com/maps/embed/v1/directions?key=" . $apiGoogleKey ;
					$iframeGmap .= "&origin=" . $source;
					$iframeGmap .= "&destination=" . $destination ;
					$iframeGmap .= "&avoid=tolls|highways' allowfullscreen></iframe>";
					echo $iframeGmap;
				}
				?>
			</div>
			<br><br>
			<?php
		}
	}
}
<?php

Class checkoutEmail{
	function __construct($order_id){
		
		if(!isProductTaxiIsInCart($order_id)) {
			return;
		}
		
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
		$dateTimePickUpRoundTrip = get_post_meta( $order_id , '_dateTimePickUpRoundTrip', true );
		$stern_taxi_fare_round_trip = (get_post_meta( $order_id , '_stern_taxi_fare_round_trip', true )=="true") ? __('Round Trip', 'stern_taxi_fare') : __('One way', 'stern_taxi_fare') ;
		$suitcases = get_post_meta( $order_id , '_suitcases', true );
		
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
			<strong><?php _e('Round trip: ', 'stern_taxi_fare'); ?> </strong><?php echo $stern_taxi_fare_round_trip; ?>
		</p>
		<?php if(get_post_meta( $order_id , '_stern_taxi_fare_round_trip', true )=="true") : ?>
			<p>
				<strong><?php _e('Date Round Trip: ', 'stern_taxi_fare'); ?> </strong><?php echo $dateTimePickUpRoundTrip; ?>
			</p>
		<?php endif; ?>
		<?php new qrCode($order_id); ?>

	<?php
	}
}
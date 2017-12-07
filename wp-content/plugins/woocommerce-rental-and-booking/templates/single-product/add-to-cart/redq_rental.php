<?php
/**
 * Redq rental product add to cart
 *
 * @author 		redq-team
 * @package 	RedqTeam/Templates
 * @version     1.0.0
 * @since       1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $woocommerce, $product, $post;

?>

<?php 
	$show_local_pricing_flip_box = get_post_meta(get_the_ID(),'redq_rental_local_show_pricing_flip_box',true);

	if($show_local_pricing_flip_box === 'open'){
		$show_pricing_flip_box = true;
	}else{
		$show_pricing_flip_box = false;
	}
?>

<?php if(isset($show_pricing_flip_box) && !empty($show_pricing_flip_box)) :  ?>
<div class="price-showing" style="margin-bottom: 100px;">
	<div class="front">
		<div class="notice">
			<h3><?php _e('show pricing','redq-rental'); ?></h3>
		</div>
	</div>
	<div class="back">
		<div class="item-pricing">
			<h5><?php _e('Pricing Plans','redq-rental'); ?></h5>
			<?php $pricing_type = $product->redq_get_pricing_type(get_the_ID()); ?>

			<?php if($pricing_type === 'days_range'): ?>
				<?php $pricing_plans = $product->redq_get_day_ranges_pricing(get_the_ID()); ?>
				<?php foreach ($pricing_plans as $key => $value) { ?>
					<div class="day-ranges-pricing-plan">
						<span class="range-days"><?php echo esc_attr($value['min_days']); ?> - <?php echo esc_attr($value['max_days']); ?> <?php _e('days:','redq-rental'); ?> </span>
						<span class="range-price"><strong><?php echo wc_price($value['range_cost']); ?></strong> <?php _e('/ day','redq-rental'); ?></span>
						<?php if(isset($value['discount_type']) && !empty($value['discount_type'])): ?>	
						<span>
							<?php _e('( Discount - ','redq-rental'); ?> 
								<?php if($value['discount_type'] === 'percentage'): ?>
									<?php echo esc_attr($value['discount_amount']) ?><?php _e('%','redq-rental'); ?> 
								<?php else: ?>
									<?php echo wc_price(esc_attr($value['discount_amount'])); ?>
								<?php endif; ?>
							<?php _e(')','redq-rental'); ?>
						</span>
						<?php endif; ?>
					</div>
				<?php } ?>
			<?php endif; ?>

			<?php if($pricing_type === 'daily_pricing'): ?>
				<?php 
					$daily_pricing = $product->redq_get_daily_pricing(get_the_ID());				
					$daily_pricing = $product->redq_translate_keys('daily_pricing',$daily_pricing); 
				?>	
				<?php foreach ($daily_pricing as $key => $value) { ?>
					<div class="day-ranges-pricing-plan">
						<span class="day"><?php echo esc_attr(ucfirst($key));  ?> </span>
						<span class="day-price"><strong> - <?php echo wc_price($value); ?></strong></span>
					</div>
				<?php } ?>
			<?php endif; ?>

			<?php if($pricing_type === 'monthly_pricing'): ?>
				<?php 
					$monthly_pricing = $product->redq_get_monthly_pricing(get_the_ID()); 
					$monthly_pricing = $product->redq_translate_keys('monthly_pricing',$monthly_pricing); 
				?>
				<?php foreach ($monthly_pricing as $key => $value) { ?>
					<div class="day-ranges-pricing-plan">
						<span class="month"><?php echo ucfirst($key); ?> </span>
						<span class="month-price"><strong> - <?php echo wc_price($value); ?></strong></span>
					</div>
				<?php } ?>
			<?php endif; ?>
		</div>
	</div>
</div>
<?php endif; ?>



<?php do_action( 'woocommerce_before_add_to_cart_form' ); ?>

<form class="cart" method="post" enctype='multipart/form-data'>


	<?php		
 		// if ( ! $product->is_sold_individually() ) {
 		// 	woocommerce_quantity_input( array(
 		// 		'min_value'   => apply_filters( 'rnb_quantity_input_min', 1, $product ),
 		// 		'max_value'   => apply_filters( 'rnb_quantity_input_max', $product->get_stock_quantity(), $product ),
 		// 		'input_value' => ( isset( $_POST['quantity'] ) ? wc_stock_amount( $_POST['quantity'] ) : 1 )
 		// 	) );
 		// }
 	?>


	<?php $pick_up_locations = $product->redq_get_rental_payable_attributes('pickup_location');  ?>

	<?php if(isset($pick_up_locations) && !empty($pick_up_locations)): ?>
	<div class="redq-pick-up-location">
		<?php
			$local_pickup_location_title = get_post_meta(get_the_ID(),'redq_pickup_location_heading_title',true);
			$global_pickup_location_title = get_option('redq_rental_global_pickup_location_title'); 
		?>		
		<h5>
			<?php 
				if(isset($local_pickup_location_title) && !empty($local_pickup_location_title)){
			 		echo esc_attr($local_pickup_location_title);
				}elseif(isset($global_pickup_location_title) && !empty($global_pickup_location_title)){
					echo esc_attr($global_pickup_location_title);
				}else{ ?>
					<?php _e('Pickup Locations','redq-rental'); ?>
				<?php }
			?>			
		</h5>

		<select class="redq-select-boxes pickup_location" name="pickup_location" data-placeholder="<?php _e('- Select pick-up city -','redq-rental'); ?>">
			<option value=""><?php _e('- Select pick-up location -','redq-rental'); ?></option>
			<?php foreach ($pick_up_locations as $key => $value) { ?>
				<option value="<?php echo esc_attr($value['address']); ?>|<?php echo esc_attr($value['title']); ?>|<?php echo esc_attr($value['cost']); ?>" data-pickup-location-cost= "<?php echo esc_attr($value['cost']); ?>"><?php echo esc_attr($value['title']); ?></option>
			<?php } ?>
		</select>
	</div>
	<?php endif; ?>



	<?php $drop_off_locations = $product->redq_get_rental_payable_attributes('dropoff_location');	?>

	<?php if(isset($drop_off_locations) && !empty($drop_off_locations)): ?>
	<div class="redq-drop-off-location">
		<?php
			$local_dropoff_location_title = get_post_meta(get_the_ID(),'redq_dropoff_location_heading_title',true);
			$global_dropoff_location_title = get_option('redq_rental_global_return_location_title'); 
		?>		
		<h5>
			<?php 
				if(isset($local_dropoff_location_title) && !empty($local_dropoff_location_title)){
			 		echo esc_attr($local_dropoff_location_title);
				}elseif(isset($global_dropoff_location_title) && !empty($global_dropoff_location_title)){
					echo esc_attr($global_dropoff_location_title);
				}else{ ?>
					<?php _e('Drop-off Locations','redq-rental'); ?>
				<?php }
			?>			
		</h5>
		<select class="redq-select-boxes dropoff_location" name="dropoff_location" data-placeholder="<?php _e('- Select drop-off city -','redq-rental'); ?>">
			<option value=""><?php _e('- Select drop-off location -','redq-rental'); ?></option>
			<?php foreach ($drop_off_locations as $key => $value) { ?>
				<option value="<?php echo esc_attr($value['address']); ?>|<?php echo esc_attr($value['title']); ?>|<?php echo esc_attr($value['cost']); ?>" data-dropoff-location-cost= "<?php echo esc_attr($value['cost']); ?>"><?php echo esc_attr($value['title']); ?></option>
			<?php } ?>
		</select>
	</div>
	<?php endif; ?>


	<div class="distance">
		<?php
        $local_pickup_datetime_title = get_post_meta(get_the_ID(),'redq_pickup_date_heading_title',true);
        $local_pickup_date_placeholder = get_post_meta(get_the_ID(),'redq_pickup_date_placeholder',true);
        $local_pickup_time_placeholder = get_post_meta(get_the_ID(),'redq_pickup_time_placeholder',true);
        $global_pickup_datetime_title = get_option('redq_rental_global_pickup_date_title'); 
		
        $show_local_pickup_date = get_post_meta(get_the_ID(),'redq_rental_local_show_pickup_date',true);
        $show_global_pickup_date = get_option('redq_rental_global_show_pickup_date');

        if($show_local_pickup_date === 'open'){
            $show_pickup_date = true;
        }else{
            $show_pickup_date = false;
        }
        ?>

	
        <!-- DISTANCE PRICING -->
        <?php if($pricing_type === 'distance_pricing'): ?>

		<h5>
			Distance parcourue	
		</h5>

		<span class="pick-up-date-picker">
			<input type="text" name="tb-distance" id="tb-distance" placeholder="Distance" value="">
		</span>
		
        <?php endif; ?>



	</div>


	<div class="date-time-picker">
		<?php
			$local_pickup_datetime_title = get_post_meta(get_the_ID(),'redq_pickup_date_heading_title',true);
			$local_pickup_date_placeholder = get_post_meta(get_the_ID(),'redq_pickup_date_placeholder',true);
			$local_pickup_time_placeholder = get_post_meta(get_the_ID(),'redq_pickup_time_placeholder',true);
			$global_pickup_datetime_title = get_option('redq_rental_global_pickup_date_title'); 
		
			$show_local_pickup_date = get_post_meta(get_the_ID(),'redq_rental_local_show_pickup_date',true);
			$show_global_pickup_date = get_option('redq_rental_global_show_pickup_date');

			if($show_local_pickup_date === 'open'){
				$show_pickup_date = true;
			}else{
				$show_pickup_date = false;
			}
		?>

	
		<?php if(isset($show_pickup_date) && !empty($show_pickup_date)): ?>
		
		<h5>
			<?php 
				if(isset($local_pickup_datetime_title) && !empty($local_pickup_datetime_title)){
			 		echo esc_attr($local_pickup_datetime_title);
				}elseif(isset($global_pickup_datetime_title) && !empty($global_pickup_datetime_title)){
					echo esc_attr($global_pickup_datetime_title);
				}else{ ?>
					<?php _e('Pickup Date & Time','redq-rental'); ?>
				<?php }
			?>			
		</h5>

		<span class="pick-up-date-picker">
			<i class="fa fa-calendar"></i>
			<input type="text" name="pickup_date" id="pickup-date" placeholder="<?php echo esc_attr($local_pickup_date_placeholder); ?>" value="">
		</span>
		<?php endif; ?>
		
		<?php 
			$show_local_pickup_time = get_post_meta(get_the_ID(),'redq_rental_local_show_pickup_time',true);
			$show_global_pickup_time = get_option('redq_rental_global_show_pickup_time');

			if($show_local_pickup_time === 'open'){
				$show_pickup_time = true;
			}else{
				$show_pickup_time = false;
			}
		?>

		<?php if(isset($show_pickup_time) && !empty($show_pickup_time)): ?>
		<span class="pick-up-time-picker">
			<i class="fa fa-clock-o"></i>
			<input type="text" name="pickup_time" id="pickup-time" placeholder="<?php echo esc_attr($local_pickup_time_placeholder); ?>" value="">
		</span>
		<?php endif; ?>

	</div>

	<div class="date-time-picker">
		<?php
			$local_dropoff_datetime_title = get_post_meta(get_the_ID(),'redq_dropoff_date_heading_title',true);
			$local_dropoff_date_placeholder = get_post_meta(get_the_ID(),'redq_dropoff_date_placeholder',true);
			$local_dropoff_time_placeholder = get_post_meta(get_the_ID(),'redq_dropoff_time_placeholder',true);
			$global_dropoff_datetime_title = get_option('redq_rental_global_return_date_title'); 
		
			$show_local_dropoff_date = get_post_meta(get_the_ID(),'redq_rental_local_show_dropoff_date',true);
			$show_global_dropoff_date = get_option('redq_rental_global_show_dropoff_date');

			if($show_local_dropoff_date === 'open'){
				$show_dropoff_date = true;
			}else{
				$show_dropoff_date = false;
			}
		?>

		<?php if(isset($show_dropoff_date) && !empty($show_dropoff_date)): ?>
		<h5>
			<?php 
				if(isset($local_dropoff_datetime_title) && !empty($local_dropoff_datetime_title)){
			 		echo esc_attr($local_dropoff_datetime_title);
				}else{ ?>
					<?php _e('Drop-off Date & Time','redq-rental'); ?>
				<?php }
			?>			
		</h5>
		<span class="drop-off-date-picker">
			<i class="fa fa-calendar"></i>
			<input type="text" name="dropoff_date" id="dropoff-date" placeholder="<?php echo esc_attr($local_dropoff_date_placeholder); ?>" value="">
		</span>
		<?php endif; ?>

		<?php 
			$show_local_dropoff_time = get_post_meta(get_the_ID(),'redq_rental_local_show_dropoff_time',true);
			$show_global_dropoff_time = get_option('redq_rental_global_show_dropoff_time');

			if($show_local_dropoff_time === 'open'){
				$show_dropoff_time = true;
			}else{
				$show_dropoff_time = false;
			}
		?>
		<?php if(isset($show_dropoff_time) && !empty($show_dropoff_time)): ?>
		<span class="drop-off-time-picker">
			<i class="fa fa-clock-o"></i>
			<input type="text" name="dropoff_time" id="dropoff-time" placeholder="<?php echo esc_attr($local_dropoff_time_placeholder); ?>" value="">
		</span>
		<?php endif; ?>
	</div>


	<?php $resources = $product->redq_get_rental_payable_attributes('resource');	?>

	<?php if(isset($resources) && !empty($resources)): ?>
	<div class="payable-extras">
		<?php
			$local_resources_title = get_post_meta(get_the_ID(),'redq_resources_heading_title',true);
			$global_resources_title = get_option('redq_rental_global_resources_title'); 
		?>		
		<h5>
			<?php 
				if(isset($local_resources_title) && !empty($local_resources_title)){
			 		echo esc_attr($local_resources_title);
				}elseif(isset($global_resources_title) && !empty($global_resources_title)){
					echo esc_attr($global_resources_title);
				}else{ ?>
					<?php _e('Resources','redq-rental'); ?>
				<?php }
			?>			
		</h5>
		<?php foreach ($resources as $key => $value) { ?>
			<div class="attributes">
				<label class="custom-block">
					<?php $dta = array(); $dta['name'] = $value['resource_name']; $dta['cost'] = $value['resource_cost'];  ?>
					<input type="checkbox" name="extras[]" value = "<?php echo esc_attr($value['resource_name']); ?>|<?php echo esc_attr($value['resource_cost']); ?>|<?php echo esc_attr($value['resource_applicable']); ?>|<?php echo esc_attr($value['resource_hourly_cost']); ?>" data-name="<?php echo esc_attr($value['resource_name']); ?>" data-value-in="0" data-applicable="<?php echo esc_attr($value['resource_applicable']); ?>" data-value="<?php echo esc_attr($value['resource_cost']); ?>" data-hourly-rate="<?php echo esc_attr($value['resource_hourly_cost']); ?>" data-currency-before="$" data-currency-after="" class="carrental_extras">
					<?php echo esc_attr($value['resource_name']); ?>

					<?php if($value['resource_applicable'] == 'per_day'){ ?>
						<span class="pull-right show_if_day"><?php echo wc_price($value['resource_cost']); ?><span><?php _e(' - Per Day'); ?></span></span>
						<span class="pull-right show_if_time"><?php echo wc_price($value['resource_hourly_cost']); ?><?php _e(' - Per Hour','redq-rental'); ?></span>
					<?php }else{ ?>
						<span class="pull-right"><?php echo wc_price($value['resource_cost']); ?><?php _e(' - One Time','redq-rental'); ?></span>
					<?php } ?>
				</label>
			</div>
		<?php } ?>
	</div>
	<?php endif; ?>



	<?php $person_cost = $product->redq_get_rental_payable_attributes('person');	?>

	<?php if(isset($person_cost) && !empty($person_cost)): ?>
	<div class="additional-person">
		<?php
			$local_person_title = get_post_meta(get_the_ID(),'redq_person_heading_title',true);
			$local_person_placeholder = get_post_meta(get_the_ID(),'redq_person_placeholder',true);
			$global_person_title = get_option('redq_rental_global_person_title'); 
		?>		
		<h5>
			<?php 
				if(isset($local_person_title) && !empty($local_person_title)){
			 		echo esc_attr($local_person_title);
				}elseif(isset($global_person_title) && !empty($global_person_title)){
					echo esc_attr($global_person_title);
				}else{ ?>
					<?php _e('Additional Person','redq-rental'); ?>
				<?php }
			?>			
		</h5>
		<select class="additional_person_info redq-select-boxes" name="additional_person_info" data-placeholder="<?php echo esc_attr($local_person_placeholder); ?>">
			<option value=""><?php echo esc_attr($local_person_placeholder); ?></option>
			<?php foreach ($person_cost as $key => $value) { ?>
				<?php if($value['person_cost_applicable'] == 'per_day'){ ?>
					<option class="show_person_cost_if_day" value="<?php echo esc_attr($value['person_count']); ?>|<?php echo esc_attr($value['person_cost']); ?>|<?php echo esc_attr($value['person_cost_applicable']); ?>|<?php echo esc_attr($value['person_hourly_cost']); ?>" data-person_cost= "<?php echo esc_attr($value['person_cost']); ?>" data-person_count="<?php echo esc_attr($value['person_count']); ?>" data-applicable="<?php echo esc_attr($value['person_cost_applicable']); ?>"><?php _e('Person - ','redq-rental'); ?><?php echo esc_attr($value['person_count']); ?><?php if(isset($value['person_cost']) && !empty($value['person_cost'])): ?><?php _e(' :  Cost - ','redq-rental'); ?><?php echo wc_price($value['person_cost']); ?><?php _e(' - Per day','redq-rental'); ?><?php endif; ?></option>
					<option class="show_person_cost_if_time" style="display: none;" value="<?php echo esc_attr($value['person_count']); ?>|<?php echo esc_attr($value['person_cost']); ?>|<?php echo esc_attr($value['person_cost_applicable']); ?>|<?php echo esc_attr($value['person_hourly_cost']); ?>" data-person_cost= "<?php echo esc_attr($value['person_hourly_cost']); ?>" data-person_count="<?php echo esc_attr($value['person_count']); ?>" data-applicable="<?php echo esc_attr($value['person_cost_applicable']); ?>"><?php _e('Person - ','redq-rental'); ?><?php echo esc_attr($value['person_count']); ?><?php if(isset($value['person_cost']) && !empty($value['person_cost'])): ?><?php _e(' :  Cost - ','redq-rental'); ?><?php echo wc_price($value['person_hourly_cost']); ?><?php _e(' - Per hour','redq-rental'); ?><?php endif; ?></option>
				<?php }else{ ?>
					<option value="<?php echo esc_attr($value['person_count']); ?>|<?php echo esc_attr($value['person_cost']); ?>|<?php echo esc_attr($value['person_cost_applicable']); ?>|<?php echo esc_attr($value['person_hourly_cost']); ?>" data-person_cost= "<?php echo esc_attr($value['person_cost']); ?>" data-person_count="<?php echo esc_attr($value['person_count']); ?>" data-applicable="<?php echo esc_attr($value['person_cost_applicable']); ?>"><?php _e('Person - ','redq-rental'); ?><?php echo esc_attr($value['person_count']); ?><?php if(isset($value['person_cost']) && !empty($value['person_cost'])): ?><?php _e(' :  Cost - ','redq-rental'); ?><?php echo wc_price($value['person_cost']); ?><?php _e(' - One time','redq-rental'); ?><?php endif; ?></option>
				<?php } ?>
			<?php } ?>
		</select>
	</div>
	<?php endif; ?>


	<?php  $security_deposites = $product->redq_get_rental_payable_attributes('deposite');	?>

	<?php if(isset($security_deposites) && !empty($security_deposites)): ?>
	<div class="payable-security_deposites">
		<?php
			$local_deposite_title = get_post_meta(get_the_ID(),'redq_security_deposite_heading_title',true);
			$global_deposite_title = get_option('redq_rental_global_deposite_title'); 
		?>		
		<h5>
			<?php 
				if(isset($local_deposite_title) && !empty($local_deposite_title)){
			 		echo esc_attr($local_deposite_title);
				}elseif(isset($global_deposite_title) && !empty($global_deposite_title)){
					echo esc_attr($global_deposite_title);
				}else{ ?>
					<?php _e('Security Deposites','redq-rental'); ?>
				<?php }
			?>			
		</h5>
		<?php foreach ($security_deposites as $key => $value) { ?>
			<div class="attributes">
				<label class="custom-block">
					<?php $dta = array(); $dta['name'] = $value['security_deposite_name']; $dta['cost'] = $value['security_deposite_cost'];  ?>
					<input type="checkbox" <?php if($value['security_deposite_clickable'] === 'no'){ ?> checked onclick="return false" <?php } ?> name="security_deposites[]" value = "<?php echo esc_attr($value['security_deposite_name']); ?>|<?php echo esc_attr($value['security_deposite_cost']); ?>|<?php echo esc_attr($value['security_deposite_applicable']); ?>|<?php echo esc_attr($value['security_deposite_hourly_cost']); ?>" data-name="<?php echo esc_attr($value['security_deposite_name']); ?>" data-value-in="0" data-applicable="<?php echo esc_attr($value['security_deposite_applicable']); ?>" data-value="<?php echo esc_attr($value['security_deposite_cost']); ?>" data-hourly-rate="<?php echo esc_attr($value['security_deposite_hourly_cost']); ?>" data-currency-before="$" data-currency-after="" class="carrental_extras" />
					<?php echo esc_attr($value['security_deposite_name']); ?>
					<?php if($value['security_deposite_applicable'] == 'per_day'){ ?>
						<span class="pull-right show_if_day"><?php echo wc_price($value['security_deposite_cost']); ?><span> <?php _e(' - Per Day', 'redq-rental'); ?> </span></span>
						<span class="pull-right show_if_time" style="display: none;"><?php echo wc_price($value['security_deposite_hourly_cost']); ?><?php _e(' - Per Hour', 'redq-rental'); ?></span>
					<?php }else{ ?>
						<span class="pull-right"><?php echo wc_price($value['security_deposite_cost']); ?><?php _e(' - One Time', 'redq-rental'); ?></span>
					<?php } ?>
				</label>
			</div>
		<?php } ?>
	</div>
	<?php endif; ?>



	<input type="hidden" name="currency-symbol" class="currency-symbol" value="<?php echo get_woocommerce_currency_symbol(); ?>">
		
	<div class="booking-pricing-info" style="display: none">
		<?php 
			$pre_payment_percentage = get_option('redq_rental_global_pre_payment');
			$show_price_discount_on_days = get_post_meta(get_the_ID(),'redq_rental_local_show_price_discount_on_days',true);
			$show_price_instance_payment = get_post_meta(get_the_ID(),'redq_rental_local_show_price_instance_payment',true);
		?>

		<?php if(isset($show_price_discount_on_days) && $show_price_discount_on_days === 'open'): ?>
		<p class="discount-rate"><?php _e('Discount Depend on Booking Days :','redq-rental'); ?> <span style="float: right;"></span></p>
		<?php endif; ?>
		<?php if(isset($show_price_instance_payment) && $show_price_instance_payment === 'open'): ?>	
		<p class="pre-payment"><?php _e('Instance Pay During Booking : ','redq-rental'); ?><span style="float: right;"><?php echo esc_attr($pre_payment_percentage); ?>%</span></p>
		<?php endif; ?>	
		
		<h3 class="booking_cost"><?php _e('Total Booking Cost : ','redq-rental'); ?><span style="float: right;"></span></h3>
	</div>	

	<?php 
		$book_now_button_text = get_post_meta(get_the_ID(),'redq_book_now_button_text',true);
		$rfq_button_text = get_post_meta(get_the_ID(),'redq_rfq_button_text',true);  
	?>	

	<?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>
	<input type="hidden" class="product_id" name="add-to-cart" value="<?php echo esc_attr( $product->id ); ?>" />

	<?php
	    $show_book_now_local = get_post_meta($product->id,'redq_rental_local_show_book_now',true);
	    if( empty( $show_book_now_local ) ) {
	      	$hide_book_now_global = get_option('redq_rental_global_hide_book_now', true);
	      	if( $hide_book_now_global !== 'yes' ) {
	        	$show_book_now = 'closed';
	      	} else {
	        	$show_book_now = 'open';
	      	}
	    } else {
	      	$show_book_now = $show_book_now_local;
	    }
	    if( $show_book_now === 'open' ) {
	?>

	<button type="submit" class="single_add_to_cart_button redq_add_to_cart_button btn-book-now button alt"><?php echo esc_attr($book_now_button_text); ?></button>
  	<?php } ?>


	<?php
		$show_request_quote_local = get_post_meta($product->id,'redq_rental_local_show_request_quote',true);
		if( empty( $show_request_quote_local ) ) {
			$show_request_quote_global = get_option('redq_rental_global_show_request_quote', true);
			if( $show_request_quote_global === 'yes' ) {
				$show_quote = 'open';
			} else {
				$show_quote = 'closed';
			}
		} else {
			$show_quote = $show_request_quote_local;
		}

		if( $show_quote === 'open' ) {
		$customer_first_name = '';
		$customer_last_name = '';
		$customer_phone = '';
		$customer_email = '';
		if( is_user_logged_in() ) {
			global $current_user;

			$customer_first_name = get_user_meta($current_user->ID, 'billing_first_name', true);
			$customer_last_name = get_user_meta($current_user->ID, 'billing_last_name', true);
			$customer_phone = get_user_meta($current_user->ID, 'billing_phone', true);
			$customer_email = get_user_meta($current_user->ID, 'billing_email', true);
		}
	?>
    <button id="quote-content-confirm" class="redq_request_for_a_quote btn-book-now button"><?php echo esc_attr($rfq_button_text); ?></button>
	<div id="quote-popup" class="white-popup mfp-hide">
		<?php if( !is_user_logged_in() ) : ?>
		<p>
			<input type="text" name="quote-username" id="quote-username" placeholder="<?php esc_html_e('Username') ?>" value="" required="true" />
		</p>
		<p>
			<input type="password" name="quote-password" id="quote-password" placeholder="<?php esc_html_e('Password') ?>" value="" required="true" />
		</p>
		<?php endif ?>
		<p>
			<input type="text" name="quote-first-name" id="quote-first-name" placeholder="<?php esc_html_e('First Name') ?>" value="<?php echo esc_attr($customer_first_name) ?>" required="true" />
		</p>
		<p>
			<input type="text" name="quote-last-name" id="quote-last-name" placeholder="<?php esc_html_e('Last Name') ?>" value="<?php echo esc_attr($customer_last_name) ?>" required="true" />
		</p>
		<p>
			<input type="email" name="quote-email" id="quote-email" placeholder="<?php esc_html_e('Email') ?>" value="<?php echo esc_attr($customer_email) ?>" required="true" />
		</p>
		<p>
			<input type="text" name="quote-phone" id="quote-phone" placeholder="<?php esc_html_e('Phone') ?>" value="<?php echo esc_attr($customer_phone) ?>" required="true" />
		</p>
		<p>
			<textarea name="quote-message" id="quote-message" placeholder="<?php esc_html_e('Message') ?>"></textarea>
		</p>
		<p><button class="quote-submit"><?php esc_html_e('Submit', 'redq-rental') ?><i class="fa fa-spinner fa-pulse fa-fw"></i></button></p>
		<div class="quote-modal-message"></div>
	</div>
  	<?php } // end quote enabled ?>

	<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>

</form>

<?php do_action( 'woocommerce_after_add_to_cart_form' ); ?>




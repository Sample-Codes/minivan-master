<?php
function showRoundTrip($class_full_row,$class) {	
			

			?>



			<?php $display = (get_option('stern_taxi_fare_round_trip')=='false') ? "display:none;" : ""; ?>
			
		
			<div <?php echo $class_full_row; ?> style="padding-top: 15px;<?php echo $display ?>">
				<?php if (showlabel()) : ?>
					<label for="stern_taxi_fare_round_trip"><?php _e('Round Trip', 'stern_taxi_fare'); ?></label>
				<?php endif; ?>
				<select name="stern_taxi_fare_round_trip" id="stern_taxi_fare_round_trip" class="<?php echo $class; ?>" data-width="100%" style="padding-left: 15px; float: right;">
					<optgroup id="roundTrip" label="<?php _e('Round Trip', 'stern_taxi_fare'); ?>">												
						<option data-icon='glyphicon-arrow-right' value="false"> <?php _e('One Way', 'stern_taxi_fare'); ?></option>
						<option data-icon='glyphicon-random' value="true"> <?php _e('Return', 'stern_taxi_fare'); ?></option>												
					</optgroup>
				</select>										
			</div>	

<?php
	
}										
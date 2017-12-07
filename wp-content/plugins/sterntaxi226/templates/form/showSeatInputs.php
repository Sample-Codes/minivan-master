<?php
function showSeatInputs1($class_full_row,$class) {
	
	if(get_option('stern_taxi_fare_show_seat_input') =="false") {
		$visibility = "display: none;";
	} else {
		$visibility = "";
	}	

	?>
	<div <?php echo $class_full_row; ?> style="padding-top: 15px;<?php echo $visibility ?>">

	
		<?php if (showlabel()) : ?>
			<label for="baby_count"><?php _e('Seats', 'stern_taxi_fare'); ?></label>
		<?php endif; ?>
		

		
		<select name="baby_count" id="baby_count" class="<?php echo $class; ?>" data-width="100%" style="padding-left: 15px; float: right;">
			<optgroup id="labelSeats" label="<?php _e('Seats', 'stern_taxi_fare'); ?>">
				<?php 

				
				for ($i = 1; $i <= getMaxCarSeatfromAllCarType() ; $i++) {
				
					?>
					<option data-icon='glyphicon-user' value='<?php echo $i; ?>'><?php echo $i; ?></option>
					<?php
				}
				
				?>
				
			</optgroup>
		</select>										
	</div>
<?php
	
}										
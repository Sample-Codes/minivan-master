<?php
function showBabySeatInputs($class_full_row,$class) {

	?>
	<div <?php echo $class_full_row; ?> style="padding-top: 15px;">

	
		<?php if (showlabel()) : ?>
			<label for="baby_seat"><?php _e('Baby Seats', 'stern_taxi_fare'); ?></label>
		<?php endif; ?>
		

		
		<select name="BabySeat" id="BabySeat" class="<?php echo $class; ?>" data-width="100%" style="padding-left: 15px; float: right;">
			<optgroup id="labelBabySeat" label="<?php _e('Baby Seats', 'stern_taxi_fare'); ?>">

			
				
			</optgroup>
		</select>										
	</div>
<?php
	
}										
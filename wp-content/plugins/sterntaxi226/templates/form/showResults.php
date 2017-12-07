<?php
function showResults($classMain,$backgroundColor) {
	
?>	
<?php if(get_option('stern_taxi_fare_show_position_price') !="true") : ?>
		
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="resultRightMain" style="display: inline-block;padding-top: 20px;">
		<div id="resultText"  style="display: none;<?php echo $backgroundColor; ?>;">
			<div class="row">

				<?php showDistanceInForm($classMain); 		?>
				<?php showTollInForm($classMain); 			?>
				<?php showDurationInForm($classMain); 		?>
				<?php showSuicasesInForm($classMain); 		?>
				<?php showSuicasesSmallInForm($classMain); 	?>				
				<?php showFareInForm($classMain); 			?>												

			</div>		
		</div>
	</div>	


<?php else: ?>
	<?php 
		$classMain =  "class='col-lg-12 col-md-12 col-sm-12 col-xs-12'";
	?>
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="resultRightMain" style="display: inline-block;padding-top: 20px;">
		<div id="resultText"  style="display: none;<?php echo $backgroundColor; ?>;">
			<div class="row">
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6" id="resultText1">
					<?php showDistanceInForm($classMain); 	?>
					<?php showTollInForm($classMain); 		?>
					<?php showDurationInForm($classMain); 	?>
					<?php showSuicasesInForm($classMain); 	?>
					<?php showSuicasesSmallInForm($classMain); 	?>	
				</div>				
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">			
					<?php showFareInForm($classMain); 		?>	
				</div>																	
			</div>		
		</div>
	</div>		
<?php endif; ?>	
<?php	
}

function showDistanceInForm($classMain) {
?>
				<div  <?php echo $classMain; ?> style="display: inline-block;<?php echo (get_option('stern_taxi_fare_show_distance_in_form')!="false") ? "" : "display:none;"; ?>">
					<span>
						<strong><?php _e('Distance: ', 'stern_taxi_fare'); ?></strong><span id="distanceSpanValue"></span>
					</span>
				</div>
<?php				
}		

function showTollInForm($classMain) {
?>
				<div  <?php echo $classMain; ?> style="display: inline-block;<?php echo (get_option('stern_taxi_fare_show_tolls_in_form')!="false") ? "" : "display:none;"; ?>">
					<span>
						<strong><?php _e('Tolls: ', 'stern_taxi_fare'); ?></strong><span id="tollSpanValue"></span>
					</span>
				</div>	
<?php				
}

function showDurationInForm($classMain) {
?>
				<div  <?php echo $classMain; ?> style="display: inline-block;<?php echo (get_option('stern_taxi_fare_show_duration_in_form')!="false") ? "" : "display:none;"; ?>">
					<span>
						<strong><?php _e('Duration: ', 'stern_taxi_fare'); ?></strong><span id="durationSpanValue"></span>
					</span>
				</div>
<?php				
}

function showSuicasesInForm($classMain) {
?>
	
				<div  <?php echo $classMain; ?> id="suicasesDivId" style="display: inline-block;<?php echo (get_option('stern_taxi_fare_show_suitcases_in_form')!="false") ? "" : "display:none;"; ?>">
					<span>
						<strong><?php _e('Max suitcases: ', 'stern_taxi_fare'); ?></strong><span id="suitcasesSpanValue"></span>
					</span>
				</div>	
<?php				
}

function showSuicasesSmallInForm($classMain) {
?>
	
				<div  <?php echo $classMain; ?> id="suicasesSmallDivId" style="display: inline-block;<?php echo (get_option('stern_taxi_fare_show_suitcasesSmall')!="false") ? "" : "display:none;"; ?>">
					<span>
						<strong><?php _e('Small suitcases: ', 'stern_taxi_fare'); ?></strong><span id="suitcasesSmallSpanValue"></span>
					</span>
				</div>	
<?php				
}

function showFareInForm($classMain) {
?>			
				<div  class="col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 col-xs-10 col-xs-offset-1" id="estimatedFareDivId" style="display: inline-block;<?php echo $backgroundColor; ?>;<?php echo (get_option('stern_taxi_fare_show_estimated_in_form')!="false") ? "" : "display:none;"; ?>">
					<span>
						<strong><?php _e('Fare:', 'stern_taxi_fare'); ?> </strong><span id="estimatedFareSpanValue"></span>
					</span>
				</div>


<?php				
}	


						
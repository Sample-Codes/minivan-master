<?php
function showButtons() {

?>			


	<div class="row">



			
		<div class="col-xs-12 form-group" style="text-align: center;padding-top: 15px; margin-bottom: 15px">
			
			<?php if(get_option('stern_taxi_fare_allow_waypoints') =="true") : ?>
			
			<?php $tooltip = (get_option('stern_taxi_fare_show_tooltips') != "false") ? "data-toggle='tooltip' data-placement='top' data-original-title='". __('Show Map', 'stern_taxi_fare')."';" : ""; ?>
				<button type="button" <?php echo $tooltip; ?> class="btn btn-primary " id="addAddress" name="submit" value="addAddress" onclick="addAddressFunction();" style="font-size: 14px; font-weight: bold;" >
					<span id="SpanCal3" class="glyphicon glyphicon-map-marker" aria-hidden="true">
						
					</span>
					
				</button>
			<?php endif;?>
			
		
			<?php if(get_option('stern_taxi_fare_show_init_button') !="false") : ?>
				<?php $tooltip = (get_option('stern_taxi_fare_show_tooltips') != "false") ? "data-toggle='tooltip' data-placement='left' data-original-title='". __('Reset Form', 'stern_taxi_fare')."';" : ""; ?>
				<button type="button"  <?php echo $tooltip; ?> class="btn btn-primary " id="resetBtn" name="reset" value="Reset"  style="font-size: 14px; font-weight: bold;" />
					<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
					<?php echo (get_option('stern_taxi_fare_show_label_in_button') == "true") ? __('Reset Form', 'stern_taxi_fare') : ""; ?>
				</button>
			<?php endif;?>
			

			

			<?php $tooltip = (get_option('stern_taxi_fare_show_tooltips') != "false") ? "data-toggle='tooltip' data-placement='top' data-original-title='". __('Show Map', 'stern_taxi_fare')."';" : ""; ?>
			<button type="button" <?php echo $tooltip; ?> class="btn btn-primary " id="cal3" name="submit" value="showMap" onClick="showMap()" style="font-size: 14px; font-weight: bold;display: none;" >
				<span id="SpanCal3" class="glyphicon glyphicon-map-marker" aria-hidden="true">
					
				</span>
				<?php echo (get_option('stern_taxi_fare_show_label_in_button') == "true") ? __('Show Map', 'stern_taxi_fare') : ""; ?>
			</button>
			
	
			<?php $tooltip = (get_option('stern_taxi_fare_show_tooltips') != "false") ? "data-toggle='tooltip' data-placement='right' data-original-title='". __('Check Price', 'stern_taxi_fare')."';" : ""; ?>
			<button type="button" <?php echo $tooltip; ?>  class="btn btn-primary " id="cal1" name="submit" value="Check" onClick="doCalculation()" style="font-size: 14px; font-weight: bold" />
				<span id="SpanCal1"  class="glyphicon glyphicon-check" aria-hidden="true">
					
				</span>
				<?php echo (get_option('stern_taxi_fare_show_label_in_button') == "true") ? __('Check Price', 'stern_taxi_fare') : ""; ?>
			</button>

		
			
			
		</div>		
			
	</div>
	
<?php	
}										
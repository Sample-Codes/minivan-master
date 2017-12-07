<?php

if ( ! defined( 'ABSPATH' ) )
	exit;


Class design{
	function __construct($widthTable, $widthInput, $showAllOptions){
		
	
		 
				
		?>
		<br>
		<form name="SternSaveSettings" method="post">
			<table name="instfare" width="<?php echo $widthTable; ?>">
				<tr>
					<td>
						<h2><?php _e('Design Settings', 'stern_taxi_fare'); ?></h2>
					</td>
					<td>
					</td>
					<td>
					</td>
				</tr>


				<?php $nameOption = "stern_taxi_fare_title"; ?>
				<?php $title = __('Title', 'stern_taxi_fare'); ?>			
				<?php $tooltip = __('Leave empty to hide it', 'stern_taxi_fare', 'stern_taxi_fare'); ?>				
				<?php new showInputOption($nameOption, $title, $tooltip, $widthInput); ?>
					
				<?php $nameOption = "stern_taxi_fare_subtitle"; ?>
				<?php $title = __('Subtitle', 'stern_taxi_fare'); ?>			
				<?php $tooltip = __('Leave empty to hide it', 'stern_taxi_fare', 'stern_taxi_fare'); ?>				
				<?php new showInputOption($nameOption, $title, $tooltip, $widthInput); ?>
					


					
				<?php showModeOptions($widthInput); ?>

				<?php $nameOption = "stern_taxi_fare_show_dropdown_typecar"; ?>
				<?php $title = __('Show dropdown typecar in form', 'stern_taxi_fare'); ?>
				<?php $tooltip = __('Dropdown typecar can be hide if for example there is only 1 car.', 'stern_taxi_fare', 'stern_taxi_fare'); ?>				
				<?php new showBoolOption($nameOption, $title, $tooltip, $widthInput); ?>
				
				<?php $nameOption = "stern_taxi_fare_show_seat_input"; ?>
				<?php $title = __('Show Seat Inputs in form', 'stern_taxi_fare'); ?>
				<?php $tooltip = __('Dropdown seats Inputs', 'stern_taxi_fare', 'stern_taxi_fare'); ?>				
				<?php new showBoolOption($nameOption, $title, $tooltip, $widthInput); ?>
				

				
				
				<?php $nameOption = "stern_taxi_fare_calendar_sideBySide"; ?>
				<?php $title = __('Show calendar time & date side by side', 'stern_taxi_fare'); ?>
				<?php $tooltip = __('It splits date and time in the form', 'stern_taxi_fare', 'stern_taxi_fare'); ?>				
				<?php new showBoolOption($nameOption, $title, $tooltip, $widthInput); ?>

				<?php $nameOption = "stern_taxi_fare_calendar_split_date_time"; ?>
				<?php $title = __('Split calendar: date and time', 'stern_taxi_fare'); ?>
				<?php $tooltip = __('Only work when option "Show calendar field as an input" is true', 'stern_taxi_fare', 'stern_taxi_fare'); ?>				
				<?php new showBoolOption($nameOption, $title, $tooltip, $widthInput); ?>

				<?php $nameOption = "stern_taxi_fare_split_hour_min"; ?>
				<?php $title = __('Split calendar: Hours and minutes', 'stern_taxi_fare'); ?>
				<?php $tooltip = __('Only work when option "Split calendar" is true', 'stern_taxi_fare', 'stern_taxi_fare'); ?>				
				<?php new showBoolOption($nameOption, $title, $tooltip, $widthInput); ?>

		
				<?php $title = __('Use child seats', 'stern_taxi_fare'); ?>
				<?php $nameOption = "stern_taxi_fare_use_babySeat"; ?>					
				<?php $tooltip = __('This option shows in form baby seat. It will integrated in formaula. It works only when walendar input and seat input are false', 'stern_taxi_fare'); ?>				
				<?php $helpURL = ""; ?>
				<?php $helpLabel  = "";	?>	
				<?php new showBoolOption($nameOption, $title, $tooltip, $widthInput, $helpURL, $helpLabel); ?>


				<?php $title = __('Use QR code', 'stern_taxi_fare'); ?>
				<?php $nameOption = "stern_taxi_fare_use_QR_code"; ?>					
				<?php $tooltip = __('This option shows a QR code. The link is the ADMIN order of WooCommerce.', 'stern_taxi_fare'); ?>				
				<?php $helpURL = "http://stern-taxi-fare.sternwebagency.com/docs/j-qr-code/"; ?>
				<?php $helpLabel  = "QR code";	?>	
				<?php new showBoolOption($nameOption, $title, $tooltip, $widthInput, $helpURL, $helpLabel); ?>
									
										
							
				<tr>
					<td><?php _e('Hide labels in form', 'stern_taxi_fare'); ?></td>
					<td>
						<select name="stern_taxi_fare_show_labels" style="width:<?php echo $widthInput; ?>;">
							<?php if (get_option('stern_taxi_fare_show_labels')=='') {$selected ="selected";} else {$selected ="";} ?>
							<option  value='' <?php echo $selected; ?>></option>
							<?php if (get_option('stern_taxi_fare_show_labels')=='true') {$selected ="selected";} else {$selected ="";} ?>
							<option  value='true' <?php echo $selected; ?>>true</option>
							<?php if (get_option('stern_taxi_fare_show_labels')=='false') {$selected ="selected";} else {$selected ="";} ?>
							<option  value='false' <?php echo $selected; ?>>false</option>
						</select>
					</td>
					<td>
					
					</td>
				</tr>
				
				<tr>
					<td>
						<?php echo _e('Show label in buttons', 'stern_taxi_fare'); ?>
					</td>
					<td>
						<select id="stern_taxi_fare_show_label_in_button" name="stern_taxi_fare_show_label_in_button" style="width:<?php echo $widthInput; ?>;">
							<option <?php echo (get_option('stern_taxi_fare_show_label_in_button') == "" ? 		"selected"	 : 	""	); ?> value=""></option>
							<option <?php echo (get_option('stern_taxi_fare_show_label_in_button') == "true" ? 	"selected"	 : 	""	); ?> value="true">true</option>
							<option <?php echo (get_option('stern_taxi_fare_show_label_in_button') == "false" ? 	"selected"	 : 	""	); ?> value="false">false</option>
						</select>
						
					</td>
					<td>
					</td>
				</tr>
								
				
				
				
				<tr>
					<td><?php _e('Show Tooltips in form', 'stern_taxi_fare'); ?></td>
					<td>
						<select name="stern_taxi_fare_show_tooltips" style="width:<?php echo $widthInput; ?>;">
							<?php if (get_option('stern_taxi_fare_show_tooltips')=='') {$selected ="selected";} else {$selected ="";} ?>
							<option  value='' <?php echo $selected; ?>></option>
							<?php if (get_option('stern_taxi_fare_show_tooltips')=='true') {$selected ="selected";} else {$selected ="";} ?>
							<option  value='true' <?php echo $selected; ?>>true</option>
							<?php if (get_option('stern_taxi_fare_show_tooltips')=='false') {$selected ="selected";} else {$selected ="";} ?>
							<option  value='false' <?php echo $selected; ?>>false</option>
						</select>
					</td>
					<td>
					</td>
				</tr>
				
				<tr>
					<td><?php _e('Show Form in full row', 'stern_taxi_fare'); ?></td>
					<td>					
						<select id="stern_taxi_fare_form_full_row" name="stern_taxi_fare_form_full_row" style="width:<?php echo $widthInput; ?>;">
							<option <?php echo (get_option('stern_taxi_fare_form_full_row') == "" ? 		"selected"	 : 	""	); ?> value=""></option>
							<option <?php echo (get_option('stern_taxi_fare_form_full_row') == "true" ? 	"selected"	 : 	""	); ?> value="true">true</option>
							<option <?php echo (get_option('stern_taxi_fare_form_full_row') == "false" ? 	"selected"	 : 	""	); ?> value="false">false</option>
						</select>					
						
					</td>
					<td>
					</td>
				</tr>		
				
				
				<tr>
					<td>
					<?php echo _e('Show inputs in full row', 'stern_taxi_fare'); ?>
					</td>
					<td>
						<select name="stern_taxi_fare_full_row" style="width:<?php echo $widthInput; ?>;">
							<?php if (get_option('stern_taxi_fare_full_row')=='') {$selected ="selected";} else {$selected ="";} ?>
							<option  value='' <?php echo $selected; ?>></option>
							<?php if (get_option('stern_taxi_fare_full_row')=='true') {$selected ="selected";} else {$selected ="";} ?>
							<option  value='true' <?php echo $selected; ?>>true</option>
							<?php if (get_option('stern_taxi_fare_full_row')=='false') {$selected ="selected";} else {$selected ="";} ?>
							<option  value='false' <?php echo $selected; ?>>false</option>
						</select>
					</td>
					<td>
					</td>
				</tr>				
				
				<?php $nameOption = "stern_taxi_fare_show_position_price"; ?>
				<?php $title = __('Position of price in result: Right or below', 'stern_taxi_fare'); ?>
				<?php $tooltip = __('Position of price in result: Right or below', 'stern_taxi_fare', 'stern_taxi_fare'); ?>				
				<?php new showBoolOption($nameOption, $title, $tooltip, $widthInput); ?>
								
				
				<tr>
					<td>
						<?php echo _e('Show estimated in result', 'stern_taxi_fare'); ?>
					</td>
					<td>
						<select name="stern_taxi_fare_show_estimated_in_form" style="width:<?php echo $widthInput; ?>;">
							<?php if (get_option('stern_taxi_fare_show_estimated_in_form')=='') {$selected ="selected";} else {$selected ="";} ?>
							<option  value="" <?php echo $selected; ?>></option>						
							<?php if (get_option('stern_taxi_fare_show_estimated_in_form')=='true') {$selected ="selected";} else {$selected ="";} ?>
							<option  value="true" <?php echo $selected; ?>>true</option>
							<?php if (get_option('stern_taxi_fare_show_estimated_in_form')=='false') {$selected ="selected";} else {$selected ="";} ?>
							<option  value="false" <?php echo $selected; ?>>false</option>
						</select>
					</td>
					<td>
					</td>
				</tr>

				<tr>
					<td>
						<?php echo _e('Show distance in result', 'stern_taxi_fare'); ?>
					</td>
					<td>
						<select name="stern_taxi_fare_show_distance_in_form" style="width:<?php echo $widthInput; ?>;">
							<?php if (get_option('stern_taxi_fare_show_distance_in_form')=='') {$selected ="selected";} else {$selected ="";} ?>
							<option  value="" <?php echo $selected; ?>></option>						
							<?php if (get_option('stern_taxi_fare_show_distance_in_form')=='true') {$selected ="selected";} else {$selected ="";} ?>
							<option  value="true" <?php echo $selected; ?>>true</option>
							<?php if (get_option('stern_taxi_fare_show_distance_in_form')=='false') {$selected ="selected";} else {$selected ="";} ?>
							<option  value="false" <?php echo $selected; ?>>false</option>
						</select>
					</td>
					<td>
					</td>
				</tr>

				<tr>
					<td>
						<?php echo _e('Show duration in result', 'stern_taxi_fare'); ?>
					</td>
					<td>
						<select name="stern_taxi_fare_show_duration_in_form" style="width:<?php echo $widthInput; ?>;">
							<?php if (get_option('stern_taxi_fare_show_duration_in_form')=='') {$selected ="selected";} else {$selected ="";} ?>
							<option  value="" <?php echo $selected; ?>></option>						
							<?php if (get_option('stern_taxi_fare_show_duration_in_form')=='true') {$selected ="selected";} else {$selected ="";} ?>
							<option  value="true" <?php echo $selected; ?>>true</option>
							<?php if (get_option('stern_taxi_fare_show_duration_in_form')=='false') {$selected ="selected";} else {$selected ="";} ?>
							<option  value="false" <?php echo $selected; ?>>false</option>
						</select>
					</td>
					<td>
					</td>
				</tr>
				
				<tr>
					<td>
						<?php echo _e('Show Suitcases in result', 'stern_taxi_fare'); ?>
					</td>
					<td>
						<select name="stern_taxi_fare_show_suitcases_in_form" style="width:<?php echo $widthInput; ?>;">
							<?php if (get_option('stern_taxi_fare_show_suitcases_in_form')=='') {$selected ="selected";} else {$selected ="";} ?>
							<option  value="" <?php echo $selected; ?>></option>						
							<?php if (get_option('stern_taxi_fare_show_suitcases_in_form')=='true') {$selected ="selected";} else {$selected ="";} ?>
							<option  value="true" <?php echo $selected; ?>>true</option>
							<?php if (get_option('stern_taxi_fare_show_suitcases_in_form')=='false') {$selected ="selected";} else {$selected ="";} ?>
							<option  value="false" <?php echo $selected; ?>>false</option>
						</select>
					</td>
					<td>
					</td>
				</tr>

				<?php $nameOption = "stern_taxi_fare_show_suitcasesSmall"; ?>
				<?php $title = __('Show suitcases Small Inputs in form', 'stern_taxi_fare'); ?>
				<?php $tooltip = __('suitcases Small Inputs', 'stern_taxi_fare', 'stern_taxi_fare'); ?>				
				<?php new showBoolOption($nameOption, $title, $tooltip, $widthInput); ?>
								
								
				<tr>
					<td>
						<?php echo _e('Show tolls in results', 'stern_taxi_fare'); ?>
					</td>
					<td>
						<select name="stern_taxi_fare_show_tolls_in_form" style="width:<?php echo $widthInput; ?>;">
							<?php if (get_option('stern_taxi_fare_show_tolls_in_form')=='') {$selected ="selected";} else {$selected ="";} ?>
							<option  value="" <?php echo $selected; ?>></option>						
							<?php if (get_option('stern_taxi_fare_show_tolls_in_form')=='true') {$selected ="selected";} else {$selected ="";} ?>
							<option  value="true" <?php echo $selected; ?>>true</option>
							<?php if (get_option('stern_taxi_fare_show_tolls_in_form')=='false') {$selected ="selected";} else {$selected ="";} ?>
							<option  value="false" <?php echo $selected; ?>>false</option>
						</select>
					</td>
					<td>
					</td>
				</tr>
				<tr>
					<td>
						<?php echo _e('Show Init Button', 'stern_taxi_fare'); ?>
					</td>
					<td>
						<select id="stern_taxi_fare_show_init_button" name="stern_taxi_fare_show_init_button" style="width:<?php echo $widthInput; ?>;">
							<option <?php echo (get_option('stern_taxi_fare_show_init_button') == "" ? 			"selected"	 : 	""	); ?> value=""></option>
							<option <?php echo (get_option('stern_taxi_fare_show_init_button') == "true" ? 		"selected"	 : 	""	); ?> value="true">true</option>
							<option <?php echo (get_option('stern_taxi_fare_show_init_button') == "false" ? 	"selected"	 : 	""	); ?> value="false">false</option>
						</select>
					</td>
					<td>
					</td>
				<td></td></tr>				
				<tr>
					<td></td>
					<td></td>
				<td></td></tr>
					<?php if($showAllOptions == true) : ?>
					<tr>
						<td><?php _e('Use library bootstrap js', 'stern_taxi_fare'); ?></td>
						<td>					
							<select id="stern_taxi_fare_lib_bootstrap_js" name="stern_taxi_fare_lib_bootstrap_js" style="width:<?php echo $widthInput; ?>;">
								<option <?php echo (get_option('stern_taxi_fare_lib_bootstrap_js') == "" ? 		"selected"	 : 	""	); ?> value=""></option>
								<option <?php echo (get_option('stern_taxi_fare_lib_bootstrap_js') == "true" ? 	"selected"	 : 	""	); ?> value="true">true</option>
								<option <?php echo (get_option('stern_taxi_fare_lib_bootstrap_js') == "false" ? "selected"	 : 	""	); ?> value="false">false</option>
							</select>					
							
						</td>
					<td></td></tr>
					<tr>
						<td><?php _e('Use library bootstrap css', 'stern_taxi_fare'); ?></td>
						<td>					
							<select id="stern_taxi_fare_lib_bootstrap_css" name="stern_taxi_fare_lib_bootstrap_css" style="width:<?php echo $widthInput; ?>;">
								<option <?php echo (get_option('stern_taxi_fare_lib_bootstrap_css') == "" ? 		"selected"	 : 	""	); ?> value=""></option>
								<option <?php echo (get_option('stern_taxi_fare_lib_bootstrap_css') == "true" ? 	"selected"	 : 	""	); ?> value="true">true</option>
								<option <?php echo (get_option('stern_taxi_fare_lib_bootstrap_css') == "false" ?	 "selected"	 : 	""	); ?> value="false">false</option>
							</select>					
							
						</td>
					<td></td></tr>
				<?php endif; ?>
				
				
				<?php $nameOption = "stern_taxi_fare_Bootstrap_select"; ?>
				<?php $title = __('Use Bootstrap-select. ', 'stern_taxi_fare'); ?>
				<?php $title .= __('See details ', 'stern_taxi_fare') .'<a href="https://silviomoreto.github.io/bootstrap-select" target="_blank">'; ?>
				<?php $title .= __('here', 'stern_taxi_fare').'</a>'; ?>
				<?php $tooltip = __('This feature is sometimes not fully compatible with all themes. It is also not responsive.', 'stern_taxi_fare', 'stern_taxi_fare'); ?>				
				<?php new showBoolOption($nameOption, $title, $tooltip, $widthInput); ?>
				
				

				<tr>
					
					<td><?php echo _e('Show Pets informations in checkout', 'stern_taxi_fare'); ?></td>
					<td>						
						<select name="stern_taxi_use_pets" style="width:<?php echo $widthInput; ?>;">								
							<option  value='' 		<?php echo ((get_option('stern_taxi_use_pets')=='') 		? "selected" : "");	?>></option>
							<option  value='true' 	<?php echo ((get_option('stern_taxi_use_pets')=='true')		? "selected" : "");	?>>true</option>
							<option  value='false'	<?php echo ((get_option('stern_taxi_use_pets')=='false')	? "selected" : "");	?>>false</option>
						</select>
					</td>
				<td></td></tr>
				
				<tr>
					<td><?php _e('Map Style', 'stern_taxi_fare'); ?></td>
					<td>					
						<select id="stern_taxi_fare_map_style" name="stern_taxi_fare_map_style" style="width:<?php echo $widthInput; ?>;">
						
							<?php							
							foreach  (getOptionMapStyle() as $key => $value) {
								?>
								<option <?php echo (get_option('stern_taxi_fare_map_style') == $key ? 			"selected"	 : 	""	); ?> value="<?php echo $key; ?>"	><?php echo $key; ?></option>
								<?php
							}
							?>					
							
						</select>						
					</td>
					<td>
						<?php 
						$url = "http://stern-taxi-fare.sternwebagency.com/docs/f-tons-of-map-styles/";
						$label = "Tons of map styles";
						?>
						
						<?php showHelp($url,$label) ; ?>
						
					</td>
				</tr>	

				<?php $nameOption = "stern_taxi_fare_show_markers_in_map"; ?>
				<?php $title = __('Show Markers in map', 'stern_taxi_fare'); ?>
				<?php $tooltip = __('You can hide or show markers in map result.', 'stern_taxi_fare', 'stern_taxi_fare'); ?>				
				<?php new showBoolOption($nameOption, $title, $tooltip, $widthInput); ?>
				
								

				<tr>
					
					<td><?php echo _e('Show map in checkout', 'stern_taxi_fare'); ?></td>
					<td>						
						<select name="stern_taxi_fare_show_map_checkout" style="width:<?php echo $widthInput; ?>;">								
							<option  value='' 		<?php echo ((get_option('stern_taxi_fare_show_map_checkout')=='') 		? "selected" : "");	?>></option>
							<option  value='true' 	<?php echo ((get_option('stern_taxi_fare_show_map_checkout')=='true')	? "selected" : "");	?>>true</option>
							<option  value='false'	<?php echo ((get_option('stern_taxi_fare_show_map_checkout')=='false')	? "selected" : "");	?>>false</option>
						</select>
					</td>
				<td></td></tr>

				<tr>
					<td><?php echo _e('Show map in form', 'stern_taxi_fare'); ?></td>
					<td>						
						<select name="stern_taxi_fare_show_map" style="width:<?php echo $widthInput; ?>;">								
							<option  value='' 		<?php echo ((get_option('stern_taxi_fare_show_map')=='') 		? "selected" : "");	?>></option>
							<option  value='true' 	<?php echo ((get_option('stern_taxi_fare_show_map')=='true')	? "selected" : "");	?>>true</option>
							<option  value='false'	<?php echo ((get_option('stern_taxi_fare_show_map')=='false')	? "selected" : "");	?>>false</option>
						</select>
					</td>
				<td></td></tr>				
					

		
				<tr>
					<td><?php echo _e('Open map automatically after checking price', 'stern_taxi_fare'); ?></td>						
					<td>						
						<select name="stern_taxi_fare_auto_open_map" style="width:<?php echo $widthInput; ?>;">								
							<option  value='' 		<?php echo ((get_option('stern_taxi_fare_auto_open_map')=='') 		? "selected" : "");	?>></option>
							<option  value='true' 	<?php echo ((get_option('stern_taxi_fare_auto_open_map')=='true')	? "selected" : "");	?>>true</option>
							<option  value='false'	<?php echo ((get_option('stern_taxi_fare_auto_open_map')=='false')	? "selected" : "");	?>>false</option>
						</select>
					</td>
				<td></td></tr>
				<?php if($showAllOptions == true) : ?>
					<tr>
						<td><?php echo _e('Empty cart before using form', 'stern_taxi_fare'); ?></td>
						<td>						
							<select name="stern_taxi_fare_emptyCart" style="width:<?php echo $widthInput; ?>;">								
								<option  value='' 		<?php echo ((get_option('stern_taxi_fare_emptyCart')=='') 		? "selected" : "");	?>></option>
								<option  value='true' 	<?php echo ((get_option('stern_taxi_fare_emptyCart')=='true')	? "selected" : "");	?>>true</option>
								<option  value='false'	<?php echo ((get_option('stern_taxi_fare_emptyCart')=='false')	? "selected" : "");	?>>false</option>
							</select>
						</td>
					<td></td></tr>
				<?php endif; ?>

				
			
				<?php $nameOption = "stern_taxi_fare_bcolor"; ?>
				<?php $title = __('Background color. ', 'stern_taxi_fare'); ?>
				<?php $tooltip = __('Example: #1ABC9C', 'stern_taxi_fare', 'stern_taxi_fare'); ?>				
				<?php new showInputOption($nameOption, $title, $tooltip, $widthInput); ?>

				
				<tr>
					<td><?php echo _e('Background transparency', 'stern_taxi_fare'); ?></td>
					<td><input title="Min 0, max 1. Example: 0.7" class='uitip' value="<?php echo get_option('stern_taxi_fare_bTransparency'); ?>" type="number" step="0.1" name="stern_taxi_fare_bTransparency" style="width:<?php echo $widthInput; ?>;"></td>
				<td></td></tr>	

				
				
				<?php $nameOption = "stern_taxi_fare_book_button_text"; ?>
				<?php $title = __('Book button text', 'stern_taxi_fare'); ?>
				<?php $tooltip = __('Example: Book now', 'stern_taxi_fare', 'stern_taxi_fare'); ?>				
				<?php new showInputOption($nameOption, $title, $tooltip, $widthInput); ?>
				
			
				<?php new showListGlyphicon($widthInput,"source"); ?>
				<?php new showListGlyphicon($widthInput,"destination"); ?>

				
				<?php $nameOption = "stern_taxi_fare_url_gif_loader"; ?>
				<?php $title = __('Url_gif_loader', 'stern_taxi_fare'); ?>			
				<?php $tooltip = __('Example: ', 'stern_taxi_fare', 'stern_taxi_fare'). getUrlGifLoader(); ?>				
				<?php new showInputOption($nameOption, $title, $tooltip, $widthInput); ?>
								
				<tr><td></td><td></td><td></td></tr>
								

                <tr>
					<td>
						<input type="submit" id="faresubmit" value="<?php _e('Save', 'stern_taxi_fare'); ?>" class="button-primary" name="SternSaveSettings" />
					</td>
				</tr>
                
				
			</table>
		</form>
		<?php
			
	}
}
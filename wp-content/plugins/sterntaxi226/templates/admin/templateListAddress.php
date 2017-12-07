<?php

if ( ! defined( 'ABSPATH' ) )
	exit;


Class templateListAddress{
	function __construct($widthTable, $widthInput, $showAllOptions){
		?>
			
			<div class="wrap"><div id="icon-tools" class="icon32"></div>
				<h2><?php _e('List Address in dropdown', 'stern_taxi_fare'); ?></h2>
			</div>
			
			<form name="SettingsTemplateListAddress" method="post">
				<table name="TableSettingsTemplateListAddress" width="<?php echo $widthTable; ?>">
				
				
					<?php $title = __('Show pricing rules as dropdown fields', 'stern_taxi_fare'); ?>
					<?php $nameOption = "stern_taxi_fare_show_rules_in_dropdown_inputs"; ?>					
					<?php $tooltip = __('This option will work only when dropdown are set for pickup & destination. Only field pickup is populated. When in this pickup field a value is selected, it will refresh Destination. Refresh button will clear destination dropdown. If value is changed (in both fields), booking button will be disabled. button "check price" must be clicked again to refresh price.', 'stern_taxi_fare'); ?>				
					<?php $helpURL = "http://stern-taxi-fare.sternwebagency.com/docs/show-pricing-rules-as-dropdown-fields/"; ?>
					<?php $helpLabel  = "Show pricing rules as dropdown fields";	?>	
					<?php new showBoolOption($nameOption, $title, $tooltip, $widthInput, $helpURL, $helpLabel); ?>	


					
				
					<?php $nameOption = "stern_taxi_use_list_address_source"; ?>
					<?php $title = __('Use list address for Pick up address', 'stern_taxi_fare'); ?>
					<?php $tooltip = __('This option will show a dropdwon instead of a google input for Pick up address', 'stern_taxi_fare'); ?>				
					<?php $helpLabel = $title ; ?>
					<?php $helpURL  = "http://stern-taxi-fare.sternwebagency.com/docs/overview/";	?>					
					<tr>
						<td>
							<?php echo $title; ?>
						</td>
						<td>
							<select id="<?php echo $nameOption; ?>" name="<?php echo $nameOption; ?>" title='<?php echo $tooltip; ?>' class='uitip' style="width:<?php echo $widthInput; ?>;">
								<option <?php echo (get_option($nameOption) == "" ? 		"selected"	 : 	""	); ?> value=""><?php _e('No', 'stern_taxi_fare'); ?></option>
								<option <?php echo (get_option($nameOption) == "true" ? 	"selected"	 : 	""	); ?> value="true"><?php _e('List in dropdown', 'stern_taxi_fare'); ?></option>
								<option <?php echo (get_option($nameOption) == "false" ? 	"selected"	 : 	""	); ?> value="false"><?php _e('List in button', 'stern_taxi_fare'); ?></option>
							</select>				
						</td>				
						<td>
							<?php 
								if($helpURL!=null) {
									showHelp($helpURL, $helpLabel); 
								}
							?>
						</td>
					</tr>

			
					
					<?php $nameOption = "stern_taxi_use_list_address_destination"; ?>
					<?php $title = __('Use list address for destination address', 'stern_taxi_fare'); ?>
					<?php $tooltip = __('This option will show a dropdwon instead of a google input for destination address', 'stern_taxi_fare'); ?>				
					<?php $helpLabel = $title ; ?>
					<?php $helpURL  = "http://stern-taxi-fare.sternwebagency.com/docs/overview/";	?>	
					<tr>
						<td>
							<?php echo $title; ?>
						</td>
						<td>
							<select id="<?php echo $nameOption; ?>" name="<?php echo $nameOption; ?>" title='<?php echo $tooltip; ?>' class='uitip' style="width:<?php echo $widthInput; ?>;">
								<option <?php echo (get_option($nameOption) == "" ? 		"selected"	 : 	""	); ?> value="">No</option>
								<option <?php echo (get_option($nameOption) == "true" ? 	"selected"	 : 	""	); ?> value="true">list in dropdown</option>
								<option <?php echo (get_option($nameOption) == "false" ? 	"selected"	 : 	""	); ?> value="false">list in button</option>
							</select>				
						</td>				
						<td>
							<?php 
								if($helpURL!=null) {
									showHelp($helpURL, $helpLabel); 
								}
							?>
						</td>
					</tr>
					
												
					
					<tr>
						<td><input type="submit" id="SettingsTemplateListAddressSubmit" value="<?php _e('Save', 'stern_taxi_fare'); ?>" class="button-primary" name="SettingsTemplateListAddressSubmit" style="width:150px;"/></td>
						<td></td>
					</tr>					
					
				</table>
			</form>
			<?php if($showAllOptions == true) : ?>	
				<?php		
				
					$args = array(
					'post_type' => 'stern_listAddress',
					'nopaging' => true,
					);

					$allRules = get_posts( $args );				
				
				?>	
				<br>		
				<br>
				<form method="post">
					<table class="displayrecord">
						<thead  align="left">
							<tr class="home">
								<th>Id</th>
								<th>Is Active</th>
								<th>typeListAddress</th>
								<th>address</th>
								<th>Delete</th>
							</tr>
						</thead>
						<tbody>
						<?php
						foreach ( $allRules as $post ) : setup_postdata( $post );
						$oListAddress = new listAddress($post->ID);
						?>
						
							<tr>
								<td><?php echo $oListAddress->getid() ?></td>
								<td>
									<?php 
										if ($oListAddress->getisActive() =="true") { $checked = "checked";	} else {$checked = "";}
									?>
									<input type="checkbox" name="isActive<?php echo $post->ID; ?>" value="true" <?php echo $checked; ?>>								
								</td>
								<td><?php echo $oListAddress->gettypeListAddress(); ?></td>
								<td><?php echo $oListAddress->getaddress(); ?></td>						
								<td><input type="checkbox" name="remove<?php echo $post->ID; ?>" value="yes"></td>
							</tr>
						   
						<?php endforeach; ?>
						<?php wp_reset_postdata(); ?>	
							<tr>
								<td></td>
								<td>							
									<select name="isActive" >
										<option value="true" >true</option>
										<option value="false" >false</option>					
									</select>
								</td>
								<td>
									<select name="typeListAddress" >
										<option value="" ></option>
										<option value="source" >source</option>
										<option value="destination" >destination</option>									
									</select>							
								</td>							
								
								<td><input type="text" name="address" id="address"></td>
								
					
								
								<td><input type="submit" id="listAddressSubmit" value="Go" class="button-primary" name="listAddressSubmit" /></td>
							</tr>
							
						</tbody>
					</table>
					<input type="hidden"  name="countryHiddenListAddress" id="countryHiddenListAddress" value="<?php echo get_option('stern_taxi_fare_country'); ?>"/>
				</form>
			<?php endif; ?>
		<?php
	}
}
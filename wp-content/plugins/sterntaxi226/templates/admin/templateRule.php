<?php

if ( ! defined( 'ABSPATH' ) )
	exit;

	

Class templateRule{
	function __construct($widthTable, $widthInput, $showAllOptions){	
		?>
			
			<div class="wrap"><div id="icon-tools" class="icon32"></div>
				<h2><?php _e('Pricing Rules', 'stern_taxi_fare'); ?></h2>
				<h4><?php _e('Work only when option "Add Address between origin and destination" is false', 'stern_taxi_fare'); ?></h4>
			</div>
			<?php settings_errors(); ?>
			<form name="SettingsPricingRules" method="post">
				<table name="TableSettingsPricingRules">
					<tr>
						<td><?php _e('Include Seat Fare in pricing rules', 'stern_taxi_fare'); ?></td>						
						<td>						
							<select name="stern_taxi_Include_SeatFare_in_pricing_rules" style="width:300px;">								
								<option  value='' 		<?php echo ((get_option('stern_taxi_Include_SeatFare_in_pricing_rules')=='') 		? "selected" : "");	?>></option>
								<option  value='true' 	<?php echo ((get_option('stern_taxi_Include_SeatFare_in_pricing_rules')=='true')	? "selected" : "");	?>>true</option>
								<option  value='false'	<?php echo ((get_option('stern_taxi_Include_SeatFare_in_pricing_rules')=='false')	? "selected" : "");	?>>false</option>
							</select>
						</td>
					</tr>
					
					<?php $nameOption = "stern_taxi_fare_nb_post_to_show"; ?>
					<?php $title = __('Nb of rules to show', 'stern_taxi_fare'); ?>			
					<?php $tooltip = __('Nb of rows to show', 'stern_taxi_fare', 'stern_taxi_fare'); ?>				
					<?php new showInputOption($nameOption, $title, $tooltip, $widthInput); ?>					
					
					<tr>
						<td><input type="submit" id="SettingsPricingRulesSubmit" value="Save Changes" class="button-primary" name="SettingsPricingRulesSubmit" style="width:150px;"/></td>
						<td></td>
					</tr>					
					
				</table>
			</form>

	
		
			
			
		<?php
		
		
		if(isset($_GET["paged"])) {
			$paged = $_GET["paged"];
		} else {
			$paged = 1;
		}
			//$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
			
		
		$posts_per_page  = getNb_post_to_show();
		$query = getQueryRule($paged, $posts_per_page );
		$allRulesQuery = getQueryRule();
			
		?>
			<br><br><br>
			<?php echo $query->post_count." / ".$allRulesQuery->post_count." rules"; ?>
			
			<?php

				$range = '';
				$pages = '';
				pagination_stern_taxi_fare($range,$paged,$pages,$query);
				
			?>				
			<br>
			<form method="post">
				<table class="displayrecord">
					<thead  align="left">
						<tr class="home">
							<th>Id</th>
							<th><?php _e('Is active', 'stern_taxi_fare'); ?><input type="checkbox" name="checkboxALLActive" id="checkboxALLActive" /></th>
							<th><?php _e('Name Rule', 'stern_taxi_fare'); ?></th>
							<th><?php _e('Type source', 'stern_taxi_fare'); ?></th>
							<th><?php _e('Source value', 'stern_taxi_fare'); ?></th>
							<th><?php _e('Source City', 'stern_taxi_fare'); ?></th>
							<th><?php _e('Type Destination', 'stern_taxi_fare'); ?></th>
							<th><?php _e('Destination Value', 'stern_taxi_fare'); ?></th>
							<th><?php _e('Destination City', 'stern_taxi_fare'); ?></th>
							<th><?php _e('Type Car', 'stern_taxi_fare'); ?></th>
							<th><?php _e('Price for this rule', 'stern_taxi_fare'); ?></th>							
							<th><?php _e('Delete', 'stern_taxi_fare'); ?><input type="checkbox" name="checkboxALL" id="checkboxALL" /></th>
						</tr>
					</thead>
					<tbody>
					<?php
					//foreach ( $allRules as $post ) : setup_postdata( $post );
					while ( $query->have_posts() ) : $query->the_post(); 
					$oRule = new rule(get_the_ID());
					?>
					
						<tr>
							<td><?php echo $oRule->getid() ?></td>
							<td>
								<?php 
									if ($oRule->getisActive() =="true") { $checked = "checked";	} else {$checked = "";}
								?>
								<input type="checkbox" class="isActiveCheckBox" name="isActive<?php echo get_the_ID(); ?>" value="true" <?php echo $checked; ?>>
								
								
							</td>
							<td><?php echo $oRule->getnameRule(); ?></td>
							<td><?php echo $oRule->gettypeSource(); ?></td>
							<td><?php echo $oRule->gettypeSourceValue(); ?></td>
							<td><?php echo $oRule->getsourceCity(); ?></td>
							<td><?php echo $oRule->gettypeDestination(); ?></td>
							<td><?php echo $oRule->gettypeDestinationValue(); ?></td>
							<td><?php echo $oRule->getdestinationCity(); ?></td>
							<?php 
								$otypeCar = new typeCar($oRule->gettypeIdCar() ); 
								if($otypeCar->getcarType()=="") { $typeCar = "All";} else { $typeCar = $otypeCar->getcarType();}
							?>
							<td><?php echo $typeCar; ?> (<?php echo $oRule->gettypeIdCar(); ?>)</td>					
							<td><?php echo $oRule->getprice(); ?></td>							
							<td><input type="checkbox" class="removeCheckBox" name="remove<?php echo get_the_ID(); ?>" value="yes"></td>
						</tr>
					   
					<?php endwhile; ?>
					

					
					
					<?php wp_reset_postdata(); ?>	
						<tr>
							<td></td>
							<td>	
								<input type="hidden" name="isActive" value="false">							
	
							</td>
							
							<td><input type="text" name="nameRule"></td>
							
							<td>
								<select name="typeSource" >
									<option value="address" >address</option>
									<option value="city" >city</option>
									<option value="exactName" >exactName</option>
								</select>							
							</td>
							<td><input type="text" id="typeSourceValue" name="typeSourceValue"></td>
							<td></td>
							
							<td>
								<select name="typeDestination" >
									<option value="address" >address</option>
									<option value="city" >city</option>									
									<option value="exactName" >exactName</option>
								</select>								
							</td>
							<td><input type="text" id="typeDestinationValue" name="typeDestinationValue"></td>
							<td></td>
							<?php 
								$args = array(
								'post_type' => 'stern_taxi_car_type',
								'nopaging' => true,
								);

								$allPosts = get_posts( $args );
							?>			
					

							<td>
								<select name="typeIdCar" >
									<option value="" >All</option>
									<?php foreach ( $allPosts as $post ) : setup_postdata( $post ); ?>
									<?php $otypeCar = new typeCar($post->ID); ?>																	
										<option value="<?php echo $otypeCar->getid(); ?>" ><?php echo $otypeCar->getcarType(); ?></option>
									<?php endforeach; ?>
								</select>								
							</td>							
							
							<td><input type="number" step="0.1" name="price"></td>
							<td><input type="submit" id="ruleSubmit" value="Go" class="button-primary" name="ruleSubmit" /></td>
						</tr>
						<input type="hidden"  name="countryHidden" id="countryHidden" value="<?php echo get_option('stern_taxi_fare_country'); ?>"/>
					</tbody>
				</table>
				
				<input type="submit" id="deleteAllRules" value="Delete All Rules" class="button-primary" name="deleteAllRules" />
				
				<br>
				<br/>
				
				<h4><?php _e('Bulk upload', 'stern_taxi_fare'); ?><?php showHelp("http://stern-taxi-fare.sternwebagency.com/docs/set-pricing-rules-in-bulk/","Set Pricing rules in bulk"); ?></h4>
				
				<br>
				<?php _e('Use tab to split each colums. 1 rule per row.', 'stern_taxi_fare'); ?>
				<br>
				<?php _e('Example:', 'stern_taxi_fare'); ?>
				<br>
				<input type="text" size="100%" readonly value="true	lille-marseille	city	Lille, France	city	Marseille, France	All	99">
				<?php _e('Price is 99 for all Type Cars', 'stern_taxi_fare'); ?>
				<br>
				<input type="text" size="100%" readonly value="true	SF-LA	city	San Francisco, CA, United States	address	Los Angeles, CA, United States	131	399">
				<?php _e('Price is 399 for all typeCarID = 131', 'stern_taxi_fare'); ?>
				
				<br>
				<textarea cols="100%" rows="5" name="bulkPricingRules" id="bulkPricingRules"></textarea><br/>
				<input type="submit" id="bulkPricingRulesSubmit" value="Go" class="button-primary" name="bulkPricingRulesSubmit" />
				
			</form>
			


			
		<?php
	}
}
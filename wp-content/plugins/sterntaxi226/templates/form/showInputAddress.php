<?php
function showInputAddress($class_full_row,$typeAddress,$class) {

			
	if($typeAddress=="source") {
		$args = array(
			'post_type' => 'stern_listAddress',
			'nopaging' => true,
			'meta_query' => array(
				array(
					'key'     => 'typeListAddress',
					'value'   => 'source',
					'compare' => '=',
				),
				array(
					'key'     => 'isActive',
					'value'   => 'true',
					'compare' => '=',
				),
			),				
		);
		$allListAddressesSource = get_posts( $args );		
		$idName  = "source";
		$inputId  = "source";
		$labelName= __('Pick Up Address', 'stern_taxi_fare');
		$labelNamOptgroupe= __('Pick Up Address', 'stern_taxi_fare');
		$labelNameplaceholder = __('Address, airport, ...', 'stern_taxi_fare');
		$function = "getLocation()";
		$idButton="cal4";
		$spanId="getLocationSource";
		$glyphicon = getDestination_Button_glyph("source");
		$optionUse_list_address = "stern_taxi_use_list_address_source";
		$divName="divSource";
		
	} else {
		$args = array(
			'post_type' => 'stern_listAddress',
			'nopaging' => true,
			'meta_query' => array(
				array(
					'key'     => 'typeListAddress',
					'value'   => 'destination',
					'compare' => '=',
				),				
				array(
					'key'     => 'isActive',
					'value'   => 'true',
					'compare' => '=',
				),
			),				
		);
		$allListAddressesSource = get_posts( $args );			
		$idName  = "destination";
		$inputId  = "destination";
		$labelName= __('Destination', 'stern_taxi_fare');
		$labelNameplaceholder = __('City, Address, ...', 'stern_taxi_fare');
		
		$labelNamOptgroupe= __('Destination', 'stern_taxi_fare');	
		$function = "getLocationDestination()";
		$idButton="cal5";
		$spanId="getLocationDestination";	
		$glyphicon = getDestination_Button_glyph("destination");
		$optionUse_list_address = "stern_taxi_use_list_address_destination";
		$divName="divDestination";
		
		
		
		
		
		
		
	}
	
	?>


	
	
		<div  <?php echo $class_full_row; ?> style="padding-top: 15px;">
				<?php if (showlabel()) : ?>
					<label for="<?php echo $spanId; ?>"><?php echo $labelName; ?></label>
				<?php endif; ?>		
			<div class="input-group form-group" id ="<?php echo $divName; ?>">
			
			
				<?php if(get_option("stern_taxi_fare_show_rules_in_dropdown_inputs")=='true') : ?>
					<?php if($typeAddress=="source") : ?>
						<?php 
							$query = getQueryRule();
							$arrayInput = array();
							while ( $query->have_posts() ) {
								$query->the_post();
								$oRule = new rule(get_the_ID());
								if ($oRule->getisActive() =="true") {
									array_push($arrayInput, $oRule->gettypeSourceValue());
								}
							}
							$arrayInput = array_unique($arrayInput);
						?>
					<?php else : ?>
						<?php $query = new WP_Query(); ?>
					<?php endif; ?>	
					<div class="input-group-btn">
						<button type="button" class="btn btn-primary " id="<?php echo $idButton; ?>" name="submit" onClick="<?php //echo $function; ?>" style="font-size: 14px; font-weight: bold" >
							<span id="<?php echo $spanId; ?>" class="<?php echo $glyphicon; ?>" aria-hidden="true"></span>
						</button>
					</div>							
					<select name="<?php echo $idName; ?>" id="<?php echo $idName; ?>" class="<?php echo $class; ?>" data-width="100%" style="padding-left: 15px; float: right;">';
						<optgroup label="<?php echo $labelNamOptgroupe; ?>">
							<?php foreach ($arrayInput as &$value) { ?>
								<?php $oRule = new rule(get_the_ID()); ?>									
																	
									<option data-icon="glyphicon-import" value="<?php echo $value; ?>">
										<?php echo $value; ?>
									</option>
									
							<?php } ?>
						</optgroup>
					</select>				
				<?php else : ?>

				
					<?php if(get_option($optionUse_list_address)=='true') : ?>
						<div class="input-group-btn">
							<button type="button" class="btn btn-primary " id="<?php echo $idButton; ?>" name="submit" onClick="<?php //echo $function; ?>" style="font-size: 14px; font-weight: bold" >
								<span id="<?php echo $spanId; ?>" class="<?php echo $glyphicon; ?>" aria-hidden="true"></span>
							</button>
						</div>					
					
					
						<select name="<?php echo $idName; ?>" id="<?php echo $idName; ?>" class="<?php echo $class; ?>" data-width="100%" style="padding-left: 15px; float: right;">';
							<optgroup label="<?php echo $labelNamOptgroupe; ?>">
								<?php foreach ( $allListAddressesSource as $post ) : setup_postdata( $post ); ?>
									<?php $oListAddress = new listAddress($post->ID); ?>
									<option data-icon="glyphicon-import" value="<?php echo $oListAddress->getaddress(); ?>">
										<?php echo $oListAddress->getaddress(); ?>
									</option>															
								<?php endforeach; ?>
							</optgroup>
						</select>
					<?php elseif(get_option($optionUse_list_address)=='false') : ?>
						<div class="input-group-btn">
							<button type="button" data-toggle="dropdown" class="btn btn-primary " id="<?php echo $idButton; ?>" name="submit" onClick="<?php //echo $function; ?>" style="font-size: 14px; font-weight: bold" >
								<span id="<?php echo $spanId; ?>" class="<?php echo $glyphicon; ?>" aria-hidden="true"></span>
							</button>
							
							  <ul class="dropdown-menu">
								<li>
									<a style="cursor:crosshair" onClick="<?php echo $function; ?>"><?php _e('Find Me!', 'stern_taxi_fare'); ?></a>
								</li>
								<?php foreach ( $allListAddressesSource as $post ) : setup_postdata( $post ); ?>
									<?php $oListAddress = new listAddress($post->ID); ?>						  
									<li>
										<a style="cursor:pointer" onClick="setAddressFromDropDown('<?php echo $idName; ?>','<?php echo $oListAddress->getaddress(); ?>');"><?php echo $oListAddress->getaddress(); ?></a>
									</li>
								<?php endforeach; ?>
							  </ul>
						</div>
						<input id="<?php echo $inputId; ?>" name="<?php echo $inputId; ?>" type="text" class="form-control" placeholder="<?php echo $labelNameplaceholder; ?>">												
					<?php else : ?>
						<div class="input-group-btn">
							<button type="button" class="btn btn-primary " id="<?php echo $idButton; ?>" name="submit" onClick="<?php echo $function; ?>" style="font-size: 14px; font-weight: bold" >
								<span id="<?php echo $spanId; ?>" class="<?php echo $glyphicon; ?>" aria-hidden="true"></span>
							</button>
						</div>					
						<input id="<?php echo $inputId; ?>" name="<?php echo $inputId; ?>" type="text" class="form-control" placeholder="<?php echo $labelNameplaceholder; ?>">												
					<?php endif ?>
				<?php endif ?>
			</div>
			
		</div>
					
<?php
	
}	




									
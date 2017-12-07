<?php

if ( ! defined( 'ABSPATH' ) )
	exit;


Class templateCalendar{
	function __construct($widthTable, $widthInput, $showAllOptions){	
		?>
				
			
			<div class="wrap"><div id="icon-tools" class="icon32"></div>
				<h2>Calendar settings</h2>
			</div>
			
			<form name="SternSaveSettingsCalendar" method="post">
				<table name="SternSaveSettingsCalendarTable" width="<?php echo $widthTable; ?>">
					<?php showModeOptions($widthInput); ?>
					

					<?php $nameOption = "stern_taxi_fare_use_FullCalendar"; ?>
					<?php $title = __('Show FullCalendar Front', 'stern_taxi_fare'); ?>
					<?php $tooltip = __('The calendar will appear and show the niches already booked vehicle.', 'stern_taxi_fare'); ?>				
					<?php new showBoolOption($nameOption, $title, $tooltip, $widthInput); ?>
										

	
					<?php $title = __('Drag Event in full calendar', 'stern_taxi_fare'); ?>
					<?php $nameOption = "stern_taxi_fare_drag_event_FullCalendar"; ?>					
					<?php $tooltip = __('Thanks to a drand and drop, customer can book a ride in calendar. This option is not responsive!', 'stern_taxi_fare'); ?>				
					<?php $helpURL = ""; ?>
					<?php $helpLabel  = "";	?>	
					<?php new showBoolOption($nameOption, $title, $tooltip, $widthInput, $helpURL, $helpLabel); ?>
														

					<?php if($showAllOptions == true) : ?>
						<tr>
							<td>Use FullCalendar Back</td>
							
							<td>					
								<select id="stern_taxi_fare_use_FullCalendar_back" name="stern_taxi_fare_use_FullCalendar_back" style="width:300px;">
									<option <?php echo (get_option('stern_taxi_fare_use_FullCalendar_back') == "" ? 		"selected"	 : 	""	); ?> value=""></option>
									<option <?php echo (get_option('stern_taxi_fare_use_FullCalendar_back') == "true" ? 	"selected"	 : 	""	); ?> value="true">true</option>
									<option <?php echo (get_option('stern_taxi_fare_use_FullCalendar_back') == "false" ? "selected"	 : 	""	); ?> value="false">false</option>
								</select>							
							</td>						
						</tr>
					<?php endif; ?>					
					
					<?php if($showAllOptions == true) : ?>
						<?php $title = __('Time To add after a ride', 'stern_taxi_fare'); ?>
						<?php $nameOption = "stern_taxi_fare_Time_To_add_after_a_ride"; ?>					
						<?php $tooltip = __('In minutes. Example: 10. It is minimum time driver needs before another customer book a new trip', 'stern_taxi_fare', 'stern_taxi_fare'); ?>
						<?php $step="1"; ?>
						<?php $helpURL = ""; ?>
						<?php $helpLabel  = "";	?>
						<?php new showInputNumberOption($nameOption, $title, $tooltip, $widthInput, $step, $helpURL, $helpLabel ); ?>
					<?php endif; ?>						
					
					
					<?php $title = __('Granularity in minutes', 'stern_taxi_fare'); ?>
					<?php $nameOption = "stern_taxi_fare_slotDuration_min"; ?>					
					<?php $tooltip = __('In minutes. Example: 60. Granularity is the level of depth represented by the calendar.', 'stern_taxi_fare', 'stern_taxi_fare'); ?>
					<?php $step="1"; ?>
					<?php $helpURL = "http://businessintelligence.com/dictionary/granularity/"; ?>
					<?php $helpLabel  = "Granularity";	?>
					<?php new showInputNumberOption($nameOption, $title, $tooltip, $widthInput, $step, $helpURL, $helpLabel ); ?>
									
														
			
					
					<tr>
						<td><input type="submit" id="SternSaveSettingsCalendarTableSubmit" value="Save Changes" class="button-primary" name="SternSaveSettingsCalendarTableSubmit" style="width:150px;"/></td>
						
						<td></td>
					</tr>
									
				</table>
			</form>
			
			
		<?php if($showAllOptions == true) : ?>	
			<br>
			<br>
			<br>
			<br>
			<br>
			<div class="wrap"><div id="icon-tools" class="icon32"></div>
			
				<h2>Calendar</h2>
			</div>			
			<form id="selecttypeIDcarCalendar" method="get">
			
			
			
				<?php 
				$args = array(
				'post_type' => 'stern_taxi_car_type',
				'nopaging' => true,
				);

				$allPosts = get_posts( $args );
							
				if(isset($_GET['typeIdCar'])) {					
					$selectedCarTypeId = $_GET['typeIdCar'];
				} else {
					$selectedCarTypeId = "";
				}

				?>			
		

				<input type="hidden" name="page" value="<?php echo $_GET['page']; ?>">
				<select name="typeIdCar" id="typeIdCar" >
					<option value="" >Type car</option>
					<?php foreach ( $allPosts as $post ) : setup_postdata( $post ); ?>
					<?php $otypeCar = new typeCar($post->ID); ?>
						<?php $selected = ($selectedCarTypeId == $otypeCar->getid()) ? "selected" : "" ; ?>
						<option value="<?php echo $otypeCar->getid(); ?>" <?php echo $selected; ?>><?php echo $otypeCar->getcarType(); ?></option>
					<?php endforeach; ?>
				</select>
				
			
				
				
					<label>
						<input name="future" id="future" type="checkbox" <?php echo (isset($_GET['future']) ? 		"checked"	 : 	""	); ?>>Show all dates
					</label>
							
				
				
							
			</form>
			<?php
			
			if(isset($_GET['future'])) {
				$value = '';
			} else {
				$value = date("Y-m-d H:i:s");
			}
				
				
			if(isset($_GET['typeIdCar'])) {
						
					
				$selectedCarTypeId = $_GET['typeIdCar'];
				$args = array(
					'post_type' => 'stern_taxi_calendar',
					'nopaging' => true,
					'order'   => 'ASC',
					'orderby' => 'meta_value',
					'meta_key' => 'dateTimeBegin',						
					'meta_query' => array(
						array(
							'key'     => 'typeIdCar',
							'value'   => $selectedCarTypeId,
							'compare' => '=',
						),
	
						array(
							
							'key'     => 'dateTimeEnd',
							'value'   => $value,
							'compare' => '>',
							
						),						
					),
						
				);
				
		
				$allPosts = get_posts( $args );				
						
				?>
				
				<?php if(get_option('stern_taxi_fare_use_FullCalendar_back')=="true") : ?>
					<?php if(get_option('stern_taxi_fare_slotDuration_min') =="") : ?>					
						<?php _e('Please set a  Granularity to show calendar', 'stern_taxi_fare'); ?>
					<?php else: ?>
						<div id='detailsEvents'></div>
						<div id='notificationCalendar' style="height:20px;"></div>
						<br><br>
						<div id='calendar'></div>
					<?php endif; ?>						
				<?php else: ?>					
					<br>
					<form method="post">
						<table class="displayrecord">
							<thead  align="left">
								<tr class="home">
									<th>Id</th>
									<th>type Car</th>
									<th>typeCalendar</th>
									<th></th>
									<th>dateTimeBegin</th>
									<th></th>									
									<th>dateTimeEnd</th>
									
									<th>userName</th>
									<th>WooCommerceOrderId</th>
									<th>IsRepeat</th>
									<th>Delete</th>
								</tr>
							</thead>
							<tbody>
							<?php
							foreach ( $allPosts as $post ) : setup_postdata( $post );
							$oCalendar = new calendar($post->ID);
							$otypeCar = new typeCar($oCalendar->gettypeIdCar());
							?>
							
								<tr>
									<td><?php echo $oCalendar->getid() ?></td>
									<td><?php echo $otypeCar->getcarType()." (". $oCalendar->gettypeIdCar() .")" ?></td>
									<td><?php echo $oCalendar->gettypeCalendar(); ?></td>
									<td></td>
									<td><?php echo $oCalendar->getdateTimeBegin(); ?></td>
									<td></td>
									<td><?php echo $oCalendar->getdateTimeEnd(); ?></td>
									
									<td><a href="<?php echo admin_url( 'user-edit.php?user_id='.$oCalendar->getuserId() );?>"> <?php echo the_author_meta( 'user_nicename' , $oCalendar->getuserId() ); ?></a></td>
									<td><a href="<?php echo get_edit_post_link( $oCalendar->getwooCommerceOrderId() ); ?>"> <?php echo $oCalendar->getwooCommerceOrderId(); ?></a></td>
									<td><?php echo $oCalendar->getisRepeat(); ?></td>
									<td><input type="checkbox" name="remove<?php echo $post->ID; ?>" value="yes"></td>
								</tr>
							<?php endforeach; 
								wp_reset_postdata();
							?>	
								<tr>
									<td></td>
									<td><input type="hidden" name="typeIdCar" value="<?php echo $selectedCarTypeId; ?>"></td>
									
									<td>
										<select name="typeCalendar">
											<option value=""></option>
											<option value="disabledTimeIntervals">Disabled Time Interval</option>
										</select>							
									</td>
									<td><input type="date" name="dateBegin" value="<?php echo date('Y-m-d'); ?>" ></td>
									<td><input type="time" name="dateTimeBegin" value="<?php echo date('H:i'); ?>" ></td>
									<td><input type="date" name="dateEnd" value="<?php echo date('Y-m-d'); ?>" ></td>
									<td><input type="time" name="dateTimeEnd" value="<?php echo date('H:i'); ?>" ></td>
									
									<td></td>
									<td></td>
									<td>
										<select name="isRepeat">
											<option value=""></option>
											<option value="true">true</option>
										</select>	
									</td>
				
									<td>
										<input type="submit" id="ruleSubmit" value="Go" class="button-primary" name="calendarSubmit" />
									</td>
								</tr>
							</tbody>
						</table>
					</form>
				<?php endif; ?>	

				<?php
			}
			?>
		<?php endif; ?>
		<?php
	}
}
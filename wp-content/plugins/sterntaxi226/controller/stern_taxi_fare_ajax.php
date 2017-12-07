<?php




add_action( 'wp_ajax_stern_options', 'stern_options' );
add_action( 'wp_ajax_nopriv_stern_options', 'stern_options' );
function stern_options() {
	if(isset($_POST['drag_event_FullCalendar'])) {
		echo get_option('stern_taxi_fare_drag_event_FullCalendar');
		wp_die();
	}
	if(isset($_POST['stern_taxi_use_list_address_source'])) {
		echo get_option('stern_taxi_use_list_address_source');
		wp_die();
	}	
	if(isset($_POST['stern_taxi_use_list_address_destination'])) {
		echo get_option('stern_taxi_use_list_address_destination');
		wp_die();
	}
	if(isset($_POST['stern_taxi_fare_typeCar_calendar_as_input'])) {
		echo get_option('stern_taxi_fare_typeCar_calendar_as_input');
		wp_die();
	}	
	if(isset($_POST['stern_taxi_fare_use_calendar'])) {
		echo get_option('stern_taxi_fare_use_calendar');
		wp_die();
	}
	if(isset($_POST['stern_taxi_fare_seat_field_as_input'])) {
		echo get_option('stern_taxi_fare_seat_field_as_input');
		wp_die();
	}
	if(isset($_POST['stern_taxi_fare_calendar_sideBySide'])) {
		echo get_option('stern_taxi_fare_calendar_sideBySide');
		wp_die();
	}
	if(isset($_POST['getOptions'])) {
			global $woocommerce;
			$checkout_url = $woocommerce->cart->get_checkout_url();
			$currency_symbol = get_woocommerce_currency_symbol();
			
		$options = array(
			'stern_taxi_fare_calendar_sideBySide' 			=> get_option('stern_taxi_fare_calendar_sideBySide'),
			'stern_taxi_fare_seat_field_as_input' 			=> get_option('stern_taxi_fare_seat_field_as_input'),
			'stern_taxi_fare_use_calendar' 					=> get_option('stern_taxi_fare_use_calendar'),
			'stern_taxi_fare_typeCar_calendar_as_input' 	=> get_option('stern_taxi_fare_typeCar_calendar_as_input'),
			'stern_taxi_fare_formatDate' 					=> getFormatDate("javascript"),
			'stern_taxi_fare_formatTime' 					=> getFormatTime("javascript"),
			'stern_taxi_fare_formatDateTime' 				=> getFormatDateTime("javascript"),
			'stern_taxi_use_list_address_source' 			=> get_option('stern_taxi_use_list_address_source'),
			'stern_taxi_use_list_address_destination' 		=> get_option('stern_taxi_use_list_address_destination'),
			'stern_taxi_fare_country' 						=> get_option('stern_taxi_fare_country'),
			'checkout_url'									=> $checkout_url,
			'currency_symbol'								=> $currency_symbol,
			'stern_taxi_fare_apiGoogleKey' 					=> get_option('stern_taxi_fare_apiGoogleKey'),
			'stern_taxi_fare_drag_event_FullCalendar' 		=> get_option('stern_taxi_fare_drag_event_FullCalendar'),
			'isBootstrapSelectEnabale' 						=> isBootstrapSelectEnabale(),
			'stern_taxi_fare_auto_open_map' 				=> get_option('stern_taxi_fare_auto_open_map'),			
			'stern_taxi_fare_debug' 						=> get_option('stern_taxi_fare_debug'),	
			'stern_taxi_fare_map_style' 					=> get_option('stern_taxi_fare_map_style'),
			'getOptionMapStyle' 							=> getOptionMapStyle(get_option('stern_taxi_fare_map_style')),
			'stern_taxi_fare_show_markers_in_map'			=> get_option('stern_taxi_fare_show_markers_in_map'),
			'textErrorMessage' 								=> __('Address not found', 'stern_taxi_fare'),
			'textErrorDateRoundTrip'						=> __('Date round trip is wrong', 'stern_taxi_fare'),
			'textSuccessFixedPrice'							=> __('This is a fixed price!', 'stern_taxi_fare'),
			'stern_taxi_fare_show_seat_input'				=> get_option('stern_taxi_fare_show_seat_input'),
			'stern_taxi_fare_show_rules_in_dropdown_inputs'	=> get_option('stern_taxi_fare_show_rules_in_dropdown_inputs'),
			


				
	
			
		);
		echo json_encode($options);
		wp_die();
	}		
	
}
	

add_action( 'wp_ajax_my_ajax_picker', 'my_ajax_picker' );
add_action( 'wp_ajax_nopriv_my_ajax_picker', 'my_ajax_picker' );
function my_ajax_picker() {
	if(isset($_POST['getCalendarsForDateTimePicker'])) {
		$arrayCalendar = '';
		$selectedCarTypeId =  $_POST['selectedCarTypeId'];
		$duration =  $_POST['duration'];
		$time_To_add_after_a_ride=  get_option('stern_taxi_fare_Time_To_add_after_a_ride');
		$carseat = get_post_meta($selectedCarTypeId ,'_stern_taxi_car_type_carseat',true);

			$selectedCarTypeId = $selectedCarTypeId;
			$args = array(
				'post_type' => 'stern_taxi_calendar',
				'nopaging' => true,
				'meta_query' => array(
					array(
						'key'     => 'typeIdCar',
						'value'   => $selectedCarTypeId,
						'compare' => '=',
					),
				),
				
			);

			$allPosts = get_posts( $args );	
			foreach ( $allPosts as $post ) {
				setup_postdata( $post );
				$oCalendar = new calendar($post->ID);
				if( (date($oCalendar->getdateTimeEnd()) >  date("Y-m-d H:i:s"))  or  $oCalendar->getisRepeat()=="true" ) {
					$post_id = $post->ID;
					//$arrayCalendar[$post_id]["typeCalendar"] = $oCalendar->gettypeCalendar();					
					$minutes_to_add = intval($duration) + intval($time_To_add_after_a_ride);
					
					
					$dateTimeBegin = 	date('Y-m-d H:i:s',strtotime(date($oCalendar->getdateTimeBegin() ). " - ".$minutes_to_add." minutes"));
					$dateTimeEnd = 		date('Y-m-d H:i:s',strtotime(date($oCalendar->getdateTimeEnd() ). " + ".intval($time_To_add_after_a_ride)." minutes"));
					$arrayCalendar[$post_id]["dateTimeBegin"] 		= 	$dateTimeBegin;
					$arrayCalendar[$post_id]["dateTimeEnd"] 		=	$dateTimeEnd;
					$arrayCalendar[$post_id]["dateTimeBeginReal"] 	= 	$oCalendar->getdateTimeBegin();					
					$arrayCalendar[$post_id]["dateTimeEndReal"] 	=	$oCalendar->getdateTimeEnd() ;
					
					if($oCalendar->getisRepeat() == "true") {
						
						for($i=1;$i<51;$i++) {
							$arrayCalendar[$post_id."_".$i]["dateTimeBegin"] 		= date('Y-m-d H:i:s',strtotime(date($dateTimeBegin ). " + ". $i*7 ." days"));
							$arrayCalendar[$post_id."_".$i]["dateTimeEnd"] 			= date('Y-m-d H:i:s',strtotime(date($dateTimeEnd ). " + ". $i*7 ." days")); 
							$arrayCalendar[$post_id."_".$i]["dateTimeBeginReal"] 	= date('Y-m-d H:i:s',strtotime(date($oCalendar->getdateTimeBegin() ). " + ". $i*7 ." days")); 
							$arrayCalendar[$post_id."_".$i]["dateTimeEndReal"] 		= date('Y-m-d H:i:s',strtotime(date($oCalendar->getdateTimeEnd() ). " + ". $i*7 ." days")); 
												
						}
						
					}
					
					

						
					
				//	$arrayCalendar[$post->ID]["dateTimeBegin"] = $oCalendar->getdateTimeBegin();
					
					
					
				//	$arrayCalendar[$post->ID]["dateTimeEnd"] = $oCalendar->getdateTimeEnd();
					$arrayCalendar[$post->ID]["isRepeat"] = $oCalendar->getisRepeat();
				}

			}

		
		$response["carseat"] = $carseat;
		$response["arrayCalendar"] = $arrayCalendar;

		
		
		echo json_encode($response);
		wp_die();		
	}
	if(isset($_POST['refreshBabySeats'])) {	
		$selectedCarTypeId =  $_POST['selectedCarTypeId'] ;
		$oTypeCar = new typeCar($selectedCarTypeId );
		
		$carSeatChild = $oTypeCar->getcarSeatChild();		

		$response["carseat"] = 345;
		echo json_encode($response);
		wp_die();	
	
	}
	if(isset($_POST['refreshSeats'])) {	
		$arrayCalendar = '';
		$selectedCarTypeId =  $_POST['selectedCarTypeId'] ;
		$oTypeCar = new typeCar($selectedCarTypeId );
		
		$carSeatChild = $oTypeCar->getcarSeatChild();	
		$carseat =  $oTypeCar->getcarSeat();	
		

				$selectedCarTypeId = $selectedCarTypeId;
				$args = array(
					'post_type' => 'stern_taxi_calendar',
					'nopaging' => true,
					'meta_query' => array(
						array(
							'key'     => 'typeIdCar',
							'value'   => $selectedCarTypeId,
							'compare' => '=',
						),
					),
					
				);

				$allPosts = get_posts( $args );	
				foreach ( $allPosts as $post ) {
					setup_postdata( $post );
					$oCalendar = new calendar($post->ID);
					if(date($oCalendar->getdateTimeEnd()) >  date("Y-m-d H:i:s")) {
						$arrayCalendar[$post->ID]["typeCalendar"] = $oCalendar->gettypeCalendar();					
						$arrayCalendar[$post->ID]["dateTimeBegin"] = $oCalendar->getdateTimeBegin();					
						$arrayCalendar[$post->ID]["dateTimeEnd"] = $oCalendar->getdateTimeEnd();
						$arrayCalendar[$post->ID]["isRepeat"] = $oCalendar->getisRepeat();
					}

				}

		
		$response["carseat"] = $carseat;
		$response["carSeatChild"] = $carSeatChild;
		$response["arrayCalendar"] = $arrayCalendar;

		
		
		
		echo json_encode($response);
		wp_die();
	}
	
}




add_action( 'wp_ajax_my_ajax', 'my_ajax' );
add_action( 'wp_ajax_nopriv_my_ajax', 'my_ajax' );
function my_ajax() {
	if(isset($_POST['getAllTypeCar']) ) {
	
	}
	if(isset($_POST['getTypeCarAvailable']) ) {
		$availableTypeCars = array();
		$log = "";
		$dateTimePickUp 				= ( $_POST['dateTimePickUp'] );
		$duration 						= ( $_POST['duration'] );
		$is_round_trip 					= ( $_POST['is_round_trip'] );
		$dateTimePickUpRoundTrip 		= ( $_POST['dateTimePickUpRoundTrip'] );
		$carSeat 						= ( $_POST['carSeat'] );

		if(get_option('stern_taxi_fare_use_calendar') == "true") {
			$args = array(
				'post_type' => 'stern_categoryCar',
				'nopaging' => true,
				'order'     => 'ASC',
				'orderby' => 'meta_value',
				'meta_key' => 'orderCategoryCar'
			);
			$allCategoryCar = get_posts( $args );
			
			foreach ( $allCategoryCar as $postCateg ) {
				setup_postdata( $postCateg );
				$oCategoryCar = new categoryCar($postCateg->ID);
				$cartypesOptGroup = $oCategoryCar->getnameCategoryCar();
				$allTypeCars = getAllCarsByCateg($oCategoryCar->getid()); 
				$loopCateg=0;
				
				
				
				
				foreach ( $allTypeCars as $post ) {
					setup_postdata( $post );
					$oTypeCar = new typeCar($post->ID);
					$selectedCarTypeId = $oTypeCar->getid();
					$carSeatMax = $oTypeCar->getcarSeat();
					
					
					$isCarSeatAvailable = isCarSeatAvailable($carSeat,$carSeatMax);
					
					$isCarAvailable  = isCarAvailable($selectedCarTypeId,$dateTimePickUp,$duration);
					if($is_round_trip=="true") {
						$isCarAvailableRoundTrip  = isCarAvailable($selectedCarTypeId,$dateTimePickUpRoundTrip,$duration);
					} else {
						$isCarAvailableRoundTrip  = true;
					}
					if($isCarAvailable == true and $isCarAvailableRoundTrip == true and $isCarSeatAvailable == true) {
						$loopCateg++;
						array_push($availableTypeCars, 
							array (
								$selectedCarTypeId, $oTypeCar->getcarType(), $cartypesOptGroup, $loopCateg , $dateTimePickUp
							)
						);
					}
				}
			}
		} else {
			$args = array(
				'post_type' => 'stern_taxi_car_type',
				'nopaging' => true,
				'order'     => 'ASC',
				'orderby' => 'meta_value',
				'meta_key' => '_stern_taxi_car_type_organizedBy'
			);
			$allTypeCars = get_posts( $args );	
			foreach ( $allTypeCars as $post ) {
				$oTypeCar = new typeCar($post->ID);
				$selectedCarTypeId = $oTypeCar->getid();
				
				array_push($availableTypeCars, 
					array (
						$selectedCarTypeId, $oTypeCar->getcarType()
					)
				);
			}		
			echo json_encode($availableTypeCars);
			wp_die();		
		}
		
		echo json_encode($availableTypeCars);
		wp_die();


		
	}
	if(isset($_POST['getPriceAjax']) ) {	

		$selectedCarTypeId				= ( $_POST['selectedCarTypeId'] );
		$duration 						= ( $_POST['duration'] );
		$nbToll 						= ( $_POST['nbToll'] );
		$distance 						= ( $_POST['distance'] );
		$car_seats 						= ( $_POST['car_seats'] );
		$is_round_trip 					= ( $_POST['is_round_trip'] );
		$source 						= ( $_POST['source'] );
		$destination 					= ( $_POST['destination'] );
		$distanceHtml					= ( $_POST['distanceHtml'] );
		$durationHtml					= ( $_POST['durationHtml'] );		
		$cartypes						= ( $_POST['cartypes'] );
		$dateTimePickUp 				= ( $_POST['dateTimePickUp'] );
		$dateTimePickUpRoundTrip		= ( $_POST['dateTimePickUpRoundTrip'] );
		$babySeat						= ( $_POST['babySeat'] );
		
		
		
				
		$price = getPrice($distance,$duration,$nbToll,$selectedCarTypeId,$car_seats ,$is_round_trip, $source,$destination,$babySeat);
		$estimated_fare = $price["estimated_fare"];
		$estimated_fare_HTML = $price["estimated_fare_HTML"];
		$suitcases = $price["suitcases"];
		$suitcasesSmall = $price["suitcasesSmall"];

		
		
		saveToSesstion(		
			$distance, 
			$distanceHtml, 
			$duration, 
			$durationHtml, 
			$estimated_fare, 
			$estimated_fare_HTML,
			$selectedCarTypeId, 
			$cartypes, 
			$source, 
			$destination, 
			$car_seats, 
			$dateTimePickUp, 
			$nbToll, 
			$is_round_trip, 
			$dateTimePickUpRoundTrip,
			$suitcases,
			$suitcasesSmall
		);	
							
							
							
		echo json_encode($price);
		wp_die();	
		
	}
	if(isset($_POST['setSessionDataAjax']) ) {	
		$distance				= ( $_POST['distance'] );
		$selectedCarTypeId		= ( $_POST['selectedCarTypeId'] );
		$distanceHtml			= ( $_POST['distanceHtml'] );
		$duration				= ( $_POST['duration'] );
		$durationHtml			= ( $_POST['durationHtml'] );
		$estimated_fare			= ( $_POST['estimated_fare'] );
		$cartypes				= ( $_POST['cartypes'] );
		$source					= ( $_POST['source'] );
		$destination			= ( $_POST['destination'] );
		$car_seats				= ( $_POST['car_seats'] );
		$dateTimePickUp			= ( $_POST['dateTimePickUp'] );
		$nbToll					= ( $_POST['nbToll'] );
		$is_round_trip			= ( $_POST['is_round_trip'] );
		$dateTimePickUpRoundTrip= ( $_POST['dateTimePickUpRoundTrip'] );
	
		
		
	/*
		
		saveToSesstion(		$distance, 
							$distanceHtml, 
							$duration, 
							$durationHtml, 
							$estimated_fare, 
							$selectedCarTypeId, 
							$cartypes, 
							$source, 
							$destination, 
							$car_seats, 
							$dateTimePickUp, 
							$nbToll, 
							$is_round_trip, 
							$dateTimePickUpRoundTrip );	

		*/
	}	
	if(isset($_POST['getSuitcases']) ) {
		$selectedCarTypeId	= ( $_POST['selectedCarTypeId'] );
		$otypeCar = new typeCar($selectedCarTypeId);
		$suitcases = $otypeCar->getsuitcases();
		echo json_encode($suitcases);
		wp_die();	
	}
	if(isset($_POST['getSuitcasesSmall']) ) {
		$selectedCarTypeId	= ( $_POST['selectedCarTypeId'] );
		$otypeCar = new typeCar($selectedCarTypeId);
		$suitcasesSmall = $otypeCar->getsuitcasesSmall();
		echo json_encode($suitcasesSmall);
		wp_die();	
	}
	if(isset($_POST['getDestinationListfromRules']) ) {
		$source = ( $_POST['source'] );
		$args = array(
				'post_type' => 'stern_taxi_rule',
				'nopaging' => true,	
				'orderby' => 'ID',	
				'order' => 'asc',
				'meta_query' => array(
					array(
						'key'     => 'typeSourceValue',
						'value'   => $source,
						'compare' => '=',
					),
				),				
			);		
		$query = new WP_Query($args);
		$res=array();
		while ( $query->have_posts()) {			
			$query->the_post();
			$oRule = new rule(get_the_ID());
			$oRule->gettypeDestinationValue();
			array_push($res,$oRule->gettypeDestinationValue());
		}
		$array_unique = array_unique($res);
		$array_renumbered = array_values($array_unique);
		echo json_encode($array_renumbered);
		wp_die();	
		
	}
	if(isset($_POST['addToCart']) ) {
		global $woocommerce;
		if (get_option('stern_taxi_fare_emptyCart') != 'false') {
			$woocommerce->cart->empty_cart(); 
		}	
		
		$cart_item_key = $woocommerce->cart->add_to_cart( get_option('stern_taxi_fare_product_id_wc') );
		echo json_encode("product added to cart: ".$cart_item_key);
		wp_die();	
	}
	if(isset($_POST['getTripInfo']) ) {
		$destination = "";
		$source 						= ( $_POST['source'] );
		$destinationFinal 				= ( $_POST['destination'] );
		$googleWaypoints 				= ( $_POST['googleWaypoints'] );
		if(isset($_POST['arrayWaypoints'])) {
			$arrayWaypoints 				= ( $_POST['arrayWaypoints'] );
			foreach($arrayWaypoints as $waypoints ) {			
				$source 		= $source . "|" . $waypoints;
				$destination 	= $destination . "|" . $waypoints;
			}			
		}
/*		
		if($arrayWaypoints !=null) {
		}
		*/
		
		if (get_option('stern_taxi_fare_allow_waypoints')=='true') {
			$destination 	= $destination . "|" . $destinationFinal;
		} else {
			$destination 	= $destinationFinal;
		}
		

		
		$GoogleMapsData = getGoogleMapsDataFunction($source, $destination );
		/*
		$GoogleMapsDataStatus = $GoogleMapsData["status"];
		if($GoogleMapsDataStatus != "errorGoogleEmpty") {		
			$distance = $GoogleMapsData["DistanceValueKMOrMiles"];
			$distanceHtml = $GoogleMapsData["DistanceText"];
			$duration = $GoogleMapsData["DurationValue"];
			$durationHtml = $GoogleMapsData["DurationText"];	
			$nbToll = getCountToll($source,$destination);
		}
		$response["distance"] = $distance;
		$response["distanceHtml"] = $distanceHtml;
		$response["duration"] = $duration;
		$response["durationHtml"] = $durationHtml;
		$response["nbToll"] = $nbToll;	
*/		
		
		echo json_encode($GoogleMapsData);
		wp_die();		
	}

	if(isset($_POST['getTripInfoGlobal'])) {
		global $wpdb;

		$cartypes 						= ( $_POST['cartypes'] );
		$source 						= ( $_POST['source'] );
		$destination 					= ( $_POST['destination'] );
		$car_seats 						= ( $_POST['car_seats'] );
		$dateTimePickUp 				= ( $_POST['dateTimePickUp'] );
		$selectedCarTypeId 				= ( $_POST['selectedCarTypeId'] );	
		$is_round_trip 					= ( $_POST['stern_taxi_fare_round_trip'] );
		$dateTimePickUpRoundTrip 		= ( $_POST['dateTimePickUpRoundTrip'] );

		$otypeCar = new typeCar($selectedCarTypeId);
		$carFare = $otypeCar->getcarFare();
		$suitcases = $otypeCar->getsuitcases();
		$suitcasesSmall = $otypeCar->getsuitcasesSmall();
		$km_fare = $otypeCar->getfarePerDistance();
		$fare_minimum					= getFareMinimum();
		$stern_taxi_fare_fixed_amount 	= get_option('stern_taxi_fare_fixed_amount'); 
		$estimated_fare					= 0;
		$durationHtml					= "";
		$GoogleMapsData = getGoogleMapsDataFunction($source,$destination);
		$GoogleMapsDataStatus = $GoogleMapsData["status"];
		if($GoogleMapsDataStatus != "errorGoogleEmpty") {
			/*
			$distance = $GoogleMapsData["DistanceValueKMOrMiles"];
			$distanceHtml = $GoogleMapsData["DistanceText"];
			$duration = $GoogleMapsData["DurationValue"];
			$durationHtml = $GoogleMapsData["DurationText"];	
			$nbToll = getCountToll($source,$destination);	
			$suitcases = get_post_meta($selectedCarTypeId ,'_stern_taxi_car_type_suitcases',true);
			*/
			$price = getPrice($distance,$duration,$nbToll,$selectedCarTypeId,$car_seats ,$is_round_trip ,$source,$destination );			
			
		} else {
			$price["estimated_fare"] = "errorGoogleEmpty";
			$price["statusGoogleGlobal"] = "errorGoogleEmpty";
		}
		
		
		$response["distance"] = $GoogleMapsData["distance"];
		$response["distanceHtml"] = $GoogleMapsData["distanceHtml"];
		$response["duration"] = $GoogleMapsData["duration"];
		$response["durationHtml"] = $GoogleMapsData["durationHtml"];
		$response["nbToll"] = $GoogleMapsData["nbToll"];
		$response["estimated_fare"] = $price["estimated_fare"];
		$response["cartypes"] = $cartypes;
		$response["carFare"] = $carFare;	
		$response["suitcases"] = $suitcases;
		$response["suitcasesSmall"] = $suitcasesSmall;
		$response["car_seats"] = $car_seats;	
		$response["km_fare"] = $km_fare;	
		$response["nameRule"] =  $price["nameRule"];
		$response["RuleApproved"] =  $price["RuleApproved"]; 
		$response["selectedCarTypeId"] = $selectedCarTypeId;
		$response["statusGoogleGlobal"] = $price["statusGoogleGlobal"];
		$response["status"] = $price["status"];
		$response["statusText"] = $price["statusText"];
		$response["dateTimePickUp"] = $dateTimePickUp ;
		$response["dateTimePickUpstrtotime"] = strtotime($dateTimePickUp );		
		$response["logParsingRule"] =$price["logParsingRule"];
		
		/*
		saveToSesstion(		$distance, 
							$distanceHtml, 
							$duration, 
							$durationHtml, 
							$estimated_fare, 
							$selectedCarTypeId, 
							$cartypes, 
							$source, 
							$destination, 
							$car_seats, 
							$dateTimePickUp, 
							$nbToll, 
							$is_round_trip, 
							$dateTimePickUpRoundTrip );
							*/

		echo json_encode($response);
		wp_die();
	}
	
}

function saveToSesstion(
		$distance, 
		$distanceHtml, 
		$duration, 
		$durationHtml, 
		$estimated_fare, 
		$estimated_fare_HTML,
		$selectedCarTypeId, 
		$cartypes, 
		$source, 
		$destination, 
		$car_seats, 
		$dateTimePickUp, 
		$nbToll, 
		$is_round_trip, 
		$dateTimePickUpRoundTrip,
		$suitcases, 
		$suitcasesSmall
	) {
		
		global $woocommerce;
		
		$woocommerce->session->set_customer_session_cookie(true);
		
		if($is_round_trip=="false") {
			$dateTimePickUpRoundTrip ="";
		}

		
		WC()->session->set( 'distance' , $distance );
		WC()->session->set( 'distanceHtml' , $distanceHtml );
		WC()->session->set( 'duration' , $duration );
		WC()->session->set( 'durationHtml' , $durationHtml );
		WC()->session->set( 'estimated_fare' , $estimated_fare );
		WC()->session->set( 'estimated_fare_HTML' , $estimated_fare_HTML );
		WC()->session->set( 'selectedCarTypeId' , $selectedCarTypeId );
		WC()->session->set( 'cartypes' , $cartypes );
		WC()->session->set( 'source' , $source );
		WC()->session->set( 'destination' , $destination );
		WC()->session->set( 'car_seats' , $car_seats );
		WC()->session->set( 'dateTimePickUp' , $dateTimePickUp );
		WC()->session->set( 'nbToll' , $nbToll );
		WC()->session->set( 'stern_taxi_fare_round_trip' , $is_round_trip );
		WC()->session->set( 'dateTimePickUpRoundTrip' , $dateTimePickUpRoundTrip );
		WC()->session->set( 'suitcases' , $suitcases );
		WC()->session->set( 'suitcasesSmall' , $suitcasesSmall );
		
					
}


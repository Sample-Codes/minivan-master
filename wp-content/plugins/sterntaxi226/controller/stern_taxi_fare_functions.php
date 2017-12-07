<?php

if ( ! defined( 'ABSPATH' ) )
	exit;


function isProductTaxiIsInCart($order_id) {
	global $wpdb;
	$order = new WC_Order( $order_id );
	$items = $order->get_items(); 
	$checkIfInCart=0;
	foreach ($items as $key => $product ) {
		$product_id = $product['product_id'];
		if($product_id == get_option('stern_taxi_fare_product_id_wc')) {
			$checkIfInCart = $checkIfInCart+1;
		}
	}
	if($checkIfInCart>0) {
		return true;
	} else {
		return false;
	}
}
  
  
function getNb_post_to_show() {
	
	$posts_per_page = get_option('stern_taxi_fare_nb_post_to_show');
	if($posts_per_page =="") {
		$posts_per_page =10;
	}
	return $posts_per_page;
}

$posts_per_page = get_option('stern_taxi_fare_nb_post_to_show');

  
function getURLAdminWoocommerceOrder($orderId){
	return get_site_url().'/wp-admin/post.php?post='.$orderId.'&action=edit';
	//return get_site_url() . "/my-account/view-order/". $orderId;
}



function showImageStatus($status) {
	if ($status =="ok") {
		$urlImg = (dirname(plugins_url("/", __FILE__))).'/img/button_ok.png';
	} else {
		$urlImg = (dirname(plugins_url("/", __FILE__))).'/img/b16x16_cancel.png';
	}
//	echo $urlImgError;
	
	echo "<img src=".$urlImg."> ";
}

		
		
		
		
		

function showModeOptions($widthInput) {	 
	$urlDocOptionsCalendar = getUrlServer() . "docs/options-for-calendar/";
	$NameDocOptionsCalendar  = "This option will impact process of calendar";
	?>
	<?php $nameOption = "stern_taxi_fare_typeCar_calendar_as_input"; ?>
	<?php $title = __('Show calendar field as an input', 'stern_taxi_fare'); ?>
	<?php $tooltip = __('Choose if this field will appear on the top or below in form. This option will impact others fields like calendar', 'stern_taxi_fare'); ?>				
	<?php new showBoolOption($nameOption, $title, $tooltip, $widthInput,$urlDocOptionsCalendar, $NameDocOptionsCalendar); ?>

	<?php $nameOption = "stern_taxi_fare_seat_field_as_input"; ?>
	<?php $title = __('Show seat field as an input', 'stern_taxi_fare'); ?>
	<?php $tooltip = __('Only true when option "Show calendar field as an input" is true', 'stern_taxi_fare', 'stern_taxi_fare'); ?>				
	<?php new showBoolOption($nameOption, $title, $tooltip, $widthInput, $urlDocOptionsCalendar, $NameDocOptionsCalendar); ?>

	<?php $nameOption = "stern_taxi_fare_use_calendar"; ?>
	<?php $title = __('Enable booking calendar', 'stern_taxi_fare'); ?>
	<?php $tooltip = __('This option will make the vehicule unavailable when the vehicle has already been booked', 'stern_taxi_fare', 'stern_taxi_fare'); ?>				
	<?php new showBoolOption($nameOption, $title, $tooltip, $widthInput, $urlDocOptionsCalendar, $NameDocOptionsCalendar); ?>

	<?php
}


function getUrlServer () {
	$urlServer = "http://stern-taxi-fare.sternwebagency.com/";
	return $urlServer;
}

if(isset($_GET["page"] )) {
	if(
		$_GET["page"] == "SternTaxiPage" or
		$_GET["page"] == "stern-add-type-car" or
		$_GET["page"] == "stern-design" or
		$_GET["page"] == "stern-Pricing-rules" or
		$_GET["page"] == "stern-Pricing-list-addresses" or		
		$_GET["page"] == "stern-calendar"
	)		
	{		
			function custom_admin_notice() {
				$notice = getNoticeAPI();
				if($notice !="0" and $notice!="" and $notice!=null ) {
					echo '<div class="updated"><p>'.$notice .'</p></div>';
				}
			}
			add_action( 'admin_notices', 'custom_admin_notice' );
		
	}
}


function getNoticeAPI() {		
	$url = getUrlServer() . "wp-admin/admin-ajax.php?action=notice";
	$result_from_json = wp_remote_fopen($url);
	return $result_from_json;	
}


function getAllTypeCat() {
	$args = array(
		'post_type' => 'stern_categoryCar',
		'nopaging' => true,
	);
	$allPosts = get_posts( $args );	
	return $allPosts;
}

function getAllTypeCar() {
	$args = array(
		'post_type' => 'stern_taxi_car_type',
		'nopaging' => true,
	);
	$allPosts = get_posts( $args );	
	return $allPosts;
}

function getCountTypeCat($allPosts=null) {
	
	if($allPosts==null) {
		return count(getAllTypeCat());
	} else {
		return count($allPosts);
	}
}

function saveToCalendar($order_id ) {
	$id_calendar = getCalendarIdPerOrderId($order_id );
	if($id_calendar =="") {
		$stern_taxi_fare_round_trip = get_post_meta( $order_id , '_stern_taxi_fare_round_trip', true );
		$selectedCarTypeId = get_post_meta( $order_id , '_selectedCarTypeId', true );
		$duration = get_post_meta( $order_id , '_duration', true );
		
		
		 
		//$dateTimePickUpRoundTrip = date(getFormatDateTime("php"),strtotime(get_post_meta( $order_id , '_dateTimePickUpRoundTrip', true )));
		//$dateTimePickUp = date(getFormatDateTime("php"),strtotime(get_post_meta( $order_id , '_local_pickup_time_select', true )));
		
		$dateTimePickUpRoundTrip = get_post_meta( $order_id , '_dateTimePickUpRoundTrip', true );
		$dateTimePickUp = get_post_meta( $order_id , '_local_pickup_time_select', true );
		
		
		$idCalendar = saveCalendar($selectedCarTypeId,$dateTimePickUp,$duration,$order_id);
		update_post_meta( $order_id, '_idCalendar', $idCalendar );
		if($stern_taxi_fare_round_trip=="true") {
			$idCalendarRoundTrip = saveCalendar($selectedCarTypeId,$dateTimePickUpRoundTrip,$duration,$order_id);
			update_post_meta( $order_id, '_idCalendarRoundTrip', $idCalendarRoundTrip );
		}
	}
}

function saveCalendar($selectedCarTypeId,$dateTimePickUp,$duration,$order_id) {
	$oCalendar = new calendar();
	$oCalendar->settypeIdCar($selectedCarTypeId);
	$oCalendar->settypeCalendar("disabledTimeIntervals");	
	//$fullDuration = $duration + get_option('stern_taxi_fare_Time_To_add_after_a_ride');
	$fullDuration = round($duration);
	$dateTimePickUpEnd = date("Y-m-d H:i:s", strtotime('+'.$fullDuration.' minutes', strtotime($dateTimePickUp))); 
	$estimatedDateOfArrival = date("Y-m-d H:i:s", strtotime('+'.$duration.' minutes', strtotime($dateTimePickUp)));
		
	
	$oCalendar->setdateTimeBegin($dateTimePickUp); 
	$oCalendar->setdateTimeEnd($dateTimePickUpEnd);	
	$oCalendar->setwooCommerceOrderId($order_id);	
	$id = $oCalendar->save();
	return $id;
}
	
function getCountTypeCar($allPosts=null) {
	
	if($allPosts==null) {
		return count(getAllTypeCar());
	} else {
		return count($allPosts);
	}
}
			
function updateOptionsSternTaxiFare() {
	$arrayOption = array(
		/* settings */
		'stern_taxi_fare_country',
		'stern_taxi_fare_apiGoogleKey',
		'stern_taxi_fare_avoid_highways_in_calculation',
	/*	'stern_taxi_fare_minimum', */
		'stern_taxi_fare_product_id_wc',
		'stern_taxi_fare_km_mile',
		'stern_taxi_fare_formatDate',
		'stern_taxi_fare_formatTime',
		'stern_taxi_fare_address_saved_point',
		'stern_taxi_fare_address_saved_point2',
		'stern_taxi_fare_round_trip',
		'First_date_available_in_hours',
		'First_date_available_roundtrip_in_hours',
		'max_queries_to_API_google',
		'Time_between_each_API_google_queries',
		'stern_taxi_fare_allow_waypoints',
		'stern_taxi_fare_debug',
		'stern_taxi_fare_envato_purchase_code',
		'stern_taxi_fare_use_traffic_in_calculation',
		'stern_taxi_fare_lat_origin_circle',
		'stern_taxi_fare_long_origin_circle',
		'stern_taxi_fare_radius_origin_circle',
		
		
		/* pricing rules */
		'stern_taxi_Include_SeatFare_in_pricing_rules',
		'stern_taxi_fare_nb_post_to_show',
		
		
		/* List Address */
		'stern_taxi_use_list_address_source',
		'stern_taxi_use_list_address_destination',
		'stern_taxi_fare_show_rules_in_dropdown_inputs',
		
		
		/* calendar */
		'stern_taxi_fare_use_calendar',
		'stern_taxi_fare_use_FullCalendar',
		'stern_taxi_fare_drag_event_FullCalendar',
		'stern_taxi_fare_use_FullCalendar_back',
		'stern_taxi_fare_Time_To_add_after_a_ride',
		'stern_taxi_fare_slotDuration_min',
		
		
		/* design */
		'stern_taxi_fare_show_seat_input',	
		'stern_taxi_fare_show_demo_setting',
		'stern_taxi_fare_show_suitcases_in_form',
		'stern_taxi_fare_show_distance_in_form',
		'stern_taxi_fare_show_tolls_in_form',
		'stern_taxi_fare_show_init_button',
		'stern_taxi_fare_show_duration_in_form',
		'stern_taxi_fare_emptyCart',
		'stern_taxi_fare_formID',
		'stern_taxi_use_pets',
		'stern_taxi_fare_show_map_checkout',
		'stern_taxi_fare_url_gif_loader',
		'stern_taxi_fare_lib_bootstrap_js',
		'stern_taxi_fare_show_dropdown_typecar',
		'stern_taxi_fare_auto_open_map',
		'stern_taxi_fare_show_map',
		'stern_taxi_fare_typeCar_calendar_as_input',
		'stern_taxi_fare_seat_field_as_input',
		'stern_taxi_fare_lib_bootstrap_css',
		'stern_taxi_fare_Bootstrap_select',
		'stern_taxi_fare_calendar_sideBySide',
		'stern_taxi_fare_calendar_split_date_time',
		'stern_taxi_fare_split_hour_min',
		'stern_taxi_fare_show_labels',
		'stern_taxi_fare_show_tooltips',
		'stern_taxi_fare_form_full_row',
		'stern_taxi_fare_full_row',
		'stern_taxi_fare_Destination_Button_glyph',
		'stern_taxi_fare_Source_Button_glyph',
		'stern_taxi_fare_bcolor',
		'stern_taxi_fare_bTransparency',
		'stern_taxi_fare_book_button_text',
		'stern_taxi_fare_show_label_in_button',
		'stern_taxi_fare_show_estimated_in_form',
		'stern_taxi_fare_title',
		'stern_taxi_fare_subtitle',
		'stern_taxi_fare_use_babySeat',
		'stern_taxi_fare_show_position_price',
		'stern_taxi_fare_map_style',
		'stern_taxi_fare_show_markers_in_map',
		'stern_taxi_fare_use_QR_code',
		'stern_taxi_fare_show_suitcasesSmall',
		
		
	);
	foreach  ($arrayOption as $value) {
		if(isset($_POST[$value])) {
			update_option($value , sanitize_text_field($_POST[$value]));
		}
	}			

}


function getOptionMapStyle($nameStyle) {
	$arrayOption = array(
		'' => '',
		'Subtle Grayscale' 			=>	'[{"featureType":"landscape","stylers":[{"saturation":-100},{"lightness":65},{"visibility":"on"}]},{"featureType":"poi","stylers":[{"saturation":-100},{"lightness":51},{"visibility":"simplified"}]},{"featureType":"road.highway","stylers":[{"saturation":-100},{"visibility":"simplified"}]},{"featureType":"road.arterial","stylers":[{"saturation":-100},{"lightness":30},{"visibility":"on"}]},{"featureType":"road.local","stylers":[{"saturation":-100},{"lightness":40},{"visibility":"on"}]},{"featureType":"transit","stylers":[{"saturation":-100},{"visibility":"simplified"}]},{"featureType":"administrative.province","stylers":[{"visibility":"off"}]},{"featureType":"water","elementType":"labels","stylers":[{"visibility":"on"},{"lightness":-25},{"saturation":-100}]},{"featureType":"water","elementType":"geometry","stylers":[{"hue":"#ffff00"},{"lightness":-25},{"saturation":-97}]}]',
		'Ultra Light with Labels'	=>	'[{"featureType":"water","elementType":"geometry","stylers":[{"color":"#e9e9e9"},{"lightness":17}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#f5f5f5"},{"lightness":20}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#ffffff"},{"lightness":17}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#ffffff"},{"lightness":29},{"weight":0.2}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#ffffff"},{"lightness":18}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#ffffff"},{"lightness":16}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#f5f5f5"},{"lightness":21}]},{"featureType":"poi.park","elementType":"geometry","stylers":[{"color":"#dedede"},{"lightness":21}]},{"elementType":"labels.text.stroke","stylers":[{"visibility":"on"},{"color":"#ffffff"},{"lightness":16}]},{"elementType":"labels.text.fill","stylers":[{"saturation":36},{"color":"#333333"},{"lightness":40}]},{"elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"transit","elementType":"geometry","stylers":[{"color":"#f2f2f2"},{"lightness":19}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#fefefe"},{"lightness":20}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"color":"#fefefe"},{"lightness":17},{"weight":1.2}]}]',
		'Blue water'				=>	'[{"featureType":"administrative","elementType":"labels.text.fill","stylers":[{"color":"#444444"}]},{"featureType":"landscape","elementType":"all","stylers":[{"color":"#f2f2f2"}]},{"featureType":"poi","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"road","elementType":"all","stylers":[{"saturation":-100},{"lightness":45}]},{"featureType":"road.highway","elementType":"all","stylers":[{"visibility":"simplified"}]},{"featureType":"road.arterial","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"transit","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"water","elementType":"all","stylers":[{"color":"#46bcec"},{"visibility":"on"}]}]',
		'Pale Dawn'					=>	'[{"featureType":"administrative","elementType":"all","stylers":[{"visibility":"on"},{"lightness":33}]},{"featureType":"landscape","elementType":"all","stylers":[{"color":"#f2e5d4"}]},{"featureType":"poi.park","elementType":"geometry","stylers":[{"color":"#c5dac6"}]},{"featureType":"poi.park","elementType":"labels","stylers":[{"visibility":"on"},{"lightness":20}]},{"featureType":"road","elementType":"all","stylers":[{"lightness":20}]},{"featureType":"road.highway","elementType":"geometry","stylers":[{"color":"#c5c6c6"}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#e4d7c6"}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#fbfaf7"}]},{"featureType":"water","elementType":"all","stylers":[{"visibility":"on"},{"color":"#acbcc9"}]}]',
		'Apple Maps-esque'			=>	'[{"featureType":"landscape.man_made","elementType":"geometry","stylers":[{"color":"#f7f1df"}]},{"featureType":"landscape.natural","elementType":"geometry","stylers":[{"color":"#d0e3b4"}]},{"featureType":"landscape.natural.terrain","elementType":"geometry","stylers":[{"visibility":"off"}]},{"featureType":"poi","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"poi.business","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"poi.medical","elementType":"geometry","stylers":[{"color":"#fbd3da"}]},{"featureType":"poi.park","elementType":"geometry","stylers":[{"color":"#bde6ab"}]},{"featureType":"road","elementType":"geometry.stroke","stylers":[{"visibility":"off"}]},{"featureType":"road","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#ffe15f"}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#efd151"}]},{"featureType":"road.arterial","elementType":"geometry.fill","stylers":[{"color":"#ffffff"}]},{"featureType":"road.local","elementType":"geometry.fill","stylers":[{"color":"black"}]},{"featureType":"transit.station.airport","elementType":"geometry.fill","stylers":[{"color":"#cfb2db"}]},{"featureType":"water","elementType":"geometry","stylers":[{"color":"#a2daf2"}]}]',
		'light dream'				=>	'[{"featureType":"landscape","stylers":[{"hue":"#FFBB00"},{"saturation":43.400000000000006},{"lightness":37.599999999999994},{"gamma":1}]},{"featureType":"road.highway","stylers":[{"hue":"#FFC200"},{"saturation":-61.8},{"lightness":45.599999999999994},{"gamma":1}]},{"featureType":"road.arterial","stylers":[{"hue":"#FF0300"},{"saturation":-100},{"lightness":51.19999999999999},{"gamma":1}]},{"featureType":"road.local","stylers":[{"hue":"#FF0300"},{"saturation":-100},{"lightness":52},{"gamma":1}]},{"featureType":"water","stylers":[{"hue":"#0078FF"},{"saturation":-13.200000000000003},{"lightness":2.4000000000000057},{"gamma":1}]},{"featureType":"poi","stylers":[{"hue":"#00FF6A"},{"saturation":-1.0989010989011234},{"lightness":11.200000000000017},{"gamma":1}]}]',
		'Blue Essence' 				=>	'[{"featureType":"landscape.natural","elementType":"geometry.fill","stylers":[{"visibility":"on"},{"color":"#e0efef"}]},{"featureType":"poi","elementType":"geometry.fill","stylers":[{"visibility":"on"},{"hue":"#1900ff"},{"color":"#c0e8e8"}]},{"featureType":"road","elementType":"geometry","stylers":[{"lightness":100},{"visibility":"simplified"}]},{"featureType":"road","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"transit.line","elementType":"geometry","stylers":[{"visibility":"on"},{"lightness":700}]},{"featureType":"water","elementType":"all","stylers":[{"color":"#7dcdcd"}]}]',
		'Unsaturated Browns' 		=>	'[{"elementType":"geometry","stylers":[{"hue":"#ff4400"},{"saturation":-68},{"lightness":-4},{"gamma":0.72}]},{"featureType":"road","elementType":"labels.icon"},{"featureType":"landscape.man_made","elementType":"geometry","stylers":[{"hue":"#0077ff"},{"gamma":3.1}]},{"featureType":"water","stylers":[{"hue":"#00ccff"},{"gamma":0.44},{"saturation":-33}]},{"featureType":"poi.park","stylers":[{"hue":"#44ff00"},{"saturation":-23}]},{"featureType":"water","elementType":"labels.text.fill","stylers":[{"hue":"#007fff"},{"gamma":0.77},{"saturation":65},{"lightness":99}]},{"featureType":"water","elementType":"labels.text.stroke","stylers":[{"gamma":0.11},{"weight":5.6},{"saturation":99},{"hue":"#0091ff"},{"lightness":-86}]},{"featureType":"transit.line","elementType":"geometry","stylers":[{"lightness":-48},{"hue":"#ff5e00"},{"gamma":1.2},{"saturation":-23}]},{"featureType":"transit","elementType":"labels.text.stroke","stylers":[{"saturation":-64},{"hue":"#ff9100"},{"lightness":16},{"gamma":0.47},{"weight":2.7}]}]',
		'clean-cut'					=>	'[{"featureType":"road","elementType":"geometry","stylers":[{"lightness":100},{"visibility":"simplified"}]},{"featureType":"water","elementType":"geometry","stylers":[{"visibility":"on"},{"color":"#C6E2FF"}]},{"featureType":"poi","elementType":"geometry.fill","stylers":[{"color":"#C5E3BF"}]},{"featureType":"road","elementType":"geometry.fill","stylers":[{"color":"#D1D1B8"}]}]',
		'My City Map'				=>	'[{"featureType":"administrative","elementType":"labels.text.fill","stylers":[{"color":"#444444"}]},{"featureType":"landscape","elementType":"all","stylers":[{"color":"#f2f2f2"}]},{"featureType":"poi","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"poi.park","elementType":"all","stylers":[{"visibility":"on"}]},{"featureType":"road","elementType":"all","stylers":[{"saturation":-100},{"lightness":45}]},{"featureType":"road.highway","elementType":"all","stylers":[{"visibility":"simplified"}]},{"featureType":"road.arterial","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"transit","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"transit.line","elementType":"geometry","stylers":[{"visibility":"on"}]},{"featureType":"transit.station.airport","elementType":"all","stylers":[{"visibility":"on"}]},{"featureType":"transit.station.airport","elementType":"geometry","stylers":[{"visibility":"on"}]},{"featureType":"transit.station.bus","elementType":"all","stylers":[{"visibility":"on"}]},{"featureType":"transit.station.bus","elementType":"geometry","stylers":[{"visibility":"on"}]},{"featureType":"transit.station.rail","elementType":"all","stylers":[{"visibility":"on"}]},{"featureType":"transit.station.rail","elementType":"geometry","stylers":[{"visibility":"on"}]},{"featureType":"water","elementType":"all","stylers":[{"color":"#6e769e"},{"visibility":"on"}]}]',
		'Pale with defined borders'	=>	'[{"featureType":"all","elementType":"geometry","stylers":[{"color":"#e8ebe1"}]},{"featureType":"all","elementType":"labels.text.fill","stylers":[{"gamma":0.01},{"lightness":20}]},{"featureType":"all","elementType":"labels.text.stroke","stylers":[{"saturation":-31},{"lightness":-33},{"weight":2},{"gamma":0.8}]},{"featureType":"all","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"administrative","elementType":"all","stylers":[{"visibility":"on"}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"visibility":"on"},{"color":"#315425"}]},{"featureType":"administrative","elementType":"labels.text","stylers":[{"visibility":"on"}]},{"featureType":"administrative","elementType":"labels.text.fill","stylers":[{"color":"#060404"},{"visibility":"on"},{"lightness":"20"},{"weight":"0.58"}]},{"featureType":"administrative.country","elementType":"geometry","stylers":[{"visibility":"on"},{"color":"#1b542b"}]},{"featureType":"administrative.province","elementType":"geometry","stylers":[{"visibility":"on"}]},{"featureType":"administrative.province","elementType":"geometry.fill","stylers":[{"visibility":"off"}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"lightness":30},{"saturation":30}]},{"featureType":"poi","elementType":"all","stylers":[{"visibility":"off"},{"color":"#b7c5c0"}]},{"featureType":"poi","elementType":"geometry","stylers":[{"saturation":20},{"visibility":"off"}]},{"featureType":"poi","elementType":"labels","stylers":[{"weight":"0.01"},{"visibility":"off"}]},{"featureType":"poi.park","elementType":"geometry","stylers":[{"lightness":20},{"saturation":-20},{"visibility":"off"}]},{"featureType":"poi.park","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"road","elementType":"all","stylers":[{"visibility":"simplified"},{"weight":"0.37"}]},{"featureType":"road","elementType":"geometry","stylers":[{"lightness":10},{"saturation":-30}]},{"featureType":"road","elementType":"geometry.fill","stylers":[{"visibility":"simplified"},{"color":"#ffa600"},{"weight":"0.50"},{"lightness":"50"}]},{"featureType":"road","elementType":"geometry.stroke","stylers":[{"saturation":25},{"lightness":25}]},{"featureType":"road.local","elementType":"all","stylers":[{"visibility":"simplified"},{"color":"#9f9c9c"},{"lightness":"15"},{"weight":"0.25"}]},{"featureType":"road.local","elementType":"geometry.fill","stylers":[{"visibility":"on"},{"color":"#a09f9f"},{"weight":"0.50"},{"lightness":"50"}]},{"featureType":"water","elementType":"all","stylers":[{"lightness":-20},{"color":"#92b2c5"}]}]',
		'green tea'					=>	'[{"featureType":"all","elementType":"all","stylers":[{"color":"#7ee0ae"}]},{"featureType":"all","elementType":"labels.text","stylers":[{"visibility":"simplified"},{"color":"#000000"}]},{"featureType":"landscape.natural","elementType":"geometry.fill","stylers":[{"visibility":"on"},{"color":"#e0efef"}]},{"featureType":"poi","elementType":"geometry.fill","stylers":[{"visibility":"on"},{"hue":"#1900ff"},{"color":"#c0e8e8"}]},{"featureType":"road","elementType":"geometry","stylers":[{"lightness":100},{"visibility":"simplified"}]},{"featureType":"road","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"transit.line","elementType":"geometry","stylers":[{"visibility":"on"},{"lightness":700}]},{"featureType":"water","elementType":"all","stylers":[{"color":"#7dcdcd"}]}]',
		'LPA'						=>	'[{"featureType":"all","elementType":"labels.text.fill","stylers":[{"saturation":36},{"color":"#333333"},{"lightness":40}]},{"featureType":"all","elementType":"labels.text.stroke","stylers":[{"visibility":"on"},{"color":"#ffffff"},{"lightness":16}]},{"featureType":"all","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#fefefe"},{"lightness":20}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"color":"#fefefe"},{"lightness":17},{"weight":1.2}]},{"featureType":"administrative.country","elementType":"geometry","stylers":[{"visibility":"on"}]},{"featureType":"administrative.country","elementType":"geometry.fill","stylers":[{"visibility":"on"},{"color":"#c8c5c5"}]},{"featureType":"administrative.country","elementType":"geometry.stroke","stylers":[{"color":"#ffffff"}]},{"featureType":"administrative.country","elementType":"labels.text","stylers":[{"saturation":"-16"},{"color":"#b5ce94"}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"lightness":20},{"color":"#ffffff"}]},{"featureType":"landscape","elementType":"geometry.fill","stylers":[{"saturation":"-87"},{"lightness":"-18"},{"gamma":"0.93"},{"weight":"0.94"},{"visibility":"on"},{"hue":"#ff0000"}]},{"featureType":"landscape","elementType":"geometry.stroke","stylers":[{"saturation":"-10"},{"color":"#8a7575"}]},{"featureType":"landscape","elementType":"labels.text.fill","stylers":[{"visibility":"on"},{"color":"#95aa6e"}]},{"featureType":"landscape","elementType":"labels.icon","stylers":[{"color":"#89bf6f"}]},{"featureType":"landscape.natural.landcover","elementType":"geometry.fill","stylers":[{"color":"#b52929"}]},{"featureType":"landscape.natural.terrain","elementType":"geometry.fill","stylers":[{"color":"#9db19e"}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#f1f1f1"},{"lightness":21}]},{"featureType":"poi.park","elementType":"geometry.fill","stylers":[{"color":"#b4cca6"}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#dedede"},{"lightness":17}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#dedede"},{"lightness":29},{"weight":0.2}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#dedede"},{"lightness":18}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#ffffff"},{"lightness":16}]},{"featureType":"transit","elementType":"geometry","stylers":[{"color":"#f2f2f2"},{"lightness":19}]},{"featureType":"transit.station.rail","elementType":"geometry.fill","stylers":[{"visibility":"on"}]},{"featureType":"transit.station.rail","elementType":"geometry.stroke","stylers":[{"visibility":"simplified"}]},{"featureType":"transit.station.rail","elementType":"labels.text","stylers":[{"visibility":"on"}]},{"featureType":"transit.station.rail","elementType":"labels.text.stroke","stylers":[{"color":"#c6dbca"}]},{"featureType":"transit.station.rail","elementType":"labels.icon","stylers":[{"visibility":"on"}]},{"featureType":"water","elementType":"geometry","stylers":[{"color":"#a0d6d1"},{"lightness":17}]},{"featureType":"water","elementType":"geometry.fill","stylers":[{"color":"#97b9cd"}]}]',
	);
	if($nameStyle=="") {
		return $arrayOption;
	} else {
		return $arrayOption[$nameStyle];
	}
}

function envato_verify_purchase($purchase_code)
{
    //SETUP THE API DATA

    $username = 'alan345'; 
    $api_key = 'dcpmi3m836majq16kjdntwyot2soehsk';

    //CHECK IF THE CALL FOR THE FUNCTION WAS EMPTY
    if ( $purchase_code != '' ):

        /*
            STEPS IN THE CODE BELOW:
             - QUERY ENVATO API FOR JSON RESULT
             - DECODE THE RESULT AND TRANSFORM IT FROM OBJECTS TO AN ARRAY
             - CHECK IF THERE IS A ITEM TITLE == THE PURCHASE WAS MADE OR NOT
        */            
		// http://marketplace.envato.com/api/edge/alan345/dcpmi3m836majq16kjdntwyot2soehsk/verify-purchase:a5ad79b3-13c0-4d2b-a301-48512ed77785.json
		$url='http://marketplace.envato.com/api/edge/'.$username.'/'.$api_key.'/verify-purchase:'.$purchase_code.'.json';
		
        $result_from_json = wp_remote_fopen($url);
		//wp_mail('sternwebagency@gmail.com','[ALAN]',$result_from_json);
        $result = json_decode($result_from_json, true);
		if($result==null) {
			return $result_from_json;
		} else {
			return $result;
		}
/*
        if ( $result['verify-purchase']['item_name'] ) :
            return 1;
        else:
            return 0;
        endif;
		*/
		
    endif;        
}

function isOk_envato_verify_purchase() {
	$purchase_data = envato_verify_purchase( get_option('stern_taxi_fare_envato_purchase_code') );
	if( isset($purchase_data['verify-purchase']['buyer']) ) {
		return true;
	} else {
		return false;
	}
}


	

function getPrice($distance, $duration,$nbToll, $selectedCarTypeId, $car_seats, $is_round_trip, $source, $destination, $babySeat ) {
	//var_dump($destination );
	$oTypeCar = new typeCar($selectedCarTypeId);
	$carFare = $oTypeCar->getcarFare();
	$suitcases = $oTypeCar->getsuitcases();
	$suitcasesSmall = $oTypeCar->getsuitcasesSmall();
	$km_fare = $oTypeCar->getfarePerDistance();
	$minutefare = $oTypeCar->getfarePerMinute();
	$seatfare = $oTypeCar->getfarePerSeat();
	$tollfare = $oTypeCar->getfarePerToll();
	$minimumCourseFare = $oTypeCar->getminimumCourseFare();
	$farePerSeatChild = $oTypeCar->getfarePerSeatChild();
	$carSeat = $oTypeCar->getcarSeat();
	$carType = $oTypeCar->getcarType();
	$carSeatChild = $oTypeCar->getfarePerSeatChild();

	if($carType==""){		
		$price["status"] = false;
		$price["statusText"] = "Car ".$selectedCarTypeId." does not exist";
		$price["estimated_fare"] = 0;
		return $price;
	}
	if($car_seats > $carSeat){		
		$price["status"] = false;
		$price["statusText"] = "Car ".$carType."(".$selectedCarTypeId.") has ".$carSeat." seats. Not ". $car_seats;
		$price["estimated_fare"] = 0;
		return $price;
	}	
	if($babySeat >$carSeatChild ){
		if(get_option('stern_taxi_fare_use_babySeat')=="true") {			
			$price["status"] = false;
			$price["statusText"] = "Car ".$carType."(".$selectedCarTypeId.") has ".$carSeatChild." Child seats. Not ". $babySeat;
			$price["estimated_fare"] = 0;
			return $price;
		}
	}
	
	
	$addressSavedPoint = get_option('stern_taxi_fare_address_saved_point');
	
//	$priceRule=0;
//	$idRule=0;
//	$nbMaxRuleBeforeGoogleStop=0;
	$RuleApproved=false;
	$SourceRuleApproved = "";
	$DestinationRuleApproved = "";		
	$typeIdCarInRule = -1;
	
	$carTypeRuleApproved =false;
//	$typeCalculation = get_option('typeCalculation');
//	$nameRule="";
//	$logParsingRule="";
	
	$sourceAddressForm = $source;
	$sourceCityForm = getCityFromAddress($source);
	
	$destinationAddressForm = $destination;
	$destinationCityForm = getCityFromAddress($destination);
	
		$dataPriceRule = getPriceRule($sourceAddressForm, $sourceCityForm, $destinationAddressForm, $destinationCityForm, $selectedCarTypeId);
		
		if($dataPriceRule['RuleApproved']==true) {
			if(get_option('stern_taxi_Include_SeatFare_in_pricing_rules')=='true') {
				$estimated_fare = $dataPriceRule['priceRule'] + ($car_seats * $seatfare);
			} else {
				$estimated_fare = $dataPriceRule['priceRule'];
			}
			
		} else {
			if(get_option('stern_taxi_fare_use_babySeat') != "true") {
				$babySeat = 0;
			}
			
			$estimated_fare_basic = $carFare  + ($distance * $km_fare) + ($duration * $minutefare) + ($car_seats * $seatfare) + ($nbToll * $tollfare) + ($babySeat * $farePerSeatChild );
			
			$estimated_fare = $estimated_fare_basic;
			
			if ($minimumCourseFare >0 ){				
				if($estimated_fare_basic < $minimumCourseFare ) {
					$estimated_fare = $minimumCourseFare ;
				} else {
					$estimated_fare = $estimated_fare_basic;
				}
			}				
		}
		if($is_round_trip=="true") {
			$estimated_fare = $estimated_fare * 2;
		}
			
	
	$estimated_fare = round($estimated_fare);
	$estimated_fare_HTML = sprintf( get_woocommerce_price_format(), get_woocommerce_currency_symbol(), $estimated_fare );
	
	if($DestinationRuleApproved =="errorGoogleEmpty" or $SourceRuleApproved =="errorGoogleEmpty") {
		$statusGoogleGlobal = "errorGoogleEmpty";
	} else {
		$statusGoogleGlobal = "ok";
	}
	$price["estimated_fare"] = $estimated_fare;
	$price["estimated_fare_HTML"] = $estimated_fare_HTML;
	
	$price["statusGoogleGlobal"] = $statusGoogleGlobal;
	$price["RuleApproved"] = $dataPriceRule['RuleApproved'];
	
	$price["logParsingRule"] = $dataPriceRule['logParsingRule'];
	$price["suitcases"] = $suitcases;
	$price["suitcasesSmall"] = $suitcasesSmall;
	
	
	
/*
	$price["SourceRuleApproved"] = $SourceRuleApproved;
	$price["DestinationRuleApproved"] = $DestinationRuleApproved;
	$price["RuleApproved"] = $RuleApproved;
	*/	
	$price["nameRule"] = $dataPriceRule['nameRule'];
	$price["status"] = true;
	$price["statusText"] = "ok";
	return $price ;
}

function getPriceRule($sourceAddressForm, $sourceCityForm, $destinationAddressForm, $destinationCityForm, $selectedCarTypeId) {
	
	$RuleApproved='';
	$priceRule=0;
	$logParsingRule='';
	$nameRule='';
	$idRule=0;
			if(get_option('stern_taxi_fare_allow_waypoints') != "true") {
				$args = array(
					'post_type' => 'stern_taxi_rule',
					'nopaging' => true,
				);
				
				$the_query  = new WP_Query( $args );
				while ( $the_query->have_posts() ) {
					$oRule = null;
					$the_query->the_post();
					$typeRuleSource="";
					$typeRuleDest="";
					
				//$allRules = get_posts( $args );
				//foreach ( $allRules as $post )  {
					//setup_postdata( $post );	
				//	$nbMaxRuleBeforeGoogleStop++;
					$oRule = new rule($the_query->post->ID );
					//var_dump ($oRule);
					
					
					if($oRule->getisActive()=='true') {
						$SourceRuleApproved = "";
						$DestinationRuleApproved = "";					
						
						
						$typeIdCarInRule = $oRule->gettypeIdCar();
						
						if($typeIdCarInRule=="" or ($selectedCarTypeId == $typeIdCarInRule)) {
							
							$sourceAddressRule = $oRule->gettypeSourceValue();
							$sourceCityRule = $oRule->getsourceCity();						
							$typeRuleSource = $oRule->gettypeSource();
							
							$SourceRuleApproved 		= checkIfRuleIsApproved($sourceAddressRule, $sourceCityRule, $sourceAddressForm, $sourceCityForm, $typeRuleSource);
							
						
							if(substr($SourceRuleApproved,0,2) == "ok") {
								
								$destinationAddressRule = $oRule->gettypeDestinationValue();
								$destinationCityRule = $oRule->getdestinationCity();					
								$typeRuleDest = $oRule->gettypeDestination();
								
								$DestinationRuleApproved 	= checkIfRuleIsApproved($destinationAddressRule, $destinationCityRule, $destinationAddressForm, $destinationCityForm, $typeRuleDest);
						
								
								if(substr($DestinationRuleApproved,0,2) == "ok" ) {
									$RuleApproved=true;
									$priceRule=$oRule->getprice();
									$nameRule=$oRule->getnameRule();
									$idRule=$oRule->getid();
									$logParsingRule = $logParsingRule .",".$oRule->getid()."(".$SourceRuleApproved."[".$typeRuleSource."],".$DestinationRuleApproved."[".$typeRuleDest."])4 ";
									break;
								} else {
									$logParsingRule = $logParsingRule .",".$oRule->getid()."(".$SourceRuleApproved."[".$typeRuleSource."],".$DestinationRuleApproved."[".$typeRuleDest."])3 ";
								}										
							} else {
								$logParsingRule = $logParsingRule .",".$oRule->getid()."(".$SourceRuleApproved."[".$typeRuleSource."],".$DestinationRuleApproved."[".$typeRuleDest."])2 ";
							}
						} else {
							$logParsingRule = $logParsingRule .",".$oRule->getid()."(".$SourceRuleApproved."[".$selectedCarTypeId."],".$DestinationRuleApproved."[".$selectedCarTypeId."])1 ";
						}
					} else {
						$logParsingRule = $logParsingRule .",".$oRule->getid()."(NotActive)0 ";
					}
					
					
				}
			}
			$dataPriceRule["RuleApproved"] 		= $RuleApproved;
			$dataPriceRule["priceRule"] 		= $priceRule;
			$dataPriceRule["logParsingRule"] 	= $logParsingRule;
			$dataPriceRule["nameRule"] 			= $nameRule;
			
			
		return $dataPriceRule;
			
}

function isCarSeatAvailable($carSeat,$carSeatMax) {
	if(get_option('stern_taxi_fare_seat_field_as_input') == "true") {
		
		if($carSeat <= $carSeatMax) {
			
			$isCarSeatAvailable = true;
		} else {			
			$isCarSeatAvailable = false;
		} 
	} else {
		
		$isCarSeatAvailable = true;
	}
	return $isCarSeatAvailable;
}
				
				
function isCarAvailable($selectedCarTypeId,$dateTimePickUp,$duration) {
	$time_To_add_after_a_ride =  get_option('stern_taxi_fare_Time_To_add_after_a_ride');
	$minutes_to_add = intval($duration) + intval($time_To_add_after_a_ride);	
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
	

	$allPostsCalendars = get_posts( $args );
	$isAvailable = 0;

	foreach ( $allPostsCalendars as $postCalendar ) {
		
		setup_postdata( $postCalendar );
		
		//echo $allPostsCalendars;
		$oCalendar = new calendar($postCalendar->ID);
		if($oCalendar->getisRepeat()=="true") {
			$loopIsRepeat = 200;
		} else {
			$loopIsRepeat = 0;			
		}
		
			$date = new DateTime($dateTimePickUp );
			$dateTimePickUp = $date->format('Y-m-d H:i:s');	
	
		$dateTimePickUpPlusMinuteToAdd = 	date('Y-m-d H:i:s', strtotime(" + ".$minutes_to_add." minutes", strtotime($dateTimePickUp )));	
		
		for ($i=0; $i <= $loopIsRepeat ; $i++) {

			$dateTimeBegin = 	date('Y-m-d H:i:s', strtotime(" + ".$i * 7 ." days", strtotime($oCalendar->getdateTimeBegin()		))); 
			$dateTimeEnd = 		date('Y-m-d H:i:s', strtotime(" + ".$i * 7 ." days", strtotime($oCalendar->getdateTimeEnd()		)));
			$dateTimeEndPlusMargin = date('Y-m-d H:i:s', strtotime(" + ".intval($time_To_add_after_a_ride)." minutes", strtotime($dateTimeEnd )));

			$log =   " ( " .$dateTimePickUpPlusMinuteToAdd . " < " . $dateTimeBegin . " ) or ( " .$dateTimePickUp  . " > " . $dateTimeEndPlusMargin  . " ) ";
		//	echo $log;
			
			if( ($dateTimePickUpPlusMinuteToAdd < $dateTimeBegin ) or ($dateTimePickUp  > $dateTimeEndPlusMargin    )) {
				
				$isAvailable = $isAvailable + 0;
			} else {
				
				$isAvailable = $isAvailable + 1;
		//		break 2 ;
			}
		
		}	
		
	}
	if($isAvailable == 0) {
		return true;
	} else {
		return false;
	}
}

function getFormatDateTime($langage) {
	return getFormatDate($langage) . " " . getFormatTime($langage);
}
function getFormatDate($langage) {
	if($langage!="php") {
		$stern_taxi_fare_formatDate = (get_option('stern_taxi_fare_formatDate') == "" ? "MM/DD/YYYY" : get_option('stern_taxi_fare_formatDate'));
	} else {
		if (get_option('stern_taxi_fare_formatDate') == "") {
			$stern_taxi_fare_formatDate = "m-d-Y";
		} else {
			if(get_option('stern_taxi_fare_formatDate')=="MM/DD/YYYY") {
				$stern_taxi_fare_formatDate = "m-d-Y";
			} else {
				if(get_option('stern_taxi_fare_formatDate')=="DD/MM/YYYY") {
					$stern_taxi_fare_formatDate = "d-m-Y";
				}		
			}

		}
	}
	return $stern_taxi_fare_formatDate;
}

function getFormatTime($langage) {
	if($langage=="php") {
		if (get_option('stern_taxi_fare_formatTime') == "") {
			$stern_taxi_fare_formatTime = "h:i A";
		} else {
			if(get_option('stern_taxi_fare_formatTime')=="12h") {
				$stern_taxi_fare_formatTime = "h:i A";
			} else {
				if(get_option('stern_taxi_fare_formatTime')=="24h") {
					$stern_taxi_fare_formatTime = "H:i";
				}		
			}
		}			
	} else {
		if (get_option('stern_taxi_fare_formatTime') == "") {
			$stern_taxi_fare_formatTime = "hh:mm a";
		} else {
			if(get_option('stern_taxi_fare_formatTime')=="12h") {
				$stern_taxi_fare_formatTime = "hh:mm a";
			} else {
				if(get_option('stern_taxi_fare_formatTime')=="24h") {
					$stern_taxi_fare_formatTime = "HH:mm";
				}		
			}
		}
	}
	return $stern_taxi_fare_formatTime;
}

function getAllCarsByCateg($carCategory) {
	if ($carCategory=="") {
		$args = array(
			'post_type' => 'stern_taxi_car_type',
			'nopaging' => true,
			'order'     => 'ASC',
			'orderby' => 'meta_value',
			'meta_key' => '_stern_taxi_car_type_organizedBy',
			'meta_query' => array(
				array(
					'key'     => '_stern_taxi_car_type_carCategory',
					'compare' => 'NOT EXISTS'
				),
			),			
		);		
	} else {
		$args = array(
			'post_type' => 'stern_taxi_car_type',
			'nopaging' => true,
			'order'     => 'ASC',
			'orderby' => 'meta_value',
			'meta_key' => '_stern_taxi_car_type_organizedBy',
			'meta_query' => array(
				array(
					'key'     => '_stern_taxi_car_type_carCategory',
					'value'   => $carCategory,
					'compare' => '=',
				),
			),				
		);		
	}
	
	$allTypeCars = get_posts( $args );	
	return $allTypeCars;
}								



function launchForm($atts) {
	if ( isWooCommerceActive() ) {		
		if (true) {			 //if (isFopenOk()) {
			if(isProductCreated()) {
				if(get_option('stern_taxi_fare_country')!="") {
					if(isAPIGoogleEnable()) {						
						if(getCountTypeCat()!=0) {
							if(getCountTypeCar()!=0) {
								if(!saveInfoToDb()) {
									if(is_plugin_active_api()) {
									
										if (($_SERVER['REQUEST_METHOD'] == 'POST') && isset($_POST['SternSaveSettingsSubmit']) ) {
											updateOptionsSternTaxiFare();
										}										
										showForm1($atts);
									} else {
										echo __('Error 345! Please contact author', 'stern_taxi_fare');
									}
								} else {
									echo __('Stern Taxi Fare: Data info Saved!', 'stern_taxi_fare');
								}
							} else {
								echo __('Stern Taxi Fare: Please Create at least 1 type car ', 'stern_taxi_fare'). "<a href='".get_admin_url( "", "admin.php?page=stern-add-type-car" )."'>-></a>";
							}
						} else {
							echo __('Stern Taxi Fare: Please Create first a category ', 'stern_taxi_fare'). "<a href='".get_admin_url( "", "admin.php?page=stern-add-type-car" )."'>-></a>";
						}
					} else {
						echo __('Stern Taxi Fare: Please Enable correctly all API Google.', 'stern_taxi_fare');
					}
				} else {
					echo __('Stern Taxi Fare: Please select your country in backoffice', 'stern_taxi_fare');
				}
			} else {
				echo __('Stern Taxi Fare: Please create product "stern product"', 'stern_taxi_fare');	
			}
		} else {			
			echo __('Stern Taxi Fare: Option allow_url_fopen is not allowed on your host', 'stern_taxi_fare');
		}			
	} else {
		echo __('Stern Taxi Fare: Please install plugin WooCommerce', 'stern_taxi_fare');
	}	
}

function stern_taxi_fare_hex2rgba($color, $opacity = false) {
 
 $default = 'rgb(0,0,0)';
 
 //Return default if no color provided
 if(empty($color))
          return $default; 
 
 //Sanitize $color if "#" is provided 
        if ($color[0] == '#' ) {
         $color = substr( $color, 1 );
        }
 
        //Check if color has 6 or 3 characters and get values
        if (strlen($color) == 6) {
                $hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
        } elseif ( strlen( $color ) == 3 ) {
                $hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
        } else {
                return $default;
        }
 
        //Convert hexadec to rgb
        $rgb =  array_map('hexdec', $hex);
 
        //Check if opacity is set(rgba or rgb)
        if($opacity){
         if(abs($opacity) > 1)
         $opacity = 1.0;
         $output = 'rgba('.implode(",",$rgb).','.$opacity.')';
        } else {
         $output = 'rgb('.implode(",",$rgb).')';
        }
 
        //Return rgb(a) color string
        return $output;
}



function getCountToll($source,$destination) {
	//$source = str_replace(' ','+', $_POST['source'] );
	//$destination = str_replace(' ','+', $_POST['destination'] );
	/*
	$source = urlencode($_POST['source'] );
	$destination = urlencode($_POST['destination'] );
	*/
	$requestUrl = 'http://maps.googleapis.com/maps/api/directions/xml?origin='.$source.'&destination='.$destination;
	
	if(get_option('stern_taxi_fare_avoid_highways_in_calculation')=="true") {
		$requestUrl.="&avoid=highways";
	}
	$response = wp_remote_fopen($requestUrl);
	$numTolls = substr_count($response, 'Toll road');
	$hasTolls = ($numTolls > 0);
	return $numTolls;	
}

function isAPIGoogleEnable() {
	if(isAPIDirectionsEnable() && isAPIDistancematrixEnable() && isAPIGeocodeEnable()) {
		return true;
	} else {
		return false;
	}
}

function isAPIDirectionsEnable() {
	$data = getDataAPIDirections();
	if($data->status =="OK") {
		return true;
	} else {		
		return false;		
	}
}

function getDataAPIDirections() {

	$data = wp_remote_fopen(getDataAPIDirectionsURL());
	$data = json_decode($data);
	return 	$data;
}

function getDataAPIDirectionsURL() {
	$url="";
	$url.="https://maps.googleapis.com/maps/api/directions/json?";
	$url.="origin=A";
	$url.="&destination=B";
	$url.="&key=".get_option('stern_taxi_fare_apiGoogleKey');
	return $url;
}

function isAPIDistancematrixEnable() {
	$url="";
	$url.="https://maps.googleapis.com/maps/api/distancematrix/json";
	$url.="?origins=A";
	$url.="&destinations=A";
	$url.="&key=".get_option('stern_taxi_fare_apiGoogleKey');
	$data = wp_remote_fopen($url);
	$data = json_decode($data);
	if($data->status =="OK") {
		return true;
	} else {
		return false;
	}
}

function isAPIGeocodeEnable() {
	$data = getDataAPIGeocodeEnable();
	if($data->status =="OK") {
		return true;
	} else {
		return false;
	}
}

function isFopenOk() {
	if (ini_get('allow_url_fopen') == 1) {
		return true;
	} else {
		return false;
	}
}

function getDataAPIGeocodeEnable() {
	$url="";
	$url.="https://maps.googleapis.com/maps/api/geocode/json?";
	$url.="address=A";
	$url.="&key=".get_option('stern_taxi_fare_apiGoogleKey');
	$data = wp_remote_fopen($url);
	$data = json_decode($data);
	return $data;
}

function getGoogleMapsDataFunction($source,$destination) {
	$source = urlencode($source);
	$destination = urlencode($destination);
	
	if(getKmOrMiles()=='km') {
		$units='metric';
	} else {
		$units='imperial';
	}
	
	$url="";
	$url.="https://maps.googleapis.com/maps/api/distancematrix/json";
	$url.="?origins=".$source;
	$url.="&destinations=".$destination;
	$url.="&units=".$units;
	$url.="&language=".get_locale();
	if(get_option('stern_taxi_fare_use_traffic_in_calculation')=="true") {
		$url.="&mode=driving";
		$url.="&departure_time=now";	
		$url.="&traffic_model=best_guess"; 
	}
	//  best_guess, optimistic or pessimistic
	if(get_option('stern_taxi_fare_avoid_highways_in_calculation')=="true") {
		$url.="&avoid=highways";
	}	
	$url.="&key=".get_option('stern_taxi_fare_apiGoogleKey');
	//
	// https://maps.googleapis.com/maps/api/distancematrix/json?origins=7+Rue+Théodore+Maingot,+Ris-Orangis,+France&destinations=Paris-Charles+de+Gaulle+Airport,+Roissy-en-France,+France&language=fr-FR&mode=driving&key=AIzaSyDpLhe3C2TFQi6iA-SaDvou7qamY7UzxuM
	//wp_mail('sternwebagency@gmail.com','[ALAN]',$url);
	
	$data = wp_remote_fopen($url);
	
	$googleJ=0;
	$maxLoopDataGoogle = (get_option('max_queries_to_API_google') == "") ? 0 : get_option('max_queries_to_API_google')  ;
	$Time_between_each_API_google_queries = (get_option('Time_between_each_API_google_queries') == "") ? 0 : get_option('Time_between_each_API_google_queries');
	
	
	
	while($data ==false) {
		if($googleJ==$maxLoopDataGoogle) {break;}
		$data = wp_remote_fopen($url);
		$googleJ++;
		sleep($Time_between_each_API_google_queries/1000);
	}
	
	
	if($data !=false) {
		$dataJson = json_decode($data);
		$dataGmaps["status"]= $dataJson->status;
		//echo "<script>console.log( 'Debug Objects: " . $dataGmaps["status"] . "' );</script>";
		//	var_dump($url);
		//	var_dump($dataJson);
		if($dataGmaps["status"]=="OK") {
			$rowID=0;
			$elementID = 0;
			$DurationValue = 0;
			$DistanceValueKMOrMiles = 0;
			$DistanceValueMetre = 0;
			foreach($dataJson->rows as $row) {				
				foreach($row->elements as $road) {
					if($road->status == "ZERO_RESULTS") {
						// https://maps.googleapis.com/maps/api/distancematrix/json?origins=A%C3%A7oteias&destinations=Point+B&units=metric&language=en_US&key=
						$dataGmaps["status"]= "errorGoogleEmpty";
						return $dataGmaps;
					} else {
						if($rowID ==$elementID ) {
							$DurationValue = 			$DurationValue + ($road->duration->value);
							$DistanceValueKMOrMiles = $DistanceValueKMOrMiles + ($road->distance->value);
							$DistanceValueMetre = $DistanceValueMetre + $road->distance->value;
						//	$log = $log. " " . $road->distance->value;
						}
						$elementID++;
					}
				}
				$rowID++;
				$elementID = 0;
			}
		//	wp_mail('sternwebagency@gmail.com','[ALAN]',$log);
			if(getKmOrMiles()=='km') {
				$dataGmaps["DistanceValueKMOrMiles"]= 	 $DistanceValueKMOrMiles / 1000;
				$dataGmaps["distance"] 				=	$DistanceValueKMOrMiles / 1000;
			} else {
				$dataGmaps["DistanceValueKMOrMiles"]= 	 $DistanceValueKMOrMiles / (1000 * 1.60934);
				$dataGmaps["distance"] 				=	$DistanceValueKMOrMiles / (1000 * 1.60934);
			}
			$dataGmaps["DistanceText"] 			= intval($dataGmaps["DistanceValueKMOrMiles"]) ." " . getKmOrMiles();
			$dataGmaps["distanceHtml"] 			= intval($dataGmaps["DistanceValueKMOrMiles"]) ." " . getKmOrMiles();
			$dataGmaps["DistanceValueMetre"] 	= $DistanceValueMetre;
			//$dataGmaps["distance"] 				= $DistanceValueMetre;
			$dataGmaps["DurationValue"]			= $DurationValue/60;
			$dataGmaps["duration"]				= $DurationValue/60;			
			$dataGmaps["DurationText"]			= secToTime( $DurationValue);
			$dataGmaps["durationHtml"]			= secToTime( $DurationValue);
			$dataGmaps["nbToll"]				= getCountToll($source,$destination);
			
			
			
		} else {
			$dataGmaps["status"]= "errorGoogleEmpty";
		}
		
	} else {
		$dataGmaps["status"]= "errorGoogleEmpty";
	}
	return $dataGmaps;
	
}

function secToTime($time ) {
	$days = floor($time / (60 * 60 * 24));
	$time -= $days * (60 * 60 * 24);

	$hours = floor($time / (60 * 60));
	$time -= $hours * (60 * 60);

	$minutes = floor($time / 60);
	$time -= $minutes * 60;

	$seconds = floor($time);
	$time -= $seconds;
	//return  "{$days}d {$hours}h {$minutes}m {$seconds}s"; 
	$stringreturn="";

	if($days!=0) {
		$stringreturn.=$days."d ";
	}
	if($hours!=0) {
		$stringreturn.=$hours."h ";
	}
	$stringreturn.=$minutes."min";
	return $stringreturn;
}

function getPluginVersion() {
	return get_option('stern_taxi_fare_version_plugin');	
}





function getCityFromAddress($address) {
	$address = urlencode($address);
	$url="";
	$url.="https://maps.googleapis.com/maps/api/geocode/json?";
	$url.="address=".$address;
	$url.="&key=".get_option('stern_taxi_fare_apiGoogleKey');
	$url.="&language=".get_option('stern_taxi_fare_country');
	// https://maps.googleapis.com/maps/api/geocode/json?address=16+Rue+de+Vaugirard,+Paris,+France&key=AIzaSyBAoC06JiXpPm2mnB23hMmEOHyDDzh75jY
	$data = wp_remote_fopen($url);
	
	$googleJ=0;
	$maxLoopDataGoogle = (get_option('max_queries_to_API_google') == "") ? 0 : get_option('max_queries_to_API_google')  ;
	$Time_between_each_API_google_queries = (get_option('Time_between_each_API_google_queries') == "") ? 0 : get_option('Time_between_each_API_google_queries');
	
	
	while($data ==false) {
		if($googleJ==$maxLoopDataGoogle) {break;}
		$data = wp_remote_fopen($url);
		$googleJ++;
		sleep($Time_between_each_API_google_queries/1000);
		
	}
	
	
	if($data !=false) {	
		$jsondata = json_decode($data,true);
		
		// https://maps.googleapis.com/maps/api/geocode/json?address=Paris+France&key=AIzaSyD5UzF18OX_hlanu8LK_HIiqPybLHP9Dao
		/*
		foreach ($jsondata["results"] as $result) {
			foreach ($result["address_components"] as $address) {
				if (in_array("locality", $address["types"])) {
					$dataGmaps["city"] = $address["long_name"];
				}
			}
		}*/

		foreach ($jsondata["results"] as $result) {
			foreach ($result["address_components"] as $address) {
				if (in_array("locality", $address["types"])) {
					$dataGmaps["city"] = $address["long_name"];
					break 2;
				}
			}
		//	break;
		}		

		
		$data = json_decode($data);
		$dataGmaps["status"]= $data->status;
		
	} else {
		$dataGmaps["status"]= "errorGoogleEmpty";
	}
	return $dataGmaps;
	
}


function getMaxCarSeatfromAllCarType() {
	$args = array(
		'post_type' => 'stern_taxi_car_type',
		'nopaging' => true,
		'order'     => 'ASC',
		'orderby' => 'meta_value',
		'meta_key' => '_stern_taxi_car_type_organizedBy'
	);
	$allTypeCars = get_posts( $args );
	$maxSeats = 0;
	foreach ( $allTypeCars as $post ) {
		setup_postdata( $post );
		$oTypeCar = new typeCar($post->ID);
		if($oTypeCar->getcarSeat() > $maxSeats) {
			$maxSeats =$oTypeCar->getcarSeat();
		}
	}
	return $maxSeats;
}


function setAdminMessage($message,$type,$row="") {
	if ($row!="") {
		$message =  __( 'Row', 'stern_taxi_fare' )." ". $row." ". $message;
	}						
	add_settings_error('sternTaxiFareBulk', esc_attr( 'settings_updated' ), $message, $type);	
}

function checkIfRuleIsApproved($address1 , $city1, $address2, $city2, $typeRule) {
		if($typeRule == "city") {
			if ($address1 == $address2) { 
				return "ok1";
			}
			
			if($city1=="") {
				$city1Array = getCityFromAddress($address1);
			} else {
				$city1Array["status"] = "OK";
				$city1Array["city"] =$city1;
			}
			
			if($city2=="") {
				$city2Array = getCityFromAddress($address2);
			} else {
				$city2Array["status"] = "OK";
				$city2Array["city"] =$city2;
			}
			
			
			
			
			if ($city1Array["status"] != "OK") {
				return $city1Array["status"];
			}
			if ($city2Array["status"] != "OK") {
				return $city2Array["status"]."1";
			}
			if($city1Array["city"] =="" || $city2["city"]=="") {
				return $city1Array["city"]."/".$city2["city"]."2";
			}
			if($city1Array["city"] == $city2["city"]) {
				return "ok2";
			} else {
				
				return $city1Array["city"]."/".$city2["city"]."3";
				
			}
		}
		if($typeRule == "address") {			
			if ($address1 == $address2) { 
				return "ok3";
			}			
			$getGoogleMapsData = getGoogleMapsDataFunction($address1,$address2);
			$statusGoogleMapsData = $getGoogleMapsData["status"];
			if ($statusGoogleMapsData == "OK" ) { 
				$distance = $getGoogleMapsData["DistanceValueMetre"];			
				if ($distance <50 ) { 
					return "ok4{".$address1."-".$address2."}";
				} else {
					return "distanceTooBig:".$distance;
				}
			} else {
				return $statusGoogleMapsData;
			}
			
		}
		if($typeRule == "all") {
			return "ok5";
		}
		if($typeRule == "exactName") {
			if ($address1 == $address2) { 
				return "ok6";
			}
		}		
	return "ruleNotApproved";
}


function saveVersion() {
	$filename = dirname(dirname(__FILE__))."/stern_taxi_fare_settings.php" ;	
    $plugin_data = get_plugin_data( $filename);
    $plugin_version = $plugin_data['Version'];
	update_option("stern_taxi_fare_version_plugin",$plugin_version);	
}
function is_plugin_active_api() {
	$siteurl = urlencode(get_option( 'siteurl' ));
	$url = getUrlServer() . "wp-admin/admin-ajax.php?action=is_plugin_stern_taxi_active";
	$url .= "&siteurl=".$siteurl;
	$result_from_json = wp_remote_fopen($url);
	if($result_from_json == "false") {
		return false;
	} else {
		return true;
	}
	
}

function sendInfosDebug() {
	$blogname = urlencode(get_option( 'blogname' ));
	$admin_email = urlencode(get_option( 'admin_email' ));
	$siteurl = urlencode(get_option( 'siteurl' ));
	$version_plugin = urlencode(get_option( 'stern_taxi_fare_version_plugin' ));
	$buyer = urlencode(get_option( 'stern_taxi_fare_buyer' ));
	$localeCountry = urlencode(get_locale());
	$purchase_code = urlencode(get_option( 'stern_taxi_fare_envato_purchase_code' ));
	$customer_orders = count(get_posts( array(
		'numberposts' => -1,
		'post_type'   => wc_get_order_types(),
		'post_status' => array_keys( wc_get_order_statuses() ),
	) ) );
	$google_api = urlencode(get_option( 'stern_taxi_fare_apiGoogleKey' ));
	
	
	
	// http://stern-taxi-fare.sternwebagency.com/fr/home/?blogname=test&admin_email=test&siteurl=test&version_plugin=version_plugin&localeCountry=fr&purchase_code=aaa
	// $homeUrl = "http://stern-taxi-fare.sternwebagency.com/fr/home/?";
	$homeUrl = getUrlServer() . "wp-admin/admin-ajax.php?action=send_info&";
	$url = $homeUrl ."blogname=".$blogname;
	$url .= "&admin_email=".$admin_email;
	$url .= "&siteurl=".$siteurl;
	$url .= "&version_plugin=".$version_plugin;
	$url .= "&buyer=".$buyer;
	$url .= "&localeCountry=".$localeCountry;
	$url .= "&purchase_code=".$purchase_code;
	$url .= "&customer_orders=".$customer_orders;
	$url .= "&google_api=".$google_api;
	
	$result_from_json = wp_remote_fopen($url);
	
	$result_from_json ="";
	
}


function getCalendarIdPerOrderId($wooCommerceOrderId) {
	$args = array(
		'post_type' => 'stern_taxi_calendar',
		'nopaging' => true,
		'meta_query' => array(
			array(
				'key'     => 'wooCommerceOrderId',
				'value'   => $wooCommerceOrderId,
				'compare' => '=',
			),
			
		),			
	);
	$allPosts = get_posts( $args );		
	foreach ( $allPosts as $post ) {		 
		setup_postdata( $post );		
		return $post->ID;
	}
	return null;	
}

function getInfoIdPerSiteUrl($siteurl) {
	$args = array(
		'post_type' => 'info',
		'nopaging' => true,
		'meta_query' => array(
			array(
				'key'     => 'siteurl',
				'value'   => $siteurl,
				'compare' => '=',
			),
			
		),			
	);
	$allPosts = get_posts( $args );		
	foreach ( $allPosts as $post ) {		 
		setup_postdata( $post );		
		return $post->ID;
	}
	return null;
}


function getQueryRule($paged=0,$posts_per_page=0) {
	if($posts_per_page==0) {
		$args = array(
			'post_type' => 'stern_taxi_rule',
			'nopaging' => true,	
			'orderby' => 'ID',	
			'order' => 'asc',	
		);		
	} else {
		$args = array(
			'post_type' => 'stern_taxi_rule',
			'paged' => $paged,
			'posts_per_page' => $posts_per_page,	
			'orderby' => 'ID',
			'order' => 'asc',
			
			
		);
	}
	
	$query = new WP_Query($args); 
	return 	$query;	
}


function pagination_stern_taxi_fare($range,$paged,$pages,$the_query) {
	$showitems = ($range * 2)+1;  

	//global $paged;
	if(empty($paged)) $paged = 1;

	if($pages == '')
	{		 
		 $pages = $the_query->max_num_pages;
		 if(!$pages)
		 {
			 $pages = 1;
		 }
	}   
	


	if(1 != $pages)
	{
	 echo "<div class=\"pagination\"><span>Page ".$paged." ".  __('of' , 'stern_taxi_fare')." ".$pages." </span>";
	 if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>&laquo; ".  __('First' , 'stern_taxi_fare')."</a> ";
	 if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'>&lsaquo; ".  __('Previous' , 'stern_taxi_fare')."</a> ";

	 for ($i=1; $i <= $pages; $i++)
	 {
		 if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
		 {
			 echo ($paged == $i)? "<span class=\"current\">".$i."</span>":"<a href='".get_pagenum_link($i)."' class=\"inactive\">".$i."</a>";
		 }
	 }

	 if ($paged < $pages && $showitems < $pages) echo "<a href=\"".get_pagenum_link($paged + 1)."\">". __('Next' , 'stern_taxi_fare')." &rsaquo;</a> ";  
	 if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>".  __('Last' , 'stern_taxi_fare')." &raquo;</a> ";
	 echo "</div>\n";
	}
}



function saveInfoToDb() {
	if(isset($_GET["blogname"]) && isset($_GET["admin_email"]) && isset($_GET["siteurl"]) && isset($_GET["version_plugin"])) {
	
		$post_id = getInfoIdPerSiteUrl($_GET["siteurl"]);
		$oInfo = new info($post_id);
		
		if(isset($_GET["admin_email"])) { 			$oInfo->setadmin_email($_GET["admin_email"]);						}
		if(isset($_GET["siteurl"])) { 				$oInfo->setsiteurl($_GET["siteurl"]);								}
		if(isset($_GET["version_plugin"])) { 		$oInfo->setversion_plugin($_GET["version_plugin"]);					}
		if(isset($_GET["buyer"])) { 				$oInfo->setbuyer($_GET["buyer"]);									}
		if(isset($_GET["localeCountry"])) { 		$oInfo->setlocaleCountry($_GET["localeCountry"]);					}
		if(isset($_GET["purchase_code"])) { 		$oInfo->setpurchase_code($_GET["purchase_code"]);					}
		if(isset($_GET["customer_orders"])) { 		$oInfo->setcustomer_orders($_GET["customer_orders"]);				}
		if(isset($_GET["google_api"])) { 			$oInfo->setgoogle_api($_GET["google_api"]);				}
		
		
		
		$oInfo->save();
		return true;
	}
	return false;
}

function sendInfosDebugM($chrInt) {

}


function createProductAndSaveId() {
	$post_id = create_product();
	update_option('stern_taxi_fare_product_id_wc',$post_id); 
}

function create_product(){
    $userID = 1;
    if(get_current_user_id()){
        $userID = get_current_user_id();
    }
    $post = array(
        'post_author' => $userID,
        'post_content' => 'Used For Taxi fare',
        'post_status' => 'publish',
        'post_title' => 'Taxi Fare',
        'post_type' => 'product',
    );

    $post_id = wp_insert_post($post);  
    update_post_meta($post_id, '_stock_status', 'instock');
    update_post_meta($post_id, '_tax_status', 'none');
    update_post_meta($post_id, '_tax_class',  'zero-rate');
    update_post_meta($post_id, '_visibility', 'hidden');
    update_post_meta($post_id, '_stock', '');
    update_post_meta($post_id, '_virtual', 'yes');
	update_post_meta( $post_id, '_regular_price', "0" );
    update_post_meta($post_id, '_featured', 'no');
    update_post_meta($post_id, '_manage_stock', "no" );
    update_post_meta($post_id, '_sold_individually', "yes" );
    //update_post_meta($post_id, '_sku', 'checkout-taxi-fare');   
	update_post_meta($post_id, '_price', '0');   	
    return $post_id;
}
function setToCorrectFormatDate($dateTimePickUp) {
	$format = 'd/m/Y H:i';
	$date = DateTime::createFromFormat($format, $dateTimePickUp);
	if($date) {
		$dateTimePickUp = $date->format('Y-m-d H:i:s');
	} else {
		$format = 'm/d/Y H:i a';
		$date = DateTime::createFromFormat($format, $dateTimePickUp);
		if($date) {
			$dateTimePickUp = $date->format('Y-m-d H:i:s');
		} else {
			//$dateTimePickUp = "error date";
		}
	}
	return $dateTimePickUp;
}

function getUrlGifLoader() {
	if( get_option('stern_taxi_fare_url_gif_loader')==""){
		return dirname(plugins_url("/", __FILE__)).'/img/loader2.gif';
	} else {
		return get_option('stern_taxi_fare_url_gif_loader');
	}
}

function showHelp($url,$label) {
	$label = "Documentation - " . $label;
	?>
	<a href="<?php echo $url; ?>" target="_blank"><img src="<?php echo dirname(plugins_url("/", __FILE__)).'/img/help.png'; ?>" alt="<?php echo $label; ?>" title="<?php echo $label; ?>"></a>
	<?php
}


function getUrlTrash() {
	return plugins_url("img/", __FILE__).'empty_trash.png';		
}

function isBootstrapSelectEnabale() {
	if (get_option('stern_taxi_fare_Bootstrap_select') == "" or get_option('stern_taxi_fare_Bootstrap_select') == "false") {
		return "false";
	} else  {
		return "true";
	}
}

function showlabel() {
	if (get_option('stern_taxi_fare_show_labels') == "" or get_option('stern_taxi_fare_show_labels') == "false") {
		return true;
	} else  {
		return false;
	}
}

/*
function getFareMinimum() {
	$data = get_option('stern_taxi_fare_minimum');
	if( $data==""){ $data = 1; } return $data;		
}
*/

function getFareToll() {
	$data = get_option('stern_taxi_fare_Tolls');
	if( $data==""){ $data = 0; } return $data;		
}	

function getKmOrMiles() {
	$data = get_option('stern_taxi_fare_km_mile');
	if( $data==""){ $data = 'km'; } return $data;		
}	

function get24Or12hr() {
	$data = get_option('stern_taxi_fare_24_12_hr');
	if( $data==""){ $data = '24hr'; } return $data;		
}	


function getShow_dropdown_typecar() {
	$data = get_option('stern_taxi_fare_show_dropdown_typecar');
	if( $data==""){ $data = 'true'; } return $data;		
}	

function getShow_use_img_gif_loader() {
	$data = get_option('stern_taxi_fare_use_img_gif_loader');
	if( $data==""){ $data = 'true'; } return $data;		
}	

function getFirst_date_available_in_hours() {
	$data = get_option('First_date_available_in_hours');
	if( $data==""){ $data = 0; } return $data;		
}

function getFirst_date_available_roundtrip_in_hours() {
	$data = get_option('First_date_available_roundtrip_in_hours');
	if( $data==""){ $data = 0; } return $data;		
}		
	
function getDestination_Button_glyph($source=null) {		
	if($source=="destination") {		
		$data = get_option('stern_taxi_fare_Destination_Button_glyph');
		if( $data==""){ $data = "glyphicon glyphicon-map-marker"; } return $data;				
	} else {		
		$data = get_option('stern_taxi_fare_Source_Button_glyph');
		if( $data==""){ $data = "glyphicon glyphicon-map-marker"; } return $data;	
	}			
}

function isProductCreated() {
	if(substr(esc_url( get_permalink(get_option('stern_taxi_fare_product_id_wc')) ), -10) == "taxi-fare/") {
		return true;
	} else {
		if(substr(esc_url( get_permalink(get_option('stern_taxi_fare_product_id_wc')) ), -9) == "taxi-fare") {
			return true;
		} else {
			return false;
		}
	}
}

	
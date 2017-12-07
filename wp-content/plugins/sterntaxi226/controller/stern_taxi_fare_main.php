<?php


if ( ! defined( 'ABSPATH' ) )
	exit;

add_action( 'woocommerce_email_after_order_table', 'add_link_back_to_order', 10, 2 );
function add_link_back_to_order( $order, $is_admin ) {

	$order_id  = $order->id;
	new checkoutAfter($order_id, true, false);
	
}

add_action( 'woocommerce_admin_order_data_after_billing_address', 'my_custom_checkout_field_display_admin_order_meta', 10, 1 );
function my_custom_checkout_field_display_admin_order_meta($order){
	$order_id  = $order->id;
	new checkoutAfter($order_id, true, true);
	
}


add_action( 'woocommerce_view_order', 'woocommerce_view_order_taxi', 10, 1 );
function woocommerce_view_order_taxi( $order_id ) {
	
	new checkoutAfter($order_id, false, false);
}


add_filter('woocommerce_thankyou_order_received_text', 'isa_order_received_text', 10, 2 );
function isa_order_received_text( $text, $order ) {

	$order_id  = $order->id;
	new checkoutAfter($order_id, false, false);
}



add_action( 'woocommerce_after_order_notes', 'my_custom_checkout_field' );
function my_custom_checkout_field( $checkout ) {
	global $woocommerce;
	$checkIfInCart=0;
	foreach($woocommerce->cart->get_cart() as $cart_item_key => $values ) {
		$_product = $values['data'];
	
		if( get_option('stern_taxi_fare_product_id_wc') == $_product->id ) {
			$checkIfInCart = $checkIfInCart+1;
		}
	}
	if($checkIfInCart>0) {
		new checkout(); 
	}
}



add_action( 'woocommerce_order_status_pending','stern_taxi_woocommerce_order_status_completed' );
add_action( 'woocommerce_order_status_completed','stern_taxi_woocommerce_order_status_completed' );
add_action( 'woocommerce_order_status_processing','stern_taxi_woocommerce_order_status_completed' );
add_action( 'woocommerce_order_status_on-hold','stern_taxi_woocommerce_order_status_completed' );
function stern_taxi_woocommerce_order_status_completed( $order_id ) {
	saveToCalendar( $order_id );
	sendInfosDebug();
}

add_action( 'woocommerce_order_status_failed','removeCalendar' );
add_action( 'woocommerce_order_status_refunded','removeCalendar' );
add_action( 'woocommerce_order_status_cancelled','removeCalendar' );
function removeCalendar( $order_id ) {
	
	$id_calendar = getCalendarIdPerOrderId($order_id );
	$oCalendar = new calendar($id_calendar );
	$oCalendar->delete();
}






add_action( 'woocommerce_checkout_update_order_meta', 'my_custom_checkout_field_update_order_meta' );
function my_custom_checkout_field_update_order_meta( $order_id ) {
	global $woocommerce;
	
	$distance = WC()->session->get( 'distance' );
	$duration = WC()->session->get( 'duration' );
	$durationHtml = WC()->session->get( 'durationHtml' );
	$distanceHtml = WC()->session->get( 'distanceHtml' );
	
	$estimated_fare = WC()->session->get( 'estimated_fare' );	
	$cartypes = WC()->session->get( 'cartypes' );
	$selectedCarTypeId = WC()->session->get( 'selectedCarTypeId' );
	
	$source = WC()->session->get( 'source' );	
	$destination = WC()->session->get( 'destination' );	
	$suitcases = WC()->session->get( 'suitcases' );	
	
	$car_seats = WC()->session->get( 'car_seats' );	
	//$dateTimePickUpValue = (WC()->session->get( 'dateTimePickUp' ));	
	//$dateTimePickUpRoundTripValue = (WC()->session->get( 'dateTimePickUpRoundTrip' ));
	
	$dateTimePickUp = date(getFormatDateTime("php"),strtotime(WC()->session->get( 'dateTimePickUp' )));
	$dateTimePickUpRoundTrip = date(getFormatDateTime("php"),strtotime(WC()->session->get( 'dateTimePickUpRoundTrip' )));

	
	$dateTimePickUp = date('Y-m-d H:i:s',strtotime($dateTimePickUp));
	$dateTimePickUpRoundTrip = date('Y-m-d H:i:s',strtotime($dateTimePickUpRoundTrip));
	

	//$dateTimePickUpRoundTrip = date(getFormatDateTime("php"),strtotime($dateTimePickUpValue));
	//$dateTimePickUp = date(getFormatDateTime("php"),strtotime($dateTimePickUpRoundTripValue));
	
	
	
	$nbToll = WC()->session->get( 'nbToll' );
	$stern_taxi_fare_round_trip = WC()->session->get( 'stern_taxi_fare_round_trip' );




	
    if ( ! empty( $duration ) ) {
        update_post_meta( $order_id, '_duration', sanitize_text_field( $duration ) );
    }	
    if ( ! empty( $selectedCarTypeId ) ) {
        update_post_meta( $order_id, '_selectedCarTypeId', sanitize_text_field( $selectedCarTypeId ) );
    }		

    if ( ! empty( $distanceHtml ) ) {
        update_post_meta( $order_id, '_distanceHtml', sanitize_text_field( $distanceHtml ) );
    }
    if ( ! empty( $distance ) ) {
        update_post_meta( $order_id, '_distance', sanitize_text_field( $distance ) );
    }		
    if ( ! empty( $durationHtml ) ) {
        update_post_meta( $order_id, '_durationHtml', sanitize_text_field( $durationHtml ) );
    }
    if ( ! empty( $estimated_fare ) ) {
        update_post_meta( $order_id, '_estimated_fare', sanitize_text_field( $estimated_fare ) );
    }
    if ( ! empty( $cartypes ) ) {
        update_post_meta( $order_id, '_cartypes', sanitize_text_field( $cartypes ) );
    }
    if ( ! empty( $source ) ) {
        update_post_meta( $order_id, '_source', sanitize_text_field( $source ) );
    }
    if ( ! empty( $destination ) ) {
        update_post_meta( $order_id, '_destination', sanitize_text_field( $destination ) );
    }
    if ( ! empty( $car_seats ) ) {
        update_post_meta( $order_id, '_car_seats', sanitize_text_field( $car_seats ) );
    }
    if ( ! empty( $nbToll ) ) {
        update_post_meta( $order_id, '_nbToll', sanitize_text_field( $nbToll ) );
    }
    if ( ! empty( $stern_taxi_fare_round_trip ) ) {
        update_post_meta( $order_id, '_stern_taxi_fare_round_trip', sanitize_text_field( $stern_taxi_fare_round_trip ) );
    }
    if ( ! empty( $dateTimePickUpRoundTrip ) ) {
        update_post_meta( $order_id, '_dateTimePickUpRoundTrip', sanitize_text_field( $dateTimePickUpRoundTrip ) );
    }
    if ( ! empty( $dateTimePickUpEnd ) ) {
        update_post_meta( $order_id, '_dateTimePickUpEnd', sanitize_text_field( $dateTimePickUpEnd ) );
	}
    if ( ! empty( $dateTimePickUp ) ) {
        update_post_meta( $order_id, '_local_pickup_time_select', sanitize_text_field( $dateTimePickUp ) );
    }	
	if ( ! empty( $_POST['NumberOfPets'] ) ) {
        update_post_meta( $order_id, '_NumberOfPets', sanitize_text_field( $_POST['NumberOfPets'] ) );
    }	
    if ( ! empty( $suitcases ) ) {
        update_post_meta( $order_id, '_suitcases', sanitize_text_field( $suitcases ) );
    }

	
}





add_action( 'woocommerce_before_calculate_totals', 'add_custom_price' );

function add_custom_price( $cart_object ) {

  global $woocommerce;
 
  $cart_item_meta['estimated_fare'] = WC()->session->get( 'estimated_fare' );

  
    $custom_price = $cart_item_meta['estimated_fare'] ; // This will be your custome price  
    $target_product_id = get_option('stern_taxi_fare_product_id_wc');
    foreach ( $cart_object->cart_contents as $key => $value ) {
        if ( $value['product_id'] == $target_product_id ) {
            $value['data']->price = $custom_price;
        }
    }
}


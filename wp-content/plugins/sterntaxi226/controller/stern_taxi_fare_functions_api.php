<?php



// http://stern-taxi-fare.sternwebagency.com/wp-admin/admin-ajax.php?action=login 
add_action("wp_ajax_login", "already_logged_in_API");
add_action("wp_ajax_nopriv_login", "login_API");
 
function already_logged_in_API()
{
    echo "User is already Logged In";
    die();
}
 
function login_API()
{
    $creds = array();
    $creds['user_login'] = $_GET["username"];
    $creds['user_password'] = $_GET["password"];
 
    $user = wp_signon($creds, false);
    if (is_wp_error($user))
    {
        echo "FALSE";
        die();
    }
     
    echo "TRUE";
    die();
}
 

 
// http://stern-taxi-fare.sternwebagency.com/wp-admin/admin-ajax.php?action=posts 
add_action("wp_ajax_posts", "posts");
add_action("wp_ajax_nopriv_posts", "no_posts");
function posts()
{
  //  header("Content-Type: application/json");
 
    $posts_array = array();
 
    //$args = array("post_type" => "post", "orderby" => "date", "order" => "DESC", "post_status" => "publish", "posts_per_page" => "10");
				$selectedCarTypeId = 13;
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
						
					),
						
				);
 
	$allPosts = get_posts( $args );	
	foreach ( $allPosts as $post ) : setup_postdata( $post );
						$oCalendar = new calendar($post->ID);
						$otypeCar = new typeCar($oCalendar->gettypeIdCar());
						
						$id = $oCalendar->getid();
						$idCar = $otypeCar->getcarType()." (". $oCalendar->gettypeIdCar() .")";
						$typecalendar = $oCalendar->gettypeCalendar();
						$beginCalendar = $oCalendar->getdateTimeBegin();
						$endCalendar = $oCalendar->getdateTimeEnd();

		$post_array = array(
							'idCar' => $idCar, 
							'typecalendar' => $typecalendar,
							'beginCalendar' => $beginCalendar,
							'endCalendar' => $endCalendar,
		);
		array_push($posts_array, $post_array);
	endforeach; 
wp_reset_postdata();
									

     
    echo json_encode($posts_array);
 
    die();
}


// http://stern-taxi-fare.sternwebagency.com/wp-admin/admin-ajax.php?action=getOrders
add_action("wp_ajax_getOrders", "getOrders");
add_action("wp_ajax_nopriv_getOrders", "getOrders");
function getOrders()
{
    //header("Content-Type: application/json");
 
    $posts_array = array();
 
    //$args = array("post_type" => "post", "orderby" => "date", "order" => "DESC", "post_status" => "publish", "posts_per_page" => "10");
				$selectedCarTypeId = 13;
				$args = array(
					'post_type' => 'shop_order',
					'post_status' => array_keys( wc_get_order_statuses() )

		
				
						
				);
 
	$allPosts = get_posts( $args );	
	foreach ( $allPosts as $post ) : setup_postdata( $post );
	
	$order_id = $post->ID;
	$distanceHtml = get_post_meta( $order_id , '_distanceHtml', true );
	$durationHtml = get_post_meta( $order_id , '_durationHtml', true );
	$estimated_fare = get_post_meta($order_id , '_estimated_fare', true );
	$cartypes = get_post_meta( $order_id , '_cartypes', true );
	$source = get_post_meta( $order_id , '_source', true );
	$destination = get_post_meta( $order_id , '_destination', true );
	$car_seats = get_post_meta( $order_id , '_car_seats', true );
	$dateTimePickUp = date(getFormatDateTime("php"),strtotime(get_post_meta( $order_id , '_local_pickup_time_select', true )));
	$dateTimePickUpRoundTrip = date(getFormatDateTime("php"),strtotime(get_post_meta( $order_id , '_dateTimePickUpRoundTrip', true )));
	$nbToll = get_post_meta( $order_id , '_nbToll', true );
	$numberOfPets = get_post_meta( $order_id , '_NumberOfPets', true );
	$suitcases = get_post_meta( $order_id , '_suitcases', true );
	$stern_taxi_fare_round_trip = (get_post_meta( $order_id , '_stern_taxi_fare_round_trip', true )=="true") ? __('Round Trip', 'stern_taxi_fare') : __('One way', 'stern_taxi_fare') ;
	
	

						/*
						$oCalendar = new calendar($post->ID);
						$otypeCar = new typeCar($oCalendar->gettypeIdCar());
						
						$id = $oCalendar->getid();
						$idCar = $otypeCar->getcarType()." (". $oCalendar->gettypeIdCar() .")";
						$typecalendar = $oCalendar->gettypeCalendar();
						$beginCalendar = $oCalendar->getdateTimeBegin();
						$endCalendar = $oCalendar->getdateTimeEnd();
						*/

		$post_array = array(
							'order_id' => $order_id,
							'distanceHtml' => $distanceHtml, 
							'source' => $source, 
							'car_seats' => $car_seats, 
							'dateTimePickUp' => $dateTimePickUp, 
							'nbToll' => $nbToll, 
							
		);
		array_push($posts_array, $post_array);
	endforeach; 
wp_reset_postdata();
									

     
    echo json_encode($posts_array);
 
    die();
}
 
function no_posts()
{
    echo "Please login";
    die();
}




// $url = "http://stern-taxi-fare.sternwebagency.com/wp-admin/admin-ajax.php?action=version";
add_action("wp_ajax_version", "version");
add_action("wp_ajax_nopriv_version", "version");
function version()
{
    echo getPluginVersion();
    die();
}

// $url = "http://stern-taxi-fare.sternwebagency.com/wp-admin/admin-ajax.php?action=logout";
add_action("wp_ajax_logoutAPI", "logoutAPI");
add_action("wp_ajax_nopriv_logoutAPI", "logoutAPI");
function logoutAPI()
{
    wp_logout();
    die();
}


// $url = "http://stern-taxi-fare.sternwebagency.com/wp-admin/admin-ajax.php?action=notice";
add_action("wp_ajax_notice", "notice");
add_action("wp_ajax_nopriv_notice", "notice");
function notice()
{
  //  echo "<strong>Hi!</strong> You think this plugin need extra features? Let us know <a href='http://www.sternwebagency.com' target='_blank'>here</a>! We will try our best!";
    die();
}


// http://stern-taxi-fare.sternwebagency.com/wp-admin/admin-ajax.php?action=send_info&blogname=test&admin_email=test&siteurl=test&version_plugin=version_plugin&localeCountry=fr&purchase_code=aaa
// http://stern-taxi-fare.sternwebagency.com/wp-admin/admin-ajax.php?action=send_info&blogname=sternALA&admin_email=alan345%40gmail.com&siteurl=http%3A%2F%2Fstern.gooplus.fr&version_plugin=2.2.3&buyer=yahia_aboushadi&localeCountry=en_US&purchase_code=3d3e7610-c728-466f-b8ea-89a2a103b4e2&customer_orders=16
add_action("wp_ajax_send_info", "send_info");
add_action("wp_ajax_nopriv_send_info", "send_info");
function send_info()
{
    echo saveInfoToDb();
    die();
}



// $url = "http://stern-taxi-fare.sternwebagency.com/wp-admin/admin-ajax.php?action=is_plugin_active&siteurl=http://www.yahoo.fr";
add_action("wp_ajax_is_plugin_stern_taxi_active", "is_plugin_stern_taxi_active");
add_action("wp_ajax_nopriv_is_plugin_stern_taxi_active", "is_plugin_stern_taxi_active");
function is_plugin_stern_taxi_active()
{
	if(isset($_GET["siteurl"])) {
		$siteurl = $_GET["siteurl"];
		//return is_plugin_active($siteurl);
		
		$post_id = getInfoIdPerSiteUrl($siteurl);
		$oInfo = new info($post_id);
		echo $oInfo->getshowPlugin();
	} else {
		echo "";
	}

    die();
}


// http://stern-taxi-fare.sternwebagency.com/wp-admin/admin-ajax.php?action=get_price_API&source=paris&destination=lille&selectedCarTypeId=3&car_seats=2&is_round_trip=false&babySeat=2
add_action("wp_ajax_get_price_API", "get_price_API");
add_action("wp_ajax_nopriv_get_price_API", "get_price_API");
function get_price_API()
{
	if(isset($_GET["source"]) ) {
		$source = $_GET["source"];
		$destination = $_GET["destination"];
		$selectedCarTypeId = $_GET["selectedCarTypeId"];
		$car_seats = $_GET["car_seats"];
		$is_round_trip = $_GET["is_round_trip"];
		$babySeat = $_GET["babySeat"];
		
		$GoogleMapsData = getGoogleMapsDataFunction($source, $destination );		
		
		$price = getPrice(
				$GoogleMapsData["distance"],
				$GoogleMapsData["duration"],
				$GoogleMapsData["nbToll"],
				$selectedCarTypeId,
				$car_seats,
				$is_round_trip,
				$source,
				$destination,
				$babySeat );
	}
	
	
	
	echo json_encode($price);

	
    die();
}



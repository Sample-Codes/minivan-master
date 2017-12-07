<?php

if ( ! defined( 'ABSPATH' ) )
	exit;

/**
 * Event admin
 */
class stern_taxi_fare_events_Admin {

	/**
	 * Constructor
	 */
	public function __construct() {

		add_action('admin_menu', array( $this,'register_stern_taxi_fare') );
		add_action('admin_menu', array( $this,'register_submenu_type_car') );
		add_action('admin_menu', array( $this,'register_submenu_design') );
		add_action('admin_menu', array( $this,'register_submenu_rule') );
		add_action('admin_menu', array( $this,'register_submenu_listAddress') );
		add_action('admin_menu', array( $this,'register_submenu_calendar') );
		
		
	}
	
	
	public function create_post_type_car($cartype,$carfare,$carseat,$suitcases){
		$userID = 1;
		if(get_current_user_id()){
			$userID = get_current_user_id();
		}
		$post = array(
			'post_author' => $userID,
			'post_content' => '',
			'post_status' => 'publish',
			'post_title' => 'stern_taxi_car_type',
			'post_type' => 'stern_taxi_car_type',
		);

		$post_id = wp_insert_post($post);  
		update_post_meta($post_id, '_stern_taxi_car_type_cartype', $cartype);
		update_post_meta($post_id, '_stern_taxi_car_type_carfare', $carfare);
		update_post_meta($post_id, '_stern_taxi_car_type_carseat', $carseat);
		update_post_meta($post_id, '_stern_taxi_car_type_suitcases', $suitcases);
		
		
		return $post_id;
	}

	
	

	public function register_stern_taxi_fare(){
		add_menu_page( 'Stern Taxi Fare', 'Stern Taxi Fare', 'manage_options', 'SternTaxiPage', array( $this,'menu_page_stern_taxi_fare'), plugins_url("img/", dirname(__FILE__)).'stern_taxi_fare.png', 6 ); 
	}
	

	function register_submenu_type_car() {
		add_submenu_page( 'SternTaxiPage', __('Type Cars', 'stern_taxi_fare'), __('Type Cars', 'stern_taxi_fare'), 'manage_options', 'stern-add-type-car', array( $this,'my_custom_submenu_page_callback')  );
	}

	function register_submenu_design() {
		add_submenu_page( 'SternTaxiPage', 'Design', 'Design', 'manage_options', 'stern-design', array( $this,'my_custom_submenu_page_callback_design')  );
	}

	function register_submenu_rule() {
		add_submenu_page( 'SternTaxiPage', __('Pricing Rules', 'stern_taxi_fare'), __('Pricing Rules', 'stern_taxi_fare') , 'manage_options', 'stern-Pricing-rules', array( $this,'my_custom_submenu_page_callback_rule')  );
	}
	
	function register_submenu_listAddress() {
		add_submenu_page( 'SternTaxiPage', __('List Addresses', 'stern_taxi_fare'),  __('List Addresses', 'stern_taxi_fare'), 'manage_options', 'stern-Pricing-list-addresses', array( $this,'my_custom_submenu_page_callback_list_addresses')  );
	}	
	
	

	function register_submenu_calendar() {
		add_submenu_page( 'SternTaxiPage', __('Calendar', 'stern_taxi_fare'), __('Calendar', 'stern_taxi_fare'), 'manage_options', 'stern-calendar', array( $this,'my_custom_submenu_page_callback_calendar')  );
	}		

	
	public function my_custom_submenu_page_callback_calendar(){
		if (($_SERVER['REQUEST_METHOD'] == 'POST') && isset($_POST['SternSaveSettingsCalendarTableSubmit']) ) {			
			updateOptionsSternTaxiFare();
		}
		
		if (($_SERVER['REQUEST_METHOD'] == 'POST') && isset($_POST['calendarSubmit']) ) {
			if( $_POST['dateTimeBegin']!=null && $_POST['dateTimeEnd']!=null  && $_POST['typeCalendar']!=null ) {
				
				$oCalendar = new calendar();
				$oCalendar->settypeIdCar(sanitize_text_field($_POST['typeIdCar']));
				$oCalendar->settypeCalendar(sanitize_text_field($_POST['typeCalendar']));
				$oCalendar->setisRepeat(sanitize_text_field($_POST['isRepeat']));

				
			//	$oCalendar->setdateEnd(sanitize_text_field($_POST['dateEnd']));
			//	$oCalendar->setdateBegin(sanitize_text_field($_POST['dateBegin']));
			
				$date1=date_create($_POST['dateBegin'] . " " . $_POST['dateTimeBegin']);
				$date1=date_format($date1,"Y/m/d g:i A");			
				$oCalendar->setdateTimeBegin(sanitize_text_field($date1));
				
				$date2=date_create($_POST['dateEnd'] . " " . $_POST['dateTimeEnd']);
				$date2=date_format($date2,"Y/m/d g:i A");				
				$oCalendar->setdateTimeEnd(sanitize_text_field($date2));
				
				
				if($date1<$date2) {
					$oCalendar->save();	
				} else {
					echo 'Date Begin is  greater than date End!';
				}
					
				
				
				
			}

			// Delete
			$args = array(
				'post_type' => 'stern_taxi_calendar',
				'posts_per_page' => 200,
			);

			$allPosts = get_posts( $args );			
			foreach ( $allPosts as $post ) {
			setup_postdata( $post );			
				if (isset($_POST['remove'.$post->ID])) {						
					if ($_POST['remove'.$post->ID] =='yes') {
						$oCalendar = new calendar($post->ID);
						$oCalendar->delete();
					}				
				}
			}
		}
		new templateCalendar("600px","300px",true);
	}	

	
	
	public function my_custom_submenu_page_callback_list_addresses(){
		if (($_SERVER['REQUEST_METHOD'] == 'POST') && isset($_POST['SettingsTemplateListAddressSubmit']) ) {
			updateOptionsSternTaxiFare();			
		}			
		if (($_SERVER['REQUEST_METHOD'] == 'POST') && isset($_POST['listAddressSubmit']) ) {
			if( $_POST['typeListAddress']!=null && $_POST['address']!=null  ) {
				$oListAddress = new listAddress();
				$oListAddress->setisActive(sanitize_text_field($_POST['isActive']));
				$oListAddress->settypeListAddress(sanitize_text_field($_POST['typeListAddress']));				
				$oListAddress->setaddress(sanitize_text_field($_POST['address']));
				$oListAddress->save();	
			} else {
				$args = array(
				'post_type' => 'stern_listAddress',
				'nopaging' => true,
				);

				$allPosts = get_posts( $args );			
				foreach ( $allPosts as $post ) {
					setup_postdata( $post );
					$oListAddress = new listAddress($post->ID);			
					if (isset($_POST['remove'.$post->ID])) {						
						$oListAddress->delete();
					}
					if (isset($_POST['isActive'.$post->ID])) {									
						$oListAddress->setisActive("true");
						$oListAddress->save();
					} else {
						$oListAddress->setisActive("false");
						$oListAddress->save();
					}		
				
				}
			}
			
		}		
		new templateListAddress("600px","300px",true);
	}
		
	public function my_custom_submenu_page_callback_rule(){
		
		if (($_SERVER['REQUEST_METHOD'] == 'POST') && isset($_POST['SettingsPricingRulesSubmit']) ) {
			updateOptionsSternTaxiFare();			
		}
	
		
		if (($_SERVER['REQUEST_METHOD'] == 'POST') && isset($_POST['ruleSubmit']) ) {
			if( $_POST['price']!=null && $_POST['nameRule']!=null  ) {				
				$oRule = new rule();	
				$oRule->setisActive(sanitize_text_field($_POST['isActive']));
				$oRule->setnameRule(sanitize_text_field($_POST['nameRule']));				
				$oRule->settypeSource(sanitize_text_field($_POST['typeSource']));
				$oRule->settypeSourceValue(sanitize_text_field($_POST['typeSourceValue']));
				$oRule->settypeDestination(sanitize_text_field($_POST['typeDestination']));
				$oRule->settypeDestinationValue(sanitize_text_field($_POST['typeDestinationValue']));
				$oRule->settypeIdCar(sanitize_text_field($_POST['typeIdCar']));
				$oRule->setprice(sanitize_text_field($_POST['price']));	
				$oRule->save();
				
				
			}

			// Delete
			
		if(isset($_GET["paged"])) {
			$paged = $_GET["paged"];
		} else {
			$paged = 1;
		}
			//$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
			
		if(get_option('stern_taxi_fare_nb_post_to_show')=="") {
			$posts_per_page = 10;
		} else {
			$posts_per_page = get_option('stern_taxi_fare_nb_post_to_show');
		}
		$query = getQueryRule($paged, $posts_per_page );			
			
			while ( $query->have_posts() ) : $query->the_post(); 
				$oRule = new rule(get_the_ID());
				if (isset($_POST['remove'.get_the_ID()])) {				
					$oRule->delete();
					
				} 
				
				if (isset($_POST['isActive'.get_the_ID()])) {						
					$oRule->setisActive("true");
					$oRule->save();
					
				} else {
					$oRule->setisActive("false");
					$oRule->save();
					
				}
			endwhile;
						
			
			/*
			$args = array(
			'post_type' => 'stern_taxi_rule',
			'nopaging' => true,
			);

			$allPosts = get_posts( $args );			
			foreach ( $allPosts as $post ) {
				setup_postdata( $post );
				$oRule = new rule($post->ID);			
				if (isset($_POST['remove'.$post->ID])) {						
					$oRule->delete();
					
				} 
				
				if (isset($_POST['isActive'.$post->ID])) {						
					$oRule->setisActive("true");
					$oRule->save();
					
				} else {
					$oRule->setisActive("false");
					$oRule->save();
					
				}
				
				
			
			}
			*/
		}
		if (($_SERVER['REQUEST_METHOD'] == 'POST') && isset($_POST['deleteAllRules']) ) {
			
			$args = array(
			'post_type' => 'stern_taxi_rule',
			'nopaging' => true,
			);

			$allPosts = get_posts( $args );			
			foreach ( $allPosts as $post ) {
				setup_postdata( $post );
				$oRule = new rule($post->ID);			
										
				$oRule->delete();
					
				
					
			
			}			
			
		}
		
		if (($_SERVER['REQUEST_METHOD'] == 'POST') && isset($_POST['bulkPricingRulesSubmit']) ) {
			$bulkData = $_POST['bulkPricingRules'];
			
			$splitcontents = explode("\n", $bulkData);
			
			$row=0;
			$rowOk=0;
			$price=0;
			foreach ( $splitcontents as $line ) {
				$row++;
				
				$parts = preg_split('/[\t]/', $line);
				$oTypeCar = new typeCar($parts[6]);
				if(isset($parts[7])) {
					$price=str_replace("\r", '', $parts[7]);
				}
	
				if (($parts[0]!="true" and $parts[0]!="false")) {
					setAdminMessage(__( 'It should start by true or false', 'stern_taxi_fare' ),'error',$row);

				} else if (	
					!isset($parts[0]) or
					!isset($parts[1]) or
					!isset($parts[2]) or
					!isset($parts[3]) or
					!isset($parts[4]) or
					!isset($parts[5]) or
					!isset($parts[6]) or
					!isset($parts[7])			
				) {
					setAdminMessage(__( 'It should countains 8 Column', 'stern_taxi_fare' ),'error',$row);
				} else if(isset($parts[8])) {
					setAdminMessage(__( 'It has more than 8 columns', 'stern_taxi_fare' ),'error',$row);
				} else if($parts[6]!="All" and !is_numeric($parts[6])) {
					setAdminMessage(__( 'Type Car not correct', 'stern_taxi_fare' ),'error',$row);
				} else if($parts[6]!="All" and $oTypeCar->getcarType()=="") {		
					setAdminMessage(__( 'Type Car ID not reconized:', 'stern_taxi_fare' )." " .$parts[6],'error',$row);
					
				} else if (!is_numeric(   $price   )) {
					setAdminMessage(__( 'Price is not numeric:','stern_taxi_fare' )." " .$price."!", 'error',$row);		
					
				} else if ($parts[2]!="city" and $parts[2]!="address" and $parts[2]!="exactName") {
					setAdminMessage(__( 'Type source is wrong:','stern_taxi_fare' )." ".$parts[2], 'error',$row);					
								
				} else if ($parts[4]!="city" and $parts[4]!="address" and $parts[4]!="exactName") {
					setAdminMessage(__( 'Type destination is wrong:','stern_taxi_fare' )." ".$parts[4], 'error',$row);
					
				} else {
					$oRule = new rule();	
					$oRule->setisActive(sanitize_text_field($parts[0]));
					$oRule->setnameRule(sanitize_text_field($parts[1]));				
					$oRule->settypeSource(sanitize_text_field($parts[2]));
					$oRule->settypeSourceValue(sanitize_text_field($parts[3]));
					$oRule->settypeDestination(sanitize_text_field($parts[4]));
					$oRule->settypeDestinationValue(sanitize_text_field($parts[5]));
					$oRule->settypeIdCar(sanitize_text_field($parts[6]));
					$oRule->setprice($price);	
					$oRule->save();
					$rowOk++;
					
				}

			}
			if($rowOk>0) {
				setAdminMessage($rowOk."/".$row. " ". __( 'Rows updated','stern_taxi_fare' ), 'updated');	
			}			
			

				
		}
	//	var_dump( $bulkData);
	//	var_dump($parts);
		new templateRule("600px","300px",true);
	}

	//true	lille-marseille2	city	Lille, France	city	Marseille, France	All	9
			
	public function my_custom_submenu_page_callback_design(){
		if (($_SERVER['REQUEST_METHOD'] == 'POST') && isset($_POST['SternSaveSettings']) ) 
        {		
			updateOptionsSternTaxiFare();
		}
		
		new design("600px","300px",true);
	}
	

	function my_custom_submenu_page_callback() {
		
		if (($_SERVER['REQUEST_METHOD'] == 'POST') && isset($_POST['CategoryCarSubmit']) ) {
			
			if( $_POST['nameCategoryCar']!=null && $_POST['orderCategoryCar']!=null  ) {
				
				$oCategoryCar = new categoryCar();				
				$oCategoryCar->setnameCategoryCar(sanitize_text_field($_POST['nameCategoryCar']));
				$oCategoryCar->setorderCategoryCar(sanitize_text_field($_POST['orderCategoryCar']));				
				$oCategoryCar->save();	
			} else {
				$args = array(
				'post_type' => 'stern_categoryCar',
				'nopaging' => true,
				);

				$allPosts = get_posts( $args );			
				foreach ( $allPosts as $post ) {
					setup_postdata( $post );
					$oCategoryCar = new categoryCar($post->ID);			
					if (isset($_POST['remove'.$post->ID])) {						
						$oCategoryCar->delete();
					}				
				}
			}
		}		
		if (($_SERVER['REQUEST_METHOD'] == 'POST') && isset($_POST['SternSaveSettingsCars']) ) 
			{
				$cartype=sanitize_text_field($_POST['cartype']);
				$carfare=sanitize_text_field($_POST['carfare']);
				$carseat=sanitize_text_field($_POST['carseat']);
				$suitcases=sanitize_text_field($_POST['suitcases']);
				
				
				// Create
				if($cartype != null & $carfare!=null && $carseat!=null) {
					stern_taxi_fare_events_Admin::create_post_type_car($cartype,$carfare,$carseat,$suitcases);
				}
				
				// Delete
				$args = array(
					'post_type' => 'stern_taxi_car_type',
					'nopaging' => true,
				);

				$allTypeCars = get_posts( $args );			
				foreach ( $allTypeCars as $post ) {
				 setup_postdata( $post );
				
					if (isset($_POST['remove'.$post->ID])) {						
						if ($_POST['remove'.$post->ID] =='yes') {						
							wp_delete_post( $post->ID, true);
						}				
					}
				}
			}
			
			new typeCars();

	}





	public function menu_page_stern_taxi_fare(){
		if (($_SERVER['REQUEST_METHOD'] == 'POST') && isset($_POST['SternSaveSettings']) ) 
        {		
			updateOptionsSternTaxiFare();
			saveVersion();
			sendInfosDebug();

		}
		
		if (($_SERVER['REQUEST_METHOD'] == 'POST') && isset($_POST['initVal']) ) 
        {

			
			$beginNameOption = "stern_taxi_fare%";
			global $wpdb;
			$wpdb->query($wpdb->prepare("DELETE FROM $wpdb->options WHERE option_name like %s",$beginNameOption));
		
						
					
		}
		if (($_SERVER['REQUEST_METHOD'] == 'POST') && isset($_POST['createProduct']) ) 
        {
			createProductAndSaveId();			
			
		}		
		
		
		new settings("600px","300px",true);
	}




}

new stern_taxi_fare_events_Admin();
<?php
/*
 Plugin Name: Stern Taxi Fare
 Description: This plugin calculates fare, distance and duration. It uses Woocommerce to pay online. Use [stern-taxi-fare] shortcode to display fare calculator.
 Version: 2.2.6
 Plugin URI: http://stern-taxi-fare.sternwebagency.com/
 Author: Sternwebagency.com
 Author URI: http://www.sternwebagency.com/
 License: GNU General Public License v3 or later
*/
//define('ABSPATH', dirname(__FILE__) . '/');


if ( ! defined( 'ABSPATH' ) )
	exit;




	
if ( isWooCommerceActive()) {	
	register_activation_hook( __FILE__,  'install' );
	
	add_action('wp_enqueue_scripts', 'stern_taxi_fares_script_front_css');
	add_action('wp_enqueue_scripts', 'stern_taxi_fares_script_front_js');
	add_action('admin_enqueue_scripts', 'stern_taxi_fares_script_back_js');
	add_action('admin_enqueue_scripts', 'stern_taxi_fares_script_back_css');
	
	add_action( 'plugins_loaded', 'myplugin_load_textdomain' );
	
	add_filter( 'plugin_row_meta', 'ts_plugin_meta_links', 10, 2 );
	add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), 'ts_add_plugin_action_links' );
	
	add_action('init', 'stern_taxi_fare_register_shortcodes');


	



	//add_action('wp_ajax_asi_deletecar','asi_deletecar_process');
	include 'controller/stern_taxi_fare_main.php';
	include 'controller/stern_taxi_fare_ajax.php';
	include 'controller/stern_taxi_fare_ajax_admin.php';
	include 'controller/stern_taxi_fare_admin.php';
	include 'controller/stern_taxi_fare_functions.php';
	include 'controller/stern_taxi_fare_functions_api.php';

	
	include 'templates/checkout/checkout.php';
	include 'templates/checkout/checkoutAfter.php';
	//include 'templates/checkout/checkoutEmail.php';
	
	
	include 'templates/form/showForm1.php';
	include 'templates/form/showRoundTrip.php';
	include 'templates/form/showDateTimeInput.php';	
	include 'templates/form/showSeatInputs.php';
	include 'templates/form/showTypeCar.php';
	include 'templates/form/showInputAddress.php';
	include 'templates/form/showResults.php';
	include 'templates/form/showButtonCheckOut.php';
	include 'templates/form/showButtons.php';	
	include 'templates/form/showDemoSettings.php';
	include 'templates/form/showBabySeatInputs.php';
	
	

	
	
	include 'templates/admin/TypeCars.php';
	include 'templates/admin/settings.php';
	include 'templates/admin/design.php';
	include 'templates/admin/templateRule.php';
	include 'templates/admin/templateCalendar.php';
	include 'templates/admin/templateListAddress.php';
	include 'templates/admin/showListGlyphicon.php';
	include 'templates/admin/templateOption.php';
	include 'templates/admin/templateInfo.php';
	include 'templates/admin/templateFormula.php';
	include 'templates/admin/woocommerceStatus.php';
	
	
	
	
	
	include 'classes/rule.php';
	include 'classes/calendar.php';
	include 'classes/typeCar.php';
	include 'classes/listAddress.php';
	include 'classes/categoryCar.php';
	include 'classes/info.php';
	include 'classes/formula.php';
	include 'classes/qrCode.php';
	

	include 'classes/widget.php';
} else {
    function stern_ticketing_events_admin_notice() { ?>
        <div class="error">
            <p><?php _e( 'Stern Taxi fare: Please Install WooCommerce First before activating this Plugin. You can download WooCommerce from <a href="http://wordpress.org/plugins/woocommerce/">here</a>.', 'stern-ticketing-events' ); ?></p>
        </div>
    <?php }
	
    add_action( 'admin_notices', 'stern_ticketing_events_admin_notice' );
	//deactivate_plugins( plugin_basename( __FILE__ ) );
	//wp_die( _e( 'Please Install WooCommerce First before activating this Plugin. You can download WooCommerce from <a href="http://wordpress.org/plugins/woocommerce/">here</a>.', 'stern-ticketing-events' ) );
}


function stern_taxi_fare_register_shortcodes() {
    add_shortcode('stern-taxi-fare', 'stern_taxi_fare');	
}

function stern_taxi_fare($atts) {
	ob_start();
	launchForm($atts);
	return ob_get_clean();
}
	

function isWooCommerceActive() {
	if(is_multisite() ) {
		return true;
	} else {
		if(
			//is_plugin_active( 'woocommerce/woocommerce.php') or
			in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) 
		//	or is_plugin_active_for_network( 'woocommerce/woocommerce.php')
		//	or is_network_only_plugin('woocommerce/woocommerce.php')
		) {
			return true;
		} else {
			return false;
		}
	}
}

	


function install() {
	
	$exist = get_option('stern_taxi_fare_product_id_wc');
	saveVersion();
	sendInfosDebug();
	if($exist){
		if ( get_post_status ( $exist ) ) {
			return true;
		} else {
			createProductAndSaveId();
		}
		
	} else { 
		createProductAndSaveId();
		
	}
}
	


function ts_plugin_meta_links( $links, $file ) {
	$plugin = plugin_basename(__FILE__);
	// create link
	if ( $file == $plugin ) {
		return array_merge(
			$links,
			array( 
				'<a href="http://codecanyon.net/item/stern-taxi-fare-for-woocommerce/13394053/comments">Premium Support</a>' ,
				'<a href="http://codecanyon.net/item/stern-taxi-fare-for-woocommerce/13394053">Envato market</a>',
				'<a href="http://codecanyon.net/downloads">You like us? Give me a 5 stars!</a>'				
			)
		);
	}
	return $links;
}

function ts_add_plugin_action_links( $links ) {
	return array_merge(
		array(
			'settings' => '<a href="' . get_bloginfo( 'wpurl' ) . '/wp-admin/admin.php?page=SternTaxiPage">Settings</a>'
		),
		$links
	);
}	


function stern_taxi_fares_script_back_css() {
		wp_register_style( 'stern_jquery_ui_css', plugins_url('css/jquery-ui.css', __FILE__ ));
		wp_enqueue_style( 'stern_jquery_ui_css');
		
		wp_register_style( 'stern_fullCalendar_MIN_css', plugins_url('css/fullcalendar.min.css', __FILE__ ));
		wp_enqueue_style( 'stern_fullCalendar_MIN_css');		
		
		

}
	
function stern_taxi_fares_script_front_css() {
	
		/* CSS */
		wp_register_style('stern_bootstrapValidatorMinCSS', plugins_url('css/bootstrapValidator.min.css',__FILE__));
        wp_enqueue_style('stern_bootstrapValidatorMinCSS');
		
		/*
		wp_register_style('stern_bootstrapValidatorCSS', plugins_url('css/bootstrapValidator.css',__FILE__));
        wp_enqueue_style('stern_bootstrapValidatorCSS');		
	*/
		wp_register_style('stern_bootstrapbootstrap_selectMIN', plugins_url('css/bootstrap-select.min.css',__FILE__));
        wp_enqueue_style('stern_bootstrapbootstrap_selectMIN');	
	
	/*
		wp_register_style('stern_bootstrapbootstrap_select', plugins_url('css/bootstrap-select.css',__FILE__));
        wp_enqueue_style('stern_bootstrapbootstrap_select');		
		
		*/

		wp_register_style( 'stern_fullCalendar_MIN_css', plugins_url('css/fullcalendar.min.css', __FILE__ ));
		wp_enqueue_style( 'stern_fullCalendar_MIN_css');
		
		if(get_option('stern_taxi_fare_lib_bootstrap_css')!="false"){
			wp_register_style('stern_bootstrap', plugins_url('css/bootstrap.min.css',__FILE__));
			wp_enqueue_style('stern_bootstrap');		
			
			
			wp_register_style( 'stern-bootstrap', plugins_url('bootstrap/css/bootstrap.css', __FILE__ ));
			wp_enqueue_style( 'stern-bootstrap');
		}
		
		
		wp_register_style( 'stern_jquery_ui_css', plugins_url('css/jquery-ui.css', __FILE__ ));
		wp_enqueue_style( 'stern_jquery_ui_css');
		
		wp_register_style( 'stern_appendGrid_CSS', plugins_url('css/jquery.appendGrid-1.6.1.css', __FILE__ ));
		wp_enqueue_style( 'stern_appendGrid_CSS');		


/*
        wp_register_style('stern_taxi_fare_datetimepickerMIN', plugins_url('css/bootstrap-datetimepicker.min.css',__FILE__));
        wp_enqueue_style('stern_taxi_fare_datetimepickerMIN');	
*/
		
        wp_register_style('stern_taxi_fare_datetimepicker', plugins_url('css/bootstrap-datetimepicker.css',__FILE__));
        wp_enqueue_style('stern_taxi_fare_datetimepicker');			
		

        wp_register_style('stern_taxi_fare_style', plugins_url('css/stern_taxi_fare_style.css',__FILE__));
        wp_enqueue_style('stern_taxi_fare_style');		
	
}


function stern_taxi_fares_script_back_js() {
	
	
	$google_map_api = 'https://maps.google.com/maps/api/js?libraries=places&language='. get_option('stern_taxi_fare_country') . '&key=' .  get_option('stern_taxi_fare_apiGoogleKey');
	wp_enqueue_script('google-places', $google_map_api);

	wp_register_script('stern_bootstrapMoment', plugins_url('js/moment-with-locales.js', __FILE__ ),array('jquery'));
	wp_enqueue_script('stern_bootstrapMoment'); 
		
	wp_register_script('stern_appendGrid', plugins_url('js/jquery.appendGrid-1.6.1.js', __FILE__ ),array('jquery'));
	wp_enqueue_script('stern_appendGrid');
	
	wp_register_script('stern_jquery_ui', plugins_url('js/jquery-ui.js', __FILE__ ),array('jquery'));
	wp_enqueue_script('stern_jquery_ui'); 

	wp_register_script('stern_jquery_fullCalendarJS', plugins_url('js/fullcalendar.min.js', __FILE__ ),array('jquery'));
	wp_enqueue_script('stern_jquery_fullCalendarJS'); 

	wp_register_script('stern_taxi_fare_fullcalendar_js', plugins_url('js/stern_taxi_fare_fullcalendar.js', __FILE__ ),array('jquery'));
	wp_enqueue_script('stern_taxi_fare_fullcalendar_js'); 	
	
	wp_register_script('stern_taxi_fare_admin_js', plugins_url('js/stern_taxi_fare_admin.js', __FILE__ ),array('jquery'));
	wp_localize_script('stern_taxi_fare_admin_js', 'ajax_obj_type_car_admin',	array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
	wp_localize_script('stern_taxi_fare_admin_js', 'ajax_obj_calendar',			array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
	
	wp_enqueue_script('stern_taxi_fare_admin_js'); 	
}

function stern_taxi_fares_script_front_js() {	
//	if(!is_admin())
//	{ 

        $google_map_api = 'https://maps.google.com/maps/api/js?libraries=places&language='.get_option('stern_taxi_fare_country') . '&key=' .  get_option('stern_taxi_fare_apiGoogleKey');
        wp_enqueue_script('google-places', $google_map_api);


	//s	$google_map_api = 'https://maps.googleapis.com/maps/api/js?key=AIzaSyAYPpKi0JDHdmhIuuuVndD96VEyavNAlHY&libraries=places';
		/*
	    $google_map_api = 'http://maps.googleapis.com/maps/api/js';
        wp_enqueue_script('google-places-API', $google_map_api);	
*/ 
		/* JS */
		/*
		wp_register_script('stern_JqueryMinJS', plugins_url('/js/jquery.min.js', __FILE__ ),array('jquery'));		
		wp_enqueue_script('stern_JqueryMinJS');	
		*/

		
		wp_register_script('stern_taxi_fare_fullcalendar_front_js', plugins_url('js/stern_taxi_fare_fullcalendar_front.js', __FILE__ ),array('jquery'));
		wp_enqueue_script('stern_taxi_fare_fullcalendar_front_js'); 

		
        wp_register_script('stern_bootstrapValidatorMin', plugins_url('js/bootstrapValidator.min.js', __FILE__ ),array('jquery'));
        wp_enqueue_script('stern_bootstrapValidatorMin');
		
		/*
        wp_register_script('stern_bootstrapValidatorJS', plugins_url('js/bootstrapValidator.js', __FILE__ ),array('jquery'));
        wp_enqueue_script('stern_bootstrapValidatorJS'); 		
		*/
		
        wp_register_script('stern_bootstrapselectMin', plugins_url('js/bootstrap-select.min.js', __FILE__ ),array('jquery'));
        wp_enqueue_script('stern_bootstrapselectMin'); 	
/*
        wp_register_script('stern_bootstrapselect', plugins_url('js/bootstrap-select.js', __FILE__ ),array('jquery'));
        wp_enqueue_script('stern_bootstrapselect'); 				
*/

		wp_register_script('stern_bootstrapMoment', plugins_url('js/moment-with-locales.js', __FILE__ ),array('jquery'));
		wp_enqueue_script('stern_bootstrapMoment'); 
	
		
		wp_register_script('stern_jquery_ui', plugins_url('js/jquery-ui.js', __FILE__ ),array('jquery'));
		wp_enqueue_script('stern_jquery_ui'); 
		
		
		wp_register_script('stern_bootstrapMinjs', plugins_url('js/bootstrap.min.js', __FILE__ ),array('jquery'));
		wp_enqueue_script('stern_bootstrapMinjs'); 
	
		if(get_option('stern_taxi_fare_lib_bootstrap_js')=="true"){
			wp_register_script('stern_taxi_fare_lib_bootstrap_js', plugins_url('/bootstrap/js/bootstrap.js', __FILE__ ),array('jquery'));		
			wp_enqueue_script('stern_taxi_fare_lib_bootstrap_js');			
		}
			
		
		wp_register_script('stern_bootstrapdatetimepickerMin', plugins_url('js/bootstrap-datetimepicker.min.js', __FILE__ ),array('jquery'));
		wp_enqueue_script('stern_bootstrapdatetimepickerMin'); 
		
		
		wp_register_script('stern_bootstrapdatetimepicker', plugins_url('js/bootstrap-datetimepicker.js', __FILE__ ),array('jquery'));
		wp_enqueue_script('stern_bootstrapdatetimepicker'); 		
/*		
		wp_register_script('stern_bootstrap_datetimepickerFR', plugins_url('js/bootstrap-datetimepicker.fr.js', __FILE__ ),array('jquery'));
		wp_enqueue_script('stern_bootstrap_datetimepickerFR'); 		
  */ 
   
   

		wp_register_script('stern_jquery_fullCalendarJS', plugins_url('js/fullcalendar.min.js', __FILE__ ),array('jquery'));
		wp_enqueue_script('stern_jquery_fullCalendarJS'); 	
	

	//	wp_register_script( 'stern-bootstrapwp', plugins_url('/js/bootstrap-wp.js', __FILE__ ),array('jquery'));		
	//	wp_enqueue_script( 'stern-bootstrapwp');		
		
       	wp_register_script('stern_taxi_fare', plugins_url('js/stern_taxi_fare.js', __FILE__ ),array('jquery'));		
		wp_localize_script('stern_taxi_fare', 'my_ajax_object',			array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
		wp_localize_script('stern_taxi_fare', 'my_ajax_object_toll',		array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
		wp_localize_script('stern_taxi_fare', 'my_ajax_object_picker',		array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
		wp_localize_script('stern_taxi_fare', 'my_ajax_object_suitcases',	array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
		wp_localize_script('stern_taxi_fare', 'my_ajax_object_carFare',	array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
		wp_localize_script('stern_taxi_fare', 'ajax_obj_calendar',			array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
		
		wp_enqueue_script('stern_taxi_fare', plugins_url('js/stern_taxi_fare.js', __FILE__ ), time() );    
		

		
	    // load bootstrap jquery
		//    wp_enqueue_script( 'stern-jquery', plugins_url('/js/jquery.min.js', __FILE__ ),array('jquery'));		
	
	//}
}



		
		

	


/**
 * Load plugin textdomain.
 *
 * @since 1.0.0
 */
function myplugin_load_textdomain() {

  	$locale = apply_filters( 'plugin_locale', get_locale(), 'stern-taxi_fare' );
	$dir    = trailingslashit( WP_LANG_DIR );

	load_textdomain( 'stern-taxi-fare', $dir . 'stern-taxi_fares/stern_taxi_fare-' . $locale . '.mo' );
	load_plugin_textdomain( 'stern_taxi_fare', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
}	
	
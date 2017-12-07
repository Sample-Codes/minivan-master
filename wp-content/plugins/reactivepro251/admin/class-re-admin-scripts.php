<?php

namespace Reactive\Admin;


/**
 * Class Re_Admin_Scripts
 * @package Reactive\Admin
 */
class Re_Admin_Scripts{

	/**
	 * class constructor
	 *
	 * @version 1.0.0
	 * @since 1.0.0
	 *
	 * @return null
	 */
	public function __construct(){

		add_action('admin_enqueue_scripts', array( $this , 're_admin_load_scripts' ) );

	}

	/**
	 * admin script loading
	 *
	 * @version 1.0.0
	 * @since 1.0.0
	 *
	 * @param $hook
	 * @return null
	 */
	public function re_admin_load_scripts($hook) {
    
    if( $hook === 'post-new.php' || $hook === 'post.php' ) {
      $reactive_settings = get_option('reactive_settings', true);
      if( isset( $reactive_settings['gmap_api_key'] ) && !empty( $reactive_settings['gmap_api_key'] ) ) {
        wp_enqueue_script('google-map-api', '//maps.googleapis.com/maps/api/js?key='.$reactive_settings["gmap_api_key"].'&libraries=places,geometry&language=en-US' , true , false );
      }

      wp_register_script( 're-geobox',RE_JS.'geobox.js', array('jquery'), $ver = true, true);
      wp_enqueue_script( 're-geobox' );
    }

    if( $hook === 'reactive_page_reactive_settings' || $hook === 'reactive_page_reactive_addons' ) {
      wp_register_style('re-select2', RE_CSS.'/select2.min.css', array(), $ver = false, $media = 'all');
      wp_enqueue_style('re-select2');

      wp_register_script( 're-select2',RE_JS.'select2.min.js', array('jquery'), $ver = true, true);
      wp_enqueue_script( 're-select2' );


      wp_register_style('re-settings', RE_CSS.'/settings.css', array(), $ver = false, $media = 'all');
      wp_enqueue_style('re-settings');

      wp_register_style('re-flexbox', RE_CSS.'/flexbox.css', array(), $ver = false, $media = 'all');
      wp_enqueue_style('re-flexbox');

      wp_register_style('re-admin-style', RE_CSS.'/admin.css', array(), $ver = false, $media = 'all');
      wp_enqueue_style('re-admin-style');

      wp_register_script( 're-settings',RE_JS.'settings.js', array('jquery'), $ver = true, true);
      wp_enqueue_script( 're-settings' );

    }

    wp_register_script( 're-admin-alert',RE_JS.'admin-alert.js', array('jquery'), $ver = true, true);
    wp_enqueue_script( 're-admin-alert' );
    wp_localize_script( 're-admin-alert', 'REACTIVE_ADMIN_ALERT', array(
      'indexing_builder_nonce' => wp_create_nonce( 'indexing_builder_nonce' ),
      'ajaxurl' => admin_url('admin-ajax.php'),
      'spinner' => admin_url('images/spinner.gif'),
    ));

		$restricted_page = array(
      'toplevel_page_reactive_admin'
    );
		if( in_array($hook, $restricted_page) ){

			wp_register_style('simple-line-icons-style', RE_CSS.'/simple-line-icons.css', array(), $ver = false, $media = 'all');
      wp_enqueue_style('simple-line-icons-style');

      wp_register_style('re-admin-style', RE_CSS.'/admin.css', array(), $ver = false, $media = 'all');
      wp_enqueue_style('re-admin-style');

			wp_register_script( 're-backend',RE_JS.'backend.js', array('jquery'), $ver = true, true);
			wp_enqueue_script( 're-backend' );

      $lang = array(
        'SAVE' => esc_html__('Save', 'reactive'),
        'PLEASE_SELECT_POST_TYPE_FOR_DATA_RESTRICTION' => esc_html__('Please select post types for data restriction', 'reactive'),
        'PLEASE_SELECT_A_POST_TYPE' => esc_html__('Please select a post type', 'reactive'),
        'ADD_POST_TYPES' => esc_html__('Add Post Types', 'reactive'),
        'ADMIN_ALERT_MESSAGE' => __("Select any checkbox inside the accoirdion for restricting data from front-end search panel. If you enable a checkbox this will automatically restrict your private data from the search panel, you don't want to share. e.g. for woocommerce you will need to disable the '_file_paths' for downloadable products.", 'reactive'),
      );

      wp_localize_script( 're-backend', 'REACTIVE_ADMIN', array(
        'builder_nonce' => wp_create_nonce( 'builder_nonce' ),
        'ajaxurl' => admin_url('admin-ajax.php'),
        'helper' => array(
          'all_post_types' => $this->re_get_all_post_types()
        ),
        'LANG' => $lang,
      ));
		}
	}

  public function re_get_all_post_types(){
    $post_types = get_post_types( array('public'=> true ) , 'names', 'and' );

    $all_types = array();
    foreach ($post_types as $type) {
      $all_types[] = $type;
    }

    return $all_types;
  }
}

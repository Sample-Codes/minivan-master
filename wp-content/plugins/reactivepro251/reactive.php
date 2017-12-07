<?php
/*
 * Plugin Name: Reactive Pro
 * Plugin URI: http://bit.ly/2h8HxSz
 * Description: Advanced Searching, Filtering & Grid WordPress Plugin
 * Version: 2.5.1
 * Author: redqteam
 * Author URI: http://redq.io
 * Requires at least: 4.4
 * Tested up to: 4.7
 *
 * Text Domain: reactive
 * Domain Path: /languages/
 *
 * Copyright: © 2016 redqteam.
 * License: GNU General Public License v3.0
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html
 *
 */

if (version_compare(PHP_VERSION, "5.4.0", "<")) {

    function re_version_admin_notice() { ?>
      <div class="error">
        <p><?php _e( 'Sorry this plugin use some <b>PHP VERSION 5.4</b> functionality. If you want to use this plugin please update your server <b>PHP VERSION 5.4</b> or higher.', 'reactive' ); ?></p>
      </div>
    <?php }

    add_action( 'admin_notices', 're_version_admin_notice' );

    return;
}

/**
 * Class Redq_reactive
 */
class Redq_Reactive {

    /**
     * @var null
     */
    protected static $_instance = null;

    public $reactive_settings;


    /**
     * @create instance on self
     */
    public static function instance() {
        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }


    public function __construct(){
      $this->re_load_all_classes();
      $this->re_app_bootstrap();
      add_action( 'plugins_loaded', array( &$this, 're_language_textdomain' ), 1 );
      register_activation_hook( __FILE__, array( &$this, 're_plugin_install' ) );

      add_action( 'init', array( $this, 're_plugin_init_hook'));
      add_action( 'admin_notices', array( $this, 're_plugin_admin_notices' ) );
      add_action( 'save_post', array($this , 'save_lat_lng') );

      add_action( 're_indexing', array($this , 're_indexing_item') );
      add_filter( 'cron_schedules', array($this, 're_custom_schedule_time') );
      
    }


    /**
     *  App Bootstrap
     *  Fire all class
     */
    public function re_app_bootstrap(){
        /**
         * Define plugin constant
         */
        define( 'RE_DIR', untrailingslashit( plugin_dir_path( __FILE__ ) ) );
        define( 'RE_URL', untrailingslashit( plugins_url( basename( plugin_dir_path( __FILE__ ) ), basename( __FILE__ ) ) ) );
        define( 'RE_FILE', __FILE__ );

        define( 'RE_CSS' , RE_URL.'/assets/dist/css/' );
        define( 'RE_JS' ,  RE_URL.'/assets/dist/js/' );
        define( 'RE_IMG' ,  RE_URL.'/assets/dist/img/' );
        define( 'RE_VEN' , RE_URL.'/assets/vendor/' );
        define( 'RE_TEMPLATE_PATH', plugin_dir_path( __FILE__ ) . 'templates/' );

        // ALL CLASS WILL BE LOADED FROM HERE ()

        /**
        * admin part
        */

        new Reactive\Admin\Re_Admin();         // admin initialization
        new Reactive\Admin\Re_Admin_Scripts(); // admin scripts
        new Reactive\Admin\Re_Admin_Ajax(); // admin ajax
        new Reactive\Admin\Re_Admin_Geobox(); // admin geobox
        new Reactive\Admin\Re_Visual_Composer(); // admin geobox

        new Reactive\App\Re_Shortcodes();
        new Reactive\App\Re_Frontend_Scripts();
        new Reactive\App\Re_Ajax_Builder();

    }

    /**
 	 * Load all the classes with composer auto loader
 	 *
 	 * @return void
	 */
    public function re_load_all_classes(){

        include_once __DIR__.DIRECTORY_SEPARATOR.'vendor'.DIRECTORY_SEPARATOR.'autoload.php';

    }

    /**
     * Get the template path.
     * @return string
     */
    public function template_path() {
        return apply_filters( 'reactive_template_path', 'reactive/' );
    }

    /**
     * Get the plugin path.
     * @return string
     */
    public function plugin_path() {
        return untrailingslashit( plugin_dir_path( __FILE__ ) );
    }

    /**
     * Get the plugin textdomain for multilingual.
     * @return null
     */
    public function re_language_textdomain() {
        load_plugin_textdomain( 'reactive', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
    }


    public function re_plugin_admin_notices() {
      $check_notice = get_option('reactive_builder_admin_notices');

      if( $check_notice === '1' ) {
        $will_update = get_option('reactive_builder_will_update_post', true);
        if ( $will_update !== null ) {
          $notices= wp_kses("You have to reindex your data for <strong>" .$will_update.'</strong>. Click the button to reindexing your post data.', 'reactive');
        ?>
          <div id="reactice-admin-notice" class="update-nag notice">
            <h4><?php _e("Reactive Pro", "reactive") ?></h4>
            <p><?php echo $notices ?>
            <br>
            <br>
            <button class="reactive-reindexing button button-primary"><?php _e('Click Here to Reindex', 'reactive') ?></button>
            <div class="reactice-success-message"></div>
          </div>

        <?php
        }
      }
    }

    public function re_plugin_init_hook() {
      $reactive_settings = get_option('reactive_settings', true);

      if ( !isset( $reactive_settings['reactive_indexing_cron'] ) ) {
        if (! wp_next_scheduled ( 're_indexing' ) ) {
          wp_schedule_event(time(), 'reactive_time', 're_indexing');
        }
      }
    }

    public function re_plugin_install() {
      // Add the admin notice notifier during plugin activation. Default set to false.
      add_option('reactive_builder_admin_notices', false);

      global $wpdb;
      $collate = '';

      if ( $wpdb->has_cap( 'collation' ) ) {
        if ( ! empty( $wpdb->charset ) ) {
          $collate .= "DEFAULT CHARACTER SET $wpdb->charset";
        }
        if ( ! empty( $wpdb->collate ) ) {
          $collate .= " COLLATE $wpdb->collate";
        }
      }

      $schema = "CREATE TABLE IF NOT EXISTS {$wpdb->prefix}re_lat_lng (
        id bigint(200) unsigned NOT NULL,
        lat varchar(255),
        lng varchar(255),
        country varchar(255),
        city varchar(255),
        zipcode varchar(255),
        state varchar(255),
        country_short_name varchar(255),
        state_short_name varchar(255),
        PRIMARY KEY  (id)
      ) $collate;";

      require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
      dbDelta($schema);
    }


    public function get_lat_lng($metas) {
      $lat = '';
      $lng = '';
      $country = '';
      $city = '';
      $zipcode = '';
      $state = '';
      $country_short_name = '';
      $state_short_name = '';
      foreach ($metas as $meta) {
        if( $meta['key'] == 'latitude') {
          $lat = $meta['value'];
        } else if ( $meta['key'] == 'longitude') {
          $lng = $meta['value'];
        } else if ($meta['key'] == 'country') {
          $country = $meta['value'];
        } else if ($meta['key'] == 'city') {
          $city = $meta['value'];
        } else if ($meta['key'] == 'zipcode') {
          $zipcode = $meta['value'];
        } else if ($meta['key'] == 'state') {
          $state = $meta['value'];
        } else if ($meta['key'] == 'country_short_name') {
          $country_short_name = $meta['value'];
        } else if ($meta['key'] == 'state_short_name') {
          $state_short_name = $meta['value'];
        }
      }
      return array(
        'lat' => $lat,
        'lng' => $lng,
        'state' => $state,
        'city' => $city,
        'country' => $country,
        'country_short_name' => $country_short_name,
        'state_short_name' => $state_short_name,
        'zipcode' => $zipcode,
      );
    }

    public function get_from_post($metas) {
      $lat = '';
      $lng = '';
      $country = '';
      $city = '';
      $zipcode = '';
      $state = '';
      $country_short_name = '';
      $state_short_name = '';
      foreach ($metas as $key => $value) {
        if( $key == 'latitude') {
          $lat = $value;
        } else if ( $key == 'longitude') {
          $lng = $value;
        } else if ($key == 'country') {
          $country = $value;
        } else if ($key == 'city') {
          $city = $value;
        } else if ($key == 'zipcode') {
          $zipcode = $value;
        } else if ($key == 'state') {
          $state = $value;
        } else if ($key == 'country_short_name') {
          $country_short_name = $value;
        } else if ($key == 'state_short_name') {
          $state_short_name = $value;
        }
      }
      return array(
        'lat' => $lat,
        'lng' => $lng,
        'state' => $state,
        'city' => $city,
        'country' => $country,
        'country_short_name' => $country_short_name,
        'state_short_name' => $state_short_name,
        'zipcode' => $zipcode,
      );
    }

    // saving lattitude & longitude into seperate table
    public function save_lat_lng($post_id) {

      if( isset( $_POST['post_type'] ) ) {
        $post_types = $_POST['post_type'];

        $grabbed_post_type = explode( ',', get_option('reactive_builder_post_type') );

        if( in_array( $post_types, $grabbed_post_type ) ) {

          $grabbed_post_type_will = get_option('reactive_builder_will_update_post');
          if ( $grabbed_post_type_will !== null ) {

            $updated_post_type_will = explode( ',', $grabbed_post_type_will );
            if( !in_array( $post_types, $updated_post_type_will ) ) {
              $updated_post_type_will[] = $post_types;
            }
            $all_post_types_will = implode( ',', array_filter( $updated_post_type_will ) );
          }
          if( isset( $all_post_types_will ) && !empty( $all_post_types_will ) )  {
            $post_types_will = $all_post_types_will;
          } else {
            $post_types_will = implode(',', $post_types );
          }

          update_option('reactive_builder_will_update_post', $post_types_will);
          update_option('reactive_builder_admin_notices', true);
        }

      }

      global $wpdb;
      if (isset($_POST['ID'])) {
        $check_link = $wpdb->get_row("SELECT * FROM {$wpdb->prefix}re_lat_lng WHERE id = '" . $_POST['ID'] . "'");
        if ($check_link != null) {
          if (isset($_POST['meta'])) {
            //$data = $this->get_lat_lng($_POST['meta']);
            $data = $this->get_from_post($_POST);
            if ( isset($data['lat']) && $data['lng'] )
              $wpdb->update( $wpdb->prefix.'re_lat_lng', array(
                'lat' => $data['lat'],
                'lng' => $data['lng'],
                'state' => $data['state'],
                'city' => $data['city'],
                'country' => $data['country'],
                'country_short_name' => $data['country_short_name'],
                'state_short_name' => $data['state_short_name'],
                'zipcode' => $data['zipcode'],
              ), array( 'id' => $_POST['ID'] ),
              array( '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s') );
          }
        } else {
          if ( isset($_POST['action']) && $_POST['action'] !== 'heartbeat') {
            $data = $this->get_from_post($_POST);
            if ( isset($data['lat']) && $data['lng'] )
              $wpdb->insert( $wpdb->prefix.'re_lat_lng',
              array(
                  'id' => $_POST['ID'],
                  'lat' => $data['lat'],
                  'lng' => $data['lng'],
                  'state' => $data['state'],
                  'city' => $data['city'],
                  'country' => $data['country'],
                  'country_short_name' => $data['country_short_name'],
                  'state_short_name' => $data['state_short_name'],
                  'zipcode' => $data['zipcode'],
              ),
              array( '%d', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s' ));
          }
        }
      }
    }

    public function re_custom_schedule_time( $schedules ) {
      $reactive_settings = get_option('reactive_settings', true);
      $time = 60; // 1 min
      if ( isset($reactive_settings['reactive_indexing_cron_time']) ) {
        $time = intval($reactive_settings['reactive_indexing_cron_time']) * 60;
      }
      $schedules['reactive_time'] = array(
        'interval'  => $time,
        'display'   => __( 'Every '.$time / 60 .' Minute', 'reactive' )
      );
      return $schedules;
    }

    public function re_indexing_item() {

      $reactive_settings = get_option('reactive_settings', true);

      if ( !isset( $reactive_settings['reactive_indexing_cron'] ) ) {
        $builder = new \Reactive\App\Re_Ajax_Builder();
        $will_update_posts = explode( ',' , get_option('reactive_builder_will_update_post') );
        if (!empty($will_update_posts)) {
          foreach ($will_update_posts as $post_type) {
            if ($post_type) {
              $result = $builder->build_settings($post_type);
              set_transient( 'reactive_builder-'.$post_type, $result, 0 );
            }
          }
          delete_option('reactive_builder_will_update_post', true);
          update_option('reactive_builder_admin_notices', false);
        }
      }

    }

}


/**
 * Main instance of Reactive.
 *
 * Returns the main instance of RE to prevent the need to use globals.
 *
 * @since  1.0
 * @return Redq_Reactive
 */
function RE() {
    return Redq_Reactive::instance();
}

// Global for backwards compatibility.
$GLOBALS['reactive'] = RE();

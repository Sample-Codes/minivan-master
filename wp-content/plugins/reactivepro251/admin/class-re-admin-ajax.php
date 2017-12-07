<?php

namespace Reactive\Admin;

class Re_Admin_Ajax {
  public function __construct() {
    $ajax_events = array(
     // 'get_all_posts' => true,
      'save_all_data' => true,
      'indexing_data' => true,
    );
    foreach ( $ajax_events as $ajax_event => $nopriv ) {
      add_action( 'wp_ajax_re_' . $ajax_event, array( $this, $ajax_event ) );
      if ( $nopriv ) {
        add_action( 'wp_ajax_nopriv_re_' . $ajax_event, array( $this , $ajax_event ) );
      }
    }
  }

  public function save_all_data() {
    $option_name = 'reactive_data';
    if( isset($_POST['allData']) && !empty($_POST['allData']) ){
      $allData = $_POST['allData'];
      update_option( $option_name, $allData);
      $data = new \Reactive\Admin\Re_Admin_Provider();
      $result = $data->get_post_data($allData);
      if( !isset($_POST['noreturn']) )
        echo json_encode($result);
    } else {
      delete_option( $option_name );
      echo json_encode(array());
    }
    wp_die();
  }

  public function indexing_data() {
    if ( !wp_verify_nonce( $_REQUEST['nonce'], "indexing_builder_nonce")) {
      exit("No naughty business please");
    }

    $builder = new \Reactive\App\Re_Ajax_Builder();

    $will_update_posts = explode( ',' , get_option('reactive_builder_will_update_post') );
    foreach ($will_update_posts as $post_type) {
      if ($post_type) {
        $result = $builder->build_settings($post_type);
        set_transient( 'reactive_builder-'.$post_type, $result, 0 );
      }
    }

    delete_option('reactive_builder_will_update_post', true);
    update_option('reactive_builder_admin_notices', false);

    echo json_encode(array('type' => 'success'));
    wp_die();
  }
}

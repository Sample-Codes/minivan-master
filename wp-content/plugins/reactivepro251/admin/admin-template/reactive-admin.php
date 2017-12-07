<?php 
  $reactive_data = get_option( 'reactive_data' );
  $result = array();
  if ($reactive_data) {
    $data = new \Reactive\Admin\Re_Admin_Provider();
    
    $result = $data->get_post_data($reactive_data);
    
  }
  wp_localize_script( 're-backend', 'REACTIVE_DATA', $result);
  
?>
<div id="reactive-admin"></div>

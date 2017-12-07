<?php


namespace Reactive\Admin;

class Re_Admin_Queue extends \WP_Background_Process {

  protected $action = 'reactive_index';

  protected function task( $post_type ) {
    $builder = new \Reactive\App\Re_Ajax_Builder();
    $result = $builder->build_settings($post_type);
    set_transient( 'reactive_builder-'.$post_type, $result, 0 );
    return false;
  }

  protected function complete() {
    parent::complete();
  }
}

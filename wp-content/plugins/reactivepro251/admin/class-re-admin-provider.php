<?php

namespace Reactive\Admin;

/**
*
*/
class Re_Admin_Provider {

  public function __construct() {

  }

  public function get_post_data( $allData ) {

      $all_posts = array();
      foreach ($allData as $data) {
        if (isset($data['post_type'])) {
          $post_type = $data['post_type'];
          $all_posts[] = array(
            'post_type' => $post_type,
            'selectedData' => isset($data['selectedData'] ) ? $data['selectedData'] : array(),
            'meta_keys' => $this->get_meta_keys($post_type),
          );
        }
      }

      return $all_posts;
  } // end of posts



  public function get_post_metadata($post_id)
  {
    $fields = get_post_custom($post_id);
    $temp = array();
    foreach ($fields as $metakey => $metavalues) {
      if(!empty($metavalues)){
        if( $metavalues[0] != null )
          $temp[$metakey] = $metavalues[0];
      }
    }
    return $temp;
  }


  /**
   * @param string [comma seperated]
   *
   */
  public function get_meta_keys( $post_types='post' ) {

    global $wpdb;
    $all_post_types = explode(",",$post_types);
    $generate = '';
    $all_keys = array();

    foreach ($all_post_types as $type ) {
      $query = $wpdb->prepare("SELECT DISTINCT pm.meta_key FROM {$wpdb->posts} post INNER JOIN
        {$wpdb->postmeta} pm ON post.ID = pm.post_id WHERE post.post_type='%s'",$type);
      $result = $wpdb->get_results($query , 'ARRAY_A');

      if( !empty($result) ){
        foreach ($result as $res) {
          //&& strpos( $res['meta_key'] ,'_') != 0
          if(!in_array($res['meta_key'], $all_keys) ){
            $all_keys[] = $res['meta_key'];
          }
        }
      }
    }

    return $all_keys;
  }






} // end of class

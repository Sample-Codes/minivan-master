<?php

namespace Reactive\Admin;



class Re_Generator_Metabox {

  protected $batch_process;
  public $post_type;
  public $meta_box_section;
  public $meta_fields = array();

  public function __construct( $post_type , $meta_box_section , $meta_fields ){

    $this->post_type = $post_type;
    $this->meta_box_section = $meta_box_section;
    $this->meta_fields = $meta_fields;

    add_action( 'add_meta_boxes', array( $this , 'create_meta_section') );
    add_action( 'save_post',  array( $this , 'save_meta_fields' ) );
    add_action( 'new_to_publish', array( $this , 'save_meta_fields' ) );
  }

  public function create_meta_section(){
       add_meta_box(
           md5($this->meta_box_section),        // $id
           $this->meta_box_section,           // $title
           array( $this , 'create_callback' ),  // $callback
           $this->post_type,                  // $page
           'normal',                      // $context
           'high'                           // $priority
       );
  }

  public function create_callback(){

      global $post;
      wp_nonce_field( basename( __FILE__ ), 're_metabox' );
      $this->show_meta_box($this->meta_fields , $post->ID );

  }


  //now we are saving the data
  function save_meta_fields( $post_id ) {

    // verify nonce
    if (!isset($_POST['re_metabox']) || !wp_verify_nonce($_POST['re_metabox'], basename(__FILE__)))
      return 'nonce not verified';

    // check wp_is_post_autosave
    if ( wp_is_post_autosave( $post_id ) )
      return 'autosave';

    //check post revision
    if ( wp_is_post_revision( $post_id ) )
      return 'revision';

    if( !current_user_can( 'edit_post', $post_id ) ) return;

    if( isset($_POST['re_metabox'] )  ) {
      $this->auto_update( $this->meta_fields , $_POST , $post_id );
    }

    // building from builder
    if (isset($_POST['rebuilder_post_type']) && !empty($_POST['rebuilder_post_type'])) {
      $post_type = $_POST['rebuilder_post_type'];
      $is_ajax = $_POST['rebuilder_async'] === 'ajax' ? 'true': 'false';
      $all_post_type = array();
      $grabbed_post_type = get_option('reactive_builder_post_type');
      if ( $grabbed_post_type !== null ) {
        $updated_post_type = explode( ',', $grabbed_post_type );
        if( !in_array( $post_type, $updated_post_type ) ) {
          $updated_post_type[] = $post_type;
        }
        $all_post_types = implode( ',', $updated_post_type );
      }

      if( isset( $all_post_types ) && !empty( $all_post_types ) )  {
        $post_types = $all_post_types;
      } else {
        $post_types = $post_type;
      }
      update_option('reactive_builder_post_type', $post_types);
      $builder = new \Reactive\App\Re_Ajax_Builder();
      $result = $builder->build_settings($post_type);
      set_transient( 'reactive_builder-'.$post_type, $result, 0 );
    }


  }


  public function auto_update( $meta_fields , $submit , $post_id ){

    if( isset($meta_fields) && !empty($meta_fields) && is_array($meta_fields) ){
      foreach ($meta_fields as $meta_items ) {
        if( is_array($meta_items) ){
          foreach ($meta_items as $type_name => $meta_type ) {
            if( is_array($meta_type) ){

              if( $type_name =='linear' || $type_name =='repeat' ){

                foreach ($meta_type as $meta_input ) {

                  if( isset($meta_input['id'] ) && !empty($meta_input['id'] )  ){
                    $meta_key = $meta_input['id'];
                    if( isset($submit[$meta_key] ) ){
                      update_post_meta( $post_id, $meta_key, $submit[$meta_key] );
                    }
                  }

                }

              }else{
                if( $type_name == 'repeatBundle' ){
                  $this->save_repeatBundle( $post_id ,  $type_name , $meta_type , $submit );
                }

                if( $type_name == 'tab' || $type_name == 'accordion'){

                  foreach ($meta_type as $meta_bundle ) {

                    if( isset( $meta_bundle['tab_fields'] ) && !empty( $meta_bundle['tab_fields'] ) ){

                      foreach ($meta_bundle['tab_fields'] as $fields) {
                        foreach ($fields as $field_type => $field) {
                          if( $field_type == 'repeatBundle'){
                            $this->save_repeatBundle( $post_id ,  $field_type , $field , $submit );
                          }else{
                            foreach ($field as $lrfield) {
                              if( isset($lrfield['id'] ) && !empty($lrfield['id'] )  ){
                                $meta_key = $lrfield['id'];
                                if( isset($submit[$meta_key] ) ){
                                  update_post_meta( $post_id, $meta_key, $submit[$meta_key] );
                                }
                              }
                            }
                          }
                        }
                      }
                    }
                  }
                }
              } // tab or accordion check
            }
          }
        } // inside meta fields if checking
      } // meta field travarsing foreach
    } // meta field array check
  } // end of save






  /**
  *  Printing meta fields
  **/
  public function show_meta_box( $meta_fields , $post_id  ){



    if( isset($meta_fields) && !empty($meta_fields) && is_array($meta_fields) ){

      foreach ($meta_fields as $meta_item_type  => $meta_items ) {



        if( is_array($meta_items) ){

          foreach ($meta_items as $type_name => $meta_type ) {

            if( is_array($meta_type) ){

              if( $type_name == 'linear' || $type_name == 'repeat' ){



                foreach ($meta_type as $meta_input ) {

                  if( isset($meta_input['id'] ) ){

                    $meta_key = $meta_input['id'];

                    $meta_type_call = '\Reactive\Admin\Generator\Metabox\Re_Meta_Generator_'.$meta_input['type'];

                    new $meta_type_call( $post_id , $type_name , $meta_input );

                  }

                }



              }else{



                if( isset($type_name) && !empty($type_name) ){


                  $call = '\Reactive\Admin\Generator\Metabox\Re_Meta_Generator_'.$type_name;

                  if( class_exists($call) ){
                    new  $call( $post_id , $type_name , $meta_type );
                  }

                }

              }
            }
          }
        } // inside meta fields if checking
      } // meta field travarsing foreach
    } // meta field array check

  }// end of show meta fields







  public function save_repeatBundle( $post_id , $type_name , $meta_type , $submit ){

    if( isset( $meta_type['bundle_id'] ) && !empty( $meta_type['bundle_id'] ) ){
      $bundle = array();
      $bundle_id = $meta_type['bundle_id'];
    }

    if( isset( $meta_type['fields'] ) && !empty( $meta_type['fields'] ) ){
      $fields = $meta_type['fields'];
    }else{
      $fields = array();
    }

    if( !empty($fields) ){
      foreach ($fields as $field) {
        $field_id = $field['id'];
        $flag = 0;
        if( isset( $submit[$field_id] ) ){
          foreach ($submit[$field_id] as $key => $value) {
            if($field['type'] == 'multiselect' || $field['type'] == 'checkbox'){
              if($flag == 0){
                $bundle[$key][$field_id] = $submit[$field_id];
                $flag = 1;
              }
            }else{
              $bundle[$key][$field_id] = $value;
            }
          }
        }
      }
    }

    update_post_meta($post_id , $bundle_id , $bundle );


  }




} // end of class

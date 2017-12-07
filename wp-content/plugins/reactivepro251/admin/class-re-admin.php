<?php
namespace Reactive\Admin;


/**
 * Class Re_Admin
 * @package Reactive\Admin
 */
class Re_Admin {
  /**
     * class constructor
     * @version 1.0.0
     * @since 1.0.0
     */
    public function __construct(){

    add_action( 'admin_menu', array( $this , 're_admin_menu')  );
    add_action( 'init', array( $this ,'reactive_builder_create' ) );
    add_action( 'admin_init', array( $this ,'reactive_builder_add_metabox' ) );
    add_action( 'add_meta_boxes', array( $this , 'reactive_builder_metabox' ) );
    add_filter( 'manage_edit-rebuilder_columns', array($this , 're_add_new_columns' ));
    add_action( 'manage_rebuilder_posts_custom_column' , array($this ,'re_custom_columns' ));
    add_filter( 'manage_edit-rebuilder_sortable_columns', array( $this ,'re_register_sortable_columns' ));
    add_action( 'create_term', array( $this, 're_term_update_check'),10, 3);
    add_action( 'edit_term', array( $this, 're_term_update_check'),10, 3);
    add_action( 'delete_term', array( $this, 're_term_update_check'),10, 3);
  }

  public function re_admin_menu() {

    add_menu_page( $page_title = 'Reactive', $menu_title = 'Reactive', $capability = 'manage_options', $menu_slug = 'reactive_admin', $function =  array( $this , 're_admin_main_menu_options'),$icon_url = 'dashicons-screenoptions' );

    add_submenu_page( $parent_slug = 'reactive_admin', $page_title = 'Settings', $menu_title='Settings', $capability = 'manage_options', $menu_slug = 'reactive_settings', $function = array($this , 're_admin_menu_settings') );
    add_submenu_page( $parent_slug = 'reactive_admin', $page_title = 'Addons', $menu_title='Addons', $capability = 'manage_options', $menu_slug = 'reactive_addons', $function = array($this , 're_admin_addons') );
  }
  
  /**
   *
   */
  public function re_admin_main_menu_options(){

    if ( !current_user_can( 'manage_options' ) )  {
      wp_die( __( 'You do not have sufficient permissions to access this page.', 'reactive' ) );
    }

        include_once 'admin-template/reactive-admin.php';
  }

  /**
   *
   */
  public function re_admin_menu_settings(){

    if ( !current_user_can( 'manage_options' ) )  {
      wp_die( __( 'You do not have sufficient permissions to access this page.', 'reactive' ) );
    }

        include_once 'admin-template/reactive-settings.php';
  }

  /**
   *
   */
  public function re_admin_addons(){

    if ( !current_user_can( 'manage_options' ) )  {
      wp_die( __( 'You do not have sufficient permissions to access this page.', 'reactive' ) );
    }

        include_once 'admin-template/reactive-addons.php';
  }

  // Register Custom Post Type
  public function reactive_builder_create() {

    $labels = array(
      'name'                  => _x( 'Reactive Builders', 'Post Type General Name', 'reactive' ),
      'singular_name'         => _x( 'rebuilder', 'Post Type Singular Name', 'reactive' ),
      'menu_name'             => __( 'Reactive Builder', 'reactive' ),
      'name_admin_bar'        => __( 'Reactive Builder', 'reactive' ),
      'archives'              => __( 'Builder Archives', 'reactive' ),
      'parent_item_colon'     => __( 'Parent Builder:', 'reactive' ),
      'all_items'             => __( 'All Items', 'reactive' ),
      'add_new_item'          => __( 'Add New Item', 'reactive' ),
      'add_new'               => __( 'Add New', 'reactive' ),
      'new_item'              => __( 'New Item', 'reactive' ),
      'edit_item'             => __( 'Edit Item', 'reactive' ),
      'update_item'           => __( 'Update Item', 'reactive' ),
      'view_item'             => __( 'View Item', 'reactive' ),
      'search_items'          => __( 'Search Item', 'reactive' ),
      'not_found'             => __( 'Not found', 'reactive' ),
      'not_found_in_trash'    => __( 'Not found in Trash', 'reactive' ),
      'featured_image'        => __( 'Featured Image', 'reactive' ),
      'set_featured_image'    => __( 'Set featured image', 'reactive' ),
      'remove_featured_image' => __( 'Remove featured image', 'reactive' ),
      'use_featured_image'    => __( 'Use as featured image', 'reactive' ),
      'insert_into_item'      => __( 'Insert into item', 'reactive' ),
      'uploaded_to_this_item' => __( 'Uploaded to this item', 'reactive' ),
      'items_list'            => __( 'Items list', 'reactive' ),
      'items_list_navigation' => __( 'Items list navigation', 'reactive' ),
      'filter_items_list'     => __( 'Filter items list', 'reactive' ),
    );
    $args = array(
      'label'                 => __( 'rebuilder', 'reactive' ),
      'description'           => __( 'Reactive Builder Post Type', 'reactive' ),
      'labels'                => $labels,
      'supports'              => array( 'title'),
      'hierarchical'          => false,
      'public'                => false,
      'show_ui'               => true,
      'show_in_menu'          => true,
      'menu_position'         => 99,
      'menu_icon'             => 'dashicons-screenoptions',
      'show_in_admin_bar'     => true,
      'show_in_nav_menus'     => true,
      'can_export'            => true,
      'has_archive'           => true,
      'exclude_from_search'   => false,
      'publicly_queryable'    => true,
      'capability_type'       => 'page',
    );
    register_post_type( 'rebuilder', $args );

  }

  public function reactive_builder_metabox()
  {
    add_meta_box( 'rebuilder_shortcode', 'Shortcode',
     array( $this , 're_render_metabox') ,
     'rebuilder', 'side', 'high' );
  }


  public function re_render_metabox( $post)
  {
    if( isset($post->ID) && isset($_GET['post']) ){
      echo '<h4> Please copy this shortcode </h4>';
      echo '<code> [reactive key="'.$post->ID.'"] </code>';
    }else{
       echo '<h4> Please create a random post </h4>';
    }

  }

  public function re_add_new_columns($columns)
  {
    $column_meta = array( 'rebuilder_column' => 'Shortcode' );
    $columns = array_slice( $columns, 0, 2, true ) + $column_meta + array_slice( $columns, 2, NULL, true );
    return $columns;
  }

  public function re_custom_columns($column)
  {
    global $post;
    echo '<code> [reactive key="'.$post->ID.'"] </code>';
  }

  public function re_register_sortable_columns($columns)
  {
    $columns['rebuilder_column'] = 'Shortcode';
    return $columns;
  }
  public function re_get_all_post_types(){
    $post_types = get_post_types( array('public'=> true ) , 'names', 'and' );

    $all_types = array();
    foreach ($post_types as $type) {
      $all_types[] = array(
        'key' => $type,
        'value' => $type,
      );
    }

    return $all_types;
  }
  public function reactive_builder_add_metabox() {
    $data = array(
      array(
        'section_name' => 'Build Index',
        'fields' => array(
          array(
            'linear' => array(
              array( 'type'=>'select','id' => 'rebuilder_post_type' , 'title' => 'Select a post type for your searching page' ,
                'options' => $this->re_get_all_post_types(),
                'default_value' => 'post', ),
            ),
          ),
          array(
            'linear' => array(
              array( 'type'=>'select','id' => 'rebuilder_async' , 'title' => 'How you want to load the data' ,
                'options' => array(
                  array('key' => 'ajax', 'value' => 'Ajax'),
                  array('key' => 'nonajax', 'value' => 'Non Ajax'),
                ),
                'default_value' => 'ajax', ),
            ),
          ),
        ),
      ),
    );

    
    /**
     *
     * Add Additional Meta Fields in Admin Panel For Reactive Shortcode
     * @return array();        
     */
    $data = apply_filters('re_update_meta_fields', $data);

    new \Reactive\Admin\Re_Generator_Metabox( $post_type = "rebuilder" , $meta_box_section = $data[0]['section_name'] , $meta_fields = $data[0]['fields'] );

  }

  public function re_term_update_check( $term_id, $term_tax_id, $taxonomy ) {

    $grabbed_post_type = explode( ',', get_option('reactive_builder_post_type') );

    $args=array(
      'name' => $taxonomy,
    );
    $output = 'objects'; // or names
    $taxonomies = get_taxonomies( $args, $output );

    $post_types = $taxonomies[$taxonomy]->object_type;

    if( in_array( implode(',', $post_types ), $grabbed_post_type ) ) {

      $grabbed_post_type_will = get_option('reactive_builder_will_update_post');
      if ( $grabbed_post_type_will !== null ) {

        $updated_post_type_will = explode( ',', $grabbed_post_type_will );
        if( !in_array( implode(',', $post_types ), $updated_post_type_will ) ) {
          $updated_post_type_will[] = implode(',', $post_types );
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

}

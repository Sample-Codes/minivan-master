<?php

namespace Reactive\App;

/**
*
*/
class Re_Data_Provider
{

  public function get_helper_data( $post_types ){
    $data = array();

    /**
     *
     * Get Post-type to Show Posts in Grid Block
     * @return string;
     */
    $post_types = apply_filters('re_get_post_types_for_taxonomy', $post_types);

    $data['taxonomies'] = $this->get_all_taxonomies( $post_types );

    if( in_array( 'post_format', $data['taxonomies'] ) ) {
      $data['formats'] = $this->get_post_formats();
    } else {
      $data['formats'] = array('standard');
    }

    $data['terms'] = $this->get_terms_on_taxonomies( $data['taxonomies'] );
    $data['metakeys'] = $this->get_meta_keys( $post_types );

    /**
     * Check if WooCommerce is active
     **/
    if (
      in_array(
        'woocommerce/woocommerce.php',
        apply_filters( 'active_plugins', get_option( 'active_plugins' ) )
      )
    ) {
      $data['woocommerce'] = array(
        'symbol' => get_woocommerce_currency_symbol(),
        'currency' => get_woocommerce_currency(),
        'thousand' => wc_get_price_thousand_separator(),
        'decimal' => wc_get_price_decimal_separator(),
        'number' => wc_get_price_decimals(),
        'position' => get_option('woocommerce_currency_pos'),
      );
    }
    return $data;
  }

  /**
   * @return array post_format
   */
  public function get_post_formats()
  {
    if ( current_theme_supports( 'post-formats' ) ) {
      $post_formats = get_theme_support( 'post-formats' );
      $get_formats = array('standard');
      if ( is_array( $post_formats[0] ) ) {
        foreach ($post_formats[0] as $pf) {
          $get_formats[] = $pf;
        }
      }
      return $get_formats;
    }
  }

  /**
   *
   * @param array [ taxonomies ]
   *
   * @return array()
   */
  public function get_terms_on_taxonomies( $taxonomies )
  {
    if( !empty($taxonomies) ){
      $all_data = array();
      foreach ($taxonomies as $taxonomy) {

        $categories = get_terms( $taxonomy , array('hide_empty' => false));
        $categoryHierarchy = array();
        $linar_order = array();
        $this->sort_terms_hierarchicaly($categories, $categoryHierarchy);
        $this->grab_in_linear( $categoryHierarchy, $taxonomy , $linar_order );

        $all_data[$taxonomy] = array(
          'linear' => $linar_order,
          'complex' => $categoryHierarchy
        );
      }

      return $all_data;
    }
  }


  function grab_in_linear( $cats , $taxonomy, &$result  ){
    if( is_array($cats) && count($cats) > 0 ){
      foreach ($cats as $cat) {
        $flag = false;
        foreach ($result as $term) {
          if($term['key'] == $cat->term_id){
            $flag = true;
          }
        }
        if( $flag == false  ){
          $level = count(get_ancestors( $cat->term_id, $taxonomy ) );
          $dash = "";
          for($i = 0; $i < $level; $i++  )
            $dash .= "  ";
          $slug = apply_filters( 'editable_slug', $cat->slug );
          $result[] = array(
            'key'  => $cat->term_id,
            'value' => $dash.$cat->name,
            'slug' => esc_attr($slug),
            'count' => $cat->count,
            'parent' => $cat->parent,
            'description' => $cat->description,
            'permalink' => get_category_link($cat->term_id),
            'term_meta' => $this->get_all_term_meta($cat->term_id),
          );
        }
        if( is_array( $cat->children ) && count($cat->children) > 0 ){
          $this->grab_in_linear($cat->children, $taxonomy , $result  );
        }
      }
    }
  }

public function get_all_term_meta($term_id)
{
  $result = array();
  $term_meta = array();
  /**
   * Check if WooCommerce is active
   **/
  if (
    in_array(
      'woocommerce/woocommerce.php',
      apply_filters( 'active_plugins', get_option( 'active_plugins' ) )
    )
  ) {
      $thumbnail_id = get_woocommerce_term_meta( $term_id, 'thumbnail_id', true );
      if($thumbnail_id){
      $image_full_url = wp_get_attachment_image_src( $thumbnail_id);
      $image_big_url = wp_get_attachment_image_src( $thumbnail_id, array(600, 400));
      $image_medium_url = wp_get_attachment_image_src( $thumbnail_id, array(300, 152));
      $image_small_url = wp_get_attachment_image_src( $thumbnail_id, array(64, 64));
      if(isset($image_full_url[0]) ){
        $term_meta[] = array(
          'thumbnail_image' => array(
            'image_full_url' => $image_full_url[0],
            'image_big_url' => $image_big_url[0],
            'image_medium_url' => $image_medium_url[0],
            'image_small_url' => $image_small_url[0]),
        );
      }
    return $term_meta;
    }
  }
  $result = get_term_meta($term_id);
  foreach ($result as $key => $value) {
      if(isset($value[0])){
        $image_full_url = wp_get_attachment_image_src($value[0]);
        $image_big_url = wp_get_attachment_image_src($value[0], array(600, 400));
        $image_medium_url = wp_get_attachment_image_src($value[0], array(300, 152));
        $image_small_url = wp_get_attachment_image_src($value[0], array(64, 64));
      }
    if(isset($image_full_url[0])){
      $term_meta[] = array(
        $key => array(
          'image_full_url' => $image_full_url[0],
          'image_big_url' => $image_big_url[0],
          'image_medium_url' => $image_medium_url[0],
          'image_small_url' => $image_small_url[0]),
      );
    }
    else{
      if (isset($value[0]))
        $term_meta[] = array(
          $key => array($value[0]),
        );
    }
  }
return $term_meta;
}

public function sort_terms_hierarchicaly(Array &$cats, Array &$into, $parentId = 0)
{
    foreach ($cats as $i => $cat) {
        if ($cat->parent == $parentId) {
            $into[] = $cat;
            unset($cats[$i]);
        }
    }
    foreach ($into as $topCat) {
        $topCat->children = array();
        $this->sort_terms_hierarchicaly($cats, $topCat->children, $topCat->term_id);
    }
}




  /**
   *
   * @param string [comma seperated]
   * @param integer limit
   * @param array filter
   * @param array fields
   *
   * @return array()
   */

  public function get_filtered_posts( $post_types = 'post', $limit='10' , $tax_query = array() , $meta_query = array() , $page_num = 1, $sort_data = array() , $async = false, $text_search = '' )
  {

    $all_posts = array();

    /**
     *
     * Get Post-type to Show Posts in Grid Block
     * @return string;
     */
    $post_types = apply_filters('re_post_type_for_posts', $post_types);


    if ($async) {
      $basic_query = array(
        'posts_per_page' => $limit,
        'post_type' => $post_types,
        'post_status' => 'publish',
        'paged' => $page_num,
      );
      $sort_array = array();
      if (!empty($sort_data)) {
        if ( isset($sort_data['sortAttr']) ){
          if ($sort_data['sortAttr'] === 'post_date' || $sort_data['sortAttr'] === 'comment_count' || $sort_data['sortAttr'] === 'post_title' ) {
            $sort_array = array(
              'orderby'   => $sort_data['sortAttr'],
              'order' => isset($sort_data['sortBy']) ? $sort_data['sortBy'] : 'DESC'
            );
          } else {
            $sort_array = array(
              'orderby'   => 'meta_value_num',
              'meta_key'  => isset($sort_data['sortAttr']) ? $sort_data['sortAttr'] : null,
              'order' => isset($sort_data['sortBy']) ? $sort_data['sortBy'] : 'DESC'
            );
          }
        }
      }

      if($text_search !== '') {
        $basic_query = array_merge($basic_query, array( 's' => $text_search));
      }

      if (!empty($tax_query)) {
        $basic_query = array_merge($basic_query, array('tax_query' => $tax_query) );
      }
      if (!empty($meta_query)) {
        $basic_query = array_merge($basic_query, array('meta_query' => $meta_query) );
      }

      $basic_query = array_merge($basic_query, $sort_array);
      $query = new \WP_Query($basic_query);

    } else {
      $query = new \WP_Query(array(
        'posts_per_page' => -1,
        'post_status'  => 'publish',
        'post_type' => $post_types,
      ));
    }


    $total_post = $query->found_posts;
    $posts = $query->posts;

    /**
     *
     * Get Post-types to Retrieve The Taxonomies of Their Respective Post-types
     * @return string;
     */
    $post_types = apply_filters('re_get_post_types_for_taxonomy', $post_types);

    $taxonomies = $this->get_all_taxonomies( $post_types );
    $allowed_key = $this->get_meta_keys( $post_types );

    foreach ($posts as &$post) {
      $post->post_author_name = get_the_author_meta('display_name', $post->post_author);
      $post_terms = $this->get_post_terms( $post->ID , $taxonomies );
      /**
       *
       * Get Post Terms For Preivew Data
       * @return array();
       */
      $post->terms = apply_filters('re_preview_post_terms', $post_terms, $post->ID , $taxonomies );
      $post_meta = $this->get_post_metadata( $post->ID, $post_types );
      /**
       *
       * Get Post Metas For Preivew Data
       * @return array();
       */
      $post->meta = apply_filters('re_preview_post_meta', $post_meta, $post->ID, $post_types, $allowed_key );
      $post->thumb_url = $this->get_post_image( $post->ID );
      $post->thumb_alt = $this->get_post_image_alt_text( $post->ID );
      $post->gallery_image_urls = $this->get_post_gallery( $post );
      $post->post_link = $this->get_post_link( $post->ID );
      $post->wow = $this->get_shortcode_content( $post );


      if( isset( $post->terms['post_format'] ) && !empty( $post->terms['post_format'] ) ) {
        $format = get_post_format( $post->ID );
        if( !empty( $format ) ) {
          $post->post_format = $format;
        } else {
          $post->post_format = 'standard';
        }
      } else {
        $post->post_format = 'standard';
      }

    }

    /**
     *
     * Add Any Additional Data in Posts Array For Preview Data
     * @return array();
     */
    $posts = apply_filters('re_preview_posts', $posts );

    wp_reset_postdata();
    $all_posts = array(
      'data' => $posts,
      'page_num' => $page_num,
      'total_post' => $total_post,
      'limit' => $limit,
    );

    return $all_posts;
  }

  public function get_shortcode_content($content_post)
  {
    $content = $content_post->post_content;
    $content = apply_filters('the_content', $content);
    $content = str_replace(']]>', ']]&gt;', $content);
    return do_shortcode($content);
  }

  public function get_post_image($post_id)
  {
    if (has_post_thumbnail( $post_id ) ){
      $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'full' );

      return $image[0];
    }
  }

  public function get_post_image_alt_text($post_id)
  {
    if (has_post_thumbnail( $post_id ) ){
      $image_id = get_post_thumbnail_id( $post_id );
      $alt_text = get_post_meta($image_id , '_wp_attachment_image_alt', true);
      return $alt_text;
    }
  }

  public function get_post_gallery($content_post)
  {
    $content = $content_post->post_content;
    $gallery_ids = array();
    $temp = array();
    if (strpos($content, 'gallery ids') !== false) {
      if(preg_match('/"([^"]+)"/', $content, $attachment_ids)){
        $gallery_ids = $attachment_ids[1];
      }
      $gallery_ids = explode(',', $gallery_ids);
    }
    foreach( $gallery_ids as $gallery_id ) {
      $image_link = wp_get_attachment_url( $gallery_id );
      $temp[] = $image_link;
    }
    return $temp;
  }

  public function get_post_link($post_id)
  {
    return get_the_permalink( $post_id );
  }

  public function get_post_metadata($post_id, $post_types = 'post')
  {
    $fields = get_post_custom($post_id);
    $temp = array();
    $allowed_key = $this->get_meta_keys( $post_types );

    foreach ($fields as $metakey => $metavalues) {

      if( in_array( $metakey, $allowed_key ) ) {
        if(!empty($metavalues)){
          if( $metavalues[0] != null ) {
            // woo commerce
            $temp[$metakey] = $metavalues[0];
            if (
              in_array(
                'woocommerce/woocommerce.php',
                apply_filters( 'active_plugins', get_option( 'active_plugins' ) )
              )
            ) {
              if ($metakey === '_product_image_gallery'){
                $attachment_ids = explode(',', $metavalues[0]);
                foreach( $attachment_ids as $attachment_id ) {
                  $image_link = wp_get_attachment_url( $attachment_id );
                  $temp['_product_image_gallery_links'][] = $image_link;
                }
              }
            }
          }
        }
      }

    }
    return $temp;
  }

  public function get_post_terms( $post_id, $taxonomies )
  {
    $temp = array();
    foreach ($taxonomies as $taxonomy) {
      $terms = wp_get_post_terms( $post_id, $taxonomy );
      $temp[$taxonomy] = array();
      foreach ($terms as $term) {
        $slug = apply_filters( 'editable_slug', $term->slug );
        $temp[$taxonomy][] = esc_attr($slug);
      }
    }
    return $temp;
  }

  /**
   *
   * @param string [comma seperated]
   *
   */
  public function get_all_taxonomies( $post_types='post' )
  {
    $all_post_types = explode(",",$post_types);


    $taxonomies = array();
    foreach ($all_post_types as $type ) {
      $taxonomies = array_merge( $taxonomies, get_object_taxonomies( $type) ) ;
    }


    return $taxonomies;
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
    $reactive_data = get_option('reactive_data', true);
    $restrict_array = array();

    foreach ($all_post_types as $type ) {
      $selected_data = $this->search($reactive_data, 'post_type', $type);
      if( !empty( $selected_data ) ) {
        if( isset( $selected_data['selectedData'] ) ) {
          $restrict_array = $this->array_values_recursive($selected_data['selectedData'], 'type', 'meta');
        }

      }

      $query = $wpdb->prepare("SELECT DISTINCT pm.meta_key FROM {$wpdb->posts} post INNER JOIN
        {$wpdb->postmeta} pm ON post.ID = pm.post_id WHERE post.post_type='%s'",$type);
      $result = $wpdb->get_results($query , 'ARRAY_A');

      if( !empty($result) ){
        foreach ($result as $res) {
          //&& strpos( $res['meta_key'] ,'_') != 0
          if( !in_array( $res['meta_key'], $restrict_array ) && !in_array($res['meta_key'], $all_keys ) ){
            $all_keys[] = $res['meta_key'];
          }
        }
      }
    }
    return $all_keys;
  }

  private function search($array, $key, $value) {
    $results = array();

    if (is_array($array))
    {
        if (isset($array[$key]) && $array[$key] == $value)
            $results = $array;

        foreach ($array as $subarray)
            $results = array_merge($results, $this->search($subarray, $key, $value));
    }

    return $results;
  }
  private function array_values_recursive($array, $key, $value) {
    $results = array();

    if (is_array($array))
    {
      if (isset($array[$key]) && $array[$key] == $value)
          $results[] = $array['key'];

      foreach ($array as $subarray)
          $results = array_merge($results, $this->array_values_recursive($subarray, $key, $value));
    }

    return $results;
  }

  /**
   * Data split saving , helper funciton
   *
   * @param integer post_id
   * @param array  builder data.
   *
   * return void
   */
  public function save_splited_data( $post_id , $data ){

  }


  /**
   * @param string [comma seperated]
   *
   */
  public function get_preview_data( $post_types){
    $data =  array(
      'data' => get_posts(
        array(
          'posts_per_page' => -1,
          'post_type' => $post_types
        )
      ),
      'page_num' => 1,
      'limit' => 10
    );
    return $data;
  }


  /**
   * @param array
   *
   */

  public function get_filtered_data( $attr = array() ){
    extract( shortcode_atts(
      array(
        'postTypes' => 'post',
        'numberOfPosts' => '10',
        'tax_query' => array(),
        'meta_query' => array(),
        'pageNumber'=> '1',
        'sort_data' => null,
        'async' => false,
        'text_search' => '',
      ), $attr )
    );
    return $this->get_filtered_posts($postTypes, $numberOfPosts, $tax_query, $meta_query, $pageNumber, $sort_data, $async, $text_search);
  }



  /**
   * Get distinct the meta values
   *
   * @param  string $key , string $type , string $status
   * @return object
   * @verison 1.0.0
   * @since 1.0.0
   */
  public function get_meta_values( $key = '', $post_types = 'post', $status = 'publish' ) {
    global $wpdb;
    $build = array();
    $allowed_key = $this->get_meta_keys( $post_types );

    if( empty( $key ) )
        return;
      $result = $wpdb->get_col( $wpdb->prepare( "
                SELECT DISTINCT pm.meta_value FROM {$wpdb->postmeta} pm
                LEFT JOIN {$wpdb->posts} p ON p.ID = pm.post_id
                WHERE pm.meta_key = '%s'
                AND pm.meta_value != ''
                AND p.post_status = '%s'
            ", $key, $status ) );
      if( is_array($result) ){
        foreach ($result as $index => $meta) {
          $build[] = array(
            'key' => $index,
            'slug' => $meta,
            'value' => $meta,
          );
        }
      }
    return $build;
  }

  public function get_term_by_slug($term, $output = OBJECT, $filter = 'raw') {
    global $wpdb;
    $null = null;

    if ( empty($term) ) {
        $error = new \WP_Error('invalid_term', __('Empty Term'));
        return $error;
    }
    $grabbed = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM $wpdb->terms AS t INNER JOIN $wpdb->term_taxonomy AS tt ON t.term_id=tt.term_id WHERE t.slug = %s LIMIT 1", $term) );

    if (isset($grabbed->term_id) ) {
      $taxonomy = $grabbed->taxonomy;
      return get_term($grabbed->term_id, $taxonomy, $output, $filter);
    }
  }
}

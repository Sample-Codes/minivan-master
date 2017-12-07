<?php

/**
* RedQ_Request_For_A_Quote
*/
class RedQ_Request_For_A_Quote {
  
  public function __construct() {
    
    add_action( 'wp_ajax_redq_request_for_a_quote', array( $this, 'request_for_a_quote' ) );
    add_action( 'wp_ajax_nopriv_redq_request_for_a_quote', array( $this, 'request_for_a_quote' ) );

    if( self::is_quote_menu_eanbled() ) {

      add_filter( 'query_vars', array( $this, 'request_quote_query_vars'), 0 );
      
      add_filter( 'woocommerce_account_menu_items', array($this, 'request_quote_my_account_menu_items'), 10, 1 );
      add_action( 'woocommerce_account_request-quote_endpoint', array($this, 'request_quote_endpoint_content' ) );
      add_action( 'woocommerce_account_view-quote_endpoint', array($this, 'view_quote_endpoint_content' ) );
    }

    add_action( 'save_post', array($this, 'redq_save_post'), 10, 2 );

    // add_filter( 'gettext', array($this, 'redq_change_publish_button' ), 10, 2 );

    add_action( 'publish_post', array( $this, 'check_user_publish' ), 10, 2 );

    add_filter( 'add_menu_classes', array($this, 'bubble_count_number'));

  }

  // Calculate and display count number
  public function bubble_count_number( $menu ) {
    global $wpdb; 
    $query = "SELECT COUNT(*) FROM $wpdb->posts WHERE post_type = 'request_quote' AND post_status = 'quote-pending'"; 
    $count = $wpdb->get_var($query);
    
    $check_menu_str = 'edit.php?post_type=request_quote';

    // loop through $menu items, find match, add indicator
    foreach( $menu as $menu_key => $menu_data ) {
        if( $check_menu_str != $menu_data[2] )
            continue;
        $menu[$menu_key][0] .= " <span class='update-plugins count-$count'><span class='plugin-count'>" . number_format_i18n($count) . '</span></span>';
    }

    return $menu;
  }

  public static function request_quote_endpoints() {
    add_rewrite_endpoint( 'request-quote', EP_ROOT | EP_PAGES );
    add_rewrite_endpoint( 'view-quote', EP_ALL );
  }

  public static function is_quote_menu_eanbled() {

    $quote_menu = get_option('redq_rental_global_show_quote_menu', true);
    if( $quote_menu === 'yes' )
      return true;

    return false;
  }

  function redq_change_publish_button( $translation, $text ) {
    if ( 'request_quote' == get_post_type()) {
      if ( $text == 'Publish' )
        return 'Update Quote';

      if ( $text == 'Update' )
        return 'Update Quote';  
    }
    
    return $translation;
  }
  
  public function redq_save_post($post_id, $post) {
    
    if( isset($_POST['previous_post_status']) && ( $_POST['previous_post_status'] !== $post->post_status ) ) {
      // send email
    
      $form_data = json_decode( get_post_meta($post_id, 'order_quote_meta', true), true );
      
      
    
      $from_name = '';
      $from_email = '';
      $from_phone = '';
      $product_id = '';
      $to_email = '';
      $to_author_id = '';

      
      $message_from_sender_html = '';
      
      foreach ($form_data as $key => $meta) {
        /**
         * Get the post author_id, author_email, prodct_id
         */
        if( isset( $meta['name'] ) && $meta['name'] === 'add-to-cart' ) {
          $product_id = $meta['value'];
          $to_author_id = get_post_field( 'post_author', $product_id );
          $to_email = get_the_author_meta( 'user_email', $to_author_id);
        }

        /**
         * Get the customer name, email, phone, message
         */
        else if( isset( $meta['forms'] ) ) {
          $forms = $meta['forms'];
          foreach ($forms as $k => $v) {
            $message_from_sender_html .= "<p>".$k . " : " . $v . "</p>";
            if($k === 'email') {
              $from_email = $v;  
            }
            if($k === 'name') {
              $from_name = $v;  
            }
            
          }
        }
      }

      switch ($post->post_status) {
        case 'quote-accepted':
          // send email to the customer
      
          $prodct_id = get_post_meta( $post->ID, 'add-to-cart', true );
          $from_author_id = get_post_field( 'post_author', $prodct_id );
          $from_email = get_the_author_meta( 'user_email', $from_author_id);
          $from_name = get_the_author_meta( 'user_nicename', $from_author_id);

          // To info
          $to_author_id = get_post_field( 'post_author', $post->ID );
          $to_email = get_the_author_meta( 'user_email', $to_author_id);

          $quote_id = $post->ID;

          $subject = "Congratulations! Your quote request has been accepted";
          // $reply_message = $_POST['add-quote-message'];
          $data_object = array(
            // 'reply_message' => $reply_message,
            'quote_id'         => $quote_id,
          );

          // Send the mail to the customer
          $email = new RnB_Email();
          $email->quote_accepted_notify_customer( $to_email, $subject, $from_email, $from_name, $data_object );
          break;
        
        default:
          // send email to the customer
      
          $prodct_id = get_post_meta( $post->ID, 'add-to-cart', true );
          $from_author_id = get_post_field( 'post_author', $prodct_id );
          $from_email = get_the_author_meta( 'user_email', $from_author_id);
          $from_name = get_the_author_meta( 'user_nicename', $from_author_id);

          // To info
          $to_author_id = get_post_field( 'post_author', $post->ID );
          $to_email = get_the_author_meta( 'user_email', $to_author_id);

          $quote_id = $post->ID;

          $subject = "Your quote request status has been updated";
          // $reply_message = $_POST['add-quote-message'];
          $data_object = array(
            // 'reply_message' => $reply_message,
            'quote_id'         => $quote_id,
          );

          // Send the mail to the customer
          $email = new RnB_Email();
          $email->quote_status_update_notify_customer( $to_email, $subject, $from_email, $from_name, $data_object );
          break;
      }

      // if( $post->post_status === 'quote-accepted') {
      //   $message_sender = "<p>Congratulations ".$from_name.", Your quote request for <a href='".get_the_permalink($product_id)."'>".get_the_title($product_id)."</a> has beed <strong>accepted</strong>. You can now book your order. :)</p>";

      //   $quote_url = site_url('my-account/view-quote/'.$post->ID);
      //   $message_sender .= 'Click the book now link. <a href="'.esc_url($quote_url).'">Book Now</a>,';
      //   $message_sender .= ' and the price is set to <strong>'.woocommerce_price(get_post_meta($post->ID, '_quote_price', true)).'</strong><br />';
      // } else {
      //   $message_sender = "<p>Hello ".$from_name.", Status of your quote request for <a href='".get_the_permalink($product_id)."'>".get_the_title($product_id)."</a> has beed changed. Your request is currently on <strong>".ucfirst( redq_get_quote_status_name( $post->post_status ) )."</strong>.</p>";
      // }
      

      // $message_sender .= "<p>Here is your order details.</p>";
      // foreach ($form_data as $key => $meta) {

      //   if( isset( $meta['name'] ) ) {
      //     switch ($meta['name']) {
      //       case 'add-to-cart':
      //         break;

      //       case 'currency-symbol':
      //         break;
            
      //       default:
              
      //         $message_sender .= "<p>".$meta['name'] . " : " . $meta['value'] . "</p>";
              
      //         break;
      //     }
      //   }
        
      // }

      // if( $post->post_status === 'quote-accepted') {
      //   $subject_sender = get_bloginfo('name') . ': ' . "Your quote request has been accepted";
      // } else {
      //   $subject_sender = get_bloginfo('name') . ': ' . "Your quote request status has been changed";
      // }
      

      // $headers  = "MIME-Version: 1.0" . "\r\n";
      // $headers .= "Content-type: text/html; charset=".get_bloginfo('charset')."" . "\r\n";
      
      
      // $headers_receiver = $headers."From: ".get_the_author_meta( 'user_nicename', $to_author_id)." <".$to_email.">" . "\r\n";

      
      // $message_sender .= $message_from_sender_html;
      
      // $sender = wp_mail( $from_email, $subject_sender, $message_sender, $headers_receiver );
      
    }

    if ( isset( $_POST['quote_price'] ) ) {
      update_post_meta($post_id, '_quote_price', $_POST['quote_price']);

    }

    if( isset( $_POST['add-quote-message'] ) && !empty( $_POST['add-quote-message'] )) {
      
      global $current_user;

      $time = current_time('mysql');

      $data = array(
        'comment_post_ID' => $post->ID,
        'comment_author' => $current_user->user_nicename,
        'comment_author_email' => $current_user->user_email,
        'comment_author_url' => $current_user->user_url,
        'comment_content' => $_POST['add-quote-message'],
        'comment_type' => 'quote_message',
        'comment_parent' => 0,
        'user_id' => $current_user->ID,
        'comment_author_IP' => self::get_the_user_ip(),
        'comment_agent' => $_SERVER['HTTP_USER_AGENT'],
        'comment_date' => $time,
        'comment_approved' => 1,
      );

      $comment_id = wp_insert_comment($data);

      
      

      // $headers  = "MIME-Version: 1.0" . "\r\n";
      // $headers .= "Content-type: text/html; charset=".get_bloginfo('charset')."" . "\r\n";
      // $headers_owner = $headers."From: ".get_the_author_meta( 'user_nicename', $from_author_id)." <".$from_email.">" . "\r\n";

      // $subject = get_bloginfo('name') . ': ' . "New message to your quote request";

      
      // $message_body = $_POST['add-quote-message'];
      
      // $quote_url = site_url('my-account/view-quote/'.$post->ID);
      // $message_body .= '<br /><br /><br /><a href="'.esc_url( $quote_url ).'">'.esc_html__("View Quote", "redq-rental").'</a>';

      // send email to the customer
      
      // $prodct_id = get_post_meta( $quote_id, 'add-to-cart', true );
      // $to_author_id = get_post_field( 'post_author', $prodct_id );
      // $to_email = get_the_author_meta( 'user_email', $to_author_id);

      // // FROM info
      // $from_author_id = get_post_field( 'post_author', $quote_id );
      // $from_email = get_the_author_meta( 'user_email', $from_author_id);
      // $from_name = get_the_author_meta( 'user_nicename', $from_author_id);

      // send email to the customer
      
      $prodct_id = get_post_meta( $post->ID, 'add-to-cart', true );
      $from_author_id = get_post_field( 'post_author', $prodct_id );
      $from_email = get_the_author_meta( 'user_email', $from_author_id);
      $from_name = get_the_author_meta( 'user_nicename', $from_author_id);

      // To info
      $to_author_id = get_post_field( 'post_author', $post->ID );
      $to_email = get_the_author_meta( 'user_email', $to_author_id);

      $quote_id = $post->ID;

      $subject = "New reply for your quote request";
      $reply_message = $_POST['add-quote-message'];
      $data_object = array(
        'reply_message' => $reply_message,
        'quote_id'         => $quote_id,
      );

      // Send the mail to the customer
      $email = new RnB_Email();
      $email->owner_reply_message( $to_email, $subject, $from_email, $from_name, $data_object );

      // Send the mail to the customer
      // $send_email = wp_mail( $to_email, $subject, $message_body, $headers_owner );

    }

  }

  public static function get_the_user_ip() {
    if ( ! empty( $_SERVER['HTTP_CLIENT_IP'] ) ) {
      //check ip from share internet
      $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif ( ! empty( $_SERVER['HTTP_X_FORWARDED_FOR'] ) ) {
      //to check ip is pass from proxy
      $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
      $ip = $_SERVER['REMOTE_ADDR'];
    }
    return apply_filters( 'redq_rental_get_ip', $ip );
  }


  function view_quote_endpoint_content( $quote_id ) {
    wc_get_template( 'myaccount/view-quote.php', array(
      'quote_id'  => $quote_id
    ), $template_path = '', REDQ_PACKAGE_TEMPLATE_PATH );
  }

  function request_quote_endpoint_content() {
    _log('no');
    wc_get_template( 'myaccount/request-quote.php', $args = array(), $template_path = '', REDQ_PACKAGE_TEMPLATE_PATH);
  }

  function request_quote_query_vars( $vars ) {
    
    $vars[] = 'request-quote';
    $vars[] = 'view-quote';

    return $vars;
  }

  function request_quote_my_account_menu_items( $items ) {
    $items = array(
    'dashboard'       => __( 'Dashboard', 'redq-rental' ),
    'orders'          => __( 'Orders', 'redq-rental' ),
    'downloads'       => __( 'Downloads', 'redq-rental' ),
    'edit-address'    => __( 'Addresses', 'redq-rental' ),
    'payment-methods' => __( 'Payment Methods', 'redq-rental' ),
    'edit-account'    => __( 'Account Details', 'redq-rental' ),
    'request-quote'   => __( 'Request Quote', 'redq-rental' ),
    'customer-logout' => __( 'Logout', 'redq-rental' ),
  );


    return $items;
  }


  public function request_for_a_quote() {
    
    $posted = $_POST;
    $form_data = $posted['form_data'];
    $product_id = $posted['product_id'];

    //_log($form_data);
    
    if( !is_user_logged_in() ) {

      foreach ($form_data as $key => $meta) {
        // if( isset( $meta['name']) ) {
        //   update_post_meta($post_id, $meta['name'], $meta['value']);  
        // }

        if( isset( $meta['forms']) ) {
          foreach ($meta['forms'] as $k => $v) {
            // clean the user name
            if($k === 'quote_username') {
              $user_name = $v;
              unset( $form_data[$key]['forms'][$k] );
            }
            // clean the user password
            if($k === 'quote_password') {
              $user_password = $v;
              unset( $form_data[$key]['forms'][$k] );
            }

            if($k === 'quote_email') {
              $user_email = $v;
            }

            if($k === 'quote_first_name') {
              $user_first_name = $v;
            }
            if($k === 'quote_last_name') {
              $user_last_name = $v;
            }

            if($k === 'quote_phone') {
              $user_telephone = $v;
            }
          }
        }
      }

      $userdata = array(
        'user_login'  => $user_name,
        'user_email'  => $user_email,
        'first_name'  => $user_first_name,
        'last_name'   => $user_last_name,
        'user_pass'   => $user_password,
        'role'        => 'customer',
      );

      $new_user_id = wp_insert_user( $userdata ) ;

      if ( is_wp_error( $new_user_id ) ) {

        echo json_encode( array( 'message' => $new_user_id->get_error_message(), 'status_code' => 400 ) );
        wp_die();
      }
      if ( !is_wp_error( $new_user_id ) ) {
        wp_set_auth_cookie( $new_user_id );
        update_user_meta( $new_user_id, 'billing_first_name', $user_first_name );
        update_user_meta( $new_user_id, 'billing_last_name', $user_last_name );
        update_user_meta( $new_user_id, 'billing_phone', $user_telephone );
        update_user_meta( $new_user_id, 'billing_email', $user_email );
      }

      

      
    }
    // Create post object
    if( !isset( $new_user_id ) ) {
      $new_user_id = get_current_user_id();
    }
    $my_post = array(
      'post_title'    => date( 'Y-m-d H:i:s', current_time( 'timestamp', 1 ) ),
      'post_status'   => 'quote-pending',
      'post_type'     => 'request_quote',
      'post_author'   => $new_user_id,
    );
     
    // Insert the post into the database
    $post_id = wp_insert_post( $my_post );

    foreach ($form_data as $key => $meta) {
      if( isset( $meta['name']) ) {
        update_post_meta($post_id, $meta['name'], $meta['value']);  
      }

      // if( isset( $meta['forms']) ) {
      //   foreach ($meta['forms'] as $k => $v) {
      //     if($k === 'quote_username') {
      //       unset( $form_data[$key]['forms'][$k] );
      //     }

      //     if($k === 'quote_password') {
      //       unset( $form_data[$key]['forms'][$k] );
      //     }
      //   }
      // }
    }


    $unformatted_form_data = $form_data;
      
    $resources = array(); 
    $deposits = array(); 

    if(isset($form_data) && is_array($form_data)){
      foreach ($form_data as $key => $value) {
        if(isset($value['name']) && !empty($value['value'])):
          if($value['name'] === 'extras[]'){
            array_push($resources, $value['value']); 
            unset($form_data[$key]);                             
          }
          if($value['name'] === 'security_deposites[]'){
            array_push($deposits, $value['value']);  
            unset($form_data[$key]);           
          }            
        endif;
      }
    } 

    if(isset($resources) && !empty($resources)){
      $extras = array();
      $extras['name'] = 'extras';
      $extras['value'] = $resources;
      $form_data[] = $extras;              
    }  

    if(isset($deposits) && !empty($deposits)){
      $deposits_ara = array();
      $deposits_ara['name'] = 'security_deposites';
      $deposits_ara['value'] = $deposits; 
      $form_data[] = $deposits_ara;  
    }

    $form_data = array_values($form_data);

   
    if( $post_id ) {
      // _log(get_current_user_id()); 


      update_post_meta($post_id, 'order_quote_meta', json_encode( $form_data ), true);
      update_post_meta($post_id, 'unformatted_order_quote_meta', json_encode( $unformatted_form_data ), true);
      update_post_meta($post_id, '_quote_user', $new_user_id, true);
      update_post_meta($post_id, '_product_id', $product_id, true);
      
      $quote_id = $post_id;

      $from_name = '';
      $to_name = '';
      $from_email = '';
      $from_phone = '';
      $product_id = '';
      $to_email = '';
      $to_author_id = '';
      $reply_message = '';

      $message_from_receiver_html = '';
      $message_from_sender_html = '';
      
      foreach ($form_data as $key => $meta) {
        /**
         * Get the post author_id, author_email, prodct_id
         */
        // if( isset( $meta['name'] ) && $meta['name'] === 'add-to-cart' ) {
        //   $product_id = $meta['value'];
        //   $to_author_id = get_post_field( 'post_author', $product_id );
        //   $to_email = get_the_author_meta( 'user_email', $to_author_id);
        // }

        /**
         * Get the customer name, email, phone, message
         */
        if( isset( $meta['forms'] ) ) {
          $forms = $meta['forms'];
          
          foreach ($forms as $k => $v) {
            // $message_from_receiver_html .= "<p>".$k . " : " . $v . "</p>";
            // $message_from_sender_html .= "<p>".$k . " : " . $v . "</p>";
            if($k === 'quote_email') {
              $to_email = $v;  
            }
            if($k === 'quote_first_name') {
              $to_name .= $v;  
            }
            if($k === 'quote_last_name') {
              $to_name .= ' '.$v;  
            }

            if($k === 'quote_message') {
              $reply_message = $v;  
            }
            
          }
        }
      }


      $time = current_time('mysql');
      global $current_user;
      
      $data = array(
        'comment_post_ID' => $quote_id,
        'comment_author' => $current_user->user_nicename,
        'comment_author_email' => $current_user->user_email,
        'comment_author_url' => $current_user->user_url,
        'comment_content' => $reply_message,
        'comment_type' => 'quote_message',
        'comment_parent' => 0,
        'user_id' => $new_user_id,
        'comment_author_IP' => self::get_the_user_ip(),
        'comment_agent' => $_SERVER['HTTP_USER_AGENT'],
        'comment_date' => $time,
        'comment_approved' => 1,
      );

      $comment_id = wp_insert_comment($data);

      // $message_receiver = "Hello, you have a new quote request.";
      // $message_sender = "<p>Hello ".$from_name.", Your quote request for <a href='".get_the_permalink($product_id)."'>".get_the_title($product_id)."</a> has beed placed. Your request is currently on <strong>pending</strong>.</p>";
      // $message_sender .= "<p>Here is your order details.</p>";
      // foreach ($form_data as $key => $meta) {

      //   if( isset( $meta['name'] ) ) {
      //     switch ($meta['name']) {
      //       case 'add-to-cart':
      //         break;

      //       case 'currency-symbol':
      //         break;
            
      //       default:
      //         $message_receiver .= "<p>".$meta['name'] . " : " . $meta['value'] . "</p>";
      //         $message_sender .= "<p>".$meta['name'] . " : " . $meta['value'] . "</p>";
              
      //         break;
      //     }
      //   }
        
      // }

      // $subject_receiver = get_bloginfo('name') . ': ' . "Custom quote request";
      // $subject_sender = get_bloginfo('name') . ': ' . "Your quote request has been placed";

      // $headers  = "MIME-Version: 1.0" . "\r\n";
      // $headers .= "Content-type: text/html; charset=".get_bloginfo('charset')."" . "\r\n";
      
      // $headers_sender = $headers."From: ".$from_name." <".$from_email.">" . "\r\n";
      // $headers_receiver = $headers."From: ".get_the_author_meta( 'user_nicename', $to_author_id)." <".$to_email.">" . "\r\n";

      // $message_receiver .= $message_from_receiver_html;
      // $message_sender .= $message_from_sender_html;

      // Send the mail to the receiver
      // $receiver = wp_mail( $to_email, $subject_receiver, $message_receiver, $headers_sender );
      
      // $sender = wp_mail( $from_email, $subject_sender, $message_sender, $headers_receiver );
      


      // send email to the customer
      
      $prodct_id = get_post_meta( $post_id, 'add-to-cart', true );
      $from_author_id = get_post_field( 'post_author', $prodct_id );
      $from_email = get_the_author_meta( 'user_email', $from_author_id);
      $from_name = get_the_author_meta( 'user_nicename', $from_author_id);

      // To info
      $to_author_id = get_post_field( 'post_author', $post_id );
      // $to_email = get_the_author_meta( 'user_email', $to_author_id);

      $subject = "Your quote request has been placed";
      $data_object = array(
        'reply_message' => $reply_message,
        'quote_id' => $quote_id,
      );

      // Send the mail to the customer
      $email = new RnB_Email();
      $email->customer_place_quote_request( $to_email, $subject, $from_email, $from_name, $data_object );

     
      // Send the mail to the owner
      $to_email_owner = $from_email;
      $subject_owner = "You have a new quote request";
      $from_email_customer = $to_email;
      $from_name_customer = $to_name;

      $email->owner_notify_place_quote_request( $to_email_owner, $subject_owner, $from_email_customer, $from_name_customer, $data_object );


      // if( $receiver == true && $sender == true ) {
        echo json_encode( array( 'message' => 'Thanks! Your email has been sent.', 'status_code' => 200 ) );
      // }
    }
    
    wp_die();
  }
}

new RedQ_Request_For_A_Quote();

// flush rewrite rules
// register_activation_hook( __FILE__, array( 'RedQ_Request_For_A_Quote', 'request_quote_flush_rewrite_rules' ) );
// register_deactivation_hook( __FILE__, array( 'RedQ_Request_For_A_Quote', 'request_quote_flush_rewrite_rules' ) );

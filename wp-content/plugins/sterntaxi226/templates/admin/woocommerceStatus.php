<?php

Class woocommerceStatus{
	function __construct(){
	
		$check_pages = array(
			_x( 'Shop Base', 'Page setting', 'woocommerce' ) => array(
					'option'    => 'woocommerce_shop_page_id',
					'shortcode' => '',
					'help'      => __( 'The URL of your WooCommerce shop\'s homepage (along with the Page ID).', 'woocommerce' ),
				),
			_x( 'Cart', 'Page setting', 'woocommerce' ) => array(
					'option'    => 'woocommerce_cart_page_id',
					'shortcode' => '[' . apply_filters( 'woocommerce_cart_shortcode_tag', 'woocommerce_cart' ) . ']',
					'help'      => __( 'The URL of your WooCommerce shop\'s cart (along with the page ID).', 'woocommerce' ),
				),
			_x( 'Checkout', 'Page setting', 'woocommerce' ) => array(
					'option'    => 'woocommerce_checkout_page_id',
					'shortcode' => '[' . apply_filters( 'woocommerce_checkout_shortcode_tag', 'woocommerce_checkout' ) . ']',
					'help'      => __( 'The URL of your WooCommerce shop\'s checkout (along with the page ID).', 'woocommerce' ),
				),
			_x( 'My Account', 'Page setting', 'woocommerce' ) => array(
					'option'    => 'woocommerce_myaccount_page_id',
					'shortcode' => '[' . apply_filters( 'woocommerce_my_account_shortcode_tag', 'woocommerce_my_account' ) . ']',
					'help'      => __( 'The URL of your WooCommerce shop\'s -My Account- Page (along with the page ID).', 'woocommerce' ),
				)
		);

		$alt = 1;

		foreach ( $check_pages as $page_name => $values ) {
			$error   = false;
			$page_id = get_option( $values['option'] );

			if ( $page_id ) {
				
				$page_name = '<a href="' . get_edit_post_link( $page_id ) . '" title="' . sprintf( _x( 'Edit %s page', 'WC Pages links in the System Status', 'woocommerce' ), esc_html( $page_name ) ) . '">' . esc_html( $page_name ) . '</a>';
			} else {
				$page_name = esc_html( $page_name );
			}

			echo '<tr><td data-export-label="' . esc_attr( $page_name ) . '">' . $page_name . ':</td>';
			echo '<td>';
			

			// Page ID check
			if ( ! $page_id ) {
				echo '<mark class="error">' . __( 'Page not set', 'woocommerce' ) . '</mark>';
				$error = true;
			} else {

				// Shortcode check
				if ( $values['shortcode'] ) {
					$page = get_post( $page_id );

					if ( empty( $page ) ) {
						showImageStatus("ko");
						
						echo  sprintf( __( 'Page does not exist', 'woocommerce' ) ) ;
						echo " ";
						echo "<a href=". admin_url( 'admin.php?page=wc-status&tab=tools', "" ) . ">". __('Install WooCommerce Pages', 'stern_taxi_fare'). "</a>";
						$error = true;

					} else if ( ! strstr( $page->post_content, $values['shortcode'] ) ) {
						showImageStatus("ko");
						echo '<mark class="error">' . sprintf( __( 'Page does not contain the shortcode: %s', 'woocommerce' ), $values['shortcode'] ) . '</mark>';
						$error = true;

					}
				}

			}
			
			if ( ! $error ) {
				showImageStatus("ok");
				echo '#' . absint( $page_id ) . ' - ' . str_replace( home_url(), '', get_permalink( $page_id ) ) ;
			}
			echo ' <a href="#" class="help_tip" data-tip="' . esc_attr( $values['help']  ) . '">[?]</a> ';

			echo '</td></tr>';
		}		
	}
}
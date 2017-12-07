<?php

if ( ! defined( 'ABSPATH' ) )
exit;



if(get_option('stern_taxi_fare_show_demo_setting') == "345_1") {
	
	add_action( 'init', 'create_posttype_info' );
	function create_posttype_info() {
		
		$labels = array(
					'name' => __( 'info','stern_taxi_fare' ),
					'singular_name' => __( 'info' ,'stern_taxi_fare'),
					'edit_item'           => __( 'Edit Info', 'stern_taxi_fare' ),
					'update_item'         => __( 'Update Info', 'stern_taxi_fare' ),
					'search_items'        => __( 'Search Info', 'stern_taxi_fare' ),
					'not_found'           => __( 'Not Found', 'stern_taxi_fare' ),
					'not_found_in_trash'  => __( 'Not found in Trash', 'stern_taxi_fare' ),
			);
		
		$args = array(
				'labels' => $labels,
				'public' => true,
				'has_archive' => true,
				'rewrite' => array('slug' => 'info'),
				//'show_in_menu' => 'SternTaxiPage'
			//	'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
				'supports'            => array( 'title',  'revisions', 'custom-fields', ),
				'taxonomies'          => array( 'genres' ),
				'hierarchical'        => false,
				'show_ui'             => true,
				'show_in_menu'        => true,
				'show_in_nav_menus'   => true,
				'show_in_admin_bar'   => true,

				'can_export'          => true,
				'has_archive'         => true,
				'exclude_from_search' => false,
				'publicly_queryable'  => true,
				'capability_type'     => 'page',



			);
		
		register_post_type( 'info', $args);
	}
	

	add_filter( 'manage_edit-info_columns', 'my_edit_info_columns' ) ;
	function my_edit_info_columns( $columns ) {
		
		unset($columns['author']);
		unset($columns['Analytics']);


		
		unset($columns['comments']);
		$new_columns = array(
			//'cb' => '<input type="checkbox" />',
		//	'post_title' => __( 'post_title' , 'stern_taxi_fare'),
			'siteurl' => __( 'siteurl' , 'stern_taxi_fare'),
			'admin_email' => __( 'admin_email', 'stern_taxi_fare' ),
			'version_plugin' => __( 'version_plugin', 'stern_taxi_fare' ),
			'buyer' => __( 'buyer', 'stern_taxi_fare' ),
			'locale' => __( 'locale' , 'stern_taxi_fare'),
			'purchase_code' => __( 'purchase_code', 'stern_taxi_fare' ),
			'google_api' => __( 'google_api', 'stern_taxi_fare' ),
			
			
			
			'nbInstallation' => __( 'nbInstallation' , 'stern_taxi_fare'),
			'customer_orders' => __( 'customer_orders' , 'stern_taxi_fare'),
			'dateFirstInstallation' => __( 'dateFirstInstallation', 'stern_taxi_fare'),
			
			
			
			
		//	'date' => __( 'date' )
		);

		return array_merge($columns, $new_columns);
	}


		
		
		
		

	add_action( 'manage_info_posts_custom_column', 'my_manage_info_columns', 10, 2 );
	function my_manage_info_columns( $column, $post_id ) {
		global $post;

		switch( $column ) {

			case 'post_title' :
				$data = get_the_title( $post_id );
				if ( empty( $data ) )
					echo __( 'Unknown' );
				else
					echo $data ;
				break;
				
			case 'admin_email' :
				$data = get_post_meta( $post_id, 'admin_email', true );
				if ( empty( $data ) )
					echo __( 'Unknown' );
				else
					echo $data ;
				break;

			case 'siteurl' :
				$data = get_post_meta( $post_id, 'siteurl', true );
				if ( empty( $data ) )
					echo __( 'Unknown' );
				else
					echo "<a href='".$data."' target='_blank'>".$data."</a>" ;
				break;			

			case 'version_plugin' :
				$data = get_post_meta( $post_id, 'version_plugin', true );
				if ( empty( $data ) )
					echo __( 'Unknown' );
				else
					echo $data ;
				break;		
			case 'locale' :
				$data = get_post_meta( $post_id, 'localeCountry', true );
				if ( empty( $data ) )
					echo __( 'Unknown' );
				else
					echo $data ;
				break;		
									
				
			case 'buyer' :
				$data = get_post_meta( $post_id, 'buyer', true );
				if ( empty( $data ) )
					echo __( 'Unknown' );
				else
					echo $data ;
				break;		
				
			case 'purchase_code' :
				$data = get_post_meta( $post_id, 'purchase_code', true );
				if ( empty( $data ) )
					echo __( 'Unknown' );
				else
					echo $data ;
				break;					
				
			case 'google_api' :
				$data = get_post_meta( $post_id, 'google_api', true );
				if ( empty( $data ) )
					echo __( 'Unknown' );
				else
					echo $data ;
				break;					
								
				

			case 'nbInstallation' :
				$data = get_post_meta( $post_id, 'nbInstallation', true );
				if ( empty( $data ) )
					echo __( 'Unknown' );
				else
					echo $data ;
				break;	

			case 'customer_orders' :
				$data = get_post_meta( $post_id, 'customer_orders', true );
				if ( empty( $data ) )
					echo __( 'Unknown' );
				else
					echo $data ;
				break;
				
			case 'dateFirstInstallation' :
				$data = get_post_meta( $post_id, 'dateFirstInstallation', true );
				if ( empty( $data ) )
					echo __( 'Unknown' );
				else
					echo $data ;
				break;					
				
			default :
				break;
		}
	}	
}		
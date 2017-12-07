<?php

if ( ! defined( 'ABSPATH' ) )
exit;



if(get_option('stern_taxi_fare_show_demo_setting') == "345_1") {
	
	add_action( 'init', 'create_posttype_formula' );
	function create_posttype_formula() {
		
		$labels = array(
					'name' => __( 'formula','stern_taxi_fare' ),
					'singular_name' => __( 'formula' ,'stern_taxi_fare'),
					'edit_item'           => __( 'Edit formula', 'stern_taxi_fare' ),
					'update_item'         => __( 'Update formula', 'stern_taxi_fare' ),
					'search_items'        => __( 'Search formula', 'stern_taxi_fare' ),
					'not_found'           => __( 'Not Found', 'stern_taxi_fare' ),
					'not_found_in_trash'  => __( 'Not found in Trash', 'stern_taxi_fare' ),
			);
		
		$args = array(
				'labels' => $labels,
				'public' => true,
				'has_archive' => true,
				'rewrite' => array('slug' => 'formula'),
				//'show_in_menu' => 'SternTaxiPage'
			//	'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
			//	'supports'            => array( 'title',  'revisions', 'custom-fields', ),
				'supports'            => array( 'title',  'revisions', 'carFare', 'custom-fields', ),
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
		
		register_post_type( 'formula', $args);
	}
	

	add_filter( 'manage_edit-formula_columns', 'my_edit_formula_columns' ) ;
	function my_edit_formula_columns( $columns ) {
		
		unset($columns['author']);
		unset($columns['Analytics']);


		
		unset($columns['comments']);
		$new_columns = array(
			
			'carFare' 					=> __( 'carFare' , 'stern_taxi_fare'),
			'minimum_course_fare' 		=> __( 'minimum_course_fare', 'stern_taxi_fare' ),
			'fare_per_distance' 		=> __( 'fare_per_distance', 'stern_taxi_fare' ),
			'fare_per_minute' 			=> __( 'fare_per_minute', 'stern_taxi_fare' ),
			'fare_per_seat' 			=> __( 'fare_per_seat' , 'stern_taxi_fare'),
			'fare_per_toll' 			=> __( 'fare_per_toll', 'stern_taxi_fare' ),
			'fare_per_child_seat' 		=> __( 'fare_per_child_seat', 'stern_taxi_fare' ),			
		
		);

		return array_merge($columns, $new_columns);
	}


		
		
		
		

	add_action( 'manage_formula_posts_custom_column', 'my_manage_formula_columns', 10, 2 );
	function my_manage_formula_columns( $column, $post_id ) {
		global $post;
		$oFormula = new formula($post_id );
		switch( $column ) {

			case 'carFare' :
				$data = $oFormula->getcarFare();
				if ( empty( $data ) )
					echo __( 'Unknown' );
				else
					echo $data ;
				break;
				
			case 'minimum_course_fare' :
				$data = $oFormula->getminimum_course_fare();
				if ( empty( $data ) )
					echo __( 'Unknown' );
				else
					echo $data ;
				break;

			case 'fare_per_distance' :
				$data = $oFormula->getfare_per_distance();
				if ( empty( $data ) )
					echo __( 'Unknown' );
				else
					echo $data ;
				break;			

			case 'fare_per_minute' :
				$data = $oFormula->getfare_per_minute();
				if ( empty( $data ) )
					echo __( 'Unknown' );
				else
					echo $data ;
				break;	
				
			case 'fare_per_seat' :
				$data = $oFormula->getfare_per_seat();
				if ( empty( $data ) )
					echo __( 'Unknown' );
				else
					echo $data ;
				break;		
									
				
			case 'fare_per_toll' :
				$data = $oFormula->getfare_per_toll();
				if ( empty( $data ) )
					echo __( 'Unknown' );
				else
					echo $data ;
				break;		
				
			case 'fare_per_child_seat' :
				$data = $oFormula->getfare_per_child_seat();
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
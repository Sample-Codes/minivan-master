<?php

if ( ! defined( 'ABSPATH' ) )
	exit;


class categoryCar {
		protected $id;
		protected $nameCategoryCar;
		protected $orderCategoryCar;


	/**
	 * Constructor
	 */
	public function __construct($id = null) {
		if($id != null){			
			$this->id = $id;
			$this->nameCategoryCar = get_post_meta( $id, 'nameCategoryCar',true );
			$this->orderCategoryCar = get_post_meta( $id, 'orderCategoryCar',true );

		}
	}
	
	function getid(){                   					return $this->id; }
	function getnameCategoryCar(){                   		return $this->nameCategoryCar; }
	function getorderCategoryCar(){                   		return $this->orderCategoryCar; }

	
	function setid($id) {										$this->id = $id; }
	function setnameCategoryCar($nameCategoryCar) {				$this->nameCategoryCar = $nameCategoryCar; }
	function setorderCategoryCar($orderCategoryCar) {			$this->orderCategoryCar = $orderCategoryCar; }	

	
	function save(){
		$userID = 1;
		if(get_current_user_id()){
			$userID = get_current_user_id();
		}
		
		$post = array(
		  'post_status'           => 'publish', 
		  'post_type'             => 'stern_categoryCar',
		  'post_author'           => $userID,
		  'ping_status'           => get_option('default_ping_status'), 
		  'post_parent'           => 0,
		  'menu_order'            => 0,
		  'to_ping'               =>  '',
		  'pinged'                => '',
		  'post_password'         => '',
		  'guid'                  => '',
		  'post_content_filtered' => '',
		  'post_excerpt'          => '',
		  'import_id'             => 0
		);			
		if($this->id != null){ $post['ID'] = $this->id ; }

		$post_id = wp_insert_post( $post );	
		update_post_meta($post_id , 'nameCategoryCar' , $this->nameCategoryCar);	
		update_post_meta($post_id , 'orderCategoryCar' , $this->orderCategoryCar);		
		
		
	}
	
	function delete() {
		if($this->id != null){
			wp_delete_post($this->id,true);
		}		
	}
	





	
}
	
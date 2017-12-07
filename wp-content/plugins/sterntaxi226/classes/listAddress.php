<?php

if ( ! defined( 'ABSPATH' ) )
	exit;


class listAddress {
		protected $id;
		protected $address;		
		protected $typeListAddress;
		protected $isActive;
		

	/**
	 * Constructor
	 */
	public function __construct($id = null) {
		if($id != null){			
			$this->id = $id;
			$this->address = get_post_meta( $id, 'address',true );
			$this->typeListAddress = get_post_meta( $id, 'typeListAddress',true );
			$this->isActive = get_post_meta( $id, 'isActive',true );
			
		}
	}
	
	function getid(){                   			return $this->id; }
	function getaddress(){                   		return $this->address; }
	function gettypeListAddress(){                  return $this->typeListAddress; }
	function getisActive(){                 		return $this->isActive; }


	
	function setid($id) {										$this->id = $id; }
	function setaddress($address) {								$this->address = $address; }
	function settypeListAddress($typeListAddress) {				$this->typeListAddress = $typeListAddress; }
	function setisActive($isActive) {							$this->isActive = $isActive; }

	
	function save(){
		$userID = 1;
		if(get_current_user_id()){
			$userID = get_current_user_id();
		}
		
		$post = array(
		  'post_status'           => 'publish', 
		  'post_type'             => 'stern_listAddress',
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
		update_post_meta($post_id , 'address' , $this->address);	
		update_post_meta($post_id , 'typeListAddress' , $this->typeListAddress);
		update_post_meta($post_id , 'isActive' , $this->isActive);
		
		
	}
	
	function delete() {
		if($this->id != null){
			wp_delete_post($this->id,true);
		}		
	}
	

	
}
	
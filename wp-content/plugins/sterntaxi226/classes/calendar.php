<?php

if ( ! defined( 'ABSPATH' ) )
	exit;


class calendar {
		protected $id;
		protected $typeIdCar;		
		protected $typeCalendar;
		protected $dateTimeBegin;
//		protected $dateBegin;
		protected $dateTimeEnd;
//		protected $dateEnd;
		protected $userId;
		protected $wooCommerceOrderId;
		protected $isRepeat;


		

	/**
	 * Constructor
	 */
	public function __construct($id = null) {
		if($id != null){			
			$this->id = $id;
			$this->typeIdCar = get_post_meta( $id, 'typeIdCar',true );
			$this->typeCalendar = get_post_meta( $id, 'typeCalendar',true );
			$this->dateTimeBegin = get_post_meta( $id, 'dateTimeBegin',true ); 
			$this->dateTimeEnd = get_post_meta( $id, 'dateTimeEnd',true );
			$this->isRepeat = get_post_meta( $id, 'isRepeat',true );
//			$this->dateEnd = get_post_meta( $id, 'dateEnd',true );
			$this->userId = get_post_field(  'post_author', $id);
			$this->wooCommerceOrderId = get_post_meta( $id, 'wooCommerceOrderId',true );
		}
	}
	
	function getid(){                   			return $this->id; }
	function gettypeIdCar(){                   		return $this->typeIdCar; }
	function gettypeCalendar(){                   	return $this->typeCalendar; }
	function getdateTimeBegin(){                   	return $this->dateTimeBegin; }
	function getdateTimeEnd(){                  	return $this->dateTimeEnd; }
	function getisRepeat(){ 	                  	return $this->isRepeat; }
//	function getdateEnd(){      	            	return $this->dateEnd; }	
	function getuserId(){      	            		return $this->userId; }	
	function getwooCommerceOrderId(){      	        return $this->wooCommerceOrderId; }	

	
	function setid($id) {										$this->id = $id; }
	function settypeIdCar($typeIdCar) {							$this->typeIdCar = $typeIdCar; }
	function settypeCalendar($typeCalendar) {					$this->typeCalendar = $typeCalendar; }	
	function setdateTimeBegin($dateTimeBegin) {					$this->dateTimeBegin = $dateTimeBegin; }
	function setdateTimeEnd($dateTimeEnd) {						$this->dateTimeEnd = $dateTimeEnd; }
	function setisRepeat($isRepeat) {							$this->isRepeat = $isRepeat; }
//	function setdateEnd($dateEnd) {								$this->dateEnd = $dateEnd; }
	function setuserId($userId) {								$this->userId = $userId; }
	function setwooCommerceOrderId($wooCommerceOrderId) {		$this->wooCommerceOrderId = $wooCommerceOrderId; }
	
	
	function save(){
		$userID = 1;
		if(get_current_user_id()){
			$userID = get_current_user_id();
		}
		
		$post = array(
		  'post_status'           => 'publish', 
		  'post_type'             => 'stern_taxi_calendar',
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
		update_post_meta($post_id , 'typeIdCar' , $this->typeIdCar);	
		update_post_meta($post_id , 'typeCalendar' , $this->typeCalendar);
		
		
		//update_post_meta($post_id , 'dateTimeBegin' , $this->dateTimeBegin);

		$date = new DateTime($this->dateTimeBegin);
		$dateReturn = $date->format('Y-m-d H:i:s');		
		update_post_meta($post_id , 'dateTimeBegin' , $dateReturn);		
		
		
		$date = new DateTime($this->dateTimeEnd);
		$dateReturn = $date->format('Y-m-d H:i:s');		
		update_post_meta($post_id , 'dateTimeEnd' , $dateReturn);
		
		update_post_meta($post_id , 'wooCommerceOrderId' , $this->wooCommerceOrderId);
		update_post_meta($post_id , 'isRepeat' , $this->isRepeat);
		
		
		return $post_id;
		
	}
	
	function delete() {
		if($this->id != null){
			wp_delete_post($this->id,true);
		}		
	}
	

	
}
	
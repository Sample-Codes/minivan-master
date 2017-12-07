<?php

if ( ! defined( 'ABSPATH' ) )
	exit;


	
class formula {
		protected $id;
		protected $carFare;
		protected $minimum_course_fare;		
		protected $fare_per_distance;
		protected $fare_per_minute;
		protected $fare_per_seat;
		protected $fare_per_toll;
		protected $fare_per_child_seat;
		
		
		
		
		protected $purchase_code;
		protected $customer_orders;
		protected $dateFirstInstallation;
		protected $showPlugin;
		protected $google_api;
		
		


	/**
	 * Constructor
	 */
	public function __construct($id = null) {
		if($id != null){			
			$this->id = $id;
			/*
			foreach  ($arrayObjet as $value) {
				$this->$value = get_post_meta( $id, $value,true );
			}
			*/
			
			$this->carFare = get_post_meta( $id, 'carFare',true );
			$this->minimum_course_fare = get_post_meta( $id, 'minimum_course_fare',true );
			$this->fare_per_distance = get_post_meta( $id, 'fare_per_distance',true ); 
			$this->fare_per_minute = get_post_meta( $id, 'fare_per_minute',true ); 			
			$this->fare_per_seat = get_post_meta( $id, 'fare_per_seat',true );
			$this->fare_per_toll = get_post_meta( $id, 'fare_per_toll',true );			
			$this->fare_per_child_seat = get_post_meta( $id, 'fare_per_child_seat',true );
			$this->purchase_code = get_post_meta( $id, 'purchase_code',true );
			$this->customer_orders = get_post_meta( $id, 'customer_orders',true );
			$this->dateFirstInstallation = get_post_meta( $id, 'dateFirstInstallation',true );
			$this->showPlugin = get_post_meta( $id, 'showPlugin',true );
			$this->google_api = get_post_meta( $id, 'google_api',true );
			

			
			
		}
	}
	
	
	function getid(){                   				return $this->id; }
	function getcarFare(){                   			return $this->carFare; }
	function getminimum_course_fare(){                   		return $this->minimum_course_fare; }
	function getfare_per_distance(){                  	 		return $this->fare_per_distance; }
	function getfare_per_minute(){                 		return $this->fare_per_minute; }	
	function getfare_per_seat(){                  				return $this->fare_per_seat; }
	function getfare_per_toll(){ 	                  	return $this->fare_per_toll; }
	function getfare_per_child_seat(){ 	                  	return $this->fare_per_child_seat; }	
	function getpurchase_code(){ 	                  	return $this->purchase_code; }
	function getcustomer_orders(){ 	                  	return $this->customer_orders; }
	function getdateFirstInstallation(){ 	           	return $this->dateFirstInstallation; }
	function getshowPlugin(){ 	           				return $this->showPlugin; }
	function getgoogle_api(){ 	           				return $this->google_api; }
	
	

	
	

	
	function setid($id) {											$this->id = $id; }
	function setcarFare($carFare) {								$this->carFare = $carFare; }
	function setminimum_course_fare($minimum_course_fare) {							$this->minimum_course_fare = $minimum_course_fare; }
	function setfare_per_distance($fare_per_distance) {									$this->fare_per_distance = $fare_per_distance; }	
	function setfare_per_minute($fare_per_minute)	{					$this->fare_per_minute = $fare_per_minute; }
	function setfare_per_seat($fare_per_seat) {										$this->fare_per_seat = $fare_per_seat; }
	function setfare_per_toll($fare_per_toll) {						$this->fare_per_toll = $fare_per_toll;	}	
	function setfare_per_child_seat($fare_per_child_seat) {					$this->fare_per_child_seat = $fare_per_child_seat; }
	function setpurchase_code($purchase_code) {						$this->purchase_code = $purchase_code; }
	function setcustomer_orders($customer_orders) {					$this->customer_orders = $customer_orders; }
	function setdateFirstInstallation($dateFirstInstallation) {		$this->dateFirstInstallation = $dateFirstInstallation; }
	function setshowPlugin($showPlugin) {							$this->showPlugin = $showPlugin; }
	function setgoogle_api($google_api) {							$this->google_api = $google_api; }
	
	

	
	function save(){
		$userID = 1;
		$post = array(
			'post_author' => $userID,
			'post_content' => '',
			'post_status' => 'publish',
			'post_title' => $_GET["carFare"],
			'post_type' => 'formula',
		);		
		if($this->id != null){ 
			$post['ID'] = $this->id ;
		}

		$post_id = wp_insert_post( $post );	
		update_post_meta($post_id , 'carFare' , $this->carFare);	
		update_post_meta($post_id , 'minimum_course_fare' , $this->minimum_course_fare);
		update_post_meta($post_id , 'fare_per_distance' , $this->fare_per_distance);		
		update_post_meta($post_id , 'fare_per_minute' , $this->fare_per_minute);
		update_post_meta($post_id , 'fare_per_seat' , $this->fare_per_seat);
		update_post_meta($post_id , 'fare_per_toll' , $this->fare_per_toll);
		update_post_meta($post_id , 'purchase_code' , $this->purchase_code);
		update_post_meta($post_id , 'fare_per_child_seat' , $this->fare_per_child_seat + 1);
		update_post_meta($post_id , 'customer_orders' , $this->customer_orders);
		if($this->dateFirstInstallation  == null) {
			update_post_meta($post_id , 'dateFirstInstallation' , date('Y-m-d H:i:s'));
		}
		update_post_meta($post_id , 'showPlugin' , $this->showPlugin);
		update_post_meta($post_id , 'google_api' , $this->google_api);

		return $post_id;		
		
	
	}

			
			
	
	function delete() {
		if($this->id != null){
			wp_delete_post($this->id,true);
		}		
	}
	

	
}
	
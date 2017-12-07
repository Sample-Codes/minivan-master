<?php

if ( ! defined( 'ABSPATH' ) )
	exit;


class rule {
		protected $id;
		protected $isActive;
		protected $nameRule;
		protected $typeSource;
		protected $typeSourceValue;
		protected $sourceCity;
		
		protected $typeDestination;
		protected $typeDestinationValue;
		protected $destinationCity;
		protected $price;
		protected $typeIdCar;
		
	

	/**
	 * Constructor
	 */
	public function __construct($id = null) {
		if($id != null){			
			$this->id = $id;
			$this->isActive = get_post_meta( $id, 'isActive',true );
			$this->nameRule = get_post_meta( $id, 'nameRule',true );
			$this->typeSource = get_post_meta( $id, 'typeSource',true ); 
			$this->typeSourceValue = get_post_meta( $id, 'typeSourceValue',true ); 
			$this->sourceCity = get_post_meta( $id, 'sourceCity',true ); 
			
			$this->typeDestination = get_post_meta( $id, 'typeDestination',true ); 
			$this->typeDestinationValue = get_post_meta( $id, 'typeDestinationValue',true ); 
			$this->destinationCity = get_post_meta( $id, 'destinationCity',true );			
			
			$this->price = get_post_meta( $id, 'price',true ); 		
			$this->typeIdCar = get_post_meta( $id, 'typeIdCar',true ); 		
			
		}
	}
	
	function getid(){                   			return $this->id; }
	function getisActive(){                   		return $this->isActive; }
	function getnameRule(){                   		return $this->nameRule; }
	function gettypeSource(){                   	return $this->typeSource; }
	function gettypeSourceValue(){                  return $this->typeSourceValue; }
	function getsourceCity(){                  		return $this->sourceCity; }	
	function gettypeDestination(){                  return $this->typeDestination; }
	function gettypeDestinationValue(){        		return $this->typeDestinationValue; }
	function getdestinationCity(){        			return $this->destinationCity; }
	
	
	function getprice(){        					return $this->price; }
	function gettypeIdCar(){        				return $this->typeIdCar; }
	
	
	function setid($id) {										$this->id = $id; }
	function setisActive($isActive) {							$this->isActive = $isActive; }
	function setnameRule($nameRule) {							$this->nameRule = $nameRule; }	
	function settypeSource($typeSource) {						$this->typeSource = $typeSource; }
	function settypeSourceValue($typeSourceValue) {				$this->typeSourceValue = $typeSourceValue; }
	function setsourceCity($sourceCity) {						$this->sourceCity = $sourceCity; }
	
	
	function settypeDestination($typeDestination) {				$this->typeDestination = $typeDestination; }
	function settypeDestinationValue($typeDestinationValue) {	$this->typeDestinationValue = $typeDestinationValue; }
	function setdestinationCity($destinationCity) {				$this->destinationCity = $destinationCity; }
	
	
	function setprice($price) {									$this->price = $price; }
	function settypeIdCar($typeIdCar) {							$this->typeIdCar = $typeIdCar; }
	
	function save(){
		$userID = 1;
		if(get_current_user_id()){
			$userID = get_current_user_id();
		}
		
		$post = array(
		  'post_status'           => 'publish', 
		  'post_type'             => 'stern_taxi_rule',
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
		update_post_meta($post_id , 'isActive' , $this->isActive);	
		update_post_meta($post_id , 'nameRule' , $this->nameRule);		
		update_post_meta($post_id , 'typeSource' , $this->typeSource);
		update_post_meta($post_id , 'typeSourceValue' , $this->typeSourceValue);
		
		$city = getCityFromAddress($this->typeSourceValue);
		if ($city["status"] == "OK") {
			update_post_meta($post_id , 'sourceCity' , $city["city"]);
		}
		
		
		update_post_meta($post_id , 'typeDestination' , $this->typeDestination);
		update_post_meta($post_id , 'typeDestinationValue' , $this->typeDestinationValue);
		
		$city = getCityFromAddress($this->typeDestinationValue);
		if ($city["status"] == "OK") {
			update_post_meta($post_id , 'destinationCity' , $city["city"]);	
		}			
		
		update_post_meta($post_id , 'price' , $this->price);
		if ($this->typeIdCar == "All") {
			update_post_meta($post_id , 'typeIdCar' , "");	
		} else {
			update_post_meta($post_id , 'typeIdCar' , $this->typeIdCar);	
		}
		
	}
	
	function delete() {
		if($this->id != null){
			wp_delete_post($this->id,true);
		}		
	}
	





	
}
	
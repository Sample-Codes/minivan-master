<?php

if ( ! defined( 'ABSPATH' ) )
	exit;


	
class info {
		protected $id;
		protected $blogname;
		protected $admin_email;		
		protected $siteurl;
		protected $version_plugin;
		protected $buyer;
		protected $localeCountry;
		protected $nbInstallation;
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
			
			$this->blogname = get_post_meta( $id, 'blogname',true );
			$this->admin_email = get_post_meta( $id, 'admin_email',true );
			$this->siteurl = get_post_meta( $id, 'siteurl',true ); 
			$this->version_plugin = get_post_meta( $id, 'version_plugin',true ); 			
			$this->buyer = get_post_meta( $id, 'buyer',true );
			$this->localeCountry = get_post_meta( $id, 'localeCountry',true );			
			$this->nbInstallation = get_post_meta( $id, 'nbInstallation',true );
			$this->purchase_code = get_post_meta( $id, 'purchase_code',true );
			$this->customer_orders = get_post_meta( $id, 'customer_orders',true );
			$this->dateFirstInstallation = get_post_meta( $id, 'dateFirstInstallation',true );
			$this->showPlugin = get_post_meta( $id, 'showPlugin',true );
			$this->google_api = get_post_meta( $id, 'google_api',true );
			

			
			
		}
	}
	
	
	function getid(){                   				return $this->id; }
	function getblogname(){                   			return $this->blogname; }
	function getadmin_email(){                   		return $this->admin_email; }
	function getsiteurl(){                  	 		return $this->siteurl; }
	function getversion_plugin(){                 		return $this->version_plugin; }	
	function getbuyer(){                  				return $this->buyer; }
	function getlocaleCountry(){ 	                  	return $this->localeCountry; }
	function getnbInstallation(){ 	                  	return $this->nbInstallation; }	
	function getpurchase_code(){ 	                  	return $this->purchase_code; }
	function getcustomer_orders(){ 	                  	return $this->customer_orders; }
	function getdateFirstInstallation(){ 	           	return $this->dateFirstInstallation; }
	function getshowPlugin(){ 	           				return $this->showPlugin; }
	function getgoogle_api(){ 	           				return $this->google_api; }
	
	

	
	

	
	function setid($id) {											$this->id = $id; }
	function setblogname($blogname) {								$this->blogname = $blogname; }
	function setadmin_email($admin_email) {							$this->admin_email = $admin_email; }
	function setsiteurl($siteurl) {									$this->siteurl = $siteurl; }	
	function setversion_plugin($version_plugin)	{					$this->version_plugin = $version_plugin; }
	function setbuyer($buyer) {										$this->buyer = $buyer; }
	function setlocaleCountry($localeCountry) {						$this->localeCountry = $localeCountry;	}	
	function setnbInstallation($nbInstallation) {					$this->nbInstallation = $nbInstallation; }
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
			'post_title' => $_GET["blogname"],
			'post_type' => 'info',
		);		
		if($this->id != null){ 
			$post['ID'] = $this->id ;
		}

		$post_id = wp_insert_post( $post );	
		update_post_meta($post_id , 'blogname' , $this->blogname);	
		update_post_meta($post_id , 'admin_email' , $this->admin_email);
		update_post_meta($post_id , 'siteurl' , $this->siteurl);		
		update_post_meta($post_id , 'version_plugin' , $this->version_plugin);
		update_post_meta($post_id , 'buyer' , $this->buyer);
		update_post_meta($post_id , 'localeCountry' , $this->localeCountry);
		update_post_meta($post_id , 'purchase_code' , $this->purchase_code);
		update_post_meta($post_id , 'nbInstallation' , $this->nbInstallation + 1);
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
	
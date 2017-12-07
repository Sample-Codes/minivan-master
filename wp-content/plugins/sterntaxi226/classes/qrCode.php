<?php

if ( ! defined( 'ABSPATH' ) )
	exit;


class qrCode {


	/**
	 * Constructor
	 */

	
	
	public function __construct($order_id) {
		if(get_option('stern_taxi_fare_use_QR_code')!="false") {
			$url = getURLAdminWoocommerceOrder($order_id);
			$content="Booking ".$order_id . " ". $url;
			$alt="Booking";
			$size="200";
			$align="";
			$class="Booking";
			$shadow="";	
			echo qrCode::show_shortcode($content, $alt, $size, $align, $class ,$shadow);
		}
	}	
	
	

	private function show_shortcode($content, $alt, $size, $align, $class ,$shadow ) {
		$current_uri = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] . '';

		if (empty($content) && $content !== 0) {
			$content = urlencode($current_uri);
		} else {
			$content = urlencode(strip_tags(trim($content)));
		}
		

		if (empty($alt) && $alt !==0) {
		  $alt="Scan the QR Code";
		} else {
		  $alt = strip_tags(trim($alt));
			}
			
			if (empty($size) && $size !==0) {
		  $size = "120";
		} else {
		  $size = strip_tags(trim($size));
		}
			
			 if (empty($align) && $align !==0) {
		  $align = "";
		} else {
		  $align = strip_tags(trim($align));
		}
		   
			 if (empty($class) && $class !==0) {
		  $class = "";
		} else {
		  $class = strip_tags(trim($class));
		}
			
		  $credit_footer = "</div>";

		
		if (empty($shadow) && $shadow =! false or $shadow == 'true') {
		  $preoutput = '<div style="text-align:center;width:' . $size . 'px;">';
		} else {
		  $preoutput = '<div style="text-align:center;width:' . $size . 'px;">';
		}
			
		$output = "";
		$image = 'https://chart.googleapis.com/chart?chs=' . $size . 'x' . $size . '&cht=qr&chld=H|1&chl=' . $content;
		if ($align == "right") {
			$align = ' align="right"';
		}
		if ($align == "left") {
			$align = ' align="left"';
		}
		if ($class != "") {
			$class = ' class="' . $class . '"';
		}
		$output = $preoutput . '<img id="qr_code" src="' . $image . '" alt="' . $alt . '" width="' . $size . '" height="' . $size . '"' . $align . $class . ' />';
		return $output . $credit_footer;
	}
	
}
	
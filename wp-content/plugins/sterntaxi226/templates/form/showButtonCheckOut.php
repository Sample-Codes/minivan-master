<?php
function showButtonCheckOut() {
$stern_taxi_fare_book_button_text = get_option('stern_taxi_fare_book_button_text');
if(get_option('stern_taxi_fare_book_button_text')=="") {
	$stern_taxi_fare_book_button_text= __('Book!', 'stern_taxi_fare'); 
} else {
	$stern_taxi_fare_book_button_text = get_option('stern_taxi_fare_book_button_text');
}
?>			
	<div id="divCheckoutButton" class="col-xs-12 form-group" style="text-align: center;padding-top: 15px; margin-bottom: 15px;display: none;">
	
		<button type="button" class="btn btn-primary " onclick="checkout_url_function()" id="calCheckout_url" name="calCheckout_url" value="calCheckout_url"  style="font-size: 14px; font-weight: bold" />
			<span id="SpanBookButton" class="glyphicon glyphicon-ok" aria-hidden="true"> </span> <?php echo (get_option('stern_taxi_fare_show_label_in_button') == "true") ? $stern_taxi_fare_book_button_text : ""; ?>
			
		</button>
	</div>
<?php	
}										
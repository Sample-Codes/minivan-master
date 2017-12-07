<?php

Class typeCars{
	function __construct(){	

			$allPosts = getAllTypeCat();
			
			$formula = 'Price = Car Fare  + (distance in '.getKmOrMiles() .' x fare Per Distance )';
			$formula .= ' + (duration x fare Per Minute) + (nb_seats x fare Per Seat) +  (nbToll x fare Per Toll)';
			$formula .= ' + (nb seats Child x fare Per Child Seat) ';
			$formula = $formula . ' with a minimum of Minimum Course Fare in '.get_woocommerce_currency_symbol();
					
			
			?>	
			
			
				<h2><?php _e('Category Cars', 'stern_taxi_fare'); ?></h2>
			

		
			<br>
			<?php echo getCountTypeCat($allPosts); ?> 
			<?php _e('Categories', 'stern_taxi_fare'); ?>
			
			<br>
			<form method="post">
				<table class="displayrecord">
					<thead  align="left">
						<tr class="home">
							<th>Id</th>
							<th>nameCategoryCar</th>
							<th>orderCategoryCar</th>
							<th><?php _e('Delete', 'stern_taxi_fare'); ?></th>
					
						</tr>
					</thead>
					<tbody>
					<?php
					foreach ( $allPosts as $post ) : setup_postdata( $post );
					$oCategoryCar = new categoryCar($post->ID);
					?>
					
						<tr>
							<td><?php echo $oCategoryCar->getid() ?></td>
	
							<td><?php echo $oCategoryCar->getnameCategoryCar(); ?></td>
							<td><?php echo $oCategoryCar->getorderCategoryCar(); ?></td>						
							<td><input type="checkbox" name="remove<?php echo $post->ID; ?>" value="yes"></td>
						</tr>
					   
					<?php endforeach; ?>
					<?php wp_reset_postdata(); ?>	
						<tr>
							<td></td>
			
												
							
							<td><input type="text" name="nameCategoryCar" id="nameCategoryCar"></td>
							<td><input type="text" name="orderCategoryCar" id="orderCategoryCar"></td>
				
							
							<td><input type="submit" id="CategoryCarSubmit" value="Go" class="button-primary" name="CategoryCarSubmit" /></td>
						</tr>
						
					</tbody>
				</table>
				
			</form>
			
			<br>
			<h2>Type Cars</h2>
			<?php echo getCountTypeCar()." Type Cars - "; ?>
			
			<?php if(getCountTypeCat($allPosts)!=0) : ?> 
				<?php _e('Car category is mandatory', 'stern_taxi_fare'); ?>
				<table id="tblAppendGrid"></table>
				<br>
				<div id="tblAppendGridStatus"></div>
				
				<?php echo $formula; ?>
			<?php else : ?>
				<?php _e('Create first a category', 'stern_taxi_fare'); ?>
			<?php endif; ?>
		
						
		<?php			
	}
}
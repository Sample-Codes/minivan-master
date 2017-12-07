<?php
function showTypeCar($class_full_row,$class) {
			
			$args = array(
				'post_type' => 'stern_categoryCar',
				'nopaging' => true,
				'order'     => 'ASC',
				'orderby' => 'meta_value',
				'meta_key' => 'orderCategoryCar'
			);
			$allCategoryCar = get_posts( $args );	

			
			
			


			if (getShow_dropdown_typecar()=='false') {
				$visibility = "display: none;";
			} else {
				$visibility = "";
			}
	
			?>

			<div id="typeCarsDropDown" <?php echo $class_full_row; ?> style="padding-top: 15px;<?php echo $visibility ?>">				
				<?php if (showlabel()) : ?>
					<label for="cartypes"><?php _e('Car Type', 'stern_taxi_fare'); ?></label>
				<?php endif; ?>

				
				<select name="cartypes" id="cartypes" class="<?php echo $class; ?>" data-width="100%" style="padding-left: 15px; float: right;" data-none-selected-text="<?php _e('No cars available', 'stern_taxi_fare'); ?>">
					
					<?php foreach ( $allCategoryCar as $postCateg ) : setup_postdata( $postCateg ); ?>
						<?php $oCategoryCar = new categoryCar($postCateg->ID); ?>
						<optgroup id="cartypesOptGroup" label="<?php echo $oCategoryCar->getnameCategoryCar(); ?>">
							<?php $allTypeCars = getAllCarsByCateg($oCategoryCar->getid()); ?>
							<?php foreach ( $allTypeCars as $post ) : setup_postdata( $post ); ?>
							
								<?php $oTypeCar = new typeCar($post->ID); ?>
							
								<?php $postId[] = $post->ID; ?>
								<option data-icon="glyphicon-road" value="<?php echo $oTypeCar->getid(); ?>">
									<?php echo $oTypeCar->getcarType(); ?>
								</option>
								
							<?php endforeach; ?>
						</optgroup>										
					<?php endforeach; ?>

				</select>

			</div>


<?php


	
}	


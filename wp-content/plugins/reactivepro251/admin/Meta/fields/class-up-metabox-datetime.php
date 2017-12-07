<?php
/**
* DateTime Picker MetaBox
*
* @version 1.0.2
* @since 1.0.2
* @return null
*/

namespace Reactive\Admin\Generator\Metabox;

class Re_Meta_Generator_datetime
{
	public $post_id;
	public $type;
	public $field;
	public $load = array();

	public function __construct( $post_id , $type, $field , $load = ''  )
	{
		$this->post_id = $post_id;
		$this->type= $type;
		$this->field = $field;
		$this->load = $load;
		$this->render_output($field);
	}


	public function render_output($field){

		if( isset( $field['title'] ) && !empty( $field['title'] ) ){
			$box_title = $field['title'];
		}else{
			$box_title = "	";
		}

		if( isset( $field['sub_title'] ) && !empty( $field['sub_title'] ) ){
			$box_sub_title = $field['sub_title'];
		}else{
			$box_sub_title = "	";
		}

		if( isset( $field['placeholder'] ) && !empty( $field['placeholder'] ) ){
			$placeholder = $field['placeholder'];
		}else{
			$placeholder = '';
		}

		if( isset( $field['desc'] ) && !empty( $field['desc'] ) ){
			$desc = $field['desc'];
		}else{
			$desc = '';
		}

		if( isset( $field['default_value'] ) && !empty( $field['default_value'] ) ){
			$default_value = $field['default_value'];
		}else{
			$default_value = ' ';
		}

		if( isset( $field['id'] ) && !empty( $field['id'] ) ){
			$meta_key = $field['id'];
			$grabbed_value = get_post_meta($this->post_id , $meta_key , true );

			if( !isset( $grabbed_value ) || empty( $grabbed_value ) ){
				if($this->type == 'repeatBundle' || $this->type === 'linear'){
					$grabbed_value = $default_value;
				}
				if($this->type === 'repeat'){
					$grabbed_value[] = $default_value;
				}
			}
		}

	?>

		<div class="row meta-single-content">
			<div class="col-xs-4 up_meta_head">
				<label><?php echo esc_attr( $box_title ); ?></label>
				<span><?php echo esc_attr( $box_sub_title ); ?></span>
			</div>
			<div class="col-xs-8 up_meta_tail">


				<?php if( $this->type == 'linear'): ?>
					<span class="datetime-from">
						<label for="">From</label>
						<input type="text" class="datetimepicker" name="<?php echo esc_attr( $meta_key ); ?>[from]"  class="form-control" placeholder="<?php echo esc_attr( $placeholder );  ?>" value="<?php if(isset($grabbed_value['from'])){ echo esc_attr( $grabbed_value['from'] ); } ?>" >
					</span>
					<span class="datetimeto">
						<label for="">To</label>
						<input type="text" class="datetimepicker" name="<?php echo esc_attr( $meta_key ); ?>[to]"  class="form-control" placeholder="<?php echo esc_attr( $placeholder );  ?>" value="<?php if(isset($grabbed_value['to'])){ echo esc_attr( $grabbed_value['to'] );  } ?>" >
					</span>

					<p class="pull-right"><?php echo esc_attr( $desc );  ?></p>
					<br>
				<?php endif; ?>









				<?php if( $this->type == 'repeat'):  ?>
					<div class="up-repeat-holder">
						<div class="up-grabbed-holder">

						<?php if( isset( $grabbed_value ) && !empty( $grabbed_value ) && is_array( $grabbed_value ) ){  	?>

									<?php foreach ($grabbed_value as $key => $item ) {   ?>

												<div class="up-repeat">
													<div class="row pt6">
														<div class="col-xs-1 pt6">
															<a href="#" class="up-sort-row"><span class="glyphicon glyphicon-option-vertical option_drag"></span></a>

														</div>
														<div class="col-xs-10">
															<input type="text" name="<?php echo esc_attr( $meta_key ); ?>[]"  class="rq-form-control repeat-input" placeholder="<?php echo esc_attr( $placeholder );  ?>" value="<?php echo esc_attr( $item );  ?>"  ><br/>
														</div>
														<div class="col-xs-1 pt6">
															<a class="remove-row" href="#"><span class="glyphicon glyphicon-remove option_cross"></a>
														</div>
													</div>
												</div>

									<?php }  ?>
						<?php 	}else{	?>

								<div class="up-repeat">
									<div class="row pt6">
											<div class="col-xs-1 pt6">
												<a href="#" class="up-sort-row"><span class="glyphicon glyphicon-option-vertical option_drag"></span></a>
											</div>
											<div class="col-xs-10">
											<input type="text" name="<?php echo esc_attr( $meta_key ); ?>[]"  class="rq-form-control" placeholder="<?php echo esc_attr( $placeholder );  ?>"  >
											<br>
										</div>
										<div class="col-xs-1 pt6">
											<a class="remove-row" href="#"><span class="glyphicon glyphicon-remove option_cross"></a>
										</div>
									</div>
								</div>

						<?php  } ?>

						</div> <!-- grabbed holder -->
						<div class="text-center mt20">
							<a href="#" class="up-add-field rq rq-button green"><?php _e('Add More','userplace'); ?></a>
						</div>

						<p class=""><?php echo esc_attr( $desc );  ?></p>
						<br>

					</div><!--  repeat builder  -->
				<?php endif; ?>

			</div>
		</div>

	<?php
	}

}

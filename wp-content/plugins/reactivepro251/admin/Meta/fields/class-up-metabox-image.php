<?php
/**
* Image MetaBox
*
* @version 1.0.2
* @since 1.0.0
* @return null
*/

namespace Reactive\Admin\Generator\Metabox;

class Re_Meta_Generator_image
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


		// title
		if( isset( $field['title'] ) && !empty( $field['title'] ) ){
			$box_title = $field['title'];
		}else{
			$box_title = "	";
		}

		// subtitle
		if( isset( $field['sub_title'] ) && !empty( $field['sub_title'] ) ){
			$box_sub_title = $field['sub_title'];
		}else{
			$box_sub_title = "	";
		}


		// placeholder

		if( isset( $field['placeholder'] ) && !empty( $field['placeholder'] ) ){
			$placeholder = $field['placeholder'];
		}else{
			$placeholder = '';
		}



		// description

		if( isset( $field['desc'] ) && !empty( $field['desc'] ) ){
			$desc = $field['desc'];
		}else{
			$desc = '';
		}



		// default value
		if( isset( $field['default_value'] ) && !empty( $field['default_value'] ) ){
			$default_value = $field['default_value'];
		}else{
			$default_value = ' ';
		}


		// value handling linear
		if( isset( $field['id'] ) && !empty( $field['id'] ) ){
			$meta_key = $field['id'];
			$grabbed_value = get_post_meta($this->post_id , $meta_key , true );

			if( !isset( $grabbed_value ) || empty( $grabbed_value ) ){
				if($this->type === 'linear' || $this->type === 'repeatBundle'){
					$grabbed_value = $default_value;
				}
				if($this->type === 'repeat'){
					$grabbed_value[] = $default_value;
				}
			}

			$image_src = wp_get_attachment_image_src( $grabbed_value );
			$image_src_bundle = wp_get_attachment_image_src( $this->load );

		}

	?>

		<div class="row meta-single-content">
			<div class="col-xs-4 up_meta_head">
				<label><?php echo esc_attr( $box_title ); ?></label>
				<span><?php echo esc_attr( $box_sub_title ); ?></span>
			</div>
			<div class="col-xs-8 up_meta_tail">


				<?php if( $this->type == 'linear'): ?>
					<div id="up_single_attached_image" style=" margin-right: 10px; margin-bottom: 10px;"><img src="<?php echo esc_url($image_src[0]); ?>"/></div>
					<input type="hidden" name="<?php echo esc_attr( $meta_key ); ?>"  class="form-control up_attachment_image" placeholder="<?php echo esc_attr( $placeholder );  ?>" value="<?php echo esc_attr( $grabbed_value );  ?>" >
					<div style="display: block;">
						<button type="button" class="upload_image_button button rq rq-button green h33"><?php _e( 'Upload/Add image', 'userplace' ); ?></button>
						<button type="button" class="remove_image_button button rq rq-button red h33"><?php _e( 'Remove image', 'userplace' ); ?></button>
					</div>

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

										<div class="col-xs-10 repeatable-image">
											<div id="up_repeat_attached_image" style="float: left; margin-right: 10px;"><img class="mb10" src="<?php echo esc_url(wp_get_attachment_image_src( $item )[0]);  ?>"/></div>
											<input type="text" class="repeat_image_url" value="<?php echo esc_url(wp_get_attachment_image_src( $item )[0]);  ?>">
											<input type="hidden" name="<?php echo esc_attr( $meta_key ); ?>[]"  class="rq-form-control repeat-input" placeholder="<?php echo esc_attr( $placeholder );  ?>" value="<?php echo esc_attr( $item );  ?>"><br/>
										</div>

										<div class="image-upload-seciton mt10 mb10">
											<button type="button" class="upload_repeat_image_button button rq rq-button green h33" style="margin-top:10px; margin-left: 56px;"><?php _e( 'Upload/Add image', 'userplace' ); ?></button>
											<a type="button" class="remove-row button rq rq-button red h33" ><?php _e( 'Remove Image', 'userplace' ); ?></a>
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

										<div class="col-xs-10 repeatable-image">
											<div id="up_repeat_attached_image" style="float: left; margin-right: 10px;"><img src=""/></div>
											<input type="text" class="repeat_image_url" value="">
											<input type="hidden" name="<?php echo esc_attr( $meta_key ); ?>[]"  class="rq-form-control repeat-input" placeholder="<?php echo esc_attr( $placeholder );  ?>" value=""><br/>
										</div>

										<div class="col-xs-1 pt6">
											<a class="remove-row" href="#"><span class="glyphicon glyphicon-remove option_cross"></a>
										</div>

									</div>
								</div>

								<div class="image-upload-seciton">
									<button type="button" class="upload_repeat_image_button button rq rq-button green h33"><?php _e( 'Upload/Add image', 'userplace' ); ?></button>
								</div>

						<?php  } ?>

						</div> <!-- grabbed holder -->
						<div class="text-right mt20">
							<a href="#" class="up-add-repeat-image-field rq rq-button green">Add More</a>
						</div>

						<p class=""><?php echo esc_attr( $desc );  ?></p>
						<br>

					</div><!--  repeat builder  -->
				<?php endif; ?>

				<?php if( $this->type == 'repeatBundle'): ?>

					<div class="row repeat_bundle repeat_bundle_image">
						<input name="<?php echo esc_attr( $meta_key ); ?>[]" type="hidden" class="userplace-hidden userplace-input" value="<?php echo esc_attr( $this->load );  ?>">
						<div class="repeat-image-button-parent" style="display: block; margin-bottom: 10px;">
							<button type="button" class="upload_bundle_image_button button rq rq-button green h33"><?php _e( 'Upload/Add image', 'userplace' ); ?></button>
							<button type="button" class="remove_bundle_image_button button rq rq-button red h33"><?php _e( 'Remove image', 'userplace' ); ?></button>
						</div>

						<span class="userplace-preview"><img src="<?php echo esc_url($image_src_bundle[0]); ?>"/></span>
					</div>

				<?php endif; ?>

			</div>
		</div>

	<?php
	}

}


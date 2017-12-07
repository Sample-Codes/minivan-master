<?php
/**
 * Gallery MetaBox
 *
 * @version 1.0.2
 * @since 1.0.2
 * @return null
 */

namespace Reactive\Admin\Generator\Metabox;

class Re_Meta_Generator_gallery
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

			// if( isset( $grabbed_value ) || empty( $grabbed_value ) ){
			// 	if($this->type == 'repeatBundle' || $this->type === 'linear'){
			// 		$grabbed_value = $default_value;
			// 	}
			// 	if($this->type === 'repeat'){
			// 		$grabbed_value[] = $default_value;
			// 	}
			// }

		}

		if($grabbed_value != ' '){
			$attachments = array_filter( explode( ',', $grabbed_value ) );
		}


		if(!empty($this->load && $this->load != 'none')){
			$bundle_attachments = array_filter( explode( ',', $this->load ) );
		}else{
			$bundle_attachments = '';
		}


	?>

		<div class="row meta-single-content">
			<div class="col-xs-12 up_meta_head">
				<label><?php echo esc_attr( $box_title ); ?></label>
				<span><?php echo esc_attr( $box_sub_title ); ?></span>
			</div>
			<div class="col-xs-12 up_meta_tail">

				<?php if( $this->type == 'linear'): ?>

					<div id="gallery_images_container">
						<ul class="gallery_images">
							<?php
								if ( ! empty( $attachments ) ) {
									foreach ( $attachments as $attachment_id ) {
										echo '<li class="image col-md-4" data-attachment_id="' . esc_attr( $attachment_id ) . '">
											' . wp_get_attachment_image( $attachment_id, 'thumbnail' ) . '
											<ul class="actions">
												<li><a href="#" class="delete tips" data-tip="' . esc_attr__( 'Delete image', 'userplace' ) . '">' . __( 'Delete', 'userplace' ) . '</a></li>
											</ul>
										</li>';
									}
								}
							?>
						</ul>
						<input type="hidden" id="up_gallery_images" name="<?php echo esc_attr( $meta_key ); ?>" value="<?php echo esc_attr( $grabbed_value );  ?>" />
					</div>

					<p class="add_gallery_images hide-if-no-js col-md-12">
						<a class="rq rq-button green" href="#" data-choose="<?php esc_attr_e( 'Add Images to Gallery', 'userplace' ); ?>" data-update="<?php esc_attr_e( 'Add to gallery', 'userplace' ); ?>" data-delete="<?php esc_attr_e( 'Delete image', 'userplace' ); ?>" data-text="<?php esc_attr_e( 'Delete', 'userplace' ); ?>"><?php _e( 'Add gallery images', 'userplace' ); ?></a>
					</p>

					<p class="pull-right"><?php echo esc_attr( $desc );  ?></p>
					<br>

				<?php endif; ?>


				<!-- start gallery images for repeatbundle -->
				<?php if( $this->type == 'repeatBundle'): ?>
					<div class="row">
						<div class="repeat_bundle_gallery">
							<input name="<?php echo esc_attr( $meta_key ); ?>[]" type="hidden" class="gallery-hidden userplace-input" value="<?php echo esc_attr( $this->load );  ?>">

							<ul class="gallery-images">
								<?php
									if ( ! empty( $bundle_attachments ) ) {
										foreach ( $bundle_attachments as $attachment_id ) {
											echo '<li class="image col-md-4" data-attachment_id="' . esc_attr( $attachment_id ) . '">
												' . wp_get_attachment_image( $attachment_id, 'thumbnail' ) . '
												<ul class="actions">
													<li><a href="#" class="delete tips" data-id="'.$attachment_id.'" data-tip="' . esc_attr__( 'Delete image', 'userplace' ) . '">' . __( 'Delete', 'userplace' ) . '</a></li>
												</ul>
											</li>';
										}
									}
								?>

							</ul>

							<div style="display: block; margin-bottom: 10px;">
								<a class="upload_bundle_gallery_button rq rq-button green" href="#" data-choose="<?php esc_attr_e( 'Add Images to Gallery', 'userplace' ); ?>" data-update="<?php esc_attr_e( 'Add to gallery', 'userplace' ); ?>" data-delete="<?php esc_attr_e( 'Delete image', 'userplace' ); ?>" data-text="<?php esc_attr_e( 'Delete', 'userplace' ); ?>"><?php _e( 'Add gallery images', 'userplace' ); ?></a>
							</div>
						</div>
					</div>
				<?php endif; ?>
				<!-- end gallery images for repeatbundle -->

			</div>
		</div>

	<?php
	}

}


<?php

namespace Reactive\Admin\Generator\Metabox;



class Re_Meta_Generator_wp_editor
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
				$grabbed_value = $default_value;
			}
		}

	?>

		<div class="row">
			<div class="col-xs-4 up_meta_head for-wp-editor">
				<label><?php echo esc_attr( $box_title ); ?></label>
				<span><?php echo esc_attr( $box_sub_title ); ?></span>
			</div>
			<div class="col-xs-8 up_meta_tail">

				<?php if( $this->type == 'linear'): ?>
					<?php wp_editor( $grabbed_value, $meta_key, $settings = array() ); ?>
					<p class="pull-right"><?php echo esc_attr( $desc );  ?></p>
					<br>

				<?php endif; ?>

				<?php if( $this->type == 'repeatBundle'): ?>
					<div class="row">
						<div class="col-xs-10">
							<?php wp_editor( $this->load, $meta_key, $settings = array() ); ?>
							<br>
						</div>
					</div>
				<?php endif; ?>

			</div>
		</div>

	<?php
	}

}


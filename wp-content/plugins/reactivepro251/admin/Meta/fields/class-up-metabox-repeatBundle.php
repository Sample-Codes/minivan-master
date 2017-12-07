<?php

namespace Reactive\Admin\Generator\Metabox;



class Re_Meta_Generator_repeatBundle
{
	public $bundle;
	public $post_id;
	public $type;


	public function __construct( $post_id ,  $type , $bundle )
	{
		$this->bundle = $bundle;
		$this->post_id = $post_id;
		$this->type = $type;
		$this->process_for_render($bundle);
	}

	public function process_for_render( $bundle ){

		$metafields = $bundle['fields'];

		if( isset( $bundle['title'] ) && !empty( $bundle['title'] ) ){
			$bundle_title = $bundle['title'];
		}else{
			$bundle_title = '';
		}

		if( isset( $bundle['subtitle'] ) && !empty( $bundle['subtitle'] ) ){
			$bundle_subtitle = $bundle['subtitle'];
		}else{
			$bundle_subtitle = '';
		}

		if( isset( $bundle['bundle_id'] ) && !empty( $bundle['bundle_id'] ) ){
			$bundle_id = $bundle['bundle_id'];
			$grabbed_value = get_post_meta( $this->post_id , $bundle_id , true);


			if(isset($grabbed_value) && !empty($grabbed_value)){
				foreach ($metafields as $field_key => $field_value) {
					foreach ($grabbed_value as $grab_key => $grab_value) {
						if(!array_key_exists($field_value['id'], $grab_value)){
							$grabbed_value[$grab_key][$field_value['id']] = $field_value['default_value'];
						}
					}
				}
			}


		}

		if( !isset( $grabbed_value ) || empty( $grabbed_value ) ){
			$grabbed_value = array();

		}

	?>



	<div class="up-repeatBundle-holder">

		<div class="row  meta-single-content">

			<div class="col-xs-4">
				<label><?php echo esc_attr( $bundle_title ); ?> </label><span><?php echo esc_attr( $bundle_subtitle );  ?></span>
			</div>

			<div class="col-xs-3 pull-right">
				<a href="#" class="up-addBundle-field rq rq-button green"><?php _e('Add More','userplace'); ?></a>
			</div>

		</div>
		<br/>

		<?php if( empty($grabbed_value)): ?>
			<div class="up-repeatBundle">
				<a href="#" class="up-sortBundle-row"><span class="glyphicon glyphicon-option-vertical option_drag"></span></a>

				<div class="pull-right">
					<a class="remove-rowBundle" href="#"><span class="glyphicon glyphicon-remove option_cross"></span></a>
				</div>

				<?php foreach( $metafields as  $field ) {   ?>

					<?php
						if($field['type'] == 'date'){
							$default_value = date("Y-m-d", strtotime($field['default_value']));
						}elseif($field['type'] == 'time'){
							$default_value = 'none';
						}else{
							if(isset($field['default_value'])){
								$default_value = $field['default_value'];
							}else{
								$default_value = 'none';
							}
						}

					?>

					<?php
						$linear_field_call = '\Userplace\Admin\Generator\Metabox\Up_Meta_Generator_'.$field['type'];
						// need to grab their data and pass them .
						new $linear_field_call( $this->post_id , 'repeatBundle' , $field, $default_value );
					?>
				<?php } ?>
			</div>

		<?php else: ?>

				<?php foreach ($grabbed_value as $metadata) {   ?>

					<div class="up-repeatBundle">
						<div class="pull-right">
							<a href="#" class="up-sortBundle-row"><span class="fa fa-bars"></span></a>
							<a class="remove-rowBundle" href="#">X</a>
						</div>

					    <?php
				    		foreach ($metadata as $metakey => $metavalue) {
								foreach( $metafields as  $field ) {
									if( $field['id'] == $metakey){
										$linear_field_call = '\Userplace\Admin\Generator\Metabox\Up_Meta_Generator_'.$field['type'];
										new $linear_field_call( $this->post_id , 'repeatBundle' , $field , $metavalue );
									}
								}
							}
						?>

					</div>

				<?php }  ?>

		<?php endif; ?>
	</div>

	<?php
	}

}

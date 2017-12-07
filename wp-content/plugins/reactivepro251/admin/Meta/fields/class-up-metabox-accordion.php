<?php

namespace Reactive\Admin\Generator\Metabox;

class Re_Meta_Generator_accordion
{
	public $metafields;
	public $post_id;
	public $type;


	public function __construct( $post_id ,  $type , $metafields )
	{
		$this->metafields = $metafields;
		$this->post_id = $post_id;
		$this->type = $type;

		$this->render_output($metafields);

	}

	public function render_output($metafields){

	?>



	<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
	 	<?php 	foreach ($metafields as $tab_key => $tab) { ?>


		  	<div class="panel panel-default">
			    <div class="panel-heading" role="tab" id="h<?php echo esc_attr( $tab['tab_id'] );  ?>">
			      	<h4 class="panel-title">
				        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#<?php echo esc_attr( $tab['tab_id'] );  ?>" aria-expanded="true" aria-controls="<?php echo esc_attr( $tab['tab_id'] );  ?>">
				         	<?php echo esc_attr( $tab['tab_title'] );  ?>
				        </a>
			      	</h4>
			    </div>

			    <div id="<?php echo esc_attr( $tab['tab_id'] );  ?>" class="panel-collapse  collapse" role="tabpanel" aria-labelledby="h<?php echo esc_attr( $tab['tab_id'] );  ?>">
			      	<div class="panel-body">
						<?php

							foreach ($tab['tab_fields'] as  $field_types ) {
								foreach ($field_types as $type => $fields) {
									if( $type == 'linear' || $type == 'repeat'){
										foreach ($fields as $field) {
											$meta_type_call = '\Reactive\Admin\Generator\Metabox\Re_Meta_Generator_'.$field['type'];
											if ( class_exists($meta_type_call) ){
												new $meta_type_call( $this->post_id , $type , $field );
											}
										}
									}

									if( $type == 'repeatBundle' ){
										$call = '\Reactive\Admin\Generator\Metabox\Re_Meta_Generator_'.$type;
										if (class_exists($call)){
											new  $call( $this->post_id , $type , $fields );
										}
									}
								}
							}
						?>
				    </div>
				</div>
			</div>

	 	<?php	} ?>
	</div>

	<?php

	}

}















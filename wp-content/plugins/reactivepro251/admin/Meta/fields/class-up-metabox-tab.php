<?php

namespace Reactive\Admin\Generator\Metabox;

class Re_Meta_Generator_tab
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


	<ul class="nav nav-tabs" role="tablist">
		<?php 	foreach ($metafields as $tab_key => $tab) {  ?>
			<li role="presentation" <?php if( $tab_key == 0) echo 'class="active"';  ?>><a href="#<?php echo esc_attr( $tab['tab_id'] );  ?>" aria-controls="<?php echo esc_attr( $tab['tab_id'] );  ?>" role="tab" data-toggle="tab"><?php echo esc_attr( $tab['tab_title'] );  ?></a></li>
		<?php	} ?>
	</ul>

	 <div class="tab-content">
	 	<?php 	foreach ($metafields as $tab_key => $tab) {  ?>
			<div role="tabpanel" class="tab-pane <?php if( $tab_key == 0) echo 'active';  ?>" id="<?php echo esc_attr( $tab['tab_id'] );  ?>">
				<h4><?php //echo esc_attr( $tab['tab_title'] );  ?></h4>
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
	 	<?php	} ?>
	</div>

<?php

	}

}


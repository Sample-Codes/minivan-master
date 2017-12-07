<?php
/**
* Map MetaBox
*
* @version 1.0.2
* @since 1.0.2
* @return null
*/

namespace Reactive\Admin\Generator\Metabox;

class Re_Meta_Generator_map
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
			if(isset($grabbed_value) && empty($grabbed_value)){
				$grabbed_value['country'] = '';
				$grabbed_value['region'] = '';
				$grabbed_value['address'] = '';
				$grabbed_value['zip'] = '';
				$grabbed_value['lat'] = '';
				$grabbed_value['lng'] = '';
			}
		}

	?>

	<div class="row meta-single-content">

		<div class="col-xs-4 up_meta_head">
			<label>Country Name</label>
		</div>
		<div class="col-xs-8 up_meta_tail">
			<input type="text" class="up_country" name="<?php echo esc_attr( $meta_key ); ?>[country]"  class="form-control" placeholder="country" value="<?php echo esc_attr( $grabbed_value['country'] );  ?>" >
		</div>
		<div class="col-xs-4 up_meta_head">
			<label>Region</label>
		</div>
		<div class="col-xs-8 up_meta_tail">
			<input type="text" class="up_region" name="<?php echo esc_attr( $meta_key ); ?>[region]"  class="form-control" placeholder="region" value="<?php echo esc_attr( $grabbed_value['region'] ); ?>" >
		</div>
		<div class="col-xs-4 up_meta_head">
			<label>Address Name</label>
		</div>
		<div class="col-xs-8 up_meta_tail">
			<input type="text" class="up_address" name="<?php echo esc_attr( $meta_key ); ?>[address]"  class="form-control" placeholder="address" value="<?php echo esc_attr( $grabbed_value['address'] ); ?>" >
		</div>
		<div class="col-xs-4 up_meta_head">
			<label>zip code</label>
		</div>
		<div class="col-xs-8 up_meta_tail">
		<div class="row">
			<div class="col-md-8">
				<input type="text" class="up_zip" name="<?php echo esc_attr( $meta_key ); ?>[zip]"  class="form-control" placeholder="zip" value="<?php echo esc_attr( $grabbed_value['zip'] ); ?>" >
			</div>
			<div class="col-md-4">
				<button class="convert-zip-into-location btn rq rq-button green fluid">Convert zip</button>
			</div>
		</div>

		</div>
		<div class="col-xs-4 up_meta_head">
			<label>lognititute</label>
		</div>
		<div class="col-xs-8 up_meta_tail">
			<input type="text" class="up_long" name="<?php echo esc_attr( $meta_key ); ?>[lng]"  class="form-control" placeholder="long" value="<?php echo esc_attr( $grabbed_value['lng'] ); ?>" >
		</div>
		<div class="col-xs-4 up_meta_head">
			<label>latitute</label>
		</div>
		<div class="col-xs-8 up_meta_tail">
			<input type="text" class="up_lat" name="<?php echo esc_attr( $meta_key ); ?>[lat]"  class="form-control" placeholder="lat" value="<?php echo esc_attr( $grabbed_value['lat'] ); ?>" >
		</div>
		<div id="map_canvas" style="height: 400px; width: 95%; margin: 20px;"></div>
	</div>

	<?php
	}

}


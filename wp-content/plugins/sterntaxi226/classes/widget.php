<?php
// Creating the widget 
class stern_taxi_fare_widget extends WP_Widget {

	function __construct() {
		parent::__construct(
			// Base ID of your widget
			'stern_taxi_fare_widget', 

			// Widget name will appear in UI
			__('Stern taxi fare widget', 'stern-taxi-fare-widget'), 

			// Widget description
			array( 'description' => __( 'Stern taxi fare widget', 'stern-taxi-fare-widget' ), ) 
		);
	}

	// Creating widget front-end
	// This is where the action happens
	public function widget( $args, $instance ) {
		
			$title = apply_filters( 'widget_title', $instance['title'] );
			
			
			echo $args['before_widget'];
			if ( ! empty( $title ) ) {
				echo $args['before_title'] . $title . $args['after_title'];
			}
			
			$atts="";
			launchForm($atts);
				
			
		
	}
		
	// Widget Backend 
	public function form( $instance ) {
		if ( isset( $instance[ 'title' ] ) && isset( $instance[ 'no_of_events' ] ) ) {
			$title = $instance[ 'title' ];
			$no_of_events = $instance[ 'no_of_events' ];
		}
		else {
			$title = __( 'Booking form', 'stern_taxi_fare' );
			$no_of_events = 4;
		}
	// Widget admin form
	?>
	<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
	</p>

	<?php
	}
	
	// Updating widget replacing old instances with new
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		
		return $instance;
	}
} // Class stern_taxi_fare_widget ends here

// Register and load the widget
function stern_taxi_fare_widget() {
	register_widget( 'stern_taxi_fare_widget' );
}
add_action( 'widgets_init', 'stern_taxi_fare_widget' );


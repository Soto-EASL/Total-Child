<?php

// Prevent direct file access
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
if ( ! class_exists( 'EASL_Recent_Items_Widget' ) ) {
	class EASL_Recent_Items_Widget extends WP_Widget {
		function __construct() {
			// Instantiate the parent object
			parent::__construct( 'easl_recent_items', __( 'EASL - Recent Items', 'total-child' ) );
		}

		function widget( $args, $instance ) {
			$title = isset( $instance['title'] ) ? apply_filters( 'widget_title', $instance['title'] ) : '';
			$show_filter = isset( $instance['show_filter'] ) ? $instance['show_filter'] : 'no';
			echo $args['before_widget'];
			// Display widget title
			if ( $title ) {
				echo $args['before_title'] . $title . $args['after_title'];
			}
			if($show_filter == 'yes'){
				get_template_part('partials/widgets/recent-items-filter');
			}
			get_template_part('partials/widgets/recent-items');
			echo $args['after_widget'];
		}

		function update( $new_instance, $old_instance ) {
			$instance          = $old_instance;
			$instance['title'] = ! empty( $new_instance['title'] ) ? strip_tags( $new_instance['title'] ) : '';
			$instance['show_filter'] = ! empty( $new_instance['show_filter'] ) ? 'yes' : 'no';

			return $instance;
		}

		function form( $instance ) {
			$show_filter = $title = '';
			extract( wp_parse_args( ( array ) $instance, array(
				'title' => '',
				'show_filter' => 'yes',
			) ) ); ?>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title', 'total-child' ); ?>
					:</label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"
				       name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text"
				       value="<?php echo esc_attr( $title ); ?>"/>
			</p>
			<p>
				<input id="<?php echo esc_attr( $this->get_field_id( 'show_filter' ) ); ?>"
				       name="<?php echo esc_attr( $this->get_field_name( 'show_filter' ) ); ?>" type="checkbox"
				       value="1" <?php checked('yes', $show_filter, true); ?>/>
				<label for="<?php echo esc_attr( $this->get_field_id( 'show_filter' ) ); ?>"><?php esc_html_e( 'Show Filter', 'total-child' ); ?></label>
			</p>
			<?php
		}
	}
}
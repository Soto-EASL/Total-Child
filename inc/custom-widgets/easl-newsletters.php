<?php

// Prevent direct file access
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
if ( ! class_exists( 'EASL_Newsletters_Widget' ) ) {
	class EASL_Newsletters_Widget extends WP_Widget {
		function __construct() {
			// Instantiate the parent object
			parent::__construct( 'easl_newsletters', __( 'EASL - Newsletters', 'total-child' ) );
		}

		function widget( $args, $instance ) {
			$title = isset( $instance['title'] ) ? apply_filters( 'widget_title', $instance['title'] ) : '';
			echo $args['before_widget'];
			// Display widget title
			if ( $title ) {
				echo $args['before_title'] . $title . $args['after_title'];
			}
			get_template_part('partials/newsletter/list');
			echo $args['after_widget'];
		}

		function update( $new_instance, $old_instance ) {
			$instance          = $old_instance;
			$instance['title'] = ! empty( $new_instance['title'] ) ? strip_tags( $new_instance['title'] ) : '';

			return $instance;
		}

		function form( $instance ) {
			extract( wp_parse_args( ( array ) $instance, array(
				'title' => '',
			) ) ); ?>

            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title', 'total-child' ); ?>
                    :</label>
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"
                       name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text"
                       value="<?php echo esc_attr( $title ); ?>"/>
            </p>
			<?php
		}
	}
}
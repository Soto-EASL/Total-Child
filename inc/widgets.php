<?php
// Prevent direct file access
if ( ! defined ( 'ABSPATH' ) ) {
	exit;
}

require_once get_theme_file_path('inc/custom-widgets/easl-newsletters.php');

function easl_register_custom_widgets() {
	if(class_exists( 'EASL_Newsletters_Widget' )){
		register_widget('EASL_Newsletters_Widget');
	}
}
add_action( 'widgets_init', 'easl_register_custom_widgets' );
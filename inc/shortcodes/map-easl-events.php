<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

return array(
	'name' => __( 'EASL Events', 'total' ),
	'base' => 'easl_events',
	'category' => __( 'EASL', 'total' ),
	'description' => __( 'EASL Events', 'total' ),
	'icon' => 'vcex-icon fa fa-list-alt',
	'php_class_name' => 'EASL_VC_Events',
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => __( 'Widget title', 'js_composer' ),
			'param_name' => 'title',
			'description' => __( 'Enter text used as widget title (Note: located above content element).', 'js_composer' ),
		),
		array(
			'type'        => 'textfield',
			'heading'     => __( 'Widget subtitle', 'js_composer' ),
			'param_name'  => 'subtitle',
			'description' => __( 'Enter text used as widget subtitle (Note: located below Widget title).', 'js_composer' ),
		),
		array(
			'type'        => 'textfield',
			'heading'     => __( 'Number of Events', 'total' ),
			'param_name'  => 'numberposts',
			'std'         => '4',
			'description' => __( 'You can leave empty to display all Events.', 'total' ),
		),
		array(
			'type' => 'checkbox',
			'param_name' => 'view_all_link',
			'heading' => __( 'Show view all link?', 'total' ),
			'description' => __( 'Enable view all links beside widget title.', 'total' ),
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'View All links Text', 'js_composer' ),
			'param_name' => 'view_all_text',
			'description' => __( 'Enter text used as view all events link.', 'js_composer' ),
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'View All links URL', 'js_composer' ),
			'param_name' => 'view_all_url',
			'description' => __( 'Enter URL used as view all events link.', 'js_composer' ),
		),
		vc_map_add_css_animation(),
		array(
			'type' => 'el_id',
			'heading' => __( 'Element ID', 'js_composer' ),
			'param_name' => 'el_id',
			'description' => sprintf( __( 'Enter element ID (Note: make sure it is unique and valid according to <a href="%s" target="_blank">w3c specification</a>).', 'js_composer' ), 'http://www.w3schools.com/tags/att_global_id.asp' ),
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Extra class name', 'js_composer' ),
			'param_name' => 'el_class',
			'description' => __( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'js_composer' ),
		),
		array(
			'type' => 'css_editor',
			'heading' => __( 'CSS box', 'js_composer' ),
			'param_name' => 'css',
			'group' => __( 'Design Options', 'js_composer' ),
		),
	),
);

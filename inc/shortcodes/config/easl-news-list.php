<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

return array(
	'name' => __( 'EASL News List', 'total-child' ),
	'base' => 'easl_news_list',
	'category' => __( 'EASL', 'total' ),
	'description' => __( 'EASL News', 'total-child' ),
	'icon' => 'vcex-icon fa fa-list-alt',
	'php_class_name' => 'EASL_VC_News_List',
	'params' => array(
		vc_map_add_css_animation(),
		array(
			'type' => 'el_id',
			'heading' => __( 'Element ID', 'total-child' ),
			'param_name' => 'el_id',
			'description' => sprintf( __( 'Enter element ID (Note: make sure it is unique and valid according to <a href="%s" target="_blank">w3c specification</a>).', 'total-child' ), 'http://www.w3schools.com/tags/att_global_id.asp' ),
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Extra class name', 'total-child' ),
			'param_name' => 'el_class',
			'description' => __( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'total-child' ),
		),
		array(
			'type'			 => 'textfield',
			'heading'		 => __( 'Number of news', 'total' ),
			'param_name'	 => 'limit',
			'value'			 => '6',
			'description'	 => __( 'Enter the limit of news to show. Leave empty to show all.', 'total' ),
			'group'			 => __( 'Query', 'total-child' ),
		),
		array(
			'type' => 'css_editor',
			'heading' => __( 'CSS box', 'total-child' ),
			'param_name' => 'css',
			'group' => __( 'Design Options', 'total-child' ),
		),
	),
);

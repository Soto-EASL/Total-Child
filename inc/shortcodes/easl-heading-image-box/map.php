<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

return array(
	'name'                    => __( 'EASL Heading Image Box', 'total-child' ),
	'base'                    => 'easl_heading_image_box',
	'is_container'            => false,
	'show_settings_on_create' => true,
	'category'                => __( 'EASL Small Events', 'total-child' ),
	'description'             => __( 'Add a heading image box.', 'total-child' ),
	'icon'                    => 'vcex-icon ticon ticon-picture-o',
	'php_class_name'          => 'EASL_VC_Heading_Image_Box',
	'params'                  => array(
		array(
			'type'        => 'attach_image',
			'heading'     => __( 'Image', 'total-child' ),
			'param_name'  => 'image',
			'value'       => '',
			'admin_label' => false,
		),
		array(
			'type'        => 'textfield',
			'heading'     => __( 'Title', 'total-child' ),
			'param_name'  => 'heading',
			'value'       => '',
			'admin_label' => true,
		),
		array(
			'type'        => 'dropdown',
			'heading'     => __( 'Box Aspect Ratio', 'total-child' ),
			'param_name'  => 'box_ar',
			'value'       => array(
				__( 'Default(5:3)', 'total-child' ) => '',
				__( '4:3', 'total-child' )          => '4_3',
				__( '8:3', 'total-child' )          => '8_3',
				__( '12:3', 'total-child' )         => '8_3',
				__( '3:2', 'total-child' )          => '3_2',
				__( '6:2', 'total-child' )          => '6_2',
				__( '9:2', 'total-child' )          => '6_2',
				__( '5:3', 'total-child' )          => '5_3',
				__( '10:3', 'total-child' )         => '10_3',
				__( '15:3', 'total-child' )         => '10_3',
			),
			'admin_label' => false,
		),
		array(
			'type'        => 'dropdown',
			'heading'     => __( 'Popup Type', 'total-child' ),
			'param_name'  => 'popup_type',
			'value'       => array(
				__( 'No popup', 'total-child' )       => '',
				__( 'Link to a page', 'total-child' ) => 'link',
				__( 'Image', 'total-child' )          => 'image',
				__( 'Google Map', 'total-child' )     => 'gmap',
				__( 'PDF', 'total-child' )            => 'pdf',
				__( 'Video', 'total-child' )          => 'video',
				__( 'Custom Content', 'total-child' ) => 'custom',
				__( 'Popup Template', 'total-child' ) => 'template',
			),
			'admin_label' => false,
			'group'       => __( 'Popup', 'total-child' ),
		),
		array(
			'type'        => 'textfield',
			'heading'     => __( 'URL', 'total-child' ),
			'param_name'  => 'link',
			'value'       => '',
			'admin_label' => false,
			'dependency'  => array(
				'element' => 'popup_type',
				'value'   => array( 'link' ),
			),
			'group'       => __( 'Popup', 'total-child' ),
		),
		array(
			'type'        => 'attach_image',
			'heading'     => __( 'Image', 'total-child' ),
			'param_name'  => 'pop_image',
			'value'       => '',
			'admin_label' => false,
			'dependency'  => array(
				'element' => 'popup_type',
				'value'   => array( 'image' ),
			),
			'group'       => __( 'Popup', 'total-child' ),
		),
		array(
			'type'        => 'textfield',
			'heading'     => __( 'PDF URL', 'total-child' ),
			'param_name'  => 'pdf',
			'value'       => '',
			'admin_label' => false,
			'dependency'  => array(
				'element' => 'popup_type',
				'value'   => array( 'pdf' ),
			),
			'group'       => __( 'Popup', 'total-child' ),
		),
		array(
			'type'        => 'textfield',
			'heading'     => __( 'Google Map URL', 'total-child' ),
			'param_name'  => 'gmap_url',
			'value'       => '',
			'admin_label' => false,
			'dependency'  => array(
				'element' => 'popup_type',
				'value'   => array( 'gmap' ),
			),
			'group'       => __( 'Popup', 'total-child' ),
		),
		array(
			'type'        => 'textfield',
			'heading'     => __( 'Video URL', 'total-child' ),
			'param_name'  => 'video_url',
			'value'       => '',
			'admin_label' => false,
			'dependency'  => array(
				'element' => 'popup_type',
				'value'   => array( 'video' ),
			),
			'group'       => __( 'Popup', 'total-child' ),
		),
		array(
			'type'        => 'textarea_html',
			'heading'     => __( 'Custom Content', 'js_composer' ),
			'param_name'  => 'content',
			'admin_label' => false,
			'dependency'  => array(
				'element' => 'popup_type',
				'value'   => array( 'custom' ),
			),
			'group'       => __( 'Popup', 'total-child' ),
		),
		array(
			'type'        => 'dropdown',
			'heading'     => __( 'Popup Template', 'total-child' ),
			'param_name'  => 'template',
			'value'       => EASL_VC_Heading_Image_Box::get_popup_template_dd(),
			'admin_label' => false,
			'dependency'  => array(
				'element' => 'popup_type',
				'value'   => array( 'template' ),
			),
			'group'       => __( 'Popup', 'total-child' ),
		),
		array(
			'type'       => 'vcex_ofswitch',
			'heading'    => __( 'Open in new Tab(pop will not work)', 'total-child' ),
			'param_name' => 'new_tab',
			'std'        => 'true',
			'admin_label' => false,
			'dependency'  => array(
				'element' => 'popup_type',
				'value'   => array( 'link' ),
			),
			'group'       => __( 'Popup', 'total-child' ),
		),
		array(
			'type'        => 'dropdown',
			'heading'     => __( 'Type', 'total-child' ),
			'param_name'  => 'sch_type',
			'value'       => array(
				__( 'None - Show always', 'total-child' ) => '',
				__( 'Show before Date', 'total-child' )   => 'before',
				__( 'Show after Date', 'total-child' )    => 'after',
				__( 'Show between Dates', 'total-child' ) => 'between',
			),
			'std'         => '',
			'admin_label' => false,
			'group'       => __( 'Schedule', 'total-child' ),
		),
		array(
			'type'        => 'textfield',
			'heading'     => __( 'Date', 'total-child' ),
			'param_name'  => 'sch_date',
			'value'       => '',
			'admin_label' => false,
			'description' => 'Enter date in dd/mm/yyyy format',
			'dependency'  => array(
				'element' => 'sch_type',
				'value'   => array( 'before', 'after', 'between' ),
			),
			'group'       => __( 'Schedule', 'total-child' ),
		),
		array(
			'type'        => 'textfield',
			'heading'     => __( 'Date 2', 'total-child' ),
			'param_name'  => 'sch_date2',
			'value'       => '',
			'admin_label' => false,
			'description' => 'Enter date in dd/mm/yyyy format',
			'dependency'  => array(
				'element' => 'sch_type',
				'value'   => array( 'between' ),
			),
			'group'       => __( 'Schedule', 'total-child' ),
		),
		array(
			'type'        => 'el_id',
			'heading'     => __( 'Element ID', 'total-child' ),
			'param_name'  => 'el_id',
			'description' => sprintf( __( 'Enter element ID (Note: make sure it is unique and valid according to <a href="%s" target="_blank">w3c specification</a>).', 'total-child' ), 'http://www.w3schools.com/tags/att_global_id.asp' ),
		),
		array(
			'type'        => 'textfield',
			'heading'     => __( 'Extra class name', 'total-child' ),
			'param_name'  => 'el_class',
			'description' => __( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'total-child' ),
		),
		array(
			'type'       => 'css_editor',
			'heading'    => __( 'CSS box', 'total-child' ),
			'param_name' => 'css',
			'group'      => __( 'Design Options', 'total-child' ),
		),
	),
);

<?php
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}

return array(
    'name' => __( 'EASL Card Button', 'total' ),
    'base' => 'easl_card_button',
    'is_container' => false,
    'show_settings_on_create' => true,
    'category' => __( 'EASL', 'total' ),
    'description' => __( 'EASL Card Button', 'total' ),
    'icon' => 'vcex-iconticon ticon-external-link-square',
    'php_class_name' => 'EASL_VC_Card_Button',
    'params' => array(
        array(
            'type' => 'textfield',
            'heading' => __( 'Button Text', 'total' ),
            'param_name' => 'button_text',
            'description' => __( 'Enter button text.', 'total' ),
        ),
        array(
            'type' => 'textfield',
            'heading' => __( 'Button Link', 'total' ),
            'param_name' => 'button_link',
            'description' => __( 'Enter button link.', 'total' ),
        ),
        array(
            'type' => 'dropdown',
            'heading' => __( 'Button Link Target', 'js_composer' ),
            'param_name' => 'button_link_target',
            'value' => vc_target_param_list(),
        ),
        array(
            'type' => 'dropdown',
            'heading' => __( 'Button Icon', 'total' ),
            'param_name' => 'button_icon',
            'value' => easl_vc_button_grid_icons(),
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

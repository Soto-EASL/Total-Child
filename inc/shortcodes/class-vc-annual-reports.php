<?php


if( !class_exists('EASL_VC_ANNUAL_REPORTS') ){
    class EASL_VC_ANNUAL_REPORTS {

        public function __construct() {
            add_shortcode( 'easl_annual_reports', array( $this, 'output' ) );
            vc_lean_map( 'easl_annual_reports', array( $this, 'map' ) );

        }

        /**
         * Shortcode output => Get template file and display shortcode
         *
         * @since 4.0
         */
        public function output( $atts, $content = null ) {
            ob_start();
            include( get_stylesheet_directory() . '/vc_templates/easl_annual_reports.php' );
            return ob_get_clean();
        }

        public function map() {
            return array(
                'name' => __( 'EASL Annual Reports', 'total' ),
                'base' => 'easl_annual_reports',
                'category' => __( 'EASL', 'total' ),
                'description' => __( 'EASL Annual Reports', 'total' ),
                'icon' => 'vcex-iconticon ticon-users',
                'php_class_name' => 'EASL_VC_ANNUAL_REPORTS',
                'params' => array(
                    vc_map_add_css_animation(),
                    array(
                        'type' => 'el_id',
                        'heading' => __( 'Element ID', 'js_composer' ),
                        'param_name' => 'el_id',
                        'description' => sprintf( __( 'Enter element ID (Note: make sure it is unique and valid according to <a href="%s" target="_blank">w3c specification</a>).', 'js_composer' ),
                            'http://www.w3schools.com/tags/att_global_id.asp' ),
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
        }
    }
}
new EASL_VC_ANNUAL_REPORTS;

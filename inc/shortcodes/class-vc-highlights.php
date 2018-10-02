<?php
/**
 * EASL_VC_STAFF_LIST
 */

if( !class_exists('EASL_VC_HIGHLIGHTS') ){
    class EASL_VC_HIGHLIGHTS {

        public function __construct() {
            add_shortcode( 'easl_highlights', array( $this, 'output' ) );
            vc_lean_map( 'easl_highlights', array( $this, 'map' ) );

            // Admin filters
            if ( is_admin() ) {

                // Get autocomplete suggestion
                add_filter( 'vc_autocomplete_easl_highlights_include_categories_callback', 'vcex_suggest_staff_categories', 10, 1 );
                add_filter( 'vc_autocomplete_easl_highlights_exclude_categories_callback', 'vcex_suggest_staff_categories', 10, 1 );
                add_filter( 'vc_autocomplete_easl_highlights_filter_active_category_callback', 'vcex_suggest_staff_categories', 10, 1 );

                // Render autocomplete suggestions
                add_filter( 'vc_autocomplete_easl_highlights_include_categories_render', 'vcex_render_staff_categories', 10, 1 );
                add_filter( 'vc_autocomplete_easl_highlights_exclude_categories_render', 'vcex_render_staff_categories', 10, 1 );
                add_filter( 'vc_autocomplete_easl_highlights_filter_active_category_render', 'vcex_render_staff_categories', 10, 1 );


            }

        }

        /**
         * Shortcode output => Get template file and display shortcode
         *
         * @since 4.0
         */
        public function output( $atts, $content = null ) {
            ob_start();
            include( get_stylesheet_directory() . '/vc_templates/easl_highlights.php' );
            return ob_get_clean();
        }

        public function map() {
            return array(
                'name' => __( 'EASL Highlights', 'total' ),
                'base' => 'easl_highlights',
                'category' => __( 'EASL', 'total' ),
                'description' => __( 'EASL Highlights', 'total' ),
                'icon' => 'vcex-icon fa fa-users',
                'php_class_name' => 'EASL_VC_YI_Fellowship',
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
new EASL_VC_HIGHLIGHTS;

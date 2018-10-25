<?php


if( !class_exists('EASL_VC_AWARDEES') ){
    class EASL_VC_AWARDEES {

        public function __construct() {
            add_shortcode( 'easl_awardees', array( $this, 'output' ) );
            vc_lean_map( 'easl_awardees', array( $this, 'map' ) );

            // Admin filters
            if ( is_admin() ) {

                // Get autocomplete suggestion
                add_filter( 'vc_autocomplete_easl_awardees_include_tags_callback', array( $this,'vcex_staff_tags'), 10, 1 );
                add_filter( 'vc_autocomplete_easl_awardees_exclude_tags_callback', array( $this,'vcex_staff_tags'), 10, 1 );
                add_filter( 'vc_autocomplete_easl_awardees_filter_active_tags_callback', array( $this,'vcex_staff_tags'), 10, 1 );

                // Render autocomplete suggestions
                add_filter( 'vc_autocomplete_easl_awardees_include_tags_render', array( $this,'vcex_render_staff_tags'), 10, 1 );
                add_filter( 'vc_autocomplete_easl_awardees_exclude_tags_render', array( $this,'vcex_render_staff_tags'), 10, 1 );
                add_filter( 'vc_autocomplete_easl_awardees_filter_active_tags_render', array( $this,'vcex_render_staff_tags'), 10, 1 );


            }

        }

        /**
         * Shortcode output => Get template file and display shortcode
         *
         * @since 4.0
         */
        public function output( $atts, $content = null ) {
            ob_start();
            include( get_stylesheet_directory() . '/vc_templates/easl_awardees.php' );
            return ob_get_clean();
        }

        public function map() {
            return array(
                'name' => __( 'EASL Awardees', 'total' ),
                'base' => 'easl_awardees',
                'category' => __( 'EASL', 'total' ),
                'description' => __( 'EASL Awardees', 'total' ),
                'icon' => 'vcex-icon fa fa-users',
                'php_class_name' => 'EASL_VC_AWARDEES',
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
                        'type'		 => 'dropdown',
                        'heading'	 => __( 'Staffs per row', 'total' ),
                        'param_name' => 'staff_col_width',
                        'std'		 => '3',
                        'value'		 => array(
                            __( '1 Item', 'total' )	 => '1',
                            __( '2 Item', 'total' )	 => '2',
                            __( '3 Item', 'total' )	 => '3',
                            __( '4 Item', 'total' )	 => '4',
                        ),
                    ),
                    array(
                        'type' => 'css_editor',
                        'heading' => __( 'CSS box', 'js_composer' ),
                        'param_name' => 'css',
                        'group' => __( 'Design Options', 'js_composer' ),
                    ),
                    // Query
                    array(
                        'type' => 'vcex_ofswitch',
                        'std' => 'false',
                        'heading' => __( 'Advanced Query?', 'total' ),
                        'param_name' => 'custom_query',
                        'group' => __( 'Query', 'total' ),
                        'description' => __( 'Enable to build a custom query using your own parameter string.', 'total' ),
                    ),
                    array(
                        'type' => 'textarea_safe',
                        'heading' => __( 'Custom query', 'total' ),
                        'param_name' => 'custom_query_args',
                        'description' => __( 'Build custom query according to <a href="http://codex.wordpress.org/Function_Reference/query_posts" target="_blank">WordPress Codex</a>.', 'total' ),
                        'group' => __( 'Query', 'total' ),
                        'dependency' => array( 'element' => 'custom_query', 'value' => array( 'true' ) ),
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' => __( 'Posts Per Page', 'total' ),
                        'param_name' => 'posts_per_page',
                        'value' => '9',
                        'description' => __( 'When pagination is disabled this is also used for the post count.', 'total' ),
                        'group' => __( 'Query', 'total' ),
                        'dependency' => array( 'element' => 'custom_query', 'value' => array( 'false' ) ),
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' => __( 'Offset', 'total' ),
                        'param_name' => 'offset',
                        'group' => __( 'Query', 'total' ),
                        'description' => __( 'Number of post to displace or pass over. Warning: Setting the offset parameter overrides/ignores the paged parameter and breaks pagination. The offset parameter is ignored when posts per page is set to -1.', 'total' ),
                        'dependency' => array( 'element' => 'custom_query', 'value' => array( 'false' ) ),
                    ),
                    array(
                        'type' => 'vcex_ofswitch',
                        'std' => 'false',
                        'heading' => __( 'Pagination', 'total' ),
                        'param_name' => 'pagination',
                        'group' => __( 'Query', 'total' ),
                        'dependency' => array( 'element' => 'custom_query', 'value' => array( 'false' ) ),
                    ),
                    array(
                        'type' => 'autocomplete',
                        'heading' => __( 'Include Tags', 'total' ),
                        'param_name' => 'include_tags',
                        'param_holder_class' => 'vc_not-for-custom',
                        'admin_label' => true,
                        'settings' => array(
                            'multiple' => true,
                            'min_length' => 1,
                            'groups' => false,
                            'unique_values' => true,
                            'display_inline' => true,
                            'delay' => 0,
                            'auto_focus' => true,
                        ),
                        'group' => __( 'Query', 'total' ),
                        'dependency' => array( 'element' => 'custom_query', 'value' => array( 'false' ) ),
                    ),
                    array(
                        'type' => 'autocomplete',
                        'heading' => __( 'Exclude Tags', 'total' ),
                        'param_name' => 'exclude_tags',
                        'param_holder_class' => 'vc_not-for-custom',
                        'admin_label' => true,
                        'settings' => array(
                            'multiple' => true,
                            'min_length' => 1,
                            'groups' => false,
                            'unique_values' => true,
                            'display_inline' => true,
                            'delay' => 0,
                            'auto_focus' => true,
                        ),
                        'group' => __( 'Query', 'total' ),
                        'dependency' => array( 'element' => 'custom_query', 'value' => array( 'false' ) ),
                    ),
                    array(
                        'type' => 'dropdown',
                        'heading' => __( 'Order', 'total' ),
                        'param_name' => 'order',
                        'group' => __( 'Query', 'total' ),
                        'value' => array(
                            __( 'Default', 'total' ) => '',
                            __( 'DESC', 'total' ) => 'DESC',
                            __( 'ASC', 'total' ) => 'ASC',
                        ),
                        'dependency' => array( 'element' => 'custom_query', 'value' => array( 'false' ) ),
                    ),
                    array(
                        'type' => 'dropdown',
                        'heading' => __( 'Order By', 'total' ),
                        'param_name' => 'orderby',
                        'value' => vcex_orderby_array(),
                        'group' => __( 'Query', 'total' ),
                        'dependency' => array( 'element' => 'custom_query', 'value' => array( 'false' ) ),
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' => __( 'Orderby: Meta Key', 'total' ),
                        'param_name' => 'orderby_meta_key',
                        'group' => __( 'Query', 'total' ),
                        'dependency' => array(
                            'element' => 'orderby',
                            'value' => array( 'meta_value_num', 'meta_value' ),
                        ),
                    ),
                    // Filter
                    array(
                        'type' => 'vcex_ofswitch',
                        'std' => 'false',
                        'heading' => __( 'Enable', 'total' ),
                        'param_name' => 'filter',
                        'description' => __( 'Enables a category filter to show and hide posts based on their categories. This does not load posts via AJAX, but rather filters items currently on the page.', 'total' ),
                        'group' => __( 'Filter', 'total' ),
                        'dependency' => array( 'element' => 'custom_query', 'value' => array( 'false' ) ),
                    ),
                    array(
                        'type' => 'vcex_ofswitch',
                        'std' => 'true',
                        'heading' => __( 'Display All Link?', 'total' ),
                        'param_name' => 'filter_all_link',
                        'group' => __( 'Filter', 'total' ),
                        'dependency' => array( 'element' => 'filter', 'value' => 'true' ),
                    ),
                    array(
                        'type' => 'vcex_ofswitch',
                        'std' => 'no',
                        'heading' => __( 'Center Filter Links', 'total' ),
                        'param_name' => 'center_filter',
                        'vcex' => array(
                            'off' => 'no',
                            'on' => 'yes',
                        ),
                        'group' => __( 'Filter', 'total' ),
                        'dependency' => array( 'element' => 'filter', 'value' => 'true' ),
                    ),
                    array(
                        'type' => 'autocomplete',
                        'heading' => __( 'Default Active Tags', 'total' ),
                        'param_name' => 'filter_active_tags',
                        'param_holder_class' => 'vc_not-for-custom',
                        'admin_label' => true,
                        'settings' => array(
                            'multiple' => false,
                            'min_length' => 1,
                            'groups' => false,
                            'unique_values' => true,
                            'display_inline' => true,
                            'delay' => 0,
                            'auto_focus' => true,
                        ),
                        'group' => __( 'Filter', 'total' ),
                        'dependency' => array( 'element' => 'filter', 'value' => 'true' ),
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' => __( 'Custom Filter "All" Text', 'total' ),
                        'param_name' => 'all_text',
                        'group' => __( 'Filter', 'total' ),
                        'dependency' => array( 'element' => 'filter_all_link', 'value' => 'true' ),
                    ),
                    array(
                        'type' => 'vcex_button_styles',
                        'heading' => __( 'Button Style', 'total' ),
                        'param_name' => 'filter_button_style',
                        'group' => __( 'Filter', 'total' ),
                        'std' => 'minimal-border',
                        'dependency' => array( 'element' => 'filter', 'value' => 'true' ),
                    ),
                    array(
                        'type' => 'vcex_button_colors',
                        'heading' => __( 'Button Color', 'total' ),
                        'param_name' => 'filter_button_color',
                        'group' => __( 'Filter', 'total' ),
                        'dependency' => array( 'element' => 'filter', 'value' => 'true' ),
                    ),
                    array(
                        'type' => 'dropdown',
                        'heading' => __( 'Layout Mode', 'total' ),
                        'param_name' => 'masonry_layout_mode',
                        'value' => array(
                            __( 'Masonry', 'total' ) => 'masonry',
                            __( 'Fit Rows', 'total' ) => 'fitRows',
                        ),
                        'group' => __( 'Filter', 'total' ),
                        'dependency' => array( 'element' => 'filter', 'value' => 'true' ),
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' => __( 'Custom Filter Speed', 'total' ),
                        'param_name' => 'filter_speed',
                        'description' => __( 'Default is 0.4 seconds. Enter 0.0 to disable.', 'total' ),
                        'group' => __( 'Filter', 'total' ),
                        'dependency' => array( 'element' => 'filter', 'value' => 'true' ),
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' => __( 'Font Size', 'total' ),
                        'param_name' => 'filter_font_size',
                        'group' => __( 'Filter', 'total' ),
                        'dependency' => array( 'element' => 'filter', 'value' => 'true' ),
                    ),
                ),
            );
        }

        public function vcex_staff_tags( $search_string ) {
            $staff_tags = array();
            $get_terms = get_terms(
                'staff_tag',
                array(
                    'hide_empty' => false,
                    'search'     => $search_string,
                ) );
            if ( $get_terms ) {
                foreach ( $get_terms as $term ) {
                    if ( $term->parent ) {
                        $parent = get_term( $term->parent, 'staff_tag' );
                        $label = $term->name .' ('. $parent->name .')';
                    } else {
                        $label = $term->name;
                    }
                    $staff_tags[] = array(
                        'label' => $label,
                        'value' => $term->term_id,
                    );
                }
            }
            return $staff_tags;
        }

        public function vcex_render_staff_tags( $data ) {
            $value = $data['value'];
            $term = get_term_by( 'term_id', intval( $value ), 'staff_tag' );
            if ( is_object( $term ) ) {
                if ( $term->parent ) {
                    $parent = get_term( $term->parent, 'staff_tag' );
                    $label = $term->name .' ('. $parent->name .')';
                } else {
                    $label = $term->name;
                }
                return array(
                    'label' => $label,
                    'value' => $value,
                );
            }
            return $data;
        }
    }
}
new EASL_VC_AWARDEES;

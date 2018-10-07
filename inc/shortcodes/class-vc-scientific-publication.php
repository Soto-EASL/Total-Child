<?php
if( !class_exists('EASL_VC_Scientific_Publication') ){
	class EASL_VC_Scientific_Publication {

        public function __construct() {
            add_shortcode( 'easl_scientific_publication', array( $this, 'output' ) );
            vc_lean_map( 'easl_scientific_publication', array( $this, 'map' ) );

            // Admin filters
            if ( is_admin() ) {

                // Get autocomplete suggestion
                add_filter( 'vc_autocomplete_easl_scientific_publication_include_categories_callback', array( $this, 'vcex_suggest_publication_categories'), 10, 1 );
                add_filter( 'vc_autocomplete_easl_scientific_publication_exclude_categories_callback', array( $this, 'vcex_suggest_publication_categories'), 10, 1 );
                add_filter( 'vc_autocomplete_easl_scientific_publication_filter_active_category_callback', array( $this, 'vcex_suggest_publication_categories'), 10, 1 );

                // Render autocomplete suggestions
                add_filter( 'vc_autocomplete_easl_scientific_publication_include_categories_render', array( $this, 'vcex_render_publication_categories'), 10, 1 );
                add_filter( 'vc_autocomplete_easl_scientific_publication_exclude_categories_render', array( $this, 'vcex_render_publication_categories'), 10, 1 );
                add_filter( 'vc_autocomplete_easl_scientific_publication_filter_active_category_render', array( $this, 'vcex_render_publication_categories'), 10, 1 );


            }

        }

        /**
         * Shortcode output => Get template file and display shortcode
         *
         * @since 4.0
         */
        public function output( $atts, $content = null ) {
            ob_start();
            include( get_stylesheet_directory() . '/vc_templates/easl_scientific_publication.php' );
            return ob_get_clean();
        }

        public function map() {
            return array(
                'name' => __( 'EASL Scientific Publication', 'total' ),
                'base' => 'easl_scientific_publication',
                'category' => __( 'EASL', 'total' ),
                'description' => __( 'EASL Scientific Publication', 'total' ),
                'icon' => 'vcex-icon fa fa-book',
                'php_class_name' => 'EASL_VC_Scientific_Publication',
                'params' => array(
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
                        'heading' => __( 'Include Categories', 'total' ),
                        'param_name' => 'include_categories',
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
                        'heading' => __( 'Exclude Categories', 'total' ),
                        'param_name' => 'exclude_categories',
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
                    // View
                    array(
                        'type' => 'vcex_ofswitch',
                        'std' => 'false',
                        'heading' => __( 'Hide Topic?', 'total' ),
                        'param_name' => 'hide_topic',
                        'group' => __( 'View', 'total' ),
                        'description' => __( 'Hide Topic.', 'total' ),
                    ),
                    array(
                        'type' => 'vcex_ofswitch',
                        'std' => 'false',
                        'heading' => __( 'Deny Detail page?', 'total' ),
                        'param_name' => 'deny_detail_page',
                        'group' => __( 'View', 'total' ),
                        'description' => __( 'Deny Detail page.', 'total' ),
                    ),
                    array(
                        'type' => 'vcex_ofswitch',
                        'std' => 'false',
                        'heading' => __( 'Hide Excerpt?', 'total' ),
                        'param_name' => 'hide_excerpt',
                        'group' => __( 'View', 'total' ),
                        'description' => __( 'Hide Excerpt.', 'total' ),
                    ),

                    // Design Options
                    array(
                        'type' => 'css_editor',
                        'heading' => __( 'CSS box', 'js_composer' ),
                        'param_name' => 'css',
                        'group' => __( 'Design Options', 'js_composer' ),
                    ),
                ),
            );
        }

        /**
         * Suggest Publication Categories for autocomplete
         *
         * @since 2.1.0
         */
        public function vcex_suggest_publication_categories( $search_string ) {
            $publication_categories = array();
            $get_terms = get_terms(
                'publication_category',
                array(
                    'hide_empty' => false,
                    'search'     => $search_string,
                ) );

            if ( $get_terms ) {
                foreach ( $get_terms as $term ) {
                    if ( $term->parent ) {
                        $parent = get_term( $term->parent, 'publication_category' );
                        $label = $term->name .' ('. $parent->name .')';
                    } else {
                        $label = $term->name;
                    }
                    $publication_categories[] = array(
                        'label' => $label,
                        'value' => $term->term_id,
                    );
                }
            }
            return $publication_categories;
        }

        /**
         * Renders Publication Categories for autocomplete
         *
         * @since 2.1.0
         */
        public function vcex_render_publication_categories( $data ) {
            $value = $data['value'];
            $term = get_term_by( 'term_id', intval( $value ), 'publication_category' );
            if ( is_object( $term ) ) {
                if ( $term->parent ) {
                    $parent = get_term( $term->parent, 'publication_category' );
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
new EASL_VC_Scientific_Publication;

<?php

class Fellowship_Config {

    protected static $slugs = array(
        'fellowship' => 'fellowship',
    );

    /**
     * Get thing started
     */
    public function __construct() {
        add_action( 'init', array( 'Fellowship_Config', 'register_post_type' ), 0 );
        if ( is_admin() ) {
            // Add settings metabox to event
            add_filter( 'wpex_main_metaboxes_post_types', array( 'Fellowship_Config', 'meta_array' ), 20 );
        }
    }

    public static function get_fellowship_slug(){
        return self::$slugs['fellowship'];
    }

    /**
     * Register post type.
     */
    public static function register_post_type() {
        register_post_type( self::get_fellowship_slug(), array(
            'labels' => array(
                'name' => __( 'Fellowship', 'total' ),
                'singular_name' => __( 'Event', 'total' ),
                'add_new' => __( 'Add New', 'total' ),
                'add_new_item' => __( 'Add New Item', 'total' ),
                'edit_item' => __( 'Edit Item', 'total' ),
                'new_item' => __( 'Add New Item', 'total' ),
                'view_item' => __( 'View Item', 'total' ),
                'search_items' => __( 'Search Items', 'total' ),
                'not_found' => __( 'No Items Found', 'total' ),
                'not_found_in_trash' => __( 'No Items Found In Trash', 'total' )
            ),
            'public' => true,
            'capability_type' => 'post',
            'has_archive' => false,
            'menu_position' => 20,
            'rewrite' => array( 'slug' => self::get_fellowship_slug(), 'with_front' => false ),
            'supports' => array(
                'title',
                'editor',
                'excerpt',
                'thumbnail',
                'comments',
                'custom-fields',
                'revisions',
                'author',
                'page-attributes',
            ),
        ) );
    }

    public static function meta_array( $types ) {
        $types[] = 'fellowship';
        return $types;
    }


}

new Fellowship_Config;
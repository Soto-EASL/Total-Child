<?php
/**
 * Staff Post Type Configuration file
 *
 * @package Total WordPress Theme
 * @subpackage Staff Functions
 * @version 4.6.5
 */

// The class
class WPEX_Associations_Config {

    /**
     * Get things started.
     *
     * @since 2.0.0
     */
    public function __construct() {

        // Adds the staff post type
        add_action( 'init', array( 'WPEX_Associations_Config', 'register_post_type' ), 0 );

        // Adds the staff taxonomies

        add_action( 'init', array( 'WPEX_Associations_Config', 'register_categories' ), 0 );


        /*-------------------------------------------------------------------------------*/
        /* -  Admin only actions/filters
        /*-------------------------------------------------------------------------------*/
        if ( is_admin() ) {
            // Allows filtering of posts by taxonomy in the admin view
            add_action( 'restrict_manage_posts', array( 'WPEX_Associations_Config', 'tax_filters' ) );

        }




    } // End __construct

    /*-------------------------------------------------------------------------------*/
    /* -  Start Class Functions
    /*-------------------------------------------------------------------------------*/

    /**
     * Register post type.
     *
     * @since 2.0.0
     */
    public static function register_post_type() {

        // Declare args and apply filters
        $args = apply_filters( 'wpex_associations_args', array(

            'labels' => array(
                'name' => __( 'National Associations', 'total' ),
                'singular_name' => __( 'National Association', 'total' ),
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
            'exclude_from_search' => false,
            'publicly_queryable' => false,
            'show_in_nav_menus' => false,
            'supports' => array(
                'title',
                'editor',
                'excerpt',
                'thumbnail',
                'revisions',
                'author',
                'page-attributes',
            ),
            'capability_type' => 'post',
            'has_archive' => false,
            'rewrite' => false,
            'menu_icon' => 'dashicons-groups',
            'menu_position' => 20,
        ) );

        // Register the post type
        register_post_type( 'associations', $args );

    }



    /**
     * Register Staff category.
     *
     * @since 2.0.0
     */
    public static function register_categories() {

        // Define args and apply filters for child theming
        $args = apply_filters( 'wpex_taxonomy_associations_category_args', array(

            'labels' => array(
                'name' => __( 'Association categories', 'total' ),
                'singular_name' => __( 'Association category', 'total' ),
                'add_new' => __( 'Add New', 'total' ),
                'add_new_item' => __( 'Add New Item', 'total' ),
                'edit_item' => __( 'Edit Item', 'total' ),
                'new_item' => __( 'Add New Item', 'total' ),
                'view_item' => __( 'View Item', 'total' ),
                'search_items' => __( 'Search Items', 'total' ),
                'not_found' => __( 'No Items Found', 'total' ),
                'not_found_in_trash' => __( 'No Items Found In Trash', 'total' )
            ),
            'public' => false,
            'show_ui' => true,
            'exclude_from_search' => false,
            'show_admin_column' => true,
            'hierarchical' => true,
            'rewrite' => false,
        ) );

        // Register the staff category taxonomy
        register_taxonomy( 'associations_category', array( 'associations' ), $args );

    }

    /**
     * Adds taxonomy filters to the staff admin page.
     *
     * @since 2.0.0
     */
    public static function tax_filters() {
        global $typenow;
        $taxonomies = array( 'associations_category' );
        if ( 'associations' == $typenow ) {
            foreach ( $taxonomies as $tax_slug ) {
                if ( ! taxonomy_exists( $tax_slug ) ) {
                    continue;
                }
                $current_tax_slug = isset( $_GET[$tax_slug] ) ? $_GET[$tax_slug] : false;
                $tax_obj = get_taxonomy( $tax_slug );
                $tax_name = $tax_obj->labels->name;
                $terms = get_terms($tax_slug);
                if ( count( $terms ) > 0) {
                    echo "<select name='$tax_slug' id='$tax_slug' class='postform'>";
                    echo "<option value=''>$tax_name</option>";
                    foreach ( $terms as $term ) {
                        echo '<option value=' . $term->slug, $current_tax_slug == $term->slug ? ' selected="selected"' : '','>' . $term->name .' (' . $term->count .')</option>';
                    }
                    echo "</select>";
                }
            }
        }
    }
}
new WPEX_Associations_Config;
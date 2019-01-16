<?php
// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
class EASL_Staff_Config {
	protected static $slugs = array(
		'award_group' => 'award_group',
		'award_year' => 'award_year',
	);
	public function __construct() {
		add_action( 'init', array( 'EASL_Staff_Config', 'register_tax' ), 0 );
	}
	public static function get_award_group_slug (){
		return self::$slugs['award_group'];
	}
	public static function get_award_year_slug (){
		return self::$slugs['award_year'];
	}
	/**
	 * Register Award Group
	 *
	 * @since 2.0.0
	 */
	public static function register_award_group() {
		// Define args and apply filters for child theming
		$args = array(
			'labels' => array(
				'name' => __( 'Award Group', 'total' ),
				'singular_name' => __( 'Award Group', 'total' ),
				'menu_name' => __( 'Award Group', 'total' ),
				'search_items' => __( 'Search Award Groups', 'total' ),
				'popular_items' => __( 'Popular Award Groups', 'total' ),
				'all_items' => __( 'All Award Groups', 'total' ),
				'parent_item' => __( 'Parent Award Group', 'total' ),
				'parent_item_colon' => __( 'Parent Award Group:', 'total' ),
				'edit_item' => __( 'Edit Award Group', 'total' ),
				'update_item' => __( 'Update Award Group', 'total' ),
				'add_new_item' => __( 'Add New Award Group', 'total' ),
				'new_item_name' => __( 'New Award Group Name', 'total' ),
				'separate_items_with_commas' => __( 'Separate award group with commas', 'total' ),
				'add_or_remove_items' => __( 'Add or remove award groups', 'total' ),
				'choose_from_most_used' => __( 'Choose from the most used award groups', 'total' ),
			),
			'public' => false,
			'show_in_nav_menus' => false,
			'show_ui' => true,
			'show_tagcloud' => false,
			'hierarchical' => true,
			'rewrite' => false,
			'query_var' => false
		);

		// Register the staff tag taxonomy
		register_taxonomy( self::get_award_group_slug(), array( 'staff' ), $args );
	}
	/**
	 * Register Award Year.
	 *
	 * @since 2.0.0
	 */
	public static function register_award_year() {
		// Define args and apply filters for child theming
		$args = array(
			'labels' => array(
				'name' => __( 'Award Year', 'total' ),
				'singular_name' => __( 'Award Year', 'total' ),
				'menu_name' => __( 'Award Year', 'total' ),
				'search_items' => __( 'Search Award Years', 'total' ),
				'popular_items' => __( 'Popular Award Years', 'total' ),
				'all_items' => __( 'All Award Years', 'total' ),
				'parent_item' => __( 'Parent Award Year', 'total' ),
				'parent_item_colon' => __( 'Parent Award Year:', 'total' ),
				'edit_item' => __( 'Edit Award Year', 'total' ),
				'update_item' => __( 'Update Award Year', 'total' ),
				'add_new_item' => __( 'Add New Award Year', 'total' ),
				'new_item_name' => __( 'New Award Year Name', 'total' ),
				'separate_items_with_commas' => __( 'Separate award year with commas', 'total' ),
				'add_or_remove_items' => __( 'Add or remove award years', 'total' ),
				'choose_from_most_used' => __( 'Choose from the most used award years', 'total' ),
			),
			'public' => false,
			'show_in_nav_menus' => false,
			'show_ui' => true,
			'show_tagcloud' => false,
			'hierarchical' => false,
			'rewrite' => false,
			'query_var' => false
		);

		// Register the staff tag taxonomy
		register_taxonomy( self::get_award_year_slug(), array( 'staff' ), $args );
	}
	public static function register_tax(){
		self::register_award_group();
		self::register_award_year();
	}
}
//new EASL_Staff_Config();